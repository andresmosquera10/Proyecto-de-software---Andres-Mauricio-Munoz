<?php
$errores = $errores ?? [];

$nombreApellido = $_POST["nombreApellido"] ?? "";
$nombreUsuario = $_POST["nombreUsuario"] ?? "";
$fechaNacimiento = $_POST["fechaNacimiento"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$correo = $_POST["correo"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - En búsqueda de la ambrosía</title>
  <link rel="stylesheet" href="registrostyles.css" />
  <style>
    .error {
      color: red;
      font-size: 0.8em;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="background-image">
      <div class="overlay-text">

        <h1 class="title">Crea tu cuenta</h1>

        <div class="form-container">
          <form id="registration-form" action="/SENA/procesar_registro.php" method="POST">
            <div class="row">

              <div class="input-group">
                <label>Nombre y apellido</label>
                <input type="text" id="nombreApellido" name="nombreApellido" value="<?= htmlspecialchars($old['nombreApellido'] ?? '') ?>" />
                <?php if (!empty($errores['nombreApellido'])): ?>
                  <div class="error"><?= $errores['nombreApellido'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Nombre de usuario</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" value="<?= htmlspecialchars($old['nombreUsuario'] ?? '') ?>" />
                <?php if (!empty($errores['nombreUsuario'])): ?>
                  <div class="error"><?= $errores['nombreUsuario'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Fecha de nacimiento</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?= htmlspecialchars($old['fechaNacimiento'] ?? '') ?>" />
                <?php if (!empty($errores['fechaNacimiento'])): ?>
                  <div class="error"><?= $errores['fechaNacimiento'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Número de teléfono</label>
                <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($old['telefono'] ?? '') ?>" />
                <?php if (!empty($errores['telefono'])): ?>
                  <div class="error"><?= $errores['telefono'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($old['correo'] ?? '') ?>" />
                <?php if (!empty($errores['correo'])): ?>
                  <div class="error"><?= $errores['correo'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" />
                <?php if (!empty($errores['contrasena'])): ?>
                  <div class="error"><?= $errores['contrasena'] ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group">
                <label>Confirmar contraseña</label>
                <input type="password" id="confirmarContrasena" name="confirmarContrasena" />
                <?php if (!empty($errores['confirmarContrasena'])): ?>
                  <div class="error"><?= $errores['confirmarContrasena'] ?></div>
                <?php endif; ?>
              </div>
            </div>
            <div class="submit-container">
              <button type="submit">Registrarse</button>
            </div>
            <div class="login-link">
              <p>¿Ya tienes una cuenta? <a href="index.html">Inicia sesión</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>