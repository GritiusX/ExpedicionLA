<?php

//*
$fechaDeSalida = @trim(stripslashes($_POST['fechaDeSalida']));
$trekking = @trim(stripslashes($_POST['trekking']));
$cabalgata = @trim(stripslashes($_POST['cabalgata']));
$programa = @trim(stripslashes($_POST['programa']));
$dias = @trim(stripslashes($_POST['dias']));
$noches = @trim(stripslashes($_POST['noches']));
$apellido = @trim(stripslashes($_POST['apellido']));
$nombre = @trim(stripslashes($_POST['nombre']));
$fechaNacimiento = @trim(stripslashes($_POST['fechaNacimiento']));
$edad = @trim(stripslashes($_POST['edad']));
$nacionalidad = @trim(stripslashes($_POST['nacionalidad']));
$pais = @trim(stripslashes($_POST['pais']));
$ciudad = @trim(stripslashes($_POST['ciudad']));
$comida = @trim(stripslashes($_POST['comida']));
$telefono = @trim(stripslashes($_POST['telefono']));
$siComparte = @trim(stripslashes($_POST['siComparte']));
$noComparte = @trim(stripslashes($_POST['noComparte']));
$acepto = @trim(stripslashes($_POST['acepto']));

$from_message = @trim(stripslashes($_POST['email']));
$from = 'info@expedicionlosandes.com';
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
$mail->MsgHTML('Reserva recibida de parte de: ' . $from_message . '<br> Fecha de Salida: ' . $fechaDeSalida . '<br> Trekking?: ' .$trekking . '<br> Cabalgata?: ' .$cabalgata . '<br> Programa: ' . $programa . '<br>Cantidad de Dias: ' . $dias . '<br> Cantidad de Noches: ' . $noches  . '<br>Apellidos: ' . $apellido . '<br>Nombres: ' .$nombre . '<br>Fecha de Nacimiento: ' . $fechaNacimiento . '<br>Edad: ' . $edad . '<br>Nacionalidad: ' . $nacionalidad . '<br>Pais: ' . $pais . '<br>Ciudad: ' . $ciudad . '<br>Tipo de Comida: ' . $comida . '<br> Telefono de Contacto: ' . $telefono  . '<br> Email de Contacto: ' . $from_message . '<br> Presiono Si en Comparte Salida: ' . $siComparte . '<br>Presiono No en Comparte Salida: ' . $noComparte . '<br> Acepto los terminos y condiciones: ' . $acepto);
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
//$mail->AltBody = 'This is a plain-text message body';
//Enviamos el correo
$mail->Send();

header('Location: reserva.html');

/* if (!$mail->Send()) {
echo false;
} else {
echo true;
} */
