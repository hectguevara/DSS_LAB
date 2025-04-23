<?php
if(!empty($_GET['id'])){
    require_once './conexion.php';
    
    //Extraer imagen de la BD mediante GET
    $result = $con->query("SELECT imagen FROM generales WHERE id = {$_GET['id']}");
    
    if($result->num_rows > 0){
        
        $imgDatos = $result->fetch_assoc();
        
        //Mostrar Imagen
        header("Content-type: image/jpg"); 
        echo $imgDatos['imagen']; 
    } else{
        echo 'Imagen no existe...';
    }
}
?>