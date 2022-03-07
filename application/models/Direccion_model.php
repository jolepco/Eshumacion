<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class direccion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }



    public function tramites_pendientes(){
        $cadena_sql = " SELECT id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, RT.fecha_editado, RT.fecha_reposicion, ET.descripcion descEstado, TI.Descripcion descTipoIden ,PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        WHERE estado IN (3,6,10,18) ORDER BY RT.fecha_tramite ASC";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_firmados(){
        $cadena_sql = " SELECT RT.id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden, RE.fecha fech_reso, RET.id_archivo, PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        JOIN validacion_titulos RE ON RE.id_titulo = RT.id_titulo AND RE.id_estado_tramite = RT.estado
        JOIN resoluciones_titulo RET ON RET.id_titulo = RT.id_titulo
        WHERE RT.estado IN (14)";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_devueltos(){
        $cadena_sql = " SELECT RT.id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden, RE.fecha fech_reso, RE.id_archivo, PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        JOIN validacion_titulos RE ON RE.id_titulo = RT.id_titulo AND RE.id_estado_tramite = RT.estado
        WHERE estado IN (15)";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_recurso(){
        $cadena_sql = " SELECT RT.id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden, RE.fecha fech_reso, RE.id_archivo, PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        JOIN validacion_titulos RE ON RE.id_titulo = RT.id_titulo AND RE.id_estado_tramite = RT.estado
        WHERE estado IN (11)";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_pendientes_id($id_titulo){
        $cadena_sql = " SELECT id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa as institucion_educativa2, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente, RT.pais_tituloequi,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden ,PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programa_equivalente PEQ ON PEQ.id_programaequi = RT.titulo_equivalente 
        WHERE id_titulo = ".$id_titulo;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function datos_tramite($id_titulo){
        $cadena_sql = " SELECT DISTINCT
                        RT.id_titulo,
                        RT.id_persona,
                        RT.fecha_tramite,
                        RT.tipo_titulo,
                        RT.institucion_educativa,
                        INS.nombre_institucion,
                        RT.profesion,
                        RT.fecha_term,
                        PU.nombre_programa,
						PU.aplica_rethus,
                        RT.tarjeta,
                        RT.diploma,
                        RT.acta,
                        RT.libro,
                        RT.folio,
                        RT.anio,
                        RT.cod_universidad,
                        RT.fecha_term_ext,
                        RT.resolucion,
                        RT.fecha_resolucion,
                        RT.entidad,
                        RT.titulo_equivalente,
                        RT.pdf_documento,
                        RT.pdf_titulo,
                        RT.pdf_acta,
                        RT.pdf_tarjeta,
                        RT.pdf_resolucion,
                        RT.estado,
                        ET.descripcion descEstado,
                        TI.Descripcion descTipoIden,
                        PE.*,
						PEQ.nombre_programa as nombreprogramaequivalente,
						PEQ.aplica_rethus as aplicarethusequivalente
                    FROM registro_titulo RT
                    JOIN persona PE ON PE.id_persona = RT.id_persona
                    JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
                    LEFT JOIN pr_institucion INS ON INS.id_institucion = RT.institucion_educativa
                    LEFT JOIN pr_programas_univ PU ON PU.id_programa = RT.profesion AND PU.id_institucion = RT.institucion_educativa
                    JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
					LEFT JOIN pr_programa_equivalente PEQ ON PEQ.id_programaequi = RT.titulo_equivalente
                    WHERE RT.id_titulo = ".$id_titulo."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function archivo_preliminar($id_titulo, $estado){
        $cadena_sql = " SELECT DISTINCT
						RE.id_validacion,
                        RE.id_archivo,
						RE.causales_negacion,
						RE.otras_causales_negacion,
                        AR.nombre
                    FROM validacion_titulos RE
                    JOIN archivos AR ON AR.id_archivo = RE.id_archivo 
                    WHERE RE.id_titulo = ".$id_titulo." ORDER BY 1 DESC";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function info_institucion($id_institucion){
        $cadena_sql = " SELECT DISTINCT id_institucion, nombre_institucion, sede FROM pr_institucion WHERE id_institucion = ".$id_institucion."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function info_programa($id_programa){
        $cadena_sql = " SELECT  id_programa, id_institucion, nombre_programa, sede FROM pr_programas_univ WHERE id_programa = ".$id_programa." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function estado_tramite_validador(){
        $cadena_sql = " SELECT  id_estado, descripcion FROM pr_estado_tramite WHERE id_estado IN (14, 15, 16) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
    public function causales_negacion(){
        $cadena_sql = " SELECT  id_causal, desc_causal FROM pr_causales_negacion ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consulta_causal($id_causal){
        $cadena_sql = " SELECT  id_causal, desc_causal FROM pr_causales_negacion WHERE id_causal = ".$id_causal;

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function consultar_archivo($id_archivo){
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
    }

    public function datos_validacion($id_titulo, $id_estado){
        $cadena_sql = " SELECT DISTINCT
						RE.id_validacion,
                        RE.id_archivo,
						RE.causales_negacion,
						RE.otras_causales_negacion,
						RE.argumentos_recurrente,
						RE.consideraciones,
						RE.consideraciones2,
						RE.articulos,
						RE.observacion1aclaracion,
						RE.observacion2aclaracion,
						RE.observacion3aclaracion,
						RE.nombresapellidos_errados,
						RE.nombre_profesionnerrado,
						RE.nombre_institucionerrado,
						RE.tipo_identificacionerrada,
						RE.fecha_termerrada,
                        AR.nombre
                    FROM validacion_titulos RE
                    JOIN archivos AR ON AR.id_archivo = RE.id_archivo 
                    WHERE RE.id_titulo = ".$id_titulo." 
                    AND RE.id_estado_tramite = ".$id_estado."  ORDER BY 1 DESC";						
        //echo $cadena_sql;
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function consulta_consecutivo($id_titulo){
        $cadena_sql = " SELECT
                            max(id_consecutivo) as max_cons
                        FROM
                            seguimiento_tramite
                        WHERE id_titulo = ".$id_titulo." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function actualizarEstado($datos) {

        $data = array(
            'estado' => $datos['estado']
        );
        $this->db->where('id_titulo', $datos['id_titulo']);
        return $this->db->update('registro_titulo', $data);
    }

    public function registro_validacion($param) {
        $this->db->trans_start();
        $this->db->insert('validacion_titulos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function registro_resolucion($param) {
        $this->db->trans_start();
        $this->db->insert('resoluciones_titulo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }


    public function insertarArchivo($param) {
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function actualizar_id_archivo($datos) {

        $data = array(
            'id_archivo' => $datos['id_archivo']
        );
        $this->db->where('id_resolucion', $datos['id_resolucion']);
        $this->db->where('anio', $datos['anio']);
        return $this->db->update('resoluciones_titulo', $data);
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('seguimiento_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

}
