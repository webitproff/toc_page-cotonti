<!-- 
	/**
	* Table of Contents Page plugin - сворачиваемое дерево с запоминанием состояния
	* File: plugins/toc_page/tpl/toc_page.tree_cotonti.tpl
	* Кастомизированный более продвинутый шаблон, вызывать его по примеру {PHP|cot_toc_page_render(9, 'toc_page.tree_cotonti')}
	*
	* Table of Contents Page plugin for Cotonti v1.+, PHP 8.5+, MySQL 8.4
	*
	* Source and updates   https://github.com/webitproff/toc_page-cotonti
	* ReadMeMore:          https://abuyfile.com/ru/market/cotonti/plugs/toc-page-cotonti
	* Support:             https://abuyfile.com/ru/forums/cotonti/custom/plugs
	* Cotonti CMF:         https://github.com/Cotonti/Cotonti
	*
	* Date: Aug 25, 2026
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
    <li class="toc-page-item level-{ROW_LEVEL}" data-id="{ROW_ID}" data-has-children="{ROW_HAS_CHILDREN}">
        <div class="toc-item-row">
			<!-- IF {ROW_HAS_CHILDREN} -->
			<span class="toc-toggle" aria-hidden="true">
				<svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
					<path class="icon-closed" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
					<path class="icon-open" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/>
				</svg>
			</span>
			<!-- ELSE -->
			<span class="toc-placeholder"></span>
			<!-- ENDIF -->
            <!-- IF {ROW_URL} -->
            <a href="{ROW_URL}">{ROW_TITLE}</a>
            <!-- ELSE -->
            <span class="toc-page-title">{ROW_TITLE}</span>
            <!-- ENDIF -->
        </div>
        {ROW_ITEMS}
    </li>
    <!-- END: ROW -->
</ul>
<!-- IF {IS_ROOT} -->
<style>
    /* ==============================================
       НАСТРОЙКА ЦВЕТОВ ИКОНОК
       Меняйте значения переменных ниже для каждой темы
    ============================================== */
    :root {
        --toc-icon-closed: #555;        /* цвет закрытой стрелки (светлая тема) */
        --toc-icon-open: #27ae60;       /* цвет открытой стрелки (светлая тема) */
    }
    [data-bs-theme="dark"] {
        --toc-icon-closed: #f0a04b;     /* цвет закрытой стрелки (тёмная тема) */
        --toc-icon-open: #2ecc71;       /* цвет открытой стрелки (тёмная тема) */
    }
    /* ============================================== */

    .toc-page {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }
    .toc-page .toc-page {
        padding-left: 1.25rem;
    }
    .toc-page-item > ul {
        display: none;
    }
    .toc-page-item.open > ul {
        display: block;
    }
    .toc-item-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0;
    }

    /* Кнопка-стрелка */
    .toc-toggle {
        cursor: pointer;
        user-select: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        flex: 0 0 24px;
        color: var(--toc-icon-closed);
        background-color: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, background-color 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    .toc-toggle:hover {
        background-color: rgba(0, 0, 0, 0.1);
        border-color: rgba(0, 0, 0, 0.25);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    }

    .toc-toggle:active {
        transform: translateY(1px);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .toc-toggle svg {
        width: 26px;
        height: 26px;
    }

    .icon-open {
        display: none;
    }
    .toc-page-item.open > .toc-item-row .icon-closed {
        display: none;
    }
    .toc-page-item.open > .toc-item-row .icon-open {
        display: block;
        color: var(--toc-icon-open);
    }

    .toc-placeholder {
        display: inline-block;
        width: 24px;
        flex: 0 0 24px;
    }

    .toc-item-row a,
    .toc-item-row .toc-page-title {
        text-decoration: none;
        color: inherit;
    }

    /* Тёмная тема для кнопки */
    [data-bs-theme="dark"] .toc-toggle {
        background-color: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    [data-bs-theme="dark"] .toc-toggle:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.35);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
</style>

<script>
(function() {
    var storageKey = 'toc_page_open_items';
    var list = document.currentScript?.previousElementSibling;
    if (!list || !list.classList.contains('toc-page')) {
        list = document.querySelector('ul.toc-page');
    }
    if (!list) return;

    var openIds = [];
    try {
        var saved = localStorage.getItem(storageKey);
        if (saved) {
            openIds = JSON.parse(saved);
            if (!Array.isArray(openIds)) openIds = [];
        }
    } catch (e) {}

    function applyState() {
        document.querySelectorAll('.toc-page-item[data-has-children="1"]').forEach(function(li) {
            var id = li.getAttribute('data-id');
            if (openIds.indexOf(id) !== -1) {
                li.classList.add('open');
            } else {
                li.classList.remove('open');
            }
        });
    }

    list.addEventListener('click', function(e) {
        var toggle = e.target.closest('.toc-toggle');
        if (!toggle) return;
        var li = toggle.closest('.toc-page-item');
        if (!li || li.getAttribute('data-has-children') !== '1') return;
        var id = li.getAttribute('data-id');
        var isOpen = li.classList.toggle('open');
        if (isOpen) {
            if (openIds.indexOf(id) === -1) openIds.push(id);
        } else {
            openIds = openIds.filter(function(x) { return x !== id; });
        }
        try {
            localStorage.setItem(storageKey, JSON.stringify(openIds));
        } catch (err) {}
    });

    applyState();
})();
</script>
<!-- ENDIF -->
<!-- END: LIST -->
