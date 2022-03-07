<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Gestor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function personas($id_gestor) {

        $sql = "SELECT DISTINCT PE.IdPersona, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, IdTipoIdentifcacion, NumeroIdentificacion, ";
        $sql .= " Edad, FechaNacimiento, Sexo, GrupoSanguineo, FactorRH, IdMunicipioNacimiento, IdLocalidad, Barrio, Direccion, Telefono, coordenada_x, coordenada_y ";
        $sql .= " FROM persona PE ";
        $sql .= " JOIN asignacion ASI ON ASI.IdPersona = PE.IdPersona ";
        $sql .= " WHERE ASI.IdGestor = ".$id_gestor." ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function personas_visitadas($id_gestor) {

        $sql = "SELECT DISTINCT PE.IdPersona, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, IdTipoIdentifcacion, NumeroIdentificacion, ";
        $sql .= " Edad, FechaNacimiento, Sexo, GrupoSanguineo, FactorRH, IdMunicipioNacimiento, IdLocalidad, Barrio, Direccion, Telefono, coordenada_x, coordenada_y ";
        $sql .= " FROM persona PE ";
        $sql .= " JOIN asignacion ASI ON ASI.IdPersona = PE.IdPersona ";
        $sql .= " JOIN Visita VI ON VI.IdPersona = PE.IdPersona ";
        $sql .= " WHERE ASI.IdGestor = ".$id_gestor." AND VI.IdEstadoVisita = 1 ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function info_persona($id_persona) {
        $sql = " SELECT IdPersona,	PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, IdTipoIdentifcacion, NumeroIdentificacion, Edad, FechaNacimiento, Sexo, GrupoSanguineo, FactorRH, Telefono, Email, Telefono2, Direccion, Barrio, coordenada_x, coordenada_y  ";
        $sql.= " FROM Persona ";
        $sql.= " WHERE IdPersona = ".$id_persona;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function consulta_persona($id_persona) {
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
                            programa
                        FROM
                            persona
                            WHERE 1=1 ";


        if($id_persona != ''){
            $cadena_sql.= "AND IdPersona = '".$id_persona."' ";
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

    public function prestador_servicio() {
        $sql = " SELECT IdPrestadorServicio, IdSubRed, Codigo, Nombre, Direccion, Telefono ";
        $sql.= " FROM pr_PrestadorServicio ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function punto_atencion($id_subred) {
        $sql = " SELECT IdPunto, NombrePunto, Direccion, Horario ";
        $sql.= " FROM pr_PuntoAtencion ";
        $sql.= " WHERE id_subred = ".$id_subred." ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function subred() {
        $sql = " SELECT IdSubRed, Codigo, Nombre ";
        $sql.= " FROM pr_SubRed ";
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

    public function niveles() {
        $sql = " SELECT IdNivelEducativo, Nombre ";
        $sql.= " FROM pr_NivelEducativo ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function responsables() {
        $sql = " SELECT IdResponsableCuidado, Nombre ";
        $sql.= " FROM pr_ResponsableCuidado ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function estado_visita() {
        $sql = " SELECT IdEstadoVisita, Nombre ";
        $sql.= " FROM EstadoVisita ";
        $sql.= " WHERE IdEstadoVisita IN(1,2,3,4,5,7) ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function cunsultarVisitas($id_persona) {
        $sql = " SELECT IdVisita, Fecha, VI.IdPersona, IdGestor, VI.IdEstadoVisita, EV.Nombre, us.username ";
        $sql.= " FROM Visita VI ";
        $sql.= " JOIN EstadoVisita EV ON EV.IdEstadoVisita = VI.IdEstadoVisita ";
        $sql.= " JOIN usuarios us ON us.id = VI.IdGestor ";
        $sql.= " WHERE VI.IdPersona = ".$id_persona;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function cunsultarVisitasEfectivas($id_persona) {
        $sql = " SELECT IdVisita, Fecha, VI.IdPersona, IdGestor, VI.IdEstadoVisita, EV.Nombre, us.username ";
        $sql.= " FROM Visita VI ";
        $sql.= " JOIN EstadoVisita EV ON EV.IdEstadoVisita = VI.IdEstadoVisita ";
        $sql.= " JOIN usuarios us ON us.id = VI.IdGestor ";
        $sql.= " WHERE VI.IdPersona = ".$id_persona;
        $sql.= " AND VI.IdEstadoVisita = 1 ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function cunsultarVisitasFicha1($id_persona) {
        $sql = " SELECT VI.IdVisita, Fecha, IdPersona, IdGestor, VI.IdEstadoVisita, EV.Nombre, FI.FechaRegistro,  ";
        $sql .= " PS.Nombre AS Prestador, ET.Nombre AS Etnia, EC.Nombre AS ECivil, NE.Nombre AS NEduca, Estrato, CantidadPersonasHogar, RC.Nombre AS Responsable, DescripcionOtroResponsable, ";
        $sql .= " TieneLimitacionFisicaDiscapacidad, DescripcionLimitacionFisicaDiscapacidad, IdOpcionUltimaConsulta, IdOpcionUltimaTomaLaboratorios, Tas, Tad, IdOpcionTAS, ValorGlucometria,  ";
        $sql .= " IdOpcionGlucometria, TiempoConsumoAlimentos, ValorPerimetroAbdominal, IdOpcionPA, ExisteHospitalizacionTA, ExisteHospitalizacionTA2, EsFumador, EsBebedor, RealizaActividadFisica, ";
        $sql .= " DescripcionActividadFisica, IdPrioridad, IdMedioCita, FechaCita, NombrePunto, ObsPrioridad ";
        $sql.= " FROM Visita VI ";
        $sql.= " JOIN EstadoVisita EV ON EV.IdEstadoVisita = VI.IdEstadoVisita ";
        $sql.= " JOIN FichaHTDA FI ON FI.IdVisita = VI.IdVisita ";
        $sql.= " JOIN pr_PrestadorServicio PS ON PS.IdPrestadorServicio = FI.IdPrestadorServicio ";
        $sql.= " JOIN pr_Etnia ET ON ET.IdEtnia = FI.IdEtnia ";
        $sql.= " JOIN pr_EstadoCivil EC ON EC.IdEstadoCivil = FI.IdEstadoCivil ";
        $sql.= " JOIN pr_NivelEducativo NE ON NE.IdNivelEducativo = FI.IdNivelEducativo ";
        $sql.= " JOIN pr_ResponsableCuidado RC ON RC.IdResponsableCuidado = FI.IdResponsableCuidado ";
        $sql.= " JOIN pr_PuntoAtencion PA ON PA.IdPunto = FI.LugarCita ";
        $sql.= " WHERE IdPersona = ".$id_persona;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function cunsultarVisitasFicha($id_persona) {
        $sql = " SELECT VI.IdVisita, Fecha, IdPersona, IdPrioridad, IdMedioCita, FechaCita, ObsPrioridad ";
        $sql.= " FROM Visita VI ";
        $sql.= " JOIN EstadoVisita EV ON EV.IdEstadoVisita = VI.IdEstadoVisita ";
        $sql.= " JOIN Ficha FI ON FI.IdVisita = VI.IdVisita ";
        $sql.= " WHERE IdPersona = ".$id_persona;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function guardaVisita($datos) {
        $this->db->trans_start();
        $this->db->insert('Visita', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function registroFicha($datos) {
        $this->db->trans_start();
        $this->db->insert('Ficha', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function registroFichaCronicos($datos) {
        $this->db->trans_start();
        $this->db->insert('FichaHTDA', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaAlerta($datos) {
        $this->db->trans_start();
        $this->db->insert('alertas', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }
    public function guardaGestante($datos) {
        $this->db->trans_start();
        $this->db->insert('materno', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaGestantePuerperio($datos) {
        $this->db->trans_start();
        $this->db->insert('materno_puerperio', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaPrimeraInfancia($datos) {
        $this->db->trans_start();
        $this->db->insert('primera_infancia', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaInfancia($datos) {
        $this->db->trans_start();
        $this->db->insert('infancia', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaAdolescencia($datos) {
        $this->db->trans_start();
        $this->db->insert('adolescencia', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaJuventud($datos) {
        $this->db->trans_start();
        $this->db->insert('juventud', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaAdultez($datos) {
        $this->db->trans_start();
        $this->db->insert('adultez', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function guardaVejez($datos) {
        $this->db->trans_start();
        $this->db->insert('vejez', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function actualizarPersona($datos) {

        $data = array(
            'Edad' => $datos['Edad'],
            'FechaNacimiento' => $datos['FechaNacimiento'],
            'IdMunicipioNacimiento' => $datos['IdMunicipioNacimiento'],
            'etnia' => $datos['etnia'],
            'IdLocalidad' => $datos['IdLocalidad'],
            'CodigoUP' => $datos['CodigoUP'],
            //'Barrio' => $datos['Barrio'],
            'Direccion' => $datos['Direccion'],
            'Telefono' => $datos['Telefono'],
            'Telefono2' => $datos['Telefono2'],
            'Email' => $datos['Email'],
            'Sexo' => $datos['Sexo'],
            'Gestante' => $datos['Gestante'],
            'semanas_gest' => $datos['semanas_gest'],
            'Peso' => $datos['Peso'],
            'Talla' => $datos['Talla'],
            'Imc' => $datos['Imc'],
            'Desc_imc' => $datos['Desc_imc']
            //'Telefono' => $datos['Telefono']
        );
        $this->db->where('IdPersona', $datos['IdPersona']);
        return $this->db->update('Persona', $data);
    }

    public function existePersona($data) {
        $sql = " SELECT IdPersona,	PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, IdTipoIdentifcacion, NumeroIdentificacion, Edad, FechaNacimiento, Sexo, GrupoSanguineo, FactorRH, Telefono, Email, Telefono2, Direccion, Barrio,  coordenada_x, coordenada_y  ";
        $sql.= " FROM Persona ";
        $sql.= " WHERE IdTipoIdentifcacion = ".$data['IdTipoIdentifcacion'];
        $sql.= " AND NumeroIdentificacion = ".$data['NumeroIdentificacion'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function registrarPersona($datos) {
        $this->db->trans_start();
        $this->db->insert('persona', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }

    public function imc_nino($meses) {

        $sql = "SELECT meses, VN3, VN2, VN1, VP0, VP1, VP2, VP3 ";
        $sql .= " FROM imc_ninos  ";
        $sql .= " WHERE meses = ".$meses;

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function imc_nina($meses) {

        $sql = "SELECT meses, VN3, VN2, VN1, VP0, VP1, VP2, VP3 ";
        $sql .= " FROM imc_ninas  ";
        $sql .= " WHERE meses = ".$meses;

        $query = $this->db->query($sql);
        return $query->result();
    }
    public function consulta_programa($id_programa) {

        $sql = "SELECT id_programa, desc_programa ";
        $sql .= " FROM pr_programa ";
        $sql .= " WHERE id_programa = ".$id_programa;

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function programas() {

        $sql = "SELECT id_programa, desc_programa ";
        $sql .= " FROM pr_programa ";

        $query = $this->db->query($sql);
        return $query->result();
    }

}
