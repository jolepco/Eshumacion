<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-bookmark fa-fw"></i> AUTORIZACIÓN DE PLAZAS
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
					<i class="fa fa-reorder"></i> Tr&aacute;mites registrados
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-success btn-block nuevo" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo trámite
						</button><br>
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
									<th class="text-center">No. trámites</th>
									<th class="text-center">Nombre representante legal</th>
									<th class="text-center">Número de documento</th>
									<!--<th class="text-center">Teléfono</th>
									<th class="text-center">Correo</th>-->
									<th class="text-center">Fecha de registro</th>
									<th class="text-center">Estado trámite</th>
									<th class="text-center">Observacioes</th>
									<th class="text-center">Proyectos y tipo de plazas</th>
								</tr>
							</thead>
							<tbody>							
								<?php
								
								for($i=0; $i<=count($info)-1; $i++){
									$idtamite=$info[$i]['id_tramite']+19722512-20131611;
									echo "<tr>";
										echo "<td>&nbsp;" . $info[$i]['id_tramite'] . "</td>";
										
										echo "<td>&nbsp;" . $info[$i]['p_nombre'] . " " . $info[$i]['s_nombre'] ." ". $info[$i]['p_apellido'] ." ". $info[$i]['s_apellido'] . "</td>";
										echo "<td class='text-center'>" . $info[$i]['numidentificacion'] . "</td>";
										//echo "<td class='text-center'>" . $info[$i]['telefono_celular'] . "</td>";
										//echo "<td>" . $info[$i]['email'] . "</td>";
										echo "<td>" . $info[$i]['fecha_registro'] . "</td>";
										echo "<td class='text-center'>";
											
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
													$valor = 'Aprobado y firmado <br>';
													/*$valor.='<div class="alert alert-success text-center">
													<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
													Descargue aqu&iacute; su resolución <br>
													<a href="'.base_url('plazas/resoluciones').'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>
													
												</div>';*/
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
													case 15:
														$valor = 'En trámite';
														$clase = "text-success";
													break;
													case 22:
														$valor = 'Pendiente por registrar proyecto';
														$clase = "text-primary";
													break;
												}
												
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
										echo "</td>";
										if($info[$i]['id_estado']==13 || $info[$i]['id_estado']==7 || $info[$i]['id_estado']==5){
											echo "<td>" . $info[$i]['observaciones'] . "</td>";
										}else{
											echo "<td></td>";
										}
										echo "<td class='text-center'>";
											?>
											<a href="<?php echo base_url("plazas/proyectos/" . $idtamite); ?>" class="btn btn-success btn-xs">Proyecto <span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
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

	