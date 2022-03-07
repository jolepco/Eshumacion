<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Consulta_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function busca_registros($tipo_ident,$cedula) {
        $sql = " SELECT ANIO_GRAVABLE, TIPO_IDENTIFICACION, NUM_IDENTIFICACION, NOMBRE_RAZON_SOCIAL, BASE_GRAVABLE_NETA, TOTAL_INGRESOS_BRUTOS_X_DISTRITO,";
        $sql .= " DEDUCCIONES_EXENCIONES_ACN, VALOR_RETEN_INDUSYCOMERCIO";     
        $sql .= " FROM contratista_ica";
		$sql .= " WHERE NUM_IDENTIFICACION = '".$cedula."'";
        $sql .= " AND TIPO_IDENTIFICACION = '".$tipo_ident."'";	
     	$query = $this->db->query($sql);		
	    return $query->result(); 	
    } 
	
    public function busca_registros_ced($tipo_ident,$cedula) {
      $sql = " SELECT ANIO_GRAVABLE, TIPO_IDENTIFICACION, NUM_IDENTIFICACION, NOMBRE_RAZON_SOCIAL, BASE_GRAVABLE_NETA, TOTAL_INGRESOS_BRUTOS_X_DISTRITO,";
        $sql .= " DEDUCCIONES_EXENCIONES_ACN, VALOR_RETEN_INDUSYCOMERCIO";     
        $sql .= " FROM contratista_ica";
        $sql .= " WHERE NUM_IDENTIFICACION = '".$cedula."'";
        $sql .= " AND TIPO_IDENTIFICACION = '".$tipo_ident."'";    
        $query = $this->db->query($sql);	
        return $query->result();  
    }

  /*  public function busca_registros_con($contrato, $cuenta) {
        $sql = " SELECT VIGENCIA, NIT_CEDULA, NOMBRE, CTO_CONVENIO,FECHA_DILIGENCIAMIENTO,";
        $sql .= " FECHA_APROBACION, ESTADO, TO_CHAR(FECHA_GIRO, 'YYYY-MM-DD') AS FECHA_GIRO, PLANILLA, ORDEN_PAGO, BRUTO, VALOR_GIRADO,";
        $sql .= " DETALLE, NOMBRE_BANCO, CUENTA_BANCO_RECEPTOR";
        $sql .= " FROM ogt_v_consulta_pagos_web";
		$sql .= " WHERE CTO_CONVENIO = '".$contrato."'";
		$sql .= " AND CUENTA_BANCO_RECEPTOR = '".$cuenta."'";	
		$sql .= " ORDER BY FECHA_GIRO DESC";
	
        $query = $this->db->query($sql);		
	    return $query->result();  	
    }*/
    public function busca_registros_ced_xls($tipo_ident,$cedula) {
        $sql = " SELECT ANIO_GRAVABLE, TIPO_IDENTIFICACION, NUM_IDENTIFICACION, NOMBRE_RAZON_SOCIAL, BASE_GRAVABLE_NETA, TOTAL_INGRESOS_BRUTOS_X_DISTRITO,";
        $sql .= " DEDUCCIONES_EXENCIONES_ACN, VALOR_RETEN_INDUSYCOMERCIO";     
        $sql .= " FROM contratista_ica";
        $sql .= " WHERE NUM_IDENTIFICACION = '".$cedula."'";
        $sql .= " AND TIPO_IDENTIFICACION = '".$tipo_ident."'";

         $query = $this->db->query($sql);	
        return array("query" => $query);	


    }		
		

   /*  public function traer_cuenta_ced($cedula) {
        $sql = " SELECT CUENTA_BANCO_RECEPTOR FROM (SELECT DISTINCT A.CUENTA_BANCO_RECEPTOR ";
        $sql .= " FROM ogt_v_consulta_pagos_web A";
		$sql .= " WHERE  ROWNUM <=25 ";
		$sql .= " UNION SELECT DISTINCT B.CUENTA_BANCO_RECEPTOR ";
        $sql .= " FROM ogt_v_consulta_pagos_web B";
		$sql .= " WHERE B.NIT_CEDULA = '".$cedula."' AND CUENTA_BANCO_RECEPTOR IS NOT null)";
		$sql .= " ORDER BY dbms_random.value";
        $query = $this->db->query($sql);		
	    return $query->result();  	
    }

     public function traer_cuenta_con($contrato) {
        $sql = " SELECT CUENTA_BANCO_RECEPTOR FROM (SELECT DISTINCT A.CUENTA_BANCO_RECEPTOR ";
        $sql .= " FROM ogt_v_consulta_pagos_web A";
		$sql .= " WHERE  ROWNUM <=25 ";
		$sql .= " UNION SELECT DISTINCT B.CUENTA_BANCO_RECEPTOR ";
        $sql .= " FROM ogt_v_consulta_pagos_web B";
        $sql .= " WHERE B.CTO_CONVENIO = '".$contrato."' AND CUENTA_BANCO_RECEPTOR IS NOT null)";			
		$sql .= " ORDER BY dbms_random.value";
        $query = $this->db->query($sql);		
	    return $query->result();  	
    }

    public function traer_cuentas() {
        $sql = " SELECT DISTINCT CUENTA_BANCO_RECEPTOR";
        $sql .= " FROM ogt_v_consulta_pagos_web";
		$sql .= " WHERE ROWNUM <= 25 ";
		$sql .= " ORDER BY dbms_random.value";			
        $query = $this->db->query($sql);
	    return $query->result();  	
    }

      public function trae_n_cedula($cedula, $cuenta) {
        $sql = " SELECT DISTINCT NOMBRE";
        $sql .= " FROM ogt_v_consulta_pagos_web";
		$sql .= " WHERE NIT_CEDULA = '".$cedula."'";	
        $sql .= " AND CUENTA_BANCO_RECEPTOR = '".$cuenta."'";     	
        $query = $this->db->query($sql);
	    return $query->result();  	
    }

      public function trae_n_contrato($contrato, $cuenta) {
        $sql = " SELECT DISTINCT NOMBRE";
        $sql .= " FROM ogt_v_consulta_pagos_web";
		$sql .= " WHERE CTO_CONVENIO = '".$contrato."'";		
        $sql .= " AND CUENTA_BANCO_RECEPTOR = '".$cuenta."'";  
        $query = $this->db->query($sql);
	    return $query->result();  	
    }*/
	
	
}