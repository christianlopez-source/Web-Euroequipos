<?php 
include("../conexion.php");
$_SESSION['username'] = "";
session_start();
if(!isset($_SESSION['username'])){
     header("Location: ../../login/");
}else{$usuario = $_SESSION['username'];}

//if(!isset($usuario)){
  if($usuario == ""){
      header("Location: ../../login/");
      exit;
}else{
    $boton_truncate="";
    if(isset($_POST['truncate']))$boton_truncate=$_POST['truncate'];
             
                   	//BOTON FORMATIAR TABLA
	if($boton_truncate)
	{
		$consultatruncate = "TRUNCATE TABLE catalogo_servicios";
		$resultadotruncate = mysqli_query($conexion,$consultatruncate);
		if($resultadotruncate){
			header("Location: ../");
			//header ("Location: index.php");
		}else{echo "NO SE PUDO FORMATIAR LA TABLA";}
    }

    $boton_index="";
    if(isset($_POST['index']))$boton_index=$_POST['index'];
    if($boton_index)
    {header("Location: ../");}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="icono.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>FORMATEAR TABLA</title>
    <style type="text/css">
    .container{
        width: 20%;
        max-width: 300px;
        min-width: 300px;
        background-image: url(precaucion.jpg);
    }
    </style>
</head>

<body>
    <div class="container">
       <center><h2>BORRAR REGISTROS</h2></center>
       <center> <p>Esta a punto de FORMATEAR</p></center>
        <div class="row">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <div class="col-md-6 col-xs-6">
<input type="submit" name="index" value="ATRAS" class="btn btn-primary pri">
            </div>
            <div class="col-md-6 col-xs-6">
 <input type="submit" name="truncate" value="FORMATEAR" class="btn btn-danger dan">
            </div>
        </form>
        </div>
        <br>
    </div>

    <script>
    alert("Se perdera toda la informacion de las tablas");
    </script>
</body>
</html>
<?php } ?>
