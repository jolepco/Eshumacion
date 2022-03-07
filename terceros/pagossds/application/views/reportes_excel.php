<?php

$datos = "";
$datos .= "Vigencia;Identificaci&oacute;n;Convenio;Estado;Fecha giro;Planilla;Orden Pago;Bruto;Valor Girado;Detalle, Nombre Banco;Cuenta;";
$datos .= "\r\n";


$total_registros = count($listado_pagos);

for($i=0;$i<$total_registros;$i++){
	
	$datos .= $listado_pagos[$i]->VIGENCIA.";";
	$datos .= $listado_pagos[$i]->NIT_CEDULA.";";
	$datos .= $listado_pagos[$i]->CTO_CONVENIO.";";
	$datos .= $listado_pagos[$i]->ESTADO.";";
	$datos .= $listado_pagos[$i]->FECHA_GIRO.";";
	$datos .= $listado_pagos[$i]->PLANILLA.";";
	$datos .= $listado_pagos[$i]->ORDEN_PAGO.";";
	$datos .= $listado_pagos[$i]->BRUTO.";";
	$datos .= $listado_pagos[$i]->VALOR_GIRADO.";";
	$datos .= $listado_pagos[$i]->DETALLE.";";
	$datos .= $listado_pagos[$i]->NOMBRE_BANCO.";";
	$datos .= $listado_pagos[$i]->CUENTA_BANCO_RECEPTOR.";";
	$datos .= "\r\n";
}

echo mb_convert_encoding($datos, 'UTF-16LE', 'UTF-8');

?>