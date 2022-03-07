<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Rx_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function departamentos_col(){
        $cadena_sql = " SELECT IdDepartamento, IdPais, CodigoDane, Descripcion FROM pr_departamento WHERE IdPais = 170  AND IdDepartamento = 3 Order by Descripcion ASC ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function equipos_radiacion(){
        $cadena_sql = " SELECT id_equipo, desc_equipo FROM pr_equipos_radiacion ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
	public function nivelAcademico(){
        $cadena_sql = " SELECT IdNivelEducativo, Nombre FROM pr_niveleducativo ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
	public function programasAcademicos(){
        $cadena_sql = " SELECT id_programa, id_institucion, nombre_programa FROM pr_programas_univ ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tipo_visualizacion(){
        $cadena_sql = " SELECT id_tipo_visualizacion, desc_tipo_visualizacion FROM pr_tipo_visualizacion ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result; 
    }
	
	public function crear_tramite($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}
	
	public function crear_tramite_flujo($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_tramite_flujo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}
	
	public function mis_tramites_rx(){
		
		$cadena_sql = "SELECT rt.id,rtt.descripcion,rt.estado, rt.created_at, prre.descripcion AS estadoDesc, rt.categoria, rf.fecha_estado, rf.observaciones, rt.fecha_subsanacion1, rt.fecha_subsanacion2, rt.solicita_prorroga, rt.fecha_envio_subsanacion1, rt.fecha_envio_subsanacion2, rf.id_archivo  
						FROM rayosx_tramite rt
						JOIN pr_rayosx_estado_tramite prre ON prre.id_estado = rt.estado 
						JOIN rayosx_tipo_tramite rtt ON rtt.id = rt.tipo_tramite
						JOIN rayosx_tramite_flujo rf ON rt.id = rf.tramite_id AND rf.id_estado = rt.estado 
						WHERE rt.user = ".$this->session->userdata('id_usuario')." ORDER BY rt.created_at DESC";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}
	
	public function tramite_info($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_tramite ";
		$cadena_sql .= " WHERE id = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
	
	
	public function actualizarModulo($datos) {

        $data = array(
            $datos['modulo'] => $datos['estado']
        );
        $this->db->where('id', $datos['id_tramite']);
        return $this->db->update('rayosx_tramite', $data);
    }
	
	public function eliminarEquipo($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('rayosx_equipos', $data);
    }
	
	public function actualizarArchivoEquipo($datos) {

        $data = array(
            $datos['documento'] => $datos['id_archivo']
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('rayosx_equipos', $data);
    }
	
	public function eliminarEquiposTodos($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('rayosx_equipos', $data);
    }
	
	public function eliminarTOE($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_toe_rayosx', $datos['id_toe_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']); 
        return $this->db->update('rayosx_toe', $data);
    }
	
	public function rayosxDireccion($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_direccion ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
	
	public function rayosxEquipo($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_equipos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}
	
	public function rayosxCategoria($id_tramite){
		
		$cadena_sql = " SELECT categoria ";
		$cadena_sql .= " FROM rayosx_tramite ";
		$cadena_sql .= " WHERE id = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;			
	}
	
	public function rayosxEquipos($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_equipos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}

	public function rayosxOficialToe($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_encargado ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}

	public function rayosxTemporalToe($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_toe ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}
	
	public function rayosxTalento($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_director ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}

	
	public function rayosxObjprueba($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_objprueba ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}

		
	public function rayosxDocumentos($id_tramite){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_documentos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}

		
	public function insertRayosxDireccion($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_direccion', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
		
	public function updateRayosxDireccion($datos) {

        $data = array(
            'depto_entidad' => $datos['depto_entidad'],
            'mpio_entidad' => $datos['mpio_entidad'],
            'dire_entidad' => $datos['dire_entidad'],
            'sede_entidad' => $datos['sede_entidad'],
            'email_entidad' => $datos['email_entidad'],
            'celular_entidad' => $datos['celular_entidad'],
            'telefono_entidad' => $datos['telefono_entidad'],
            'extension_entidad' => $datos['extension_entidad'],
            'updated_at' => $datos['updated_at']
        );
        $this->db->where('id_direccion_rayosx', $datos['id_direccion_tramite']);
        return $this->db->update('rayosx_direccion', $data);
    }
			
	
	public function insertRayosxCategoria($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_categoria', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
	
	public function insertRayosxEquipo($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_equipos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
		
	public function updateRayosxEquipo($datos){
	
		$data = array(
            'categoria1' => $datos['categoria1'],
            'categoria2' => $datos['categoria2'],
            'categoria1_1' => $datos['categoria1_1'],
            'categoria1_2' => $datos['categoria1_2'],
            'categoria2_1' => $datos['categoria2_1'],
            'otro_equipo' => $datos['otro_equipo'],
            'tipo_visualizacion' => $datos['tipo_visualizacion'],
            'marca_equipo' => $datos['marca_equipo'],
            'modelo_equipo' => $datos['modelo_equipo'],
            'serie_equipo' => $datos['serie_equipo'],
            'marca_tubo_rx' => $datos['marca_tubo_rx'],
            'modelo_tubo_rx' => $datos['modelo_tubo_rx'],
            'serie_tubo_rx' => $datos['serie_tubo_rx'],
            'tension_tubo_rx' => $datos['tension_tubo_rx'],
            'contiene_tubo_rx' => $datos['contiene_tubo_rx'],
            'energia_fotones' => $datos['energia_fotones'],
            'energia_electrones' => $datos['energia_electrones'],
            'carga_trabajo' => $datos['carga_trabajo'],
            'ubicacion_equipo' => $datos['ubicacion_equipo'],
            'anio_fabricacion' => $datos['anio_fabricacion'],
            'numero_permiso' => $datos['numero_permiso'],
            'marca_tubo_rx2' => $datos['marca_tubo_rx2'],
            'modelo_tubo_rx2' => $datos['modelo_tubo_rx2'],
            'serie_tubo_rx2' => $datos['serie_tubo_rx2'],
            'tension_tubo_rx2' => $datos['tension_tubo_rx2'],
            'contiene_tubo_rx2' => $datos['contiene_tubo_rx2'],
            'energia_fotones2' => $datos['energia_fotones2'],
            'energia_electrones2' => $datos['energia_electrones2'],
            'carga_trabajo2' => $datos['carga_trabajo2'],
            'anio_fabricacion_tubo2' => $datos['anio_fabricacion_tubo2'],
            'estado' => $datos['estado'],
            'updated_at' => $datos['updated_at']
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('rayosx_equipos', $data);
		
	}		
		
	public function updateRayosxCategoria($datos) {

        $data = array(
            'categoria' => $datos['categoria'],
            'categoria1' => $datos['categoria1'],
            'categoria1_1' => $datos['categoria1_1'],
            'categoria1_2' => $datos['categoria1_2'],
            'categoria2' => $datos['tipo_visualizacion'],
            'estado' => $datos['estado'],
            'updated_at' => $datos['updated_at']
        );
        $this->db->where('id_categoria_rayosx', $datos['id_categoria_rayosx']);
        return $this->db->update('rayosx_categoria', $data);
    }
	
	
	public function insertRayosxEncargado($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_encargado', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
		
	public function updateRayosxEncargado($datos) {

        $data = array(
            'encargado_pnombre' => $datos['encargado_pnombre'],
            'encargado_snombre' => $datos['encargado_snombre'],
            'encargado_papellido' => $datos['encargado_papellido'],
            'encargado_sapellido' => $datos['encargado_sapellido'],
            'encargado_tdocumento' => $datos['encargado_tdocumento'],
            'encargado_ndocumento' => $datos['encargado_ndocumento'],
            'encargado_lexpedicion' => $datos['encargado_lexpedicion'],
            'encargado_correo' => $datos['encargado_correo'],
            'encargado_nivel' => $datos['encargado_nivel'],
            'encargado_profesion' => $datos['encargado_profesion']
        );
        $this->db->where('id_encargado_rayosx', $datos['id_encargado_rayosx']);
        return $this->db->update('rayosx_encargado', $data);
    }
	
	public function insertRayosxTemporalToe($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_toe', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}
	
		
	public function updateRayosxTemporalToe($datos) {

        $data = array(
            'encargado_pnombre' => $datos['encargado_pnombre'],
            'encargado_snombre' => $datos['encargado_snombre'],
            'encargado_papellido' => $datos['encargado_papellido'],
            'encargado_sapellido' => $datos['encargado_sapellido'],
            'encargado_tdocumento' => $datos['encargado_tdocumento'],
            'encargado_ndocumento' => $datos['encargado_ndocumento'],
            'encargado_lexpedicion' => $datos['encargado_lexpedicion'],
            'encargado_correo' => $datos['encargado_correo'],
            'encargado_nivel' => $datos['encargado_nivel'],
            'encargado_profesion' => $datos['encargado_profesion']
        );
        $this->db->where('id_encargado_rayosx', $datos['id_encargado_rayosx']);
        return $this->db->update('rayosx_encargado', $data);
    }

	public function insertRayosxDirector($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_director', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
		
	public function updateRayosxDirector($datos) {

        $data = array(
            'talento_pnombre' => $datos['talento_pnombre'],
            'talento_snombre' => $datos['talento_snombre'],
            'talento_papellido' => $datos['talento_papellido'],
            'talento_sapellido' => $datos['talento_sapellido'],
            'talento_tdocumento' => $datos['talento_tdocumento'],
            'talento_ndocumento' => $datos['talento_ndocumento'],
            'talento_lexpedicion' => $datos['talento_lexpedicion'],
            'talento_correo' => $datos['talento_correo'],
            'talento_titulo' => $datos['talento_titulo'],
            'talento_universidad' => $datos['talento_universidad'],
            'talento_libro' => $datos['talento_libro'],
            'talento_registro' => $datos['talento_registro'],
            'talento_fecha_diploma' => $datos['talento_fecha_diploma'],
            'talento_resolucion' => $datos['talento_resolucion'],
            'talento_fecha_convalida' => $datos['talento_fecha_convalida'],
            'talento_nivel' => $datos['talento_nivel'],
            'talento_titulo_pos' => $datos['talento_titulo_pos'],
            'talento_universidad_pos' => $datos['talento_universidad_pos'],
            'talento_libro_pos' => $datos['talento_libro_pos'],
            'talento_registro_pos' => $datos['talento_registro_pos'],
            'talento_fecha_diploma_pos' => $datos['talento_fecha_diploma_pos'],
            'talento_resolucion_pos' => $datos['talento_resolucion_pos'],
            'talento_fecha_convalida_pos' => $datos['talento_fecha_convalida_pos'],
            'updated_at' => $datos['updated_at']
        );
        $this->db->where('id_director_rayosx', $datos['id_director_rayosx']);
        return $this->db->update('rayosx_director', $data);
    }	
	
	
	public function updateVisita($datos) {

        $data = array(
            'visita_previa' => $datos['visita_previa']
        );
        $this->db->where('id', $datos['id']);
        return $this->db->update('rayosx_tramite', $data);
    }

	public function insertRayosxObjeto($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_objprueba', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
    
	public function inactivarDocumentoPrevios($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        $this->db->where('documento', $datos['documento']);
        return $this->db->update('rayosx_documentos', $data);
    }
	
	public function insertDocumento($param){
		
		$this->db->trans_start();
        $this->db->insert('rayosx_documentos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
		
	}	
    
    public function estado_tramite_validador_rx($perfil){
        $cadena_sql = " SELECT  id_estado, descripcion FROM pr_rayosx_estado_tramite ";
		
		if($perfil == 8){
			$cadena_sql .= "WHERE id_estado IN (3,15,24)";
		}else if($perfil == 9){
			$cadena_sql .= "WHERE id_estado IN (4,16,25)";
		}else if($perfil == 3){
			$cadena_sql .= "WHERE id_estado IN (5,6,7,8,17,18,19,20,21,26,27,28)";
		}else if($perfil == 10){
			$cadena_sql .= "WHERE id_estado IN (9,33,39,11,29,30,31,32)";
		}else if($perfil == 5){
			$cadena_sql .= "WHERE id_estado IN (10,12,13,22,33,34,35,36,37,38,40,41)";
		}else if($perfil == 11){
			$cadena_sql .= "WHERE id_estado IN (11,29,30,31,32)";
		}
		 
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
    
    public function tramite_info_validacion($id_tramite){
		
		$cadena_sql = " SELECT rt.*, rxe.*, pe.*, TI.idTipoIdentificacion, TI.Codigo, TI.Descripcion as descTipoIden ";
		$cadena_sql .= " FROM rayosx_tramite rt ";
		$cadena_sql .= " JOIN pr_rayosx_estado_tramite rxe ON rxe.id_estado = rt.estado ";
		$cadena_sql .= " JOIN usuarios US ON US.id = rt.user ";		
		$cadena_sql .= " JOIN persona pe ON pe.id_persona = US.id_persona ";
		$cadena_sql .= " JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = pe.tipo_identificacion ";
		$cadena_sql .= " WHERE rt.id = ".$id_tramite;
        
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
    
    public function rayosxDocumentosValidacion($id_tramite){
		
		$cadena_sql = " SELECT rxd.*, ar.* ";
		$cadena_sql .= " FROM rayosx_documentos rxd ";
		$cadena_sql .= " JOIN archivos ar ON ar.id_archivo = rxd.id_archivo ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}
    
    public function consultar_archivo($id_tramite, $doc){
		
		$cadena_sql = " SELECT rxd.*, ar.* ";
		$cadena_sql .= " FROM rayosx_documentos rxd ";
		$cadena_sql .= " JOIN archivos ar ON ar.id_archivo = rxd.id_archivo ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND documento = '".$doc."'";
		$cadena_sql .= " AND rxd.estado = 1";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
    
    public function actualizarEstado($datos) {

        $data = array(
            'estado' => $datos['estado'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $datos['id_tramite']);
        return $this->db->update('rayosx_tramite', $data);
    }
    
    public function consulta_consecutivo($id_tramite){
        $cadena_sql = " SELECT
                            max(id_consecutivo) max_cons
                        FROM
                            rayosx_seguimiento_tramite
                        WHERE id_tramite = ".$id_tramite." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
    
    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('rayosx_seguimiento_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function actualizarDatosPersona($datos) {

        $data = array(
            'tipo_identificacion' => $datos['tipo_identificacion'],
            //'nume_identificacion' => $datos['nume_documento'],
            'p_nombre' => $datos['p_nombre'],
            's_nombre' => $datos['s_nombre'],
            'p_apellido' => $datos['p_apellido'],
            's_apellido' => $datos['s_apellido'],
            'email' => $datos['email'],
            'telefono_fijo' => $datos['telefono_fijo'],			
			'fecha_nacimiento' => $datos['fecha_nacimiento'],
			'sexo' => $datos['sexo'],
			'genero' => $datos['genero'],
			'orientacion' => $datos['orientacion'],
			'etnia' => $datos['etnia'],
			'estado_civil' => $datos['estado_civil'],
			'nivel_educativo' => $datos['nivel_educativo'],
            'telefono_celular' => $datos['telefono_celular'],			
            'tipo_iden_rl' => $datos['tipo_iden_rl'],			
            'nume_iden_rl' => $datos['nume_iden_rl'],			
            'nombre_rs' => $datos['nombre_rs']			
        );
        $this->db->where('id_persona', $datos['id_persona']);
        return $this->db->update('persona', $data);
    }

	public function consultar_archivo_equipo($id_archivo){
		
		$cadena_sql = " SELECT ar.* ";
		$cadena_sql .= " FROM archivos ar ";
		$cadena_sql .= " WHERE ar.id_archivo = ".$id_archivo;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}
	
	public function itemsInfraestructura($id_resolucion){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM pr_rayosx_items_infra ";
		$cadena_sql .= " WHERE id_resolucion = ".$id_resolucion;
	
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;		
	}  
	
	public function consulta_obs_infra($datos){
		
		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM rayosx_equipo_infra ";
		$cadena_sql .= " WHERE id_equipo = ".$datos['id_equipo'];
		$cadena_sql .= " AND id_tramite = ".$datos['id_tramite'];
		$cadena_sql .= " AND id_item = ".$datos['id_item'];
		$cadena_sql .= " AND id_estado = ".$datos['id_estado'];
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;		
	}    
	
	public function crear_obs_infra($param) {
        $this->db->trans_start();
        $this->db->insert('rayosx_equipo_infra', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
	
	public function registrarObservacionValidacion($param) {
        $this->db->trans_start();
        $this->db->insert('rayosx_validacion', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    } 
	
	public function actualiza_obs_infra($datos) { 

        $data = array(
            'observaciones' => $datos['observaciones'],
            'id_usuario' => $datos['id_usuario'],
            'fecha_observacion' => $datos['fecha_observacion']		
        );
        $this->db->where('id_equipo', $datos['id_equipo']);
        $this->db->where('id_tramite', $datos['id_tramite']);
        $this->db->where('id_item', $datos['id_item']);
        $this->db->where('id_estado', $datos['id_estado']);
        return $this->db->update('rayosx_equipo_infra', $data);
    }
	    
	
	    
	public function rayosx_pendientes_coordinador($perfil){

        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
						FROM rayosx_tramite RX
						JOIN usuarios US ON US.id = RX.user
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
						JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado 
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
		if($perfil == 10){
			$cadena_sql .= " WHERE RX.estado IN (5,17,26,6,18,20,27,28)"; 	
		}else if($perfil == 11){
			$cadena_sql .= " WHERE RX.estado IN (6,18,20,27,28)";	
		}else if($perfil == 5){
			$cadena_sql .= " WHERE RX.estado IN (11)";	
		}
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }	
	   
	public function rayosx_pendientes_director($perfil){

        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
						FROM rayosx_tramite RX
						JOIN usuarios US ON US.id = RX.user
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
						JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado 
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
		if($perfil == 5){
			$cadena_sql .= " WHERE RX.estado IN (9,11,7,21,29,30,31,32,33,39,19)";	
		}
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }	 
	
	public function consultar_estado_tramite($id_tramite, $estado){

        $cadena_sql = "SELECT * FROM rayosx_tramite_flujo ";		
		$cadena_sql .= " WHERE tramite_id = ".$id_tramite;	
		$cadena_sql .= " AND id_estado = ".$estado;	
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }	
	
	public function observaciones_validacion($id_tramite, $estado){

        $cadena_sql = "SELECT *
						FROM rayosx_validacion 
						WHERE id_tramite = ".$id_tramite." AND estado = ".$estado."";
		
		$query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }	
	
	
    public function registro_resolucion_rx($param) {
        $this->db->trans_start();
        $this->db->insert('rayosx_resoluciones', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
	
	public function actualizar_resolucion_rx($datos) {

        $data = array(
            'id_archivo' => $datos['id_archivo']	
        );
        $this->db->where('id_resolucion', $datos['id_resolucion']);
        $this->db->where('anio', $datos['anio']);
        $this->db->where('id_tramite', $datos['id_tramite']);
        $this->db->where('estado', $datos['estado']);
        return $this->db->update('rayosx_resoluciones', $data);
    }


	public function seguimiento_tramite($id_tramite){
		
		$cadena_sql = "SELECT DISTINCT RX.id, RX.user, RX.estado, RX.created_at, RX.fecha_envio, RF.id_usuario, RF.id_estado, PERX.descripcion AS descEstado, RF.fecha_estado, RF.observaciones, USU.username, ar.ruta, ar.nombre
						FROM rayosx_tramite RX
						JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id 
						JOIN pr_rayosx_estado_tramite PERX ON PERX.id_estado = RF.id_estado 
						JOIN usuarios USU ON USU.id = RF.id_usuario 
						LEFT JOIN archivos ar ON ar.id_archivo = RF.id_archivo
						WHERE RX.id = ".$id_tramite;
						
		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;	
		
	}
	
	public function reporte_rayosx($fechai, $fechaf){
	
	$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_subsanacion1, RX.fecha_subsanacion2, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
						FROM rayosx_tramite RX
						JOIN usuarios US ON US.id = RX.user
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
						JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado 
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
        if ($fechai != "" && $fechaf != "")
        	$cadena_sql .= " WHERE RX.created_at BETWEEN '$fechai' AND '$fechaf 23:59' AND RX.estado > 1";
        else{
                $cadena_sql .= " WHERE RX.created_at BETWEEN '$fec2' AND '$fecha2 23:59' AND RX.estado > 1";
	}		

		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consultar_flujo_estado($id_tramite, $id_estado){
        $cadena_sql = "SELECT id_usuario, id_estado, fecha_estado, observaciones 
                        FROM rayosx_tramite_flujo 
                        WHERE tramite_id = ".$id_tramite." AND id_estado = ".$id_estado;
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function festivos_colombia(){
        $cadena_sql = "SELECT fecha FROM pr_festivos";
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function max_estado_infra($id_tramite){
        $cadena_sql = "SELECT max(id_estado) AS max_estado FROM rayosx_equipo_infra WHERE id_tramite = ".$id_tramite;
		
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
}
