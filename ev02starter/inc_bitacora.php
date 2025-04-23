<?php
if (!isset($Utilidades) || !is_object($Utilidades)) {
    include_once(__DIR__ . "/class/utilidades.class.php");
    $Utilidades = new Utilidades();
}

$pagina = $_SERVER['PHP_SELF'];
$fecha = date("Y-m-d H:i:s");

$consulta = "INSERT INTO bitacora (FECHA_HORA, PAGINA, TABLA, TIPO_CONSULTA)
             VALUES ('$fecha', '$pagina', $TABLA_LOG, $TIPO_CONSULTA_LOG)";

$conexionPath = __DIR__ . "/conexion.php";
if (file_exists($conexionPath)) {
    include($conexionPath);
    if (isset($con) && $con) {
        $con->query($consulta);
    } else {
        error_log("Error: variable \$con no definida o conexión no válida.");
    }
} else {
    error_log("Error: no se encontró el archivo conexion.php en $conexionPath");
}
?>
<?php