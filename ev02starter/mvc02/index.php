<?php
require_once 'model/db.php';
require_once 'controller/apuntes.php';

$controller = new apuntesController();
$data = [];

$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

if (method_exists($controller, $action)) {
    $data = $controller->$action();
    $dataToView = ["data" => $data]; // 👈🏽 CORREGIDO para pasar a la vista
    $view = $controller->view;
    $page_title = $controller->page_title;
} else {
    $view = 'listar_apuntes';
    $page_title = 'Mis Apuntes';
    $dataToView = ["data" => []]; // 👈🏽 si hay error, vista vacía
}

$dataToView = [];

if (method_exists($controller, $action)) {
    $dataToView = $controller->$action(); // ← esto es lo que se pasa a la vista
    $view = $controller->view;
    $page_title = $controller->page_title;
}


include "view/template/encabezado.php";
include "view/$view.php";
include "view/template/piedepagina.php";
?>
