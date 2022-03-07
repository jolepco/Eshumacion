<?php
require_once("../funciones.php");	
require_once("../conexionBD.php");
require_once("../PHPMailer_5.2.4/class.phpmailer.php");
$link=conectarse(); 
$num = 0;
//Se valida que sea superadministrador para que pueda agregar o modificar estudiantes
//if ($_COOKIE['VotaDatAdmin']==1) {
	$resp=mysqli_query($link,"select id,documento,correo,nombres,apellidos from estudiantes");
	//echo $resp;
	// function limpiarAsunto($asunto)
// {
    // $cadena = "Subject";
    // $longitud = strlen($cadena) + 2;
    // return substr(
        // iconv_mime_encode(
            // $cadena,
            // $asunto,
            // [
                // "input-charset" => "UTF-8",
                // "output-charset" => "UTF-8",
            // ]
        // ),
        // $longitud
    // );
// }
	while($row = mysqli_fetch_array($resp)) {
		$aleatorio = rand(0,100);
		$clave = $row['documento'].$aleatorio;
		$id =$row["id"];
		$claveencriptada = md5($clave);
		//****Actualizar en la BD*******
			$destinatario = $row["correo"];
			$nombrecompleto = $row["nombres"]." ".$row["apellidos"];
			$cons_sql3  = sprintf("UPDATE estudiantes SET clave=%s WHERE id=%d", comillas($claveencriptada),$id);
			mysqli_query($link,$cons_sql3);

			 
			//mail($destinatario, html_entity_decode($asunto), $cuerpo, $headers);
$mail = new PHPMailer(true);

$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "172.16.0.238"; // specif smtp server
$mail->SMTPSecure= ""; // Used instead of TLS when only POP mail is selected
$mail->Port = 25; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = false;
$mail->Username = "bienestarycapacitacion@saludcapital.gov.co"; // SMTP username
$mail->Password = "Talento2020*"; // SMTP password
$mail->FromName = "Dirección de Gestión del Talento Humano";
$mail->From = "bienestarycapacitacion@saludcapital.gov.co";
$mail->AddAddress($destinatario, $nombrecompleto);               
$mail->WordWrap = 50;
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true); // set email format to HTML
$mail->Subject = 'VOTACIÓN VIRTUAL - REPRESENTANTES DEL COMITÉ DE RECREACIÓN Y DEPORTE SDS';
	
$html = '
	<p>Señor(a)</br>
	<b>'. utf8_encode($row['nombres']).' '.utf8_encode($row['apellidos']). '</b></br>
	Debido a las fallas técnicas presentadas en la votación del pasado 16 de octubre y en aras de realizar una elección transparente, los resultados de la fecha en mención no se tendrán en cuenta.</br>
En cumplimiento a la Resolución 036 del 26 de Febrero de 2020 y a la Resolución 212 del 21 de Septiembre de 2020, por medio de las cuales se convoca a la Elección de Representantes al Comité de Recreación y Deportes, lo(a) invitamos a votar por el(la) candidato(a) de su elección, el día 2 de Diciembre de  2020, en el horario de 8:00 a.m. a 4:30 p.m.</br>
	<b>Para ingresar a registrar su voto, ingrese a través del siguiente enlace: </b></br>
	<a href="https://tramitesenlinea.saludcapital.gov.co/votacion/" target="_blank">Votación Virtual </a></br>
	<b>Los datos para su ingreso al sistema de votación virtual, son los siguientes: </b></br>
	<b>Usuario:</b></br>'.$row['documento'].'</br>
	<b>Clave:</b></br>'.$clave.'</br>
	<p><b><i>Secretaría Distrital de Salud.<br>
		Dirección de Gestión del Talento Humano</b></i><br>		
	</p>';

$mail->Body = nl2br ($html,false);

$mail->Send();
	
			$num = $num+1;
			
	}
	        include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Se han enviado  correos a '.$num.' servidores de la Secretaría Distrital de Salud</strong></td></tr>';
        echo '</table></div></body></html>';
// }

// else {
        // include_once("encabezado.html");
        // echo '<table>';
        // echo '<tr><td class="cen"><strong>Su sesión ha finalizado, por favor vuelva a ingresar al sistema</strong></td></tr>';
        // echo '</table></div></body></html>';
// }
mysqli_close($link);
?>
