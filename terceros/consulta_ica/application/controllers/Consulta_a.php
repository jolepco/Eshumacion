<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('consulta_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->helper('mysql_to_excel_helper');
		$this->load->database('default');		
    }
	
	public function index()
	{	
		$data['contenido'] = 'consulta_view';
		$data['titulo'] = 'Consulta SDS - ICA';
		//$data['tipo_ident'] = $this->login_model->lista_tipoident();
		$data['num_identif']='';
		/*$data['contrato']='';	*/	
		$data['existe']=0;
		//$aleatorio=rand(1,50);;
		//$data['cuenta'] = $this->consulta_model->traer_cuentas(); 
		/*$data['cuenta'] = 0; */
		$this->load->view('templates/layout_consulta',$data);
	}
 

	public function listadoJson() {

		$response['data'][0]['ANIO_GRAVABLE'] = '';      
		$response['data'][0]['TIPO_IDENTIFICACION'] = '';
		$response['data'][0]['NUM_IDENTIFICACION'] = '';
		$response['data'][0]['NOMBRE_RAZON_SOCIAL'] = '';      
		$response['data'][0]['BASE_GRAVABLE_NETA'] = '';
		$response['data'][0]['TOTAL_INGRESOS_BRUTOS_X_DISTRITO'] = '';
		$response['data'][0]['VALOR_RETEN_INDUSYCOMERCIO'] = '';
    $response['data'][0]['DEDUCCIONES_EXENCIONES_ACN'] = '';

		$cedula = $this->uri->segment(4);
		$tipo_ident = $this->uri->segment(3);	


		/*$contrato = $this->uri->segment(4);
		$cuenta = $this->uri->segment(5);*/

		if($cedula=='-'){$cedula="";}
		if($tipo_ident=='-'){$tipo_ident="";}
		/*if($contrato=='-'){$contrato="";}
		if($cuenta=='-'){$cuenta="";}*/

		$registro=0;

		/*if(!empty($cuenta) && (!empty($cedula) || !empty($contrato))){		*/
		if(!empty($cedula)  && !empty($tipo_ident)){
			$registro = $this->consulta_model->busca_registros($tipo_ident,$cedula);
			if(count($registro) > 0) {
	            foreach ($registro as $ku => $vu) {
                $response['data'][$ku]['ANIO_GRAVABLE'] = $registro[$ku]->ANIO_GRAVABLE;
                $response['data'][$ku]['TIPO_IDENTIFICACION'] = $registro[$ku]->TIPO_IDENTIFICACION;
                $response['data'][$ku]['NUM_IDENTIFICACION'] = $registro[$ku]->NUM_IDENTIFICACION;	
	             	$response['data'][$ku]['NOMBRE_RAZON_SOCIAL'] = $registro[$ku]->NOMBRE_RAZON_SOCIAL;
                 $response['data'][$ku]['BASE_GRAVABLE_NETA'] = "$".number_format($registro[$ku]->BASE_GRAVABLE_NETA);
                 $response['data'][$ku]['TOTAL_INGRESOS_BRUTOS_X_DISTRITO'] = "$".number_format($registro[$ku]->TOTAL_INGRESOS_BRUTOS_X_DISTRIT;
                 $response['data'][$ku]['VALOR_RETEN_INDUSYCOMERCIO'] = "$".number_format($registro[$ku]->VALOR_RETEN_INDUSYCOMERCIO);
                 $response['data'][$ku]['DEDUCCIONES_EXENCIONES_ACN'] = "$".number_format($registro[$ku]->DEDUCCIONES_EXENCIONES_ACN);
				}			

	        } else {
	            $response['codiError'] = 1;
	           // $this->session->set_flashdata('mensajeError', 'No encontrado');	           
	        }
    	}			
		$this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($response));
	}

	public function generarPlano( $tipo_ident=0, $cedula=0)
	{				
		if(empty($cedula)) {
			show_error('No se ha escrito identificación.', 400, 'Información incompleta');
			redirect(base_url().'/','refresh');
            return false;
		}
		
		$datos = $this->consulta_model->busca_registros_ced_xls($tipo_ident,$cedula);
		to_excel($datos, "ConsultaICA".$cedula);
	}
}