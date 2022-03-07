<?php
require_once("funciones.php");
require_once("conexionBD.php");
$link=conectarse();
//****Verificar si el sistema se encuentra activo*****
$estado=mysqli_query($link,"select * from general");
$leer= mysqli_fetch_array($estado);
if ($leer['activo']=="S") {

if (!isset($_POST['envia_consulta'])) {
        include_once("ingresa.html");
}
else {

//******VALIDACION DE INGRESO AL SISTEMA******

if ($_POST['documento']!="") {
	$DocEst=$_POST['documento'];
}
else {
	include_once("encabezado.html");
	print "<strong>No ha escrito el número de documento<br />";
	print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
	exit;
}
//****Se valida la contraseña del estudiante si el sistema la solicita
if ($leer['clave']=="S") {
	if ($_POST['contra']!="") {
		$ContraEst=md5($_POST['contra']);
	}
	else {
		include_once("encabezado.html");
		print "<strong>No ha escrito la contraseña de acceso<br />";
		print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
		exit;
	}
	$resp6=mysqli_query($link,sprintf("select id from estudiantes where documento=%s AND clave=%s", comillas($DocEst), comillas($ContraEst)));
	if (!$row6= mysqli_fetch_array($resp6)) {
		include_once("encabezado.html");
		print "<strong>La contraseña de acceso es inválida<br />";
		print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
		exit;
	}
}

//******Funcion para guardar los datos de control ******
function LogControl($faccion2, $idest2) {
	require_once("conexionBD.php");
	$link=conectarse();
	$ffecha=date("Y-m-d");
	$fhora=date("G:i:s");
	$fip = $_SERVER['REMOTE_ADDR'];
	$cons_sql  = sprintf("INSERT INTO control(c_fecha,c_hora,c_ip,c_accion,c_idest) VALUES(%s,%s,%s,%s,%d)", comillas($ffecha), comillas($fhora), comillas($fip), comillas($faccion2),$idest2);
	mysqli_query($link,$cons_sql);
}
//***** VALIDAMOS QUE EL ESTUDIANTE NO HAYA VOTADO*****
$resp2=mysqli_query($link,sprintf("select id_estudiante from voto, estudiantes where documento=%s and id_estudiante=estudiantes.id",comillas($DocEst)));
        if ($row2= mysqli_fetch_array($resp2)) {
		$faccion="Intento-IngresoDuplicado";
		LogControl($faccion,$row2['id_estudiante']);
		include_once("encabezado.html");
		print "<strong>No puede ingresar</strong><br />Su voto ya está registrado en el sistema.<br />";
		print"<br /><strong><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
		exit;
	}

	$resp=mysqli_query($link,sprintf("select id,nombres,apellidos,grado from estudiantes where documento=%s",comillas($DocEst)));
	if ($row= mysqli_fetch_array($resp)) {
		$IdEncrip=md5($row['id']);
		//**** Creamos la cookie
		setcookie("DataVota", $DocEst, time()+3600);
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html>';
		echo '<head>';
		echo '<title>SECRETARÍA DISTRITAL DE SALUD - Tarjetón de votación</title>';
		echo '<link href="estilo4.css" rel="stylesheet" type="text/css" />';

		echo '</head>';
		echo '<body>';
		echo '<div align="center">';
		$faccion="Ingreso-".$DocEst;
		LogControl($faccion,$row['id']);
		echo '<div class="nombrevota"; font-weight: bold;">SERVIDOR: '.utf8_encode($row['nombres']).' '.utf8_encode($row['apellidos']).'</div>';
		//echo '<img src="iconos/alcaldiac_logo.png" style="display:scroll;position:absolute; top:40px;left:50px; width:130px" alt="" />';
		//echo '<img src="iconos/presidencia_logo.png" style="display:scroll;position:fixed; top:35px;right:150px;" alt="" /><br />';
        //Variable que guarda las categorías que se muestran en el tarjetón
        $catarj="";
		echo '<form name="votacion" action="votacion.php" method="post" >';
echo '<h2>SECRETARÍA DISTRITAL DE SALUD <br />VOTACIÓN VIRTUAL - ELECCIÓN DE REPRESENTANTES COMITÉ DE RECREACIÓN Y DEPORTES - 2020<br /></h2>';
		echo '<table style="font-weight:bold";>';						
		echo '<thead><tr><th>TARJETÓN ELECTORAL</th></tr></thead>';		
		echo '<tr>';
		echo '<td>';
        //Leemos la lista de categorías que aparecerán en el tarjetón
		$resp5=mysqli_query($link,"select * from categorias order by id");
		while($row5 = mysqli_fetch_array($resp5)) {
            //Verificamos si existe un grado con el mismo nombre de la categoría
            //para tener en cuenta para las votaciones de los candidatos por grado.
            $vrep=0;
            $resp9=mysqli_query($link,"select * from grados");
            while($row9 = mysqli_fetch_array($resp9)) {
                $grados[$row9["id"]]=$row9["grado"];
                if (cambia_mayuscula($row5['nombre'])==cambia_mayuscula($row9['grado'])) {
                    $vrep=1;
                }
            }
        //Se muestran los candidatos por grado (pertenecen al mismo grado del estudiante) o de otras categorías
        if ((cambia_mayuscula($grados[$row['grado']])==cambia_mayuscula($row5['nombre']))  or ($vrep==0)) {
			//*****Contar el total de candidatos por categoria******
			$resp8=mysqli_query($link,sprintf("select count(nombres) from candidatos where representante=%d",$row5['id']));			
			$row8 = mysqli_fetch_array($resp8);
			if ($row8[0]>0) {
                $catarj = $catarj . $row5['id'] . ",";
                echo '<div align="center">';
    			echo '<table style="font-weight:bold";>';
				echo '<thead><tr><th colspan="'.$row8[0].'" class="vto";>ELECCIÓN VIRTUAL DE REPRESENTANTES AL COMITÉ DE RECREACIÓN Y DEPORTES DE LA SECRETARÍA DISTRITAL DE SALUD - 2020</th></tr></thead>';

		    	echo '<tr>';
    			# MOSTRAR CANDIDATOS
	    		$resp3=mysqli_query($link,sprintf("select * from candidatos where representante=%d order by apellidos DESC",$row5['id']));
		    	while($row3 = mysqli_fetch_array($resp3)) {
    				echo '<td class="cen cd">';
	    			if ((file_exists ('fotos/'.$row3['id'].'.jpg'))||(file_exists ('fotos/'.$row3['id'].'.png'))||(file_exists ('fotos/'.$row3['id'].'.gif'))) {

		    			if (file_exists ('fotos/'.$row3['id'].'.jpg')){
			    			echo '<img src="fotos/'.$row3['id'].'.jpg" width="100" height ="120" alt="Candidato" onClick = "document.getElementById (\'candidato'.$row3['id'] .'\').checked = true;" /><br />';
				    	}
					    elseif (file_exists ('fotos/'.$row3['id'].'.png')){
    						echo '<img src="fotos/'.$row3['id'].'.png" width="100" height ="120" alt="Candidato" onClick = "document.getElementById (\'candidato'.$row3['id'] .'\').checked = true;" /><br />';
	    				}
		    			elseif (file_exists ('fotos/'.$row3['id'].'.gif')){
			    			echo '<img src="fotos/'.$row3['id'].'.gif" width="100" height ="120" alt="Candidato" onClick = "document.getElementById (\'candidato'.$row3['id'] .'\').checked = true;" /><br />';
				    	}

    				}
	    			else {
		    			echo '<img src="fotos/sinfoto.png" alt="Candidato" onClick = "document.getElementById (\'candidato'.$row3['id'] .'\').checked = true;" /><br />';
			    	}
    				echo '<input type="radio" name="categoria'.$row5['id'].'" id ="candidato'.$row3['id'].'" value="'.$row3['id'].'" />';
	    			echo '<strong>'.utf8_decode($row3['nombres']).' '.utf8_encode($row3['apellidos']).'</strong>';
		    		echo '</td>';
    			}
	    		echo '</tr>';
		    	echo '</table></div><br />';
            }
		}
        }
		//***Si el tarjetón no tiene candidatos se muestra un mensaje
        if ($catarj=="") {
            echo '<strong>No existen candidatos para votar, por favor comuníquese con el administrador del sistema.</strong>';
            echo '</td>';		
    		echo '</tr>';
	    	echo '</table>';
		    echo '</div><br />';
        }
        else {
            echo '</td>';		
	    	echo '</tr>';
		    echo '</table>';
    		echo '</div><br />';
	    	echo '<div class="cen">';
		    echo '<input type="hidden" name="idvoto" value="'.$row['id'].'">';
    		//Eliminamos la última coma "," de la lista de categorías
            $catarj=trim($catarj,',');
            echo '<input type="hidden" name="catarj" value="'.$catarj.'">';
    		echo '<input type="submit" name="envia_voto" value="Votar" title="Registrar voto" style="font-size:16px; font-family:Verdana,Helvetica; font-weight:bold; color:white; background:#3f631e;;  border:0px;  width:130px; height:40px;" />';
	    	echo '</div>';
        }
		echo '</form>';
		echo '</body>';
		echo '</html>';
	}
	else {
		setcookie("DataVota", "", time()-3600);
		include_once("encabezado.html");
		$faccion="IngresoFallido-".$DocEst;
		LogControl($faccion,0);
		echo '<table>';
		echo '<tr><td class="cen" colspan="2"><strong>El documento escrito no está registrado en el sistema<br /><br />';
		print "<strong><a href='javascript:history.go(-1)'>Volver a intentarlo</a></strong></td></tr>";
		echo '</table></div></body></html>';
	}
}
}
else {
    include_once("encabezado.html");
	print "<strong>EL SISTEMA DE VOTACIÓN ESTA INACTIVO</strong><br />";
    print "(Comuníquese con el administrador del sistema)</div></body></html>";
}
mysqli_close($link);
?>
