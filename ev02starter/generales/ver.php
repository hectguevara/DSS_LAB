<?php
require_once './php/conexion.php';
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Listado de Registros</h2>

        <?php
        $sql1 = "SELECT * FROM generales";
        $resultado = $con->query($sql1);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="card mb-3 shadow-sm">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><strong>' . htmlspecialchars($fila['nombre']) . '</strong></h5>';
                echo '<p class="card-text"><strong>Carnet:</strong> ' . htmlspecialchars($fila['carnet']) . '</p>';
                echo '<p class="card-text"><strong>CUM:</strong> ' . htmlspecialchars($fila['cum']) . '</p>';
                echo '<p class="card-text"><strong>Email:</strong> ' . htmlspecialchars($fila['correo']) . '</p>';

                if (!empty($fila['imagen'])) {
                    $imagenCodificada = base64_encode($fila['imagen']);
                    echo '<img src="data:image/jpeg;base64,' . $imagenCodificada . '" class="img-thumbnail" width="200">';
                }

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning text-center">No hay registros disponibles.</div>';
        }

        $con->close();
        ?>
    </div>
</body>
</html>
