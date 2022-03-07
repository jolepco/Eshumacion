<?php
require_once("../funciones.php");	
require_once("../conexionBD.php");
$link=conectarse(); 
$num = 0;
//Se valida que sea superadministrador para que pueda agregar o modificar estudiantes
if ($_COOKIE['VotaDatAdmin']==1) {
	$resp=mysqli_query($link,"select id,documento,correo from estudiantes");
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
			$cons_sql3  = sprintf("UPDATE estudiantes SET clave=%s WHERE id=%d", comillas($claveencriptada),$id);
			mysqli_query($link,$cons_sql3);

			// $to = $row["correo"];
			// $asunto = limpiarAsunto("Elección Representantes al Comité de Recreación y Deportes");
			$asunto = "Elección Representantes al Comité de Recreación y Deportes";
			// $asunto = "=?ISO-8859-1?B?".base64_encode($asunto)."=?=";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
			$headers .= "From: SDS Bienestar y Capacitación <bienestarycapacitacion@saludcapital.gov.co>" . "\r\n";
			$cuerpo = "
			<html>
			<body>
			<p>Reciba un cordial saludo,</p>
			<p></p>
			<p>En cumplimiento a la Resolución 036 del 26 de Febrero de 2020 y a la Resolución 212 del 21 de Septiembre de 2020, por medio de las cuales se convoca a la Elección de Representantes al Comité de Recreación y Deportes, para el día 16 de octubre de 2020, los invitamos a votar por el candidato de su elección de 8:00 a.m. a 4:30 p.m.</p>
			<p>Los datos para su ingreso al sistema de votación virtual para la elección de representantes al comité de deportes, son los siguientes: </p></br>
			<p>Usuario:".$row['documento']."</p></br>
			<p>Clave:".$clave."</p></br>
			</body>
			</html>";
			 
			$retorno = mail($destinatario, html_entity_decode($asunto), $cuerpo, $headers);
			var_dump($retorno);
			$num = $num+1;
			
	}
	        include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Se han enviado  correos a '.$num.' servidores de la Secretaría Distrital de Salud</strong></td></tr>';
        echo '</table></div></body></html>';
}

else {
        include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Su sesión ha finalizado, por favor vuelva a ingresar al sistema</strong></td></tr>';
        echo '</table></div></body></html>';
}
mysqli_close($link);
?>
