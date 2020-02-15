<?php
include ("conexion.php"); 
/*$boton_idUpdate="";
if(isset($_POST['id']))$boton_idUpdate=$_POST['id'];
if($boton_idUpdate)
{
	echo "Modificar ->".$_REQUEST['busqueda'];
}*/

$boton_idEliminar="";
if(isset($_GET['id']))$boton_idEliminar=$_GET['id'];
if($boton_idEliminar)
{
	$id=$_REQUEST['id'];
	$consultadelete = "delete from catalogo_servicios where id ='$id' ";
    $resultadodelete = mysqli_query($conexion,$consultadelete);

    if($resultadodelete){
        header("Location: index.php");
        $mensajee = $_SESSION['mensaje'] = "SE ELIMINO UN REGISTRO";
        //header ("Location: index.php");
    }else{ header("Location: index.php"); $mensajee = $_SESSION['mensaje'] = "NO SE PUDO ELIMINO";}
}





