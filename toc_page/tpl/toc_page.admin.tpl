<!-- 
	/**
	* Table of Contents Page plugin - admin panel
	* File: plugins/toc_page/tpl/toc_page.admin.tpl
	*
	* @package toc_page
	* @version 1.0.0
	* @author webitproff
	* @copyright (c) webitproff 2026 https://github.com/webitproff
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
	</ul>
	
    <!-- IF {PHP.tab} == 'trees' -->
    <div class="card p-3 mb-4">
        <h3>{PHP.L.toc_page_trees_list}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{PHP.L.toc_page_tree_title}</th>
                    <th>{PHP.L.toc_page_tree_desc}</th>
                    <th>{PHP.L.toc_page_actions}</th>
				</tr>
			</thead>
            <tbody>
                <!-- BEGIN: TREES_ROW -->
                <tr>
                    <td>{TREE_ID}</td>
                    <td><a href="{TREE_EDIT_URL}">{TREE_TITLE}</a></td>
                    <td>{TREE_DESC}</td>
					<td>
						<a href="{TREE_EDIT_URL}" class="btn btn-sm btn-primary">{PHP.L.toc_page_tree_items}</a>
						<a href="{TREE_RENAME_URL}" class="btn btn-sm btn-outline-secondary">{PHP.L.toc_page_edit_tree_meta}</a>
						<a href="{TREE_DELETE_URL}" class="btn btn-sm btn-danger" onclick="return confirm('{PHP.L.toc_page_confirm_delete}');">{PHP.L.Delete}</a>
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
        <form method="post" action="{SAVE_FORM_URL}">
            <table class="table table-bordered">
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
                            <a href="{ITEM_DELETE_URL}" class="btn btn-sm btn-danger" onclick="return confirm('{PHP.L.toc_page_confirm_delete}');">{PHP.L.Delete}</a>
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
                    {ADD_PAGE_SELECT}
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
</div>

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
<!-- END: MAIN -->