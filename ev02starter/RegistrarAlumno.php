<?php
include("frameppal.php");
include("class/utilidades.class.php");
$Utilidades = new Utilidades();

$mensaje = "";
$clase = "info";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombres"]) && isset($_FILES["foto"])) {
    $nombres = $Utilidades->limpiar_campos($_POST["nombres"]);
    $apellidos = $Utilidades->limpiar_campos($_POST["apellidos"]);
    $carnet = strtoupper($Utilidades->limpiar_campos($_POST["carnet"]));

    $fotoNombre = $_FILES["foto"]["name"];
    $fotoTmp = $_FILES["foto"]["tmp_name"];
    $extension = pathinfo($fotoNombre, PATHINFO_EXTENSION);
    $nuevoNombreFoto = $carnet . "." . $extension;
    $rutaFotos = $_SERVER["DOCUMENT_ROOT"] . "/dss404/ev02starter/ALUMNOS/FOTOS/";

    if (!is_dir($rutaFotos)) {
        mkdir($rutaFotos, 0777, true);
    }

    $rutaFinal = $rutaFotos . $nuevoNombreFoto;

    if (move_uploaded_file($fotoTmp, $rutaFinal)) {
        include_once(__DIR__ . "/Connections/conn.php");

        // Verificar si el carnet ya existe
        $verificar = $db->prepare("SELECT COUNT(*) FROM alumnos WHERE carnet = ?");
        $verificar->bind_param("s", $carnet);
        $verificar->execute();
        $verificar->bind_result($existe);
        $verificar->fetch();
        $verificar->close();

        if ($existe > 0) {
            $mensaje = "❌ El carnet <strong>$carnet</strong> ya está registrado.";
            $clase = "danger";
        } else {
            // Insertar nuevo alumno
            $sql = "INSERT INTO alumnos (nombres, apellidos, carnet, foto) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $fotoRelativa = "ALUMNOS/FOTOS/" . $nuevoNombreFoto;

            if ($stmt->execute([$nombres, $apellidos, $carnet, $fotoRelativa])) {
                $mensaje = "✅ Alumno registrado exitosamente.";
                $clase = "success";

                // Bitácora
                $TABLA_LOG = "'RegistrarAlumno'";
                $TIPO_CONSULTA_LOG = "'INSERT'";
                include("inc_bitacora.php");
            } else {
                $mensaje = "❌ Error al registrar alumno en la base de datos.";
                $clase = "danger";
            }
        }
    } else {
        $mensaje = "❌ Error al subir la fotografía.";
        $clase = "danger";
    }
}
?>

<div class="container mt-4">
    <h2>Registrar Alumno</h2>

    <?php if (!empty($mensaje)) : ?>
        <div class="alert alert-<?php echo $clase; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label>Nombres:</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Apellidos:</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Carnet:</label>
            <input type="text" name="carnet" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Fotografía:</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Alumno</button>
    </form>
</div>
</body>
</html>