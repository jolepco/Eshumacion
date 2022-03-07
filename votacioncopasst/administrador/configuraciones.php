<?php
require_once("../funciones.php");	
require_once("../conexionBD.php");
$link=conectarse(); 
//***Leer variables del sistema******
$estado=mysqli_query($link,"select * from general");
$leer= mysqli_fetch_array($estado);
//****** Verificamos si existe la cookie *****/
if(isset($_COOKIE['VotaDatAdmin'])) {
if (!isset($_POST['envia_config'])) {	
	include_once("configuraciones.html");	
}
else {	

//*****************************************************
// VALIDAMOS ALGUNOS VALORES EN LA BD ANTES DE GUARDAR
//*****************************************************

//Validar los campos requeridos
//valida(array("requerido"=>"institucion"));

// $finstitucion=$_POST['institucion'];
// $fdescripcion=$_POST['descripcion'];
if(isset($_POST['activar'])) {
	$factivar="S";
}
else {
	$factivar="N";
}
// if(isset($_POST['clave'])) {
	// $fclave="S";
// }
// else {
	// $fclave="N";
// }

//********************************
// GUARDAMOS LOS DATOS EN LA BD
//********************************

// $cons_sql  = sprintf("UPDATE general SET institucion=%s,descripcion=%s,activo=%s,clave=%s WHERE id=1", comillas($finstitucion), comillas($fdescripcion), comillas($factivar), comillas($fclave));
$cons_sql  = sprintf("UPDATE general SET activo=%s WHERE id=1", comillas($factivar));

mysqli_query($link,$cons_sql);

//******Guardamos los datos de control ******
$ffecha=date("Y-m-d");
$fhora=date("G:i:s");
$fip = $_SERVER['REMOTE_ADDR']; 
$faccion="Cambio_ConfiGeneral";
$cons_sql2  = sprintf("INSERT INTO control(c_fecha,c_hora,c_ip,c_accion) VALUES(%s,%s,%s,%s)", comillas($ffecha), comillas($fhora), comillas($fip), comillas($faccion));
mysqli_query($link,$cons_sql2);
include_once("confirma2.html");	
mysqli_close($link);
}
}
else {
        include_once("encabezado.html");
        echo '<table>';
        echo '<tr><td class="cen"><strong>Su sesi�n ha finalizado, por favor vuelva a ingresar al sistema</strong></td></tr>';
        echo '</table></div></body></html>';
}
?>
