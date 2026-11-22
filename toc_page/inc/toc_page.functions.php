<?php
/**
 * Table of Contents Page plugin - helper functions
 *
 * File: toc_page.functions.php
 * Path: plugins/toc_page/inc/toc_page.functions.php
 *
 * Table of Contents Page plugin for Cotonti v1.+
 *
 * Source and updates   https://github.com/webitproff/toc_page-cotonti
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

// Регистрируем таблицы плагина в Cotonti
Cot::$db->registerTable('toc_page_trees');
Cot::$db->registerTable('toc_page_items');
Cot::$db->registerTable('toc_page_i18n');

/**
 * Проверяет, включена ли мультиязычность для плагина
 *
 * @return bool
 */
function toc_page_i18n_enabled()
{
    return !empty(Cot::$cfg['plugin']['toc_page']['toc_page_i18n_use']);
}

/**
 * Возвращает код языка по умолчанию
 *
 * @return string
 */
function toc_page_get_default_lang()
{
    return !empty(Cot::$cfg['plugin']['toc_page']['toc_page_i18n_lang_code_default'])
        ? Cot::$cfg['plugin']['toc_page']['toc_page_i18n_lang_code_default']
        : Cot::$cfg['defaultlang'];
}

/**
 * Возвращает массив активных дополнительных языков
 *
 * @return array
 */
function toc_page_get_active_langs()
{
    $defaultLang = toc_page_get_default_lang();
    $activeLangs = [];

    $pairs = [
        ['use' => 'toc_page_i18n_lang_code_first_use',  'code' => 'toc_page_i18n_lang_code_first'],
        ['use' => 'toc_page_i18n_lang_code_second_use', 'code' => 'toc_page_i18n_lang_code_second'],
    ];

    foreach ($pairs as $pair) {
        if (
            !empty(Cot::$cfg['plugin']['toc_page'][$pair['use']])
            && !empty(Cot::$cfg['plugin']['toc_page'][$pair['code']])
        ) {
            $lang = Cot::$cfg['plugin']['toc_page'][$pair['code']];
            if ($lang !== $defaultLang) {
                $activeLangs[] = $lang;
            }
        }
    }

    return $activeLangs;
}

/**
 * Загружает перевод значения поля элемента дерева для указанного языка
 *
 * @param int    $itemId    ID элемента
 * @param string $fieldName Имя поля
 * @param string $lang      Код языка
 * @return string|null
 */
function toc_page_i18n_load($itemId, $fieldName, $lang)
{
    $value = Cot::$db->query(
        "SELECT value FROM " . Cot::$db->toc_page_i18n .
        " WHERE item_id = ? AND field_name = ? AND lang = ?",
        [$itemId, $fieldName, $lang]
    )->fetchColumn();

    return ($value === false || $value === '') ? null : $value;
}

/**
 * Сохраняет или удаляет перевод значения поля элемента дерева
 *
 * @param int    $itemId    ID элемента
 * @param string $fieldName Имя поля
 * @param string $lang      Код языка
 * @param mixed  $value     Значение перевода (null или '' для удаления)
 */
function toc_page_i18n_save($itemId, $fieldName, $lang, $value)
{
    if ($value === null || $value === '') {
        Cot::$db->delete(
            Cot::$db->toc_page_i18n,
            "item_id = ? AND field_name = ? AND lang = ?",
            [$itemId, $fieldName, $lang]
        );
    } else {
        Cot::$db->query(
            "INSERT INTO " . Cot::$db->toc_page_i18n .
            " (item_id, field_name, lang, value)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE value = VALUES(value)",
            [$itemId, $fieldName, $lang, $value]
        );
    }
}

/**
 * Все переводы дерева для языка одним запросом (кэш на время запроса).
 * Формат: [item_id][field_name] => value
 *
 * @param int    $treeId ID дерева
 * @param string $lang   Код языка
 * @return array
 */
function toc_page_i18n_map($treeId, $lang)
{
    static $cache = [];
    $key = (int)$treeId . '|' . $lang;

    if (!isset($cache[$key])) {
        $cache[$key] = [];
        $rows = Cot::$db->query(
            "SELECT t.item_id, t.field_name, t.value FROM " . Cot::$db->toc_page_i18n . " AS t" .
            " INNER JOIN " . Cot::$db->toc_page_items . " AS i ON i.item_id = t.item_id" .
            " WHERE i.tree_id = ? AND t.lang = ?",
            [(int)$treeId, $lang]
        )->fetchAll();
        foreach ($rows as $row) {
            if ($row['value'] !== '' && $row['value'] !== null) {
                $cache[$key][(int)$row['item_id']][$row['field_name']] = $row['value'];
            }
        }
    }

    return $cache[$key];
}

/**
 * Возвращает значение поля элемента с учётом мультиязычного перевода.
 *
 * - Если мультиязычность выключена или текущий язык основной, возвращается оригинал.
 * - Для дополнительного языка берётся перевод, если он есть, иначе оригинал.
 *
 * @param int    $itemId        ID элемента дерева
 * @param string $fieldName     Имя поля ('item_title' или 'item_url')
 * @param mixed  $originalValue Исходное значение
 * @param int    $treeId        ID дерева (если указан, переводы берутся одним запросом)
 * @return mixed
 */
function toc_page_i18n_get_value($itemId, $fieldName, $originalValue, $treeId = 0)
{
    if (!toc_page_i18n_enabled()) {
        return $originalValue;
    }

    $defaultLang = toc_page_get_default_lang();
    $currentLang = Cot::$usr['lang'] ?? $defaultLang;

    if ($currentLang === $defaultLang) {
        return $originalValue;
    }

    if ($treeId > 0) {
        $map = toc_page_i18n_map($treeId, $currentLang);
        return $map[(int)$itemId][$fieldName] ?? $originalValue;
    }

    $translated = toc_page_i18n_load($itemId, $fieldName, $currentLang);
    return $translated !== null ? $translated : $originalValue;
}

/**
 * Получает дерево элементов в виде вложенного массива (кэш на время запроса)
 *
 * @param int $treeId ID дерева
 * @return array
 */
function toc_page_get_tree($treeId)
{
    static $cache = [];

    $treeId = (int)$treeId;
    if ($treeId <= 0) {
        return [];
    }
    if (isset($cache[$treeId])) {
        return $cache[$treeId];
    }

    $items = Cot::$db->query(
        "SELECT * FROM " . Cot::$db->toc_page_items .
        " WHERE tree_id = ? AND item_enabled = 1 ORDER BY item_sort ASC, item_id ASC",
        [$treeId]
    )->fetchAll();

    if (empty($items)) {
        return $cache[$treeId] = [];
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

    return $cache[$treeId] = $build(0);
}

/**
 * Загружает опубликованные страницы одним запросом (кэш на время запроса)
 *
 * @param array $ids ID страниц
 * @return array [page_id => row]
 */
function toc_page_get_pages(array $ids)
{
    static $cache = [];

    $need = [];
    foreach ($ids as $id) {
        $id = (int)$id;
        if ($id > 0 && !array_key_exists($id, $cache)) {
            $need[$id] = $id;
        }
    }

    if ($need) {
        $placeholders = implode(',', array_fill(0, count($need), '?'));
        $rows = Cot::$db->query(
            "SELECT page_id, page_title, page_cat, page_alias FROM " . Cot::$db->pages .
            " WHERE page_state = 0 AND page_id IN ($placeholders)",
            array_values($need)
        )->fetchAll();
        foreach ($need as $id) {
            $cache[$id] = null;
        }
        foreach ($rows as $row) {
            $cache[(int)$row['page_id']] = $row;
        }
    }

    $out = [];
    foreach ($ids as $id) {
        $id = (int)$id;
        if (!empty($cache[$id])) {
            $out[$id] = $cache[$id];
        }
    }
    return $out;
}

/**
 * Собирает ID страниц из вложенного дерева
 *
 * @param array $items
 * @return array
 */
function toc_page_collect_page_ids(array $items)
{
    $ids = [];
    foreach ($items as $item) {
        if ($item['item_type'] === 'page') {
            $ids[] = (int)$item['item_ref'];
        }
        if (!empty($item['children'])) {
            $ids = array_merge($ids, toc_page_collect_page_ids($item['children']));
        }
    }
    return $ids;
}

/**
 * Register plugin assets through Cotonti's resource manager.
 * Files are registered only when they physically exist.
 */
function toc_page_register_assets()
{
    static $registered = false;

    if ($registered) {
        return;
    }

    $pluginDir = rtrim(Cot::$cfg['plugins_dir'], '/\\') . '/toc_page';
    $pluginUrl = rtrim(Cot::$cfg['plugins_dir'], '/\\') . '/toc_page';

    // CSS
    $cssFile = $pluginDir . '/css/toc_page.css';

    if (is_file($cssFile) && is_readable($cssFile)) {
        Resources::linkFile($pluginUrl . '/css/toc_page.css');
    }

    // JavaScript
    $jsFile = $pluginDir . '/js/toc_page.js';

    if (is_file($jsFile) && is_readable($jsFile)) {
        Resources::linkFileFooter($pluginUrl . '/js/toc_page.js');
    }

    $registered = true;
}

/**
 * Рендерит оглавление по шаблону.
 *
 * Каждый вызов получает уникальный ID экземпляра, поэтому одно и то же
 * дерево (или разные деревья) можно выводить на странице сколько угодно раз.
 *
 * @param int    $treeId ID дерева
 * @param string $tpl    Имя шаблона (без .tpl)
 * @return string HTML
 */
function cot_toc_page_render($treeId = 0, $tpl = 'toc_page')
{
    static $counter = 0;
    $counter++;

    // CSS и JS через Resources
    toc_page_register_assets();

    $treeId = (int)$treeId;
    if ($treeId <= 0 && !empty(Cot::$cfg['plugin']['toc_page']['default_tree'])) {
        $treeId = (int)Cot::$cfg['plugin']['toc_page']['default_tree'];
    }

    $tree = toc_page_get_tree($treeId);
    if (empty($tree)) {
        return '';
    }

    // Прогреваем кэш страниц одним запросом
    toc_page_get_pages(toc_page_collect_page_ids($tree));

    return toc_page_display($tree, 0, $tpl, $treeId, 'tocpg-' . $treeId . '-' . $counter);
}

/**
 * Рекурсивно выводит элементы дерева
 *
 * @param array  $items    Элементы
 * @param int    $level    Уровень вложенности
 * @param string $tpl      Имя шаблона
 * @param int    $treeId   ID дерева
 * @param string $instance Уникальный ID экземпляра на странице
 * @return string HTML
 */
function toc_page_display($items, $level, $tpl, $treeId = 0, $instance = '')
{
    $t = new XTemplate(cot_tplfile($tpl, 'plug'));
    $t->assign([
        'LIST_LEVEL' => $level,
        'IS_ROOT'    => $level === 0 ? 1 : 0,
        'TREE_ID'    => (int)$treeId,
        'INSTANCE'   => $instance,
    ]);

    foreach ($items as $item) {
        $rawTitle = $item['item_title'];
        $rawUrl   = $item['item_url'];

        if (toc_page_i18n_enabled()) {
            $rawTitle = toc_page_i18n_get_value($item['item_id'], 'item_title', $rawTitle, $treeId);
            $rawUrl   = toc_page_i18n_get_value($item['item_id'], 'item_url', $rawUrl, $treeId);
        }

        $title = htmlspecialchars((string)$rawTitle);
        $url = '';

        switch ($item['item_type']) {
            case 'category':
                $catCode = $item['item_ref'];
                if (isset(Cot::$structure['page'][$catCode])) {
                    $url = !empty($rawUrl) ? htmlspecialchars($rawUrl) : cot_url('page', ['c' => $catCode]);
                    if (empty($rawTitle)) {
                        $localTitle = toc_page_i18n_cat_title($catCode);
                        $title = htmlspecialchars(!empty($localTitle) ? $localTitle : Cot::$structure['page'][$catCode]['title']);
                    }
                }
                break;

            case 'page':
                $pageId = (int)$item['item_ref'];
                if ($pageId > 0) {
                    $pages = toc_page_get_pages([$pageId]);
                    if (isset($pages[$pageId])) {
                        $page = $pages[$pageId];
                        $url = !empty($rawUrl) ? htmlspecialchars($rawUrl) : cot_page_url($page);
                        if (empty($rawTitle)) {
                            $localTitle = toc_page_i18n_page_title($pageId);
                            $title = htmlspecialchars(!empty($localTitle) ? $localTitle : $page['page_title']);
                        }
                    }
                }
                break;

            case 'custom':
            default:
                $url = htmlspecialchars((string)$rawUrl);
                if (empty($title) && !empty($url)) {
                    $title = $url;
                }
                break;
        }

        if (empty($title)) {
            continue;
        }

        $t->assign([
            'ROW_URL'          => $url,
            'ROW_TITLE'        => $title,
            'ROW_LEVEL'        => $level,
            'ROW_LVL'          => $level === 0 ? ' tocpg-l0' : '',
            'ROW_ITEMS'        => '',
            'ROW_ID'           => $item['item_id'],
            'ROW_HAS_CHILDREN' => !empty($item['children']) ? 1 : 0,
        ]);

        if (!empty($item['children'])) {
            $t->assign('ROW_ITEMS', toc_page_display($item['children'], $level + 1, $tpl, $treeId, $instance));
        }

        $t->parse('LIST.ROW');
    }

    $t->parse('LIST');
    return $t->text('LIST');
}

/**
 * Локализованное название категории (если i18n активен)
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
 * Локализованное название страницы (если i18n активен)
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
