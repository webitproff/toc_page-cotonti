<?php
/* ====================
[BEGIN_COT_EXT]
Code=toc_page
Name=Table of Contents Page
Description=Управляемое оглавление для страниц с ручной сортировкой, иерархией и поддержкой мультиязычности
Category=administration-management
Version=1.0.1
Date=2026-08-23
Author=webitproff
Copyright=(c) webitproff 2026 https://github.com/webitproff
Notes=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
Requires_modules=page
Recommends_plugins=i18n
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
default_tree=01:string::0:ID дерева по умолчанию
[END_COT_EXT_CONFIG]
==================== */

/**
 * Filename: toc_page.setup.php 
 * Purpose: Register data in $db_core, $db_plugins and $db_config. Setup & Config File for the Table of Contents Page plugin
 * Path: plugins/toc_page/toc_page.setup.php
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
