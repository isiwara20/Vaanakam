<?php
/**
 * Translation API Endpoint - Vaanakam
 * Auto-translates English product, category, and subcategory names into Tamil
 */
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/helpers/language.php';

header('Content-Type: application/json; charset=utf-8');

$text = trim($_GET['text'] ?? $_POST['text'] ?? '');

if ($text === '') {
    echo json_encode([
        'success'  => true,
        'original' => '',
        'tamil'    => ''
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$translated = auto_translate_to_tamil($text);

echo json_encode([
    'success'  => true,
    'original' => $text,
    'tamil'    => $translated
], JSON_UNESCAPED_UNICODE);
