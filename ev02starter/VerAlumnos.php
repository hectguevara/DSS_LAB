<?php
include("frameppal.php");
include_once(__DIR__ . "/Connections/conn.php");

$mensaje = "";
$alumnos = [];

try {
    $query = "SELECT * FROM alumnos ORDER BY id DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $alumnos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    $mensaje = "Error al obtener los alumnos: " . $e->getMessage();
}
?>

<div class="container mt-4">
    <h2>Listado de Alumnos Registrados</h2>

    <?php if (!empty($mensaje)) : ?>
        <div class="alert alert-danger"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if (count($alumnos) === 0) : ?>
        <div class="alert alert-warning">No hay alumnos registrados aún.</div>
    <?php else : ?>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Fotografía</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Carnet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $index => $alumno): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td>
                            <?php
                            $fotoPath = $alumno['foto'];
                            $fotoFullPath = __DIR__ . "/" . $fotoPath;
                            $fotoFullUrl = "/dss404/ev02starter/" . $fotoPath;

                            if (!empty($fotoPath) && file_exists($fotoFullPath)) {
                                echo "<img src='$fotoFullUrl' alt='Foto' width='100' class='img-thumbnail'>";
                            } else {
                                echo "<span class='text-muted'>Sin foto</span>";
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($alumno['nombres']); ?></td>
                        <td><?php echo htmlspecialchars($alumno['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($alumno['carnet']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>