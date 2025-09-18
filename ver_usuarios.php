<?php
require_once "db.php";

try {
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Usuarios en la base de datos:</h3>";
    echo "<pre>";
    var_dump($usuarios);
    echo "</pre>";
} catch (PDOException $e) {
    echo "Error al consultar usuarios: " . $e->getMessage();
}