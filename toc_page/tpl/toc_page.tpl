<!--
	Table of Contents Page plugin - простой (несворачиваемый) шаблон по умолчанию
	File: plugins/toc_page/tpl/toc_page.tpl
	Вызов: {PHP|cot_toc_page_render(1)}
	version 1.4.5
-->
<!-- BEGIN: LIST -->
<ul class="tocpg-plain tocpg-plain-level-{LIST_LEVEL}">
	<!-- BEGIN: ROW -->
	<li class="tocpg-plain-item">
		<!-- IF {ROW_URL} --><a href="{ROW_URL}">{ROW_TITLE}</a><!-- ELSE --><span>{ROW_TITLE}</span><!-- ENDIF -->
		{ROW_ITEMS}
	</li>
	<!-- END: ROW -->
</ul>
<!-- END: LIST -->
