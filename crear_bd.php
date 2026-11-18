<?php
// Este archivo se conecta SIN indicar base de datos, porque todavía no existe.
try {
    $con = new PDO("mysql:host=localhost;charset=utf8mb4", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS personal CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci";
    $con->exec($sql);
    echo "Base de datos 'personal' creada exitosamente";
} catch (PDOException $e) {
    echo "Error al crear la base de datos: " . $e->getMessage();
}
$con = null;
?>
