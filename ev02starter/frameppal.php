<?php
require_once('Connections/conn.php'); // aquí ya se hace session_start()

// ✅ validación de sesión, mantenela
if (!isset($_SESSION['utenticado']) || $_SESSION['utenticado'] !== 'SI') {
    header("Location: index.php");
    exit;
}
$TituloSeccion = "Bienvenido!";
?>
<!doctype html>
<html lang="es">
<head>
    <?php require_once('head.php'); ?>
    <link rel="stylesheet" href="/dss404/ev02starter/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dss404/ev02starter/css/styles.css">
</head>
<body>
    <div class="container mt-4">
        <?php require_once('menu.php'); ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 col-lg-8 text-center">
                <p class="lead">
                    Tu solución integral para administrar tu información.<br>
                    Explora, gestiona y optimiza, todo en un solo lugar.
                </p>
                <img src="/dss404/ev02starter/imgs/inicio.png?time=a" class="img-fluid mt-3" alt="Inicio">
            </div>
        </div>
    </div>
    <?php require_once('scripts.php'); ?>
</body>



</html>
