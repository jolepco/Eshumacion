<?php

require_once("../Rest.php");

class login extends Rest {

    const servidor = "localhost";
    const usuario_db = "root";
    const pwd_db = "Edwin1988";
    const nombre_db = "sds_ficha";

    private $_conn = NULL;
    private $_metodo;
    private $_argumentos;

    public function __construct() {
        parent::__construct();
        $this->conectarDB();
    }

    private function conectarDB() {
        $dsn = 'mysql:dbname=' . self::nombre_db . ';host=' . self::servidor;
        try {
            $this->_conn = new PDO($dsn, self::usuario_db, self::pwd_db);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    private function devolverError($id) {
        $errores = array(
            array('estado' => "error", "msg" => "petición no encontrada"),
            array('estado' => "error", "msg" => "petición no aceptada"),
            array('estado' => "error", "msg" => "petición sin contenido"),
            array('estado' => "error", "msg" => "email o password incorrectos"),
            array('estado' => "error", "msg" => "error borrando usuario"),
            array('estado' => "error", "msg" => "error actualizando nombre de usuario"),
            array('estado' => "error", "msg" => "error buscando usuario por email"),
            array('estado' => "error", "msg" => "error creando usuario"),
            array('estado' => "error", "msg" => "usuario ya existe")
        );
        return $errores[$id];
    }

    public function procesarLLamada() {

        if (isset($_REQUEST['url'])) {
            //si por ejemplo pasamos explode('/','////controller///method////args///') el resultado es un array con elem vacios;
            //Array ( [0] => [1] => [2] => [3] => [4] => controller [5] => [6] => [7] => method [8] => [9] => [10] => [11] => args [12] => [13] => [14] => )
            $url = explode('/', trim($_REQUEST['url']));
            //con array_filter() filtramos elementos de un array pasando función callback, que es opcional.
            //si no le pasamos función callback, los elementos false o vacios del array serán borrados 
            //por lo tanto la entre la anterior función (explode) y esta eliminamos los '/' sobrantes de la URL
            $url = array_filter($url);
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
            $func = $this->_metodo;
            if ((int) method_exists($this, $func) > 0) {
                if (count($this->_argumentos) > 0) {
                    call_user_func_array(array($this, $this->_metodo), $this->_argumentos);
                } else {//si no lo llamamos sin argumentos, al metodo del controlador  
                    call_user_func(array($this, $this->_metodo));
                }
            } else
                $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
        }
        $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);
    }

    private function convertirJson($data) {
        return json_encode($data);
    }

       

    private function validar($usuario,$pass) {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
		
		if($usuario != '' && $pass != ''){
			
			$password = sha1($pass);
			
			$sql = "SELECT id, perfil, username, password, Cargo, IdPersona ";
			$sql .= " FROM usuarios  ";
			$sql .= " WHERE username = '".$usuario."' AND password = '".$password."' ";

			$query = $this->_conn->query($sql);
			$filasDB = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($filasDB) > 0){
				
				$resultado['id_persona'] = $filasDB[0]['IdPersona'];
				$resultado['usuario'] = $filasDB[0]['username'];
				$resultado['cargo'] = $filasDB[0]['Cargo'];
				
				$respuesta['estado'] = 'ok';
				$respuesta['respuesta'] = $resultado;
				$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
			}else{
				$respuesta['estado'] = 'error';
				$respuesta['respuesta'] = 'Usuario y/o clave invalidos';
				$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
			}	
		}else{
			$respuesta['estado'] = 'error';
			$respuesta['respuesta'] = 'Debe enviar usuario y clave validos';
			$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
		}     
    }
}

$api = new login();
$api->procesarLLamada();
