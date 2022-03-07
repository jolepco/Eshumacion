<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class personas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function consulta_persona($datos) {
        $this->load->database();

        $cadena_sql = "SELECT
                            IdPersona,
                            PrimerNombre,
                            SegundoNombre,
                            PrimerApellido,
                            SegundoApellido,
                            IdTipoIdentifcacion,
                            NumeroIdentificacion,
                            Edad,
                            Gestante,
                            FechaNacimiento,
                            Sexo,
                            GrupoSanguineo,
                            FactorRH,
                            IdMunicipioNacimiento,
                            IdLocalidad,
                            Barrio,
                            Direccion,
                            Telefono,
                            Telefono2,
                            Email,
                            CodigoUP,
                            coordenada_x,
                            coordenada_y,
                            Peso,
                            Talla,
                            Imc,
                            Desc_imc,
                            etnia,
                            id_subred,
                            estado
                        FROM
                            persona
                            WHERE 1=1 ";


        if($datos['nume_iden_consulta'] != ''){
            $cadena_sql.= "AND NumeroIdentificacion = '".$datos['nume_iden_consulta']."' ";
        }

        if(isset($datos['id_subred']) && $datos['id_subred'] != ''){
            $cadena_sql.= "AND id_subred = '".$datos['id_subred']."' ";
        }


        $query = $this->db->query($cadena_sql);

        return $query->result();
    }


    public function tipo_docu() {
        $sql = " SELECT IdTipoIdentificacion, Descripcion ";
        $sql.= " FROM pr_TipoIdentificacion ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function departamentos() {
        $sql = " SELECT IdDepartamento,	CodigoDane, Descripcion ";
        $sql.= " FROM pr_Departamento ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function municipios($dpto) {
        $sql = " SELECT IdMunicipio, IdDepartamento	, CodigoDane, Descripcion ";
        $sql.= " FROM pr_Municipio ";
        $sql.= " WHERE IdDepartamento = ".$dpto;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function localidad($id_subred = '') {
        $sql = " SELECT IdLocalidad, Nombre ";
        $sql.= " FROM pr_Localidad ";

        if($id_subred != ''){
            $sql.= " WHERE id_subred = ".$id_subred;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function upz($localidad) {
        $sql = " SELECT id_upz, id_localidad, cod_upz, nom_upz ";
        $sql.= " FROM pr_upz ";
        $sql.= " WHERE id_localidad = ".$localidad;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function upz_todas() {
        $sql = " SELECT id_upz, id_localidad, cod_upz, nom_upz ";
        $sql.= " FROM pr_upz ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function etnias() {
        $sql = " SELECT IdEtnia, Nombre ";
        $sql.= " FROM pr_Etnia ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function estados_civiles() {
        $sql = " SELECT  IdEstadoCivil, Nombre ";
        $sql.= " FROM pr_EstadoCivil ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function actualizarPersona($datos) {

        $data = array(
            'Edad' => $datos['Edad'],
            'FechaNacimiento' => $datos['FechaNacimiento'],
            'IdLocalidad' => $datos['IdLocalidad'],
            'CodigoUP' => $datos['CodigoUP'],
            'Direccion' => $datos['Direccion'],
            'Telefono' => $datos['Telefono'],
            'Telefono2' => $datos['Telefono2'],
            'Email' => $datos['Email'],
            'Gestante' => $datos['Gestante'],
            'Sexo' => $datos['Sexo'],
            'etnia' => $datos['etnia']
        );
        $this->db->where('IdPersona', $datos['IdPersona']);
        return $this->db->update('Persona', $data);
    }

    public function actualizarPersonaAdmin($datos) {

        $data = array(
            'PrimerNombre' => $datos['p_nombre'],
            'SegundoNombre' => $datos['s_nombre'],
            'PrimerApellido' => $datos['p_apellido'],
            'SegundoApellido' => $datos['s_apellido'],
            'IdTipoIdentifcacion' => $datos['t_docu'],
            'NumeroIdentificacion' => $datos['n_docu'],
            'Edad' => $datos['Edad'],
            'FechaNacimiento' => $datos['FechaNacimiento'],
            'IdLocalidad' => $datos['IdLocalidad'],
            'CodigoUP' => $datos['CodigoUP'],
            'Direccion' => $datos['Direccion'],
            'Telefono' => $datos['Telefono'],
            'Telefono2' => $datos['Telefono2'],
            'Email' => $datos['Email'],
            'Gestante' => $datos['Gestante'],
            'Sexo' => $datos['Sexo'],
            'etnia' => $datos['etnia'],
            'estado' => $datos['estado']
        );
        $this->db->where('IdPersona', $datos['IdPersona']);
        return $this->db->update('Persona', $data);
    }

    public function validarAsignacion($param) {
        $sql = " SELECT * ";
        $sql.= " FROM asignacion ";
        $sql.= " WHERE IdPersona = ".$param['IdPersona'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function registrarAsignacion($param) {
        $this->db->trans_start();
        $this->db->insert('asignacion', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
}
