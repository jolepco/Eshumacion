<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('consulta_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		
		$this->load->database('default');		
    }
	
	public function index()
	{	
		$this->load->helper('mysql_to_excel_helper');
		$data['contenido'] = 'consulta_view';
		$data['titulo'] = 'Consulta Pagos SDS';
		//$data['tipo_identif'] = $this->login_model->lista_tipoident();
		$data['num_identif']='';
		$data['contrato']='';		
		$data['existe']=0;
		//$aleatorio=rand(1,50);;
		//$data['cuenta'] = $this->consulta_model->traer_cuentas(); 
		$data['cuenta'] = 0; 
		$this->load->view('templates/layout_consulta',$data);
	}
 
	/* public function buscar(){		
		$data['contenido'] = 'consulta_view';	 
		$data['titulo'] = 'Consulta Pagos SDS';	
		$data['num_identif']='';
		$data['contrato']='';
		$data['cuenta']=0;
		$data['existe']=0;	

				
		$cedula = $this->input->post('num_identif');
		$contrato = $this->input->post('contrato'); 
		$cuenta = $this->input->post('cuenta'); 
		$exists = false;		
		 
		if(empty($contrato) && !empty($cedula)){
			$exists = $this->consulta_model->busca_registros_ced($cedula,$cuenta);
		}

		if(empty($cedula) && !empty($contrato)){
			$exists = $this->consulta_model->busca_registros_con($contrato,$cuenta);	
		}
		
		if(!empty($contrato) && !empty($cedula)){
			$exists = $this->consulta_model->busca_registros($cedula, $contrato,$cuenta);
		}	
		
	
		if($exists == TRUE)
		{	$data['VIGENCIA']=$exists->VIGENCIA;
			$data['NIT_CEDULA']=$exists->NIT_CEDULA;
			$data['NOMBRE']=$exists->NOMBRE;
			$data['CTO_CONVENIO']=$exists->CTO_CONVENIO;
			$data['FECHA_DILIGENCIAMIENTO']=$exists->FECHA_DILIGENCIAMIENTO;
			$data['FECHA_APROBACION']=$exists->FECHA_APROBACION;
			$data['ESTADO']=$exists->ESTADO;
			$data['FECHA_GIRO']=$exists->FECHA_APROBACION;
			$data['PLANILLA']=$exists->PLANILLA;
			$data['ORDEN_PAGO']=$exists->ORDEN_PAGO ;
			$data['BRUTO']=$exists->BRUTO;
			$data['VALOR_GIRADO']=$exists->VALOR_GIRADO;
			$data['DETALLE']=$exists->DETALLE;
			$data['NOMBRE_BANCO']=$exists->NOMBRE_BANCO;
			$data['CUENTA_BANCO_RECEPTOR']=$exists->CUENTA_BANCO_RECEPTOR;
			$data['existe']=1;			
		}else{
			$data['tipo_doc']=$tipo_doc_dg;
			$data['tipo_doc2']=$tipo_doc_dg;
			$data['num_identif']=$num_identif;
			$data['existe']=2;
			$data['mensajeNE'] =' No se encuentran pagos con estos parametros de busqueda';
		}  
	 			
		$this->load->view('templates/layout_consulta',$data);		
	 }
	 */

	 public function cargaCuentas(){
	 	$num_identif = $this->input->post('num_identif');	
		$datos = $this->consulta_model->traer_cuenta_ced($num_identif); 

		if(count($datos) > 0){
			foreach($datos as $key => $value) {
				$arreglo[$key]['CUENTA_BANCO_RECEPTOR'] = $value->CUENTA_BANCO_RECEPTOR;			
			}
			//var_dump($arreglo); exit;
			$this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($arreglo));
		}			
	 }

	  public function cargaCuentasCon(){
	 	$contrato = $this->input->post('contrato');	
		$datos = $this->consulta_model->traer_cuenta_con($contrato); 

		if(count($datos) > 0){
			foreach($datos as $key => $value) {
				$arreglo[$key]['CUENTA_BANCO_RECEPTOR'] = $value->CUENTA_BANCO_RECEPTOR;			
			}
			//var_dump($arreglo); exit;
			$this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($arreglo));
		}			
	 }

	public 	function traer_nombre()
	{
		$num_identif = $this->input->post('num_identif');
		$cuenta = $this->input->post('cuenta');
		$datos = $this->consulta_model->trae_n_cedula($num_identif, $cuenta);
		
		if(count($datos) > 0){
			$arreglo['nombre'] = $datos[0]->NOMBRE;
			echo json_encode($arreglo);		
		}else{
			 $response['codiError'] = 1;
			$this->session->set_flashdata('mensajeError', 'No encontrado');	
			
		}			
	}

	public 	function traer_nombre_con()
	{
		$contrato = $this->input->post('contrato');
		$cuenta = $this->input->post('cuenta');
		$datos = $this->consulta_model->trae_n_contrato($contrato, $cuenta);

		if(count($datos) > 0){
			$arreglo['nombre'] = $datos[0]->NOMBRE;
			echo json_encode($arreglo);			
		}else{
			$response['codiError'] = 1;
			$this->session->set_flashdata('mensajeError', 'No encontrado');				
		}	
	}

	public function listadoJson() {

		$response['data'][0]['VIGENCIA'] = '';				
		$response['data'][0]['NIT_CEDULA'] = '';
       /* $response['data'][0]['NOMBRE'] = '';		*/
		$response['data'][0]['CTO_CONVENIO'] = '';
		/*$response['data'][0]['FECHA_DILIGENCIAMIENTO'] = '';	
		$response['data'][0]['FECHA_APROBACION'] = '';*/
		$response['data'][0]['ESTADO'] = '';
		$response['data'][0]['FECHA_GIRO'] = '';
		$response['data'][0]['PLANILLA'] = '';
		$response['data'][0]['ORDEN_PAGO'] = '';
		$response['data'][0]['BRUTO'] = '';
		$response['data'][0]['VALOR_GIRADO'] = '';
		$response['data'][0]['DETALLE'] = '';
		$response['data'][0]['NOMBRE_BANCO'] = '';
		$response['data'][0]['CUENTA_BANCO_RECEPTOR'] = '';		

		$cedula = $this->uri->segment(3);
		$contrato = $this->uri->segment(4);
		$cuenta = $this->uri->segment(5);

		if($cedula=='-'){$cedula="";}
		if($contrato=='-'){$contrato="";}
		if($cuenta=='-'){$cuenta="";}

		$registro=0;

		if(!empty($cuenta) && (!empty($cedula) || !empty($contrato))){		
			if(empty($contrato) && !empty($cedula)){
				$registro = $this->consulta_model->busca_registros_ced($cedula,$cuenta);
			}

			if(empty($cedula) && !empty($contrato)){
				$registro = $this->consulta_model->busca_registros_con($contrato,$cuenta);	
			}
			
			if(!empty($contrato) && !empty($cedula)){
				$registro = $this->consulta_model->busca_registros($cedula, $contrato,$cuenta);
			}

			if(count($registro) > 0) {
	            foreach ($registro as $ku => $vu) {		          
	             	$response['data'][$ku]['VIGENCIA'] = $registro[$ku]->VIGENCIA;
					$response['data'][$ku]['NIT_CEDULA'] = $registro[$ku]->NIT_CEDULA;
					/*$response['data'][$ku]['NOMBRE'] = $registro[$ku]->NOMBRE;*/
	                $response['data'][$ku]['CTO_CONVENIO'] = $registro[$ku]->CTO_CONVENIO;	
				/*	$response['data'][$ku]['FECHA_DILIGENCIAMIENTO'] = $registro[$ku]->FECHA_DILIGENCIAMIENTO;
					$response['data'][$ku]['FECHA_APROBACION'] = $registro[$ku]->FECHA_APROBACION;*/
					$response['data'][$ku]['ESTADO'] = $registro[$ku]->ESTADO;
					$response['data'][$ku]['FECHA_GIRO'] = $registro[$ku]->FECHA_GIRO;
	                $response['data'][$ku]['PLANILLA'] = $registro[$ku]->PLANILLA;
	                $response['data'][$ku]['ORDEN_PAGO'] = "<a href='".base_url('consulta/generarPDF/'.$registro[$ku]->VIGENCIA.'/'.$contrato.'/'.$cedula.'/'.$registro[$ku]->ORDEN_PAGO)."' target='_blank'>".$registro[$ku]->ORDEN_PAGO."</a>";
					$response['data'][$ku]['BRUTO'] = "$".number_format($registro[$ku]->BRUTO);
					$response['data'][$ku]['VALOR_GIRADO'] = "$".number_format($registro[$ku]->VALOR_GIRADO);
	                $response['data'][$ku]['DETALLE'] = $registro[$ku]->DETALLE;
	                $response['data'][$ku]['NOMBRE_BANCO'] = $registro[$ku]->NOMBRE_BANCO;
	                $response['data'][$ku]['CUENTA_BANCO_RECEPTOR'] = $registro[$ku]->CUENTA_BANCO_RECEPTOR;
				}			

	        } else {
	            $response['codiError'] = 1;
	           // $this->session->set_flashdata('mensajeError', 'No encontrado');	           
	        }
    	}			
		$this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($response));
	}

	public function generarPlano($cedula=0, $contrato=0,  $cuenta=0)
	{		
		if(empty($cuenta)) {
			show_error('No se ha seleccionado la cuenta.', 400, 'Información incompleta');
			redirect(base_url().'consulta/','refresh');
            return false;
		}
		
		
		ini_set('memory_limit', '512M');
        ini_set('max_execution_time','600');
        $name="AutorizacionPlazas".$fecha.".csv";
        $data['listado_pagos']= $this->consulta_model->busca_registros($cedula, $contrato,$cuenta);        
        
        //$data['listado_con'] = $this->formsp_model->registroPersonasContactos();
        //$datos['data'] = $data;
        header("Content-Type: application/x-octet-stream; charset=UTF-16LE");
        header('Content-Disposition: attachment; filename='.$name.'');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
                
        $this->load->view('reportes_excel',$data, FALSE);
		
	}

	public function generarPDF($vigencia, $contrato, $nit, $op){
		$datos['pago'] = $this->consulta_model->trae_datos_pagos_contrato($vigencia, $contrato, $nit, $op);
		$datos['descuento'] = $this->consulta_model->trae_datos_descuentos_contrato($vigencia, $contrato, $nit, $op);
		$datos['img_qr']=$this->generar_qr($contrato,$vigencia);
		$data['nomimg']=$contrato.'_'.$vigencia;		
        $nombre_archivo = "recibo_".$contrato.'_'.$vigencia.".pdf";
        
		$this->load->library('M_pdf2');
		//$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
		$mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 5,'margin_right' => 5,'margin_top' => 15,'margin_bottom' => 15,'margin_header' => 5,'margin_footer' => 5]);
		
		//load mPDF library para windows
		//require_once APPPATH . 'libraries/vendor/autoload.php';
		//$mpdf = new \Mpdf\Mpdf();
		$mpdf->debug = true;
		$mpdf->allow_output_buffering= true;
		$mpdf->showImageErrors = true;
		$mpdf->showWatermarkText = true;

		$imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
		$imagenFooter = $data['img_qr'];
		$imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
		/*$mpdf->SetHTMLHeader("<table class='sinborde centro' width='100%' border='0'>
									<tr class='centro'> 
										<td width='100%'>
											<img src='".$imagenHeader."' width='250px'>
										</td>
									</tr>
								</table>","O");*/
		$mpdf->SetHTMLFooter("<table class='sinborde centro' border='0' width='100%'>
									<tr class='centro'> 
										<td width='100%'>
											<img src='".$imagenFooter."' width='550px'>
										</td>
									</tr>
								</table>","O"); 
		
		$mpdf->SetWatermarkText('Consulta Pagos');
		$mpdf->AddPage();		
		$mpdf->WriteHTML($this->load->view('formato_pagos', $datos, true)); 
		$mpdf->Output($nombre_archivo.'.pdf', 'I');
	}

	function generar_qr($contrato,$vigencia) {

		$this->load->library('ciqrcode');
        //hacemos configuraciones
        $contrat=$contrato.'_'.$vigencia;
        $params['data'] = base_url('consulta/validar/'.base64_encode($contrat));
        $params['level'] = 'H';
        $params['size'] = 10;
        
        //decimos el directorio a guardar el codigo qr, en este 
        //caso una carpeta en la raíz llamada qr_code

		$params['savename'] = FCPATH .'uploads/qr_code/qr_'.$contrat.'.png';
		//generamos el código qr
        $this->ciqrcode->generate($params); 
		//return 	'qr_'.$id_persona.'.png';
		return 	$params['savename'];		
	}

	public function validar($contrato){
		
		$id_contrato = base64_decode($contrato);
		$contr=explode("_",$id_contrato);
		
		$data['pago'] = $this->consulta_model->pagos_contrato_id($contr[1], $contr[0]);
		
		$data['titulo'] = 'Consulta Pagos SDS';
        $data['contenido'] = "validacion_contrato";
        $data['controller']="ConsultaPagos";
		$this->load->view('templates/layout_consulta',$data);
		
	}
}