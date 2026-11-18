<?php
include("conexion.php");

try {
    // Limpiar datos anteriores (primero la tabla hija)
    $conexion->exec("DELETE FROM `Empleados`");
    $conexion->exec("DELETE FROM `Departamento`");

    // 1. Departamentos (tabla padre, primero)
    $conexion->exec("INSERT INTO `Departamento` (`Clave_Depto`, `Nombre`, `Presupuesto`) VALUES
        (1, 'Personal',     80000),
        (2, 'Almacén',      70000),
        (3, 'Contabilidad', 60000),
        (4, 'Manufactura',  50000),
        (5, 'Empaque',      30000)");

    // 2. Empleados (tabla hija)
    $conexion->exec("INSERT INTO `Empleados` (`Clave_empleado`, `Nombre`, `Apellidos`, `Clave_Depto`) VALUES
        ('EMP01', 'Armando',   'López',     2),
        ('EMP02', 'Tatiana',   'Vargas',    1),
        ('EMP03', 'Laura',     'Iturria',   3),
        ('EMP04', 'Juan',      'Pérez',     4),
        ('EMP05', 'Iván',      'López',     4),
        ('EMP06', 'Margarita', 'Hernández', 1),
        ('EMP07', 'Jesús',     'Pérez',     3),
        ('EMP08', 'Tonatiuh',  'Flores',    2),
        ('EMP09', 'Juan',      'López',     4),
        ('EMP10', 'José',      'Hernández', 5)");

    echo "Datos insertados correctamente";
} catch (PDOException $e) {
    echo "Error al insertar los datos: " . $e->getMessage();
}

$conexion = null;
?>
