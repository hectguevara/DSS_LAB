<?php
require_once('Connections/conn.php');

$ExisteUsuario = false;
$ScriptProcesado = false;
$inputUsuario = "";
$contrasena = "";

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    spl_autoload_register(function($class) {
        require_once "class/" . $class . ".class.php";
    });

    $Utilidades = new Utilidades();

    // Limpiar valores y eliminar comillas externas (ej. 'Douglas' => Douglas)
    function limpiar_y_sanitizar($valor) {
        $limpio = trim($valor);                      // eliminar espacios
        $limpio = trim($limpio, "'\" ");              // eliminar comillas simples y dobles externas
        return htmlspecialchars($limpio);             // evitar inyecciones HTML
    }

    // Aplicar limpieza
    $inputUsuario = limpiar_y_sanitizar($_POST['inputUsuario']);
    $inputNombres = limpiar_y_sanitizar($_POST['inputNombres']);
    $inputApellidos = limpiar_y_sanitizar($_POST['inputApellidos']);
    $inputEmail = limpiar_y_sanitizar($_POST['inputEmail']);
    $contrasena = limpiar_y_sanitizar($_POST['inputContrasena']);

    // Verificar si el usuario ya existe
    $sqlCheck = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmtCheck = $db->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $inputUsuario);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();
    $ExisteUsuario = $result->num_rows > 0;
    $stmtCheck->close();

    // Si no existe, insertarlo
    if (!$ExisteUsuario) {
        $sqlInsert = "INSERT INTO usuarios (usuario, contrasena, nombres, apellidos, email) VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = $db->prepare($sqlInsert);
        $stmtInsert->bind_param("sssss", $inputUsuario, $contrasena, $inputNombres, $inputApellidos, $inputEmail);
        $stmtInsert->execute();
        $stmtInsert->close();

        $ScriptProcesado = true;

        // Registrar en la bitácora
        $TABLA_LOG = "'usuarios'";
        $TIPO_CONSULTA_LOG = "'INSERT'";
        include 'inc_bitacora.php';
    }
}

$TituloSeccion = "Crear Usuario";
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $TituloSeccion; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="d-flex align-items-center justify-content-center">
    <div class="col-sm-7">
        <div class="text-center border border-primary rounded">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="cerrar_sesion.php">Salir</a>
            </nav>
            <h1>Bienvenido!</h1>
            <hr width="80%" class="bg-primary border-2 border-top border-primary" />
            <center>
                <p class="lead">
                    <?php if ($ExisteUsuario) { ?>
                        <div class="alert alert-warning" role="alert">
                            El Usuario <?php echo trim($inputUsuario, "'"); ?> ya existe en el Sistema!
                        </div>
                    <?php } else if ($ScriptProcesado) { ?>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>USUARIO</th>
                                    <th>CONTRASE&Ntilde;A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo trim($inputUsuario, "'"); ?></td>
                                    <td><?php echo trim($contrasena, "'"); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                    Al crear el nuevo usuario, el Sistema le asignar&aacute; una Contrase&ntilde;a para utilizarla en el sistema.
                </p>
                <form class="form-horizontal form-outline w-75" name="formUsuarios" method="POST" action="usuariosadm.php" autocomplete="off">
                    <div class="row">
                        <div class="col">
                            <label for="inputUsuario">Usuario:</label>
                            <input type="text" class="form-control" name="inputUsuario" required minlength="4" maxlength="12">
                        </div>
                        <div class="col">
                            <label for="inputContrasena">Contrase&ntilde;a:</label>
                            <input type="password" class="form-control" name="inputContrasena" required minlength="4" maxlength="12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputNombres">Nombres:</label>
                            <input type="text" class="form-control" name="inputNombres" required minlength="3" maxlength="24">
                        </div>
                        <div class="col">
                            <label for="inputApellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="inputApellidos" required minlength="3" maxlength="24">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputEmail">Correo Electr&oacute;nico:</label>
                            <input type="email" class="form-control" name="inputEmail" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="okForm" value="Continuar">
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </div>
                </form>
            </center>
        </div>
    </div>
</div>
<?php require_once('scripts.php'); ?>
<?php if ($ScriptProcesado) { ?>
<script>
    window.scrollTo(0, document.body.scrollHeight);
</script>
<?php } ?>
</body>
</html>
