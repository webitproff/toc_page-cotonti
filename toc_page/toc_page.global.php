<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
[END_COT_EXT]
==================== */

/**
 * Filename: toc_page.global.php
 * Purpose: Table of Contents Page plugin - global initialization
 * Path: plugins/toc_page/toc_page.global.php
 *
 * Table of Contents Page plugin for Cotonti v1.+, PHP v8.5, MySQL-8.4
 *
 * Source and updates   https://github.com/webitproff/toc_page-cotonti
 *
 * Date: Nov 23, 2026
 *
 * @package toc_page
 * @version 1.4.5
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

// Функции плагина: plugins/toc_page/inc/toc_page.functions.php
// (внутри - языковой файл и регистрация таблиц БД)
require_once cot_incfile('toc_page', 'plug');

// Регистрируем CSS/JS заранее, чтобы дерево, выведенное в шапке или другом месте,
// которое разбирается после формирования <head>, тоже получило стили и скрипт.
// Повторный вызов из cot_toc_page_render() безопасен (внутри статический флаг).
if (!defined('COT_ADMIN')) {
    toc_page_register_assets();
}
