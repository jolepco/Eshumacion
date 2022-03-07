<?php defined('BASEPATH') or exit('No direct script access allowed');
class Plazas extends MY_Controller {
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

    public function index(){
        $this->load->model("plazas_models");
    	$this->session->set_userdata('controller','Autorización de plazas','controller');
        $data["controller"]=$this->session->userdata('controller');
        $data['id_usuario']=$this->session->userdata('id_persona');
        $data["nom_usuario"] = $nom_usuario;

        $data['info'] = $this->plazas_models->get_tramites($data['id_usuario']);
        
        $data['contenido'] = 'nuevo_tramite'; 

        $this->load->view('templates/layout_plazas',$data);
        
    }

    public function validacion()
    {
        redirect(base_url('plazas/tramites_pendientes'));
    }

    //Método para mostrar los trámites registrados
    public function registrar_tramite(){
        //header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['tipo_identificacion']=$this->parametricas->tipos_identificacion();
        $data['information'] = FALSE;
       
        if($this->input->post('id_tramite')){
            $id_tramite=$this->input->post('id_tramite');
            $data['information']=$this->plazas_models->get_tramitesbyId($id_tramite);
        }
        
        
        if($this->input->post('idRow')&&$this->input->post('idRow')=='persona'){
            $usuario= $data['id_persona'];
        }else{
             $usuario= $data['id_usuario'];
        }
        
        $this->load->view("registrar_tramite_view", $data);
    }

    //Método para guardar nuevos trámites
    public function save_nuevo_tramite(){
        header('Content-Type: application/json');
       $this->load->model("plazas_models");
        $data = array();

        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $idUser = $this->session->userdata('id_persona'); 
        $id_usuario = $this->session->userdata('id_usuario'); 

        $msj = "Se adicionó un nuevo trámite, sin embargo no se ha enviado a validación hasta tanto no registre el proyecto.";
        if ($idUser != '') {
            $msj = "Se adicionó un nuevo trámite, sin embargo no se ha enviado a validación hasta tanto no registre el proyecto.";
        }           

        $result_tramite = false;
        $fecha = date('Y-m-d');
        
        //Verify if the user already exist by the user name
        $arrParam = array(
            "column" => "id_usuario",
            "value" => $idUser,
            "column1" => "fecha_registro",
            "value1" => $fecha,
        );
        $result_tramite = $this->plazas_models->verifyTramite($arrParam);
            
        if ($result_tramite) {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Tiene un trámite registrado, usted podrá registrar un trámite por día.');
        } else {
            $estado=22;

            $idTramite=$this->input->post('id_tramite');
            if ($idUsuario = $this->plazas_models->saveTramite($idUser,$estado, $idTramite)) {

                $info = $this->plazas_models->mis_tramites($idUser);
                
                $dataTramite['id_tramite'] =$info[0]->id_tramite;
                $dataTramite['id_usuario']=$id_usuario;
                $dataTramite['fecha_registro']=date('Y-m-d H:i:s'); 
                $dataTramite['id_estado']=22;
                $dataTramite['observaciones']='';
                //Regista el seguimiento histórico del trámite
                $registrarSeguimiento = $this->plazas_models->registrarSeguimiento($dataTramite);
               
                $datos_tramite['id_tramite']=$info[0]->id_tramite;
                $datos_tramite['p_nombre']=$info[0]->p_nombre;
                $datos_tramite['p_apellido']=$info[0]->p_apellido;
                $datos_tramite['email']=$info[0]->email;
                $datos_tramite['estado']=$info[0]->id_estado;
                //envío correo confirmando el registo del trámite

                $this->enviarCorreo($datos_tramite);
                $data["result"] = true;                 
                $this->session->set_flashdata('retornoExito', $msj);
               
            } else {
                $data["result"] = "error";                  
                $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
            }
        }

        echo json_encode($data);
    }

    //Método donde se muestra la información del trámite y del proyecto
    public function proyectos($idtramite){
        $this->load->model("plazas_models");
        $id_tramite=$idtramite-19722512+20131611;
        $data = array();
        
        $this->session->set_userdata('id_tramite',$id_tramite);
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['information']=$this->plazas_models->get_tramitesbyId($id_tramite);
        $data['archivos']=$this->plazas_models->consulta_archivos($id_tramite);
        //var_dump($data['archivos']);
        $data['contenido'] = 'proyectos_plazas';
        $this->load->view('templates/layout_plazas',$data);
    }

    //Método para registrar proyetos
    public function registrar_proyecto(){
        //header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        $data['id_usuario']=$this->session->userdata('id_persona'); 
        $data['profesiones']=$this->parametricas->obtener_profesiones();
        $data['vinculacion']=$this->parametricas->obtener_vinculacion();
        $data['modalidad']=$this->parametricas->obtener_modalidad();
        $data['information'] = FALSE;
       
        if($this->input->post('id_tramite')){
            $id_tramite=$this->input->post('id_tramite');
            $data['information']=$this->plazas_models->get_tramitesbyId($id_tramite);
        }
        
        
        if($this->input->post('idRow')&&$this->input->post('idRow')=='persona'){
            $usuario= $data['id_persona'];
        }else{
             $usuario= $data['id_usuario'];
        }
        
        $this->load->view("registrar_proyecto_view", $data);
    }

    //Método para guardar el formulario del proyecto
    public function save_proyecto(){
        $this->load->model("plazas_models");
        $id_tramite=$this->session->userdata('id_tramite');
        $id_usuario=$this->session->userdata('id_usuario');
        $idtramite=$id_tramite+19722512-20131611;

        $registrarTramite = $this->plazas_models->saveProyecto($id_tramite);
        $registrarHistrico = $this->plazas_models->save_historico($id_tramite);
        $this->plazas_models->actualizar_tramite($id_tramite);
        if($registrarTramite){
            /**
            Cargar archivos del equipo
            */

            $bandera = 1;
            if($this->input->post('modalidad')==2){
                $documentos = array("doc_proyecto","hv_director", "doc_actividades", "doc_colciencias", "cert_disponibilidad");
            }else{
                $documentos = array("doc_proyecto");
            }
           
            //Bucle para el conteo de los documento cargados
            for($i=0;$i<=count($documentos);$i++){
                //Vallida la rcecpción de archivos.
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                  
                    $nombre_archivo = $id_tramite."-".$documentos[$i]."-".date('YmdHis');
                                        
                    $config['upload_path'] = "/mt/sdb1/uploads/plazas/";
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
                   
                    $datosAr['ruta'] = '/mt/sdb1/uploads/plazas/';
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['id_persona'] = $id_usuario;
                    $datosAr['condicion'] = 0;
                    $datosAr['estado'] = 'AC';

                    $resultadoIDDocumentoArc = $this->plazas_models->insertarArchivo($datosAr);
                }
                
            }
           
            //Redirecciona a proyecto
            $this->session->set_flashdata('retornoExito', 'Registro de investigación y tipo de plaza exitoso para el trámite número '.$id_tramite.'.</b>');
            redirect(base_url('plazas/proyectos/'.$idtramite.''), 'refresh');
            exit;
            
        }
    }

    //Método para ver los trámites pendientes
    public function tramites_pendientes(){
       $this->load->model("plazas_models");
       
        $data['id_usuario']=$this->session->userdata('id_persona');

        $data['info'] = $this->plazas_models->get_tramites();

        $data['archivos'] = $this->plazas_models->consulta_archivos($data['id_usuario']);
           
        $data['titulo'] = 'Autorización de plazas';
        
        $data['contenido'] = 'lista_tramites';
        $this->load->view('templates/layout_plazas',$data);
    }

    //Método para ver los trámites seleccinados de la lista
    public function aprobar_tramite($idTramite){
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        $num_tramite=$idTramite-19722512+20131611;
        $this->session->set_userdata('id_tramite',$num_tramite);
        $data['id_tramite']=$this->session->userdata('id_tramite');
        $data['information']=$this->plazas_models->get_tramitesbyId($data['id_tramite']);
        $data['archivos']=$this->plazas_models->consulta_archivos($data['id_tramite']);
        $data['estados'] = $this->parametricas->consulat_estados();
        if($this->session->userdata('perfil')==5){
            $data['boton']="Guardar";
        }else{
            $data['boton']="Guardar";
        }
        $data['titulo'] = 'Autorización de plazas';
        
        $data['contenido'] = 'aprobar_tramite_view';
        $this->load->view('templates/layout_plazas',$data);
    }

    //Método para aprobar validador
    public function save_aprobar(){
        header('Content-Type: application/json');
        $this->load->model("plazas_models");
        $idtramite=$this->session->userdata('id_tramite');
        //Registra en el histódiro de trámite
        if ($idTramite = $this->plazas_models->save_historico($idtramite)) {
            //Actualiza el trpamite
            $this->plazas_models->actualizar_tramite($idtramite);
            //Si el perfil es validador
            if($this->session->userdata('perfil')==3){
                if($this->input->post('estado')==13 || $this->input->post('estado')==5){
                    $info = $this->plazas_models->get_tramitesbyId($idtramite);
                    //Asigno la información a un arreglo $datos_tramite
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
                //si el trámite es probado
                if($this->input->post('estado')==4){
                    //Verifica la existencia de una resolución
                    $result_resolucion = $this->plazas_models->verifyResolucion($idtramite,$this->input->post('estado'));  
                    if ($result_resolucion) {
                        $data["result"] = "error";
                        $this->session->set_flashdata('retornoError', '<strong></strong> El ciudadano ya tiene registrada una resolución de licencia de expendedor de droga.');
                        //redirect(base_url('expendedor_droga/editar_tramite/'), 'refresh');
                    }else{
                        //Genera código de verificación 
                        $codigo_verificacion = $this->genera_codigo();
                        //Registra la resolución en la bd
                        $result_save_resolucion = $this->plazas_models->save_resolucion($idtramite, $codigo_verificacion,$this->input->post('estado'));
                        //Envía correo de notificación
                        if($result_save_resolucion){
                            //Consulta la información del ciudadano para el envío de correo
                            $info = $this->plazas_models->get_tramitesbyId($idtramite);
                            //Asigno la información a un arreglo $datos_tramite
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
                    //Consulta la información del ciudadano para el envío de correo
                    $info = $this->plazas_models->get_tramitesbyId($idtramite);
                    //Asigno la información a un arreglo $datos_tramite
                    $datos_tramite['p_nombre']=$info[0]->p_nombre;
                    $datos_tramite['p_apellido']=$info[0]->p_apellido;
                    $datos_tramite['email']=$info[0]->email;
                    $datos_tramite['estado']=$info[0]->id_estado;
                    $datos_tramite['observaciones']=$info[0]->observaciones;
                    $this->enviarCorreo($datos_tramite);      
                }
            }
            
            $msj = "Registro exitoso.";
            $data["result"] = true;
            $this->session->set_flashdata('retornoExito', $msj);
        }else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        echo json_encode($data);
    }

    //Método para descargar los PDF con las resoluciones de la credenciales o resolción de solicitud rechazada
    public function resoluciones(){
        
        $this->load->model("plazas_models");
        $data['id_usuario']=$this->session->userdata('id_persona');
        $idpersona = $this->session->userdata('idpersona');
               
        $idtramite=$this->session->userdata('id_tramite');
        
        if($this->session->userdata('perfil')>=3){
            $idCiudadano = $idpersona;
        }else{
            $idCiudadano = $data['id_usuario'];
        }
       
        $datos['info'] = $this->plazas_models->get_tramitesbyId($idtramite);
        
        if($datos['info'][0]->id_estado == 4){
            $data['exp'] = $this->plazas_models->consulta_resolucion($idtramite,4);
        }elseif($datos['info'][0]->id_estado == 7){
            $data['exp'] = $this->plazas_models->consulta_resolucion($idtramite,7);
        }
        $datos['id_tramite'] = $datos['info'][0]->id_tramite;
        $fechaReg=explode('-',$datos['info'][0]->fecha_registro);
        $datos['anio_reg']=$fechaReg[0];
        $datos['dia_reg']=$fechaReg[2];
        $mes_reg=$fechaReg[1];
        //Invoco la función meese para rescatar el nombre del mes
        $datos['mes_reg']=$this->meses($mes_reg);
        $datos['num_plazas']=$datos['info'][0]->nro_plazas;
        $datos['modalidad_plaza']=$datos['info'][0]->modalidad_plaza;
        $datos['modalidad']=$datos['info'][0]->modalidad;
        $datos['nom_proyecto']=$datos['info'][0]->nom_proyecto;
        $datos['nombre_rs']=$datos['info'][0]->nombre_rs;
        $datos['tipo_profesion']=$datos['info'][0]->tipo_profesion;
        $datos['profesion']=$datos['info'][0]->profesion;
        $datos['especialidad']=$datos['info'][0]->especialidad;

        $fechaApr=explode('-',$datos['info'][0]->fecha_aprobacion);
        $datos['anio_apr']=$fechaApr[0];
        $datos['dia_apr']=substr($fechaApr[2],0,2);
        $mes_apr=$fechaApr[1];
        $datos['mes_apr']=$this->meses($mes_apr);
         
        $datos['nume_resolucion'] =$data['exp']->id_resolucion;
        $datos['codigo_veridicacion'] =$data['exp']->codigo_verificacion;
        //$datos['nume_resolucion'] =$data['info']->tipo_identificacion;
        $fechaExp=explode('-',$data['exp']->fecha_resolucion);
        $datos['anio']=$fechaExp[0];
        $datos['dia']=$fechaExp[2];
        $mes=$fechaExp[1];
        //Invoco la función meese para rescatar el nombre del mes
        $datos['mes']=$this->meses($mes);
        
        $ruta_archivos = "/mt/sdb1/uploads/plazas/resoluciones/";
        $nombre_archivo = "resolucion_".$idtramite.".pdf";
        
        //load mPDF library para linux
        //$this->load->library('M_pdf');
        $this->load->library('M_pdf2');
        //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 35, 'margin_bottom' => 25,'margin_header' => 5,'margin_footer' => 5]);
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
                    //$mail->AddReplyTo("acangel@saludcapital.gov.co", "DUES");
                if($datos_tramite['estado']==4){
                    //$archivo = base_url('uploads/expendedor/resoluciones/resolucion_'.$datos_tramite['idpersona'].'.pdf');
                    $archivo = '/mt/sdb1/uploads/plazas/resoluciones/resolucion_'.$datos_tramite['idtramite'].'.pdf';
                    //$url = 'http://app.pimsaseguros.com/_files/_img/_holidays/040616-160454_img001.pdf';
                    //$fichero = file_get_contents($url);
                    $mail->AddAttachment($archivo,"Resolucion.pdf");
                }
               
                $mail->WordWrap = 50;
                $mail->CharSet = 'UTF-8';
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_alcaldia.png', 'imagen');
                //$mail->AddEmbeddedImage('assets/imgs/logo_pdf_footer.png', 'imagen2');
                $mail->IsHTML(true); // set email format to HTML
                $mail->Subject = 'Solicitud de trámite autorización de plazas';
                if($datos_tramite['estado']==4){
                    $html = '
                    <p>Señor(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>Una vez realizado el proceso de validación de documentos del Trámite de autorización de plazas para el servicio social obligatorio, nos complace informar que su trámite fue fue APROBADO, favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y  "Descargue allí su credencial" haga click en la imagen PDF para descargar la resolución.
                    </p>

                    <p>
                        La Secretaria Distrital de Salud, con el propósito de mejorar nuestros servicios a la ciudadanía, quiere conocer su opinión frente a la experiencia en la realización de nuestros trámites, por lo cual agradecemos su tiempo para responder la siguiente encuesta. <br>  
                        <a href="http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es" target="_blank">http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es.</a>
                    </p>
                    
                    <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: expendedormedicamentos@saludcapital.gov.co
                    </p>
                    <p>
                        Se adjunta archivo pdf con resolución.
                    </p>
                    <p><b>Secretaría Distrital de Salud.<br>
                        Subdirección de Inspección Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - TTrámite de autorización de plazas para el servicio social obligatorio<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==5 || $datos_tramite['estado']==13){
                    $html = '
                    <p>Señor(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>Una vez realizado el proceso de validación de documentos del Trámite de autorización de plazas para el servicio social obligatorio, se encontró la siguiente inconsistencia por favor ingrese a la plataforma <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> y realice los ajustes correspondientes para continuar con su trámite:
                   </p>
                      <p>
                        '.$datos_tramite['observaciones'].'
                      </p>
                    
                    <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co
                    </p>
                    <p><b>Secretaría Distrital de Salud.<br>
                        Subdirección de Inspección Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite de autorización de plazas para el servicio social obligatorio<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==7){
                    $html = '
                    <p>Señor(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>
                    Nos permitimos informarlq que, revisados los documentos aportados para la solicitu de autorización de plazas, se constató que éstos no cumplen con los requisitos
                    exigidos por la resolución 13370 de 1990 y decreto 1070 de 1990 del Ministerio de Salud.
                    </p>
                    <p>
                        Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co
                    </p>
                    <p><b>Secretaría Distrital de Salud.<br>
                        Subdirección de Inspección Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Licencia de Expendedor de droga<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    </p>';
                }elseif($datos_tramite['estado']==22){
                    $html = '
                    <p>Señor(a)</p>
                    <p><b>' . $datos_tramite['p_nombre'] . ' ' . $datos_tramite['p_apellido'] . '</b>
                    </p>
                    <p>Nos permitimos informarle que su trámite se registró exitosamente con radicado número '.$datos_tramite['id_tramite'].'. Sin embargo no se ha enviado a validadión hasta tanto no se registre el proyecto.
                   </p>
                    <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co
                    </p>
                    <p><b>Secretaría Distrital de Salud.<br>
                        Subdirección de Inspección Vigilancia y Control - Oficina de Registro</b><br>
                        <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite de autorización de plazas para el servicio social obligatorio<br>
                        Cra 32 #12-81 Bogotá D.C, Colombia<br>
                        Teléfono: (571) 3649090
                    </p>';
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
        $this->load->model("plazas_models");
        $id_archivo = $this->input->post("idRow");
        $archivos=$this->plazas_models->consulta_archivosbyId($id_archivo);

        $doc_pdf = '<embed src="'.base_url('/plazas/abrir_pdf/'.$archivos[0]['nombre']).'" frameborder="0" width="100%" height="400px">
         <div class="modal-footer">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>';
        echo $doc_pdf;
    }

    //Método para ver seguimiento y audotoría
    public function ver_auditoria(){
        $this->load->model("plazas_models");
        $id_tramite = $this->session->userdata('id_tramite');
        $data['auditoria']=$this->plazas_models->consulta_auditoria($id_tramite);
        //hago un explode al nobre del archivo
        $this->load->view("ver_auditoria_view", $data);
    }

    //Envía la resolución  firmada al usuario
    public function enviar_resolucion(){
        header('Content-Type: application/json');
        $this->load->model("plazas_models");
        $data = array();
        $idtramite=$this->session->userdata('id_tramite');
        $info = $this->plazas_models->get_tramitesbyId($idtramite);
        //Asigno la información a un arreglo $datos_tramite
        $datos_tramite['p_nombre']=$info[0]->p_nombre;
        $datos_tramite['p_apellido']=$info[0]->p_apellido;
        $datos_tramite['email']=$info[0]->email;
        $datos_tramite['estado']=$info[0]->id_estado;
        $datos_tramite['idtramite']= $idtramite;
        //$datos_tramite['email']='sjneira@saludcapital.gov.co';
        $this->enviarCorreo($datos_tramite);
        
        $data["result"] = true;
        $this->session->set_flashdata('retornoEnvio', $msj);
        echo json_encode($data);
        //redirect('expendedor_droga/tramites_pendientes', 'reload');

    }

    //Método para editar los datos personales del ciudadano
    public function modal_editpersona(){
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        
        $id_persona = $this->session->userdata('id_persona');

        $data['information'] = $this->plazas_models->consulta_persona($id_persona);
        $data['nivel_educativo'] = $this->parametricas->consulta_nivel();
        $this->load->view("editar_personas", $data);
        //$this->load->view('templates/layout_expendedor',$data);
    }

    //Método para guardar los camibos de los datos personales
    public function save_persona(){
        header('Content-Type: application/json');
        $this->load->model("plazas_models");
        $data = array();
               
        $id_persona = $this->session->userdata('id_persona');
        
        $msj = "Los datos del representante legal se actualizaron exitosamente.";
        
        $documento = $this->input->post('documento');

        if ($this->plazas_models->savePersona($id_persona)) {
            //$this->capitulo1->insertarControl();
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoP', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    }

    //Método para editar los datos del encargado del trámite
    public function modal_editencargado(){
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        
        $id_persona = $this->session->userdata('id_persona');
        $idtramite=$this->session->userdata('id_tramite');
        $data['information'] = $this->plazas_models->get_tramitesbyId($idtramite);
        $data['tipo_doc'] = $this->parametricas->consulta_tipodoc();
        $this->load->view("editar_encargado", $data);
        //$this->load->view('templates/layout_expendedor',$data);
    }

    //Método para guardar los camibos de los datos del encargado del trámte
    public function save_encargado(){
        header('Content-Type: application/json');
        $this->load->model("plazas_models");
        $data = array();
        $id_tramite = $this->session->userdata('id_tramite');
        
        $msj = "Los datos del encargado del trámite se actualizaron exitosamente.";
        
        $documento = $this->input->post('documento');

        if ($this->plazas_models->saveEncargado($id_tramite)) {
            //$this->capitulo1->insertarControl();
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoENC', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    }

    //Método para editar los datos del proyecto
    public function modal_editproyecto(){
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $this->load->model("plazas_models");
        $this->load->model("parametricas");
        
        $id_persona = $this->session->userdata('id_persona');
        $idtramite=$this->session->userdata('id_tramite');
        $data['information'] = $this->plazas_models->get_tramitesbyId($idtramite);
        $data['nivel_educativo'] = $this->parametricas->consulta_nivel();
        $data['modalidad'] = $this->parametricas->obtener_modalidad();
        $data['profesiones'] = $this->parametricas->obtener_profesiones();
        $data['vinculacion'] = $this->parametricas->obtener_vinculacion();
        if($data['information'][0]->especialidad==''){
            $data['disabled']='disabled="disabled"';
        }else{
            $data['disabled']='';
        }
        $this->load->view("editar_proyecto", $data);
        //$this->load->view('templates/layout_expendedor',$data);
    }

    //Método para guardar los camibos de los datos del proyecto
    public function save_editproyecto(){
        $this->load->model("plazas_models");
        $id_tramite=$this->session->userdata('id_tramite');
        $id_usuario=$this->session->userdata('id_usuario');
        $idtramite=$id_tramite+19722512-20131611;

        $registrarTramite = $this->plazas_models->saveEditproyecto($id_tramite);

        if($registrarTramite){
            /**
            Cargar archivos del equipo
            */

            $bandera = 1;
            $documentos = array("doc_corregido");
           
            //Bucle para el conteo de los documento cargados
            for($i=0;$i<=count($documentos);$i++){
                //Vallida la rcecpción de archivos.
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                  
                    $nombre_archivo = $id_tramite."-".$documentos[$i]."-".date('YmdHis');
                                        
                    $config['upload_path'] = "/mt/sdb1/uploads/plazas/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '50000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */
                    
                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    //var_dump($config);
                    if ($this->upload->do_upload($documentos[$i])) {
                        //Carga el documento
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        
                        $bandera = 0;
                    }

                    $datosAr['ruta'] = '/mt/sdb1/uploads/plazas/';
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['id_persona'] = $id_usuario;
                    $datosAr['condicion'] = 0;
                    $datosAr['estado'] = 'AC';
                    
                    $resultado = $this->plazas_models->insertarArchivo($datosAr);

                }
                
            }
            //Redirecciona a proyecto
            $this->session->set_flashdata('retornoExito', 'Registro de investigación y tipo de plaza exitoso para el trámite número '.$id_tramite.'.</b>');
                redirect(base_url('plazas/proyectos/'.$idtramite.''), 'refresh');
            exit;
            
        }
    }

    public function enviar_validacion(){
        $this->load->model("plazas_models");
        $idtramite=$this->session->userdata('id_tramite');
        
        $msj = "Los datos del encargado del trámite se actualizaron exitosamente.";
        
        $documento = $this->input->post('documento');

        if ($this->plazas_models->actualizar_tramite($idtramite)) {
            //$this->capitulo1->insertarControl();
            $data["result"] = true;
            $this->session->set_flashdata('retornoExitoENC', $msj);
        } else {
            $data["result"] = "error";
            $this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
        }
        

        echo json_encode($data);
    } 

    public function reportes($tipo_reporte) {
        $this->load->model("plazas_models");
        $data['js'] = array(base_url('assets/js/plazas/validate/reportes.js'));
        $datosAr1 = $this->session->userdata('username');
        $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
        $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
        $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';
        if($tipo_reporte==1){
            $data['listado_soli'] = $this->plazas_models->listarSolicitudesAP($fechai,$fechaf,0);
            $data['contenido'] = 'tramites_licenciaAP_view';
        }elseif($tipo_reporte==2){
            $data['listado_soli'] = $this->plazas_models->listarHistoricoAP($fechai,$fechaf,0);
            $data['contenido'] = 'tramites_historico_view';
        }
        $this->load->view('templates/layout_plazas',$data);
    }

    public function generar_excel($tipo_reporte){
        $this->load->model("plazas_models");
        $fechai= isset($_GET['fecha_i']) ? $_GET['fecha_i']:'';
        $fechaf= isset($_GET['fecha_f']) ? $_GET['fecha_f']:'';//echo $fechaf;exit;
        $fechaInicial=$this->plazas_models->formatoFecha($fechai,'/'); 
        $fechaFinal=$this->plazas_models->formatoFecha($fechaf,'/'); 
        $fec=strtotime ('-31 day', strtotime($_GET['fechaFinal']));
        $fec2= date('Y-m-d', $fec);
        $fecha=date('dmY his');

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time','600');
        $name="AutorizacionPlazas".$fecha.".csv";
                
        if($tipo_reporte==1){    
                $data['listado_plazas']= $this->plazas_models->listarSolicitudesAP($fechai,$fechaf,0);
                $listado_plazas= $this->plazas_models->listarSolicitudesAP($fechai,$fechaf,0);
        }elseif($tipo_reporte==2){
            $data['listado_plazas']= $this->plazas_models->listarHistoricoAP($fechai,$fechaf,0);
            $listado_plazas=$this->plazas_models->listarHistoricoAP($fechai,$fechaf,0);
            
        }
        //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
        //$datos['data'] = $data;
        header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
        header('Content-Disposition: attachment; filename='.$name.'');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
                
        $this->load->view('reportes_plazas_view',$data, FALSE);
        
    }

    //Método para visaulizar todos los documentos PDF cargados por el ciudadano
    public function abrir_pdf($archivo){
        //$this->load->model("plazas_models");
        //$archivos=$this->plazas_models->consulta_archivosbyId($id_archivo);
        $file = '/mt/sdb1/uploads/plazas/'.$archivo; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }

    //Método para visaulizar los PDF de las resoluciones
    public function abrir_resolucion_pdf($id_usuario){
        $file = "/mt/sdb1/uploads/plazas/resoluciones/resolucion_".$id_usuario.".pdf"; 
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
        //redirect(base_url());
        header('Location: ../../index.php'); 
    }

}
