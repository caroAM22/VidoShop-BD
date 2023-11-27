<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    La primera consulta muestra la cédula y el nombre de cada cliente cuyo
    saldo es mayor o igual a la suma de los valores correspondientes a los bonos de regalo que utilizó.
</p>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require('../config/conexion.php');

    # El coalesce hace que cuando el subquery de null lo vuelva 0 por defecto. Es decir un cliente que no
    # ha usado nunca un bono_regalo también debe salir en la consulta.
    $query = "SELECT c.cedula, c.nombre
              FROM cliente c
              WHERE c.saldo >= COALESCE((
                  SELECT SUM(valor)
                  FROM bono_regalo b
                  WHERE b.cliente_utiliza = c.cedula
              ),0)";

    $resultadoBusqueda = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    if ($resultadoBusqueda and $resultadoBusqueda->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadoBusqueda as $fila):
            ?>
            <tr>
                <td class="text-center"><?= $fila["cedula"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
            </tr>
            <?php
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
    No se encontraron resultados para esta consulta
</div>
<?php
    endif;
}

include "../includes/footer.php";
?>