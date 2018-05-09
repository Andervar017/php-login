<?php
  session_start();
  require 'database.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My College</title><br>
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Hola <?= $user['email']; ?>
      <br>Haz ingresado exitosamente
      <hr>
      <h2><a href="logout.php">Salir</a> o
      <a href="/Juegocollege/juego.php">Entrar al juego
      </a></h2>
    <?php else: ?>
      <h1>Registro e ingreso</h1>

      <h2><a href="login.php">Ingresar</a> o
      <a href="signup.php">Registrar</a><h2>
    <?php endif; ?>
  </body>
</html>