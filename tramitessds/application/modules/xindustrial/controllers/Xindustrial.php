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
 * @since      Version 0.0.1listado_tramites
 * @filesource
 *
 */

class Xindustrial extends MY_Controller
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
        $this->load->model('xindustrial_model');		
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
            redirect(base_url('xindustrial/listado_tramites'));
        }else if($this->session->userdata('perfil') == 3){
            redirect(base_url('xindustrial/validacion/'));
        }else if($this->session->userdata('perfil') == 4){
            redirect(base_url('xindustrial/coordinacion/'));
        }else if($this->session->userdata('perfil') == 5){
            redirect(base_url('xindustrial/direccion/'));
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


  public function etapas_tramite()
	{
    		$data['js'] = array(base_url('assets/js/sst/sst.js'));
        $data['departamentos_col'] = $this->xindustrial_model->departamentos_col();
        $data['mistramites_rx'] = $this->xindustrial_model->mis_tramites_rx();#rx
        $data['contenido'] = 'usuario/etapas_usuario';
        $this->load->view('templates/layout_sst',$data);
	}

  public function etapa_procesado()
	{
		$data['js'] = array(base_url('assets/js/sst/sst.js'));
        $data['departamentos_col'] = $this->xindustrial_model->departamentos_col();
        $data['mistramites_rx'] = $this->xindustrial_model->mis_tramites_rx();#rx
        $data['contenido'] = 'usuario/etapa_procesado';
        $this->load->view('templates/layout_sst',$data);
	}
    public function listado_tramites(){

        $data['js'] = array(base_url('assets/js/sst/sst.js'));
        $data['mistramites_rx'] = $this->xindustrial_model->mis_tramites_rx();#rx
        $data['contenido'] = 'usuario/listado_tramites'; 
        $this->load->view('templates/layout_sst',$data);

    }

    public function rx_crear_tramite()
    {
        $data['departamento'] = $this->xindustrial_model->departamentos_col();
        $data['equipos_radiacion'] = $this->xindustrial_model->equipos_radiacion();
        $data['tipo_visualizacion'] = $this->xindustrial_model->tipo_visualizacion();
        $data['js'] = array(base_url('assets/js/xindustrial/xindustrial.js'));
        $data['titulo'] = 'Licencias Equipos industriales';
        //$data['contenido'] = 'usuario/licencias_rx_view';
        $data['contenido'] = 'usuario/rx_crear_tramite';
        $this->load->view('templates/layout_sst',$data);		
    }

    public function crearTramiteRayosx()
    {
      if($_REQUEST['tipo_tramite'] == 2){

        $data['id_motivo_modificacion'] = $this->input->post('motivo_modificacion');
        $data['num_resolucion_anterior'] = $this->input->post('num_resolucion_anterior');
        $data['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anterior');

        $data['user'] = $this->session->userdata('id_usuario');
        $data['tipo_tramite'] = $_REQUEST['tipo_tramite'];
        $data['estado'] = 1;
        $data['created_at'] = date("Y-m-d H:i:s");

        $data['tramite_id'] = $resultadoCrearTramite = $this->xindustrial_model->crear_tramite($data);

        $documentos = array("doc_lic_anterior", "soporte_modificacion");

        for($i=0;$i<count($documentos);$i++){
            if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

                $nombre_archivo = $data['tramite_id']."-".$documentos[$i]."-".$data['id_usuario']."-".date('YmdHis');
                $config['upload_path'] = "uploads/xindustrial/";
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

                $resultadoIDDocumento = $this->xindustrial_model->insertarArchivo($datosAr);

                $datosDoc['id_tramite_rayosx'] = $resultadoCrearTramite;
                $datosDoc['documento'] = $documentos[$i];
                $datosDoc['path'] = $rutaFinal['rutaFinal']['full_path'];
                $datosDoc['id_archivo'] = $resultadoIDDocumento;
                $datosDoc['estado'] = 1;
                $datosDoc['created_at'] = date("Y-m-d H:i:s");
                $resultRayosxArc = $this->xindustrial_model->inactivarDocumentoPrevios($datosDoc);
                $resultRayosxObjeto = $this->xindustrial_model->insertDocumento($datosDoc);

            }
        }


		}else if($_REQUEST['tipo_tramite'] == 3){
      $data['num_resolucion_anterior'] = $this->input->post('num_resolucion_anteriorR');
      $data['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anteriorR');

      $data['user'] = $this->session->userdata('id_usuario');
      $data['tipo_tramite'] = $_REQUEST['tipo_tramite'];
      $data['estado'] = 1;
      $data['created_at'] = date("Y-m-d H:i:s");

      $resultadoCrearTramite = $this->xindustrial_model->crear_tramite($data);


      $documentos = array("doc_lic_anteriorR");

      for($i=0;$i<count($documentos);$i++){
          if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

              $nombre_archivo = $documentos[$i]."-".$data['id_usuario']."-".date('YmdHis');
              $config['upload_path'] = "uploads/xindustrial/";
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

              $resultadoIDDocumento = $this->xindustrial_model->insertarArchivo($datosAr);

              $datosDoc['id_tramite_rayosx'] = $resultadoCrearTramite;
              $datosDoc['documento'] = $documentos[$i];
              $datosDoc['path'] = $rutaFinal['rutaFinal']['full_path'];
              $datosDoc['id_archivo'] = $resultadoIDDocumento;
              $datosDoc['estado'] = 1;
              $datosDoc['created_at'] = date("Y-m-d H:i:s");
              $resultRayosxArc = $this->xindustrial_model->inactivarDocumentoPrevios($datosDoc);
              $resultRayosxObjeto = $this->xindustrial_model->insertDocumento($datosDoc);



          }
      }

		}else{
            $data['user'] = $this->session->userdata('id_usuario');
            $data['tipo_tramite'] = $_REQUEST['tipo_tramite'];
            $data['estado'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $resultadoCrearTramite = $this->xindustrial_model->crear_tramite($data);
    }

      if($resultadoCrearTramite){
         $dataflujo['tramite_id'] = $resultadoCrearTramite;
         $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
         $dataflujo['id_estado'] = 1;
         $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
         $dataflujo['observaciones'] = "Creación del trámite RAYOS X Equipos Industriales";
         $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

         if($resultadoCrearTramiteFlujo){
           $this->session->set_flashdata('exito', 'Por favor complete su solicitud radicada en la opción de Mis Trámites RX Veterinarias, este trámite cuenta con dos etapas, la primera la creación de la solicitud y la segunda la finalización de la solicitud donde se envía el formulario para su validación. El solicitante puede ingresar a la opción de Mis Trámites para ingresar a la solicitud creada y realizar guardados parciales por etapa, una vez finalice el trámite será enviado para validación. Para hacerle seguimiento a este trámite no olvide anotar el ID del trámite descrito a continuación: <br><br> <b> N&uacute;mero de radicado: '.$resultadoCrearTramite.'</b>. <br><br> Muchas Gracias por utilizar los servicios en línea de la Secretaría Distrital de Salud. Recuerde realizar seguimiento a su trámite a traves de la Portal Transaccional de Trámites y Servicios.<br><br>  Ante cualquier inquietud no dude primero consultar la documentación disponible o contactar con los canales de atención disponibles o el email contactenos@saludcapital.gov.co');
         }
       }else{
        $this->session->set_flashdata('error', 'No es posible realizar el registro del trámite, intentarlo más tarde. Si el problema persiste favor contactar con los canales de atención disponibles o el email contactenos@saludcapital.gov.co');
       }
       redirect(base_url('xindustrial/listado_tramites'), 'refresh');
       exit;

    }

    public function rx_editarForm($id_tramite){

        $data['id_tramite'] = $id_tramite;
		$data['tramite_info'] = $this->xindustrial_model->tramite_info($id_tramite);
        $data['departamento'] = $this->xindustrial_model->departamentos_col();
        $data['equipos_radiacion'] = $this->xindustrial_model->equipos_radiacion();
        $data['tipo_visualizacion'] = $this->xindustrial_model->tipo_visualizacion();
        $data['tipo_identificacion_natural'] = $this->xindustrial_model->tipo_identificacion();
        $data['nivelAcademico'] = $this->xindustrial_model->nivelAcademico();
        $data['programasAcademicos'] = $this->xindustrial_model->programasAcademicos();
		
		//Verificar si tiene datos por cada paso
		$data['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
		$data['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
		$data['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
		$data['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
		$data['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
		$data['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
		$data['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
		$data['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
		
		
        $data['js'] = array(base_url('assets/js/xindustrial/xindustrial.js?n='.date('is')));
        $data['titulo'] = 'Licencias Rayos X';
        $data['contenido'] = 'usuario/rx_editarForm2_view';
        $this->load->view('templates/layout_sst',$data);


    }

    public function editarDireccionRX() {
		
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
               $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
               redirect(base_url('xindustrial/listado_tramites'), 'refresh');
               exit;
        }else {
            
            $rayosxDireccion['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
            $rayosxDireccion['depto_entidad'] = $_REQUEST['depto_entidad'];
            $rayosxDireccion['mpio_entidad'] = $_REQUEST['mpio_entidad'];
            $rayosxDireccion['dire_entidad'] = $_REQUEST['dire_entidad'];
            $rayosxDireccion['sede_entidad'] = $_REQUEST['sede_entidad'];
            $rayosxDireccion['email_entidad'] = $_REQUEST['email_entidad'];
            $rayosxDireccion['celular_entidad'] = $_REQUEST['celular_entidad'];
            $rayosxDireccion['telefono_entidad'] = $_REQUEST['telefono_entidad'];
            $rayosxDireccion['extension_entidad'] = $_REQUEST['extension_entidad'];
            
            if($_REQUEST['id_direccion_tramite'] != ''){
                
                $rayosxDireccion['id_direccion_tramite'] = $_REQUEST['id_direccion_tramite'];
                $rayosxDireccion['updated_at'] = date("Y-m-d H:i:s");
                $resultRayosxDireccion = $this->xindustrial_model->updateRayosxDireccion($rayosxDireccion);
            }else{
                $rayosxDireccion['created_at'] = date("Y-m-d H:i:s");
                $resultRayosxDireccion = $this->xindustrial_model->insertRayosxDireccion($rayosxDireccion);
            }

               if($resultRayosxDireccion){
                   $this->session->set_flashdata('exito', 'Se realizo la actualización con exito</b>');

                   $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                   $dataAct['modulo'] = "modulo1";
                   $dataAct['estado'] = "1";
                   $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                   
               }else{
                   $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');	
               }				
               redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
               exit;
                
   
        }
   }
       
   public function editarCategoriaRX() {
       
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
            
           $respuestaServicio['estado'] = "ERROR";
           $respuestaServicio['mensaje'] = "Error al actualizar el registro";
           $respuestaServicio['btn_menu'] = 0;
           
        }else {
            
            $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
            $dataAct['modulo'] = "categoria";
            $dataAct['estado'] = $_REQUEST['categoria'];
            $resultRayosxCategoria = $this->xindustrial_model->actualizarModulo($dataAct);
            
            if($resultRayosxCategoria){
                                       
                   $rayosxCategoria = $this->xindustrial_model->rayosxCategoria($_REQUEST['id_tramite_rayosx']);
                   $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($_REQUEST['id_tramite_rayosx']);
                   
                   if(($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2) && count($rayosxEquipo) > 0){
                       
                       $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                       $dataAct['modulo'] = "modulo2";
                       $dataAct['estado'] = "1";
                       $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                       
                       $respuestaServicio['btn_menu'] = 1;
                   }else{
                       $respuestaServicio['btn_menu'] = 0;
                   }
                   
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Actualización exitosa";					
                   
               }else{
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Actualización exitosa";
                   $respuestaServicio['btn_menu'] = 0;
               }					 
   
        }
        
        echo json_encode($respuestaServicio);
   }
   
   public function editarEquipoRX() {
       
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
               $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
               redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
               exit;
        }else {
            
            $rayosxCategoria = $this->xindustrial_model->rayosxCategoria($_REQUEST['id_tramite_rayosx']);
            
            if($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2){
                $rayosxEquipo['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
                $rayosxEquipo['categoria1'] = $_REQUEST['categoria1'];
                $rayosxEquipo['categoria2'] = $_REQUEST['categoria2'];
                $rayosxEquipo['otro_equipo'] = $_REQUEST['otro_equipo'];
                $rayosxEquipo['tipo_visualizacion'] = $_REQUEST['tipo_visualizacion'];
                $rayosxEquipo['marca_equipo'] = $_REQUEST['marca_equipo'];
                $rayosxEquipo['modelo_equipo'] = $_REQUEST['modelo_equipo'];
                $rayosxEquipo['serie_equipo'] = $_REQUEST['serie_equipo'];
                $rayosxEquipo['marca_tubo_rx'] = $_REQUEST['marca_tubo_rx'];
                $rayosxEquipo['modelo_tubo_rx'] = $_REQUEST['modelo_tubo_rx'];
                $rayosxEquipo['serie_tubo_rx'] = $_REQUEST['serie_tubo_rx'];
                $rayosxEquipo['tension_tubo_rx'] = $_REQUEST['tension_tubo_rx'];
                $rayosxEquipo['contiene_tubo_rx'] = $_REQUEST['contiene_tubo_rx'];
                $rayosxEquipo['energia_fotones'] = $_REQUEST['energia_fotones'];
                $rayosxEquipo['energia_electrones'] = $_REQUEST['energia_electrones'];
                $rayosxEquipo['carga_trabajo'] = $_REQUEST['carga_trabajo'];
                $rayosxEquipo['ubicacion_equipo'] = $_REQUEST['ubicacion_equipo'];
                $rayosxEquipo['anio_fabricacion'] = $_REQUEST['anio_fabricacion'];
                $rayosxEquipo['anio_fabricacion_tubo'] = $_REQUEST['anio_fabricacion_tubo'];
                $rayosxEquipo['numero_permiso'] = $_REQUEST['numero_permiso'];		 
                $rayosxEquipo['estado'] = 1;
                
                $rayosxEquipo['created_at'] = date("Y-m-d H:i:s");
                $resultRayosxEquipo = $this->xindustrial_model->insertRayosxEquipo($rayosxEquipo);

                   if($resultRayosxEquipo){
                       
                       
                       /**
                       Cargar archivos del equipo
                       */						
                       $bandera = 1;
                       $documentos = array("fi_blindajes","fi_control_calidad", "fi_pruebas_caracterizacion", "fi_plano", "fi_manual","fi_ficha", "fi_estudio");
                       
                       for($i=0;$i<count($documentos);$i++){
                           if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

                               $nombre_archivo = $_REQUEST['id_tramite_rayosx']."-".$documentos[$i]."-".date('YmdHis');
                               $config['upload_path'] = "uploads/xindustrial/";
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

                               $resultadoIDDocumentoArc = $this->xindustrial_model->insertarArchivo($datosAr);
                               
                               if($resultadoIDDocumentoArc){
                                   
                                   $datosDoc['id_equipo_rayosx'] = $resultRayosxEquipo;
                                   $datosDoc['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
                                   $datosDoc['documento'] = $documentos[$i];
                                   $datosDoc['id_archivo'] = $resultadoIDDocumentoArc;
                                   
                                   $resultadoIDDocumentoCarga = $this->xindustrial_model->actualizarArchivoEquipo($datosDoc);
                                   
                               }
                           }
                       }

                       $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($_REQUEST['id_tramite_rayosx']);

                       if(($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2) && count($rayosxEquipo) > 0){

                           $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                           $dataAct['modulo'] = "modulo2";
                           $dataAct['estado'] = "1";
                           $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);

                           $respuestaServicio['btn_menu'] = 1;
                       }else{
                           $respuestaServicio['btn_menu'] = 0;
                       }

                       $this->session->set_flashdata('exito', 'Se realizo la actualización con exito</b>');
                       redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
                       exit;					

                   }else{
                       $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
                       redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
                       exit;
                   }
            }else{
               $this->session->set_flashdata('error', 'Debe guardar primero la categoria a la que pertenecen los equipos</b>');
               redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
               exit;
            } 	
        }

   }
       
   public function actualizarEquipoRX() {
       
       if($_REQUEST['id_tramite_rayosx'] == NULL || $_REQUEST['id_equipo_rayosx'] == NULL) {
           
               $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
               redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
               exit;
        }else {
            
            $rayosxCategoria = $this->xindustrial_model->rayosxCategoria($_REQUEST['id_tramite_rayosx']);
            
            if($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2){
                $rayosxEquipo['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
                $rayosxEquipo['id_equipo_rayosx'] = $_REQUEST['id_equipo_rayosx'];
                $rayosxEquipo['categoria1'] = $_REQUEST['categoria1_eq'.$_REQUEST['id_equipo_rayosx']];
                $rayosxEquipo['categoria2'] = $_REQUEST['categoria2_eq'.$_REQUEST['id_equipo_rayosx']];
                $rayosxEquipo['otro_equipo'] = $_REQUEST['otro_equipo_eq'.$_REQUEST['id_equipo_rayosx']];
                $rayosxEquipo['tipo_visualizacion'] = $_REQUEST['tipo_visualizacion'];
                $rayosxEquipo['marca_equipo'] = $_REQUEST['marca_equipo'];
                $rayosxEquipo['modelo_equipo'] = $_REQUEST['modelo_equipo'];
                $rayosxEquipo['serie_equipo'] = $_REQUEST['serie_equipo'];
                $rayosxEquipo['marca_tubo_rx'] = $_REQUEST['marca_tubo_rx'];
                $rayosxEquipo['modelo_tubo_rx'] = $_REQUEST['modelo_tubo_rx'];
                $rayosxEquipo['serie_tubo_rx'] = $_REQUEST['serie_tubo_rx'];
                $rayosxEquipo['tension_tubo_rx'] = $_REQUEST['tension_tubo_rx'];
                $rayosxEquipo['contiene_tubo_rx'] = $_REQUEST['contiene_tubo_rx'];
                $rayosxEquipo['energia_fotones'] = $_REQUEST['energia_fotones'];
                $rayosxEquipo['energia_electrones'] = $_REQUEST['energia_electrones'];
                $rayosxEquipo['carga_trabajo'] = $_REQUEST['carga_trabajo'];
                $rayosxEquipo['ubicacion_equipo'] = $_REQUEST['ubicacion_equipo'];
                $rayosxEquipo['anio_fabricacion'] = $_REQUEST['anio_fabricacion'];
                $rayosxEquipo['anio_fabricacion_tubo'] = $_REQUEST['anio_fabricacion_tubo'];
                $rayosxEquipo['numero_permiso'] = $_REQUEST['numero_permiso'];			 
                $rayosxEquipo['estado'] = 1;                 
                $rayosxEquipo['updated_at'] = date("Y-m-d H:i:s");
                $resultRayosxEquipo = $this->xindustrial_model->updateRayosxEquipo($rayosxEquipo);
                   
                   if($resultRayosxEquipo){
                       
                       /**
                       Cargar archivos del equipo
                       */						
                       $bandera = 1;
                       $documentos = array("fi_blindajes","fi_control_calidad", "fi_pruebas_caracterizacion", "fi_plano", "fi_manual","fi_ficha", "fi_estudio");
                       
                       for($i=0;$i<count($documentos);$i++){
                           
                           if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

                               $nombre_archivo = $_REQUEST['id_tramite_rayosx']."-".$documentos[$i]."-".date('YmdHis');
                               $config['upload_path'] = "uploads/xindustrial/";
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
                               
                               $resultadoIDDocumento = $this->xindustrial_model->insertarArchivo($datosAr);
                               
                               if($resultadoIDDocumento){
                                   
                                   $datosDoc['id_equipo_rayosx'] = $_REQUEST['id_equipo_rayosx'];
                                   $datosDoc['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
                                   $datosDoc['documento'] = $documentos[$i];
                                   $datosDoc['id_archivo'] = $resultadoIDDocumento;
                                   
                                   $resultadoIDDocumentoCarga = $this->xindustrial_model->actualizarArchivoEquipo($datosDoc);
                                   
                               }
                           }
                       }
                       
                       $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($_REQUEST['id_tramite_rayosx']);

                       if(($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2) && count($rayosxEquipo) > 0){

                           $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                           $dataAct['modulo'] = "modulo2";
                           $dataAct['estado'] = "1";
                           $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);

                           $respuestaServicio['btn_menu'] = 1;
                       }else{
                           $respuestaServicio['btn_menu'] = 0;
                       }

                       $this->session->set_flashdata('exito', 'Se realizo la actualización con exito</b>');
                       redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
                       exit;

                   }else{
                       $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
                       redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
                       exit;
                   }
            }else{
               $this->session->set_flashdata('error', 'Error al actualizar el registro</b>');
               redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
               exit;
            } 	
        }
   }	
       
   public function listarEquipos(){
       
       $rayosxEquipo = $this->xindustrial_model->rayosxEquipos($_REQUEST['id_tramite_rayosx']);
       $tramite_info = $this->xindustrial_model->tramite_info($_REQUEST['id_tramite_rayosx']);
                   
       if($rayosxEquipo){
           ?>
           <table class="table table-striped">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Marca Equipo</th>
                   <th>Modelo Equipo</th>
                   <th>Serie Equipo</th>										
                   <th>Ver más</th>
                   <th>Editar</th>
                   <th>Eliminar</th>
               </tr>
           </thead>
           <tbody>
           <?php
           for($i=0;$i<count($rayosxEquipo);$i++){
               ?>
               <tr>
                   <td><?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></td>
                   <td><?php echo $rayosxEquipo[$i]->marca_equipo?></td>
                   <td><?php echo $rayosxEquipo[$i]->modelo_equipo?></td>
                   <td><?php echo $rayosxEquipo[$i]->serie_equipo?></td>										
                   <td>
                       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                         Ver mas...
                       </button>
                   </td>
                   <td>
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                         Editar
                       </button>	
                   </td>
                   <td>
                       <a class="btn btn-danger" href="#" onClick="eliminarEquipo(<?php echo $rayosxEquipo[$i]->id_tramite_rayosx?>,<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">Eliminar</a>
                   </td>
               </tr>

               <!-- Modal -->
               <div class="modal fade" id="editarEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                       <div class="modal-content">	
                           <form id="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" action="<?php echo base_url('usuario/actualizarEquipoRX')?>" method="post" class="text-left border border-light formActEquipo" onsubmit="validarFormEquipoAct(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)" enctype="multipart/form-data">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Editar equipo <?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                           </div>
                           <div class="modal-body">
                               <?php
                               
                               if($tramite_info->categoria == 1){
                                   $vercateact1 = "block";
                                   $vercateact2 = "none";
                               }else if($tramite_info->categoria == 2){
                                   $vercateact1 = "none";
                                   $vercateact2 = "block";
                               }
                               
                               ?>
                               <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>"/>
                               <input id="id_equipo_rayosx" name="id_equipo_rayosx" type="hidden" value="<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>"/>
                                   <div class="row">
                                       <div class="col" style="display:<?php echo $vercateact1?>" id="div_categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <span class="text-orange">•</span><label for="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipos generadores de radicaci&oacute;n ionizante</label>
                                           <select id="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]" onchange="act_cambiacat1(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">
                                               <option value="">Seleccione...</option>
                                               <option value="1" <?php if($rayosxEquipo[$i]->categoria1 == 1){echo "selected";}?>>Radiolog&iacute;a odontol&oacute;gica periapical</option>
                                               <option value="2" <?php if($rayosxEquipo[$i]->categoria1 == 2){echo "selected";}?>>Equipo de RX</option>
                                           </select>
                                       </div>
                                       <div class="col" style="display:<?php echo $vercateact2?>" id="div_categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <label for="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipos generadores de radicaci&oacute;n ionizante</label>
                                           <select id="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]"  onchange="act_cambiacat2(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">
                                               <option value="">Seleccione...</option>
                                               <option value="1" <?php if($rayosxEquipo[$i]->categoria2 == 1){echo "selected";}?>>Radioterapia</option>
                                               <option value="2" <?php if($rayosxEquipo[$i]->categoria2 == 2){echo "selected";}?>>Radio diagn&oacute;stico de alta complejidad</option>
                                               <option value="3" <?php if($rayosxEquipo[$i]->categoria2 == 3){echo "selected";}?>>Radio diagn&oacute;stico de media complejidad</option>
                                               <option value="4" <?php if($rayosxEquipo[$i]->categoria2 == 4){echo "selected";}?>>Radio diagn&oacute;stico de baja complejidad</option>
                                               <option value="5" <?php if($rayosxEquipo[$i]->categoria2 == 5){echo "selected";}?>>Radiografias odontol&oacute;gicas pan&oacute;ramicas y tomografias orales</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="row">			
                                       <div class="col" style="display:<?php echo $vercateact1?>" id="div_categoria1-1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <label for="categoria1-1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Radiolog&iacute;a odontol&oacute;gica periapical</label>
                                           <select id="categoria1_1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria1_1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]">
                                               <option value="">Seleccione...</option>
                                               <option value="1" <?php if($rayosxEquipo[$i]->categoria1_1 == 1){echo "selected";}?>>Equipo de RX odontol&oacute;gico periapical</option>
                                               <option value="2" <?php if($rayosxEquipo[$i]->categoria1_1 == 2){echo "selected";}?>>Equipo de RX odontol&oacute;gico periapical portat&iacute;l</option>
                                           </select>
                                       </div>
                                       <div class="col" style="display:<?php echo $vercateact1?>" id="div_categoria1-2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <label for="categoria1-2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipo de RX</label>
                                           <select id="categoria1_2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria1_2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]">
                                               <option value="">Seleccione...</option>
                                               <option value="1" <?php if($rayosxEquipo[$i]->categoria1_2 == 1){echo "selected";}?>>Densit&oacute;metro &oacute;seo</option>
                                           </select>
                                       </div>
                                       <div class="col" style="display:<?php echo $vercateact2?>" id="div_categoria2-1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <label for="categoria2_1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipo de RX</label>
                                           <select id="categoria2_1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria2_1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]" onchange="act_cambiacat2_1(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">
                                               <option value="">Seleccione...</option>
                                               <option value="1" <?php if($rayosxEquipo[$i]->categoria2_1 == 1){echo "selected";}?>>Equipo de RX convencional</option>
                                               <option value="2" <?php if($rayosxEquipo[$i]->categoria2_1 == 2){echo "selected";}?>>Tomógrafo Odontológico</option>
                                               <option value="3" <?php if($rayosxEquipo[$i]->categoria2_1 == 3){echo "selected";}?>>Tomógrafo</option>
                                               <option value="4" <?php if($rayosxEquipo[$i]->categoria2_1 == 4){echo "selected";}?>>Equipo de RX Portátil</option>
                                               <option value="5" <?php if($rayosxEquipo[$i]->categoria2_1 == 5){echo "selected";}?>>Equipo de RX Odontológico</option>
                                               <option value="6" <?php if($rayosxEquipo[$i]->categoria2_1 == 6){echo "selected";}?>>Panorámico Cefálico</option>
                                               <option value="7" <?php if($rayosxEquipo[$i]->categoria2_1 == 7){echo "selected";}?>>Fluoroscopio</option>
                                               <option value="8" <?php if($rayosxEquipo[$i]->categoria2_1 == 8){echo "selected";}?>>SPECT-CT</option>
                                               <option value="9" <?php if($rayosxEquipo[$i]->categoria2_1 == 9){echo "selected";}?>>Arco en C</option>
                                               <option value="10" <?php if($rayosxEquipo[$i]->categoria2_1 == 10){echo "selected";}?>>Mamógrafo</option>
                                               <option value="11" <?php if($rayosxEquipo[$i]->categoria2_1 == 11){echo "selected";}?>>Litotriptor</option>
                                               <option value="12" <?php if($rayosxEquipo[$i]->categoria2_1 == 12){echo "selected";}?>>Angiógrafo</option>
                                               <option value="13" <?php if($rayosxEquipo[$i]->categoria2_1 == 13){echo "selected";}?>>PET-CT</option>
                                               <option value="14" <?php if($rayosxEquipo[$i]->categoria2_1 == 14){echo "selected";}?>>Acelerador lineal</option>
                                               <option value="15" <?php if($rayosxEquipo[$i]->categoria2_1 == 15){echo "selected";}?>>Sistema de radiocirugia robótica</option>
                                               <option value="16" <?php if($rayosxEquipo[$i]->categoria2_1 == 16){echo "selected";}?>>Otro</option>
                                           </select>
                                       </div>
                                       <div class="col" style="display:none" id="div_categoria2-1-otro_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                                           <label for="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Otro equipo de RX</label>
                                           <input id="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" placeholder="Otro equipo" class="form-control input-md validate[minSize[4], maxSize[100]]"  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
                                       </div>	
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                           <label for="tipo_visualizacion">Tipo de visualización de la imagen</label>
                                           <select id="tipo_visualizacion" name="tipo_visualizacion" class="form-control validate[required]" required>
                                              <option value="1" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 1){echo "selected";}?>>Digital</option>
                                              <option value="2" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 2){echo "selected";}?>>Digitalizado</option>
                                              <option value="3" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 3){echo "selected";}?>>Análogo</option>
                                              <option value="4" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 4){echo "selected";}?>>Revelado Automático</option>
                                              <option value="5" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 5){echo "selected";}?>>Revelado Manual</option>
                                              <option value="6" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 6){echo "selected";}?>>Monitor Análogo</option>
                                              <option value="7" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 7){echo "selected";}?>>No Aplica</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                          <label for="marca_equipo">Marca equipo</label>
                                          <input id="marca_equipo" value="<?php if($rayosxEquipo[$i]->marca_equipo != ''){echo $rayosxEquipo[$i]->marca_equipo;}?>" name="marca_equipo" placeholder="Ingresar Marca equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>
                                       <div class="col">
                                          <label for="modelo_equipo">Modelo equipo</label>
                                          <input id="modelo_equipo" value="<?php if($rayosxEquipo[$i]->modelo_equipo != ''){echo $rayosxEquipo[$i]->modelo_equipo;}?>" name="modelo_equipo" placeholder="Ingresar Modelo equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"   onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>
                                       <div class="col">
                                          <label for="serie_equipo">Serie equipo</label>
                                          <input id="serie_equipo" value="<?php if($rayosxEquipo[$i]->serie_equipo != ''){echo $rayosxEquipo[$i]->serie_equipo;}?>" name="serie_equipo" placeholder="Ingresar Serie equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>			
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                          <label for="marca_tubo_rx">Marca tubo RX</label>
                                          <input id="marca_tubo_rx" value="<?php if($rayosxEquipo[$i]->marca_tubo_rx != ''){echo $rayosxEquipo[$i]->marca_tubo_rx;}?>" name="marca_tubo_rx" placeholder="Ingresar Marca tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]" required type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>

                                       <div class="col">
                                          <label for="modelo_tubo_rx">Modelo tubo RX</label>
                                          <input id="modelo_tubo_rx" value="<?php if($rayosxEquipo[$i]->modelo_tubo_rx != ''){echo $rayosxEquipo[$i]->modelo_tubo_rx;}?>" name="modelo_tubo_rx" placeholder="Ingresar Modelo tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>

                                       <div class="col">
                                          <label for="serie_tubo_rx">Serie tubo RX</label>
                                          <input id="serie_tubo_rx" value="<?php if($rayosxEquipo[$i]->serie_tubo_rx != ''){echo $rayosxEquipo[$i]->serie_tubo_rx;}?>" name="serie_tubo_rx" placeholder="Ingresar Serie tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                          <label for="tension_tubo_rx">Tensión máxima tubo RX [kV]</label>
                                          <input id="tension_tubo_rx" value="<?php if($rayosxEquipo[$i]->tension_tubo_rx != ''){echo $rayosxEquipo[$i]->tension_tubo_rx;}?>" name="tension_tubo_rx" placeholder="Ingresar Tensión máxima tubo RX [kV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]"  required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;" >
                                       </div>
                                       <div class="col">
                                          <label for="contiene_tubo_rx">Corriente Max del tubo RX [mA]</label>
                                          <input id="contiene_tubo_rx" value="<?php if($rayosxEquipo[$i]->contiene_tubo_rx != ''){echo $rayosxEquipo[$i]->contiene_tubo_rx;}?>" name="contiene_tubo_rx" placeholder="Ingresar corriente máxima del tubo RX [mA]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                       </div>
                                       <div class="col">
                                          <label for="energia_fotones">Energ&iacute;a de fotones [MeV]</label>
                                          <input id="energia_fotones" value="<?php if($rayosxEquipo[$i]->energia_fotones != ''){echo $rayosxEquipo[$i]->energia_fotones;}?>" name="energia_fotones" placeholder="Ingresar Energ&iacute;a de fotones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                          <label for="energia_electrones">Energ&iacute;a de electrones [MeV]</label>
                                          <input id="energia_electrones" value="<?php if($rayosxEquipo[$i]->energia_electrones != ''){echo $rayosxEquipo[$i]->energia_electrones;}?>" name="energia_electrones" placeholder="Ingresar Energ&iacute;a de electrones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                       </div>
                                       <div class="col">
                                          <label for="carga_trabajo">Carga de trabajo [mA.min/semana]</label>
                                          <input id="carga_trabajo" value="<?php if($rayosxEquipo[$i]->carga_trabajo != ''){echo $rayosxEquipo[$i]->carga_trabajo;}?>" name="carga_trabajo" placeholder="Ingresar Carga de trabajo [mA.min/semana]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any"    min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                       </div>
                                       <div class="col">
                                           <label for="ubicacion_equipo">Ubicación del equipo de la instalación</label>
                                           <input id="ubicacion_equipo" value="<?php if($rayosxEquipo[$i]->ubicacion_equipo != ''){echo $rayosxEquipo[$i]->ubicacion_equipo;}?>" name="ubicacion_equipo" placeholder="Ingresar Ubicación del equipo de la instalación" class="form-control input-md validate[required, minSize[4], maxSize[100]]" required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col">
                                          <label for="anio_fabricacion">A&ntilde;o de fabricación del equipo</label>
                                          <input id="anio_fabricacion" value="<?php if($rayosxEquipo[$i]->anio_fabricacion != ''){echo $rayosxEquipo[$i]->anio_fabricacion;}?>" name="anio_fabricacion" placeholder="Ingresar A&ntilde;o de fabricación del equipo" class="form-control input-md validate[custom[number], minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]" onKeyPress="if(this.value.length==4) return false;">
                                       </div>
                                       <div class="col">
                                          <label for="anio_fabricacion_tubo">A&ntilde;o de fabricación del tubo</label>
                                          <input id="anio_fabricacion_tubo" value="<?php if($rayosxEquipo[$i]->anio_fabricacion_tubo != ''){echo $rayosxEquipo[$i]->anio_fabricacion_tubo;}?>" name="anio_fabricacion_tubo" placeholder="Ingresar A&ntilde;o de fabricación del tubo" class="form-control input-md validate[custom[number], minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]]" onKeyPress="if(this.value.length==4) return false;">
                                       </div>
                                       <div class="col" id="div_numpermiso">
                                          <label for="numero_permiso">Número de permiso de comercialización</label>
                                          <input id="numero_permiso" value="<?php if($rayosxEquipo[$i]->numero_permiso != ''){echo $rayosxEquipo[$i]->numero_permiso;}?>" name="numero_permiso" placeholder="Ingresar Número de permiso de comercialización" class="form-control input-md validate[minSize[4], maxSize[30]]" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                       </div>
                                   </div>
                                   <div class="row justify-content-md-center">
                                       <div class="col-md-10">
                                           <div class="row bg-light text-dark">
                                               <div class="col-md-4">
                                                   Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_blindajes != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_blindajes);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_blindajes" name="fi_blindajes" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-4">
                                                   Informe sobre los resultados del control de calidad
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_control_calidad != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_control_calidad);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_control_calidad" name="fi_control_calidad" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <div class="row bg-light text-dark">
                                               <div class="col-md-4">
                                                   Plano general de las instalaciones
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_plano != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_plano);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_plano" name="fi_plano" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <?php
                                           if($tramite_info->categoria == 1){
                                           ?>
                                           <div class="row">
                                               <div class="col-md-4">
                                                   Pruebas iniciales de caracterización de los equipos o licencia anterior
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_pruebas_caracterizacion != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_pruebas_caracterizacion);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_pruebas_caracterizacion" name="fi_pruebas_caracterizacion" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <?php
                                           }
                                           ?>	
                                       </div>										
                                   </div>
                                   <?php
                                   if($rayosxEquipo[$i]->categoria2_1 == 16){
                                       $vertubo2 = "block";
                                   }else{
                                       $vertubo2 = "none";
                                   }
                                   ?>	
                                   <div class="row" id="div_info_tubo2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" style="display:<?php echo $vertubo2?>">	
                                       <div class="subtitle text-left">
                                           <h3><b>Descripción tubo Rx 2:</b></h3>
                                       </div>
                                       <div class="row">
                                           <div class="col">
                                              <label for="marca_tubo_rx2">Marca tubo RX</label>
                                              <input id="marca_tubo_rx2" name="marca_tubo_rx2" placeholder="Ingresar Marca tubo RX" class="form-control input-md validate[minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                           </div>

                                           <div class="col">
                                              <label for="modelo_tubo_rx2">Modelo tubo RX</label>
                                              <input id="modelo_tubo_rx2" name="modelo_tubo_rx2" placeholder="Ingresar Modelo tubo RX" class="form-control input-md validate[minSize[4], maxSize[30]]"    type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                           </div>

                                           <div class="col">
                                              <label for="serie_tubo_rx2">Serie tubo RX</label>
                                              <input id="serie_tubo_rx2" name="serie_tubo_rx2" placeholder="Ingresar Serie tubo RX" class="form-control input-md validate[minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col">
                                              <label for="tension_tubo_rx2">Tensión máxima tubo RX [kV]</label>
                                              <input id="tension_tubo_rx2" name="tension_tubo_rx2" placeholder="Ingresar Tensión máxima tubo RX [kV]" class="form-control input-md validate[custom[number], minSize[1], maxSize[4]]"   step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;" >
                                           </div>

                                           <div class="col">
                                              <label for="contiene_tubo_rx2">Corriente Max del tubo RX [mA]</label>
                                              <input id="contiene_tubo_rx2" name="contiene_tubo_rx2" placeholder="Ingresar corriente máxima del tubo RX [mA]" class="form-control input-md validate[custom[number], minSize[1], maxSize[4]]"  step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                           </div>

                                           <div class="col">
                                              <label for="energia_fotones2">Energ&iacute;a de fotones [MeV]</label>
                                              <input id="energia_fotones2" name="energia_fotones2" placeholder="Ingresar Energ&iacute;a de fotones [MeV]" class="form-control input-md validate[custom[number], minSize[1], maxSize[3]]"  step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col">
                                              <label for="energia_electrones2">Energ&iacute;a de electrones [MeV]</label>
                                              <input id="energia_electrones2" name="energia_electrones2" placeholder="Ingresar Energ&iacute;a de electrones [MeV]" class="form-control input-md validate[custom[number], minSize[1], maxSize[3]]"  step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                           </div>

                                           <div class="col">
                                              <label for="carga_trabajo2">Carga de trabajo [mA.min/semana]</label>
                                              <input id="carga_trabajo2" name="carga_trabajo2" placeholder="Ingresar Carga de trabajo [mA.min/semana]" class="form-control input-md validate[custom[number],  minSize[1], maxSize[4]]"  step="any"    min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
                                           </div>
                                           <div class="col">
                                              <label for="anio_fabricacion_tubo2">A&ntilde;o de fabricación del tubo</label>
                                              <input id="anio_fabricacion_tubo2" name="anio_fabricacion_tubo2" placeholder="Ingresar A&ntilde;o de fabricación del tubo" class="form-control input-md validate[custom[number], minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]]" onKeyPress="if(this.value.length==4) return false;">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row" id="div_doc_tubo2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" style="display:<?php echo $vertubo2?>">
                                       <div class="row justify-content-md-center">
                                       <div class="col-md-10">
                                           <div class="row bg-light text-dark">
                                               <div class="col-md-4">
                                                   Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_blindajes2 != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_blindajes2);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_blindajes2" name="fi_blindajes2" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-4">
                                                   Informe sobre los resultados del control de calidad
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_control_calidad2 != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_control_calidad2);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_control_calidad2" name="fi_control_calidad2" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <?php
                                           if($tramite_info->categoria == 1){
                                           ?>
                                           <div class="row">
                                               <div class="col-md-4">
                                                   Pruebas iniciales de caracterización de los equipos o licencia anterior
                                               </div>
                                               <div class="col">
                                               <?php
                                                   if($rayosxEquipo[$i]->fi_pruebas_caracterizacion2 != ''){
                                                       $resultado_archivo = $this->validacion_model->consultar_archivo($rayosxEquipo[$i]->fi_pruebas_caracterizacion2);
                                                       ?>
                                                       <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                                           <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                       </a>
                                                       <?php
                                                   }else{
                                                       echo "Sin archivo";
                                                   }
                                               ?>
                                               </div>
                                               <div class="col">
                                                   <input id="fi_pruebas_caracterizacion2" name="fi_pruebas_caracterizacion2" type="file" class="form-control-file archivopdf validate[required]">
                                               </div>
                                           </div>
                                           <?php
                                           }
                                           ?>	
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                               <button type="submit" class="btn btn-primary">Actualizar</button>
                           </div>
                       </form>							
                       </div>
                   </div>
               </div>
               
               <div class="modal fade" id="verEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                       <div class="modal-content">	
                           <form id="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" action="<?php echo base_url('usuario/actualizarEquipoRX')?>" method="post" class="text-left border border-light formActEquipo" onsubmit="validarFormEquipoAct(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)" enctype="multipart/form-data">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Ver equipo <?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                           </div>
                           <div class="modal-body">
                               <p><h2><b>Equipo ID:<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></b></h2></p>
                                   <ul>
                                       <?php
                                                   if($rayosxEquipo[$i]->categoria1 != 0 || $rayosxEquipo[$i]->categoria1 != NULL){
                                                       if($rayosxEquipo[$i]->categoria1 == 1){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radiolog&iacute;a odontol&oacute;gica periapical</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria1 == 2){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de RX</li>
                                                           <?php
                                                       }
                                                   }
                                              
                                                   if($rayosxEquipo[$i]->categoria2 != 0 || $rayosxEquipo[$i]->categoria2 != NULL){
                                                       if($rayosxEquipo[$i]->categoria2 == 1){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radioterapia</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2 == 2){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de alta complejidad</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2 == 3){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de media complejidad</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2 == 4){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de baja complejidad</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2 == 5){
                                                           ?>
                                                           <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radiografias odontol&oacute;gicas pan&oacute;ramicas y tomografias orales</li>
                                                           <?php
                                                       }
                                                   }
                                       
                                                   if($rayosxEquipo[$i]->categoria1_1 != 0 || $rayosxEquipo[$i]->categoria1_1 != NULL){
                                                       if($rayosxEquipo[$i]->categoria1_1 == 1){
                                                           ?>
                                                           <li><b>Radiolog&iacute;a odontol&oacute;gica periapical: </b>Equipo de RX odontol&oacute;gico periapical</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria1_1 == 2){
                                                           ?>
                                                           <li><b>Radiolog&iacute;a odontol&oacute;gica periapical: </b>Equipo de RX odontol&oacute;gico periapical portat&iacute;l</li>
                                                           <?php
                                                       }
                                                   }
                                       
                                                   if($rayosxEquipo[$i]->categoria1_2 != 0 || $rayosxEquipo[$i]->categoria1_2 != NULL){
                                                       if($rayosxEquipo[$i]->categoria1_2 == 1){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Densit&oacute;metro &oacute;seo</li>
                                                           <?php
                                                       }
                                                   }
                                                   
                                                   if($rayosxEquipo[$i]->categoria2_1 != 0 || $rayosxEquipo[$i]->categoria2_1 != NULL){
                                                       if($rayosxEquipo[$i]->categoria2_1 == 1){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Equipo de RX convencional</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 2){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Tomógrafo Odontológico</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 3){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Tomógrafo</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 4){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Equipo de RX Portátil</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 5){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Equipo de RX Odontológico</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 6){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Panorámico Cefálico</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 7){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Fluoroscopio</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 8){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>SPECT-CT</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 9){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Arco en C</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 10){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Mamógrafo</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 11){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Litotriptor</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 12){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Angiógrafo</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 13){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>PET-CT</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 14){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Acelerador lineal</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 15){
                                                           ?>
                                                           <li><b>Equipo de RX: </b>Sistema de radiocirugia robótica</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->categoria2_1 == 16){
                                                           ?>
                                                           <li><b>Equipo de RX: </b><?php echo $rayosxEquipo[$i]->otro_equipo?></li>
                                                           <?php
                                                       }
                                                   }					
                                       
                                                   if($rayosxEquipo[$i]->tipo_visualizacion != 0 || $rayosxEquipo[$i]->tipo_visualizacion != NULL){
                                                       if($rayosxEquipo[$i]->tipo_visualizacion == 1){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Digital</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 2){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Digitalizado</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 3){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Análogo</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 4){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Revelado Automático</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 5){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Revelado Manual</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 6){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>Monitor Análogo</li>
                                                           <?php
                                                       }else if($rayosxEquipo[$i]->tipo_visualizacion == 7){
                                                           ?>
                                                           <li><b>Tipo de visualización de la imagen: </b>No Aplica</li>
                                                           <?php
                                                       }
                                                   }
                                               ?>
                                       <li><b>Marca Equipo: </b><?php echo $rayosxEquipo[$i]->marca_equipo?></li>
                                       <li><b>Modelo Equipo: </b><?php echo $rayosxEquipo[$i]->modelo_equipo?></li>
                                       <li><b>Serie Equipo: </b><?php echo $rayosxEquipo[$i]->serie_equipo?></li>
                                       <li><b>Marca Tubo RX: </b><?php echo $rayosxEquipo[$i]->marca_tubo_rx?></li>
                                       <li><b>Modelo Tubo RX: </b><?php echo $rayosxEquipo[$i]->modelo_tubo_rx?></li>
                                       <li><b>Serie Tubo RX: </b><?php echo $rayosxEquipo[$i]->serie_tubo_rx?></li>
                                       <li><b>Tensión máxima tubo RX [kV]: </b><?php echo $rayosxEquipo[$i]->tension_tubo_rx?></li>
                                       <li><b>Cont. Max del tubo RX [mA]: </b><?php echo $rayosxEquipo[$i]->contiene_tubo_rx?></li>
                                       <li><b>Energía de fotones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_fotones?></li>
                                       <li><b>Energía de electrones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_electrones?></li>
                                       <li><b>Carga de trabajo [mA.min/semana]: </b><?php echo $rayosxEquipo[$i]->carga_trabajo?></li>
                                       <li><b>Ubicación del equipo de la instalación: </b><?php echo $rayosxEquipo[$i]->ubicacion_equipo?></li>
                                       <li><b>Año de fabricación del equipo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion?></li>
                                       <li><b>Año de fabricación del tubo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion_tubo?></li>
                                       
                                       <?php
                                           
                                           if($rayosxEquipo[$i]->fi_blindajes != ''){
                                                   $fi_blindajes = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_blindajes);
                                                   
                                                   if($fi_blindajes){
                                                       ?>
                                                       <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_blindajes->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                       <?php
                                                   }else{
                                                       ?>
                                                       <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
                                                       <?php
                                                   }		
                                               }else{
                                                   ?>
                                                   <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
                                                   <?php
                                               }
                                               
                                               
                                               
                                               if($rayosxEquipo[$i]->fi_control_calidad != ''){
                                                   $fi_control_calidad = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_control_calidad);
                                                   
                                                   if($fi_control_calidad){
                                                       ?>
                                                       <li><b>Informe sobre los resultados del control de calidad: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_control_calidad->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                       <?php
                                                   }else{
                                                       ?>
                                                       <li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
                                                       <?php
                                                   }
                                               }else{
                                                   ?>
                                                   <li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
                                                   <?php
                                               }	

                                               if($rayosxEquipo[$i]->fi_plano != ''){
                                                   $fi_plano = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_plano);
                                                   
                                                   if($fi_plano){
                                                       ?>
                                                       <li><b>Plano general de las instalaciones: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_plano->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                       <?php
                                                   }else{
                                                       ?>
                                                       <li><b>Plano general de las instalaciones: </b> Sin archivo disponible</li>		
                                                       <?php
                                                   }
                                               }else{
                                                   ?>
                                                   <li><b>Plano general de las instalaciones: </b> Sin archivo disponible</li>		
                                                   <?php
                                               }		
                                               
                                               if($rayosxEquipo[$i]->fi_pruebas_caracterizacion != ''){
                                                   $fi_pruebas_caracterizacion = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_pruebas_caracterizacion);
                                                   
                                                   if($fi_pruebas_caracterizacion){
                                                       ?>
                                                       <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_pruebas_caracterizacion->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                       <?php
                                                   }else{
                                                       ?>
                                                       <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior:  </b> Sin archivo disponible</li>		
                                                       <?php
                                                   }
                                               }else{
                                                   ?>
                                                   <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b> Sin archivo disponible</li>		
                                                   <?php
                                               }		
                                       
                                           if($rayosxEquipo[$i]->categoria2_1 == 16){
                                               
                                               ?>
                                               <h3>Información Tubo RX 2</h3>
                                               
                                               <li><b>Marca Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->marca_tubo_rx2?></li>
                                               <li><b>Modelo Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->modelo_tubo_rx2?></li>
                                               <li><b>Serie Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->serie_tubo_rx2?></li>
                                               <li><b>Tensión máxima tubo 2 RX [kV]: </b><?php echo $rayosxEquipo[$i]->tension_tubo_rx2?></li>
                                               <li><b>Cont. Max del tubo 2 RX [mA]: </b><?php echo $rayosxEquipo[$i]->contiene_tubo_rx2?></li>
                                               <li><b>Energía de fotones 2 [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_fotones2?></li>
                                               <li><b>Energía de electrones 2 [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_electrones2?></li>
                                               <li><b>Carga de trabajo 2 [mA.min/semana]: </b><?php echo $rayosxEquipo[$i]->carga_trabajo2?></li>
                                               <li><b>Año de fabricación del tubo2: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion_tubo2?></li>
                                               <?php
                                                                               
                                               if($rayosxEquipo[$i]->fi_blindajes2 != ''){
                                                       $fi_blindajes2 = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_blindajes2);
                                                       
                                                       if($fi_blindajes2){
                                                           ?>
                                                           <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_blindajes2->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                           <?php
                                                       }else{
                                                           ?>
                                                           <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
                                                           <?php
                                                       }		
                                                   }else{
                                                       ?>
                                                       <li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
                                                       <?php
                                                   }
                                                   
                                                   if($rayosxEquipo[$i]->fi_control_calidad2 != ''){
                                                       $fi_control_calidad2 = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_control_calidad2);
                                                       
                                                       if($fi_control_calidad2){
                                                           ?>
                                                           <li><b>Informe sobre los resultados del control de calidad: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_control_calidad2->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                           <?php
                                                       }else{
                                                           ?>
                                                           <li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
                                                           <?php
                                                       }
                                                   }else{
                                                       ?>
                                                       <li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
                                                       <?php
                                                   }	

                                                   
                                                   if($rayosxEquipo[$i]->fi_pruebas_caracterizacion2 != ''){
                                                       $fi_pruebas_caracterizacion2 = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_pruebas_caracterizacion2);
                                                       
                                                       if($fi_pruebas_caracterizacion2){
                                                           ?>
                                                           <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_pruebas_caracterizacion2->nombre);?>" target="_blank">Ver archivo</a></li>		
                                                           <?php
                                                       }else{
                                                           ?>
                                                           <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior:  </b> Sin archivo disponible</li>		
                                                           <?php
                                                       }
                                                   }else{
                                                       ?>
                                                       <li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b> Sin archivo disponible</li>		
                                                       <?php
                                                   }
                                           
                                               
                                           }
                                       ?>
                                   </ul>					  
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                           </div>
                       </form>							
                       </div>
                   </div>
               </div>
                                               
               <div id="ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="modal">
                 
               </div>
               <?php
           }
           ?>								
           </tbody>
       </table>
           <?php
       }else{
           echo "<p>Sin datos</p>";
       }	
   }
   
   public function eliminarEquipo(){
       
       if(isset($_REQUEST['id_tramite_rayosx']) && isset($_REQUEST['id_equipo_rayosx'])){
           
           $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($_REQUEST['id_tramite_rayosx']);
           
           if(count($rayosxEquipo)>1){
               $dataAct['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
               $dataAct['id_equipo_rayosx'] = $_REQUEST['id_equipo_rayosx'];
               
               $resultRayosxEquipo = $this->xindustrial_model->eliminarEquipo($dataAct);
               
               $rayosxCategoria = $this->xindustrial_model->rayosxCategoria($_REQUEST['id_tramite_rayosx']);
               
               $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($_REQUEST['id_tramite_rayosx']);

               if(($rayosxCategoria->categoria == 1 || $rayosxCategoria->categoria == 2) && count($rayosxEquipo) > 0){

                   $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                   $dataAct['modulo'] = "modulo2";
                   $dataAct['estado'] = "1";
                   $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);

                   $respuestaServicio['btn_menu'] = 1;
               }else{
                   $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                   $dataAct['modulo'] = "modulo2";
                   $dataAct['estado'] = "0";
                   $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                   $respuestaServicio['btn_menu'] = 0;
               }
               
               if($resultRayosxEquipo){
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Se elimino el equipo seleccionado";
               }else{
                   $respuestaServicio['estado'] = "ERROR";
                   $respuestaServicio['mensaje'] = "No fue posible ejecutar la operación";
               }
           }else{
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "No fue posible eliminar el equipo, debe existir al menos un equipo para continuar el tramite";
           }
           
           echo json_encode($respuestaServicio);
       }
   }
   
   public function editarOficialToeRX() {
       
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "Error al guardar la información";
               $respuestaServicio['btn_menu'] = 0;
        }else {
                         
            $rayosxEncargado['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
            $rayosxEncargado['encargado_pnombre'] = $_REQUEST['encargado_pnombre'];
            $rayosxEncargado['encargado_snombre'] = $_REQUEST['encargado_snombre'];
            $rayosxEncargado['encargado_papellido'] = $_REQUEST['encargado_papellido'];
            $rayosxEncargado['encargado_sapellido'] = $_REQUEST['encargado_sapellido'];
            $rayosxEncargado['encargado_tdocumento'] = $_REQUEST['encargado_tdocumento'];
            $rayosxEncargado['encargado_ndocumento'] = $_REQUEST['encargado_ndocumento'];
            $rayosxEncargado['encargado_lexpedicion'] = $_REQUEST['encargado_lexpedicion'];
            $rayosxEncargado['encargado_correo'] = $_REQUEST['encargado_correo'];
            $rayosxEncargado['encargado_nivel'] = $_REQUEST['encargado_nivel'];
            $rayosxEncargado['encargado_profesion'] = $_REQUEST['encargado_profesion'];
            //$rayosxEncargado['estado'] = 1;
            
            if($_REQUEST['id_encargado_rayosx'] != ''){
                
                $rayosxEncargado['id_encargado_rayosx'] = $_REQUEST['id_encargado_rayosx'];
                //$rayosxEncargado['updated_at'] = date("Y-m-d H:i:s");
                $resultRayosxEncargado = $this->xindustrial_model->updateRayosxEncargado($rayosxEncargado);
            }else{
                //$rayosxEncargado['created_at'] = date("Y-m-d H:i:s");
                $resultRayosxEncargado = $this->xindustrial_model->insertRayosxEncargado($rayosxEncargado);
            }

               if($resultRayosxEncargado){
                   
                   $rayosxOficialToe = $this->xindustrial_model->rayosxOficialToe($_REQUEST['id_tramite_rayosx']);
                   $rayosxTemporalToe = $this->xindustrial_model->rayosxTemporalToe($_REQUEST['id_tramite_rayosx']);
                   
                   if($rayosxOficialToe != NULL && $rayosxTemporalToe != NULL){
                       
                       $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                       $dataAct['modulo'] = "modulo3";
                       $dataAct['estado'] = "1";
                       $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                       
                       $respuestaServicio['btn_menu'] = 1;
                   }else{
                       $respuestaServicio['btn_menu'] = 0;
                   }
                   
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Actualización exitosa";
                                       
               }else{
                   $respuestaServicio['estado'] = "ERROR";
                   $respuestaServicio['mensaje'] = "Error al actualizar el registro";					
               }					 
   
        }
        echo json_encode($respuestaServicio);
   }
   
   public function editarTrabajadorToeRX() {
       
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "Error al guardar la información";
               $respuestaServicio['btn_menu'] = 0;
        }else {
            
            $rayosxEquipo['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
            $rayosxEquipo['toe_pnombre'] = $_REQUEST['toe_pnombre'];
            $rayosxEquipo['toe_snombre'] = $_REQUEST['toe_snombre'];
            $rayosxEquipo['toe_papellido'] = $_REQUEST['toe_papellido'];
            $rayosxEquipo['toe_sapellido'] = $_REQUEST['toe_sapellido'];
            $rayosxEquipo['toe_correo'] = $_REQUEST['toe_correo'];
            $rayosxEquipo['toe_tdocumento'] = $_REQUEST['toe_tdocumento'];
            $rayosxEquipo['toe_ndocumento'] = $_REQUEST['toe_ndocumento'];
            $rayosxEquipo['toe_lexpedicion'] = $_REQUEST['toe_lexpedicion'];
            $rayosxEquipo['toe_nivel'] = $_REQUEST['toe_nivel'];
            $rayosxEquipo['toe_profesion'] = $_REQUEST['toe_profesion'];
            $rayosxEquipo['toe_ult_entrenamiento'] = $_REQUEST['toe_ult_entrenamiento'];
            $rayosxEquipo['toe_pro_entrenamiento'] = $_REQUEST['toe_pro_entrenamiento'];
            $rayosxEquipo['toe_registro'] = $_REQUEST['toe_registro'];
            
            /*if($_REQUEST['id_categoria_rayosx'] != ''){
                
                $rayosxEquipo['id_categoria_rayosx'] = $_REQUEST['id_categoria_rayosx'];
                $rayosxEquipo['updated_at'] = date("Y-m-d H:i:s");
                $resultRayosxCategoria = $this->xindustrial_model->updateRayosxTemporalToe($rayosxEquipo);
            }else{*/
                $rayosxEquipo['created_at'] = date("Y-m-d H:i:s");
                $resultRayosxTemporalToe = $this->xindustrial_model->insertRayosxTemporalToe($rayosxEquipo);
            //}

               if($resultRayosxTemporalToe){
                   
                   $rayosxOficialToe = $this->xindustrial_model->rayosxOficialToe($_REQUEST['id_tramite_rayosx']);
                   $rayosxTemporalToe = $this->xindustrial_model->rayosxTemporalToe($_REQUEST['id_tramite_rayosx']);
                   
                   if($rayosxOficialToe != NULL && $rayosxTemporalToe != NULL){
                       
                       $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                       $dataAct['modulo'] = "modulo3";
                       $dataAct['estado'] = "1";
                       $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                       
                       $respuestaServicio['btn_menu'] = 1;
                   }else{
                       $respuestaServicio['btn_menu'] = 0;
                   }
                   
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Trabajador agregado con exito";

                   
               }else{
                   $respuestaServicio['estado'] = "ERROR";
                   $respuestaServicio['mensaje'] = "Error al actualizar el registro";						
               }					 
   
        }
        echo json_encode($respuestaServicio);
		$this->session->set_flashdata('exito', 'Se realizo la actualización con exito</b>');
		redirect(base_url('xindustrial/rx_editarForm/'.$_REQUEST['id_tramite_rayosx']), 'refresh');
        exit;					

   }
   
   public function listarTrabajadores(){
       
       $rayosxTemporalToe = $this->xindustrial_model->rayosxTemporalToe($_REQUEST['id_tramite_rayosx']);
                   
       if($rayosxTemporalToe){
           ?>
           <table class="display nowrap table table-hover">
              <thead>
                 <tr>
                    <th>ID</th>
                    <th>Número Identificación</th>
                    <th>Nombres y Apellidos </th>
                    <th>Ver Más</th>
                    <th>Eliminar</th>
                 </tr>
              </thead>

           <tbody>
           <?php 
           if(isset($rayosxTemporalToe)){
               for($i=0;$i<count($rayosxTemporalToe);$i++){
                   ?>
                   <tr>
                       <td><?php echo $rayosxTemporalToe[$i]->id_toe_rayosx;?></td>
                       <td><?php echo $rayosxTemporalToe[$i]->toe_ndocumento;?></td>
                       <td><?php echo $rayosxTemporalToe[$i]->toe_pnombre;?> <?php echo $rayosxTemporalToe[$i]->toe_snombre;?> <?php echo $rayosxTemporalToe[$i]->toe_papellido;?> <?php echo $rayosxTemporalToe[$i]->toe_sapellido;?></td>
                       <td>
                           <a class="btn btn-success"  onClick="abrirModal('TOE ID: <?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>','#modalToe<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>')">Ver más...</a> 
                       </td>
                       <td>
                           <a class="btn btn-danger" href="#" onClick="eliminarTOE(<?php echo $rayosxTemporalToe[$i]->id_tramite_rayosx?>,<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>)">Eliminar</a>
                       </td>
                   </tr>
                   <div id="modalToe<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>" class="modal">
                     <p><b>TOE ID:<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?></b></p>
                       <ul>							
                           <li><b>Primer Nombre: </b><?php echo $rayosxTemporalToe[$i]->toe_pnombre?></li>
                           <li><b>Segundo Nombre: </b><?php echo $rayosxTemporalToe[$i]->toe_snombre?></li>
                           <li><b>Primer Apellido: </b><?php echo $rayosxTemporalToe[$i]->toe_papellido?></li>
                           <li><b>Segundo Apellido: </b><?php echo $rayosxTemporalToe[$i]->toe_sapellido?></li>
                           <li><b>Número de identificación: </b><?php echo $rayosxTemporalToe[$i]->toe_ndocumento?></li>
                           <li><b>Lugar Expedición: </b><?php echo $rayosxTemporalToe[$i]->toe_lexpedicion?></li>
                           <li><b>Correo: </b><?php echo $rayosxTemporalToe[$i]->toe_correo?></li>
                           <li><b>Profesión: </b><?php echo $rayosxTemporalToe[$i]->toe_profesion?></li>
                           <li><b>Nivel Académico: </b><?php echo $rayosxTemporalToe[$i]->toe_nivel?></li>
                           <li><b>Fecha del último entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$i]->toe_ult_entrenamiento?></li>
                           <li><b>Fecha del próximo entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$i]->toe_pro_entrenamiento?></li>
                           <li><b>Número del registro profesional de salud: </b><?php echo $rayosxTemporalToe[$i]->toe_registro?></li>
                       </ul>					  
                     
                   </div>
                   <?php	
               }	
           }else{
               ?>
               <tr>
                   <td colspan="6" scope="col">No Existen TOE Registrados</td>
               </tr>	
               <?php
           }
           ?>            
           </tbody>
           </table>
           <?php
       }
       
   }
       
   public function eliminarTOE(){
       
       
       if(isset($_REQUEST['id_tramite_rayosx']) && isset($_REQUEST['id_toe_rayosx'])){
           
           $rayosxTOE = $this->xindustrial_model->rayosxTemporalToe($_REQUEST['id_tramite_rayosx']);
           
           if(count($rayosxTOE)>1){
               $dataAct['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
               $dataAct['id_toe_rayosx'] = $_REQUEST['id_toe_rayosx'];
               
               $resultRayosxTOE = $this->xindustrial_model->eliminarTOE($dataAct);
               
               if($resultRayosxTOE){
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Se elimino el trabajador seleccionado";
               }else{
                   $respuestaServicio['estado'] = "ERROR";
                   $respuestaServicio['mensaje'] = "No fue posible ejecutar la operación";
               }
           }else{
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "No fue posible eliminar el trabajador, debe existir al menos un trabajador para continuar el tramite";
           }
           
           echo json_encode($respuestaServicio);
       }
   }
       
   public function editarDirector() {
       
        if($_REQUEST['id_tramite_rayosx'] == NULL) {
			   $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "Error al guardar la información";
               $respuestaServicio['btn_menu'] = 0;
        }else {			
            if($_REQUEST['visita_previa'] == 1){
                
               $rayosxVisita['id'] = $_REQUEST['id_tramite_rayosx'];
               $rayosxVisita['visita_previa'] = $_REQUEST['visita_previa'];
               $resultRayosxVisita = $this->xindustrial_model->updateVisita($rayosxVisita); 
                
               $rayosxDirector['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];				
               $rayosxDirector['talento_pnombre'] = $_REQUEST['talento_pnombre'];
               $rayosxDirector['talento_snombre'] = $_REQUEST['talento_snombre'];
               $rayosxDirector['talento_papellido'] = $_REQUEST['talento_papellido'];
               $rayosxDirector['talento_sapellido'] = $_REQUEST['talento_sapellido'];
               $rayosxDirector['talento_tdocumento'] = $_REQUEST['talento_tdocumento'];
               $rayosxDirector['talento_ndocumento'] = $_REQUEST['talento_ndocumento'];
               $rayosxDirector['talento_lexpedicion'] = $_REQUEST['talento_lexpedicion'];
               $rayosxDirector['talento_correo'] = $_REQUEST['talento_correo'];
               $rayosxDirector['talento_titulo'] = $_REQUEST['talento_titulo'];
               $rayosxDirector['talento_universidad'] = $_REQUEST['talento_universidad'];
               $rayosxDirector['talento_libro'] = $_REQUEST['talento_libro'];
               $rayosxDirector['talento_registro'] = $_REQUEST['talento_registro'];
               $rayosxDirector['talento_fecha_diploma'] = $_REQUEST['talento_fecha_diploma'];
               $rayosxDirector['talento_resolucion'] = $_REQUEST['talento_resolucion'];
               $rayosxDirector['talento_fecha_convalida'] = $_REQUEST['talento_fecha_convalida'];
               $rayosxDirector['talento_nivel'] = $_REQUEST['talento_nivel'];
               $rayosxDirector['talento_titulo_pos'] = $_REQUEST['talento_titulo_pos'];
               $rayosxDirector['talento_universidad_pos'] = $_REQUEST['talento_universidad_pos'];
               $rayosxDirector['talento_libro_pos'] = $_REQUEST['talento_libro_pos'];
               $rayosxDirector['talento_registro_pos'] = $_REQUEST['talento_registro_pos'];
               $rayosxDirector['talento_fecha_diploma_pos'] = $_REQUEST['talento_fecha_diploma_pos'];
               $rayosxDirector['talento_resolucion_pos'] = $_REQUEST['talento_resolucion_pos'];
               $rayosxDirector['talento_fecha_convalida_pos'] = $_REQUEST['talento_fecha_convalida_pos'];
               
               if(isset($_REQUEST['id_director_rayosx']) && $_REQUEST['id_director_rayosx'] != ''){
                
                    $rayosxDireccion['id_director_rayosx'] = $_REQUEST['id_director_rayosx'];
                    $rayosxDireccion['updated_at'] = date("Y-m-d H:i:s");
                    $resultRayosxDirector = $this->xindustrial_model->updateRayosxDirector($rayosxDirector);
                }else{
                    $rayosxDireccion['created_at'] = date("Y-m-d H:i:s");
                    $resultRayosxDirector = $this->xindustrial_model->insertRayosxDirector($rayosxDirector);
                }
                
               $rayosxTalento = $this->xindustrial_model->rayosxTalento($_REQUEST['id_tramite_rayosx']);
               $rayosxObjprueba = $this->xindustrial_model->rayosxObjprueba($_REQUEST['id_tramite_rayosx']);
               
               if(!empty($rayosxTalento)){
                   $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                   $dataAct['modulo'] = "modulo4";
                   $dataAct['estado'] = "0";
                   $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                   
                   $respuestaServicio['btn_menu'] = 0;
               }else{
                   $respuestaServicio['btn_menu'] = 0;
               }
               
               $respuestaServicio['estado'] = "OK";
               $respuestaServicio['mensaje'] = "Actualización exitosa";
                
                
            }else{
               $rayosxVisita['id'] = $_REQUEST['id_tramite_rayosx'];
               $rayosxVisita['visita_previa'] = $_REQUEST['visita_previa'];
               $resultRayosxVisita = $this->xindustrial_model->updateVisita($rayosxVisita);  
               
               $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
               $dataAct['modulo'] = "modulo4";
               $dataAct['estado'] = "1";
               $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
               
               $respuestaServicio['btn_menu'] = 1;
               $respuestaServicio['estado'] = "OK";
               $respuestaServicio['mensaje'] = "Actualización exitosa";
            }	
        }		 
        echo json_encode($respuestaServicio);
   }

   public function editarObjetosPrueba(){
       
       if(isset($_REQUEST['id_tramite_rayosx']) && $_REQUEST['id_tramite_rayosx'] == '') {
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "Error al agregar el equipo";
               $respuestaServicio['btn_menu'] = 0;
        }else {
            
            $rayosxObjeto['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
            $rayosxObjeto['obj_nombre'] = $_REQUEST['obj_nombre'];
            $rayosxObjeto['obj_marca'] = $_REQUEST['obj_marca'];
            $rayosxObjeto['obj_modelo'] = $_REQUEST['obj_modelo'];
            $rayosxObjeto['obj_serie'] = $_REQUEST['obj_serie'];
            $rayosxObjeto['obj_calibracion'] = $_REQUEST['obj_calibracion'];
            $rayosxObjeto['obj_vigencia'] = $_REQUEST['obj_vigencia'];
            $rayosxObjeto['obj_fecha'] = $_REQUEST['obj_fecha'];
            $rayosxObjeto['obj_uso'] = $_REQUEST['obj_uso'];
            $rayosxObjeto['estado'] = 1;
            
            $rayosxObjeto['created_at'] = date("Y-m-d H:i:s");
            $resultRayosxObjeto = $this->xindustrial_model->insertRayosxObjeto($rayosxObjeto);
            

               if($resultRayosxObjeto){
                   
               $rayosxTalento = $this->xindustrial_model->rayosxTalento($_REQUEST['id_tramite_rayosx']);
               $rayosxObjprueba = $this->xindustrial_model->rayosxObjprueba($_REQUEST['id_tramite_rayosx']);
               
                   if(!empty($rayosxTalento) && !empty($rayosxObjprueba)){
                       $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
                       $dataAct['modulo'] = "modulo4";
                       $dataAct['estado'] = "1";
                       $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);
                       
                       $respuestaServicio['btn_menu'] = 1;
                   }else{
                       $respuestaServicio['btn_menu'] = 0;
                   }
               
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Objeto de prueba agregado con exito";					
                   
               }else{
                   $respuestaServicio['estado'] = "ERROR2";
                   $respuestaServicio['mensaje'] = "Error al agregar el objeto de prueba";
                   $respuestaServicio['btn_menu'] = 0;
               }									
   
        }
        echo json_encode($respuestaServicio);
   }
   
   public function listarObjetos(){
       
       $rayosxObjprueba = $this->xindustrial_model->rayosxObjprueba($_REQUEST['id_tramite_rayosx']);
                   
       if($rayosxObjprueba){
           ?>
           <table class="display nowrap table table-hover">
              <thead>
                 <tr>
                     <th>ID</th>
                     <th>Nombre del equipo</th>
                     <th>Marca del equipo</th>
                     <th>Modelo del equipo</th>
                     <th>Ver Más</th>
                     <th>Eliminar</th>
                 </tr>
              </thead>

              <tbody>
              <?php
              if(isset($rayosxObjprueba)){
                  for($i=0;$i<count($rayosxObjprueba);$i++){
                      ?>
                      <tr>
                          <td><?php echo $rayosxObjprueba[$i]->id_obj_rayosx;?></td>
                          <td><?php echo $rayosxObjprueba[$i]->obj_nombre;?></td>
                          <td><?php echo $rayosxObjprueba[$i]->obj_marca;?></td>
                          <td><?php echo $rayosxObjprueba[$i]->obj_modelo;?></td>
                          <td>
                              <a class="btn btn-success" onClick="abrirModal('Equipo Objeto de prueba ID: <?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>','#modalObj<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>')">Ver más...</a>
                          </td>
                          <td>
                              <a class="btn btn-danger"  href="#" onClick="eliminarObj(<?php echo $rayosxObjprueba[$i]->id_tramite_rayosx?>,<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>)">Eliminar</a>
                          </td>
                      </tr>
                      <div id="modalObj<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>" class="modal">
                        <p><b>Equipo Objeto de prueba ID:<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?></b></p>
                          <ul>
                              <li><b>Nombre del Equipo: </b><?php echo $rayosxObjprueba[$i]->obj_nombre?></li>
                              <li><b>Marca del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_marca?></li>
                              <li><b>Modelo del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_modelo?></li>
                              <li><b>Serie del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_serie?></li>
                              <li><b>Calibración: </b><?php echo $rayosxObjprueba[$i]->obj_calibracion?></li>
                              <li><b>Vigencia de calibración: </b><?php echo $rayosxObjprueba[$i]->obj_vigencia?></li>
                              <li><b>Fecha de calibración: </b><?php echo $rayosxObjprueba[$i]->obj_fecha?></li>
                              <li><b>Manual Técnico y ficha Técnica: </b><?php echo $rayosxObjprueba[$i]->obj_manual?></li>
                              <li><b>Usos: </b><?php echo $rayosxObjprueba[$i]->obj_uso?></li>
                          </ul>
                      </div>
                      <?php
                  }
              }else{
                  ?>
                  <tr>
                      <td colspan="6" scope="col">No Existen Objetos de prueba Registrados</td>
                  </tr>
                  <?php
              }
              ?>
              </tbody>
              </table>
              <?php
          }

      }


   public function eliminarObj(){
       
       
       if(isset($_REQUEST['id_tramite_rayosx']) && isset($_REQUEST['id_obj_rayosx'])){
           
           $rayosxObj = $this->xindustrial_model->rayosxObjprueba($_REQUEST['id_tramite_rayosx']);
           
           if(count($rayosxObj)>1){
               $dataAct['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
               $dataAct['id_obj_rayosx'] = $_REQUEST['id_obj_rayosx'];
               
               $resultObj = $this->xindustrial_model->eliminarObj($dataAct);
               
               if($resultObj){
                   $respuestaServicio['estado'] = "OK";
                   $respuestaServicio['mensaje'] = "Se elimino el objeto seleccionado";
               }else{
                   $respuestaServicio['estado'] = "ERROR";
                   $respuestaServicio['mensaje'] = "No fue posible objeto la operación";
               }
           }else{
               $respuestaServicio['estado'] = "ERROR";
               $respuestaServicio['mensaje'] = "No fue posible eliminar el objeto, debe existir al menos un objeto para continuar el tramite";
           }
           
           echo json_encode($respuestaServicio);
       }
   }

      public function editarDocumentos1(){

          $bandera = 1;
          $documentos = array("pn_doc","pj_doc","pj_cyc","fi_doc_encargado","fi_diploma_encargado",
                             "fi_registro_dosimetrico","fi_constancia_toe","fi_constancia_equipo",
                             "fi_soporte_talento","fi_diploma_director","fi_res_convalida_director",
                             "fi_diploma_pos_profe","fi_res_convalida_profe","fi_cert_calibracion",
                             "fi_declaraciones");

          for($i=0;$i<count($documentos);$i++){
              if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {

               $nombre_archivo = $_REQUEST['id_tramite_rayosx']."-".$documentos[$i]."-".date('YmdHis');
               $config['upload_path'] = "uploads/xindustrial/";
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

               $resultadoIDDocumento = $this->xindustrial_model->insertarArchivo($datosAr);

               $datosDoc['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
               $datosDoc['documento'] = $documentos[$i];
               $datosDoc['path'] = $rutaFinal['rutaFinal']['full_path'];
               $datosDoc['categoria'] = $_REQUEST['categoria_docs'];
               $datosDoc['id_archivo'] = $resultadoIDDocumento;
               $datosDoc['estado'] = 1;
               $datosDoc['created_at'] = date("Y-m-d H:i:s");
               $resultRayosxArc = $this->xindustrial_model->inactivarDocumentoPrevios($datosDoc);
               $resultRayosxObjeto = $this->xindustrial_model->insertDocumento($datosDoc);

           }
       }
       
       if($bandera = 1){
           
           $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
           $dataAct['modulo'] = "modulo5";
           $dataAct['estado'] = "1";
           $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);

              if($resultRayosxDireccion){
                  $this->session->set_flashdata('retorno_exito', 'Documentos cargados con exito, por favor finalice el tr&aacute;mite para enviar a la Secretaria de Salud.</b>');
              }else{
                  $this->session->set_flashdata('retorno_error', 'Error al enviar los documentos</b>');
              }
          }else{
              $this->session->set_flashdata('retorno_error', 'Favor verificar, no fue posible cargar todos los documentos.</b>');
          }


          redirect(base_url('xindustrial/rx_editarForm/'.$dataAct['id_tramite']), 'refresh');
          exit;
      }

      public function editarDocumentos2(){

          $bandera = 1;
          $documentos = array("pn_doc","pj_doc","pj_cyc","fi_doc_oficial","fi_diploma_oficial",
                             "fi_registro_dosimetrico","fi_constancia_toe","fi_constancia_equipo",
                             "fi_capacitacion_radiologica","fi_evaluacion","fi_soporte_talento","fi_diploma_director",
                             "fi_res_convalida_director","fi_diploma_pos_profe","fi_res_convalida_profe",
                             "fi_cert_calibracion","fi_declaraciones");


          for($i=0; $i<count($documentos); $i++){

              if (isset($_FILES[$documentos[$i]]) && $_FILES[$documentos[$i]]['size'] > 0) {
                 $nombre_archivo = $_REQUEST['id_tramite_rayosx']."-".$documentos[$i]."-".date('YmdHis');
                  $config['upload_path'] = "uploads/xindustrial/";
                  $config['allowed_types'] = 'pdf';
                  $config['max_size'] = '30000';
                  $config['file_name'] = $nombre_archivo;
                  // Fin Configuracion parametros para carga de archivos
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

               $resultadoIDDocumento = $this->xindustrial_model->insertarArchivo($datosAr);
               
               $datosDoc['id_tramite_rayosx'] = $_REQUEST['id_tramite_rayosx'];
               $datosDoc['documento'] = $documentos[$i];
               $datosDoc['path'] = $rutaFinal['rutaFinal']['full_path'];
               $datosDoc['categoria'] = $_REQUEST['categoria_docs'];
               $datosDoc['id_archivo'] = $resultadoIDDocumento;
               $datosDoc['estado'] = 1;
               $datosDoc['created_at'] = date("Y-m-d H:i:s");
               $resultRayosxArc = $this->xindustrial_model->inactivarDocumentoPrevios($datosDoc);
               $resultRayosxObjeto = $this->xindustrial_model->insertDocumento($datosDoc);
               
           }
       }

       if($bandera = 1){
           
           $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
           $dataAct['modulo'] = "modulo5";
           $dataAct['estado'] = "1";
           $resultRayosxDireccion = $this->xindustrial_model->actualizarModulo($dataAct);

           if($resultRayosxDireccion){
               $this->session->set_flashdata('retorno_exito', 'Documentos cargados con exito, por favor finalice el tr&aacute;mite para enviar a la Secretaria de Salud.</b>');
           }else{
               $this->session->set_flashdata('retorno_error', 'Error al enviar los documentos</b>');	
           }
       }else{
           $this->session->set_flashdata('retorno_error', 'Favor verificar, no fue posible cargar todos los documentos.</b>');
       }
       
       
       redirect(base_url('xindustrial/rx_editarForm/'.$dataAct['id_tramite']), 'refresh');
       exit;
   }

      public function completarTramiteRayosx(){

          $tramite_info = $this->xindustrial_model->tramite_info($_REQUEST['id_tramite_rayosx']);
		  $tramite_info_user = $this->xindustrial_model->tramite_info_user($_REQUEST['id_tramite_rayosx']);
          $idTramite = $_REQUEST['id_tramite_rayosx'];
          if($tramite_info->estado == 1){

              $data['id'] = $_REQUEST['id_tramite_rayosx'];
              $data['estado'] = 2;

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "estado";
              $dataAct['estado'] = "2";
              $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "fecha_envio";
              $dataAct['estado'] = date('Y-m-d H:i:s');
              $resultRayosxFechaEnvio = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "notificacion";
              $dataAct['estado'] = $_REQUEST['notificacion'];
              $resultRayosxNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "correo_notificacion";
              $dataAct['estado'] = $_REQUEST['correo_notificacion'];
              $resultRayosxCorreoNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataflujo['tramite_id'] = $_REQUEST['id_tramite_rayosx'];
              $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
              $dataflujo['id_estado'] = 2;
              $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
              $dataflujo['observaciones'] = "Finalización del trámite RAYOS X";

              $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

          }else if($tramite_info->estado == 13){

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "estado";
              $dataAct['estado'] = "14";
              $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "fecha_envio_subsanacion1";
              $dataAct['estado'] = date('Y-m-d H:i:s');
              $resultRayosxFechaEnvio = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "notificacion";
              $dataAct['estado'] = $_REQUEST['notificacion'];
              $resultRayosxNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "correo_notificacion";
              $dataAct['estado'] = $_REQUEST['correo_notificacion'];
              $resultRayosxCorreoNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataflujo['tramite_id'] = $_REQUEST['id_tramite_rayosx'];
              $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
              $dataflujo['id_estado'] = 14;
              $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
              $dataflujo['observaciones'] = "Subsanación primera intancia completo";

              $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);
          }else if($tramite_info->estado == 22){

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "estado";
              $dataAct['estado'] = "23";
              $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "fecha_envio_subsanacion2";
              $dataAct['estado'] = date('Y-m-d H:i:s');
              $resultRayosxFechaEnvio = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "notificacion";
              $dataAct['estado'] = $_REQUEST['notificacion'];
              $resultRayosxNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataAct['id_tramite'] = $_REQUEST['id_tramite_rayosx'];
              $dataAct['modulo'] = "correo_notificacion";
              $dataAct['estado'] = $_REQUEST['correo_notificacion'];
              $resultRayosxCorreoNotificacion = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataflujo['tramite_id'] = $_REQUEST['id_tramite_rayosx'];
              $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
              $dataflujo['id_estado'] = 23;
              $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
              $dataflujo['observaciones'] = "Subsanación segunda intancia completo";

              $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);
          }



          if($resultRayosxEstado){
              if($_REQUEST['notificacion'] == 1){
                  $mensajeAdi = "Recuerde que, al seleccionar la opción de notificación electrónica, puede ser notificado y/o comunicado a través de su correo electrónico, recomendamos revisar periódicamente las carpetas spam o correo no deseado de su email.";

                   $dataEmail['nombre_usuario'] = $tramite_info_user->p_nombre." ".$tramite_info_user->s_nombre." ".$tramite_info_user->p_apellido." ".$tramite_info_user->s_apellido;
                   $dataEmail['nombre_rs'] = $tramite_info_user->nombre_rs;
                   $dataEmail['email'] = $_REQUEST['correo_notificacion'];
                   $dataEmail['titulo'] = "Respuesta Radicado Licencia de equipos industriales, veterinaria o de investigación - SDS";
                   $dataEmail['tramite_id'] = $_REQUEST['id_tramite_rayosx'];

                   $this->enviarCorreoNotificacion($dataEmail);

              }else{
                  $mensajeAdi = "";
              }
                 $this->session->set_flashdata('exito', 'Su solicitud ha sido completada con exito. El trámite ingresa a proceso de validación de datos por cuenta de los funcionarios del proceso encargado. Para hacerle seguimiento a este trámite no olvide anotar el ID del trámite descrito a continuación: <br><br> <b> N&uacute;mero de radicado: '.$idTramite.'</b>. El trámite es totalmente en línea y en la etapa de Mis Trámites, puede realizar seguimiento, subsnación y/o resultado de la solicitud.  <br><br> Muchas Gracias por utilizar los servicios en línea de la Secretaría Distrital de Salud. Recuerde realizar seguimiento a su trámite a traves de la Portal Transaccional de Trámites y Servicios.<br><br>  Ante cualquier inquietud no dude primero consultar la documentación disponible o contactar con los canales de atención disponibles o el email contactenos@saludcapital.gov.co');
          }else{
              $this->session->set_flashdata('error', 'No es posible realizar el registro del trámite, intentarlo más tarde. Si el problema persiste favor contactar con los canales de atención disponibles o el email contactenos@saludcapital.gov.co');
          }

          redirect(base_url('xindustrial/listado_tramites'), 'refresh');
          exit;

      }

      public function limpiarCategoria($id_tramite){

          $dataAct['id_tramite'] = $id_tramite;
          $dataAct['modulo'] = "categoria";
          $dataAct['estado'] = "0";
          $resultRayosxCategoria = $this->xindustrial_model->actualizarModulo($dataAct);

          if($resultRayosxCategoria){

              $dataEli['id_tramite_rayosx'] = $id_tramite;

              $resultRayosxEquipos = $this->xindustrial_model->eliminarEquiposTodos($dataEli);

              if($resultRayosxEquipos){
                  $this->session->set_flashdata('retorno_exito', 'Se realizo la actualización de la categoría con éxito y se inactivaron los equipos previamente registrados');
              }else{
                  $this->session->set_flashdata('retorno_exito', 'Se realizo la actualización de la categoría con éxito, pero no fue posible inactivar los equipos');
              }

          }else{
              $this->session->set_flashdata('retorno_error', 'Error al realizar la actualización</b>');
          }

          redirect(base_url('xindustrial/rx_editarForm/'.$id_tramite), 'refresh');
          exit;

      }

      public function solicitarProrroga($id_tramite){


          if(isset($id_tramite)){

              $dataAct['id_tramite'] = $id_tramite;
              $dataAct['modulo'] = "solicita_prorroga";
              $dataAct['estado'] = 1;
              $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

              if($resultRayosxEstado){
                  $this->session->set_flashdata('retorno_exito', 'Se realizo el registro de la solicitud de prorroga, recuerde que cuenta con 20 días adicionales para subsanar el trámite');
              }else{
                  $this->session->set_flashdata('retorno_error', 'No fue posible ejecutar la operación');
              }

              redirect(base_url('xindustrial/'), 'refresh');
              exit;
          }
      }

      public function anularTramite($id_tramite){


          if(isset($id_tramite)){

              $dataAct['id_tramite'] = $id_tramite;
              $dataAct['modulo'] = "estado";
              $dataAct['estado'] = 8;
              $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

              $dataflujo['tramite_id'] = $id_tramite;
              $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
              $dataflujo['id_estado'] = 8;
              $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
              $dataflujo['observaciones'] = "Usuario solicita anular trámite";

              $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

              if($resultRayosxEstado){
                  $this->session->set_flashdata('retorno_exito', 'Se realizo el registro de la anulación del trámite');
              }else{
                  $this->session->set_flashdata('retorno_error', 'No fue posible ejecutar la operación');
              }

              redirect(base_url('xindustrial/'), 'refresh');
              exit;
          }
      }

    public function cargaMunicipio() {
        if ($this->input->post('departamento')) {
            $departamento = $this->input->post('departamento');
            $ciudades = $this->xindustrial_model->municipios_col($departamento);
            ?>
            <option value="">Seleccione...</option>
            <?php
            foreach ($ciudades as $fila) {
                ?>
                <option value="<?php echo $fila->CodigoDane ?>"><?php echo $fila->Descripcion ?></option>
                <?php
            }
        }
    }

       public function enviarCorreoNotificacion($datos){
       //public function enviarCorreoResolucion($datos){



           require_once(APPPATH . 'libraries/PHPMailer_5.2.4/class.phpmailer.php');
           $mail = new PHPMailer(true);

           $mail->IsSMTP(); // set mailer to use SMTP
           $mail->Host = "172.16.0.238"; // specif smtp server
           $mail->SMTPSecure = ""; // Used instead of TLS when only POP mail is selected
           $mail->Port = 25; // Used instead of 587 when only POP mail is selected
           $mail->SMTPAuth = false;
           $mail->Username = "cuidatesefeliz@saludcapital.gov.co"; // SMTP username
           $mail->Password = "Colombia2018"; // SMTP password
           $mail->FromName = "Trámites en línea";
           $mail->From = "tramiteslinea@saludcapital.gov.co";
           $mail->AddAddress($datos['email'], $datos['email']);
           $mail->WordWrap = 50;
           $mail->CharSet = 'UTF-8';
           $mail->IsHTML(true); // set email format to HTML
           $mail->Subject = $datos['titulo'];

           $html = '<p>Señor(a)(es):</p>';

           if($datos['nombre_rs'] != ''){
               $html .= '<p><b>' . $datos['nombre_usuario'] .'<br>'. $datos['nombre_rs'] . '</b></p>';
           }else{
               $html .= '<p><b>' . $datos['nombre_usuario'] . '</b></p>';
           }

           $html .= '
             <p>Una vez completado el trámite de Licencia de equipos industriales, veterinaria o de investigación, se obtiene el siguiente Radicado No. '.$datos['tramite_id'].'</p>
             <p>Para visualizar el radicado ingrese a <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> con su usuario y clave e ingrese a la opción "Mis Trámites"
             y posteriormente a la opción "Mis Trámites de Licencia de equipos industriales, veterinaria o de investigación"</p>
             <p>
               La Secretaria Distrital de Salud, con el propósito de mejorar nuestros servicios a la ciudadanía, quiere conocer su opinión frente a la experiencia en la realización de nuestros trámites, por lo cual agradecemos su tiempo para responder la siguiente encuesta. <br>
               <a href="http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es" target="_blank">http://fapp.saludcapital.gov.co/encuestas/index.php?sid=16649&newtest=Y&lang=es.</a>
             </p>
             <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co</p>
             <p><b>Secretaría Distrital de Salud.<br>
                   Subdirección de Inspección Vigilancia y Control</b><br>
                   <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Licencia de equipos industriales, veterinaria o de investigación<br>
                   Cra 32 #12-81 Bogotá D.C, Colombia<br>
                   Teléfono: (571) 3649090
               </p>';

           $mail->Body = nl2br($html, false);

           if ($mail->Send()) {

           }
       }

       public function reporte_xindustrial() {

       $datosAr1 = $this->session->userdata('username');
       $data['validacion'] = $this->xindustrial_model->info_usuariotramite($datosAr1);
           $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
           $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';
           $data['listado_soli'] = $this->xindustrial_model->listarSolicitudesLRX($fechai,$fechaf,0);
           //var_dump($data['listado_soli']);

           $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
           $data['titulo'] = 'Perfil Validaci&oacute;n';
           $data['contenido'] = 'validacion/reporte_xindustrial_view';
           $this->load->view('templates/layout_xindustrial', $data);
       }

       public function reporteporcedulaRX() {

 				$datosAr1 = $this->session->userdata('username');
 				$data['validacion'] = $this->xindustrial_model->info_usuariotramite($datosAr1);
 				$numdoc= isset($_POST['num_doc']) ? $_POST['num_doc']:'';
 				if($numdoc == null){
 					$data['tramitesinfo'] = null;
 				}
 				else{
 				$data['tramitesinfo'] = $this->xindustrial_model->tramites_pornumdocRX($numdoc,0);
 				}
           $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
 				$data['titulo'] = 'Perfil Validaci&oacute;n';
 				$data['contenido'] = 'validacion/tramites_porcedularx_view';
 				$this->load->view('templates/layout_xindustrial', $data);

     }

       public function buscarporcedulaRX() {

   				$datosAr1 = $this->session->userdata('username');
   				$data['validacion'] = $this->xindustrial_model->info_usuariotramite($datosAr1);
   				$numdoc= isset($_POST['num_doc']) ? $_POST['num_doc']:'';
   				$data['tramitesinfo'] = $this->xindustrial_model->tramites_pornumdocRX($numdoc,0);
           $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
   				$data['titulo'] = 'Perfil Validaci&oacute;n';
   				$data['contenido'] = 'validacion/tramites_porcedularx_view';
   				$this->load->view('templates/layout_xindustrial', $data);

       }
       public function generar_excel(){
           $fechai= isset($_GET['fecha_i']) ? $_GET['fecha_i']:'';
           $fechaf= isset($_GET['fecha_f']) ? $_GET['fecha_f']:'';//echo $fechaf;exit;
           $data['listado_soli']= $this->xindustrial_model->listarSolicitudesLRX($fechai,$fechaf,0);
           $listado_soli= $this->xindustrial_model->listarSolicitudesLRX($fechai,$fechaf,0);
           $data['titulo'] = 'Perfil Validaci&oacute;n';
           $data['contenido'] = 'validacion/reporte_xindustrial_view';
           $this->load->view('templates/layout_xindustrial', $data);
           if(count($listado_soli) > 0){
               require_once APPPATH.'libraries/PHPExcel/PHPExcel.php';
               $this->excel = new PHPExcel();

               $this->excel->setActiveSheetIndex(0);
               $this->excel->getActiveSheet()->setTitle('Solicitudes');
               //Contador de filas
               $contador = 1;
               // ancho las columnas.
               $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
               $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth(40);
               $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth(40);
               $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("K")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth(40);
               $this->excel->getActiveSheet()->getColumnDimension("M")->setWidth(30);
               $this->excel->getActiveSheet()->getColumnDimension("N")->setWidth(20);
               $this->excel->getActiveSheet()->getColumnDimension("O")->setWidth(20);
               $this->excel->getActiveSheet()->getColumnDimension("P")->setWidth(20);



               // negrita a los títulos de la cabecera.
               $this->excel->getActiveSheet()->getStyle("A{$contador}:P{$contador}")->getFont()->setBold(true);
               #$this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
               // títulos de la cabecera.
               $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'ID Solicitud');
               $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Tipo Trámite RX');
               $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Categoría Equipo');
               $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Fecha de Creación');
               $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Numero doc Solicitante');
               $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Nombres Solicitante');
               $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Genero Solicitante');
               $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Orientación Sexual Solicitante');
               $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Etnía Solicitante');
               $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Estado Civil Solicitante');
               $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'Nivel Educativo Solicitante');
               $this->excel->getActiveSheet()->setCellValue("L{$contador}", 'Estado de Gestión');
               $this->excel->getActiveSheet()->setCellValue("M{$contador}", 'Fecha estado');
               $this->excel->getActiveSheet()->setCellValue("N{$contador}", 'Usuario/Funcionario');
               $this->excel->getActiveSheet()->setCellValue("O{$contador}", 'No Resolución');
               $this->excel->getActiveSheet()->setCellValue("P{$contador}", 'Codigo Verificación');



               foreach($listado_soli as $l){
                  $contador++;
                  //Informacion de la consulta.
                  $this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->id);
                  $this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->tipo_tramite);
                  $this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->categoria);
                  $this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->created_at);
                  $this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->nume_identificacion);
                  $this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->p_nombre." ".$l->s_nombre." ".$l->p_apellido." ".$l->s_apellido);
                  $this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->genero);
                  $this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->orientacion);
                  $this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->etnia);
                  $this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->estado_civil);
                  $this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->nivel_educativo);

                  $this->excel->getActiveSheet()->setCellValue("L{$contador}", $l->descripcion);
                  $this->excel->getActiveSheet()->setCellValue("M{$contador}", $l->fecha_estado);
                  $this->excel->getActiveSheet()->setCellValue("N{$contador}", $l->username);
                  if($l->estado=='10'){
                    $this->excel->getActiveSheet()->setCellValue("O{$contador}", $l->id_resolucion);
                    $this->excel->getActiveSheet()->setCellValue("P{$contador}", $l->codigo_verificacion);
                  }else if($l->estado=='12'){
                    $this->excel->getActiveSheet()->setCellValue("O{$contador}", $l->id_resolucion);
                    $this->excel->getActiveSheet()->setCellValue("P{$contador}", $l->codigo_verificacion);
                  }
                  else{
                    $this->excel->getActiveSheet()->setCellValue("O{$contador}");
                    $this->excel->getActiveSheet()->setCellValue("P{$contador}");
                  }

                   }
                   //nombre de archivo que se va a generar.
                   $archivo = "Solicitudes_licenciaRXVeterinarias.xls";
                   header('Content-Type: application/vnd.ms-excel');
                   header('Content-Disposition: attachment;filename="'.$archivo.'"');
                   header('Cache-Control: max-age=0');
                   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                   // salida al navegador con el archivo Excel.
                   $objWriter->save('php://output');
            }/*else{
               echo 'No se encontraron registros';
               exit;
            }*/
         }


         public function visualizar_documentos($id_tramite)
       {
     	  $data['id_tramite'] = $id_tramite;
     	  $data['tramite_info'] = $this->xindustrial_model->tramite_info($id_tramite);


     	  $data['departamento'] = $this->xindustrial_model->departamentos_col();
     	  $data['equipos_radiacion'] = $this->xindustrial_model->equipos_radiacion();
     	  $data['tipo_visualizacion'] = $this->xindustrial_model->tipo_visualizacion();
     	  $data['tipo_identificacion_natural'] = $this->xindustrial_model->tipo_identificacion();
     	  $data['nivelAcademico'] = $this->xindustrial_model->nivelAcademico();
     	  $data['programasAcademicos'] = $this->xindustrial_model->programasAcademicos();

     	  //Verificar si tiene datos por cada paso
     	  $data['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
     	  $data['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
     	  $data['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
     	  $data['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
     	  $data['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
     	  $data['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
     	  $data['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
     	  $data['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
     	  $data['documentosTramite'] = $this->xindustrial_model->rayosxDocumentosValidacion($id_tramite);


     	  $data['observacionesTramite'] = $this->xindustrial_model->consulta_obstramite($id_tramite);


     	  $data['tramites_pendientes'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
     	  $data['tipo_identificacion'] = $this->xindustrial_model->tipo_identificacion_todos();
     	  $data['departamentos_col'] = $this->xindustrial_model->departamentos_col();
     	  $data['tramites_seguimientos'] = $this->xindustrial_model->seguimiento_tramite($id_tramite);

     	  //$data['js'] = array(base_url('assets/js/rayosx.js'),base_url('assets/js/validacion_rx.js'));
     	  $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
     	  $data['titulo'] = 'Perfil Validaci&oacute;n';
     	  $data['contenido'] = 'validacion/visualizar_documentos';

     	  $this->load->view('templates/layout_xindustrial',$data);

       }



}
