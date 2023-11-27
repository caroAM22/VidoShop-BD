<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CASILLERO (BONO REGALO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="bono_regalo_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="fecha_creacion" class="form-label">Fecha de creación</label>
            <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>

        <div class="mb-3">
            <label for="mes" class="form-label">Mes</label>
            <input type="text" class="form-control" id="mes" name="mes" required>
        </div>
        
        <div class="mb-3">
            <label for="cliente_dueno" class="form-label">Cliente dueño</label>
            <select name="cliente_dueno" id="cliente_dueno" class="form-select">
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../cliente/cliente_select.php");

                // Verificar si llegan datos
                if ($resultadoCliente) :

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCliente as $fila):
                ?>

                        <!-- Opción que se genera -->
                        <!-- Opción que se genera -->
                        <option value="<?= $fila["cedula"]; ?>"><?= $fila["cedula"]; ?></option>
                <?php
                    // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="cliente_utiliza" class="form-label">Cliente que utiliza</label>
            <select name="cliente_utiliza" id="cliente_utiliza" class="form-select">
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../cliente/cliente_select.php");

                // Verificar si llegan datos
                if ($resultadoCliente) :

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCliente as $fila):
                ?>

                        <!-- Opción que se genera -->
                        <!-- Opción que se genera -->
                        <option value="<?= $fila["cedula"]; ?>"><?= $fila["cedula"]; ?></option>
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
require("bono_regalo_select.php");

// Verificar si llegan datos
if($resultadoBonoRegalo and $resultadoBonoRegalo->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Fecha de creación</th>
                <th scope="col" class="text-center">Valor</th>
                <th scope="col" class="text-center">Mes</th>
                <th scope="col" class="text-center">Cliente dueño</th>
                <th scope="col" class="text-center">Cliente que utiliza</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoBonoRegalo as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["fecha_creacion"]; ?></td>
                <td class="text-center">$<?= $fila["valor"]; ?></td>
                <td class="text-center"><?= $fila["mes"]; ?></td>
                <td class="text-center"><?= $fila["cliente_dueno"] !== null ? 'C.C. ' . $fila["cliente_dueno"] : ''; ?></td>
                <td class="text-center"><?= $fila["cliente_utiliza"] !== null ? 'C.C. ' . $fila["cliente_utiliza"] : ''; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="bono_regalo_delete.php" method="post">
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