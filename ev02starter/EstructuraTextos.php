<?php
require_once('Connections/conn.php');

$inputCarnet = "";
$recorrerArbol = false;

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {
    spl_autoload_register(function($class) {
        require_once "class/" . $class . ".class.php";
    });

    $inputCarnet = trim($_POST['inputCarnet']);
    $inputDocumentos = $inputCarnet . "/DOCUMENTOS";
    $inputTextos = $inputDocumentos . "/TEXTOS";

    if (!file_exists($inputCarnet)) mkdir($inputCarnet);
    if (!file_exists($inputDocumentos)) mkdir($inputDocumentos);
    if (!file_exists($inputTextos)) mkdir($inputTextos);

    $Utilidades = new Utilidades();
    $TABLA_LOG = "'estructura_textos'";
    $TIPO_CONSULTA_LOG = "'INSERT'";
    include 'inc_bitacora.php';

    $recorrerArbol = true;
}

$TituloSeccion = "Crear Estructura de Textos";
?>
<!doctype html>
<html lang="es">
<head>
    <?php require_once('head.php'); ?>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-sm-7">
            <div class="text-center border border-primary rounded">
                <?php require_once('menu.php'); ?>
                <center>
                    <p class="lead">
                        Formulario para crear la estructura con comandos de archivos y directorios de PHP
                    </p>
                    <form class="form-horizontal col-sm-5" method="POST" action="EstructuraTextos.php" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <label for="inputCarnet">Carnet:</label>
                                <input type="text" class="form-control" name="inputCarnet" value="<?php echo $inputCarnet; ?>" required minlength="4" maxlength="12">
                                <input type="hidden" name="okForm" value="Continuar">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear Estructura</button><br><br>
                        </div>
                    </form>
                    <?php
                    if ($recorrerArbol) {
                        $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"] . "/dss404/ev02starter/" . $inputCarnet;
                        $directorio = new Directorio($nombreDirectorio);
                        $directorio->imprimirArbol();
                    }
                    ?>
                </center>
            </div>
        </div>
    </div>
    <?php require_once('scripts.php'); ?>
</body>
</html>
