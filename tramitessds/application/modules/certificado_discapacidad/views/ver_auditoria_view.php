<div class="panel panel-default">
	<div class="panel-heading">
		VENTANA DE SEGUIMIENTO Y AUDITORÍA
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="panel-body">
		<div class="row">
			<fieldset class="header-form">
				<div class="modal-header">
				    <div class="row">
					  <div class="col-sm-1">Id tramite</div>
					  <div class="col-sm-2">Nombre usuario</div>
					  <div class="col-sm-2">Fecha de registro</div>
					  <div class="col-sm-3">Estado</div>
					  <div class="col-sm-4">Observaciones</div>
					  
					</div>
				</div>
				<div class="modal-body">
					<?php
					//if($info){
						for($i=0; $i<=count($auditoria)-1; $i++){
							echo '<div class="row">
							  	<div class="col-sm-1">'.$auditoria[$i]['id_tramite'].'</div>
							 	<div class="col-sm-2">'.$auditoria[$i]['p_nombre']. ' '.$auditoria[$i]['p_apellido'] .'</div>
							  	<div class="col-sm-2">'.$auditoria[$i]['fecha_registro'].'</div>
							  	<div class="col-sm-3">';
							  	switch ($auditoria[$i]['id_estado']) {
													case 1:
														$valor = 'Solicitud realizada por el usuario';
														$clase = "text-primary";
													break;
													case 2:
														$valor = 'Aprobado por parte del validador de documentos';
														$clase = "text-success";
													break;
													case 3:
														$valor = 'Aprobado por el coordinador';
														$clase = "text-success";
													break;
													case 4:
													$valor = 'Aprobado y firmado';
													$clase = "text-success";
													break;
													case 5:
														$valor = 'Negado por el validador de documentos';
														$clase = "text-success";
													break;
													case 6:
														$valor = 'Negado por el coordinador';
														$clase = "text-success";
													break;
													case 7:
														$valor = 'Negado y firmado';
														$clase = "text-danger";
													break;
													case 13:
														$valor = 'Solicitar mas información';
														$clase = "text-warning";
													break;
												}
												echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
							echo '</div>
							  	<div class="col-sm-4">'.$auditoria[$i]['observaciones'].'</div>
							</div>';
						}
					//} 
					?>
				</div>

			</fieldset>
		</div>
	</div>
</div>