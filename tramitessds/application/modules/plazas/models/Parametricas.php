<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parametricas extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }

    /**
     * Obtiene la lista de los tipos de identificación.
     * @author sjneirag
     * @since  01/2020
     */
    function tipos_identificacion(){
    	$tipIden = array();
    	$sql = "SELECT IdTipoIdentificacion, Codigo, Descripcion
   		FROM pr_tipoidentificacion
     	ORDER BY IdTipoIdentificacion ASC ";
    	 
    	$query = $this->db->query($sql);
    	
    	if ($query->num_rows()>0){
    		$i=0;
    		foreach($query->result() as $row){
    			$tipIden[$i]["IdTipoIdentificacion"] = $row->IdTipoIdentificacion;
          		$tipIden[$i]["Descripcion"] = $row->Descripcion;
         	$i++;
    		}
    	}
    	return $tipIden;
    	$this->db->close();
    }

    /**
     * Obtiene la lista de las profesiones
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_profesiones(){
        $profesion = array();
        $sql = "SELECT id_profesion, nombre
        FROM plazas_profesiones
        ORDER BY nombre ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $profesion[$i]["id_profesion"] = $row->id_profesion;
                $profesion[$i]["nombre"] = $row->nombre;
            $i++;
            }
        }
        return $profesion;
        $this->db->close();
    }
    /**
     * Obtiene la lista de los tipos de vinculación
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_vinculacion(){
        $vinculacion = array();
        $sql = "SELECT id_vinculacion, descripcion
        FROM plazas_vinculacion
        ORDER BY descripcion ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $vinculacion[$i]["id_vinculacion"] = $row->id_vinculacion;
                $vinculacion[$i]["descripcion"] = $row->descripcion;
            $i++;
            }
        }
        return $vinculacion;
        $this->db->close();
    }

    /**
     * Obtiene la lista de los tipos de modalidad
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_modalidad(){
        $modalidad = array();
        $sql = "SELECT id_modalidad, descripcion
        FROM plazas_modlidad
        ORDER BY descripcion ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $modalidad[$i]["id_modalidad"] = $row->id_modalidad;
                $modalidad[$i]["descripcion"] = $row->descripcion;
            $i++;
            }
        }
        return $modalidad;
        $this->db->close();
    }

    /**
     * Obtiene la lista de los estados de trámite.
     * @author sjneirag
     * @since  06/2020
     */
    function consulat_estados(){
       
        $estados = array();
        $sql = "SELECT id_estado, descripcion
        FROM pr_estado_tramite ";
        if($this->session->userdata('perfil')==3){
            $sql.= "WHERE id_estado IN (2,5,13) ";
        }else if($this->session->userdata('perfil')==4){
            $sql.= "WHERE id_estado IN (3,15) ";
        }else if($this->session->userdata('perfil')==5){
            $sql.= "WHERE id_estado IN (4,20) ";
        }
        $sql.="ORDER BY id_estado ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $estados[$i]["id_estado"] = $row->id_estado;
                $estados[$i]["descripcion"] = $row->descripcion;
         $i++;
            }
        }
        $this->db->close();
        return $estados;
    }

    /**
     * Obtiene la lista del nivel educativo.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_nivel(){
        $nivel = array();
        $sql = "SELECT IdNivelEducativo, Nombre
        FROM pr_nivel_educativo_per
        ORDER BY IdNivelEducativo ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $nivel[$i]["IdNivelEducativo"] = $row->IdNivelEducativo;
                $nivel[$i]["Nombre"] = $row->Nombre;
         $i++;
            }
        }
        $this->db->close();
        return $nivel;
    }
    /**
     * Obtiene la lista del nivel educativo.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_tipodoc(){
        $nivel = array();
        $sql = "SELECT IdTipoIdentificacion, Descripcion
        FROM pr_tipoidentificacion
        ORDER BY IdTipoIdentificacion ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $nivel[$i]["IdTipoIdentificacion"] = $row->IdTipoIdentificacion;
                $nivel[$i]["Descripcion"] = $row->Descripcion;
         $i++;
            }
        }
        $this->db->close();
        return $nivel;
    }
}