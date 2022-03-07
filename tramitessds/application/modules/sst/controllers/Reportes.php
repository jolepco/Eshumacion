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

class Reportes extends MY_Controller
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
        $this->load->model('reportes_model');		
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

        $data['tramites_pendientes'] = $this->reportes_model->tramites_pendientes();
        $data['tramites_validados'] = $this->reportes_model->tramites_validados();
        $data['licencias_aprobadas'] = $this->reportes_model->licencias_aprobadas();
        $data['licencias_negadas'] = $this->reportes_model->licencias_negadas();
        $data['reporte_estados'] = $this->reportes_model->reporte_estados();
        //$data['js'] = array(base_url('assets/js/sst/reportes.js'));
        $data['titulo'] = 'Reportes';
        $data['contenido'] = 'reportes/dashboard';
        $this->load->view('templates/layout_sst',$data);
    }

    public function anulados(){
        $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
        $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';
	
	if(!empty($fechai) && !empty($fechaf)){

		$fec= date('Y-m-d',strtotime ($fechaf.'-31 day'));
		if($fechai<$fec){
			$this->session->set_flashdata('error', 'Estimado usuario ha elegido un rango de fecha superior a un mes. Favor ingrese nuevamente los datos</b>');
			redirect(base_url('/sst/reportes/anulados'), 'refresh');
			exit;
		}
	}

	if($fechai>$fechaf){
        	$this->session->set_flashdata('error', 'La Fecha de Inicio es superior a la fecha Final. Favor ingrese nuevamente los datos</b>');
		redirect(base_url('/sst/reportes/anulados'), 'refresh');
		exit;
	}else{
        	$data['tramites_anulados'] = $this->reportes_model->tramites_anulados($fechai,$fechaf,0);
	        $data['js'] = array(base_url('assets/js/sst/reportes.js'));
        	$data['titulo'] = 'Reportes';
	        $data['contenido'] = 'reportes/anulados';
        	$this->load->view('templates/layout_sst',$data);
	}
    }

    public function devueltos(){

        $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
        $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';
	
	if(!empty($fechai) && !empty($fechaf)){

		$fec= date('Y-m-d',strtotime ($fechaf.'-31 day'));
		if($fechai<$fec){
			$this->session->set_flashdata('error', 'Estimado usuario ha elegido un rango de fecha superior a un mes. Favor ingrese nuevamente los datos</b>');
			redirect(base_url('/sst/reportes/devueltos'), 'refresh');
			exit;
		}
	}

	if($fechai>$fechaf){
        	$this->session->set_flashdata('error', 'La Fecha de Inicio es superior a la fecha Final. Favor ingrese nuevamente los datos</b>');
		redirect(base_url('/sst/reportes/devueltos'), 'refresh');
		exit;
	}else{

        	$data['tramites_devueltos'] = $this->reportes_model->tramites_devueltos($fechai,$fechaf,0);
	        $data['js'] = array(base_url('assets/js/sst/reportes.js'));
	        $data['titulo'] = 'Reportes';
	        $data['contenido'] = 'reportes/devueltos';
        	$this->load->view('templates/layout_sst',$data);
	}
    }

    public function licencias(){

        $fechai= isset($_POST['fecha_i']) ? $_POST['fecha_i']:'';
        $fechaf= isset($_POST['fecha_f']) ? $_POST['fecha_f']:'';
	
	if(!empty($fechai) && !empty($fechaf)){

		$fec= date('Y-m-d',strtotime ($fechaf.'-31 day'));
		if($fechai<$fec){
			$this->session->set_flashdata('error', 'Estimado usuario ha elegido un rango de fecha superior a un mes. Favor ingrese nuevamente los datos</b>');
			redirect(base_url('/sst/reportes/licencias'), 'refresh');
			exit;
		}
	}

	

	if($fechai>$fechaf){
        	$this->session->set_flashdata('error', 'La Fecha de Inicio es superior a la fecha Final. Favor ingrese nuevamente los datos</b>');
		redirect(base_url('/sst/reportes/licencias'), 'refresh');
		exit;
	}else{
        	$data['licencias_emitidas'] = $this->reportes_model->licencias_emitidas($fechai,$fechaf,0);
	        $data['js'] = array(base_url('assets/js/sst/reportes.js'));
	        $data['titulo'] = 'Reportes';
	        $data['contenido'] = 'reportes/licencias';
	        $this->load->view('templates/layout_sst',$data);
	}
    }


    public function ver_contenido($id_tramite)
    {
        $data['tramite_info'] = $this->sst_model->tramite_info_validacion($id_tramite);
        $data['departamentos_col'] = $this->sst_model->departamentos_col();
        $data['tipo_identificacion'] = $this->sst_model->tipo_identificacion_todos();
        $data['tramite_registro'] = $this->sst_model->tramite_registro($id_tramite);
        $data['perfiles_natural'] = $this->sst_model->sst_perfiles_natural();
        $data['campos_accion_natural'] = $this->sst_model->sst_campos_accion_natural();
        $data['campos_accion_juridica'] = $this->sst_model->sst_campos_accion_juridica();
        $data['campos_tramite'] = $this->sst_model->sst_campos_tramite($id_tramite);
        $data['perfiles_tramite'] = $this->sst_model->sst_perfiles_tramite($id_tramite);
        $data['tramites_seguimientos'] = $this->sst_model->seguimiento_tramite($id_tramite);
        $data['tramites_proceso_usuario'] = $this->sst_model->tramites_proceso_usuario($data['tramite_info']->id_usuario, $id_tramite);
        $data['estados_validacion'] = $this->sst_model->estados_validacion($this->session->userdata('perfil'));
        $data['campos_tramite'] = $this->sst_model->sst_campos_tramite($id_tramite);
        $data['total_sedes'] = $this->sst_model->sst_campos_sedes($id_tramite);

        $data['js'] = array(base_url('assets/js/sst/validacion.js'));
        $data['titulo'] = 'Reportes';
        $data['contenido'] = 'reportes/ver_contenido';
        
        $this->load->view('templates/layout_sst',$data);
    }

    public function ministerio(){

        $data['js'] = array(base_url('assets/js/sst/reportes.js'));
        $data['titulo'] = 'Reportes';
        $data['contenido'] = 'reportes/ministerio';
        $this->load->view('templates/layout_sst',$data);
    }

    public function generarExcelMinisterio(){
        
        ini_set('memory_limit', '-1');
		$Name = 'reporte_ministerio'.$this->input->post('reporte').'.csv';
		
		
        //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
		
		header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
		header('Content-Disposition: attachment; filename='.$Name.'.csv');
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);

        $data['fecha_inicial'] = $this->input->post('fecha_inicial');
        $data['fecha_final'] = $this->input->post('fecha_final');

        if($this->input->post('reporte') == 'PN'){
            $data['listado_per'] = $this->reportes_model->consulta_persona_natural($data);            
            $this->load->view('reportes/reporte_ministerio_pn',$data, FALSE);
        }else if($this->input->post('reporte') == 'PJ'){
            $data['listado_per'] = $this->reportes_model->consulta_persona_juridica($data);
            $this->load->view('reportes/reporte_ministerio_pj',$data, FALSE);
        }
        
		

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

	public function reporteporcedulaSST() {


		$numdoc= isset($_POST['num_doc']) ? $_POST['num_doc']:'';
		if($numdoc == null){
			$data['tramitesinfo'] = null;
		}
		else{
			$data['tramitesinfo'] = $this->reportes_model->tramites_pornumdocSST($numdoc,0);
		}
		$data['js'] = array(base_url('assets/js/sst/reportes.js'));
		$data['titulo'] = 'Perfil Validaci&oacute;n';
		$data['contenido'] = 'reportes/tramites_porcedulasst_view';
		$this->load->view('templates/layout_sst',$data);

	}

    	public function buscarporcedulaSST() {

		$numdoc= isset($_POST['num_doc']) ? $_POST['num_doc']:'';
		$data['tramitesinfo'] = $this->reportes_model->tramites_pornumdocSST($numdoc,0);
		//var_dump($data['tramitesinfo']);
		$data['js'] = array(base_url('assets/js/sst/reportes.js'));
		$data['titulo'] = 'Perfil Validaci&oacute;n';
		$data['contenido'] = 'reportes/tramites_porcedulasst_view';
		$this->load->view('templates/layout_sst',$data);

    	}		

    	public function visualizar_documentos($id_tramite){
        
        $data['id_tramite'] = $id_tramite;
        $data['tramite_info'] = $this->sst_model->tramite_info_validacion($id_tramite);
	//var_dump($data['tramite_info']);
        $data['departamentos_col'] = $this->sst_model->departamentos_col();
        $data['tipo_identificacion'] = $this->sst_model->tipo_identificacion_todos();
        $data['tramite_registro'] = $this->sst_model->tramite_registro($id_tramite);
        $data['perfiles_natural'] = $this->sst_model->sst_perfiles_natural();
        $data['campos_accion_natural'] = $this->sst_model->sst_campos_accion_natural();
        $data['campos_accion_juridica'] = $this->sst_model->sst_campos_accion_juridica();
        $data['campos_tramite'] = $this->sst_model->sst_campos_tramite($id_tramite);
        $data['perfiles_tramite'] = $this->sst_model->sst_perfiles_tramite($id_tramite);
        $data['tramites_seguimientos'] = $this->sst_model->seguimiento_tramite($id_tramite);
        $data['tramites_proceso_usuario'] = $this->sst_model->tramites_proceso_usuario($data['tramite_info']->id_usuario, $id_tramite);
        $data['estados_validacion'] = $this->sst_model->estados_validacion($this->session->userdata('perfil'));
        $data['campos_tramite'] = $this->sst_model->sst_campos_tramite($id_tramite);
        $data['total_sedes'] = $this->sst_model->sst_campos_sedes($id_tramite);
	$data['js'] = array(base_url('assets/js/sst/validacion.js'));
	$data['titulo'] = 'Perfil Validaci&oacute;n';
	$data['contenido'] = 'reportes/visualizar_documentos';
	$this->load->view('templates/layout_sst',$data);      
    	}	
}
