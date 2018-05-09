<?php
  require 'database.php';
  $message = '';
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = '|     Cuenta creada satisfactoriamente     |';
    } else {
      $message = '|     Ya se ha creado una cuenta con este email     |';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrate</title>
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrar</h1>
    <span><a href="login.php">Iniciar sesion</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingresa el email">
      <input name="password" type="password" placeholder="Ingresa la contraseña">
      <input name="confirm_password" type="password" placeholder="Confirma la contraseña">
      <hr><input type="submit" value="Submit">
    </form>

  </body>
</html>