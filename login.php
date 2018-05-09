<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login/hola.php');
  }
  require 'database.php';
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
    #Verifico con la base de datos a ver si es la contraseña correcta
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = '|     Verifica tu correo y usuario e intenta de nuevo     |';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicia Sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Ingresa</h1>
    <span><a href="signup.php">Registrar</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Ingresa tu email">
      <input name="password" type="password" placeholder="Ingresa tu contraseña">
      <hr><input type="submit" value="Submit">
    </form>
  </body>
</html>