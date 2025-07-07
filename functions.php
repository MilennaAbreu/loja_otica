<?php

/**
 * Busca produtos ativos no banco de dados principal do sistema.
 * A consulta traz apenas alguns campos utilizados na vitrine.
 */
function getProducts(PDO $pdo): array {
    $sql = "SELECT ID, NOME, VALOR_UNITARIO, IMAGEM FROM PRODUTO WHERE STATUS = 'ATIVO' LIMIT 12";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
