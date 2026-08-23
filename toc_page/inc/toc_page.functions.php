<?php
/**
 * Table of Contents Page plugin - helper functions
 *
 * File: toc_page.functions.php
 *
 * Path: plugins/toc_page/toc_page.functions.php
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


// Регистрируем таблицы плагина в Cotonti
Cot::$db->registerTable('toc_page_trees');
Cot::$db->registerTable('toc_page_items');


/**
 * Получает дерево элементов для указанного дерева в виде вложенного массива
 *
 * @param int $treeId ID дерева
 * @return array Вложенный массив элементов
 */
function toc_page_get_tree($treeId)
{
    $treeId = (int)$treeId;
    if ($treeId <= 0) {
        return [];
    }

    $items = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items .
        " WHERE tree_id = ? AND item_enabled = 1 ORDER BY item_sort ASC",
        [$treeId]
    )->fetchAll();

    if (empty($items)) {
        return [];
    }

    $byParent = [];
    foreach ($items as $item) {
        $byParent[$item['parent_id']][] = $item;
    }

    $build = function ($parentId) use (&$build, $byParent) {
        $result = [];
        if (!empty($byParent[$parentId])) {
            foreach ($byParent[$parentId] as $item) {
                $item['children'] = $build($item['item_id']);
                $result[] = $item;
            }
        }
        return $result;
    };

    return $build(0);
}

/**
 * Рендерит оглавление по шаблону
 *
 * @param int $treeId ID дерева
 * @param string $tpl Имя шаблона (без .tpl)
 * @return string HTML
 */
function cot_toc_page_render($treeId, $tpl = 'toc_page')
{
    $tree = toc_page_get_tree($treeId);
    return toc_page_display($tree, 0, $tpl);
}

/**
 * Рекурсивно выводит элементы дерева
 *
 * @param array $items Элементы
 * @param int $level Уровень вложенности
 * @param string $tpl Имя шаблона
 * @return string HTML
 */
function toc_page_display($items, $level, $tpl)
{
    $t = new XTemplate(cot_tplfile($tpl, 'plug'));
    $t->assign('LIST_LEVEL', $level);

    foreach ($items as $item) {
        $url = '';
        $title = htmlspecialchars($item['item_title']);

        switch ($item['item_type']) {
            case 'category':
                $catCode = $item['item_ref'];
                if (isset(Cot::$structure['page'][$catCode])) {
                    $url = cot_url('page', ['c' => $catCode]);
                    // Локализованное название категории
                    $localTitle = toc_page_i18n_cat_title($catCode);
                    if (empty($item['item_title'])) {
                        $title = !empty($localTitle) ? htmlspecialchars($localTitle) : htmlspecialchars(Cot::$structure['page'][$catCode]['title']);
                    }
                }
                break;

            case 'page':
                $pageId = (int)$item['item_ref'];
                if ($pageId > 0) {
                    $page = Cot::$db->query(
                        "SELECT page_id, page_title, page_cat, page_alias FROM " . Cot::$db->pages .
                        " WHERE page_id = ? AND page_state = 0",
                        [$pageId]
                    )->fetch();
                    if ($page) {
                        $url = cot_page_url($page);
                        $localTitle = toc_page_i18n_page_title($pageId);
                        if (empty($item['item_title'])) {
                            $title = !empty($localTitle) ? htmlspecialchars($localTitle) : htmlspecialchars($page['page_title']);
                        }
                    }
                }
                break;

            case 'custom':
            default:
                $url = htmlspecialchars($item['item_url']);
                if (empty($title) && !empty($url)) {
                    $title = $url;
                }
                break;
        }

		if (empty($title)) {
			continue;
		}

        $t->assign([
            'ROW_URL'   => $url,
            'ROW_TITLE' => $title,
            'ROW_LEVEL' => $level,
            'ROW_ITEMS' => '',
        ]);

        if (!empty($item['children'])) {
            $sub = toc_page_display($item['children'], $level + 1, $tpl);
            $t->assign('ROW_ITEMS', $sub);
        }

        $t->parse('LIST.ROW');
    }

    $t->parse('LIST');
    return $t->text('LIST');
}

/**
 * Получает локализованное название категории (если i18n активен)
 *
 * @param string $catCode Код категории
 * @return string|null
 */
function toc_page_i18n_cat_title($catCode)
{
    global $i18n_structure, $i18n_locale, $i18n_read;
    if (cot_plugin_active('i18n') && $i18n_read && $i18n_locale && isset($i18n_structure[$catCode][$i18n_locale]['title'])) {
        return $i18n_structure[$catCode][$i18n_locale]['title'];
    }
    return null;
}

/**
 * Получает локализованное название страницы (если i18n активен)
 *
 * @param int $pageId ID страницы
 * @return string|null
 */
function toc_page_i18n_page_title($pageId)
{
    global $db_i18n_pages, $i18n_locale, $i18n_read;
    if (cot_plugin_active('i18n') && $i18n_read && $i18n_locale) {
        $row = Cot::$db->query(
            "SELECT ipage_title FROM " . $db_i18n_pages .
            " WHERE ipage_id = ? AND ipage_locale = ?",
            [(int)$pageId, $i18n_locale]
        )->fetch();
        if ($row && !empty($row['ipage_title'])) {
            return $row['ipage_title'];
        }
    }
    return null;
}