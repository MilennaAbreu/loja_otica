<?php
require 'config.php';
include 'header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
?>
<main class="container">
  <h2>Pedido realizado</h2>
  <p>Obrigado por comprar conosco! Seu pedido #<?php echo $id; ?> foi registrado.</p>
  <a href="index.php">Continuar comprando</a>
</main>
<?php include 'footer.php'; ?>
