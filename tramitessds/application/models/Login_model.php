<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validar_codigo($codigo_verificacion){
        
        $cadena_sql = " SELECT RT.id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.tarjeta, RT.diploma, RT.acta, RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente, RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden, RE.id_resolucion, RE.id_archivo, RE.estado, PU.nombre_programa, PE.* 
        FROM registro_titulo RT 
        JOIN persona PE ON PE.id_persona = RT.id_persona 
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado 
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion 
        JOIN pr_programas_univ PU ON PU.id_programa = RT.profesion AND PU.id_institucion = RT.institucion_educativa
        JOIN resoluciones_titulo RE ON RE.id_titulo = RT.id_titulo
        WHERE RE.codigo_verificacion = '".$codigo_verificacion."'";
        //echo $cadena_sql;
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
	/*Author: Mario Beltrán mebeltran@saludcapital.gov.co Since: 21062019
	Validacion de Codigo Verificacion Licencia de Exhumacion*/	
    public function validar_codigoLE($codigo_verificacion){
        
        $cadena_sql = " SELECT LE.idlicencia_exhumacion, LE.id_persona, LE.fecha_solicitud, RE.nombre_difunto, RE.cementerio, RE.num_licencia_inhumacion, RE.fecha_inhumacion, RE.numero_lic_exhu, RE.fecha_aprob, TI.Descripcion descTipoIden, PE.* 
        FROM licencia_exhuma LE 
        JOIN persona PE ON PE.id_persona = LE.id_persona 
        JOIN estado_tramite_licenciaexh ET ON ET.id_estado = LE.estado 
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion 
        JOIN aprobacion_licencia RE ON RE.idlicencia_exhumacion = LE.idlicencia_exhumacion
        WHERE RE.numero_verificacion = '".$codigo_verificacion."'";
        //echo $cadena_sql;
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

    public function login_user($username,$password)
    {
        $sql = " SELECT id,	id_persona, perfil, username, password, estado, fecha_terminos ";
        $sql.= " FROM usuarios us ";
        $sql.= " WHERE username = '".$username."' ";
        $sql.= " AND password = '".$password."' ";
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

	public function info_usuariotramite($id_persona) {
        $sql = " SELECT * ";
        $sql.= " FROM usuarios  ";
        $sql.= " WHERE username = '".$id_persona."'";
        $query = $this->db->query($sql);
        return $query->row();
    }	
    public function faqs(){
        $cadena_sql = " SELECT * FROM pr_faqtips WHERE estado = 1 AND tipo_faqs = 1";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tips(){
        $cadena_sql = " SELECT * FROM pr_faqtips WHERE estado = 1 AND tipo_faqs = 2";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
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

    public function municipios_col($dpto){
        $cadena_sql = " SELECT IdMunicipio, IdDepartamento, CodigoDane, Descripcion FROM pr_municipio WHERE IdDepartamento = ".$dpto." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function localidades($id_subred){
        $cadena_sql = " SELECT IdLocalidad, Nombre, id_subred FROM pr_localidad WHERE id_subred = ".$id_subred." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function subred(){
        $cadena_sql = " SELECT IdSubRed, Codigo, Nombre FROM pr_subred ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function upz($id_localidad){
        $cadena_sql = " SELECT id_upz, id_localidad, cod_upz, nom_upz FROM pr_upz WHERE id_localidad = ".$id_localidad." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function barrios($id_upz){
        $cadena_sql = " SELECT id_barrio, id_upz, nombre_barrio FROM pr_barrio WHERE id_upz = ".$id_upz." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function instituciones(){
        $cadena_sql = " SELECT DISTINCT id_institucion, nombre_institucion, sede FROM pr_institucion ORDER BY 2 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function institucionesdesc($id_institucion){
        $cadena_sql = " SELECT DISTINCT id_institucion, nombre_institucion, sede FROM pr_institucion WHERE id_institucion = ".$id_institucion." ";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
    public function sedes($id_institucion){
        $cadena_sql = " SELECT  id_institucion, nombre_institucion, sede FROM pr_institucion WHERE id_institucion = ".$id_institucion."";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function programas($id_institucion, $sede){
        $cadena_sql = " SELECT  id_programa, id_institucion, nombre_programa, sede FROM pr_programas_univ WHERE id_institucion = ".$id_institucion."";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

	public function programas_todos(){
        $cadena_sql = " SELECT  id_programa, id_institucion, nombre_programa, sede FROM pr_programas_univ ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function profesionesequi(){
        $cadena_sql = " SELECT  id_programaequi, nombre_programa, grupo_tituloequi, aplica_rethus, tipo_prog FROM pr_programa_equivalente ORDER BY 5";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
    public function tipo_identificacion(){
        $cadena_sql = " SELECT IdTipoIdentificacion, Codigo, Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion IN(1,2,3,6) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	public function tipo_identificaciondesc($id){
        $cadena_sql = " SELECT Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion = ". $id . "";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
    
    public function tipo_identificacion_juridica(){
        $cadena_sql = " SELECT IdTipoIdentificacion, Codigo, Descripcion FROM pr_tipoidentificacion WHERE IdTipoIdentificacion IN(5) ";

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

    public function programasInstitucion($id_institucion){
        $cadena_sql = " SELECT  id_programa, id_institucion, nombre_programa, sede, tipo_prog FROM pr_programas_univ WHERE id_institucion = ".$id_institucion." ORDER BY 3 ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function nivelAcademico(){
        $cadena_sql = " SELECT  IdNivelAcademico, Nombre FROM pr_nivelacademico ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function existe_persona($tipo_identificacion, $numero_identificacion){
        $cadena_sql = " SELECT id_persona, tipo_identificacion, nume_identificacion FROM persona ";
        $cadena_sql .= " WHERE tipo_identificacion = '".$tipo_identificacion."' AND nume_identificacion = '".$numero_identificacion."'";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
	public function existe_persona1( $numero_identificacion){
        $cadena_sql = " SELECT id_persona, tipo_identificacion, nume_identificacion FROM persona ";
        $cadena_sql .= " WHERE nume_identificacion = '".$numero_identificacion."'";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function existe_representantelegal($tipo_identificacionel, $numero_identificacionrl){
        $cadena_sql = " SELECT id_persona, tipo_identificacion, nume_identificacion FROM persona ";
        $cadena_sql .= " WHERE tipo_identificacion = '".$tipo_identificacionel."' AND nume_identificacion = '".$numero_identificacionrl."'";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function guardaPersona($datos) {
        $this->db->trans_start();
        $this->db->insert('persona', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }
    public function guardaUsuario($datos) {
        $this->db->trans_start();
        $this->db->insert('usuarios', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;

    }
        
    public function validar_datos_persona($datos){
        $cadena_sql = " SELECT us.id, username, tipo_identificacion, nume_identificacion, p_nombre, s_nombre, p_apellido, s_apellido, email 
                        FROM usuarios us
                        JOIN persona per ON us.id_persona = per.id_persona
                        WHERE username = '".$datos['usuario']."' AND per.email = '".$datos['correo_electronico']."';";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
    
    public function validar_datos_clave($datos){
        $cadena_sql = " SELECT us.id, username, tipo_identificacion, nume_identificacion, p_nombre, s_nombre, p_apellido, s_apellido, email 
                        FROM usuarios us
                        JOIN persona per ON us.id_persona = per.id_persona
                        WHERE username = '".$datos['usuario']."' AND password = '".$datos['clave_actual']."';";
        
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
    
    public function validar_datos_clave_usuario($datos){
        $cadena_sql = " SELECT us.id, us.username, per.email, per.p_nombre, per.p_apellido 
                        FROM usuarios us JOIN persona as per on per.id_persona =us.id_persona
                        WHERE us.username = '".$datos['usuario']."' AND us.password = '".$datos['clave_actual']."';";
        
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }
	
	
    
    public function actualizar_clave($datos) {

        $data = array(
            'password' => $datos['password']
        );
        $this->db->where('id', $datos['id']);
        return $this->db->update('usuarios', $data);
    }

	/*Author: Mario Beltrán mebeltran@saludcapital.gov.co Since: 11062019
	Metodo Buscar persona por num_identificacion oracle*/		
	public function validacionUsuario_oracle($datosAr) {
		$data = array(
            'nume_identificacion' => $datosAr['nume_identificacion'],
        );
		
        $oracle = $this->load->database('oracle', TRUE);
        $cadena_sql = " SELECT DISTINCT NROIDENT, NOMBRES, APELLIDOS, NOMBRE_PROFESION, NOMBRE_INSTIT, FECHA_RESOLUCION,NUMERO_RESOLUCION FROM V_PROFESIONALES_SALUD ";
        $cadena_sql.= " WHERE NROIDENT =".$data['nume_identificacion']; 

        $query = $oracle->query($cadena_sql);
		$result = $query->result();
        return $result;
    }


}
