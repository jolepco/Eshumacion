<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class sst_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login_user($username) 
    {
        $sql = " SELECT id,	id_persona, perfil, username, password, estado, fecha_terminos ";
        $sql.= " FROM usuarios us ";
        $sql.= " WHERE username = '".$username."' ";
        $sql.= " AND estado = 'AC' ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() == 1)
        {
            return $query->row();
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            redirect(base_url().'login','refresh');
        }
    }

    public function info_usuario($id_persona) {
        $sql = " SELECT tipo_identificacion, nume_identificacion, p_nombre, s_nombre, p_apellido, s_apellido, email ";
        $sql.= " FROM persona  ";
        $sql.= " WHERE id_persona = ".$id_persona;
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function paises($id_pais = ''){
        $cadena_sql = " SELECT IdPais, Nombre, Orden FROM pr_pais ORDER BY 3";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function departamentos_col(){
        $cadena_sql = " SELECT IdDepartamento, IdPais, CodigoDane, Descripcion FROM pr_departamento WHERE IdPais = 170  order by Descripcion ASC ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consulta_departamento($dpto){
        $cadena_sql = " SELECT IdDepartamento, IdPais, CodigoDane, Descripcion FROM pr_departamento WHERE IdPais = 170 AND IdDepartamento = ".$dpto."  order by Descripcion ASC ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function municipios_col($dpto){
        $cadena_sql = " SELECT IdMunicipio, IdDepartamento, CodigoDane, Descripcion FROM pr_municipio WHERE IdDepartamento = ".$dpto." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consulta_municipio($mpio){
        $cadena_sql = " SELECT IdMunicipio, IdDepartamento, CodigoDane, Descripcion FROM pr_municipio WHERE IdMunicipio = ".$mpio." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function tipo_identificacion_todos(){
        $cadena_sql = " SELECT IdTipoIdentificacion, Codigo, Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion IN(1,2,3,4,6,5) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function insertarArchivo($param) {
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function insertarTramite($param) {
        $this->db->trans_start();
        $this->db->insert('sst_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function insertarTramiteFlujo($param) {
        $this->db->trans_start();
        $this->db->insert('sst_tramite_flujo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function insertarRegistroSST($param) {
        $this->db->trans_start();
        $this->db->insert('sst_registro', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function insertarTramiteCampo($param) {
        $this->db->trans_start();
        $this->db->insert('sst_tramite_campo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function insertarTramitePerfil($param) {
        $this->db->trans_start();
        $this->db->insert('sst_tramite_perfil', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

	public function sst_pendientes_usuario($id_usuario){

        $cadena_sql = "SELECT sst.*, stf.* , PE.*, se.*
						FROM sst_tramite sst
						JOIN usuarios US ON US.id = sst.id_usuario
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN sst_estados se ON se.id_estado = sst.id_estado
						JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id AND stf.id_estado = sst.id_estado 
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
		
		$cadena_sql .= " WHERE sst.id_usuario = ".$id_usuario;	
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }


       
    public function sst_pendientes($perfil){

        $cadena_sql = "SELECT sst.*, stf.* , PE.*, se.*, TI.Descripcion as descTipoIden
						FROM sst_tramite sst
						JOIN usuarios US ON US.id = sst.id_usuario
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN sst_estados se ON se.id_estado = sst.id_estado
						JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id AND stf.id_estado = sst.id_estado 
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
		if($perfil == 3){
			$cadena_sql .= " WHERE sst.id_estado IN (1,5)";	
		}else if($perfil == 4){
			$cadena_sql .= " WHERE sst.id_estado IN (2,3)";	
		}else if($perfil == 5){
			$cadena_sql .= " WHERE sst.id_estado IN (7,8)";	
		}
       		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramite_info_validacion($id_tramite){
		
		$cadena_sql = " SELECT st.*, se.*, pe.*, TI.idTipoIdentificacion, TI.Codigo, TI.Descripcion as descTipoIden ";
		$cadena_sql .= " FROM sst_tramite st ";
		$cadena_sql .= " JOIN sst_estados se ON se.id_estado = st.id_estado ";
		$cadena_sql .= " JOIN usuarios US ON US.id = st.id_usuario ";		
		$cadena_sql .= " JOIN persona pe ON pe.id_persona = US.id_persona ";
		$cadena_sql .= " JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = pe.tipo_identificacion ";
		$cadena_sql .= " WHERE st.id_tramite = ".$id_tramite;
        
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}

    public function tramite_registro($id_tramite){
		
		$cadena_sql = " SELECT str.*";
		$cadena_sql .= " FROM sst_registro str ";
		$cadena_sql .= " WHERE str.id_tramite = ".$id_tramite;
        
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
    
    public function actualizarEstadoTramite($parametros){
        $data = array(
            'id_estado' => $parametros['id_estado']
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_tramite', $data);
    }

    public function consultar_archivo($id_archivo){
		
		$cadena_sql = " SELECT ar.* ";
		$cadena_sql .= " FROM archivos ar  ";
		$cadena_sql .= " WHERE id_archivo = ".$id_archivo;
		$cadena_sql .= " AND ar.estado = 'AC'";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}

    public function estados_validacion($perfil){
		
		$cadena_sql = " SELECT id_estado, descripcion, rol ";
		$cadena_sql .= " FROM sst_estados  ";
		$cadena_sql .= " WHERE rol = ".$perfil;
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
    }
    
    public function seguimiento_tramite($id_tramite){
		
		$cadena_sql = "SELECT DISTINCT sst.id_tramite, sst.id_usuario, sst.id_estado, sst.fecha_creacion, stf.id_usuario, stf.id_estado, esta.descripcion AS descEstado, stf.fecha_estado, stf.observaciones, USU.username
						FROM sst_tramite sst
						JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id 
						JOIN sst_estados esta ON esta.id_estado = stf.id_estado 
						JOIN usuarios USU ON USU.id = stf.id_usuario
						WHERE sst.id_tramite = ".$id_tramite;
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }
    
    public function sst_perfiles_natural(){
		
		$cadena_sql = "SELECT *
						FROM sst_perfiles";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }

    public function sst_campos_accion_natural(){
		
		$cadena_sql = "SELECT *
                        FROM sst_campos_accion 
                        WHERE tipo_persona = 1";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }

    public function sst_campos_accion_juridica(){
		
		$cadena_sql = "SELECT *
                        FROM sst_campos_accion WHERE tipo_persona = 2";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }
    
    public function sst_campos_tramite($id_tramite){
		
		$cadena_sql = "SELECT * FROM sst_campos_validacion cv
                        JOIN sst_campos_accion ca ON ca.id_campo = cv.id_campo
                        LEFT JOIN sst_perfiles per ON per.id_perfil = cv.id_perfil 
                        WHERE cv.id_tramite = ".$id_tramite."
                        ORDER BY cv.contador";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }
    
    public function sst_campos_sedes($id_tramite){
		
		$cadena_sql = "SELECT DISTINCT contador, sede, id_perfil FROM sst_campos_validacion cv WHERE cv.id_tramite = ".$id_tramite;
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }

    public function sst_campos_tramite_sede($id_tramite, $contador){
		
		$cadena_sql = "SELECT * FROM sst_campos_validacion cv
                        JOIN sst_campos_accion ca ON ca.id_campo = cv.id_campo
                        LEFT JOIN sst_perfiles per ON per.id_perfil = cv.id_perfil 
                        WHERE cv.id_tramite = ".$id_tramite."
                        AND cv.contador = ".$contador."
                        ORDER BY cv.contador";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }

    public function sst_perfiles_tramite($id_tramite){
		
		$cadena_sql = "SELECT * FROM sst_tramite_perfil stp 
                        JOIN sst_perfiles sp ON stp.id_perfil = sp.id_perfil 
                        WHERE id_tramite = ".$id_tramite. " AND estado_perfil = 1 ";
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }
    
    public function campos_por_perfil($perfil){
		
		$cadena_sql = "SELECT ca.* FROM sst_perfiles_campos pc
                        JOIN sst_campos_accion ca ON ca.id_campo = pc.id_campo
                        WHERE pc.id_perfil = ".$perfil;
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
    }
    
    public function actualizarActaTramite($parametros){
        $data = array(
            'acta_visita' => $parametros['acta_visita'],
            'fecha_visita' => $parametros['fecha_visita']
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_tramite', $data);
    }

    public function actualizarDocumentoActa($parametros){
        $data = array(
            'pdf_acta' => $parametros['pdf_acta']
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_tramite', $data);
    }
    
    public function actualizarEstadoCampo($parametros){
        $data = array(
            'estado_aprobacion' => $parametros['estado_aprobacion']
        );
        $this->db->where('id_tramite_campo', $parametros['id_tramite_campo']);
        return $this->db->update('sst_tramite_campo', $data);
    }
    
    
    public function actualizarEstadoPerfil($parametros){
        $data = array(
            'estado_aprobacion' => $parametros['estado_aprobacion']
        );
        $this->db->where('id_tramite_perfil', $parametros['id_tramite_perfil']);
        return $this->db->update('sst_tramite_perfil', $data);
    }
    
    public function actualizarRegistroTramite($parametros){
       
        $data = array(
            'labora' => $parametros['labora'],
            'nombre_empresa' => $parametros['nombre_empresa'],
            'dir_empresa' => $parametros['dir_empresa'],
            'depto_empresa' => $parametros['depto_empresa'],
            'mpio_empresa' => $parametros['mpio_empresa'],
            'tel_empresa' => $parametros['tel_empresa'],
            'fax_empresa' => $parametros['fax_empresa'],
            'servicios' => $parametros['servicios'],
            'caracteristicas' => $parametros['caracteristicas'],
            'otros' => $parametros['otros'],
            'tipo_programa' => $parametros['tipo_programa'],
            'tipo_titulo' => $parametros['tipo_titulo'],
            'tipo_profesional' => $parametros['tipo_profesional'],
            'titulo_programa' => $parametros['titulo_programa'],
            'titulo_postgrado' => $parametros['titulo_postgrado']
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_registro', $data);
    }

    public function limpiarCampos($id_tramite){
        $data = array(
            'estado_campo' => 0
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_tramite_campo', $data);
    }
    
    public function limpiarPerfiles($id_tramite){
        $data = array(
            'estado_perfil' => 0
        );
        $this->db->where('id_tramite', $parametros['id_tramite']);
        return $this->db->update('sst_tramite_perfil', $data);
    }

    public function festivos_colombia(){
        $cadena_sql = "SELECT fecha FROM pr_festivos";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_proceso_usuario($id_usuario, $id_tramite){
        $cadena_sql = "SELECT * FROM sst_tramite WHERE id_usuario = ".$id_usuario." AND id_tramite != ".$id_tramite;
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function insertarCampoValidacion($param) {
        $this->db->trans_start();
        $this->db->insert('sst_campos_validacion', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function limpiarCampoValidacion($data){
        $this->db->trans_start();
        $this->db->where('id_tramite', $data['id_tramite']);
        $this->db->delete('sst_campos_validacion');
        $this->db->trans_complete();
    }

}
