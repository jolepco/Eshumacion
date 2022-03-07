<?php

require_once("../Rest.php");

class personas extends Rest {

    const servidor = "localhost";
    const usuario_db = "root";
    const pwd_db = "";
    const nombre_db = "sds_gestores_final";

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

       

    private function gestorpersonas($usuario, $id_usuario) 
	{
        if ($_SERVER['REQUEST_METHOD'] != "GET") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
		
		if($usuario != '' && $id_usuario != ''){
							
				$sql = "SELECT DISTINCT PE.IdPersona, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, IdTipoIdentifcacion, NumeroIdentificacion,Edad,Gestante,FechaNacimiento,Sexo,GrupoSanguineo, ";
				$sql .= " FactorRH,IdMunicipioNacimiento,IdLocalidad,Barrio,Direccion,Telefono,Telefono2,Email, ";
				$sql .= " CodigoUP,coordenada_x,coordenada_y,Peso,Talla,Imc, ";
				$sql .= " Desc_imc,etnia,id_subred,semanas_gest,programa ";
				$sql .= " FROM Persona PE ";
				$sql .= " JOIN Asignacion ASI ON ASI.IdPersona = PE.IdPersona ";
				$sql .= " WHERE IdGestor = '".$id_usuario."' ";
				
				$queryPersonas = $this->_conn->query($sql);
				$resultadoPersonas = $queryPersonas->fetchAll(PDO::FETCH_ASSOC);
				//var_dump($resultadoPersonas);exit;
				if(count($resultadoPersonas) > 0){
					$persona = 0;
					for($i=0;$i<count($resultadoPersonas);$i++)
					{
						$resultado[$persona]['IdPersona'] = $resultadoPersonas[$i]['IdPersona'];
						$resultado[$persona]['PrimerNombre'] = utf8_decode($resultadoPersonas[$i]['PrimerNombre']);
						$resultado[$persona]['SegundoNombre'] = utf8_decode($resultadoPersonas[$i]['SegundoNombre']);
						$resultado[$persona]['PrimerApellido'] = utf8_decode($resultadoPersonas[$i]['PrimerApellido']);
						$resultado[$persona]['SegundoApellido'] = utf8_decode($resultadoPersonas[$i]['SegundoApellido']);
						$resultado[$persona]['IdTipoIdentifcacion'] = $resultadoPersonas[$i]['IdTipoIdentifcacion'];
						$resultado[$persona]['NumeroIdentificacion'] = $resultadoPersonas[$i]['NumeroIdentificacion'];
						$resultado[$persona]['Edad'] = $resultadoPersonas[$i]['Edad'];
						$resultado[$persona]['Gestante'] = $resultadoPersonas[$i]['Gestante'];
						$resultado[$persona]['FechaNacimiento'] = $resultadoPersonas[$i]['FechaNacimiento'];
						$resultado[$persona]['Sexo'] = $resultadoPersonas[$i]['Sexo'];
						$resultado[$persona]['GrupoSanguineo'] = $resultadoPersonas[$i]['GrupoSanguineo'];
						$resultado[$persona]['FactorRH'] = $resultadoPersonas[$i]['FactorRH'];
						$resultado[$persona]['IdMunicipioNacimiento'] = $resultadoPersonas[$i]['IdMunicipioNacimiento'];
						$resultado[$persona]['IdLocalidad'] = $resultadoPersonas[$i]['IdLocalidad'];
						$resultado[$persona]['Barrio'] = $resultadoPersonas[$i]['Barrio'];
						$resultado[$persona]['Direccion'] = $resultadoPersonas[$i]['Direccion'];
						$resultado[$persona]['Telefono'] = $resultadoPersonas[$i]['Telefono'];
						$resultado[$persona]['Telefono2'] = $resultadoPersonas[$i]['Telefono2'];
						$resultado[$persona]['Email'] = $resultadoPersonas[$i]['Email'];
						$resultado[$persona]['CodigoUP'] = $resultadoPersonas[$i]['CodigoUP'];
						$resultado[$persona]['coordenada_x'] = $resultadoPersonas[$i]['coordenada_x'];
						$resultado[$persona]['coordenada_y'] = $resultadoPersonas[$i]['coordenada_y'];
						$resultado[$persona]['Peso'] = $resultadoPersonas[$i]['Peso'];
						$resultado[$persona]['Talla'] = $resultadoPersonas[$i]['Talla'];
						$resultado[$persona]['Imc'] = $resultadoPersonas[$i]['Imc'];
						$resultado[$persona]['Desc_imc'] = $resultadoPersonas[$i]['Desc_imc'];
						$resultado[$persona]['etnia'] = $resultadoPersonas[$i]['etnia'];
						$resultado[$persona]['id_subred'] = $resultadoPersonas[$i]['id_subred'];
						$resultado[$persona]['semanas_gest'] = $resultadoPersonas[$i]['semanas_gest'];
						$resultado[$persona]['programa'] = $resultadoPersonas[$i]['programa'];
						
						$persona++;
					}
					/*echo "<pre>";
					var_dump($resultado);
					echo "</pre>";
					exit;*/
					$respuesta['estado'] = 'ok';
					$respuesta['respuesta'] = $resultado;
					$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
				}else{
					$respuesta['estado'] = 'error';
					$respuesta['respuesta'] = 'El usuario no tiene personas asociadas';
					$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
				}	
			}else{
				$respuesta['estado'] = 'error';
				$respuesta['respuesta'] = 'No se encontro el usuario';
				$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
			}
		
    }
	
	private function registroFicha() 
	{	
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);
        }
		
		$cuerpo = file_get_contents('php://input');
		$datos = json_decode($cuerpo);
		
		
		for($i=0;$i<count($datos->viable);$i++){
			
			if(isset($datos->viable[$i]) && $datos->viable[$i] == 1){
			
			$datosPersona['Edad'] = $datos->enc_edad[$i];
			$datosPersona['FechaNacimiento'] = $datos->enc_fech_nac[$i];
			$datosPersona['IdLocalidad'] = $datos->loca_capta[$i];
			$datosPersona['Barrio'] = $datos->barr_capta[$i];
			$datosPersona['Direccion'] = $datos->dire_resi[$i];
			$datosPersona['Telefono'] = $datos->tele_cont[$i];
			$datosPersona['IdPersona'] = $datos->id_persona[$i];
			
			$sql = "UPDATE Persona SET ";
			$sql .= " Edad = '".$datosPersona['Edad']."', ";
			$sql .= " FechaNacimiento = '".$datosPersona['FechaNacimiento']."', ";
			$sql .= " IdLocalidad = '".$datosPersona['IdLocalidad']."', ";
			$sql .= " Barrio = '".$datosPersona['Barrio']."', ";
			$sql .= " Direccion = '".$datosPersona['Direccion']."', ";
			$sql .= " Telefono = '".$datosPersona['Telefono']."' ";
			$sql .= " WHERE IdPersona = '".$datosPersona['IdPersona']."' ";
			
			// Prepare statement
			$stmt = $this->_conn->prepare($sql);

			// execute the query
			$registro = $stmt->execute();
			
			if($registro){
				
				$sql = "SELECT id, perfil, idPersona ";
				$sql .= " FROM usuarios ";
				$sql .= " WHERE username = '".$datos->id_gestor."' ";
				
				$queryGestor = $this->_conn->query($sql);
				$resultadoGestor = $queryGestor->fetchAll(PDO::FETCH_ASSOC);
				
				$idGestor = $resultadoGestor[0]['id'];
				
				$datosNoViable['Fecha'] = date('Y-m-d');
				$datosNoViable['IdPersona'] = $datos->id_persona[$i];
				$datosNoViable['IdGestor'] = $idGestor;
				$datosNoViable['IdEstadoVisita'] = $datos->viable[$i];
				
				$sql = " INSERT INTO Visita ";
				$sql .= " (Fecha, IdPersona, IdGestor, IdEstadoVisita) ";
				$sql .= " VALUES ";
				$sql .= " ('".$datosNoViable['Fecha']."', ".$datosNoViable['IdPersona'].", ".$datosNoViable['IdGestor'].", ".$datosNoViable['IdEstadoVisita']."); ";
	
				// Prepare statement
				$this->_conn->exec($sql);
				
				$resultadoVisita = $this->_conn->lastInsertId(); 
				//var_dump($resultadoVisita);exit;
				//$resultadoVisita = $this->gestor_model->guardaVisita($datosNoViable);
				
				if($resultadoVisita){
					$datosFicha['IdVisita'] = $resultadoVisita;
					$datosFicha['FechaRegistro'] = date('Y-m-d');
					$datosFicha['IdPrestadorServicio'] = $datos->pres_prim[$i];
					$datosFicha['IdEtnia'] = $datos->enc_etnia[$i];
					$datosFicha['IdEstadoCivil'] = $datos->enc_estado_civil[$i];
					$datosFicha['IdNivelEducativo'] = $datos->enc_nivel[$i];
					$datosFicha['Estrato'] = $datos->enc_estrato[$i];
					$datosFicha['CantidadPersonasHogar'] = $datos->enc_personas[$i];
					$datosFicha['IdResponsableCuidado'] = $datos->enc_responsable[$i];
					$datosFicha['DescripcionOtroResponsable'] = $datos->cual_enca[$i];
					$datosFicha['TieneLimitacionFisicaDiscapacidad'] = $datos->enc_discapacidad[$i];
					$datosFicha['DescripcionLimitacionFisicaDiscapacidad'] = $datos->cual_disc[$i];
					$datosFicha['IdOpcionUltimaConsulta'] = $datos->p1[$i];
					$datosFicha['IdOpcionUltimaTomaLaboratorios'] = $datos->p2[$i];
					$datosFicha['Tas'] = $datos->tas[$i];
					$datosFicha['Tad'] = $datos->tad[$i];
					$datosFicha['IdOpcionTAS'] = $datos->p3[$i];
					$datosFicha['ValorGlucometria'] = $datos->glucometria[$i];
					$datosFicha['IdOpcionGlucometria'] = $datos->p4[$i];
					$datosFicha['TiempoConsumoAlimentos'] = $datos->t_com_v[$i];
					$datosFicha['ValorPerimetroAbdominal'] = $datos->vp_5[$i];
					$datosFicha['IdOpcionPA'] = $datos->p5[$i];
					$datosFicha['ExisteHospitalizacionTA'] = $datos->p6[$i];
					$datosFicha['ExisteHospitalizacionTA2'] = $datos->p7[$i];
					$datosFicha['EsFumador'] = $datos->p8[$i];
					$datosFicha['EsBebedor'] = $datos->p9[$i];
					$datosFicha['RealizaActividadFisica'] = $datos->p10[$i];
					$datosFicha['DescripcionActividadFisica'] = $datos->cual_depo[$i];
					$datosFicha['IdPrioridad'] = $datos->prioridad[$i];
					$datosFicha['IdMedioCita'] = $datos->medio_cita[$i];
					$datosFicha['FechaCita'] = $datos->fecha_cita[$i];
					$datosFicha['LugarCita'] = $datos->lugar_cita[$i];
					$datosFicha['ObsPrioridad'] = $datos->ambulancia[$i];
					
					$sql = "INSERT INTO FichaHTDA ";
					$sql .= " (IdVisita, FechaRegistro, IdPrestadorServicio, IdEtnia, IdEstadoCivil, IdNivelEducativo, DescripcionOtroNivelEducativo, Estrato, ";
					$sql .= " CantidadPersonasHogar, IdResponsableCuidado, DescripcionOtroResponsable, TieneLimitacionFisicaDiscapacidad, DescripcionLimitacionFisicaDiscapacidad, ";
					$sql .= " IdOpcionUltimaConsulta, IdOpcionUltimaTomaLaboratorios, Tas, Tad, IdOpcionTAS, ValorGlucometria, IdOpcionGlucometria, TiempoConsumoAlimentos, ";
					$sql .= " ValorPerimetroAbdominal, IdOpcionPA, ExisteHospitalizacionTA, ExisteHospitalizacionTA2, EsFumador, EsBebedor, RealizaActividadFisica, DescripcionActividadFisica, ";
					$sql .= " IdPrioridad, IdMedioCita, FechaCita, LugarCita, ObsPrioridad) ";
					$sql .= " VALUES ";
					$sql .= " (".$datosFicha['IdVisita'].", ";
					$sql .= " ".$datosFicha['FechaRegistro'].", ";
					$sql .= " ".$datosFicha['IdPrestadorServicio'].", ";
					$sql .= " ".$datosFicha['IdEtnia'].", ";
					$sql .= " ".$datosFicha['IdEstadoCivil'].", ";
					$sql .= " ".$datosFicha['IdNivelEducativo'].", ";
					$sql .= " '".$datosFicha['DescripcionOtroNivelEducativo']."',";
					$sql .= " ".$datosFicha['Estrato'].",";
					$sql .= " ".$datosFicha['CantidadPersonasHogar'].",";
					$sql .= " ".$datosFicha['IdResponsableCuidado'].",";
					$sql .= " '".$datosFicha['DescripcionOtroResponsable']."',";
					$sql .= " ".$datosFicha['TieneLimitacionFisicaDiscapacidad'].", ";
					$sql .= " '".$datosFicha['DescripcionLimitacionFisicaDiscapacidad']."',";
					$sql .= " ".$datosFicha['IdOpcionUltimaConsulta'].",";
					$sql .= " ".$datosFicha['IdOpcionUltimaTomaLaboratorios'].",";
					$sql .= " ".$datosFicha['Tas'].",";
					$sql .= " ".$datosFicha['Tad'].",";
					$sql .= " ".$datosFicha['IdOpcionTAS'].",";
					$sql .= " ".$datosFicha['ValorGlucometria'].",";
					$sql .= " ".$datosFicha['IdOpcionGlucometria'].",";
					$sql .= " ".$datosFicha['TiempoConsumoAlimentos'].",";
					$sql .= " ".$datosFicha['ValorPerimetroAbdominal'].",";
					$sql .= " ".$datosFicha['IdOpcionPA'].",";
					$sql .= " ".$datosFicha['ExisteHospitalizacionTA'].",";
					$sql .= " ".$datosFicha['ExisteHospitalizacionTA2'].",";
					$sql .= " ".$datosFicha['EsFumador'].",";
					$sql .= " ".$datosFicha['EsBebedor'].",";
					$sql .= " ".$datosFicha['RealizaActividadFisica'].",";
					$sql .= " '".$datosFicha['DescripcionActividadFisica']."',";
					$sql .= " ".$datosFicha['IdPrioridad'].",";
					$sql .= " ".$datosFicha['IdMedioCita'].",";
					$sql .= " ".$datosFicha['FechaCita'].",";
					$sql .= " ".$datosFicha['LugarCita'].",";
					$sql .= " '".$datosFicha['ObsPrioridad']."'); ";
	
					// Prepare statement
					$this->_conn->exec($sql);
					
					$resultadoFicha = $this->_conn->lastInsertId(); 
					
					if($resultadoFicha){
						
						$resp_ws[$datos->id_persona[$i]]['guardoFicha'] = 1;
						$resp_ws[$datos->id_persona[$i]]['mensaje'] = "Se guardo la informacion de la ficha, visita y persona";
						
						
					}else{
						$resp_ws[$datos->id_persona[$i]]['guardoFicha'] = 0;
						$resp_ws[$datos->id_persona[$i]]['mensaje'] = "Se guardo la informacion de la visita y la persona pero no de la ficha";
					}
					
				}else{
					$resp_ws[$datos->id_persona[$i]]['guardoFicha'] = 0;	
					$resp_ws[$datos->id_persona[$i]]['mensaje'] = "Se guardo la informacion de la persona pero no de la visita y la ficha";
				}
				
			}else{
				$resp_ws[$datos->id_persona[$i]]['guardoFicha'] = 0;	
				$resp_ws[$datos->id_persona[$i]]['mensaje'] = "No se guardo la informacion";
			}
		}else{
			
			$sql = "SELECT id, perfil, idPersona ";
			$sql .= " FROM usuarios ";
			$sql .= " WHERE username = '".$datos->id_gestor."' ";
			
			$queryGestor = $this->_conn->query($sql);
			$resultadoGestor = $queryGestor->fetchAll(PDO::FETCH_ASSOC);
			
			$idGestor = $resultadoGestor[0]['id'];
			
			$datosNoViable['Fecha'] = date('Y-m-d');
			$datosNoViable['IdPersona'] = $datos->id_persona[$i];
			$datosNoViable['IdGestor'] = $idGestor;
			$datosNoViable['IdEstadoVisita'] = $datos->viable[$i];
			
			$sql = " INSERT INTO Visita ";
			$sql .= " (Fecha, IdPersona, IdGestor, IdEstadoVisita) ";
			$sql .= " VALUES ";
			$sql .= " ('".$datosNoViable['Fecha']."', ".$datosNoViable['IdPersona'].", ".$datosNoViable['IdGestor'].", ".$datosNoViable['IdEstadoVisita']."); ";

			// Prepare statement
			$this->_conn->exec($sql);
			
			$resultadoVisita = $this->_conn->lastInsertId(); 
			
			$resp_ws[$datos->id_persona[$i]]['guardoFicha'] = 1;	
			$resp_ws[$datos->id_persona[$i]]['mensaje'] = "Se registro la informacion de la visita";
			
			}
			
		}
		$respuesta['estado'] = 'respuesta';
		$respuesta['respuesta'] = $resp_ws;
		$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
    }
}

$api = new personas();
$api->procesarLLamada();
