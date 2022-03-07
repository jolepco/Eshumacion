<?php

/*

Editado por Alejo en 05/11/2019

 */

include_once '../conf/Config.php';
class conexion {

    private $conexion = null;
    private $user = USER;
    private $pass = PASS;
    private $service = HOST;
    private $port = PORT;
    private $database = DB;

    public  function conectar() {
       $this->conexion = mysqli_connect($this->service, $this->user, $this->pass, $this->database, $this->port);
        if ($this->conexion != null) {
            return $this->conexion;
        } else {
            error_log("No se ha podido establecer conexión con la base de datos");
            return null;
        }
    }

}
?>
