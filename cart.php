<?php
require 'config.php';
require 'functions.php';
include 'header.php';

$items = getCartItems($pdo);
$total = 0.0;
foreach ($items as $it) {
    $total += $it['VALOR_UNITARIO'] * $it['QUANTIDADE'];
}
$cep = $_GET['cep'] ?? '';
$frete = $cep ? 15.00 : 0.00; // cálculo simplificado
$totalComFrete = $total + $frete;
?>
<main class="container">
  <h2>Carrinho</h2>
  <?php if (!$items): ?>
    <p>Seu carrinho está vazio.</p>
  <?php else: ?>
    <table class="cart-table">
      <thead>
        <tr>
          <th></th>
          <th>Produto</th>
          <th>Qtd.</th>
          <th>Valor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($items as $item): ?>
        <?php
          $img = $item['IMAGEM'];
          if (!preg_match('/^https?:\/\//', $img)) {
              if ($img !== '' && $img[0] !== '/') {
                  $img = 'assets/images/' . $img;
              }
          }
          if ($img === '' || $img === null) {
              $img = 'assets/images/placeholder.svg';
          }
        ?>
        <tr>
          <td><img src="<?= htmlspecialchars($img) ?>" alt=""></td>
          <td><?php echo htmlspecialchars($item['NOME']); ?></td>
          <td><?php echo (int)$item['QUANTIDADE']; ?></td>
          <td>R$ <?php echo number_format($item['VALOR_UNITARIO']*$item['QUANTIDADE'], 2, ',', '.'); ?></td>
          <td><a class="btn" href="remove_item.php?id=<?php echo $item['ID']; ?>">Remover</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <form class="cart-shipping" method="get">
      <label>CEP:
        <input type="text" name="cep" value="<?php echo htmlspecialchars($cep); ?>">
      </label>
      <label>Cupom:
        <input type="text" name="cupom" value="<?php echo htmlspecialchars($_GET['cupom'] ?? ''); ?>">
      </label>
      <button class="btn" type="submit">Calcular Frete</button>
    </form>
    <p><strong>Total: R$ <?php echo number_format($totalComFrete, 2, ',', '.'); ?> (frete <?php echo number_format($frete,2,',','.'); ?>)</strong></p>
    <div class="cart-actions">
      <form action="checkout.php" method="post">
        <button class="btn btn-success" type="submit">Finalizar Compra - R$ <?php echo number_format($totalComFrete, 2, ',', '.'); ?></button>
      </form>
    </div>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
