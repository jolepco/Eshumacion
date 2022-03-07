<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class expendedor extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function aceptarTerminos($id_persona) {

        $data = array(
            'fecha_terminos' => date('Y-m-d')
        );
        $this->db->where('id_persona', $id_persona);
        return $this->db->update('usuarios', $data);
    }

    /**
     * Verifica trámite
     * @since  21/01/2020
     */
    public function verifyTramite($arrData) 
    {
        $this->db->where($arrData);
        
        $query = $this->db->get("expdrogas_tramite");
        
        if ($query->num_rows() >= 1) {
            return true;
        } else{ 
            return false; 
        }
              

        $this->db->close();
    }

    //Registra el támite de expendedor de droga
    public function registrarTramite($param) {
        $this->db->trans_start();
        $this->db->insert('expdrogas_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
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

    public function consulta_tramite($id_usuario){
        $cadena_sql = " SELECT
                        id_expdrogas_tramite,
                        id_usuario,
                        id_estado,
                        fecha_registro,
                        observaciones
                    FROM expdrogas_tramite
                    WHERE id_usuario = ".$id_usuario."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }

    public function consulta_oracle($id_usuario){
        $tramite = array();
        $oracle = $this->load->database('oracle', TRUE);
        $cadena_sql = " SELECT
                        NROIDENT,
                        NOMBRES,
                        APELLIDOS,
                        NUMERO_RESOLUCION,
                        FECHA_RESOLUCION
                    FROM V_CERT_MEDICAMENTOS
                    WHERE NROIDENT = ".$id_usuario.""; //19441394
        //$query = $this->load->database('oracle', TRUE); 
        $query = $oracle->query($cadena_sql);
        
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row)
            {
                $tramite["NROIDENT"] = $row->NROIDENT;
                $tramite["NOMBRES"] = $row->NOMBRES;
                $tramite["APELLIDOS"] = $row->APELLIDOS;
                $tramite["NUMERO_RESOLUCION"] = $row->NUMERO_RESOLUCION;
                $tramite["FECHA_RESOLUCION"] = $row->FECHA_RESOLUCION;
            $i++;
            }
        }else{
            $tramite["NROIDENT"] = "0";
            $tramite["NOMBRES"] = "0";
            $tramite["APELLIDOS"] = "0";
            $tramite["NUMERO_RESOLUCION"] = "0";
            $tramite["FECHA_RESOLUCION"] = "0";
        }

        $this->db->close();
        return $tramite;
        
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
                    WHERE id_persona = ".$id_usuario."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }               

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('expdrogas_historico_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
        /*$str = $this->db->last_query();

        echo "<pre>";
        print_r($str);
        exit;*/
        $this->db->close();
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
     * Obtiene la lista de los estados de trámite.
     * @author sjneirag
     * @since  06/2020
     */
    function consulat_estados(){
       
        $estados = array();
        $sql = "SELECT id_estado, descripcion
        FROM pr_estado_tramite ";
        if($this->session->userdata('perfil')==3){
            $sql.= "WHERE id_estado IN (2,5,9,13,17) ";
        }else if($this->session->userdata('perfil')==4){
            $sql.= "WHERE id_estado IN (3,6,10,15,18) ";
        }else if($this->session->userdata('perfil')==5){
            $sql.= "WHERE id_estado IN (4,7,11,19,20) ";
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

    function formatoFecha($fecha,$formato){
        $fecha = substr($fecha,0,10);
        switch($formato){
            case '-':  //Guardar en la Base de Datos
                       $arrayFecha = explode("-",$fecha);
                       $string = $arrayFecha[2]."/".$arrayFecha[1]."/".$arrayFecha[0];
                       break;
                      
            case '/':  //Recoger de la base de datos
                       $arrayFecha = explode('/',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[0].'-'.$arrayFecha[1];
                       break;
                      
            case '\\': //Recoger de la base de datos
                       $arrayFecha = explode('\\',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[1].'-'.$arrayFecha[0];
                       break;         
        }
        return $string;         
    }   

    /**
     * Actualiza datos personales 
     * @since 06/2020
     */
    public function savePersona($idusuario)
    {
        if($this->input->post('email') != ''){
            $fecha_nacimiento=$this->input->post('fecha_nacimiento');
            $newFecha_nacimiento=$this->expendedor->formatoFecha($fecha_nacimiento,'/');
            $data = array(
                'p_nombre' => $this->input->post('p_nombre'),
                's_nombre' => $this->input->post("s_nombre"),
                'p_apellido ' => $this->input->post('p_apellido'),
                's_apellido' => $this->input->post('s_apellido'),
                'fecha_nacimiento' => $newFecha_nacimiento,
                'email' => $this->input->post('email'),
                'telefono_celular' => $this->input->post('telefono_celular'),
                'telefono_fijo' => $this->input->post('telefono_fijo'),
                'dire_resi' => $this->input->post('dire_resi'),
                'nivel_educativo' => $this->input->post('nivel_educativo')
                
            );
            $this->db->where('id_persona', $idusuario);
            $query = $this->db->update('persona', $data);
            
            $this->db->close();
            /*$str = $this->db->last_query();
            echo "<pre>";
            print_r($str);
            exit;*/
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
     * Obtiene la lista de archivos cargados.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_archivos($id_usuario){
        $archivos = array();
        $sql = "SELECT id_archivo, ruta, nombre, id_persona, condicion
        FROM archivos
        WHERE ruta LIKE '%uploads/expendedor/'
        AND id_persona = ".$id_usuario."
        AND estado = 'AC'
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
     * Obtiene la lista de archivos cargados.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_auditoria($id_tramite){
       $auditoria = array();
        $sql = "SELECT id_tramite, id_usuario, p.p_nombre, p.p_apellido, fecha_registro, id_estado, observaciones
        FROM expdrogas_historico_tramite e
        INNER JOIN persona p ON p.id_persona = e.id_usuario
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

    public function get_tramites(){
        $tramites = array();
        $sql = "SELECT  
                TR.id_expdrogas_tramite,
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
                TR.observaciones,
                RE.id_resolucion
        FROM expdrogas_tramite TR
        JOIN persona PER ON PER.id_persona = TR.id_usuario
        JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado 
        LEFT JOIN expdrogas_resoluciones RE ON RE.id_tramite = TR.id_expdrogas_tramite ";
       
        if($this->session->userdata('perfil')==3){
            $sql.= "WHERE TR.id_estado IN (1,8,12,15,23,12) ";
        }else if($this->session->userdata('perfil')==4){
             $sql.= "WHERE TR.id_estado IN (5,2,9,20,17) ";
        }else if($this->session->userdata('perfil')==5){
             $sql.= "WHERE TR.id_estado IN (3,6,10,18) ";
        }
             
        $sql.= "AND TR.id_estado NOT IN (21) ";
        $sql.= "ORDER BY 1 DESC ";
        
        $query = $this->db->query($sql);
        if ($query->num_rows()>0){
            $i = 0;
            foreach($query->result() as $row){
                $tramites[$i]["id_expdrogas"] = $row->id_expdrogas_tramite;
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

    //
    public function mis_tramites($id_usuario){
        $cadena_sql = " SELECT
                        TR.id_expdrogas_tramite,
                        TR.id_estado,
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
                        TR.observaciones,
                        TR.obs_aclaracion,
                        TR.obs_articulo1
                    FROM expdrogas_tramite TR
                    JOIN persona PER ON PER.id_persona = TR.id_usuario
                    JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                    WHERE TR.id_usuario = ".$id_usuario."
                    AND TR.id_estado NOT IN (21)
                    ORDER BY 1";
                 
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        
        return $result;
        $this->db->close();
    }

	public function consulta_resolucion($id_persona,$estado){
        $cadena_sql = " SELECT
                        id_resolucion,
                        fecha_resolucion,
                        id_tramite,
                        codigo_verificacion,
                        id_estado_tramite,
                        estado_resolucion
                    FROM expdrogas_resoluciones
                    WHERE id_persona = ".$id_persona." 
                    AND id_estado_tramite= ".$estado.";";
                   
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }


    public function tramites_seguimientociudadanano_id($id_titulo){
	    $cadena_sql = " SELECT SEG.fecha_registro, USR.perfil, PER.p_apellido, PER.s_apellido, PER.p_nombre, PER.s_nombre, EST.descripcion, SEG.observaciones, SEG.tipomotivoaclaracion
        FROM seguimiento_tramite SEG 
		JOIN usuarios USR ON USR.id = SEG.id_usuario
		LEFT JOIN persona PER ON PER.id_persona = USR.id_persona
		JOIN pr_estado_tramite EST ON EST.id_estado = SEG.estado
        WHERE SEG.estado in (13,16) AND SEG.id_titulo = ".$id_titulo;

	    $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

    public function consulta_resolucionreposicion($id_titulo){
        $cadena_sql = " SELECT
                        id_resolucion,
                        id_titulo,
                        id_archivo,
                        codigo_verificacion,
                        estado
                    FROM resoluciones_titulo
                    WHERE id_titulo = ".$id_titulo.";";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consulta_seguimientoresolucion($id_titulo){
        $cadena_sql = " SELECT
                        *
                    FROM seguimiento_tramite
                    WHERE id_titulo = ".$id_titulo.";";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
    public function consultar_archivo_resolucion($id_archivo){
        $cadena_sql = " SELECT
                            id_archivo,
                            ruta,
                            nombre,
                            fecha,
                            tags,
                            es_publico,
                            estado
                        FROM
                            archivos
                        WHERE id_archivo = ".$id_archivo." ";
        //echo $cadena_sql;
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }

	
     /**
     * Guuarda el histórico del trámite 
     * @since 06/2020
     */
    public function save_historico($idpersona)
    {       
        $id_usuario = $this->session->userdata('id_persona');
        $fecha_registro = date('Y-m-d H:i:s');
        $newFecha_nacimiento=$this->expendedor->formatoFecha($fecha_nacimiento,'-');
        $data = array(
            'id_tramite' => $this->input->post('idtramite'),
            'id_usuario' => $id_usuario,
            'fecha_registro' => $fecha_registro,
            'id_estado' => $this->input->post('estado'),
            'observaciones' => $this->input->post('observaciones')
        );
        
        $query = $this->db->insert('expdrogas_historico_tramite', $data);
        
        $idTramite = $this->db->insert_id();
                
       if ($query) {
            return $idTramite;
        } else {
            return false;
        }

        
    }

    //Actualiza el trámite cuando cambian el estado
    public function actualizar_tramite($idpersona){
        $id_usuario = $this->session->userdata('id_persona');
        $fecha_revision = date('Y-m-d');
       
        if($this->session->userdata('perfil')==2){
            $data = array(
                'id_estado' => $idpersona['id_estado'],
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==3){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_revisa' =>  $id_usuario,
                'fecha_revision' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones'),
                'obs_aclaracion' => $this->input->post('obs_aclaracion'),
                'obs_articulo1' => $this->input->post('obs_articulo1')
            );
        }else if($this->session->userdata('perfil')==4){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_coordinador' =>  $id_usuario,
                'fecha_revisa_coordinador' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones'),
                'obs_aclaracion' => $this->input->post('obs_aclaracion'),
                'obs_articulo1' => $this->input->post('obs_articulo1')
                
            );
        }else if($this->session->userdata('perfil')==5){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_aprueba' =>  $id_usuario,
                'fecha_aprobacion' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones'),
                'obs_aclaracion' => $this->input->post('obs_aclaracion'),
                'obs_articulo1' => $this->input->post('obs_articulo1')
            );
        }
        if($this->session->userdata('perfil')==2){
            $this->db->where('id_usuario', $idpersona['id_usuario']);
        }
        else{
            $this->db->where('id_usuario', $idpersona);
        }
        return $this->db->update('expdrogas_tramite', $data);
       $str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
        $this->db->close();
    }

    //Actualiza los estados del archivo
    public function actualizar_archivo ($idarchivo){
        $data = array(
            'condicion' => $this->input->post($idarchivo)
        );
        $this->db->where('id_archivo', $idarchivo);
        return $this->db->update('archivos', $data);
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
       $str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
        $this->db->close();
    }

    //Anula el trámite cuando hay problemas al cargar los archivos
    public function anularTramite ($idusuario){
        $data = array(
                'id_estado' => 21,
                'Observaciones' => 'Se anula por intento de cargue de archivos pesados.'
            );
        $this->db->where('id_usuario', $idusuario);
        return $this->db->update('expdrogas_tramite', $data);
       $str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
        $this->db->close();
    }

    //Anulan los archivos por problemas en el cargue
    public function anularArchivos ($idusuario){
        $data = array(
                'estado' => 'DS'
            );
        $this->db->where('id_persona', $idusuario);
        return $this->db->update('archivos', $data);
        $this->db->close();
    }

    public function consulta_consecutivo($id_titulo){
        $cadena_sql = " SELECT
                            max(id_consecutivo) max_cons
                        FROM
                            seguimiento_tramite
                        WHERE id_titulo = ".$id_titulo." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function consulta_existe_documento($id_persona){
        $cadena_sql = " SELECT
                            pdf_documento
                        FROM
                            registro_titulo
                        WHERE id_persona = ".$id_persona." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
	
	public function actualizarEstadoReposicion($datos) {

        $data = array(
            'estado' => $datos['estado'],
			'fecha_reposicion' => $datos['fecha_reposicion']
        );

        $this->db->where('id_titulo', $datos['id_titulo']);
        return $this->db->update('registro_titulo', $data);
    }

	public function actualizarEstadoAclaracion($datos) {

        $data = array(
            'estado' => $datos['estado'],
			'fecha_aclaracion' => $datos['fecha_aclaracion']
        );

        $this->db->where('id_titulo', $datos['id_titulo']);
        return $this->db->update('registro_titulo', $data);
    }

	// Creación validacion no duplicados en mysql Exh Mario Beltran 30012020.
    	public function validartramitemsqlExh($datosAr){
	    $data = array(
            	'numero_licencia' => $datosAr['numero_licencia'],
		'fechaInh' => $datosAr['fechaInh'],
	        'id_persona' => $datosAr['id_persona'],

	    );
	
        $cadena_sql = "SELECT DISTINCT
                       l.numero_licencia 
	    	       FROM licencia_exhuma as l, persona as p,estado_tramite_licenciaExh as e";

	if($data['numero_licencia'] !="" && $data['fechaInh'] !=""){
		  $cadena_sql.=" WHERE l.numero_licencia = '".$data['numero_licencia']."' AND l.fecha_inhumacion = '".$data['fechaInh']."' AND 			l.id_persona ='".$data['id_persona']."' AND l.estado <> 5 ORDER BY 1";
	}
	else{
		  $cadena_sql.=" WHERE l.id_persona = ".$data['id_persona']." AND l.estado = 0 ORDER BY 1";
	}
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    /**
     * Verifica resolución
     * @since  06/2020
     */
    public function verifyResolucion($idpersona,$estadoTramite) 
    {
        $this->db->where('id_persona', $idpersona);
        $this->db->where('id_estado_tramite', $estadoTramite);
        $query = $this->db->get("expdrogas_resoluciones");

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
    public function save_resolucion($idpersona, $codigo_verificacion, $estadoTramite)
    {
        $idpersona = $this->session->userdata('idpersona');
        $fecha_resolucion = date('Y-m-d');
        $newFecha_nacimiento=$this->expendedor->formatoFecha($fecha_nacimiento,'-');
        $data = array(
            'fecha_resolucion' => $fecha_resolucion,
            'id_tramite' => $this->input->post('idtramite'),
            'id_persona' => $idpersona,
            'codigo_verificacion' => $codigo_verificacion,
            'id_estado_tramite' => $estadoTramite,
            'estado_resolucion' => 1
        );
       
        $query = $this->db->insert('expdrogas_resoluciones', $data);

        $idResolucion= $this->db->insert_id();
       
       if ($query) {
            return $idResolucion;
        } else {
            return false;
        }
        
        $this->db->close();
        
    }

    function listarSolicitudesED($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->expendedor->formatoFecha($fechai,'/');
        $fechaFinal=$this->expendedor->formatoFecha($fechaf,'/');

        $sql = "SELECT TR.id_expdrogas_tramite,
                TR.id_usuario,
                TR.id_estado,
                CASE TR.id_estado
                    WHEN 1 THEN 'Registrado por usuario'
                    WHEN 2 THEN 'Aprobado por validador'
                    WHEN 3 THEN 'Aprobado por coordinador'
                    WHEN 4 THEN 'Aprobado y firmado'
                    WHEN 5 THEN 'Negado por el validador'
                    WHEN 6 THEN 'Negado por el coordinador'
                    WHEN 7 THEN 'Negado y firmado'
                    WHEN 8 THEN 'Solicitud de recurso de reposición'
                    WHEN 9 THEN 'Resuelve recurso de reposición validacion'
                    WHEN 10 THEN 'Resuelve recurso de reposición coordinador'
                    WHEN 11 THEN 'Resuelve recurso de reposición firma'
                    WHEN 12 THEN 'Solicitud de recurso de aclaración'
                    WHEN 13 THEN 'Solicitar mas información'
                    WHEN 14 THEN 'Firmar Documento'
                    WHEN 15 THEN 'Devolver validación coordinación'
                    WHEN 16 THEN 'Tramite duplicado - Anular'
                    WHEN 17 THEN 'Resuelve recurso de aclaración validación'
                    WHEN 18 THEN 'Resuelve recurso de aclaración coordinador'
                    WHEN 19 THEN 'Resuelve recurso de aclaración firma'
                    WHEN 20 THEN 'Devolver validación dirección'
                    WHEN 21 THEN 'Anulado'
                    WHEN 23 THEN 'Subsanado'
                END as nombre_estado,
                ET.descripcion,
                TR.fecha_registro,
                TR.fecha_aprobacion,
                PER.nume_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                CONCAT(PER.p_nombre, ' ', PER.s_nombre, ' ', PER.p_apellido, ' ',PER.s_apellido) as nombre_solisitante,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                TR.Observaciones,
                HT.observaciones as observaciones_h,
                HT.fecha_registro as fecha_registro_h,
                HT.id_estado as id_estado_h,
                HT.id_usuario as id_usuario_h,
                CONCAT(PEF.p_nombre, ' ', PEF.s_nombre, ' ', PEF.p_apellido, ' ',PEF.s_apellido) as nombre_f,
                PER.nacionalidad,
                PA.Nombre as Pais,
                PER.departamento, 
                DEP.Descripcion as Depto,
                PER.ciudad_nacimiento, 
                MUN.Descripcion as Ciudad, 
                PER.dire_resi, 
                PER.localidad, 
                LOC.Nombre as nomlocalidad,
                PER.upz, 
                UPZ.nom_upz, 
                PER.barrio, 
                BAR.nombre_barrio, 
                PER.fecha_nacimiento, 
                PER.edad, 
                PER.sexo,
                SEX.descripcion_sexo, 
                PER.genero, 
                PER.orientacion, 
                PER.etnia,
                ETN.Nombre as nomEtnia, 
                PER.estado_civil,
                ECV.Nombre as estcivil, 
                PER.nivel_educativo,
                NED.Nombre as nivelEducativo
                FROM expdrogas_tramite TR
                INNER JOIN persona PER ON PER.id_persona = TR.id_usuario
                INNER JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                LEFT JOIN expdrogas_resoluciones RE ON RE.id_tramite=TR.id_expdrogas_tramite  
                LEFT JOIN expdrogas_historico_tramite HT ON HT.id_tramite = TR.id_expdrogas_tramite  AND HT.id_estado=TR.id_estado
                LEFT JOIN persona PEF ON PEF.id_persona = HT.id_usuario
                LEFT JOIN pr_pais PA ON PER.nacionalidad=PA.IdPais
                LEFT JOIN pr_departamento DEP ON PER.departamento=DEP.IdDepartamento
                LEFT JOIN pr_municipio MUN ON PER.ciudad_nacimiento=MUN.IdMunicipio
                LEFT JOIN pr_localidad LOC ON PER.localidad=LOC.idLocalidad
                LEFT JOIN pr_upz UPZ ON PER.upz=UPZ.id_upz
                LEFT JOIN pr_barrio BAR ON PER.barrio=BAR.id_barrio
                LEFT JOIN pr_sexo SEX ON PER.sexo=SEX.id_sexo
                LEFT JOIN pr_etnia ETN ON PER.etnia=ETN.IdEtnia
                LEFT JOIN pr_estadocivil ECV ON PER.estado_civil= ECV.IdEstadoCivil
                LEFT JOIN pr_nivel_educativo_per NED ON PER.nivel_educativo=NED.IdNivelEducativo
                ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (21) GROUP BY TR.id_expdrogas_tramite";
        //echo "MMM".$sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

    function listarHistoricoED($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->expendedor->formatoFecha($fechai,'/');
        $fechaFinal=$this->expendedor->formatoFecha($fechaf,'/');

        $sql = "SELECT TR.id_expdrogas_tramite,
                TR.id_usuario,
                HT.id_estado,
                CASE HT.id_estado
                    WHEN 1 THEN 'Registrado por usuario'
                    WHEN 2 THEN 'Aprobado por validador'
                    WHEN 3 THEN 'Aprobado por coordinador'
                    WHEN 4 THEN 'Aprobado y firmado'
                    WHEN 5 THEN 'Negado por el validador'
                    WHEN 6 THEN 'Negado por el coordinador'
                    WHEN 7 THEN 'Negado y firmado'
                    WHEN 8 THEN 'Solicitud de recurso de reposición'
                    WHEN 9 THEN 'Resuelve recurso de reposición validacion'
                    WHEN 10 THEN 'Resuelve recurso de reposición coordinador'
                    WHEN 11 THEN 'Resuelve recurso de reposición firma'
                    WHEN 12 THEN 'Solicitud de recurso de aclaración'
                    WHEN 13 THEN 'Solicitar mas información'
                    WHEN 14 THEN 'Firmar Documento'
                    WHEN 15 THEN 'Devolver validación coordinación'
                    WHEN 16 THEN 'Tramite duplicado - Anular'
                    WHEN 17 THEN 'Resuelve recurso de aclaración validación'
                    WHEN 18 THEN 'Resuelve recurso de aclaración coordinador'
                    WHEN 19 THEN 'Resuelve recurso de aclaración firma'
                    WHEN 20 THEN 'Devolver validación dirección'
                    WHEN 21 THEN 'Anulado'
                    WHEN 23 THEN 'Subsanado'
                END as nombre_estado,
                ET.descripcion,
                TR.fecha_registro,
                TR.fecha_aprobacion,
                PER.nume_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                CONCAT(PER.p_nombre, ' ', PER.s_nombre, ' ', PER.p_apellido, ' ',PER.s_apellido) as nombre_solisitante,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                TR.Observaciones,
                HT.observaciones as observaciones_h,
                HT.fecha_registro as fecha_registro_h,
                HT.id_estado as id_estado_h,
                HT.id_usuario as id_usuario_h,
                CONCAT(PEF.p_nombre, ' ', PEF.s_nombre, ' ', PEF.p_apellido, ' ',PEF.s_apellido) as nombre_f
                FROM expdrogas_tramite TR
                   INNER JOIN persona PER ON PER.id_persona = TR.id_usuario
                   INNER JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                   LEFT JOIN expdrogas_resoluciones RE ON RE.id_tramite=TR.id_expdrogas_tramite  
                   INNER JOIN expdrogas_historico_tramite HT ON HT.id_tramite = TR.id_expdrogas_tramite 
                   LEFT JOIN persona PEF ON PEF.id_persona = HT.id_usuario
                   ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (21) ";
        //secho "MMM".$sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }  	

}
