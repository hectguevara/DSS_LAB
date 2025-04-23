<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

if (
    !isset($data->id_notas) || !isset($data->carnet) || !isset($data->materia) ||
    !isset($data->nota1) || !isset($data->nota2) || !isset($data->nota3)
) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "ev02");

if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$id = $conn->real_escape_string($data->id_notas);
$carnet = $conn->real_escape_string($data->carnet);
$materia = $conn->real_escape_string($data->materia);
$nota1 = $conn->real_escape_string($data->nota1);
$nota2 = $conn->real_escape_string($data->nota2);
$nota3 = $conn->real_escape_string($data->nota3);

$sql = "UPDATE notas SET carnet='$carnet', materia='$materia', nota1='$nota1', nota2='$nota2', nota3='$nota3' WHERE id_notas=$id";

if ($conn->query($sql) === TRUE) {
    echo "Exito";
} else {
    echo json_encode(["error" => "No se pudo actualizar"]);
}

$conn->close();
?>
