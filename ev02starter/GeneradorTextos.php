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

    // Asegurar que el directorio exista
    if (!is_dir($inputTextos)) {
        mkdir($inputTextos, 0777, true);
    }

    $Textarea01 = $_POST['Textarea01'];
    $array = explode('...', $Textarea01);

    $contenidoArchivo01 = $array[0] ?? '';
    $contenidoArchivo02 = $array[1] ?? '';

    file_put_contents($inputTextos . "/LOREMIPSUM01.TXT", $contenidoArchivo01);
    file_put_contents($inputTextos . "/LOREMIPSUM02.TXT", $contenidoArchivo02);

    $recorrerArbol = true;

    $Utilidades = new Utilidades();
    $TABLA_LOG = "'generartextos'";
    $TIPO_CONSULTA_LOG = "'INSERT'";
    include 'inc_bitacora.php';
}

$TituloSeccion = "Procesar Textos";
?>
<!doctype html>
<html lang="es">
<head>
    <?php require_once('head.php'); ?>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-sm-9">
            <div class="text-center border border-primary rounded">
                <?php require_once('menu.php'); ?>
                <center>
                    <p class="lead">
                        Debe crear dos archivos de texto, dentro de la ruta especificada.
                        <br><b>LOREMIPSUM01.TXT</b> debe contener el contenido completo del primer párrafo.
                        <br><b>LOREMIPSUM02.TXT</b> debe contener el segundo párrafo (después de los tres puntos ...).
                    </p>
                    <form class="form-horizontal col-sm-9" method="POST" action="GeneradorTextos.php" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <label for="inputCarnet">Carnet:</label>
                                <input type="text" class="form-control" id="inputCarnet" name="inputCarnet" value="<?php echo $inputCarnet; ?>" required>
                                <input type="hidden" name="okForm" value="Continuar">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="Textarea01">Lorem Ipsum</label>
                                <textarea class="form-control w-100 p-3" id="Textarea01" name="Textarea01" rows="8" required>Lorem ipsum dolor sit amet...Curabitur sed fringilla arcu</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear Archivos de Texto</button><br><br>
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
