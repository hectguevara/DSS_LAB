<?php
session_start();
session_unset();
$err = 'NO';

// MECANISMO DE AUTENTICACION POR SESIONES
if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {
    spl_autoload_register(function ($class) {
        require_once "class/" . $class . ".class.php";
    });

    $usuario = trim($_POST['inputUsuario']);
    $password = trim($_POST['inputPassword']);

    $cn = new mysqli("localhost", "root", "", "ev02");

    if ($cn->connect_error) {
        die("Error de conexión: " . $cn->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_RsLogin = $result->fetch_assoc();
    $totalRows_RsLogin = $result->num_rows;

    $stmt->close();
    $cn->close();

    if ($totalRows_RsLogin == 1) {
        $err = 'NO';
        $_SESSION['usuario'] = $row_RsLogin["usuario"];
        $_SESSION['email'] = $row_RsLogin["email"];
        $_SESSION['nombres'] = $row_RsLogin["nombres"];
        $_SESSION['apellidos'] = $row_RsLogin["apellidos"];
        $_SESSION['utenticado'] = "SI";

        header("Location: frameppal.php");
        exit;
    } else {
        $err = 'SI';
    }
}

$TituloSeccion = "Inicio de Sesi&oacute;n";
?>
<!doctype html>
<html lang="es">
<head>
    <?php require_once('head.php'); ?>
</head>
<body>
<div class="d-flex align-items-center justify-content-center">
    <div class="shadow-lg p-3 col-sm-5 bg-white rounded">
        <div class="text-center border border-primary rounded bg-light">
            <?php if ($err == 'SI') { ?>
                <div class="alert alert-danger" role="alert">
                    Usuario Inactivo &oacute Contrase&ntilde;a equivocada!
                </div>
            <?php } ?>
            <br>
            <img src="imgs/login.png?t=25" alt="ICONO">
            <hr width="80%" class="bg-primary border-2 border-top border-primary" />
            <h1>Inicio de Sesi&oacute;n</h1>
            <center>
                <form class="form-horizontal form-outline w-75" name="formLogin" method="POST" action="index.php" autocomplete="off">
                    <div class="form-group">
                        <label for="inputUsuario">Usuario:</label>
                        <input type="text" class="form-control" id="inputUsuario" name="inputUsuario" required autofocus>
                        <small class="form-text text-muted">No comparta sus credenciales con nadie.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Contrase&ntilde;a</label>
                        <div class="input-group">
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control pwd" placeholder="Contrase&ntilde;a" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button">
                                    <i class="alert alert-primary" role="alert"><img id="abrircerrar" src="imgs/open.png"></i>
                                </button>
                            </span>   
                        </div>
                        <input type="hidden" name="okForm" value="Continuar">
                    </div>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Crear Nuevo Usuario</button>
                    <button type="submit" class="btn btn-primary">Iniciar Sesi&oacute;n</button><br><br>
                </form>
            </center>
        </div>  
    </div>
</div>

<?php require_once('scripts.php'); ?>
<script>
    $(document).on('click', '#btnNuevo', function () {
        location.href = "usuariosadm.php";
    });

    $(".reveal").on('click', function () {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
            $("#abrircerrar").attr("src", "imgs/close.png");
        } else {
            $pwd.attr('type', 'password');
            $("#abrircerrar").attr("src", "imgs/open.png");
        }
    });
</script>
</body>
</html>
