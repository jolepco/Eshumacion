<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../conf/Config.php';

$numeroIns= isset($_POST['numeroIns'])? $_POST['numeroIns']:'';

if($numeroIns){
	
$connectionInfo=array("Database"=>bdSQL,"UID"=>usuarioSQL,"PWD"=>claveSQL);
$conn=sqlsrv_connect(servidorSQL,$connectionInfo);

##   base de datos

if( $conn ) {
    # consulta   
    $query="select * from dbo.fnGetInscripEstabById('$numeroIns')";
    $result = sqlsrv_query($conn,$query);
      
    $row = sqlsrv_fetch_array($result);    

    $str=$row[0]."|".$row[1]."|".$row[2]."|".$row[3]."|".$row[4]."|".$row[5]."|".$row[6]."|".$row[7]."|".$row[8]."|".$row[9]."|".$row[10];
    $str.="|".$row[11]."|".$row[12]."|".$row[13]."|".$row[14]."|".$row[15]."|".$row[16]."|".$row[17]."|".$row[18]."|".$row[19];
    $str.="|".$row[20]."|".$row[21]."|".$row[22]."|".$row[23]."|".$row[24]."|".$row[25]."|".$row[26]."|".$row[27]."|".$row[28];
    $str.="|".$row[29]."|".$row[30]."|".$row[31]."|".$row[32]."|".$row[33]."|".$row[34]."|".$row[35]."|".$row[36]."|".$row[37];    
   
    echo $str;
    exit;
   
}else{
    echo "0";
    foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
}

    
}