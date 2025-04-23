<?php
// Establecer cabeceras para permitir solicitudes desde otro origen si fuese necesario
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ev02";

// Conexión
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos JSON crudos
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Validar que los datos existen
if (
    isset($data["carnet"]) && isset($data["materia"]) &&
    isset($data["nota1"]) && isset($data["nota2"]) && isset($data["nota3"])
) {
    $carnet = $conn->real_escape_string($data["carnet"]);
    $materia = $conn->real_escape_string($data["materia"]);
    $nota1 = $conn->real_escape_string($data["nota1"]);
    $nota2 = $conn->real_escape_string($data["nota2"]);
    $nota3 = $conn->real_escape_string($data["nota3"]);

    // Consulta para insertar los datos
    $sql = "INSERT INTO notas (carnet, materia, nota1, nota2, nota3)
            VALUES ('$carnet', '$materia', '$nota1', '$nota2', '$nota3')";

    if ($conn->query($sql) === TRUE) {
        echo "Exito";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Datos incompletos";
}

$conn->close();
?>
