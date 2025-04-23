<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (!isset($_GET['id_notas'])) {
    echo json_encode(["error" => "ID no especificado"]);
    exit;
}

$id = intval($_GET['id_notas']);

$conn = new mysqli("localhost", "root", "", "ev02");

if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$sql = "DELETE FROM notas WHERE id_notas = $id";

if ($conn->query($sql) === TRUE) {
    echo "Exito";
} else {
    echo json_encode(["error" => "No se pudo eliminar"]);
}

$conn->close();
?>
