<?php
require 'config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $stmt = $pdo->prepare('SELECT ID, SENHA FROM USUARIO WHERE USERNAME=? AND STATUS="ATIVO"');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($senha, $user['SENHA'])) {
        $_SESSION['user_id'] = (int)$user['ID'];
        header('Location: index.php');
        exit;
    } else {
        $message = 'Credenciais inválidas';
    }
}
include 'header.php';
?>
<main class="container">
  <h2>Login</h2>
  <?php if ($message) echo '<p style="color:red">'.$message.'</p>'; ?>
  <form method="post">
    <label>Email:<br><input type="email" name="email" required></label><br>
    <label>Senha:<br><input type="password" name="senha" required></label><br>
    <button type="submit">Entrar</button>
  </form>
  <p>Ou entre com sua conta Google (requer configuração):</p>
  <div id="g_id_onload" data-client_id="YOUR_GOOGLE_CLIENT_ID" data-login_uri="google_login.php"></div>
  <div class="g_id_signin"></div>
</main>
<?php include 'footer.php'; ?>
