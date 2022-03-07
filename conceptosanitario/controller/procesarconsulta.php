<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once '../conf/Config.php';
include_once '../class/solicitudConcepto.php';
require_once('../lib/nusoap.php');
#header('Content-Type: text/xml; charset=utf-8');
//$id=  isset($_POST['numerosolicitud'])?$_POST['numerosolicitud']:'';
$id = '1';
//$solicitudConcepto= new SolicitudConcepto();
if ($id) {
    /*$wsdl = "http://dev.saludcapital.gov.co/SivigiladcPruebas/WebServiceIVCSCS.asmx?wsdl";
    $username = 'UsuarioIVCSDS';
    $password = 'pruebas123';*/
    $wsdl=URLWS;
    $username=USERWS;
    $password=PASSWS;
    //instanciando un nuevo objeto cliente para consumir el webservice
    //$client = new nusoap_client($wsdl, 'wsdl');
  $client = new soapclient($wsdl, true);
  echo "<br>";
  var_dump($client);
    $param = array(
      'pLogin' => $username, 
      'pContrasena'=>$password,
      'NroSoicitud' => $id
    );
   echo "<br>";
    var_dump($param);
   $resultado = $client->call('ConsultarSolicitud', $param);
   echo "<br>";
   //var_dump($resultado);
   //exit;
        if ($client->fault) { 
          echo 'fallo '. print_r($resultado);
        } else {

          $err = $client->getError();
          if ($err) {
          // Display the error
          echo '0';//. $err;
          } else {
        // Display the result
            #echo '<h2>Result</h2><pre>';
            #print_r($resultado);
            #$array = json_decode(json_encode($resultado),true);
              #var_dump($resultado);
              echo 'Estimado(a) Ciudadano,';
              echo '<br>A continuación se describe el estado de su solicitud: ';
            foreach ($resultado as $opcion) {
              echo  isset($opcion["TextoError"])?(utf8_encode($opcion['TextoError'])):'';
              echo isset($opcion["CodError"])?($opcion['CodError']):'';
              #echo  isset($opcion["Id_EstadoSolicitud"])?(utf8_encode(' '.$opcion['Id_EstadoSolicitud'])):'';
            $concep=  isset($opcion["ConceptoSanitario"])?(utf8_encode(' '.$opcion['ConceptoSanitario'])):'';
            $concepto= trim($concep);
            echo $estado= isset($opcion["Des_EstadoSolicitud"])?(utf8_encode(trim($opcion['Des_EstadoSolicitud']))):'';
              $fechaprog=  isset($opcion["FechaProgramada"])?(utf8_encode($opcion['FechaProgramada'])):'';
              $fechar=  isset($opcion["FechaRespuesta"])?(utf8_encode($opcion['FechaRespuesta'])):'';
              $respuesta=  isset($opcion["Respuesta"])?(utf8_encode($opcion['Respuesta'])):'';
              $fechap=date("Y/d/m", strtotime($fechaprog));
              echo '<br>';
              if($estado=="Solicitada"){
                  echo 'Su solicitud ha sido radicada';
              }
              if($estado=="Leida"){
                  echo ' Su solicitud ha sido recibida y está pendiente asignar fecha probable de visita';
              }
              if($estado=="Confirmada"){echo 'Su visita ha sido programada para: '.$solicitudConcepto->fechaCastellano($fechaprog);
                echo '<br>Recuerde que debe haber una persona autorizada al momento de realizar la visita';
              }
              if($estado=="Ejecutada"){ 
                echo 'Visita realizada: '.$fechaprog .' Con Concepto ';
                $solicitudConcepto->defConcepto($concepto);
                
              }
            }

          }
    } 
}       

 ?> 
 