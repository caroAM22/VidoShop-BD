<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
$query = "SELECT codigo, DATE_FORMAT(fecha_compra, '%d-%m-%Y') AS fecha_compra, costo_total, tipo_pedido, direccion_envio, empleado_atiende, empleado_envia FROM pedido;";

// Ejecutar la consulta
$resultadoPedido = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);

