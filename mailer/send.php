<?php

	$nombre				= 	htmlentities($_POST['nombre']);
	$email				=	strtolower($_POST['email']);
	$consulta			=	htmlentities($_POST['consulta']);
	$telefono			=	htmlentities($_POST['telefono']);
	$direccion_envio	=	'info@donpixeldesign.com'; // info@lotsa.com.ar Direccion de correo electronico de destino	
	$name				=	$nombre;
	$subject			=	"Consulta desde Sitio web";

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

	$cabeceras = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	print json_encode([mail(
		$direccion_envio,
		$subject,
		$contenido,
		$cabeceras
	)]);

?>