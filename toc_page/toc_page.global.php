<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
[END_COT_EXT]
==================== */

/**
 * Filename: toc_page.global.php
 * Purpose: Table of Contents Page plugin - global connections
 * Path: plugins/toc_page/toc_page.global.php
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

// подключаем файл функций плагина
// в нем уже файлы локализации и регистрация таблиц БД плагина
require_once cot_incfile('toc_page', 'plug');