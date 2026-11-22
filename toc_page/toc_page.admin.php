<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
 * Table of Contents Page plugin - admin panel
 *
 * Filename: toc_page.admin.php
 * Purpose:  Главный интерфейс администрирования плагина (хук `tools`,
 *           admin.php?m=other&p=toc_page). Вкладки:
 *             1. trees        - список деревьев, создание, переименование, удаление;
 *             2. edit         - элементы дерева, добавление, удаление (рекурсивно);
 *             3. edit_element - редактирование одного элемента;
 *             4. i18n         - переводы заголовков и URL (при включённой мультиязычности).
 *           Действия задаются GET-параметром `a`.
 * Path:     plugins/toc_page/toc_page.admin.php
 *
 * Date: Nov 22, 2026
 *
 * @package toc_page
 * @version 1.4.0
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('toc_page', 'plug');
require_once cot_incfile('toc_page', 'plug', 'functions');
require_once cot_incfile('forms');

$tab = cot_import('tab', 'G', 'ALP') ?: 'trees';
$treeId = (int)cot_import('tree', 'G', 'INT');
$a = cot_import('a', 'G', 'ALP');

// Инициализация мультиязычности
$i18nActive = toc_page_i18n_enabled();
$activeLangs = $i18nActive ? toc_page_get_active_langs() : [];
$defaultLang = toc_page_get_default_lang();

// Пагинация
$perPage = (int)(Cot::$cfg['plugin']['toc_page']['perpage'] ?? 20);
if ($perPage < 1) {
    $perPage = 20;
}

$allowedTypes = ['category', 'page', 'custom'];

// Вкладки edit/i18n без указанного дерева -> первое дерево или список деревьев
if (($tab == 'edit' || $tab == 'i18n') && $treeId <= 0) {
    $firstTree = Cot::$db->query(
        "SELECT tree_id FROM " . Cot::$db->toc_page_trees . " ORDER BY tree_id ASC LIMIT 1"
    )->fetchColumn();
    if ($firstTree) {
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => $tab, 'tree' => $firstTree], '', true));
    } else {
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }
}

$t = new XTemplate(cot_tplfile('toc_page.admin', 'plug', true));

$t->assign([
    'TAB_TREES_ACTIVE'   => $tab == 'trees' ? 'active' : '',
    'TAB_EDIT_ACTIVE'    => $tab == 'edit' ? 'active' : '',
    'TAB_I18N_ACTIVE'    => $tab == 'i18n' ? 'active' : '',
    'TAB_ELEMENT_ACTIVE' => $tab == 'edit_element' ? 'active' : '',
    'URL_TREES'          => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees']),
    'URL_EDIT'           => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId]),
    'URL_I18N'           => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'i18n', 'tree' => $treeId]),
    'URL_EDIT_ELEMENT'   => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit_element']),
]);

/**
 * Подпись и описание ссылки элемента для таблиц админки
 */
$tocRefInfo = function (array $item) {
    if ($item['item_type'] == 'category') {
        $catCode = $item['item_ref'];
        return isset(Cot::$structure['page'][$catCode])
            ? htmlspecialchars(Cot::$structure['page'][$catCode]['title'])
            : Cot::$L['toc_page_category_not_found'];
    }
    if ($item['item_type'] == 'page') {
        $page = Cot::$db->query(
            "SELECT page_title FROM " . Cot::$db->pages . " WHERE page_id = ?",
            [(int)$item['item_ref']]
        )->fetch();
        return $page ? htmlspecialchars($page['page_title']) : Cot::$L['toc_page_page_not_found'];
    }
    return htmlspecialchars($item['item_url']);
};

/**
 * Select2-поле выбора страницы (HTML) + подключение скриптов
 */
$tocPageSelect2 = function ($currentRef, $currentPageIdForAjax) {
    Resources::linkFileFooter(Resources::SELECT2);
    $ajaxUrl = cot_url('plug', [
        'r'               => 'toc_page',
        'ajax'            => 'search',
        'current_page_id' => (int)$currentPageIdForAjax,
    ], '', true);
    $placeholder = addslashes(Cot::$L['toc_page_selectpage'] ?? 'Начните вводить название страницы...');

    $html = '<div class="customrelated-row mb-3">';
    $html .= '<input type="hidden" name="item_ref_page" class="toc-page-id" value="' . htmlspecialchars((string)$currentRef) . '" />';
    $html .= '<select class="toc-page-select" data-placeholder="' . htmlspecialchars($placeholder) . '"></select>';
    $html .= '</div>';

    $js = <<<JS
document.addEventListener('DOMContentLoaded', function () {
    $('.toc-page-select').each(function () {
        if (this.dataset.inited) return;
        this.dataset.inited = true;
        const \$select = $(this);
        \$select.select2({
            ajax: {
                url: '{$ajaxUrl}',
                dataType: 'json',
                delay: 300,
                data: params => ({ q: params.term || '' }),
                processResults: data => ({ results: data.results || [] }),
                cache: true
            },
            minimumInputLength: 2,
            width: '100%',
            placeholder: '{$placeholder}',
            allowClear: true
        });
        \$select.on('change', function () {
            \$select.closest('.customrelated-row').find('.toc-page-id').val(\$select.val() || '');
        });
    });
});
JS;
    Resources::embedFooter($js);

    return $html;
};

/* ========== Вкладка: Деревья ========== */
if ($tab == 'trees') {
    // Обновление названия и описания дерева
    if ($a == 'update_tree' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $newTitle = cot_import('edit_tree_title', 'P', 'TXT', 255);
        $newDesc  = cot_import('edit_tree_desc', 'P', 'TXT');
        if ($treeId > 0 && !empty($newTitle)) {
            Cot::$db->update(
                Cot::$db->toc_page_trees,
                [
                    'tree_title'       => $newTitle,
                    'tree_description' => (string)$newDesc,
                    'tree_updated'     => time(),
                ],
                'tree_id = ?',
                [$treeId]
            );
            cot_message(Cot::$L['toc_page_msg_tree_updated']);
        }
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }

    // Форма редактирования дерева
    if ($a == 'edit_tree' && $treeId > 0) {
        $treeToEdit = Cot::$db->query(
            "SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?",
            [$treeId]
        )->fetch();
        if ($treeToEdit) {
            $t->assign([
                'EDIT_TREE_ID'       => $treeToEdit['tree_id'],
                'EDIT_TREE_TITLE'    => cot_inputbox('text', 'edit_tree_title', htmlspecialchars($treeToEdit['tree_title']), 'class="form-control"'),
                'EDIT_TREE_DESC'     => cot_inputbox('text', 'edit_tree_desc', htmlspecialchars((string)$treeToEdit['tree_description']), 'class="form-control"'),
                'EDIT_TREE_FORM_URL' => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'update_tree', 'tree' => $treeToEdit['tree_id']]),
            ]);
            $t->parse('MAIN.EDIT_TREE_FORM');
        }
    }

    // Добавление нового дерева
    if ($a == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = cot_import('tree_title', 'P', 'TXT', 255);
        $desc  = cot_import('tree_desc', 'P', 'TXT');
        if (!empty($title)) {
            Cot::$db->insert(Cot::$db->toc_page_trees, [
                'tree_title'       => $title,
                'tree_description' => (string)$desc,
                'tree_created'     => time(),
                'tree_updated'     => time(),
            ]);
            cot_message(Cot::$L['toc_page_msg_tree_created']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
        }
    }

    // Удаление дерева (элементы и переводы тоже)
    if ($a == 'delete' && $treeId > 0) {
        $itemIds = Cot::$db->query(
            "SELECT item_id FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ?",
            [$treeId]
        )->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($itemIds)) {
            $placeholders = implode(',', array_fill(0, count($itemIds), '?'));
            Cot::$db->delete(Cot::$db->toc_page_i18n, "item_id IN ($placeholders)", $itemIds);
        }

        Cot::$db->delete(Cot::$db->toc_page_items, 'tree_id = ?', [$treeId]);
        Cot::$db->delete(Cot::$db->toc_page_trees, 'tree_id = ?', [$treeId]);

        cot_message(Cot::$L['toc_page_msg_tree_deleted']);
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }

    $trees = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " ORDER BY tree_id")->fetchAll();
    foreach ($trees as $tree) {
        $t->assign([
            'TREE_ID'         => $tree['tree_id'],
            'TREE_TITLE'      => htmlspecialchars($tree['tree_title']),
            'TREE_DESC'       => htmlspecialchars((string)$tree['tree_description']),
            'TREE_CODE'       => htmlspecialchars(
                "<!-- IF {PHP|cot_plugin_active('toc_page')} -->\n"
                . "{PHP|cot_toc_page_render(" . $tree['tree_id'] . ", 'toc_page.tree')}\n"
                . "<!-- ENDIF -->"
            ),
            'TREE_EDIT_URL'   => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $tree['tree_id']]),
            'TREE_RENAME_URL' => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'edit_tree', 'tree' => $tree['tree_id']]),
            'TREE_DELETE_URL' => cot_confirm_url(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'delete', 'tree' => $tree['tree_id']])),
        ]);
        $t->parse('MAIN.TREES_ROW');
    }

    $t->assign([
        'ADD_TREE_FORM_URL' => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'add']),
        'ADD_TREE_TITLE'    => cot_inputbox('text', 'tree_title', '', 'class="form-control"'),
        'ADD_TREE_DESC'     => cot_inputbox('text', 'tree_desc', '', 'class="form-control"'),
    ]);
}

/* ========== Вкладка: Редактирование дерева ========== */
if ($tab == 'edit' && $treeId > 0) {
    $tree = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?", [$treeId])->fetch();
    if (!$tree) {
        cot_die_message(404);
    }

    list($pg, $d, $durl) = cot_import_pagenav('d', $perPage);

    // Удаление пункта (рекурсивно вместе с потомками и переводами)
    if ($a == 'delete_item') {
        $itemId = (int)cot_import('item_id', 'G', 'INT');
        if ($itemId > 0) {
            $idsToDelete = [];
            $queue = [$itemId];
            while (!empty($queue)) {
                $currentId = array_shift($queue);
                if (in_array($currentId, $idsToDelete, true)) {
                    continue; // защита от циклов
                }
                $idsToDelete[] = $currentId;
                $childIds = Cot::$db->query(
                    "SELECT item_id FROM " . Cot::$db->toc_page_items . " WHERE parent_id = ? AND tree_id = ?",
                    [$currentId, $treeId]
                )->fetchAll(PDO::FETCH_COLUMN);
                foreach ($childIds as $childId) {
                    $queue[] = (int)$childId;
                }
            }
            $placeholders = implode(',', array_fill(0, count($idsToDelete), '?'));
            Cot::$db->delete(Cot::$db->toc_page_i18n, "item_id IN ($placeholders)", $idsToDelete);
            Cot::$db->delete(Cot::$db->toc_page_items, "item_id IN ($placeholders)", $idsToDelete);

            cot_message(Cot::$L['toc_page_msg_item_deleted']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'd' => 0], '', true));
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Сохранение изменений элементов
        if ($a == 'save') {
            $items = cot_import('items', 'P', 'ARR');
            if (is_array($items)) {
                foreach ($items as $itemId => $data) {
                    $itemId = (int)$itemId;
                    if ($itemId <= 0) {
                        continue;
                    }
                    $parentId = isset($data['parent_id']) ? (int)$data['parent_id'] : 0;
                    if ($parentId === $itemId) {
                        $parentId = 0; // элемент не может быть родителем самого себя
                    }
                    Cot::$db->update(
                        Cot::$db->toc_page_items,
                        [
                            'parent_id'    => $parentId,
                            'item_sort'    => isset($data['sort']) ? max(0, (int)$data['sort']) : 0,
                            'item_title'   => isset($data['title']) ? trim($data['title']) : '',
                            'item_enabled' => isset($data['enabled']) ? 1 : 0,
                        ],
                        'item_id = ? AND tree_id = ?',
                        [$itemId, $treeId]
                    );
                }
                cot_message(Cot::$L['toc_page_msg_items_saved']);
                cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'd' => $durl], '', true));
            }
        }

        // Добавление нового элемента
        if ($a == 'add_item') {
            $type = cot_import('item_type', 'P', 'ALP');
            if (!in_array($type, $allowedTypes, true)) {
                $type = 'custom';
            }
            $ref = '';
            if ($type == 'category') {
                $ref = (string)cot_import('item_ref_cat', 'P', 'TXT', 255);
            } elseif ($type == 'page') {
                $ref = (string)(int)cot_import('item_ref_page', 'P', 'INT');
            }
            $title = (string)cot_import('item_title', 'P', 'TXT', 255);
            $url = (string)cot_import('item_url', 'P', 'TXT', 255);
            $parentId = (int)cot_import('parent_id', 'P', 'INT');

            $maxSort = Cot::$db->query(
                "SELECT MAX(item_sort) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? AND parent_id = ?",
                [$treeId, $parentId]
            )->fetchColumn();
            $newSort = ($maxSort !== false && $maxSort !== null) ? (int)$maxSort + 1 : 0;

            Cot::$db->insert(Cot::$db->toc_page_items, [
                'tree_id'      => $treeId,
                'parent_id'    => $parentId,
                'item_type'    => $type,
                'item_ref'     => $ref,
                'item_title'   => $title,
                'item_url'     => $url,
                'item_sort'    => $newSort,
                'item_enabled' => 1,
            ]);
            cot_message(Cot::$L['toc_page_msg_item_added']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'd' => 0], '', true));
        }
    }

    $totalItems = (int)Cot::$db->query(
        "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ?",
        [$treeId]
    )->fetchColumn();

    // Все элементы дерева для выпадающих списков
    $allTreeItems = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? ORDER BY parent_id, item_sort",
        [$treeId]
    )->fetchAll();

    // Элементы текущей страницы
    $allItems = array_slice($allTreeItems, $d, $perPage);

    if (!empty($allItems)) {
        foreach ($allItems as $item) {
            $parentOptions = '<option value="0"' . ($item['parent_id'] == 0 ? ' selected' : '') . '>' . Cot::$L['toc_page_top_level'] . '</option>';
            foreach ($allTreeItems as $optItem) {
                if ($optItem['item_id'] == $item['item_id']) {
                    continue;
                }
                $selected = ($optItem['item_id'] == $item['parent_id']) ? ' selected' : '';
                $parentOptions .= '<option value="' . $optItem['item_id'] . '"' . $selected . '>' . htmlspecialchars($optItem['item_title']) . '</option>';
            }

            $t->assign([
                'ITEM_ID'              => $item['item_id'],
                'ITEM_LEVEL'           => 0,
                'ITEM_TYPE'            => $item['item_type'],
                'ITEM_REF_INFO'        => $tocRefInfo($item),
                'ITEM_TITLE_VALUE'     => htmlspecialchars($item['item_title']),
                'ITEM_PARENT_SELECT'   => $parentOptions,
                'ITEM_SORT'            => $item['item_sort'],
                'ITEM_ENABLED_CHECKED' => $item['item_enabled'] ? 'checked="checked"' : '',
                'ITEM_DELETE_URL'      => cot_confirm_url(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'a' => 'delete_item', 'item_id' => $item['item_id']])),
                'ITEM_EDIT_URL'        => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit_element', 'item' => $item['item_id']]),
            ]);
            $t->parse('MAIN.EDIT_ITEM');
        }
    } else {
        $t->parse('MAIN.EDIT_EMPTY');
    }

    // Данные для форм добавления
    $categories = [];
    if (!empty(Cot::$structure['page'])) {
        foreach (Cot::$structure['page'] as $code => $cat) {
            $categories[$code] = $cat['title'];
        }
    }

    $parentOptions = '<option value="0">' . Cot::$L['toc_page_top_level'] . '</option>';
    foreach ($allTreeItems as $item) {
        $parentOptions .= '<option value="' . $item['item_id'] . '">' . htmlspecialchars($item['item_title']) . '</option>';
    }

    $select2Active = !empty(Cot::$cfg['plugin']['toc_page']['toc_page_select2_use']);
    $pageSelectHtml = '';
    $pageSelectOld = '';
    if ($select2Active) {
        $pageSelectHtml = $tocPageSelect2('', 0);
    } else {
        $pages = Cot::$db->query(
            "SELECT page_id, page_title FROM " . Cot::$db->pages . " WHERE page_state = 0 ORDER BY page_title"
        )->fetchAll();
        $pageSelectOld = cot_selectbox('', 'item_ref_page', array_column($pages, 'page_id'), array_column($pages, 'page_title'), false);
    }

    $pagenav = cot_pagenav('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId], $d, $totalItems, $perPage, 'd');
    $t->assign(cot_generatePaginationTags($pagenav));

    $t->assign([
        'TREE_ID'           => $treeId,
        'TREE_TITLE'        => htmlspecialchars($tree['tree_title']),
        'SAVE_FORM_URL'     => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'a' => 'save', 'd' => $durl]),
        'ADD_ITEM_FORM_URL' => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'a' => 'add_item', 'd' => $durl]),
        'ADD_CAT_SELECT'    => cot_selectbox('', 'item_ref_cat', array_keys($categories), array_values($categories), false),
        'ADD_PAGE_SELECT'   => $pageSelectOld,
        'ADD_PAGE_SELECT2'  => $pageSelectHtml,
        'ADD_PARENT_SELECT' => $parentOptions,
    ]);
}

/* ========== Вкладка: Редактирование элемента ========== */
if ($tab == 'edit_element') {
    $itemId = (int)cot_import('item', 'G', 'INT');
    if ($itemId <= 0) {
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }

    $item = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE item_id = ?",
        [$itemId]
    )->fetch();
    if (!$item) {
        cot_die_message(404);
    }

    $treeId = (int)$item['tree_id'];
    $tree = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?", [$treeId])->fetch();

    // Сохранение изменений элемента
    if ($a == 'save_element' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $type = cot_import('item_type', 'P', 'ALP');
        if (!in_array($type, $allowedTypes, true)) {
            $type = 'custom';
        }
        $ref = '';
        if ($type == 'category') {
            $ref = (string)cot_import('item_ref_cat', 'P', 'TXT', 255);
        } elseif ($type == 'page') {
            $ref = (string)(int)cot_import('item_ref_page', 'P', 'INT');
        }
        $parentId = (int)cot_import('parent_id', 'P', 'INT');
        if ($parentId === $itemId) {
            $parentId = 0;
        }

        Cot::$db->update(
            Cot::$db->toc_page_items,
            [
                'parent_id'    => $parentId,
                'item_sort'    => max(0, (int)cot_import('item_sort', 'P', 'INT')),
                'item_type'    => $type,
                'item_ref'     => $ref,
                'item_title'   => (string)cot_import('item_title', 'P', 'TXT', 255),
                'item_url'     => (string)cot_import('item_url', 'P', 'TXT', 255),
                'item_enabled' => cot_import('item_enabled', 'P', 'BOL') ? 1 : 0,
            ],
            'item_id = ?',
            [$itemId]
        );

        cot_message(Cot::$L['toc_page_msg_item_saved']);
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit_element', 'item' => $itemId], '', true));
    }

    $categories = [];
    if (!empty(Cot::$structure['page'])) {
        foreach (Cot::$structure['page'] as $code => $cat) {
            $categories[$code] = $cat['title'];
        }
    }

    $allItemsForParent = Cot::$db->query(
        "SELECT item_id, item_title FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? AND item_id != ? ORDER BY parent_id, item_sort",
        [$treeId, $itemId]
    )->fetchAll();

    $parentOptions = '<option value="0"' . ($item['parent_id'] == 0 ? ' selected' : '') . '>' . Cot::$L['toc_page_top_level'] . '</option>';
    foreach ($allItemsForParent as $optItem) {
        $selected = ($optItem['item_id'] == $item['parent_id']) ? ' selected' : '';
        $parentOptions .= '<option value="' . $optItem['item_id'] . '"' . $selected . '>' . htmlspecialchars($optItem['item_title']) . '</option>';
    }

    $typeOptions = '';
    foreach ($allowedTypes as $tp) {
        $selected = ($item['item_type'] == $tp) ? ' selected' : '';
        $label = Cot::$L['toc_page_type_' . $tp] ?? $tp;
        $typeOptions .= '<option value="' . $tp . '"' . $selected . '>' . $label . '</option>';
    }

    $select2Active = !empty(Cot::$cfg['plugin']['toc_page']['toc_page_select2_use']);
    $pageSelectHtml = '';
    $pageSelectOld = '';
    if ($select2Active) {
        $pageSelectHtml = $tocPageSelect2($item['item_ref'], $item['item_type'] == 'page' ? (int)$item['item_ref'] : 0);
    } else {
        $pages = Cot::$db->query(
            "SELECT page_id, page_title FROM " . Cot::$db->pages . " WHERE page_state = 0 ORDER BY page_title"
        )->fetchAll();
        // chosen-значение - ПЕРВЫЙ аргумент cot_selectbox
        $pageSelectOld = cot_selectbox($item['item_ref'], 'item_ref_page', array_column($pages, 'page_id'), array_column($pages, 'page_title'), false);
    }

    $t->assign([
        'ELEMENT_ID'              => $item['item_id'],
        'ELEMENT_TREE_ID'         => $treeId,
        'ELEMENT_TREE_TITLE'      => htmlspecialchars($tree['tree_title']),
        'ELEMENT_TYPE_SELECT'     => $typeOptions,
        'ELEMENT_TITLE_VALUE'     => htmlspecialchars($item['item_title']),
        'ELEMENT_URL_VALUE'       => htmlspecialchars($item['item_url']),
        'ELEMENT_CAT_SELECT'      => cot_selectbox($item['item_ref'], 'item_ref_cat', array_keys($categories), array_values($categories), false),
        'ELEMENT_PAGE_SELECT'     => $pageSelectOld,
        'ELEMENT_PAGE_SELECT2'    => $pageSelectHtml,
        'ELEMENT_PARENT_SELECT'   => $parentOptions,
        'ELEMENT_SORT'            => $item['item_sort'],
        'ELEMENT_ENABLED_CHECKED' => $item['item_enabled'] ? 'checked="checked"' : '',
        'ELEMENT_FORM_URL'        => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit_element', 'item' => $itemId, 'a' => 'save_element']),
        'ELEMENT_BACK_URL'        => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId]),
    ]);

    $t->parse('MAIN.EDIT_ELEMENT_FORM');
}

/* ========== Вкладка: Переводы (i18n) ========== */
if ($tab == 'i18n' && $treeId > 0) {
    $tree = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?", [$treeId])->fetch();
    if (!$tree) {
        cot_die_message(404);
    }

    list($pg, $d, $durl) = cot_import_pagenav('d', $perPage);
    $d = (int)$d;

    // Сохранение переводов
    if ($a == 'save_i18n' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $items = cot_import('items', 'P', 'ARR');
        if (is_array($items)) {
            foreach ($items as $itemId => $fields) {
                $itemId = (int)$itemId;
                if ($itemId <= 0) {
                    continue;
                }

                $exists = Cot::$db->query(
                    "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE item_id = ? AND tree_id = ?",
                    [$itemId, $treeId]
                )->fetchColumn();
                if (!$exists) {
                    continue;
                }

                if ($i18nActive && !empty($activeLangs)) {
                    foreach ($activeLangs as $lang) {
                        if ($lang === $defaultLang) {
                            continue;
                        }
                        $titleVal = isset($fields['title_' . $lang]) ? trim($fields['title_' . $lang]) : '';
                        toc_page_i18n_save($itemId, 'item_title', $lang, $titleVal);
                        $urlVal = isset($fields['url_' . $lang]) ? trim($fields['url_' . $lang]) : '';
                        toc_page_i18n_save($itemId, 'item_url', $lang, $urlVal);
                    }
                }
            }
            cot_message(Cot::$L['toc_page_msg_i18n_saved']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'i18n', 'tree' => $treeId, 'd' => $durl], '', true));
        }
    }

    $totalItems = (int)Cot::$db->query(
        "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ?",
        [$treeId]
    )->fetchColumn();

    $allItems = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? ORDER BY parent_id, item_sort LIMIT $d, $perPage",
        [$treeId]
    )->fetchAll();

    // Заголовки языков
    if ($i18nActive && !empty($activeLangs)) {
        foreach ($activeLangs as $lang) {
            if ($lang === $defaultLang) {
                continue;
            }
            $t->assign('LANG_CODE', strtoupper($lang));
            $t->parse('MAIN.I18N_LANG_HEADER');
        }
    }

    if (!empty($allItems)) {
        foreach ($allItems as $item) {
            $t->assign([
                'I18N_ITEM_ID'    => $item['item_id'],
                'I18N_ITEM_TYPE'  => $item['item_type'],
                'I18N_ITEM_REF'   => $tocRefInfo($item),
                'I18N_ITEM_TITLE' => htmlspecialchars($item['item_title']),
            ]);

            if ($i18nActive && !empty($activeLangs)) {
                foreach ($activeLangs as $lang) {
                    if ($lang === $defaultLang) {
                        continue;
                    }
                    $t->assign([
                        'LANG_CODE'   => htmlspecialchars($lang),
                        'TITLE_VALUE' => htmlspecialchars(toc_page_i18n_load($item['item_id'], 'item_title', $lang) ?? ''),
                        'URL_VALUE'   => htmlspecialchars(toc_page_i18n_load($item['item_id'], 'item_url', $lang) ?? ''),
                    ]);
                    $t->parse('MAIN.I18N_ROW.I18N_LANG_FIELDS');
                }
            }

            $t->parse('MAIN.I18N_ROW');
        }
    } else {
        $t->parse('MAIN.I18N_EMPTY');
    }

    $pagenav = cot_pagenav('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'i18n', 'tree' => $treeId], $d, $totalItems, $perPage, 'd');
    $t->assign(cot_generatePaginationTags($pagenav));

    $t->assign([
        'TREE_ID'       => $treeId,
        'TREE_TITLE'    => htmlspecialchars($tree['tree_title']),
        'I18N_ACTIVE'   => $i18nActive ? 1 : 0,
        'I18N_FORM_URL' => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'i18n', 'tree' => $treeId, 'a' => 'save_i18n', 'd' => $durl]),
    ]);
}

cot_display_messages($t);
$t->parse('MAIN');
$pluginBody = $t->text('MAIN');
