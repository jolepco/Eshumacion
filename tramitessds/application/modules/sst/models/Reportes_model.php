<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class reportes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function tramites_pendientes() 
    {
        $sql = " SELECT count(*) as total FROM sst_tramite ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return NULL;
        }
    }

    public function tramites_validados() 
    {
        $sql = " SELECT COUNT(*) as total FROM sst_tramite ";
        $sql .= " WHERE id_estado NOT IN (1) ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return NULL;
        }
    }

    public function licencias_aprobadas() 
    {
        $sql = " SELECT count(*) as total FROM sst_resoluciones ";
        $sql .= " WHERE estado = 10 ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return NULL;
        }
    }

    public function licencias_negadas() 
    {
        $sql = " SELECT count(*) as total FROM sst_resoluciones ";
        $sql .= " WHERE estado = 11 ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return NULL;
        }
    }

    public function reporte_estados() 
    {
        $sql = " SELECT se.id_estado, se.descripcion, count(*) as total ";
        $sql .= " FROM sst_tramite st ";
        $sql .= " JOIN sst_estados se ON st.id_estado = se.id_estado ";
        $sql .= " GROUP BY 1,2 ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function tramites_anulados($fechai, $fechaf) 
    {	
	$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $sql = " SELECT sst.*, stf.* , PE.*, se.*, TI.Descripcion AS DescTipoIden
                FROM sst_tramite sst
                JOIN usuarios US ON US.id = sst.id_usuario
                JOIN persona PE ON PE.id_persona = US.id_persona
                JOIN sst_estados se ON se.id_estado = sst.id_estado
                JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id AND stf.id_estado = sst.id_estado 
                JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion"; 
        if ($fechai != "" && $fechaf != "")
        	$sql .= " WHERE sst.fecha_creacion BETWEEN '$fechai' AND '$fechaf 23:59' AND sst.id_estado = 6";
        else{
                $sql .= " WHERE sst.fecha_creacion BETWEEN '$fec2' AND '$fecha2 23:59' AND sst.id_estado = 6";
	}
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }
    
    public function tramites_devueltos($fechai, $fechaf) 
    {
	$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $sql = " SELECT sst.*, stf.* , PE.*, se.*, TI.Descripcion AS DescTipoIden
                FROM sst_tramite sst
                JOIN usuarios US ON US.id = sst.id_usuario
                JOIN persona PE ON PE.id_persona = US.id_persona
                JOIN sst_estados se ON se.id_estado = sst.id_estado
                JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id AND stf.id_estado = sst.id_estado 
                JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
        if ($fechai != "" && $fechaf != "")
        	$sql .= " WHERE sst.fecha_creacion  BETWEEN '$fechai' AND '$fechaf 23:59' AND sst.id_estado = 4";
        else{
                $sql .= " WHERE sst.fecha_creacion  BETWEEN '$fec2' AND '$fecha2 23:59' AND sst.id_estado = 4";
	}
	
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }
    
    public function licencias_emitidas($fechai, $fechaf)  
    {
	$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $sql = " SELECT sst.*, stf.* , PE.*, se.*, RE.*, AR.*, TI.Descripcion AS DescTipoIden
                FROM sst_tramite sst
                JOIN usuarios US ON US.id = sst.id_usuario
                JOIN persona PE ON PE.id_persona = US.id_persona
                JOIN sst_estados se ON se.id_estado = sst.id_estado
                JOIN sst_tramite_flujo stf ON sst.id_tramite = stf.tramite_id AND stf.id_estado = sst.id_estado 
                JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion 
                JOIN sst_resoluciones RE ON RE.id_tramite = sst.id_tramite AND RE.estado = sst.id_estado 
                JOIN archivos AR ON RE.id_archivo = AR.id_archivo ";
               if ($fechai != "" && $fechaf != "")
                    $sql .= " WHERE stf.fecha_estado BETWEEN '$fechai' AND '$fechaf 23:59' ";
               else{
                    $sql .= " WHERE stf.fecha_estado BETWEEN '$fec2' AND '$fecha2 23:59' ";
	       }
		
        $query = $this->db->query($sql);
	$result = $query->result();
        return $result;
		
   
    }
    
    public function consulta_persona_natural($data) 
    {
        $sql = " SELECT st.*, stf.*, sre.*, sr.*, us.*, per.* 
                FROM sst_resoluciones sre 
                JOIN sst_tramite st ON st.id_tramite = sre.id_tramite 
                JOIN sst_tramite_flujo stf ON stf.tramite_id = st.id_tramite AND stf.id_estado = st.id_estado
                JOIN sst_registro sr ON sr.id_tramite = st.id_tramite
                JOIN usuarios us ON us.id = st.id_usuario 
                JOIN persona per ON per.id_persona =  us.id_persona 
                WHERE per.tipo_identificacion IN(1,2,3,4,6) 
                AND stf.fecha_estado BETWEEN '{$data['fecha_inicial']} 00:00:00' AND '{$data['fecha_final']} 11:59:59'; ";
		
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function consulta_persona_juridica($data) 
    {
        $sql = " SELECT st.*, stf.*, sre.*, sr.*, us.*, per.*
                FROM sst_resoluciones sre 
                JOIN sst_tramite st ON st.id_tramite = sre.id_tramite 
                JOIN sst_tramite_flujo stf ON stf.tramite_id = st.id_tramite AND stf.id_estado = st.id_estado
                JOIN sst_registro sr ON sr.id_tramite = st.id_tramite
                JOIN usuarios us ON us.id = st.id_usuario 
                JOIN persona per ON per.id_persona =  us.id_persona 
                WHERE per.tipo_identificacion IN(5) 
                AND stf.fecha_estado BETWEEN '{$data['fecha_inicial']} 00:00:00' AND '{$data['fecha_final']} 11:59:59'; ";
		
        $query = $this->db->query($sql);
		
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function campos_accion_pn($id_tramite) 
    {
        $sql = " SELECT * 
                FROM sst_campos_validacion stcv
                JOIN sst_perfiles stp ON stp.id_perfil = stcv.id_perfil
                JOIN sst_campos_accion stca ON stca.id_campo = stcv.id_campo
                WHERE id_tramite = {$id_tramite}; ";
		
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function campos_accion_pj($id_tramite) 
    {
        $sql = " SELECT * 
                FROM sst_campos_validacion stcv
                JOIN sst_campos_accion stca ON stca.id_campo = stcv.id_campo
                WHERE id_tramite = {$id_tramite}; ";
		
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function info_usuariotramite($id_persona) {
          $sql = " SELECT * ";
          $sql.= " FROM usuarios  ";
          $sql.= " WHERE username = '".$id_persona."'";
          $query = $this->db->query($sql);
          return $query->row();
    }
	
    public function tramites_pornumdocSST($numdoc){
        $cadena_sql = "SELECT sst.*, PE.*, se.*, TI.*
						FROM sst_tramite sst
						JOIN usuarios US ON US.id = sst.id_usuario
						JOIN persona PE ON PE.id_persona = US.id_persona
						JOIN sst_estados se ON se.id_estado = sst.id_estado
                        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion";
		
		

		if($numdoc !=""){
		  $cadena_sql.=" WHERE PE.nume_identificacion =".$numdoc."";
		}
		else {
		  $cadena_sql.=" WHERE PE.nume_identificacion ='0'";
		}
		$query = $this->db->query($cadena_sql);
		$result = $query->result();
		return $result;
    }

}
