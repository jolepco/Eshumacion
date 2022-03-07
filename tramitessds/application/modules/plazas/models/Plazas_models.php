<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Plazas_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function verifyTramite($arrData) 
    {
        $this->db->where($arrData["column"], $arrData["value"]);
        $this->db->where($arrData["column1"], $arrData["value1"]);
        $query = $this->db->get("plazas_tramite");
        
        if ($query->num_rows() >= 1) {
            return true;
        } else{ 
            return false; 
        }
        
              
        $this->db->close();
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
                        nombre_rs
                    FROM persona
                    LEFT JOIN pr_nivel_educativo_per ON IdNivelEducativo = nivel_educativo
                    WHERE id_persona = ".$id_usuario."";
       
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    } 

    /**
     * Add/Edit USER
     * @since 21/01/2020
     */
    public function saveTramite($id_usuario, $estado, $idTramite) 
    {
        $fecha=$fecha = date('Y-m-d');
        $data = array(
            'id_usuario' => $id_usuario,
            'id_estado ' => $estado,
            'fecha_registro' => $fecha,
            'enc_pnombre' => $this->input->post('encargado_pnombre'),
            'enc_snombre' => $this->input->post('encargado_snombre'),
            'enc_papellido' => $this->input->post('encargado_papellido'),
            'enc_sapellido' => $this->input->post('encargado_sapellido'),
            'enc_tipodoc' => $this->input->post('encargado_tipodoc'),
            'enc_numdoc' => $this->input->post('encargado_numdoc'),
            'enc_email' => $this->input->post('encargado_email'),
            'enc_telefono' => $this->input->post('encargado_telefono'),
            'enc_celular' => $this->input->post('encargado_celular')
        );  

            //revisar si es para adicionar o editar
        if ($idTramite == 'x') {
            $query = $this->db->insert('plazas_tramite', $data);
            $idTramite = $this->db->insert_id();
        } else {
            //$data['estado'] = $this->input->post('estado');
            $this->db->where('id_tramite', $idTramite);
            $query = $this->db->update('plazas_tramite', $data);
        }

        /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
        exit;*/

        if ($query) {
            return $idTramite;
        } else {
            return false;
        }
         $this->db->close();
    }


    public function get_tramites(){
    	$id_usuario=$this->session->userdata('id_persona');
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
        FROM plazas_tramite TR
        JOIN persona PER ON PER.id_persona = TR.id_usuario
        JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado ";
       	if($this->session->userdata('perfil')==2){
       		$sql.= "WHERE TR.id_usuario IN (".$id_usuario.") ";
       	}
        if($this->session->userdata('perfil')==3){
            $sql.= "WHERE TR.id_estado IN (1,15,20) ";
        }else if($this->session->userdata('perfil')==4){
             $sql.= "WHERE TR.id_estado IN (2) ";
        }else if($this->session->userdata('perfil')==5){
             $sql.= "WHERE TR.id_estado IN (3) ";
        }
             
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
                $i++;
            }
        }
       
        return $tramites;
        $this->db->close();
    }

     public function get_tramitesbyId($id_tramite){
        $cadena_sql = " SELECT
                        TR.id_tramite,
		                TR.id_usuario,
		                TR.id_estado,
		                TR.enc_pnombre,
		                TR.enc_snombre,
		                TR.enc_papellido,
		                TR.enc_sapellido,
		                TR.enc_tipodoc,
		                CASE
						    WHEN TR.enc_tipodoc = 1 THEN 'Cédula de ciudadanía'
						    WHEN TR.enc_tipodoc = 2 THEN 'Cédula de extranjería'
						    WHEN TR.enc_tipodoc = 3 THEN 'Tarjeta de identidad'
						    WHEN TR.enc_tipodoc = 4 THEN '	
                            Permiso especial de permanencia' 
							WHEN TR.enc_tipodoc = 5 THEN 'NIT'
							WHEN TR.enc_tipodoc = 6 THEN 'Pasaporte'
						    ELSE ''
						END tipidenenc,
		                TR.enc_numdoc,
		                TR.enc_email,
		                TR.enc_telefono,
		                TR.enc_celular,
		                ET.descripcion,
		                TR.fecha_registro,
                        TR.fecha_revisa_coordinador,
                        TR.fecha_aprobacion,
		                PER.nombre_rs,
		                PER.nume_identificacion,
		                CASE
						    WHEN PER.tipo_identificacion = 1 THEN 'Cédula de ciudadanía'
						    WHEN PER.tipo_identificacion = 2 THEN 'Cédula de extranjería'
						    WHEN PER.tipo_identificacion = 3 THEN 'Tarjeta de identidad'
						    WHEN PER.tipo_identificacion = 4 THEN '	
                            Permiso especial de permanencia' 
							WHEN PER.tipo_identificacion = 5 THEN 'NIT'
							WHEN PER.tipo_identificacion = 6 THEN 'Pasaporte'
						    ELSE ''
						END tipiden,
		                PER.tipo_identificacion,
		                PER.p_nombre,
		                PER.s_nombre,
		                PER.p_apellido,
		                PER.s_apellido,
		                PER.email,
		                PER.telefono_fijo,
		                PER.telefono_celular,
                        PER.nume_iden_rl,
                        PER.tipo_iden_rl,
                        TR.observaciones,
                        PR.id_proyecto,
                        PR.modalidad_plaza,
                        MP.descripcion as modalidad,
                        PR.nro_plazas,
                        PR.nom_proyecto,
                        PR.tipo_profesion,
                        PROF.nombre as profesion,
                        PR.tipo_vinculacion,
                        PV.descripcion as vinculacion, 
                        PR.especialidad,
                        PR.nro_poblacion,
                        PR.salario_asignado,
                        PR.fecha_registro
                    FROM plazas_tramite TR
                    JOIN persona PER ON PER.id_persona = TR.id_usuario
                    JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                    LEFT JOIN plazas_proyectos PR ON PR.id_tramite=TR.id_tramite
                    LEFT JOIN plazas_modlidad MP ON MP.id_modalidad=PR.modalidad_plaza
                    LEFT JOIN plazas_profesiones PROF ON PROF.id_profesion=PR.tipo_profesion
                    LEFT JOIN plazas_vinculacion PV ON PV.id_vinculacion=PR.tipo_vinculacion
                    WHERE TR.id_tramite = ".$id_tramite."
                    ORDER BY 1 LIMIT 1";
                 
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        
        return $result;
        $this->db->close();
    }

    public function mis_tramites($id_usuario){
        $cadena_sql = " SELECT
                        TR.id_tramite,
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
                        TR.observaciones
                    FROM plazas_tramite TR
                    JOIN persona PER ON PER.id_persona = TR.id_usuario
                    JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                    WHERE TR.id_usuario = ".$id_usuario."
                    ORDER BY 1 DESC limit 1";
                
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        
        return $result;
        $this->db->close();
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('plazas_historico', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  true;
        $this->db->close();
    }

    //Registra los archivos en la bd
    public function insertarArchivo($param) {
        
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
       
        $this->db->trans_complete();
        return  $insert_id;

        
        $str = $this->db->last_query();
                echo "<pre>";
                print_r($str);
                exit;
    }

    public function editar_archivo ($datosAr){
        $data = array(
                'ruta' => $datosAr['ruta'],
                'nombre' => $datosAr['nombre'],
                'fecha' => $datosAr['fecha'],                
                'condicion' => $datosAr['condicion']
            );
        $this->db->where('id_archivo', $this->input->post('id_documento'));
        $query = $this->db->update('archivos', $data);
      
        if ($query) {
            return true;
        } else {
            return false;
        }
        $this->db->close();
    }

    //guarda la información de los proyectos
    public function saveProyecto($id_tramite){
        $fecha = date('Y-m-d');
        $data = array(
            'id_tramite' => $id_tramite,
            'modalidad_plaza' => $this->input->post('modalidad'),
            'nro_plazas' => $this->input->post('nro_plazas'),
            'nom_proyecto' => $this->input->post('nombre_proyecto')?$this->input->post('nombre_proyecto'):'',
            'tipo_profesion' => $this->input->post('tipo_profesion'),
            'tipo_vinculacion' => $this->input->post('tipo_vinculacion'),
            
            'especialidad' => $this->input->post('especialidad')?$this->input->post('especialidad'):'',
            'nro_poblacion' => $this->input->post('nro_poblacion'),
            'salario_asignado' => $this->input->post('salario_plaza'),
            'fecha_registro' => $fecha,
            'estado_proyecto' => '1'
        );  

            //revisar si es para adicionar o editar
        if ($this->input->post('id_tramite') == 'x') {
            $query = $this->db->insert('plazas_proyectos', $data);
            $idTramite = $this->db->insert_id();
        } else {
            //$data['estado'] = $this->input->post('estado');
            $this->db->where('id_tramite', $idTramite);
            $query = $this->db->update('plazas_proyectos', $data);
        }

        /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
        exit;*/

        if ($query) {
            return $idTramite;
        } else {
            return false;
        }
         $this->db->close();
    }

    /**
     * Obtiene la lista de archivos cargados.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_archivos($id_tramite){
        $archivos = array();
        $sql = "SELECT id_archivo, ruta, nombre, id_persona, condicion
        FROM archivos
        WHERE ruta LIKE '%uploads/plazas/'
        AND nombre LIKE '".$id_tramite."-%'
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

    /**
     * Guuarda el histórico del trámite 
     * @since 06/2020
     */
    public function save_historico($idTramite)
    {    
        $idusuario=$this->session->userdata('id_usuario'); 
        $fecha_registro = date('Y-m-d H:i:s');
        $newFecha_nacimiento=$this->plazas_models->formatoFecha($fecha_nacimiento,'-');
        if($this->input->post('estado')){
            $estado=$this->input->post('estado');
        }else{
            $estado=1;
        }
        if($this->input->post('observaciones')){
            $observaciones = $this->input->post('observaciones');
        }else{
            $observaciones = "Se registra el proyecto por parte del ciudadano";
        }
        $data = array(
            'id_tramite' => $idTramite,
            'id_usuario' => $idusuario,
            'fecha_registro' => $fecha_registro,
            'id_estado' => $estado,
            'observaciones' => trim($observaciones)
        );
        
        $query = $this->db->insert('plazas_historico', $data);
        
        $idTramite = $this->db->insert_id();
                
       if ($query) {
            return $idTramite;
        } else {
            return false;
        }

        
    }

    //Da formato a la fecha
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

    //Actualiza el trámite cuando cambian el estado
    public function actualizar_tramite($idTramite){
        $id_usuario = $this->session->userdata('id_persona');
        $fecha_revision = date('Y-m-d');
        if($this->session->userdata('perfil')==2){
            $data = array(
                'id_estado' =>1,
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==3){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_revisa' =>  $id_usuario,
                'fecha_revision' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==4){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_coordinador' =>  $id_usuario,
                'fecha_revisa_coordinador' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones')
            );
        }else if($this->session->userdata('perfil')==5){
            $data = array(
                'id_estado' => $this->input->post('estado'),
                'id_usuario_aprueba' =>  $id_usuario,
                'fecha_aprobacion' => $fecha_revision,
                'observaciones' => $this->input->post('observaciones')
            );
        }
        if($this->session->userdata('perfil')==2){
            //$this->db->where('id_usuario', $idpersona['id_usuario']);
            $this->db->where('id_tramite', $idTramite);
        }
        else{
            $this->db->where('id_tramite', $idTramite);
        }
        return $this->db->update('plazas_tramite', $data);
        /*$str = $this->db->last_query();
        echo "<pre>";
        print_r($str); exit;*/
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
        FROM plazas_historico e
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
        $query = $this->db->get("plazas_resoluciones");

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
        $newFecha_nacimiento=$this->plazas_models->formatoFecha($fecha_nacimiento,'-');
        $data = array(
            'fecha_resolucion' => $fecha_resolucion,
            'id_tramite' => $idtramite,
            'codigo_verificacion' => $codigo_verificacion,
            'estado_tramite' => $estadoTramite,
            'estado_resolucion' => 1
        );
       
        $query = $this->db->insert('plazas_resoluciones', $data);

        $idResolucion= $this->db->insert_id();
       
       if ($query) {
            return $idResolucion;
        } else {
            return false;
        }
        $str = $this->db->last_query();
        echo "<pre>";
        print_r($str);
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
                    FROM plazas_resoluciones
                    WHERE id_tramite = ".$id_tramite." 
                    AND estado_tramite= ".$estado.";";
                   
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
        $this->db->close();
    }

    /**
     * Actualiza datos personales 
     * @since 06/2020
     */
    public function savePersona($idusuario)
    {
        $data = array(
            'p_nombre' => $this->input->post('p_nombre'),
            's_nombre' => $this->input->post("s_nombre"),
            'p_apellido ' => $this->input->post('p_apellido'),
            's_apellido' => $this->input->post('s_apellido'),
            'email' => $this->input->post('email'),
            'telefono_celular' => $this->input->post('telefono_celular'),
            'telefono_fijo' => $this->input->post('telefono_fijo'),
            'dire_resi' => $this->input->post('dire_resi'),
        );
        $this->db->where('id_persona', $idusuario);
        $query = $this->db->update('persona', $data);
        
        $this->db->close();
        $str = $this->db->last_query();
        /*echo "<pre>";
        print_r($str);
        exit;*/
        if ($query) {
            return $idusuario;
        } else {
            return false;
        }
    }

    /**
     * Actualiza datos encargado trámite 
     * @since 06/2020
     */
    public function saveEncargado($idtramite)
    {
        $data = array(
            'enc_numdoc' => $this->input->post('enc_numiden'),
            'enc_tipodoc' => $this->input->post("tipo_doc"),
            'enc_pnombre ' => $this->input->post('enc_pnombre'),
            'enc_snombre' => $this->input->post('enc_snombre'),
            'enc_papellido' => $this->input->post('enc_papellido'),
            'enc_sapellido' => $this->input->post('enc_sapellido'),
            'enc_email' => $this->input->post('enc_email'),
            'enc_telefono' => $this->input->post('enc_telefono'),
            'enc_celular' => $this->input->post('enc_celular'),
        );
        $this->db->where('id_tramite', $idtramite);
        $query = $this->db->update('plazas_tramite', $data);
        
        $this->db->close();
        $str = $this->db->last_query();
        /*echo "<pre>";
        print_r($str);
        exit;*/
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Actualiza datos del proyecto
     * @since 06/2020
     */
    public function saveEditproyecto($idtramite)
    {
        $fecha = date('Y-m-d');
        $data = array(
            'modalidad_plaza' => $this->input->post('modalidad'),
            'nro_plazas' => $this->input->post("nro_plazas"),
            'nom_proyecto' => $this->input->post('nombre_proyecto'),
            'tipo_profesion' => $this->input->post('tipo_profesion'),
            'tipo_vinculacion' => $this->input->post('tipo_vinculacion'),
            'especialidad' => $this->input->post('especialidad'),
            'nro_poblacion' => $this->input->post('nro_poblacion'),
            'salario_asignado' => $this->input->post('salario_plaza'),
            'fecha_modificacion' => $fecha
        );
        $this->db->where('id_tramite', $idtramite);
        $query = $this->db->update('plazas_proyectos', $data);
        
        if ($query) {
            return true;
        } else {
            return false;
        }
        $this->db->close();
    }

    function listarSolicitudesAP($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->plazas_models->formatoFecha($fechai,'/');
        $fechaFinal=$this->plazas_models->formatoFecha($fechaf,'/');

        $sql = "SELECT DISTINCT  TR.id_tramite,
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
                    WHEN 22 THEN 'Pendiente para registro de proyecto'
                END as nombre_estado,
                ET.descripcion,
                TR.fecha_registro,
                TR.fecha_aprobacion,
                PER.nume_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                CONCAT(PER.p_nombre,' ',PER.s_nombre,' ',PER.p_apellido,' ',PER.s_apellido) as nombres,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                PER.nume_iden_rl,
                PER.tipo_iden_rl,
                PER.nombre_rs,
                TR.Observaciones,
                HT.observaciones as observaciones_h,
                HT.fecha_registro as fecha_registro_h,
                HT.id_estado as id_estado_h,
                HT.id_usuario as id_usuario_h,
                CONCAT(PEF.p_nombre, ' ', PEF.s_nombre, ' ', PEF.p_apellido, ' ',PEF.s_apellido) as nombre_f
                FROM plazas_tramite TR
                   INNER JOIN persona PER ON PER.id_persona = TR.id_usuario
                   INNER JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                   LEFT JOIN plazas_resoluciones RE ON RE.id_tramite=TR.id_tramite  
                   LEFT JOIN plazas_historico HT ON HT.id_tramite = TR.id_tramite  AND HT.id_estado=TR.id_estado
                   LEFT JOIN persona PEF ON PEF.id_persona = HT.id_usuario
                   ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (21) GROUP BY TR.id_tramite ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

    function listarHistoricoAP($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->plazas_models->formatoFecha($fechai,'/');
        $fechaFinal=$this->plazas_models->formatoFecha($fechaf,'/');

        $sql = "SELECT TR.id_tramite,
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
                    WHEN 22 THEN 'Pendiente para registro de proyecto'
                END as nombre_estado,
                ET.descripcion,
                TR.fecha_registro,
                TR.fecha_aprobacion,
                PER.nume_identificacion,
                PER.p_nombre,
                PER.s_nombre,
                PER.p_apellido,
                PER.s_apellido,
                PER.email,
                PER.telefono_fijo,
                PER.telefono_celular,
                TR.Observaciones,
                HT.observaciones as observaciones_h,
                HT.fecha_registro as fecha_registro_h,
                HT.id_estado as id_estado_h,
                HT.id_usuario as id_usuario_h,
                CONCAT(PEF.p_nombre, ' ', PEF.s_nombre, ' ', PEF.p_apellido, ' ',PEF.s_apellido) as nombre_f
                FROM plazas_tramite TR
                   INNER JOIN persona PER ON PER.id_persona = TR.id_usuario
                   INNER JOIN pr_estado_tramite ET ON ET.id_estado = TR.id_estado
                   LEFT JOIN plazas_resoluciones RE ON RE.id_tramite=TR.id_tramite  
                   INNER JOIN plazas_historico HT ON HT.id_tramite = TR.id_tramite 
                   LEFT JOIN persona PEF ON PEF.id_persona = HT.id_usuario
                   ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE TR.fecha_registro BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE TR.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
        $sql .= "AND TR.id_estado NOT IN (20) ";
       
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }
}     
