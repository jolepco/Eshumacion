<?php
$datos = "";
$datos .= "Direccionterritorial;Resolucion;fechaexpedicion;Fecharenovacion;Razon Social;Nit;técnico;Tecnólogo;profso;profesionmedico;profesioningeniero;profesionpsicologo;Profesión otro; Especialista; Maestría; Doctorado; Campo de acción;";
$datos .= "";
$datos .= "\r\n";


foreach($listado_per as $l){

    $campos_aprobados = $this->reportes_model->campos_accion_pj($l->id_tramite);
   
    //Informacion de la consulta.
    $datos .= "11;";
    $datos .= $l->id_resolucion.";";
    $datos .= $l->fecha_estado.";";

    if($l->tipo_tramite == 3){
        $datos .= $l->fecha_estado.";";
    }else{
        $datos .= ";";
    }
    
    $datos .= $l->nombre_rs.";";
    $datos .= $l->nume_identificacion.";";
    
    

    $datos .= ";";
    $datos .= ";";
    $datos .= ";";
    $datos .= ";";
    $datos .= ";";
    $datos .= ";";
    
    $datos .= ";";

    $datos .= ";";
    $datos .= ";";
    $datos .= ";";

    if($campos_aprobados != NULL){
        $campos = "";
        for($ca=0;$ca<count($campos_aprobados);$ca++){
            $campos .= $campos_aprobados[$ca]->desc_campo." - ";
        }
        $datos .= $campos.";";

    }else{
        $datos .= ";";
    }
    
    
    
     $datos .= "\r\n";
    
    
 }


echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>