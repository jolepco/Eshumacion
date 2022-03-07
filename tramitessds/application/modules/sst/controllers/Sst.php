<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC
 *
 * @package    CodeIgniter-HMVC
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @filesource
 *
 */

class Sst extends MY_Controller
{
    //
    public $CI;
    
    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
        $this->load->model('sst_model');		
        $this->load->database('default');
		$this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form'));
		
		if(!$this->session->userdata('id_usuario') || $this->session->userdata('id_usuario') == ''){
			$this->session->sess_destroy();
			redirect($this->config->item('url_tramites'));
		}
    }

    public function index(){

        if($this->session->userdata('perfil') == 2){
            redirect(base_url('sst/listado_tramites'));
        }else if($this->session->userdata('perfil') == 3){
            redirect(base_url('sst/validacion/'));
        }else if($this->session->userdata('perfil') == 4){
            redirect(base_url('sst/coordinacion/'));
        }else if($this->session->userdata('perfil') == 5){
            redirect(base_url('sst/direccion/'));
        }


    }

    public function datosMunicipios()
    {
        $dpto = $this->input->post('departamento');
        $municipios = $this->sst_model->municipios_col($dpto);

        $retorno = '<option value="">Seleccione...</option>';

        for($i=0;$i<count($municipios);$i++){
            $retorno .= "<option value='".$municipios[$i]->IdMunicipio."'>".$municipios[$i]->Descripcion."</option>";
        }

        echo $retorno;

    }
	/*QUITAR EN PRODUCCION*/
    public function crear_sesion($username){
		
		$check_user = $this->sst_model->login_user($username);
        
		if($check_user == TRUE)
		{
			$data = array(
				'is_logued_in' 	=> 		TRUE,
				'id_usuario' 	=> 		$check_user->id,
				'perfil'		=>		$check_user->perfil,
				'id_persona'	=>		$check_user->id_persona,
				'username' 		=> 		$check_user->username,
				'fecha_terminos' 		=> 		$check_user->fecha_terminos
			);

			$this->session->set_userdata($data);

			if($check_user->id_persona != 0){
				$usuario = $this->sst_model->info_usuario($check_user->id_persona);

				$data = array(
				'tipo_identificacion' 		=> 		$usuario->tipo_identificacion,
				'nume_identificacion' 		=> 		$usuario->nume_identificacion,
				'email' 		=> 		$usuario->email,
				'nombre' 		=> 		$usuario->p_nombre." ".$usuario->s_nombre." ".$usuario->p_apellido." ".$usuario->s_apellido
				);
                $this->session->set_userdata($data);
                
                
            }
            
            redirect(base_url('sst'), 'refresh');

		}

	}
	/*QUITAR EN PRODUCCION*/
    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect($this->config->item('url_tramites'), 'refresh');
    }
	
	public function formulario_usuario()
	{
		$data['js'] = array(base_url('assets/js/sst/sst.js'));
        $data['departamentos_col'] = $this->sst_model->departamentos_col();
        $data['tramites_proceso'] = $this->sst_model->sst_pendientes_usuario($this->session->userdata('id_usuario'));  
        $data['contenido'] = 'usuario/formulario_usuario'; 
        $this->load->view('templates/layout_sst',$data);
	}

    public function listado_tramites(){

        $data['js'] = array(base_url('assets/js/sst/sst.js'));
        $data['tramites_pen'] = $this->sst_model->sst_pendientes_usuario($this->session->userdata('id_usuario'));        
        $data['contenido'] = 'usuario/listado_tramites'; 
        $this->load->view('templates/layout_sst',$data);

    }

    public function guardarTramite(){

        $data['id_usuario'] = $this->session->userdata('id_usuario');
        $data['tipo_tramite'] = $this->input->post('tipo_tramite');
        $data['id_estado'] = $this->input->post('id_estado');
        $data['fecha_creacion'] = date('Y-m-d H:i:s');

        if($this->input->post('tipo_tramite') == 2){
            
            $data['id_motivo_modificacion'] = $this->input->post('motivo_modificacion');
            $data['num_resolucion_anterior'] = $this->input->post('num_resolucion_anterior');
            $data['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anterior');

            $documentos = array("doc_lic_anterior", "soporte_modificacion");
        
            for($i=0;$i<count($documentos);$i++){
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $documentos[$i]."-".$data['id_usuario']."-".date('YmdHis');
                    $config['upload_path'] = "/mt/sdb1/uploads/sst/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '30000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */

                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload($documentos[$i])) {
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        $bandera = 0;
                    }

                    $datosAr['ruta'] = $rutaFinal['rutaFinal']['full_path'];
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['estado'] = 'AC';

                    $resultadoIDDocumento = $this->sst_model->insertarArchivo($datosAr);

                    if($documentos[$i] == 'doc_lic_anterior'){
                        $data['id_licencia_ant'] = $resultadoIDDocumento;
                    }else if($documentos[$i] == 'soporte_modificacion'){
                        $data['soporte_modificacion'] = $resultadoIDDocumento;
                    }
                    

                }
            }

        }else if($this->input->post('tipo_tramite') == 3){
            
            $data['id_depto_renovacion'] = $this->input->post('depto_lic_anterior');
            $data['id_mpio_renovacion'] = $this->input->post('mpio_lic_anterior');
            $data['num_resolucion_anterior'] = $this->input->post('num_resolucion_anteriorR');
            $data['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anteriorR');

            $documentos = array("doc_lic_anteriorR");
        
            for($i=0;$i<count($documentos);$i++){
                if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $documentos[$i]."-".$data['id_usuario']."-".date('YmdHis');
                    $config['upload_path'] = "/mt/sdb1/uploads/sst/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '30000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */

                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload($documentos[$i])) {
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        $bandera = 0;
                    }

                    $datosAr['ruta'] = $rutaFinal['rutaFinal']['full_path'];
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['estado'] = 'AC';

                    $resultadoIDDocumento = $this->sst_model->insertarArchivo($datosAr);
                    $data['id_licencia_ant'] = $resultadoIDDocumento;

                }
            }

        }

        $resultadoIDTramite = $this->sst_model->insertarTramite($data);

        if($resultadoIDTramite){
            $dataFlujo['tramite_id'] = $resultadoIDTramite;
            $dataFlujo['id_usuario'] = $this->session->userdata('id_usuario');
            $dataFlujo['id_estado'] = $this->input->post('id_estado');
            $dataFlujo['fecha_estado'] = date('Y-m-d H:i:s');
            $dataFlujo['observaciones'] = 'Registro de trámite SST usuario externo';

            $resultadoIDTramiteFlujo = $this->sst_model->insertarTramiteFlujo($dataFlujo);
            
            if($resultadoIDTramiteFlujo){

                $datareg['id_tramite'] = $resultadoIDTramite;
                $datareg['servicios'] = $this->input->post('servicios');
                $datareg['caracteristicas'] = $this->input->post('caracteristicas');
                $datareg['otros'] = $this->input->post('otros');

                if($this->session->userdata('tipo_identificacion') != 5){
                    $datareg['labora'] = $this->input->post('labora_actual');
                    $datareg['nombre_empresa'] = $this->input->post('nombre_empresa');
                    $datareg['dir_empresa'] = $this->input->post('dir_empresa');
                    $datareg['depto_empresa'] = $this->input->post('depto_empresa');
                    $datareg['mpio_empresa'] = $this->input->post('mpio_empresa');
                    $datareg['tel_empresa'] = $this->input->post('tel_empresa');
                    $datareg['fax_empresa'] = $this->input->post('fax_empresa');
                    $datareg['tipo_programa'] = $this->input->post('tipo_programa');
                    $datareg['tipo_titulo'] = $this->input->post('tipo_titulo');
                    $datareg['tipo_profesional'] = $this->input->post('tipo_profesional');
                    $datareg['otro_tipo_profesional'] = $this->input->post('otro_tipo_profesional');
                    $datareg['titulo_programa'] = $this->input->post('titulo_programa');
                    $datareg['titulo_postgrado'] = $this->input->post('titulo_postgrado');
                }else{
                    $datareg['direccion_entidad'] = $this->input->post('direccion_entidad');
                }

                $bandera = 1;
                $documentos = array("doc_docu_iden","doc_pregrado","doc_postgrado","doc_convalidacion","doc_pensum","doc_soporte","doc_cc","doc_rl","doc_formato_personas","doc_formato_equipos");
        
                for($i=0;$i<count($documentos);$i++){
                    if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

                        $nombre_archivo = "sst-".$documentos[$i]."-".$resultadoIDTramite."-".date('YmdHis');
                        $config['upload_path'] = "/mt/sdb1/uploads/sst/";
                        $config['allowed_types'] = 'pdf';
                        $config['max_size'] = '30000';
                        $config['file_name'] = $nombre_archivo;
                        /* Fin Configuracion parametros para carga de archivos */

                        // Cargue libreria
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        if ($this->upload->do_upload($documentos[$i])) {
                            $upload_data = $this->upload->data();
                            $rutaFinal = array('rutaFinal' => $this->upload->data());
                        } else {
                            $bandera = 0;
                        }

                        $datosAr['ruta'] = $rutaFinal['rutaFinal']['full_path'];
                        $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                        $datosAr['fecha'] = date('Y-m-d');
                        $datosAr['tags'] = "";
                        $datosAr['es_publico'] = 1;
                        $datosAr['estado'] = 'AC';

                        $resultadoIDDocumento = $this->sst_model->insertarArchivo($datosAr);
                        $datareg[$documentos[$i]] = $resultadoIDDocumento;

                    }
                }

                $resultadoIDDocumento = $this->sst_model->insertarRegistroSST($datareg);
                
                $this->session->set_flashdata('exito', 'Su solicitud se ha registrado con &eacute;xito en el sistema con n&uacute;mero de radicado: <b>'.$resultadoIDTramite.'</b>. <br><br>Recuerde realizar seguimiento a su trámite a traves de la Ventanilla Unica de Trámites y Servicios.');
                redirect(base_url('sst/listado_tramites'), 'refresh');
                exit;

            }else{
                $this->session->set_flashdata('error', 'No es posible realizar el registro del trámite');
                redirect(base_url('sst/listado_tramites'), 'refresh');
                exit;
            }

        }else{
            $this->session->set_flashdata('error', 'No es posible realizar el registro del trámite');
            redirect(base_url('sst/listado_tramites'), 'refresh');
            exit;
        }
        
    }

    public function editar_tramite($id_tramite){

        $data['js'] = array(base_url('assets/js/sst/sst_editar.js'));
        $data['id_tramite'] = $id_tramite; 
        $data['tramite_info'] = $this->sst_model->tramite_info_validacion($id_tramite); 
        $data['tramite_registro'] = $this->sst_model->tramite_registro($id_tramite); 
        $data['departamentos_col'] = $this->sst_model->departamentos_col();
        $data['estado_tramite'] = $this->sst_model->estado_tramite($id_tramite);
        $data['contenido'] = 'usuario/formulario_editar'; 
        $this->load->view('templates/layout_sst',$data);

    }

    public function actualizarTramite(){
        
        $documentosTramite = array("doc_lic_anterior", "soporte_modificacion");
        
        if($this->input->post('tipo_tramite') == 2 || $this->input->post('tipo_tramite') == 3)
        {

            for($i=0;$i<count($documentosTramite);$i++){
                if (isset($_FILES[$documentosTramite[$i]]) && $_FILES[$documentosTramite[$i]]['size'] > 0) {
                    
                    $nombre_archivo = $documentosTramite[$i]."-".$data['id_usuario']."-".date('YmdHis');
                    $config['upload_path'] = "/mt/sdb1/uploads/sst/";
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '30000';
                    $config['file_name'] = $nombre_archivo;
                    /* Fin Configuracion parametros para carga de archivos */

                    // Cargue libreria
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload($documentosTramite[$i])) {
                        $upload_data = $this->upload->data();
                        $rutaFinal = array('rutaFinal' => $this->upload->data());
                    } else {
                        $bandera = 0;
                    }

                    $datosAr['ruta'] = $rutaFinal['rutaFinal']['full_path'];
                    $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                    $datosAr['fecha'] = date('Y-m-d');
                    $datosAr['tags'] = "";
                    $datosAr['es_publico'] = 1;
                    $datosAr['estado'] = 'AC';

                    $resultadoIDDocumento = $this->sst_model->insertarArchivo($datosAr);

                    if($documentosTramite[$i] == 'doc_lic_anterior'){
                        $dataActTra['id_licencia_ant'] = $resultadoIDDocumento;
                    }else if($documentosTramite[$i] == 'soporte_modificacion'){
                        $dataActTra['soporte_modificacion'] = $resultadoIDDocumento;
                    }
                    

                }
            }

            $dataActTra['id_usuario'] = $this->session->userdata('id_usuario');
            $dataActTra['id_tramite'] = $this->input->post('id_tramite');
            $dataActTra['id_motivo_modificacion'] = $this->input->post('motivo_modificacion');
            $dataActTra['id_depto_renovacion'] = $this->input->post('depto_lic_anterior');
            $dataActTra['id_mpio_renovacion'] = $this->input->post('mpio_lic_anterior');
            $dataActTra['num_resolucion_anterior'] = $this->input->post('num_resolucion_anterior');
            $dataActTra['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anterior');
            
            $resultadoTramite = $this->sst_model->actualizarTramite($dataActTra);
        }


        $documentosRegistro = array("doc_cc", "doc_rl", "doc_formato_personas", "doc_formato_equipos", "doc_docu_iden", "doc_pregrado", "doc_postgrado", "doc_convalidacion", "doc_pensum", "doc_soporte");

        for($i=0;$i<count($documentosRegistro);$i++){
            if (isset($_FILES[$documentosRegistro[$i]]) && $_FILES[$documentosRegistro[$i]]['size'] > 0) {
                
                $nombre_archivo = $documentosRegistro[$i]."-".$data['id_usuario']."-".date('YmdHis');
                $config['upload_path'] = "/mt/sdb1/uploads/sst/";
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '30000';
                $config['file_name'] = $nombre_archivo;
                /* Fin Configuracion parametros para carga de archivos */

                // Cargue libreria
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload($documentosRegistro[$i])) {
                    $upload_data = $this->upload->data();
                    $rutaFinal = array('rutaFinal' => $this->upload->data());
                } else {
                    $bandera = 0;
                }

                $datosAr['ruta'] = $rutaFinal['rutaFinal']['full_path'];
                $datosAr['nombre'] = $rutaFinal['rutaFinal']['file_name'];
                $datosAr['fecha'] = date('Y-m-d');
                $datosAr['tags'] = "";
                $datosAr['es_publico'] = 1;
                $datosAr['estado'] = 'AC';

                $resultadoIDDocumento = $this->sst_model->insertarArchivo($datosAr);

                $datareg[$documentosRegistro[$i]] = $resultadoIDDocumento;                

            }
        }

        $whereReg['id_usuario'] = $this->session->userdata('id_usuario');
        $whereReg['id_tramite'] = $this->input->post('id_tramite');
        $whereReg['id_estado'] = $this->input->post('id_estado');

        $datareg['servicios'] = $this->input->post('servicios');
        $datareg['caracteristicas'] = $this->input->post('caracteristicas');
        $datareg['otros'] = $this->input->post('otros');
       
        if($this->session->userdata('tipo_identificacion') != 5){
            $datareg['labora'] = $this->input->post('labora_actual');
            $datareg['nombre_empresa'] = $this->input->post('nombre_empresa');
            $datareg['dir_empresa'] = $this->input->post('dir_empresa');
            $datareg['depto_empresa'] = $this->input->post('depto_empresa');
            $datareg['mpio_empresa'] = $this->input->post('mpio_empresa');
            $datareg['tel_empresa'] = $this->input->post('tel_empresa');
            $datareg['fax_empresa'] = $this->input->post('fax_empresa');
            $datareg['tipo_programa'] = $this->input->post('tipo_programa');
            $datareg['tipo_titulo'] = $this->input->post('tipo_titulo');
            $datareg['tipo_profesional'] = $this->input->post('tipo_profesional');
            $datareg['otro_tipo_profesional'] = $this->input->post('otro_tipo_profesional');
            $datareg['titulo_programa'] = $this->input->post('titulo_programa');
            $datareg['titulo_postgrado'] = $this->input->post('titulo_postgrado');
        }else{
            $datareg['direccion_entidad'] = $this->input->post('direccion_entidad');
        }

        $resultadoRegistroTramite = $this->sst_model->actualizarRegistro($datareg, $whereReg);
        
        $dataEstado['id_tramite'] = $this->input->post('id_tramite');
        $dataEstado['id_estado'] = $this->input->post('id_estado');
        
        $resultadoEstadoTramite = $this->sst_model->actualizarEstadoTramite($dataEstado);
        
        $dataFlujo['tramite_id'] = $this->input->post('id_tramite');
        $dataFlujo['id_usuario'] = $this->session->userdata('id_usuario');
        $dataFlujo['id_estado'] = $this->input->post('id_estado');
        $dataFlujo['fecha_estado'] = date('Y-m-d H:i:s');
        $dataFlujo['observaciones'] = 'Subsanación por parte del usuario externo';

        $resultadoIDTramiteFlujo = $this->sst_model->insertarTramiteFlujo($dataFlujo);
                
        $this->session->set_flashdata('exito', 'Su solicitud se ha actualizada con &eacute;xito en el sistema. <br><br>Recuerde realizar seguimiento a su trámite a traves de la Ventanilla Unica de Trámites y Servicios.');
        redirect(base_url('sst/listado_tramites'), 'refresh');
        exit;

    }

    public function cargarCampos(){
        $perfiles = $this->input->post('perfiles');
        $campos = $this->sst_model->campos_por_perfil($perfiles);

        $retorno = '';

        for($i=0;$i<count($campos);$i++){
            $retorno .= "<option value='".$campos[$i]->id_campo."'>".$campos[$i]->desc_campo."</option>";
        }

        echo $retorno;
    }
   
    public function seguimientociudadano()
    {
		$tramite_id = $this->input->post('idt');
    	$resultado = $this->sst_model->tramites_seguimientociudadanano_id($tramite_id);
			
		echo json_encode($resultado);			


    }	

    //Método para visaulizar las resoluciones en PDF generados por el sistema
    public function abrir_resoluciones($resolucion){
        $file = "/mt/sdb1/uploads/sst/resoluciones/".$resolucion; 
        $filename = $archivos[0]['nombre'];  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }




    public function enviarCorreoConfirmacion(){
            
    }

	//Método para visaulizar todos los documentos PDF cargados por el ciudadano
    public function abrir_pdf($archivo){
        $file = "/mt/sdb1/uploads/sst/".$archivo; 
        $filename = $archivo;  
        //echo $file; exit;
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . $filename . '"');  
        header('Content-Transfer-Encoding: binary');  
        header('Accept-Ranges: bytes');  
         // leer archivo
        @readfile($file);
    }
}
