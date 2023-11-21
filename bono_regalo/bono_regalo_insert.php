<?php
// Crear conexión con la BD
require('../config/conexion.php');
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores de los campos del formulario
    $codigo = $_POST["codigo"];
    $fecha_creacion = $_POST["fecha_creacion"];
    $valor = $_POST["valor"];
    $mes = $_POST["mes"];
    $cliente_dueno = isset($_POST["cliente_dueno"]) ? $_POST["cliente_dueno"] : null;
    $cliente_utiliza = isset($_POST["cliente_utiliza"]) ? $_POST["cliente_utiliza"] : null;

    // Crear conexión con la BD
    require('../config/conexion.php');

    // Query SQL a la BD. Utiliza sentencias preparadas
    $query = "INSERT INTO `bono_regalo`(`codigo`, `fecha_creacion`, `valor`, `mes`, `cliente_dueno`, cliente_utiliza) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $query);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "isisii", $codigo, $fecha_creacion, $valor, $mes, $cliente_dueno, $cliente_utiliza);

    // Ejecutar la consulta
    $result = mysqli_stmt_execute($stmt);

    // Redirigir al usuario a la misma página
    if ($result) {
        // Si fue exitosa, redirigirse de nuevo a la página de la entidad
        header("Location: bono_regalo.php");
    } else {
        echo "Ha ocurrido un error al crear el pedido: " . mysqli_error($conn);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>