<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sanitizar las entradas del usuario
$cedula = mysqli_real_escape_string($conn, $_POST["cedula"]);
$nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
$fecha_contratacion = mysqli_real_escape_string($conn, $_POST["fecha_contratacion"]);
$salario = mysqli_real_escape_string($conn, $_POST["salario"]);

// Query SQL a la BD con consulta preparada
$query = "INSERT INTO `empleado`(`cedula`, `nombre`, `fecha_contratacion`, `salario`) VALUES (?, ?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $query);

// Vincular los parámetros
mysqli_stmt_bind_param($stmt, "sssd", $cedula, $nombre, $fecha_contratacion, $salario);

// Ejecutar la consulta
$result = mysqli_stmt_execute($stmt);

// Verificar el resultado
if ($result) {
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header("Location: empleado.php");
} else {
    echo "Ha ocurrido un error al crear la persona";
}

// Cerrar la conexión y liberar recursos
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
