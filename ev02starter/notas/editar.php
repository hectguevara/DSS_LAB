<?php
// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = "http://localhost/dss404/ev02starter/notas/api/editar.php";
    $data = json_encode([
        "id_notas" => $_POST["id_notas"],
        "carnet"   => $_POST["carnet"],
        "materia"  => $_POST["materia"],
        "nota1"    => $_POST["nota1"],
        "nota2"    => $_POST["nota2"],
        "nota3"    => $_POST["nota3"]
    ]);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "Content-Type: application/json"
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);

    if ($response === "Exito") {
        echo "<script>alert('Registro actualizado exitosamente');window.location='index.php';</script>";
    } else {
        echo "<script>alert('No se pudo actualizar el registro');window.location='index.php';</script>";
    }
    exit;
}

// Obtener datos para edición
if (!isset($_GET["id_notas"])) {
    echo "<script>alert('ID de nota no especificado');window.location='index.php';</script>";
    exit;
}

$id = $_GET["id_notas"];
$url = "http://localhost/dss404/ev02starter/notas/api/obtener.php?id_notas=" . $id;

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
curl_close($client);

$data = json_decode($response);

if (!$data || isset($data->error)) {
    echo "<script>alert('No se pudo obtener el registro');window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nota</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-4">
    <h2 class="text-center">Editar Nota</h2>
    <form method="POST" action="editar.php">
        <input type="hidden" name="id_notas" value="<?= $data->id_notas ?>">
        <div class="form-group">
            <label>Carnet:</label>
            <input type="text" name="carnet" class="form-control" value="<?= $data->carnet ?>" required>
        </div>
        <div class="form-group">
            <label>Materia:</label>
            <input type="text" name="materia" class="form-control" value="<?= $data->materia ?>" required>
        </div>
        <div class="form-group">
            <label>Nota 1:</label>
            <input type="number" name="nota1" step="0.01" class="form-control" value="<?= $data->nota1 ?>" required>
        </div>
        <div class="form-group">
            <label>Nota 2:</label>
            <input type="number" name="nota2" step="0.01" class="form-control" value="<?= $data->nota2 ?>" required>
        </div>
        <div class="form-group">
            <label>Nota 3:</label>
            <input type="number" name="nota3" step="0.01" class="form-control" value="<?= $data->nota3 ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Modificar</button>
    </form>
</div>
</body>
</html>
