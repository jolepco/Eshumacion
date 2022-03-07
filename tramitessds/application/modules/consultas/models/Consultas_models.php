<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Consultas_models extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }

    public function tramitesTodos(){
        if($this->input->post('num_doc')){
            $documento=$this->input->post('num_doc');
        }else{
            $documento=0;
        }
        $sql = "CALL pa_tramites_id($documento)";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

     public function tramites_rango($fechai, $fechaf){
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->consultas_models->formatoFecha($fechai,'/');
        $fechaFinal=$this->consultas_models->formatoFecha($fechaf,'/');
        
        if ($fechai != "" && $fechaf != ""){
           $fecha_ini= $fechaInicial;
           $fecha_fin=$fechaFinal;
        }
        else{
            $fecha_ini= $fec2;
            $fecha_fin=$fecha2.' 23:59'; 
        }

        $sql = "CALL pa_tramites_fecha('$fecha_ini','$fecha_fin')";
       
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    }

    /**
     * Obtiene la traza del trámite de Expendedor de Drogas.
     * @author sjneirag
     * @since  06/2020
     */
    function listarSolicitudesRX($fechai, $fechaf){
       $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $fechaInicial=$this->consultas_models->formatoFecha($fechai,'/');
        $fechaFinal=$this->consultas_models->formatoFecha($fechaf,'/');
        
        $sql = "SELECT RX.id, RX.user, RX.estado, RX.created_at, RX.categoria, RX.visita_previa, RX.fecha_subsanacion1, RX.fecha_subsanacion2, RX.fecha_envio, RF.fecha_estado, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.tipo_identificacion as tipo_iden, TI.Descripcion, PE.nume_identificacion, PE.p_nombre, PE.s_nombre, PE.p_apellido, PE.s_apellido, PE.email, PE.telefono_fijo, PE.telefono_celular, PE.nacionalidad, PA.Nombre as nom_nacionalidad, PE.departamento, DEP.Descripcion as nom_depto, PE.ciudad_nacimiento, MUN.Descripcion as nom_mpio, PE.dire_resi, PE.localidad, LOC.Nombre as nom_localidad, PE.upz, UPZ.nom_upz, PE.barrio, BAR.nombre_barrio, PE.fecha_nacimiento, PE.edad, PE.sexo, SEX.descripcion_sexo, PE.genero, PE.orientacion, PE.etnia, ETN.Nombre as nom_etnia, PE.estado_civil, ECV.Nombre as nom_est_civil, PE.nivel_educativo, NED.Nombre as nom_nivel_educativo, PE.tipo_iden_rl, PE.nume_iden_rl, PE.nombre_rs
            FROM rayosx_tramite RX
            JOIN usuarios US ON US.id = RX.user
            JOIN persona PE ON PE.id_persona = US.id_persona
            JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
            JOIN rayosx_tramite_flujo RF ON RX.id = RF.tramite_id AND RF.id_estado = RX.estado 
            LEFT JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
            LEFT JOIN pr_pais PA ON PE.nacionalidad=PA.IdPais
            LEFT JOIN pr_departamento DEP ON PE.departamento=DEP.IdDepartamento
            LEFT JOIN pr_municipio MUN ON PE.ciudad_nacimiento=MUN.IdMunicipio
            LEFT JOIN pr_localidad LOC ON PE.localidad=LOC.idLocalidad
            LEFT JOIN pr_upz UPZ ON PE.upz=UPZ.id_upz
            LEFT JOIN pr_barrio BAR ON PE.barrio=BAR.id_barrio
            LEFT JOIN pr_sexo SEX ON PE.sexo=SEX.id_sexo
            LEFT JOIN pr_etnia ETN ON PE.etnia=ETN.IdEtnia
            LEFT JOIN pr_estadocivil ECV ON PE.estado_civil= ECV.IdEstadoCivil
            LEFT JOIN pr_niveleducativo NED ON PE.nivel_educativo=NED.IdNivelEducativo ";
        if ($fechai != "" && $fechaf != ""){
            $sql .= " WHERE RX.created_at BETWEEN '$fechaInicial' AND '$fechaFinal 23:59' ";
        }
        else{
            $sql .= "  WHERE RX.created_at BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }
       
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        $this->db->close();
    } 

    /**
     * Obtiene la traza del trámite de Seguridad salud trabajo.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_auditoriaSST($id_tramite){
       $auditoria = array();
        $sql = "SELECT tramite_id, id_usuario, p.p_nombre, p.p_apellido, fecha_estado, id_estado, observaciones
        FROM sst_tramite_flujo e
        INNER JOIN usuarios u ON u.id = e.id_usuario
        INNER JOIN persona p ON p.id_persona = u.id_persona
        WHERE tramite_id = ".$id_tramite."
        ORDER BY id_tramite ASC ";
       
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
               $auditoria[$i]["id_tramite"] = $row->tramite_id;
               $auditoria[$i]["id_usuario"] = $row->id_usuario;
               $auditoria[$i]["p_nombre"] = $row->p_nombre;
               $auditoria[$i]["p_apellido"] = $row->p_apellido;
               $auditoria[$i]["fecha_registro"] = $row->fecha_registro;
               $auditoria[$i]["id_estado"] = $row->id_estado;
               $auditoria[$i]["observaciones"] = $row->observaciones;
            $i++;
            }
        }
        
        return$auditoria;
        $this->db->close();
    } 

    /**
     * Obtiene la traza del trámite de Autorización de plazas.
     * @author sjneirag
     * @since  06/2020
     */
    function consulta_auditoriaAP($id_tramite){
       $auditoria = array();
        $sql = "SELECT id_tramite, id_usuario, p.p_nombre, p.p_apellido, fecha_registro, id_estado, observaciones
        FROM plazas_historico e
        INNER JOIN usuarios u ON u.id = e.id_usuario
        INNER JOIN persona p ON p.id_persona = u.id_persona
        WHERE id_tramite = ".$id_tramite."
        ORDER BY id_tramite ASC ";
       
        $query = $this->db->query($sql);
        
        if ($query->num_rows()>0){
            $i=0;
            foreach($query->result() as $row){
               $auditoria[$i]["id_tramite"] = $row->id_tramite;
               $auditoria[$i]["id_usuario"] = $row->id_usuario;
               $auditoria[$i]["p_nombre"] = $row->p_nombre;
               $auditoria[$i]["p_apellido"] = $row->p_apellido;
               $auditoria[$i]["fecha_registro"] = $row->fecha_registro;
               $auditoria[$i]["id_estado"] = $row->id_estado;
               $auditoria[$i]["observaciones"] = $row->observaciones;
            $i++;
            }
        }
        
        return$auditoria;
        $this->db->close();
    } 

    function formatoFecha($fecha,$formato){
        $fecha = substr($fecha,0,10);
        switch($formato){
            case '-':  //Guardar en la Base de Datos
                       $arrayFecha = explode("-",$fecha);
                       $string = $arrayFecha[2]."/".$arrayFecha[1]."/".$arrayFecha[0];
                       break;
                      
            case '/':  //Recoger de la base de datos
                       $arrayFecha = explode('/',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[0].'-'.$arrayFecha[1];
                       break;
                      
            case '\\': //Recoger de la base de datos
                       $arrayFecha = explode('\\',$fecha);
                       $string = $arrayFecha[2].'-'.$arrayFecha[1].'-'.$arrayFecha[0];
                       break;         
        }
        return $string;         
    }   


}