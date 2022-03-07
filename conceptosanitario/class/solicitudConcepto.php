<?php

include_once '../conf/conexion.php';

/**
 * 
 */
class SolicitudConcepto {

    public $conexion;
    public $fecha_inscripcion, $numero_inscripcion;
    public $codigo;
    public $matricula_mercantil;
    public $tiene_matricula;
    public $tipo_persona;
    public $razon_social;
    public $nit;
    public $nombre_establecimiento;
    public $direccion;
    public $localidad;
    public $upz;
    public $barrio;
    public $telefono;
    public $celular;
    public $fk_ciudad;
    public $correo;
    public $representante_legal;
    public $fk_tipo_doc;
    public $documento;
    public $table = 'solicitud_concepto';
    public $direccion_notif;
    public $direccion_not_electronica;
    public $fk_ciudad_notif;
    public $autoriza_notf_email;
    public $codigoAct_econPrincipal;
    public $visita_previa;
    public $numero_actavisita;
    public $fecha_ultimaInspeccion;
    public $concepto_sanit;
    public $observaciones;
    public $cod_actecon1;
    public $cod_actecon2;
    public $cod_actecon3;
    public $cod_actecon4;

    function __construct() {
        $con = new conexion();
        $this->conexion = $con->conectar();
    }
    /**
     * 
     * @return listado de establecimientos
     */
    function tipoestablecimien() {
        $sql = " SELECT * FROM tipos_establecimientos order by nombre asc";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            return $result;
        } else {
            echo 'Error!!!' . mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
    /**
     * 
     * @return listado de ciudades
     */
    function listciudades() {
        $sql = " SELECT idciudad,nombre FROM ciudades ";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            return $result;
        } else {
            echo 'Error!!!' . mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
    /**
     * @guarda los registros en la BD
     * @return ultimo id insertado en la tabla solicitudes para realizar el consumo del web service y hacer la 
     * radicación de la solicitud en SIVIGILA
     */
    function insert() {
        $sql = " INSERT INTO $this->table(fecha_inscripcion,num_inscripcion, codigo,tiene_matricula,";
        $sql .= "matricula_mercantil,tipo_persona,razon_social,nit,nombre_establecimiento,";
        $sql .= " direccion,localidad,upz,barrio,telefono,celular,fk_ciudad,correo,representante_legal,";
        $sql .= " fk_tipo_doc,documento, direccion_notif,direccion_not_electronica,";
        $sql .= "fk_ciudad_notif, autoriza_notf_email,codigoAct_econPrincipal,visita_previa,";
        if($this->fecha_ultimaInspeccion!=''){
        $sql .= " fecha_ultimaInspeccion,";
        }
        $sql .= " numero_actavisita,";
        $sql .= "concepto_sanit, observaciones,cod_actecon1,cod_actecon2,cod_actecon3,cod_actecon4";
        $sql .= ") VALUES (";
        $sql .= "'$this->fecha_inscripcion',";
        $sql .= "'$this->numero_inscripcion',";
        $sql .= "'$this->codigo','$this->tiene_matricula',";
        $sql .= " '$this->matricula_mercantil',";
        $sql .= "'$this->tipo_persona','$this->razon_social',";
        $sql .= "'$this->nit','$this->nombre_establecimiento',";
        $sql .= "'$this->direccion','$this->localidad',";
        $sql .= "'$this->upz','$this->barrio',";
        $sql .= "'$this->telefono',";
        $sql .= "'$this->celular','$this->fk_ciudad_notif',";
        $sql .= "'$this->correo','$this->representante_legal',";
        $sql .= "'$this->fk_tipo_doc','$this->documento',";
        $sql .= "'$this->direccion_notif','$this->direccion_not_electronica',";
        $sql .= "'$this->fk_ciudad_notif','$this->autoriza_notf_email',";
        $sql .= "'$this->codigoAct_econPrincipal','$this->visita_previa',";
        //$sql.= "'".$this->fecha_ultimaInspeccion."',";
        if($this->fecha_ultimaInspeccion !=''){
        $sql .= "" .($this->fecha_ultimaInspeccion!=''?"'".$this->fecha_ultimaInspeccion."'":'null').',';
        }
        $sql .= "'$this->numero_actavisita',"; 
        $sql .= "'$this->concepto_sanit','$this->observaciones',";
        #$sql .= "'$this->cod_actecon1','$this->cod_actecon2',";
        #$sql .= "'$this->cod_actecon3','$this->cod_actecon4'";
        $sql .= " " . ($this->cod_actecon1 != '' ? "'" . $this->cod_actecon1 . "'" : 'null');
        $sql .= ", " . ($this->cod_actecon2 != '' ? "'" . $this->cod_actecon2 . "'" : 'null');
        $sql .= ", " . ($this->cod_actecon3 != '' ? "'" . $this->cod_actecon3 . "'" : 'null');
        $sql .= ", " . ($this->cod_actecon4 != '' ? "'" . $this->cod_actecon4 . "'" : 'null');

        # $sql.= ", " . ($this->date_end != '' ? "'".$this->db->idate($this->date_end)."'" : 'null');
        $sql .= ")"; 
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $this->id = mysqli_insert_id($this->conexion);
            return $this->id;
        } else {
            echo mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }

    /**
     * * obtener información por id de la solicitud;
     * */
    function fetchId($id) {
        $sql = " SELECT * FROM $this->table as c";
        /* $sql .= " LEFT JOIN tipos_establecimientos AS te ON te.idtipo=c.codigoAct_econPrincipal";
          $sql .= " LEFT JOIN tipos_establecimientos AS te1 ON te1.idtipo=c.cod_actecon1";
          $sql .= " LEFT JOIN tipos_establecimientos AS te2 ON te2.idtipo=c.cod_actecon2";
          $sql .= " LEFT JOIN tipos_establecimientos AS te3 ON te3.idtipo=c.cod_actecon3";
          $sql .= " LEFT JOIN tipos_establecimientos AS te4 ON te4.idtipo=c.cod_actecon4"; */
        $sql .= " LEFT JOIN tipo_documento AS td on td.idtipo_documento=c.fk_tipo_doc";
        $sql .= " WHERE c.id=$id";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
          // return $row= mysqli_fetch_array($result);
            // if (mysqli_fetch_row($result)) {
            $obj = mysqli_fetch_object($result);
            $this->fecha_inscripcion = $obj->fecha_inscripcion;
            $this->numero_inscripcion = $obj->num_inscripcion;
            $this->codigo = $obj->codigo;
            $this->matricula_mercantil = $obj->matricula_mercantil;
            $this->tiene_matricula = $obj->tiene_matricula;
            $this->tipo_persona = $obj->tipo_persona;
            $this->razon_social = $obj->razon_social;
            $this->nit = $obj->nit;
            $this->nombre_establecimiento = $obj->nombre_establecimiento;
            $this->direccion = $obj->direccion;
            $this->localidad = $obj->localidad;
            $this->upz = $obj->upz;
            $this->barrio = $obj->barrio;
            $this->telefono = $obj->telefono;
            $this->celular = $obj->celular;
            $this->fk_ciudad = $obj->fk_ciudad;
            $this->correo = $obj->correo;
            $this->representante_legal = $obj->representante_legal;
            $this->fk_tipo_doc = $obj->fk_tipo_doc;
            $this->abrev = $obj->abrev;
            $this->documento = $obj->documento;
            $this->direccion_notif = $obj->direccion_notif;
            $this->direccion_not_electronica = $obj->direccion_not_electronica;
            $this->fk_ciudad_notif = $obj->fk_ciudad_notif;
            $this->autoriza_notf_email = $obj->autoriza_notf_email;
            $this->codigoAct_econPrincipal = $obj->codigoAct_econPrincipal;
            $this->visita_previa = $obj->visita_previa;
            $this->numero_actavisita = $obj->numero_actavisita;
            $this->fecha_ultimaInspeccion = $obj->fecha_ultimaInspeccion;
            $this->concepto_sanit = $obj->concepto_sanit;
            $this->observaciones = $obj->observaciones;
            $this->cod_actecon1 = $obj->cod_actecon1;
            $this->cod_actecon2 = $obj->cod_actecon2;
            $this->cod_actecon3 = $obj->cod_actecon3;
            $this->cod_actecon4 = $obj->cod_actecon4;
            // }
        } else {
            echo "Error!!!" . mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }

    function TipoDocu() {
        $sql = "SELECT * FROM tipo_documento WHERE activo=1";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            return $result;
        } else {
            echo mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
    /**
     * 
     * @return listado de localidades 
     */
    function select_localidad() {
        $sql = " SELECT * FROM localidades";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            echo '<option></option>';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $obj = mysqli_fetch_object($result);
                echo '<option value="' . $obj->idlocalidad . '">' . $obj->codigo_loc . ' ' . utf8_encode($obj->nombre_loc) . '</option>';
            }
        } else {
            return mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
    /**
     * 
     * @param  $idlocalidad
     * @return listado upz correspondientes a una localidad
     */
    function select_upz($idlocalidad) {
        $sql = " SELECT idupz,nombre_upz,codigo_upz FROM upz WHERE fk_idlocalidad=$idlocalidad";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            echo '<option></option>';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $object = mysqli_fetch_object($result);
                print '<option value="' . $object->idupz . '">' . $object->codigo_upz . ' ' . utf8_encode($object->nombre_upz) . '</option>';
            }
        } else {
            echo mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
    /**
     * 
     * @param type $idupz
     * @return listado de barrios correspondientes a upz
     */
    function select_barrio($idupz) {
        $sql = " SELECT nombre_barrio,codigo_barrio FROM barrios WHERE fk_upz=$idupz";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            echo '<option></option>';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $object = mysqli_fetch_object($result);
                echo '<option value="' . $object->codigo_barrio . '">' . $object->nombre_barrio . '</option>';
            }
        } else {
            return mysqli_error($this->conexion);
        }
        mysqli_close($this->conexion);
    }
     
    
    /***
     * funcion que permite extraer la fecha por partes y mostrarla en español
     */
    function fechaCastellano($fecha1) {
        $fe=str_replace("/", "-", $fecha1);
        $fech = new DateTime($fe);
        $fecha = $fech->format("Y/m/d");
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombreMes . " de " . $anio;
    }

    /**
     * 
     * @param type $concepto
     * Funcion para mostrar la respuesta al ciudadano segun el tipo de concepto obtenido en la solicitud de la visita
     */

    function defConcepto($concepto) {

        if ($concepto == "CF") {
            echo "Favorable";
        } elseif ($concepto == "CD") {
            echo "Desfavorable ";
        } elseif ($concepto== "CFR") {
            echo "Favorable con requerimientos ";
        } else {
            echo "Pendiente ";
        }
    }

}
