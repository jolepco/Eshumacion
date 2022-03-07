<?php

/**
 * *By@ura
 * */
/**
 * 
 */
#header('Content-Type: text/html; charset=ISO-8859-1'); 
#header('Content-Type: text/xml; charset=utf-8');
include_once '../class/solicitudConcepto.php';
require_once('../lib/nusoap.php');

class ControllerSolicitudConcepto {

    public $action;
    public $solic;

    function __construct() {
        $this->solic = new solicitudConcepto();
    }

    function guardarS() {
        $this->action = isset($_POST['action']) ? $_POST['action'] : '';
        if ($this->action == 'guardar') {
            $this->solic->fecha_inscripcion = isset($_POST['fechaIns']) ? $_POST['fechaIns'] : '';
            $this->solic->numero_inscripcion = isset($_POST['numeroIns']) ? $_POST['numeroIns'] : '';
            $this->solic->codigo = !empty($_POST['codigo']) ? $_POST['codigo'] : '';
            $this->solic->tiene_matricula = !empty($_POST['matricula']) ? $_POST['matricula'] : '';
            $this->solic->matricula_mercantil = !empty($_POST['numeromatricula']) ? $_POST['numeromatricula'] : '';
            $this->solic->tipo_persona = !empty($_POST['persona_j']) ? $_POST['persona_j'] : '';
            $this->solic->razon_social = !empty($_POST['razon_s']) ? $_POST['razon_s'] : '';
            $this->solic->nit = !empty($_POST['nit']) ? $_POST['nit'] : '';
            $this->solic->nombre_establecimiento = !empty($_POST['nombreEstable']) ? $_POST['nombreEstable'] : '';
            $this->solic->direccion = !empty($_POST['direccionGenerada']) ? $_POST['direccionGenerada'] : '';
            $this->solic->localidad = !empty($_POST['localidad']) ? $_POST[''] : '';
            $this->solic->upz = isset($_POST['upz']) ? $_POST['upz'] : '';
            $this->solic->telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : '';
            $this->solic->celular = !empty($_POST['celular']) ? $_POST['celular'] : '';
            $this->solic->fk_ciudad = !empty($_POST['fk_ciudad']) ? $_POST['fk_ciudad'] : '';
            $this->solic->correo = !empty($_POST['email']) ? $_POST['email'] : '';
            $this->solic->representante_legal = !empty($_POST['representante']) ? $_POST['representante'] : '';
            $this->solic->fk_tipo_doc = !empty($_POST['tipo_doc']) ? $_POST['tipo_doc'] : '';
            $this->solic->documento = !empty($_POST['numero_doc']) ? $_POST['numero_doc'] : '';
            $this->solic->direccion_notif = !empty($_POST['direccion_notf']) ? $_POST['direccion_notf'] : '';
            $this->solic->direccion_not_electronica = !empty($_POST['email_notif']) ? $_POST['email_notif'] : '';
            $this->solic->fk_ciudad_notif = !empty($_POST['ciudad_notif']) ? $_POST['ciudad_notif'] : '';
            $this->solic->autoriza_notf_email = !empty($_POST['autoriza_notif']) ? $_POST['autoriza_notif'] : '';
            $this->solic->codigoAct_econPrincipal = !empty($_POST['actividadP']) ? $_POST['actividadP'] : '';
            $this->solic->visita_previa = !empty($_POST['inspec_antes']) ? $_POST['inspec_antes'] : '';
            $this->solic->fecha_ultima_inspeccion = !empty($_POST['fecha_insp']) ? $_POST['fecha_insp'] : '';
            $this->solic->numero_actavisita = !empty($_POST['numero_acta']) ? $_POST['numero_acta'] : '';
            $this->solic->concepto_sanit = !empty($_POST['concepto_emitido']) ? $_POST['concepto_emitido'] : '';
            $this->solic->observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : '';
            #$actividadesEconsecun=implode(',', $_POST['actividadescom']);
            #echo $actividadesEconsecun;
            $actividadesEconsecun = !empty($_POST['actividadescom']) ? $_POST['actividadescom'] : '';
            $this->solic->cod_actecon1 = !empty($actividadesEconsecun[0]) ? $actividadesEconsecun[0] : '';
            $this->solic->cod_actecon2 = !empty($actividadesEconsecun[1]) ? $actividadesEconsecun[1] : '';
            $this->solic->cod_actecon3 = !empty($actividadesEconsecun[2]) ? $actividadesEconsecun[2] : '';
            $this->solic->cod_actecon4 = !empty($actividadesEconsecun[3]) ? $actividadesEconsecun[3] : '';
            
            $result = $this->solic->insert();
            if ($result) {
                $id = $result;
                $this->solic->fetchId($id);
                /* if($this->solic->cod_actecon1  !=0)
                  $act1=$$this->solic->cod_actecon1;
                  else $act1=''; */
                #header('Content-Type: text/xml; charset=utf-8');
                $wsdl = "http://dev.saludcapital.gov.co/SivigiladcPruebas/WebServiceIVCSCS.asmx?wsdl";
                $username = 'UsuarioIVCSDS';
                $password = 'pruebas123';
                //instanciando un nuevo objeto cliente para consumir el webservice
                $client = new nusoap_client($wsdl, 'wsdl', $username, $password);


                //pasando los parámetros 
                $param = array('_SolicitudVisita' => array(
                        'NroInscrip' => $this->solic->numero_inscripcion,
                        'FechaInscrip' => $this->solic->fecha_inscripcion,
                        'NroSolicitudVisita' => $id,
                        'TieneMatricula' => $this->solic->tiene_matricula,
                        'NroMatricula' => $this->solic->matricula_mercantil,
                        'NIT' => $this->solic->nit,
                        'RazonSocial' => $this->solic->razon_social,
                        'NombreComercial' => $this->solic->nombre_establecimiento,
                        'DireccionComercial' => $this->solic->direccion,
                        'CodLocalidad' => $this->solic->localidad,
                        'CodUpz' => $this->solic->upz,
                        'Telefono1' => $this->solic->celular,
                        'telefono2' => $this->solic->telefono,
                        'CorreoElect' => $this->solic->correo,
                        'NombreRepLegal' => $this->solic->representante_legal,
                        'CodTipoDocRepLegal' => $this->solic->abrev,
                        'NroDocRepLegal' => $this->solic->documento,
                        'DireccionNotif' => $this->solic->direccion_notif,
                        'CorreoNotif' => $this->solic->direccion_not_electronica,
                        'CiudadNotif' => $this->solic->fk_ciudad_notif,
                        'AutorizaNotifElect' => $this->solic->autoriza_notf_email,
                        'CodActivEcoPrincipal' => $this->solic->codigoAct_econPrincipal,
                        'VisitasPrevias' => $this->solic->visita_previa,
                        'FechaVisitaPrev' => $this->solic->fecha_ultimaInspeccion,
                        'NroActaVisitaPrev' => $this->solic->numero_actavisita,
                        'CodConceptoPrev' => $this->solic->concepto_sanit,
                        'CodActEcoComp1' => $this->solic->cod_actecon1,
                        'CodActEcoComp2' => $this->solic->cod_actecon2,
                        'CodActEcoComp3' => $this->solic->cod_actecon3,
                        'CodActEcoComp4' => $this->solic->cod_actecon4
                    )
                );
                $resultado = $client->call('CaptarSolicitud', $param);                 
                if ($client->fault) {
                    echo 'fallo ' . print_r($resultado);
                } else {

                    $err = $client->getError();
                    if ($err) {
                        // Display the error
                        echo 'Error !!!!' . $err;
                    } else {
                        // Display the result
                        print_r($resultado);
                    }
                }
                /* echo '<pre>';
                  print_r($resultado);
                  echo '</pre>';
                  print_r($resultado);
                  $err = $client->getError();
                  if ($err) {
                  echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
                  echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
                  exit();
                  } */
            } else {
                echo 'Error!!!! No fue posible realizar su solicitud por favor intentelo nuevamente';
            }
        }
    }

    function tipoestablecimientos() {
        $result = $this->solic->tipoestablecimien();
        $num = mysqli_num_rows($result);
        for ($i = 0; $i < $num; $i++) {
            $obj = mysqli_fetch_object($result);
            print'<option value="' . $obj->codigo . '">' . utf8_encode($obj->nombre) . '</option>';
        }
    }

    function ciudades() {
        $result = $this->solic->listciudades();
        $num = mysqli_num_rows($result);
        for ($i = 0; $i < $num; $i++) {
            $obj = mysqli_fetch_object($result);
            print'<option value="' . $obj->idciudad . '">' . utf8_encode($obj->nombre) . '</option>';
        }
    }

    function TipoDoc() {
        $result = $this->solic->TipoDocu();
        $num = mysqli_num_rows($result);
        $i = 0;
        while ($i < $num) {
            $obj = mysqli_fetch_array($result);
            echo'<option value="' . $obj['idtipo_documento'] . '">' . utf8_encode($obj['nombre']) . '</option>';
            $i++;
        }
    }

}
