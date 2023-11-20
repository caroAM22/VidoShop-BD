<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$fecha_compra = $_POST["fecha_compra"];
$costo_total = $_POST["costo_total"];
$tipo_pedido = $_POST["tipo_pedido"];
$direccion_envio = $_POST["direccion_envio"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `pedido`(`codigo`,`fecha_compra`, `costo_total`, `tipo_pedido`,`direccion_envio`) VALUES ('$codigo', '$fecha_compra', '$costo_total', '$tipo_pedido', '$direccion_envio')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: pedido.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);