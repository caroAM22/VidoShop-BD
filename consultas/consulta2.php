<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
    La segunda consulta muestra la cédula, el nombre y el número de
    pedidos que atendió cada empleado que cumple las siguientes dos condiciones:

    <ol>
        <li>Todos sus pedidos tienen la misma dirección.</li>
        <li>Debe tener al menos tres pedidos (es decir, deber tener 3, 4 o más pedidos).</li>
    </ol>
</p>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require('../config/conexion.php');

    $query = "SELECT e.cedula, e.nombre, COUNT(p.codigo) AS num_pedidos
              FROM empleado e
              JOIN pedido p ON e.cedula = p.empleado_atiende
              WHERE p.direccion_envio IS NOT NULL
                AND (
                    SELECT COUNT(DISTINCT direccion_envio)
                    FROM pedido
                    WHERE empleado_atiende = e.cedula
                ) = 1
              GROUP BY e.cedula, e.nombre
              HAVING num_pedidos >= 3";

    $resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    if ($resultadoC2 and $resultadoC2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Número de Pedidos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadoC2 as $fila):
            ?>
            <tr>
                <td class="text-center"><?= $fila["cedula"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["num_pedidos"]; ?></td>
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
