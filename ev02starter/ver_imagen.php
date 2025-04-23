<?php
if (isset($_GET['carnet']) && isset($_GET['img'])) {
    $carnet = preg_replace("/[^A-Z0-9]/i", "", $_GET['carnet']);
    $img = basename($_GET['img']); // evita path traversal
    $ruta = __DIR__ . "/$carnet/DOCUMENTOS/IMAGENES/" . $img;

    if (file_exists($ruta)) {
        $mime = mime_content_type($ruta);
        header("Content-Type: $mime");
        readfile($ruta);
        exit;
    }
}
http_response_code(404);
echo "Imagen no encontrada";
?>
<?php