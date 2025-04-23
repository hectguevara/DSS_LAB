<?php
require_once('Connections/conn.php');
//IMPLMENTAR MECANISMO DE AUTENTICACION POR SESIONES

//NO OLVIDE LA BITACORA

// Número de resultados por página
$resultados_por_pagina = 5;

// Obtener la página actual (si no se especifica, la página es 1)
if (isset($_GET["pagina"])) {
    $pagina_actual = $_GET["pagina"];
} else {
    $pagina_actual = 1;
}

// Calcular el índice de inicio para la consulta SQL
$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

$queryBitacora = "SELECT * FROM bitacora LIMIT $resultados_por_pagina OFFSET $indice_inicio";

$RsBitacora = $db->query($queryBitacora);

$totalRows_RsBitacora = $RsBitacora->num_rows;

$TituloSeccion = "Bitácora de Usuarios";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="col-sm-7">
                <div class="text-center border border-primary rounded">
                    <?php require_once('menu.php'); ?>
                    <center>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">FECHA Y HORA</th>
                                    <th scope="col">PAGINA</th>
                                    <th scope="col">TABLA</th>
                                    <th scope="col">CONSULTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_RsBitacora = $RsBitacora->fetch_assoc()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row_RsBitacora['FECHA_HORA']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_RsBitacora['PAGINA']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_RsBitacora['TABLA']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_RsBitacora['TIPO_CONSULTA']; ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
                            </tbody>
                        </table>
                        <?php
                        // Calcular el número total de páginas
                        //OBTENGA EL TOTAL DE RESULTADOS CON UNA CONSULTA TIPO COUNT(*)
                        $total_resultados = $row_total["total"];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $paginas_a_mostrar = 8;
                        $mitad_paginas = floor($paginas_a_mostrar / 2);

                        $inicio_paginacion = max(1, $pagina_actual - $mitad_paginas);
                        $fin_paginacion = min($total_paginas, $inicio_paginacion + $paginas_a_mostrar - 1);

                        if ($fin_paginacion - $inicio_paginacion + 1 < $paginas_a_mostrar) {
                            $inicio_paginacion = max(1, $fin_paginacion - $paginas_a_mostrar + 1);
                        }

                        // Mostrar los enlaces de paginación
                        echo "<br>";
                        echo '<nav aria-label="...">
                            <ul class="pagination pagination-lg  justify-content-center">';
                        for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++) {
                            echo '<li class = "page-item"><a class = "page-link" href = "bitacora.php?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                        echo '</ul>
                        </nav>';
                        ?>
                    </center>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>