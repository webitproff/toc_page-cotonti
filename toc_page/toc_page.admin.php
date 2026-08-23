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
 * Purpose: Предоставляет главный интерфейс администрирования плагина.
 * Path: plugins/toc_page/toc_page.admin.php
 *
 * Table of Contents Page plugin for Cotonti v1.+, PHP 8.5+, MySQL 8.4 
 *
 * Source and updates   https://github.com/webitproff/toc_page-cotonti
 * ReadMeMore:          https://abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti
 * Support:             https://abuyfile.com/ru/forums/cotonti/custom/plugs
 * Cotonti CMF:         https://github.com/Cotonti/Cotonti
 *
 * Date: Aug 23, 2026
 *
 * @package toc_page
 * @version 1.0.1
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
// Если открыта вкладка редактирования, но дерево не указано,
// перенаправляем на первое доступное дерево или на список деревьев
if ($tab == 'edit' && $treeId <= 0) {
    $firstTree = Cot::$db->query(
        "SELECT tree_id FROM " . Cot::$db->toc_page_trees . " ORDER BY tree_id ASC LIMIT 1"
    )->fetchColumn();
    if ($firstTree) {
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $firstTree], '', true));
    } else {
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }
}
$t = new XTemplate(cot_tplfile('toc_page.admin', 'plug', true));

$t->assign([
    'TAB_TREES_ACTIVE' => $tab == 'trees' ? 'active' : '',
    'TAB_EDIT_ACTIVE'  => $tab == 'edit' ? 'active' : '',
    'URL_TREES'        => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees']),
    'URL_EDIT'         => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId]),
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
        Cot::$db->delete(Cot::$db->toc_page_trees, 'tree_id = ?', [$treeId]);
        Cot::$db->delete(Cot::$db->toc_page_items, 'tree_id = ?', [$treeId]);
        cot_message(Cot::$L['toc_page_msg_tree_deleted']);
        cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees'], '', true));
    }

    $trees = Cot::$db->query("SELECT * FROM " . Cot::$db->toc_page_trees . " ORDER BY tree_id")->fetchAll();
    foreach ($trees as $tree) {
        $t->assign([
            'TREE_ID'          => $tree['tree_id'],
            'TREE_TITLE'       => htmlspecialchars($tree['tree_title']),
            'TREE_DESC'        => htmlspecialchars($tree['tree_description']),
            'TREE_EDIT_URL'    => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $tree['tree_id']]),
            'TREE_RENAME_URL'  => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'trees','a'=>'edit_tree','tree'=>$tree['tree_id']]),
            'TREE_DELETE_URL'  => cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'trees', 'a' => 'delete', 'tree' => $tree['tree_id']]),
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
                cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId], '', true));
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
                $ref = ''; // для custom используем item_url
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
            cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId], '', true));
        }

        // Удаление элемента
        if ($a == 'delete_item') {
            $itemId = cot_import('item_id', 'P', 'INT');
            if ($itemId > 0) {
                Cot::$db->delete(Cot::$db->toc_page_items, 'item_id = ? AND tree_id = ?', [$itemId, $treeId]);
                Cot::$db->delete(Cot::$db->toc_page_items, 'parent_id = ? AND tree_id = ?', [$itemId, $treeId]);
                cot_message(Cot::$L['toc_page_msg_item_deleted']);
                cot_redirect(cot_url('admin', ['m' => 'other', 'p' => 'toc_page', 'tab' => 'edit', 'tree' => $treeId], '', true));
            }
        }
    }

    // Получаем все элементы дерева
    $allItems = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items . " WHERE tree_id = ? ORDER BY parent_id, item_sort",
        [$treeId]
    )->fetchAll();

    // Группируем по родителю
    $itemsByParent = [];
    foreach ($allItems as $item) {
        $itemsByParent[$item['parent_id']][] = $item;
    }

    // Рекурсивный вывод элементов в админке
    $renderAdminItems = function($parentId, $level = 0) use (&$renderAdminItems, $itemsByParent, $t, $treeId, $allItems) {
        if (empty($itemsByParent[$parentId])) return;

        foreach ($itemsByParent[$parentId] as $item) {
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

            // Собираем список всех элементов для выпадающего списка родителя
            $parentOptions = '<option value="0"' . ($item['parent_id'] == 0 ? ' selected' : '') . '>' . Cot::$L['toc_page_top_level'] . '</option>';
            foreach ($allItems as $optItem) {
                if ($optItem['item_id'] == $item['item_id']) continue; // исключаем себя
                $selected = ($optItem['item_id'] == $item['parent_id']) ? ' selected' : '';
                $parentOptions .= '<option value="' . $optItem['item_id'] . '"' . $selected . '>' . htmlspecialchars($optItem['item_title']) . '</option>';
            }

            $t->assign([
                'ITEM_ID'             => $item['item_id'],
                'ITEM_LEVEL'          => $level,
                'ITEM_TYPE'           => $typeLabel,
                'ITEM_REF_INFO'       => $refInfo,
                'ITEM_TITLE_VALUE'    => htmlspecialchars($item['item_title']),
                'ITEM_PARENT_SELECT'  => $parentOptions,
                'ITEM_SORT'           => $item['item_sort'],
                'ITEM_ENABLED_CHECKED'=> $item['item_enabled'] ? 'checked="checked"' : '',
                'ITEM_DELETE_URL'     => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'delete_item','item_id'=>$item['item_id']]),
            ]);
            $t->parse('MAIN.EDIT_ITEM');

            $renderAdminItems($item['item_id'], $level + 1);
        }
    };

    $renderAdminItems(0);

    // Готовим данные для форм добавления
    // Все категории страниц
    $categories = [];
    if (!empty(Cot::$structure['page'])) {
        foreach (Cot::$structure['page'] as $code => $cat) {
            $categories[$code] = $cat['title'];
        }
    }

    // Все опубликованные страницы
    $pages = Cot::$db->query(
        "SELECT page_id, page_title FROM " . Cot::$db->pages . " WHERE page_state = 0 ORDER BY page_title"
    )->fetchAll();

    $parentOptions = '<option value="0">' . Cot::$L['toc_page_top_level'] . '</option>';
    foreach ($allItems as $item) {
        $parentOptions .= '<option value="' . $item['item_id'] . '">' . htmlspecialchars($item['item_title']) . '</option>';
    }

    $t->assign([
        'TREE_ID'           => $treeId,
        'TREE_TITLE'        => htmlspecialchars($tree['tree_title']),
        'SAVE_FORM_URL'     => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'save']),
		'ADD_ITEM_FORM_URL' => cot_url('admin', ['m'=>'other','p'=>'toc_page','tab'=>'edit','tree'=>$treeId,'a'=>'add_item']),
        'ADD_CAT_SELECT'    => cot_selectbox('', 'item_ref_cat', array_keys($categories), array_values($categories), false),
        'ADD_PAGE_SELECT'   => cot_selectbox('', 'item_ref_page', array_column($pages, 'page_id'), array_column($pages, 'page_title'), false),
        'ADD_PARENT_SELECT' => $parentOptions,
    ]);
}

cot_display_messages($t);
$t->parse('MAIN');
$pluginBody = $t->text('MAIN');