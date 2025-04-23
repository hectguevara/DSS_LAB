<?php
require_once 'model/apuntes.php';

class apuntesController {
    public $page_title;
    public $view;
    public $noteObj;

    public function __construct() {
        $this->view = 'listar_apuntes';
        $this->page_title = '';
        $this->noteObj = new Apuntes();
    }

    public function listar() {
        $this->page_title = 'Mis Apuntes';
        // 👇 Retornar correctamente con clave "data"
        return ["data" => $this->noteObj->obtenerApuntes()];


    }

    public function editar($id = null) {
        $this->page_title = 'Editar Apunte';
        $this->view = 'editar_apunte';

        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if ($id) {
            return ["data" => $this->noteObj->ObtenerApuntePorId($id)];
        } else {
            return ["data" => ["id" => "", "titulo" => "", "contenido" => ""]];
        }
    }

    public function guardar() {
        $this->view = 'editar_apunte';
        $this->page_title = 'Editar Apunte';
        $id = $this->noteObj->guardar($_POST);
        $_GET["response"] = true;
        return ["data" => $this->noteObj->ObtenerApuntePorId($id)];
    }

    public function confirmarBorrado() {
        $this->page_title = 'Borrar Apunte';
        $this->view = 'confirmar_borrar_apunte';
        return ["data" => $this->noteObj->ObtenerApuntePorId($_GET["id"])];
    }

    public function borrar() {
        $this->page_title = 'Listado de Apuntes';
        $this->view = 'listar_apuntes'; // redirige de nuevo al listado
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $this->noteObj->BorrarApuntePorId($_POST["id"]);
        }
    
        return ["data" => $this->noteObj->obtenerApuntes()];
    }
    
    
}
