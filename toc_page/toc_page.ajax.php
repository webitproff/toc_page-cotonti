<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=ajax
 * [END_COT_EXT]
 */

/**
 * ============================================================
 * ДОКУМЕНТАЦИЯ ПО ХУКУ `ajax` И ФАЙЛУ toc_page.ajax.php
 * ============================================================
 *
 * Хук `ajax` в Cotonti используется для обработки AJAX-запросов
 * через публичный роутер. Несмотря на то, что этот файл вызывается
 * из административной части плагина (вкладка «Редактирование дерева»),
 * сам HTTP-запрос отправляется на публичный URL вида:
 *
 *   index.php?r=toc_page&ajax=search
 *
 * Как это работает в ядре Cotonti:
 * ---------------------------------
 * В файле system/router/Router.php, метод route():
 *
 *   $ajax = cot_import('r', 'G', 'ALP');
 *   ...
 *   if (!$extensionCode) {
 *       if (!empty($ajax)) {
 *           $extensionCode = $ajax;   // код расширения берётся из параметра `r`
 *       }
 *   }
 *   ...
 *   $route = $this->processFrontIncludeFiles(
 *       $extensionCode,
 *       $extensionType,
 *       $ajax !== null,          // признак AJAX-запроса
 *       $popup !== null
 *   );
 *
 * В методе processFrontIncludeFiles() определяется хук:
 *
 *   private function processFrontIncludeFiles(
 *       string $extensionCode,
 *       string $extensionType,
 *       bool $isAjax,
 *       bool $isPopup
 *   ): ?Route {
 *       if ($isPopup) {
 *           $hook = 'popup';
 *       } elseif ($isAjax) {
 *           $hook = 'ajax';      // <-- здесь формируется имя хука
 *       } else {
 *           $hook = ...;
 *       }
 *
 *       $route->includeFiles = cot_getextplugins(
 *           $hook,               // передаётся строка 'ajax'
 *           true,
 *           $extensionCode,
 *           $extensionType
 *       );
 *       ...
 *   }
 *
 * То есть прямого вызова cot_getextplugins('ajax') в роутере нет,
 * но переменная $hook получает значение 'ajax' и затем используется
 * как первый аргумент. Благодаря этому Cotonti подключает все файлы
 * плагина, зарегистрированные с хуком `ajax`.
 *
 * Так как эндпоинт технически доступен из публичной части,
 * в рабочем коде обязательно должна быть проверка прав доступа.
 * В нашем случае доступ разрешён только администраторам.
 *
 * ============================================================
 */

/**
 * Table of Contents Page plugin - AJAX search for pages in admin panel
 *
 * Filename: toc_page.ajax.php
 * Purpose:   Обрабатывает AJAX-запросы поиска страниц для Select2.
 *            Возвращает JSON-список страниц, отфильтрованных по названию.
 *            Доступ ограничен только администраторами.
 *
 * Path:     plugins/toc_page/toc_page.ajax.php
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

defined('COT_CODE') or die('Wrong URL');

// Защита: доступ только для администраторов
if (!cot::$usr['isadmin']) {
    echo json_encode(['results' => []]);
    exit;
}

// Устанавливаем заголовок ответа как JSON с поддержкой UTF-8
header('Content-Type: application/json; charset=UTF-8');

// Получаем поисковый запрос из GET-параметра `q`
$q = cot_import('q', 'G', 'TXT');
$q = trim($q);

// Если запрос короче 2 символов — возвращаем пустой результат (минимальный порог для Select2)
if (mb_strlen($q) < 2) {
    echo json_encode(['results' => []]);
    exit;
}

// ID текущей редактируемой страницы (в контексте toc_page не используется,
// но оставлено для потенциального исключения самой страницы из результатов)
$current_page_id = cot_import('current_page_id', 'G', 'INT');

// ID текущего пользователя (владельца). Используется для фильтрации,
// если пользователь не является администратором.
$current_user_id = cot_import('current_user_id', 'G', 'INT');

// Подключаем глобальные объекты базы данных
global $db, $db_pages;

// Формируем шаблон для поиска: ищем вхождение подстроки в названии страницы (без учёта регистра)
$like = '%' . mb_strtolower($q) . '%';

// Базовое условие: только опубликованные страницы и совпадение по названию
$where = "page_state = 0 AND LOWER(page_title) LIKE ?";
$params = [$like];

// Исключаем саму редактируемую страницу (если передан её ID) —
// на случай, если в будущем потребуется исключать страницу из списка
if ($current_page_id > 0) {
    $where .= " AND page_id != ?";
    $params[] = $current_page_id;
}

// Для не-администраторов ограничиваем поиск страницами, которыми владеет текущий пользователь.
// Важно: фильтр идёт по полю `page_ownerid` (владелец), а не по `page_author` (автор).
// В Cotonti "владелец" — это пользователь, создавший страницу, а "автор" может быть указан
// отдельно (например, если статья взята из внешнего источника).
if ($current_user_id > 0 && !cot::$usr['isadmin']) {
    $where .= " AND page_ownerid = ?";
    $params[] = $current_user_id;
}

// Выполняем запрос к базе данных: получаем ID и заголовок страницы.
// `LIMIT 50` ограничивает количество результатов в выпадающем списке.
$rows = $db->query(
    "SELECT page_id AS id, page_title AS text
     FROM $db_pages
     WHERE $where
     ORDER BY page_date DESC
     LIMIT 50",
    $params
)->fetchAll(PDO::FETCH_ASSOC);

// Приводим типы: id — целое число, text — строка
foreach ($rows as &$row) {
    $row['id'] = (int)$row['id'];
    $row['text'] = (string)$row['text'];
}

// Возвращаем JSON с результатами для Select2
echo json_encode(
    ['results' => $rows],
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
exit;