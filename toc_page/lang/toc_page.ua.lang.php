<?php
/**
 * Ukrainian Language File for Table of Contents Page Plugin with i18n support
 *
 * Filename: toc_page.ua.lang.php
 *
 * Path:    plugins/toc_page/lang/toc_page.ua.lang.php
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
$L['info_desc'] = 'Кероване оглавлення для сторінок з ручним сортуванням, ієрархією та підтримкою мультимовності.';
$L['info_notes'] = '';

$L['toc_page_title'] = $L['info_name'];
$L['toc_page_desc']  = $L['info_desc'];
$L['toc_page_name']  = $L['info_name'];

// ========================
// НАЛАШТУВАННЯ ПЛАГІНА (АДМІНКА)
// ========================
$L['cfg_default_tree'] = 'ID дерева за замовчуванням';
$L['cfg_default_tree_hint'] = 'Використовується, якщо функція виклику дерева викликається без явного вказівника ID.';

$L['cfg_toc_page_i18n_use'] = 'Мультимовність активувати і використовувати';
$L['cfg_toc_page_i18n_use_hint'] = 'Вмикає підтримку перекладів заголовків та URL елементів дерева. При вимкненні переклади зберігаються, але не відображаються на сайті.';

$L['cfg_toc_page_i18n_lang_code_default'] = 'Код основної мови сайту';
$L['cfg_toc_page_i18n_lang_code_default_hint'] = 'Повинен збігатися з глобальним налаштуванням <code>$cfg[\'defaultlang\']</code>. Значення цієї мови зберігаються в основній таблиці і вважаються оригіналом.';

$L['cfg_toc_page_i18n_lang_code_first'] = 'Код першої додаткової мови';
$L['cfg_toc_page_i18n_lang_code_first_use'] = 'Використовувати першу додаткову мову';
$L['cfg_toc_page_i18n_lang_code_first_use_hint'] = 'Якщо активно, у формі перекладів з\'являться поля для введення перекладу цією мовою.';

$L['cfg_toc_page_i18n_lang_code_second'] = 'Код другої додаткової мови';
$L['cfg_toc_page_i18n_lang_code_second_use'] = 'Використовувати другу додаткову мову';
$L['cfg_toc_page_i18n_lang_code_second_use_hint'] = 'Якщо активно, у формі перекладів з\'являться поля для введення перекладу цією мовою.';

$L['cfg_toc_page_select2_use'] = 'Використовувати пошук статей через Select2';
$L['cfg_toc_page_select2_use_hint'] = 'Вмикає AJAX-пошук сторінок у формі додавання елемента оглавлення замість звичайного випадаючого списку.';

// ========================
// ІНТЕРФЕЙС: ВКЛАДКИ
// ========================
$L['toc_page_tab_trees'] = 'Дерева';
$L['toc_page_tab_edit'] = 'Редагування дерева';
$L['toc_page_tab_i18n'] = 'Переклади';

// ========================
// ВКЛАДКА «ДЕРЕВА»
// ========================
$L['toc_page_trees_list'] = 'Список дерев';
$L['toc_page_add_tree'] = 'Додати дерево';
$L['toc_page_add_tree_btn'] = 'Створити';
$L['toc_page_tree_title'] = 'Назва дерева';
$L['toc_page_tree_desc'] = 'Опис';
$L['toc_page_tree_codepaste'] = 'Код для вставки';
$L['toc_page_copy'] = 'Копіювати';
$L['toc_page_copy_success'] = 'Скопійовано!';
$L['toc_page_actions'] = 'Дії';
$L['toc_page_confirm_delete'] = 'Ви впевнені?';
$L['toc_page_tree_items'] = 'Елементи';
$L['toc_page_edit_tree_meta'] = 'Змінити';
$L['toc_page_edit_tree'] = 'Редагування дерева';

// ========================
// ВКЛАДКА «РЕДАГУВАННЯ ДЕРЕВА»
// ========================
$L['toc_page_items_list'] = 'Елементи';
$L['toc_page_item_type'] = 'Тип';
$L['toc_page_item_ref'] = 'Посилання на об\'єкт';
$L['toc_page_item_title'] = 'Заголовок';
$L['toc_page_item_parent'] = 'Батьківський';
$L['toc_page_item_sort'] = 'Порядок';
$L['toc_page_item_enabled'] = 'Увімкнено';
$L['toc_page_item_actions'] = 'Дії';
$L['toc_page_save_changes'] = 'Зберегти зміни';
$L['toc_page_add_item'] = 'Додати елемент';
$L['toc_page_add_item_btn'] = 'Додати';
$L['toc_page_selectpage'] = 'Почніть вводити назву сторінки...';

$L['toc_page_type_category'] = 'Категорія';
$L['toc_page_type_page'] = 'Сторінка';
$L['toc_page_type_custom'] = 'Довільне посилання';
$L['toc_page_category'] = 'Категорія';
$L['toc_page_page'] = 'Сторінка';
$L['toc_page_url'] = 'URL';
$L['toc_page_top_level'] = 'Верхній рівень';

$L['toc_page_tab_element'] = 'Елемент';
$L['toc_page_edit_element'] = 'Редагування елемента';
$L['toc_page_back'] = 'Назад';
$L['toc_page_edit'] = 'Редагувати';
$L['toc_page_msg_item_saved'] = 'Елемент збережено';

// ========================
// ВКЛАДКА «ПЕРЕКЛАДИ»
// ========================
$L['toc_page_i18n_lang_header'] = 'Мова';
$L['toc_page_no_items'] = 'Немає елементів для перекладу';

// ========================
// СИСТЕМНІ ПОВІДОМЛЕННЯ
// ========================
$L['toc_page_msg_tree_created'] = 'Дерево створено';
$L['toc_page_msg_tree_deleted'] = 'Дерево видалено';
$L['toc_page_msg_items_saved'] = 'Зміни збережено';
$L['toc_page_msg_item_added'] = 'Елемент додано';
$L['toc_page_msg_item_deleted'] = 'Елемент видалено';
$L['toc_page_msg_tree_updated'] = 'Дерево оновлено';
$L['toc_page_msg_i18n_saved'] = 'Переклади збережено';

// ========================
// ІНШІ РЯДКИ
// ========================
$L['toc_page_category_not_found'] = 'Категорію не знайдено';
$L['toc_page_page_not_found'] = 'Сторінку не знайдено';

// ========================
// ПІДКАЗКИ ДЛЯ НАЛАШТУВАНЬ (якщо потрібні окремо)
// ========================
// вже визначені вище