<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Expendedor_droga extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('usuarios_model');
        $this->load->model('login_model');		
        $this->load->database('default');
		$this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form'));
		
		if(!$this->session->userdata('id_usuario') || $this->session->userdata('id_usuario') == ''){
			$this->session->sess_destroy();
			redirect($this->config->item('url_tramites'));
        } 
    }

    public function validacion()
    {
        redirect(base_url('expendedor_droga/tramites_pendientes'));
    }

    public function pruebaapi(){
        $email = $this->input->get_post('email');
      $url="https://sicai.saludcapital.gov.co/WebApiSolicitudVacunas/api/autautorizacion/validarUsuarioIps";
        
        $curl = curl_init();
       
         curl_setopt_array($curl, array(
         CURLOPT_URL => "".$url."",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "POST",
         //CURLOPT_POSTFIELDS => "{\"codProveedor\": \"Contactalos\",\"destinatarios\": [\"".$celular."\"],\"mensaje\": \"".$mensaje."\"}",
         CURLOPT_POSTFIELDS => "{\"usuario\": \"".$email."\"}",
         CURLOPT_HTTPHEADER => array(
        "Authorization: basic U0RTX1NJR1NCOmEzOWFkNmU2LTI4YTUtNDg0Yi05NTJiLWE2YzEzMDMzOTI3MQ==",
        "Content-Type: application/json"
         ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        

        curl_close($curl);

        if ($err) {
         echo "cURL Error #:" . $err;
        } else {
          $obj = json_decode($response, true);
          
        if($obj['Codigo']==1){

            if($tipo_consulta==1){
              $this->generar_excel($obj['Datos'],1);
            }
            elseif($tipo_consulta==2){
              $this->generar_excel($obj['Datos'],2);
            }
            elseif($tipo_consulta==3){
              $this->generar_excel($obj['Datos'],3);
            }
            elseif($tipo_consulta==4){
              
              $this->generar_excel($obj['Datos'],4);
            }
            

          }else{
            //var_dump($obj);
            echo "Error al generar el archivo ".$obj['ErrorSys'];
          }
          
        }
    }

    public function index(){
        $this->load->model("expendedor");
        $this->session->set_userdata('controller','Expendedor droga','controller');
        $data["controller"]=$this->session->userdata('controller');
        $data['id_usuario']=$this->session->userdata('id_persona');
        $data['information'] = $this->expendedor->consulta_persona($data['id_usuario']);
        $data['contenido'] = 'declaracion_juramentada';
        /*$arrParam = array(
            "column" => "id_usuario",
            "value" => $data['id_usuario']
        );*/
        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        $result_tramite = $this->expendedor->verifyTramite($arrParam); 

        if ($result_tramite) {
            
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrado un tr??mite para licencia de expendedor de droga.');
            redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
        } 
        else {
            $this->load->view('templates/layout_expendedor',$data);
        }
    }

    public function form_documentos()
    {
    	$this->load->model("expendedor");
		$this->session->set_userdata('controller','Expendedor droga','controller');
        $data["controller"]=$this->session->userdata('controller');
        $data['id_usuario']=$this->session->userdata('id_persona');	
        $data["nom_usuario"] = $nom_usuario;
        
        $data['information'] = $this->expendedor->consulta_persona($data['id_usuario']);
        
        $data['contenido'] = 'cargar_documentos'; 
        //$data["menu"] = "adminmenu";
        //Valida la existencia de registro de tr??mite
        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        $result_tramite = $this->expendedor->verifyTramite($arrParam);	
        if ($result_tramite) {
        	
        	/*$data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrado un tr??mite para licencia de expendedor de droga.');*/
            redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
        } 
        else {
        	$this->load->view('templates/layout_expendedor',$data);
    	}
		
	}

	//M??todo para cargar los ducumentos para t??mite de expendedor de drogas
	public function registrar_documentos(){
		$this->load->model("expendedor");

		$data['id_usuario']=$this->session->userdata('id_persona');	
		$data['id_estado']=1;	
		$data['fecha_registro']=date('Y-m-d H:i:s');

		$arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado != " => 21,
        );
        //Valida la existencia de registro de tr??mite
        $result_tramite = $this->expendedor->verifyTramite($arrParam);	
        if ($result_tramite) {
        	$data["result"] = "error";
            $this->session->set_flashdata('retornoError', 'El ciudadano ya tiene registrado un tr??mite para licencia de expendedor de droga.'); 
            redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
        } 
        else {
        	//Regista el tr??mite
			$registrarTramite = $this->expendedor->registrarTramite($data);
			if($registrarTramite){
                //Consulta tr??mite
    			$idtramite = $this->expendedor->consulta_tramite($data['id_usuario']);
    			$dataTramite['id_tramite'] = $idtramite->id_expdrogas_tramite;
    			$dataTramite['id_usuario']=$this->session->userdata('id_persona');
                $dataTramite['fecha_registro']=date('Y-m-d H:i:s');	
    			$dataTramite['id_estado']=1;
    			$dataTramite['observaciones']=$this->input->get_post('observaciones');
    			//Regista el seguimiento host??rico del tr??mite
    			$registrarSeguimiento = $this->expendedor->registrarSeguimiento($dataTramite);

    			/**
    			Cargar archivos del equipo
    			*/
    								
    			$bandera = 1;
    			$documentos = array("cedula","registro_civil", "tarjeta_reservista", "certificado_salud", "antecedentes_judiciales","certificado_vecindad", "manisfestacion_expresa", "certificado_minsalud", "certificado_estudios");
			
    			//Bucle para el conteo de los documento cargados
                $flag=0;
                for($i=0;$i<=count($documentos);$i++){
                    //Vallida la rcecpci??n de archivos.
                    if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0 && $_FILES[$documentos[$i]]['type']=='application/pdf') {
                        
    					$nombre_archivo = $data['id_usuario']."-".$documentos[$i]."-".date('YmdHis');
    					
    					$config['upload_path'] = "/mt/sdb1/uploads/expendedor/";
    					$config['allowed_types'] = 'pdf';
    					$config['max_size'] = '50000';
    					$config['file_name'] = $nombre_archivo;
    					/* Fin Configuracion parametros para carga de archivos */
    					
    					// Cargue libreria
    					$this->load->library('upload', $config);
    					$this->upload->initialize($config);
    					
    					//var_dump($config);
    					if ($this->upload->do_upload($documentos[$i])) {
    						$upload_data = $this->upload->data();
    						$rutaFinal = array('rutaFinal' => $this->upload->data());
                            $datosAr['ruta'] = '/mt/sdb1/uploads/expendedor/';
                            $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                            $datosAr['fecha'] = date('Y-m-d');
                            $datosAr['tags'] = "";
                            $datosAr['es_publico'] = 1;
                            $datosAr['id_persona'] = $data['id_usuario'];
                            $datosAr['condicion'] = 0;
                            $datosAr['estado'] = 'AC';
                            $resultadoIDDocumentoArc = $this->expendedor->insertarArchivo($datosAr);
    					} else {
                            $flag=1;
    					}
                    }
                }
               
                $info = $this->expendedor->mis_tramites($data['id_usuario']);
                if($flag==1){
                    $this->expendedor->anularTramite($data['id_usuario']);
                    $this->expendedor->anularArchivos($data['id_usuario']);
                    $this->session->set_flashdata('retorno_error', "Error al cargar el archivo, por favor contacte al administrador");
                    redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
                    exit;
                }else{                
                    //Asigno la informaci??n a un arreglo $datos_tramite
                    $datos_tramite['p_nombre']=$info[0]->p_nombre;
                    $datos_tramite['p_apellido']=$info[0]->p_apellido;
                    $datos_tramite['email']=$info[0]->email;
                    $datos_tramite['estado']=$info[0]->id_estado;
                    $datos_tramite['id_tramite']=$info[0]->id_expdrogas_tramite;
                    //env??o correo confirmando el registo del tr??mite
                    $this->enviarCorreo($datos_tramite);
                    $this->session->set_flashdata('retornoExito', 'Registro exitoso, tr??mite  n??mero '.$datos_tramite['id_tramite'].'.</b>');
        			redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
        			exit;
                }
            }
		}
	}

	//M??todo para mostrar los tr??mites registrados, en este caso uno
	public function verTramite(){
		$this->load->model("expendedor");
		$data['id_usuario']=$this->session->userdata('id_persona');	
        $data['info'] = $this->expendedor->mis_tramites($data['id_usuario']);

        $data['archivos'] = $this->expendedor->consulta_archivos($data['id_usuario']);
		//echo "MMM".$data['archivos'][0]['id_archivo'];     
        $data['titulo'] = 'Licencias Expendedor de drogas';
        
        $data['contenido'] = 'mi_tramite';
        $this->load->view('templates/layout_expendedor',$data);


    }

    //M??todo para editar los datos personales del ciudadano
    public function editar_tramite(){
    	//header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("expendedor");

        $data['id_usuario']=$this->session->userdata('id_persona');	
        $data['id_persona']=$this->session->userdata('idpersona'); 
        $data['information'] = FALSE;
        if($this->input->post('idRow')&&$this->input->post('idRow')=='persona'){
            $usuario= $data['id_persona'];
        }else{
             $usuario= $data['id_usuario'];
        }
       	$data['information'] = $this->expendedor->consulta_persona($usuario);
       	$data['nivel_educativo'] = $this->expendedor->consulta_nivel();
        $Fecha = explode("-",$data['information']->fecha_nacimiento);
        $data['newFecha_nacimiento'] = $Fecha[1]."/".$Fecha[2]."/".$Fecha[0];
       
        $this->load->view("editar_personas", $data);
        //$this->load->view('templates/layout_expendedor',$data);
    }

    //M??todo para guardar los camibos de los datos personales
    public function save_persona(){
    	header('Content-Type: application/json');
        $this->load->model("expendedor");
        $data = array();
        
        if($this->session->userdata('perfil')==2){
            $idusuario = $this->session->userdata('id_persona');
            $data['id_usuario']=$this->session->userdata('id_persona'); 
            $data['id_estado']=23;   
            $data['fecha_registro']=date('Y-m-d H:i:s');
            $editar_estadoTramite = $this->expendedor->actualizar_tramite($data);
        }else{
              $idusuario = $this->session->userdata('idpersona');
        }
               
       	$msj = "Se actualiz&oacute; el registro exitosamente.";
        
        $documento = $this->input->post('documento');

        if ($idActividad = $this->expendedor->savePersona($idusuario)) {
           
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoP', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    }

    //M??todo para ver los tr??mites pendientes
    public function tramites_pendientes(){
       $this->load->model("expendedor");
       
        $data['id_usuario']=$this->session->userdata('id_persona');

        $data['info'] = $this->expendedor->get_tramites();

        $data['archivos'] = $this->expendedor->consulta_archivos($data['id_usuario']);
           
        $data['titulo'] = 'Licencias Expendedor de drogas';
        
        $data['contenido'] = 'lista_tramites';
        $this->load->view('templates/layout_expendedor',$data);
    }

    //M??todo para ver los tr??mites seleccinados de la lista
    public function aprobar_tramite($id_persona){
        $this->load->model("expendedor");
        $data['id_usuario']=$this->session->userdata('id_persona');  
        $data['info'] = $this->expendedor->mis_tramites($id_persona);
        $data['resolucion'] = $this->expendedor->consulta_resolucion
($id_persona,4);

        $data['estados'] = $this->expendedor->consulat_estados();
        $data['archivos'] = $this->expendedor->consulta_archivos($id_persona);
        $this->session->set_userdata('idpersona',$id_persona);
        $data['id_persona']=$this->session->userdata('idpersona');
        $usuario= $id_persona;
        
        $data['information'] = $this->expendedor->consulta_persona($usuario);

        //Valida en ORACLE si tiene tr??mite
        $data['tiene_tramite']= 0;
        //if($id_persona==23236){
            
        $numiden=$data['info'][0]->nume_identificacion;
        $data['tramite_oracle'] = $this->expendedor->consulta_oracle($numiden);
        if($data['tramite_oracle']['NROIDENT'] == 0){
            $data['tiene_tramite']= 0;
        }else{
            $data['tiene_tramite']= 1;
        }
        //}
       
        if($this->session->userdata('perfil')==5){
            $data['boton']="Guardar";
        }else{
            $data['boton']="Guardar";
        }
        $data['titulo'] = 'Licencias Expendedor de drogas';
        
        $data['contenido'] = 'aprobar_tramite_view';
        $this->load->view('templates/layout_expendedor',$data);
    }

    //M??todo para aprobar validador
    public function save_aprobar_validador(){
        header('Content-Type: application/json');
        $this->load->model("expendedor");
        $data = array();
        $idpersona = $this->session->userdata('idpersona');
        //var_dump($this->session->userdata);
       
        $msj = "Registro exitoso.";

        $dataarchivos['archivos']=$this->expendedor->consulta_archivos($idpersona);
        $cierto=0;
        for($i=0; $i<=count( $dataarchivos['archivos'])-1; $i++){
            if($this->input->post($dataarchivos['archivos'][$i]['id_archivo'])==2 && $this->input->post('estado')==2){
                
                $cierto=1;
            }
        }
        if($cierto==1){
            $data["result"] = true;
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Error al aprobar el tr??mite, tiene documentos marcados como no cumplen.');
        }else{
        
            //Registra en el hist??diro de tr??mite
            if ($idTramite = $this->expendedor->save_historico($idpersona)) {
                //Actualiza el trpamite
               $this->expendedor->actualizar_tramite($idpersona);
               
               //Consulta los archivos registardos por el ciudadano
               $dataarchivos['archivos']=$this->expendedor->consulta_archivos($idpersona);
               //Actualiza el estado de los archivos
                $alerta=0;
                for($i=0; $i<=count( $dataarchivos['archivos'])-1; $i++){
                    $this->expendedor->actualizar_archivo($dataarchivos['archivos'][$i]['id_archivo']);
                }
                //Si el pefil es validador
                if($this->session->userdata('perfil')==3){
                    if($this->input->post('estado')==13){
                        $info = $this->expendedor->mis_tramites($idpersona);
                        //Asigno la informaci??n a un arreglo $datos_tramite
                        $datos_tramite['p_nombre']=$info[0]->p_nombre;
                        $datos_tramite['p_apellido']=$info[0]->p_apellido;
                        $datos_tramite['email']=$info[0]->email;
                        $datos_tramite['estado']=$info[0]->id_estado;
                        $datos_tramite['observaciones']=$info[0]->observaciones;
                        $this->enviarCorreo($datos_tramite);
                    }
                }
                //Si el perfil es director
                if($this->session->userdata('perfil')==5){
                    //si el tr??mite es probado
                    if($this->input->post('estado')==4 || $this->input->post('estado')==11){
                        //Verifica la existencia de una resoluci??n
                        $result_resolucion = $this->expendedor->verifyResolucion($idpersona,$this->input->post('estado'));  
                        if ($result_resolucion) {
                            $data["result"] = "error";
                            $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrada una resoluci??n de licencia de expendedor de droga.');
                            //redirect(base_url('expendedor_droga/editar_tramite/'), 'refresh');
                        }else{
                            //Genera c??digo de verificaci??n 
                            $codigo_verificacion = $this->genera_codigo();
                            //Registra la resoluci??n en la bd
                            $result_save_resolucion = $this->expendedor->save_resolucion($idpersona, $codigo_verificacion,$this->input->post('estado'));
                            //Env??a correo de notificaci??n
                            if($result_save_resolucion){
                                //Consulta la informaci??n del ciudadano para el env??o de correo
                                $info = $this->expendedor->mis_tramites($idpersona);
                                //Asigno la informaci??n a un arreglo $datos_tramite
                                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                                $datos_tramite['email']=$info[0]->email;
                                $datos_tramite['estado']=$info[0]->id_estado;
                                //$datos_tramite['email']='sjneira@saludcapital.gov.co';
                                //$this->enviarCorreo($datos_tramite);
                                //redirect(base_url('expendedor_droga/firmar_credencial/'), 'refresh');
                            }
                        }
                    }elseif($this->input->post('estado')==7){
                        //Verifica la existencia de una resoluci??n
                        $result_resolucion = $this->expendedor->verifyResolucion($idpersona,$this->input->post('estado'));  
                        if ($result_resolucion) {
                            $data["result"] = "error";
                            $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrada una resoluci??n de licencia de expendedor de droga.');
                            //redirect(base_url('expendedor_droga/editar_tramite/'), 'refresh');
                        }else{
                            //Genera c??digo de verificaci??n 
                            $codigo_verificacion = $this->genera_codigo();
                            //Registra la resoluci??n en la bd
                            $result_save_resolucion = $this->expendedor->save_resolucion($idpersona, $codigo_verificacion,$this->input->post('estado'));
                            //Env??a correo de notificaci??n
                            if($result_save_resolucion){
                                //Consulta la informaci??n del ciudadano para el env??o de correo
                                $info = $this->expendedor->mis_tramites($idpersona);
                                //Asigno la informaci??n a un arreglo $datos_tramite
                                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                                $datos_tramite['email']=$info[0]->email;
                                $datos_tramite['estado']=$info[0]->id_estado;
                                $datos_tramite['observaciones']=$info[0]->observaciones;
                                //$this->enviarCorreo($datos_tramite);
                            }
                        }
                    }elseif($this->input->post('estado')==19){
                        //Verifica la existencia de una resoluci??n
                        $result_resolucion = $this->expendedor->verifyResolucion($idpersona,4);  
                        if ($result_resolucion) {
                            $info = $this->expendedor->mis_tramites($idpersona);
                            //Asigno la informaci??n a un arreglo $datos_tramite
                            $datos_tramite['p_nombre']=$info[0]->p_nombre;
                            $datos_tramite['p_apellido']=$info[0]->p_apellido;
                            $datos_tramite['email']=$info[0]->email;
                            $datos_tramite['estado']=$info[0]->id_estado;
                            $datos_tramite['observaciones']=$info[0]->observaciones;
                        }else{
                            $data["result"] = "error";
                            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Para la resoluci??n de aclaraci??n no es ecesario tener una resoluci??n de aprobaci??n.');
                        }
                    }
                }

                $data["result"] = true;
                $this->session->set_flashdata('retornoExito', $msj);
            } else {
                $data["result"] = "error";
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
            }
        }
        
        echo json_encode($data);
    }

    //M??todo para descargar los PDF con las resoluciones de la credenciales o resolci??n de solicitud rechazada
    public function resoluciones(){
        
        $this->load->model("expendedor");
        $data['id_usuario']=$this->session->userdata('id_persona');
        $idpersona = $this->session->userdata('idpersona');
        if($this->session->userdata('perfil')>=3){
            $idCiudadano = $idpersona;
        }else{
            $idCiudadano = $data['id_usuario'];
        }
       
        $datos['info'] = $this->expendedor->mis_tramites($idCiudadano);
        
        if($datos['info'][0]->id_estado == 4 || $datos['info'][0]->id_estado == 12 || $datos['info'][0]->id_estado == 17 || $datos['info'][0]->id_estado == 18 || $datos['info'][0]->id_estado == 15){
            $data['exp'] = $this->expendedor->consulta_resolucion($idCiudadano,4);
        }elseif($datos['info'][0]->id_estado == 7){
            $data['exp'] = $this->expendedor->consulta_resolucion($idCiudadano,7);
        }elseif($datos['info'][0]->id_estado == 19){
            $data['exp'] = $this->expendedor->consulta_resolucion($idCiudadano,4);
        }elseif($datos['info'][0]->id_estado == 11){
            $data['exp'] = $this->expendedor->consulta_resolucion($idCiudadano,11);
        }
         
        $datos['nume_resolucion'] =$data['exp']->id_resolucion;

        //var_dump($datos['nume_resolucion']); exit;

        $datos['codigo_veridicacion'] =$data['exp']->codigo_verificacion;
        //$datos['nume_resolucion'] =$data['info']->tipo_identificacion;
        $fechaExp=explode('-',$data['exp']->fecha_resolucion);
        $datos['anio']=$fechaExp[0];
        $datos['dia']=$fechaExp[2];
        $mes=$fechaExp[1];
        //Invoco la funci??n meese para rescatar el nombre del mes
        $datos['mes']=$this->meses($mes);
        if($datos['info'][0]->id_estado == 4 || $datos['info'][0]->id_estado == 11){
            $ruta_archivos = "/mt/sdb1/uploads/expendedor/resoluciones/";
        }elseif($datos['info'][0]->id_estado == 19){
            $ruta_archivos = "/mt/sdb1/uploads/expendedor/aclaraciones/";
        }
        $nombre_archivo = "resolucion_".$idpersona.".pdf";
        
        //load mPDF library para linux
        //$this->load->library('M_pdf');
        $this->load->library('M_pdf2');
        //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 35,'margin_bottom' => 1,'margin_header' => 5,'margin_footer' => 5]);
                //load mPDF library para windows
        //require_once APPPATH . 'libraries/vendor/autoload.php';
        //$mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->allow_output_buffering= true;
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkText = true;
        $imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
        $imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
        $mpdf->SetHTMLHeader("<table class='sinborde centro' width='100%' border='0'>
                                    <tr class='centro'> 
                                        <td width='100%'>
                                            <img src='".$imagenHeader."' width='250px'>
                                        </td>
                                    </tr>
                                </table>","O");
        $mpdf->SetHTMLFooter("<table class='sinborde centro' border='0' width='100%'>
                                    <tr class='centro'> 
                                        <td width='100%'>
                                            <img src='".$imagenFooter."' width='550px'>
                                        </td>
                                    </tr>
                                </table>","O");
        if($datos['info'][0]->id_estado != 4){
            if($this->input->post("resolucion")){ 
                if($this->input->post("resolucion")==1){
                    $mpdf->SetWatermarkText('Aprobado');
                }elseif($this->input->post("resolucion")==2){
                    $mpdf->SetWatermarkText('Negado');
                }else{
                    $mpdf->SetWatermarkText('Aclaraci??n');
                }
            }
        }
        /*if($data['exp']->id_estado_tramite == 7){ 
            $mpdf->SetWatermarkText('Negado');
        }*/
        $mpdf->AddPage();
        //echo "MMM";
       //echo $this->load->view('resolucion_aprobacion', $datos, true); exit;
        if($this->input->post("resolucion")){ 
            if($this->input->post("resolucion")==1){
                $datos['firma']='N';
                $mpdf->WriteHTML($this->load->view('resolucion_aprobacion', $datos, true));
            }elseif($this->input->post("resolucion")==2){
                $datos['firma']='N';
                $mpdf->WriteHTML($this->load->view('resolucion_negacion', $datos, true));
            }else{
                $datos['firma']='N';
                $mpdf->WriteHTML($this->load->view('resolucion_aclaracion', $datos, true));
            }
        }else{
            if($datos['info'][0]->id_estado == 4 || $datos['info'][0]->id_estado == 11){
                $datos['firma']='S';
                $mpdf->WriteHTML($this->load->view('resolucion_aprobacion', $datos, true));
            }elseif($datos['info'][0]->id_estado == 7){
                $datos['firma']='S';
                $mpdf->WriteHTML($this->load->view('resolucion_negacion', $datos, true));
            }elseif($datos['info'][0]->id_estado == 19){
                $datos['firma']='S';
                $mpdf->WriteHTML($this->load->view('resolucion_aclaracion', $datos, true));
            }

        }
        $mpdf->Output();
        $mpdf->Output($ruta_archivos . $nombre_archivo, "F");
    }

    //M??todo para cambiar el mes de n??mero a string
    public function meses($mes){
        switch($mes){
            case '01': $nombremes = 'Enero'; break;
            case '02': $nombremes = 'Febrero'; break;
            case '03': $nombremes = 'Marzo'; break;
            case '04': $nombremes = 'Abril'; break;
            case '05': $nombremes = 'Mayo'; break;
            case '06': $nombremes = 'Junio'; break;
            case '07': $nombremes = 'Julio'; break;
            case '08': $nombremes = 'Agosto'; break;
            case '09': $nombremes = 'Septiembre'; break;
            case '10': $nombremes = 'Octubre'; break;
            case '11': $nombremes = 'Noviembre'; break;
            case '12': $nombremes = 'Diciembre'; break;
        }
        return $nombremes;
    }

    //Genera el c??digo de verificaci??n
    public function genera_codigo(){
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contrase&ntilde;a
        $pass = "";
        //Se define la longitud de la contrase&ntilde;a, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 10;

        //Creamos la contrase&ntilde;a
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contrase&ntilde;a en cada iteraccion del bucle, a&ntilde;adiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    //M??todo para env??o de correo
    public function enviarCorreo($datos_tramite){
       
        require_once(APPPATH.'libraries/PHPMailer_5.2.4/class.phpmailer.php');
        $mail = new PHPMailer(true);

        try {
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->Host = "172.16.0.238"; // specif smtp server
                $mail->SMTPSecure= ""; // Used instead of TLS when only POP mail is selected
                $mail->Port = 25; // Used instead of 587 when only POP mail is selected
                $mail->SMTPAuth = false;
                $mail->Username = "cuidatesefeliz@saludcapital.gov.co"; // SMTP username
                $mail->Password = "Colombia2018"; // SMTP password
                $mail->FromName = "Secretar??a Distrital de Salud";
                $mail->From = "contactenos@saludcapital.gov.co";
                //$mail->AddAddress($correo_electronico, "CUIDATE"); //replace myname and mypassword to yours
                $mail->AddAddress($datos_tramite['email'], $datos_tramite['email']);
                    //$mail->AddReplyTo("acangel@saludcapital.gov.co", "DUES");
                if($datos_tramite['estado']==4 || $datos_tramite['estado']==7 || $datos_tramite['estado']==11){
                    //$archivo = base_url('uploads/expendedor/resoluciones/resolucion_'.$datos_tramite['idpersona'].'.pdf');
                    $archivo = '/mt/sdb1/uploads/expendedor/resoluciones/resolucion_'.$datos_tramite['idpersona'].'.pdf';
                    //$url = 'http://app.pimsaseguros.com/_files/_img/_holidays/040616-160454_img001.pdf';
                    //$fichero = file_get_contents($url);
                    $mail->AddAttachment($archivo,"Credencial.pdf");
                }
                if($datos_tramite['estado']==19){
                    //$archivo = base_url('uploads/expendedor/resoluciones/resolucion_'.$datos_tramite['idpersona'].'.pdf');
                    $archivo = '/mt/sdb1/uploads/expendedor/aclaraciones/resolucion_'.$datos_tramite['idpersona'].'.pdf';
                    //$url = 'http://app.pimsaseguros.com/_files/_img/_holidays/040616-160454_img001.pdf';
                    //$fichero = file_get_contents($url);
                    $mail->AddAttachment($archivo,"Credencial.pdf");
                }
               
                $mail->WordWrap = 50;
                $mail->CharSet = 'UTF-8';
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_alcaldia.png', 'imagen');
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_footer.png', 'imagen2');
                $mail->IsHTML(true); // set email format to HTML
                $mail->Subject = 'Solicitud de tr??mite licencia expendedor de droga';

                if($datos_tramite['estado']==4 || $datos_tramite['estado']==11){
                    $html = '
                    Se??or(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    Una vez realizado el proceso de validaci??n de documentos del Tr??mite de Licencia de Expendedor de Droga, nos complace informar que su licencia de expendedor de droga fue APROBADA, favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y  "Descargue all?? su credencial" haga click en la imagen PDF para descargar la licencia.
                    
                    
                        La Secretaria Distrital de Salud, con el prop??sito de mejorar nuestros servicios a la ciudadan??a, quiere conocer su opini??n frente a la experiencia en la realizaci??n de nuestros tr??mites, por lo cual agradecemos su tiempo para responder la siguiente encuesta. <br>  
                        <a href="http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es" target="_blank">http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es.</a>

                    
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    
                    
                        Se adjunta archivo pdf con resoluci??n.
                    
                    <b>Secretar??a Distrital de Salud.<br>
                        Subdirecci??n de Inspecci??n Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Licencia de Expendedor de Drogas<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090
                    ';
                }elseif($datos_tramite['estado']==5 || $datos_tramite['estado']==13){
                    $html = '
                    <p>Se??or(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>Una vez realizado el proceso de validaci??n de documentos del Tr??mite de licencia de expenedor de drogas, se encontr?? la siguiente inconsistencia por favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y realice los ajustes correspondientes para continuar con su tr??mite:
                   </p>
                      <p>
                        '.$datos_tramite['observaciones'].'
                      </p>
                    
                    <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    </p>
                    <p><b>Secretar??a Distrital de Salud.<br>
                        Subdirecci??n de Inspecci??n Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Licencia de Exhumaci??n<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==7){
                    $html = '
                    <p>Se??or(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>
                    Nos permitimos informarlq que, revisados los documentos aportados para la solicitu de licencia de expendedor de droga, se constat?? que ??stos no cumplen con los requisitos
                    exigidos por la resoluci??n 13370 de 1990 y decreto 1070 de 1990 del Ministerio de Salud.
                    </p>
                    <p>
                    Teniendo en cuenta que no se acredit?? la veracidad de los documentos presentados por el solicitante, no es posible
                    autorizar a la misma para ejercer la ocupaci??n y expedici??n de una credencial de expendedor de drogas.
                    </p>
                    <p>
                        Se adjunta archivo pdf con resoluci??n.
                    </p>
                    <p>
                        Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    </p>
                    <p><b>Secretar??a Distrital de Salud.<br>
                        Subdirecci??n de Inspecci??n Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Licencia de Expendedor de droga<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==1){
                    $html = '
                    <p>Se??or(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>Nos permitimos informarle que su tr??mite se registr?? exitosamente con radicado n??mero '.$datos_tramite['id_tramite'].'.
                   </p>
                    <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    </p>
                    <p><b>Secretar??a Distrital de Salud.<br>
                        Subdirecci??n de Inspecci??n Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Licencia de Expendedor de droga<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==23){
                    $html = '
                    Se??or(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atenci??n a la petici??n, mediante la cual usted solicita, la expedici??n de la Credencial de Expededor de Medicamentos a la Secretaria Distrital de Salud de Bogot??, le informamos que se ha recibido su actualizaci??n, con radicado n??mero '.$datos_tramite['id_tramite'].', y la misma se encuentra en proceso de revisi??n.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorizaci??n ser?? envidada al correo electr??nico registrado por usted,

                        En caso de requerir mayor informaci??n o claridad de la documentaci??n aportada, se generar?? contacto con usted a trav??s de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    
                    <b>Secretar??a Distrital de Salud.<br>
                        Direcci??n de Provisi??n de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Certidicado de Discapacidad<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090';
                }elseif($datos_tramite['estado']==12){
                    $html = '
                    Se??or(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atenci??n a la petici??n, mediante la cual usted solicita un recurso de aclaraci??n de la Credencial de Expededor de Medicamentos a la Secretaria Distrital de Salud de Bogot??, le informamos que se ha recibido su actualizaci??n, con radicado n??mero '.$datos_tramite['id_tramite'].', y la misma se encuentra en proceso de revisi??n.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorizaci??n ser?? envidada al correo electr??nico registrado por usted,

                        En caso de requerir mayor informaci??n o claridad de la documentaci??n aportada, se generar?? contacto con usted a trav??s de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    
                    <b>Secretar??a Distrital de Salud.<br>
                        Direcci??n de Provisi??n de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Certidicado de Discapacidad<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090';
                }elseif($datos_tramite['estado']==19){
                    $html = '
                    Se??or(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atenci??n a la petici??n, mediante la cual usted solicita un recurso de aclaraci??n de la Credencial de Expededor de Medicamentos a la Secretaria Distrital de Salud de Bogot?? y una vez realizado el proceso de validaci??n del documento recibido, nos complace informar que su licencia de expendedor de droga fue APROBADA con resoluci??n de aclaraci??n, favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y  "Descargue all?? su credencial" haga click en la imagen PDF para descargar la licencia.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorizaci??n ser?? envidada al correo electr??nico registrado por usted,

                        En caso de requerir mayor informaci??n o claridad de la documentaci??n aportada, se generar?? contacto con usted a trav??s de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    
                    <b>Secretar??a Distrital de Salud.<br>
                        Direcci??n de Provisi??n de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Certidicado de Discapacidad<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090';
                }elseif($datos_tramite['estado']==8){
                    $html = '
                    Se??or(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atenci??n a la petici??n, mediante la cual usted solicita un recurso de reposici??n de la Credencial de Expededor de Medicamentos a la Secretaria Distrital de Salud de Bogot??, le informamos que se ha recibido su actualizaci??n, con radicado n??mero '.$datos_tramite['id_tramite'].', y la misma se encuentra en proceso de revisi??n.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorizaci??n ser?? envidada al correo electr??nico registrado por usted,

                        En caso de requerir mayor informaci??n o claridad de la documentaci??n aportada, se generar?? contacto con usted a trav??s de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentaci??n dispuesta en el portal de la Ventanilla ??nica de Tr??mites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    
                    <b>Secretar??a Distrital de Salud.<br>
                        Direcci??n de Provisi??n de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Tr??mite Certidicado de Discapacidad<br>
                        Cra 32 #12-81 Bogot?? D.C, Colombia<br>
                        Tel??fono: (571) 3649090';
                }
                $mail->Body = nl2br ($html,false);

                $mail->Send();
                //$respuesta=$mail->Send();
                //var_dump($respuesta);

        }catch (Exception $e){
            print_r($e->getMessage());
            exit;
        }
    }

    //Abre el documento PDF en un modal
    public function cargar_modal_pdf(){
        $this->load->model("expendedor");
        $id_archivo = $this->input->post("idRow");
        $archivos=$this->expendedor->consulta_archivosbyId($id_archivo);
        
        $doc_pdf = '<embed src="'.base_url('expendedor_droga/abrir_pdf/'.$archivos[0]['id_archivo']).'" frameborder="0" width="100%" height="400px">
         <div class="modal-footer">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>Cerrar</button>
        </div>';
        echo $doc_pdf;
    }

    //Carga el modal para corregir los documentos PDF no aprobados
    public function cargar_modal_editarpdf(){
        $this->load->model("expendedor");
        $id_archivo = $this->input->post("idRow");
        $data['id_documento']=$id_archivo;
        $archivos=$this->expendedor->consulta_archivosbyId($id_archivo);
        //hago un explode al nobre del archivo
        $nombre=explode('-',$archivos[0]['nombre']);
        $data['nombre']=$nombre[1];
        $this->load->view("corregir_documento", $data);
    }

    //M??todo para cargar los ducumentos que fueron negados y que se volvieron a cargar.
    public function editar_documentos(){
        $this->load->model("expendedor");

        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['id_estado']=23;   
        $data['fecha_registro']=date('Y-m-d H:i:s');
        $id_archivo = $this->input->post("idRow");

        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        //Valida la existencia de registro de tr??mite
        $result_tramite = $this->expendedor->verifyTramite($arrParam);  
        if ($result_tramite) {
            //Cambiamos el estado del tr??mite
            $editar_estadoTramite = $this->expendedor->actualizar_tramite($data);
            $idtramite = $this->expendedor->consulta_tramite($data['id_usuario']);
            $dataTramite['id_tramite'] = $idtramite->id_expdrogas_tramite;
            $dataTramite['id_usuario']=$this->session->userdata('id_persona');
            $dataTramite['fecha_registro']=date('Y-m-d H:i:s');  
            $dataTramite['id_estado']=23;
            $dataTramite['observaciones']=$this->input->get_post('observaciones');
            //Regista el seguimiento host??rico del tr??mite
            $registrarSeguimiento = $this->expendedor->registrarSeguimiento($dataTramite);
            /**
            Cargar archivos del equipo
            */
                                
            $bandera = 1;
            $documentos = array("cedula","registro_civil", "tarjeta_reservista", "certificado_salud", "antecedentes_judiciales","certificado_vecindad", "manisfestacion_expresa", "certificado_minsalud", "certificado_estudios");
            
            //Bucle para el conteo de los documento cargados
            for($i=0;$i<=count($documentos);$i++){
                //Vallida la rcecpci??n de archivos.
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $data['id_usuario']."-".$documentos[$i]."-".date('YmdHis');
                    
                    $config['upload_path'] = "/mt/sdb1/uploads/expendedor/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '50000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */
                    
                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    //var_dump($config);
                    if ($this->upload->do_upload($documentos[$i])) {
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        $bandera = 0;
                    }

                    $datosAr['id_archivo'] = $id_archivo;
                    $datosAr['ruta'] = '/mt/sdb1/uploads/expendedor/';
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['id_persona'] = $data['id_usuario'];
                    $datosAr['condicion'] = 0;
                    $datosAr['estado'] = 'AC';

                    $result_edit_doumento = $this->expendedor->editar_archivo($datosAr);
                    
                }
            }
            if($result_edit_doumento){
                $info = $this->expendedor->mis_tramites($data['id_usuario']);
                //Asigno la informaci??n a un arreglo $datos_tramite
                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                $datos_tramite['email']=$info[0]->email;
                $datos_tramite['estado']=$info[0]->id_estado;
                $datos_tramite['id_tramite']=$info[0]->id_expdrogas_tramite;
                //env??o correo confirmando el registo del tr??mite
                $this->enviarCorreo($datos_tramite);
                $this->session->set_flashdata('retornoExito', 'El tr??mite se registr?? exitosamente.</b>');
                redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
                exit;
            }
        } 
    }

    public function enviar_resolucion(){
        header('Content-Type: application/json');
        $this->load->model("expendedor");
        $data = array();
        $idpersona = $this->session->userdata('idpersona');
        $info = $this->expendedor->mis_tramites($idpersona);
        //Asigno la informaci??n a un arreglo $datos_tramite
        $datos_tramite['p_nombre']=$info[0]->p_nombre;
        $datos_tramite['p_apellido']=$info[0]->p_apellido;
        $datos_tramite['email']=$info[0]->email;
        $datos_tramite['estado']=$info[0]->id_estado;
        $datos_tramite['idpersona']= $idpersona;
        //$datos_tramite['email']='sjneira@saludcapital.gov.co';
        $this->enviarCorreo($datos_tramite);
        
        $data["result"] = true;
        $this->session->set_flashdata('retornoEnvio', $msj);
        echo json_encode($data);
        //redirect('expendedor_droga/tramites_pendientes', 'reload');

    }

    public function ver_auditoria(){
        $this->load->model("expendedor");
        $idpersona = $this->session->userdata('idpersona');
        $idtramite=$this->expendedor->consulta_tramite($idpersona);
        $id_tramite= $idtramite->id_expdrogas_tramite;
        $data['id_documento']=$id_archivo;
        $data['auditoria']=$this->expendedor->consulta_auditoria($id_tramite);
        //hago un explode al nobre del archivo
        $this->load->view("ver_auditoria_view", $data);
    }

    public function logout_ci()
    {

        $this->session->sess_destroy();
        redirect($this->config->item('url_tramites'));
        //header('Location: ../../index.php'); 
    }


     public function reportes($tipo_reporte) {
        $this->load->model("expendedor");
        $data['js'] = array(base_url('assets/js/expendedor/validate/reportes.js'));
        $datosAr1 = $this->session->userdata('username');
        $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
        $fechai= $this->input->post('fecha_i');
        $fechaf= $this->input->post('fecha_f');

        $this->session->set_userdata('fechai',$fechai);
        $this->session->set_userdata('fechaf',$fechaf);
        
        if($tipo_reporte==1){
            $data['listado_soli'] = $this->expendedor->listarSolicitudesED($fechai,$fechaf,0);
            $data['contenido'] = 'tramites_licenciaExp_view';
        }elseif($tipo_reporte==2){
            $data['listado_soli'] = $this->expendedor->listarHistoricoED($fechai,$fechaf,0);
            $data['contenido'] = 'tramites_historico_view';
        }
        $this->load->view('templates/layout_expendedor',$data);
    }


    public function generar_excel($tipo_reporte){
       $this->load->model("expendedor");
       
       
       $fechai= $this->session->userdata('fechai');
       $fechaf= $this->session->userdata('fechaf');
      
       
       $fechaInicial=$this->expendedor->formatoFecha($fechai,'/'); 
       $fechaFinal=$this->expendedor->formatoFecha($fechaf,'/'); 
       $fec=strtotime ('-31 day', strtotime($_GET['fechaFinal']));
       $fec2= date('Y-m-d', $fec);
       
      
        if($tipo_reporte==1){    
            $data['listado_soli']= $this->expendedor->listarSolicitudesED($fechai,$fechaf,0);
            
        }elseif($tipo_reporte==2){
            $data['listado_soli']= $this->expendedor->listarHistoricoED($fechai,$fechaf,0);
                    }
        $data['titulo'] = 'Perfil Consulta';
        $data['contenido'] = 'tramites_licenciaExp_view';
        //$this->load->view('templates/layout_expendedor', $data);
        if(count($data['listado_soli']) > 0){
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time','600');
            $name="Expederdor".$fecha.".csv";
           
           //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
            //$datos['data'] = $data;
            header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
            header('Content-Disposition: attachment; filename='.$name.'');
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            if($tipo_reporte==1){
                $this->load->view('reporte_expendedor_view',$data, FALSE);
            }elseif($tipo_reporte==2){
                $this->load->view('reporte_historico_view',$data, FALSE);
            }
        }else{
            $this->session->set_flashdata('error', 'No se encontraron registros.</b>');
            redirect(base_url('expendedor_droga/reportes/'.$tipo_reporte.''), 'refresh');
            exit;
        }

    }

    //M??todo para presentar recurso de aclaaraci??n
    public function recurso_aclaracion(){
        $this->load->model("expendedor");
        $idpersona = $this->session->userdata('id_persona');
        $info = $this->expendedor->mis_tramites($idpersona);
       $data['nivel_educativo'] = $this->expendedor->consulta_nivel();
        $this->load->view("recurso_view", $data);
    }

    public function registrar_recurso(){
        $this->load->model("expendedor");
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['id_estado']=12;   
        $data['fecha_registro']=date('Y-m-d H:i:s');
        $id_archivo = $this->input->post("idRow");

        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        //Valida la existencia de registro de tr??mite
        $result_tramite = $this->expendedor->verifyTramite($arrParam);  
        if ($result_tramite) {
            //Cambiamos el estado del tr??mite
            $editar_estadoTramite = $this->expendedor->actualizar_tramite($data);
            $idtramite = $this->expendedor->consulta_tramite($data['id_usuario']);
            $dataTramite['id_tramite'] = $idtramite->id_expdrogas_tramite;
            $dataTramite['id_usuario']=$this->session->userdata('id_persona');
            $dataTramite['fecha_registro']=date('Y-m-d H:i:s');  
            $dataTramite['id_estado']=12;
            $dataTramite['observaciones']=$this->input->get_post('observaciones');
            //Regista el seguimiento host??rico del tr??mite
            $registrarSeguimiento = $this->expendedor->registrarSeguimiento($dataTramite);
            /**
            Cargar archivos del equipo
            */
                                
            $bandera = 1;
            $documentos = array("recurso_aclaracion");
            
            //Bucle para el conteo de los documento cargados
            for($i=0;$i<=count($documentos);$i++){
                //Vallida la rcecpci??n de archivos.
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $data['id_usuario']."-".$documentos[$i]."-".date('YmdHis');
                    
                    $config['upload_path'] = "/mt/sdb1/uploads/expendedor/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '50000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */
                    
                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    //var_dump($config);
                    if ($this->upload->do_upload($documentos[$i])) {
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        $bandera = 0;
                    }

                    $rutaFinal = array('rutaFinal' => $this->upload->data());
                    $datosAr['ruta'] = '/mt/sdb1/uploads/expendedor/';
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['id_persona'] = $data['id_usuario'];
                    $datosAr['condicion'] = 0;
                    $datosAr['estado'] = 'AC';
                    $resultadoIDDocumentoArc = $this->expendedor->insertarArchivo($datosAr);
                }
            }
            if($resultadoIDDocumentoArc){

                $info = $this->expendedor->mis_tramites($data['id_usuario']);
                //Asigno la informaci??n a un arreglo $datos_tramite
                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                $datos_tramite['email']=$info[0]->email;
                $datos_tramite['estado']=$info[0]->id_estado;
                $datos_tramite['id_tramite']=$info[0]->id_expdrogas_tramite;
                //env??o correo confirmando el registo del tr??mite
                $this->enviarCorreo($datos_tramite);
                $this->session->set_flashdata('retornoExito', 'El tr??mite se registr?? exitosamente.</b>');
                redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
                exit;
            }
        } 
    }

    //M??todo para presentar recurso de reposici??n
    public function recurso_reposicion(){
        $this->load->model("expendedor");
        $idpersona = $this->session->userdata('id_persona');
        $info = $this->expendedor->mis_tramites($idpersona);
        $this->load->view("reposicion_view", $data);
    }

    public function registrar_reposicion(){
        $this->load->model("expendedor");
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['id_estado']=8;   
        $data['fecha_registro']=date('Y-m-d H:i:s');
        $id_archivo = $this->input->post("idRow");

        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        //Valida la existencia de registro de tr??mite
        $result_tramite = $this->expendedor->verifyTramite($arrParam);  
        if ($result_tramite) {
            //Cambiamos el estado del tr??mite
            $editar_estadoTramite = $this->expendedor->actualizar_tramite($data);
            $idtramite = $this->expendedor->consulta_tramite($data['id_usuario']);
            $dataTramite['id_tramite'] = $idtramite->id_expdrogas_tramite;
            $dataTramite['id_usuario']=$this->session->userdata('id_persona');
            $dataTramite['fecha_registro']=date('Y-m-d H:i:s');  
            $dataTramite['id_estado']=8;
            $dataTramite['observaciones']=$this->input->get_post('observaciones');
            //Regista el seguimiento host??rico del tr??mite
            $registrarSeguimiento = $this->expendedor->registrarSeguimiento($dataTramite);
            if($editar_estadoTramite){
                $info = $this->expendedor->mis_tramites($data['id_usuario']);
                //Asigno la informaci??n a un arreglo $datos_tramite
                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                $datos_tramite['email']=$info[0]->email;
                $datos_tramite['estado']=$info[0]->id_estado;
                $datos_tramite['id_tramite']=$info[0]->id_expdrogas_tramite;
                //env??o correo confirmando el registo del tr??mite
                $this->enviarCorreo($datos_tramite);
                $this->session->set_flashdata('retornoExito', 'El tr??mite se registr?? exitosamente.</b>');
                redirect(base_url('expendedor_droga/verTramite/'), 'refresh');
                exit;
            }
        }
    }

    //M??todo para visaulizar todos los documentos PDF cargados por el ciudadano
    public function abrir_pdf($id_archivo){
        $this->load->model("expendedor");
        $archivos=$this->expendedor->consulta_archivosbyId($id_archivo);
        $file = '/mt/sdb1/uploads/expendedor/'.$archivos[0]['nombre']; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

    //M??todo para visaulizar los PDF de las resoluciones
    public function abrir_resolucion_pdf($id_usuario){
        $file = "/mt/sdb1/uploads/expendedor/resoluciones/resolucion_".$id_usuario.".pdf"; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

    //M??todo para visaulizar los PDF de las resoluciones de aclaraci??n
    public function abrir_aclaracion_pdf($id_usuario){
        $file = "/mt/sdb1/uploads/expendedor/aclaraciones/resolucion_".$id_usuario.".pdf"; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

}