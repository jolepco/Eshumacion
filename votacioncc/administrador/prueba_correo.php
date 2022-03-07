<?php

require_once("PHPMailer_5.2.4/class.phpmailer.php");

$destinatario = "esanchez1988@gmail.com";
$nombrecompleto = "Usuario votación";
$row['nombres'] = "Usuario";
$row['apellidos'] = "Prueba";
$row['documento'] = 545888887;
$clave = "XXXXXXX";

$mail = new PHPMailer(true);

$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "172.16.0.238"; // specif smtp server
$mail->SMTPSecure= ""; // Used instead of TLS when only POP mail is selected
$mail->Port = 25; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = false;
$mail->Username = "cuidatesefeliz@saludcapital.gov.co"; // SMTP username
$mail->Password = "Colombia2018"; // SMTP password
$mail->FromName = "Dirección de Gestión del Talento Humano";
$mail->From = "mlsuarez@saludcapital.gov.co";
$mail->AddAddress($destinatario, $nombrecompleto);               
$mail->WordWrap = 50;
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true); // set email format to HTML
$mail->Subject = 'Elección Representantes al Comité de Recreación y Deportes';
	
$html = '
	<p>Señor(a)</p>
	<p><b>'. $row['nombres'].' '.$row['apellidos']. '</b>
	</p>
	<p>En cumplimiento a la Resolución 036 del 26 de Febrero de 2020 y a la Resolución 212 del 21 de Septiembre de 2020, por medio de las cuales se convoca a la Elección de Representantes al Comité de Recreación y Deportes, para el día 16 de octubre de 2020, los invitamos a votar por el candidato de su elección de 8:00 a.m. a 4:30 p.m.</p>
	<p>Para ingresar a registrar su voto, copie y pegue en el navegador la siguiente URL: </p>
	<p><a href="http://172.16.1.77/votacion/" target="_blank">Votación Virtual</a>
	<p>Los datos para su ingreso al sistema de votación virtual, son los siguientes: </p>
	<p>Usuario:'.$row['documento'].'</p>
	<p>Clave:'.$clave.'</p></br>
	<p><b>Secretaría Distrital de Salud.<br>
		Dirección de Gestión del Talento Humano</b><br>
		
	</p>';

$mail->Body = nl2br ($html,false);

$mail->Send();
?>