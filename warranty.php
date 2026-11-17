<?php
/**
 * Warranty check - Redirect to refund policy
 */
require_once __DIR__ . '/config/app.php';
header("Location: " . BASE_URL . "refund-policy.php", true, 301);
exit;
