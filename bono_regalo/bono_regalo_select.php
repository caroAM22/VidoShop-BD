<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
$query = "SELECT codigo, DATE_FORMAT(fecha_creacion, '%d-%m-%Y') AS fecha_creacion, valor, mes, cliente_dueno, cliente_utiliza FROM bono_regalo;";

// Ejecutar la consulta
$resultadoBonoRegalo = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);

