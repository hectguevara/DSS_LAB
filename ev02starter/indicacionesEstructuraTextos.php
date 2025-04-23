<?php
require_once('Connections/conn.php');

//IMPLMENTAR MECANISMO DE AUTENTICACION POR SESIONES

//NO OLVIDE LA BITACORA

$TituloSeccion = "Indicaciones Crear Estructura de Textos";
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
                        <p class="lead">
                            De acuerdo a la estructura que se ve en el gr&aacute;fico, utilice un formulario para crear la estructura con comandos de archivos y directorios de PHP
                            <br>
                        </p>
                        <div>
                            <img src="imgs/Generartextos.png">
                        </div>
                        <br><br>
                    </center>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>