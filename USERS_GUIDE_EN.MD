# Table of Contents Page (toc_page) Plugin Guide for Cotonti

**Version:** 1.1.4  
**Date:** August 24, 2026

## Table of Contents

1. [Introduction](#introduction)
   - [About the Plugin](#about-the-plugin)
   - [Features](#features)
   - [Requirements](#requirements)
2. [Installation and Setup](#installation-and-setup)
   - [Installing the Plugin](#installing-the-plugin)
   - [Initial Configuration](#initial-configuration)
   - [Multilingual Configuration](#multilingual-configuration)
   - [Select2 Setup](#select2-setup)
3. [Managing Trees](#managing-trees)
   - [Creating a Tree](#creating-a-tree)
   - [Editing a Tree](#editing-a-tree)
   - [Deleting a Tree](#deleting-a-tree)
   - [Tree Embed Code](#tree-embed-code)
4. [Managing Items](#managing-items)
   - [Adding an Item](#adding-an-item)
   - [Item Types](#item-types)
     - [Category](#category)
     - [Page](#page)
     - [Custom Link](#custom-link)
   - [Editing an Item](#editing-an-item)
   - [Changing Item Type](#changing-item-type)
   - [Sorting and Order](#sorting-and-order)
   - [Hierarchy and Parent Items](#hierarchy-and-parent-items)
   - [Enabling and Disabling](#enabling-and-disabling)
   - [Deleting an Item](#deleting-an-item)
5. [Multilingualism](#multilingualism)
   - [Enabling and Configuring Languages](#enabling-and-configuring-languages)
   - [Translating Titles and URLs](#translating-titles-and-urls)
   - [How Language Detection Works](#how-language-detection-works)
   - [i18n Developer Functions](#i18n-developer-functions)
6. [Cotonti Integration](#cotonti-integration)
   - [Rendering a Tree on a Page](#rendering-a-tree-on-a-page)
   - [Function cot_toc_page_render()](#function-cot_toc_page_render)
   - [Template toc_page.tpl](#template-toc_pagetpl)
   - [Using in TPL Templates](#using-in-tpl-templates)
7. [AJAX Page Search (Select2)](#ajax-page-search-select2)
   - [Enabling](#enabling)
   - [How It Works](#how-it-works)
   - [Minimum Length Setting](#minimum-length-setting)
8. [SQL Dump Generator](#sql-dump-generator)
   - [Purpose](#purpose)
   - [Preparing HTML List](#preparing-html-list)
   - [Creating a Dump](#creating-a-dump)
   - [Importing to Database](#importing-to-database)
9. [Advanced Functions](#advanced-functions)
   - [Data Retrieval Functions](#data-retrieval-functions)
   - [Direct Translation Handling](#direct-translation-handling)
10. [Frequently Asked Questions](#frequently-asked-questions)
    - [Why is the tree not displayed?](#why-is-the-tree-not-displayed)
    - [How to change item type?](#how-to-change-item-type)
    - [How to add a new language?](#how-to-add-a-new-language)
    - [How to remove the plugin?](#how-to-remove-the-plugin)
11. [Examples](#examples)
    - [Simple Tree](#simple-tree)
    - [Tree with Sublevels](#tree-with-sublevels)
    - [Multilingual Tree](#multilingual-tree)

---

## Introduction

### About the Plugin

**Table of Contents Page (toc_page)** is a plugin for the **Cotonti** content management system designed to create manageable tables of contents on site pages. It allows building hierarchical menus (trees) consisting of items of various types: links to categories, individual pages, or arbitrary URLs. Items can be manually sorted, assigned parent-child relationships, enabled or disabled, and their titles and URLs can be translated into different languages.

The plugin is especially useful for:

- creating knowledge bases and reference sections;
- navigation menus with manual control;
- hierarchical tables of contents for long guides;
- multilingual navigation structures.

The main feature is complete control over the order and nesting of items, which distinguishes the plugin from automatically generated menus based on category or page structure.

### Features

- **Unlimited number of trees**: multiple independent tables of contents can be created for different site sections.
- **Three item types**:
  - *Category* — link to a Cotonti category;
  - *Page* — link to a specific page;
  - *Custom Link* — any external or internal URL.
- **Manual sorting**: each item is assigned a numeric order within its parent.
- **Hierarchy**: unlimited item nesting.
- **Multilingualism**: translation of titles and URLs into additional languages (when enabled).
- **AJAX page search**: convenient page selection via Select2 instead of a bulky dropdown.
- **Pagination** in the admin panel for working with large trees.
- **Editing item type** after creation.
- **SQL dump generator**: quickly imports a ready-made tree structure from an HTML list.
- **Simple integration**: output a tree with one function in any template.
- **Security**: access rights support, AJAX requests protected.

### Requirements

- **Cotonti** version 1.0 or higher (latest recommended).
- **PHP** 8.5 or higher.
- **MySQL** 8.4 or higher (with InnoDB and utf8mb4 support).
- **Page** module must be enabled (required).
- For multilingualism, the **i18n** plugin is recommended (optional).

---

## Installation and Setup

### Installing the Plugin

1. **Download** the `toc_page` plugin archive.
2. **Extract** the archive into the `plugins/` directory of your Cotonti site. The structure should be:

   ```
   plugins/
   └── toc_page/
       ├── toc_page.setup.php
       ├── toc_page.admin.php
       ├── toc_page.functions.php
       ├── toc_page.ajax.php
       ├── lang/
       │   ├── toc_page.ru.lang.php
       │   ├── toc_page.en.lang.php
       │   └── toc_page.uk.lang.php
       ├── tpl/
       │   ├── toc_page.admin.tpl
       │   └── toc_page.tpl
       └── setup/
           └── toc_page.install.sql
   ```

3. **Log in** to the Cotonti administration panel.
4. Go to **Extensions** → **Plugins**.
5. Find **Table of Contents Page** in the list and click **Install**.
6. After successful installation, the plugin will be activated.

During installation, three database tables will be created:

- `cot_toc_page_trees` — trees (titles, descriptions, timestamps);
- `cot_toc_page_items` — tree items (type, reference, title, URL, sort order, status);
- `cot_toc_page_i18n` — translations of item fields (item_title, item_url, etc.).

> **Note:** If your table prefix is different (e.g., `my_`), replace `cot_` in the SQL file with your prefix before installation. Usually, this can be handled automatically during installation if the system uses a dynamic prefix, but it’s safer to verify.

### Initial Configuration

After installation, go to **Settings** → **Plugins** → **Table of Contents Page**. The following parameters are available:

| Parameter | Description | Default |
|-----------|-------------|---------|
| `default_tree` | Default tree ID. Used when `cot_toc_page_render()` is called without an explicit ID. | 0 |
| `toc_page_i18n_use` | Enable/disable multilingual support. | Off |
| `toc_page_i18n_lang_code_default` | Main site language code (should match `$cfg['defaultlang']`). | ru |
| `toc_page_i18n_lang_code_first` | Code of the first additional language. | en |
| `toc_page_i18n_lang_code_first_use` | Use the first additional language. | On |
| `toc_page_i18n_lang_code_second` | Code of the second additional language. | ua |
| `toc_page_i18n_lang_code_second_use` | Use the second additional language. | Off |
| `toc_page_select2_use` | Use AJAX page search via Select2. | Off |

It is recommended to set `default_tree` after creating your first tree so that the render function works without parameters.

### Multilingual Configuration

1. Enable **“Activate and use multilingual support”**.
2. Set the **main language code** in `toc_page_i18n_lang_code_default`. This should match Cotonti’s global setting `$cfg['defaultlang']`. Item titles in the main table `cot_toc_page_items` are considered original for this language.
3. For each additional language:
   - specify its code (e.g., `en`, `uk`, `de`);
   - enable the **“Use …”** flag.
4. Save the settings.

Now an **“Translations”** tab will appear in the plugin admin panel, where you can enter translations for titles and URLs for each active additional language.

> **Important:** If you already have items, enabling multilingualism will not change their original values; they remain in the main table.

### Select2 Setup

Select2 is an enhanced dropdown with search. The plugin uses it for selecting pages in add/edit item forms.

**How to enable:**

1. In plugin settings, find **“use page search via select2”**.
2. Set to **Yes**.
3. Save.

After that, in the add item form for the “Page” type, the regular `<select>` will be replaced with an autocomplete field. When at least two characters are typed, an AJAX request is sent to the server, which returns a list of matching pages.

Select2 is automatically loaded from Cotonti resources. If you want to adjust the minimum input length, you can change it in the code (`minimumInputLength: 2`) in the files `toc_page.admin.php` (two places: for the tree edit tab and for the item edit tab). The default threshold is 2 characters.

---

## Managing Trees

### Creating a Tree

1. Go to the plugin admin section: **“Other”** → **“Table of Contents Page”**.
2. Open the **“Trees”** tab.
3. At the bottom of the page there is an **“Add Tree”** form:
   - **Tree Title** — required field (e.g., “Knowledge Base”).
   - **Description** — optional brief description (displayed only in admin).
4. Click **“Create”**.

After saving, the tree will appear in the tree list with an assigned ID.

### Editing a Tree

Each tree in the list has an **“Edit”** button (pencil icon). Clicking it opens an editing form directly in the list (Trees tab). Editable fields: title and description. Click **“Update”** to save.

### Deleting a Tree

In the tree list, each tree has a **“Delete”** button. When deleting:

- all items of this tree are removed from `cot_toc_page_items`;
- all translations of these items are removed from `cot_toc_page_i18n` (cascade);
- the tree record is removed from `cot_toc_page_trees`.

Deletion is irreversible — make a database backup beforehand.

### Tree Embed Code

In the **“Paste Code”** column, a ready-made code is automatically generated for each tree, which should be inserted into a page TPL template or PHP code.

Example code:

```html
<!-- IF {PHP|cot_plugin_active('toc_page')} -->
{PHP|cot_toc_page_render(1)}
<!-- ENDIF -->
```

Here `1` is the tree ID. You can copy this code using the **“Copy”** button and paste it where needed.

---

## Managing Items

### Adding an Item

1. Go to the **“Edit Tree”** tab (the “Items” button next to the desired tree in the tree list).
2. At the bottom of the page there is an **“Add Item”** form.
3. Select the **item type**:
   - **Category** — you will need to choose a category from the dropdown.
   - **Page** — you will need to select a page (via a regular list or Select2).
   - **Custom Link** — you will need to enter a URL.
4. Fill in the **title** (if left empty for “Page” or “Category”, the title may be automatically taken from the linked object).
5. Optionally select a **parent** from the list (default — “Top Level”).
6. Click **“Add”**.

The new item will be added to the end of its parent’s list with an automatically calculated sort order (`item_sort`).

### Item Types

#### Category

When selecting this type, you must specify a category from the Cotonti page structure. The category code is saved in the `item_ref` field. When displayed on the site, the link will lead to the category page, and the title (if not set manually) will be taken from the category name.

If the category is later deleted or renamed, the plugin will show the title stored in `item_title`, or display “Category not found”.

#### Page

The “Page” type requires selecting a specific page from the list of published pages (`page_state = 0`). The numeric page ID is stored in `item_ref`. When rendering, the page URL is generated, and the title is taken from the page name or from `item_title`.

When using Select2 AJAX search, you can quickly find the desired page by name.

#### Custom Link

This type allows specifying any external or internal URL (e.g., `https://example.com` or `/some/page`). Nothing is stored in `item_ref`; the URL is placed in `item_url`. The title should be entered manually in the “Title” field.

### Editing an Item

To edit an item, click the **“Edit”** button (pencil icon) in the item row on the “Edit Tree” tab. A separate **“Element”** tab opens with a full editing form.

Here you can change:

- item type;
- linked object (category, page, or URL);
- title;
- parent item;
- sort order;
- status (enabled/disabled).

After saving, you remain on the editing page to see the changes.

### Changing Item Type

Previously, after creating an item, its type could not be changed. In version 1.1.4 this problem is solved: in the item edit form (the “Element” tab) there is a “Type” dropdown. You can freely switch the type between “Category”, “Page”, and “Custom Link”. The corresponding fields for selecting an object will change automatically via JavaScript.

### Sorting and Order

The order of items within the same parent is determined by the number in the `item_sort` field. It is filled automatically when adding an item (maximum value + 1). The order can be changed in two ways:

1. **In the general list** (Edit Tree tab): change the number in the “Order” column and click “Save Changes” at the bottom of the table.
2. **In the item editing form**: in the “Order” field enter the desired number.

It is recommended to use sequential numbers (1, 2, 3...). Items with the same order are sorted by ID.

### Hierarchy and Parent Items

Each item can have a parent selected from the list of all items in the same tree. Top level corresponds to `parent_id = 0`. Nesting is unlimited. When rendered on the site, nested items are automatically placed inside the `<ul>` of the parent item.

In the list of parent items, it is impossible to select the item itself (to avoid cycles) — this is handled in the item edit form.

### Enabling and Disabling

Each item has an “Enabled” flag. If unchecked, the item is not displayed on the site but remains in the database. This is convenient for temporarily hiding menu items without deleting them.

Flag management:

- In the item list table — checkbox in the “Enabled” column.
- In the item edit form — similar checkbox.

### Deleting an Item

To delete an item on the “Edit Tree” tab, click the “Delete” button (red icon). When deleting:

- the item itself is deleted;
- all its child items are deleted recursively;
- all translations of the deleted items are also deleted (cascade due to foreign key).

A confirmation prompt will appear before deletion.

---

## Multilingualism

### Enabling and Configuring Languages

Detailed setup is described in the “Multilingual Configuration” section. To recap:

1. Enable `toc_page_i18n_use`.
2. Set the main language (`toc_page_i18n_lang_code_default`).
3. Enable the needed additional languages (`toc_page_i18n_lang_code_first_use`, etc.) and set their codes.

### Translating Titles and URLs

After enabling multilingualism, the **“Translations”** tab appears in the plugin admin. It is available only if a specific tree is selected (in the tree list). This tab shows a table of all tree items with fields for each active additional language:

- `Title` — translation of the item name;
- `URL` — translation of the link (if needed, for example, for different language versions of pages).

Original values (in the main language) are shown in the “Title” column without editing possibility (they are edited on the “Edit Tree” or “Element” tabs).

To save translations, fill in the needed fields and click “Save Changes”. Empty fields delete the translation (if any), leaving the original for that language.

### How Language Detection Works

The current language detection occurs in the function `toc_page_i18n_get_value()`. Logic:

1. If multilingualism is off — original is returned.
2. The main language is determined from the plugin settings (`toc_page_get_default_lang()`).
3. The current visitor’s language is determined (`Cot::$usr['lang']` or the default if guest).
4. If the current language matches the main language — the original is always returned (translations for the main language are not used).
5. Otherwise, a translation is loaded from `cot_toc_page_i18n` by `item_id`, `field_name`, `lang`. If found, it is returned; otherwise, the original.

Thus, for the main language, original fields are always used, and translations are applied only for additional languages.

### i18n Developer Functions

For developers, the following functions are available in `toc_page.functions.php`:

- `toc_page_i18n_enabled()` — checks if multilingualism is enabled.
- `toc_page_get_active_langs()` — returns an array of active additional language codes.
- `toc_page_get_default_lang()` — returns the main language code.
- `toc_page_i18n_load($itemId, $fieldName, $lang)` — loads a translation.
- `toc_page_i18n_save($itemId, $fieldName, $lang, $value)` — saves/deletes a translation.
- `toc_page_i18n_get_value($itemId, $fieldName, $originalValue)` — returns the value considering translation.

These functions can be used in custom extensions or templates.

---

## Cotonti Integration

### Rendering a Tree on a Page

The plugin provides a simple way to output a tree anywhere on the site. To do this, use the function `cot_toc_page_render($treeId)`.

**Call methods:**

1. **In a TPL template:**

   ```html
   {PHP|cot_toc_page_render(1)}
   ```

   Where `1` is the tree ID.

2. **In PHP code (e.g., in a module or plugin):**

   ```php
   $out = cot_toc_page_render(1);
   ```

   Then pass `$out` to the template.

The function returns ready HTML generated from the `toc_page.tpl` template.

### Function cot_toc_page_render()

Signature:

```php
function cot_toc_page_render($treeId, $tpl = 'toc_page')
```

Parameters:

- `$treeId` — ID of the tree to display.
- `$tpl` — template name (without `.tpl` extension). Default `toc_page`.

The function:

1. Gets all enabled items of the tree via `toc_page_get_tree()`.
2. Calls recursive rendering `toc_page_display()`.
3. Returns HTML.

If the tree is empty or the ID is invalid, an empty string is returned.

### Template toc_page.tpl

The file `toc_page.tpl` (in the `tpl/` folder) controls the tree markup. By default it has the following structure:

```html
<!-- BEGIN: LIST -->
<ul class="toc-page level-{LIST_LEVEL}">
    <!-- BEGIN: ROW -->
    <li class="toc-page-item level-{ROW_LEVEL}">
        <!-- IF {ROW_URL} -->
        <a href="{ROW_URL}">{ROW_TITLE}</a>
        <!-- ELSE -->
        <span class="toc-page-title">{ROW_TITLE}</span>
        <!-- ENDIF -->
        {ROW_ITEMS}
    </li>
    <!-- END: ROW -->
</ul>
<!-- END: LIST -->
```

You can modify this template to fit your design. Available variables:

- `{LIST_LEVEL}` — nesting level of the root list (usually 0);
- `{ROW_LEVEL}` — level of the particular item;
- `{ROW_URL}` — generated link (if any);
- `{ROW_TITLE}` — title (with translation and HTML cleanup);
- `{ROW_ITEMS}` — recursively generated HTML of child items.

### Using in TPL Templates

The most common scenario is to insert a tree into a sidebar or page content. Example:

```html
<div class="block">
    <h3>Knowledge Base</h3>
    {PHP|cot_toc_page_render(1)}
</div>
```

If you need to display different trees on different pages, you can use Cotonti conditional statements or PHP logic in the template.

To have the function available globally in TPL, make sure the plugin is active and the function is registered (this happens automatically when `toc_page.functions.php` is included).

---

## AJAX Page Search (Select2)

### Enabling

To use Select2 for page selection, enable the **“use page search via select2”** option in the plugin settings.

### How It Works

When Select2 is enabled, in the add/edit forms for the “Page” item type, instead of a standard `<select>`, a hidden field and a Select2 element appear. The user types at least 2 characters, after which an AJAX request is sent to the public URL `index.php?r=toc_page&ajax=search&q=...`. The server (file `toc_page.ajax.php`) searches for pages where `page_state = 0` and the title contains the entered substring (case-insensitive). Results are returned in JSON format for Select2.

Access rights are filtered: only administrators can use the search (in the current implementation, the check `cot::$usr['isadmin']` is performed). For non-administrators, access is not provided because AJAX is used only in the admin panel.

### Minimum Length Setting

The minimum input length for the search is set in the JavaScript code in the files `toc_page.admin.php` (two places: the “Edit Tree” tab and the “Edit Element” tab). Find the line:

```js
minimumInputLength: 2,
```

and replace `2` with the desired number. After making the change, save the file and clear the browser cache.

---

## SQL Dump Generator

### Purpose

The `generate_toc_dump.php` script is designed to automatically create an SQL dump of the plugin tables based on an HTML list. This is useful when you need to quickly import a ready-made tree structure (e.g., from an existing static menu) without manually adding items in the admin panel.

### Preparing HTML List

The HTML list must be a valid nested `<ul><li>` list. Rules:

- Each item is an `<li>` that can contain a nested `<ul>`.
- `<nav></nav>` inside `<li>` is ignored (can be omitted).
- HTML entities are automatically converted.
- Do not leave extra spaces between a closing `</li>` and the next `<li>`.

Example:

```html
<ul>
    <li>Parent
        <ul>
            <li>Child 1</li>
            <li>Child 2</li>
        </ul>
    </li>
    <li>Another parent</li>
</ul>
```

### Creating a Dump

1. Open the file `generate_toc_dump.php` in an editor.
2. Insert your HTML into the `$html` variable (between `<<<'HTML'` and `HTML;`).
3. Fill the `$translations` array (if translations are needed), where the key is the original and the value is the translation.
4. Set the tree parameters: `$treeId`, `$treeTitle`, `$treeDescription`.
5. Check the table prefix (default `cot_`). Replace if necessary.
6. Upload the file to the site root via FTP.
7. Run it in a browser: `https://your-domain/generate_toc_dump.php`.
8. The script will create a file `toc_page_dump_YYYYMMDD_HHMMSS.sql` in the site root.
9. Download this file via FTP.

### Importing to Database

1. Log in to phpMyAdmin and select your database.
2. Go to the “Import” tab.
3. Choose the downloaded `.sql` file.
4. Ensure the encoding is utf-8.
5. Click “Import”.

**Important:** During import, the script drops existing `cot_toc_page_*` tables and creates them anew. Make a backup if you already have data.

After import, the tree will appear in the plugin admin.

---

## Advanced Functions

### Data Retrieval Functions

In `toc_page.functions.php`, the following functions are defined:

- **`toc_page_get_tree($treeId)`** — returns a nested array of all enabled items of the tree. Each item contains all table fields plus `children` (array of children).
- **`cot_toc_page_render($treeId, $tpl = 'toc_page')`** — renders the tree according to the template.
- **`toc_page_display($items, $level, $tpl)`** — recursively outputs items. Usually not called directly.

For developers, the multilingual functions described earlier are also available.

### Direct Translation Handling

If you need to programmatically add or retrieve a translation, use:

```php
// Load translation
$translated = toc_page_i18n_load($itemId, 'item_title', 'en');

// Save translation
toc_page_i18n_save($itemId, 'item_title', 'en', 'English title');

// Delete translation (pass null or empty string)
toc_page_i18n_save($itemId, 'item_title', 'en', '');
```

These functions automatically handle insert/update/delete.

---

## Frequently Asked Questions

### Why is the tree not displayed?

- Check that the plugin is activated.
- Ensure the tree ID is correct and the tree contains at least one enabled item.
- Verify that the TPL template uses the correct call `{PHP|cot_toc_page_render(ID)}`.
- Clear the Cotonti cache.
- Make sure items are not disabled (the “Enabled” flag).

### How to change item type?

1. Open the “Edit Tree” tab.
2. Find the desired item and click the “Edit” button.
3. In the opened “Element” tab, change the type in the dropdown.
4. Fill in the corresponding fields (category, page, or URL).
5. Click “Update”.

### How to add a new language?

1. In plugin settings, enable multilingualism.
2. In the additional language field, enter a code (e.g., `de`) and enable the “Use” flag.
3. Save settings.
4. Go to the “Translations” tab and fill in the translations.

A maximum of two additional languages are supported (plus the main one).

### How to remove the plugin?

1. Make a database backup.
2. In Cotonti admin, go to Extensions → Plugins.
3. Find Table of Contents Page and click “Remove”.
4. Optionally delete the plugin files from the `plugins/toc_page` directory.

> **Warning:** When removing the plugin, the `cot_toc_page_*` tables are usually deleted automatically. If **something goes wrong...**, then to completely clean the database, delete them manually via phpMyAdmin or execute the SQL commands `DROP TABLE IF EXISTS ...`.

---

## Examples

### Simple Tree

Suppose you need to create a sidebar menu with three items:

```
- Home
- About Us
- Contacts
```

**Steps:**

1. Create a tree with ID 1.
2. Add three items of type “Custom Link” with URLs: `/`, `/about`, `/contacts`.
3. Set order 1, 2, 3.
4. Insert into template:

```html
<div class="sidebar">
    {PHP|cot_toc_page_render(1)}
</div>
```

### Tree with Sublevels

Structure:

```
- Services
  - Development
  - Design
- Portfolio
  - Websites
  - Logos
```

**Implementation:**

1. Add items “Services” and “Portfolio” as parent items (parent = 0).
2. Add child items by selecting the corresponding parent item in the “Parent” field.
3. Adjust the order.

### Multilingual Tree

Need to display a menu in Russian and English.

1. Enable multilingualism, set the main language to `ru`, additional to `en`.
2. Create items with Russian titles.
3. Go to the “Translations” tab, enter English titles for each item.
4. When visiting the site in English, the titles will automatically be replaced.

If no translation is provided for an item, the Russian original will be displayed.

---

This guide covers the main aspects of working with the Table of Contents Page plugin version 1.1.4. For additional information, refer to **[developer](https://github.com/webitproff)** or the support forum.
