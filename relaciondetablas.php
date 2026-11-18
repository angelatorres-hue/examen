<?php
include("conexion.php");

try {
    // Si la relación ya existía, se elimina para poder crearla de nuevo
    try {
        $conexion->exec("ALTER TABLE `Empleados` DROP FOREIGN KEY `fk_empleados_departamento`");
    } catch (PDOException $e) {
        // No existía, se continúa
    }

    $sql = "ALTER TABLE `Empleados`
            ADD CONSTRAINT `fk_empleados_departamento`
            FOREIGN KEY (`Clave_Depto`)
            REFERENCES `Departamento` (`Clave_Depto`)
            ON UPDATE CASCADE
            ON DELETE RESTRICT";

    $conexion->exec($sql);
    echo "La relación entre Empleados y Departamento se creó correctamente";
} catch (PDOException $e) {
    echo "Error al crear la relación: " . $e->getMessage();
}

$conexion = null;
?>
