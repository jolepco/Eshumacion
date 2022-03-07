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

class Direccion extends MY_Controller
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

        $data['rayosx_pendientes'] = $this->xindustrial_model->rayosx_pendientes_director($this->session->userdata('perfil'));
        $data['festivos'] = $this->xindustrial_model->festivos_colombia();#rx
        $datosAr1 = $this->session->userdata('username');
        //var_dump($data['validacion']);
        $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
        $data['titulo'] = 'Perfil Dirección';
        $data['contenido'] = 'direccion/tramites_pendientes_view';
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
        //var_dump($data['observacionesTramite']);

        $data['resultado_validacion'] = $this->xindustrial_model->estado_tramite_validador_rx($this->session->userdata('perfil'));
        $data['tramites_pendientes'] = $this->xindustrial_model->tramite_info_validacion($id_tramite);
        $data['tipo_identificacion'] = $this->xindustrial_model->tipo_identificacion_todos();
        $data['departamentos_col'] = $this->xindustrial_model->departamentos_col();
        $data['tramites_seguimientos'] = $this->xindustrial_model->seguimiento_tramite($id_tramite);

        //$data['js'] = array(base_url('assets/js/rayosx.js'),base_url('assets/js/validacion_rx.js'));
        $data['js'] = array(base_url('assets/js/xindustrial/xindustrial_validacion.js'));
        $data['titulo'] = 'Perfil Dirección';
        $data['contenido'] = 'direccion/validar_documentos';

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

		    $datos['mostrarObsInfra'] = $_REQUEST['mostrarObsInfra'];

    		if($_REQUEST['resultado_validacion'] == '10'){
    			//APROBACION
    			if($_REQUEST['observaciones'] != ''){

    				$dataSeg['observaciones'] = $_REQUEST['observaciones'];

    			}else{
    				$dataSeg['observaciones'] = 'Aprobación validación de documentos';
    			}

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

          $datosR['codigo_verificacion'] = $this->genera_codigo();
          $datos['codigo_verificacion'] = $datosR['codigo_verificacion'];

          $consecutivo_actual = $this->xindustrial_model->consulta_consecutivo();
          $consecutivo = $consecutivo_actual->max_cons + 1;
          $datos['nume_resolucion'] = $consecutivo;

    			$datos['firma'] = TRUE;


					$ruta_archivos = "uploads/xindustrial/resoluciones/";
          $nombre_archivo = "Direccionaprobacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

            //load mPDF library para linux
            //$this->load->library('M_pdf');
            //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
          $this->load->library('M_pdf2');
          //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
          $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);



            //load mPDF library para windows
            //require_once APPPATH . 'libraries/vendor/autoload.php';
            //$mpdf = new \Mpdf\Mpdf();
          $mpdf->debug = false;
			    $mpdf->allow_output_buffering= true;
          $mpdf->showImageErrors = false;
          $mpdf->showWatermarkText = false;
			    $mpdf->SetWatermarkText('Aprobación');
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

			    $mpdf->SetHTMLHeader("<table class='table centro' width='100%'>
										<tr class='centro'>
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



		  }else if($_REQUEST['resultado_validacion'] == '12'){
        //MEGACION
		      if($_REQUEST['observaciones'] != ''){
    			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];
    		  }else{
    			  $dataSeg['observaciones'] = 'Negación validación de documentos';
    		  }

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

          $datosR['codigo_verificacion'] = $this->genera_codigo();
          $datos['codigo_verificacion'] = $datosR['codigo_verificacion'];

          $consecutivo_actual = $this->xindustrial_model->consulta_consecutivo();
          $consecutivo = $consecutivo_actual->max_cons + 1;
          $datos['nume_resolucion'] = $consecutivo;

    		  $datos['firma'] = TRUE;

    		  $ruta_archivos = "uploads/xindustrial/resoluciones/";
    		  $nombre_archivo = "Direccionnegacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

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
    		  $mpdf->debug = false;
    		  $mpdf->allow_output_buffering= true;
    		  $mpdf->showImageErrors = false;
    		  $mpdf->showWatermarkText = false;
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



  	  }else if($_REQUEST['resultado_validacion'] == '13'){
  		  //SUBSANACION
  		  if($_REQUEST['observaciones'] != ''){

  			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];

  		  }else{
  			  if($_REQUEST['resultado_validacion'] == '15'){
  				  $dataSeg['observaciones'] = 'Subsanación primera instancia';
  			  }else if($_REQUEST['resultado_validacion'] == '21'){
  				  $dataSeg['observaciones'] = 'Subsanación segunda instancia';
  			  }

  		  }

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

      		  $datos['firma'] = TRUE;

      		  $ruta_archivos = "uploads/xindustrial/resoluciones/";
      		  $nombre_archivo = "Directorsubsanacion-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

      		  //load mPDF library para linux
      		  //$this->load->library('M_pdf');
      		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
      		  $this->load->library('M_pdf2');
      		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
      		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


      		  //load mPDF library para windows
      		  //require_once APPPATH . 'libraries/vendor/autoload.php';
      		  //$mpdf = new \Mpdf\Mpdf();
      		  $mpdf->debug = false;
      		  $mpdf->allow_output_buffering= true;
      		  $mpdf->showImageErrors = false;
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
      		  if($_REQUEST['resultado_validacion'] == '7'){
      			  $mpdf->SetWatermarkText('Subsanación Primera Instancia');
      		  }else if($_REQUEST['resultado_validacion'] == '21'){
      			  $mpdf->SetWatermarkText('Subsanación Segunda Instancia');
      		  }

      		  $mpdf->AddPage();
      		  $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_rx_subsanacion_view', $datos, true));



	  }else if($_REQUEST['resultado_validacion'] == '41'){
		  //PROGRAMAR VISITA

    		  if($_REQUEST['observaciones'] != ''){

    			  $dataSeg['observaciones'] = $_REQUEST['observaciones'];

    		  }else{
    			  $dataSeg['observaciones'] = 'Programar visita';
    		  }


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

      		  $datos['firma'] = TRUE;


      		  $ruta_archivos = "uploads/xindustrial/resoluciones/";
      		  $nombre_archivo = "DireccionvisitaRX-".$_REQUEST['id_tramite']."-".$_REQUEST['resultado_validacion']."-".date('YmdHis').".pdf";

      		  //load mPDF library para linux
      		  //$this->load->library('M_pdf');
      		  //$mpdf = new mPDF('c', 'Letter', '', '', 20, 20, 40, 35, 5, 10 , 'P');
      		  $this->load->library('M_pdf2');
      		  //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
      		  $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);


      		  //load mPDF library para windows
      		  //require_once APPPATH . 'libraries/vendor/autoload.php';
      		  //$mpdf = new \Mpdf\Mpdf();
      		  $mpdf->debug = false;
      		  $mpdf->allow_output_buffering= true;
      		  $mpdf->showImageErrors = false;
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

		  if($_REQUEST['resultado_validacion'] != '18')
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

          if($_REQUEST['resultado_validacion'] == '10' || $_REQUEST['resultado_validacion'] == '12')
    		  {
          $datosR['id_tramite'] = $id_tramite;
          $datosR['codigo_verificacion'] = $datos['codigo_verificacion'];
          $datosR['anio'] = date('Y');
          $datosR['codi_tramite'] = 'RXV';
          $datosR['id_archivo'] = $resultadoID;
          $datosR['estado'] =  $_REQUEST['resultado_validacion'];
          $datos['nume_resolucion'] = $this->xindustrial_model->registro_resolucion_rx($datosR);
          }

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

                $dataEmail['nombre_usuario'] = $datos['datos_personales']->p_nombre." ".$datos['datos_personales']->s_nombre." ".$datos['datos_personales']->p_apellido." ".$datos['datos_personales']->s_apellido;
                $dataEmail['nombre_rs'] = $datos['datos_personales']->nombre_rs;
                $dataEmail['email'] = $datos_personales['email'];
                $dataEmail['titulo'] = "Respuesta Radicado Licencia de equipos industriales, veterinaria o de investigación - SDS";
                $dataEmail['tramite_id'] = $_REQUEST['id_tramite_rayosx'];

                $this->enviarCorreoResolucion($dataEmail);

							  $this->session->set_flashdata('exito', 'Se realizo el registro de la validaci&oacute;n del tramite</b>');
							  redirect(base_url('xindustrial/direccion/'), 'refresh');
							  exit;
						  }else{
							  $this->session->set_flashdata('error', 'Error al realizar la validación del tramite</b>');
							  redirect(base_url('xindustrial/direccion/'), 'refresh');
							  exit;
						  }

					  }else{
						  $this->session->set_flashdata('error', 'Error al realizar la validación de información</b>');
						  redirect(base_url('xindustrial/direccion/'), 'refresh');
						  exit;
					  }

					  $this->session->set_flashdata('exito', 'Se realizo el registro de la validaci&oacute;n de información</b>');
					  redirect(base_url('xindustrial/direccion/'), 'refresh');
					  exit;
				  }
			  }else{
				  $this->session->set_flashdata('error', 'Error al generar el documento PDF</b>');
				  redirect(base_url('xindustrial/direccion/'), 'refresh');
				  exit;
			  }
		  }else{

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
					  redirect(base_url('xindustrial/direccion/'), 'refresh');
					  exit;
				  }else{
					  $this->session->set_flashdata('error', 'Error al realizar la validación del tramite</b>');
					  redirect(base_url('xindustrial/direccion/'), 'refresh');
					  exit;
				  }

			  }else{
				  $this->session->set_flashdata('error', 'Error al realizar la validación de información</b>');
				  redirect(base_url('xindustrial/direccion/'), 'refresh');
				  exit;
			  }
		  }

		}else{
			$mpdf->Output();
		}

    }


    public function enviarCorreoResolucion($datos){
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
          <p>Una vez realizado el proceso de validación de documentos del Trámite de Licencia de equipos industriales, veterinaria o de investigación, se ha dado respuesta a su solicitud.</p>
          <p>Para visualizar la respuesta ingrese a <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> con su usuario y clave e ingrese a la opción "Mis Trámites"
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

}
