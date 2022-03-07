<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-wheelchair"></i> CERTIFICADO DE DISCAPACIDAD
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
					<i class="fa fa-folder-open"></i> Estado de mi trámite
				</div>
				<div class="panel-body">
					<?php
					if($info){
						if ($info[0]['id_estado']!=13 && $info[0]['email']!=''){
							$disabled="disabled='disabled'";
						}else{
							$disabled='';
						}
					?>	
						<button type="button" class="btn btn-success btn-block editar" data-toggle="modal" data-target="#modal" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos personales
						</button><br>
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
						$retornoExitoP = $this->session->flashdata('retornoExitoP');
						if ($retornoExitoP) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success ">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo $retornoExitoP ?>		
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

						if ($info[0]['id_estado']==4) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success text-center">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo 'Descargue aqu&iacute; su órden de valoración <br>
									<a href="'.base_url('certificado_discapacidad/resoluciones').'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
									?>	
								</div>
							</div>
							<?php
						}	
						?> 
						
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
							<thead>
								<tr>
									<th class="text-center">No. trámite</th>
									<th class="text-center">Nombres y Apelldidos</th>
									<th class="text-center">Número de documento</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Correo</th>
									<th class="text-center">Estado trámite</th>
									<th class="text-center">Observacioes</th>
									<!--<th class="text-center">Editar</th>-->
								</tr>
							</thead>
							<tbody>							
								<?php
								foreach ($info as $lista):
									//echo "MMM".$info ."as". $lista;
									echo "<tr>";
										echo "<td>&nbsp;&nbsp;&nbsp;" . $info[0]['id_tramite'] . "</td>";
										echo "<td>&nbsp;" . $info[0]['p_nombre'] . " ". $info[0]['p_apellido'] . "</td>";
										echo "<td class='text-center'>" . $info[0]['nume_identificacion'] . "</td>";
										echo "<td class='text-center'>" . $info[0]['telefono_celular'] . "</td>";
										echo "<td>" . $info[0]['email'] . "</td>";
										echo "<td class='text-center'>";

											switch ($info[0]['id_estado']) {
												case 1:
												$valor = 'Registrado';
												$clase = "text-primary";
												break;
												case 2:
												case 3:
												$valor = 'En trámite';
												$clase = "text-success";
												break;
												case 4:
												$valor = 'Aprobado';
												$clase = "text-success";
												break;
												case 5:
												case 6:
												case 7:
												$valor = 'Negado';
												$clase = "text-danger";
												break;
												case 13:
												$valor = 'Se requiere mas informaci&oacute;n';
												$clase = "text-warning";
												break;
												case 23:
												$valor = 'Subsanado';
												$clase = "text-primary";
												break;
												case 24:
												$valor = 'Sin competencia (Régimen especial o no residente en Bogotá)';
												$clase = "text-danger";
												break;
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
										echo "</td>";
										
										
										echo "<td>" . $info[0]['observaciones'] . "</td>";
									echo "</tr>";
								endforeach;
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
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bookmark"></i>
				<a data-toggle="collapse" href="#collapse1">Datos del trámite</a>
			</div>
			<div id="collapse1" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group text-left">
								Pertenece al r&eacute;gimen especial:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['regimen_esp']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group text-left">
								Categor&iacute;a:
								
									<?php for ($i = 0; $i < count($categoria); $i++) { 
									$j=$i+1;
									if($info[0]['categoria_'.$j] == 1){
									?>
									<label class="checkbox-inline" for="categoria">
									<input class="categoria" type="checkbox" value="1" 
									<?php if($info[0]['categoria_'.$j] == 1) { echo "checked"; } else { echo ""; } ?> disabled="disabled">
									<label class="control-label" for="numiden">
									<?php echo $categoria[$i]["descripcion"];?>
									</label>
									<?php }
									} ?>
								
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Cuál dispositivo utiliza para movilizarse:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['nom_moviliza']:""; ?></label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Qué otro dispositivo utiliza para movilizarse:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cual_moviliza']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Cuál dispositivo utiliza para comunicarse:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['nom_comunica']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Qué otro dispositivo utiliza para comunicarses:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cual_comunica']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Requiere acompa&ntilde;ante:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['req_acompanante']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Vive con una persona que presente condici&oacute;n de discapacidad:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['vive_persona']:""; ?></label>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								IPS seleccionada:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['nom_ips']:""; ?></label>
								
							</div>
						</div>
					</div>
					<?php
					if($info[0]['id_estado']==13){
					?>
					<div class="row">
						<div class="col-lg-12 text-center">
							<button type="button" class="btn btn-success editTramite" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos del trámite
							</button>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user-md"></i>
				<a data-toggle="collapse" href="#collapse2">Datos del cuidador</a>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Primer Nombre:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_pnombre']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Segundo Nombre:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_snombre']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Primer Apellido:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_papellido']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Segundo Apellido:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_sapellido']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Tipo de Identificación:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['nom_tipodoc']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								No. de documento:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_numdoc']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Correo electrónico:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_email']:""; ?></label>
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								Teléfono fijo:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_telefono']:""; ?></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								Teléfono celular:
								<label class="control-label" for="numiden"><?php echo $info?$info[0]['cu_celular']:""; ?></label>
								
							</div>
						</div>
					</div>
					<?php
					if($info[0]['id_estado']==13){
					?>
					<div class="row">
						<div class="col-lg-12 text-center">
							<button type="button" class="btn btn-success editCuidador" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos del cuidador
							</button>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	if($info[0]->id_estado==4 || $info[0]->id_estado==7) {
		echo "";
	}else{
		?>

	<div class="row">
		<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file-pdf-o"></i>
					<a>Documentos registrados</a>
				</div>
				<div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="header-form">
								<div class="modal-header">
								    <div class="row">
									  <div class="col-sm-2">Id documento</div>
									  <div class="col-sm-4">Descripci&oacute;n</div>
									  <div class="col-sm-2">Ver documento</div>
									  <div class="col-sm-2">Estado del documento</div>
									  
									</div>
								</div>
								<div class="modal-body">
									<?php
									if($info){
										for($i=0; $i<=count($archivos)-1; $i++){
											$nombre=explode('-', $archivos[$i]['nombre']);
											$corregir='<button type="button" class="btn btn-danger btn-xs corregirPDF" data-toggle="modal" data-target="#modal1" id="'.$archivos[$i]['id_archivo'].'" >
												Corregir <span class="glyphicon glyphicon-edit" aria-hidden="true">
												</button>';
											$ruta='<a href="'.base_url('certificado_discapacidad/abrir_pdf/'.$archivos[$i]['id_archivo']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
															
											echo '<div class="row">
											  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
											 	<div class="col-sm-4">'.$nombre[1].'</div>
											  	<div class="col-sm-2">'; 
										  		if($archivos[$i]['condicion']=="2"){
										  			echo $corregir;
										  		}else{
										  			echo $ruta;
										  		}	
										  		
											echo '</div>
											  	<div class="col-sm-2">';
												  	switch ($archivos[$i]['condicion']) {
														case 0:
														$clase = '<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"> Registrado</span></button>';
														break;
														case 1:
														$clase = '<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-check"> Si cumple</span></button>';
														break;
														case 2:
														$clase = '<button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"> No cumple</span></button>';
														break;
													}
													echo '<p>'.$clase.'</p>';
											  	echo '</div>
										  
											</div>';
										}
									} 
									?>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /.row -->
		
		<?php
	}
	?>
</div>
	<!-- /#page-wrapper -->


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
		
	</div>
	
</div>
<div class="modal fade text-center" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos1">
			
		</div>
	</div>
 </div>                   
	<!--FIN Modal para adicionar HAZARDS -->

	