<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */


/**
 * ============================================================
 * ДОКУМЕНТАЦИЯ ПО ХУКУ `tools` И ФАЙЛУ toc_page.admin.php
 * ============================================================
 *
 * Хук `tools` в Cotonti используется для подключения административных страниц
 * плагинов через раздел «Администрирование» (admin.php?m=other&p=<код_плагина>).
 *
 * Маршрутизация:
 * ---------------------------------
 * В файле system/router/Router.php метод routeAdminOther() получает
 * код плагина из GET-параметра `p`:
 *
 *   $extensionCode = cot_import('p', 'G', 'ALP', 24);
 *   ...
 *   $extensionType = ExtensionsDictionary::TYPE_PLUGIN;
 *   $route = $this->processAdminExtensionIncludeFiles(
 *       $extensionCode,
 *       $extensionType,
 *       'tools'
 *   );
 *
 * Метод processAdminExtensionIncludeFiles() вызывает:
 *
 *   $route->includeFiles = cot_getextplugins(
 *       $hook,
 *       true,
 *       $extensionCode,
 *       $extensionType
 *   );
 *
 * где $hook = 'tools'. В результате Cotonti подключает все файлы плагина,
 * зарегистрированные с хуком `tools`, включая наш toc_page.admin.php.
 *
 * Наш файл является точкой входа в административный интерфейс плагина
 * Table of Contents Page. Он обрабатывает три вкладки:
 *
 *   1. «Деревья» (tab=trees):
 *      - просмотр списка деревьев;
 *      - создание нового дерева;
 *      - редактирование названия и описания дерева;
 *      - удаление дерева с полной очисткой:
 *          * все элементы дерева;
 *          * все переводы этих элементов;
 *          * само дерево.
 *
 *   2. «Редактирование дерева» (tab=edit):
 *      - просмотр и редактирование элементов выбранного дерева;
 *      - изменение заголовков, порядка сортировки, родительских элементов;
 *      - включение/отключение элементов;
 *      - добавление новых элементов трёх типов: category, page, custom;
 *      - удаление элемента вместе со всеми дочерними элементами
 *        (рекурсивно) и связанными переводами.
 *
 *   3. «Переводы» (tab=i18n):
 *      - доступна только при включённой мультиязычности;
 *      - редактирование переводов заголовков и URL для активных
 *        дополнительных языков;
 *      - сохранение переводов в таблице cot_toc_page_i18n.
 *
 * Управление действиями выполняется через GET-параметр `a` (action):
 *   update_tree, edit_tree, add, delete, save, add_item, delete_item, save_i18n.
 *
 * Дополнительно:
 * ---------------------------------
 * В форме добавления элемента типа «page» поддерживается
 * AJAX-поиск страниц через Select2, если в настройках плагина включена
 * опция toc_page_select2_use. В этом случае в шаблон передаётся
 * переменная ADD_PAGE_SELECT2, а обычный выпадающий список ADD_PAGE_SELECT
 * отключается.
 *
 * ============================================================
 */

/**
 * Table of Contents Page plugin - admin panel
 *
 * Filename: toc_page.admin.php
 * Purpose:   Предоставляет главный интерфейс администрирования плагина.
 *            Реализует управление деревьями, элементами и мультиязычными
 *            переводами через вкладки «Деревья», «Редактирование дерева»
 *            и «Переводы».
 *
 * Path:     plugins/toc_page/toc_page.admin.php
 *
 * Table of Contents Page plugin for Cotonti v1.+, PHP 8.5+, MySQL 8.4
 *
 * Source and updates   https://github.com/webitproff/toc_page-cotonti
 * ReadMeMore:          https://abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti
 * Support:             https://abuyfile.com/ru/forums/cotonti/custom/plugs
 * Cotonti CMF:         https://github.com/Cotonti/Cotonti
 *
 * Date: Aug 24, 2026
 *
 * @package toc_page
 * @version 1.1.4
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */


defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('toc_page', 'plug');
require_once cot_incfile('toc_page', 'plug', 'functions');
require_once cot_incfile('forms');

$tab = cot_import('tab', 'G', 'ALP') ?: 'trees';
$treeId = cot_import('tree', 'G', 'INT');
$a = cot_import('a', 'G', 'ALP');

// Инициализация мультиязычности
$i18nActive = toc_page_i18n_enabled();
$activeLangs = $i18nActive ? toc_page_get_active_langs() : [];
$defaultLang = toc_page_get_default_lang();

// Пагинация: количество элементов на страницу
$perPage = (int) (Cot::$cfg['plugin']['toc_page']['perpage'] ?? 20);
if ($perPage < 1) $perPage = 20;

// Если открыта вкладка редактирования или переводов, но дерево не указано,
// перенаправляем на первое доступное дерево или на список деревьев
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
    'TAB_TREES_ACTIVE'  => $tab == 'trees' ? 'active' : '',
    'TAB_EDIT_ACTIVE'   => $tab == 'edit' ? 'active' : '',
    'TAB_I18N_ACTIVE'   => $tab == 'i18n' ? 'active' : '',
    'TAB_ELEMENT_ACTIVE'=> $tab == 'edit_element' ? 'active' : '',
    'URL_TREES'         => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees']),
    'URL_EDIT'          => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId]),
    'URL_I18N'          => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'i18n', 'tree' => $treeId]),
    'URL_EDIT_ELEMENT'  => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit_element']),
]);

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
                    'tree_description' => $newDesc,
                    'tree_updated'     => time(),
                ],
                'tree_id = ?',
                [$treeId]
            );
            cot_message(Cot::$L['toc_page_msg_tree_updated']);
        }
        cot_redirect(cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'trees'], '', true));
    }

    // Показ формы редактирования дерева
    if ($a == 'edit_tree' && $treeId > 0) {
        $treeToEdit = Cot::$db->query(
            "SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?",
            [$treeId]
        )->fetch();
        if ($treeToEdit) {
            $t->assign([
                'EDIT_TREE_ID'       => $treeToEdit['tree_id'],
                'EDIT_TREE_TITLE'    => cot_inputbox('text', 'edit_tree_title', htmlspecialchars($treeToEdit['tree_title']), 'class="form-control"'),
                'EDIT_TREE_DESC'     => cot_inputbox('text', 'edit_tree_desc', htmlspecialchars($treeToEdit['tree_description']), 'class="form-control"'),
                'EDIT_TREE_FORM_URL' => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'trees','a'=>'update_tree','tree'=>$treeToEdit['tree_id']]),
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
                'tree_description' => $desc,
                'tree_created'     => time(),
                'tree_updated'     => time(),
            ]);
            cot_message(Cot::$L['toc_page_msg_tree_created']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
        }
    }

    // Удаление дерева
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
            'TREE_ID'          => $tree['tree_id'],
            'TREE_TITLE'       => htmlspecialchars($tree['tree_title']),
            'TREE_DESC'        => htmlspecialchars($tree['tree_description']),
            'TREE_CODE'        => htmlspecialchars(
                "<!-- IF {PHP|cot_plugin_active('toc_page')} -->\n"
                . "{PHP|cot_toc_page_render(" . $tree['tree_id'] . ")}\n"
                . "<!-- ENDIF -->"
            ),
            'TREE_EDIT_URL'    => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $tree['tree_id']]),
            'TREE_RENAME_URL'  => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'trees','a'=>'edit_tree','tree'=>$tree['tree_id']]),
            'TREE_DELETE_URL'  => cot_confirm_url(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'delete', 'tree' => $tree['tree_id']])),
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

    // Пагинация для всех элементов
    list($pg, $d, $durl) = cot_import_pagenav('d', $perPage);

    // Обработка удаления пункта через GET (рекурсивно удаляем все дочерние элементы)
    if ($a == 'delete_item') {
        $itemId = cot_import('item_id', 'G', 'INT');
        if ($itemId > 0) {
            $idsToDelete = [];
            $queue = [$itemId];
            while (!empty($queue)) {
                $currentId = array_shift($queue);
                $idsToDelete[] = $currentId;
                $childIds = Cot::$db->query(
                    "SELECT item_id FROM " . Cot::$db->toc_page_items . " WHERE parent_id = ?",
                    [$currentId]
                )->fetchAll(PDO::FETCH_COLUMN);
                foreach ($childIds as $childId) {
                    $queue[] = $childId;
                }
            }
            if (!empty($idsToDelete)) {
                $placeholders = implode(',', array_fill(0, count($idsToDelete), '?'));
                Cot::$db->delete(Cot::$db->toc_page_i18n, "item_id IN ($placeholders)", $idsToDelete);
                Cot::$db->delete(Cot::$db->toc_page_items, "item_id IN ($placeholders)", $idsToDelete);
            }
            cot_message(Cot::$L['toc_page_msg_item_deleted']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'd' => 0], '', true));
        }
    }

    // Обработка POST-запросов
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Сохранение изменений элементов
        if ($a == 'save') {
            $items = cot_import('items', 'P', 'ARR');
            if (is_array($items)) {
                foreach ($items as $itemId => $data) {
                    $itemId = (int)$itemId;
                    if ($itemId <= 0) continue;
                    $parentId = isset($data['parent_id']) ? (int)$data['parent_id'] : 0;
                    $sort = isset($data['sort']) ? (int)$data['sort'] : 0;
                    $title = isset($data['title']) ? trim($data['title']) : '';
                    $enabled = isset($data['enabled']) ? 1 : 0;
                    Cot::$db->update(
                        Cot::$db->toc_page_items,
                        [
                            'parent_id'   => $parentId,
                            'item_sort'   => $sort,
                            'item_title'  => $title,
                            'item_enabled'=> $enabled,
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
            $ref = '';
            if ($type == 'category') {
                $ref = cot_import('item_ref_cat', 'P', 'TXT', 255);
            } elseif ($type == 'page') {
                $ref = cot_import('item_ref_page', 'P', 'INT');
            } else {
                $ref = '';
            }
            $title = cot_import('item_title', 'P', 'TXT', 255);
            $url = cot_import('item_url', 'P', 'TXT', 255);
            $parentId = cot_import('parent_id', 'P', 'INT');

            $maxSort = Cot::$db->query(
                "SELECT MAX(item_sort) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? AND parent_id = ?",
                [$treeId, $parentId]
            )->fetchColumn();
            $newSort = ($maxSort !== false) ? (int)$maxSort + 1 : 0;

            Cot::$db->insert(Cot::$db->toc_page_items, [
                'tree_id'    => $treeId,
                'parent_id'  => $parentId,
                'item_type'  => $type,
                'item_ref'   => (string)$ref,
                'item_title' => $title,
                'item_url'   => $url,
                'item_sort'  => $newSort,
                'item_enabled'=> 1,
            ]);
            cot_message(Cot::$L['toc_page_msg_item_added']);
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId, 'd' => 0], '', true));
        }
    }

    // Получаем общее количество элементов
    $totalItems = Cot::$db->query(
        "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ?",
        [$treeId]
    )->fetchColumn();

    // Все элементы дерева для выпадающих списков
    $allTreeItems = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? ORDER BY parent_id, item_sort",
        [$treeId]
    )->fetchAll();

    // Элементы текущей страницы (плоский список)
    $allItems = array_slice($allTreeItems, $d, $perPage);

    // Выводим строки элементов
    if (!empty($allItems)) {
        foreach ($allItems as $item) {
            $typeLabel = $item['item_type'];
            $refInfo = '';
            if ($item['item_type'] == 'category') {
                $catCode = $item['item_ref'];
                $refInfo = isset(Cot::$structure['page'][$catCode])
                    ? htmlspecialchars(Cot::$structure['page'][$catCode]['title'])
                    : Cot::$L['toc_page_category_not_found'];
            } elseif ($item['item_type'] == 'page') {
                $pageId = (int)$item['item_ref'];
                $page = Cot::$db->query("SELECT page_title FROM " . Cot::$db->pages . " WHERE page_id = ?", [$pageId])->fetch();
                $refInfo = $page ? htmlspecialchars($page['page_title']) : Cot::$L['toc_page_page_not_found'];
            } else {
                $refInfo = htmlspecialchars($item['item_url']);
            }

            $parentOptions = '<option value="0"' . ($item['parent_id'] == 0 ? ' selected' : '') . '>' . Cot::$L['toc_page_top_level'] . '</option>';
            foreach ($allTreeItems as $optItem) {
                if ($optItem['item_id'] == $item['item_id']) continue;
                $selected = ($optItem['item_id'] == $item['parent_id']) ? ' selected' : '';
                $parentOptions .= '<option value="' . $optItem['item_id'] . '"' . $selected . '>' . htmlspecialchars($optItem['item_title']) . '</option>';
            }

            $t->assign([
                'ITEM_ID'             => $item['item_id'],
                'ITEM_LEVEL'          => 0,
                'ITEM_TYPE'           => $typeLabel,
                'ITEM_REF_INFO'       => $refInfo,
                'ITEM_TITLE_VALUE'    => htmlspecialchars($item['item_title']),
                'ITEM_PARENT_SELECT'  => $parentOptions,
                'ITEM_SORT'           => $item['item_sort'],
                'ITEM_ENABLED_CHECKED'=> $item['item_enabled'] ? 'checked="checked"' : '',
                'ITEM_DELETE_URL'     => cot_confirm_url(cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'delete_item','item_id'=>$item['item_id']])),
                'ITEM_EDIT_URL'       => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit_element','item'=>$item['item_id']]),
            ]);
            $t->parse('MAIN.EDIT_ITEM');
        }
    } else {
        $t->parse('MAIN.EDIT_EMPTY');
    }

    // Готовим данные для форм добавления
    $categories = [];
    if (!empty(Cot::$structure['page'])) {
        foreach (Cot::$structure['page'] as $code => $cat) {
            $categories[$code] = $cat['title'];
        }
    }

    $pages = Cot::$db->query(
        "SELECT page_id, page_title FROM " . Cot::$db->pages . " WHERE page_state = 0 ORDER BY page_title"
    )->fetchAll();

    $parentOptions = '<option value="0">' . Cot::$L['toc_page_top_level'] . '</option>';
    foreach ($allTreeItems as $item) {
        $parentOptions .= '<option value="' . $item['item_id'] . '">' . htmlspecialchars($item['item_title']) . '</option>';
    }

    $select2Active = !empty(Cot::$cfg['plugin']['toc_page']['toc_page_select2_use']);

    if ($select2Active) {
        Resources::linkFileFooter(Resources::SELECT2);
        $ajaxUrl = cot_url('plug', [
            'r'              => 'toc_page',
            'ajax'           => 'search',
            'current_page_id' => 0,
            'current_user_id' => cot::$usr['id']
        ], '', true);
        $placeholder = addslashes($L['toc_page_selectpage'] ?? 'Начните вводить название страницы...');

        $pageSelectHtml = '<div class="customrelated-row mb-3">';
        $pageSelectHtml .= '<input type="hidden" name="item_ref_page" class="toc-page-id" value="" />';
        $pageSelectHtml .= '<select class="toc-page-select" data-placeholder="' . htmlspecialchars($placeholder) . '"></select>';
        $pageSelectHtml .= '</div>';

        $pageSelectJs = <<<JS
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
        Resources::embedFooter($pageSelectJs);
    }

    $pageSelectOld = $select2Active ? '' : cot_selectbox('', 'item_ref_page', array_column($pages, 'page_id'), array_column($pages, 'page_title'), false);

    // Пагинация
    $pagenav = cot_pagenav('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId], $d, $totalItems, $perPage, 'd');
    $t->assign(cot_generatePaginationTags($pagenav));

    $t->assign([
        'TREE_ID'           => $treeId,
        'TREE_TITLE'        => htmlspecialchars($tree['tree_title']),
        'SAVE_FORM_URL'     => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'save','d'=>$durl]),
        'ADD_ITEM_FORM_URL' => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'add_item','d'=>$durl]),
        'ADD_CAT_SELECT'    => cot_selectbox('', 'item_ref_cat', array_keys($categories), array_values($categories), false),
        'ADD_PAGE_SELECT'   => $pageSelectOld,
        'ADD_PAGE_SELECT2'  => $select2Active ? $pageSelectHtml : '',
        'ADD_PARENT_SELECT' => $parentOptions,
    ]);
}

/* ========== Вкладка: Редактирование элемента ========== */
if ($tab == 'edit_element') {
    $itemId = cot_import('item', 'G', 'INT');
    if ($itemId <= 0) {
        cot_redirect(cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'trees'], '', true));
    }

    $item = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE item_id = ?",
        [$itemId]
    )->fetch();

    if (!$item) {
        cot_die_message(404);
    }

    $treeId = $item['tree_id'];
    $tree = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?", [$treeId])->fetch();

    // Сохранение изменений элемента
    if ($a == 'save_element' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $type = cot_import('item_type', 'P', 'ALP');
        $ref = '';
        if ($type == 'category') {
            $ref = cot_import('item_ref_cat', 'P', 'TXT', 255);
        } elseif ($type == 'page') {
            $ref = cot_import('item_ref_page', 'P', 'INT');
        } else {
            $ref = '';
        }
        $title = cot_import('item_title', 'P', 'TXT', 255);
        $url = cot_import('item_url', 'P', 'TXT', 255);
        $parentId = cot_import('parent_id', 'P', 'INT');
        $sort = cot_import('item_sort', 'P', 'INT');
        $enabled = cot_import('item_enabled', 'P', 'BOL') ? 1 : 0;

        Cot::$db->update(
            Cot::$db->toc_page_items,
            [
                'parent_id'   => $parentId,
                'item_sort'   => $sort,
                'item_type'   => $type,
                'item_ref'    => (string)$ref,
                'item_title'  => $title,
                'item_url'    => $url,
                'item_enabled'=> $enabled,
            ],
            'item_id = ?',
            [$itemId]
        );

        cot_message(Cot::$L['toc_page_msg_item_saved']);
        cot_redirect(cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit_element','item'=>$itemId], '', true));
    }

    // Подготовка данных для формы
    $categories = [];
    if (!empty(Cot::$structure['page'])) {
        foreach (Cot::$structure['page'] as $code => $cat) {
            $categories[$code] = $cat['title'];
        }
    }

    $pages = Cot::$db->query(
        "SELECT page_id, page_title FROM " . Cot::$db->pages . " WHERE page_state = 0 ORDER BY page_title"
    )->fetchAll();

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
    $types = ['category', 'page', 'custom'];
    foreach ($types as $tp) {
        $selected = ($item['item_type'] == $tp) ? ' selected' : '';
        $label = isset(Cot::$L['toc_page_type_' . $tp]) ? Cot::$L['toc_page_type_' . $tp] : $tp;
        $typeOptions .= '<option value="' . $tp . '"' . $selected . '>' . $label . '</option>';
    }

    $select2Active = !empty(Cot::$cfg['plugin']['toc_page']['toc_page_select2_use']);
    if ($select2Active) {
        Resources::linkFileFooter(Resources::SELECT2);
        $ajaxUrl = cot_url('plug', [
            'r'              => 'toc_page',
            'ajax'           => 'search',
            'current_page_id' => $item['item_ref'],
            'current_user_id' => cot::$usr['id']
        ], '', true);
        $placeholder = addslashes($L['toc_page_selectpage'] ?? 'Начните вводить название страницы...');

        $pageSelectHtml = '<div class="customrelated-row mb-3">';
        $pageSelectHtml .= '<input type="hidden" name="item_ref_page" class="toc-page-id" value="' . htmlspecialchars($item['item_ref']) . '" />';
        $pageSelectHtml .= '<select class="toc-page-select" data-placeholder="' . htmlspecialchars($placeholder) . '"></select>';
        $pageSelectHtml .= '</div>';

        $pageSelectJs = <<<JS
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
        Resources::embedFooter($pageSelectJs);
    }

    $pageSelectOld = $select2Active ? '' : cot_selectbox('', 'item_ref_page', array_column($pages, 'page_id'), array_column($pages, 'page_title'), $item['item_ref'], false);

    $t->assign([
        'ELEMENT_ID'          => $item['item_id'],
        'ELEMENT_TREE_ID'     => $treeId,
        'ELEMENT_TREE_TITLE'  => htmlspecialchars($tree['tree_title']),
        'ELEMENT_TYPE_SELECT' => $typeOptions,
        'ELEMENT_TITLE_VALUE' => htmlspecialchars($item['item_title']),
        'ELEMENT_URL_VALUE'   => htmlspecialchars($item['item_url']),
        'ELEMENT_CAT_SELECT'  => cot_selectbox('', 'item_ref_cat', array_keys($categories), array_values($categories), $item['item_ref'], false),
        'ELEMENT_PAGE_SELECT' => $pageSelectOld,
        'ELEMENT_PAGE_SELECT2'=> $select2Active ? $pageSelectHtml : '',
        'ELEMENT_PARENT_SELECT'=> $parentOptions,
        'ELEMENT_SORT'        => $item['item_sort'],
        'ELEMENT_ENABLED_CHECKED' => $item['item_enabled'] ? 'checked="checked"' : '',
        'ELEMENT_FORM_URL'    => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit_element','item'=>$itemId,'a'=>'save_element']),
        'ELEMENT_BACK_URL'    => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId]),
    ]);

    $t->parse('MAIN.EDIT_ELEMENT_FORM');
}

/* ========== Вкладка: Переводы (i18n) ========== */
if ($tab == 'i18n' && $treeId > 0) {
    $tree = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " WHERE tree_id = ?", [$treeId])->fetch();
    if (!$tree) {
        cot_die_message(404);
    }

    // Пагинация для всех элементов
    list($pg, $d, $durl) = cot_import_pagenav('d', $perPage);

    // Обработка сохранения переводов
    if ($a == 'save_i18n' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $items = cot_import('items', 'P', 'ARR');
        if (is_array($items)) {
            foreach ($items as $itemId => $fields) {
                $itemId = (int)$itemId;
                if ($itemId <= 0) continue;

                $exists = Cot::$db->query(
                    "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE item_id = ? AND tree_id = ?",
                    [$itemId, $treeId]
                )->fetchColumn();
                if (!$exists) continue;

                if ($i18nActive && !empty($activeLangs)) {
                    foreach ($activeLangs as $lang) {
                        if ($lang === $defaultLang) continue;
                        $titleKey = 'title_' . $lang;
                        $titleVal = isset($fields[$titleKey]) ? trim($fields[$titleKey]) : '';
                        toc_page_i18n_save($itemId, 'item_title', $lang, $titleVal);
                        $urlKey = 'url_' . $lang;
                        $urlVal = isset($fields[$urlKey]) ? trim($fields[$urlKey]) : '';
                        toc_page_i18n_save($itemId, 'item_url', $lang, $urlVal);
                    }
                }
            }
            cot_message(Cot::$L['toc_page_msg_i18n_saved']);
            cot_redirect(cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'i18n','tree'=>$treeId, 'd' => $durl], '', true));
        }
    }

    // Получаем общее число элементов и текущую страницу
    $totalItems = Cot::$db->query(
        "SELECT COUNT(*) FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ?",
        [$treeId]
    )->fetchColumn();

    $allItems = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? ORDER BY parent_id, item_sort LIMIT $d, $perPage",
        [$treeId]
    )->fetchAll();

    // Генерация заголовков языков
    if ($i18nActive && !empty($activeLangs)) {
        foreach ($activeLangs as $lang) {
            if ($lang === $defaultLang) continue;
            $t->assign('LANG_CODE', strtoupper($lang));
            $t->parse('MAIN.I18N_LANG_HEADER');
        }
    }

    // Выводим строки таблицы
    if (!empty($allItems)) {
        foreach ($allItems as $item) {
            $typeLabel = $item['item_type'];
            $refInfo = '';
            if ($item['item_type'] == 'category') {
                $catCode = $item['item_ref'];
                $refInfo = isset(Cot::$structure['page'][$catCode])
                    ? htmlspecialchars(Cot::$structure['page'][$catCode]['title'])
                    : Cot::$L['toc_page_category_not_found'];
            } elseif ($item['item_type'] == 'page') {
                $pageId = (int)$item['item_ref'];
                $page = Cot::$db->query("SELECT page_title FROM " . Cot::$db->pages . " WHERE page_id = ?", [$pageId])->fetch();
                $refInfo = $page ? htmlspecialchars($page['page_title']) : Cot::$L['toc_page_page_not_found'];
            } else {
                $refInfo = htmlspecialchars($item['item_url']);
            }

            $t->assign([
                'I18N_ITEM_ID'    => $item['item_id'],
                'I18N_ITEM_TYPE'  => $typeLabel,
                'I18N_ITEM_REF'   => $refInfo,
                'I18N_ITEM_TITLE' => htmlspecialchars($item['item_title']),
            ]);

            if ($i18nActive && !empty($activeLangs)) {
                foreach ($activeLangs as $lang) {
                    if ($lang === $defaultLang) continue;
                    $t->assign([
                        'LANG_CODE' => htmlspecialchars($lang),
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

    // Пагинация
    $pagenav = cot_pagenav('admin', ['m'=>'other','p'=>'toc_page','tab'=>'i18n','tree'=>$treeId], $d, $totalItems, $perPage, 'd');
    $t->assign(cot_generatePaginationTags($pagenav));

    $t->assign([
        'TREE_ID'           => $treeId,
        'TREE_TITLE'        => htmlspecialchars($tree['tree_title']),
        'I18N_ACTIVE'       => $i18nActive ? 1 : 0,
        'I18N_FORM_URL'     => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'i18n','tree'=>$treeId,'a'=>'save_i18n','d'=>$durl]),
    ]);
}

cot_display_messages($t);
$t->parse('MAIN');
$pluginBody = $t->text('MAIN');
