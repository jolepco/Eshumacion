<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../class/solicitudConcepto.php';
$funcion= isset($_POST['funcion'])? $_POST['funcion']:'';
$solicitud=new SolicitudConcepto();
if($funcion=="upz"){
    $idlocalidad=$_POST['idlocalidad']; 
    $solicitud->select_upz($idlocalidad);
}else if($funcion=="barrio"){
    $idupz=$_POST['idupz']; 
    $solicitud->select_barrio($idupz);
}