<?php defined('BASEPATH') or exit('No direct script access allowed');

class Consultas extends MY_Controller
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

    public function rayosx(){
        $this->load->model("consultas_models");
        $data['js'] = array(base_url('assets/js/expendedor/validate/reportes.js'));
        $datosAr1 = $this->session->userdata('username');
        $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
        $fechai= $this->input->post('fecha_i');
        $fechaf= $this->input->post('fecha_f');

        $this->session->set_userdata('fechai',$fechai);
        $this->session->set_userdata('fechaf',$fechaf);
        $data['listado_soli'] = $this->consultas_models->listarSolicitudesRX($fechai,$fechaf,0);
        $data['contenido'] = 'tramitesrx_rango_view';
       
        $this->load->view('templates/layout_expendedor',$data);
    }
    public function ver_historico($idtramite,$tramite){
        $this->load->model("consultas_models");
        $idpersona = $this->session->userdata('idpersona');
        if($tramite==3){
            $data['auditoria']=$this->consultas_models->consulta_auditoriaRX($idtramite);
        }else if($tramite==4){
            $data['auditoria']=$this->consultas_models->consulta_auditoriaED($idtramite);
        }else if($tramite==5){
            $data['auditoria']=$this->consultas_models->consulta_auditoriaSST($idtramite);
        }else if($tramite==6){
            $data['auditoria']=$this->consultas_models->consulta_auditoriaAP($idtramite);
        }else if($tramite==7){
            $data['auditoria']=$this->consultas_models->consulta_auditoriaEI($idtramite);
        }
        $data['contenido']="ver_auditoria_view";
        $this->load->view('templates/layout_expendedor',$data);
    }

     public function reportes_fechas() {
        $this->load->model("consultas_models");
        $datosAr1 = $this->session->userdata('username');
        $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
        $fechai= $this->input->post('fecha_i');
        $fechaf= $this->input->post('fecha_f');

        $this->session->set_userdata('fechai',$fechai);
        $this->session->set_userdata('fechaf',$fechaf);
        $data['listado_soli'] = $this->consultas_models->tramites_rango($fechai,$fechaf,0);
        $data['js'] = array(base_url('assets/js/expendedor/validate/reportes.js'));
        $data['contenido'] = 'tramites_rango_view';
        
        $this->load->view('templates/layout_expendedor',$data);
    }

    public function generar_excel($tipo_reporte){
        $this->load->model("consultas_models");
        $fechai= $this->session->userdata('fechai');
       $fechaf= $this->session->userdata('fechaf');
        $fechaInicial=$this->consultas_models->formatoFecha($fechai,'/'); 
        $fechaFinal=$this->consultas_models->formatoFecha($fechaf,'/'); 
        $fec=strtotime ('-31 day', strtotime($_GET['fechaFinal']));
        $fec2= date('Y-m-d', $fec);
        $fecha=date('dmY his');

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time','600');
        $name="Rayos x".$fecha.".csv";
                
        $data['listado'] = $this->consultas_models->listarSolicitudesRX($fechai,$fechaf,0);

        //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
        //$datos['data'] = $data;
        header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
        header('Content-Disposition: attachment; filename='.$name.'');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
                
        $this->load->view('reporte_rangoFechas_view',$data, FALSE);
        
    }
}
