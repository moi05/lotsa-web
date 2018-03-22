<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {

	$nombre				= 	htmlentities($_POST['nombre']);
	$email				=	strtolower($_POST['email']);
	$consulta			=	htmlentities($_POST['consulta']);
	$telefono			=	htmlentities($_POST['telefono']);
	$direccion_envio	=	'info@lotsa.com.ar';//   Direccion de correo electronico de destino
	$name				=	$nombre;
	$subject			=	"Consulta desde Sitio web";


	//Server settings
	$mail->SMTPDebug = 2;                                 // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP


	/** COMPLETAR ESTOS DATOS ***/

	$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
	$mail->Username = '';                 				  // SMTP username
	$mail->Password = 'secret';                           // SMTP password

	$mail->setFrom('from@example.com', 'Mailer');
	$mail->addReplyTo('info@example.com', 'Information');

	/***************************************************/

	

	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	//Recipients

	$mail->addAddress($email, $nombre);     // Add a recipient

	//Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Here is the subject';

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

//	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();

	print json_encode([true]);

} catch (Exception $e) {
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
