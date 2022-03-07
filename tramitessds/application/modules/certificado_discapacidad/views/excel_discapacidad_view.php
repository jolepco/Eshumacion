<?php

$datos = "";
$datos .= "Id Trámite; Código RLCPD; Estado; Fecha registro; Tipo IDentificacion; No. Identificcion; Nombres Solicitante; E-mail; Teléfono fijo; Teléfono celular; Ciudad Residencia; Direccion Residencia; Localidad; Nivel Educativo; Sexo; Fecha de Nacimiento; Regimen Especial; Física; Mental; Psicológica; Múltiple; Auditiva; Visual; Sordo ceguera; Cognitiva; Modalidad; Dispositivo moviliza; Otro moviliza; Dispositivo cominica; Otro comunica; Requiere acompañante; Vive con persona con discapacidad; IPS; Nombre cuidador; Documento cuidador; E-mail cuidador; Teléfono cuidador; Celular cuidador;";
$datos .= "\r\n";


$total_registros = count($listado_soli);

for($i=0;$i<$total_registros;$i++){
	$observ = trim(preg_replace('/\s+/', ' ', $listado_soli[$i]->observaciones_h));
	$datos .= $listado_soli[$i]->id_tramite.";";
	$datos .= $listado_soli[$i]->cod_autorizacion.";";
	$datos .= $listado_soli[$i]->est_tramite.";";
	$datos .= $listado_soli[$i]->fecha_registro.";";
	$datos .= $listado_soli[$i]->nom_identificacion.";";
	$datos .= $listado_soli[$i]->nume_identificacion.";";
	$datos .= $listado_soli[$i]->p_nombre." ".$listado_soli[$i]->s_nombre." ".$listado_soli[$i]->p_apellido." ".$listado_soli[$i]->s_apellido.";";
	$datos .= $listado_soli[$i]->email.";";
	$datos .= $listado_soli[$i]->telefono_fijo.";";
	$datos .= $listado_soli[$i]->telefono_celular.";";
	$datos .= $listado_soli[$i]->ciudad_residencia.";";
	$datos .= $listado_soli[$i]->dire_resi.";";
	$datos .= $listado_soli[$i]->localidad.";";
	$datos .= $listado_soli[$i]->nom_educativo.";";
	$datos .= $listado_soli[$i]->descripcion_sexo.";";
	$datos .= $listado_soli[$i]->fecha_nacimiento.";";
	$datos .= $listado_soli[$i]->regimen_esp.";";
	$datos .= $listado_soli[$i]->categoria_1.";";
	$datos .= $listado_soli[$i]->categoria_2.";";
	$datos .= $listado_soli[$i]->categoria_3.";";
	$datos .= $listado_soli[$i]->categoria_4.";";
	$datos .= $listado_soli[$i]->categoria_5.";";
	$datos .= $listado_soli[$i]->categoria_6.";";
	$datos .= $listado_soli[$i]->categoria_7.";";
	$datos .= $listado_soli[$i]->categoria_8.";";
	$datos .= $listado_soli[$i]->nom_modalidad.";";
	$datos .= $listado_soli[$i]->dis_moviliza.";";
	$datos .= $listado_soli[$i]->cual_moviliza.";";
	$datos .= $listado_soli[$i]->dis_comunica.";";
	$datos .= $listado_soli[$i]->cual_comunica.";";
	$datos .= $listado_soli[$i]->req_acompanante.";";
	$datos .= $listado_soli[$i]->vive_persona.";";
	$datos .= $listado_soli[$i]->nombre_ips.";";
	$datos .= $listado_soli[$i]->cu_pnombre." ".$listado_soli[$i]->cu_snombre." ".$listado_soli[$i]->cu_papellido." ".$listado_soli[$i]->cu_sapellido.";";
	$datos .= $listado_soli[$i]->cu_numdoc.";";
	$datos .= $listado_soli[$i]->cu_email.";";
	$datos .= $listado_soli[$i]->cu_telefono.";";
	$datos .= $listado_soli[$i]->cu_celular.";";
	
	$datos .= "\r\n";
}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>