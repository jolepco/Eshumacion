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

        $data['tramites_pendientes'] = $this->sst_model->sst_pendientes($this->session->userdata('perfil'));

        $data['js'] = array(base_url('assets/js/sst/direccion.js'));
        $data['titulo'] = 'Perfil Direcci&oacute;n';
        $data['contenido'] = 'direccion/tramites_pendientes_view';
        $this->load->view('templates/layout_sst',$data);
    }

    public function validar_documentos_sst($id_tramite){
        
        $data['id_tramite'] = $id_tramite;

        $data['departamentos_col'] = $this->sst_model->departamentos_col();
        $data['tipo_identificacion'] = $this->sst_model->tipo_identificacion_todos();
        $data['tramite_info'] = $this->sst_model->tramite_info_validacion($id_tramite);
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

        if($data['tramite_info']->id_estado == 7 || $data['tramite_info']->id_estado == 8){
            $data['js'] = array(base_url('assets/js/sst/direccion.js'));
            $data['titulo'] = 'Perfil Direcci&oacute;n';
            $data['contenido'] = 'direccion/validar_documentos';
            
            $this->load->view('templates/layout_sst',$data);
        }else{
            $data['js'] = array(base_url('assets/js/sst/direccion.js'));
            $data['titulo'] = 'Perfil Direcci&oacute;n';
            $data['contenido'] = 'direccion/tramite_finalizado';
            
            $this->load->view('templates/layout_sst',$data);
        }

    }

    public function guardarEstado($id_tramite){
        
        if($this->input->post('tipo_identificacion') == 5){

            $datosJuridicaSet['nombre_rs'] = $this->input->post('nombre_rs');
            $datosJuridicaSet['telefono_celular'] = $this->input->post('telefono_celular');
            $datosJuridicaSet['telefono_fijo'] = $this->input->post('telefono_fijo');
            $datosJuridicaSet['email'] = $this->input->post('email');
            $datosJuridicaSet['tipo_iden_rl'] = $this->input->post('tipo_iden_rl');
            $datosJuridicaSet['nume_iden_rl'] = $this->input->post('nume_iden_rl');
            $datosJuridicaSet['p_nombre'] = $this->input->post('p_nombre');
            $datosJuridicaSet['s_nombre'] = $this->input->post('s_nombre');
            $datosJuridicaSet['p_apellido'] = $this->input->post('p_apellido');
            $datosJuridicaSet['s_apellido'] = $this->input->post('s_apellido');
            $datosJuridicaWhere['id_persona'] = $this->input->post('id_persona');

            $resultadoUpdatePersona = $this->sst_model->actualizar_persona_sst($datosJuridicaSet,$datosJuridicaWhere);

        }else{
            $datosNaturalSet['p_nombre'] = $this->input->post('p_nombre');
            $datosNaturalSet['s_nombre'] = $this->input->post('s_nombre');
            $datosNaturalSet['p_apellido'] = $this->input->post('p_apellido');
            $datosNaturalSet['s_apellido'] = $this->input->post('s_apellido');
            $datosNaturalSet['telefono_celular'] = $this->input->post('telefono_celular');
            $datosNaturalSet['telefono_fijo'] = $this->input->post('telefono_fijo');
            $datosNaturalSet['email'] = $this->input->post('email');
            $datosNaturalSet['dire_resi'] = $this->input->post('direccion');
            $datosNaturalWhere['id_persona'] = $this->input->post('id_persona');

            $resultadoUpdatePersona = $this->sst_model->actualizar_persona_sst($datosNaturalSet,$datosNaturalWhere);
        }

        $documentos = array("pdf_acta");
        
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
                $dataActa[$documentos[$i]] = $resultadoIDDocumento;
                $dataActa['id_tramite'] = $this->input->post('id_tramite');
                $resultadoActa = $this->sst_model->actualizarDocumentoActa($dataActa);

            }
        }


        if($this->input->post('tipo_identificacion') != 5){

            $dataLimpiar['id_tramite'] = $this->input->post('id_tramite');
            $resultadoLimpiar = $this->sst_model->limpiarCampoValidacion($dataLimpiar);
            
            for($i=1;$i<=$this->input->post('total_campos_accion');$i++){
                if($this->input->post('areas-'.$i)){
                    for($j=0;$j<count($this->input->post('areas-'.$i));$j++){

                        $dataArea['id_tramite'] = $this->input->post('id_tramite');
                        $dataArea['contador'] = $i;
                        $dataArea['sede'] = '';
                        $dataArea['id_perfil'] = $this->input->post('perfiles-'.$i);
                        $dataArea['id_campo'] = $this->input->post('areas-'.$i)[$j];

                        $resultadoCampoValidacion = $this->sst_model->insertarCampoValidacion($dataArea);

                    }
                }
            }          

        }else{

            $dataLimpiar['id_tramite'] = $this->input->post('id_tramite');
            $resultadoLimpiar = $this->sst_model->limpiarCampoValidacion($dataLimpiar);

            for($i=1;$i<=$this->input->post('total_campos_accion');$i++){

                for($j=0;$j<count($this->input->post('areas-'.$i));$j++){

                    $dataArea['id_tramite'] = $this->input->post('id_tramite');
                    $dataArea['contador'] = $i;
                    $dataArea['sede'] = $this->input->post('sede_campo-'.$i);
                    $dataArea['id_perfil'] = '';
                    $dataArea['id_campo'] = $this->input->post('areas-'.$i)[$j];                    

                    $resultadoCampoValidacion = $this->sst_model->insertarCampoValidacion($dataArea);

                }

            }

        }
        
        //Actualización datos registro
        $dataRegistro['id_tramite'] = $this->input->post('id_tramite');   
        $dataRegistro['labora'] = $this->input->post('labora_actual');   
        $dataRegistro['nombre_empresa'] = $this->input->post('nombre_empresa');   
        $dataRegistro['dir_empresa'] = $this->input->post('dir_empresa');   
        $dataRegistro['depto_empresa'] = $this->input->post('depto_empresa');   
        $dataRegistro['mpio_empresa'] = $this->input->post('mpio_empresa');   
        $dataRegistro['tel_empresa'] = $this->input->post('tel_empresa');   
        $dataRegistro['fax_empresa'] = $this->input->post('fax_empresa');   
        $dataRegistro['servicios'] = $this->input->post('servicios');   
        $dataRegistro['caracteristicas'] = $this->input->post('caracteristicas');   
        $dataRegistro['otros'] = $this->input->post('otros');   
        $dataRegistro['tipo_programa'] = $this->input->post('tipo_programa');   
        $dataRegistro['tipo_titulo'] = $this->input->post('tipo_titulo');   
        $dataRegistro['tipo_profesional'] = $this->input->post('tipo_profesional');   
        $dataRegistro['titulo_programa'] = $this->input->post('titulo_programa');
        $dataRegistro['titulo_postgrado'] = $this->input->post('titulo_postgrado');             
        $dataRegistro['direccion_entidad'] = $this->input->post('direccion_entidad');   
           
        
        $resultadoActualizarRegistro = $this->sst_model->actualizarRegistroTramite($dataRegistro);

        if($this->input->post('requiere_visita') && $this->input->post('requiere_visita') == 'S')
        {
            $dataEstado['id_tramite'] = $this->input->post('id_tramite');            
            $dataEstado['acta_visita'] = $this->input->post('acta_visita');
            $dataEstado['fecha_visita'] = $this->input->post('fecha_visita');

            $resultadoActaTramite = $this->sst_model->actualizarActaTramite($dataEstado);
        }else{
            $dataEstado['id_tramite'] = $this->input->post('id_tramite');            
            $dataEstado['acta_visita'] = NULL;
            $dataEstado['fecha_visita'] = NULL;

            $resultadoActaTramite = $this->sst_model->actualizarActaTramite($dataEstado);
        }

        if($this->input->post('num_resolucion_anterior') != '' && $this->input->post('fecha_resolucion_anterior') != ''){

            $dataResolucionAnt['id_tramite'] = $this->input->post('id_tramite');  
            $dataResolucionAnt['num_resolucion_anterior'] = $this->input->post('num_resolucion_anterior');    
            $dataResolucionAnt['fecha_resolucion_anterior'] = $this->input->post('fecha_resolucion_anterior'); 
            $dataResolucionAnt['num_resolucion_articulo'] = $this->input->post('num_resolucion_articulo');    
            $dataResolucionAnt['fecha_resolucion_articulo'] = $this->input->post('fecha_resolucion_articulo');

            $resultadoResolucionAnterior = $this->sst_model->actualizarResolucionAnterior($dataResolucionAnt);
        }

        $datos['id_tramite'] = $id_tramite;
        $datos['tramite_info'] = $this->sst_model->tramite_info_validacion($id_tramite);           
        $datos['tramite_registro'] = $this->sst_model->tramite_registro($id_tramite);
        $datos['perfiles_tramite'] = $this->sst_model->sst_perfiles_tramite($id_tramite);
        $datos['campos_tramite'] = $this->sst_model->sst_campos_tramite($id_tramite);
        $datos['total_sedes'] = $this->sst_model->sst_campos_sedes($id_tramite);
        $datos['observaciones'] = $this->input->post('observaciones');
        
        if($this->input->post('resultado_validacion') == 10){
            //Aprobacion    
            
            $this->load->library('M_pdf2');
            //$mpdf = new mPDF('c', 'Letter', '', '', 10, 10, 30, 1, 5, 5 , 'P');
            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P','margin_left' => 10,'margin_right' => 10,'margin_top' => 36,'margin_bottom' => 20,'margin_header' => 5,'margin_footer' => 5]);

            //load mPDF library para windows
            //require_once APPPATH . 'libraries/vendor/autoload.php';
            //$mpdf = new \Mpdf\Mpdf();
            $mpdf->debug = false;
            $mpdf->allow_output_buffering= false;
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
            $mpdf->SetWatermarkText('Aprobación');
            $mpdf->AddPage();

            $datos['firma'] = TRUE;
			
			if(isset($_REQUEST['guardar'])){
				
                $datosReso['anio'] = date('Y');  
                
                $nume_reso_actual = $this->sst_model->consultar_maximo_numero_resolucion($datosReso);

                if($nume_reso_actual->nume_reso == NULL){
                    $datosReso['id_resolucion'] = 1;
                }else{
                    $datosReso['id_resolucion'] = $nume_reso_actual->nume_reso + 1;
                }

				$datosReso['codi_tramite'] = 'C';  
				$datosReso['id_tramite'] = $_REQUEST['id_tramite'];  				
				$datosReso['codigo_verificacion'] = $this->genera_codigo();
				$datosReso['estado'] = $this->input->post('resultado_validacion');                
                $resultado_resolucion = $this->sst_model->registro_resolucion_sst($datosReso);
                $datos['nume_resolucion'] = $datosReso['id_resolucion'];
				$datos['codigo_verificacion'] = $datosReso['codigo_verificacion'];
				
			}else{
                $datos['nume_resolucion'] = 'XXXXXX';
                $datos['codigo_verificacion'] = 'XXXX';	
			}	
			
			$ruta_archivos = "/mt/sdb1/uploads/sst/resoluciones/";
            $nombre_archivo = "direccionSST-".$_REQUEST['id_tramite']."-".$this->input->post('resultado_validacion')."-".date('YmdHis').".pdf";
        
            if($datos['tramite_info']->tipo_tramite == 1){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_aprobacion', $datos, true)); 
            }else if($datos['tramite_info']->tipo_tramite == 2){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_aprobacion_modificacion', $datos, true)); 
            }else if($datos['tramite_info']->tipo_tramite == 3){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_aprobacion_renovacion', $datos, true)); 
            }
            
            

        }else if($this->input->post('resultado_validacion') == 11){
            //Negacion
            //load mPDF library para linux
        
            $datos['nume_resolucion'] = 'XX';
            $datos['firma'] = false;
            $datos['codigo_verificacion'] = false;
            
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
            $mpdf->SetWatermarkText('Negación');
            $mpdf->AddPage();
            
            $datos['firma'] = TRUE;
			
			if(isset($_REQUEST['guardar'])){
				
				$datosReso['anio'] = date('Y');  
				$datosReso['codi_tramite'] = 'C';  
				$datosReso['id_tramite'] = $_REQUEST['id_tramite'];  				
				$datosReso['codigo_verificacion'] = $this->genera_codigo();
				$datosReso['estado'] = $this->input->post('resultado_validacion');                
                $datos['nume_resolucion'] = $this->sst_model->registro_resolucion_sst($datosReso);
				$datos['codigo_verificacion'] = $datosReso['codigo_verificacion'];
				
			}else{
                $datos['nume_resolucion'] = 'XXXXXX';
                $datos['codigo_verificacion'] = 'XXXX';	
            }	
            
			
			$ruta_archivos = "/mt/sdb1/uploads/sst/resoluciones/";
            $nombre_archivo = "direccionSST-".$_REQUEST['id_tramite']."-".$this->input->post('resultado_validacion')."-".date('YmdHis').".pdf";

            if($datos['tramite_info']->tipo_tramite == 1){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_negacion', $datos, true)); 
            }else if($datos['tramite_info']->tipo_tramite == 2){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_negacion', $datos, true)); 
            }else if($datos['tramite_info']->tipo_tramite == 3){
                $mpdf->WriteHTML($this->load->view('resoluciones/resolucion_negacion', $datos, true)); 
            }
        }
        
        if($this->input->post('guardar')){

            $salvar = $mpdf->Output($ruta_archivos.$nombre_archivo, "F");

			if(file_exists ( $ruta_archivos.$nombre_archivo )){
					$datosAr['ruta'] = $ruta_archivos;
					$datosAr['nombre'] = $nombre_archivo;
					$datosAr['fecha'] = date('Y-m-d');
					$datosAr['tags'] = "";
					$datosAr['es_publico'] = 1;
                    $datosAr['estado'] = 'AC';
                    
                    $resultadoID = $this->sst_model->insertarArchivo($datosAr);

                    if($resultadoID){

                        $dataEstado['id_tramite'] = $this->input->post('id_tramite');            
                        $dataEstado['id_archivo'] = $resultadoID;
                        
                        $resultadoIdArchivoResolucion = $this->sst_model->actualizarArchivoResolucion($dataEstado);

                        $dataEstado['id_tramite'] = $this->input->post('id_tramite');            
                        $dataEstado['id_estado'] = $this->input->post('resultado_validacion');
                        
                        $resultadoEstadoTramite = $this->sst_model->actualizarEstadoTramite($dataEstado);
                        
                        $dataFlujo['tramite_id'] = $this->input->post('id_tramite');
                        $dataFlujo['id_usuario'] = $this->session->userdata('id_usuario');
                        $dataFlujo['id_estado'] = $this->input->post('resultado_validacion');
                        $dataFlujo['fecha_estado'] = date('Y-m-d H:i:s');
                        $dataFlujo['id_archivo'] = $resultadoID;
                        
                        if($this->input->post('observaciones') != ''){
                            $dataFlujo['observaciones'] = $this->input->post('observaciones');
                        }else{
                            $dataFlujo['observaciones'] = 'Firma de documento por parte de dirección';
                        }
                        
                        $resultadoIDTramiteFlujo = $this->sst_model->insertarTramiteFlujo($dataFlujo);

                        if($datos['tramite_info']->email != ''){

                            $dataEmail['nombre_usuario'] = $datos['tramite_info']->p_nombre." ".$datos['tramite_info']->s_nombre." ".$datos['tramite_info']->p_apellido." ".$datos['tramite_info']->s_apellido;
                            $dataEmail['nombre_rs'] = $datos['tramite_info']->nombre_rs;
                            $dataEmail['email'] = $datos['tramite_info']->email;
                            $dataEmail['titulo'] = "Respuesta trámite Licencia de Seguridad y Salud en el Trabajo - SDS";

                            $this->enviarCorreoResolucion($dataEmail);

                        }
                        
                        $this->session->set_flashdata('exito', 'Se realizó la firma de la resolución, por lo tanto este trámite sale de su bandeja de pendientes');
                        redirect(base_url('sst/direccion'), 'refresh');
                        exit;
                    }else{
                        $this->session->set_flashdata('error', 'No es posible generar el archivo de la resolución');
                        redirect(base_url('sst/direccion'), 'refresh');
                        exit;
                    }
            }else{
                $this->session->set_flashdata('error', 'No es posible guardar el estado de la validación');
                redirect(base_url('sst/direccion'), 'refresh');
                exit;
            }
                
        }else{
            $mpdf->Output();
        }

    }

    public function enviarCorreo($datos){
       
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

        $html = '
          <p>Señor(a)</p>
          <p><b>' . $datos['p_nombre'] . ' ' . $datos['p_apellido'] . ',</b></p>
          <p>Una vez realizado el proceso de validación de documentos del Trámite de Licencia de Seguridad y Salud en el trabajo y se encontró la siguiente inconsistencia.</p>
          <p>
            Estado: ' . $datos['estado'] . '
          </p>
          <p>
            ' . $datos['mensajeR'] . '
          </p>
          <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co</p>
          <p><b>Secretaría Distrital de Salud.<br>
                Subdirección de Inspección Vigilancia y Control</b><br>
                <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Licencia de Seguridad y Salud en el trabajo<br>
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
          <p>Una vez realizado el proceso de validación de documentos del Trámite de Licencia de Seguridad y Salud en el trabajo, se ha dado respuesta a su solicitud.</p>
          <p>Para visualizar la respuesta ingrese a <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> con su usuario y clave e ingrese a la opción "Mis Trámites" 
          y posteriormente a la opción "Mis Trámites de Seguridad y Salud en el Trabajo"</p>
          <p>Ante cualquier inquietud o novedad no dude consultar primeramente la documentación dispuesta en el portal de la Ventanilla Única de Trámites y Servicios o por medio del correo: contactenos@saludcapital.gov.co</p>
          <p><b>Secretaría Distrital de Salud.<br>
                Subdirección de Inspección Vigilancia y Control</b><br>
                <a href="http://tramitesenlinea.saludcapital.gov.co/" target="_blank">tramitesenlinea.saludcapital.gov.co</a> - Trámite Licencia de Seguridad y Salud en el trabajo<br>
                Cra 32 #12-81 Bogotá D.C, Colombia<br>
                Teléfono: (571) 3649090
            </p>';

        $mail->Body = nl2br($html, false);

        if ($mail->Send()) { 

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

}
