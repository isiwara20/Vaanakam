<?php
require_once __DIR__ . '/config/app.php';
header("Location: " . BASE_URL . "my-orders.php", true, 301);
exit;
