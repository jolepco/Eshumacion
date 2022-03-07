<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class xindustrial_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertarArchivo($param) {
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function consultar_archivo_pdf($id_archivo){
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
        $this->db->insert('xindustrial_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;

	}

	public function crear_tramite_flujo($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_tramite_flujo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;

	}

	public function mis_tramites_rx(){

		$cadena_sql = "SELECT rt.id,rtt.descripcion,rt.estado, rt.created_at, prre.descripcion AS estadoDesc, rt.categoria, rf.fecha_estado, rf.observaciones, rt.fecha_subsanacion2, rf.id_archivo
						FROM xindustrial_tramite rt
						JOIN xindustrial_estado_tramite prre ON prre.id_estado = rt.estado
						JOIN xindustrial_tipo_tramite rtt ON rtt.id = rt.tipo_tramite
						JOIN xindustrial_tramite_flujo rf ON rt.id = rf.tramite_id AND rf.id_estado = rt.estado
						WHERE rt.user = ".$this->session->userdata('id_usuario')." GROUP BY (rt.id) ORDER BY rt.created_at DESC";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}

	public function tramite_info($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_tramite";
		$cadena_sql .= " WHERE id = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

	public function tramite_info_user($id_tramite){

		$cadena_sql = "SELECT PE.* ";
		$cadena_sql .= " FROM xindustrial_tramite rt";
		$cadena_sql .= " JOIN usuarios US ON US.id = rt.user ";
		$cadena_sql .= " JOIN persona pe ON pe.id_persona = US.id_persona ";
		$cadena_sql .= " WHERE rt.id = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

	public function actualizarModulo($datos) {

        $data = array(
            $datos['modulo'] => $datos['estado']
        );
        $this->db->where('id', $datos['id_tramite']);
        return $this->db->update('xindustrial_tramite', $data);
    }

    public function actualizarActa($datos) {

          $data = array(
              'archivo_visita'=> $datos['archivo_visita'],
              'fecha_visita'=> $datos['fecha_visita'],
              'id_usuario' => $datos['id_usuario'],
              'estado'=> $datos['estado']
          );
          $this->db->where('id', $datos['id_tramite']);
          return $this->db->update('xindustrial_validacion', $data);
      }

    public function actualizarEstado2($datos) {

          $data = array(
              'estado'=> $datos['estado']
          );
          $this->db->where('id', $datos['id_tramite']);
          return $this->db->update('xindustrial_tramite', $data);
      }
	public function eliminarEquipo($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_equipos', $data);
    }

	public function actualizarArchivoEquipo($datos) {

        $data = array(
            $datos['documento'] => $datos['id_archivo']
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_equipos', $data);
    }

	public function eliminarEquiposTodos($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_equipos', $data);
    }

	public function eliminarTOE($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_toe_rayosx', $datos['id_toe_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_toe', $data);
    }

	public function eliminarObj($datos) {

        $data = array(
            'estado' => 0
        );
        $this->db->where('id_obj_rayosx', $datos['id_obj_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_objprueba', $data);
    }


	public function rayosxDireccion($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_direccion ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

	public function rayosxEquipo($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_equipos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}

	public function rayosxCategoria($id_tramite){

		$cadena_sql = " SELECT categoria ";
		$cadena_sql .= " FROM xindustrial_tramite ";
		$cadena_sql .= " WHERE id = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

	public function rayosxEquipos($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_equipos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}

	public function rayosxOficialToe($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_encargado ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);

        if($query->num_rows() >= 0)
        {
            return $query->row();
        }else{
            return NULL;
        }
	}

	public function rayosxTemporalToe($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_toe ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1 ";

        $query = $this->db->query($cadena_sql);

        if($query->num_rows() >= 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
	}

	public function rayosxTalento($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_director ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}


	public function rayosxObjprueba($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_objprueba ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;
		$cadena_sql .= " AND estado = 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}


	public function rayosxDocumentos($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_documentos ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}


	public function insertRayosxDireccion($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_direccion', $param);
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
        return $this->db->update('xindustrial_direccion', $data);
    }


	public function insertRayosxCategoria($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_categoria', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;

	}

	public function insertRayosxEquipo($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_equipos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;

	}

	public function updateRayosxEquipo($datos){

		$data = array(
            'categoria1' => $datos['categoria1'],
            'categoria2' => $datos['categoria2'],
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
            'estado' => $datos['estado'],
            'updated_at' => $datos['updated_at']
        );
        $this->db->where('id_equipo_rayosx', $datos['id_equipo_rayosx']);
        $this->db->where('id_tramite_rayosx', $datos['id_tramite_rayosx']);
        return $this->db->update('xindustrial_equipos', $data);

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
        return $this->db->update('xindustrial_categoria', $data);
    }


	public function insertRayosxEncargado($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_encargado', $param);
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
        return $this->db->update('xindustrial_encargado', $data);
    }

	public function insertRayosxTemporalToe($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_toe', $param);
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
        return $this->db->update('xindustrial_encargado', $data);
    }

	public function insertRayosxDirector($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_director', $param);
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
        return $this->db->update('xindustrial_director', $data);
    }


	public function updateVisita($datos) {

        $data = array(
            'visita_previa' => $datos['visita_previa']
        );
        $this->db->where('id', $datos['id']);
        return $this->db->update('xindustrial_tramite', $data);
    }

	public function insertRayosxObjeto($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_objprueba', $param);
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
        return $this->db->update('xindustrial_documentos', $data);
    }

	public function insertDocumento($param){

		$this->db->trans_start();
        $this->db->insert('xindustrial_documentos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;

	}

    public function estado_tramite_validador_rx($perfil){
        $cadena_sql = " SELECT  id_estado, descripcion FROM xindustrial_estado_tramite ";

	  if($perfil == 3){
			$cadena_sql .= "WHERE id_estado IN (5,6,7,8,19,21)";
		}else if($perfil == 4){
      $cadena_sql .= "WHERE id_estado IN (9,11,15,16,8,21,22,23)";
    }


        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramite_info_validacion($id_tramite){

		$cadena_sql = " SELECT rt.*,tt.descripcion as ttdescripcion, rxe.*, pe.*, TI.idTipoIdentificacion, TI.Codigo, TI.Descripcion as descTipoIden ";
		$cadena_sql .= " FROM xindustrial_tramite rt ";
    $cadena_sql .= " JOIN xindustrial_tipo_tramite tt ON rt.tipo_tramite = tt.id ";
		$cadena_sql .= " JOIN xindustrial_estado_tramite rxe ON rxe.id_estado = rt.estado ";
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
		$cadena_sql .= " FROM xindustrial_documentos rxd ";
		$cadena_sql .= " JOIN archivos ar ON ar.id_archivo = rxd.id_archivo ";
		$cadena_sql .= " WHERE id_tramite_rayosx = ".$id_tramite;

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
	}

    public function consultar_archivo($id_tramite, $doc){

		$cadena_sql = " SELECT rxd.*, ar.* ";
		$cadena_sql .= " FROM xindustrial_documentos rxd ";
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
        return $this->db->update('xindustrial_tramite', $data);
    }

    public function consulta_consecutivo(){
        $cadena_sql = " SELECT
                            max(id_resolucion) max_cons
                        FROM
                            xindustrial_resoluciones";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('xindustrial_seguimiento_tramite', $param);
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

  public function consultar_archivo_visita($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_tramite_flujo rtf JOIN archivos ar ON rtf.id_archivo = ar.id_archivo";
		$cadena_sql .= " WHERE rtf.id_estado= 41 AND rtf.tramite_id = ".$tramite_id;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consultar_archivo_avisita($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_validacion rtv JOIN archivos ar ON rtv.archivo_visita = ar.id_archivo";
		$cadena_sql .= " WHERE rtv.id_tramite = ".$tramite_id;
    $cadena_sql .= " AND rtv.estado IN (22) ORDER BY 1 DESC LIMIT 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consultar_archivo_avisita2($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_validacion rtv JOIN archivos ar ON rtv.archivo_visita = ar.id_archivo";
		$cadena_sql .= " WHERE rtv.id_tramite = ".$tramite_id;
    $cadena_sql .= " AND rtv.estado IN (23) ORDER BY 1 DESC LIMIT 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consultar_archivo_negacion($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_tramite_flujo rtf JOIN archivos ar ON rtf.id_archivo = ar.id_archivo";
		$cadena_sql .= " WHERE rtf.id_estado= 12 AND rtf.tramite_id = ".$tramite_id;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consultar_archivo_subsanacion($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_tramite_flujo rtf JOIN archivos ar ON rtf.id_archivo = ar.id_archivo";
		$cadena_sql .= " WHERE rtf.id_estado= 13 AND rtf.tramite_id = ".$tramite_id;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}
  public function consultar_archivo_aprobacion($tramite_id){

		$cadena_sql = " SELECT ar.nombre";
		$cadena_sql .= " FROM xindustrial_tramite_flujo rtf JOIN archivos ar ON rtf.id_archivo = ar.id_archivo";
		$cadena_sql .= " WHERE rtf.id_estado= 10 AND rtf.tramite_id = ".$tramite_id;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

	public function itemsInfraestructura($id_resolucion){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_items_infra ";
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
        $this->db->insert('xindustrial_equipo_infra', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

	public function registrarObservacionValidacion($param) {
        $this->db->trans_start();
        $this->db->insert('xindustrial_validacion', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

	public function consulta_obstramite($id_tramite){

		$cadena_sql = " SELECT * ";
		$cadena_sql .= " FROM xindustrial_validacion ";
		$cadena_sql .= " WHERE id_tramite = ".$id_tramite;
    $cadena_sql .= " ORDER BY 1 DESC";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consulta_visita1($id_tramite){

    		$cadena_sql = " SELECT * ";
    		$cadena_sql .= " FROM xindustrial_validacion ";
    		$cadena_sql .= " WHERE id_tramite = ".$id_tramite;
        $cadena_sql .= " AND estado IN (22) ORDER BY 1 DESC LIMIT 1";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
	}

  public function consulta_visita2($id_tramite){

    		$cadena_sql = " SELECT * ";
    		$cadena_sql .= " FROM xindustrial_validacion ";
    		$cadena_sql .= " WHERE id_tramite = ".$id_tramite;
        $cadena_sql .= " AND estado IN (23) ORDER BY 1 DESC LIMIT 1";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
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
        return $this->db->update('xindustrial_equipo_infra', $data);
    }



	public function rayosx_pendientes_coordinador($perfil){

        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
						FROM xindustrial_tramite RX
						JOIN usuarios US ON US.id = RX.user
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN xindustrial_estado_tramite ET ON ET.id_estado = RX.estado
						JOIN xindustrial_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";

		if($perfil == 4){
			$cadena_sql .= " WHERE RX.estado IN (5,6,7,19,18,21,22,23) GROUP BY (RX.id)";
		}

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

	public function rayosx_pendientes_director($perfil){

        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
                        FROM xindustrial_tramite RX
                        JOIN usuarios US ON US.id = RX.user
                        JOIN persona PE ON PE.id_persona = US.id_persona
                        JOIN xindustrial_estado_tramite ET ON ET.id_estado = RX.estado
                        JOIN xindustrial_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado
                        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";

		if($perfil == 5){
			$cadena_sql .= " WHERE RX.estado IN (9,11,15,16) GROUP BY (RX.id)";
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
        $this->db->insert('xindustrial_resoluciones', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

	public function actualizar_resolucion_rx($datos) {

        $data = array(
            'id_archivo' => $datos['id_archivo'],
			'codi_tramite' => $datos['codi_tramite']
        );
        $this->db->where('id_resolucion', $datos['id_resolucion']);
        $this->db->where('anio', $datos['anio']);
        $this->db->where('id_tramite', $datos['id_tramite']);
        $this->db->where('estado', $datos['estado']);
        return $this->db->update('xindustrial_resoluciones', $data);
    }


	public function seguimiento_tramite($id_tramite){

		$cadena_sql = "SELECT DISTINCT RX.id, RX.user, RX.estado, RX.created_at, RX.fecha_envio, RF.id_usuario, RF.id_estado, PERX.descripcion AS descEstado, RF.fecha_estado, RF.observaciones, USU.username
						FROM xindustrial_tramite RX
						JOIN xindustrial_tramite_flujo RF ON RX.id = RF.tramite_id
						JOIN xindustrial_estado_tramite PERX ON PERX.id_estado = RF.id_estado
						JOIN usuarios USU ON USU.id = RF.id_usuario
						WHERE RX.id = ".$id_tramite;

		$query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;

	}

	public function reporte_rayosx(){

        $cadena_sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_subsanacion1, RX.fecha_subsanacion2, RX.fecha_envio, RF.fecha_estado, RF.observaciones, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
						FROM rayosx_tramite RX
						JOIN usuarios US ON US.id = RX.user
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
						JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado
						JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";


		$cadena_sql .= " WHERE RX.estado > 1";

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

    public function tipo_identificacion(){
        $cadena_sql = " SELECT IdTipoIdentificacion, Codigo, Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion IN(1,2,3,6) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function municipios_col($dpto){
        $cadena_sql = " SELECT IdMunicipio, IdDepartamento, CodigoDane, Descripcion FROM pr_municipio WHERE IdDepartamento = ".$dpto." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tipo_identificacion_todos(){
        $cadena_sql = " SELECT IdTipoIdentificacion, Codigo, Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion IN(1,2,3,6,5) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function info_usuariotramite($id_persona) {
          $sql = " SELECT * ";
          $sql.= " FROM usuarios  ";
          $sql.= " WHERE username = '".$id_persona."'";
          $query = $this->db->query($sql);
          return $query->row();
      }

    function listarSolicitudesLRX($fechai, $fechaf) {
            $fec1 = date("Y-m-d");
            $fec = strtotime('-1 month', strtotime($fec1));
            $fec2 = date('Y-m-d', $fec);
            $fecha = strtotime('+1 day', strtotime($fec1));
            $fecha2 = date('Y-m-d', $fecha);
            $sql = "SELECT ";
            $sql.=" p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido,p.s_apellido,";
        		$sql .= "CASE
        					WHEN P.genero = 1 THEN 'Masculino'
        					WHEN P.genero = 2 THEN 'Femenino'
        					WHEN P.genero = 3 THEN 'Transgenero'
        					WHEN P.genero = 4 THEN 'No responde'
        					ELSE '-'
        				END as genero,
        				CASE
        					WHEN P.orientacion = 1 THEN 'Heterosexual'
        					WHEN P.orientacion = 2 THEN 'Homosexual'
        					WHEN P.orientacion = 3 THEN 'Bisexual'
        					ELSE '-'
        				END as orientacion,
        				CASE
        					WHEN P.etnia = 1 THEN 'Indigena'
        					WHEN P.etnia = 2 THEN 'Rom-Gitano'
        					WHEN P.etnia = 3 THEN 'Raizal'
        					WHEN P.etnia = 4 THEN 'Palenquero'
        					WHEN P.etnia = 5 THEN 'Afrocolombiano'
        					WHEN P.etnia = 6 THEN 'Ninguna'
        					ELSE '-'
        				END as etnia,
        				CASE
        					WHEN P.estado_civil = 1 THEN 'Soltero'
        					WHEN P.estado_civil = 2 THEN 'Casado'
        					WHEN P.estado_civil = 3 THEN 'Union marital de hecho'
        					WHEN P.estado_civil = 4 THEN 'Divorciado'
        					WHEN P.estado_civil = 5 THEN 'Viudo'
        					ELSE '-'
        				END as estado_civil,
        				CASE
        					WHEN P.nivel_educativo = 1 THEN 'Primaria'
        					WHEN P.nivel_educativo = 2 THEN 'Secundaria'
        					WHEN P.nivel_educativo = 3 THEN 'Técnico'
        					WHEN P.nivel_educativo = 4 THEN 'Tecnólogo'
        					WHEN P.nivel_educativo = 5 THEN 'Profesional'
        					WHEN P.nivel_educativo = 6 THEN 'Especialista'
        					WHEN P.nivel_educativo = 7 THEN 'Maestria'
        					WHEN P.nivel_educativo = 8 THEN 'Doctorado'
        					WHEN P.nivel_educativo = 9 THEN 'Post-Doctorado'
        					WHEN P.nivel_educativo = 10 THEN 'Ninguno'
        					ELSE '-'
        				END as nivel_educativo,
                CASE
                  WHEN rt.tipo_tramite = 1 THEN 'PRIMERA VEZ'
                  WHEN rt.tipo_tramite = 2 THEN 'MODIFICACIÓN RX'
                  WHEN rt.tipo_tramite = 3 THEN 'RENOVACIÓN RX'
                  ELSE '-'
                END as tipo_tramite,
                P.fecha_nacimiento,rt.id, rt.categoria, rt.created_at, rt.archivo_visita, rtf.fecha_estado, rtf.id_estado as estado, rts.descripcion,res.id_resolucion, res.codigo_verificacion, u.username";
                $sql .= " FROM xindustrial_tramite rt ";
                $sql .= " JOIN usuarios as u on u.id=rt.user ";
                $sql .= " JOIN persona as p ON p.id_persona=u.id_persona";
                $sql .= " JOIN xindustrial_tramite_flujo rtf ON rt.id=rtf.tramite_id";
                $sql .= " LEFT JOIN xindustrial_resoluciones res ON rt.id=res.id_tramite";
                $sql .= " LEFT JOIN xindustrial_equipos rte ON rte.id_tramite_rayosx=rt.id";
                $sql .= " LEFT JOIN xindustrial_estado_tramite rts ON rtf.id_estado=rts.id_estado";
                       if ($fechai != "" && $fechaf != "")
                    $sql .= " WHERE rt.created_at BETWEEN '$fechai' AND '$fechaf 23:59' ";
                else
                    $sql .= " WHERE rt.created_at BETWEEN '$fec2' AND '$fecha2 23:59' ";
                $sql .= "ORDER BY rt.created_at, rtf.fecha_estado"; //echo $sql;exit;
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function tramites_pornumdocRX($numdoc){
    		$cadena_sql = "SELECT p.tipo_identificacion, td.Descripcion, p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.descripcion,rt.id,rt.created_at,rt.tipo_tramite,rt.categoria
    		FROM persona as p
        JOIN usuarios as u on u.id_persona=p.id_persona
    		JOIN xindustrial_tramite as rt ON u.id=rt.user
    		JOIN pr_tipoidentificacion as td ON p.tipo_identificacion=td.IdTipoIdentificacion
    		LEFT JOIN xindustrial_estado_tramite as e ON rt.estado = e.id_estado";
            //$cadena_sql = " SELECT *
            //FROM todos_los_tramites
            //";

            if($numdoc !=""){
              $cadena_sql.=" WHERE p.nume_identificacion =".$numdoc."";
            }
            else {
              $cadena_sql.=" WHERE p.nume_identificacion ='0'";
            }
    		//SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.idlicencia_exhumacion,l.fecha_solicitud,l.parentesco FROM persona as p JOIN licencia_exhuma as l ON p.id_persona=l.id_persona LEFT JOIN estado_tramite_licenciaexh as e ON l.estado = e.id_estado WHERE p.nume_identificacion='60123123'
            //var_dump($cadena_sql);
    		//exit;
            $query = $this->db->query($cadena_sql);
            $result = $query->result();
            return $result;
        }

}
