<!--
	Table of Contents Page v1.4.0 - сворачиваемое дерево
	File: plugins/toc_page/tpl/toc_page.tree.tpl
	Вызов: {PHP|cot_toc_page_render(1, 'toc_page.tree')}

	Стили: css/toc_page.css, скрипт: js/toc_page.js (подключаются через Resources в cot_toc_page_render()).
	В шаблоне нет <style> и <script>. Раскрытие работает на нативном <details>.
-->
<!-- BEGIN: LIST -->
<!-- IF {IS_ROOT} --><nav class="tocpg" id="{INSTANCE}" data-tocpg data-tocpg-tree="{TREE_ID}" aria-label="Table of contents"><!-- ENDIF -->
<ul class="tocpg-list">
	<!-- BEGIN: ROW -->
	<li class="tocpg-item">
		<!-- IF {ROW_HAS_CHILDREN} -->
		<details class="tocpg-node" data-id="{ROW_ID}">
			<summary class="tocpg-row{ROW_LVL}"><span class="tocpg-chev" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg></span><!-- IF {ROW_URL} --><a href="{ROW_URL}">{ROW_TITLE}</a><!-- ELSE --><span class="tocpg-title">{ROW_TITLE}</span><!-- ENDIF --></summary>
			<div class="tocpg-sub">{ROW_ITEMS}</div>
		</details>
		<!-- ELSE -->
		<div class="tocpg-row{ROW_LVL}"><span class="tocpg-ph"></span><!-- IF {ROW_URL} --><a href="{ROW_URL}">{ROW_TITLE}</a><!-- ELSE --><span class="tocpg-title">{ROW_TITLE}</span><!-- ENDIF --></div>
		<!-- ENDIF -->
	</li>
	<!-- END: ROW -->
</ul>
<!-- IF {IS_ROOT} --></nav><!-- ENDIF -->
<!-- END: LIST -->
