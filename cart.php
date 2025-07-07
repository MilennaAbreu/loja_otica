<?php
require 'config.php';
require 'functions.php';
include 'header.php';

$items = getCartItems($pdo);
$total = 0.0;
foreach ($items as $it) {
    $total += $it['VALOR_UNITARIO'] * $it['QUANTIDADE'];
}
?>
<main class="container">
  <h2>Carrinho</h2>
  <?php if (!$items): ?>
    <p>Seu carrinho está vazio.</p>
  <?php else: ?>
    <table class="cart-table">
      <thead><tr><th>Produto</th><th>Qtd.</th><th>Valor</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><?php echo htmlspecialchars($item['NOME']); ?></td>
          <td><?php echo (int)$item['QUANTIDADE']; ?></td>
          <td>R$ <?php echo number_format($item['VALOR_UNITARIO']*$item['QUANTIDADE'], 2, ',', '.'); ?></td>
          <td><a class="btn" href="remove_item.php?id=<?php echo $item['ID']; ?>">Remover</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <p>Total: <strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></p>
    <form action="checkout.php" method="post">
      <button class="btn" type="submit">Finalizar Compra</button>
    </form>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
