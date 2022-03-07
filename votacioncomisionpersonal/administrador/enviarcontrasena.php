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

$mail = new PHPMailer(true);

$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "172.16.0.238"; // specif smtp server
$mail->SMTPSecure= ""; // Used instead of TLS when only POP mail is selected
$mail->Port = 25; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = false;
$mail->Username = "comisiondepersonal@saludcapital.gov.co"; // SMTP username
$mail->Password = "Colombia2021*.*"; // SMTP password
$mail->FromName = "Dirección de Gestión del Talento Humano";
$mail->From = "comisiondepersonal@saludcapital.gov.co";
$mail->AddAddress($destinatario, $nombrecompleto);               
$mail->WordWrap = 50;
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true); // set email format to HTML
$mail->Subject = 'VOTACIÓN VIRTUAL - REPRESENTANTES ANTE COMISIÓN DE PERSONAL';
	
$html = '
	<p>Señor(a)</br>
	<b>'. utf8_encode($row['nombres']).' '.utf8_encode($row['apellidos']). '</b></br>
	En cumplimiento a la Resolución 955 del 24 de junio de 2021, por medio de la cual se convoca y se fija el proceso de elección de los representantes de los empleados públicos ante la Comisión de Personal de la Secretaría Distrital de Salud, lo(a) invitamos a votar el 9 de agosto de 2021, por el (la) candidato(a) de su elección, en el horario de 7:30 a.m. a 4:00 p.m. </br>	
	<b>Para ingresar a registrar su voto, ingrese a través del siguiente enlace: </b></br>
	<a href="https://tramitesenlinea.saludcapital.gov.co/votacioncomisionpersonal/" target="_blank">Votación Virtual</a></br>
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
	$cons_actualiza  = sprintf("UPDATE administradores SET enviarcontrasena=%d",1);
		mysqli_query($link,$cons_actualiza);
		
	    include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Se han enviado  correos a '.$num.' servidores de la Secretaría Distrital de Salud</strong></td></tr>';
        echo '</table></div></body></html>';
		
		echo '<script type="text/javascript"> opener.location.reload();</script>';

// }

// else {
        // include_once("encabezado.html");
        // echo '<table>';
        // echo '<tr><td class="cen"><strong>Su sesión ha finalizado, por favor vuelva a ingresar al sistema</strong></td></tr>';
        // echo '</table></div></body></html>';
// }
mysqli_close($link);
?>
