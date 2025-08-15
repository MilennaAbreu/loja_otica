<?php
require 'config.php';
require 'functions.php';

$id  = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
if ($id > 0 && $qty > 0) {
    addToCart($pdo, $id, $qty);
}
header('Location: cart.php');
exit;
?>
