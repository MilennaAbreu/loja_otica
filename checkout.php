<?php
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId = $_SESSION['user_id'] ?? 0;
    $orderId = createOrder($pdo, $clientId);
    header('Location: order_success.php?id=' . $orderId);
    exit;
}
header('Location: cart.php');
?>
