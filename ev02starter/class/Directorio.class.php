<?php

class Directorio {

    private $directorioRaiz;

    public function __construct($directorio) {
        // Normalizamos separadores de directorio
        $directorio = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $directorio);

        // Verifica si la ruta proporcionada es un directorio existente
        if (!is_dir($directorio)) {
            // Si no es absoluta (Windows: C:\ o Unix: /), asumimos que es relativa
            if (!preg_match('/^[A-Z]:\\\\|^\//i', $directorio)) {
                // Completamos desde DOCUMENT_ROOT
                $directorioAbsoluto = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "dss404" . DIRECTORY_SEPARATOR . "ev02starter" . DIRECTORY_SEPARATOR . $directorio;
                if (!is_dir($directorioAbsoluto)) {
                    throw new Exception("La ruta proporcionada no es un directorio válido: " . $directorioAbsoluto);
                }
                $directorio = $directorioAbsoluto;
            } else {
                throw new Exception("La ruta proporcionada no es un directorio válido: " . $directorio);
            }
        }

        $this->directorioRaiz = $directorio;
    }

    public function arbolTransversal() {
        return $this->escanearDirectorio($this->directorioRaiz);
    }

    private function escanearDirectorio($directorio) {
        $contenidos = [];
        $elementos = scandir($directorio);

        foreach ($elementos as $elemento) {
            if ($elemento === '.' || $elemento === '..') continue;

            $ruta = $directorio . DIRECTORY_SEPARATOR . $elemento;

            if (is_dir($ruta)) {
                $contenidos[$elemento] = $this->escanearDirectorio($ruta);
            } else {
                $contenidos[] = $elemento;
            }
        }
        return $contenidos;
    }

    public function imprimirArbol($arbol = null, $prefijo = "", $rutaBase = "") {
        if ($arbol === null) {
            $arbol = $this->arbolTransversal();
            $rutaBase = $this->directorioRaiz;
        }

        foreach ($arbol as $llave => $valor) {
            if (is_array($valor)) {
                $rutaDirectorio = $rutaBase . "/" . $llave;
                echo $prefijo . "<u><img style='margin-left: 20px; margin-right: 10px;' src='imgs/folder.jpg' border=0> " . $llave . "</u><br>\n";
                $this->imprimirArbol($valor, $prefijo . "&nbsp;&nbsp;&nbsp;&nbsp;", $rutaDirectorio);
            } else {
                $rutaArchivo = $rutaBase . "/" . $valor;
                $rutaArchivoRelativa = str_replace($_SERVER["DOCUMENT_ROOT"], "", $rutaArchivo);
                $rutaArchivoAbsoluta = "http://" . $_SERVER["HTTP_HOST"] . $rutaArchivoRelativa;
                $tamanoArchivo = filesize($rutaArchivo);
                $tamanoArchivoFormateado = $this->formatearTamanoArchivo($tamanoArchivo);

                echo $prefijo . "<a target='_blank' href='" . $rutaArchivoAbsoluta . "'> " . $valor . "</a> (" . $tamanoArchivoFormateado . ")<br>\n";
            }
        }
    }

    private function formatearTamanoArchivo($bytes) {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }
}
