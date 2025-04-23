<?php
function mostrarArbol($ruta, $nivel = 0) {
    if (is_dir($ruta)) {
        $elementos = scandir($ruta);
        foreach ($elementos as $elemento) {
            if ($elemento != '.' && $elemento != '..') {
                echo str_repeat("&nbsp;&nbsp;&nbsp;", $nivel) . "|-- " . $elemento . "<br>";
                if (is_dir($ruta . '/' . $elemento)) {
                    mostrarArbol($ruta . '/' . $elemento, $nivel + 1);
                }
            }
        }
    }
}

$rutaBase = $_SERVER['DOCUMENT_ROOT'] . "/dss404/ev02starter/";

echo "<h2>Estructura completa de directorios de imágenes y textos</h2>";
mostrarArbol($rutaBase);
?>