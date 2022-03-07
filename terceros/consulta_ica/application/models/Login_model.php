<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($username,$password)
	{
		$sql = " SELECT id,	perfil, username, password";
        $sql.= " FROM usuarios ";
        $sql.= " WHERE username = '".$username."' ";
        $sql.= " AND password = '".$password."' ";
        $query = $this->db->query($sql);         
		
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'login','refresh');
		}
	}
	
	public function busca_registro($tipo_doc,$num_identif) {
        $sql = " SELECT ind.primer_nombre as primer_nombre, ind.segundo_nombre as segundo_nombre, ind.primer_apellido as primer_apellido, ind.segundo_apellido as segundo_apellido,";
		$sql .= " ind.fecha_registro as fecha_registro, doc.tipo_doc as tipo_doc FROM disc__individuos ind";
		$sql.= " JOIN disc__tipos_doc doc ON doc.id_tipo_doc=ind.id_tipo_doc_ind ";
		$sql.= " WHERE ind.id_tipo_doc_ind = '".$tipo_doc."'";
		$sql.= " AND ind.numero_documento = '".$num_identif."'";		
	
        $query = $this->db->query($sql);
        return $query->row(); 
    }
	
	public function lista_tipoident() {
        $sql = "SELECT id_tipo_doc, tipo_doc FROM disc__tipos_doc";
        $query = $this->db->query($sql);
        return $query->result();  		
    }
	
	
}