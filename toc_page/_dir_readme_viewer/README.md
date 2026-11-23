
# Table of Contents Plugin for Cotonti

**Plugin code:** toc_page  
**Version:** 1.4.0  
**Date:** **November 22, 2026**  
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
# Table of Contents Page for Cotonti

**A managed table of contents for a Cotonti site: trees made of categories, pages and custom links, with manual sorting, hierarchy, collapsible branches and multilingual support.**

| | |
|---|---|
| Version | **1.4.0** |
| Date | **November 22, 2026** |
| Extension code | `toc_page` |
| Author | webitproff |
| License | BSD |
| Repository | <https://github.com/webitproff/toc_page-cotonti> |

---

<a id="toc-en"></a>

## Table of Contents

- [1. Overview](#s1-en)
  - [1.1. What the plugin does](#s1-1-en)
  - [1.2. How to read this guide](#s1-2-en)
  - [1.3. Features](#s1-3-en)
  - [1.4. Plugin passport](#s1-4-en)
  - [1.5. Requirements](#s1-5-en)
- [2. Quick start](#s2-en)
  - [2.1. Installation](#s2-1-en)
  - [2.2. Creating a tree](#s2-2-en)
  - [2.3. Filling a tree](#s2-3-en)
  - [2.4. Displaying a tree on the site](#s2-4-en)
  - [2.5. What you should see](#s2-5-en)
- [3. Admin panel guide](#s3-en)
  - [3.1. Where the plugin is in the admin panel](#s3-1-en)
  - [3.2. The "Trees" tab](#s3-2-en)
  - [3.3. The "Edit tree" tab](#s3-3-en)
  - [3.4. Editing a single element](#s3-4-en)
  - [3.5. The "Translations" tab](#s3-5-en)
  - [3.6. Plugin settings](#s3-6-en)
  - [3.7. Admin messages](#s3-7-en)
  - [3.8. Access rights](#s3-8-en)
- [4. Business logic: how a tree works on the site](#s4-en)
  - [4.1. Which elements appear in the tree](#s4-1-en)
  - [4.2. How the title and link are determined](#s4-2-en)
  - [4.3. Multilingual behavior on the site](#s4-3-en)
  - [4.4. Branch expansion, remembering state, highlighting the current page](#s4-4-en)
  - [4.5. Multiple trees and multiple instances](#s4-5-en)
  - [4.6. Summary of rules and limitations](#s4-6-en)
  - [4.7. Typical situations and their causes](#s4-7-en)
- [5. Integration and appearance (for developers)](#s5-en)
  - [5.1. The output function](#s5-1-en)
  - [5.2. Output templates](#s5-2-en)
  - [5.3. Template tags](#s5-3-en)
  - [5.4. HTML structure of the collapsible tree](#s5-4-en)
  - [5.5. Customizing appearance with CSS](#s5-5-en)
  - [5.6. A custom template](#s5-6-en)
  - [5.7. How the JavaScript works](#s5-7-en)
- [6. Technical part](#s6-en)
  - [6.1. File structure](#s6-1-en)
  - [6.2. Cotonti hooks](#s6-2-en)
  - [6.3. Database](#s6-3-en)
  - [6.4. Plugin functions](#s6-4-en)
  - [6.5. What happens when `cot_toc_page_render()` is called](#s6-5-en)
  - [6.6. Admin controller: tabs and actions](#s6-6-en)
  - [6.7. AJAX page search](#s6-7-en)
  - [6.8. Loading CSS and JS](#s6-8-en)
  - [6.9. Caching](#s6-9-en)
  - [6.10. Security](#s6-10-en)
  - [6.11. Browser compatibility](#s6-11-en)
- [7. Glossary](#s7-en)
- [8. License and authorship](#s8-en)

---

<a id="s1-en"></a>

## 1. Overview

<a id="s1-1-en"></a>

### 1.1. What the plugin does

The **Table of Contents Page** plugin lets you build a **tree-style table of contents** (a hierarchical menu with collapsible branches) on your site **by hand**, instead of generating it automatically from the category structure.

You decide:

- which items the tree contains;
- whether each item points to a category, a page or an arbitrary address;
- in what order the items appear;
- which item is nested inside which;
- what an item is called (your own title, or the title of the category/page itself);
- which items are temporarily hidden;
- what items are called and where they lead on the site's additional languages.

You can have any number of trees. Each tree has its own number (ID). Any tree can be output in any site template (header, sidebar, article list, article page), and as many times as you like.

<a id="s1-2-en"></a>

### 1.2. How to read this guide

| You are | Read |
|---|---|
| An admin panel user (you fill the trees) | [Section 2 "Quick start"](#s2-en), [Section 3 "Admin panel guide"](#s3-en), [Section 4 "Business logic"](#s4-en) |
| A front-end developer / site administrator | [Section 5 "Integration and appearance"](#s5-en) |
| A developer | [Section 6 "Technical part"](#s6-en) |
| You met an unfamiliar word | [Section 7 "Glossary"](#s7-en) |

<a id="s1-3-en"></a>

### 1.3. Features

- Any number of independent trees (each has its own ID, title and description).
- Three element types: **category**, **page**, **custom link**.
- Unlimited nesting (a parent is chosen for every element).
- Manual sorting within one level (numeric "Order" field).
- Enabling and disabling an element without deleting it.
- Your own item title, or the automatic category/page title.
- Your own item address (overrides the automatic one) for categories and pages.
- Multilingual support: translations of the item title and address for two additional languages.
- Page search via Select2 when adding an element (optional).
- Collapsible branches built on the native HTML `<details>` element, remembering expanded branches in the visitor's browser, highlighting the current page and automatically expanding the path to it.
- Two ready-made output templates: a collapsible tree (`toc_page.tree`) and a plain list (`toc_page`).
- CSS and JS loaded through Cotonti's resource manager (`Resources`).

<a id="s1-4-en"></a>

### 1.4. Plugin passport

| Parameter | Value (from `toc_page.setup.php`) |
|---|---|
| Code | `toc_page` |
| Name | Table of Contents Page |
| Description | "Управляемое оглавление для страниц с ручной сортировкой, иерархией и поддержкой мультиязычности" (managed table of contents for pages with manual sorting, hierarchy and multilingual support) |
| Category | `administration-management` |
| Version | 1.4.0 |
| Date | 2026-11-22 |
| Author | webitproff |
| Requires_modules | `page` |
| Recommends_plugins | `i18n` |
| Auth_guests / Lock_guests | `R` / `W12345A` |
| Auth_members / Lock_members | `R` / `W12345A` |

<a id="s1-5-en"></a>

### 1.5. Requirements

- **Cotonti** CMF version 1.x (the code uses `Cot::$db`, `Resources`, `XTemplate`, `cot_import()` and other Cotonti 0.9.x/1.x APIs).
- The **`page` module** installed and enabled (a mandatory condition, set in `Requires_modules`).
- The **`i18n` plugin** is recommended but not required. It is used only to obtain localized titles of categories and pages (see [4.2](#s4-2-en)). The plugin's own translations (section [3.5](#s3-5-en)) do not depend on the `i18n` plugin.
- To view the site — a modern browser (details in [6.11](#s6-11-en)).

---

<a id="s2-en"></a>

## 2. Quick start

<a id="s2-1-en"></a>

### 2.1. Installation

1. Copy the `toc_page` folder into the site's plugins directory: `plugins/toc_page/`.
2. In the Cotonti admin panel, open the extensions section and install the **Table of Contents Page** plugin. Installation runs the `setup/toc_page.install.sql` file, which creates three tables (see [6.3](#s6-3-en)).
3. Make sure the plugin is enabled.
4. After installation, clear the Cotonti cache.

> Uninstalling runs `setup/toc_page.uninstall.sql` — **all three tables are dropped together with the trees, elements and translations**.

<a id="s2-2-en"></a>

### 2.2. Creating a tree

1. Open the admin panel → the "Other" section → the **Table of Contents Page** plugin (an address like `admin.php?m=other&p=toc_page`).
2. The **"Trees"** tab opens.
3. In the add form, enter the tree **title** (required) and, optionally, a **description**.
4. Click **Create**. A success message appears and the tree shows up in the list.

<a id="s2-3-en"></a>

### 2.3. Filling a tree

1. In the row of the tree you need, go to editing (the **"Edit tree"** tab).
2. In the **"Add element"** form, choose a type:
   - **Category** — choose a `page` module category;
   - **Page** — choose a published page;
   - **Custom link** — enter a title and an address.
3. If needed, set a title, an address and a parent ("Top level" or another element of the same tree).
4. Click **Add**. The element appears at the end of its level.
5. Change titles, parents, order and enabled state in the elements table and save with the **Save changes** button.

<a id="s2-4-en"></a>

### 2.4. Displaying a tree on the site

In the list of trees, every tree has a **ready-made code snippet** shown. It looks like this (the number `1` is the tree ID):

```
<!-- IF {PHP|cot_plugin_active('toc_page')} -->
{PHP|cot_toc_page_render(1, 'toc_page.tree')}
<!-- ENDIF -->
```

Paste this code into the desired place of any `.tpl` template of the site — for example, the page list template, the page template, the header or a sidebar.

<a id="s2-5-en"></a>

### 2.5. What you should see

- A tree with collapsible branches: items that have nested elements show an arrow button on the left; the others show an empty space of the same size.
- Clicking the arrow (or the title of an item without a link) expands or collapses the branch.
- The item whose link matches the address of the current page is highlighted, and all its parent branches are expanded.
- The branches you expand are remembered in the browser and stay expanded the next time the site is opened.

If the tree did not appear, see [4.7 "Typical situations and their causes"](#s4-7-en).

---

<a id="s3-en"></a>

## 3. Admin panel guide

<a id="s3-1-en"></a>

### 3.1. Where the plugin is in the admin panel

Address: `admin.php?m=other&p=toc_page`. The interface consists of tabs. The tab is selected by the `tab` parameter in the address:

| Tab | `tab` parameter | Purpose |
|---|---|---|
| Trees | `trees` (default) | List of trees, creating, renaming, deleting |
| Edit tree | `edit` | Elements of the selected tree: adding, saving, deleting |
| Element | `edit_element` | Editing a single element with all its fields |
| Translations | `i18n` | Translations of element titles and addresses (when multilingual mode is on) |

Tab and button labels in the interface come from the language files (`lang/toc_page.ru.lang.php`, `lang/toc_page.en.lang.php`); the names used in this guide describe their meaning.

If the "Edit tree" or "Translations" tab is opened without a tree specified, the plugin automatically redirects to the tree with the lowest ID. If there are no trees, it redirects to the "Trees" tab.

<a id="s3-2-en"></a>

### 3.2. The "Trees" tab

<a id="s3-2-1-en"></a>

#### 3.2.1. List of trees

For every tree the following is shown: ID, title, description, the **code snippet** for the site (the `TREE_CODE` tag) and actions:

| Action | What it does |
|---|---|
| Elements / editing | Goes to the "Edit tree" tab of this tree |
| Edit | Shows the form for changing the title and description |
| Delete | Deletes the tree (with confirmation) |

> The tree description (`tree_description`) exists only for convenience in the admin panel. It is **not output** on the site.

<a id="s3-2-2-en"></a>

#### 3.2.2. Creating a tree

| Field | Required | Limit |
|---|---|---|
| Tree title | Yes | up to 255 characters |
| Description | No | text |

If the title is empty, the tree is not created. On success the creation time and update time are stored, and a success message is shown.

<a id="s3-2-3-en"></a>

#### 3.2.3. Renaming a tree

The "Edit" button opens a form with the current title and description. A new title is required (an empty title is not saved). On saving, the tree's modification time is updated and a success message is shown. The tree ID does not change, so the snippet on the site stays the same.

<a id="s3-2-4-en"></a>

#### 3.2.4. Deleting a tree

Deletion requires confirmation. The following is deleted **irreversibly**:

1. all translations of this tree's elements;
2. all elements of the tree (at all levels);
3. the tree itself.

After deletion a success message is shown. The snippet of the deleted tree on the site will stop outputting anything (the function returns an empty string).

<a id="s3-3-en"></a>

### 3.3. The "Edit tree" tab

<a id="s3-3-1-en"></a>

#### 3.3.1. Elements table

All elements of the selected tree are shown as a **flat list** (without level indents), sorted by parent and order. Elements are paginated — **20** per page. (The page size is taken from the plugin's `perpage` parameter; there is no such setting in the plugin's settings, so the value 20 is used.)

For every element the following is shown:

| Column | Content |
|---|---|
| Type | `category`, `page` or `custom` |
| Object reference | For a category — its title; for a page — its title; for a custom link — the entered address. If the category or page is not found, the corresponding label from the language file is shown |
| Title | A field for editing the item title |
| Parent | A list: "Top level" and all other elements of this tree (the element itself is absent from the list) |
| Order | A number for sorting within the level |
| Enabled | A checkbox |
| Actions | Edit the element (a separate form), delete the element |

<a id="s3-3-2-en"></a>

#### 3.3.2. What can be changed in the table and how to save

In the table you can change: the **title**, the **parent**, the **order**, the **enabled state**. The **Save changes** button saves the elements shown on the current page. After saving a success message is shown and you stay on the same list page.

Saving rules:

- If an element is chosen as its own parent, the parent is reset to "Top level".
- Order is an integer not less than 0.
- The title is trimmed of leading and trailing spaces. **An empty title is allowed** for categories and pages (then the title of the category/page itself is substituted on the site), see [4.2](#s4-2-en).
- If the "Enabled" checkbox is cleared, the element is disabled.

The other fields (type, object reference, address) are changed in the element form ([3.4](#s3-4-en)).

<a id="s3-3-3-en"></a>

#### 3.3.3. Adding an element

The "Add element" form:

| Field | When used | Note |
|---|---|---|
| Type | Always | Category / Page / Custom link |
| Category | Type "Category" | A list of all `page` module categories |
| Page | Type "Page" | A regular drop-down of all published pages (alphabetical) **or** Select2 search, if enabled in the settings ([3.6](#s3-6-en)) |
| Title | Always, optional | up to 255 characters |
| URL | Always, optional | up to 255 characters; for a category and a page it overrides the automatic address |
| Parent | Always | "Top level" or any element of this tree |

What happens on adding:

- If the type is given incorrectly, `custom` is used.
- For a category the category code is stored, for a page — its numeric ID; for a custom link the "object reference" field stays empty.
- The order of the new element = **the largest order among the elements with the same parent + 1** (0 if there are no elements there yet). That is, the new element goes to the end of its level.
- The new element is enabled.
- A success message is shown and the first page of the list opens.

<a id="s3-3-4-en"></a>

#### 3.3.4. Element types

| Type | Label in the interface | What is stored | Where the title and link come from |
|---|---|---|---|
| `category` | Category | The `page` module category code | Title: yours, if set, otherwise the category title. Link: your URL, if set, otherwise the standard category link |
| `page` | Page | The page ID | Title: yours, if set, otherwise the page title. Link: your URL, if set, otherwise the standard page link |
| `custom` | Custom link | Nothing (only title and URL) | The title and link are yours. If the title is empty and the URL is set, the URL itself is output as the title |

Details and exceptions — in [4.2](#s4-2-en).

<a id="s3-3-5-en"></a>

#### 3.3.5. Deleting an element

Deletion requires confirmation. The following is deleted **irreversibly**: the element itself, **all its descendants at all levels** and all translations of these elements. After deletion a success message is shown and the first page of the list opens.

<a id="s3-3-6-en"></a>

#### 3.3.6. How to build the hierarchy and order

- **Top level** — elements whose parent is "Top level".
- **Nesting** — choose the needed element in the "Parent" field. Nesting is unlimited.
- **Order** — within one parent, elements are output by ascending "Order" number; for equal numbers — by ascending internal element number (creation order). Numbers do not have to be consecutive (you can use 10, 20, 30 to leave room for insertion).
- **Hiding a branch** — disable the parent element: its children stop being output together with it (see [4.1](#s4-1-en)).

> **Caution:** the plugin only checks that an element is not chosen as its own parent. If you choose **your own descendant** as the parent, a closed chain forms, and these elements stop being output on the site, because they cannot be reached from the top level. Fix the parent in the element form.

<a id="s3-4-en"></a>

### 3.4. Editing a single element

Opened by the "Edit" action of an element (`tab=edit_element`). It shows the title of the tree the element belongs to and lets you change **all** fields:

| Field | Description |
|---|---|
| Type | Category / Page / Custom link (the type can be changed) |
| Category | The current one is selected if the type is category |
| Page | The current one is selected if the type is page (list or Select2) |
| Title | up to 255 characters |
| URL | up to 255 characters |
| Parent | All other elements of the same tree and "Top level" (the element itself is absent from the list) |
| Order | An integer not less than 0 |
| Enabled | A checkbox |

After saving a success message is shown and the same form opens. To return to the tree's element list, the form provides a link (`ELEMENT_BACK_URL`).

On saving:

- a type that is not in the list `category` / `page` / `custom` is replaced with `custom`;
- for the "Category" type the selected category code is stored, for "Page" — the page ID, for "Custom link" the object reference is cleared;
- a parent equal to the element itself is reset to "Top level" (cycle checking against descendants is not performed — see the warning in [3.3.6](#s3-3-6-en)).

<a id="s3-5-en"></a>

### 3.5. The "Translations" tab

The tab is for entering item titles and addresses in additional languages. It works when **all** of the following conditions are met:

1. multilingual mode is enabled in the settings (**"Multilingual mode: activate and use"**);
2. at least one additional language (first or second) is enabled, and its code differs from the code of the main language ([3.6](#s3-6-en)).

**What it looks like.** A table of the selected tree's elements (20 per page, the same order as on the edit tab). For every element the type, the object reference and the original title are shown, and for every active additional language — two fields:

| Field | Purpose |
|---|---|
| Title in the language | Translation of the item title |
| URL in the language | The item address for this language (optional) |

**Rules:**

- The save button writes the translations of all elements on the current page. After saving a success message is shown.
- **An empty field deletes** the corresponding translation.
- Only elements of the selected tree are saved.
- For the site's **main language** translations are not entered and not used: in the main language the original is always output.
- Only two fields are translated: title and address (`item_title`, `item_url`).
- The language code in the translations table is stored in a field of **two characters** (`CHAR(2)`), so language codes must be two-letter (for example `ru`, `en`, `ua`).

If multilingual mode is turned off, previously entered translations are **kept** but are not shown on the site.

<a id="s3-6-en"></a>

### 3.6. Plugin settings

Located in the extension settings in the Cotonti admin panel.

| Parameter | Type | Default | Purpose |
|---|---|---|---|
| Default tree ID (`default_tree`) | string | `0` | Used when `cot_toc_page_render()` is called without an ID or with an ID of 0 (or less). The value `0` means "no default tree set" |
| Multilingual mode: activate and use (`toc_page_i18n_use`) | yes/no | no | Enables translations of titles and addresses on the site and the "Translations" tab |
| Main site language code (`toc_page_i18n_lang_code_default`) | string | `ru` | The language of the originals. Must match `$cfg['defaultlang']`. Translations are not used for this language |
| First additional language code (`toc_page_i18n_lang_code_first`) | string | `en` | A two-letter code |
| Use the first additional language (`toc_page_i18n_lang_code_first_use`) | yes/no | yes | Shows this language's fields on the "Translations" tab and applies the translations on the site |
| Second additional language code (`toc_page_i18n_lang_code_second`) | string | `ua` | A two-letter code |
| Use the second additional language (`toc_page_i18n_lang_code_second_use`) | yes/no | no | The same for the second language |
| Use article search via Select2 (`toc_page_select2_use`) | yes/no | no | When adding and editing an element of the "Page" type, AJAX search is used instead of a regular list (see [6.7](#s6-7-en)) |

Notes:

- An additional language is considered active if its "use" checkbox is on, its code is not empty and it **differs** from the main language code.
- In total, the **main language and up to two additional ones** are supported.

<a id="s3-7-en"></a>

### 3.7. Admin messages

After actions, messages are shown. Their texts are taken from the language files `lang/toc_page.ru.lang.php` and `lang/toc_page.en.lang.php` by these keys:

| Event | Language file key |
|---|---|
| Tree created | `toc_page_msg_tree_created` |
| Tree updated | `toc_page_msg_tree_updated` |
| Tree deleted | `toc_page_msg_tree_deleted` |
| Element added | `toc_page_msg_item_added` |
| Table changes saved | `toc_page_msg_items_saved` |
| Element saved (element form) | `toc_page_msg_item_saved` |
| Element deleted | `toc_page_msg_item_deleted` |
| Translations saved | `toc_page_msg_i18n_saved` |

The code also uses the keys `toc_page_top_level` ("Top level"), `toc_page_category_not_found`, `toc_page_page_not_found`, `toc_page_type_category` / `toc_page_type_page` / `toc_page_type_custom` (type labels) and `toc_page_selectpage` (the Select2 field placeholder). See your language files for the exact wording.

<a id="s3-8-en"></a>

### 3.8. Access rights

- Plugin rights in `toc_page.setup.php`: guests and members — **read** (`R`), the other rights are locked (`W12345A`).
- The administrative interface (tabs, creating, editing, deleting) is attached through the administrative "Other" section and is available within access to the Cotonti admin panel.
- The AJAX page search responds **only to administrators**; everyone else gets an empty list of results.

---

<a id="s4-en"></a>

## 4. Business logic: how a tree works on the site

<a id="s4-1-en"></a>

### 4.1. Which elements appear in the tree

On output, the elements of the specified tree are taken **only if their checkbox is enabled**. The tree is built top-down: first the elements whose parent is "Top level", then the children of each are collected, and so on. The order is by the "Order" number (for ties — by element number).

It follows that:

1. **A disabled element is not output, and neither are all its descendants**, even if they are enabled themselves.
2. An element that cannot be reached from the top level (its parent was deleted, is disabled, or forms a closed chain) is not output.
3. If there are no elements at all (the tree is empty, all elements are disabled, or no tree with that ID exists), the output function returns an **empty string** — neither an empty list nor a wrapper appears on the page.
4. An element whose final title turned out to be empty ([4.2](#s4-2-en)) is skipped **together with its descendants**.

<a id="s4-2-en"></a>

### 4.2. How the title and link are determined

For each element, the "Title" and "URL" values are taken first (in an additional language — taking translations into account, see [4.3](#s4-3-en)). Then:

| Type | Condition | Link | Title |
|---|---|---|---|
| Category | The category with the stored code exists in the `page` structure | Your URL, if set; otherwise the standard category link | Your title, if set; otherwise the localized category title (if the `i18n` plugin is active and a translation exists), otherwise the category title |
| Category | The category is not found | No link | Your title, if set; otherwise the element is skipped |
| Page | ID greater than 0, the page exists and is **published** (status `0`) | Your URL, if set; otherwise the standard page link | Your title, if set; otherwise the localized page title (if the `i18n` plugin is active and a translation exists), otherwise the page title |
| Page | The page is not found or not published | No link | Your title, if set; otherwise the element is skipped |
| Custom link | — | Your URL | Your title; if it is empty and the URL is set — the URL itself; if both are empty — the element is skipped |

Notes:

- An **element without a link** is output as plain text (not clickable). If it has nested elements, clicking the title expands or collapses the branch.
- All titles and your URLs are output with special HTML characters escaped.
- For pages and categories the "standard link" is built by Cotonti means (`cot_page_url()` for a page, `cot_url('page', ['c' => code])` for a category), so it respects the site's URL settings.
- If an item address translation is used on the site, it replaces the automatic link (see [4.3](#s4-3-en)).

<a id="s4-3-en"></a>

### 4.3. Multilingual behavior on the site

The rules apply only if the plugin's multilingual mode is enabled.

1. The **visitor's current language** (`Cot::$usr['lang']`) and the **main language** (the "Main site language code" setting; by default — the site's default language) are determined.
2. If the current language **matches** the main one, the original is always used (the element's own "Title" and "URL" fields). Translations are not applied for the main language.
3. If the current language **differs**, a translation for the title and address is looked up in the translations table for that language. A found non-empty translation is used; otherwise the original stays.
4. Then the usual rules from [4.2](#s4-2-en) apply. If the title is still empty after that, for categories and pages the title of the category/page itself is substituted.

A separate feature of the `i18n` plugin (if installed and enabled): localized category and page titles are substituted automatically when the item's own title is empty.

<a id="s4-4-en"></a>

### 4.4. Branch expansion, remembering state, highlighting the current page

The `toc_page.tree` template draws items with nested elements as branches on the HTML `<details>` element, so they can be expanded and collapsed even without JavaScript. The `js/toc_page.js` script adds the following:

| Function | How it works |
|---|---|
| Remembering | The list of IDs of expanded branches is stored in the visitor's browser (`localStorage`) under the key `tocpg:open:<tree ID>`. On the next page load the branches are expanded in the same state. If storage is unavailable, errors are suppressed (there is simply no remembering) |
| Highlighting | The address (path without query parameters, without a trailing `/`, decoded) of every tree link is compared with the current page path. The matching link gets `aria-current="page"` and is highlighted |
| Auto-expansion | All parent branches of the highlighted item are expanded. This state is **not** written to the remembered state |
| Synchronization | If the same tree is output in several places on the page, expanding a branch in one instance is repeated in the others |
| Animation | Switched on after the first state arrangement, so branches do not "slide in" on page load |

Expansion/collapse performed by the script itself (on load or synchronization) is not saved as a user action — only your own clicks are saved.

<a id="s4-5-en"></a>

### 4.5. Multiple trees and multiple instances

- **Different trees** and **the same tree several times** can be output on one page.
- Each call gets its own instance identifier of the form `tocpg-<tree ID>-<call number>` (it is written to the wrapper's `id`).
- Remembering expanded branches is kept **separately for each tree** (by its ID).
- Identical trees on a page synchronize branch expansion.
- CSS and JS are registered **once** per request, no matter how many trees are output.

<a id="s4-6-en"></a>

### 4.6. Summary of rules and limitations

- A disabled element hides its entire branch.
- An element with an empty final title is not output together with its descendants.
- A category/page that does not exist (or an unpublished page) is output as text without a link if your own title is set; otherwise it is skipped.
- The tree description is not output on the site.
- The main language and up to two additional ones are supported; the language code is 2 characters.
- Only the item title and address are translated.
- The plugin does not check nesting for cycles (except "an element is not its own parent").
- Current-page highlighting compares only the address path (query parameters are ignored).
- The list page size in the admin panel is 20 elements.
- In the admin table, elements are shown as a flat list, without level indents.

<a id="s4-7-en"></a>

### 4.7. Typical situations and their causes

| What you observe | Cause by the plugin's logic |
|---|---|
| The tree is not output on the site at all | The plugin is not active (the `cot_plugin_active('toc_page')` condition); a non-existent ID is given; the tree has no elements; all elements are disabled; no ID is passed and no "Default tree ID" is set |
| A whole branch is not output | The parent element is disabled, or the parent has an empty final title, or a closed chain of parents has formed |
| An item is output without a link | The category is not found, or the page is not found/not published; your own title is set |
| An item is not output although it is enabled | The final title is empty (no own title and no category/page), or its parent is not output |
| The English version output is not translated | Multilingual mode is off; the language is not enabled in the settings; no translation is entered for the item (the original is shown then); the current language matches the main one |
| A new item ended up at the bottom of the list | By design: a new element gets the order "maximum on this level + 1" |
| The "Translations" tab / fields are not visible | Multilingual mode is not enabled or no additional language is enabled |
| Current-page highlighting does not work | The path of the item link differs from the path of the current page (query parameters are not taken into account) |

---

<a id="s5-en"></a>

## 5. Integration and appearance (for developers)

<a id="s5-1-en"></a>

### 5.1. The output function

```
cot_toc_page_render($treeId = 0, $tpl = 'toc_page')
```

| Argument | Value |
|---|---|
| `$treeId` | Tree ID. If not greater than 0, the "Default tree ID" setting is used |
| `$tpl` | Template name without `.tpl`: `toc_page.tree` (collapsible tree) or `toc_page` (plain list), or your own |

Returns an HTML string, or an empty string if there is nothing to output.

Call examples in a `.tpl` template:

```
<!-- IF {PHP|cot_plugin_active('toc_page')} -->
{PHP|cot_toc_page_render(1, 'toc_page.tree')}
<!-- ENDIF -->
```

```
{PHP|cot_toc_page_render(2)}   <!-- plain list, default template -->
```

The function can be called any number of times and with different trees.

<a id="s5-2-en"></a>

### 5.2. Output templates

| Template | File | What it outputs |
|---|---|---|
| `toc_page.tree` | `tpl/toc_page.tree.tpl` | A collapsible tree on `<details>` with arrow buttons |
| `toc_page` | `tpl/toc_page.tpl` | A plain nested list of links without collapsing (`ul.tocpg-plain …`; the plugin has no CSS rules for it) |

The template is resolved by the Cotonti function `cot_tplfile($tpl, 'plug')`.

<a id="s5-3-en"></a>

### 5.3. Template tags

A template must contain a `LIST` block with a `ROW` block inside. The template is parsed anew for each nesting level; the nested result is substituted into the parent's `{ROW_ITEMS}` tag.

`LIST` block tags:

| Tag | Value |
|---|---|
| `{LIST_LEVEL}` | List nesting level: 0 for the top one |
| `{IS_ROOT}` | `1` for the top list, `0` for nested ones |
| `{TREE_ID}` | Tree ID |
| `{INSTANCE}` | Instance identifier: `tocpg-<tree ID>-<call number>` |

`ROW` block tags:

| Tag | Value |
|---|---|
| `{ROW_ID}` | Element number |
| `{ROW_TITLE}` | Title (HTML-escaped) |
| `{ROW_URL}` | Link; an empty string if there is no link |
| `{ROW_LEVEL}` | Element level: 0 for the top one |
| `{ROW_LVL}` | An empty string, and for the top level ` tocpg-l0` (with a leading space) |
| `{ROW_HAS_CHILDREN}` | `1` if there are nested elements, otherwise `0` |
| `{ROW_ITEMS}` | Ready HTML of the nested list (empty if there are none) |

<a id="s5-4-en"></a>

### 5.4. HTML structure of the collapsible tree

The `toc_page.tree` template produces the following markup (abridged):

```html
<nav class="tocpg" id="tocpg-1-1" data-tocpg data-tocpg-tree="1" aria-label="Table of contents">
  <ul class="tocpg-list">
    <li class="tocpg-item">
      <!-- an item with nested elements -->
      <details class="tocpg-node" data-id="10">
        <summary class="tocpg-row tocpg-l0">
          <span class="tocpg-chev" aria-hidden="true"><svg>…</svg></span>
          <a href="/…">Title</a>   <!-- or <span class="tocpg-title">…</span> if there is no link -->
        </summary>
        <div class="tocpg-sub">
          <ul class="tocpg-list"> … nested items … </ul>
        </div>
      </details>
    </li>
    <li class="tocpg-item">
      <!-- an item without nested elements -->
      <div class="tocpg-row tocpg-l0"><span class="tocpg-ph"></span><a href="/…">Title</a></div>
    </li>
  </ul>
</nav>
```

The `nav.tocpg` wrapper is output only for the top list (`IS_ROOT = 1`).

<a id="s5-5-en"></a>

### 5.5. Customizing appearance with CSS

All rules in `css/toc_page.css` start with `.tocpg`; there are no global rules. Border, background and line colors are derived from the text color (`currentColor`), so they adapt to light and dark themes automatically.

Variables that can be set from outside (on `.tocpg` or any of its parents):

| Variable | Purpose | Default |
|---|---|---|
| `--tocpg-accent` | Arrow color of an expanded branch | `#27ae60` |
| `--tocpg-current` | Color of the current (highlighted) item and of the focus outline | `var(--bs-link-color, #0d6efd)` for the item, `#0d6efd` for the focus outline |

Example:

```css
.tocpg { --tocpg-accent: #e67e22; --tocpg-current: #c0392b; }
```

Sizes: the arrow button is 24×24 px (32×32 px for the top level), the icon inside is 20 px (28 px at the top level). The nested list is indented and marked with a vertical line.

The expansion animation is defined via `::details-content` and works in browsers that support it; when the visitor has the "reduce motion" mode on (`prefers-reduced-motion`), the animation is disabled.

<a id="s5-6-en"></a>

### 5.6. A custom template

1. Copy `tpl/toc_page.tree.tpl` under a new name, for example `tpl/toc_page.mymenu.tpl`.
2. Keep the `LIST` → `ROW` block structure and use the tags from [5.3](#s5-3-en). For nested levels, be sure to output `{ROW_ITEMS}` inside the proper container.
3. Call: `{PHP|cot_toc_page_render(1, 'toc_page.mymenu')}`.

If you need the plugin's collapsing script and styles, keep the classes and attributes from [5.4](#s5-4-en) in the markup: `[data-tocpg]`, `[data-tocpg-tree]`, `details.tocpg-node[data-id]` — the script works with exactly these.

<a id="s5-7-en"></a>

### 5.7. How the JavaScript works

The `js/toc_page.js` file is a self-invoking function that:

- does nothing if it has already been loaded (the `window.tocpgInit` check);
- on page load (or immediately, if the page is already loaded) processes all `[data-tocpg]` elements, each exactly once;
- attaches **one** `toggle` event handler to the whole document in the capture phase (the `toggle` event does not bubble);
- publishes the `window.tocpgInit()` function — call it if a tree is added to the page dynamically (AJAX, pjax): it will process the new trees.

The script does not use `document.currentScript` and does not look for "the first list on the page", so it does not depend on where the tree is output.

---

<a id="s6-en"></a>

## 6. Technical part

<a id="s6-1-en"></a>

### 6.1. File structure

```
plugins/toc_page/
├── toc_page.setup.php          Extension metadata and settings
├── toc_page.global.php         Global initialization (global hook)
├── toc_page.ajax.php           AJAX page search for Select2 (ajax hook)
├── toc_page.admin.php          Administrative interface (tools hook)
├── setup/
│   ├── toc_page.install.sql    Table creation
│   └── toc_page.uninstall.sql  Table removal
├── inc/
│   └── toc_page.functions.php  Core plugin functions
├── js/
│   └── toc_page.js             Tree behavior
├── css/
│   └── toc_page.css            Tree styles
├── tpl/
│   ├── toc_page.admin.tpl      Admin panel template
│   ├── toc_page.tree.tpl       Template: collapsible tree
│   └── toc_page.tpl            Template: plain list
└── lang/
    ├── toc_page.en.lang.php    English language
    └── toc_page.ru.lang.php    Russian language
```

| File | Purpose |
|---|---|
| `toc_page.setup.php` | The metadata block (`[BEGIN_COT_EXT]`) and the settings block (`[BEGIN_COT_EXT_CONFIG]`) |
| `toc_page.global.php` | Includes the functions file and registers CSS/JS (except in the admin panel) |
| `toc_page.ajax.php` | Returns JSON with a list of pages for Select2; administrators only |
| `toc_page.admin.php` | Admin tabs, handling of forms and actions |
| `inc/toc_page.functions.php` | All plugin functions, DB table registration, language file loading |
| `tpl/toc_page.admin.tpl` | Admin panel markup (tags are assigned in `toc_page.admin.php`) |
| `tpl/toc_page.tree.tpl`, `tpl/toc_page.tpl` | Output templates for the site |
| `lang/*.lang.php` | Interface texts and settings labels |

<a id="s6-2-en"></a>

### 6.2. Cotonti hooks

| File | Hook | When it runs |
|---|---|---|
| `toc_page.global.php` | `global` | On every page load; includes the functions and (outside the admin panel) registers resources |
| `toc_page.admin.php` | `tools` | When `admin.php?m=other&p=toc_page` is opened |
| `toc_page.ajax.php` | `ajax` | On the AJAX page search request (the address is built in `toc_page.admin.php`: `r=toc_page`, `ajax=search`) |

<a id="s6-3-en"></a>

### 6.3. Database

The tables are created by `setup/toc_page.install.sql` (the `CREATE TABLE IF NOT EXISTS` statement, `utf8mb4` charset, `utf8mb4_unicode_ci`, `InnoDB` engine). The file uses the `cot_` prefix; the actual prefix is the one set in your site's database settings.

#### `toc_page_trees` — trees

| Field | Type | Description |
|---|---|---|
| `tree_id` | INT UNSIGNED, AUTO_INCREMENT, PK | Tree ID |
| `tree_title` | VARCHAR(255) | Title |
| `tree_description` | TEXT, NULL | Description (admin panel only) |
| `tree_created` | INT UNSIGNED | Creation time (Unix time) |
| `tree_updated` | INT UNSIGNED | Last modification time |

#### `toc_page_items` — tree elements

| Field | Type | Description |
|---|---|---|
| `item_id` | INT UNSIGNED, AUTO_INCREMENT, PK | Element ID |
| `tree_id` | INT UNSIGNED, index | The tree the element belongs to |
| `parent_id` | INT UNSIGNED, index | Parent element ID; `0` — top level |
| `item_type` | ENUM('category','page','custom') | Element type |
| `item_ref` | VARCHAR(255) | Category code (for `category`), page ID (for `page`), empty (for `custom`) |
| `item_title` | VARCHAR(255) | The item's own title |
| `item_url` | VARCHAR(255) | The item's own address |
| `item_sort` | INT UNSIGNED, index | Order within the level |
| `item_enabled` | TINYINT UNSIGNED | `1` — enabled, `0` — disabled |

#### `toc_page_i18n` — translations

| Field | Type | Description |
|---|---|---|
| `item_id` | INT UNSIGNED | Element |
| `field_name` | VARCHAR(255) | Translated field: `item_title` or `item_url` |
| `lang` | CHAR(2) | Language code (2 characters) |
| `value` | TEXT | Translation value |

Composite primary key: (`item_id`, `field_name`, `lang`). Foreign key `fk_toc_page_i18n_item` on `item_id` referencing `toc_page_items(item_id)` with `ON DELETE CASCADE`. In addition, when deleting trees and elements, the plugin itself explicitly deletes the related translations.

Relations: `toc_page_trees` 1 — N `toc_page_items`; `toc_page_items` 1 — N `toc_page_i18n`; `toc_page_items.parent_id` refers to `toc_page_items.item_id` (logically, without a foreign key).

The `setup/toc_page.uninstall.sql` file drops the tables `toc_page_i18n`, `toc_page_items`, `toc_page_trees` (in that order).

<a id="s6-4-en"></a>

### 6.4. Plugin functions

File `inc/toc_page.functions.php`. When included, it loads the language file and registers the tables (`toc_page_trees`, `toc_page_items`, `toc_page_i18n`) in Cotonti's DB manager.

| Function | Purpose |
|---|---|
| `toc_page_i18n_enabled()` | Whether the plugin's multilingual mode is on |
| `toc_page_get_default_lang()` | Main language code: from the plugin setting, otherwise `$cfg['defaultlang']` |
| `toc_page_get_active_langs()` | Array of active additional languages (up to two, codes that differ from the main one) |
| `toc_page_i18n_load($itemId, $field, $lang)` | A single translation from the DB; `null` if absent or empty |
| `toc_page_i18n_save($itemId, $field, $lang, $value)` | Saves a translation; an empty value deletes the record |
| `toc_page_i18n_map($treeId, $lang)` | All non-empty translations of a tree for a language in one query (cached per request) |
| `toc_page_i18n_get_value($itemId, $field, $original, $treeId = 0)` | A field value taking translation into account per the rules in [4.3](#s4-3-en) |
| `toc_page_get_tree($treeId)` | A nested array of the tree's enabled elements (cached per request) |
| `toc_page_get_pages(array $ids)` | Published pages by ID in one query (cached per request) |
| `toc_page_collect_page_ids(array $items)` | Recursively collects page IDs from the tree |
| `toc_page_register_assets()` | Registers CSS and JS through `Resources` (once per request) |
| `cot_toc_page_render($treeId, $tpl)` | The main output function |
| `toc_page_display($items, $level, $tpl, $treeId, $instance)` | Recursively builds a tree level's HTML from the template |
| `toc_page_i18n_cat_title($catCode)` | Localized category title from the `i18n` plugin (if available) |
| `toc_page_i18n_page_title($pageId)` | Localized page title from the `i18n` plugin (if available) |

<a id="s6-5-en"></a>

### 6.5. What happens when `cot_toc_page_render()` is called

1. The call counter is incremented (it is needed for the instance identifier).
2. `toc_page_register_assets()` is called — CSS and JS are registered (once per request).
3. If `$treeId` is not greater than 0 and the `default_tree` parameter is set, it is used.
4. `toc_page_get_tree()` loads **in one query** all enabled elements of the tree, ordered by `item_sort ASC, item_id ASC`, and builds a nested array starting from `parent_id = 0`. The result is cached for the duration of the request.
5. If the tree is empty, `''` is returned.
6. `toc_page_get_pages()` preloads **in one query** all pages referenced by elements of the `page` type.
7. `toc_page_display()` recursively creates a template object for each level, assigns the level tags, determines the title and link of each element ([4.2](#s4-2-en), [4.3](#s4-3-en)), skips elements with an empty title, assigns the element tags, recursively builds the nested levels and substitutes them into `{ROW_ITEMS}`; then it parses the `LIST.ROW` and `LIST` blocks.
8. The result is returned as a string.

<a id="s6-6-en"></a>

### 6.6. Admin controller: tabs and actions

File `toc_page.admin.php`. Address parameters: `tab` (tab), `tree` (tree ID), `a` (action), `item` / `item_id` (element), `d` (pagination offset).

| Tab | Action `a` | Method | What it does |
|---|---|---|---|
| `trees` | — | GET | List of trees |
| `trees` | `add` | POST | Creates a tree (a non-empty title is required) |
| `trees` | `edit_tree` | GET | Shows the rename form |
| `trees` | `update_tree` | POST | Saves the title and description (a non-empty title is required) |
| `trees` | `delete` | GET (with confirmation) | Deletes the translations, elements and the tree |
| `edit` | — | GET | Elements table (pagination, add form) |
| `edit` | `save` | POST | Saves titles, parents, order, enabled state of the page's elements |
| `edit` | `add_item` | POST | Adds an element |
| `edit` | `delete_item` | GET (with confirmation) | Deletes an element with descendants and translations |
| `edit_element` | — | GET | Single element form |
| `edit_element` | `save_element` | POST | Saves all fields of the element |
| `i18n` | — | GET | Translations table |
| `i18n` | `save_i18n` | POST | Saves translations (an empty value deletes) |

Implementation details:

- Deleting an element walks the descendants breadth-first (a queue), with protection against visiting the same element twice, and deletes translations and elements with one query per table.
- Deleting a tree first deletes the translations of all its elements, then the elements, then the tree.
- After successful actions a redirect (`cot_redirect`) to the corresponding tab is performed.
- The admin template (`tpl/toc_page.admin.tpl`) receives data through tags and blocks assigned in the controller: the blocks `MAIN.TREES_ROW`, `MAIN.EDIT_TREE_FORM`, `MAIN.EDIT_ITEM`, `MAIN.EDIT_EMPTY`, `MAIN.EDIT_ELEMENT_FORM`, `MAIN.I18N_LANG_HEADER`, `MAIN.I18N_ROW` (with the nested `I18N_LANG_FIELDS`), `MAIN.I18N_EMPTY`.
- For the copy-code button/link, each tree is given the `TREE_CODE` tag (the ready snippet using the `toc_page.tree` template).

<a id="s6-7-en"></a>

### 6.7. AJAX page search

Enabled by the "Use article search via Select2" setting. Then, when adding and editing an element of the "Page" type, the Select2 resources (`Resources::SELECT2`) and a search field are included instead of a drop-down list.

The request is built in the admin panel with `cot_url('plug', ['r' => 'toc_page', 'ajax' => 'search', 'current_page_id' => <ID>])`; the search string is passed in the `q` parameter (sent by Select2).

Behavior of `toc_page.ajax.php`:

| Condition | Result |
|---|---|
| The user is not an administrator | `{"results":[]}` |
| The search string is shorter than 2 characters | `{"results":[]}` |
| Otherwise | Up to 50 published pages (`page_state = 0`) whose title contains the string (case-insensitive), by descending page date; the page with ID `current_page_id` is excluded |

The response is JSON of the form `{"results":[{"id":123,"text":"Title"}, …]}` in UTF-8. In the element edit form, `current_page_id` receives the ID of the selected page if the element is of the "Page" type (otherwise 0), so the page already selected is not shown in the search results. The selected value is written to the hidden field `item_ref_page`. The minimum search string length on the field side is 2 characters, and the delay before sending is 300 ms.

<a id="s6-8-en"></a>

### 6.8. Loading CSS and JS

The `toc_page_register_assets()` function:

- runs once per request (a static flag);
- registers `plugins/toc_page/css/toc_page.css` via `Resources::linkFile()`;
- registers `plugins/toc_page/js/toc_page.js` via `Resources::linkFileFooter()` (page footer);
- registers each file **only if it exists and is readable**.

It is called from two places:

1. `cot_toc_page_render()` — on every tree output;
2. `toc_page.global.php` — on every page except the admin panel (the `COT_ADMIN` constant is defined). This is so that a tree output in the header or another place that is parsed after `<head>` has already been built also receives the styles and the script.

<a id="s6-9-en"></a>

### 6.9. Caching

There is no persistent cache. For the duration of a single request the following are cached (static function variables): the element tree by ID, pages by ID, the tree's translations by the "tree + language" pair, the resource registration flag, and the call counter. The branch expansion state is stored in the visitor's browser (`localStorage`) and is not stored on the server.

<a id="s6-10-en"></a>

### 6.10. Security

- Values from forms and the address are imported via `cot_import()` with a specified type (`TXT`, `INT`, `ALP`, `BOL`, `ARR`); numeric parameters are cast to `int`.
- Database queries are executed with parameters (`?`).
- Titles and addresses output on the site and in the admin panel are escaped via `htmlspecialchars()`.
- Deleting trees and elements is done through links with confirmation (`cot_confirm_url()`).
- The element type is limited to the list `category` / `page` / `custom`.
- The AJAX search returns data only to administrators.
- Saving translations is performed only for elements of the selected tree.
- The script on the site makes no network requests; the only storage is `localStorage` in the visitor's browser.

<a id="s6-11-en"></a>

### 6.11. Browser compatibility

The script and styles use standard browser features: the `<details>/<summary>` element, `localStorage`, `URL`, `Element.closest`. Specifics:

- Expanding and collapsing work thanks to the native `<details>`, including with JavaScript disabled. Remembering, highlighting the current page and tree synchronization require JavaScript.
- For colors with `color-mix()`, the CSS provides fallback values (`rgba(...)`) for browsers without support for it.
- The smooth expansion animation uses `::details-content` and `interpolate-size`; in browsers without support for them, branches expand without animation.

---

<a id="s7-en"></a>

## 7. Glossary

| Term | Meaning |
|---|---|
| **Tree** | A standalone table of contents with its own ID, title and set of elements. Output on the site by calling `cot_toc_page_render(ID, …)` |
| **Element (item)** | One row of the tree: a category, a page or a custom link |
| **Element type** | `category`, `page` or `custom` |
| **Parent** | The element inside which the given one is nested. "Top level" (`parent_id = 0`) — an element without a parent |
| **Descendants** | All elements nested in the given one at any depth |
| **Order (`item_sort`)** | A number by which elements are sorted within one parent |
| **Enabled / disabled** | A checkbox for the element's visibility on the site. Disabling hides the element together with its descendants |
| **Branch** | An element with nested elements that can be expanded or collapsed |
| **Object reference (`item_ref`)** | The category code or page ID the element is bound to |
| **Element URL** | An optional own address; overrides the automatic one |
| **Category** | A section of the Cotonti `page` module (the category code is stored in the `page` structure) |
| **Published page** | A `page` module page with status `0` (`page_state = 0`) |
| **Main language** | The language in which the original titles are entered; translations are not used for it |
| **Additional language** | A language for which translations of titles and addresses can be entered (up to two) |
| **Multilingual mode** | A mode in which translations of element titles and addresses are applied on the site |
| **Select2** | A drop-down search library; in the plugin it is used for searching pages by title |
| **AJAX** | A request to the server without reloading the page (used for page search in the admin panel) |
| **Hook** | A Cotonti extension point at which a plugin file is attached (`global`, `ajax`, `tools`) |
| **Resources** | Cotonti's manager of included CSS/JS |
| **XTemplate / `.tpl`** | Cotonti's template engine and template files |
| **`cot_tplfile()`** | A Cotonti function that determines a template file by name |
| **Instance** | One specific output of a tree on a page. The same tree ID can be output by several instances |
| **`<details>` / `<summary>`** | Standard HTML elements of a collapsible block and its heading; the tree branches are built on them |
| **`localStorage`** | Storage in the visitor's browser; the set of expanded branches is remembered in it |
| **`aria-current="page"`** | An accessibility attribute marking the link to the current page |
| **`currentColor`** | The CSS value "text color"; borders, backgrounds and lines of the tree are derived from it |
| **ID** | The numeric number of a tree or element |
| **DB prefix** | The beginning of table names set by the site settings (written as `cot_` in the plugin's SQL) |

---

<a id="s8-en"></a>

## 8. License and authorship

- License: **BSD** (free distribution with preservation of attribution).
- Author: **webitproff** — <https://github.com/webitproff>
- Copyright © webitproff 2026
- Source code and updates: <https://github.com/webitproff/toc_page-cotonti>

[Back to table of contents](#toc-en)

---  
> RU
---  


# Table of Contents Page для Cotonti

**Управляемое оглавление для сайта на Cotonti: деревья из категорий, страниц и произвольных ссылок с ручной сортировкой, иерархией, сворачиванием веток и мультиязычностью.**

| | |
|---|---|
| Версия | **1.4.0** |
| Дата | **22 ноября 2026** |
| Код расширения | `toc_page` |
| Автор | webitproff |
| Лицензия | BSD |
| Репозиторий | <https://github.com/webitproff/toc_page-cotonti> |

---

<a id="toc"></a>

## Оглавление

- [1. Обзор](#s1)
  - [1.1. Что делает плагин](#s1-1)
  - [1.2. Как читать это руководство](#s1-2)
  - [1.3. Возможности](#s1-3)
  - [1.4. Паспорт плагина](#s1-4)
  - [1.5. Требования](#s1-5)
- [2. Быстрый старт](#s2)
  - [2.1. Установка](#s2-1)
  - [2.2. Создание дерева](#s2-2)
  - [2.3. Наполнение дерева](#s2-3)
  - [2.4. Вывод дерева на сайте](#s2-4)
  - [2.5. Что вы должны увидеть](#s2-5)
- [3. Руководство по админ-панели](#s3)
  - [3.1. Где находится плагин в админке](#s3-1)
  - [3.2. Вкладка «Деревья»](#s3-2)
  - [3.3. Вкладка «Редактирование дерева»](#s3-3)
  - [3.4. Редактирование одного элемента](#s3-4)
  - [3.5. Вкладка «Переводы»](#s3-5)
  - [3.6. Настройки плагина](#s3-6)
  - [3.7. Сообщения админки](#s3-7)
  - [3.8. Права доступа](#s3-8)
- [4. Бизнес-логика: как дерево работает на сайте](#s4)
  - [4.1. Какие элементы попадают в дерево](#s4-1)
  - [4.2. Как определяются заголовок и ссылка](#s4-2)
  - [4.3. Мультиязычность на сайте](#s4-3)
  - [4.4. Раскрытие веток, запоминание, подсветка текущей страницы](#s4-4)
  - [4.5. Несколько деревьев и несколько экземпляров](#s4-5)
  - [4.6. Сводка правил и ограничений](#s4-6)
  - [4.7. Типичные ситуации и их причины](#s4-7)
- [5. Подключение и настройка внешнего вида (для разработчиков)](#s5)
  - [5.1. Функция вывода](#s5-1)
  - [5.2. Шаблоны вывода](#s5-2)
  - [5.3. Теги шаблона](#s5-3)
  - [5.4. HTML-структура сворачиваемого дерева](#s5-4)
  - [5.5. Настройка внешнего вида через CSS](#s5-5)
  - [5.6. Собственный шаблон](#s5-6)
  - [5.7. Работа JavaScript](#s5-7)
- [6. Техническая часть](#s6)
  - [6.1. Структура файлов](#s6-1)
  - [6.2. Хуки Cotonti](#s6-2)
  - [6.3. База данных](#s6-3)
  - [6.4. Функции плагина](#s6-4)
  - [6.5. Что происходит при вызове `cot_toc_page_render()`](#s6-5)
  - [6.6. Контроллер админ-панели: вкладки и действия](#s6-6)
  - [6.7. AJAX-поиск страниц](#s6-7)
  - [6.8. Подключение CSS и JS](#s6-8)
  - [6.9. Кэширование](#s6-9)
  - [6.10. Безопасность](#s6-10)
  - [6.11. Совместимость с браузерами](#s6-11)
- [7. Глоссарий](#s7)
- [8. Лицензия и авторство](#s8)

---

<a id="s1"></a>

## 1. Обзор

<a id="s1-1"></a>

### 1.1. Что делает плагин

Плагин **Table of Contents Page** позволяет собрать на сайте **оглавление-дерево** (иерархическое меню со сворачиваемыми ветками) вручную, а не автоматически по структуре категорий.

Вы сами решаете:

- какие пункты есть в дереве;
- на какие категории, страницы или произвольные адреса они ведут;
- в каком порядке они идут;
- какой пункт вложен в какой;
- как пункт называется (своё название либо название самой категории/страницы);
- какие пункты временно скрыты;
- как пункты называются и куда ведут на дополнительных языках сайта.

Деревьев может быть сколько угодно. Каждое дерево имеет свой номер (ID). Любое дерево можно вывести в любом шаблоне сайта (в шапке, боковой колонке, в списке статей, на странице статьи) и сколько угодно раз.

<a id="s1-2"></a>

### 1.2. Как читать это руководство

| Вы | Читайте |
|---|---|
| Пользователь админ-панели (наполняете деревья) | [Раздел 2 «Быстрый старт»](#s2), [Раздел 3 «Руководство по админ-панели»](#s3), [Раздел 4 «Бизнес-логика»](#s4) |
| Верстальщик / администратор сайта | [Раздел 5 «Подключение и внешний вид»](#s5) |
| Разработчик | [Раздел 6 «Техническая часть»](#s6) |
| Встретили незнакомое слово | [Раздел 7 «Глоссарий»](#s7) |

<a id="s1-3"></a>

### 1.3. Возможности

- Любое количество независимых деревьев (у каждого свой ID, название и описание).
- Три типа элементов: **категория**, **страница**, **произвольная ссылка**.
- Неограниченная вложенность (родитель выбирается для каждого элемента).
- Ручная сортировка внутри одного уровня (числовое поле «Порядок»).
- Включение и отключение элемента без удаления.
- Своё название пункта или автоматическое название категории/страницы.
- Свой адрес пункта (переопределяет автоматический) для категорий и страниц.
- Мультиязычность: переводы названия и адреса пункта для двух дополнительных языков.
- Поиск страниц при добавлении элемента через Select2 (необязательно).
- Сворачиваемые ветки на нативном HTML-элементе `<details>`, запоминание раскрытых веток в браузере посетителя, подсветка текущей страницы и автоматическое раскрытие пути к ней.
- Два готовых шаблона вывода: сворачиваемое дерево (`toc_page.tree`) и простой список (`toc_page`).
- Загрузка CSS и JS через менеджер ресурсов Cotonti (`Resources`).

<a id="s1-4"></a>

### 1.4. Паспорт плагина

| Параметр | Значение (из `toc_page.setup.php`) |
|---|---|
| Code | `toc_page` |
| Name | Table of Contents Page |
| Description | Управляемое оглавление для страниц с ручной сортировкой, иерархией и поддержкой мультиязычности |
| Category | `administration-management` |
| Version | 1.4.0 |
| Date | 2026-11-22 |
| Author | webitproff |
| Requires_modules | `page` |
| Recommends_plugins | `i18n` |
| Auth_guests / Lock_guests | `R` / `W12345A` |
| Auth_members / Lock_members | `R` / `W12345A` |

<a id="s1-5"></a>

### 1.5. Требования

- CMF **Cotonti** версии 1.x (код использует `Cot::$db`, `Resources`, `XTemplate`, `cot_import()` и другие API Cotonti 0.9.x/1.x).
- Установленный и включённый **модуль `page`** (обязательное условие, указано в `Requires_modules`).
- Плагин **`i18n`** — рекомендуется, но не обязателен. Он используется только для получения локализованных названий категорий и страниц (см. [4.2](#s4-2)). Собственные переводы плагина (раздел [3.5](#s3-5)) от плагина `i18n` не зависят.
- Для просмотра на сайте — современный браузер (подробности в [6.11](#s6-11)).

---

<a id="s2"></a>

## 2. Быстрый старт

<a id="s2-1"></a>

### 2.1. Установка

1. Скопируйте папку `toc_page` в каталог плагинов сайта: `plugins/toc_page/`.
2. В админ-панели Cotonti откройте раздел расширений и установите плагин **Table of Contents Page**. При установке выполняется файл `setup/toc_page.install.sql`, который создаёт три таблицы (см. [6.3](#s6-3)).
3. Убедитесь, что плагин включён.
4. После установки очистите кэш Cotonti.

> Удаление плагина выполняет `setup/toc_page.uninstall.sql` — **все три таблицы удаляются вместе с деревьями, элементами и переводами**.

<a id="s2-2"></a>

### 2.2. Создание дерева

1. Откройте админ-панель → раздел «Другое» (Other) → плагин **Table of Contents Page** (адрес вида `admin.php?m=other&p=toc_page`).
2. Откроется вкладка **«Деревья»**.
3. В форме добавления укажите **название** дерева (обязательно) и, при желании, **описание**.
4. Нажмите **«Создать»**. Появится сообщение об успешном создании, дерево появится в списке.

<a id="s2-3"></a>

### 2.3. Наполнение дерева

1. В строке нужного дерева перейдите к редактированию (вкладка **«Редактирование дерева»**).
2. В форме **«Добавить элемент»** выберите тип:
   - **Категория** — выберите категорию модуля `page`;
   - **Страница** — выберите опубликованную страницу;
   - **Произвольная ссылка** — укажите название и адрес.
3. При необходимости задайте название, адрес и родителя («Верхний уровень» или другой элемент этого же дерева).
4. Нажмите **«Добавить»**. Элемент появится в конце своего уровня.
5. Меняйте названия, родителей, порядок и включённость в таблице элементов и сохраняйте кнопкой **«Сохранить изменения»**.

<a id="s2-4"></a>

### 2.4. Вывод дерева на сайте

В списке деревьев для каждого дерева показан **готовый код для вставки**. Он выглядит так (число `1` — это ID дерева):

```
<!-- IF {PHP|cot_plugin_active('toc_page')} -->
{PHP|cot_toc_page_render(1, 'toc_page.tree')}
<!-- ENDIF -->
```

Вставьте этот код в нужное место любого `.tpl`-шаблона сайта — например, в шаблон списка страниц, шаблон страницы, шапку или боковую колонку.

<a id="s2-5"></a>

### 2.5. Что вы должны увидеть

- Дерево с сворачиваемыми ветками: у пунктов с вложенными элементами слева есть кнопка-стрелка, у остальных — пустое место того же размера.
- Клик по стрелке (или по названию пункта без ссылки) раскрывает или сворачивает ветку.
- Пункт, ссылка которого совпадает с адресом текущей страницы, выделяется, а все его родительские ветки раскрываются.
- Раскрытые вами ветки запоминаются в браузере и при следующем открытии сайта остаются раскрытыми.

Если дерево не появилось, см. [4.7 «Типичные ситуации и их причины»](#s4-7).

---

<a id="s3"></a>

## 3. Руководство по админ-панели

<a id="s3-1"></a>

### 3.1. Где находится плагин в админке

Адрес: `admin.php?m=other&p=toc_page`. Интерфейс состоит из вкладок. Выбор вкладки определяется параметром `tab` в адресе:

| Вкладка | Параметр `tab` | Назначение |
|---|---|---|
| Деревья | `trees` (по умолчанию) | Список деревьев, создание, переименование, удаление |
| Редактирование дерева | `edit` | Элементы выбранного дерева, их добавление, сохранение, удаление |
| Элемент | `edit_element` | Редактирование одного элемента со всеми полями |
| Переводы | `i18n` | Переводы названий и адресов элементов (при включённой мультиязычности) |

Если открыта вкладка «Редактирование дерева» или «Переводы», а дерево не указано, плагин автоматически перенаправляет на дерево с наименьшим ID. Если деревьев нет — на вкладку «Деревья».

<a id="s3-2"></a>

### 3.2. Вкладка «Деревья»

<a id="s3-2-1"></a>

#### 3.2.1. Список деревьев

Для каждого дерева отображаются: ID, название, описание, **код для вставки** на сайт (тег `TREE_CODE`) и действия:

| Действие | Что делает |
|---|---|
| Элементы / редактирование | Переход на вкладку «Редактирование дерева» этого дерева |
| Изменить | Показывает форму изменения названия и описания |
| Удалить | Удаляет дерево (с подтверждением) |

> Описание дерева (`tree_description`) нужно только для удобства в админ-панели. На сайте оно **не выводится**.

<a id="s3-2-2"></a>

#### 3.2.2. Создание дерева

| Поле | Обязательное | Ограничение |
|---|---|---|
| Название дерева | Да | до 255 символов |
| Описание | Нет | текст |

Если название пустое, дерево не создаётся. При успешном создании сохраняются время создания и время обновления, показывается сообщение об успехе.

<a id="s3-2-3"></a>

#### 3.2.3. Переименование дерева

Кнопка «Изменить» открывает форму с текущими названием и описанием. Новое название обязательно (пустое название не сохраняется). При сохранении обновляется время изменения дерева и показывается сообщение об успехе. ID дерева не меняется, поэтому код вставки на сайте остаётся прежним.

<a id="s3-2-4"></a>

#### 3.2.4. Удаление дерева

Удаление требует подтверждения. Удаляются **безвозвратно**:

1. все переводы элементов этого дерева;
2. все элементы дерева (на всех уровнях);
3. само дерево.

После удаления показывается сообщение об успехе. Код вставки удалённого дерева на сайте перестанет выводить что-либо (функция вернёт пустую строку).

<a id="s3-3"></a>

### 3.3. Вкладка «Редактирование дерева»

<a id="s3-3-1"></a>

#### 3.3.1. Таблица элементов

Все элементы выбранного дерева показываются **плоским списком** (без отступов по уровням), отсортированным по родителю и порядку. Элементы выводятся постранично — по **20** на страницу. (Размер страницы берётся из параметра `perpage` плагина; в настройках плагина такого параметра нет, поэтому используется значение 20.)

Для каждого элемента показано:

| Колонка | Содержимое |
|---|---|
| Тип | `category`, `page` или `custom` |
| Ссылка на объект | Для категории — её название; для страницы — её заголовок; для произвольной ссылки — введённый адрес. Если категория или страница не найдена, показывается соответствующая подпись из языкового файла |
| Заголовок | Поле для редактирования названия пункта |
| Родитель | Список: «Верхний уровень» и все остальные элементы этого дерева (сам элемент в списке отсутствует) |
| Порядок | Число для сортировки внутри уровня |
| Включено | Флажок |
| Действия | Редактировать элемент (отдельная форма), удалить элемент |

<a id="s3-3-2"></a>

#### 3.3.2. Что можно менять в таблице и как сохранять

В таблице можно менять: **заголовок**, **родителя**, **порядок**, **включённость**. Кнопка **«Сохранить изменения»** сохраняет элементы, показанные на текущей странице. После сохранения выводится сообщение об успехе, вы остаётесь на той же странице списка.

Правила при сохранении:

- Если элемент выбран родителем сам себе, родитель сбрасывается на «Верхний уровень».
- Порядок — целое число не меньше 0.
- Название очищается от пробелов по краям. **Пустое название допустимо** для категорий и страниц (тогда на сайте подставится название самой категории/страницы), см. [4.2](#s4-2).
- Если флажок «Включено» снят, элемент отключается.

Остальные поля (тип, ссылка на объект, адрес) меняются в форме элемента ([3.4](#s3-4)).

<a id="s3-3-3"></a>

#### 3.3.3. Добавление элемента

Форма «Добавить элемент»:

| Поле | Когда используется | Примечание |
|---|---|---|
| Тип | Всегда | Категория / Страница / Произвольная ссылка |
| Категория | Тип «Категория» | Список всех категорий модуля `page` |
| Страница | Тип «Страница» | Обычный выпадающий список всех опубликованных страниц (по алфавиту) **или** поиск Select2, если он включён в настройках ([3.6](#s3-6)) |
| Заголовок | Всегда, необязательно | до 255 символов |
| URL | Всегда, необязательно | до 255 символов; для категории и страницы переопределяет автоматический адрес |
| Родитель | Всегда | «Верхний уровень» или любой элемент этого дерева |

Что происходит при добавлении:

- Если тип указан некорректно, используется `custom`.
- Для категории сохраняется код категории, для страницы — её числовой ID, для произвольной ссылки поле «ссылка на объект» остаётся пустым.
- Порядок нового элемента = **наибольший порядок среди элементов с тем же родителем + 1** (если там ещё нет элементов — 0). То есть новый элемент встаёт в конец своего уровня.
- Новый элемент включён.
- Показывается сообщение об успехе, открывается первая страница списка.

<a id="s3-3-4"></a>

#### 3.3.4. Типы элементов

| Тип | Подпись в интерфейсе | Что хранится | Откуда берутся заголовок и ссылка |
|---|---|---|---|
| `category` | Категория | Код категории модуля `page` | Заголовок: ваш, если задан, иначе название категории. Ссылка: ваш URL, если задан, иначе стандартная ссылка на категорию |
| `page` | Страница | ID страницы | Заголовок: ваш, если задан, иначе заголовок страницы. Ссылка: ваш URL, если задан, иначе стандартная ссылка на страницу |
| `custom` | Произвольная ссылка | Ничего (только заголовок и URL) | Заголовок и ссылка — ваши. Если заголовок пуст, а URL задан, в качестве заголовка выводится сам URL |

Подробности и исключения — в [4.2](#s4-2).

<a id="s3-3-5"></a>

#### 3.3.5. Удаление элемента

Удаление требует подтверждения. Удаляются **безвозвратно**: сам элемент, **все его потомки на всех уровнях** и все переводы этих элементов. После удаления показывается сообщение об успехе, открывается первая страница списка.

<a id="s3-3-6"></a>

#### 3.3.6. Как построить иерархию и порядок

- **Верхний уровень** — элементы с родителем «Верхний уровень».
- **Вложенность** — выберите в поле «Родитель» нужный элемент. Вложенность не ограничена.
- **Порядок** — внутри одного родителя элементы выводятся по возрастанию числа «Порядок»; при равных числах — по возрастанию внутреннего номера элемента (порядка создания). Числа не обязаны идти подряд (можно 10, 20, 30, чтобы оставить место для вставки).
- **Скрыть ветку** — отключите родительский элемент: дочерние перестанут выводиться вместе с ним (см. [4.1](#s4-1)).

> **Осторожно:** плагин проверяет только, что элемент не выбран родителем самого себя. Если выбрать родителем **своего собственного потомка**, образуется замкнутая цепочка, и эти элементы перестанут выводиться на сайте, так как до них нельзя дойти от верхнего уровня. Исправьте родителя в форме элемента.

<a id="s3-4"></a>

### 3.4. Редактирование одного элемента

Открывается по действию «Редактировать» у элемента (`tab=edit_element`). Показывает название дерева, которому принадлежит элемент, и позволяет менять **все** поля:

| Поле | Описание |
|---|---|
| Тип | Категория / Страница / Произвольная ссылка (можно сменить тип) |
| Категория | Выбрана текущая, если тип — категория |
| Страница | Выбрана текущая, если тип — страница (список или Select2) |
| Заголовок | до 255 символов |
| URL | до 255 символов |
| Родитель | Все остальные элементы того же дерева и «Верхний уровень» (сам элемент в списке отсутствует) |
| Порядок | Целое число не меньше 0 |
| Включено | Флажок |

После сохранения показывается сообщение об успехе, открывается эта же форма. Для возврата к списку элементов дерева в форме предусмотрена ссылка (`ELEMENT_BACK_URL`).

При сохранении:

- тип, не входящий в список `category` / `page` / `custom`, заменяется на `custom`;
- для типа «Категория» сохраняется выбранный код категории, для «Страница» — ID страницы, для «Произвольная ссылка» ссылка на объект очищается;
- родитель, равный самому элементу, сбрасывается на «Верхний уровень» (проверка циклов с потомками не выполняется — см. предупреждение в [3.3.6](#s3-3-6)).

<a id="s3-5"></a>

### 3.5. Вкладка «Переводы»

Вкладка предназначена для ввода названий и адресов пунктов на дополнительных языках. Она работает при выполнении **всех** условий:

1. в настройках включена мультиязычность (**«Мультиязычность активировать и использовать»**);
2. включён хотя бы один дополнительный язык (первый или второй), и его код отличается от кода основного языка ([3.6](#s3-6)).

**Как это выглядит.** Таблица элементов выбранного дерева (по 20 на страницу, тот же порядок, что на вкладке редактирования). Для каждого элемента показаны тип, ссылка на объект и оригинальный заголовок, а для каждого активного дополнительного языка — два поля:

| Поле | Назначение |
|---|---|
| Заголовок на языке | Перевод названия пункта |
| URL на языке | Адрес пункта для этого языка (необязательно) |

**Правила:**

- Кнопка сохранения записывает переводы всех элементов на текущей странице. После сохранения показывается сообщение об успехе.
- **Пустое поле удаляет** соответствующий перевод.
- Сохраняются только элементы выбранного дерева.
- Для **основного языка** сайта переводы не вводятся и не используются: на основном языке всегда выводится оригинал.
- Переводятся только два поля: название и адрес (`item_title`, `item_url`).
- Код языка в таблице переводов хранится в поле из **двух символов** (`CHAR(2)`), поэтому коды языков должны быть двухбуквенными (например, `ru`, `en`, `ua`).

Если мультиязычность отключена, ранее введённые переводы **сохраняются**, но на сайте не показываются.

<a id="s3-6"></a>

### 3.6. Настройки плагина

Находятся в настройках расширения в админ-панели Cotonti.

| Параметр | Тип | По умолчанию | Назначение |
|---|---|---|---|
| ID дерева по умолчанию (`default_tree`) | строка | `0` | Используется, когда `cot_toc_page_render()` вызвана без ID или с ID 0 (и меньше). Значение `0` — «дерево по умолчанию не задано» |
| Мультиязычность активировать и использовать (`toc_page_i18n_use`) | да/нет | нет | Включает переводы названий и адресов на сайте и вкладку «Переводы» |
| Код основного языка сайта (`toc_page_i18n_lang_code_default`) | строка | `ru` | Язык оригиналов. Должен совпадать с `$cfg['defaultlang']`. Для этого языка переводы не используются |
| Код первого дополнительного языка (`toc_page_i18n_lang_code_first`) | строка | `en` | Двухбуквенный код |
| Использовать первый дополнительный язык (`toc_page_i18n_lang_code_first_use`) | да/нет | да | Показывает поля этого языка на вкладке «Переводы» и применяет переводы на сайте |
| Код второго дополнительного языка (`toc_page_i18n_lang_code_second`) | строка | `ua` | Двухбуквенный код |
| Использовать второй дополнительный язык (`toc_page_i18n_lang_code_second_use`) | да/нет | нет | То же для второго языка |
| Использовать поиск статей через Select2 (`toc_page_select2_use`) | да/нет | нет | При добавлении и редактировании элемента типа «Страница» вместо обычного списка используется AJAX-поиск (см. [6.7](#s6-7)) |

Замечания:

- Дополнительный язык считается активным, если его флажок «использовать» включён, код не пуст и **отличается** от кода основного языка.
- Всего поддерживается **основной язык и до двух дополнительных**.

<a id="s3-7"></a>

### 3.7. Сообщения админки

После действий показываются сообщения. Их тексты берутся из языковых файлов `lang/toc_page.ru.lang.php` и `lang/toc_page.en.lang.php` по ключам:

| Событие | Ключ языкового файла |
|---|---|
| Дерево создано | `toc_page_msg_tree_created` |
| Дерево обновлено | `toc_page_msg_tree_updated` |
| Дерево удалено | `toc_page_msg_tree_deleted` |
| Элемент добавлен | `toc_page_msg_item_added` |
| Изменения в таблице сохранены | `toc_page_msg_items_saved` |
| Элемент сохранён (форма элемента) | `toc_page_msg_item_saved` |
| Элемент удалён | `toc_page_msg_item_deleted` |
| Переводы сохранены | `toc_page_msg_i18n_saved` |

В коде также используются ключи `toc_page_top_level` («Верхний уровень»), `toc_page_category_not_found`, `toc_page_page_not_found`, `toc_page_type_category` / `toc_page_type_page` / `toc_page_type_custom` (подписи типов) и `toc_page_selectpage` (подсказка поля Select2). Точные формулировки смотрите в своих языковых файлах.

<a id="s3-8"></a>

### 3.8. Права доступа

- Права плагина в `toc_page.setup.php`: гости и участники — **чтение** (`R`), остальные права заблокированы (`W12345A`).
- Административный интерфейс (вкладки, создание, редактирование, удаление) подключается через административный раздел «Другое» и доступен в рамках доступа к админ-панели Cotonti.
- AJAX-поиск страниц отвечает **только администраторам**; всем остальным возвращает пустой список результатов.

---

<a id="s4"></a>

## 4. Бизнес-логика: как дерево работает на сайте

<a id="s4-1"></a>

### 4.1. Какие элементы попадают в дерево

При выводе берутся элементы указанного дерева **только с включённым флажком**. Дерево строится сверху вниз: сначала элементы с родителем «Верхний уровень», затем к каждому подбираются его дочерние элементы, и так далее. Порядок — по числу «Порядок» (при равенстве — по номеру элемента).

Из этого следует:

1. **Отключённый элемент не выводится, а вместе с ним не выводятся и все его потомки**, даже если они сами включены.
2. Элемент, до которого нельзя дойти от верхнего уровня (его родитель удалён, отключён или образует замкнутую цепочку), не выводится.
3. Если элементов нет вообще (дерево пусто, отключены все элементы, дерева с таким ID нет), функция вывода возвращает **пустую строку** — на странице не появится ни пустой список, ни обёртка.
4. Элемент, у которого итоговое название оказалось пустым ([4.2](#s4-2)), пропускается **вместе со своими потомками**.

<a id="s4-2"></a>

### 4.2. Как определяются заголовок и ссылка

Для каждого элемента сначала берутся значения «Заголовок» и «URL» (на дополнительном языке — с учётом переводов, см. [4.3](#s4-3)). Затем:

| Тип | Условие | Ссылка | Заголовок |
|---|---|---|---|
| Категория | Категория с сохранённым кодом существует в структуре `page` | Ваш URL, если задан; иначе стандартная ссылка на категорию | Ваш заголовок, если задан; иначе локализованное название категории (если активен плагин `i18n` и есть перевод), иначе название категории |
| Категория | Категория не найдена | Нет ссылки | Ваш заголовок, если задан; иначе элемент пропускается |
| Страница | ID больше 0, страница существует и **опубликована** (статус `0`) | Ваш URL, если задан; иначе стандартная ссылка на страницу | Ваш заголовок, если задан; иначе локализованный заголовок страницы (если активен плагин `i18n` и есть перевод), иначе заголовок страницы |
| Страница | Страница не найдена или не опубликована | Нет ссылки | Ваш заголовок, если задан; иначе элемент пропускается |
| Произвольная ссылка | — | Ваш URL | Ваш заголовок; если он пуст, а URL задан — сам URL; если оба пусты — элемент пропускается |

Пояснения:

- **Элемент без ссылки** выводится как обычный текст (не кликабельный). Если у него есть вложенные элементы, клик по названию раскрывает или сворачивает ветку.
- Все названия и ваши URL выводятся с экранированием специальных HTML-символов.
- Для страниц и категорий «стандартная ссылка» формируется средствами Cotonti (`cot_page_url()` для страницы, `cot_url('page', ['c' => код])` для категории), то есть учитывает настройки адресов сайта.
- Если на сайте используется перевод адреса пункта, он заменяет автоматическую ссылку (см. [4.3](#s4-3)).

<a id="s4-3"></a>

### 4.3. Мультиязычность на сайте

Правила применяются, только если включена мультиязычность плагина.

1. Определяется **текущий язык посетителя** (`Cot::$usr['lang']`) и **основной язык** (настройка «Код основного языка сайта», по умолчанию — язык сайта по умолчанию).
2. Если текущий язык **совпадает** с основным — всегда используется оригинал (поля «Заголовок» и «URL» самого элемента). Переводы для основного языка не применяются.
3. Если текущий язык **отличается** — для названия и адреса ищется перевод из таблицы переводов на этот язык. Найденный непустой перевод используется, иначе остаётся оригинал.
4. Дальше — обычные правила из [4.2](#s4-2). Если после этого название пустое, для категорий и страниц подставляется название самой категории/страницы.

Отдельная возможность плагина `i18n` (если он установлен и включён): локализованные названия категорий и страниц подставляются автоматически, когда собственное название пункта пусто.

<a id="s4-4"></a>

### 4.4. Раскрытие веток, запоминание, подсветка текущей страницы

Шаблон `toc_page.tree` рисует пункты с вложенными элементами как ветки на HTML-элементе `<details>`, поэтому раскрывать и сворачивать их можно даже без JavaScript. Скрипт `js/toc_page.js` добавляет следующее:

| Функция | Как работает |
|---|---|
| Запоминание | Список ID раскрытых веток хранится в браузере посетителя (`localStorage`) под ключом `tocpg:open:<ID дерева>`. При следующей загрузке страницы ветки раскрываются в том же состоянии. Если хранилище недоступно, ошибки подавляются (запоминания просто нет) |
| Подсветка | Адрес (путь без параметров запроса, без завершающего `/`, в декодированном виде) каждой ссылки дерева сравнивается с путём текущей страницы. Совпавшая ссылка получает `aria-current="page"` и выделяется |
| Автораскрытие | Все ветки-родители подсвеченного пункта раскрываются. Это состояние **не** записывается в запоминаемые |
| Синхронизация | Если одно и то же дерево выведено в нескольких местах страницы, раскрытие ветки в одном экземпляре повторяется в остальных |
| Анимация | Включается после первой расстановки состояния, чтобы при загрузке страницы ветки не «въезжали» |

Раскрытие/сворачивание, выполненное самим скриптом (при загрузке или синхронизации), не сохраняется как действие пользователя — сохраняются только ваши собственные клики.

<a id="s4-5"></a>

### 4.5. Несколько деревьев и несколько экземпляров

- На одной странице можно вывести **разные деревья** и **одно и то же дерево несколько раз**.
- Каждый вызов получает собственный идентификатор экземпляра вида `tocpg-<ID дерева>-<номер вызова>` (он записывается в `id` обёртки).
- Запоминание раскрытых веток ведётся **отдельно для каждого дерева** (по его ID).
- Одинаковые деревья на странице синхронизируют раскрытие веток.
- CSS и JS регистрируются **один раз** за запрос, сколько бы деревьев ни было выведено.

<a id="s4-6"></a>

### 4.6. Сводка правил и ограничений

- Отключённый элемент скрывает всю свою ветку.
- Элемент с пустым итоговым названием не выводится вместе с потомками.
- Категория/страница, которых нет (или страница не опубликована), выводятся как текст без ссылки, если задано собственное название; иначе пропускаются.
- Описание дерева на сайте не выводится.
- Поддерживаются основной язык и до двух дополнительных; код языка — 2 символа.
- Переводятся только название и адрес пункта.
- Плагин не проверяет цикличность вложенности (кроме «элемент не родитель сам себе»).
- Подсветка текущей страницы сравнивает только путь адреса (параметры запроса игнорируются).
- Размер страницы списка в админке — 20 элементов.
- Элементы в админ-таблице показываются плоским списком, без отступов по уровням.

<a id="s4-7"></a>

### 4.7. Типичные ситуации и их причины

| Что наблюдаете | Причина по логике плагина |
|---|---|
| Дерево на сайте не выводится совсем | Плагин не активен (условие `cot_plugin_active('toc_page')`); указан несуществующий ID; в дереве нет элементов; все элементы отключены; ID не передан и не задано «ID дерева по умолчанию» |
| Не выводится целая ветка | Родительский элемент отключён, либо у родителя пустое итоговое название, либо образована замкнутая цепочка родителей |
| Пункт выведен без ссылки | Категория не найдена, либо страница не найдена/не опубликована; задано собственное название |
| Пункт не выведен, хотя включён | Итоговое название пустое (нет собственного названия и нет категории/страницы), либо его родитель не выводится |
| На английской версии вывод не переведён | Мультиязычность выключена; язык не включён в настройках; для пункта не введён перевод (тогда показывается оригинал); текущий язык совпадает с основным |
| Новый пункт оказался внизу списка | Так задумано: новый элемент получает порядок «максимальный на этом уровне + 1» |
| Не видно кнопки «Переводы» / нет полей | Не включена мультиязычность или не включён ни один дополнительный язык |
| Подсветка текущей страницы не срабатывает | Путь ссылки пункта отличается от пути текущей страницы (параметры запроса не учитываются) |

---

<a id="s5"></a>

## 5. Подключение и настройка внешнего вида (для разработчиков)

<a id="s5-1"></a>

### 5.1. Функция вывода

```
cot_toc_page_render($treeId = 0, $tpl = 'toc_page')
```

| Аргумент | Значение |
|---|---|
| `$treeId` | ID дерева. Если не больше 0 — используется настройка «ID дерева по умолчанию» |
| `$tpl` | Имя шаблона без `.tpl`: `toc_page.tree` (сворачиваемое дерево) или `toc_page` (простой список), либо ваш собственный |

Возвращает строку HTML или пустую строку, если выводить нечего.

Примеры вызова в `.tpl`-шаблоне:

```
<!-- IF {PHP|cot_plugin_active('toc_page')} -->
{PHP|cot_toc_page_render(1, 'toc_page.tree')}
<!-- ENDIF -->
```

```
{PHP|cot_toc_page_render(2)}   <!-- простой список, шаблон по умолчанию -->
```

Вызывать функцию можно сколько угодно раз и с разными деревьями.

<a id="s5-2"></a>

### 5.2. Шаблоны вывода

| Шаблон | Файл | Что выводит |
|---|---|---|
| `toc_page.tree` | `tpl/toc_page.tree.tpl` | Сворачиваемое дерево на `<details>` с кнопками-стрелками |
| `toc_page` | `tpl/toc_page.tpl` | Простой вложенный список ссылок без сворачивания (`ul.tocpg-plain …`, CSS-правил для него в плагине нет) |

Шаблон разрешается функцией Cotonti `cot_tplfile($tpl, 'plug')`.

<a id="s5-3"></a>

### 5.3. Теги шаблона

Шаблон должен содержать блок `LIST`, внутри которого — блок `ROW`. Для каждого уровня вложенности шаблон разбирается заново, вложенный результат подставляется в тег `{ROW_ITEMS}` родителя.

Теги блока `LIST`:

| Тег | Значение |
|---|---|
| `{LIST_LEVEL}` | Уровень вложенности списка: 0 для верхнего |
| `{IS_ROOT}` | `1` для верхнего списка, `0` для вложенных |
| `{TREE_ID}` | ID дерева |
| `{INSTANCE}` | Идентификатор экземпляра: `tocpg-<ID дерева>-<номер вызова>` |

Теги блока `ROW`:

| Тег | Значение |
|---|---|
| `{ROW_ID}` | Номер элемента |
| `{ROW_TITLE}` | Заголовок (HTML-экранирован) |
| `{ROW_URL}` | Ссылка; пустая строка, если ссылки нет |
| `{ROW_LEVEL}` | Уровень элемента: 0 для верхнего |
| `{ROW_LVL}` | Пустая строка, а для верхнего уровня — ` tocpg-l0` (с пробелом в начале) |
| `{ROW_HAS_CHILDREN}` | `1`, если есть вложенные элементы, иначе `0` |
| `{ROW_ITEMS}` | Готовый HTML вложенного списка (пусто, если вложенных нет) |

<a id="s5-4"></a>

### 5.4. HTML-структура сворачиваемого дерева

Шаблон `toc_page.tree` формирует следующую разметку (сокращённо):

```html
<nav class="tocpg" id="tocpg-1-1" data-tocpg data-tocpg-tree="1" aria-label="Table of contents">
  <ul class="tocpg-list">
    <li class="tocpg-item">
      <!-- пункт с вложенными элементами -->
      <details class="tocpg-node" data-id="10">
        <summary class="tocpg-row tocpg-l0">
          <span class="tocpg-chev" aria-hidden="true"><svg>…</svg></span>
          <a href="/…">Название</a>   <!-- или <span class="tocpg-title">…</span>, если ссылки нет -->
        </summary>
        <div class="tocpg-sub">
          <ul class="tocpg-list"> … вложенные пункты … </ul>
        </div>
      </details>
    </li>
    <li class="tocpg-item">
      <!-- пункт без вложенных элементов -->
      <div class="tocpg-row tocpg-l0"><span class="tocpg-ph"></span><a href="/…">Название</a></div>
    </li>
  </ul>
</nav>
```

Обёртка `nav.tocpg` выводится только у верхнего списка (`IS_ROOT = 1`).

<a id="s5-5"></a>

### 5.5. Настройка внешнего вида через CSS

Все правила в `css/toc_page.css` начинаются с `.tocpg`, глобальных правил нет. Цвета рамок, фонов и линий строятся от цвета текста (`currentColor`), поэтому подстраиваются под светлую и тёмную темы автоматически.

Переменные, которые можно задать снаружи (на `.tocpg` или любом его родителе):

| Переменная | Назначение | Значение по умолчанию |
|---|---|---|
| `--tocpg-accent` | Цвет стрелки раскрытой ветки | `#27ae60` |
| `--tocpg-current` | Цвет текущего (подсвеченного) пункта и рамки фокуса | `var(--bs-link-color, #0d6efd)` для пункта, `#0d6efd` для рамки фокуса |

Пример:

```css
.tocpg { --tocpg-accent: #e67e22; --tocpg-current: #c0392b; }
```

Размеры: кнопка-стрелка — 24×24 px (для верхнего уровня 32×32 px), значок внутри — 20 px (28 px у верхнего уровня). Вложенный список сдвинут и отмечен вертикальной линией.

Анимация раскрытия задана через `::details-content` и работает в браузерах с её поддержкой; при включённом у посетителя режиме «уменьшить движение» (`prefers-reduced-motion`) анимация отключается.

<a id="s5-6"></a>

### 5.6. Собственный шаблон

1. Скопируйте `tpl/toc_page.tree.tpl` под новым именем, например `tpl/toc_page.mymenu.tpl`.
2. Сохраните структуру блоков `LIST` → `ROW` и используйте теги из [5.3](#s5-3). Для вложенных уровней обязательно выводите `{ROW_ITEMS}` внутри нужного контейнера.
3. Вызовите: `{PHP|cot_toc_page_render(1, 'toc_page.mymenu')}`.

Если нужны скрипт и стили сворачивания из плагина, сохраните в разметке классы и атрибуты из [5.4](#s5-4): `[data-tocpg]`, `[data-tocpg-tree]`, `details.tocpg-node[data-id]` — скрипт работает именно с ними.

<a id="s5-7"></a>

### 5.7. Работа JavaScript

Файл `js/toc_page.js` — самовызывающаяся функция, которая:

- ничего не делает, если уже была загружена (проверка `window.tocpgInit`);
- при загрузке страницы (или сразу, если страница уже загружена) обрабатывает все элементы `[data-tocpg]`, каждый ровно один раз;
- вешает **один** обработчик события `toggle` на весь документ в фазе перехвата (событие `toggle` не всплывает);
- публикует функцию `window.tocpgInit()` — вызовите её, если дерево добавлено на страницу динамически (AJAX, pjax): она обработает новые деревья.

Скрипт не использует `document.currentScript` и не ищет «первый список на странице», поэтому не зависит от места вывода дерева.

---

<a id="s6"></a>

## 6. Техническая часть

<a id="s6-1"></a>

### 6.1. Структура файлов

```
plugins/toc_page/
├── toc_page.setup.php          Метаданные и настройки расширения
├── toc_page.global.php         Глобальная инициализация (хук global)
├── toc_page.ajax.php           AJAX-поиск страниц для Select2 (хук ajax)
├── toc_page.admin.php          Административный интерфейс (хук tools)
├── setup/
│   ├── toc_page.install.sql    Создание таблиц
│   └── toc_page.uninstall.sql  Удаление таблиц
├── inc/
│   └── toc_page.functions.php  Основные функции плагина
├── js/
│   └── toc_page.js             Поведение дерева
├── css/
│   └── toc_page.css            Стили дерева
├── tpl/
│   ├── toc_page.admin.tpl      Шаблон админ-панели
│   ├── toc_page.tree.tpl       Шаблон: сворачиваемое дерево
│   └── toc_page.tpl            Шаблон: простой список
└── lang/
    ├── toc_page.en.lang.php    Английский язык
    └── toc_page.ru.lang.php    Русский язык
```

| Файл | Назначение |
|---|---|
| `toc_page.setup.php` | Блок метаданных (`[BEGIN_COT_EXT]`) и блок настроек (`[BEGIN_COT_EXT_CONFIG]`) |
| `toc_page.global.php` | Подключает файл функций и регистрирует CSS/JS (кроме админ-панели) |
| `toc_page.ajax.php` | Возвращает JSON со списком страниц для Select2; только для администраторов |
| `toc_page.admin.php` | Вкладки админки, обработка форм и действий |
| `inc/toc_page.functions.php` | Все функции плагина, регистрация таблиц БД, загрузка языкового файла |
| `tpl/toc_page.admin.tpl` | Разметка админ-панели (теги назначаются в `toc_page.admin.php`) |
| `tpl/toc_page.tree.tpl`, `tpl/toc_page.tpl` | Шаблоны вывода на сайте |
| `lang/*.lang.php` | Тексты интерфейса и подписи настроек |

<a id="s6-2"></a>

### 6.2. Хуки Cotonti

| Файл | Хук | Когда выполняется |
|---|---|---|
| `toc_page.global.php` | `global` | На каждой загрузке страницы; подключает функции и (вне админки) регистрирует ресурсы |
| `toc_page.admin.php` | `tools` | При открытии `admin.php?m=other&p=toc_page` |
| `toc_page.ajax.php` | `ajax` | При AJAX-запросе поиска страниц (адрес формируется в `toc_page.admin.php`: `r=toc_page`, `ajax=search`) |

<a id="s6-3"></a>

### 6.3. База данных

Таблицы создаются файлом `setup/toc_page.install.sql` (оператор `CREATE TABLE IF NOT EXISTS`, кодировка `utf8mb4`, `utf8mb4_unicode_ci`, механизм `InnoDB`). В файле указан префикс `cot_`; фактический префикс — тот, что задан в настройках базы вашего сайта.

#### `toc_page_trees` — деревья

| Поле | Тип | Описание |
|---|---|---|
| `tree_id` | INT UNSIGNED, AUTO_INCREMENT, PK | ID дерева |
| `tree_title` | VARCHAR(255) | Название |
| `tree_description` | TEXT, NULL | Описание (только для админки) |
| `tree_created` | INT UNSIGNED | Время создания (Unix time) |
| `tree_updated` | INT UNSIGNED | Время последнего изменения |

#### `toc_page_items` — элементы деревьев

| Поле | Тип | Описание |
|---|---|---|
| `item_id` | INT UNSIGNED, AUTO_INCREMENT, PK | ID элемента |
| `tree_id` | INT UNSIGNED, индекс | Дерево, которому принадлежит элемент |
| `parent_id` | INT UNSIGNED, индекс | ID родительского элемента; `0` — верхний уровень |
| `item_type` | ENUM('category','page','custom') | Тип элемента |
| `item_ref` | VARCHAR(255) | Код категории (для `category`), ID страницы (для `page`), пусто (для `custom`) |
| `item_title` | VARCHAR(255) | Собственное название пункта |
| `item_url` | VARCHAR(255) | Собственный адрес пункта |
| `item_sort` | INT UNSIGNED, индекс | Порядок внутри уровня |
| `item_enabled` | TINYINT UNSIGNED | `1` — включён, `0` — отключён |

#### `toc_page_i18n` — переводы

| Поле | Тип | Описание |
|---|---|---|
| `item_id` | INT UNSIGNED | Элемент |
| `field_name` | VARCHAR(255) | Переводимое поле: `item_title` или `item_url` |
| `lang` | CHAR(2) | Код языка (2 символа) |
| `value` | TEXT | Значение перевода |

Составной первичный ключ: (`item_id`, `field_name`, `lang`). Внешний ключ `fk_toc_page_i18n_item` по `item_id` на `toc_page_items(item_id)` с `ON DELETE CASCADE`. Кроме того, при удалении деревьев и элементов плагин сам явно удаляет связанные переводы.

Связи: `toc_page_trees` 1 — N `toc_page_items`; `toc_page_items` 1 — N `toc_page_i18n`; `toc_page_items.parent_id` ссылается на `toc_page_items.item_id` (логически, без внешнего ключа).

Файл `setup/toc_page.uninstall.sql` удаляет таблицы `toc_page_i18n`, `toc_page_items`, `toc_page_trees` (в таком порядке).

<a id="s6-4"></a>

### 6.4. Функции плагина

Файл `inc/toc_page.functions.php`. При подключении загружается языковой файл и регистрируются таблицы (`toc_page_trees`, `toc_page_items`, `toc_page_i18n`) в менеджере БД Cotonti.

| Функция | Назначение |
|---|---|
| `toc_page_i18n_enabled()` | Включена ли мультиязычность плагина |
| `toc_page_get_default_lang()` | Код основного языка: из настройки плагина, иначе `$cfg['defaultlang']` |
| `toc_page_get_active_langs()` | Массив активных дополнительных языков (до двух, коды, отличающиеся от основного) |
| `toc_page_i18n_load($itemId, $field, $lang)` | Один перевод из БД; `null`, если нет или пуст |
| `toc_page_i18n_save($itemId, $field, $lang, $value)` | Сохраняет перевод; пустое значение удаляет запись |
| `toc_page_i18n_map($treeId, $lang)` | Все непустые переводы дерева для языка одним запросом (с кэшем на запрос) |
| `toc_page_i18n_get_value($itemId, $field, $original, $treeId = 0)` | Значение поля с учётом перевода по правилам [4.3](#s4-3) |
| `toc_page_get_tree($treeId)` | Вложенный массив включённых элементов дерева (с кэшем на запрос) |
| `toc_page_get_pages(array $ids)` | Опубликованные страницы по ID одним запросом (с кэшем на запрос) |
| `toc_page_collect_page_ids(array $items)` | Рекурсивно собирает ID страниц из дерева |
| `toc_page_register_assets()` | Регистрирует CSS и JS через `Resources` (один раз за запрос) |
| `cot_toc_page_render($treeId, $tpl)` | Главная функция вывода |
| `toc_page_display($items, $level, $tpl, $treeId, $instance)` | Рекурсивно формирует HTML уровня дерева по шаблону |
| `toc_page_i18n_cat_title($catCode)` | Локализованное название категории из плагина `i18n` (если доступно) |
| `toc_page_i18n_page_title($pageId)` | Локализованный заголовок страницы из плагина `i18n` (если доступно) |

<a id="s6-5"></a>

### 6.5. Что происходит при вызове `cot_toc_page_render()`

1. Увеличивается счётчик вызовов (нужен для идентификатора экземпляра).
2. Вызывается `toc_page_register_assets()` — CSS и JS регистрируются (один раз за запрос).
3. Если `$treeId` не больше 0 и задан параметр `default_tree`, используется он.
4. `toc_page_get_tree()` загружает **одним запросом** все включённые элементы дерева, упорядоченные по `item_sort ASC, item_id ASC`, и строит вложенный массив, начиная с `parent_id = 0`. Результат кэшируется на время запроса.
5. Если дерево пусто — возвращается `''`.
6. `toc_page_get_pages()` заранее загружает **одним запросом** все страницы, на которые ссылаются элементы типа `page`.
7. `toc_page_display()` рекурсивно создаёт объект шаблона для каждого уровня, назначает теги уровня, для каждого элемента определяет заголовок и ссылку ([4.2](#s4-2), [4.3](#s4-3)), пропускает элементы с пустым названием, назначает теги элемента, рекурсивно формирует вложенные уровни и подставляет их в `{ROW_ITEMS}`; затем разбирает блоки `LIST.ROW` и `LIST`.
8. Результат возвращается как строка.

<a id="s6-6"></a>

### 6.6. Контроллер админ-панели: вкладки и действия

Файл `toc_page.admin.php`. Параметры адреса: `tab` (вкладка), `tree` (ID дерева), `a` (действие), `item` / `item_id` (элемент), `d` (смещение пагинации).

| Вкладка | Действие `a` | Метод | Что делает |
|---|---|---|---|
| `trees` | — | GET | Список деревьев |
| `trees` | `add` | POST | Создание дерева (нужно непустое название) |
| `trees` | `edit_tree` | GET | Показывает форму переименования |
| `trees` | `update_tree` | POST | Сохраняет название и описание (нужно непустое название) |
| `trees` | `delete` | GET (с подтверждением) | Удаляет переводы, элементы и дерево |
| `edit` | — | GET | Таблица элементов (пагинация, форма добавления) |
| `edit` | `save` | POST | Сохраняет заголовки, родителей, порядок, включённость элементов страницы |
| `edit` | `add_item` | POST | Добавляет элемент |
| `edit` | `delete_item` | GET (с подтверждением) | Удаляет элемент с потомками и переводами |
| `edit_element` | — | GET | Форма одного элемента |
| `edit_element` | `save_element` | POST | Сохраняет все поля элемента |
| `i18n` | — | GET | Таблица переводов |
| `i18n` | `save_i18n` | POST | Сохраняет переводы (пустое значение удаляет) |

Подробности реализации:

- Удаление элемента обходит потомков в ширину (очередь), с защитой от повторного обхода одного и того же элемента, и удаляет переводы и элементы одним запросом на таблицу.
- Удаление дерева сначала удаляет переводы всех его элементов, затем элементы, затем дерево.
- После успешных действий выполняется перенаправление (`cot_redirect`) на соответствующую вкладку.
- Шаблон админки (`tpl/toc_page.admin.tpl`) получает данные через теги и блоки, назначаемые в контроллере: блоки `MAIN.TREES_ROW`, `MAIN.EDIT_TREE_FORM`, `MAIN.EDIT_ITEM`, `MAIN.EDIT_EMPTY`, `MAIN.EDIT_ELEMENT_FORM`, `MAIN.I18N_LANG_HEADER`, `MAIN.I18N_ROW` (с вложенным `I18N_LANG_FIELDS`), `MAIN.I18N_EMPTY`.
- Для кнопки/ссылки копирования кода каждому дереву назначается тег `TREE_CODE` (готовый код вставки с шаблоном `toc_page.tree`).

<a id="s6-7"></a>

### 6.7. AJAX-поиск страниц

Включается настройкой «Использовать поиск статей через Select2». Тогда при добавлении и редактировании элемента типа «Страница» вместо выпадающего списка подключаются ресурсы Select2 (`Resources::SELECT2`) и поле поиска.

Запрос формируется в админке функцией `cot_url('plug', ['r' => 'toc_page', 'ajax' => 'search', 'current_page_id' => <ID>])`; строка поиска передаётся параметром `q` (отправляет Select2).

Поведение `toc_page.ajax.php`:

| Условие | Результат |
|---|---|
| Пользователь не администратор | `{"results":[]}` |
| Длина строки поиска меньше 2 символов | `{"results":[]}` |
| Иначе | До 50 опубликованных страниц (`page_state = 0`), заголовок которых содержит строку (без учёта регистра), по убыванию даты страницы; страница с ID `current_page_id` исключается |

Ответ — JSON вида `{"results":[{"id":123,"text":"Заголовок"}, …]}` в кодировке UTF-8. В форме редактирования элемента в `current_page_id` передаётся ID выбранной страницы, если элемент типа «Страница» (иначе 0), поэтому уже выбранная страница в результатах поиска не показывается. Выбранное значение записывается в скрытое поле `item_ref_page`. Минимальная длина строки поиска на стороне поля — 2 символа, пауза перед отправкой — 300 мс.

<a id="s6-8"></a>

### 6.8. Подключение CSS и JS

Функция `toc_page_register_assets()`:

- выполняется один раз за запрос (статический флаг);
- регистрирует `plugins/toc_page/css/toc_page.css` через `Resources::linkFile()`;
- регистрирует `plugins/toc_page/js/toc_page.js` через `Resources::linkFileFooter()` (подвал страницы);
- регистрирует каждый файл **только если он существует и читается**.

Вызывается из двух мест:

1. `cot_toc_page_render()` — при каждом выводе дерева;
2. `toc_page.global.php` — на каждой странице, кроме админ-панели (константа `COT_ADMIN` определена). Это нужно, чтобы дерево, выведенное в шапке или другом месте, которое разбирается уже после формирования `<head>`, тоже получило стили и скрипт.

<a id="s6-9"></a>

### 6.9. Кэширование

Постоянного кэша нет. На время одного запроса кэшируются (статические переменные функций): дерево элементов по ID, страницы по ID, переводы дерева по паре «дерево + язык», флаг регистрации ресурсов, счётчик вызовов. Состояние раскрытия веток хранится в браузере посетителя (`localStorage`), на сервере не хранится.

<a id="s6-10"></a>

### 6.10. Безопасность

- Значения из форм и адреса импортируются через `cot_import()` с указанием типа (`TXT`, `INT`, `ALP`, `BOL`, `ARR`); числовые параметры приводятся к `int`.
- Запросы к БД выполняются с параметрами (`?`).
- Названия и адреса, выводимые на сайте и в админке, экранируются через `htmlspecialchars()`.
- Удаление деревьев и элементов выполняется по ссылкам с подтверждением (`cot_confirm_url()`).
- Тип элемента ограничен списком `category` / `page` / `custom`.
- AJAX-поиск возвращает данные только администраторам.
- Сохранение переводов выполняется только для элементов выбранного дерева.
- Скрипт на сайте не выполняет сетевых запросов; единственное хранилище — `localStorage` в браузере посетителя.

<a id="s6-11"></a>

### 6.11. Совместимость с браузерами

Скрипт и стили используют стандартные возможности браузера: элемент `<details>/<summary>`, `localStorage`, `URL`, `Element.closest`. Особенности:

- Раскрытие и сворачивание работают за счёт нативного `<details>`, в том числе при отключённом JavaScript. Запоминание, подсветка текущей страницы и синхронизация деревьев требуют JavaScript.
- Для цветов с `color-mix()` в CSS указаны запасные значения (`rgba(...)`) для браузеров без его поддержки.
- Плавная анимация раскрытия использует `::details-content` и `interpolate-size`; в браузерах без их поддержки ветки раскрываются без анимации.

---

<a id="s7"></a>

## 7. Глоссарий

| Термин | Значение |
|---|---|
| **Дерево** | Самостоятельное оглавление со своим ID, названием и набором элементов. Выводится на сайте вызовом `cot_toc_page_render(ID, …)` |
| **Элемент (пункт)** | Одна строка дерева: категория, страница или произвольная ссылка |
| **Тип элемента** | `category`, `page` или `custom` |
| **Родитель** | Элемент, внутри которого вложен данный. «Верхний уровень» (внутри `parent_id = 0`) — элемент без родителя |
| **Потомки** | Все элементы, вложенные в данный на любую глубину |
| **Порядок (`item_sort`)** | Число, по которому элементы упорядочены внутри одного родителя |
| **Включён / отключён** | Флажок видимости элемента на сайте. Отключение скрывает элемент вместе с потомками |
| **Ветка** | Элемент с вложенными элементами, которую можно раскрыть или свернуть |
| **Ссылка на объект (`item_ref`)** | Код категории или ID страницы, к которым привязан элемент |
| **URL элемента** | Необязательный собственный адрес; переопределяет автоматический |
| **Категория** | Раздел модуля `page` Cotonti (код категории хранится в структуре `page`) |
| **Опубликованная страница** | Страница модуля `page` со статусом `0` (`page_state = 0`) |
| **Основной язык** | Язык, на котором вводятся оригиналы названий; для него переводы не используются |
| **Дополнительный язык** | Язык, для которого можно ввести переводы названий и адресов (до двух) |
| **Мультиязычность** | Режим, в котором на сайте применяются переводы названий и адресов элементов |
| **Select2** | Библиотека поиска в выпадающем списке; в плагине используется для поиска страниц по названию |
| **AJAX** | Запрос к серверу без перезагрузки страницы (используется для поиска страниц в админке) |
| **Хук (hook)** | Точка расширения Cotonti, в которой подключается файл плагина (`global`, `ajax`, `tools`) |
| **Resources** | Менеджер подключаемых CSS/JS в Cotonti |
| **XTemplate / `.tpl`** | Шаблонизатор Cotonti и файлы шаблонов |
| **`cot_tplfile()`** | Функция Cotonti, определяющая файл шаблона по имени |
| **Экземпляр** | Один конкретный вывод дерева на странице. Один и тот же ID дерева может быть выведен несколькими экземплярами |
| **`<details>` / `<summary>`** | Стандартные HTML-элементы раскрывающегося блока и его заголовка; на них построены ветки дерева |
| **`localStorage`** | Хранилище в браузере посетителя; в нём запоминается набор раскрытых веток |
| **`aria-current="page"`** | Атрибут доступности, отмечающий ссылку на текущую страницу |
| **`currentColor`** | Значение CSS «цвет текста»; от него строятся рамки, фоны и линии дерева |
| **ID** | Числовой номер дерева или элемента |
| **Префикс БД** | Начало имени таблиц, заданное настройками сайта (в SQL плагина записано как `cot_`) |

---

<a id="s8"></a>

## 8. Лицензия и авторство

- Лицензия: **BSD** (свободное распространение при сохранении авторства).
- Автор: **webitproff** — <https://github.com/webitproff>
- Copyright © webitproff 2026
- Исходный код и обновления: <https://github.com/webitproff/toc_page-cotonti>

[К оглавлению](#toc)

