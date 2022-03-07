<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#header('Content-Type: text/html; charset=ISO-8859-1'); 
#header('Content-Type: text/xml; charset=utf-8');
include_once '../class/solicitudConcepto.php';
include_once '../conf/conexion.php';
include_once '../conf/Config.php';
require_once('../lib/nusoap.php');

$now= date("Y-m-d");
$solic = new SolicitudConcepto();
$action = isset($_POST['action']) ? $_POST['action'] : '';
if ($action == 'guardar') {
    global $usuario, $servidor, $puerto, $usuario, $clave;
    $solic->fecha_inscripcion = isset($_POST['fechaIns']) ? $_POST['fechaIns'] : '';
    $solic->numero_inscripcion = isset($_POST['numeroIns']) ? $_POST['numeroIns'] : '';
    $solic->codigo = !empty($_POST['codigo']) ? $_POST['codigo'] : '';
    $solic->tiene_matricula = !empty($_POST['matricula']) ? $_POST['matricula'] : '';
    $solic->matricula_mercantil = !empty($_POST['numeromatricula']) ? $_POST['numeromatricula'] : '';
    $solic->tipo_persona = !empty($_POST['persona_j']) ? $_POST['persona_j'] : '';

	if (!empty($_POST['razon_s'])){
		$str = utf8_decode($_POST['razon_s']);
		$nomrsocial= str_replace("'","",$str);
		$solic->razon_social = $nomrsocial;
	}
    $solic->nit = !empty($_POST['nit']) ? $_POST['nit'] : '';

	if (!empty($_POST['nombreEstable'])){
		$str = utf8_decode($_POST['nombreEstable']);
		$nomestab= str_replace("'","",$str);
		$solic->nombre_establecimiento = $nomestab;
	}
    #if(!empty($_POST['direccionGenerada']))
    $solic->direccion = !empty($_POST['direccionGenerada']) ? $_POST['direccionGenerada'] : $_POST['direccionrural'];
    $solic->localidad = !empty($_POST['localidad']) ? $_POST['localidad'] : $_POST['codigoloc'];
    $solic->upz = !empty($_POST['upz']) ? $_POST['upz'] : $_POST['codigoupz'];
    $solic->barrio = !empty($_POST['barrio']) ? $_POST['barrio'] : $_POST['barriorural'];
    $solic->telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : '';
    $solic->celular = !empty($_POST['celular']) ? $_POST['celular'] : '';
    $solic->fk_ciudad = !empty($_POST['fk_ciudad']) ? $_POST['fk_ciudad'] : '';
    $solic->correo = !empty($_POST['email']) ? $_POST['email'] : '';

	if (!empty($_POST['representante'])){
		$str = utf8_decode($_POST['representante']);
		$nomrepleg= str_replace("'","",$str);
		$solic->representante_legal = $nomrepleg;
	}

    $solic->fk_tipo_doc = !empty($_POST['tipo_doc']) ? $_POST['tipo_doc'] : '';
    $solic->documento = !empty($_POST['numero_doc']) ? $_POST['numero_doc'] : '';
    $solic->direccion_notif = !empty($_POST['direccion_notf']) ? $_POST['direccion_notf'] : '';
    $solic->direccion_not_electronica = !empty($_POST['email_notif']) ? $_POST['email_notif'] : '';
    $solic->fk_ciudad_notif = !empty($_POST['ciudad_notif']) ? $_POST['ciudad_notif'] : '';
    $solic->autoriza_notf_email = !empty($_POST['autoriza_notif']) ? $_POST['autoriza_notif'] : '';
    $solic->codigoAct_econPrincipal = !empty($_POST['actividadP']) ? $_POST['actividadP'] : '';
    $solic->visita_previa = !empty($_POST['inspec_antes']) ? $_POST['inspec_antes'] : '1';
    $solic->fecha_ultimaInspeccion = isset($_POST['fecha_insp']) ? $_POST['fecha_insp'] : '';
    $solic->numero_actavisita = !empty($_POST['numero_acta']) ? $_POST['numero_acta'] : '';
    $solic->concepto_sanit = !empty($_POST['concepto_emitido']) ? $_POST['concepto_emitido'] : '';
    $solic->observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : '';
    #$actividadesEconsecun=implode(',', $_POST['actividadescom']);
    /* $actividadesEconsecun = isset($_POST['actividadescom']) ? $_POST['actividadescom'] : '';
      $solic->cod_actecon1 = isset($actividadesEconsecun[0]) ? $actividadesEconsecun[0] : '';
      $solic->cod_actecon2 = isset($actividadesEconsecun[1]) ? $actividadesEconsecun[1] : '';
      $solic->cod_actecon3 = isset($actividadesEconsecun[2]) ? $actividadesEconsecun[2] : '';
      $solic->cod_actecon4 = isset($actividadesEconsecun[3]) ? $actividadesEconsecun[3] : ''; */
    $solic->cod_actecon1 = isset($_POST['actividadescom1']) ? $_POST['actividadescom1'] : '';
    $solic->cod_actecon2 = isset($_POST['actividadescom2']) ? $_POST['actividadescom2'] : '';
    $solic->cod_actecon3 = isset($_POST['actividadescom3']) ? $_POST['actividadescom3'] : '';
    $solic->cod_actecon4 = isset($_POST['actividadescom4']) ? $_POST['actividadescom4'] : '';
    if( $solic->autoriza_notf_email ==1 && $solic->direccion_not_electronica ==''){
       echo '1|Email de notificación requerido si autoriza envio de notificación';
       exit;
    }
    if ($solic->codigoAct_econPrincipal == $solic->cod_actecon1 or $solic->codigoAct_econPrincipal == $solic->cod_actecon2 or $solic->codigoAct_econPrincipal == $solic->cod_actecon3 or$solic->codigoAct_econPrincipal == $solic->cod_actecon2 or $solic->codigoAct_econPrincipal == $solic->cod_actecon4) {
        echo '1|La actividad Principal y una de las actividades secundarias tienen el mismo código';
        return;
    }
    if ($solic->cod_actecon1 != '' && $solic->cod_actecon1 == $solic->cod_actecon2 or $solic->cod_actecon1 != '' && $solic->cod_actecon1 == $solic->cod_actecon3 or $solic->cod_actecon1 != '' && $solic->cod_actecon1 == $solic->cod_actecon4) {
        echo '1|La primera actividad y la actividad  2, 3 o 4 tienen el mismo código';
        exit;
    }
    if ($solic->cod_actecon2 != '' && $solic->cod_actecon2 == $solic->cod_actecon3 or $solic->cod_actecon2 != '' && $solic->cod_actecon2 == $solic->cod_actecon4) {
        echo '1|La segunda actividad  y la actividad 3 o 4 tienen el mismo código';
        exit;
    }
    if ($solic->cod_actecon3 != '' && $solic->cod_actecon3 == $solic->cod_actecon4) {
        echo '1|La  actividad 3 y 4 tienen el mismo código';
        exit;
    }
    if($solic->fecha_ultimaInspeccion >= $now){
       echo '1|La fecha de la ultima inspección no puede ser mayor o igual a la fecha actual';
       exit;
    }

    $result = $solic->insert();
    if ($result) {
        $id = $result;
        $solic->fetchId($id);

        $wsdl = URLWS;
        $username = USERWS;
        $password = PASSWS;
        //instanciando un nuevo objeto cliente para consumir el webservice
        $client = new nusoap_client($wsdl, 'wsdl');
        //pasando los parámetros a un array
        $param = array('pLogin' => $username,
            'pContrasena' => $password, '_SolicitudVisita' => array(
                'NroInscrip' => $solic->numero_inscripcion,
                'FechaInscrip' => date("d/m/Y", strtotime($solic->fecha_inscripcion)),
                'NroSolicitudVisita' => (string) $id,
                'TieneMatricula' => $solic->tiene_matricula,
                'NroMatricula' => $solic->matricula_mercantil,
                'NIT' => $solic->nit,
                'RazonSocial' => $solic->razon_social,
                'NombreComercial' => $solic->nombre_establecimiento,
                'DireccionComercial' => $solic->direccion,
                'CodLocalidad' => $solic->localidad,
                'CodUpz' => $solic->upz,
                'CodBarrio' => $solic->barrio,
                'Telefono1' => $solic->celular,
                'telefono2' => $solic->telefono,
                'CorreoElect' => $solic->correo,
                'NombreRepLegal' => $solic->representante_legal,
                'CodTipoDocRepLegal' => $solic->abrev,
                'NroDocRepLegal' => $solic->documento,
                'DireccionNotif' => $solic->direccion_notif,
                'CorreoNotif' => $solic->direccion_not_electronica,
                'CiudadNotif' => $solic->fk_ciudad_notif,
                'AutorizaNotifElect' => $solic->autoriza_notf_email,
                'CodActivEcoPrincipal' => $solic->codigoAct_econPrincipal,
                'VisitasPrevias' => $solic->visita_previa,
                'FechaVisitaPrev' => date("d/m/Y", strtotime($solic->fecha_ultimaInspeccion ? $solic->fecha_ultimaInspeccion:'null')),
                'NroActaVisitaPrev' => $solic->numero_actavisita,
                'CodConceptoPrev' => $solic->concepto_sanit,
                'CodActEcoComp1' => $solic->cod_actecon1,
                'CodActEcoComp2' => $solic->cod_actecon2,
                'CodActEcoComp3' => $solic->cod_actecon3,
                'CodActEcoComp4' => $solic->cod_actecon4
            )
        );

        //echo "ENVIO".json_encode($param);
        

       $resultado = $client->call('CaptarSolicitud', $param);
       //echo "ENVIO".json_encode($param)."RESULTADO".json_encode($resultado);
        

        if ($client->fault) {
            echo 'Fallo ' . print_r($resultado);
			error_log("secuncia de error: " .  print_r($resultado) );
        } else {
            $err = $client->getError();
            if ($err) {                  // Display the error
				error_log("secuncia de error: " . $err );
                echo '1|Error!!! Al guardar la información. Intenta nuevamente'; //.$err;
            } else {
                // Display the result
                foreach ($resultado as $opcion) {
                    isset($opcion["TextoError"]) ? (utf8_encode($opcion['TextoError'])) : '';
                    $codigoE = isset($opcion["CodError"]) ? ($opcion['CodError']) : '';
                    isset($opcion["Parametros"]) ? (utf8_encode($opcion['Parametros'])) : '';
                      
                    if ($codigoE == 0) {
                        $re= "Señor(a) $solic->representante_legal, su solicitud quedo registrada bajo el No. $id, y está siendo validada por la entidad. Recuerde que puede consultar el estado de su solicitud con el siguiente número de Radicado $id en: " . URLCONSULTA . "<br><br>Ante cualquier inquietud o novedad no dude consultar el portal de Autorregulación ó informar por medio de correo electrónico a: <u>contactenos@saludcapital.gov.co</u>"; 
                        if ($solic->autoriza_notf_email == 1 && $solic->direccion_not_electronica !='null') {
                            //Email
                            $to = $solic->direccion_not_electronica;
                            $subject = "Comunicado solicitud de visita Concepto Sanitario";
                            $message = "Señor(a) $solic->representante_legal, su solicitud quedo registrada bajo el No. $id, y está siendo validada por la entidad. Recuerde que puede consultar el estado de su solicitud con el siguiente número de Radicado $id en: " . URLCONSULTA . "<br><br>Ante cualquier inquietud o novedad no dude consultar el portal de Autorregulación ó informar por medio de correo electrónico a: <u>contactenos@saludcapital.gov.co</u><br><br><b>Secretaría Distrital de Salud</b><br><b>Subsecretaria de Salud Pública</b><br>Cra 32 #12-81 Bogotá, Colombia<br>Teléfono: (571) 3649090";
                            require_once('../lib/class.phpmailer.php');
                            $mail = new PHPMailer(true);
                            $mail->IsSMTP(); // set mailer to use SMTP
                            $mail->Host = "172.16.0.238"; // specif smtp server
                            $mail->SMTPSecure= ""; // Used instead of TLS when only POP mail is selected
                            $mail->Port = 25; // Used instead of 587 when only POP mail is selected
                            $mail->SMTPAuth = false;
                            //$mail->Username = "cuidatesefeliz@saludcapital.gov.co"; // SMTP username
                            $mail->Username = "conceptosanitarios@saludcapital.gov.co"; // SMTP username
                            $mail->Password = "Julio2019"; // SMTP password
                            $mail->FromName = "Secretaría Distrital de Salud";
                            $mail->From = "conceptosanitario@saludcapital.gov.co";
                            $mail->AddAddress($to, $solic->direccion_not_electronica);
                            $mail->WordWrap = 50;
                            $mail->CharSet = 'UTF-8';
                            $mail->IsHTML(true); // set email format to HTML
                            $mail->Subject = $subject;
                            $mail->Body = nl2br ($message,false);
							if ($mail->send()) {
							} else {
								error_log( "El message No sido enviado para la Solicitud ID ".$id);
							}  
                        }
                    }
                    if(isset($re)){
                        echo $ret =$opcion["CodError"]."|".$opcion["TextoError"]."|$re|";
                    }
                else {
                    echo $ret =$opcion["CodError"]."|".$opcion["TextoError"] . $id ."||";
                  }
                }
            }
           # header("Location:consulta.php"); exit();
        }
    } else {
        echo '1|Error!!!! No fue posible realizar su solicitud por favor intentelo nuevamente';
    }
}
?>
