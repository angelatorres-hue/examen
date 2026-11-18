<?php
include("conexion.php");

try {
    // Borrar tablas viejas (si existen) para evitar estructuras antiguas
    $conexion->exec("SET FOREIGN_KEY_CHECKS = 0");
    $conexion->exec("DROP TABLE IF EXISTS `Empleados`");
    $conexion->exec("DROP TABLE IF EXISTS `Departamento`");
    $conexion->exec("SET FOREIGN_KEY_CHECKS = 1");

    // 1. Tabla padre
    $conexion->exec("CREATE TABLE `Departamento` (
        `Clave_Depto` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `Nombre` VARCHAR(30) NOT NULL,
        `Presupuesto` INT NOT NULL COMMENT 'Presupuesto en dólares (USD)'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci");
    echo "La tabla 'Departamento' se creó correctamente<br>";

    // 2. Tabla hija (la relación se agrega después en relaciondetablas.php)
    $conexion->exec("CREATE TABLE `Empleados` (
        `Clave_empleado` VARCHAR(8) NOT NULL PRIMARY KEY,
        `Nombre` VARCHAR(30) NOT NULL,
        `Apellidos` VARCHAR(30) NOT NULL,
        `Clave_Depto` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci");
    echo "La tabla 'Empleados' se creó correctamente";
} catch (PDOException $e) {
    echo "Error al crear las tablas: " . $e->getMessage();
}

$conexion = null;
?>
