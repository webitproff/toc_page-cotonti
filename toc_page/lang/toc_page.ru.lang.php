<?php
/**
 * Russian Language File for Table of Contents Page Plugin with i18n support
 *
 * Filename: toc_page.ru.lang.php
 *
 * Path:    plugins/toc_page/lang/toc_page.ru.lang.php
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
$L['info_desc'] = 'Управляемое оглавление для страниц с ручной сортировкой, иерархией и поддержкой мультиязычности.';
$L['info_notes'] = '';

$L['toc_page_title'] = $L['info_name'];
$L['toc_page_desc']  = $L['info_desc'];
$L['toc_page_name']  = $L['info_name'];

// ========================
// НАСТРОЙКИ ПЛАГИНА (АДМИНКА)
// ========================
$L['cfg_default_tree'] = 'ID дерева по умолчанию';
$L['cfg_default_tree_hint'] = 'Используется, если функция вызова дерева вызывается без явного указания ID.';

$L['cfg_toc_page_i18n_use'] = 'Мультиязычность активировать и использовать';
$L['cfg_toc_page_i18n_use_hint'] = 'Включает поддержку переводов заголовков и URL элементов дерева. При отключении переводы сохраняются, но не отображаются на сайте.';

$L['cfg_toc_page_i18n_lang_code_default'] = 'Код основного языка сайта';
$L['cfg_toc_page_i18n_lang_code_default_hint'] = 'Должен совпадать с глобальной настройкой <code>$cfg[\'defaultlang\']</code>. Значения этого языка хранятся в основной таблице и считаются оригиналом.';

$L['cfg_toc_page_i18n_lang_code_first'] = 'Код первого дополнительного языка';
$L['cfg_toc_page_i18n_lang_code_first_use'] = 'Использовать первый дополнительный язык';
$L['cfg_toc_page_i18n_lang_code_first_use_hint'] = 'Если активно, в форме переводов появятся поля для ввода перевода на этот язык.';

$L['cfg_toc_page_i18n_lang_code_second'] = 'Код второго дополнительного языка';
$L['cfg_toc_page_i18n_lang_code_second_use'] = 'Использовать второй дополнительный язык';
$L['cfg_toc_page_i18n_lang_code_second_use_hint'] = 'Если активно, в форме переводов появятся поля для ввода перевода на этот язык.';
$L['cfg_toc_page_select2_use'] = 'Использовать поиск статей через Select2';
$L['cfg_toc_page_select2_use_hint'] = 'Включает AJAX-поиск страниц в форме добавления элемента оглавления вместо обычного выпадающего списка.';

// ========================
// ИНТЕРФЕЙС: ВКЛАДКИ
// ========================
$L['toc_page_tab_trees'] = 'Деревья';
$L['toc_page_tab_edit'] = 'Редактирование дерева';
$L['toc_page_tab_i18n'] = 'Переводы';

// ========================
// ВКЛАДКА «ДЕРЕВЬЯ»
// ========================
$L['toc_page_trees_list'] = 'Список деревьев';
$L['toc_page_add_tree'] = 'Добавить дерево';
$L['toc_page_add_tree_btn'] = 'Создать';
$L['toc_page_tree_title'] = 'Название дерева';
$L['toc_page_tree_desc'] = 'Описание';
$L['toc_page_tree_codepaste'] = 'Код для вставки';
$L['toc_page_copy'] = 'Копировать';
$L['toc_page_copy_success'] = 'Скопировано!';
$L['toc_page_actions'] = 'Действия';
$L['toc_page_confirm_delete'] = 'Вы уверены?';
$L['toc_page_tree_items'] = 'Элементы';
$L['toc_page_edit_tree_meta'] = 'Изменить';
$L['toc_page_edit_tree'] = 'Редактирование дерева';

// ========================
// ВКЛАДКА «РЕДАКТИРОВАНИЕ ДЕРЕВА»
// ========================
$L['toc_page_items_list'] = 'Элементы';
$L['toc_page_item_type'] = 'Тип';
$L['toc_page_item_ref'] = 'Ссылка на объект';
$L['toc_page_item_title'] = 'Заголовок';
$L['toc_page_item_parent'] = 'Родитель';
$L['toc_page_item_sort'] = 'Порядок';
$L['toc_page_item_enabled'] = 'Включено';
$L['toc_page_item_actions'] = 'Действия';
$L['toc_page_save_changes'] = 'Сохранить изменения';
$L['toc_page_add_item'] = 'Добавить элемент';
$L['toc_page_add_item_btn'] = 'Добавить';
$L['toc_page_selectpage'] = 'Начните вводить название страницы...';

$L['toc_page_type_category'] = 'Категория';
$L['toc_page_type_page'] = 'Страница';
$L['toc_page_type_custom'] = 'Произвольная ссылка';
$L['toc_page_category'] = 'Категория';
$L['toc_page_page'] = 'Страница';
$L['toc_page_url'] = 'URL';
$L['toc_page_top_level'] = 'Верхний уровень';

$L['toc_page_tab_element'] = 'Элемент';
$L['toc_page_edit_element'] = 'Редактирование элемента';
$L['toc_page_back'] = 'Назад';
$L['toc_page_edit'] = 'Редактировать';
$L['toc_page_msg_item_saved'] = 'Элемент сохранён';

// ========================
// ВКЛАДКА «ПЕРЕВОДЫ»
// ========================
$L['toc_page_i18n_lang_header'] = 'Язык'; // не используется, если заголовки генерируются динамически
$L['toc_page_no_items'] = 'Нет элементов для перевода';

// ========================
// СИСТЕМНЫЕ СООБЩЕНИЯ
// ========================
$L['toc_page_msg_tree_created'] = 'Дерево создано';
$L['toc_page_msg_tree_deleted'] = 'Дерево удалено';
$L['toc_page_msg_items_saved'] = 'Изменения сохранены';
$L['toc_page_msg_item_added'] = 'Элемент добавлен';
$L['toc_page_msg_item_deleted'] = 'Элемент удалён';
$L['toc_page_msg_tree_updated'] = 'Дерево обновлено';
$L['toc_page_msg_i18n_saved'] = 'Переводы сохранены';

// ========================
// ПРОЧИЕ СТРОКИ
// ========================
$L['toc_page_category_not_found'] = 'Категория не найдена';
$L['toc_page_page_not_found'] = 'Страница не найдена';

// ========================
// ПОДСКАЗКИ ДЛЯ НАСТРОЕК (если нужны отдельно)
// ========================
// уже определены выше
