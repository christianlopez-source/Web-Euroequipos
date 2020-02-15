<?php

$db_host="localhost";
$db_nombre="id9632954_db_euro";
$db_usuario="id9632954_europrueba";
$db_contra="";


//Base de datos de 000webhost Lopez mmv
/*
$db_host="localhost";
$db_nombre="id8563910_db_prueba";
$db_usuario="id8563910_europruebauser";
$db_contra="europrueba";
*/

/*
//BASE DE DATOS DE 000whehost POVEDA
$db_host="localhost";
$db_nombre="id9790199_europrueba";
$db_usuario="id9790199_user_europrueba";
$db_contra="europrueba";
*/

/*
$db_host="localhost";
$db_nombre="db_prueba";
$db_usuario="root";
$db_contra="";
*/

$tableCatalogo = "catalogo_servicios";

$conexion=mysqli_connect($db_host,$db_usuario,$db_contra);

if(mysqli_connect_error()){
    echo "<div style='border-top-style: dotted;
    border-right-style: solid;
    border-bottom-style: dotted;
    border-left-style: solid;
    border-color: red;  width: 60%; margin: auto;
    position: relative; margin-top: 150px;'><p style='margin: auto; font-size: 50px; color: red; margin-left: 20px;'><strong>NO HAY CONEXION A LA BASE DE DATO</strong></p>
    <ul style='margin-left: 30px;'>
        <li>No hay internet</li>
        <li>Probelmas con la base de datos</li>
        <li>IProblemas con la fecha</li>
    </ul>
    <a href='../' class='btn btn-primary' style='right: 10px;'>ir a Inicio</a>
     </div>";
}else{  }

mysqli_select_db($conexion, $db_nombre) or die ("<div style='border-top-style: dotted;
border-right-style: solid;
border-bottom-style: dotted;
border-left-style: solid;
border-color: red;  width: 60%; margin: auto;
position: relative; margin-top: 10px;'><p style='margin: auto; font-size: 20px; color: red; margin-left: 20px;'><strong>NO HAY CONEXION A LA BASE DE DATO</strong></p></div>");
mysqli_set_charset($conexion, "utf8");

?>