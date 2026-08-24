<?php
/**
 * English Language File for Table of Contents Page Plugin with i18n support
 *
 * Filename: toc_page.en.lang.php
 *
 * Path:    plugins/toc_page/lang/toc_page.en.lang.php
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

defined('COT_CODE') or die('Wrong URL.');

// ========================
// MAIN Plugin Info
// ========================
$L['info_name'] = 'Table of Contents Page';
$L['info_desc'] = 'Managed table of contents for pages with manual sorting, hierarchy and multilingual support.';
$L['info_notes'] = '';

$L['toc_page_title'] = $L['info_name'];
$L['toc_page_desc']  = $L['info_desc'];
$L['toc_page_name']  = $L['info_name'];

// ========================
// PLUGIN SETTINGS (ADMIN)
// ========================
$L['cfg_default_tree'] = 'Default tree ID';
$L['cfg_default_tree_hint'] = 'Used when the tree render function is called without an explicit ID.';

$L['cfg_toc_page_i18n_use'] = 'Activate and use multilingual support';
$L['cfg_toc_page_i18n_use_hint'] = 'Enables translation support for tree item titles and URLs. When disabled, translations are kept but not displayed on the site.';

$L['cfg_toc_page_i18n_lang_code_default'] = 'Main site language code';
$L['cfg_toc_page_i18n_lang_code_default_hint'] = 'Must match the global setting <code>$cfg[\'defaultlang\']</code>. Values of this language are stored in the main table and considered original.';

$L['cfg_toc_page_i18n_lang_code_first'] = 'First additional language code';
$L['cfg_toc_page_i18n_lang_code_first_use'] = 'Use first additional language';
$L['cfg_toc_page_i18n_lang_code_first_use_hint'] = 'If active, fields for translating into this language will appear in the translation form.';

$L['cfg_toc_page_i18n_lang_code_second'] = 'Second additional language code';
$L['cfg_toc_page_i18n_lang_code_second_use'] = 'Use second additional language';
$L['cfg_toc_page_i18n_lang_code_second_use_hint'] = 'If active, fields for translating into this language will appear in the translation form.';

$L['cfg_toc_page_select2_use'] = 'Use Select2 page search';
$L['cfg_toc_page_select2_use_hint'] = 'Enables AJAX page search in the add TOC item form instead of a regular dropdown.';

// ========================
// INTERFACE: TABS
// ========================
$L['toc_page_tab_trees'] = 'Trees';
$L['toc_page_tab_edit'] = 'Edit Tree';
$L['toc_page_tab_i18n'] = 'Translations';

// ========================
// TAB: TREES
// ========================
$L['toc_page_trees_list'] = 'Tree List';
$L['toc_page_add_tree'] = 'Add Tree';
$L['toc_page_add_tree_btn'] = 'Create';
$L['toc_page_tree_title'] = 'Tree Title';
$L['toc_page_tree_desc'] = 'Description';
$L['toc_page_tree_codepaste'] = 'Paste Code';
$L['toc_page_copy'] = 'Copy';
$L['toc_page_copy_success'] = 'Copied!';
$L['toc_page_actions'] = 'Actions';
$L['toc_page_confirm_delete'] = 'Are you sure?';
$L['toc_page_tree_items'] = 'Items';
$L['toc_page_edit_tree_meta'] = 'Edit';
$L['toc_page_edit_tree'] = 'Edit Tree';

// ========================
// TAB: EDIT TREE
// ========================
$L['toc_page_items_list'] = 'Items';
$L['toc_page_item_type'] = 'Type';
$L['toc_page_item_ref'] = 'Object Link';
$L['toc_page_item_title'] = 'Title';
$L['toc_page_item_parent'] = 'Parent';
$L['toc_page_item_sort'] = 'Order';
$L['toc_page_item_enabled'] = 'Enabled';
$L['toc_page_item_actions'] = 'Actions';
$L['toc_page_save_changes'] = 'Save Changes';
$L['toc_page_add_item'] = 'Add Item';
$L['toc_page_add_item_btn'] = 'Add';
$L['toc_page_selectpage'] = 'Start typing page title...';

$L['toc_page_type_category'] = 'Category';
$L['toc_page_type_page'] = 'Page';
$L['toc_page_type_custom'] = 'Custom Link';
$L['toc_page_category'] = 'Category';
$L['toc_page_page'] = 'Page';
$L['toc_page_url'] = 'URL';
$L['toc_page_top_level'] = 'Top Level';

$L['toc_page_tab_element'] = 'Element';
$L['toc_page_edit_element'] = 'Edit Element';
$L['toc_page_back'] = 'Back';
$L['toc_page_edit'] = 'Edit';
$L['toc_page_msg_item_saved'] = 'Item saved';

// ========================
// TAB: TRANSLATIONS
// ========================
$L['toc_page_i18n_lang_header'] = 'Language';
$L['toc_page_no_items'] = 'No items to translate';

// ========================
// SYSTEM MESSAGES
// ========================
$L['toc_page_msg_tree_created'] = 'Tree created';
$L['toc_page_msg_tree_deleted'] = 'Tree deleted';
$L['toc_page_msg_items_saved'] = 'Changes saved';
$L['toc_page_msg_item_added'] = 'Item added';
$L['toc_page_msg_item_deleted'] = 'Item deleted';
$L['toc_page_msg_tree_updated'] = 'Tree updated';
$L['toc_page_msg_i18n_saved'] = 'Translations saved';

// ========================
// OTHER STRINGS
// ========================
$L['toc_page_category_not_found'] = 'Category not found';
$L['toc_page_page_not_found'] = 'Page not found';

// ========================
// SETTINGS HINTS (if needed separately)
// ========================
// already defined above
