<?php
include("frameppal.php");
include("class/utilidades.class.php");

$Utilidades = new Utilidades();
$mensaje = "";
$mostrarImagenes = false;
$rutaImagenes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inputCarnet'])) {
    $carnet = strtoupper($Utilidades->limpiar_campos($_POST['inputCarnet']));
    $rutaImagenes = __DIR__ . "/$carnet/DOCUMENTOS/IMAGENES/";

    if (is_dir($rutaImagenes)) {
        $mostrarImagenes = true;
        $TABLA_LOG = "'generarimgs'";
        $TIPO_CONSULTA_LOG = "'SELECT'";
        include 'inc_bitacora.php';
    } else {
        $mensaje = "No se encontró la carpeta de imágenes para el carnet ingresado.";
    }
}
?>

<div class="container mt-4">
    <h2>Visualizar Imágenes por Carnet</h2>

    <form method="POST" class="mb-3">
        <div class="form-group">
            <label for="inputCarnet">Ingrese su carnet:</label>
            <input type="text" name="inputCarnet" id="inputCarnet" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Ver imágenes</button>
    </form>

    <?php if (!empty($mensaje)) : ?>
        <div class="alert alert-warning"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if ($mostrarImagenes) : ?>
        <div class="row">
            <?php
            $imagenes = array_filter(scandir($rutaImagenes), function($file) use ($rutaImagenes) {
                return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file) && is_file($rutaImagenes . $file);
            });

            if (count($imagenes) == 0) {
                echo "<div class='alert alert-info'>No hay imágenes registradas para este carnet.</div>";
            } else {
                foreach ($imagenes as $img) {
                    $imgUrl = "ver_imagen.php?carnet=$carnet&img=" . urlencode($img);
                    echo "<div class='col-md-4 mb-3'><img src='$imgUrl' class='img-thumbnail'></div>";
                }
            }
            ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
<?php