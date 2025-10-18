<?php
session_start();

$errores = $_SESSION['errores'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errores'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>En búsqueda de la ambrosía</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .error {
      color: red;
      font-size: 0.9em;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="background-image">
      <div class="overlay-text">
        <h1>En búsqueda de<br>la ambrosía</h1>
      </div>

      <div class="form-container">
        <form id="login-form" action="procesar_login.php" method="POST">
          <div class="input-group">
            <label for="usuario">Usuario, correo electrónico o número de teléfono</label>
            <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($old['usuario'] ?? '') ?>" />
            <?php if (!empty($errores['usuario'])): ?>
              <div class="error"><?= $errores['usuario'] ?></div>
            <?php endif; ?>
          </div>

          <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" />
            <?php if (!empty($errores['password'])): ?>
              <div class="error"><?= $errores['password'] ?></div>
            <?php endif; ?>
          </div>

          <div class="checkbox-group">
            <input type="checkbox" id="remember" />
            <label for="remember">Recordar contraseña</label>
          </div>

          <button type="submit" class="login-button">Iniciar sesión</button>

          <div class="links">
            <a href="restaurar.html">¿Olvidaste la contraseña?</a>
          </div>

          <hr class="divider">

          <button type="button" class="create-button" onclick="window.location.href='registro.php'">Crear una cuenta</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>