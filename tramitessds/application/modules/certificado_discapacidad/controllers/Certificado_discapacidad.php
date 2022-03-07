<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Certificado_discapacidad extends MY_Controller {

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
        redirect(base_url('certificado_discapacidad/tramites_pendientes'));
    }

     public function index(){
        //header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $data['perfil']=$this->session->userdata('perfil'); 
        $data['id_usuario']=$this->session->userdata('id_usuario'); 
        $data['id_persona']=$this->session->userdata('id_persona'); 
        $data['categoria']=$this->parametricas->categorias();
        $data['tipo_identificacion']=$this->parametricas->consulta_tipodoc();
        $data['movilizar']=$this->parametricas->obtener_moviliza();
        $data['comunicar']=$this->parametricas->obtener_comunica();
        $data['lista_ips']=$this->parametricas->obtener_ips();
        $data['information'] = FALSE;
        //Consulta los datos del usuario en la tabla persona

       	$data['persona'] = $this->cert_discapacidad->consulta_persona($data['id_persona']);
       	$usuario= $data['id_usuario'];
        //Verifica que la ciudad de residencia se Bogotá
        //echo "MMMM".$data['persona']->ciudad_resi;
        if($data['persona']->ciudad_resi==149){
            //Parámetros para verificar que trámites registrados
            $arrParam = array(
            "id_usuario" => $usuario,
            "id_estado != " => 21,
            );
            //Verifica los trámtes registrados
            $result_tramite = $this->cert_discapacidad->verifyTramite($arrParam);
            $tramite = $this->cert_discapacidad->consulta_tramite($usuario);
            //Si tiene trámite registrado redireciona a ver trámites    
            if ($result_tramite) {
                if($tramite->regimen_esp=='si'){ //Si es de régimen especial
                    redirect(base_url('certificado_discapacidad/regimen/'), 'refresh');
                }else{
                    redirect(base_url('certificado_discapacidad/verTramite/'), 'refresh');
                }
            }else{ //Si no tiene trámites registrados muesta la vista para registro del trámite
        	   $data['contenido'] = 'registrar_tramite_view';
            }
    	}else{ //Si no es residente de Bogotá
            $arrParam = array(
                "id_usuario" => $usuario,
                "id_estado != " => 21,
            );
            $result_tramite = $this->cert_discapacidad->verifyTramite($arrParam);
                
            if ($result_tramite) {
                $data['contenido'] = 'aviso_residencia_view';
            }else{
                $datos['id_usuario']=$usuario;
                $datos['fecha_registro']=date("Y-m-d");
                $datos['id_estado']=1;
                $datos['observaciones']="La ciudad de residencia es diferente a Bogotá, la ciudad registrada es: ".$data['persona']->ciudad_nacimiento." - ".$data['persona']->Descripcion;
                $registrarTramite = $this->cert_discapacidad->registrarTramite($datos);
                if($registrarTramite){
                    $idtramite = $this->cert_discapacidad->consulta_tramite($usuario);
                    $dataTramite['id_tramite'] = $idtramite->id_tramite;
                    $dataTramite['id_usuario']=$usuario;
                    $dataTramite['fecha_registro']=date('Y-m-d H:i:s'); 
                    $dataTramite['id_estado']=1;
                    $dataTramite['observaciones']="La ciudad de residencia es diferente a Bogotá, la ciudad registrada es: ".$data['persona']->ciudad_nacimiento." - ".$data['persona']->Descripcion;
                //Regista el seguimiento hostórico del trámite
                $registrarSeguimiento = $this->cert_discapacidad->registrarSeguimiento($dataTramite);
                }
                $data['contenido'] = 'aviso_residencia_view';
            }
        }
        
        $this->load->view('templates/layout_discapacidad',$data);
    }

    //Método para registro del trámite
	public function registrar_tramite(){
		$this->load->model("cert_discapacidad");
        $usuario=$this->session->userdata('id_usuario');
		foreach ($_POST as $nombre_campo => $valor) {
            
            if(!isset($valor)){
                $valor1=0;
            }else{
                $valor1=$valor;
            }
            $asignacion = "\$" . $nombre_campo . "='" . $valor1 . "';";
            eval($asignacion);
        }
        $arrParam = array(
            "id_usuario" => $usuario,
            "id_estado != " => 21,
        );
        $result_tramite = $this->cert_discapacidad->verifyTramite($arrParam);
          	
        if ($result_tramite) {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', 'El ciudadano ya tiene registrado un trámite de certificado de discapacidad.'); 
            redirect(base_url('certificado_discapacidad/index/'), 'refresh');
        }else{
            $datos['id_usuario']=$usuario;
            $datos['regimen_esp']=$regimen_esp;
            $datos['categoria_1']=$categoria1;
            $datos['categoria_2']=$categoria2;
            $datos['categoria_3']=$categoria3;
            $datos['categoria_4']=$categoria4;
            $datos['categoria_5']=$categoria5;
            $datos['categoria_6']=$categoria6;
            $datos['categoria_7']=$categoria7;
            $datos['categoria_8']=$categoria8;
            $datos['moviliza']=$movilizar;
            $datos['cual_moviliza']=$cual_movilizar;
            $datos['comunica']=$comunicar;
            $datos['cual_comunica']=$cual_comunicar;
            $datos['req_acompanante']=$req_acompanante;
            $datos['vive_persona']=$vive_persona;
            $datos['id_ips']=$ips;
            $datos['cu_pnombre']=$cuidador_pnombre;
            $datos['cu_snombre']=$cuidador_snombre;
            $datos['cu_papellido']=$cuidador_papellido;
            $datos['cu_sapellido']=$cuidador_sapellido;
            $datos['cu_tipodoc']=$cuidador_tipodoc;
            $datos['cu_numdoc']=$cuidador_numdoc;
            $datos['cu_email']=$email_cuidador;
            $datos['cu_telefono']=$cuidador_telefono;
            $datos['cu_telefono']=$cuidador_telefono;
            $datos['cu_celular']=$cuidador_celular;
            $datos['fecha_registro']=date("Y-m-d");
            $datos['id_estado']=1;
            $datos['observaciones']=$observaciones;
        	$registrarTramite = $this->cert_discapacidad->registrarTramite($datos);
			if($registrarTramite){
                //Consulta trámite
    			$idtramite = $this->cert_discapacidad->consulta_tramite($usuario);
    			$dataTramite['id_tramite'] = $idtramite->id_tramite;
    			$dataTramite['id_usuario']=$usuario;
                $dataTramite['fecha_registro']=date('Y-m-d H:i:s');	
    			$dataTramite['id_estado']=1;
    			$dataTramite['observaciones']=$this->input->get_post('observaciones');
    			//Regista el seguimiento hostórico del trámite
    			$registrarSeguimiento = $this->cert_discapacidad->registrarSeguimiento($dataTramite);
                if($regimen_esp=='si'){
                     $this->session->set_flashdata('retornoExito', 'Registro exitoso, trámite  número '.$datos_tramite['id_tramite'].'.</b>');
                    redirect(base_url('certificado_discapacidad/regimen/'), 'refresh');
                    exit;
                }else{
                    /**
                    Cargar archivos del equipo
                    */
                                        
                    $bandera = 1;
                    $documentos = array("historia_clinica","examen_medico", "copia_documento", "certificado_residencia", "valoracion_domiciliaria");
                
                    //Bucle para el conteo de los documento cargados
                    $flag=0;
                    for($i=0;$i<=count($documentos);$i++){
                        //Vallida la rcecpción de archivos.
                        if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0 && $_FILES[$documentos[$i]]['type']=='application/pdf') {
                            
                            $nombre_archivo = $datos['id_usuario']."-".$documentos[$i]."-".date('YmdHis');
                            
                            //$config['upload_path'] = "uploads/discapacidad/";
                            $config['upload_path'] = "/mt/sdb1/uploads/discapacidad/";
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
                                $datosAr['ruta'] = '/mt/sdb1/uploads/discapacidad/';
                                $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                                $datosAr['fecha'] = date('Y-m-d');
                                $datosAr['tags'] = "";
                                $datosAr['es_publico'] = 1;
                                $datosAr['id_persona'] = $usuario;
                                $datosAr['condicion'] = 0;
                                $datosAr['estado'] = 'AC';
                                $resultadoIDDocumentoArc = $this->cert_discapacidad->insertarArchivo($datosAr);
                            } else {
                                echo "No subio";
                                //$flag=1;
                            }
                        }
                    }
                   
                    $info = $this->cert_discapacidad->mis_tramites($usuario);
                    if($flag==1){
                        $this->expendedor->anularTramite($usuario);
                        $this->expendedor->anularArchivos($usuario);
                        $this->session->set_flashdata('retorno_error', "Error al cargar el archivo, por favor contacte al administrador");
                        redirect(base_url('certificado_discapacidad/verTramite/'), 'refresh');
                        exit;
                    }else{                
                        //Asigno la información a un arreglo $datos_tramite
                        $datos_tramite['p_nombre']=$info[0]['p_nombre'];
                        $datos_tramite['p_apellido']=$info[0]['p_apellido'];
                        $datos_tramite['email']=$info[0]['email'];
                        $datos_tramite['estado']=$info[0]['id_estado'];
                        $datos_tramite['id_tramite']=$info[0]['id_tramite'];
                        //envío correo confirmando el registo del trámite
                        $this->enviarCorreo($datos_tramite);
                        $this->session->set_flashdata('retornoExito', 'Registro exitoso, trámite  número '.$datos_tramite['id_tramite'].'.</b>');
                        redirect(base_url('certificado_discapacidad/verTramite/'), 'refresh');
                        exit;
                    }
                }
            }else{
                echo "No se pudo registrar";
            }
        }
	}

	//Método para mostrar los trámites registrados
    public function verTramite(){
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $data['categoria']=$this->parametricas->categorias();
        $data['tipo_identificacion']=$this->parametricas->consulta_tipodoc();
        $data['movilizar']=$this->parametricas->obtener_moviliza();
        $data['comunicar']=$this->parametricas->obtener_comunica();
        $data['lista_ips']=$this->parametricas->obtener_ips();
        $data['id_usuario']=$this->session->userdata('id_usuario'); 
        $data['info'] = $this->cert_discapacidad->mis_tramites($data['id_usuario']);
        $num_tramite=$data['info'][0]['id_tramite'];
        $this->session->set_userdata('id_tramite',$num_tramite);
        //var_dump($data['info']);
        $data['archivos'] = $this->cert_discapacidad->consulta_archivos($data['id_usuario']);
        //echo "MMM".$data['archivos'][0]['id_archivo'];     
        $data['titulo'] = 'Certificado de discapacidad';
        
        $data['contenido'] = 'mi_tramite';
        $this->load->view('templates/layout_discapacidad',$data);


    }


    //Método para ver los trámites pendientes
    public function tramites_pendientes(){

        $this->load->model("cert_discapacidad");
       
        $data['id_usuario']=$this->session->userdata('id_usuario');

        $data['info'] = $this->cert_discapacidad->get_tramites();

        $data['archivos'] = $this->cert_discapacidad->consulta_archivos($data['id_usuario']);
           
        $data['titulo'] = 'Certificado de discapacidad';
        
        $data['contenido'] = 'lista_tramites';
        $this->load->view('templates/layout_discapacidad',$data);
    }

    //Método para ver los trámites seleccinados de la lista
    public function aprobar_tramite($idTramite){
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $usuario=$this->session->userdata('id_usuario');

        $data['categoria']=$this->parametricas->categorias();
        $data['tipo_identificacion']=$this->parametricas->consulta_tipodoc();
        $data['movilizar']=$this->parametricas->obtener_moviliza();
        $data['comunicar']=$this->parametricas->obtener_comunica();
        $data['lista_ips']=$this->parametricas->obtener_ips();
        $data['modalidad']=$this->parametricas->obtener_modalidad();

        $num_tramite=$idTramite-19722512+20131611;

        $this->session->set_userdata('id_tramite',$num_tramite);
        $data['id_tramite']=$this->session->userdata('id_tramite');
       
        $data['info']=$this->cert_discapacidad->get_tramitesbyId($data['id_tramite']);
        
        $data['archivos']=$this->cert_discapacidad->consulta_archivos($data['info'][0]['id_usuario']);
        $data['estados'] = $this->parametricas->consulat_estados();
        if($this->session->userdata('perfil')==5){
            $data['boton']="Guardar";
        }else{
            $data['boton']="Guardar";
        }
        $data['titulo'] = 'Certificado de discapacidad';
        
        $data['contenido'] = 'aprobar_tramite_view';
        $this->load->view('templates/layout_discapacidad',$data);
    }

    //Abre el documento PDF en un modal
    public function cargar_modal_pdf(){
        $this->load->model("cert_discapacidad");
        $id_archivo = $this->input->post("idRow");
        $archivos=$this->cert_discapacidad->consulta_archivosbyId($id_archivo);
        
        //Abre modal con el PDF
        $doc_pdf = '<embed src="'.base_url('certificado_discapacidad/abrir_pdf/'.$archivos[0]['id_archivo']).'" frameborder="0" width="100%" height="400px">
         <div class="modal-footer">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>Cerrar</button>
        </div>';
        echo $doc_pdf;
    }

    //Método para aprobar trámites
    public function save_aprobar(){
        header('Content-Type: application/json');
        $this->load->model("cert_discapacidad");
        $data = array();
        $idusuario = $this->session->userdata('id_usuario');
        $data['id_tramite']=$this->session->userdata('id_tramite');
        //Conslto en No. del trámite
        $data['info']=$this->cert_discapacidad->get_tramitesbyId($data['id_tramite']);

        $msj = "Registro exitoso.";
        //Conslto los archivos que tienen registrado el usaurio en este trámite
        $dataarchivos['archivos']=$this->cert_discapacidad->consulta_archivos($data['info'][0]['id_usuario']);
        
        $cierto=0;
        for($i=0; $i<=count( $dataarchivos['archivos'])-1; $i++){
            if($this->input->post($dataarchivos['archivos'][$i]['id_archivo'])==2 && $this->input->post('estado')==2){
                
                $cierto=1;
            }
        }
        if($cierto==1){
            $data["result"] = true;
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Error al aprobar el trámite, tiene documentos marcados como no cumplen.');
        }else{
        
            //Registra en el histódiro de trámite
            if ($idTramite = $this->cert_discapacidad->save_historico($data['info'][0]['id_usuario'])) {
                
                //Actualiza el trámite
               $this->cert_discapacidad->actualizar_tramite($data['info'][0]['id_usuario']);
               //Consulta los archivos registardos por el ciudadano
               $dataarchivos['archivos']=$this->cert_discapacidad->consulta_archivos($data['info'][0]['id_usuario']);
               //Actualiza el estado de los archivos
                $alerta=0;
                for($i=0; $i<=count( $dataarchivos['archivos'])-1; $i++){
                    $idarchivo=$dataarchivos['archivos'][$i]['id_archivo'];
                    $cumple=$this->input->post('cumple'.$i);
                    $this->cert_discapacidad->actualizar_archivo($idarchivo,$cumple);
                }
               
                //Si el pefil es validador
                if($this->session->userdata('perfil')==3){
                    if($this->input->post('estado')==5 || $this->input->post('estado')==13){
                        $info = $this->cert_discapacidad->mis_tramites($data['info'][0]['id_usuario']);
                        //Asigno la información a un arreglo $datos_tramite
                        $datos_tramite['p_nombre']=$info[0]['p_nombre'];
                        $datos_tramite['p_apellido']=$info[0]['p_apellido'];
                        $datos_tramite['email']=$info[0]['email'];
                        $datos_tramite['estado']=$info[0]['id_estado'];
                        $datos_tramite['observaciones']=$info[0]['observaciones'];
                        $this->enviarCorreo($datos_tramite);
                    }
                }
                //Si el perfil es director
                if($this->session->userdata('perfil')==5){
                    //si el trámite es probado
                    if($this->input->post('estado')==4){
                        //Verifica la existencia de una resolución
                        $result_resolucion = $this->cert_discapacidad->verifyResolucion($data['id_tramite'],$this->input->post('estado'));  
                        if ($result_resolucion) {
                            $data["result"] = "error";
                            $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrada una autorización.');
                            //redirect(base_url('expendedor_droga/editar_tramite/'), 'refresh');
                        }else{
                            //Genera código de verificación 
                            $codigo_verificacion = $this->genera_codigo();
                            //Registra la resolución en la bd
                            $result_save_resolucion = $this->cert_discapacidad->save_resolucion($data['id_tramite'], $codigo_verificacion,$this->input->post('estado'));
                            //Envía correo de notificación
                            if($result_save_resolucion){
                                //Consulta la información del trámite para el envío de correo
                               $info = $this->cert_discapacidad->get_tramitesbyId($data['id_tramite']);
                                //Asigno la información a un arreglo $datos_tramite
                                $datos_tramite['p_nombre']=$info[0]['p_nombre'];
                                $datos_tramite['p_apellido']=$info[0]['p_apellido'];
                                $datos_tramite['email']=$info[0]['email'];
                                $datos_tramite['estado']=$info[0]['id_estado'];
                                $datos_tramite['cod_autorizacion']=$info[0]['cod_autorizacion'];
                                $datos_tramite['nom_ips']=$info[0]['nom_ips'];
                                $datos_tramite['email_ips']=$info[0]['email_ips'];
                                $datos_tramite['telefono_ips']=$info[0]['telefono_ips'];
                                $datos_tramite['direccion_ips']=$info[0]['direccion_ips'];
                                //redirect(base_url('expendedor_droga/firmar_credencial/'), 'refresh');
                            }
                        }
                    }elseif($this->input->post('estado')==7){ //Si el trámite es negado
                        //Consulta la información del ciudadano para el envío de correo
                        $info = $this->cert_discapacidad->get_tramitesbyId($idtramite);
                        //Asigno la información a un arreglo $datos_tramite
                        $datos_tramite['p_nombre']=$info[0]->p_nombre;
                        $datos_tramite['p_apellido']=$info[0]->p_apellido;
                        $datos_tramite['email']=$info[0]->email;
                        $datos_tramite['estado']=$info[0]->id_estado;
                        $datos_tramite['observaciones']=$info[0]->observaciones;
                        $this->enviarCorreo($datos_tramite);
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

    //Método para envío de correo
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
                $mail->FromName = "Secretaría Distrital de Salud";
                $mail->From = "contactenos@saludcapital.gov.co";
                //$mail->AddAddress($correo_electronico, "CUIDATE"); //replace myname and mypassword to yours
                $mail->AddAddress($datos_tramite['email'], $datos_tramite['email']);
                if($datos_tramite['email_ips']){
                    $mail->AddCC($datos_tramite['email_ips'], $datos_tramite['email_ips']);
                }
                //$mail->AddReplyTo("acangel@saludcapital.gov.co", "DUES");
                if($datos_tramite['estado']==4 || $datos_tramite['estado']==7){
                    //$archivo = base_url('uploads/expendedor/resoluciones/resolucion_'.$datos_tramite['idpersona'].'.pdf');
                    $archivo = '/mt/sdb1/uploads/discapacidad/resoluciones/resolucion_'.$datos_tramite['idtramite'].'.pdf';
                    //$url = 'http://app.pimsaseguros.com/_files/_img/_holidays/040616-160454_img001.pdf';
                    //$fichero = file_get_contents($url);
                    $mail->AddAttachment($archivo,"OrdenValoracion.pdf");
                }
               
                $mail->WordWrap = 50;
                $mail->CharSet = 'UTF-8';
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_alcaldia.png', 'imagen');
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_footer.png', 'imagen2');
                $mail->IsHTML(true); // set email format to HTML
                $mail->Subject = 'Servicio Digital Certificado de Discapacidad';
                if($datos_tramite['estado']==4){
                    $html = '
                    Señor(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    De acuerdo a la petición relacionada con la solicitud para obtener la certificación de discapacidad y el Registro para la Localización y Caracterización de Personas con Discapacidad (RLCPD), me permito informar que la Secretaria Distrital de Salud en el marco de sus competencias y previa verificación del cumplimiento de los requisitos señalados en Resolución 113 del 31 de enero de 2020, expidió la orden de valoración por el equipo multidisciplinario en la Institución Prestadora de Servicios de Salud elegida por usted:

                        <b>Código de autorización</b>: '.$datos_tramite['cod_autorizacion'].'
                        <b>IPS</b>: '.$datos_tramite['nom_ips'].'
                        <b>Correo electrónico</b>: '.$datos_tramite['email_ips'].'
                        <b>Teléfono</b>: '.$datos_tramite['telefono_ips'].'
                        <b>Dirección</b>: '.$datos_tramite['direccion_ips'].'

                        En tal sentido, la IPS dispondrá de un término de diez (10) días hábiles, posteriores a su solicitud para programar la cita con el equipo multidisciplinario, quienes realizarán La valoración y establecerán o no, su condición de discapacidad expidiendo el respectivo certificado y la consecuente inclusión en el Registro de Localización y Caracterización de Personas con Discapacidad (RCLPD).

                        En consecuencia, es pertinente que se comunique de <b>manera telefónica </b>con la IPS mencionada a efectos de agendar su cita, con la orden anexa a esta respuesta.

                        Señor Usuario recuerde que; <b>es obligatorio que el día de su cita con el equipo multidisciplinario lleve la historia clínica con todos los exámenes que complementen su diagnóstico de discapacidad, recuerde que de no llevar estos documentos no será atendido y tendrá que reprogramar su cita</b>. 

                        Señores IPS: <b>Se solicita muy amablemente su colaboración, verificando el código de la autorización previo a la programación, y asistencia del usuario a la institución, con el fin de identificar a que IPS por error fue asignado, teniendo en cuenta que la plataforma SISPRO no permite la anulación de códigos</b>.
                                           
                        La Secretaria Distrital de Salud, con el propósito de mejorar nuestros servicios a la ciudadanía, quiere conocer su opinión frente a la experiencia en la realización de nuestros trámites, por lo cual agradecemos su tiempo para responder la siguiente encuesta. <br>  
                        <a href="http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es" target="_blank">http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es.</a>
                    
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: solicitudtramitediscapacidad@saludcapital.gov.co
                                        
                        Se adjunta archivo pdf con órden de valoración.
                    
                    <b>Secretaría Distrital de Salud.<br>
                        Dirección de Provisión de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Certificado de Discapacidad<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    ';
                }elseif($datos_tramite['estado']==5 || $datos_tramite['estado']==13){
                    $html = '
                    Señor(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    Una vez realizado el proceso de validación de documentos del Trámite de Certificado de Discapacidad, se encontró la siguiente inconsistencia: 

                        '.$datos_tramite['observaciones'].'

                        Por favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y realice los ajustes correspondientes para continuar con su trámite:
                                    
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: solicitudtramitediscapacidad@saludcapital.gov.co
                    
                    <b>Secretaría Distrital de Salud.<br>
                        Dirección de Provisión de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Certificado de Discapacidad<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    ';
                }elseif($datos_tramite['estado']==7){
                    $html = '
                    <p>Señor(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>
                    Nos permitimos informarlq que, revisados los documentos aportados para la solicitu de licencia de expendedor de droga, se constató que éstos no cumplen con los requisitos
                    exigidos por la resolución 13370 de 1990 y decreto 1070 de 1990 del Ministerio de Salud.
                    </p>
                    <p>
                    Teniendo en cuenta que no se acreditó la veracidad de los documentos presentados por el solicitante, no es posible
                    autorizar a la misma para ejercer la ocupación y expedición de una credencial de expendedor de drogas.
                    </p>
                    <p>
                        Se adjunta archivo pdf con resolución.
                    </p>
                    <p>
                        Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: solicitudtramitediscapacidad@saludcapital.gov.co
                    </p>
                    <p><b>Secretaría Distrital de Salud.<br>
                       Dirección de Provisión de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Certificado de Discapacidad<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==1){
                    $html = '
                    Señor(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atención a la petición, mediante la cual usted solicita, la expedición del certificado y Registro de Localización y Caracterización de personas con Discapacidad (RLCPD) a la Secretaria Distrital de Salud de Bogotá, le informamos que se ha recibido su solicitud, con radicado número '.$datos_tramite['id_tramite'].', y la misma se encuentra en proceso de revisión.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorización será envidada al correo electrónico registrado por usted.

                        En caso de requerir mayor información o claridad de la documentación aportada, se generará contacto con usted a través de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: solicitudtramitediscapacidad@saludcapital.gov.co
                    
                    <b>Secretaría Distrital de Salud.<br>
                        Dirección de Provisión de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Certificado de Discapacidad<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    ';
                }elseif($datos_tramite['estado']==23){
                    $html = '
                    Señor(a)
                    <b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    
                    En atención a la petición, mediante la cual usted solicita, la expedición del certificado y Registro de Localización y Caracterización de personas con Discapacidad (RLCPD) a la Secretaria Distrital de Salud de Bogotá, le informamos que se ha recibido su actualización, con radicado número '.$datos_tramite['id_tramite'].', y la misma se encuentra en proceso de revisión.

                       En el caso de que sus documentos cumplan con lo solicitado, su autorización será envidada al correo electrónico registrado por usted,

                        En caso de requerir mayor información o claridad de la documentación aportada, se generará contacto con usted a través de los diferentes canales establecidos por la entidad.
                   
                    Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: tramitediscapacidad@saludcapital.gov.co
                    
                    <b>Secretaría Distrital de Salud.<br>
                        Dirección de Provisión de Servicios de Salud</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Certidicado de Discapacidad<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090';
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

    //Método para editar los datos personales del ciudadano
    public function editar_tramite(){
        //header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['id_persona']=$this->session->userdata('idpersona'); 
        $data['information'] = FALSE;
        if($this->input->post('idRow')&&$this->input->post('idRow')=='persona'){
            $usuario= $data['id_persona'];
        }else{
             $usuario= $data['id_usuario'];
        }
        $data['information'] = $this->cert_discapacidad->consulta_persona($usuario);
        $data['nivel_educativo'] = $this->parametricas->consulta_nivel();
        $this->load->view("editar_personas_view", $data);
        //$this->load->view('templates/layout_expendedor',$data);
    }

    //Método para guardar los camibos de los datos personales
    public function save_persona(){
        header('Content-Type: application/json');
        $this->load->model("cert_discapacidad");
        $data = array();
        
        if($this->session->userdata('perfil')==2){
            $idusuario = $this->session->userdata('id_persona');
             $this->load->model("cert_discapacidad");

            $data['id_usuario']=$this->session->userdata('id_usuario'); 
            $data['id_estado']=23;   
            $data['fecha_registro']=date('Y-m-d H:i:s');
            
            $editar_estadoTramite = $this->cert_discapacidad->actualizar_tramite($data); 
            $arrParam = array(
                "id_usuario" => $data['id_usuario'],
                "id_estado !=" => 21
            );
            //Valida la existencia de registro de trámite
            $result_tramite = $this->cert_discapacidad->verifyTramite($arrParam);  
        }else{
              $idusuario = $this->session->userdata('idpersona');
        }

        $msj = "Se actualiz&oacute; el registro exitosamente.";
        
        $documento = $this->input->post('documento');
        if($this->input->post('email')!=''){
            if ($idActividad = $this->cert_discapacidad->savePersona($idusuario)) {
                //$this->capitulo1->insertarControl();
                $data["result"] = true;
                $this->session->set_flashdata('retornoExitoP', $msj);
            } else {
                $data["result"] = "error";
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
            }
        }else {
                $data["result"] = "error";
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
            }
        

        echo json_encode($data);
    }

    //Carga el modal para corregir los documentos PDF no aprobados
    public function cargar_modal_editarpdf(){
        $this->load->model("cert_discapacidad");
        $id_archivo = $this->input->post("idRow");
        $data['id_documento']=$id_archivo;
        $archivos=$this->cert_discapacidad->consulta_archivosbyId($id_archivo);
        //hago un explode al nobre del archivo
        $nombre=explode('-',$archivos[0]['nombre']);
        $data['nombre']=$nombre[1];
        $this->load->view("corregir_documento", $data);
    }

    //Método para cargar los ducumentos que fueron negados y que se volvieron a cargar.
    public function editar_documentos(){
        $this->load->model("cert_discapacidad");

        $data['id_usuario']=$this->session->userdata('id_usuario'); 
        $data['id_estado']=23;   
        $data['fecha_registro']=date('Y-m-d H:i:s');
        $id_archivo = $this->input->post("idRow");

        $arrParam = array(
            "id_usuario" => $data['id_usuario'],
            "id_estado !=" => 21
        );
        //Valida la existencia de registro de trámite
        $result_tramite = $this->cert_discapacidad->verifyTramite($arrParam);  
        if ($result_tramite) {
            //Cambiamos el estado del trámite
            $editar_estadoTramite = $this->cert_discapacidad->actualizar_tramite($data);
            $idtramite = $this->cert_discapacidad->consulta_tramite($data['id_usuario']);
            $dataTramite['id_tramite'] = $idtramite->id_tramite;
            $dataTramite['id_usuario']=$this->session->userdata('id_usuario');
            $dataTramite['fecha_registro'] = date('Y-m-d H:i:s');  
            $dataTramite['id_estado']=23;
            $dataTramite['observaciones']=$this->input->get_post('observaciones');
            //Regista el seguimiento hostórico del trámite
            $registrarSeguimiento = $this->cert_discapacidad->registrarSeguimiento($dataTramite);
            /**
            Cargar archivos del equipo
            */
                                
            $bandera = 1;
            $documentos = array("historia_clinica","examen_medico", "copia_documento", "certificado_residencia", "valoracion_domiciliaria");
            
            //Bucle para el conteo de los documento cargados
            for($i=0;$i<=count($documentos);$i++){
                //Vallida la rcecpción de archivos.
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $data['id_usuario']."-".$documentos[$i]."-".date('YmdHis');
                    
                    $config['upload_path'] = "/mt/sdb1/uploads/discapacidad/";
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
                    $datosAr['ruta'] = '/mt/sdb1/uploads/discapacidad/';
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['id_persona'] = $data['id_usuario'];
                    $datosAr['condicion'] = 0;
                    $datosAr['estado'] = 'AC';
                   
                    $result_edit_doumento = $this->cert_discapacidad->editar_archivo($datosAr);
                    
                }
            }
            if($result_edit_doumento){
                $info = $this->cert_discapacidad->mis_tramites($data['id_usuario']);
                //Asigno la información a un arreglo $datos_tramite
                $datos_tramite['p_nombre']=$info[0]['p_nombre'];
                $datos_tramite['p_apellido']=$info[0]['p_apellido'];
                $datos_tramite['email']=$info[0]['email'];
                $datos_tramite['estado']=$info[0]['id_estado'];
                $datos_tramite['id_tramite']=$info[0]['id_tramite'];
                //envío correo confirmando el registo del trámite
                $this->enviarCorreo($datos_tramite);
                $this->session->set_flashdata('retornoExito', 'El trámite se registró exitosamente.</b>');
                redirect(base_url('certificado_discapacidad/verTramite/'), 'refresh');
                exit;
            }
        } 
    }

    //Método para cargar el modal para deitar los datos del trámite
    public function modal_editTramite(){
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $id_usuario = $this->session->userdata('id_usuario');
        $data['information'] = $this->cert_discapacidad->mis_tramites($id_usuario);
        $data['categoria'] = $this->parametricas->categorias();
        $data['movilizar'] = $this->parametricas->obtener_moviliza();
        $data['comunicar'] = $this->parametricas->obtener_comunica();
        $data['lista_ips'] = $this->parametricas->obtener_ips();
        $this->load->view("datos_tramite_view", $data);
    }

    //Método para guardar los camibos de los datos personales
    public function save_datosTramite(){
        header('Content-Type: application/json');
        $this->load->model("cert_discapacidad");
        $data = array();
        
        if($this->session->userdata('perfil')==2){
            $idusuario = $this->session->userdata('id_persona');
        }else{
              $idusuario = $this->session->userdata('idpersona');
        }

        $msj = "Los datos del trámte se actualizaron exitosamente.";
        
        $documento = $this->input->post('documento');

        if ($this->cert_discapacidad->save_datosTramite()) {
            //$this->capitulo1->insertarControl();
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoP', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    }

    //Método para cargar el modal para deitar los datos del cuidador
    public function modal_editCuidador(){
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("cert_discapacidad");
        $this->load->model("parametricas");
        $id_usuario = $this->session->userdata('id_usuario');
        $data['information'] = $this->cert_discapacidad->mis_tramites($id_usuario);
        $data['categoria'] = $this->parametricas->categorias();
        $data['movilizar'] = $this->parametricas->obtener_moviliza();
        $data['comunicar'] = $this->parametricas->obtener_comunica();
        $data['lista_ips'] = $this->parametricas->obtener_ips();
        $data['tipo_identificacion'] = $this->parametricas->tipos_identificacion();
        $this->load->view("datos_cuidador_view", $data);
    }

    //Método para guardar los camibos de los datos del cuidador
    public function save_datosCuidador(){
        header('Content-Type: application/json');
        $this->load->model("cert_discapacidad");
        $data = array();
        
        if($this->session->userdata('perfil')==2){
            $idusuario = $this->session->userdata('id_persona');
        }else{
              $idusuario = $this->session->userdata('idpersona');
        }

        $msj = "Los datos del cuidador se actualizaron exitosamente.";
        
        $documento = $this->input->post('documento');
       
        if ($this->cert_discapacidad->save_datosCuidador()) {
            //$this->capitulo1->insertarControl();
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoP', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    }

    //Método para ver seguimiento y audotoría
    public function ver_auditoria(){
        $this->load->model("cert_discapacidad");
        $id_tramite = $this->session->userdata('id_tramite');
        $data['auditoria']=$this->cert_discapacidad->consulta_auditoria($id_tramite);
        //hago un explode al nobre del archivo
        $this->load->view("ver_auditoria_view", $data);
    }

    public function regimen(){
        $this->load->model("cert_discapacidad");
        $data['contenido'] = 'aviso_regimen_view';
        $this->load->view('templates/layout_discapacidad',$data);
    }

    //Genera el código de verificación
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

    //Método para descargar los PDF con las resoluciones de la credenciales o resolción de solicitud rechazada
    public function resoluciones(){
        
        $this->load->model("cert_discapacidad");
        $data['id_usuario']=$this->session->userdata('id_persona');
        $idpersona = $this->session->userdata('idpersona');
               
        $idtramite=$this->session->userdata('id_tramite');
        
        if($this->session->userdata('perfil')>=3){
            $idCiudadano = $idpersona;
        }else{
            $idCiudadano = $data['id_usuario'];
        }
       
        $datos['info'] = $this->cert_discapacidad->get_tramitesbyId($idtramite);
        
        if($datos['info'][0]['id_estado'] == 4){
            $data['exp'] = $this->cert_discapacidad->consulta_resolucion($idtramite,4);
        }elseif($datos['info'][0]['id_estado'] == 7){
            $data['exp'] = $this->cert_discapacidad->consulta_resolucion($idtramite,7);
        }

        $datos['id_tramite'] = $datos['info'][0]['id_tramite'];
        $fechaReg=explode('-',$datos['info'][0]['fecha_registro']);
        $datos['anio_reg']=$fechaReg[0];
        $datos['dia_reg']=substr($fechaReg[2],0,2);
        $datos['mes_reg']=$fechaReg[1];
        $mes_reg=$fechaReg[1];
        //Invoco la función meese para rescatar el nombre del mes
        $datos['mes_reg1']=$this->meses($mes_reg);
       
        $fechaApr=explode('-',$datos['info'][0]['fecha_aprueba_director']);
        $datos['anio_apr']=$fechaApr[0];
        $datos['dia_apr']=substr($fechaApr[2],0,2);
        $datos['mes_apr']=$fechaApr[1];
        $mes_apr=$fechaApr[1];
        $datos['mes_apr1']=$this->meses($mes_apr);
         
        $datos['nume_resolucion'] =$data['exp']->id_resolucion;
        $datos['codigo_veridicacion'] =$data['exp']->codigo_verificacion;
        //$datos['nume_resolucion'] =$data['info']->tipo_identificacion;
        $fechaExp=explode('-',$data['exp']->fecha_resolucion);
        $datos['anio']=$fechaExp[0];
        $datos['dia']=$fechaExp[2];
        $mes=$fechaExp[1];
        //Invoco la función meese para rescatar el nombre del mes
        $datos['mes']=$this->meses($mes);
        
        $ruta_archivos = "/mt/sdb1/uploads/discapacidad/resoluciones/";
        $nombre_archivo = "resolucion_".$idtramite.".pdf";
        
        //load mPDF library para linux
        //$this->load->library('M_pdf');
        $this->load->library('M_pdf2');
        //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 40, 'margin_bottom' => 25,'margin_header' => 5,'margin_footer' => 5]);
                //load mPDF library para windows
        //require_once APPPATH . 'libraries/vendor/autoload.php';
        //$mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->allow_output_buffering= true;
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkText = true;
        $imagenHeader = FCPATH."assets/imgs/alcaldia_discapacidad1.png";
        $imagenHeader1 = FCPATH."assets/imgs/alcaldia_discapacidad.png";
        $imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
        $mpdf->SetHTMLHeader("<table width='100%' style='border:1px solid black; border-collapse:collapse; font-family: Lucida Grande, Verdana, Sans-serif; font-size: 12px; text-align: center;'>
                <tr style='border:0px solid black; border-collapse:collapse;'> 
                    <td width='20%' style='border:1px solid black; border-collapse:collapse;'>
                        <img src='".$imagenHeader."' width='90' height='90'>
                    </td>
                    <td style='border:1px solid black; border-collapse:collapse;'>
                        <table width='100%' style='border:1px solid black; border-collapse:collapse;'>
                            <tr>
                                <td style='border:1px solid black; border-collapse:collapse;'colspan='4'>
                                    DIRECCIÓN DE PROVISIÓN DE SERVICIOS DE SALUD <br>
                                    SISTEMA DE GESTIÓN<br>
                                    CONTROL DOCUMENTAL
                                </td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black; border-collapse:collapse;' colspan='4'>
                                    ORDEN PARA VALORACIÓN POR EQUIPO MULTIDISCIPLINARIO<br>
                                    PARA CERTIFICACIÓN DE DISCAPACIDAD
                                </td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black; border-collapse:collapse;'>
                                    Código:
                                </td>
                                <td style='border:1px solid black; border-collapse:collapse;'>
                                   SDS-PSS-FT-592 
                                </td>
                                <td style='border:1px solid black; border-collapse:collapse;'>
                                    Versión:
                                </td>
                                <td style='border:1px solid black; border-collapse:collapse;'>
                                    2
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                    <td style='border:1px solid black; border-collapse:collapse;'>
                        <img src='".$imagenHeader1."' width='90' height='90'>
                    </td>
                </tr>
                <tr style='border:1px solid black; border-collapse:collapse;'> 
                    <td colspan='3' style='font-size: 10px; text-align: justify;'>
                        Elaborado por: Jhon Jairo Sánchez, Bady Heredia Angie Vanessa Rodríguez Vargas /Revisado por: Ricardo Duran Arango, Adriana Arcila López  y Tamara  Gilma Vanin  / Aprobado por: Daniel Blanco Martínez
                    <td>
                </tr>
            </table>","O");
        
        $mpdf->setFooter("<table class='sinborde centro' border='0' width='100%'>
                                    <tr class='centro'> 
                                        <td width='100%'>
                                            <img src='".$imagenFooter."' width='550px'>
                                        </td>
                                    </tr>
                                </table>Página {PAGENO} de {nb}");
        if($data['exp']->id_estado_tramite != 4){
            if($this->input->post("resolucion")){ 
                if($this->input->post("resolucion")==1){
                    $mpdf->SetWatermarkText('Aprobado');
                }else{
                    $mpdf->SetWatermarkText('Negado');
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
            }else{
                $datos['firma']='N';
                $mpdf->WriteHTML($this->load->view('resolucion_negacion', $datos, true));
            }
        }else{
            if($data['exp']->estado_tramite == 4){
                $datos['firma']='S';
                $mpdf->WriteHTML($this->load->view('resolucion_aprobacion', $datos, true));
            }elseif($data['exp']->id_estado_tramite == 7){
                $datos['firma']='S';
                $mpdf->WriteHTML($this->load->view('resolucion_negacion', $datos, true));
            }
        }
        $mpdf->Output();
        $mpdf->Output($ruta_archivos . $nombre_archivo, "F");
    }

    //Envía la resolución  firmada al usuario
    public function enviar_resolucion(){
        header('Content-Type: application/json');
        $this->load->model("cert_discapacidad");
        $data = array();
        $idtramite=$this->session->userdata('id_tramite');
        $info = $this->cert_discapacidad->get_tramitesbyId($idtramite);
        //Asigno la información a un arreglo $datos_tramite
        $datos_tramite['p_nombre']=$info[0]['p_nombre'];
        $datos_tramite['p_apellido']=$info[0]['p_apellido'];
        $datos_tramite['email']=$info[0]['email'];
        $datos_tramite['email_ips']=$info[0]['email_ips'];
        $datos_tramite['telefono_ips']=$info[0]['telefono_ips'];
        $datos_tramite['direccion_ips']=$info[0]['direccion_ips'];
        $datos_tramite['estado']=$info[0]['id_estado'];
        $datos_tramite['cod_autorizacion']=$info[0]['cod_autorizacion'];
        $datos_tramite['nom_ips']=$info[0]['nom_ips'];
        $datos_tramite['celular']=$info[0]['telefono_celular'];
        $datos_tramite['email']=$info[0]['email'];
        $datos_tramite['idtramite']= $idtramite;
        //$datos_tramite['email']='sjneira@saludcapital.gov.co';
        $this->enviarCorreo($datos_tramite);
        
        $data["result"] = true;
        $this->session->set_flashdata('retornoEnvio', $msj);
        echo json_encode($data);
        //redirect('expendedor_droga/tramites_pendientes', 'reload');

    }

    //Método para cambiar el mes de número a string
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

    //Método para generar reportes
    public function reportes($tipo_reporte) {
        $this->load->model("cert_discapacidad");
        $data['js'] = array(base_url('assets/js/discapacidad/validate/reportes.js'));
        $datosAr1 = $this->session->userdata('username');
        $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
        $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
        $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';

        $this->session->set_userdata('fechai',$fechai);
        $this->session->set_userdata('fechaf',$fechaf);

        if($tipo_reporte==1){
            
            $data['listado_soli'] = $this->cert_discapacidad->listarSolicitudes($fechai,$fechaf,0);
            
            $data['contenido'] = 'tramites_licencia_view';
        }elseif($tipo_reporte==2){
            $data['listado_soli'] = $this->cert_discapacidad->listarHistorico($fechai,$fechaf,0);
            $data['contenido'] = 'tramites_historico_view';
        }
        $this->load->view('templates/layout_discapacidad',$data);
    }

    //Método para descargar el reporte en formato excel
    public function generar_excel($tipo_reporte){
       $this->load->model("cert_discapacidad");
       $fechai= $this->session->userdata('fechai');
       $fechaf= $this->session->userdata('fechaf');
       
       $fechaInicial=$this->cert_discapacidad->formatoFecha($fechai,'/'); 
       $fechaFinal=$this->cert_discapacidad->formatoFecha($fechaf,'/'); 
       $fec=strtotime ('-31 day', strtotime($_GET['fechaFinal']));
       $fec2= date('Y-m-d', $fec);
       
        //Consulto el reporte si es registrados o histórico
        if($tipo_reporte==1){    
            $data['listado_soli']= $this->cert_discapacidad->listarSolicitudes($fechai,$fechaf,0);
            //var_dump($data['listado_soli']);
        }elseif($tipo_reporte==2){
            $data['listado_soli']= $this->cert_discapacidad->listarHistorico($fechai,$fechaf,0);
        }
        //var_dump($data['listado_soli']);
        $data['titulo'] = 'Perfil Consulta';
        $data['contenido'] = 'excel_discapacidad_view';
        //$this->load->view('templates/layout_expendedor', $data);
        if(count($data['listado_soli']) > 0){
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time','600');
            $name="Discapacidad".$fecha.".csv";
           
           //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
            //$datos['data'] = $data;
            header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
            header('Content-Disposition: attachment; filename='.$name.'');
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            if($tipo_reporte==1){
                $this->load->view('excel_discapacidad_view',$data, FALSE);
            }elseif($tipo_reporte==2){
                $this->load->view('excel_historico_view',$data, FALSE);
            }
        }else{
            $this->session->set_flashdata('error', 'No se encontraron registros.</b>');
            redirect(base_url('certificado_discapacidad/reportes/'.$tipo_reporte.''), 'refresh');
            exit;
        }

    }

    //Método para visaulizar todos los documentos PDF cargados por el ciudadano
    public function abrir_pdf($id_archivo){
        $this->load->model("cert_discapacidad");
        $archivos=$this->cert_discapacidad->consulta_archivosbyId($id_archivo);
        $file = $archivos[0]['ruta'].''.$archivos[0]['nombre']; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

    //Método para visaulizar las resoluciones en PDF generados por el sistema
    public function abrir_resolucion_pdf($id_tramite){
        $file = "/mt/sdb1/uploads/discapacidad/resoluciones/resolucion_".$id_tramite.".pdf"; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

    public function logout_ci()
    {

        $this->session->sess_destroy();
        redirect($this->config->item('url_tramites'));
        //header('Location: ../../index.php'); 
    }
}