<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Transversal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function actualizarClave($parametros){
        $data = array(
            'password' => $parametros['pass_nuevo']
        );
        $this->db->where('id', $parametros['id_usuario']);
        return $this->db->update('usuarios', $data);
    }

    public function validar_clave($data){

        $cadena_sql = "SELECT *
						FROM usuarios
                        WHERE id = {$data['id_usuario']} 
                        AND password = '{$data['pass_actual']}' ";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

}
