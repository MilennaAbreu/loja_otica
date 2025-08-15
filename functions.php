<?php
/**
 * Busca produtos ativos no banco de dados principal do sistema.
 * A consulta traz apenas alguns campos utilizados na vitrine.
 */
function getProducts(PDO $pdo): array {
    $sql = "SELECT ID, NOME, VALOR_UNITARIO, IMAGEM FROM PRODUTO WHERE STATUS='ATIVO' LIMIT 12";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/** Obtem ou cria um carrinho para a sessao atual */
function getCartId(PDO $pdo): int {
    if (isset($_SESSION['cart_id'])) {
        return (int)$_SESSION['cart_id'];
    }
    $stmt = $pdo->prepare("INSERT INTO CARRINHO_COMPRAS (ID_CLIENTE) VALUES (?)");
    $clientId = $_SESSION['user_id'] ?? null;
    $stmt->execute([$clientId]);
    $_SESSION['cart_id'] = (int)$pdo->lastInsertId();
    return $_SESSION['cart_id'];
}

/** Adiciona item ao carrinho */
function addToCart(PDO $pdo, int $productId, int $qty = 1): void {
    $cartId = getCartId($pdo);
    $stmt = $pdo->prepare("SELECT QUANTIDADE FROM ITENS_CARRINHO WHERE ID_CARRINHO=? AND ID_PRODUTO=?");
    $stmt->execute([$cartId, $productId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($item) {
        $newQty = $item['QUANTIDADE'] + $qty;
        $up = $pdo->prepare("UPDATE ITENS_CARRINHO SET QUANTIDADE=? WHERE ID_CARRINHO=? AND ID_PRODUTO=?");
        $up->execute([$newQty, $cartId, $productId]);
    } else {
        $ins = $pdo->prepare("INSERT INTO ITENS_CARRINHO (ID_CARRINHO, ID_PRODUTO, QUANTIDADE) VALUES (?,?,?)");
        $ins->execute([$cartId, $productId, $qty]);
    }
}

/** Lista itens do carrinho */
function getCartItems(PDO $pdo): array {
    if (!isset($_SESSION['cart_id'])) {
        return [];
    }
    $stmt = $pdo->prepare("SELECT i.ID, i.QUANTIDADE, p.ID as PRODUTO_ID, p.NOME, p.VALOR_UNITARIO, p.IMAGEM FROM ITENS_CARRINHO i JOIN PRODUTO p ON i.ID_PRODUTO=p.ID WHERE i.ID_CARRINHO=?");
    $stmt->execute([$_SESSION['cart_id']]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/** Remove um item do carrinho */
function removeCartItem(PDO $pdo, int $itemId): void {
    $stmt = $pdo->prepare("DELETE FROM ITENS_CARRINHO WHERE ID=?");
    $stmt->execute([$itemId]);
}

/** Limpa carrinho */
function clearCart(PDO $pdo): void {
    if (!isset($_SESSION['cart_id'])) return;
    $stmt = $pdo->prepare("DELETE FROM ITENS_CARRINHO WHERE ID_CARRINHO=?");
    $stmt->execute([$_SESSION['cart_id']]);
}

/** Cria pedido a partir do carrinho */
function createOrder(PDO $pdo, int $clientId, string $formaPagamento = 'À VISTA'): int {
    $cartId = getCartId($pdo);
    $items = getCartItems($pdo);
    $total = 0;
    foreach ($items as $it) {
        $total += $it['VALOR_UNITARIO'] * $it['QUANTIDADE'];
    }
    $stmt = $pdo->prepare("INSERT INTO PEDIDO_ECOMMERCE (ID_CLIENTE, FORMA_PAGAMENTO, TOTAL) VALUES (?,?,?)");
    $stmt->execute([$clientId, $formaPagamento, $total]);
    $orderId = (int)$pdo->lastInsertId();
    $insertItem = $pdo->prepare("INSERT INTO ITENS_PEDIDO_ECOMMERCE (ID_PEDIDO, ID_PRODUTO, QUANTIDADE, VALOR_UNITARIO) VALUES (?,?,?,?)");
    $updateStock = $pdo->prepare("UPDATE PRODUTO SET ESTOQUE_ATUAL = ESTOQUE_ATUAL - ? WHERE ID=? AND ESTOQUE_ATUAL >= ?");
    foreach ($items as $it) {
        $insertItem->execute([$orderId, $it['PRODUTO_ID'], $it['QUANTIDADE'], $it['VALOR_UNITARIO']]);
        $updateStock->execute([$it['QUANTIDADE'], $it['PRODUTO_ID'], $it['QUANTIDADE']]);
    }
    clearCart($pdo);
    return $orderId;
}
?>
