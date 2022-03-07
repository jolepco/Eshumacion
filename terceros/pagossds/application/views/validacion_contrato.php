<div class="text-center">
<h3>Se valida la informaci&oacute;n del presente docuento con los siguientes datos:</h3>
<?php

if(count($pago)>0){
	
	?>
	<h5 style="color:green">Datos de contrato</h5>
	<i class="far fa-thumbs-up fa-9x" style="color:green"></i>
	<table class="table">
		<tr>
			<td><b>Identificación: </b></td>
			<td><?php echo $pago[0]->NIT_CEDULA; ?></td>
		</tr>
		<tr>
			<td><b>Nombre: </b></td>
			<td><?php echo $pago[0]->NOMBRE; ?></td>
		</tr>
		<tr>
			<td><b>Contato: </b></td>
			<td><?php echo $pago[0]->CTO_CONVENIO; ?></td>
		</tr>
		<tr>
			<td><b>Vigencia: </b></td>
			<td><?php echo $pago[0]->VIGENCIA; ?></td>
		</tr>
		
	</table>			
	<?php
	
}else{
	
	?>
	<h5 style="color:red">Ciudadano no registrado</h5>
	<i class="far fa-thumbs-down fa-9x" style="color:red"></i>
	<?php
	
}

?>
</div>