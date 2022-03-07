<?php
$datos = "";
$datos .= "Direccionterritorial;Resolucion;fechaexpedicion;Fecharenovacion;Nombre;Cedula;técnico;Tecnólogo;profso;profesionmedico;profesioningeniero;profesionpsicologo;Profesión otro; Especialista; Maestría; Doctorado; Campo de acción;";
$datos .= "";
$datos .= "\r\n";


foreach($listado_per as $l){

    $campos_aprobados = $this->reportes_model->campos_accion_pn($l->id_tramite);
   
    //Informacion de la consulta.
    $datos .= "11;";
    $datos .= $l->id_resolucion.";";
    $datos .= $l->fecha_estado.";";

    if($l->tipo_tramite == 3){
        $datos .= $l->fecha_estado.";";
    }else{
        $datos .= ";";
    }
    
    $datos .= $l->p_nombre." ".$l->s_nombre." ".$l->p_apellido." ".$l->s_apellido.";";
    $datos .= $l->nume_identificacion.";";
    
    if($l->tipo_programa == 4){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    if($l->tipo_programa == 3){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    if(($l->tipo_programa == 1 || $l->tipo_programa == 2) && $l->tipo_profesional == 4){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    if(($l->tipo_programa == 1 || $l->tipo_programa == 2) && $l->tipo_profesional == 1){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    if(($l->tipo_programa == 1 || $l->tipo_programa == 2) && $l->tipo_profesional == 3){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    if(($l->tipo_programa == 1 || $l->tipo_programa == 2) && $l->tipo_profesional == 2){
        $datos .= $l->titulo_programa.";";
    }else{
        $datos .= ";";
    }

    $datos .= ";";

    if($l->titulo_postgrado != ''){
        $datos .= $l->titulo_postgrado.";";
    }else{
        $datos .= ";";
    }
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