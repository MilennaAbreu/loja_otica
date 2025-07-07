<?php
require 'config.php';
require 'functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    removeCartItem($pdo, $id);
}
header('Location: cart.php');
exit;
?>
