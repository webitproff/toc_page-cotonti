<!-- 
	/**
	* Table of Contents Page plugin - дерево и списки выводим через вызов функции в глобальной видимости {PHP|cot_toc_page_render(1)} - (меняем ID на свой актуальный)
	* File: plugins/toc_page/tpl/toc_page.tpl
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
