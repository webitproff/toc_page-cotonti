
# Table of Contents Plugin for Cotonti

**Plugin code:** toc_page  
**Version:** 1.1.4  
**Date:** 24-08-2026  
**Author:** webitproff   
**License:** BSD   
**Source code:** [github.com/webitproff/toc_page-cotonti](https://github.com/webitproff/toc_page-cotonti)

The **toc_page** plugin is designed for creating and managing custom table-of-contents trees on a Cotonti website. It allows administrators to manually build documentation structures, knowledge bases, or navigation menus by combining categories, pages, and external links.

**[Overview and purpose of the plugin Table of Contents Page](https://abuyfile.com/en/usersblog/review-toc-page-cotonti)**

[![Version](https://img.shields.io/badge/version-1.1.4-green.svg)](https://github.com/webitproff/toc_page-cotonti/releases)
[![Cotonti Compatibility](https://img.shields.io/badge/Cotonti-1.0-orange.svg)](https://github.com/Cotonti/Cotonti)
[![PHP](https://img.shields.io/badge/PHP-8.5-purple.svg)](https://www.php.net/releases/8_5_0.php)
[![MySQL](https://img.shields.io/badge/MySQL-8.4-blue.svg)](https://www.mysql.com/)
[![Bootstrap v5.3.8](https://img.shields.io/badge/Bootstrap-v5.3.8-blueviolet.svg)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/license-BSD-blue.svg)](https://github.com/webitproff/toc_page-cotonti/blob/main/LICENSE)

<img width="1536" height="1024" alt="Table of Contents Page plugin for Cotonti v1 +, PHP 8 5+, MySQL 8 4" src="https://github.com/user-attachments/assets/3a135a65-7271-470c-932f-b1f32a6064fb" />

<img width="1906" height="953" alt="toc_page-cotonti_by_webitproff_2026" src="https://github.com/user-attachments/assets/1e4150df-f3f5-46c5-a81f-45f851b4cde5" />

___
## Press Release

**Table of Contents Page (toc_page) for Cotonti — Version 1.1.4 Release**

*August 24, 2026*

---

The development team of the **Table of Contents Page (toc_page)** plugin is pleased to announce the release of version **1.1.4**. This is a significant update aimed at improving administration convenience, performance with large data volumes, and expanding multilingual capabilities.

The **toc_page** plugin is designed to create a manageable table of contents on Cotonti pages. It allows building hierarchical trees of items (categories, pages, custom links), manually sorting them, controlling visibility, and adding translations for titles and URLs.

Version **1.1.4** focuses on fixing shortcomings of previous releases and introducing new features that make working with the plugin even more intuitive and efficient.

---

## Key Changes in Version 1.1.4

### 1. Pagination for tree items and translations

One of the main improvements is the introduction of page-by-page navigation (pagination) in the **“Edit Tree”** and **“Translations”** administrative tabs.

Previously, with a large number of items (e.g., more than 500), they were all displayed on a single page, leading to slow loading and inconvenience. Now items and translations are split into pages (20 by default, configurable in the plugin settings).

- In the **“Edit Tree”** tab, a flat list with pagination is displayed, preserving the usual sorting order.
- In the **“Translations”** tab, pagination works similarly, allowing quick access to the desired items for translation.
- All actions (save, add, delete) correctly keep the current page or reset it when necessary.

Thanks to this, administrators can easily manage trees with hundreds and thousands of items without performance loss.

### 2. Editing item type after creation

A major drawback has been fixed: previously, after creating an item, it was impossible to change its type. If an item was created as a “Custom Link” (custom), it could not be turned into a “Page” or “Category”.

Version **1.1.4** adds a **separate “Element” tab** (`edit_element`) that opens a full editing form:

- Change the item type (category, page, custom link).
- Configure the associated link (select category, page via AJAX Select2 search, or enter URL).
- Edit the title, parent item, sorting order.
- Enable/disable the item.

An **“Edit”** button has been added to the tree item list. After saving changes, the administrator stays on the editing page rather than being redirected back to the tree, allowing immediate verification of the entered data.

### 3. Fixed parent item dropdown lists

An error introduced after pagination was fixed: in the dropdown lists for selecting a parent item (both in the item table and in the add form), only items from the current page were shown instead of all tree items.

Now parent lists always contain **all tree items**, regardless of the selected page. This eliminates the inability to assign a parent located on another pagination page.

### 4. User experience improvements

- After saving an item, the edit page refreshes and the administrator remains on it, seeing the current data.
- Minor fixes and code optimization for stable operation on PHP 8.5+ and MySQL 8.4.

### 5. Expanded language support

Added **official language packs**:

- English (`toc_page.en.lang.php`)
- Ukrainian (`toc_page.uk.lang.php`)

The Russian language pack has been updated and supplemented with new strings.

---

## Compatibility

The **toc_page 1.1.4** plugin is developed for **Cotonti v1.+** and tested on **PHP 8.5+** and **MySQL 8.4**. It is fully backward compatible with previous versions — data is preserved without changes, and no additional migration is required.

---

## Developer Quote

> “We aimed to make managing tables of contents as convenient as possible even with very large trees. Pagination and the ability to edit item type are exactly the features our users were missing. Now the plugin is truly ready for use on large projects.”  
> — **webitproff**, plugin author

---

## Useful Links

- **Source code and updates:** [github.com/webitproff/toc_page-cotonti](https://github.com/webitproff/toc_page-cotonti)
- **Detailed documentation:** [abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti](https://abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti)
- **Support and forum:** [abuyfile.com/ru/forums/cotonti/custom/plugs](https://abuyfile.com/ru/forums/cotonti/custom/plugs)
- **Cotonti CMF:** [github.com/Cotonti/Cotonti](https://github.com/Cotonti/Cotonti)

---

## About the Plugin

**Table of Contents Page (toc_page)** is a flexible tool for creating hierarchical tables of contents on Cotonti pages. It allows:

- Creating unlimited numbers of TOC trees.
- Adding items of three types: categories, pages, and custom links.
- Manually sorting items and defining hierarchy.
- Managing item visibility.
- Translating titles and URLs into multiple languages.

Distributed under the **BSD** license.

---

**Press contacts:**  
Author: **[webitproff](https://abuyfile.com/ru/users/webitproff)**  

Website: **[abuyfile.com](https://abuyfile.com/en/market/cotonti/toc-page-cotonti)**
___

---

## Table of Contents

### Technical Documentation

- [Overview](#overview-en)
- [Requirements](#requirements-en)
- [Installation and Uninstallation](#installation-and-uninstallation-en)
- [File Structure](#file-structure-en)
- [Database](#database-en)
- [Plugin Functions](#plugin-functions-en)
- [Administrative Interface](#administrative-interface-en)
- [Templates](#templates-en)
- [Localization](#localization-en)
- [Settings](#settings-en)
- [Usage Examples](#usage-examples-en)
- [Notes](#notes-en)

### User Guide

- [Right After Installation](#right-after-installation-en)
- [First Look at the Plugin Page](#first-look-at-the-plugin-page-en)
- [Getting to Know the Tabs](#getting-to-know-the-tabs-en)
- [Creating Your First Tree](#creating-your-first-tree-en)
- [What a Tree Is and Why You Need It](#what-a-tree-is-and-why-you-need-it-en)
- [Opening a Tree for Filling](#opening-a-tree-for-filling-en)
- [Add Element Form](#add-element-form-en)
- [Adding a Category Element](#adding-a-category-element-en)
- [Adding a Page Element](#adding-a-page-element-en)
- [Adding a Custom Link Element](#adding-a-custom-link-element-en)
- [Managing Elements After Adding](#managing-elements-after-adding-en)
- [Saving Changes](#saving-changes-en)
- [Conclusion](#conclusion-en)

---

## Technical Documentation

### Overview

The **toc_page** plugin creates and manages custom table-of-contents trees. It stores trees and their elements in its own database tables and does not depend on the category structure of the Pages module.

The plugin provides an administrative interface for creating trees, adding elements of three types (category, page, custom link), configuring hierarchy, order, and visibility. To display the tree on the website, the PHP function `cot_toc_page_render()` is used.

The plugin supports multilingualism through the i18n plugin: if it is active, category and page titles are automatically taken from localized data.

### Requirements

- Cotonti 1.0+ or a compatible version
- Pages module (page)
- PHP 8.5+
- MySQL 8.0+ (or compatible PDO driver)
- i18n plugin recommended for multilingualism

### Installation and Uninstallation

#### Installation

1. Copy the `toc_page` folder to the `plugins/` directory of your Cotonti site.
2. Go to the administration panel → **Extensions**.
3. Find the **Table of Contents Page** plugin and click **Install**.
4. If necessary, configure the `default_tree` parameter in the plugin settings.

During installation, Cotonti automatically executes the SQL file `setup/toc_page.install.sql`, which creates the tables `cot_toc_page_trees` and `cot_toc_page_items` with your site’s prefix.

#### Uninstallation

When uninstalling the plugin, Cotonti executes the SQL file `setup/toc_page.uninstall.sql`, which drops both tables. All plugin data will be permanently deleted.

### File Structure

```
plugins/toc_page/
├── toc_page.setup.php          // Plugin metadata and configuration
├── toc_page.global.php         // Global initialization
├── toc_page.functions.php      // Core plugin functions
├── toc_page.admin.php          // Administrative interface
├── setup/
│   ├── toc_page.install.sql    // SQL for installation
│   └── toc_page.uninstall.sql  // SQL for uninstallation
├── tpl/
│   ├── toc_page.admin.tpl      // Admin template
│   └── toc_page.tpl            // Tree output template
└── lang/
    └── toc_page.ru.lang.php    // Russian language file
```

#### File Descriptions

- **toc_page.setup.php** — contains plugin metadata (code, name, description, version, author, license, requirements) and the configuration parameter `default_tree`.
- **toc_page.global.php** — includes the plugin functions file via `cot_incfile('toc_page', 'plug')`.
- **toc_page.functions.php** — registers the plugin tables in Cotonti and declares public functions for working with trees.
- **toc_page.admin.php** — handles actions in the admin panel, prepares data for the template, performs CRUD operations with trees and elements.
- **toc_page.install.sql** — SQL queries for creating plugin tables.
- **toc_page.uninstall.sql** — SQL queries for dropping plugin tables.
- **toc_page.admin.tpl** — administrative template on XTemplate.
- **toc_page.tpl** — frontend tree output template.
- **toc_page.ru.lang.php** — Russian interface strings.

### Database

#### Table `cot_toc_page_trees`

Stores table-of-contents trees.

| Field | Type | Description |
|---|---|---|
| `tree_id` | INT UNSIGNED, AUTO_INCREMENT | Unique tree identifier |
| `tree_title` | VARCHAR(255) | Tree name |
| `tree_description` | TEXT NULL | Tree description |
| `tree_created` | INT UNSIGNED | Creation time (Unix timestamp) |
| `tree_updated` | INT UNSIGNED | Last update time (Unix timestamp) |

#### Table `cot_toc_page_items`

Stores tree elements.

| Field | Type | Description |
|---|---|---|
| `item_id` | INT UNSIGNED, AUTO_INCREMENT | Unique element identifier |
| `tree_id` | INT UNSIGNED | ID of the tree to which the element belongs |
| `parent_id` | INT UNSIGNED | ID of the parent element; 0 means top level |
| `item_type` | ENUM('category','page','custom') | Element type |
| `item_ref` | VARCHAR(255) | Reference to object: category code for category, page ID for page, empty for custom |
| `item_title` | VARCHAR(255) | Custom element title; if empty, the object’s title is used |
| `item_url` | VARCHAR(255) | URL for custom link |
| `item_sort` | INT UNSIGNED | Sort order among elements with the same parent |
| `item_enabled` | TINYINT UNSIGNED | Visibility flag: 1 — enabled, 0 — hidden |

### Plugin Functions

All functions are declared in the `toc_page.functions.php` file.

#### `toc_page_get_tree($treeId)`

Returns a nested array of elements for the specified tree. Executes an SQL query against the `cot_toc_page_items` table with the condition `tree_id = ? AND item_enabled = 1`, sorts by `item_sort ASC`, then recursively groups elements by `parent_id`.

**Parameters:**
- `$treeId` (int) — tree ID.

**Returns:** an array of elements with the `children` key for nested elements.

#### `cot_toc_page_render($treeId, $tpl = 'toc_page')`

Retrieves the tree via `toc_page_get_tree()` and passes it to `toc_page_display()` for rendering.

**Parameters:**
- `$treeId` (int) — tree ID.
- `$tpl` (string) — template name without the `.tpl` extension; defaults to `toc_page`.

**Returns:** HTML code of the rendered tree.

#### `toc_page_display($items, $level, $tpl)`

Recursively traverses elements and generates HTML using XTemplate. For each element, the URL and title are determined:

- **category** — uses `$item['item_ref']` as the category code. The URL is built via `cot_url('page', ['c' => $code])`. The title is taken from localized data if available, otherwise from the Cotonti page structure.
- **page** — `$item['item_ref']` is cast to an integer and used as the page ID. The URL and title are retrieved from the pages table with localization.
- **custom** — URL is taken from `$item['item_url']`, title from `$item['item_title']` or from the URL.

If the title is empty, the element is skipped. If the URL is empty but the title exists, the element is displayed as plain text (separator), and nested elements are processed.

**Parameters:**
- `$items` (array) — array of tree elements.
- `$level` (int) — current nesting level.
- `$tpl` (string) — template name.

**Returns:** HTML code of the list.

#### `toc_page_i18n_cat_title($catCode)`

Returns the localized category title if the i18n plugin is active and a translation exists for the current locale. Otherwise returns `null`.

#### `toc_page_i18n_page_title($pageId)`

Returns the localized page title from the i18n table if the i18n plugin is active and the record exists. Otherwise returns `null`.

### Administrative Interface

The plugin admin panel is implemented in the `toc_page.admin.php` file. Access it via **Administration → Table of Contents Page**.

#### Tabs

- **Trees** — list of trees, creation, renaming, deletion.
- **Edit Tree** — managing elements of the selected tree.

#### Actions on the “Trees” Tab

- `add` — create a new tree. Fields: `tree_title`, `tree_desc`.
- `edit_tree` — display the form for editing the tree name and description.
- `update_tree` — update the tree name and description.
- `delete` — delete the tree and all its elements.

#### Actions on the “Edit Tree” Tab

- `save` — save changes to elements from the table (titles, parents, order, visibility).
- `add_item` — add a new element. Fields: `item_type`, `item_ref_cat` (for category), `item_ref_page` (for page), `item_url` (for link), `item_title`, `parent_id`.
- `delete_item` — delete an element and all its descendants.

#### Parent List Generation

When displaying each element in the table, a dropdown list of all tree elements except itself is built. This allows changing the parent directly in the table.

### Templates

#### Admin template: `tpl/toc_page.admin.tpl`

Contains the layout of both tabs, the filter form, and the element table. Uses XTemplate blocks:

- `MAIN.TREES_ROW` — tree table row.
- `MAIN.EDIT_TREE_FORM` — form for editing tree name and description (shown on `edit_tree` action).
- `MAIN.EDIT_ITEM` — element table row.

#### Output template: `tpl/toc_page.tpl`

Used by `cot_toc_page_render()` to display the tree on the site. Main blocks:

- `LIST` — level list.
- `LIST.ROW` — list element. Contains a condition: if `{ROW_URL}` is not empty, a link is displayed; otherwise, plain text.

### Localization

Interface strings are located in `lang/toc_page.ru.lang.php`. Main keys:

- `toc_page_title` — plugin name
- `toc_page_tab_trees` — “Trees” tab
- `toc_page_tab_edit` — “Edit Tree” tab
- `toc_page_tree_items` — “Items” button
- `toc_page_edit_tree_meta` — “Edit” button
- `toc_page_msg_tree_updated` — “Tree updated” message
- and other strings for fields, actions, and messages.

### Settings

One configuration parameter is defined in `toc_page.setup.php`:

- `default_tree` (type `string`) — default tree ID. Used if the function is called without an argument.

The default value is `0`, meaning no tree.

### Usage Examples

#### Displaying a tree in a site template

```
{PHP|cot_toc_page_render(1)}
```

Here `1` is the tree ID. The function returns the HTML code of the tree.

#### Displaying with a custom template

```
{PHP|cot_toc_page_render(1, 'my_custom_toc')}
```

In this case, the file `tpl/my_custom_toc.tpl` will be used.

### Notes

- The plugin does not modify the structure of Cotonti tables.
- All plugin data is stored in its own tables and is destroyed when the plugin is uninstalled.
- For correct work with categories, `item_ref` stores the category code, not its ID.
- When a `custom` element has an empty URL and nested elements, it acts as a separator and is not displayed as a link.
- The plugin supports an unlimited number of trees and elements.

---

## User Guide

### Right After Installation

After the plugin is installed, a new menu item appears in the Cotonti administration panel. It is located under **“Administration”** and is named **“Table of Contents Page”**. Click on it.

The plugin page will open. It is almost empty because you have not created any trees yet. Don’t worry: this is where all work begins.

### First Look at the Plugin Page

You will see the heading **“Table of Contents Page”**. Below it are two tabs: **“Trees”** and **“Edit Tree”**. The “Trees” tab is currently active.

Inside the “Trees” tab there are two main blocks:

- **Tree List** — a table where all your created trees will be displayed. It is empty now.
- **Add Tree** — the form with which you will create the first tree.

### Getting to Know the Tabs

The plugin has two tabs, each responsible for its part of the work.

#### “Trees” Tab

This tab is for managing the trees themselves. Here you can:

- create new trees;
- view the list of already created trees;
- change the name and description of a tree;
- delete an entire tree.

#### “Edit Tree” Tab

This tab is for filling a tree with elements. Here you can:

- select which tree you are working with;
- add elements of different types;
- configure the order, nesting, and visibility of elements;
- save changes.

Simply put: first you create a container on the “Trees” tab, and then you fill it with content on the “Edit Tree” tab.

### Creating Your First Tree

Let’s create the first tree. Follow these steps.

1. Make sure you are on the **“Trees”** tab. If not, click it.
2. Find the **“Add Tree”** block.
3. In the **“Tree Name”** field, enter a name. For example, *Product Documentation* or *Site Help*. This name will be visible to you in the tree list.
4. In the **“Description”** field, you can enter a short note. This is optional but useful if you have several trees. For example, *User guide for the product filter module*.
5. Click the **“Create”** button.

After clicking, the tree will appear in the “Tree List” table. You will see:

- **ID** — a number assigned automatically. You will need it later to display the tree on the site.
- **Tree Name** — what you entered.
- **Description** — your note.
- **Actions** — buttons for working with the tree: “Items”, “Edit”, “Delete”.

Remember the ID of your tree. For example, if this is the first tree, its ID is **1**.

### What a Tree Is and Why You Need It

A tree is a structure into which you add menu or table-of-contents items. Imagine that the tree is a frame, and the elements are individual branches. Thanks to the tree, you can combine pages from different categories, add external links, and arrange them in a convenient order.

You can create multiple trees. For example, one for documentation, another for the “Help” section, and a third for links to external resources. Each tree will be a separate list on the site.

### Opening a Tree for Filling

After creating a tree, you need to start filling it. To do this, do one of the following:

- Go to the **“Edit Tree”** tab. If the tree was just created, it will be selected automatically.
- Or on the “Trees” tab, click the **“Items”** button next to the desired tree.

Now you are on the “Edit Tree” tab. At the top of the screen, you will see which tree you are editing, for example: **“Edit Tree: Product Documentation”**.

Below you will see the element table. It is empty now. Under the table is the **“Add Element”** form — that is what we will use to add items.

### Add Element Form

The “Add Element” form contains several fields:

- **Type** — a dropdown where you select what you are adding: “Category”, “Page”, or “Custom Link”.
- **Category** — appears only when the “Category” type is selected; it is a dropdown of all page categories on your site.
- **Page** — appears only when the “Page” type is selected; it is a dropdown of all published pages.
- **URL** — appears only when the “Custom Link” type is selected; enter the address here.
- **Title** — a text field where you can enter your own text for the menu item. If left empty, the category or page’s own title will be used.
- **Parent** — a dropdown of all already added elements, allowing you to choose where to nest the new item. By default, “Top Level” is selected, meaning the item will be at the first level of the tree.

Now let’s look at adding each element type separately.

### Adding a Category Element

A category is a section of the site that may already contain pages. By adding a category to the tree, you create an item that leads to that category.

Let’s say you have a category called “Articles”. We want to add it to the tree as the first item.

1. In the **“Add Element”** form, find the **“Type”** field and select **“Category”** from the list.
2. A new field — **“Category”** — will appear. Click it to open the list of all categories on your site.
3. Select the desired category, for example, “Articles”.
4. In the **“Title”** field, you can enter your own text if you want the menu item to have a different name than the category. For example, enter *Useful Articles*. If left empty, the category name “Articles” will be displayed.
5. Leave **“Top Level”** in the **“Parent”** field, since this is the first item and should be at the first level.
6. Click the **“Add”** button.

After that, the element will appear in the table above. You will see a row with the ID, type “Category”, the selected category name, title, parent “Top Level”, order (e.g., 1), and the “Enabled” checkbox (checked by default).

### Adding a Page Element

A page is a separate article or material on the site. You can add any published page to the tree, even if it is in a different category.

Suppose you have a page titled “How to Install the Module”. Let’s add it as a nested item under the “Articles” category.

1. In the **“Add Element”** form, select the **“Page”** type.
2. The **“Page”** field will appear. Click it to open the list of all published pages.
3. Find and select the page “How to Install the Module”.
4. In the **“Title”** field, you can enter your own text, for example *Module Installation*. If left empty, the page title will be displayed.
5. In the **“Parent”** field, select the previously added element “Useful Articles” (or “Articles” if you left the default title). To do this, click the list and choose the desired item.
6. Click the **“Add”** button.

Now a new row will appear in the table. The “Parent” column will show the selected element. This means the page will be nested under it and will be displayed with an indent on the site.

### Adding a Custom Link Element

A custom link is any internet address: another page on your site, an external site, a document, or a file. This type is suitable when you need to add something that is not among the pages or categories of Cotonti.

Let’s add a link to an external resource, such as a support forum.

1. In the **“Add Element”** form, select the **“Custom Link”** type.
2. The **“URL”** field will appear. Enter the full address, for example `https://forum.example.com`.
3. In the **“Title”** field, be sure to enter the text that will be displayed in the menu. For example, *Support Forum*. If you don’t enter it, the URL itself will become the title, which is not pretty.
4. In the **“Parent”** field, if necessary, select which element to nest the link under. If left as “Top Level”, the link will be a separate first-level item.
5. Click **“Add”**.

The link will appear in the table. The “Link to Object” column will show the URL, and the “Type” column will show “Custom Link”.

### Managing Elements After Adding

After adding several elements, you can change their order, nesting, and visibility directly in the table.

The element table has the following columns:

- **ID** — element number, cannot be changed.
- **Type** — shows what it is: category, page, or link.
- **Link to Object** — category or page name, or URL.
- **Title** — text field, can be edited.
- **Parent** — dropdown. Select another parent to move the element to a different branch.
- **Order** — a number. The smaller the number, the higher the element among siblings with the same parent.
- **Enabled** — checkbox. If checked, the element is displayed on the site. Uncheck to temporarily hide it.
- **Actions** — “Delete” button.

To change the order, simply enter new numbers in the “Order” column. For example, you have three top-level items. Set them to 1, 2, 3. If you want an item to be first, set it to 1 and the others to 2 and 3.

To change nesting, select a different parent in the “Parent” column. If you choose “Top Level”, the element becomes a standalone item.

To hide an element, uncheck the “Enabled” box. You can later check it again.

### Saving Changes

After any edits in the element table, be sure to click the **“Save Changes”** button below the table. Only then will your changes take effect.

### Conclusion

Now you can:

- create trees;
- add categories, pages, and custom links to them;
- configure order, nesting, and visibility of elements;
- save changes.

The created tree can be displayed on the site using the tree ID. If you work with templates yourself, use the call `{PHP|cot_toc_page_render(1)}`, where `1` is your tree ID. If a developer handles the templates, just pass them this ID.

The plugin is ready to use. Good luck creating convenient and clear tables of contents!


___


# toc_page — плагин оглавления для Cotonti

**Код плагина:** toc_page  
**Версия:** 1.1.4 
**Автор:** webitproff  
**Лицензия:** BSD  
**Исходный код:** [github.com/webitproff/toc_page-cotonti](https://github.com/webitproff/toc_page-cotonti)

Плагин **toc_page** предназначен для создания и управления произвольными деревьями оглавления на сайте Cotonti. Он позволяет администратору вручную собирать структуру документации, базы знаний или навигационного меню, комбинируя категории, страницы и внешние ссылки.


___
# Пресс-релиз

**Table of Contents Page (toc_page) для Cotonti — релиз версии 1.1.4**

*24 августа 2026 г.*

---

Команда разработчиков плагина **Table of Contents Page (toc_page)** рада сообщить о выходе версии **1.1.4**. Это значительное обновление, направленное на повышение удобства администрирования, производительности при работе с большими объёмами данных и расширение мультиязычных возможностей.

Плагин **toc_page** предназначен для создания управляемого оглавления на страницах Cotonti. Он позволяет строить иерархические деревья элементов (категории, страницы, произвольные ссылки), вручную сортировать их, управлять видимостью и добавлять переводы заголовков и URL.

В версии **1.1.4** основное внимание уделено исправлению недостатков предыдущих релизов и внедрению новых функций, которые делают работу с плагином ещё более интуитивной и эффективной.

---

## Ключевые изменения в версии 1.1.4

### 1. Пагинация для элементов дерева и переводов

Одним из главных улучшений стало внедрение постраничной навигации (пагинации) в административных вкладках **«Редактирование дерева»** и **«Переводы»**.

Ранее при большом количестве элементов (например, более 500) все они выводились на одной странице, что приводило к замедлению загрузки и неудобству работы. Теперь элементы и переводы разбиваются на страницы (по умолчанию 20, количество настраивается в конфигурации плагина).

- На вкладке **«Редактирование дерева»** отображается плоский список с пагинацией, сохраняющий привычный порядок сортировки.
- На вкладке **«Переводы»** пагинация работает аналогичным образом, позволяя быстро находить нужные элементы для перевода.
- Все действия (сохранение, добавление, удаление) корректно сохраняют текущую страницу или сбрасывают её при необходимости.

Благодаря этому администраторы могут легко управлять деревьями с сотнями и тысячами элементов без потери производительности.

### 2. Редактирование типа элемента после создания

Исправлена серьёзная недоработка: раньше после создания элемента нельзя было изменить его тип. Если элемент был создан как «Произвольная ссылка» (custom), его нельзя было превратить в «Страницу» или «Категорию».

В версии **1.1.4** добавлена **отдельная вкладка «Элемент»** (`edit_element`), которая открывает полноценную форму редактирования:

- Изменение типа элемента (категория, страница, произвольная ссылка).
- Настройка связанной ссылки (выбор категории, страницы через AJAX-поиск Select2 или ввод URL).
- Редактирование заголовка, родительского элемента, порядка сортировки.
- Включение/отключение элемента.

Кнопка **«Редактировать»** добавлена в список элементов дерева. После сохранения изменений администратор остаётся на странице редактирования, а не перенаправляется обратно в дерево, что позволяет сразу убедиться в корректности внесённых данных.

### 3. Исправление выпадающих списков родительских элементов

Устранена ошибка, возникавшая после внедрения пагинации: в выпадающих списках выбора родительского элемента (как в таблице элементов, так и в форме добавления) отображались только элементы текущей страницы, а не все элементы дерева.

Теперь списки родителей всегда содержат **все элементы дерева**, независимо от выбранной страницы. Это исключает невозможность назначить родителя, находящегося на другой странице пагинации.

### 4. Улучшение пользовательского опыта

- После сохранения элемента страница редактирования обновляется, и администратор остаётся на ней, видя актуальные данные.
- Мелкие исправления и оптимизация кода для стабильной работы на PHP 8.5+ и MySQL 8.4.

### 5. Расширение языковой поддержки

Добавлены **официальные языковые пакеты**:

- Английский (`toc_page.en.lang.php`)
- Украинский (`toc_page.uk.lang.php`)

Русский языковой пакет обновлён и дополнен новыми строками.

---

## Совместимость

Плагин **toc_page 1.1.4** разработан для **Cotonti v1.+** и протестирован на **PHP 8.5+** и **MySQL 8.4**. Он полностью обратно совместим с предыдущими версиями — данные сохраняются без изменений, дополнительная миграция не требуется.

---

## Цитата разработчика

> «Мы стремились сделать управление оглавлениями максимально удобным даже при очень больших деревьях. Пагинация и возможность редактировать тип элемента — это именно те функции, которых не хватало нашим пользователям. Теперь плагин стал по-настоящему готовым к эксплуатации на крупных проектах».  
> — **webitproff**, автор плагина

---

## Полезные ссылки

- **Исходный код и обновления:** [github.com/webitproff/toc_page-cotonti](https://github.com/webitproff/toc_page-cotonti)
- **Подробная документация:** [abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti](https://abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti)
- **Поддержка и форум:** [abuyfile.com/ru/forums/cotonti/custom/plugs](https://abuyfile.com/ru/forums/cotonti/custom/plugs)
- **Cotonti CMF:** [github.com/Cotonti/Cotonti](https://github.com/Cotonti/Cotonti)

---

## О плагине

**Table of Contents Page (toc_page)** — это гибкий инструмент для создания иерархических оглавлений на страницах Cotonti. Он позволяет:

- Создавать неограниченное количество деревьев оглавления.
- Добавлять элементы трёх типов: категории, страницы и произвольные ссылки.
- Вручную сортировать элементы и задавать иерархию.
- Управлять видимостью элементов.
- Переводить заголовки и URL на несколько языков.

Распространяется под лицензией **BSD**.

---

**Контакты для прессы:**  
Автор: webitproff  
Email: [указан в репозитории]  
Веб-сайт: [abuyfile.com](https://abuyfile.com)
___

---

## Оглавление

### Техническая документация

- [Общая информация](#общая-информация)
- [Требования](#требования)
- [Установка и удаление](#установка-и-удаление)
- [Структура файлов](#структура-файлов)
- [База данных](#база-данных)
- [Функции плагина](#функции-плагина)
- [Административный интерфейс](#административный-интерфейс)
- [Шаблоны](#шаблоны)
- [Локализация](#локализация)
- [Настройки](#настройки)
- [Примеры использования](#примеры-использования)
- [Примечания](#примечания)

### Руководство пользователя

- [Сразу после установки](#сразу-после-установки)
- [Первый взгляд на страницу плагина](#первый-взгляд-на-страницу-плагина)
- [Знакомство с вкладками](#знакомство-с-вкладками)
- [Создание первого дерева](#создание-первого-дерева)
- [Что такое дерево и зачем оно нужно](#что-такое-дерево-и-зачем-оно-нужно)
- [Открытие дерева для наполнения](#открытие-дерева-для-наполнения)
- [Форма добавления элемента](#форма-добавления-элемента)
- [Добавление элемента типа «Категория»](#добавление-элемента-типа-категория)
- [Добавление элемента типа «Страница»](#добавление-элемента-типа-страница)
- [Добавление элемента типа «Произвольная ссылка»](#добавление-элемента-типа-произвольная-ссылка)
- [Управление элементами после добавления](#управление-элементами-после-добавления)
- [Сохранение изменений](#сохранение-изменений)
- [Заключение](#заключение)

---

## Техническая документация

### Общая информация

Плагин **toc_page** создаёт и управляет произвольными деревьями оглавления. Он хранит деревья и их элементы в собственных таблицах базы данных и не зависит от структуры категорий модуля Pages.

**[Обзор и назначение плагина Table of Contents Page](https://abuyfile.com/ru/usersblog/review-toc-page-cotonti)**

Плагин предоставляет административный интерфейс для создания деревьев, добавления в них элементов трёх типов (категория, страница, произвольная ссылка), настройки иерархии, порядка и видимости. Для вывода дерева на сайте используется PHP-функция `cot_toc_page_render()`.

Плагин поддерживает мультиязычность через плагин i18n: если он активен, заголовки категорий и страниц автоматически берутся из локализованных данных.

### Требования

- Cotonti 1.0+ или совместимая версия
- Модуль Pages (page)
- PHP 8.5+
- MySQL 8.0+ (или совместимый драйвер PDO)
- Рекомендуется плагин i18n для мультиязычности

### Установка и удаление

#### Установка

1. Скопируйте папку `toc_page` в каталог `plugins/` сайта Cotonti.
2. Перейдите в административную панель → **Расширения**.
3. Найдите плагин **Table of Contents Page** и нажмите **Установить**.
4. При необходимости настройте параметр `default_tree` в настройках плагина.

При установке Cotonti автоматически выполнит SQL-файл `setup/toc_page.install.sql`, который создаст таблицы `cot_toc_page_trees` и `cot_toc_page_items` с префиксом вашего сайта.

#### Удаление

При удалении плагина Cotonti выполнит SQL-файл `setup/toc_page.uninstall.sql`, который удалит обе таблицы. Все данные плагина будут безвозвратно удалены.

### Структура файлов

```
plugins/toc_page/
├── toc_page.setup.php          // Метаданные и конфигурация плагина
├── toc_page.global.php         // Глобальная инициализация
├── toc_page.functions.php      // Основные функции плагина
├── toc_page.admin.php          // Административный интерфейс
├── setup/
│   ├── toc_page.install.sql    // SQL для установки
│   └── toc_page.uninstall.sql  // SQL для удаления
├── tpl/
│   ├── toc_page.admin.tpl      // Шаблон админки
│   └── toc_page.tpl            // Шаблон вывода дерева
└── lang/
    └── toc_page.ru.lang.php    // Русский языковой файл
```

#### Назначение файлов

- **toc_page.setup.php** — содержит метаданные плагина (код, название, описание, версию, автора, лицензию, требования) и конфигурационный параметр `default_tree`.
- **toc_page.global.php** — подключает файл функций плагина через `cot_incfile('toc_page', 'plug')`.
- **toc_page.functions.php** — регистрирует таблицы плагина в Cotonti и объявляет публичные функции для работы с деревьями.
- **toc_page.admin.php** — обрабатывает действия в админ-панели, формирует данные для шаблона, выполняет CRUD-операции с деревьями и элементами.
- **toc_page.install.sql** — SQL-запросы для создания таблиц плагина.
- **toc_page.uninstall.sql** — SQL-запросы для удаления таблиц плагина.
- **toc_page.admin.tpl** — шаблон административной части на XTemplate.
- **toc_page.tpl** — шаблон вывода дерева на фронтенде.
- **toc_page.ru.lang.php** — русские языковые строки интерфейса.

### База данных

#### Таблица `cot_toc_page_trees`

Хранит деревья оглавления.

| Поле | Тип | Описание |
|---|---|---|
| `tree_id` | INT UNSIGNED, AUTO_INCREMENT | Уникальный идентификатор дерева |
| `tree_title` | VARCHAR(255) | Название дерева |
| `tree_description` | TEXT NULL | Описание дерева |
| `tree_created` | INT UNSIGNED | Время создания (Unix timestamp) |
| `tree_updated` | INT UNSIGNED | Время последнего обновления (Unix timestamp) |

#### Таблица `cot_toc_page_items`

Хранит элементы деревьев.

| Поле | Тип | Описание |
|---|---|---|
| `item_id` | INT UNSIGNED, AUTO_INCREMENT | Уникальный идентификатор элемента |
| `tree_id` | INT UNSIGNED | ID дерева, к которому относится элемент |
| `parent_id` | INT UNSIGNED | ID родительского элемента; 0 — верхний уровень |
| `item_type` | ENUM('category','page','custom') | Тип элемента |
| `item_ref` | VARCHAR(255) | Ссылка на объект: код категории для category, ID страницы для page, пусто для custom |
| `item_title` | VARCHAR(255) | Пользовательский заголовок элемента; если пусто, используется заголовок объекта |
| `item_url` | VARCHAR(255) | URL для custom-ссылки |
| `item_sort` | INT UNSIGNED | Порядок сортировки среди элементов с одинаковым родителем |
| `item_enabled` | TINYINT UNSIGNED | Флаг видимости: 1 — включён, 0 — скрыт |

### Функции плагина

Все функции объявлены в файле `toc_page.functions.php`.

#### `toc_page_get_tree($treeId)`

Возвращает вложенный массив элементов указанного дерева. Выполняет SQL-запрос к таблице `cot_toc_page_items` с условием `tree_id = ? AND item_enabled = 1`, сортирует по `item_sort ASC`, затем рекурсивно группирует элементы по `parent_id`.

**Параметры:**
- `$treeId` (int) — ID дерева.

**Возвращает:** массив элементов с ключом `children` для вложенных элементов.

#### `cot_toc_page_render($treeId, $tpl = 'toc_page')`

Получает дерево через `toc_page_get_tree()` и передаёт его в `toc_page_display()` для рендеринга.

**Параметры:**
- `$treeId` (int) — ID дерева.
- `$tpl` (string) — имя шаблона без расширения `.tpl`; по умолчанию `toc_page`.

**Возвращает:** HTML-код отрендеренного дерева.

#### `toc_page_display($items, $level, $tpl)`

Рекурсивно обходит элементы и формирует HTML с помощью XTemplate. Для каждого элемента определяются URL и заголовок:

- **category** — используется `$item['item_ref']` как код категории. URL строится через `cot_url('page', ['c' => $code])`. Заголовок берётся из локализованных данных, если они доступны, иначе из структуры страниц Cotonti.
- **page** — `$item['item_ref']` преобразуется в целое число и используется как ID страницы. URL и заголовок берутся из таблицы страниц с учётом локализации.
- **custom** — URL берётся из `$item['item_url']`, заголовок из `$item['item_title']` или из URL.

Если заголовок пуст, элемент пропускается. Если URL пуст, но заголовок есть, элемент выводится как обычный текст (разделитель), а вложенные элементы обрабатываются.

**Параметры:**
- `$items` (array) — массив элементов дерева.
- `$level` (int) — текущий уровень вложенности.
- `$tpl` (string) — имя шаблона.

**Возвращает:** HTML-код списка.

#### `toc_page_i18n_cat_title($catCode)`

Возвращает локализованное название категории, если активен плагин i18n и для текущей локали есть перевод. Иначе возвращает `null`.

#### `toc_page_i18n_page_title($pageId)`

Возвращает локализованное название страницы из таблицы i18n, если активен плагин i18n и запись существует. Иначе возвращает `null`.

### Административный интерфейс

Админка плагина реализована в файле `toc_page.admin.php`. Доступ к ней осуществляется через раздел **Администрирование → Table of Contents Page**.

#### Вкладки

- **Деревья** — список деревьев, создание, переименование, удаление.
- **Редактирование дерева** — управление элементами выбранного дерева.

#### Действия на вкладке «Деревья»

- `add` — создание нового дерева. Поля: `tree_title`, `tree_desc`.
- `edit_tree` — отображение формы редактирования названия и описания дерева.
- `update_tree` — обновление названия и описания дерева.
- `delete` — удаление дерева и всех его элементов.

#### Действия на вкладке «Редактирование дерева»

- `save` — сохранение изменений элементов из таблицы (заголовки, родители, порядок, видимость).
- `add_item` — добавление нового элемента. Поля: `item_type`, `item_ref_cat` (для категории), `item_ref_page` (для страницы), `item_url` (для ссылки), `item_title`, `parent_id`.
- `delete_item` — удаление элемента и всех его потомков.

#### Формирование списка родителей

При выводе каждого элемента в таблице строится выпадающий список всех элементов дерева, кроме самого себя. Это позволяет изменить родителя непосредственно в таблице.

### Шаблоны

#### Шаблон админки: `tpl/toc_page.admin.tpl`

Содержит разметку обеих вкладок, форму фильтров и таблицы элементов. Использует XTemplate-блоки:

- `MAIN.TREES_ROW` — строка таблицы деревьев.
- `MAIN.EDIT_TREE_FORM` — форма редактирования названия и описания дерева (показывается при действии `edit_tree`).
- `MAIN.EDIT_ITEM` — строка таблицы элементов.

#### Шаблон вывода: `tpl/toc_page.tpl`

Используется функцией `cot_toc_page_render()` для отображения дерева на сайте. Основные блоки:

- `LIST` — список уровня.
- `LIST.ROW` — элемент списка. Содержит условие: если `{ROW_URL}` не пуст, выводится ссылка, иначе — текст.

### Локализация

Языковые строки интерфейса находятся в файле `lang/toc_page.ru.lang.php`. Основные ключи:

- `toc_page_title` — название плагина
- `toc_page_tab_trees` — вкладка «Деревья»
- `toc_page_tab_edit` — вкладка «Редактирование дерева»
- `toc_page_tree_items` — кнопка «Элементы»
- `toc_page_edit_tree_meta` — кнопка «Изменить»
- `toc_page_msg_tree_updated` — сообщение «Дерево обновлено»
- и другие строки для полей, действий и сообщений.

### Настройки

В файле `toc_page.setup.php` определён один конфигурационный параметр:

- `default_tree` (тип `string`) — ID дерева по умолчанию. Используется, если функция вызывается без аргумента.

По умолчанию значение равно `0`, что означает отсутствие дерева.

### Примеры использования

#### Вывод дерева в шаблоне сайта

```
{PHP|cot_toc_page_render(1)}
```

Здесь `1` — ID дерева. Функция вернёт HTML-код дерева.

#### Вывод с кастомным шаблоном

```
{PHP|cot_toc_page_render(1, 'my_custom_toc')}
```

В этом случае будет использоваться файл `tpl/my_custom_toc.tpl`.

### Примечания

- Плагин не изменяет структуру таблиц Cotonti.
- Все данные плагина хранятся в собственных таблицах и при удалении плагина уничтожаются.
- Для корректной работы с категориями в поле `item_ref` хранится код категории, а не её ID.
- При пустом URL у элемента с типом `custom` и наличии вложенных элементов, он работает как разделитель и не отображается как ссылка.
- Плагин поддерживает неограниченное количество деревьев и элементов.

---

## Руководство пользователя

### Сразу после установки

После того как плагин установлен, в административной панели Cotonti появляется новый пункт меню. Он находится в разделе **«Администрирование»** и называется **«Table of Contents Page»**. Нажмите на этот пункт.

Откроется страница плагина. Сейчас она почти пустая, потому что вы ещё не создали ни одного дерева. Не пугайтесь: именно с этого экрана начинается вся работа.

### Первый взгляд на страницу плагина

На странице вы увидите заголовок **«Table of Contents Page»**. Под ним расположены две вкладки: **«Деревья»** и **«Редактирование дерева»**. Сейчас активна вкладка «Деревья».

Внутри вкладки «Деревья» находятся два основных блока:

- **Список деревьев** — таблица, в которой будут отображаться все созданные вами деревья. Сейчас она пустая.
- **Добавить дерево** — форма, с помощью которой вы создадите первое дерево.

### Знакомство с вкладками

Плагин имеет две вкладки, и каждая отвечает за свою часть работы.

#### Вкладка «Деревья»

Эта вкладка предназначена для управления самими деревьями. Здесь вы можете:

- создавать новые деревья;
- просматривать список уже созданных деревьев;
- изменять название и описание дерева;
- удалять дерево целиком.

#### Вкладка «Редактирование дерева»

Эта вкладка служит для наполнения дерева элементами. Здесь вы:

- выбираете, с каким деревом работаете;
- добавляете элементы разных типов;
- настраиваете порядок, вложенность и видимость элементов;
- сохраняете изменения.

Проще говоря: сначала на вкладке «Деревья» вы создаёте контейнер, а затем на вкладке «Редактирование дерева» наполняете его содержимым.

### Создание первого дерева

Теперь создадим первое дерево. Выполните следующие действия.

1. Убедитесь, что вы находитесь на вкладке **«Деревья»**. Если нет — нажмите на неё.
2. Найдите блок **«Добавить дерево»**.
3. В поле **«Название дерева»** введите название. Например, *Документация по продукту* или *Помощь по сайту*. Это название будет видно вам в списке деревьев, чтобы не путаться.
4. В поле **«Описание»** можно ввести короткое пояснение. Это необязательно, но полезно, если деревьев будет несколько. Например, *Руководство пользователя для модуля фильтра товаров*.
5. Нажмите кнопку **«Создать»**.

После нажатия кнопки дерево появится в таблице «Список деревьев». Вы увидите:

- **ID** — номер дерева, который присваивается автоматически. Он понадобится позже, чтобы вывести дерево на сайте.
- **Название дерева** — то, что вы ввели.
- **Описание** — ваше пояснение.
- **Действия** — кнопки для работы с деревом: «Элементы», «Изменить», «Удалить».

Запомните ID вашего дерева. Например, если это первое дерево, его ID будет **1**.

### Что такое дерево и зачем оно нужно

Дерево — это структура, в которую вы будете добавлять пункты меню или оглавления. Представьте, что дерево — это каркас, а элементы — отдельные ветви. Благодаря дереву вы можете объединить в одном месте страницы из разных категорий, добавить внешние ссылки и выстроить их в удобном порядке.

Вы можете создать несколько деревьев. Например, одно для документации, другое для раздела «Помощь», третье для ссылок на внешние ресурсы. Каждое дерево будет отдельным списком на сайте.

### Открытие дерева для наполнения

После создания дерева нужно перейти к его наполнению. Для этого выполните одно из действий:

- Перейдите на вкладку **«Редактирование дерева»**. Если дерево только что создано, оно будет выбрано автоматически.
- Или на вкладке «Деревья» нажмите кнопку **«Элементы»** рядом с нужным деревом.

Теперь вы на вкладке «Редактирование дерева». В верхней части экрана будет написано, какое дерево вы редактируете, например: **«Редактирование дерева: Документация по продукту»**.

Ниже вы увидите таблицу элементов. Сейчас она пустая. Под таблицей находится форма **«Добавить элемент»** — именно с её помощью мы будем добавлять пункты.

### Форма добавления элемента

Форма «Добавить элемент» содержит несколько полей:

- **Тип** — выпадающий список, где нужно выбрать, что вы добавляете: «Категория», «Страница» или «Произвольная ссылка».
- **Категория** — появляется только при выборе типа «Категория»; это выпадающий список всех категорий страниц сайта.
- **Страница** — появляется только при выборе типа «Страница»; это выпадающий список всех опубликованных страниц.
- **URL** — появляется только при выборе типа «Произвольная ссылка»; сюда вводится адрес.
- **Заголовок** — текстовое поле, куда можно ввести свой текст для пункта меню. Если оставить пустым, для категорий и страниц будет использовано их собственное название.
- **Родитель** — выпадающий список всех уже добавленных элементов, чтобы выбрать, в какой из них вложить новый пункт. По умолчанию стоит «Верхний уровень», то есть пункт будет на первом уровне дерева.

Теперь рассмотрим добавление каждого типа элемента отдельно.

### Добавление элемента типа «Категория»

Категория — это раздел сайта, в котором уже могут находиться страницы. Добавляя категорию в дерево, вы создаёте пункт, который ведёт на эту категорию.

Предположим, у вас есть категория с названием «Статьи». Мы хотим добавить её в дерево как первый пункт.

1. В форме **«Добавить элемент»** найдите поле **«Тип»** и выберите из списка **«Категория»**.
2. После этого под полем «Тип» появится новое поле — **«Категория»**. Нажмите на него, чтобы открыть список всех категорий вашего сайта.
3. Выберите нужную категорию, например «Статьи».
4. В поле **«Заголовок»** можно ввести свой текст, если вы хотите, чтобы пункт меню назывался иначе, чем категория. Например, введите *Полезные статьи*. Если оставить пустым, будет показано название категории «Статьи».
5. В поле **«Родитель»** оставьте **«Верхний уровень»**, так как это первый пункт и он должен быть на первом уровне.
6. Нажмите кнопку **«Добавить»**.

После этого элемент появится в таблице выше. Вы увидите строку с ID, типом «Категория», названием выбранной категории, заголовком, родителем «Верхний уровень», порядком (например, 1) и флажком «Включено» (по умолчанию включено).

### Добавление элемента типа «Страница»

Страница — это отдельная статья или материал сайта. Вы можете добавить любую опубликованную страницу в дерево, даже если она находится в другой категории.

Допустим, у вас есть страница с заголовком «Как установить модуль». Добавим её как вложенный пункт в категорию «Статьи».

1. В форме **«Добавить элемент»** выберите тип **«Страница»**.
2. Появится поле **«Страница»**. Нажмите на него, чтобы открыть список всех опубликованных страниц.
3. Найдите и выберите страницу «Как установить модуль».
4. В поле **«Заголовок»** можно ввести свой текст, например *Установка модуля*. Если оставить пустым, будет показано название страницы.
5. В поле **«Родитель»** выберите ранее добавленный элемент «Полезные статьи» (или «Статьи», если вы оставили заголовок по умолчанию). Для этого нажмите на список и выберите нужный пункт.
6. Нажмите кнопку **«Добавить»**.

Теперь в таблице появится новая строка. В колонке «Родитель» будет указан выбранный элемент. Это означает, что страница будет вложена в него и на сайте отобразится с отступом.

### Добавление элемента типа «Произвольная ссылка»

Произвольная ссылка — это любой адрес в интернете: другая страница вашего сайта, внешний сайт, документ, файл. Этот тип подходит, если нужно добавить в дерево что-то, чего нет среди страниц или категорий Cotonti.

Добавим ссылку на внешний ресурс, например на форум поддержки.

1. В форме **«Добавить элемент»** выберите тип **«Произвольная ссылка»**.
2. Появится поле **«URL»**. Введите полный адрес, например `https://forum.example.com`.
3. В поле **«Заголовок»** обязательно введите текст, который будет отображаться в меню. Например, *Форум поддержки*. Если не ввести, заголовком станет сам URL, что некрасиво.
4. В поле **«Родитель»** при необходимости выберите, в какой элемент вложить ссылку. Если оставить «Верхний уровень», ссылка будет отдельным пунктом на первом уровне.
5. Нажмите **«Добавить»**.

Ссылка появится в таблице. В колонке «Ссылка на объект» будет показан URL, а в колонке «Тип» — «Произвольная ссылка».

### Управление элементами после добавления

После добавления нескольких элементов вы можете изменить их порядок, вложенность и видимость прямо в таблице.

В таблице элементов есть такие колонки:

- **ID** — номер элемента, изменить нельзя.
- **Тип** — показывает, что это: категория, страница или ссылка.
- **Ссылка на объект** — название категории или страницы либо URL.
- **Заголовок** — текстовое поле, можно изменить.
- **Родитель** — выпадающий список. Выберите другого родителя, чтобы переместить элемент в другую ветку.
- **Порядок** — число. Чем меньше число, тем выше элемент среди соседей с тем же родителем.
- **Включено** — флажок. Если он установлен, элемент виден на сайте. Снимите, чтобы временно скрыть.
- **Действия** — кнопка «Удалить».

Чтобы изменить порядок, просто введите новые числа в колонке «Порядок». Например, у вас есть три пункта на верхнем уровне. Поставьте им 1, 2, 3. Если хотите, чтобы какой-то пункт был первым, поставьте ему 1, остальным — 2 и 3.

Чтобы изменить вложенность, в колонке «Родитель» выберите другой элемент. Если выбрать «Верхний уровень», элемент станет самостоятельным.

Чтобы скрыть элемент, снимите галочку в колонке «Включено». Позже её можно вернуть.

### Сохранение изменений

После любых правок в таблице элементов обязательно нажмите кнопку **«Сохранить изменения»**, которая находится под таблицей. Только после этого ваши изменения вступят в силу.

### Заключение

Теперь вы умеете:

- создавать деревья;
- добавлять в них категории, страницы и произвольные ссылки;
- настраивать порядок, вложенность и видимость элементов;
- сохранять изменения.

Созданное дерево можно вывести на сайте с помощью ID дерева. Если вы сами работаете с шаблонами, используйте вызов `{PHP|cot_toc_page_render(1)}`, где `1` — ID вашего дерева. Если шаблонами занимается разработчик, просто передайте ему этот ID.

Плагин готов к работе. Удачи в создании удобных и понятных оглавлений!
