<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function roles() {
        $sql = " SELECT id_rol, desc_rol  ";
        $sql.= " FROM roles ";
        $sql.= " WHERE estado = 'AC' AND id_rol != 2 ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function tramites() {
        $sql = " SELECT id_tramite, desc_tramite  ";
        $sql.= " FROM tramites ";
        $sql.= " WHERE estado = 'AC' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consulta_usuario($datos){
        $sql = " SELECT
                    us.id,
                    us.id_persona,
                    us.perfil,
                    ro.desc_rol,
                    us.username,
                    us.password,
                    us.estado,
                    us.fecha_terminos,
                    us.tramites
                FROM
                    usuarios us
                    JOIN roles ro ON ro.id_rol = us.perfil
                WHERE us.perfil != 2 ";

        if($datos['usuario'] != ''){
            $sql .= " AND username = ".$datos['usuario'];
        }

        if($datos['rol'] != ''){
            $sql .= " AND perfil = ".$datos['rol'];
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consulta_usuario_id($id){
        $sql = " SELECT
                    us.id,
                    us.id_persona,
                    us.perfil,
                    ro.desc_rol,
                    us.username,
                    us.password,
                    us.estado,
                    us.fecha_terminos,
                    us.tramites
                FROM
                    usuarios us
                    JOIN roles ro ON ro.id_rol = us.perfil
                WHERE 1=1 ";

        if($id != ''){
            $sql .= " AND id = ".$id;
        }

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function consulta_usuario_user($usuario){
        $sql = " SELECT
                    us.id,
                    us.id_persona,
                    us.perfil,
                    ro.desc_rol,
                    us.username,
                    us.password,
                    us.estado,
                    us.fecha_terminos,
                    us.tramites
                FROM
                    usuarios us
                    JOIN roles ro ON ro.id_rol = us.perfil
                WHERE 1=1 ";

        if($usuario != ''){
            $sql .= " AND username = ".$usuario;
        }

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function insertarUsuario($param) {
        $this->db->trans_start();
        $this->db->insert('usuarios', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    function actualizarUsuario($datos)
    {
        $data = array(
            'perfil' => $datos['perfil'],
            'tramites' => $datos['tramites']
        );
        $this->db->where('username', $datos['username']);
        return $this->db->update('usuarios', $data);
    }

    function eliminar_usuario($id_usuario)
    {
        $data = array(
            'estado' => 'IN',
        );
        $this->db->where('id', $id_usuario);
        return $this->db->update('usuarios', $data);
    }
	
	public function consulta_titulos(){
        $sql = "select * from temp_titulo_huerfanos ";

        $query = $this->db->query($sql);
        return $query->result();
    }
	
	public function consulta_seguimiento($id_titulo){
        $sql = "select * from seguimiento_tramite WHERE id_titulo = ".$id_titulo." AND estado = 14 ";

        $query = $this->db->query($sql);
        return $query->row();
    }
	
	public function consulta_validacion($id_titulo){
        $sql = "select * from validacion_titulos WHERE id_titulo = ".$id_titulo." AND id_estado_tramite = 14 ";

        $query = $this->db->query($sql);
        return $query->row();
    }
		
	public function resoluciones_titulo($id_titulo){
        $sql = "select * from resoluciones_titulo WHERE id_titulo = ".$id_titulo."";

        $query = $this->db->query($sql);
        return $query->row();
    }
	
	function actualizartemp($id_titulo, $campo, $valor)
    {
        $data = array(
            $campo => $valor
        );
        $this->db->where('id_titulo', $id_titulo);
        return $this->db->update('temp_titulo_huerfanos', $data);
    }
}
