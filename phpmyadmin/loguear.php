<?php 
require ("conexion.php");
session_start();

$usuario = "admin";
$password = $_POST['password'];

$cmd = "select count(*) as contar from usuario_pass where usuario = '$usuario' AND password='$password' LIMIT 1";
$consulta = mysqli_query($conexion,$cmd);
$array = mysqli_fetch_array($consulta);

if($array['contar']>0){
    $_SESSION['username'] = $usuario;
header("Location: index.php");
}else{ echo "Datos Incorrecto"; }
?>