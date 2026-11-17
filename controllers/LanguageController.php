<?php
/**
 * Vaanakam - Language Controller
 * Switch storefront language between English and Tamil
 */
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../helpers/language.php';

$lang = strtolower(trim($_GET['lang'] ?? $_POST['lang'] ?? ''));

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
    || isset($_GET['ajax'])
    || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

if ($lang !== '' && set_current_language($lang)) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'lang'    => get_current_language(),
            'info'    => get_language_info()
        ]);
        exit;
    }
    
    $referer = $_SERVER['HTTP_REFERER'] ?? (defined('BASE_URL') ? BASE_URL : '/');
    header('Location: ' . $referer);
    exit;
}

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Invalid language code.']);
    exit;
}

$referer = $_SERVER['HTTP_REFERER'] ?? (defined('BASE_URL') ? BASE_URL : '/');
header('Location: ' . $referer);
exit;
