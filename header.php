<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Óticas Alamanda</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
  <header class="main-header">
    <div class="header-top container">
      <div class="logo"><a href="index.php"><img src="assets/images/logo.png" alt="Óticas Alamanda"></a></div>
      <button id="btn-hamburger" class="hamburger"><span></span><span></span><span></span></button>
      <nav class="main-nav">
        <ul>
          <li><a href="#">Óculos de Sol</a></li>
          <li><a href="#">Óculos de Grau</a></li>
          <li><a href="#">Lançamentos</a></li>
          <li><a href="#">Ofertas</a></li>
          <li><a href="tryon.php">Provador</a></li>

          <li><a href="try_on.php">Provador</a></li>

        </ul>
      </nav>
      <div class="header-icons">
        <a href="cart.php"><img src="assets/images/icon-cart.svg" alt="Carrinho"></a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="logout.php"><img src="assets/images/icon-user.svg" alt="Sair"></a>
        <?php else: ?>
          <a href="login.php"><img src="assets/images/icon-user.svg" alt="Minha Conta"></a>
        <?php endif; ?>
      </div>
    </div>
  </header>
