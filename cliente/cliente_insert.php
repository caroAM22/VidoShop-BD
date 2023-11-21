<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sanitizar las entradas del usuario
$cedula = mysqli_real_escape_string($conn, $_POST["cedula"]);
$nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
$numero_contacto = mysqli_real_escape_string($conn, $_POST["numero_contacto"]);
$saldo = mysqli_real_escape_string($conn, $_POST["saldo"]);
$correo_electronico = mysqli_real_escape_string($conn, $_POST["correo_electronico"]);

// Query SQL a la BD con consulta preparada
$query = "INSERT INTO `cliente`(`cedula`, `nombre`, `numero_contacto`, `saldo`, `correo_electronico`) VALUES (?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $query);

// Vincular los parámetros
mysqli_stmt_bind_param($stmt, "isiis", $cedula, $nombre, $numero_contacto, $saldo , $correo_electronico);

// Ejecutar la consulta
$result = mysqli_stmt_execute($stmt);

// Verificar el resultado
if ($result) {
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header("Location: cliente.php");
} else {
    echo "Ha ocurrido un error al crear la persona";
}

// Cerrar la conexión y liberar recursos
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
