<?php
require_once("../funciones.php");	
require_once("../conexionBD.php");
$link=conectarse(); 
//***Leer variables del sistema******
$estado=mysqli_query($link,"select * from general");
$leer= mysqli_fetch_array($estado);
//****** Verificamos si existe la cookie *****/
if(isset($_COOKIE['VotaDatAdmin'])) {
if(isset($_GET['id'])) {	

//Se valida que sea superadministrador para que pueda agregar o modificar estudiantes
if ($_COOKIE['VotaDatAdmin']==1) {
	//****Agregar nuevo servidor*******
		if (isset($_POST['envia_estudiante'])) {
			if ((borra_espacios($_POST['nom_est'])!="")and(borra_espacios($_POST['ape_est'])!="")and(borra_espacios($_POST['doc_est'])!="")) {
				$fgrado=$_GET['id'];
				$fnom_est=cambia_mayuscula(borra_espacios($_POST['nom_est']));
				$fape_est=cambia_mayuscula(borra_espacios($_POST['ape_est']));
				$fdoc_est=borra_espacios($_POST['doc_est']);			
				$fclave_est=md5($_POST['clave_est']);
			}
			else {
				include_once("encabezado.html");
				print "<strong>Debe llenar todos los campos<br />";
				print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
				exit;
			}
			
			//*****Validamos que no exista un documento duplicado**** 
			$duplica=0;
			$resp3=mysqli_query($link,"select documento from estudiantes");
			while($row3 = mysqli_fetch_array($resp3)) {
					if (borra_espacios($fdoc_est)==borra_espacios($row3['documento'])){
						   $duplica=1;
					}
			}
			if ($duplica==1) {
					include_once("encabezado.html");
					print "<strong>Ya existe un servidor con este número de documento<br />";
					print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
					exit;
			}
			
			//******Guardamos los datos en la BD ******
			$cons_sql  = sprintf("INSERT INTO estudiantes(grado,nombres,apellidos,documento,clave) VALUES(%d,%s,%s,%s,%s)", $fgrado, comillas($fnom_est),comillas($fape_est),comillas($fdoc_est),comillas($fclave_est));
			mysqli_query($link,$cons_sql);

			//****obtener el id del servidor guardado
			$id_est=mysqli_insert_id($link);

			//******Guardamos los datos de control ******
					$ffecha=date("Y-m-d");
					$fhora=date("G:i:s");
					$fip = $_SERVER['REMOTE_ADDR'];
					$faccion="Admin_Crea_Estudiante (id:".$id_est.")";
					$cons_sql5  = sprintf("INSERT INTO control(c_fecha,c_hora,c_ip,c_accion,c_idest) VALUES(%s,%s,%s,%s,%d)", comillas($ffecha), comillas($fhora), comillas($fip), comillas($faccion),$_COOKIE['VotaDatAdmin']);
	mysqli_query($link,$cons_sql5);

		}
		//****Actualizar información de servidor*******
		if (isset($_POST['edita_est'])) {
			if ((borra_espacios($_POST['nom_est'])!="")and(borra_espacios($_POST['ape_est'])!="")and(borra_espacios($_POST['doc_est'])!="")) {
				$fgrado=$_GET['id'];
				$fnom_est=cambia_mayuscula(borra_espacios($_POST['nom_est']));
				$fape_est=cambia_mayuscula(borra_espacios($_POST['ape_est']));
				$fdoc_est=borra_espacios($_POST['doc_est']);			
				$fclave_est=md5($_POST['clave_est']);
			}
			else {
				include_once("encabezado.html");
				print "<strong>Debe llenar todos los campos<br />";
				print"<br /><a href='javascript:history.go(-1)'>Volver al formulario</a></strong></div></body></html>";
				exit;
			}		
			
			//****Actualizar en la BD*******
			$cons_sql3  = sprintf("UPDATE estudiantes SET grado=%d, nombres=%s, apellidos=%s, documento=%s, clave=%s WHERE id=%d", $fgrado, comillas($fnom_est), comillas($fape_est), comillas($fdoc_est), comillas($fclave_est), $_POST['identificador']);
			mysqli_query($link,$cons_sql3);
		
			//******Guardamos los datos de control ******
					$ffecha=date("Y-m-d");
					$fhora=date("G:i:s");
					$fip = $_SERVER['REMOTE_ADDR'];
					$faccion="Admin_Actualiza_Estudiante (id:".$_POST['identificador'].")";
					$cons_sql5  = sprintf("INSERT INTO control(c_fecha,c_hora,c_ip,c_accion,c_idest) VALUES(%s,%s,%s,%s,%d)", comillas($ffecha), comillas($fhora), comillas($fip), comillas($faccion),$_COOKIE['VotaDatAdmin']);
	mysqli_query($link,$cons_sql5);
		
		}	
		
		echo '<div align="center">';	
		//*****Formulario para agregar un servidor *******
		if((isset($_GET['agrega']))and($_GET['agrega']=="ok")) { 
			echo '<form name="addest" action="consulta.php?id='.$_GET['id'].'" method="post">';
				echo '<table>';
				echo '<tr>';
				echo '<td style="text-align:right;"><label for="nom_est">';
				echo '<strong>Nombres:</strong>';
				echo '</label></td>';
				echo '<td><input type="text" name="nom_est" size="30" maxlength="50" title="Escriba los nombres del servidor" />';
				echo '</td></tr>';
				echo '<tr>';
				echo '<td style="text-align:right;"><label for="ape_est">';
				echo '<strong>Apellidos:</strong>';
				echo '</label></td>';
				echo '<td><input type="text" name="ape_est" size="30" maxlength="50" title="Escriba los apellidos del servidor" />';
				echo '</td></tr>';
				echo '<tr>';
				echo '<td style="text-align:right;"><label for="doc_est">';
				echo '<strong>Documento:</strong>';
				echo '</label></td>';
				echo '<td><input type="text" name="doc_est" size="30" maxlength="50" title="Escriba el número de documento del servidor" />';
				echo '</td></tr>';
				echo '<tr>';
				echo '<td style="text-align:right;"><label for="clave_est">';
				echo '<strong>Contraseña:</strong>';
				echo '</label></td>';
				echo '<td><input type="password" name="clave_est" size="30" maxlength="50" title="Escriba la contraseña de acceso del servidor" />';
				echo '</td></tr>';

				echo '<tr><td class="cen" colspan="2"><input type="submit" name="envia_estudiante" value="Guardar" title="Agregar servidor" />&nbsp&nbsp&nbsp&nbsp';
			echo '<input type="button" name="Cancel" value="Cancelar" onclick="window.location =\'consulta.php?id='.$_GET['id'].'\'"/></td></tr>';
			echo '</form></table>';
		}
		else {
			echo '<div class=cen>';
			echo '<strong><a href="consulta.php?id='.$_GET['id'].'&agrega=ok" title="Agregar estudiante">Agregar servidor</a></strong>';
			echo '</div>';
		}
		
		//*****Formulario para editar servidor *******
		if((isset($_GET['id'])) and (isset($_GET['est'])) and (isset($_GET['editar'])) and ($_GET['editar']=="ok")) { 
			$resp4=mysqli_query($link,sprintf("select * from estudiantes where md5(id)=%s",comillas($_GET['est'])));
				if ($row4 = mysqli_fetch_array($resp4)) {	

				echo '<br /><form name="editaest" action="consulta.php?id='.$_GET['id'].'" method="post">';
					echo '<table>';
					echo '<tr>';
					echo '<td style="text-align:right;"><label for="nom_est">';
					echo '<strong>Nombres:</strong>';
					echo '</label></td>';
					echo '<td><input type="text" name="nom_est" value="'.$row4['nombres'].'" size="30" maxlength="50" title="Escriba los nombres del servidor" />';
					echo '</td></tr>';
					echo '<tr>';
					echo '<td style="text-align:right;"><label for="ape_est">';
					echo '<strong>Apellidos:</strong>';
					echo '</label></td>';
					echo '<td><input type="text" name="ape_est" value="'.$row4['apellidos'].'" size="30" maxlength="50" title="Escriba los apellidos del servidor" />';
					echo '</td></tr>';
					echo '<tr>';
					echo '<td style="text-align:right;"><label for="doc_est">';
					echo '<strong>Documento:</strong>';
					echo '</label></td>';
					echo '<td><input type="text" name="doc_est" value="'.$row4['documento'].'" size="30" maxlength="50" title="Escriba el documento del servidor" />';
					echo '</td></tr>';
					echo '<tr>';
					echo '<td style="text-align:right;"><label for="clave_est">';
					echo '<strong>Contraseña:</strong>';
					echo '</label></td>';
					echo '<td><input type="password" name="clave_est" size="30" maxlength="50" title="Escriba la contraseña de acceso del servidor" />';
					echo '</td></tr>';
				echo '<input type="hidden" name="identificador" value="'.$row4['id'].'" />';

					echo '<tr><td class="cen" colspan="2"><input type="submit" name="edita_est" value="Guardar" title="Agregar servidor" />&nbsp&nbsp&nbsp&nbsp';			
				echo '<input type="button" name="Cancel" value="Cancelar" onclick="window.location =\'consulta.php?id='.$_GET['id'].'\'"/></td></tr>';
				echo '</form></table>';
			}
			else {
					echo '<table>';
					echo '<tr><td class="cen"><strong>No hay datos para el servidor</strong></td></tr>';
					echo '</table>';
			}	
		}
		//******Mostrar mensaje para borrar servidor*******
		if((isset($_GET['id']))and(isset($_GET['est']))and(isset($_GET['elimina']))and($_GET['elimina']=="0")) {
			
			$resp5=mysqli_query($link,sprintf("select * from estudiantes where md5(id)=%s",comillas($_GET['est'])));
				if ($row5 = mysqli_fetch_array($resp5)) {
                    //Verificar que no existan votos para borrar el servidor
                    $resp9=mysqli_query($link,sprintf("select id from voto where id_estudiante=%d",$row5['id']));
                    if (!$row9 = mysqli_fetch_array($resp9)) {
        				echo '<br /><div class="cen"><strong>';
	        			echo '¿Desea borrar el servidor '.$row5['apellidos'].' '.$row5['nombres'].' del sistema? ';
		        		echo '<a href="consulta.php?id='.$_GET['id'].'&est='.$_GET['est'].'&elimina=1" title="Borrar servidor del sistema">Si</a>&nbsp&nbsp&nbsp&nbsp';
			        	echo '<a href="consulta.php?id='.$_GET['id'].'" title="Cancelar la eliminación del servidor">No</a>';
				        echo '</strong></div>';
                    }
                    else {
                        echo '<br /><strong>Advertencia: No puede borrar al servidor '.$row5['nombres'].' '.$row5['apellidos'].', ya que tiene su voto registrado.</strong>';
                    }
			}
			else {
				echo '<table>';
					echo '<tr><td class="cen"><strong>No hay datos para el estudiante</strong></td></tr>';
					echo '</table>';
			}
		}
		
		//*****Eliminar servidor******
		if((isset($_GET['id']))and(isset($_GET['est']))and(isset($_GET['elimina']))and($_GET['elimina']=="1")) {
			$resp6=mysqli_query($link,sprintf("select * from estudiantes where md5(id)=%s",comillas($_GET['est'])));
				$row6 = mysqli_fetch_array($resp6);
				$resp2=mysqli_query($link,sprintf("delete from estudiantes where md5(id)=%s",comillas($_GET['est'])));

			//******Guardamos los datos de control ******
					$ffecha=date("Y-m-d");
					$fhora=date("G:i:s");
					$fip = $_SERVER['REMOTE_ADDR'];
					$faccion="Admin_Borra_Estudiante (Grado:".$_GET['id']."-".$row6['apellidos']." ".$row6['nombres'].")";
					$cons_sql5  = sprintf("INSERT INTO control(c_fecha,c_hora,c_ip,c_accion,c_idest) VALUES(%s,%s,%s,%s,%d)", comillas($ffecha), comillas($fhora), comillas($fip), comillas($faccion),$_COOKIE['VotaDatAdmin']);
	mysqli_query($link,$cons_sql5);

		}	
}

	//******MUESTRA LA LISTA DE SERVIDORES POR DEPENDENCIA
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo '<html>';
	echo '<head>';
	echo '<title>SECRETARÍA DISTRITAL DE SALUD - Consulta por Dependencia</title>';
	echo '<link href="../estilo4.css" rel="stylesheet" type="text/css" />';
	echo '</head>';
	echo '<body>';
	$resp3=mysqli_query($link,sprintf("select grado from grados where id=%d",$_GET['id']));
	if($row3 = mysqli_fetch_array($resp3)) {
		echo '<h1>SECRETARÍA DISTRITAL DE SALUD</h1>';
		echo '<h2>DEPENDENCIA: '.$row3['grado'].'</h2>';
		echo '<div align="center">';
		echo '<div class="enlace">';
		echo '<a href="consulta.php?id='.$_GET['id'].'&votos=si" title="Consultar lista de servidores que han votado">Ver servidores con voto>></a><br />';
		echo '<a href="consulta.php?id='.$_GET['id'].'&votos=no" title="Consultar lista de servidores que no han votado">Ver servidores sin voto>></a>';
		echo '</div>';
		if (!isset($_GET['votos'])) {
			echo '<table>';
			if ($_COOKIE['VotaDatAdmin']==1) {
				echo '<thead><tr><th>SERVIDOR</th><th>DOCUMENTO</th><th colspan="2">OPCIONES</th></tr></thead>';
			}
			else {
				echo '<thead><tr><th>SERVIDOR</th><th>DOCUMENTO</th></tr></thead>';
			}
			$ContEst=0;
			$VerAccion="Registro";
			$resp=mysqli_query($link,sprintf("select * from estudiantes where grado=%d order by apellidos",$_GET['id']));
			while($row = mysqli_fetch_array($resp)) {
				echo '<tr>';
				echo '<td>'.$row['apellidos'].' '.$row['nombres'].'</td>';
		                echo '<td>'.$row['documento'].'</td>';
				if ($_COOKIE['VotaDatAdmin']==1) {
					echo '<td class="cen"><a href="consulta.php?id='.$_GET['id'].'&est='.md5($row['id']).'&editar=ok" title="Editar servidor"><img src="../iconos/lapiz.png" border="0" width="20px" border="0" alt="Editar" /></a></td>';
        		                echo '<td class="cen"><a href="consulta.php?id='.$_GET['id'].'&est='.md5($row['id']).'&elimina=0" title="Borrar servidor"><img src="../iconos/delete.png" border="0" alt="Borrar" /></a></td>';
				}
			
				echo '</tr>';
				$ContEst=$ContEst+1;
			}
			echo '<tr>';
			if ($_COOKIE['VotaDatAdmin']==1) {
				echo '<td style="text-align:right;" colspan="4"><strong>Total servidores... ';
			}
			else {
				echo '<td style="text-align:right;" colspan="2"><strong>Total servidores... ';

			}
			echo $ContEst.'</strong></td></tr>';
			echo '</table></div><br />';
		}
		else {
			echo '<table>';
			$ContEst=0;
			$VerAccion="Registro";
			if($_GET['votos']=="si"){
				$resp=mysqli_query($link,sprintf("select distinct estudiantes.id, nombres,apellidos,documento from estudiantes,voto where estudiantes.grado=%d and estudiantes.id=id_estudiante order by apellidos",$_GET['id']));
				echo '<thead><tr><th colspan="2">SERVIDORES CON VOTO</th></tr></thead>';
			}
			if($_GET['votos']=="no"){
				$resp=mysqli_query($link,sprintf("select nombres,apellidos,documento from estudiantes where estudiantes.grado=%d and estudiantes.id not in (select id_estudiante from voto) order by apellidos",$_GET['id']));
				echo '<thead><tr><th colspan="2">SERVIDORES SIN VOTO</th></tr></thead>';
			}
			if(isset($resp)) {
				while($row = mysqli_fetch_array($resp)) {
					echo '<tr>';
					echo '<td>'.$row['apellidos'].' '.$row['nombres'].'</td>';
					echo '<td>'.$row['documento'].'</td>';
					echo '</tr>';
					$ContEst=$ContEst+1;
				}
			}
			echo '<tr>';
			echo '<td colspan="2" style="text-align:right;"><strong>Total servidores... ';
			echo $ContEst.'</strong></td></tr>';
			echo '</table></div>';

		}
		echo '<div class="cen">';
		echo '<a href="general.php" title="consulta por Dependencia"><strong> Volver a consulta por Dependencia</strong></a>';
		echo '</div><br />';
	}
	else {
		echo 'Error: Registro no existe';
	}
	echo '</body>';
	echo '</html>';
	
}
}
else {
        include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Su sesión ha finalizado, por favor vuelva a ingresar al sistema</strong></td></tr>';
        echo '</table></div></body></html>';
}
mysqli_close($link);
?>
