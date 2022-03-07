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

class Transversal extends MY_Controller
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
        $this->load->model('transversal_model');		
        $this->load->database('default');
		$this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form'));
		
		if(!$this->session->userdata('id_usuario') || $this->session->userdata('id_usuario') == ''){
			$this->session->sess_destroy();
			redirect($this->config->item('url_tramites'));
		}
    }

	public function cambiar_clave()
	{
		$data['js'] = array(base_url('assets/js/transversal.js'));
        $data['contenido'] = 'transversal/cambiar_clave'; 
        if($this->session->userdata('tramites') == 5){
            $this->load->view('templates/layout_sst',$data);
        }else if($this->session->userdata('tramites') == 7){
            $this->load->view('templates/layout_xindustrial',$data);
        }
        
    }
    
    public function guardarContrasena(){

        $data['id_usuario'] = $this->session->userdata('id_usuario');
        $data['pass_actual'] = sha1($this->input->post('pass_actual'));
        $data['pass_nuevo'] = sha1($this->input->post('pass_nuevo'));
        $data['pass_repite'] = sha1($this->input->post('pass_repite'));

        $pass_valido = $this->transversal_model->validar_clave($data);  

        if($pass_valido){

            $cambiar_clave = $this->transversal_model->actualizarClave($data); 

            if($cambiar_clave){
                $this->session->set_flashdata('exito', 'Se realizó la actualización de la clave con éxito');
                redirect(base_url('transversal/cambiar_clave'), 'refresh');
                exit;
            }else{
                $this->session->set_flashdata('error', 'Error al cambiar la contraseña');
                redirect(base_url('transversal/cambiar_clave'), 'refresh');
                exit;
            }
            
        }else{

            $this->session->set_flashdata('error', 'La contraseña actual no es valida');
            redirect(base_url('transversal/cambiar_clave'), 'refresh');
            exit;

        }
        
    }
}
