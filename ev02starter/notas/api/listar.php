<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ev02";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Consulta para obtener los registros
$sql = "SELECT id_notas, carnet, materia, nota1, nota2, nota3 FROM notas";
$result = $conn->query($sql);

// Array para almacenar los datos
$datos = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $datos[] = $row; // Devuelve como array indexado [0, 1, 2...]
    }
}

// Respuesta como JSON
echo json_encode($datos);
$conn->close();
