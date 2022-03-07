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
     * Obtiene la lista de los tipos de dispositivo paa movilizarse
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_moviliza(){
        $moviliza = array();
        $sql = "SELECT id_moviliza, nombre_dispositivo
        FROM discapacidad_moviliza
        WHERE estado_dispositivo=1
        ORDER BY nombre_dispositivo ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $moviliza[$i]["id_moviliza"] = $row->id_moviliza;
                $moviliza[$i]["nombre_dispositivo"] = $row->nombre_dispositivo;
            $i++;
            }
        }
        return $moviliza;
        $this->db->close();
    }

    /**
     * Obtiene el nombre del dispositivo de movilización
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_moviliza($id_moviliza){
        $sql = "SELECT id_moviliza, nombre_dispositivo
        FROM discapacidad_moviliza
        WHERE estado_dispositivo=1
        AND id_moviliza = ".$id_moviliza." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $nombre = $row->nombre_dispositivo;
            }
        }
        return $nombre;
        $this->db->close();
    }

    /**
     * Obtiene la lista de los tipos de dispositivo paa comunicarse
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_comunica(){
        $moviliza = array();
        $sql = "SELECT id_comunica, nombre_dispositivo
        FROM discapacidad_comunica
        WHERE estado_dispositivo=1
        ORDER BY nombre_dispositivo ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $moviliza[$i]["id_comunica"] = $row->id_comunica;
                $moviliza[$i]["nombre_dispositivo"] = $row->nombre_dispositivo;
            $i++;
            }
        }
        return $moviliza;
        $this->db->close();
    }

    /**
     * Obtiene el nombre del dispositivo para movilizarse
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_comunica($id_comunica){
        $sql = "SELECT id_comunica, nombre_dispositivo
        FROM discapacidad_comunica
        WHERE estado_dispositivo=1
        AND id_comunica = ".$id_comunica." "; 
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $nombre = $row->nombre_dispositivo;
            $i++;
            }
        }
        return $nombre;
        $this->db->close();
    }
    /**
     * Obtiene el nombre del director
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_director($id_usuario){
        $sql = "SELECT concat_ws(' ', PE.p_nombre, PE.s_nombre, PE.p_apellido, PE.s_apellido) as nombre_director
        FROM usuarios US
        INNER JOIN persona PE ON PE.id_persona=US.id_persona
        WHERE US.id = ".$id_usuario." "; 
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $nombre_dir = $row->nombre_director;
            $i++;
            }
        }
        return $nombre_dir;
        $this->db->close();
    }
    /**
     * Obtiene el email del director
     * @author sjneirag
     * @since  09/2020
     */
    function email_director($id_usuario){
        $sql = "SELECT PE.email
        FROM usuarios US
        INNER JOIN persona PE ON PE.id_persona=US.id_persona
        WHERE US.id = ".$id_usuario." "; 
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $email = $row->email;
            $i++;
            }
        }
        return $email;
        $this->db->close();
    }

   
    /**
     * Obtiene la lista de los tipos de modalidad
     * @author sjneirag
     * @since  04/2021
     */
    function categorias(){
        $categoria = array();
        $sql = "SELECT id_categoria, descripcion
        FROM discapacidad_categoria
        WHERE estado = 1
        ORDER BY id_categoria ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $categoria[$i]["id_categoria"] = $row->id_categoria;
                $categoria[$i]["descripcion"] = $row->descripcion;
            $i++;
            }
        }
        return $categoria;
        $this->db->close();
    }

    /**
     * Obtiene la lista de las ips
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_ips(){
        $perfil=$this->session->userdata('perfil');
        $modalidad = array();
        $sql = "SELECT id_ips, nombre_ips, email_ips
        FROM discapacidad_ips ";
        if($perfil==2){
            $sql.= "WHERE estado = 1 ";
        }
        $sql.= "ORDER BY nombre_ips ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $modalidad[$i]["id_ips"] = $row->id_ips;
                $modalidad[$i]["nombre_ips"] = $row->nombre_ips;
                $modalidad[$i]["email_ips"] = $row->email_ips;
            $i++;
            }
        }
        return $modalidad;
        $this->db->close();
    }

    /**
     * Obtiene el nombre de la ips
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_ips($id_ips){
        $sql = "SELECT id_ips, nombre_ips, email_ips
        FROM discapacidad_ips
        WHERE id_ips = ".$id_ips." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $nombre = $row->nombre_ips;
            }
        }
        return $nombre;
        $this->db->close();
    }

     /**
     * Obtiene el email de la ips
     * @author sjneirag
     * @since  09/2020
     */
    function email_ips($id_ips){
        $sql = "SELECT id_ips, nombre_ips, email_ips
        FROM discapacidad_ips
        WHERE estado = 1
        AND id_ips = ".$id_ips." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $email_ips = $row->email_ips;
            }
        }
        return $email_ips;
        $this->db->close();
    }

    /**
     * Obtiene el telefono de la ips
     * @author sjneirag
     * @since  09/2020
     */
    function telefono_ips($id_ips){
        $sql = "SELECT id_ips, telefono
        FROM discapacidad_ips
        WHERE estado = 1
        AND id_ips = ".$id_ips." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $telefono = $row->telefono;
            }
        }
        return $telefono;
        $this->db->close();
    }

    /**
     * Obtiene el dirección de la ips
     * @author sjneirag
     * @since  09/2020
     */
    function direccion_ips($id_ips){
        $sql = "SELECT id_ips, direccion
        FROM discapacidad_ips
        WHERE estado = 1
        AND id_ips = ".$id_ips." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $direccion = $row->direccion;
            }
        }
        return $direccion;
        $this->db->close();
    }

    /**
     * Obtiene el nombre del nivel educativo
     * @author sjneirag
     * @since  09/2020
     */
    function nivel_educativo($id_nivel){
         $sql = "SELECT IdNivelEducativo, Nombre
        FROM pr_nivel_educativo_per
        WHERE  IdNivelEducativo = ".$id_nivel." ";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $nombre = $row->Nombre;
            }
        }
        return $nombre;
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
            $sql.= "WHERE id_estado IN (2,5,13,24) ";
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

    /**
     * Obtiene el nombre del tipo de docmento
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_tipodoc($cu_tipodoc){
         $sql = "SELECT IdTipoIdentificacion, Descripcion
        FROM pr_tipoidentificacion
        WHERE IdTipoIdentificacion = ".$cu_tipodoc." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $nombre = $row->Descripcion;
            }
        }
        return $nombre;
        $this->db->close();
    }
    /**
     * Obtiene el nombre del tipo de docmento
     * @author sjneirag
     * @since  09/2020
     */
    function nombre_modalidad($id_modalidad){
         $sql = "SELECT id_modalidad, nombre
        FROM discapacidad_modalidad
        WHERE id_modalidad = ".$id_modalidad." ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            foreach($query->result() as $row){
                $nombre = $row->nombre;
            }
        }
        return $nombre;
        $this->db->close();
    }

    /**
     * Obtiene la lista de modalidad
     * @author sjneirag
     * @since  09/2020
     */
    function obtener_modalidad(){
        $modalidad = array();
        $sql = "SELECT id_modalidad, nombre
        FROM discapacidad_modalidad
        ORDER BY nombre ASC ";
         
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $modalidad[$i]["id_modalidad"] = $row->id_modalidad;
                $modalidad[$i]["nombre"] = $row->nombre;
            $i++;
            }
        }
        return $modalidad;
        $this->db->close();
    }
}