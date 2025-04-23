<?php
session_start();
if (!isset($_SESSION['utenticado']) || $_SESSION['utenticado'] !== 'SI') {
    header("Location: ../index.php");
    exit;
}

// Puedes agregar aquí el código de bitácora si deseas registrar la acción

$url = "http://localhost/dss404/ev02starter/notas/api/listar.php";

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);

$result = json_decode($response);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Listado de Notas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4">
        <h2 class="text-center">Listado de Notas</h2>
        <div class="mb-3 text-right">
            <a href="nuevo.php" class="btn btn-primary">Nuevo Registro</a>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Carnet</th>
                    <th>Materia</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                        echo sprintf('
                            <tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>
                                    <a href="editar.php?id_notas=%s" class="btn btn-success btn-sm">Modificar</a>
                                    <a href="eliminar.php?id_notas=%s" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de eliminar este registro?\')">Eliminar</a>
                                </td>
                            </tr>', 
                            $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[0], $row[0]
                        );
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay registros disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
