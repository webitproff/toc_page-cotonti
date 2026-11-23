<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=ajax
 * [END_COT_EXT]
 */

/**
 * Table of Contents Page plugin - AJAX search for pages in admin panel
 *
 * Filename: toc_page.ajax.php
 * Purpose:  Поиск страниц для Select2 (JSON). Доступ только для администраторов.
 *           Запрос: index.php?r=toc_page&ajax=search
 * Path:     plugins/toc_page/toc_page.ajax.php
 *
 * Table of Contents Page plugin for Cotonti v1.+, PHP v8.5, MySQL-8.4
 *
 * Source and updates   https://github.com/webitproff/toc_page-cotonti
 *
 * Date: Nov 23, 2026
 *
 * @package toc_page
 * @version 1.4.5
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

header('Content-Type: application/json; charset=UTF-8');

// Защита: эндпоинт публичный, поэтому только администраторам
if (empty(Cot::$usr['isadmin'])) {
    echo json_encode(['results' => []]);
    exit;
}

$q = trim((string)cot_import('q', 'G', 'TXT'));

// Минимум 2 символа
if (mb_strlen($q) < 2) {
    echo json_encode(['results' => []]);
    exit;
}

$current_page_id = (int)cot_import('current_page_id', 'G', 'INT');

$like = '%' . mb_strtolower($q) . '%';
$where = "page_state = 0 AND LOWER(page_title) LIKE ?";
$params = [$like];

if ($current_page_id > 0) {
    $where .= " AND page_id != ?";
    $params[] = $current_page_id;
}

$rows = Cot::$db->query(
    "SELECT page_id AS id, page_title AS text
     FROM " . Cot::$db->pages . "
     WHERE $where
     ORDER BY page_date DESC
     LIMIT 50",
    $params
)->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as &$row) {
    $row['id'] = (int)$row['id'];
    $row['text'] = (string)$row['text'];
}
unset($row);

echo json_encode(
    ['results' => $rows],
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
exit;
