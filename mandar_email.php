<?php

//*
$name = @trim(stripslashes($_POST['nombre']));
$from_message = @trim(stripslashes($_POST['email']));
$from = 'info@expedicionlosandes.com';
$subject = @trim(stripslashes($_POST['asunto']));
$message = @trim(stripslashes($_POST['mensaje']));
$to = 'guidopawluk@hotmail.com'; //aca eventualmente va el mail de info@expedicionlosandes.com.

require_once 'PHPMailer_5.2.4/class.phpmailer.php';

//Crear una instancia de PHPMailer
$mail = new PHPMailer();
//Definir que vamos a usar SMTP
$mail->isSMTP();
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0; //en prod dejalo en 2 hasta q se mande bien y luego ponelo en 0
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host = 'ca9.toservers.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port = 25; // o 26 para towebs
//Definmos la seguridad como TLS
//$mail->SMTPSecure = 'tls';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username = "mangravi";
//Introducimos nuestra contraseña de gmail
$mail->Password = "expedicion2020";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom($from, $name);
//Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
$mail->AddReplyTo($from_message);
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress($to);
//Definimos el tema del email
$mail->Subject = $subject;
//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
//$mail->MsgHTML(file_get_contents('correomaquetado.html'), dirname(ruta_al_archivo));
$mail->MsgHTML('De parte de : ' . $from_message . '<br> Mensaje :' . $message);
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
//$mail->AltBody = 'This is a plain-text message body';
//Enviamos el correo
$mail->Send();

header('Location: contacto.html');

/* if (!$mail->Send()) {
echo false;
} else {
echo true;
} */
