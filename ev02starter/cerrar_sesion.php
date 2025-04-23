<?php
//no olvide destruir todas las variables de el servidor

$TituloSeccion = "Cerrar Sesi&oacute;n";
?>
<!doctype html>
<html lang="es">
    <head>
<?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="shadow-lg p-3 col-sm-5 bg-white rounded">
                <div class="text-center border border-primary rounded bg-light">
                    <div class="alert alert-success" role="alert">
                        Sesi&oacute;n Cerrada con &Eacute;xito!
                    </div>
                    <br>
                    <img src="imgs/login.png" alt="">
                    <hr width="80%" class="bg-primary border-2 border-top border-primary" />
                    <h1>Cierre de Sesi&oacute;n</h1>
                    <center>
                        <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">&nbsp;&nbsp;&nbsp;Salir&nbsp;&nbsp;&nbsp;</a>
                    </center>
                    <br>
                </div>  
            </div>
        </div>        
<?php require_once('scripts.php'); ?>
    </body>
</html>