
<?PHP
$email = $_POST["email"];
$nombre = $_POST["name"];
$tel = $_POST["phone"];
$servicios='';
if (isset($_POST['check'])) {
    $servicios = implode( ' -- ', $_POST['check']);
}
$coment= $_POST["the-textarea"];



$to = "dueredilizia_ramon_@hotmail.it";
$subject = "Nuevo correo electrónico";
$headers = "Desde: $email\n";
$message = "Un visitante quiere contactarlo \naqui sus datos:" .
"\nNombre: " . $nombre .
"\nEmail: " . $email .
"\nTelefono: " . $tel.
"\nServicios: " . $servicios.
"\nDescripcion: " . $coment;


$user = "$email";
$usersubject = "Gracias";
$userheaders = "From: correo@gmail.com\n";

$usermessage = "Gracias por su interés al registrarse, descargue - aqui -
su versión de prueba. "
;

mail($to,$subject,$message,$headers);
mail($user,$usersubject,$usermessage,$userheaders) ;
echo "<script>alert ('formulario enviado con éxito, en unos momentos nos pondremos en contacto contigo.')</script>";
echo "<script>setTimeout(\"locatio.href='../index.php'\")</script>";


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: MyCompany <welcome@mycompany.com>' . "\r\n";  


?>





  


    