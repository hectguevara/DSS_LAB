<?php
require_once('Connections/conn.php');

//IMPLMENTAR MECANISMO DE AUTENTICACION POR SESIONES

//NO OLVIDE LA BITACORA


spl_autoload_register(function($class) {
    require_once "class/" . $class . ".class.php";
});

$Utilidades = new Utilidades();

$TituloSeccion = "Variables de Sesión del Sistema";
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
                        <?php
                        //MUESTRE Y FORMATEE LAS VARIABLES DE SESION DEL SISTEMA UTILICE EL METODO nicevar DE LA CLASE UTILIDADES
                        ?>
                    </center>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>