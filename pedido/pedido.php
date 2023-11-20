<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a EMPRESA (PEDIDO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="pedido_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="fecha_compra" class="form-label">Fecha de compra</label>
            <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
        </div>

        <div class="mb-3">
            <label for="costo_total" class="form-label">Costo total</label>
            <input type="number" class="form-control" id="costo_total" name="costo_total" required>
        </div>

        <div class="mb-3">
            <label for="tipo_pedido" class="form-label">Tipo de pedido</label>
            <input type="text" class="form-control" id="tipo_pedido" name="tipo_pedido" required>
        </div>

        <div class="mb-3">
            <label for="direccion_envio" class="form-label">Dirección de envío</label>
            <input type="text" class="form-control" id="direccion_envio" name="direccion_envio" required>
        </div>
        
        <!-- Consultar la lista de empleados y desplegarlos -->
        <div class="mb-3">
            <label for="empleado" class="form-label">Empleado</label>
            <select name="empleado" id="empleado" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../empleado/empleado_select.php");
                
                // Verificar si llegan datos
                if($resultadoEmpleado):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoEmpleado as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["cedula"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["cedula"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("pedido_select.php");

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
                <th scope="col" class="text-center">Fecha de compra</th>
                <th scope="col" class="text-center">Costo total</th>
                <th scope="col" class="text-center">Tipo de pedido</th>
                <th scope="col" class="text-center">Dirección de envío</th>
                <th scope="col" class="text-center">Empleado</th>
                <th scope="col" class="text-center">Acciones</th>
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
                <td class="text-center"><?= $fila["fecha_compra"]; ?></td>
                <td class="text-center">$<?= $fila["costo_total"]; ?></td>
                <td class="text-center">$<?= $fila["tipo_pedido"]; ?></td>
                <td class="text-center">$<?= $fila["direccion_envio"]; ?></td>
                <td class="text-center">C.C. <?= $fila["empleado"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="pedido_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>