<?php

require_once 'model/db.php';

class Apuntes {
    private $db;

    public function __construct() {
        $this->db = Db::connect(); // ← conectar con PDO
    }

    public function obtenerApuntes() {
        $stmt = $this->db->query("SELECT * FROM apuntes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ObtenerApuntePorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM apuntes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        if (!empty($data["id"])) {
            $stmt = $this->db->prepare("UPDATE apuntes SET titulo = ?, contenido = ? WHERE id = ?");
            $stmt->execute([$data["titulo"], $data["contenido"], $data["id"]]);
            return $data["id"];
        } else {
            $stmt = $this->db->prepare("INSERT INTO apuntes (titulo, contenido) VALUES (?, ?)");
            $stmt->execute([$data["titulo"], $data["contenido"]]);
            return $this->db->lastInsertId();
        }
    }

    public function BorrarApuntePorId($id) {
        $stmt = $this->db->prepare("DELETE FROM apuntes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
