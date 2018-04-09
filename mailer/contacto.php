<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
/*if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");


}*/

$mail->SMTPDebug = 2; 

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$mensaje = $_POST["mensaje"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "mail.lotsa.com.ar";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "hola@lotsa.com.ar";  // Mi cuenta de correo
$smtpClave = "Hhhh2018";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "hola@lotsa.com.ar";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;



	$nombre				= 	htmlentities($_POST['nombre']);
	$email				=	strtolower($_POST['email']);
	$consulta			=	htmlentities($_POST['consulta']);
	$telefono			=	htmlentities($_POST['telefono']);
	$direccion_envio	=	'hola@lotsa.com.ar';//   Direccion de correo electronico de destino
	$name				=	$nombre;
	$subject			=	"Consulta desde Sitio web";



$mail->From = $smtpUsuario; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
$mail->AddReplyTo($email); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del visitante. 
$mail->Subject = "consulta Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "{$mensajeHtml} <br /><br />Formulario de ejemplo. By DonWeb<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Consulta Web"; // Texto sin formato HTML

	$contenido = '<html><body>';
	$contenido .= '<table width="500" border="0" cellspacing="0" cellpadding="0" style="font-family:Courier New, Arial, sans-serif;font-size:12px;">';
	$contenido .= '<tr>';
	$contenido .= '<td height="20" style="color:#15395D;"><strong>Nombre:</strong> '. $nombre.'</td>';
	$contenido .= '</tr>';
	$contenido .= '</tr>';
	$contenido .= '<td height="20" style="color:#15395D;"><strong>Email:</strong> '.$email.'</td>';
	$contenido .= '<td height="20"style="color:#15395D;"><strong>Telefono:</strong> '.$telefono.'</td>';
	$contenido .= '<tr>';
	$contenido .= '<td height="20"style="color:#15395D;"><strong>Consulta:</strong> '.nl2br($consulta).'</td>';
	$contenido .= '</tr>';
	$contenido .= '</table>';
	$contenido .= '</body></html>';

	$mail->Body    = $contenido;

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}



