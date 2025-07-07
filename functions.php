<?php
function getProducts($pdo) {
    $stmt = $pdo->query("SELECT * FROM products LIMIT 12");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>