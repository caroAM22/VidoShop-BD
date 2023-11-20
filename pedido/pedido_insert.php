<?php
// Crear conexión con la BD
require('../config/conexion.php');
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores de los campos del formulario
    $codigo = $_POST["codigo"];
    $fecha_compra = $_POST["fecha_compra"];
    $costo_total = $_POST["costo_total"];
    $tipo_pedido = $_POST["tipo_pedido"];
    $direccion_envio = $_POST["direccion_envio"] ? $_POST["direccion_envio"] : null;
    $empleado_atiende = isset($_POST["empleado_atiende"]) ? $_POST["empleado_atiende"] : null;
    $empleado_envia = isset($_POST["empleado_envia"]) ? $_POST["empleado_envia"] : null;

    // Crear conexión con la BD
    require('../config/conexion.php');

    // Query SQL a la BD. Utiliza sentencias preparadas
    $query = "INSERT INTO `pedido`(`codigo`, `fecha_compra`, `costo_total`, `tipo_pedido`, `direccion_envio`, `empleado_atiende`, `empleado_envia`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $query);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "isdssii", $codigo, $fecha_compra, $costo_total, $tipo_pedido, $direccion_envio, $empleado_atiende, $empleado_envia);

    // Ejecutar la consulta
    $result = mysqli_stmt_execute($stmt);

    // Redirigir al usuario a la misma página
    if ($result) {
        // Si fue exitosa, redirigirse de nuevo a la página de la entidad
        header("Location: pedido.php");
    } else {
        echo "Ha ocurrido un error al crear el pedido: " . mysqli_error($conn);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>