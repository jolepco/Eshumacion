<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-bookmark fa-fw"></i> CREDENCIALES EXPENDEDOR DE DROGAS
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-reorder"></i> Tr&aacute;mites pendientes
				</div>
				<div class="panel-body">
					<?php
					if($info){
						?>	
						
						<br>
						<?php
						$retornoExito = $this->session->flashdata('retornoExito');
						if ($retornoExito) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success ">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo $retornoExito ?>		
								</div>
							</div>
							<?php
						}

						$retornoError = $this->session->flashdata('retornoError');
						if ($retornoError) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-danger ">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<?php echo $retornoError ?>
								</div>
							</div>
							<?php
						}
						?> 
								
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesTramites">
							<thead>
								<tr>
									<th class="text-center">No. trámite</th>
									<th class="text-center">Nombres Completo</th>
									<th class="text-center">Número de documento</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Correo</th>
									<th class="text-center">Fecha de registro</th>
									<th class="text-center">Estado trámite</th>
									<!--<th class="text-center">Observacioes</th>-->
									<th class="text-center">Validar trámite</th>
								</tr>
							</thead>
							<tbody>							
								<?php

								for($i=0; $i<=count($info)-1; $i++){
									//echo "MMM".$info ."as". $lista;
									
									echo "<tr>";
										echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;" . $info[$i]['id_expdrogas'] . "</td>";
										
										echo "<td>&nbsp;" . $info[$i]['p_nombre'] . " " . $info[$i]['s_nombre'] ." ". $info[$i]['p_apellido'] ." ". $info[$i]['s_apellido'] . "</td>";
										echo "<td class='text-center'>" . $info[$i]['numidentificacion'] . "</td>";
										echo "<td class='text-center'>" . $info[$i]['telefono_celular'] . "</td>";
										echo "<td>" . $info[$i]['email'] . "</td>";
										echo "<td>" . $info[$i]['fecha_registro'] . "</td>";
										echo "<td class='text-center'>";
											if($info[$i]['id_resolucion'] == '' || $info[$i]['id_estado'] == 12 || $info[$i]['id_estado']==17 || $info[$i]['id_estado']==18 || $info[$i]['id_estado']==8 || $info[$i]['id_estado']==9 || $info[$i]['id_estado']==10){
												switch ($info[$i]['id_estado']) {
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
													case 8:
														$valor = 'Solicitud de recurso de reposición';
														$clase = "text-primary";
														break;
													case 9:
														$valor = 'Resuelve recurso de reposición validacion';
														$clase = "text-primary";
														break;
													case 10:
														$valor = 'Resuelve recurso de reposición coordinador';
														$clase = "text-primary";
														break;
													case 12:
														$valor = 'Solicitud de recurso de aclaración';
														$clase = "text-primary";
														break;
													case 13:
														$valor = 'Solicitar mas información';
														$clase = "text-warning";
													break;
													case 17:
														$valor = 'Resuelve recurso de aclaración validación';
														$clase = "text-success";
													break;
													case 18:
														$valor = 'Resuelve recurso de aclaración coordinador';
														$clase = "text-success";
													break;
													case 23:
														$valor = 'Subsanado';
														$clase = "text-primary";
													break;
												}
											}else{
												$valor = 'Este trámite ya tiene una resolución';
												$clase = "text-danger";
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
										echo "</td>";
										//echo "<td>" . $info[$i]['observaciones'] . "</td>";
										echo "<td class='text-center'>";
											?>
											<a href="<?php echo base_url("expendedor_droga/aprobar_tramite/" . $info[$i]['idusuario']); ?>" class="btn btn-success btn-xs">Validar <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a>
											<?php
										echo "</td>";
										/**/
									echo "</tr>";
								}
								?>
							</tbody>
						</table>

					<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
</div>
	<!-- /#page-wrapper -->


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
	<!--FIN Modal para adicionar HAZARDS -->

	