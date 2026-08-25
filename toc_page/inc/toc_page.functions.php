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
 * Возвращает массив активных дополнительных языков
 *
 * @return array
 */
function toc_page_get_active_langs()
{
    $defaultLang = !empty(Cot::$cfg['plugin']['toc_page']['toc_page_i18n_lang_code_default'])
        ? Cot::$cfg['plugin']['toc_page']['toc_page_i18n_lang_code_default']
        : Cot::$cfg['defaultlang'];

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
 * Загружает перевод значения поля элемента дерева для указанного языка
 *
 * @param int    $itemId   ID элемента
 * @param string $fieldName Имя поля
 * @param string $lang     Двухбуквенный код языка
 * @return string|null
 */
function toc_page_i18n_load($itemId, $fieldName, $lang)
{
    return Cot::$db->query(
        "SELECT value FROM " . Cot::$db->toc_page_i18n .
        " WHERE item_id = ? AND field_name = ? AND lang = ?",
        [$itemId, $fieldName, $lang]
    )->fetchColumn() ?: null;
}

/**
 * Сохраняет или удаляет перевод значения поля элемента дерева
 *
 * @param int    $itemId   ID элемента
 * @param string $fieldName Имя поля
 * @param string $lang     Двухбуквенный код языка
 * @param mixed  $value    Значение перевода (null или '' для удаления)
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
 * Возвращает значение поля элемента с учётом мультиязычного перевода.
 *
 * Логика работы:
 *   - Если мультиязычность выключена, сразу возвращается оригинальное значение.
 *   - Определяется основной язык сайта из настроек плагина.
 *   - Определяется текущий язык посетителя.
 *   - Если текущий язык совпадает с основным, всегда возвращается оригинал,
 *     даже если он пустой. Переводы для основного языка не используются.
 *   - Если текущий язык отличается от основного, предпринимается попытка
 *     загрузить перевод из таблицы `cot_toc_page_i18n`. Если перевод найден,
 *     возвращается он, иначе возвращается оригинальное значение.
 *
 * @param int    $itemId        ID элемента дерева
 * @param string $fieldName     Имя переводимого поля (например, 'item_title' или 'item_url')
 * @param mixed  $originalValue Исходное значение из основной таблицы
 * @return mixed Значение на нужном языке или оригинал, если перевода нет
 */
function toc_page_i18n_get_value($itemId, $fieldName, $originalValue)
{
    // Выходим сразу, если мультиязычность отключена
    if (!toc_page_i18n_enabled()) {
        return $originalValue;
    }

    // Определяем основной язык (для него переводы не хранятся)
    $defaultLang = toc_page_get_default_lang();

    // Язык текущего посетителя
    $currentLang = Cot::$usr['lang'] ?? $defaultLang;

    // Если текущий язык основной — всегда возвращаем оригинал,
    // даже если он пустой. Это гарантирует, что на основном языке
    // не будут подставляться переводы с других языков.
    if ($currentLang === $defaultLang) {
        return $originalValue;
    }

    // Для дополнительного языка пытаемся найти перевод.
    // Если перевода нет, возвращаем оригинал.
    $translated = toc_page_i18n_load($itemId, $fieldName, $currentLang);

    return $translated !== null ? $translated : $originalValue;
}


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
	$t->assign('IS_ROOT', $level === 0 ? 1 : 0);

    foreach ($items as $item) {
        // Применяем i18n к заголовку и URL
        $rawTitle = $item['item_title'];
        $rawUrl   = $item['item_url'];

        if (toc_page_i18n_enabled()) {
            $rawTitle = toc_page_i18n_get_value($item['item_id'], 'item_title', $rawTitle);
            $rawUrl   = toc_page_i18n_get_value($item['item_id'], 'item_url', $rawUrl);
        }

        $title = htmlspecialchars($rawTitle);
        $url = '';

        switch ($item['item_type']) {
            case 'category':
                $catCode = $item['item_ref'];
                if (isset(Cot::$structure['page'][$catCode])) {
                    // Если есть переведённый URL, используем его, иначе генерируем стандартный
                    $url = !empty($rawUrl) ? htmlspecialchars($rawUrl) : cot_url('page', ['c' => $catCode]);
                    // Локализованное название категории
                    $localTitle = toc_page_i18n_cat_title($catCode);
                    if (empty($rawTitle)) {
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
                        // Если есть переведённый URL, используем его, иначе генерируем стандартный
                        $url = !empty($rawUrl) ? htmlspecialchars($rawUrl) : cot_page_url($page);
                        $localTitle = toc_page_i18n_page_title($pageId);
                        if (empty($rawTitle)) {
                            $title = !empty($localTitle) ? htmlspecialchars($localTitle) : htmlspecialchars($page['page_title']);
                        }
                    }
                }
                break;

            case 'custom':
            default:
                $url = htmlspecialchars($rawUrl);
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
			'ROW_ITEMS'        => '',
			'ROW_ID'           => $item['item_id'],
			'ROW_HAS_CHILDREN' => !empty($item['children']) ? 1 : 0,
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
