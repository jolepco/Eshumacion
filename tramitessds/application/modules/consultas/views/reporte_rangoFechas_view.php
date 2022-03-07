<?php

$datos = "";
$datos .= "id; user; estado; created_at; categoria; visita_previa; fecha_subsanacion1; fecha_subsanacion2; fecha_envio; fecha_estado; descEstado; descTipoIden ; tipo_identificacion; nume_identificacion; p_nombre; s_nombre; p_apellido; s_apellido; email; telefono_fijo; telefono_celular; nacionalidad; Nombre; departamento; Descripcion; ciudad_nacimiento; Descripcion; dire_resi; localidad; Nombre; upz; nom_upz; barrio; nombre_barrio; fecha_nacimiento; edad; sexo; descripcion_sexo; genero; orientacion; etnia; Nombre; estado_civil; Nombre; nivel_educativo; Nombre; tipo_iden_rl; nume_iden_rl; nombre_rs;";
$datos .= "\r\n";


$total_registros = count($listado);

for($i=0;$i<$total_registros;$i++){
	
	$datos .= $listado[$i]->id.";";
	$datos .= $listado[$i]->user.";";
	$datos .= $listado[$i]->estado.";";
	$datos .= $listado[$i]->created_at.";";
	$datos .= $listado[$i]->categoria.";";
	$datos .= $listado[$i]->visita_previa.";";
	$datos .= $listado[$i]->fecha_subsanacion1.";";
	$datos .= $listado[$i]->fecha_subsanacion2.";";
	$datos .= $listado[$i]->fecha_envio.";";
	$datos .= $listado[$i]->fecha_estado.";";
	$datos .= $listado[$i]->descEstado.";";
	$datos .= $listado[$i]->descTipoIden.";";
	$datos .= $listado[$i]->tipo_iden.";";
	$datos .= $listado[$i]->nume_identificacion.";";
	$datos .= $listado[$i]->p_nombre.";";
	$datos .= $listado[$i]->s_nombre.";";
	$datos .= $listado[$i]->p_apellido.";";
	$datos .= $listado[$i]->s_apellido.";";
	$datos .= $listado[$i]->email.";";
	$datos .= $listado[$i]->telefono_fijo.";";
	$datos .= $listado[$i]->telefono_celular.";";
	$datos .= $listado[$i]->nacionalidad.";";
	$datos .= $listado[$i]->nom_nacionalidad.";";
	$datos .= $listado[$i]->departamento.";";
	$datos .= $listado[$i]->nom_depto.";";
	$datos .= $listado[$i]->ciudad_nacimiento.";";
	$datos .= $listado[$i]->nom_mpio.";";
	$datos .= $listado[$i]->dire_resi.";";
	$datos .= $listado[$i]->localidad.";";
	$datos .= $listado[$i]->nom_localidad.";";
	$datos .= $listado[$i]->upz.";";
	$datos .= $listado[$i]->nom_upz.";";
	$datos .= $listado[$i]->barrio.";";
	$datos .= $listado[$i]->nombre_barrio.";";
	$datos .= $listado[$i]->fecha_nacimiento.";";
	$datos .= $listado[$i]->edad.";";
	$datos .= $listado[$i]->sexo.";";
	$datos .= $listado[$i]->descripcion_sexo.";";
	$datos .= $listado[$i]->genero.";";
	$datos .= $listado[$i]->orientacion.";";
	$datos .= $listado[$i]->etnia.";";
	$datos .= $listado[$i]->nom_etnia.";";
	$datos .= $listado[$i]->estado_civil.";";
	$datos .= $listado[$i]->nom_est_civil.";";
	$datos .= $listado[$i]->nivel_educativo.";";
	$datos .= $listado[$i]->nom_nivel_educativo.";";
	$datos .= $listado[$i]->tipo_iden_rl.";";
	$datos .= $listado[$i]->nume_iden_rl.";";
	$datos .= $listado[$i]->nombre_rs.";";
   	
   	
   	$datos .= "\r\n";

}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>