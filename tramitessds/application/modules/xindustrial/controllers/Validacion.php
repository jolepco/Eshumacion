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

class Validacion extends MY_Controller
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
        $this->load->model('validacion_model');		
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

        $data['rayosx_pendientes'] = $this->validacion_model->rayosx_pendientes($this->session->userdata('perfil'));
        $data['festivos'] = $this->xindustrial_model->festivos_colombia();#rx
        $datosAr1 = $this->session->userdata('username');        
        //var_dump($data['validacion']);
        $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
        $data['titulo'] = 'Perfil Validaci&oacute;n';
        $data['contenido'] = 'validacion/tramites_pendientes_view';
        $this->load->view('templates/layout_xindustrial',$data);
        
    }

    public function validar_documentos_rx($id_tramite)
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
    $data['visita1Tramite'] = $this->xindustrial_model->consulta_visita1($id_tramite);
    $data['visita2Tramite'] = $this->xindustrial_model->consulta_visita2($id_tramite);

	  $data['resultado_validacion'] = $this->xindustrial_model->estado_tramite_validador_rx($this->session->userdata('perfil'));

    //var_dump($data['resultado_validacion']);

	  $data['tramites_pendientes'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
	  $data['tipo_identificacion'] = $this->xindustrial_model->tipo_identificacion_todos();
	  $data['departamentos_col'] = $this->xindustrial_model->departamentos_col();
	  $data['tramites_seguimientos'] = $this->xindustrial_model->seguimiento_tramite($id_tramite);

	  //$data['js'] = array(base_url('assets/js/rayosx.js'),base_url('assets/js/validacion_rx.js'));
	  $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
	  $data['titulo'] = 'Perfil Validaci&oacute;n';
	  $data['contenido'] = 'validacion/validar_documentos';
	  
	  $this->load->view('templates/layout_xindustrial',$data);

  }

  public function guardarEstadoRx($id_tramite)
  {
	  $datos_auditoria['id_persona'] = $_REQUEST['id_persona'];
	  $datos_auditoria['id_usuario'] = $this->session->userdata('id_usuario');
	  //Actualizar los datos personales
	  $datos_personales['id_persona'] = $_REQUEST['id_persona'];
	  $datos_personales['tipo_identificacion'] = $_REQUEST['tipo_identificacion'];
	  //$datos_personales['nume_documento'] = $_REQUEST['nume_documento'];


	  if(isset($_REQUEST['tipo_iden_rl'])){
		  $datos_personales['tipo_iden_rl'] = $_REQUEST['tipo_iden_rl'];
	  }else{
		  $datos_personales['tipo_iden_rl'] = '';
	  }

	  if(isset($_REQUEST['nume_iden_rl'])){
		  $datos_personales['nume_iden_rl'] = $_REQUEST['nume_iden_rl'];
	  }else{
		  $datos_personales['nume_iden_rl'] = '';
	  }

	  if(isset($_REQUEST['nombre_rs'])){
		  $datos_personales['nombre_rs'] = $_REQUEST['nombre_rs'];
	  }else{
		  $datos_personales['nombre_rs'] = '';
	  }

	  if(isset($_REQUEST['fecha_nacimiento'])){
		  $datos_personales['fecha_nacimiento'] = $_REQUEST['fecha_nacimiento'];
	  }else{
		  $datos_personales['fecha_nacimiento'] = '';
	  }

	  if(isset($_REQUEST['sexo'])){
		  $datos_personales['sexo'] = $_REQUEST['sexo'];
	  }else{
		  $datos_personales['sexo'] = '';
	  }

	  if(isset($_REQUEST['genero'])){
		  $datos_personales['genero'] = $_REQUEST['genero'];
	  }else{
		  $datos_personales['genero'] = '';
	  }

	  if(isset($_REQUEST['orientacion'])){
		  $datos_personales['orientacion'] = $_REQUEST['orientacion'];
	  }else{
		  $datos_personales['orientacion'] = '';
	  }

	  if(isset($_REQUEST['etnia'])){
		  $datos_personales['etnia'] = $_REQUEST['etnia'];
	  }else{
		  $datos_personales['etnia'] = '';
	  }

	  if(isset($_REQUEST['estado_civil'])){
		  $datos_personales['estado_civil'] = $_REQUEST['estado_civil'];
	  }else{
		  $datos_personales['estado_civil'] = '';
	  }

	  if(isset($_REQUEST['nivel_educativo'])){
		  $datos_personales['nivel_educativo'] = $_REQUEST['nivel_educativo'];
	  }else{
		  $datos_personales['nivel_educativo'] = '';
	  }


	  $datos_personales['p_nombre'] = $_REQUEST['p_nombre'];
	  $datos_personales['s_nombre'] = $_REQUEST['s_nombre'];
	  $datos_personales['p_apellido'] = $_REQUEST['p_apellido'];
	  $datos_personales['s_apellido'] = $_REQUEST['s_apellido'];
	  $datos_personales['email'] = $_REQUEST['email'];
	  $datos_personales['telefono_fijo'] = $_REQUEST['telefono_fijo'];
	  $datos_personales['telefono_celular'] = $_REQUEST['telefono_celular'];

	  $actualizarDatosPersona = $this->xindustrial_model->actualizarDatosPersona($datos_personales);

	  $estado_infra = $_REQUEST['estadoInfra'];
	  $rayosxEquipo = $this->xindustrial_model->rayosxEquipo($id_tramite);
  
	  if($_REQUEST['fecha_visita']){
		  $dataAct['id_tramite'] = $id_tramite;
		  $dataAct['modulo'] = "fecha_visita";
		  $dataAct['estado'] = $_REQUEST['fecha_visita'];
		  $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);
	  }

	  if($_REQUEST['resultado_validacion'] == '5'){
		  //APROBACION
		  if($_REQUEST['observaciones'] != ''){

			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];

		  }else{
			  $dataSeg['observaciones'] = 'Aprobación validación de documentos';
		  }

		  $datos['nume_resolucion'] = 'XXXXXX';
		  switch(date('m')){
			  case '01': $datos['mes'] = 'Enero';	break;
			  case '02': $datos['mes'] = 'Febrero'; break;
			  case '03': $datos['mes'] = 'Marzo'; break;
			  case '04': $datos['mes'] = 'Abril';	break;
			  case '05': $datos['mes'] = 'Mayo'; break;
			  case '06': $datos['mes'] = 'Junio'; break;
			  case '07': $datos['mes'] = 'Julio';	break;
			  case '08': $datos['mes'] = 'Agosto'; break;
			  case '09': $datos['mes'] = 'Septiembre'; break;
			  case '10': $datos['mes'] = 'Octubre'; break;
			  case '11': $datos['mes'] = 'Noviembre'; break;
			  case '12': $datos['mes'] = 'Diciembre';	break;

		  }

		  $datos['datos_tramite'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
		  $datos['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
		  $datos['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
		  $datos['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
		  $datos['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
		  $datos['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
		  $datos['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
		  $datos['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
		  $datos['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
		  $datos['documentosTramite'] = $this->xindustrial_model->rayosxDocumentosValidacion($id_tramite);

		  $datos['obs_val1'] = $_REQUEST['observaciones_item1'];
		  $datos['obs_val2'] = $_REQUEST['observaciones_item2'];
		  $datos['obs_val3'] = $_REQUEST['observaciones_item3'];
		  $datos['obs_val4'] = $_REQUEST['observaciones_item4'];
		  $datos['obs_val5'] = $_REQUEST['observaciones_item5'];
		  $datos['obs_val6'] = $_REQUEST['observaciones_item6'];


		  $datos['firma'] = FALSE;

		  $ruta_archivos = "uploads/xindustrial/preliminares/";
		  $nombre_archivo = "Validadoraprobacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

		  //load mPDF library para linux
		  //$this->load->library('M_pdf');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
		  $this->load->library('M_pdf2');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


		  //load mPDF library para windows
		  //require_once APPPATH . 'libraries/vendor/autoload.php';
		  //$mpdf = new \Mpdf\Mpdf();
		  $mpdf->debug = true;
		  $mpdf->allow_output_buffering= true;
		  $mpdf->showImageErrors = true;
		  $mpdf->showWatermarkText = true;
		  $mpdf->SetWatermarkText('Aprobación');
		  $imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
		  $imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
		  $mpdf->SetHTMLHeader("<table class='table ' width='100%'>
									  <tr class=''>
										  <td width='100%'>
											  <img src='".$imagenHeader."' width='250px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->SetHTMLFooter("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenFooter."' width='550px'>
										  </td>
									  </tr>
								  </table>","O");

		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_aprobacion_rx_1', $datos, true));

		  if($datos['datos_tramite']->tipo_identificacion == 5){
				  $nombre_rs = $datos['datos_tramite']->nombre_rs;
				  $nombre_rl = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;
				  switch ($datos['datos_tramite']->tipo_iden_rl) {
					  case 1:
						  $tipo_iden_rl = "Cédula de ciudadanía";
						  break;
					  case 2:
						  $tipo_iden_rl = "Cédula de extranjería";
						  break;
					  case 3:
						  $tipo_iden_rl = "Tarjeta de identidad";
						  break;
					  case 4:
						  $tipo_iden_rl = "Permiso especial de permanencia";
						  break;
					  case 5:
						  $tipo_iden_rl = "NIT";
						  break;
				  }
				  $nume_iden_rl = $datos['datos_tramite']->nume_iden_rl;
			  }else{
				  $nombre_rs = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;
				  $nombre_rl = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;

				  $tipo_iden_rl = $datos['datos_tramite']->descTipoIden;
				  $nume_iden_rl = $datos['datos_tramite']->nume_identificacion;
			  }

		  $mpdf->SetHTMLHeader("<table class='table' width='100%'>
									  <tr class=''>
										  <td width='100%'>
											  <img src='".$imagenHeader."' width='250px'>
										  </td>
									  </tr>
									  <tr>
										  <td><p>continuación de la resolución No ".$datos['nume_resolucion']." de ".date('Y-m-d')." por la cual se concede licencia de practica industrial, veterinaria o de investigación para ".$nombre_rs." - ".$datos['rayosxDireccion']->sede_entidad.".</p></td>
									  </tr>
								  </table>","O");
		  $mpdf->SetHTMLFooter("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenFooter."' width='550px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_aprobacion_rx_2', $datos, true));


	  }else if($_REQUEST['resultado_validacion'] == '6'){
		  //NEGACION
		  if($_REQUEST['observaciones'] != ''){

			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];
			  $datos['observaciones'] = $_REQUEST['observaciones'];
		  }else{
			  $dataSeg['observaciones'] = 'Negación validación de documentos';
		  }

		  $datos['nume_resolucion'] = 'XXXXXX';
		  switch(date('m')){
			  case '01': $datos['mes'] = 'Enero';	break;
			  case '02': $datos['mes'] = 'Febrero'; break;
			  case '03': $datos['mes'] = 'Marzo'; break;
			  case '04': $datos['mes'] = 'Abril';	break;
			  case '05': $datos['mes'] = 'Mayo'; break;
			  case '06': $datos['mes'] = 'Junio'; break;
			  case '07': $datos['mes'] = 'Julio';	break;
			  case '08': $datos['mes'] = 'Agosto'; break;
			  case '09': $datos['mes'] = 'Septiembre'; break;
			  case '10': $datos['mes'] = 'Octubre'; break;
			  case '11': $datos['mes'] = 'Noviembre'; break;
			  case '12': $datos['mes'] = 'Diciembre';	break;

		  }

		  $datos['datos_tramite'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
		  $datos['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
		  $datos['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
		  $datos['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
		  $datos['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
		  $datos['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
		  $datos['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
		  $datos['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
		  $datos['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
		  $datos['documentosTramite'] = $this->xindustrial_model->rayosxDocumentosValidacion($id_tramite);


		  $datos['obs_val1'] = $_REQUEST['observaciones_item1'];
		  $datos['obs_val2'] = $_REQUEST['observaciones_item2'];
		  $datos['obs_val3'] = $_REQUEST['observaciones_item3'];
		  $datos['obs_val4'] = $_REQUEST['observaciones_item4'];
		  $datos['obs_val5'] = $_REQUEST['observaciones_item5'];
		  $datos['obs_val6'] = $_REQUEST['observaciones_item6'];
		  $datos['observaciones'] = $_REQUEST['observaciones'];
		  $datos['observaciones_visita'] = $_REQUEST['observaciones_visita'];
		  $datos['fecha_visita'] = $_REQUEST['fecha_visita'];

		  $datos['firma'] = FALSE;

		  $ruta_archivos = "uploads/xindustrial/preliminares/";
		  $nombre_archivo = "Validadornegacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

		  if($datos['datos_tramite']->categoria == 1){
				$categoria_romano = "I";
			}else{
				$categoria_romano = "II";
			}

		  //load mPDF library para linux
		  //$this->load->library('M_pdf');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
		  $this->load->library('M_pdf2');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


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
		  $mpdf->SetWatermarkText('Negación');
		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_negacion_rx_1', $datos, true));

		  if($datos['datos_tramite']->tipo_identificacion == 5){
				  $nombre_rs = $datos['datos_tramite']->nombre_rs;
				  $nombre_rl = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;
				  switch ($datos['datos_tramite']->tipo_iden_rl) {
					  case 1:
						  $tipo_iden_rl = "Cédula de ciudadanía";
						  break;
					  case 2:
						  $tipo_iden_rl = "Cédula de extranjería";
						  break;
					  case 3:
						  $tipo_iden_rl = "Tarjeta de identidad";
						  break;
					  case 4:
						  $tipo_iden_rl = "Permiso especial de permanencia";
						  break;
					  case 5:
						  $tipo_iden_rl = "NIT";
						  break;
				  }
				  $nume_iden_rl = $datos['datos_tramite']->nume_iden_rl;
			  }else{
				  $nombre_rs = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;
				  $nombre_rl = $datos['datos_tramite']->p_nombre." ".$datos['datos_tramite']->s_nombre." ".$datos['datos_tramite']->p_apellido." ".$datos['datos_tramite']->s_apellido;

				  $tipo_iden_rl = $datos['datos_tramite']->descTipoIden;
				  $nume_iden_rl = $datos['datos_tramite']->nume_identificacion;
			  }

		  $mpdf->SetHTMLHeader("<table class='table' width='100%'>
									  <tr class=''>
										  <td width='100%'>
											  <img src='".$imagenHeader."' width='250px'>
										  </td>
									  </tr>
									  <tr>
										  <td><p style='font-size:10px;'><i>Continuación de la resolución No ".$datos['nume_resolucion']." de ".date('Y-m-d')." por la cual se niega licencia de practica industrial, veterinaria o de investigación Categoría ".$categoria_romano.".</i></p></td>
									  </tr>
								  </table>","O");
		  $mpdf->SetHTMLFooter("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenFooter."' width='550px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_negacion_rx_2', $datos, true));



	  }else if($_REQUEST['resultado_validacion'] == '7'){
		  //SUBSANACION
		  if($_REQUEST['observaciones'] != ''){

			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];
			  $datos['observaciones'] = $_REQUEST['observaciones'];

		  }else{
			  if($_REQUEST['resultado_validacion'] == '7'){
				  $dataSeg['observaciones'] = 'Subsanación primera instancia';
			  }else if($_REQUEST['resultado_validacion'] == '21'){
				  $dataSeg['observaciones'] = 'Subsanación segunda instancia';
			  }

		  }

		  $datos['nume_resolucion'] = 'XXXXXX';
		  switch(date('m')){
			  case '01': $datos['mes'] = 'Enero';	break;
			  case '02': $datos['mes'] = 'Febrero'; break;
			  case '03': $datos['mes'] = 'Marzo'; break;
			  case '04': $datos['mes'] = 'Abril';	break;
			  case '05': $datos['mes'] = 'Mayo'; break;
			  case '06': $datos['mes'] = 'Junio'; break;
			  case '07': $datos['mes'] = 'Julio';	break;
			  case '08': $datos['mes'] = 'Agosto'; break;
			  case '09': $datos['mes'] = 'Septiembre'; break;
			  case '10': $datos['mes'] = 'Octubre'; break;
			  case '11': $datos['mes'] = 'Noviembre'; break;
			  case '12': $datos['mes'] = 'Diciembre';	break;

		  }

		  $datos['datos_tramite'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
		  $datos['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
		  $datos['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
		  $datos['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
		  $datos['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
		  $datos['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
		  $datos['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
		  $datos['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
		  $datos['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
		  $datos['documentosTramite'] = $this->xindustrial_model->rayosxDocumentosValidacion($id_tramite);

		  $datos['obs_val1'] = $_REQUEST['observaciones_item1'];
		  $datos['obs_val2'] = $_REQUEST['observaciones_item2'];
		  $datos['obs_val3'] = $_REQUEST['observaciones_item3'];
		  $datos['obs_val4'] = $_REQUEST['observaciones_item4'];
		  $datos['obs_val5'] = $_REQUEST['observaciones_item5'];
		  $datos['obs_val6'] = $_REQUEST['observaciones_item6'];

		  $datos['firma'] = FALSE;

		  $ruta_archivos = "uploads/xindustrial/preliminares/";
		  $nombre_archivo = "Validadorsubsanacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

		  //load mPDF library para linux
		  //$this->load->library('M_pdf');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
		  $this->load->library('M_pdf2');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


		  //load mPDF library para windows
		  //require_once APPPATH . 'libraries/vendor/autoload.php';
		  //$mpdf = new \Mpdf\Mpdf();
		  $mpdf->debug = true;
		  $mpdf->allow_output_buffering= true;
		  $mpdf->showImageErrors = true;
		  $mpdf->showWatermarkText = true;
		  $imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
		  $imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
		  $mpdf->SetHTMLHeader("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenHeader."' width='250px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->SetHTMLFooter("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenFooter."' width='550px'>
										  </td>
									  </tr>
								  </table>","O");
		  if($_REQUEST['resultado_validacion'] == '7'){
			  $mpdf->SetWatermarkText('Subsanación Primera Instancia');
		  }else if($_REQUEST['resultado_validacion'] == '21'){
			  $mpdf->SetWatermarkText('Subsanación Segunda Instancia');
		  }

		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_rx_subsanacion_view', $datos, true));


	  }else if($_REQUEST['resultado_validacion'] == '19'){
		  //PROGRAMAR VISITA

		  if($_REQUEST['observaciones'] != ''){

			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];
			  $datos['observaciones'] = $_REQUEST['observaciones'];

		  }else{
			  $dataSeg['observaciones'] = 'Programar visita';
		  }

		  $datos['nume_resolucion'] = 'XXXXXX';
		  switch(date('m')){
			  case '01': $datos['mes'] = 'Enero';	break;
			  case '02': $datos['mes'] = 'Febrero'; break;
			  case '03': $datos['mes'] = 'Marzo'; break;
			  case '04': $datos['mes'] = 'Abril';	break;
			  case '05': $datos['mes'] = 'Mayo'; break;
			  case '06': $datos['mes'] = 'Junio'; break;
			  case '07': $datos['mes'] = 'Julio';	break;
			  case '08': $datos['mes'] = 'Agosto'; break;
			  case '09': $datos['mes'] = 'Septiembre'; break;
			  case '10': $datos['mes'] = 'Octubre'; break;
			  case '11': $datos['mes'] = 'Noviembre'; break;
			  case '12': $datos['mes'] = 'Diciembre';	break;

		  }

		  $datos['datos_tramite'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
		  $datos['rayosxDireccion'] = $this->xindustrial_model->rayosxDireccion($id_tramite);
		  $datos['rayosxCategoria'] = $this->xindustrial_model->rayosxCategoria($id_tramite);
		  $datos['rayosxEquipo'] = $this->xindustrial_model->rayosxEquipo($id_tramite);
		  $datos['rayosxOficialToe'] = $this->xindustrial_model->rayosxOficialToe($id_tramite);
		  $datos['rayosxTemporalToe'] = $this->xindustrial_model->rayosxTemporalToe($id_tramite);
		  $datos['rayosxTalento'] = $this->xindustrial_model->rayosxTalento($id_tramite);
		  $datos['rayosxObjprueba'] = $this->xindustrial_model->rayosxObjprueba($id_tramite);
		  $datos['rayosxDocumentos'] = $this->xindustrial_model->rayosxDocumentos($id_tramite);
		  $datos['documentosTramite'] = $this->xindustrial_model->rayosxDocumentosValidacion($id_tramite);

		  $datos['obs_val1'] = $_REQUEST['observaciones_item1'];
		  $datos['obs_val2'] = $_REQUEST['observaciones_item2'];
		  $datos['obs_val3'] = $_REQUEST['observaciones_item3'];
		  $datos['obs_val4'] = $_REQUEST['observaciones_item4'];
		  $datos['obs_val5'] = $_REQUEST['observaciones_item5'];
		  $datos['obs_val6'] = $_REQUEST['observaciones_item6'];
      $datos['observaciones'] = $_REQUEST['observaciones'];

		  $datos['firma'] = FALSE;

		  $ruta_archivos = "uploads/xindustrial/preliminares/";
		  $nombre_archivo = "ValidadorvisitaRX-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

		  //load mPDF library para linux
		  //$this->load->library('M_pdf');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
		  $this->load->library('M_pdf2');
		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


		  //load mPDF library para windows
		  //require_once APPPATH . 'libraries/vendor/autoload.php';
		  //$mpdf = new \Mpdf\Mpdf();
		  $mpdf->debug = true;
		  $mpdf->allow_output_buffering= true;
		  $mpdf->showImageErrors = true;
		  $mpdf->showWatermarkText = false;
		  $imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
		  $imagenFooter = FCPATH."assets/imgs/logo_pdf_footer.png";
		  $mpdf->SetHTMLHeader("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenHeader."' width='250px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->SetHTMLFooter("<table class='table centro' width='100%'>
									  <tr class='centro'>
										  <td width='100%'>
											  <img src='".$imagenFooter."' width='550px'>
										  </td>
									  </tr>
								  </table>","O");
		  $mpdf->SetWatermarkText('Programar visita');
		  $mpdf->AddPage();
		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_rx_visita_view', $datos, true));


	  }



	  if(isset($_REQUEST['guardar'])){

		  if($_REQUEST['resultado_validacion'] != '8' && $_REQUEST['resultado_validacion'] != '21')
		  {

        $salvar = $mpdf->Output($ruta_archivos.$nombre_archivo, "F");

			  if(file_exists ( $ruta_archivos.$nombre_archivo )){
				  $datosAr['ruta'] = $ruta_archivos;
				  $datosAr['nombre'] = $nombre_archivo;
				  $datosAr['fecha'] = date('Y-m-d');
				  $datosAr['tags'] = "";
				  $datosAr['es_publico'] = 1;
				  $datosAr['estado'] = 'AC';

				  $resultadoID = $this->validacion_model->insertarArchivo($datosAr);

				  $datosObs['id_tramite'] = $id_tramite;
				  $datosObs['estado'] = $_REQUEST['resultado_validacion'];
				  $datosObs['id_usuario'] = $this->session->userdata('id_usuario');

				  if(trim($_REQUEST['observaciones_item1']) != ''){
					  $datosObs['observaciones1'] = $_REQUEST['observaciones_item1'];
				  }else{
					  $datosObs['observaciones1'] = "";
				  }

				  if(trim($_REQUEST['observaciones_item2']) != ''){
					  $datosObs['observaciones2'] = $_REQUEST['observaciones_item2'];
				  }else{
					  $datosObs['observaciones2'] = "";
				  }

				  if(trim($_REQUEST['observaciones_item3']) != ''){
					  $datosObs['observaciones3'] = $_REQUEST['observaciones_item3'];
				  }else{
					  $datosObs['observaciones3'] = "";
				  }

				  if(trim($_REQUEST['observaciones_item4']) != ''){
					  $datosObs['observaciones4'] = $_REQUEST['observaciones_item4'];
				  }else{
					  $datosObs['observaciones4'] = "";
				  }

				  if(trim($_REQUEST['observaciones_item5']) != ''){
					  $datosObs['observaciones5'] = $_REQUEST['observaciones_item5'];
				  }else{
					  $datosObs['observaciones5'] = "";
				  }

				  if(trim($_REQUEST['observaciones_item6']) != ''){
					  $datosObs['observaciones6'] = $_REQUEST['observaciones_item6'];
				  }else{
					  $datosObs['observaciones6'] = "";
				  }

				  if(trim($_REQUEST['observaciones']) != ''){
					  $datosObs['observaciones'] = $_REQUEST['observaciones'];
				  }else{
					  $datosObs['observaciones'] = "";
				  }

				  if(trim($_REQUEST['observaciones_visita']) != ''){
					  $datosObs['observaciones_visita'] = $_REQUEST['observaciones_visita'];
				  }else{
					  $datosObs['observaciones_visita'] = "";
				  }

				  $resultadoObservaciones = $this->xindustrial_model->registrarObservacionValidacion($datosObs);

				  if($resultadoID){

					  $dataAct['id_tramite'] = $id_tramite;
					  $dataAct['modulo'] = "estado";
					  $dataAct['estado'] = $_REQUEST['resultado_validacion'];
					  $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

					  if($resultRayosxEstado){
						  $dataflujo['tramite_id'] = $id_tramite;
						  $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
						  $dataflujo['id_estado'] = $_REQUEST['resultado_validacion'];
						  $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
						  $dataflujo['observaciones'] = $_REQUEST['observaciones'];
						  $dataflujo['id_archivo'] = $resultadoID;

						  $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

						  if($resultadoCrearTramiteFlujo){

							  if($datos['datos_tramite']->notificacion == 1){

								  if($_REQUEST['resultado_validacion'] == '19'){
									  $this->enviarCorreo($datos['datos_tramite']);
								  }
							  }

							  $this->session->set_flashdata('exito', 'Se realizo el registro de la validaci&oacute;n del tramite</b>');
							  redirect(base_url('xindustrial/validacion/'), 'refresh');
							  exit;
						  }else{
							  $this->session->set_flashdata('error', 'Error al realizar la validación del tramite</b>');
							  redirect(base_url('xindustrial/validacion/'), 'refresh');
							  exit;
						  }

					  }else{
						  $this->session->set_flashdata('error', 'Error al realizar la validación de información</b>');
						  redirect(base_url('xindustrial/validacion/'), 'refresh');
						  exit;
					  }

					  $this->session->set_flashdata('exito', 'Se realizo el registro de la validaci&oacute;n de información</b>');
					  redirect(base_url('xindustrial/validacion/'), 'refresh');
					  exit;
				  }
			  }else{
				  $this->session->set_flashdata('error', 'Error al generar el documento PDF</b>');
				  redirect(base_url('xindustrial/validacion/'), 'refresh');
				  exit;
			  }
		  }else{
			  $dataAct['id_tramite'] = $id_tramite;
			  $dataAct['modulo'] = "estado";
			  $dataAct['estado'] = $_REQUEST['resultado_validacion'];
			  $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

			  if($resultRayosxEstado){
				  $dataflujo['tramite_id'] = $id_tramite;
				  $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
				  $dataflujo['id_estado'] = $_REQUEST['resultado_validacion'];
				  $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
				  $dataflujo['observaciones'] = $_REQUEST['observaciones'];

				  $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

				  if($resultadoCrearTramiteFlujo){
					  $this->session->set_flashdata('exito', 'Se realizo el registro de la validaci&oacute;n del tramite</b>');
					  redirect(base_url('xindustrial/validacion/'), 'refresh');
					  exit;
				  }else{
					  $this->session->set_flashdata('error', 'Error al realizar la validación del tramite</b>');
					  redirect(base_url('xindustrial/validacion/'), 'refresh');
					  exit;
				  }

			  }else{
				  $this->session->set_flashdata('error', 'Error al realizar la validación de información</b>');
				  redirect(base_url('xindustrial/validacion/'), 'refresh');
				  exit;
			  }
		  }

	  }else{
		  $mpdf->Output();
	  }

  }

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
			  $mail->FromName = "Tramites en línea - SDS";
			  $mail->From = "hceu@saludcapital.gov.co";
			  //$mail->AddAddress($correo_electronico, "CUIDATE"); //replace myname and mypassword to yours
			  $mail->AddAddress($datos_tramite->email, $datos_tramite->email);
			  //$mail->AddReplyTo("acangel@saludcapital.gov.co", "DUES");
			  $mail->WordWrap = 50;
			  $mail->CharSet = 'UTF-8';
			  $mail->AddEmbeddedImage('assets/imgs/logo_pdf_alcaldia.png', 'imagen');
			  $mail->AddEmbeddedImage('assets/imgs/logo_pdf_footer.png', 'imagen2');
			  $mail->IsHTML(true); // set email format to HTML
			  $mail->Subject = 'Tramites en línea - SDS';

			  $html = "
					  <table border=\"0\" width=\"80% \" align= \"justify\"><tr align=\"justify\"><td style = \" border: inset 0pt\" >" .
					  "<p align=\"justify\"><img src='cid:imagen'/></p>" .
					  "</br><h3>Estimado(a): ".$datos_tramite->p_nombre." ".$datos_tramite->p_apellido."</h3> " .
					  "<p>El estado del trámite ".$datos_tramite->id." ha cambiado de estado, puede ingresar a través del siguiente <a href='" . base_url() ."'  target='_blank'>link</a></p>" .
					  "<p>Este estado corresponde a una comunicación enviada por la Secretaría Distrital de Salud y la cual debe ser revisada por el usuario</p>" .
					  "<p align=\"justify\"><img src='cid:imagen2'/></p></table>";

			  $mail->Body = nl2br ($html,false);

			  $mail->Send();

	  }catch (Exception $e){
		  print_r($e->getMessage());
		  exit;
	  }
  }

  public function actualizarFechaNotificacion($id_tramite, $id_subsanacion, $fecha){

	  if($id_tramite != '' && $id_subsanacion != '' && $fecha != ''){

		  $exd = date_create($fecha);
		  $fecha_subsana = date_format($exd,"Y-m-d H:i:s");

		  $dataAct['id_tramite'] = $id_tramite;
		  $dataAct['modulo'] = "fecha_subsanacion".$id_subsanacion;
		  $dataAct['estado'] = $fecha_subsana;

		  $resultRayosxEstado = $this->xindustrial_model->actualizarModulo($dataAct);

		  if($resultRayosxEstado){
			  $this->session->set_flashdata('exito', 'Se realizo el registro de la fecha de notificación</b>');
			  redirect(base_url('validacion/'), 'refresh');
			  exit;
		  }else{
			  $this->session->set_flashdata('exito', 'Error al registrar la fecha de notificación</b>');
			  redirect(base_url('validacion/'), 'refresh');
			  exit;
		  }


	  }


  }

  public function repor_consulta_rx(){

	  $datosAr1 = $this->session->userdata('username');
	  $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
	  $data['rayosx_pendientes'] = $this->xindustrial_model->reporte_rayosx();
	  //$data['js'] = array(base_url('assets/js/validacion.js'),base_url('assets/js/validacion_rx.js'));
	  $data['js'] = array(base_url('assets/js/validacion_rx.js'));
	  $data['titulo'] = 'Perfil Validaci&oacute;n';
	  $data['contenido'] = 'validacion/reporte_rx_view';
	  $this->load->view('templates/layout_rx',$data);

  }

  public function info_tramite_rx($id_tramite)
  {
	  $datosAr1 = $this->session->userdata('username');
	  $data['validacion'] = $this->login_model->info_usuariotramite($datosAr1);
	  $data['id_tramite'] = $id_tramite;
	  $data['tramite_info'] = $this->xindustrial_model->tramite_info($id_tramite);
	  $data['departamento'] = $this->xindustrial_model->departamentos_col();
	  $data['equipos_radiacion'] = $this->xindustrial_model->equipos_radiacion();
	  $data['tipo_visualizacion'] = $this->xindustrial_model->tipo_visualizacion();
	  $data['tipo_identificacion_natural'] = $this->login_model->tipo_identificacion();
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

	  $data['resultado_validacion'] = $this->xindustrial_model->estado_tramite_validador_rx($this->session->userdata('perfil'));
	  $data['tramites_pendientes'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
	  $data['tipo_identificacion'] = $this->login_model->tipo_identificacion_todos();
	  $data['departamentos_col'] = $this->login_model->departamentos_col();
	  $data['tramites_seguimientos'] = $this->xindustrial_model->seguimiento_tramite($id_tramite);

	  //$data['js'] = array(base_url('assets/js/rayosx.js'),base_url('assets/js/validacion_rx.js'));
	  $data['js'] = array(base_url('assets/js/rayosx.js'));
	  $data['titulo'] = 'Perfil Validaci&oacute;n';
	  $data['contenido'] = 'validacion/info_tramite_rx_view';

	  $this->load->view('templates/layout_rx',$data);

  }

}
