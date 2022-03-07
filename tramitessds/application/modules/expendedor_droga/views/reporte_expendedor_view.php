<?php

$datos = "";
$datos .= "Id Trámite;Número documento;Nombres Solicitante;email;telefono fijo;telefono celular;Fecha Solicitud;Fecha de aprobación;Estado;Funcionario;Fecha; Nacionalidad;Nombre Pais;Departamento;Nombre Depto;Ciudad nacimiento;Nombre Ciudad;Dirección Residencia;Localidad;Nombre Localidad;UPZ;Nombre UPZ;Barrio;Nombre Barrio;Fecha nacimiento;Edad;Sexo;Genero;Orientación;Etnia;Estado Civil;Nivel Educativo;";
$datos .= "\r\n";


$total_registros = count($listado_soli);

for($i=0;$i<$total_registros;$i++){
	$observ = trim(preg_replace('/\s+/', ' ', $listado_soli[$i]->observaciones_h));
	$datos .= $listado_soli[$i]->id_expdrogas_tramite.";";
	$datos .= $listado_soli[$i]->nume_identificacion.";";
	$datos .= $listado_soli[$i]->nombre_solisitante.";";
	$datos .= $listado_soli[$i]->email.";";
	$datos .= $listado_soli[$i]->telefono_fijo.";";
	$datos .= $listado_soli[$i]->telefono_celular.";";
	$datos .= $listado_soli[$i]->fecha_registro.";";
	$datos .= $listado_soli[$i]->fecha_aprobacion.";";
	$datos .= $listado_soli[$i]->nombre_estado.";";
	$datos .= $listado_soli[$i]->nombre_f.";";
	//$datos .= $$observ.";";
	$datos .= $listado_soli[$i]->fecha_registro_h.";";
	$datos .= $listado_soli[$i]->nacionalidad.";";
	$datos .= $listado_soli[$i]->Pais.";";
	$datos .= $listado_soli[$i]->departamento.";";
	$datos .= $listado_soli[$i]->Depto.";";
	$datos .= $listado_soli[$i]->ciudad_nacimiento.";";
	$datos .= $listado_soli[$i]->Ciudad.";";
	$datos .= $listado_soli[$i]->dire_resi.";";
	$datos .= $listado_soli[$i]->localidad.";";
	$datos .= $listado_soli[$i]->nomlocalidad.";";
	$datos .= $listado_soli[$i]->upz.";";
	$datos .= $listado_soli[$i]->nom_upz.";";
	$datos .= $listado_soli[$i]->barrio.";";
	$datos .= $listado_soli[$i]->nombre_barrio.";";
	$datos .= $listado_soli[$i]->fecha_nacimiento.";";
	$datos .= $listado_soli[$i]->edad.";";
	$datos .= $listado_soli[$i]->descripcion_sexo.";";
	$datos .= $listado_soli[$i]->genero.";";
	$datos .= $listado_soli[$i]->orientacion.";";
	$datos .= $listado_soli[$i]->nomEtnia.";";
	$datos .= $listado_soli[$i]->estcivil.";";
	$datos .= $listado_soli[$i]->nivelEducativo.";";
	$datos .= "\r\n";
}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>