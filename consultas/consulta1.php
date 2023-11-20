<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    La primera consulta muestra la cédula y el nombre de cada empleado cuyo
    salario sea mayor o igual a la suma de los costos totales correspondiente a los pedidos que atendio.
</p>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require('../config/conexion.php');

    $query = "SELECT e.cedula, e.nombre
              FROM empleado e
              JOIN pedido p ON e.cedula = p.empleado_atiende
              WHERE e.salario >= (
                  SELECT SUM(costo_total)
                  FROM pedido
                  WHERE empleado_atiende = e.cedula
              )";

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