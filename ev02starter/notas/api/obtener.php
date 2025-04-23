<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (!isset($_GET["id_notas"])) {
    echo json_encode(["error" => "ID de nota no especificado"]);
    exit;
}

$id_notas = $_GET["id_notas"];

$mysqli = new mysqli("localhost", "root", "", "ev02");

if ($mysqli->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$query = "SELECT * FROM notas WHERE id_notas = $id_notas";
$result = $mysqli->query($query);

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No encontrado"]);
}
$mysqli->close();
?>
