<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class usuarios_model extends CI_Model {

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

    public function actualizarTitulo($datos) {

        $data = array(
            'institucion_educativa' => $datos['institucion_educativa'],
            'profesion' => $datos['profesion'],
            'tarjeta' => $datos['tarjeta'],
            'diploma' => $datos['diploma'],
            'acta' => $datos['acta'],
            'libro' => $datos['libro'],
            'folio' => $datos['folio'],
            'anio' => $datos['anio'],
            'cod_universidad' => $datos['cod_universidad'],
            'resolucion' => $datos['resolucion'],
            'fecha_resolucion' => $datos['fecha_resolucion'],
            'entidad' => $datos['entidad'],
            'titulo_equivalente' => $datos['titulo_equivalente'],
			'pais_tituloequi' => $datos['pais_tituloequi'],
            'estado' => $datos['estado']
        );

        if($datos['pdf_documento'] != 0){
            $data['pdf_documento'] = $datos['pdf_documento'];
        }

        if($datos['pdf_titulo'] != 0){
            $data['pdf_titulo'] = $datos['pdf_titulo'];
        }

        if($datos['pdf_acta'] != 0){
            $data['pdf_acta'] = $datos['pdf_acta'];
        }

        if($datos['pdf_tarjeta'] != 0){
            $data['pdf_tarjeta'] = $datos['pdf_tarjeta'];
        }

        if($datos['pdf_resolucion'] != 0){
            $data['pdf_resolucion'] = $datos['pdf_resolucion'];
        }



        $this->db->where('id_titulo', $datos['id_titulo']);
        return $this->db->update('registro_titulo', $data);
    }

    public function mis_tramites($id_persona){
        $cadena_sql = " SELECT DISTINCT
                        RT.id_titulo,
                        RT.id_persona,
                        RT.fecha_tramite,
                        RT.tipo_titulo,
                        RT.institucion_educativa,
                        INS.nombre_institucion,
                        RT.profesion,
                        PU.nombre_programa,
                        RT.tarjeta,
                        RT.diploma,
                        RT.acta,
                        RT.libro,
                        RT.folio,
                        RT.anio,
                        RT.cod_universidad,
                        RT.resolucion,
                        RT.fecha_resolucion,
                        RT.entidad,
                        RT.titulo_equivalente,
			PE.nombre_programa as programaequivalente,
                        RT.pdf_documento,
                        RT.pdf_titulo,
                        RT.pdf_acta,
                        RT.pdf_tarjeta,
                        RT.pdf_resolucion,
                        RT.estado,
                        ET.descripcion
                    FROM registro_titulo RT
                    JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
                    LEFT JOIN pr_institucion INS ON INS.id_institucion = RT.institucion_educativa
                    LEFT JOIN pr_programas_univ PU ON PU.id_programa = RT.profesion
		    LEFT JOIN pr_programa_equivalente PE ON PE.id_programaequi = RT.titulo_equivalente
                    WHERE RT.id_persona = ".$id_persona."
                    ORDER BY 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

	// Creación validacion no duplicados en mysql.
    public function validartramitemsql($datosAr){

		$data = array(
            'institucion_educativa' => $datosAr['institucion_educativa'],
			'titulo_equivalente' => $datosAr['titulo_equivalente'],
            'profesion' => $datosAr['profesion'],
            'id_persona' => $datosAr['id_persona'],

        );
        $cadena_sql = " SELECT DISTINCT
                        RT.id_titulo,
                        RT.id_persona,
                        RT.fecha_tramite,
                        RT.tipo_titulo,
                        RT.institucion_educativa,
                        INS.nombre_institucion,
                        RT.profesion,
                        PU.nombre_programa,
                        RT.tarjeta,
                        RT.diploma,
                        RT.acta,
                        RT.libro,
                        RT.folio,
                        RT.anio,
                        RT.cod_universidad,
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
                        ET.descripcion
                    FROM registro_titulo RT
                    JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
                    LEFT JOIN pr_institucion INS ON INS.id_institucion = RT.institucion_educativa
                    LEFT JOIN pr_programas_univ PU ON PU.id_programa = RT.profesion
					LEFT JOIN pr_programa_equivalente PEQ ON PEQ.id_programaequi = RT.titulo_equivalente";


					if($data['institucion_educativa'] !="" && $data['profesion'] !=""){
					  $cadena_sql.=" WHERE RT.id_persona = ".$data['id_persona']." AND RT.institucion_educativa =".$data['institucion_educativa']." AND RT.profesion ='".$data['profesion']."' ORDER BY 1";
					}
					elseif ($data['titulo_equivalente'] !="" ) {
					  $cadena_sql.=" WHERE RT.id_persona = ".$data['id_persona']." AND PEQ.id_programaequi ='".$data['titulo_equivalente']."' ORDER BY 1";
					}
					else{
					  $cadena_sql.=" WHERE RT.id_persona = ".$data['id_persona']." RT.estado = 0 ORDER BY 1";
					}

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function consulta_resolucion($id_titulo){
        $cadena_sql = " SELECT
                        id_resolucion,
                        id_titulo,
                        id_archivo,
                        codigo_verificacion,
                        estado
                    FROM resoluciones_titulo
                    WHERE id_titulo = ".$id_titulo.";";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
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
    }

	//Author: Mario BeltrA�n mebeltran@saludcapital.gov.co Since: 17062019
	//Ajuste campo fecha term error al editar formulario.

    public function datos_tramite($id_titulo){
        $cadena_sql = " SELECT DISTINCT
                        RT.id_titulo,
                        RT.id_persona,
                        RT.fecha_tramite,
                        RT.tipo_titulo,
                        RT.institucion_educativa ins_titulo,
                        INS.nombre_institucion,
                        RT.profesion,
                        PU.nombre_programa,
						RT.fecha_term,
						RT.fecha_term_ext,
                        RT.tarjeta,
                        RT.diploma,
                        RT.acta,
                        RT.libro,
                        RT.folio,
                        RT.anio,
                        RT.cod_universidad,
                        RT.resolucion,
                        RT.fecha_resolucion,
                        RT.entidad,
                        RT.titulo_equivalente,
						PEQ.nombre_programa as programaequivalente,
						RT.pais_tituloequi,
                        RT.pdf_documento,
                        RT.pdf_titulo,
                        RT.pdf_acta,
                        RT.pdf_tarjeta,
                        RT.pdf_resolucion,
                        RT.estado,
                        ET.descripcion descEstado,
                        TI.Descripcion descTipoIden,
                        PE.*
                    FROM registro_titulo RT
                    JOIN persona PE ON PE.id_persona = RT.id_persona
                    JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
                    LEFT JOIN pr_institucion INS ON INS.id_institucion = RT.institucion_educativa
                    LEFT JOIN pr_programas_univ PU ON PU.id_programa = RT.profesion
					LEFT JOIN pr_programa_equivalente PEQ ON PEQ.id_programaequi = RT.titulo_equivalente
                    JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
                    WHERE RT.id_titulo = ".$id_titulo."";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function programasInstitucion($id_institucion){
        $cadena_sql = " SELECT  id_programa, id_institucion, nombre_programa, sede FROM pr_programas_univ WHERE id_institucion = ".$id_institucion." ORDER BY 3 ";

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

    public function registrarTitulo($param) {
        $this->db->trans_start();
        $this->db->insert('registro_titulo', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('seguimiento_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
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

}
