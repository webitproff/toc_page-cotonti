<!-- 
	/**
	* Table of Contents Page plugin - admin panel
	* File: plugins/toc_page/tpl/toc_page.admin.tpl
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
-->
<!-- BEGIN: MAIN -->
<div class="container-fluid py-4">
    <h2>{PHP.L.toc_page_title}</h2>
    {FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
	
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {TAB_TREES_ACTIVE}" href="{URL_TREES}">{PHP.L.toc_page_tab_trees}</a>
		</li>
        <li class="nav-item">
            <a class="nav-link {TAB_EDIT_ACTIVE}" href="{URL_EDIT}">{PHP.L.toc_page_tab_edit}</a>
		</li>
        <li class="nav-item">
            <a class="nav-link {TAB_I18N_ACTIVE}" href="{URL_I18N}">{PHP.L.toc_page_tab_i18n}</a>
		</li>
        <li class="nav-item">
            <a class="nav-link {TAB_ELEMENT_ACTIVE}" href="{URL_EDIT_ELEMENT}">{PHP.L.toc_page_tab_element}</a>
		</li>
	</ul>
	
    <!-- IF {PHP.tab} == 'trees' -->
    <div class="p-3 mb-4">
        <h3>{PHP.L.toc_page_trees_list}</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{PHP.L.toc_page_tree_title}</th>
                    <th>{PHP.L.toc_page_tree_desc}</th>
					<th>{PHP.L.toc_page_tree_codepaste}</th>
                    <th>{PHP.L.toc_page_actions}</th>
				</tr>
			</thead>
            <tbody>
                <!-- BEGIN: TREES_ROW -->
                <tr>
                    <td>{TREE_ID}</td>
                    <td><a href="{TREE_EDIT_URL}">{TREE_TITLE}</a></td>
                    <td><pre>{TREE_DESC}</pre></td>
					<td>
						<div class="d-flex align-items-start">
							<pre class="mb-0 me-2 flex-grow-1"><code>{TREE_CODE}</code></pre>
							<button type="button" class="btn btn-sm btn-outline-success copy-tree-code" data-tree-id="{TREE_ID}" title="{PHP.L.toc_page_copy}">
								<span class="copy-label">{PHP.L.toc_page_copy}</span>
								<i class="fa-solid fa-copy copy-icon"></i>
							</button>
						</div>
					</td>
					<td>
						<a href="{TREE_EDIT_URL}" class="btn btn-sm btn-primary">{PHP.L.toc_page_tree_items}</a>
						<a href="{TREE_RENAME_URL}" class="btn btn-sm btn-outline-secondary">{PHP.L.toc_page_edit_tree_meta}</a>
						<a href="{TREE_DELETE_URL}" class="btn btn-sm btn-danger">{PHP.L.Delete}</a>
					</td>
				</tr>
                <!-- END: TREES_ROW -->
			</tbody>
		</table>
		<!-- IF {EDIT_TREE_ID} -->
		<div class="card p-3 mb-4">
			<h3>{PHP.L.toc_page_edit_tree}: {EDIT_TREE_ID}</h3>
			<form method="post" action="{EDIT_TREE_FORM_URL}">
				<div class="mb-3">
					<label>{PHP.L.toc_page_tree_title}</label>
					{EDIT_TREE_TITLE}
				</div>
				<div class="mb-3">
					<label>{PHP.L.toc_page_tree_desc}</label>
					{EDIT_TREE_DESC}
				</div>
				<button type="submit" class="btn btn-success">{PHP.L.Update}</button>
			</form>
		</div>
		<!-- ENDIF -->
        <h3>{PHP.L.toc_page_add_tree}</h3>
        <form method="post" action="{ADD_TREE_FORM_URL}">
            <div class="mb-3">
                <label>{PHP.L.toc_page_tree_title}</label>
                {ADD_TREE_TITLE}
			</div>
            <div class="mb-3">
                <label>{PHP.L.toc_page_tree_desc}</label>
                {ADD_TREE_DESC}
			</div>
            <button type="submit" class="btn btn-success">{PHP.L.toc_page_add_tree_btn}</button>
		</form>
	</div>
    <!-- ENDIF -->
	
    <!-- IF {PHP.tab} == 'edit' -->
    <div class="card p-3">
        <h3>{PHP.L.toc_page_edit_tree}: {TREE_TITLE}</h3>
		
        <h4>{PHP.L.toc_page_items_list}</h4>
		
        <!-- IF {PAGINATION} -->
        <nav class="mt-3">
            <div class="text-center mb-2">{PHP.L.Total}: {TOTAL_ENTRIES}, {PHP.L.Onpage}: {ENTRIES_ON_CURRENT_PAGE}</div>
            <ul class="pagination justify-content-center">{PREVIOUS_PAGE} {PAGINATION} {NEXT_PAGE}</ul>
		</nav>
        <!-- ENDIF -->		
		
        <form method="post" action="{SAVE_FORM_URL}">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width:50px;">ID</th>
                        <th>{PHP.L.toc_page_item_type}</th>
                        <th>{PHP.L.toc_page_item_ref}</th>
                        <th>{PHP.L.toc_page_item_title}</th>
                        <th>{PHP.L.toc_page_item_parent}</th>
                        <th>{PHP.L.toc_page_item_sort}</th>
                        <th>{PHP.L.toc_page_item_enabled}</th>
                        <th>{PHP.L.toc_page_item_actions}</th>
					</tr>
				</thead>
                <tbody>
                    <!-- BEGIN: EDIT_ITEM -->
                    <tr>
                        <td>{ITEM_ID}</td>
                        <td>{ITEM_TYPE}</td>
                        <td>{ITEM_REF_INFO}</td>
                        <td>
                            <input type="text" name="items[{ITEM_ID}][title]" value="{ITEM_TITLE_VALUE}" class="form-control">
						</td>
                        <td>
                            <select name="items[{ITEM_ID}][parent_id]" class="form-select">
                                {ITEM_PARENT_SELECT}
							</select>
						</td>
                        <td>
                            <input type="number" name="items[{ITEM_ID}][sort]" value="{ITEM_SORT}" class="form-control" style="width:80px;">
						</td>
                        <td>
                            <input type="checkbox" name="items[{ITEM_ID}][enabled]" value="1" {ITEM_ENABLED_CHECKED}>
						</td>
                        <td>
                            <a href="{ITEM_EDIT_URL}" class="btn btn-sm btn-primary">{PHP.L.toc_page_edit}</a>
                            <a href="{ITEM_DELETE_URL}" class="btn btn-sm btn-danger">{PHP.L.Delete}</a>
						</td>
					</tr>
                    <!-- END: EDIT_ITEM -->
				</tbody>
			</table>
            <button type="submit" class="btn btn-primary">{PHP.L.toc_page_save_changes}</button>
		</form>
		
        <h4 class="mt-4">{PHP.L.toc_page_add_item}</h4>
        <form method="post" action="{ADD_ITEM_FORM_URL}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_type}</label>
                    <select name="item_type" class="form-select" id="item_type_select">
                        <option value="category">{PHP.L.toc_page_type_category}</option>
                        <option value="page">{PHP.L.toc_page_type_page}</option>
                        <option value="custom">{PHP.L.toc_page_type_custom}</option>
					</select>
				</div>
                <div class="col-md-3" id="cat_block">
                    <label>{PHP.L.toc_page_category}</label>
                    {ADD_CAT_SELECT}
				</div>
                <div class="col-md-3" id="page_block" style="display:none;">
                    <label>{PHP.L.toc_page_page}</label>
                    <!-- IF {ADD_PAGE_SELECT2} -->
                    {ADD_PAGE_SELECT2}
                    <!-- ELSE -->
                    {ADD_PAGE_SELECT}
                    <!-- ENDIF -->
				</div>
                <div class="col-md-3" id="custom_block" style="display:none;">
                    <label>{PHP.L.toc_page_url}</label>
                    <input type="text" name="item_url" class="form-control">
				</div>
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_title}</label>
                    <input type="text" name="item_title" class="form-control">
				</div>
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_parent}</label>
                    <select name="parent_id" class="form-select">
                        {ADD_PARENT_SELECT}
					</select>
				</div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-success">{PHP.L.toc_page_add_item_btn}</button>
				</div>
			</div>
		</form>
	</div>
    <!-- ENDIF -->
	
    <!-- IF {PHP.tab} == 'edit_element' -->
    <div class="card p-3">
        <h3>{PHP.L.toc_page_edit_element}: {ELEMENT_ID}</h3>
        <p>{PHP.L.toc_page_tree_title}: {ELEMENT_TREE_TITLE}</p>
		
        <form method="post" action="{ELEMENT_FORM_URL}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_type}</label>
                    <select name="item_type" class="form-select" id="element_type_select">
                        {ELEMENT_TYPE_SELECT}
					</select>
				</div>
                <div class="col-md-3" id="element_cat_block">
                    <label>{PHP.L.toc_page_category}</label>
                    {ELEMENT_CAT_SELECT}
				</div>
                <div class="col-md-3" id="element_page_block" style="display:none;">
                    <label>{PHP.L.toc_page_page}</label>
                    <!-- IF {ELEMENT_PAGE_SELECT2} -->
                    {ELEMENT_PAGE_SELECT2}
                    <!-- ELSE -->
                    {ELEMENT_PAGE_SELECT}
                    <!-- ENDIF -->
				</div>
                <div class="col-md-3" id="element_custom_block" style="display:none;">
                    <label>{PHP.L.toc_page_url}</label>
                    <input type="text" name="item_url" value="{ELEMENT_URL_VALUE}" class="form-control">
				</div>
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_title}</label>
                    <input type="text" name="item_title" value="{ELEMENT_TITLE_VALUE}" class="form-control">
				</div>
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_parent}</label>
                    <select name="parent_id" class="form-select">
                        {ELEMENT_PARENT_SELECT}
					</select>
				</div>
                <div class="col-md-3">
                    <label>{PHP.L.toc_page_item_sort}</label>
                    <input type="number" name="item_sort" value="{ELEMENT_SORT}" class="form-control">
				</div>
                <div class="col-md-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="item_enabled" value="1" {ELEMENT_ENABLED_CHECKED} class="form-check-input">
                        <label class="form-check-label">{PHP.L.toc_page_item_enabled}</label>
					</div>
				</div>
			</div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">{PHP.L.Update}</button>
                <a href="{ELEMENT_BACK_URL}" class="btn btn-outline-secondary">{PHP.L.toc_page_back}</a>
			</div>
		</form>
	</div>
    <!-- ENDIF -->
	
    <!-- IF {PHP.tab} == 'i18n' -->
    <div class="card p-3">
        <h3>{PHP.L.toc_page_edit_tree}: {TREE_TITLE}</h3>
		
        <!-- IF {PAGINATION} -->
        <nav class="mt-3">
            <div class="text-center mb-2">{PHP.L.Total}: {TOTAL_ENTRIES}, {PHP.L.Onpage}: {ENTRIES_ON_CURRENT_PAGE}</div>
            <ul class="pagination justify-content-center">{PREVIOUS_PAGE} {PAGINATION} {NEXT_PAGE}</ul>
		</nav>
        <!-- ENDIF -->		
		
        <form method="post" action="{I18N_FORM_URL}">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{PHP.L.toc_page_item_type}</th>
                        <th>{PHP.L.toc_page_item_ref}</th>
                        <th>{PHP.L.toc_page_item_title}</th>
                        <!-- BEGIN: I18N_LANG_HEADER -->
                        <th>{LANG_CODE} {PHP.L.toc_page_item_title}</th>
                        <th>{LANG_CODE} URL</th>
                        <!-- END: I18N_LANG_HEADER -->
					</tr>
				</thead>
                <tbody>
                    <!-- BEGIN: I18N_ROW -->
                    <tr>
                        <td>{I18N_ITEM_ID}<input type="hidden" name="items[{I18N_ITEM_ID}][id]" value="{I18N_ITEM_ID}"></td>
                        <td>{I18N_ITEM_TYPE}</td>
                        <td>{I18N_ITEM_REF}</td>
                        <td>{I18N_ITEM_TITLE}</td>
                        <!-- BEGIN: I18N_LANG_FIELDS -->
                        <td>
                            <input type="text" name="items[{I18N_ITEM_ID}][title_{LANG_CODE}]" value="{TITLE_VALUE}" class="form-control">
						</td>
                        <td>
                            <input type="text" name="items[{I18N_ITEM_ID}][url_{LANG_CODE}]" value="{URL_VALUE}" class="form-control">
						</td>
                        <!-- END: I18N_LANG_FIELDS -->
					</tr>
                    <!-- END: I18N_ROW -->
                    <!-- BEGIN: I18N_EMPTY -->
                    <tr><td colspan="10" class="text-center">{PHP.L.toc_page_no_items}</td></tr>
                    <!-- END: I18N_EMPTY -->
				</tbody>
			</table>
            <button type="submit" class="btn btn-success">{PHP.L.toc_page_save_changes}</button>
		</form>
	</div>
    <!-- ENDIF -->
</div>
<style>
    /* Нормализация Select2 под Bootstrap form-select */
    .select2-container--default .select2-selection--single {
	min-height: 38px; /* как у form-select */
	padding: 0.375rem 0.75rem;
	border: 1px solid #ced4da;
	border-radius: 0.375rem;
	background-color: #fff;
	display: flex;
	align-items: center;
	transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
	
    /* Фокус — как у Bootstrap */
    .select2-container--default .select2-selection--single:focus,
    .select2-container--default.select2-container--focus .select2-selection--single {
	border-color: #86b7fe;
	box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
	outline: 0;
    }
	
    /* Текст выбранного значения */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
	color: #212529;
	line-height: 1.5;
	padding-left: 0;
	padding-right: 0;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
    }
	
    /* Placeholder */
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
	color: #6c757d; /* серый как placeholder Bootstrap */
	line-height: 1.5;
    }
	
    /* Стрелка справа */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
	height: 100%;
	right: 0.75rem;
    }
	
    /* Выпадающий список */
    .select2-container--default .select2-results__options {
	max-height: 50vh !important;
	overflow-y: auto;
	background-color: #fff;
	color: #212529;
    }
	
    /* Подсветка активного элемента */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #0d6efd; /* синий Bootstrap primary */
	color: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('item_type_select');
        const catBlock = document.getElementById('cat_block');
        const pageBlock = document.getElementById('page_block');
        const customBlock = document.getElementById('custom_block');
		
        function updateBlocks() {
            const val = typeSelect.value;
            catBlock.style.display = val === 'category' ? 'block' : 'none';
            pageBlock.style.display = val === 'page' ? 'block' : 'none';
            customBlock.style.display = val === 'custom' ? 'block' : 'none';
		}
		
        if (typeSelect) {
            typeSelect.addEventListener('change', updateBlocks);
            updateBlocks();
		}
	});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('element_type_select');
        const catBlock = document.getElementById('element_cat_block');
        const pageBlock = document.getElementById('element_page_block');
        const customBlock = document.getElementById('element_custom_block');
		
        function updateBlocks() {
            const val = typeSelect.value;
            catBlock.style.display = val === 'category' ? 'block' : 'none';
            pageBlock.style.display = val === 'page' ? 'block' : 'none';
            customBlock.style.display = val === 'custom' ? 'block' : 'none';
		}
		
        if (typeSelect) {
            typeSelect.addEventListener('change', updateBlocks);
            updateBlocks();
		}
	});
</script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.querySelectorAll('.copy-tree-code').forEach(function(btn) {
			btn.addEventListener('click', function() {
				var codeElement = this.closest('td').querySelector('code');
				if (!codeElement) return;
				
				var codeText = codeElement.textContent;
				var originalTitle = btn.getAttribute('title');
				var labelElement = btn.querySelector('.copy-label');
				var iconElement = btn.querySelector('.copy-icon');
				var originalLabel = labelElement.textContent;
				var originalIconClass = iconElement.className;
				var successText = "{PHP.L.toc_page_copy_success}";
				
				navigator.clipboard.writeText(codeText).then(function() {
					// Визуальное подтверждение: меняем текст, иконку и title
					labelElement.textContent = successText;
					iconElement.className = 'fa-solid fa-check copy-icon';
					btn.setAttribute('title', successText);
					
					setTimeout(function() {
						labelElement.textContent = originalLabel;
						iconElement.className = originalIconClass;
						btn.setAttribute('title', originalTitle);
					}, 1500);
					}).catch(function(err) {
					// Если копирование не удалось — ничего не меняем
					console.error('Ошибка копирования: ', err);
				});
			});
		});
	});
</script>
<!-- END: MAIN -->
