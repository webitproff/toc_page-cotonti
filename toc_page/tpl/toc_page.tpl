<!-- 
	/**
	* Table of Contents Page plugin - дерево и списки выводим через вызов функции в глобальной видимости {PHP|cot_toc_page_render(1)} - (меняем ID на свой актуальный)
	* File: plugins/toc_page/tpl/toc_page.tpl
	*
	* @package toc_page
	* @version 1.0.0
	* @author webitproff
	* @copyright (c) webitproff 2026 https://github.com/webitproff
	* @license BSD
	*/
-->
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