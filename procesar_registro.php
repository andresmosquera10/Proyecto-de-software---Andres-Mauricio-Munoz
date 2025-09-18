<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errores = [];
    $old = $_POST;

    $nombreApellido = trim($_POST["nombreApellido"] ?? "");
    $nombreUsuario = trim($_POST["nombreUsuario"] ?? "");
    $fechaNacimiento = trim($_POST["fechaNacimiento"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $contrasena = trim($_POST["contrasena"] ?? "");
    $confirmarContrasena = trim($_POST["confirmarContrasena"] ?? "");

    if (empty($nombreApellido)) {
        $errores['nombreApellido'] = "El nombre y apellido es obligatorio.";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,50}$/", $nombreApellido)) {
        $errores['nombreApellido'] = "El nombre y apellido solo puede contener letras (máximo 50 caracteres).";
    }

    if (empty($nombreUsuario)) {
        $errores['nombreUsuario'] = "El nombre de usuario es obligatorio.";
    } elseif (!preg_match("/^[A-Za-z0-9._-]{8,25}$/", $nombreUsuario)) {
        $errores['nombreUsuario'] = "El nombre de usuario debe tener entre 8 y 25 caracteres, sin símbolos especiales.";
    }

    if (empty($fechaNacimiento)) {
        $errores['fechaNacimiento'] = "La fecha de nacimiento es obligatoria.";
    } elseif (preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechaNacimiento)) {
        $fecha = strtotime($fechaNacimiento);
        $hoy = strtotime(date("Y-m-d"));
        if ($fecha >= $hoy || $fecha < strtotime("1900-01-01")) {
            $errores['fechaNacimiento'] = "La fecha de nacimiento no es válida.";
        }
    } else {
        $errores['fechaNacimiento'] = "La fecha de nacimiento no tiene un formato válido.";
    }

    if (empty($telefono)) {
        $errores['telefono'] = "El número de teléfono es obligatorio.";
    } elseif (!preg_match("/^[0-9]{10}$/", $telefono)) {
        $errores['telefono'] = "El número de teléfono debe tener exactamente 10 dígitos.";
    }

    if (empty($correo)) {
        $errores['correo'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = "El correo electrónico no es válido.";
    }

    if (empty($contrasena)) {
        $errores['contrasena'] = "La contraseña es obligatoria.";
    } elseif (!preg_match("/^[A-Za-z0-9]{8,}$/", $contrasena)) {
        $errores['contrasena'] = "La contraseña debe tener al menos 8 caracteres y solo puede contener letras y números.";
    }

    if (empty($confirmarContrasena)) {
        $errores['confirmarContrasena'] = "Debe confirmar la contraseña.";
    } elseif ($contrasena !== $confirmarContrasena) {
        $errores['confirmarContrasena'] = "Las contraseñas no coinciden.";
    }

    if (!empty($errores)) {
        include "registro.php";
        exit;
    }

    try {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios 
                (nombreApellido, nombreUsuario, fechaNacimiento, telefono, correo, contrasena)
                VALUES 
                (:nombreApellido, :nombreUsuario, :fechaNacimiento, :telefono, :correo, :contrasena)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nombreApellido" => $nombreApellido,
            ":nombreUsuario" => $nombreUsuario,
            ":fechaNacimiento" => $fechaNacimiento,
            ":telefono" => $telefono,
            ":correo" => $correo,
            ":contrasena" => $hash
        ]);

        echo "<p>Usuario registrado exitosamente.</p>";
        echo "<p><a href='index.html'>Ir al inicio de sesión</a></p>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
