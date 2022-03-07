<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Seguimiento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function personas_digitador($id_subred) {

        $sql = "SELECT DISTINCT PE.IdPersona, PE.PrimerNombre, PE.SegundoNombre, PE.PrimerApellido, PE.SegundoApellido, PE.IdTipoIdentifcacion, PE.NumeroIdentificacion, ";
        $sql .= " PE.Edad, PE.FechaNacimiento, PE.Sexo, PE.GrupoSanguineo, PE.FactorRH, PE.IdMunicipioNacimiento, PE.IdLocalidad, PE.Barrio, PE.Direccion, PE.Telefono, USU.username, VI.Fecha ";
        $sql .= " FROM Persona PE ";
        $sql .= " JOIN Asignacion ASI ON ASI.IdPersona = PE.IdPersona ";
        $sql .= " JOIN usuarios USU ON USU.id = ASI.IdGestor ";
        $sql .= " JOIN Visita VI ON VI.IdPersona = PE.IdPersona ";
        $sql .= " JOIN ficha FI ON VI.IdVisita = FI.IdVisita  ";
        $sql .= " WHERE PE.id_subred = ".$id_subred." ";
        $sql .= " ORDER BY IdPrioridad, IdMedioCita desc ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consultarVisitas($id_persona) {
        $sql = " SELECT IdVisita, Fecha, IdPersona, IdGestor, VI.IdEstadoVisita, EV.Nombre ";
        $sql.= " FROM Visita VI ";
        $sql.= " JOIN EstadoVisita EV ON EV.IdEstadoVisita = VI.IdEstadoVisita ";
        $sql.= " WHERE IdPersona = ".$id_persona;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consultarVisitasFicha($id_persona) {
        $sql = " SELECT
                per.PrimerNombre, per.SegundoNombre, per.PrimerApellido, per.SegundoApellido, per.NumeroIdentificacion, Edad, per.Direccion, Telefono,
                FechaCita, IdPrioridad, LugarCita,
                CASE idprioridad
                    WHEN '0' THEN 'Sin Prioridad'
                    WHEN '1' THEN 'Urgencia'
                    WHEN '2' THEN 'Cita de atencion medica prioritaria'
                    ELSE 'Sin Prioridad'
                END as prioridad,
                idMedioCita,
                CASE idMedioCita
                    WHEN '0' THEN 'N/A'
                    WHEN '1' THEN 'Web'
                    WHEN '2' THEN 'Chat'
                    WHEN '3' THEN 'Telefono'
                    ELSE 'N/A'
                END as medio,
                pat.NombrePunto, ObsPrioridad, vis.fecha, EV.Nombre, Asistio, fic.IdVisita
                FROM ficha fic
                JOIN visita  vis ON vis.IdVisita = fic.IdVisita
                JOIN EstadoVisita EV ON EV.IdEstadoVisita = vis.IdEstadoVisita
                JOIN persona per ON per.IdPersona = vis.IdPersona
                LEFT JOIN pr_puntoatencion pat ON pat.IdPunto = fic.LugarCita ";
        $sql.= " WHERE per.IdPersona = ".$id_persona;


        $query = $this->db->query($sql);
        return $query->result();
    }

    public function pr_razon_asistencia() {
        $sql = " SELECT
                    id_razon_asistencia,
                    desc_razon_asistencia
                FROM
                    pr_razon_asistencia; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function pr_tipo_seguimiento() {
        $sql = " SELECT
                    id_tipo_seguimiento,
                    desc_tipo_seguimiento
                FROM
                    pr_tipo_seguimiento; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consultaPersona($datos) {
        $sql = " SELECT
                    IdPersona
                FROM
                    visita
                    WHERE IdVisita = ".$datos['IdVisita']."; ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function pr_razon_seguimiento() {
        $sql = " SELECT
                    id_razon_seguimiento,
                    desc_razon_seguimiento
                FROM
                    pr_razon_seguimiento; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function actualizaCita($datos) {

        $data = array(
            'FechaCita' => $datos['FechaCita'],
            'LugarCita' => $datos['LugarCita'],
            'Asistio' => $datos['Asistio']
        );
        $this->db->where('IdVisita', $datos['IdVisita']);
        return $this->db->update('ficha', $data);
    }

    public function actualizaCitaNueva($datos) {

        $data = array(
            'fecha_cita' => $datos['fecha_cita'],
            'id_punto_atencion' => $datos['id_punto_atencion'],
            'asistio' => $datos['asistio']
        );
        $this->db->where('id_persona', $datos['id_persona']);
        return $this->db->update('nueva_cita', $data);
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('seguimiento_ficha', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function registrarSeguimientoNuevo($param) {
        $this->db->trans_start();
        $this->db->insert('seguimiento_nuevacita', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function nuevaCita($param) {
        $this->db->trans_start();
        $this->db->insert('nueva_cita', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }


    public function seguimientos_realizado_ficha($id_persona) {
        $sql = " SELECT	sf.IdVisita, fecha_seguimiento, sf.id_tipo_seguimiento, desc_tipo_seguimiento, sf.id_razon_asistencia, desc_razon_asistencia, sf.id_razon_seguimiento, desc_razon_seguimiento, observaciones, id_digitador
                    FROM visita vi
                    JOIN seguimiento_ficha sf ON sf.IdVisita = vi.IdVisita
                    JOIN pr_tipo_seguimiento ts ON ts.id_tipo_seguimiento = sf.id_tipo_seguimiento
                    LEFT JOIN pr_razon_asistencia ra ON ra.id_razon_asistencia = sf.id_razon_asistencia
                    JOIN pr_razon_seguimiento rs ON rs.id_razon_seguimiento = sf.id_razon_seguimiento
                    WHERE IdPersona = ".$id_persona."; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function seguimientos_nuevacita($id_cita) {
        $sql = " SELECT	sn.id_cita, fecha_seguimiento, sn.id_tipo_seguimiento, desc_tipo_seguimiento, sn.id_razon_asistencia, desc_razon_asistencia, sn.id_razon_seguimiento, desc_razon_seguimiento, observaciones, id_digitador
        FROM seguimiento_nuevacita sn
        JOIN pr_tipo_seguimiento ts ON ts.id_tipo_seguimiento = sn.id_tipo_seguimiento
        LEFT JOIN pr_razon_asistencia ra ON ra.id_razon_asistencia = sn.id_razon_asistencia
        JOIN pr_razon_seguimiento rs ON rs.id_razon_seguimiento = sn.id_razon_seguimiento
        WHERE id_cita = ".$id_cita."; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consulta_nuevas_citas($id_persona) {
        $sql = " SELECT nc.id_cita, nc.id_programa, pr.desc_programa, nc.fecha_cita, nc.id_punto_atencion, pa.NombrePunto, nc.fecha_asignacion, asistio FROM nueva_cita nc JOIN pr_programa pr ON pr.id_programa = nc.id_programa JOIN pr_puntoatencion pa ON pa.IdPunto = nc.id_punto_atencion
        WHERE id_persona = ".$id_persona."; ";

        $query = $this->db->query($sql);
        return $query->result();
    }

}
