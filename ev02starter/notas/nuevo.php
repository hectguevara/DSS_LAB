<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ingresar nuevo usuario con API Rest</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Registro de Notas</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="carnet">Carnet</label>
                        <input type="text" class="form-control" placeholder="Carnet" name="carnet" required>
                    </div>
                    <div class="form-group">
                        <label for="materia">Materia</label>
                        <input type="text" class="form-control" placeholder="Materia" name="materia" required>
                    </div>
                    <div class="form-group">
                        <label for="nota1">Nota 1</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Nota 1" name="nota1" required>
                    </div>
                    <div class="form-group">
                        <label for="nota2">Nota 2</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Nota 2" name="nota2" required>
                    </div>
                    <div class="form-group">
                        <label for="nota3">Nota 3</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Nota 3" name="nota3" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = "http://localhost/dss404/ev02starter/notas/api/insertar.php";

    $data = [
        "carnet" => $_POST['carnet'],
        "materia" => $_POST['materia'],
        "nota1" => $_POST['nota1'],
        "nota2" => $_POST['nota2'],
        "nota3" => $_POST['nota3'],
    ];

    $curl = curl_init($url);
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode == 200 && trim($response) == "Exito") {
        echo "<script>alert('Registro agregado exitosamente'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('No se pudo agregar el registro'); window.history.back();</script>";
    }
}
?>
