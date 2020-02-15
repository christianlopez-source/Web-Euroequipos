<?php
include ("conexion.php");
    $busqueda = $_POST['busqueda'];
    $imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
$query = "UPDATE ".$tableCatalogo." SET Imagen='$imagen' WHERE id='$busqueda'";
$resultado = $conexion->query($query);

if($resultado){
   header("Location: index.php");
}
else {
    echo "no se pudo guardar la imagen";
}

?>