<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_notas'])) {
    $id = $_POST['id_notas'];
    $url = "http://localhost/dss404/ev02starter/notas/api/eliminar.php?id_notas=" . $id;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $response = curl_exec($curl);
    curl_close($curl);

    if ($response === "Exito") {
        echo "<script>alert('Registro eliminado exitosamente');window.location='index.php';</script>";
    } else {
        echo "<script>alert('No se pudo eliminar el registro');window.location='index.php';</script>";
    }
    exit;
}

// Validar que llegue el id_notas por GET para cargar datos
if (!isset($_GET['id_notas'])) {
    echo "<script>alert('ID inválido');window.location='index.php';</script>";
    exit;
}

$id = $_GET['id_notas'];
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
    <title>Eliminar Nota</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-4">
    <h2 class="text-center">Eliminar Nota</h2>
    <form method="POST" action="eliminar.php">
        <input type="hidden" name="id_notas" value="<?= $data->id_notas ?>">
        <div class="form-group">
            <label>Materia:</label>
            <input readonly class="form-control" value="<?= $data->materia ?>">
        </div>
        <div class="form-group">
            <label>Nota 1:</label>
            <input readonly class="form-control" value="<?= $data->nota1 ?>">
        </div>
        <div class="form-group">
            <label>Nota 2:</label>
            <input readonly class="form-control" value="<?= $data->nota2 ?>">
        </div>
        <div class="form-group">
            <label>Nota 3:</label>
            <input readonly class="form-control" value="<?= $data->nota3 ?>">
        </div>
        <button type="submit" class="btn btn-danger">Confirmar Eliminación</button>
    </form>
</div>
</body>
</html>
