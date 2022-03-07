<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('usuarios_model');
        $this->load->model('personas_model');
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form'));
        $this->load->database('default');

        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
        {
            redirect(base_url().'login');
        }
    }

    public function index()
    {
        $data['titulo'] = 'Administrador';
        $data['js'] = array(base_url('assets/js/administrador.js'));
        $data['contenido'] = 'admin/usuarios_view';
        $data['roles'] = $this->admin_model->roles();
        $data['tramites'] = $this->admin_model->tramites();
        $this->load->view('templates/layout_general',$data);
    }

    public function cargaDatosUsuario() {

        $usuario = trim($this->input->post('usuario_consulta'));
        $rol = trim($this->input->post('rol_consulta'));


        $datos['usuario'] = $usuario;
        $datos['rol'] = $rol;


        $datos["usuarios"] = $this->admin_model->consulta_usuario($datos);

        if(count($datos["usuarios"]) > 0){
            $this->load->view('admin/usuariosDatos', $datos);
            //echo $data;
        }else{
            echo "<center><h2>Sin informaci&oacute;n</h2></center>";
        }

    }

    public function guardarUsuario() {

        $tramites = '';

        $datosU['username'] = $_REQUEST['nume_iden'];
        $datosU['password'] = sha1($_REQUEST['clave']);
        $datosU['perfil'] = $_REQUEST['rol'];
        $datosU['estado'] = 'AC';
        $datosU['fecha_terminos'] = date('Y-m-d');

        if(count($_REQUEST['tramites']) > 0){

            for($i=0;$i<count($_REQUEST['tramites']);$i++){

                if(isset($_REQUEST['tramites'][$i + 1]) && $_REQUEST['tramites'][$i + 1] != ''){
                    $tramites .= $_REQUEST['tramites'][$i].',';
                }else{
                    $tramites .= $_REQUEST['tramites'][$i];
                }

            }

        }

        $datosU['tramites'] = $tramites;

        $resultadoUsuario = $this->admin_model->consulta_usuario_user($datosU['username']);

        if(count($resultadoUsuario) > 0){
            $this->session->set_flashdata('errorBD', 'El usuario '.$_REQUEST['nume_iden'].' ya se encuentra registrado en el sistema');
            redirect(base_url('admin/'), 'refresh');
            exit;
        }else{
            //Se registra la informacion del usuario, restorna el ID que asigna la BD
            $resultadoID = $this->admin_model->insertarUsuario($datosU);

            if ($resultadoID) {

                $this->session->set_flashdata('registroExitoso', "Se realizo el registro de usuario con exito");
                redirect(base_url('admin/'), 'refresh');
                exit;
            }else{
                $this->session->set_flashdata('errorBD', 'Error al registrar el usuario');
                redirect(base_url('admin/'), 'refresh');
                exit;
            }
        }
    }

    public function editarUsuario($id_usuario)
    {
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
        {
            redirect(base_url().'login');
        }
        $data['titulo'] = 'Usuarios';
        $data['contenido'] = 'admin/editar_usuarios_view';
        $data["usuario"] = $this->admin_model->consulta_usuario_id($id_usuario);
        $data['roles'] = $this->admin_model->roles();
        $data['tramites'] = $this->admin_model->tramites();
        $this->load->view('templates/layout_general',$data);
    }


    public function actualizarUsuario() {

        $tramites = '';
        $datosU['username'] = $_REQUEST['nume_iden'];
        $datosU['perfil'] = $_REQUEST['rol'];

        if(count($_REQUEST['tramites']) > 0){

            for($i=0;$i<count($_REQUEST['tramites']);$i++){

                if(isset($_REQUEST['tramites'][$i + 1]) && $_REQUEST['tramites'][$i + 1] != ''){
                    $tramites .= $_REQUEST['tramites'][$i].',';
                }else{
                    $tramites .= $_REQUEST['tramites'][$i];
                }

            }

        }

        $datosU['tramites'] = $tramites;
        //Se registra la informacion del usuario, restorna el ID que asigna la BD
        $resultadoID = $this->admin_model->actualizarUsuario($datosU);

        if ($resultadoID) {

            $this->session->set_flashdata('registroExitoso', "Se realizo la actualizaci&oacute;n de usuario con exito");
            redirect(base_url('admin/'), 'refresh');
            exit;

        }else{

            $this->session->set_flashdata('errorBD', 'Error al actualizar el usuario');
            redirect(base_url('admin/'), 'refresh');
            exit;

        }
    }

    public function borrarUsuario($id_usuario) {

        //Se registra la informacion del usuario, restorna el ID que asigna la BD
        $resultadoID = $this->admin_model->eliminar_usuario($id_usuario);

        if ($resultadoID) {

            $this->session->set_flashdata('registroExitoso', "Se inactivo el registro de usuario con exito");
            redirect(base_url('admin/'), 'refresh');
            exit;
        }else{
            $this->session->set_flashdata('errorBD', 'Error al inactivar el usuario');
            redirect(base_url('admin/'), 'refresh');
            exit;
        }
    }




    public function personas()
    {
        if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
        {
            redirect(base_url().'login');
        }
        $data['titulo'] = 'Personas';
        $data['contenido'] = 'admin/datosPersonas_view';
        $this->load->view('templates/layout_general',$data);
    }

    public function cargaDatosPersona() {

        $nume_iden_consulta = trim($this->input->post('nume_iden_consulta'));

        $datos['nume_iden_consulta'] = $nume_iden_consulta;

        $datos["persona"] = $this->personas_model->consulta_persona($datos);
        $datos['tipo_docu'] = $this->personas_model->tipo_docu();
        $datos['departamentos'] = $this->personas_model->departamentos();
        $datos['localidad'] = $this->personas_model->localidad();

        if(isset($datos["persona"][0]->IdLocalidad) && $datos["persona"][0]->IdLocalidad != ''){
            $datos['upz'] = $this->personas_model->upz($datos["persona"][0]->IdLocalidad);
        }else{
            $datos['upz'] = $this->personas_model->upz_todas();
        }

        $datos['etnias'] = $this->personas_model->etnias();
        $datos['estados_civiles'] = $this->personas_model->estados_civiles();

        if(count($datos["persona"]) > 0){
            $this->load->view('admin/personasDatos', $datos);
            //echo $data;
        }else{
            echo "<center><h2>Sin informaci&oacute;n</h2></center>";
        }

    }

    public function actualizarPersona(){

        $datos['IdPersona'] = $_REQUEST['id_persona'];
        $datos['p_nombre'] = $_REQUEST['p_nombre'];
        $datos['s_nombre'] = $_REQUEST['s_nombre'];
        $datos['p_apellido'] = $_REQUEST['p_apellido'];
        $datos['s_apellido'] = $_REQUEST['s_apellido'];
        $datos['t_docu'] = $_REQUEST['t_docu'];
        $datos['n_docu'] = $_REQUEST['n_docu'];
        $datos['Sexo'] = $_REQUEST['enc_sexo'];
        $datos['Gestante'] = $_REQUEST['enc_gestante'];
        $datos['FechaNacimiento'] = $_REQUEST['enc_fech_nac'];
        $datos['Edad'] = $_REQUEST['enc_edad'];
        $datos['Email'] = $_REQUEST['email'];
        $datos['Telefono'] = $_REQUEST['telefono'];
        $datos['Telefono2'] = $_REQUEST['telefono2'];
        $datos['etnia'] = $_REQUEST['etnia'];
        $datos['IdLocalidad'] = $_REQUEST['loca_capta'];
        $datos['CodigoUP'] = $_REQUEST['upz_capta'];
        $datos['Direccion'] = $_REQUEST['dire_usua'];
        $datos['estado'] = $_REQUEST['estado_persona'];


        //Se registra la informacion del usuario, restorna el ID que asigna la BD
        $resultadoID = $this->personas_model->actualizarPersonaAdmin($datos);

        if ($resultadoID) {

            $this->session->set_flashdata('registroExitoso', "Se realizo la actualizaci&oacute;n de la persona [".$_REQUEST['n_docu']."] con exito");
            redirect(base_url('admin/personas'), 'refresh');
            exit;
        }else{
            $this->session->set_flashdata('errorBD', 'Error al actualizar la persona');
            redirect(base_url('admin/personas'), 'refresh');
            exit;
        }
    }


    public function asignarPersona($id_persona, $id_gestor){

        $datos['IdPersona'] = $id_persona;
        $datos['IdGestor'] = $id_gestor;
        $resultadoAsignacion = $this->personas_model->validarAsignacion($datos);

        if(count($resultadoAsignacion)<=0){
            //Se registra la informacion del usuario, restorna el ID que asigna la BD
            $resultadoID = $this->personas_model->registrarAsignacion($datos);

            if ($resultadoID) {

                $this->session->set_flashdata('registroExitoso', "Se realizo la asignaci&oacute;n de la persona con exito");
                redirect(base_url('admin/asignarUsuarios/'.$id_gestor), 'refresh');
                exit;
            }else{
                $this->session->set_flashdata('errorBD', 'Error al asignar la persona');
                redirect(base_url('admin/asignarUsuarios/'.$id_gestor), 'refresh');
                exit;
            }
        }else{
            $this->session->set_flashdata('errorBD', 'Error al asignar la persona, ya se encuentra asignada a un gestor');
            redirect(base_url('admin/asignarUsuarios/'.$id_gestor), 'refresh');
            exit;
        }


    }

    public function asignarUsuarios($id_usuario)
    {
        $data['titulo'] = 'Asignaci&oacute;n';
        $data['contenido'] = 'admin/form_asignar_view';
        $data["usuario"] = $this->usuarios_model->consulta_usuario_id($id_usuario);
        $data["personas"] = $this->usuarios_model->personas_asignadas($id_usuario);
        $this->load->view('templates/layout_general',$data);
    }

    public function cargaDatosAsignacion() {

        $nume_iden_consulta = trim($this->input->post('nume_iden_consulta'));
        $id_gestor = trim($this->input->post('id_gestor'));

        $datos['nume_iden_consulta'] = $nume_iden_consulta;
        $datos['id_gestor'] = $id_gestor;

        $datos["persona"] = $this->personas_model->consulta_persona($datos);

        if(count($datos["persona"]) > 0){
            $this->load->view('admin/personasAsignacion', $datos);
            //echo $data;
        }else{
            echo "<center><h2>Sin informaci&oacute;n</h2></center>";
        }

    }
}
