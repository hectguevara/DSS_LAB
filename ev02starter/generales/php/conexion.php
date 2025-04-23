<?php 
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$db = "ev02"; 

$con = new mysqli($host, $user, $password, $db); 

if (!$con->connect_error) { 
    $con->set_charset('utf8'); 
} else { 
    echo "Se ha producido el siguiente error en la conexión: " . $con->connect_error; 
}
?>
