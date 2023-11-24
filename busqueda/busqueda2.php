<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    Este formulario permite ingresar dos fechas f1 y f2 (cada fecha con día, mes y año),
    f2 >= f1 y un mes. Se debe mostrar todos los datos de los bonos que tienen fecha de
    creación entre f1 (inclusive) y f2 (inclusive), que son del mes ingresado,
    que tienen un cliente dueño y que fue utilizado por otro cliente.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="fecha1" class="form-label">Fecha Inicial</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>

        <div class="mb-3">
            <label for="fecha2" class="form-label">Fecha Final</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>

        <div class="mb-3">
            <label for="mes" class="form-label">Mes</label>
            <input type="text" class="form-control" id="mes" name="mes" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>

</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer esta verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $mes = $_POST["mes"];

    // Query SQL a la BD
    $query = "SELECT * FROM bono_regalo 
              WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' 
              AND mes = '$mes'
              AND cliente_utiliza IS NOT NULL
              AND cliente_dueno IS NOT NULL";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if ($resultadoB2 and $resultadoB2->num_rows > 0):
?>

    <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

        <table class="table table-striped table-bordered">

            <!-- Títulos de la tabla, cambiarlos -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Fecha de Compra</th>
                    <th scope="col" class="text-center">Valor</th>
                    <th scope="col" class="text-center">Mes</th>
                    <th scope="col" class="text-center">Cliente dueño</th>
                    <th scope="col" class="text-center">Cliente que utiliza</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoB2 as $fila):
                ?>

                    <!-- Fila que se generará -->
                    <tr>
                        <!-- Cada una de las columnas, con su valor correspondiente -->
                        <td class="text-center"><?= $fila["codigo"]; ?></td>
                        <td class="text-center"><?= date("d-m-Y", strtotime($fila["fecha_creacion"])); ?></td>
                        <td class="text-center"><?= $fila["valor"]; ?></td>
                        <td class="text-center"><?= $fila["mes"]; ?></td>
                        <td class="text-center"><?= $fila["cliente_dueno"]; ?></td>
                        <td class="text-center"><?= $fila["cliente_utiliza"]; ?></td>
                    </tr>

                <?php
                // Cerrar los estructuras de control
                endforeach;
                ?>

            </tbody>

        </table>
    </div>

    <!-- Mensaje de error si no hay resultados -->
<?php else : ?>

    <div class="alert alert-danger text-center mt-5">
        No se encontraron resultados para esta consulta
    </div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>
