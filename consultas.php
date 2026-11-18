<?php
include("conexion.php");

$consultas = [
    "a) Obtener todos los datos de los departamentos" =>
        "SELECT * FROM Departamento",

    "b) Obtener todos los datos de los empleados" =>
        "SELECT * FROM Empleados",

    "c) Empleados que se apellidan 'Lopez'" =>
        "SELECT * FROM Empleados WHERE Apellidos = 'Lopez'",

    "d) Empleados que se apellidan 'Lopez' y los que se apellidan 'Perez'" =>
        "SELECT * FROM Empleados WHERE Apellidos IN ('Lopez', 'Perez')",

    "e) Nombre y clave de empleado de los trabajadores del departamento 4" =>
        "SELECT Nombre, Clave_empleado FROM Empleados WHERE Clave_Depto = 4",

    "f) Empleados de los departamentos 1 o 3, ordenados alfabéticamente por nombre" =>
        "SELECT * FROM Empleados WHERE Clave_Depto IN (1, 3) ORDER BY Nombre ASC",

    "g) Nombre y apellidos de los empleados cuyo apellido comienza con 'H'" =>
        "SELECT Nombre, Apellidos FROM Empleados WHERE Apellidos LIKE 'H%'",

    "h) Departamentos con presupuesto entre \$50,000 y \$70,000" =>
        "SELECT * FROM Departamento WHERE Presupuesto BETWEEN 50000 AND 70000",

    "i) Clave, nombre y apellidos de los empleados del departamento de Contabilidad" =>
        "SELECT e.Clave_empleado, e.Nombre, e.Apellidos
         FROM Empleados e
         INNER JOIN Departamento d ON e.Clave_Depto = d.Clave_Depto
         WHERE d.Nombre = 'Contabilidad'",

    "j) Nombre y apellidos de cada empleado, con el nombre de su departamento" =>
        "SELECT e.Nombre, e.Apellidos, d.Nombre AS Departamento
         FROM Empleados e
         INNER JOIN Departamento d ON e.Clave_Depto = d.Clave_Depto",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h3 { margin-bottom: 4px; }
        pre { background: #f4f4f4; padding: 8px; margin: 4px 0 8px; }
        table { border-collapse: collapse; margin-bottom: 25px; }
        th, td { border: 1px solid #000; padding: 6px 14px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
<h2>5. Consultas</h2>
<?php
foreach ($consultas as $titulo => $sql) {
    echo "<h3>" . htmlspecialchars($titulo) . "</h3>";
    echo "<pre>" . htmlspecialchars(preg_replace('/\s+/', ' ', $sql)) . "</pre>";

    try {
        $filas = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if (count($filas) === 0) {
            echo "<p>Sin resultados</p>";
            continue;
        }

        echo "<table><tr>";
        foreach (array_keys($filas[0]) as $col) {
            echo "<th>" . htmlspecialchars(strtoupper($col)) . "</th>";
        }
        echo "</tr>";
        foreach ($filas as $fila) {
            echo "<tr>";
            foreach ($fila as $col => $valor) {
                // El presupuesto está en dólares
                if ($col === 'Presupuesto') {
                    $valor = '$' . number_format($valor);
                }
                echo "<td>" . htmlspecialchars($valor) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
$conexion = null;
?>
</body>
</html>
