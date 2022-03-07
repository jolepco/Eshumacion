<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
Variables de configuracion produccion
define('URLWS', "http://172.16.150.95/SivigilaDC/WebServiceIVCSCS.asmx?wsdl");
define('USERWS', 'UsuarioIVCSDS');
define('PASSWS', 'Brsageco2019');
define('URLWSGEOLOCALIZACION', "http://201.245.195.150/WsDireccion/?wsdl");
define('USUARIOGEO', 'usrVirtualizacionTramites');
define('PASSGEO','SDS2018jhsta$20');
define('URLCONSULTA','http://www.saludcapital.gov.co/solicitudConcepto');
*/

define('URLWS', "https://appb.saludcapital.gov.co/SivigilaDC/WebServiceIVCSCS.asmx?wsdl");

//define('USERWS', 'UsuarioIVCSDS');
define('USERWS', 'UsuarioIVCSDS');
//define('PASSWS', 'pruebas123');
define('PASSWS', 'Brsageco2019');
define('URLWSGEOLOCALIZACION', "http://201.245.195.150/WsDireccion/?wsdl");
define('USUARIOGEO', 'usrVirtualizacionTramites');
define('PASSGEO','SDS2018jhsta$20');
define('URLCONSULTA','http://www.saludcapital.gov.co/solicitudConcepto');

/***
***
 * información DB PRUEBAS 
 */
define('USER','pruebas_concepto');
define('PASS','C0nc3pt02019*');
define('DB','pruebas_concepto');
define('PORT','3306');
define('HOST','172.16.1.54');

/***
***
 * información DB PRODUCCION
 
define('USER','conceptosanitario');
define('PASS','Concept2019$');
define('DB','concepto_sanitario');
define('PORT','3306');
define('HOST','172.16.1.54');
*/


/***
***
 * información email
 * Se utilza la funcion mail de PHP
 */
$servidor= "smtp.gmail.com";
$puerto="587";
$usuario="soporte.enesima@gmail.com";
$clave="libro.2018";

/**
 * Conexion sqlserver
 */
//servidor\instancia, numeropuerto 
   define('servidorSQL','172.16.0.227\VDBSQLA, 46782'); 
   define('usuarioSQL','UsuarioIVCSDS');
   define('claveSQL','Brsageco2019');
   define('bdSQL','SIVIGILA');
