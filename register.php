<?php
require 'config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $nome  = $_POST['nome'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email inválido';
    } else {
        $stmt = $pdo->prepare('SELECT ID FROM USUARIO WHERE USERNAME=?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $message = 'Email já cadastrado';
        } else {
            $hash = password_hash($senha, PASSWORD_BCRYPT);
            $ins = $pdo->prepare('INSERT INTO USUARIO (USERNAME, SENHA, NOME, STATUS) VALUES (?,?,?,"ATIVO")');
            $ins->execute([$email, $hash, $nome]);
            $_SESSION['user_id'] = (int)$pdo->lastInsertId();
            header('Location: index.php');
            exit;
        }
    }
}
include 'header.php';
?>
<main class="container">
  <h2>Cadastro</h2>
  <?php if ($message) echo '<p style="color:red">'.$message.'</p>'; ?>
  <div class="form-card">
    <form method="post">
      <label>Email:<br><input type="email" name="email" required></label>
      <label>Nome:<br><input type="text" name="nome" required></label>
      <label>Senha:<br><input type="password" name="senha" required></label>
      <button class="btn" type="submit">Cadastrar</button>
    </form>
  </div>
</main>
<?php include 'footer.php'; ?>
