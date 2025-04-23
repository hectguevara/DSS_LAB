<?php
if (!empty($_POST)) {
    require_once './conexion.php';

    $imagen = addslashes(file_get_contents($_FILES['adjunto']['tmp_name']));
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $carnet = $_POST["carnet"];
    $cum = $_POST["cum"];

    $sql = "INSERT INTO generales (nombre, correo, carnet, cum, imagen, fechacreacion)
            VALUES ('$nombre', '$email', '$carnet', '$cum', '$imagen', NOW())";

    if ($con->query($sql)) {
        header('Location: ../index.php');
        exit;
    } else {
        echo "Error al guardar: " . $con->error;
    }
}
?>
