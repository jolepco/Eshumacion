<?php

$datos = "";
$datos .= "Id Trámite;Número documento;Razón Social;Nombres Solicitante;Fecha Solicitud;Fecha de aprobación;Estado;Funcionario;Notificación;Fecha Observación;";
$datos .= "\r\n";


$total_registros = count($listado_plazas);

for($i=0;$i<$total_registros;$i++){
	
	$datos .= $listado_plazas[$i]->id_tramite.";";
	$datos .= $listado_plazas[$i]->nume_identificacion.";";
	$datos .= $listado_plazas[$i]->nombre_rs.";";
	$datos .= $listado_plazas[$i]->nombres.";";
	$datos .= $listado_plazas[$i]->fecha_registro.";";
	$datos .= $listado_plazas[$i]->fecha_aprobacion.";";
	$datos .= $listado_plazas[$i]->nombre_estado.";";
	$datos .= $listado_plazas[$i]->nombre_f.";";
	$datos .= $listado_plazas[$i]->observaciones_h.";";
	$datos .= $listado_plazas[$i]->fecha_registro_h.";";
	$datos .= "\r\n";
}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>