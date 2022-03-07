<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#header('Content-Type: text/html; charset=ISO-8859-1'); 
#header('Content-Type: text/xml; charset=utf-8');
require_once('../lib/nusoap.php');
include_once '../conf/Config.php';
$dir =  isset($_POST['direccion'])?$_POST['direccion']:'';
if ($dir) {
    /*$wsdl = "http://201.245.195.150/WsDireccion/?wsdl";
    $usuario = 'usrVirtualizacionTramites';
    $pass = 'SDS2018jhsta$20';*/
    $wsdl=URLWSGEOLOCALIZACION;
    $usuario=USUARIOGEO;
    $pass=PASSGEO;       
    //instanciando un nuevo objeto cliente para consumir el webservice
    $client = new nusoap_client($wsdl, 'wdsl');
   $param = array( 
      'pass'=>$pass,
      "Direccion" => "$dir",
      'usuario' => $usuario
    );

   $resultado = $client->call('obtenerCodDireccion', $param);
   #$d=$resultado->return; echo $id;
             if ($client->fault) { 
                 echo 'fallo '. print_r($resultado);
                } else {

                 $err = $client->getError();
                  if ($err) {
                 // Display the error
                  echo 'Error !!!!'. $err;
                  } else {
                 // Display the result
                  //print_r($resultado);
                 $datos=implode(';', $resultado);
                  $dat=explode(';', $datos);
                  echo $dat[1] . "|" . $dat[2]."|" . $dat[3];
                 //echo $loca= $dat[1];
                 //echo $upz= $dat[2];
                 
                  }
                 } 
 
}       