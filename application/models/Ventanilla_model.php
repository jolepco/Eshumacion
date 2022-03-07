<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class ventanilla_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function tramites_usuario_habilitados($id_tramites) {
        $sql = " SELECT id_tramite, desc_tramite  ";
        $sql.= " FROM tramites tr ";
        $sql.= " WHERE tr.estado = 'AC' AND id_tramite IN(".$id_tramites.") ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function tramites_usuario($id_usuario) {
        $sql = " SELECT tramites  ";
        $sql.= " FROM usuarios us ";
        $sql.= " WHERE us.id = ".$id_usuario." ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function persona($nume_identificacion) {
        $sql = " SELECT
                    id_persona,
                    tipo_identificacion,
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
                    ciudad_nacimiento_otro,
                    depa_resi,
                    ciudad_resi,
                    dire_resi,
                    zona,
                    localidad,
                    upz,
                    barrio,
                    fecha_nacimiento,
                    edad,
                    sexo,
                    genero,
                    orientacion,
                    etnia,
                    estado_civil,
                    nivel_educativo,
                    institucion_educativa,
                    sede,
                    programa,
                    anio_grado,
                    periodo_grado,
                    cursa_otro_programa,
                    otro_programa,
                    tipo_iden_rp,
                    nume_iden_rp,
                    nombre_rp
                FROM
                    persona
                WHERE nume_identificacion = ".$nume_identificacion."  ";

        $query = $this->db->query($sql);
        return $query->row();
    }


}
