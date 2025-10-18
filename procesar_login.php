<?php
session_start();
require_once "db.php";

$errores = [];
$usuario = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($usuario)) {
        $errores['usuario'] = "Debe llenar el campo de usuario.";
    }
    if (empty($password)) {
        $errores['password'] = "Debe llenar el campo de contraseña.";
    }

    if (empty($errores)) {
        $db = new SQLite3(__DIR__ . '/database/usuarios.db');

        $stmt = $db->prepare("SELECT id, nombreApellido, nombreUsuario, contrasena FROM usuarios WHERE nombreUsuario = :usuario OR correo = :usuario OR telefono = :usuario");
        $stmt->bindValue(':usuario', $usuario, SQLITE3_TEXT);
        $resultado = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if ($resultado) {
            if (password_verify($password, $resultado['contrasena'])) {
                $_SESSION['nombreApellido'] = $resultado['nombreApellido'];
                $_SESSION['nombreUsuario'] = $resultado['nombreUsuario'];
                $_SESSION['id'] = $resultado['id'];

                $db->close();
                header("Location: menuprincipal.php");
                exit();
            } else {
                $errores['password'] = "Contraseña incorrecta.";
            }
        } else {
            $errores['usuario'] = "Ingrese un nombre de usuario, correo o teléfono válido.";
        }

        $db->close();
    }

    $_SESSION['errores'] = $errores;
    $_SESSION['old'] = ['usuario' => $usuario];

    header("Location: index.php");
    exit();
} else {
    echo "Acceso no autorizado.";
}
