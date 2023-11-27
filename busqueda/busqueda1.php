<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    Este formulario permite ingresar la cédula de un cliente. 
    Luego, se muestra el código y la fecha de creación de todos los bonos que el cliente utilizó, 
    siempre y cuando estos bonos no sean propiedad de algún cliente.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a este mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula del cliente</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar Bonos</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer esta verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $cedula = $_POST["cedula"];

    // Query SQL a la BD para obtener los pedidos del empleado
    $query = "SELECT codigo, DATE_FORMAT(fecha_creacion, '%d-%m-%Y') AS fecha_creacion 
              FROM bono_regalo
              WHERE cliente_utiliza = '$cedula' AND cliente_dueno IS NULL";

    // Ejecutar la consulta
    $resultadoPedido = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoPedido and $resultadoPedido->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Fecha de creación</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoPedido as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["fecha_creacion"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta búsqueda
</div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>
