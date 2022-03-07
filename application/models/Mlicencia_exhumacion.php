<?php

class Mlicencia_Exhumacion extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Registrar solicitud lucencia exhumacion
     * @Exhumacion
     * @ura
     */
    function registrarSolicitudLicencia($parametros) {

        $datos = array(
            'tipo_tramiteexh' => $parametros['tipotramiteexh'],
            'id_persona' => $parametros['id_persona'],
            'fecha_solicitud' => $parametros['fecha_solicitud'],
            'numero_licencia' => $parametros['numero_licencia'],
            'estado' => $parametros['estado'],
            'parentesco' => $parametros['parentesco'],
            'fecha_inhumacion' => $parametros['fecha_inhumacion'],
			      'interviene_medlegal' => $parametros['interviene_medlegal'],
            'declaracion_juramentada' => $parametros['declaracion_juramentada']
        );


        if (isset($parametros['numero_regdefuncion'])){
          if($parametros['numero_regdefuncion'] != 0) {
            $datos['numero_regdefuncion'] = $parametros['numero_regdefuncion'];
          }
        }else{
            $datos['numero_regdefuncion'] = NULL;
        }

        if (isset($parametros['numero_docfallecido'])){
          if($parametros['numero_docfallecido'] != 0) {
            $datos['numero_docfallecido'] = $parametros['numero_docfallecido'];
          }
        }else{
            $datos['numero_docfallecido'] = NULL;
        }


        if (isset($parametros['pdf_cedulasolicitante'])){
          if($parametros['pdf_cedulasolicitante'] != 0) {
            $datos['pdf_cedulasolicitante'] = $parametros['pdf_cedulasolicitante'];
          }
        }else{
            $datos['pdf_cedulasolicitante'] = NULL;
        }

        if (isset($parametros['pdf_certificadocementerio'])){
          if($parametros['pdf_certificadocementerio'] != 0) {
            $datos['pdf_certificadocementerio'] = $parametros['pdf_certificadocementerio'];
          }
        }else{
            $datos['pdf_certificadocementerio'] = NULL;
        }

        if (isset($parametros['pdf_ordenjudicial'])){
          if($parametros['pdf_ordenjudicial'] != 0) {
            $datos['pdf_ordenjudicial'] = $parametros['pdf_ordenjudicial'];
          }
        }else{
            $datos['pdf_ordenjudicial'] = NULL;
        }

        if (isset($parametros['pdf_autorizacionfiscal'])){
          if($parametros['pdf_autorizacionfiscal'] != 0) {
            $datos['pdf_autorizacionfiscal'] = $parametros['pdf_autorizacionfiscal'];
          }
        }else{
            $datos['pdf_autorizacionfiscal'] = NULL;
        }

        if (isset($parametros['pdf_otro'])){
          if($parametros['pdf_otro'] != 0) {
            $datos['pdf_otro'] = $parametros['pdf_otro'];
          }
        }else{
            $datos['pdf_otro'] = NULL;
        }

        if (isset($parametros['pdf_documentorl'])){
          if($parametros['pdf_documentorl'] != 0) {
            $datos['pdf_documentorl'] = $parametros['pdf_documentorl'];
          }
        }else{
            $datos['pdf_documentorl'] = NULL;
        }

        if (isset($parametros['pdf_nombramientorl'])){
          if($parametros['pdf_nombramientorl'] != 0) {
            $datos['pdf_nombramientorl'] = $parametros['pdf_nombramientorl'];
          }
        }else{
            $datos['pdf_nombramientorl'] = NULL;
        }

        if (isset($parametros['pdf_edipto'])){
          if($parametros['pdf_edipto'] != 0) {
            $datos['pdf_edipto'] = $parametros['pdf_edipto'];
          }
        }else{
            $datos['pdf_edipto'] = NULL;
        }

        if (isset($parametros['pdf_licenciainhumacion'])){
          if($parametros['pdf_licenciainhumacion'] != 0) {
            $datos['pdf_licenciainhumacion'] = $parametros['pdf_licenciainhumacion'];
          }
        }else{
            $datos['pdf_licenciainhumacion'] = NULL;
        }


        if (isset($parametros['tipo_identificacionfallecido'])){
          if($parametros['tipo_identificacionfallecido'] != NULL) {
            $datos['tipo_identificacionfallecido'] = $parametros['tipo_identificacionfallecido'];
          }
        }else{
            $datos['tipo_identificacionfallecido'] = NULL;
        }

        if (isset($parametros['otrodocumentofallecido'])){
          if($parametros['otrodocumentofallecido'] != NULL) {
            $datos['otrodocumentofallecido'] = $parametros['otrodocumentofallecido'];
          }
        }else{
            $datos['otrodocumentofallecido'] = NULL;
        }

        if (isset($parametros['nume_documentofallecido'])){
          if($parametros['nume_documentofallecido'] != 0) {
            $datos['nume_documentofallecido'] = $parametros['nume_documentofallecido'];
          }
        }else{
            $datos['nume_documentofallecido'] = NULL;
        }

        if (isset($parametros['tienenombrefallecido'])){
            $datos['tienenombrefallecido'] = $parametros['tienenombrefallecido'];
        }else{
            $datos['tienenombrefallecido'] = NULL;
        }

        if (isset($parametros['aliasfallecido'])){
          if($parametros['aliasfallecido'] != NULL) {
            $datos['aliasfallecido'] = $parametros['aliasfallecido'];
          }
        }else{
            $datos['aliasfallecido'] = NULL;
        }

        if (isset($parametros['p_nombrefallecido'])){
          if($parametros['p_nombrefallecido'] != NULL) {
            $datos['p_nombrefallecido'] = $parametros['p_nombrefallecido'];
          }
        }else{
            $datos['p_nombrefallecido'] = NULL;
        }

        if (isset($parametros['s_nombrefallecido'])){
          if($parametros['s_nombrefallecido'] != NULL) {
            $datos['s_nombrefallecido'] = $parametros['s_nombrefallecido'];
          }
        }else{
            $datos['s_nombrefallecido'] = NULL;
        }

        if (isset($parametros['p_apellidofallecido'])){
          if($parametros['p_apellidofallecido'] != NULL) {
            $datos['p_apellidofallecido'] = $parametros['p_apellidofallecido'];
          }
        }else{
            $datos['p_apellidofallecido'] = NULL;
        }

        if (isset($parametros['s_apellidofallecido'])){
          if($parametros['s_apellidofallecido'] != NULL) {
            $datos['s_apellidofallecido'] = $parametros['s_apellidofallecido'];
          }
        }else{
            $datos['s_apellidofallecido'] = NULL;
        }

        if (isset($parametros['restosfuerabgta'])){
            $datos['restosfuerabgta'] = $parametros['restosfuerabgta'];
        }else{
            $datos['restosfuerabgta'] = NULL;
        }

        if (isset($parametros['depa_cementerio'])){
          if($parametros['depa_cementerio'] != 0) {
            $datos['depa_cementerio'] = $parametros['depa_cementerio'];
          }
        }else{
            $datos['depa_cementerio'] = NULL;
        }

        if (isset($parametros['ciudad_cementerio'])){
          if($parametros['ciudad_cementerio'] != 0) {
            $datos['ciudad_cementerio'] = $parametros['ciudad_cementerio'];
          }
        }else{
            $datos['ciudad_cementerio'] = NULL;
        }

        if (isset($parametros['nombrecementerio'])){
          if($parametros['nombrecementerio'] != NULL) {
            $datos['nombrecementerio'] = $parametros['nombrecementerio'];
          }
        }else{
            $datos['nombrecementerio'] = NULL;
        }


        $this->db->insert('licencia_exhuma', $datos);
        return $this->db->insert_id();
    }

    /**
     * listado de tramites de licencia exhumacion
     * solicitados por el usuario
     * @param type $id_persona
     * @return type
     */
    public function mistramites_exh($id_persona) {
        $sql = "SELECT e.des_estado,l.* FROM licencia_exhuma as l, persona as p,estado_tramite_licenciaExh as e
              where p.id_persona=l.id_persona and l.estado=e.id_estado and l.id_persona=$id_persona and estado IN(1,2,3,4,5,6,7,8)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * listado de solicitudes de licencia exhumacion
     * @return type
     */
    public function listadotramites_exhumacion() {
        $sql = "SELECT * FROM licencia_exhuma as l ";
        $sql .= " LEFT JOIN  archivos AS a ON a.id_archivo=l.pdf_cedulasolicitante";
        $sql .= " LEFT JOIN archivos a1 ON a1.id_archivo=l.pdf_certificadocementerio";
        $sql .= " LEFT JOIN archivos a2 ON a2.id_archivo=l.pdf_certificado_per4";
        $sql .= " LEFT JOIN archivos a3 ON a3.id_archivo=l.pdf_certificado_per3";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /*     * listado solicitudes exhumacion general
     *
     * @return type
     */
    public function listadosolicitudesExh() {
        $sql = "SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,l.* FROM licencia_exhuma as l, persona as p
              where p.id_persona=l.id_persona and l.id_persona=p.id_persona";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * listado solicitudes para la gestion del coordinador
     * @return type
     */

     public function listadosolicitudesExh_dire() {
         $sql = "SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.* FROM licencia_exhuma as l, persona as p,
               estado_tramite_licenciaExh as e
               where p.id_persona=l.id_persona and l.id_persona=p.id_persona and l.estado=e.id_estado and estado IN(7)";
         $query = $this->db->query($sql);
         $result = $query->result();
         return $result;
     }


    public function listadosolicitudesExh_coor() {
        $sql = "SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.* FROM licencia_exhuma as l, persona as p,
              estado_tramite_licenciaExh as e
              where p.id_persona=l.id_persona and l.id_persona=p.id_persona and l.estado=e.id_estado and estado IN(3,8)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * listado solicitudes para la gestion del validador
     * @return type
     */
    public function listadosolicitudesExh_vali() {
        $sql = "SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.* FROM licencia_exhuma as l, persona as p,
              estado_tramite_licenciaExh as e
              where p.id_persona=l.id_persona and l.id_persona=p.id_persona and l.estado=e.id_estado and estado IN(1,6)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * informacio solicitud exhumacion por idsolicitud
     * @param type $id
     * @return type
     */
    public function exhumacionfetch($id) {
        $sql = " SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,p.nombre_rs,p.tipo_iden_rl,p.nume_iden_rl, interviene_medlegal, es.des_estado,group_concat(n.observaciones) observaciones,l.* FROM licencia_exhuma as l ";
        $sql .= " LEFT JOIN persona as p ON p.id_persona=l.id_persona ";
        $sql .= " LEFT JOIN estado_tramite_licenciaExh as es ON es.id_estado=l.estado ";
        $sql .= "LEFT JOIN notificacion_exh as n on n.idlicencia_exhumacion=l.idlicencia_exhumacion";
        $sql .= " WHERE  l.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    public function exhumacionfetchaprob($id) {
        $sql = " SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,p.nombre_rs,p.tipo_iden_rl,p.nume_iden_rl, l.interviene_medlegal, es.des_estado,group_concat(n.observaciones) observaciones, a.revisado, a.aprobado, a.aprobadocoord, a.nombre_difunto, a.num_docdifunto, a.num_certdefunsion, a.cementerio, a.num_licencia_inhumacion, a.fecha_inhumacion as fech_inh, a.observaciones as observacionesint, a.id_archivo, a.numero_verificacion, a.estado_apro ,l.* FROM aprobacion_licencia as a JOIN licencia_exhuma as l ON a.idlicencia_exhumacion = l.idlicencia_exhumacion";
        $sql .= " LEFT JOIN persona as p ON p.id_persona=l.id_persona ";
        $sql .= " LEFT JOIN estado_tramite_licenciaExh as es ON es.id_estado=l.estado ";
        $sql .= "LEFT JOIN notificacion_exh as n on n.idlicencia_exhumacion=l.idlicencia_exhumacion";
        $sql .= " WHERE  l.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }



    /*COdigo fuente para busqueda de documentos persona juridica por: mebeltran@saludcapital.gov.co*/
    public function busquedadocumentosRL($id_usuario) {
        $sql = " SELECT l.* FROM licencia_exhuma as l ";
        $sql .= " LEFT JOIN estado_tramite_licenciaExh as es ON es.id_estado=l.estado ";
        $sql .= "LEFT JOIN notificacion_exh as n on n.idlicencia_exhumacion=l.idlicencia_exhumacion";
        $sql .= " WHERE  l.id_persona=$id_usuario ORDER BY idlicencia_exhumacion DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    /**
     * funcion que permite actualizar la solicitud del tramite
     * @param type $parametros
     * @return type
     */
    public function actualizarTramiteExh($parametros) {

        $datos = array(
            'id_persona' => $parametros['id_persona'],
            'tipo_tramiteexh' => $parametros['tipo_tramiteexh'],
            'numero_licencia' => $parametros['numero_licencia'],
            'estado' => $parametros['estado'],
            'parentesco' => $parametros['parentesco'],
            'fecha_inhumacion' => $parametros['fecha_inhumacion'],
            'interviene_medlegal' => $parametros['interviene_medlegal']
            );

            if (isset($parametros['numero_regdefuncion'])){
              if($parametros['numero_regdefuncion'] != 0) {
                $datos['numero_regdefuncion'] = $parametros['numero_regdefuncion'];
              }
            }else{
                $datos['numero_regdefuncion'] = NULL;
            }

            if (isset($parametros['numero_docfallecido'])){
              if($parametros['numero_docfallecido'] != 0) {
                $datos['numero_docfallecido'] = $parametros['numero_docfallecido'];
              }
            }else{
                $datos['numero_docfallecido'] = NULL;
            }

            if (isset($parametros['pdf_cedulasolicitante'])){
              if($parametros['pdf_cedulasolicitante'] != 0) {
                $datos['pdf_cedulasolicitante'] = $parametros['pdf_cedulasolicitante'];
              }
            }else{
                $datos['pdf_cedulasolicitante'] = NULL;
            }

            if (isset($parametros['pdf_certificadocementerio'])){
              if($parametros['pdf_certificadocementerio'] != 0) {
                $datos['pdf_certificadocementerio'] = $parametros['pdf_certificadocementerio'];
              }
            }else{
                $datos['pdf_certificadocementerio'] = NULL;
            }

            if (isset($parametros['pdf_ordenjudicial'])){
              if($parametros['pdf_ordenjudicial'] != 0) {
                $datos['pdf_ordenjudicial'] = $parametros['pdf_ordenjudicial'];
              }
            }else{
                $datos['pdf_ordenjudicial'] = NULL;
            }

            if (isset($parametros['pdf_autorizacionfiscal'])){
              if($parametros['pdf_autorizacionfiscal'] != 0) {
                $datos['pdf_autorizacionfiscal'] = $parametros['pdf_autorizacionfiscal'];
              }
            }else{
                $datos['pdf_autorizacionfiscal'] = NULL;
            }

            if (isset($parametros['pdf_otro'])){
              if($parametros['pdf_otro'] != 0) {
                $datos['pdf_otro'] = $parametros['pdf_otro'];
              }
            }else{
                $datos['pdf_otro'] = NULL;
            }

            if (isset($parametros['pdf_documentorl'])){
              if($parametros['pdf_documentorl'] != 0) {
                $datos['pdf_documentorl'] = $parametros['pdf_documentorl'];
              }
            }else{
                $datos['pdf_documentorl'] = NULL;
            }

            if (isset($parametros['pdf_nombramientorl'])){
              if($parametros['pdf_nombramientorl'] != 0) {
                $datos['pdf_nombramientorl'] = $parametros['pdf_nombramientorl'];
              }
            }else{
                $datos['pdf_nombramientorl'] = NULL;
            }

            if (isset($parametros['pdf_edipto'])){
              if($parametros['pdf_edipto'] != 0) {
                $datos['pdf_edipto'] = $parametros['pdf_edipto'];
              }
            }else{
                $datos['pdf_edipto'] = NULL;
            }

            if (isset($parametros['pdf_licenciainhumacion'])){
              if($parametros['pdf_licenciainhumacion'] != 0) {
                $datos['pdf_licenciainhumacion'] = $parametros['pdf_licenciainhumacion'];
              }
            }else{
                $datos['pdf_licenciainhumacion'] = NULL;
            }


            if (isset($parametros['tipo_identificacionfallecido'])){
              if($parametros['tipo_identificacionfallecido'] != NULL) {
                $datos['tipo_identificacionfallecido'] = $parametros['tipo_identificacionfallecido'];
              }
            }else{
                $datos['tipo_identificacionfallecido'] = NULL;
            }

            if (isset($parametros['otrodocumentofallecido'])){
              if($parametros['otrodocumentofallecido'] != 0) {
                $datos['otrodocumentofallecido'] = $parametros['otrodocumentofallecido'];
              }
            }else{
                $datos['otrodocumentofallecido'] = NULL;
            }

            if (isset($parametros['nume_documentofallecido'])){
              if($parametros['nume_documentofallecido'] != 0) {
                $datos['nume_documentofallecido'] = $parametros['nume_documentofallecido'];
              }
            }else{
                $datos['nume_documentofallecido'] = NULL;
            }

            if (isset($parametros['tienenombrefallecido'])){
                $datos['tienenombrefallecido'] = $parametros['tienenombrefallecido'];
            }else{
                $datos['tienenombrefallecido'] = NULL;
            }

            if (isset($parametros['aliasfallecido'])){
              if($parametros['aliasfallecido'] != NULL) {
                $datos['aliasfallecido'] = $parametros['aliasfallecido'];
              }
            }else{
                $datos['aliasfallecido'] = NULL;
            }

            if (isset($parametros['p_nombrefallecido'])){
              if($parametros['p_nombrefallecido'] != NULL) {
                $datos['p_nombrefallecido'] = $parametros['p_nombrefallecido'];
              }
            }else{
                $datos['p_nombrefallecido'] = NULL;
            }

            if (isset($parametros['s_nombrefallecido'])){
              if($parametros['s_nombrefallecido'] != NULL) {
                $datos['s_nombrefallecido'] = $parametros['s_nombrefallecido'];
              }
            }else{
                $datos['s_nombrefallecido'] = NULL;
            }

            if (isset($parametros['p_apellidofallecido'])){
              if($parametros['p_apellidofallecido'] != NULL) {
                $datos['p_apellidofallecido'] = $parametros['p_apellidofallecido'];
              }
            }else{
                $datos['p_apellidofallecido'] = NULL;
            }

            if (isset($parametros['s_apellidofallecido'])){
              if($parametros['s_apellidofallecido'] != NULL) {
                $datos['s_apellidofallecido'] = $parametros['s_apellidofallecido'];
              }
            }else{
                $datos['s_apellidofallecido'] = NULL;
            }

            if (isset($parametros['restosfuerabgta'])){
                $datos['restosfuerabgta'] = $parametros['restosfuerabgta'];
            }else{
                $datos['restosfuerabgta'] = NULL;
            }

            if (isset($parametros['depa_cementerio'])){
              if($parametros['depa_cementerio'] != 0) {
                $datos['depa_cementerio'] = $parametros['depa_cementerio'];
              }
            }else{
                $datos['depa_cementerio'] = NULL;
            }

            if (isset($parametros['ciudad_cementerio'])){
              if($parametros['ciudad_cementerio'] != 0) {
                $datos['ciudad_cementerio'] = $parametros['ciudad_cementerio'];
              }
            }else{
                $datos['ciudad_cementerio'] = NULL;
            }

            if (isset($parametros['nombrecementerio'])){
              if($parametros['nombrecementerio'] != NULL) {
                $datos['nombrecementerio'] = $parametros['nombrecementerio'];
              }
            }else{
                $datos['nombrecementerio'] = NULL;
            }



        $this->db->where('idlicencia_exhumacion', $parametros['idlicencia_exhumacion']);
        return $this->db->update('licencia_exhuma', $datos);
    }

    /*     * *
     * func consultar archivo generado para la lcencia
     */
    public function consultar_archivo($id_archivo) {
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
                        WHERE id_archivo = " . $id_archivo . " ";
        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }


    /**
     * Infoemacion correspondiente con la aprobacion de la licencia
     * @param type $id
     * @return type
     */
    function info_aprobacionlicencia($id) {
        $sql = "SELECT p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.nombre_rs,l.*,a.* FROM aprobacion_licencia as a";
        $sql .= " LEFT JOIN licencia_exhuma as l ON l.idlicencia_exhumacion=a.idlicencia_exhumacion";
        $sql .= " LEFT JOIN persona as p ON p.id_persona=l.id_persona";
        #$sql.= " LEFT JOIN usuarios as u ON u.id=a.aprobado";
        $sql .= " WHERE a.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }


    function info_licencia($id) {
        $sql = " SELECT p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.nombre_rs,l.* FROM licencia_exhuma as l ";
        $sql .= " JOIN persona as p ON p.id_persona=l.id_persona";
        #$sql.= " LEFT JOIN usuarios as u ON u.id=a.aprobado";
        $sql .= " WHERE l.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    /**
     * fincion para conocer el funcionario que realizo la gestion
     * @param type $id
     * @return type
     */
    function usuarios($id) {
        $sql .= "SELECT p.* from persona p";
        $sql .= " LEFT JOIN usuarios u on u.id_persona=p.id_persona";
        $sql .= " LEFT JOIN aprobacion_licencia as ap on  ap.aprobado=u.id  WHERE ap.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function sesionU($id) {
        $sql .= "SELECT p.* from persona p";
        $sql .= " LEFT JOIN usuarios u on u.id_persona=p.id_persona";
        $sql .= " WHERE u.id=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }


    function consultaUsuario($id) {
        $sql = "SELECT p.* from persona p";
        $sql .= " LEFT JOIN usuarios u on u.id_persona=p.id_persona";
        $sql .= " WHERE u.id=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    /**
     * funcion para conocer el funcionario que realizo la gestion
     * @param type $id
     * @return type
     */
    function usuariosReviso($id) {
        $sql = "SELECT p.* from persona p";
        $sql .= " LEFT JOIN usuarios u on u.id_persona=p.id_persona";
        $sql .= " LEFT JOIN aprobacion_licencia as ap on ap.revisado=u.id WHERE ap.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function usuariosAprobo($id) {
        $sql = "SELECT p.* from persona p";
        $sql .= " LEFT JOIN usuarios u on u.id_persona=p.id_persona";
        $sql .= " LEFT JOIN aprobacion_licencia as ap on ap.aprobadocoord=u.id WHERE ap.idlicencia_exhumacion=$id";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    /**
     * funcion para actualizar el estado del tramite
     * @param type $datos
     * @return type
     */
    public function actualizarEstado($datos) {

        $data = array(
            'estado' => $datos['estado']
        );
        $this->db->where('idlicencia_exhumacion', $datos['idlicencia_exhumacion']);
        return $this->db->update('licencia_exhuma', $data);
    }

    /**
     * funcion para actualizar el estado del tramite
     * @param type $datos
     * @return type
     */
    public function actualizarDatos($datos) {
        $data = array(
            'nombre_difunto' => $datos['nombre_difunto'],
            'cementerio' => $datos['cementerio'],
        );
       $this->db->where('idlicencia_exhumacion', $datos['idlicencia_exhumacion']);
        return $this->db->update('aprobacion_licencia', $data);
    }

    /**
     * guardar la informacion corespondiente con las notificaciones al ciudadano
     * @param type $param
     * @return type
     */
    public function registrarNotificacion($param) {
        $this->db->trans_start();
        $this->db->insert('notificacion_exh', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    /**
     * funcion para guardar los documentos
     * @param type $param
     * @return type
     */
    public function insertarArchivo($param) {
        $this->db->trans_start();
        $this->db->insert('archivos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    /**
     * guardar la informacion correspondiente con la aporvacion de la licencia
     * @param type $param
     * @return type
     */
    public function registro_aprobacionlicencia($param) {
        $this->db->trans_start();
        $this->db->insert('aprobacion_licencia', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    /**
     * funcion que permite actualizar la aprobacion de la licencia
     * @param type $parametros
     * @return type
     */
    public function actualizarAprobacionLicencia($parametros) {
        $datos = array(
            'aprobadocoord' => $parametros['aprobadocoord'],
            'numero_lic_exhu' => $parametros['numero_lic_exhu'],
            'fecha_aprob' => $parametros['fecha_aprob'],
            'nombre_difunto' => $parametros['nombre_difunto'],
            'cementerio' => $parametros['cementerio'],
            'num_licencia_inhumacion' => $parametros['num_licencia_inhumacion'],
            'fecha_inhumacion' => $parametros['fecha_inhumacion'],
            'numero_verificacion' => $parametros['numero_verificacion'],
            'observaciones' => $parametros['observaciones'],
            'estado_apro' => $parametros['estado_apro']
        );

        if (isset($parametros['revisado'])){
          if($parametros['revisado'] != 0) {
            $datos['revisado'] = $parametros['revisado'];
          }
        }
       $this->db->where('idlicencia_exhumacion', $parametros['idlicencia_exhumacion']);
      # $this->db->where('idaprobacion', $parametros['idaprobacion']);
        return $this->db->update('aprobacion_licencia', $datos);
    }

    /**
     * funcion para actualizar un archivo
     * @param type $datos
     * @return type
     */
    public function actualizar_id_archivo($datos) {

        $data = array(
            'id_archivo' => $datos['id_archivo']
        );
        $this->db->where('idlicencia_exhumacion', $datos['idlicencia_exhumacion']);
        return $this->db->update('aprobacion_licencia', $data);
    }

    /* $estado
      AND RE.id_titulo = ".$id_titulo."";
     * archivo preliminar de licencia ques e le otorga al solicitante
     *  */
    public function archivo_preliminar($id) {
        $cadena_sql = " SELECT DISTINCT
                        a.id_archivo,
                        AR.nombre
                    FROM aprobacion_licencia a
                    JOIN archivos AR ON AR.id_archivo = a.id_archivo
                    WHERE a.idlicencia_exhumacion =$id";

        $query = $this->db->query($cadena_sql);
        $result = $query->row();
        return $result;
    }

    /**
     * consulta vista de oracle donde se encuentra la informaciòn relacionada con un difunto
     * con los parametros de numero inhumacion y fecha inhumacion
     * @param type $datos
     * @return type
     */
    public function informacion_oracle($datos) {
        $fecha = new DateTime($datos->fecha_inhumacion);
        $fechaN = $fecha->format('d/m/Y');
		//var_dump($fechaN);
		//exit;
        $oracle = $this->load->database('oracle', TRUE);

        $cadena_sql = "SELECT INH_NUM_LICENCIA,to_char(INH_FEC_LICENCIA, 'YYYY-MM-DD') INH_FEC_LICENCIA,
                            FETAL_Y_NO_FETAL, PRIMER_NOMBRE, SEGUNDO_NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, NROIDENT,
                            NUM_CERTIFICADO_DEFUNCION, CEMENTERIO, TIPO_MUERTE, TIPO_IDENT, COD_INST, RADICADO, RAZON_INST
                        FROM V_MUERTOS ";
        $cadena_sql .= " WHERE INH_NUM_LICENCIA =" . $datos->numero_licencia;
        $cadena_sql .= " AND INH_FEC_LICENCIA ='$fechaN'";

        $query = $oracle->query($cadena_sql);        //var_dump($cadena_sql);var_dump($fechaN);
        $result = $query->row();

        return $result;
    }

    /**
     * consulta vista de oracle donde se encuentra la informaciòn relacionada con un difunto
     * con los parametros de numero inhumacion y fecha inhumacion
     * @param type $datos
     * @return type
     */
    public function validacionUsuario_oracle($numeroL, $fecha) {
        $fecha1 = new DateTime($fecha);
        $fechaN = $fecha1->format('d/m/Y');
        $oracle = $this->load->database('oracle', TRUE);
        $cadena_sql = " SELECT INH_NUM_LICENCIA,to_char(INH_FEC_LICENCIA, 'YYYY-MM-DD') INH_FEC_LICENCIA,
                            FETAL_Y_NO_FETAL, PRIMER_NOMBRE, SEGUNDO_NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, NROIDENT,
                            NUM_CERTIFICADO_DEFUNCION, CEMENTERIO, TIPO_MUERTE, TIPO_IDENT, COD_INST, RADICADO, RAZON_INST
                        FROM V_MUERTOS ";
        $cadena_sql .= " WHERE INH_NUM_LICENCIA =" . $numeroL;
        $cadena_sql .= " AND INH_FEC_LICENCIA ='$fechaN'";
        $query = $oracle->query($cadena_sql);
        $result = $query->row();
        if (isset($result)) {
            echo $result->INH_NUM_LICENCIA;
            exit();
        }
    }


    public function validacionFuncionario_oracle($numeroL, $fecha) {
        $fecha1 = new DateTime($fecha);
        $fechaN = $fecha1->format('d/m/Y');
        $oracle = $this->load->database('oracle', TRUE);
        $cadena_sql = " SELECT INH_NUM_LICENCIA,to_char(INH_FEC_LICENCIA, 'YYYY-MM-DD') INH_FEC_LICENCIA,
                            FETAL_Y_NO_FETAL, PRIMER_NOMBRE, SEGUNDO_NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, NROIDENT,
                            NUM_CERTIFICADO_DEFUNCION, CEMENTERIO, TIPO_MUERTE, TIPO_IDENT, COD_INST, RADICADO, RAZON_INST
                        FROM V_MUERTOS ";
        $cadena_sql .= " WHERE INH_NUM_LICENCIA =" . $numeroL;
        $cadena_sql .= " AND INH_FEC_LICENCIA ='$fechaN'";
        $query = $oracle->query($cadena_sql);
        $result = $query->row();
		    return $result;
    }
    /**
     *
     * @param type $numeroLINH
     * @param type $fecha INH
     */
    public function informacionLEXH_oracle($datos) {
        $fecha = new DateTime($datos->fecha_inhumacion);
        $fechaN = $fecha->format('d/m/Y');
        $oracle = $this->load->database('oracle', TRUE);

        $cadena_sql = " SELECT INH_NUM_LICENCIA,to_char(INH_FEC_LICENCIA,'YYYY-MM-DD') INH_FEC_LICENCIA,
                            FETAL_Y_NO_FETAL, EXH_NUM_LICENCIA, EXH_FEC_LICENCIA FROM v_muertos_exh ";
        $cadena_sql .= " WHERE INH_NUM_LICENCIA =" . $datos->numero_licencia;
        $cadena_sql .= " AND INH_FEC_LICENCIA ='$fechaN'";
        $cadena_sql .= " ORDER BY  EXH_FEC_LICENCIA DESC";

        $query = $oracle->query($cadena_sql);
        $result = $query->row();

        return $result;
    }

    /**
     * Infoemacion correspondiente con la aprobacion de la licencia
     * @param type $id
     * @return type
     */
    function info_aprobacionL($datos) {
        $sql = "SELECT a.* FROM aprobacion_licencia as a";
        $sql .= " WHERE a.num_licencia_inhumacion=" . $datos->numero_licencia;
        $sql .= " and a.fecha_inhumacion='$datos->fecha_inhumacion' AND estado_apro=4";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function info_aprobacionLAccess($datos) {
        $sql = "SELECT a.* FROM lexh_backupaccess as a";
        $sql .= " WHERE a.NRO_LIC_INHUMAC=" . $datos->numero_licencia;
        $sql .= " and a.FEC_LIC_INHUMAC='$datos->fecha_inhumacion'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    /**
     *
     * @param type $fechai fecha inicial
     * @param type $fechaf fecha fin
     * @param type $numlicExh numero lic exhumacion
     * @return type
     */
function listarSolicitudesLE($fechai, $fechaf) {
        $fec1 = date("Y-m-d");
        $fec = strtotime('-1 month', strtotime($fec1));
        $fec2 = date('Y-m-d', $fec);
        $fecha = strtotime('+1 day', strtotime($fec1));
        $fecha2 = date('Y-m-d', $fecha);
        $sql = "SELECT l.idlicencia_exhumacion idap,l.fecha_solicitud,l.fecha_inhumacion as fechaI,l.numero_regdefuncion,l.numero_licencia,l.parentesco,la.numero_lic_exhu,";
		
        $sql.=" la.fecha_aprob,la.nombre_difunto,la.cementerio,la.numero_verificacion,la.id_archivo, ne.estado estado_apro,l.numero_docfallecido,";
        $sql.=" est.des_estado estadoNotif, el.des_estado,
                    p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido,p.s_apellido,ne.observaciones obs,";
        $sql .= " ne.fecha_registro ,pe.p_nombre pnom_funcionario,pe.s_nombre snom_funcionario,pe.p_apellido pape_funcionario,pe.s_apellido sape_funcionario";
        $sql .= " ,pval.p_nombre pnom_val,pval.s_nombre snom_val,";
        $sql .= " pval.p_apellido pape_val,pval.s_apellido sape_val ";
        $sql .= ",paprob.p_nombre pnom_aprob,paprob.s_nombre snom_aprob,";
        $sql .= "paprob.p_apellido pape_aprob,paprob.s_apellido sape_aprob, ";
		$sql .= "CASE
					WHEN P.genero = 1 THEN 'Masculino'
					WHEN P.genero = 2 THEN 'Femenino'
					WHEN P.genero = 3 THEN 'Transgenero'
					WHEN P.genero = 4 THEN 'No responde'
					ELSE '-'
				END as genero,
				CASE
					WHEN P.orientacion = 1 THEN 'Heterosexual'
					WHEN P.orientacion = 2 THEN 'Homosexual'
					WHEN P.orientacion = 3 THEN 'Bisexual'
					ELSE '-'
				END as orientacion,
				CASE
					WHEN P.etnia = 1 THEN 'Indigena'
					WHEN P.etnia = 2 THEN 'Rom-Gitano'
					WHEN P.etnia = 3 THEN 'Raizal'
					WHEN P.etnia = 4 THEN 'Palenquero'
					WHEN P.etnia = 5 THEN 'Afrocolombiano'
					WHEN P.etnia = 6 THEN 'Ninguna'
					ELSE '-'
				END as etnia,
				CASE
					WHEN P.estado_civil = 1 THEN 'Soltero'
					WHEN P.estado_civil = 2 THEN 'Casado'
					WHEN P.estado_civil = 3 THEN 'Union marital de hecho'
					WHEN P.estado_civil = 4 THEN 'Divorciado'
					WHEN P.estado_civil = 5 THEN 'Viudo'
					ELSE '-'
				END as estado_civil,
				CASE
					WHEN P.nivel_educativo = 1 THEN 'Primaria'
					WHEN P.nivel_educativo = 2 THEN 'Secundaria'
					WHEN P.nivel_educativo = 3 THEN 'Técnico'
					WHEN P.nivel_educativo = 4 THEN 'Tecnólogo'
					WHEN P.nivel_educativo = 5 THEN 'Profesional'
					WHEN P.nivel_educativo = 6 THEN 'Especialista'
					WHEN P.nivel_educativo = 7 THEN 'Maestria'
					WHEN P.nivel_educativo = 8 THEN 'Doctorado'
					WHEN P.nivel_educativo = 9 THEN 'Post-Doctorado'
					WHEN P.nivel_educativo = 10 THEN 'Ninguno'
					ELSE '-'
				END as nivel_educativo,	
				P.fecha_nacimiento";
        $sql .= " FROM licencia_exhuma l ";
        $sql .= " LEFT JOIN persona as p ON p.id_persona=l.id_persona";
        $sql .= " LEFT JOIN estado_tramite_licenciaexh est ON est.id_estado=l.estado";
        $sql .= " LEFT JOIN aprobacion_licencia la ON la.idlicencia_exhumacion=l.idlicencia_exhumacion";
        $sql .= " LEFT JOIN notificacion_exh ne ON ne.idlicencia_exhumacion=l.idlicencia_exhumacion ";
        $sql .= " LEFT JOIN estado_tramite_licenciaexh el ON el.id_estado=ne.estado";
        $sql .= " LEFT JOIN usuarios as u on u.id=ne.id_usuario ";
        $sql .= " LEFT JOIN persona pe ON pe.id_persona=u.id_persona";
        $sql .= " LEFT JOIN usuarios us on us.id=la.revisado ";
        $sql .= " LEFT JOIN persona as pval on pval.id_persona=us.id_persona";
        $sql .= " LEFT JOIN usuarios usc on usc.id=la.aprobado";
        $sql .= " LEFT JOIN persona paprob  on paprob.id_persona=usc.id_persona";
               if ($fechai != "" && $fechaf != "")
            $sql .= " WHERE l.fecha_solicitud BETWEEN '$fechai' AND '$fechaf 23:59' ";
        else
            $sql .= "  WHERE l.fecha_solicitud BETWEEN '$fec2' AND '$fecha2 23:59' ";
        $sql .= "ORDER BY l.idlicencia_exhumacion"; //echo $sql;exit;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    function idAprobacionLE($id){
        $sql=" SELECT idaprobacion FROM aprobacion_licencia WHERE idlicencia_exhumacion=$id";
        $query =$this->db->query($sql);
        $result = $query->row();
        if (isset($result)) {
            return $result->idaprobacion;
        }
        $this->db->close();

    }

    function numLicenciaExh(){
        $query =$this->db->query("call PA_LICENCIA()");
        $result = $query->row();

        if (count($result) > 0) {
            return $result->NUMERO;
        }
       $query = null;
    }

	public function licenciaexh_seguimientociudadanano_id($id_licenciaexh){
	    $cadena_sql = " SELECT SEG.fecha_registro, USR.perfil, PER.p_apellido, PER.s_apellido, PER.p_nombre, PER.s_nombre, EST.descripcion, SEG.observaciones
        FROM notificacion_exh SEG
		JOIN usuarios USR ON USR.id = SEG.id_usuario
		LEFT JOIN persona PER ON PER.id_persona = USR.id_persona
		JOIN pr_estado_tramite EST ON EST.id_estado = SEG.estado
        WHERE SEG.estado in (2,5) AND SEG.idlicencia_exhumacion = ".$id_licenciaexh;

	    $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }


    public function actualizarDatosPersona($datos) {

        $data = array(
            'p_nombre' => $datos['p_nombre'],
            's_nombre' => $datos['s_nombre'],
            'p_apellido' => $datos['p_apellido'],
            's_apellido' => $datos['s_apellido'],
            'email' => $datos['email'],
            'telefono_fijo' => $datos['telefono_fijo'],
			      'telefono_celular' => $datos['telefono_celular'],

        );

        if(isset($datos['tipo_identificacionpj']) && $datos['tipo_identificacionpj']!= 0) {
            $data['tipo_identificacion'] = $datos['tipo_identificacionpj'];
        }else{
            $data['tipo_identificacion'] = $datos['tipo_identificacion'];
        }

        if(isset($datos['r_social']) && $datos['r_social']!= NULL) {
            $data['nombre_rs'] = $datos['r_social'];
        }

        $this->db->where('id_persona', $datos['id_persona']);
        return $this->db->update('persona', $data);
    }


	public function actualizarAuditoriaUsuario($datos) {

        $data = array(
            'id_llave' => $datos['id_persona'],
            //'nume_identificacion' => $datos['nume_documento'],
            'usuario' => $datos['id_usuario'],


        );
        $this->db->where('id_llave', $datos['id_persona']);
		    $this->db->where('tabla_nombre', 'persona');
		//var_dump($data);
		//exit;

        return $this->db->update('ts_auditoriapersona', $data);

    }


    public function actualizarDatosLicencia($datos) {

        $data = array(

            'interviene_medlegal' => $datos['interviene_medlegal'],

        );

        if(isset($datos['parentesco']) && $datos['parentesco']!= NULL) {
            $data['parentesco'] = $datos['parentesco'];
        }else{
            $data['parentesco'] = NULL;
        }

        if (isset($datos['numero_regdefuncion'])){
          if($datos['numero_regdefuncion'] != 0) {
            $data['numero_regdefuncion'] = $datos['numero_regdefuncion'];
          }
        }else{
            $data['numero_regdefuncion'] = NULL;
        }

        if (isset($datos['numero_docfallecido'])){
          if($datos['numero_docfallecido'] != 0) {
            $data['numero_docfallecido'] = $datos['numero_docfallecido'];
          }
        }else{
            $data['numero_docfallecido'] = NULL;
        }

        if (isset($datos['tipo_identificacionfallecido'])){
          if($datos['tipo_identificacionfallecido'] != NULL) {
            $data['tipo_identificacionfallecido'] = $datos['tipo_identificacionfallecido'];
          }
        }else{
            $data['tipo_identificacionfallecido'] = NULL;
        }

        if (isset($datos['otrodocumentofallecido'])){
          if($datos['otrodocumentofallecido'] != NULL) {
            $data['otrodocumentofallecido'] = $datos['otrodocumentofallecido'];
          }
        }else{
            $data['otrodocumentofallecido'] = NULL;
        }


          if(!empty($datos['nume_documentofallecido'])) {
            $data['nume_documentofallecido'] = $datos['nume_documentofallecido'];
          }else{
              $data['nume_documentofallecido'] = NULL;
          }

        if (isset($datos['tienenombrefallecido'])){
            $data['tienenombrefallecido'] = $datos['tienenombrefallecido'];
        }else{
            $data['tienenombrefallecido'] = NULL;
        }

        if (isset($datos['aliasfallecido'])){
          if($datos['aliasfallecido'] != NULL) {
            $data['aliasfallecido'] = $datos['aliasfallecido'];
          }
        }else{
            $data['aliasfallecido'] = NULL;
        }

        if (isset($datos['p_nombrefallecido'])){
          if($datos['p_nombrefallecido'] != NULL) {
            $data['p_nombrefallecido'] = $datos['p_nombrefallecido'];
          }
        }else{
            $data['p_nombrefallecido'] = NULL;
        }

        if (isset($datos['s_nombrefallecido'])){
          if($datos['s_nombrefallecido'] != NULL) {
            $data['s_nombrefallecido'] = $datos['s_nombrefallecido'];
          }
        }else{
            $data['s_nombrefallecido'] = NULL;
        }

        if (isset($datos['p_apellidofallecido'])){
          if($datos['p_apellidofallecido'] != NULL) {
            $data['p_apellidofallecido'] = $datos['p_apellidofallecido'];
          }
        }else{
            $data['p_apellidofallecido'] = NULL;
        }

        if (isset($datos['s_apellidofallecido'])){
          if($datos['s_apellidofallecido'] != NULL) {
            $data['s_apellidofallecido'] = $datos['s_apellidofallecido'];
          }
        }else{
            $data['s_apellidofallecido'] = NULL;
        }

        if (isset($datos['restosfuerabgta'])){
            $data['restosfuerabgta'] = $datos['restosfuerabgta'];
        }else{
            $data['restosfuerabgta'] = NULL;
        }

        if (isset($datos['depa_cementerio'])){
          if($datos['depa_cementerio'] != 0) {
            $data['depa_cementerio'] = $datos['depa_cementerio'];
          }
        }else{
            $data['depa_cementerio'] = NULL;
        }

        if (isset($datos['ciudad_cementerio'])){
          if($datos['ciudad_cementerio'] != 0) {
            $data['ciudad_cementerio'] = $datos['ciudad_cementerio'];
          }
        }else{
            $data['ciudad_cementerio'] = NULL;
        }

        if (isset($datos['nombrecementerio'])){
          if($datos['nombrecementerio'] != NULL) {
            $data['nombrecementerio'] = $datos['nombrecementerio'];
          }
        }else{
            $data['nombrecementerio'] = NULL;
        }


        $this->db->where('idlicencia_exhumacion', $datos['idlicencia_exhumacion']);
        return $this->db->update('licencia_exhuma', $data);
    }

    public function actualizarNumFecInhuma($datos) {

        $data = array(
            'numero_licencia' => $datos['numero_licencia'],
            'fecha_inhumacion' => $datos['fecha_inhumacion'],
        );
        $this->db->where('idlicencia_exhumacion', $datos['idlicencia_exhumacion']);
        return $this->db->update('licencia_exhuma', $data);
    }

    public function tramites_seguimientocompleto_id($id){
	    $cadena_sql = " SELECT SEG.fecha_registro, USR.perfil, PER.p_apellido, PER.s_apellido, PER.p_nombre, PER.s_nombre, EST.des_estado, SEG.observaciones
        FROM notificacion_exh SEG
		JOIN usuarios USR ON USR.id = SEG.id_usuario
		LEFT JOIN persona PER ON PER.id_persona = USR.id_persona
		JOIN estado_tramite_licenciaexh EST ON EST.id_estado = SEG.estado
        WHERE SEG.idlicencia_exhumacion = ".$id;

	    $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }


		//Author: Mario BeltrĂ¡n mebeltran@saludcapital.gov.co Since: 03092020
		//Metodo bandeja tramites exhumacion por Numero Documento.
    public function tramites_pornumdocexh($numdoc){
		$cadena_sql = "SELECT p.tipo_identificacion, td.Descripcion, p.nume_identificacion,p.p_nombre,p.s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.idlicencia_exhumacion,l.fecha_solicitud,l.parentesco
		FROM persona as p
		JOIN licencia_exhuma as l ON p.id_persona=l.id_persona
		JOIN pr_tipoidentificacion as td ON p.tipo_identificacion=td.IdTipoIdentificacion
		LEFT JOIN estado_tramite_licenciaexh as e ON l.estado = e.id_estado";
        //$cadena_sql = " SELECT *
        //FROM todos_los_tramites
        //";

        if($numdoc !=""){
          $cadena_sql.=" WHERE p.nume_identificacion =".$numdoc."";
        }
        else {
          $cadena_sql.=" WHERE p.nume_identificacion ='0'";
        }
		//SELECT p.tipo_identificacion,p.nume_identificacion,p.p_nombre,s_nombre,p.p_apellido, p.s_apellido,p.email,p.telefono_fijo,p.telefono_celular,e.des_estado,l.idlicencia_exhumacion,l.fecha_solicitud,l.parentesco FROM persona as p JOIN licencia_exhuma as l ON p.id_persona=l.id_persona LEFT JOIN estado_tramite_licenciaexh as e ON l.estado = e.id_estado WHERE p.nume_identificacion='60123123'
        //var_dump($cadena_sql);
		//exit;
        $query = $this->db->query($cadena_sql);
        $result = $query->result();
        return $result;
    }

    public function actualizarDatosPersonaExh($datos) {

      $data = array(

          'id_persona' => $datos['id_persona'],
          'tipo_iden_rl' => $datos['tipo_identificacionrl'],
          'nume_iden_rl' => $datos['nume_documentorl'],
          'p_nombre' => $datos['p_nombrerl'],
          's_nombre' => $datos['s_nombrerl'],
          'p_apellido' => $datos['p_apellidorl'],
          's_apellido' => $datos['s_apellidorl'],
          'email' => $datos['emailrl'],
          'nombre_rs' => $datos['razonsocial']

      );
      $this->db->where('id_persona', $datos['id_persona']);
      return $this->db->update('persona', $data);

    }


}

?>
