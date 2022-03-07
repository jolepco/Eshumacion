<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class cert_discapacidad extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function faceptarTerminos($id_persona) {

        $data = array(
            'fecha_terminos' => date('Y-m-d')
        );
        $this->db->where('id_persona', $id_persona);
        return $this->db->update('usuarios', $data);
    }
    public function consulta_persona($id_usuario){
        $cadena_sql = " SELECT
                        id_persona, 
                        nume_identificacion,
                        p_nombre,
                        s_nombre,
                        p_apellido,
                        s_apellido,
                        email,
                        telefono_fijo,
                        telefono_celular,
                        nacionalidad,
                        departamento,
                        ciudad_nacimiento,
                        Descripcion,
                        ciudad_resi,
                        dire_resi,
                        fecha_nacimiento,
                        edad,
                        sexo,
                        etnia,
                        estado_civil,
                        nivel_educativo,
                        Nombre
                    FROM persona
                    LEFT JOIN pr_nivel_educativo_per ON IdNivelEducativo = nivel_educativo
                    LEFT JOIN pr_municipio ON IdMunicipio = ciudad_nacimiento
                    WHERE id_persona = ".$id_usuario."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }

    //Verifica si tiene trámites registrados
    public function verifyTramite($arrData) 
    {
        $this->db->where($arrData);
        
        $query = $this->db->get("discapacidad_tramite");
        
        if ($query->num_rows() >= 1) {
            return true;
        } else{ 
            return false; 
        }
              
        print_r($this->db->last_query());
        $this->db->close();
    }

    //Registra el támite 
    public function registrarTramite($param) {
        $this->db->trans_start();
        $this->db->insert('discapacidad_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
        $this->db->close();

        print_r ($this->db->last_query());

       
    }
    
    public function consulta_tramite($id_usuario){
        $cadena_sql = " SELECT
                        id_tramite,
                        regimen_esp,
                        id_usuario,
                        id_estado,
                        fecha_registro,
                        observaciones
                    FROM discapacidad_tramite
                    WHERE id_usuario = ".$id_usuario."";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('discapacidad_historico', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
        echo $this->db->last_query();

        
        $this->db->close();
    }

    //Registra los archivos en la bd
    public function insertarArchivo($param) {
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
        $this->db->close();
    }

    public function mis_tramites($id_usuario){
        $this->load->model("parametricas");
        $tramite = array();
        $cadena_sql = " SELECT
                        TR.id_tramite,
                        TR.id_usuario,
                        TR.regimen_esp,
                        TR.categoria_1,
                        TR.categoria_2,
                        TR.categoria_3,
                        TR.categoria_4,
                        TR.categoria_5,
                        TR.categoria_6,
                        TR.categoria_7,
                        TR.categoria_8,
                        TR.moviliza,
                        TR.cual_moviliza,
                        TR.comunica,
                        TR.cual_comunica,
                        TR.req_acompanante,
                        TR.vive_persona,
                        TR.id_ips,
                        TR.cu_pnombre,
                        TR.cu_snombre,
                        TR.cu_papellido,
                        TR.cu_sapellido,
                        TR.cu_tipodoc,
                        TR.cu_numdoc,
                        TR.cu_email,
                        TR.cu_telefono,
                        TR.cu_celular,
                        TR.fecha_registro,
                        TR.id_usuario_revisa,
                        TR.fecha_revision,
                        TR.id_usuario_coordinador,
                        TR.fecha_revisa_coordinador,
                        TR.id_usuario_director,
                        TR.fecha_aprueba_director,
                        TR.id_estado,
                        TR.observaciones,
                        ET.descripcion,
                        TR.fecha_registro,
                        PER.nume_identificacion,
                        PER.tipo_identificacion,
                        PER.p_nombre,
                        PER.s_nombre,
                        PER.p_apellido,
                        PER.s_apellido,
                        PER.email,
                        PER.telefono_fijo,
                        PER.telefono_celular,
                        PER.dire_resi
                    FROM discapacidad_tramite TR
                    JOIN usuarios US ON US.id = TR.id_usuario
                    JOIN persona PER ON PER.id_persona = US.id_persona
                    JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                    WHERE TR.id_usuario = ".$id_usuario."
                    AND TR.id_estado NOT IN (21)
                    ORDER BY 1";
                 
        $query = $this->db->query($cadena_sql);
       if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $tramite[$i]["id_tramite"] = $row->id_tramite;
                $tramite[$i]["id_usuario"] = $row->id_usuario;
                $tramite[$i]["regimen_esp"] = $row->regimen_esp;
                $tramite[$i]["categoria_1"] = $row->categoria_1;
                $tramite[$i]["categoria_2"] = $row->categoria_2;
                $tramite[$i]["categoria_3"] = $row->categoria_3;
                $tramite[$i]["categoria_4"] = $row->categoria_4;
                $tramite[$i]["categoria_5"] = $row->categoria_5;
                $tramite[$i]["categoria_6"] = $row->categoria_6;
                $tramite[$i]["categoria_7"] = $row->categoria_7;
                $tramite[$i]["categoria_8"] = $row->categoria_8;
                $tramite[$i]["moviliza"] = $row->moviliza;
                $tramite[$i]["nom_moviliza"] = $this->parametricas->nombre_moviliza($row->moviliza);
                $tramite[$i]["cual_moviliza"] = $row->cual_moviliza;
                $tramite[$i]["comunica"] = $row->comunica;
                $tramite[$i]["nom_comunica"] = $this->parametricas->nombre_comunica($row->comunica);
                $tramite[$i]["cual_comunica"] = $row->cual_comunica;
                $tramite[$i]["req_acompanante"] = $row->req_acompanante;
                $tramite[$i]["vive_persona"] = $row->vive_persona;
                $tramite[$i]["id_ips"] = $row->id_ips;
                //$tramite[$i]["nom_ips"] = $this->parametricas->nombre_ips($row->id_ips);
                $tramite[$i]["cu_pnombre"] = $row->cu_pnombre;
                $tramite[$i]["cu_snombre"] = $row->cu_snombre;
                $tramite[$i]["cu_papellido"] = $row->cu_papellido;
                $tramite[$i]["cu_sapellido"] = $row->cu_sapellido;
                $tramite[$i]["cu_tipodoc"] = $row->cu_tipodoc;
                $tramite[$i]["nom_tipodoc"] = $this->parametricas->nombre_tipodoc($row->cu_tipodoc);
                $tramite[$i]["cu_numdoc"] = $row->cu_numdoc;
                $tramite[$i]["cu_email"] = $row->cu_email;
                $tramite[$i]["cu_telefono"] = $row->cu_telefono;
                $tramite[$i]["cu_celular"] = $row->cu_celular;
                $tramite[$i]["fecha_registro"] = $row->fecha_registro;
                $tramite[$i]["id_usuario_revisa"] = $row->id_usuario_revisa;
                $tramite[$i]["fecha_revision"] = $row->fecha_revision;
                $tramite[$i]["id_usuario_coordinador"] = $row->id_usuario_coordinador;
                $tramite[$i]["fecha_revisa_coordinador"] = $row->fecha_revisa_coordinador;
                $tramite[$i]["id_usuario_director"] = $row->id_usuario_director;
                $tramite[$i]["fecha_aprueba_director"] = $row->fecha_aprueba_director;
                $tramite[$i]["id_estado"] = $row->id_estado;
                $tramite[$i]["observaciones"] = $row->observaciones;
                $tramite[$i]["descripcion"] = $row->descripcion;
                $tramite[$i]["nume_identificacion"] = $row->nume_identificacion;
                $tramite[$i]["tipo_identificacion"] = $row->tipo_identificacion;
                $tramite[$i]["p_nombre"] = $row->p_nombre;
                $tramite[$i]["s_nombre"] = $row->s_nombre;
                $tramite[$i]["p_apellido"] = $row->p_apellido;
                $tramite[$i]["s_apellido"] = $row->s_apellido;
                $tramite[$i]["email"] = $row->email;
                $tramite[$i]["telefono_fijo"] = $row->telefono_fijo;
                $tramite[$i]["telefono_celular"] = $row->telefono_celular;
                $tramite[$i]["dire_resi"] = $row->dire_resi;
            $i++;
            }
        }
        return $tramite;
        $this->db->close();
    }

    /**
     * Obtiene la lista de archivos cargados.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_archivos($id_usuario){
        $archivos = array();
        $sql = "SELECT id_archivo, ruta, nombre, id_persona, condicion
        FROM archivos
        WHERE id_persona = ".$id_usuario."
        AND estado = 'AC'
        AND ruta = '/mt/sdb1/uploads/discapacidad/'
        ORDER BY id_archivo ASC ";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $archivos[$i]["id_archivo"] = $row->id_archivo;
                $archivos[$i]["ruta"] = $row->ruta;
                $archivos[$i]["nombre"] = $row->nombre;
                $archivos[$i]["id_persona"] = $row->id_persona;
                $archivos[$i]["condicion"] = $row->condicion;
            $i++;
            }
        }
        
        return $archivos;
        $this->db->close();
    } 

     /**
     * Obtiene la lista de archivos cargados filtrados por id.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_archivosbyId($id_archivo){
        $archivosbyid = array();
        $sql = "SELECT id_archivo, ruta, nombre, id_persona, condicion
        FROM archivos
        WHERE id_archivo = ".$id_archivo." ";
       
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $archivosbyid[$i]["id_archivo"] = $row->id_archivo;
                $archivosbyid[$i]["ruta"] = $row->ruta;
                $archivosbyid[$i]["nombre"] = $row->nombre;
                $archivosbyid[$i]["id_persona"] = $row->id_persona;
                $archivosbyid[$i]["condicion"] = $row->condicion;
            $i++;
            }
        }
        
        return $archivosbyid;
        $this->db->close();
    }

    //Actualiza los estados del archivo
    public function actualizar_archivo ($idarchivo,$cumple){
        $data = array(
            'condicion' => $cumple
        );
        $this->db->where('id_archivo', $idarchivo);
        return $this->db->update('archivos', $data);
       print_r($this->db->last_query());
        
        $this->db->close();
    }

    public function get_tramites(){
        $tramites = array();
        $sql = "SELECT  
                TR.id_tramite,
                TR.id_usuario,
                TR.id_estado,
                ET.descripcion,
                TR.fecha_registro,
                PER.nume_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                TR.observaciones
        FROM discapacidad_tramite TR
        JOIN usuarios US ON US.id = TR.id_usuario
        JOIN persona PER ON PER.id_persona = US.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado ";
       
        if($this->session->userdata('perfil')==3){
            $sql.= "WHERE TR.id_estado IN (1,12,15,23) ";
        }else if($this->session->userdata('perfil')==4){
             $sql.= "WHERE TR.id_estado IN (5,2,9,20) ";
        }else if($this->session->userdata('perfil')==5){
             $sql.= "WHERE TR.id_estado IN (3,6) ";
        }
             
        $sql.= "AND TR.id_estado NOT IN (21) ";
        $sql.= "ORDER BY 1 DESC ";
        
        $query = $this->db->query($sql);
        if ($query->num_rows()>0){
            $i = 0;
            foreach($query->result() as $row){
                $tramites[$i]["id_tramite"] = $row->id_tramite;
                $tramites[$i]["idusuario"] = $row->id_usuario;
                $tramites[$i]["id_estado"] = $row->id_estado;
                $tramites[$i]["descripcion"] = $row->descripcion;
                $tramites[$i]["fecha_registro"] = $row->fecha_registro;
                $tramites[$i]["numidentificacion"] = $row->nume_identificacion;
                $tramites[$i]["p_nombre"] = $row->p_nombre;
                $tramites[$i]["s_nombre"] = $row->s_nombre;
                $tramites[$i]["p_apellido"] = $row->p_apellido;
                $tramites[$i]["s_apellido"] = $row->s_apellido;
                $tramites[$i]["email"] = $row->email;
                $tramites[$i]["telefono_fijo"] = $row->telefono_fijo;
                $tramites[$i]["telefono_celular"] = $row->telefono_celular;
                $tramites[$i]["observaciones"] = $row->observaciones;
                $tramites[$i]["id_resolucion"] = $row->id_resolucion;
                $i++;
            }
        }
       
        return $tramites;
        $this->db->close();
    }

    function get_tramitesbyId($id_tramite){
        $this->load->model("parametricas");
        $tramite = array();
        $cadena_sql = " SELECT
                        TR.id_tramite,
                        TR.id_usuario,
                        TR.regimen_esp,
                        TR.categoria_1,
                        TR.categoria_2,
                        TR.categoria_3,
                        TR.categoria_4,
                        TR.categoria_5,
                        TR.categoria_6,
                        TR.categoria_7,
                        TR.categoria_8,
                        TR.id_modalidad,
                        TR.moviliza,
                        TR.cual_moviliza,
                        TR.comunica,
                        TR.cual_comunica,
                        TR.req_acompanante,
                        TR.vive_persona,
                        TR.id_ips,
                        TR.cu_pnombre,
                        TR.cu_snombre,
                        TR.cu_papellido,
                        TR.cu_sapellido,
                        TR.cu_tipodoc,
                        TR.cu_numdoc,
                        TR.cu_email,
                        TR.cu_telefono,
                        TR.cu_celular,
                        TR.fecha_registro,
                        TR.id_usuario_revisa,
                        TR.fecha_revision,
                        TR.id_usuario_coordinador,
                        TR.fecha_revisa_coordinador,
                        TR.cod_autorizacion,
                        TR.id_usuario_director,
                        TR.fecha_aprueba_director,
                        TR.id_estado,
                        TR.observaciones,
                        ET.descripcion,
                        TR.fecha_registro,
                        PER.nume_identificacion,
                        PER.tipo_identificacion,
                        PER.p_nombre,
                        PER.s_nombre,
                        PER.p_apellido,
                        PER.s_apellido,
                        PER.email,
                        PER.telefono_fijo,
                        PER.telefono_celular,
                        PER.ciudad_resi,
                        PER.dire_resi,
                        PER.nivel_educativo,
                        PER.fecha_nacimiento,
                        TI.Descripcion as tipoiden,
                        MU.Descripcion as ciudadnacimiento,
                        LO.Nombre as localidad,
                        IPS.nombre_ips
                    FROM discapacidad_tramite TR
                    JOIN usuarios US ON US.id = TR.id_usuario
                    JOIN persona PER ON PER.id_persona = US.id_persona
                    JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                    JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PER.tipo_identificacion
                    LEFT JOIN pr_municipio MU ON MU.IdMunicipio = PER.ciudad_resi
                    LEFT JOIN pr_localidad LO ON LO.idLocalidad = PER.localidad
                    LEFT JOIN discapacidad_ips IPS ON IPS.id_ips = TR.id_ips
                    WHERE TR.id_tramite = ".$id_tramite."
                    ORDER BY 1";
          //echo $cadena_sql;       
        $query = $this->db->query($cadena_sql);
       if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
                $tramite[$i]["id_tramite"] = $row->id_tramite;
                $tramite[$i]["id_usuario"] = $row->id_usuario;
                $tramite[$i]["regimen_esp"] = $row->regimen_esp;
                $tramite[$i]["categoria_1"] = $row->categoria_1;
                $tramite[$i]["categoria_2"] = $row->categoria_2;
                $tramite[$i]["categoria_3"] = $row->categoria_3;
                $tramite[$i]["categoria_4"] = $row->categoria_4;
                $tramite[$i]["categoria_5"] = $row->categoria_5;
                $tramite[$i]["categoria_6"] = $row->categoria_6;
                $tramite[$i]["categoria_7"] = $row->categoria_7;
                $tramite[$i]["categoria_8"] = $row->categoria_8;
                $tramite[$i]["id_modalidad"] = $row->id_modalidad;
                if($row->id_modalidad){
                    $tramite[$i]["nom_modalidad"] = $this->parametricas->nombre_modalidad($row->id_modalidad);
                }
                $tramite[$i]["moviliza"] = $row->moviliza;
                if($row->moviliza){
                    $tramite[$i]["nom_moviliza"] = $this->parametricas->nombre_moviliza($row->moviliza);
                }
                $tramite[$i]["cual_moviliza"] = $row->cual_moviliza;
                $tramite[$i]["comunica"] = $row->comunica;
                if($row->comunica){
                    $tramite[$i]["nom_comunica"] = $this->parametricas->nombre_comunica($row->comunica);
                }
                $tramite[$i]["cual_comunica"] = $row->cual_comunica;
                $tramite[$i]["req_acompanante"] = $row->req_acompanante;
                $tramite[$i]["vive_persona"] = $row->vive_persona;
                $tramite[$i]["id_ips"] = $row->id_ips;
                $tramite[$i]["nombre_ips"] = $row->nombre_ips;
                if($row->id_ips){
                    $tramite[$i]["nom_ips"] = $this->parametricas->nombre_ips($row->id_ips);
                    $tramite[$i]["email_ips"] = $this->parametricas->email_ips($row->id_ips);
                    $tramite[$i]["telefono_ips"] = $this->parametricas->telefono_ips($row->id_ips);
                    $tramite[$i]["direccion_ips"] = $this->parametricas->direccion_ips($row->id_ips);
                }
                $tramite[$i]["cu_pnombre"] = $row->cu_pnombre;
                $tramite[$i]["cu_snombre"] = $row->cu_snombre;
                $tramite[$i]["cu_papellido"] = $row->cu_papellido;
                $tramite[$i]["cu_sapellido"] = $row->cu_sapellido;
                $tramite[$i]["cu_tipodoc"] = $row->cu_tipodoc;
                $tramite[$i]["nom_tipodoc"] = $this->parametricas->nombre_tipodoc($row->cu_tipodoc);
                $tramite[$i]["cu_numdoc"] = $row->cu_numdoc;
                $tramite[$i]["cu_email"] = $row->cu_email;
                $tramite[$i]["cu_telefono"] = $row->cu_telefono;
                $tramite[$i]["cu_celular"] = $row->cu_celular;
                $tramite[$i]["fecha_registro"] = $row->fecha_registro;
                $tramite[$i]["id_usuario_revisa"] = $row->id_usuario_revisa;
                $tramite[$i]["fecha_revision"] = $row->fecha_revision;
                $tramite[$i]["id_usuario_coordinador"] = $row->id_usuario_coordinador;
                $tramite[$i]["fecha_revisa_coordinador"] = $row->fecha_revisa_coordinador;
                $tramite[$i]["cod_autorizacion"] = $row->cod_autorizacion;
                $tramite[$i]["id_usuario_director"] = $row->id_usuario_director;
                if($row->id_usuario_director != ''){
                    $tramite[$i]["nom_usuario_director"] = $this->parametricas->nombre_director($row->id_usuario_director);
                    $tramite[$i]["email_director"] = $this->parametricas->email_director($row->id_usuario_director);
                }
                $tramite[$i]["fecha_aprueba_director"] = $row->fecha_aprueba_director;
                $tramite[$i]["id_estado"] = $row->id_estado;
                $tramite[$i]["observaciones"] = $row->observaciones;
                $tramite[$i]["descripcion"] = $row->descripcion;
                $tramite[$i]["nume_identificacion"] = $row->nume_identificacion;
                $tramite[$i]["tipo_identificacion"] = $row->tipo_identificacion;
                $tramite[$i]["tipoiden"] = $row->tipoiden;
                $tramite[$i]["p_nombre"] = $row->p_nombre;
                $tramite[$i]["s_nombre"] = $row->s_nombre;
                $tramite[$i]["p_apellido"] = $row->p_apellido;
                $tramite[$i]["s_apellido"] = $row->s_apellido;
                $tramite[$i]["email"] = $row->email;
                $tramite[$i]["telefono_fijo"] = $row->telefono_fijo;
                $tramite[$i]["telefono_celular"] = $row->telefono_celular;
                $tramite[$i]["ciudadnacimiento"] = $row->ciudadnacimiento;
                $tramite[$i]["dire_resi"] = $row->dire_resi;
                $tramite[$i]["localidad"] = $row->localidad;
                $tramite[$i]["fecha_nacimiento"] = $row->fecha_nacimiento;
                if($row->nivel_educativo){
                    $tramite[$i]["nom_nivel"] = $this->parametricas->nivel_educativo($row->nivel_educativo);
                }
            $i++;
            }
        }
        return $tramite;
        $this->db->close();

    }

     /**
     * Guuarda el histórico del trámite 
     * @since 06/2020
     */
    public function save_historico($idusuario)
    {       
        $fecha_registro = date('Y-m-d H:i:s');
        $id_usuario = $this->session->userdata('id_usuario');
        $data = array(
            'id_tramite' => $this->input->post('idtramite'),
            'id_usuario' => $id_usuario,
            'fecha_registro' => $fecha_registro,
            'id_estado' => $this->input->post('estado'),
            'observaciones' => $this->input->post('observaciones')
        );
        
        $query = $this->db->insert('discapacidad_historico', $data);
        
        $idTramite = $this->db->insert_id();
                
       if ($query) {
            return $idTramite;
        } else {
            return false;
        }

        
    }

     //Actualiza el trámite cuando cambian el estado
    public function actualizar_tramite($idpersona){
        $id_usuario = $this->session->userdata('id_usuario');
        $fecha_revision = date('Y-m-d');
        if($this->session->userdata('perfil')==2){
            $data = array(
                'id_estado' => $idpersona['id_estado'],
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==3){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_ips' => $this->input->post('ips'),
                'id_usuario_revisa' =>  $id_usuario,
                'fecha_revision' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==4){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_ips' => $this->input->post('ips'),
                'id_usuario_coordinador' =>  $id_usuario,
                'fecha_revisa_coordinador' => $fecha_revision,
                'id_modalidad' => $this->input->post('modalidad'),
                'cod_autorizacion' => $this->input->post('cod_autorizacion'),
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==5){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_ips' => $this->input->post('ips'),
                'id_usuario_director' =>  $id_usuario,
                'fecha_aprueba_director' => $fecha_revision,
                'id_modalidad' => $this->input->post('modalidad'),
                'cod_autorizacion' => $this->input->post('cod_autorizacion'),
                'observaciones' => $this->input->post('observaciones')
            );
        }
        if($this->session->userdata('perfil')==2){
            $this->db->where('id_usuario', $idpersona['id_usuario']);
        }
        else{
            $this->db->where('id_usuario', $idpersona);
        }
        return $this->db->update('discapacidad_tramite', $data);
        /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str);*/
        $this->db->close();
    }

    /**
     * Actualiza datos personales 
     * @since 06/2020
     */
    public function savePersona($idusuario)
    {   
        if($this->input->post('email')!=''){       
            $data = array(
                'p_nombre' => $this->input->post('p_nombre'),
                's_nombre' => $this->input->post("s_nombre"),
                'p_apellido ' => $this->input->post('p_apellido'),
                's_apellido' => $this->input->post('s_apellido'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'email' => $this->input->post('email'),
                'telefono_celular' => $this->input->post('telefono_celular'),
                'telefono_fijo' => $this->input->post('telefono_fijo'),
                'dire_resi' => $this->input->post('dire_resi'),
                'nivel_educativo' => $this->input->post('nivel_educativo')
                
            );
            $this->db->where('id_persona', $idusuario);
            $query = $this->db->update('persona', $data);
            
            $this->db->close();
            
            if ($query) {
                return $idusuario;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Actualiza datos personales 
     * @since 06/2020
     */
    public function save_datosTramite()
    {
        $data = array(
            'regimen_esp' => $this->input->post('regimen_esp'),
            'categoria_1' => $this->input->post("categoria1"),
            'categoria_2' => $this->input->post("categoria2"),
            'categoria_3' => $this->input->post("categoria3"),
            'categoria_4' => $this->input->post("categoria4"),
            'categoria_5' => $this->input->post("categoria5"),
            'categoria_6' => $this->input->post("categoria6"),
            'categoria_7' => $this->input->post("categoria7"),
            'categoria_8' => $this->input->post("categoria8"),
            'moviliza ' => $this->input->post('movilizar'),
            'cual_moviliza' => $this->input->post('cual_movilizar'),
            'comunica' => $this->input->post('comunicar'),
            'cual_comunica' => $this->input->post('cual_comunicar'),
            'req_acompanante' => $this->input->post('req_acompanante'),
            'vive_persona' => $this->input->post('vive_persona'),
            'id_estado' => 23,
        );
        $this->db->where('id_tramite', $this->input->post('id_tramite'));
        return $this->db->update('discapacidad_tramite', $data);
        //print_r($this->db->last_query());
        $this->db->close();
        
    }

    /**
     * Actualiza datos cuidador 
     * @since 06/2020
     */
    public function save_datosCuidador()
    {
        $data = array(
            'cu_pnombre' => $this->input->post('cuidador_pnombre'),
            'cu_snombre' => $this->input->post("cuidador_snombre"),
            'cu_papellido' => $this->input->post("cuidador_papellido"),
            'cu_sapellido' => $this->input->post("cuidador_sapellido"),
            'cu_tipodoc' => $this->input->post("cuidador_tipodoc"),
            'cu_numdoc' => $this->input->post("cuidador_numdoc"),
            'cu_email' => $this->input->post("email_cuidador"),
            'cu_telefono' => $this->input->post("cuidador_telefono"),
            'cu_celular' => $this->input->post("cuidador_celular"),
            'id_estado' => 23,
        );
        $this->db->where('id_tramite', $this->input->post('id_tramite'));
        return $this->db->update('discapacidad_tramite', $data);
        //print_r($this->db->last_query());
        $this->db->close();
        
    }

    public function editar_archivo ($datosAr){
        $data = array(
                'ruta' => $datosAr['ruta'],
                'nombre' => $datosAr['nombre'],
                'fecha' => $datosAr['fecha'],                
                'condicion' => $datosAr['condicion']
            );
        $this->db->where('id_archivo', $this->input->post('id_documento'));
        return $this->db->update('archivos', $data);
       /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str);*/
        $this->db->close();
    }

    /**
     * Obtiene la lista de archivos cargados.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_auditoria($id_tramite){
       $auditoria = array();
        $sql = "SELECT id_tramite, id_usuario, p.p_nombre, p.p_apellido, fecha_registro, id_estado, observaciones
        FROM discapacidad_historico e
        INNER JOIN usuarios u ON u.id = e.id_usuario
        INNER JOIN persona p ON p.id_persona = u.id_persona
        WHERE id_tramite = ".$id_tramite."
        ORDER BY id_tramite ASC ";
       
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
               $auditoria[$i]["id_tramite"] = $row->id_tramite;
               $auditoria[$i]["id_usuario"] = $row->id_usuario;
               $auditoria[$i]["p_nombre"] = $row->p_nombre;
               $auditoria[$i]["p_apellido"] = $row->p_apellido;
               $auditoria[$i]["fecha_registro"] = $row->fecha_registro;
               $auditoria[$i]["id_estado"] = $row->id_estado;
               $auditoria[$i]["observaciones"] = $row->observaciones;
            $i++;
            }
        }
        
        return$auditoria;
        $this->db->close();
    }

     /**
     * Verifica resolución
     * @since  06/2020
     */
    public function verifyResolucion($id_tramite,$estadoTramite) 
    {
        $this->db->where('id_tramite', $id_tramite);
        $this->db->where('estado_tramite', $estadoTramite);
        $query = $this->db->get("discapacidad_resoluciones");

        if ($query->num_rows() >= 1) {
            return true;
        } else{ 
            return false; 
        }

        $this->db->close();
    }

    /**
     * Guuarda el histórico del trámite 
     * @since 06/2020
     */
    public function save_resolucion($idtramite, $codigo_verificacion, $estadoTramite)
    {
        $fecha_resolucion = date('Y-m-d');
        $newFecha_nacimiento=$this->cert_discapacidad->formatoFecha($fecha_nacimiento,'-');
        $data = array(
            'fecha_resolucion' => $fecha_resolucion,
            'id_tramite' => $idtramite,
            'codigo_verificacion' => $codigo_verificacion,
            'estado_tramite' => $estadoTramite,
            'estado_resolucion' => 1
        );
       
        $query = $this->db->insert('discapacidad_resoluciones', $data);

        $idResolucion= $this->db->insert_id();
       /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str);*/
       if ($query) {
            return $idResolucion;
        } else {
            return false;
        }
       
        $this->db->close();
    } 

    //Consulta la resolución por id_tramite y estado
    public function consulta_resolucion($id_tramite,$estado){
        $cadena_sql = " SELECT
                        id_resolucion,
                        fecha_resolucion,
                        id_tramite,
                        codigo_verificacion,
                        estado_tramite,
                        estado_resolucion
                    FROM discapacidad_resoluciones
                    WHERE id_tramite = ".$id_tramite." 
                    AND estado_tramite= ".$estado.";";
                   
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }  

    function formatoFecha($fecha,$formato){
        $fecha = substr($fecha,0,10);
        switch($formato){
            case '-':  //Guardar en la Base de Datos
                       $arrayFecha = explode("-",$fecha);
                       $string = $arrayFecha[2]."/".$arrayFecha[1]."/".$arrayFecha[0];
                       break;
                      
            case '/':  //Recoger de la base de datos
                       $arrayFecha = explode('/',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[1].'-'.$arrayFecha[0];
                       break;
                      
            case '\\': //Recoger de la base de datos
                       $arrayFecha = explode('\\',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[1].'-'.$arrayFecha[0];
                       break;         
        }
        return $string;         
    }

    function listarSolicitudes($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->cert_discapacidad->formatoFecha($fechai,'/');
        $fechaFinal=$this->cert_discapacidad->formatoFecha($fechaf,'/');

        $sql = "SELECT DISTINCT TR.id_tramite,
                TR.id_usuario,
                TR.regimen_esp,
                TR.categoria_1,
                TR.categoria_2,
                TR.categoria_3,
                TR.categoria_4,
                TR.categoria_5,
                TR.categoria_6,
                TR.categoria_7,
                TR.categoria_8,
                TR.id_modalidad,
                MO.nombre as nom_modalidad,
                TR.moviliza,
                MV.nombre_dispositivo as dis_moviliza,
                TR.cual_moviliza,
                TR.comunica,
                CO.nombre_dispositivo as dis_comunica,
                TR.cual_comunica,
                TR.req_acompanante,
                TR.vive_persona,
                TR.id_ips,
                TR.cu_pnombre,
                TR.cu_snombre,
                TR.cu_papellido,
                TR.cu_sapellido,
                TR.cu_tipodoc,
                TR.cu_numdoc,
                TR.cu_email,
                TR.cu_telefono,
                TR.cu_celular,
                TR.fecha_registro,
                TR.id_usuario_revisa,
                TR.fecha_revision,
                TR.id_usuario_coordinador,
                TR.fecha_revisa_coordinador,
                TR.cod_autorizacion,
                TR.id_usuario_director,
                TR.fecha_aprueba_director,
                TR.id_estado,
                TR.observaciones,
                ET.descripcion est_tramite,
                TR.fecha_registro,
                PER.nume_identificacion,
                PER.tipo_identificacion,
                TI.Descripcion as nom_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                PER.ciudad_resi,
                MU.Descripcion as ciudad_residencia,
                PER.dire_resi,
                PER.nivel_educativo,
                NE.Nombre as nom_educativo,
                SEX.descripcion_sexo,
                PER.fecha_nacimiento,
                LO.Nombre as localidad,
                IPS.nombre_ips
            FROM discapacidad_tramite TR
            JOIN usuarios US ON US.id = TR.id_usuario
            JOIN persona PER ON PER.id_persona = US.id_persona
            JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
            JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PER.tipo_identificacion
            LEFT JOIN pr_municipio MU ON MU.IdMunicipio = PER.ciudad_resi
            LEFT JOIN pr_localidad LO ON LO.idLocalidad = PER.localidad
            LEFT JOIN discapacidad_ips IPS ON IPS.id_ips = TR.id_ips
            LEFT JOIN pr_nivel_educativo_per NE ON NE.IdNivelEducativo = PER.nivel_educativo
            LEFT JOIN pr_sexo SEX ON SEX.id_sexo = PER.sexo
            LEFT JOIN discapacidad_modalidad MO ON MO.id_modalidad = TR.id_modalidad
            LEFT JOIN discapacidad_moviliza MV ON MV.id_moviliza = TR.moviliza
            LEFT JOIN discapacidad_comunica CO ON CO.id_comunica = TR.comunica
           ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (21) ";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

    function listarHistorico($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->cert_discapacidad->formatoFecha($fechai,'/');
        $fechaFinal=$this->cert_discapacidad->formatoFecha($fechaf,'/');

        $sql = "SELECT TR.id_tramite,
                TR.id_usuario,
                TR.regimen_esp,
                TR.categoria_1,
                TR.categoria_2,
                TR.categoria_3,
                TR.categoria_4,
                TR.categoria_5,
                TR.categoria_6,
                TR.categoria_7,
                TR.categoria_8,
                TR.id_modalidad,
                MO.nombre as nom_modalidad,
                TR.moviliza,
                MV.nombre_dispositivo as dis_moviliza,
                TR.cual_moviliza,
                TR.comunica,
                CO.nombre_dispositivo as dis_comunica,
                TR.cual_comunica,
                TR.req_acompanante,
                TR.vive_persona,
                TR.id_ips,
                TR.cu_pnombre,
                TR.cu_snombre,
                TR.cu_papellido,
                TR.cu_sapellido,
                TR.cu_tipodoc,
                TR.cu_numdoc,
                TR.cu_email,
                TR.cu_telefono,
                TR.cu_celular,
                TR.fecha_registro,
                TR.id_usuario_revisa,
                TR.fecha_revision,
                TR.id_usuario_coordinador,
                TR.fecha_revisa_coordinador,
                TR.cod_autorizacion,
                TR.id_usuario_director,
                TR.fecha_aprueba_director,
                HT.id_estado,
                HT.observaciones as observaciones_h,
                HT.fecha_registro as fecha_registro_h,
                EH.descripcion est_tramite,
                TR.fecha_registro,
                PER.nume_identificacion,
                PER.tipo_identificacion,
                TI.Descripcion as nom_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                PER.ciudad_resi,
                MU.Descripcion as ciudad_residencia,
                PER.dire_resi,
                PER.nivel_educativo,
                NE.Nombre as nom_educativo,
                SEX.descripcion_sexo,
                PER.fecha_nacimiento,
                LO.Nombre as localidad,
                IPS.nombre_ips
            FROM discapacidad_tramite TR
            JOIN usuarios US ON US.id = TR.id_usuario
            JOIN persona PER ON PER.id_persona = US.id_persona
            JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
            JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PER.tipo_identificacion
            LEFT JOIN pr_municipio MU ON MU.IdMunicipio = PER.ciudad_resi
            LEFT JOIN pr_localidad LO ON LO.idLocalidad = PER.localidad
            LEFT JOIN discapacidad_ips IPS ON IPS.id_ips = TR.id_ips
            LEFT JOIN pr_nivel_educativo_per NE ON NE.IdNivelEducativo = PER.nivel_educativo
            LEFT JOIN pr_sexo SEX ON SEX.id_sexo = PER.sexo
            LEFT JOIN discapacidad_modalidad MO ON MO.id_modalidad = TR.id_modalidad
            LEFT JOIN discapacidad_moviliza MV ON MV.id_moviliza = TR.moviliza
            LEFT JOIN discapacidad_comunica CO ON CO.id_comunica = TR.comunica
            INNER JOIN discapacidad_historico HT ON HT.id_tramite = TR.id_tramite
            JOIN pr_estado_tramite EH ON EH.id_estado = HT.id_estado ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (21) ";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }
}               