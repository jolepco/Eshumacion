<?php

$datos = "";
$datos .= "Id Trámite;Número documento;Nombres Solicitante;email;telefono fijo;telefono celular;Fecha Solicitud;Fecha de aprobación;Estado;Funcionario;Fecha Observación;Notificación;";
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
	$datos .= $listado_soli[$i]->fecha_registro_h.";";
	$datos .= $observ.";";
	$datos .= "\r\n";
}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');
?>