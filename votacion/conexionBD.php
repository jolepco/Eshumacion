<?php

function conectarse()

{

$db_host="172.16.1.54"; // Host BD al que conectarse, habitualmente es localhost

$db_nombre="votacionsds"; // Nombre de la Base de Datos que se desea utilizar

$db_user="usr_votacion"; // Nombre del usuario con permisos para acceder a la BD

$db_pass="Vota5D52020."; // Contraseña del usuario de la BD

// Ahora estamos realizando una conexión y la llamamos $link
$link=mysqli_connect($db_host, $db_user, $db_pass,$db_nombre);
if ($link->connect_error) {
    die("Ha fallado la conexion: " . $link->connect_error);
} 
//echo "Conectado correctamente";

// Seleccionamos la base de datos que nos interesa

//mysql_select_db($db_nombre ,$link) or die("Error seleccionando la base de datos.");

// Retornamos $link  para hacer consultas a la BD.

return $link;

}
//$link=conectarse();

?>
