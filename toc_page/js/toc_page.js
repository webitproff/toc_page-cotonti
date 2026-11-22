/**
 * Table of Contents Page v1.4.0
 * plugins/toc_page/js/toc_page.js
 *
 * Раскрытие/сворачивание обеспечивает нативный <details>, скрипт добавляет:
 * запоминание состояния (отдельно для каждого дерева), подсветку текущей страницы,
 * раскрытие пути к ней и синхронизацию одинаковых деревьев на странице.
 * Работает со всеми деревьями [data-tocpg]; не использует currentScript
 * и глобальные селекторы вроде "первый ul на странице".
 */
(function () {
	'use strict';
	if (window.tocpgInit) { return; }

	var KEY = 'tocpg:open:';

	function read(tree) {
		try {
			var v = JSON.parse(localStorage.getItem(KEY + tree));
			return Array.isArray(v) ? v.map(String) : [];
		} catch (e) { return []; }
	}
	function write(tree, ids) {
		try { localStorage.setItem(KEY + tree, JSON.stringify(ids)); } catch (e) {}
	}
	function norm(path) {
		try { path = decodeURIComponent(path); } catch (e) {}
		return path.replace(/\/+$/, '') || '/';
	}

	// Программное изменение помечаем, чтобы не сохранять его как действие пользователя
	function setOpen(details, open) {
		if (details.open === open) { return; }
		details._tocpgExpect = open;
		details.open = open;
	}

	function initRoot(root) {
		if (root.hasAttribute('data-tocpg-init')) { return; }
		root.setAttribute('data-tocpg-init', '1');

		var ids = read(root.getAttribute('data-tocpg-tree'));
		root.querySelectorAll('details.tocpg-node[data-id]').forEach(function (d) {
			setOpen(d, ids.indexOf(d.getAttribute('data-id')) !== -1);
		});

		// Подсветить текущую страницу и раскрыть путь к ней (без записи в localStorage)
		var here = norm(location.pathname);
		root.querySelectorAll('a[href]').forEach(function (a) {
			var p;
			try { p = norm(new URL(a.getAttribute('href'), location.href).pathname); } catch (e) { return; }
			if (p !== here) { return; }
			a.setAttribute('aria-current', 'page');
			var d = a.closest('details.tocpg-node');
			while (d) {
				setOpen(d, true);
				d = d.parentElement ? d.parentElement.closest('details.tocpg-node') : null;
			}
		});

		// Анимация включается только после первой расстановки состояния
		requestAnimationFrame(function () {
			requestAnimationFrame(function () { root.setAttribute('data-tocpg-ready', ''); });
		});
	}

	function initAll() {
		document.querySelectorAll('[data-tocpg]').forEach(initRoot);
	}

	// 'toggle' не всплывает, поэтому один обработчик в фазе capture на весь документ
	document.addEventListener('toggle', function (e) {
		var d = e.target;
		if (!d || d.tagName !== 'DETAILS' || !d.classList.contains('tocpg-node')) { return; }
		var root = d.closest('[data-tocpg]');
		if (!root) { return; }

		if (d._tocpgExpect === d.open) { d._tocpgExpect = undefined; return; }

		var tree = root.getAttribute('data-tocpg-tree');
		var id = d.getAttribute('data-id');
		var list = read(tree).filter(function (x) { return x !== id; });
		if (d.open) { list.push(id); }
		write(tree, list);

		// Синхронизация других экземпляров этого же дерева (шапка + сайдбар и т.п.)
		document.querySelectorAll('[data-tocpg][data-tocpg-tree="' + tree + '"] details.tocpg-node[data-id="' + id + '"]')
			.forEach(function (o) { if (o !== d) { setOpen(o, d.open); } });
	}, true);

	window.tocpgInit = initAll; // для контента, подгруженного через AJAX/pjax

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initAll);
	} else {
		initAll();
	}
})();
