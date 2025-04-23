<!-- //IMPLMENTAR MECANISMO DE AUTENTICACION POR SESIONES -->
<!-- //NO OLVIDE LA BITACORA -->
<html>
    <head>
        <meta charset="utf-8" />
        <title>Registro</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="col-sm-7">
                <div class="text-center border border-primary rounded">
                    <?php include "php/navbar.php"; ?>
                    <center>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Registro</h2>
                                    <form role="form" name="registro" action="php/registro.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Alumno</label>
                                            <input type="text" class="form-control" id="username" name="nombre" 
                                                   placeholder="Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Correo Electronico</label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   placeholder="Correo Electronico">
                                        </div>
                                        <div class="form-group">
                                            <label for="carnet">Carnet</label>
                                            <input type="text" class="form-control" id="fullname" name="carnet" 
                                                   placeholder="Carnet">
                                        </div>
                                        <div class="form-group">
                                            <label for="cum">CUM Acumulado de Notas</label>
                                            <input type="number" class="form-control" id="cum" name="cum" 
                                                   placeholder="CUM Acumulado de Notas" step="0.01" min="1" max="100">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="max_file_size" value="2500000" />
                                            <label for="adjunto">Fotograf&iacute;a Carnet (Subir a la Base de Datos):</label>
                                            <input type="file" name="adjunto" id="adjunto" /><br />
                                        </div>

                                        <button type="submit" class="btn btn-default">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>                
            </div>                
        </div>
    </body>
</html>