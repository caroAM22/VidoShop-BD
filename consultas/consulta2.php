<?php
include "../includes/header.php";
?>
<head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
</head>
<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
    La segunda consulta muestra la cédula, el nombre y el número de
    bonos de regalo que ha usado cada cliente que cumple las siguientes dos condiciones:

    <ol>
        <li>Todos sus bonos usados han sido para el mismo mes</li>
        <li>Debe haber usado al menos 3 bonos (es decir, deber haber utilizado 3, 4 o más).</li>
    </ol>
</p>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require('../config/conexion.php');

    $query = "SELECT c.cedula, c.nombre, COUNT(*) AS num_bonos
              FROM cliente c
              JOIN bono_regalo b ON c.cedula = b.cliente_utiliza
              GROUP BY c.cedula
              HAVING COUNT(DISTINCT b.mes) = 1 AND num_bonos >= 3";

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
                <th scope="col" class="text-center">Número de Bonos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadoC2 as $fila):
            ?>
            <tr>
                <td class="text-center"><?= $fila["cedula"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["num_bonos"]; ?></td>
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
