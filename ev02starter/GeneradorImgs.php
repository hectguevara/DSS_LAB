<?php
include("frameppal.php");
include("class/utilidades.class.php");
$Utilidades = new Utilidades();

$mensaje = "";
$claseAlerta = "info";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen']) && isset($_POST['carnet'])) {
    $carnet = strtoupper(trim($_POST['carnet']));
    $nombreArchivo = $_FILES['imagen']['name'];
    $archivoTemporal = $_FILES['imagen']['tmp_name'];

    if ($carnet == "" || !preg_match("/^[A-Z0-9]+$/", $carnet)) {
        $mensaje = "Carnet inválido.";
        $claseAlerta = "danger";
    } else {
        $rutaDestino = $_SERVER['DOCUMENT_ROOT'] . "/dss404/ev02starter/$carnet/DOCUMENTOS/IMAGENES/";
        if (!is_dir($rutaDestino)) {
            mkdir($rutaDestino, 0777, true);
        }

        $rutaFinal = $rutaDestino . basename($nombreArchivo);

        if (move_uploaded_file($archivoTemporal, $rutaFinal)) {
            $mensaje = "✅ Imagen subida correctamente para el carnet <strong>$carnet</strong>.";
            $claseAlerta = "success";

            $TABLA_LOG = "'GeneradorImgs'";
            $TIPO_CONSULTA_LOG = "'INSERT'";
            include 'inc_bitacora.php';
        } else {
            $mensaje = "❌ Error al subir la imagen.";
            $claseAlerta = "danger";
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Subir Imagen con Carnet</h2>

            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-<?php echo $claseAlerta; ?> mt-3">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="form-group mb-3">
                    <label for="carnet">Carnet:</label>
                    <input type="text" name="carnet" id="carnet" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="imagen">Selecciona una imagen:</label>
                    <input type="file" name="imagen" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Subir Imagen</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php