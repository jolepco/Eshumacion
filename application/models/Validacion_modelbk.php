<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class validacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function rayosx_pendientes(){
        $cadena_sql = " SELECT id_registro, RX.id_persona, RX.fecha_tramite, ET.descripcion descEstado, TI.Descripcion descTipoIden , PE.*
        FROM registro_rayosx RX
        JOIN persona PE ON PE.id_persona = RX.id_persona
        JOIN pr_rayosx_estado_tramite ET ON ET.id_estado = RX.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        WHERE estado IN (1)";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }



    public function tramites_pendientes(){
        $cadena_sql = " SELECT id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
        RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado, TI.Descripcion descTipoIden ,PE.*
        FROM registro_titulo RT
        JOIN persona PE ON PE.id_persona = RT.id_persona
        JOIN pr_estado_tramite ET ON ET.id_estado = RT.estado
        JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
        WHERE estado IN (1,8,17) ORDER BY RT.fecha_tramite ASC";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Aprobados.
    public function tramites_aprobados($fechai,$fechaf){
		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
        $cadena_sql = "SELECT rt.id_titulo,val2.id_estado_tramite,RT.fecha_tramite,
		val2.fecha fecha_resolucion,rt.estado,val2.id_estado_tramite, 
		 TI.descripcion as descTipoIden, PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo, 
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,	
		PE.fecha_nacimiento, RT.estado, PROG.nombre_programa, INST.nombre_institucion, RT.cod_universidad, 
		RT.titulo_equivalente, EST.descripcion as descEstado, rest.id_resolucion
		
		FROM resoluciones_titulo as rest,validacion_titulos val2, registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		LEFT JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE VAL2.id_titulo = RT.id_titulo AND rEST.id_titulo = RT.id_titulo";

        if($fechai !="" && $fechaf!=""){
          $cadena_sql.=" AND VAL2.fecha BETWEEN '$fechai' AND '$fechaf 23:59' GROUP BY rt.id_titulo,val2.id_estado_tramite HAVING val2.id_estado_tramite=14 and val2.id_estado_tramite not in (6,5)";
        }
        else {
          $cadena_sql.="  AND VAL2.fecha BETWEEN '$fec2' AND '$fecha2 23:59' GROUP BY rt.id_titulo,val2.id_estado_tramite HAVING val2.id_estado_tramite=14 and val2.id_estado_tramite not in (6,5) ";
        }

        //var_dump($cadena_sql);
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Rechazados.
    public function tramites_rechazados($fechai,$fechaf){

		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
        $cadena_sql = "SELECT rt.id_titulo, seg.estado, RT.fecha_tramite,
        seg.fecha_registro as fecha_seguimiento,
		seg.observaciones,
        TI.descripcion as descTipoIden,
		PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo,
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,

		PE.fecha_nacimiento, PROG.nombre_programa, INST.nombre_institucion, RT.cod_universidad, 
		RT.titulo_equivalente, EST.descripcion as descEstado
		
		FROM seguimiento_tramite seg, registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		LEFT JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE seg.id_titulo = RT.id_titulo and seg.estado=13 and rt.estado not in (14,7,11) and rt.id_persona not in (2550,3810,4897)";

        if($fechai !="" && $fechaf!=""){
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fechai' AND '$fechaf 23:59' ";
        }
        else {
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' ";
        }

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Negados.
    public function tramites_negados($fechai,$fechaf){
		
		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
        $cadena_sql = "SELECT rt.id_titulo, seg.estado, RT.fecha_tramite,
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,
		
        (SELECT seg2.fecha_registro 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as fecha_seguimiento,
		(SELECT seg2.observaciones 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as observaciones,
		rt.estado,TI.descripcion as descTipoIden, 
		PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo, PE.fecha_nacimiento, RT.estado, PROG.nombre_programa, INST.nombre_institucion, RT.cod_universidad, 
		RT.titulo_equivalente, EST.descripcion as descEstado
		
		FROM seguimiento_tramite seg, registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		LEFT JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE seg.id_titulo = RT.id_titulo";
		
		
        if($fechai !="" && $fechaf!=""){
          $cadena_sql.="  AND seg.fecha_registro BETWEEN '$fechai' AND '$fechaf 23:59' GROUP BY rt.id_titulo,seg.estado,rt.estado HAVING rt.estado=7 and seg.estado in (6)";
        }
        else {
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' GROUP BY rt.id_titulo,seg.estado,rt.estado HAVING rt.estado=7 and seg.estado in (6)";
        }
		
		
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Anulados.
    public function tramites_anulados($fechai,$fechaf){
		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
        $cadena_sql = "SELECT rt.id_titulo, seg.estado, RT.fecha_tramite,
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,

        (SELECT seg2.fecha_registro 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as fecha_seguimiento,
		(SELECT seg2.observaciones 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as observaciones,
		rt.estado,TI.descripcion as descTipoIden, 
		PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo, PE.fecha_nacimiento, RT.estado, PROG.nombre_programa, INST.nombre_institucion, RT.cod_universidad, 
		RT.titulo_equivalente, EST.descripcion as descEstado
		
		FROM seguimiento_tramite seg, registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE seg.id_titulo = RT.id_titulo";

        if($fechai !="" && $fechaf!=""){
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fechai' AND '$fechaf 23:59'	GROUP BY rt.id_titulo HAVING rt.estado=16";
        }
        else {
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' GROUP BY rt.id_titulo HAVING rt.estado=16";
        }

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }
	
		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Solicitados.
    public function tramites_solicitados($fechai,$fechaf){
		
		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
		
        $cadena_sql = "SELECT rt.id_titulo, RT.fecha_tramite,
		rt.estado,TI.descripcion as descTipoIden, 
		PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo,
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,

		PE.fecha_nacimiento, PROG.nombre_programa, INST.nombre_institucion, EST.descripcion as descEstado, RT.cod_universidad, RT.titulo_equivalente
		
		FROM registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		LEFT JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE ";

        if($fechai !="" && $fechaf!=""){
          $cadena_sql.=" rt.fecha_tramite BETWEEN '$fechai' AND '$fechaf 23:59' GROUP BY rt.id_titulo ";
        }
        else {
          $cadena_sql.=" rt.fecha_tramite BETWEEN '$fec2' AND '$fecha2 23:59' GROUP BY rt.id_titulo ";
        }

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }	
	
	
		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 14062019
		//Metodo bandeja tramites Recurso.
    public function tramites_recurso($fechai,$fechaf){
		
		$fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
		
        $cadena_sql = "SELECT rt.id_titulo, seg.estado, RT.fecha_tramite,
		
		CASE
			WHEN PE.genero = 1 THEN 'Masculino'
			WHEN PE.genero = 2 THEN 'Femenino'
			WHEN PE.genero = 3 THEN 'Transgenero'
			WHEN PE.genero = 4 THEN 'No responde'
			ELSE '-'
		END as genero,
		CASE
			WHEN PE.orientacion = 1 THEN 'Heterosexual'
			WHEN PE.orientacion = 2 THEN 'Homosexual'
			WHEN PE.orientacion = 3 THEN 'Bisexual'
			ELSE '-'
		END as orientacion,
		CASE
			WHEN PE.etnia = 1 THEN 'Indigena'
			WHEN PE.etnia = 2 THEN 'Rom-Gitano'
			WHEN PE.etnia = 3 THEN 'Raizal'
			WHEN PE.etnia = 4 THEN 'Palenquero'
			WHEN PE.etnia = 5 THEN 'Afrocolombiano'
			WHEN PE.etnia = 6 THEN 'Ninguna'
			ELSE '-'
		END as etnia,
		CASE
			WHEN PE.estado_civil = 1 THEN 'Soltero'
			WHEN PE.estado_civil = 2 THEN 'Casado'
			WHEN PE.estado_civil = 3 THEN 'Union marital de hecho'
			WHEN PE.estado_civil = 4 THEN 'Divorciado'
			WHEN PE.estado_civil = 5 THEN 'Viudo'
			ELSE '-'
		END as estado_civil,
		CASE
			WHEN PE.nivel_educativo = 1 THEN 'Primaria'
			WHEN PE.nivel_educativo = 2 THEN 'Secundaria'
			WHEN PE.nivel_educativo = 3 THEN 'Técnico'
			WHEN PE.nivel_educativo = 4 THEN 'Tecnólogo'
			WHEN PE.nivel_educativo = 5 THEN 'Profesional'
			WHEN PE.nivel_educativo = 6 THEN 'Especialista'
			WHEN PE.nivel_educativo = 7 THEN 'Maestria'
			WHEN PE.nivel_educativo = 8 THEN 'Doctorado'
			WHEN PE.nivel_educativo = 9 THEN 'Post-Doctorado'
			WHEN PE.nivel_educativo = 10 THEN 'Ninguno'
			ELSE '-'
		END as nivel_educativo,

        (SELECT seg2.fecha_registro 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as fecha_seguimiento,
		(SELECT seg2.observaciones 
		FROM seguimiento_tramite as seg2
		WHERE seg2.id_titulo = RT.id_titulo
		ORDER BY 1 DESC LIMIT 1) as observaciones,
		rt.estado,TI.descripcion as descTipoIden, 
		PE.nume_identificacion, PE.p_apellido, PE.s_apellido, PE.p_nombre, PE.s_nombre,
		CASE
			WHEN RT.tipo_titulo = 1 THEN 'Nacional'
			WHEN RT.tipo_titulo = 2 THEN 'Extranjero'
		END as tipo_titulo, PE.fecha_nacimiento, RT.estado, PROG.nombre_programa, INST.nombre_institucion, RT.cod_universidad, 
		RT.titulo_equivalente, EST.descripcion as descEstado
		
		FROM seguimiento_tramite seg, registro_titulo rt
		JOIN persona as PE on RT.id_persona = PE.id_persona
		JOIN pr_tipoidentificacion TI ON TI.IdTipoIdentificacion = PE.tipo_identificacion
		LEFT JOIN pr_programas_univ PROG ON PROG.id_programa = RT.profesion
		LEFT JOIN pr_institucion INST ON INST.id_institucion = RT.institucion_educativa
		JOIN pr_estado_tramite EST ON RT.estado = EST.id_estado
		WHERE seg.id_titulo = RT.id_titulo";

		
        if($fechai !="" && $fechaf!=""){
          $cadena_sql.="  AND seg.fecha_registro BETWEEN '$fechai' AND '$fechaf 23:59' GROUP BY rt.id_titulo,seg.estado HAVING rt.estado=14 and seg.estado in (10)";
        }
        else {
          $cadena_sql.=" AND seg.fecha_registro BETWEEN '$fec2' AND '$fecha2 23:59' GROUP BY rt.id_titulo,seg.estado HAVING rt.estado=14 and seg.estado in (10)";
        }
		

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function todos_los_tramites(){
        $cadena_sql = " SELECT *
        FROM todos_los_tramites
        ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function tramites_pendientes_id($id_titulo){
	    $cadena_sql = " SELECT id_titulo, RT.id_persona, RT.fecha_tramite, RT.tipo_titulo, RT.institucion_educativa as institucion_educativa2, RT.profesion, RT.fecha_term, RT.tarjeta, RT.diploma, RT.acta,
		RT.libro, RT.folio, RT.anio, RT.cod_universidad, RT.fecha_term_ext, RT.resolucion, RT.fecha_resolucion, RT.entidad, RT.titulo_equivalente, RT.pais_tituloequi,
        RT.pdf_documento, RT.pdf_titulo, RT.pdf_acta, RT.pdf_tarjeta, RT.pdf_resolucion, RT.estado, ET.descripcion descEstado,  TI.Descripcion descTipoIden ,PE.*
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

    public function tramites_seguimiento_id($id_titulo){
	    $cadena_sql = " SELECT *
        FROM seguimiento_tramite SEG 
        WHERE SEG.estado = 13 AND SEG.id_titulo = ".$id_titulo;

	    $query = $this->db->query($cadena_sql);
        $result = $query->result();
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
        $cadena_sql = " SELECT  id_estado, descripcion FROM pr_estado_tramite WHERE id_estado IN (2,5,9,13,16) ";

        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function estado_tramite_validador_rx(){
        $cadena_sql = " SELECT  id_estado, descripcion FROM pr_rayosx_estado_tramite WHERE id_estado IN (2,3) ";

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
        $cadena_sql = " SELECT  id_causal, desc_causal FROM pr_causales_negacion WHERE id_causal = ".$id_causal." ";
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

    public function actualizarEstado($datos) {

        $data = array(
            'estado' => $datos['estado']
        );
        $this->db->where('id_titulo', $datos['id_titulo']);
        return $this->db->update('registro_titulo', $data);
    }

    public function actualizarDatosPersona($datos) {

        $data = array(
            'tipo_identificacion' => $datos['tipo_identificacion'],
            //'nume_identificacion' => $datos['nume_documento'],
            'p_nombre' => $datos['p_nombre'],
            's_nombre' => $datos['s_nombre'],
            'p_apellido' => $datos['p_apellido'],
            's_apellido' => $datos['s_apellido'],
            'email' => $datos['email'],
            'telefono_fijo' => $datos['telefono_fijo'],
			
			'fecha_nacimiento' => $datos['fecha_nacimiento'],
			'sexo' => $datos['sexo'],
			'genero' => $datos['genero'],
			'orientacion' => $datos['orientacion'],
			'etnia' => $datos['etnia'],
			'estado_civil' => $datos['estado_civil'],
			'nivel_educativo' => $datos['nivel_educativo'],
			
            'telefono_celular' => $datos['telefono_celular'],
			
			'nacionalidad' => $datos['nacionalidad'],
			
			'departamento' => $datos['departamento'],
			'ciudad_nacimiento' => $datos['ciudad_nacimiento'],

   			'depa_resi' => $datos['depa_resi'],
			'ciudad_resi' => $datos['ciudad_resi']
			
        );
        $this->db->where('id_persona', $datos['id_persona']);
        return $this->db->update('persona', $data);
    }

    public function actualizarDatosTitulo($datos) {

        $data = array(
            'institucion_educativa' => $datos['institucion_educativa'],
            'profesion' => $datos['profesion'],
            'fecha_term' => $datos['fecha_term'],
            'tarjeta' => $datos['tarjeta'],
            'diploma' => $datos['diploma'],
            'acta' => $datos['acta'],
            'libro' => $datos['libro'],
            'folio' => $datos['folio'],
            'anio' => $datos['anio'],
            'cod_universidad' => $datos['cod_universidad'],
            'fecha_term_ext' => $datos['fecha_term_ext'],
            'resolucion' => $datos['resolucion'],
            'fecha_resolucion' => $datos['fecha_resolucion'],
            'entidad' => $datos['entidad'],
            'titulo_equivalente' => $datos['titulo_equivalente'],
			'pais_tituloequi' => $datos['pais_tituloequi']
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
        $this->db->where('id_validacion', $datos['id_validacion']);
        return $this->db->update('validacion_titulos', $data);
    }

    public function registrarSeguimiento($param) {
        $this->db->trans_start();
        $this->db->insert('seguimiento_tramite', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }


    public function buscar_resolucion($id_titulo){
        $cadena_sql = " SELECT id_resolucion, rt.anio, rt.codi_tramite, rt.id_titulo, rt.id_archivo, rt.codigo_verificacion, ar.id_archivo, ar.ruta, ar.nombre
                        FROM resoluciones_titulo rt
                        JOIN archivos ar ON ar.id_archivo = rt.id_archivo
                        WHERE id_titulo = ".$id_titulo."";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    public function buscar_validacion($id_titulo, $estado){
        $cadena_sql = " SELECT id_seguimiento, st.fecha_registro, st.observaciones, st.id_usuario, us.username
                        FROM seguimiento_tramite st
                        JOIN usuarios us ON us.id = st.id_usuario
                        WHERE st.id_titulo = ".$id_titulo." AND st.estado = ".$estado." ";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }


}
