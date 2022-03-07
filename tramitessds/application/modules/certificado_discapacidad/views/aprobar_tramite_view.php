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
					<a class="btn btn-info" href=" <?php echo base_url(). 'certificado_discapacidad/tramites_pendientes'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a>
					<i class="fa fa-check-circle"></i> APROBAR TRÁMITE
				</div>
				<div class="panel-body">
					<?php
					if($info){
						if ($info[0]['id_estado']==4 || $info[0]['id_estado']==7) {
							//echo base_url('expendedor_droga/resoluciones');
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success text-center">
									<embed src="<?php echo base_url('certificado_discapacidad/resoluciones'); ?>" frameborder="0" width="100%" height="400px">
								    <br>     
									
									 <a href="<?php echo base_url('certificado_discapacidad/resoluciones'); ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png');?>" width="30px"></a>
									 <br>
									<input type="button" id="btnSubmitFirmar" name="btnSubmitFirmar" value="Firmar y Enviar" class="btn btn-success"/>		
								</div>
							</div>
							<div class="col-lg-12">	
								
							</div>
							<?php
							if ($retornoExito) {
								$disabled="disabled";
								?>
								<div class="col-lg-12">	
									<div class="alert alert-success ">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
										<?php echo $retornoExito ?>		
									</div>
								</div>
								<?php
							}
							?> 

							<?php
						}
					?>	
						<?php
						$retornoExito = $this->session->flashdata('retornoExito');
						if ($retornoExito) {
							$disabled="disabled";
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success ">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo $retornoExito ?>		
								</div>
							</div>
							<?php
						}else{
							$disabled="";
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
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user"></i>
								<a data-toggle="collapse" href="#collapse1">Datos del ciudadano</a>
							</div>
							<div id="collapse1" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
												<?php echo $info?$info[0]['nume_identificacion']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="p_nombre">Primer nombre:</label>
												<?php echo $info?$info[0]['p_nombre']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="s_nombre">Segundo nombre: </label>
												<?php echo $info?$info[0]['s_nombre']:""; ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="p_apellido">Primer apellido:</label>
												<?php echo $info?$info[0]['p_apellido']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="s_apellido">Segundo apellido:</label>
												<?php echo $info?$info[0]['s_apellido']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="fecha_nacimiento">Fecha de nacimiento: </label>
												<?php echo $info?$info[0]['fecha_nacimiento']:""; ?>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="email">E-mail: </label>
												<?php echo $info?$info[0]['email']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="telefono_celular">Tel&eacute;fono celular: </label>
												<?php echo $info?$info[0]['telefono_celular']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="telefono_fijo">Tel&eacute;fono fijo: </label>
												<?php echo $info?$info[0]['telefono_fijo']:""; ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="dire_resi">Direcci&oacute;n: </label>
												<?php echo $info?$info[0]['dire_resi']:""; ?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group text-left">
												<label class="control-label" for="nivel_educativo">Nivel educativo : </label>
												<?php echo $info[0]['nom_nivel']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-bookmark"></i>
								<a data-toggle="collapse" href="#collapse2">Datos del trámite</a>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
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
								</div>
							</div>
						</div>	
								
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md"></i>
								<a data-toggle="collapse" href="#collapse3">Datos del cuidador</a>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
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
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md"></i>
								Aprobar certificado
							</div>
							<div id="collapse4" class="">
								<div class="panel-body">
									<div class="modal-body">

										<p class="text-danger text-left">Los campos con * son obligatorios.</p>
										<form name="form_aprobar" id="form_aprobar" role="form_aprobar" method="post" >
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group text-left">
													<label class="control-label" for="estado">Estado del trámite : *</label>
													<select name="estado" id="estado" class="form-control" required>
														<option value=''>Selecccione...</option>
														<?php for ($i = 0; $i < count($estados); $i++) { ?>
															<option value="<?php echo $estados[$i]["id_estado"]; ?>" <?php if($info[0]['id_estado'] == $estados[$i]["id_estado"]) { echo "selected"; }  ?>><?php echo $estados[$i]["descripcion"]; ?></option>	
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<?php if($this->session->userdata('perfil')!=3) { ?>
										<div class="row">
											<div class="col-sm-6">
												<label for="cod_autorizacion">Código de autorización RLCPD:</label>
												<div>
													<input id="cod_autorizacion" name="cod_autorizacion" value="<?php echo $info?$info[0]['cod_autorizacion']:""; ?>" placeholder="Código de autorización RLCPD" class="form-control input-md validate[required,maxSize[80]] regimen_no" type="text" required  autocomplete="off">

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<label for="modalidad">Modalidad de consulta por equipo multidisciplinario de salud, de acuerdo con lo establecido por el médico tratante:</label>
												<div>
													<select name="modalidad" id="modalidad" class="form-control" required>
														<option value=''>Selecccione...</option>
														<?php for ($i = 0; $i < count($modalidad); $i++) { ?>
															<option value="<?php echo $modalidad[$i]["id_modalidad"]; ?>" <?php if($info[0]['id_modalidad'] == $modalidad[$i]["id_modalidad"]) { echo "selected"; }  ?>><?php echo $modalidad[$i]["nombre"]; ?></option>	
														<?php } ?>
													</select>

												</div>
											</div>
										</div>
										<?php } ?>
										<div class="row">
											<div class="col-sm-6">
												<label for="ips">Seleccione la IPS</label>
												<div>
													<select name="ips" id="ips" class="form-control regimen_no" required <?php $info[0]['regimen_esp']=='si'? $flag='disabled':$flag=''; echo $flag; ?>>
													<option value=''>Selecccione...</option>
													<?php for ($i = 0; $i < count($lista_ips); $i++) { ?>
														<option value="<?php echo $lista_ips[$i]["id_ips"]; ?>" <?php if($info[0]['id_ips'] == $lista_ips[$i]["id_ips"]) { echo "selected"; }  ?>><?php echo $lista_ips[$i]['nombre_ips']; ?>
														</option>	
													<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group text-left">
													<label class="control-label" for="observaciones">Observaciones :</label>
													<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50" required><?php echo $info[0]['observaciones']; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<legend>Documentos cargados</legend>
										</div>
										<div class="row">
											<div class="modal-header">
												<div class="row">
											      <div class="col-sm-2">Id documento</div>
												  <div class="col-sm-4">Descripci&oacute;n</div>
												  <div class="col-sm-2">Abrir documento</div>
												  <div class="col-sm-2">Ver documento</div>
												  <div class="col-sm-2">Cumple?</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="modal-body">
												<?php
												if($info){
													
													for($i=0; $i<=count($archivos)-1; $i++){
														
														//$ruta='<a href="'.base_url('/'.$archivos[$i]['ruta'].''.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
														$ruta='<a href="'.base_url('certificado_discapacidad/abrir_pdf/'.$archivos[$i]['id_archivo']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
														$nombre=explode('-', $archivos[$i]['nombre']);
																									
														echo '<div class="row">
														  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
														 	<div class="col-sm-4">'.$nombre[1].'</div>
														  	<div class="col-sm-2">'. $ruta.'</div> ';
															echo "<div class='col-sm-2'>";
															?>
																<button type="button" class="btn btn-info btn-xs VerPDF" data-toggle="modal" data-target="#modal" id="<?php echo $archivos[$i]['id_archivo']; ?>" >
																Ver PDF<span class="glyphicon glyphicon-eye-open" aria-hidden="true">
																</button>
															<?php
															echo "</div>";
														echo '<div class="col-sm-2">

																<label class="form-check-label" for="materialUnchecked">SI
																<input type="radio" class="form-check-input cumplen'.$i.'" id="cumple'.$i.'" name="cumple'.$i.'" value="1"';
													  			if($archivos[$i]["condicion"] == 1){
													  				echo 'checked="checked"';
													  			}
													  			echo ' 
													  			</label>
															 	<label class="form-check-label" for="materialUnchecked">NO
															 	<input type="radio" class="form-check-input cumplen'.$i.'" id="cumple'.$i.'" name="cumple'.$i.'" value="2"
															 	';
													  			if($archivos[$i]["condicion"] == 2){
													  				echo 'checked="checked"';
													  			}
													  			echo ' 
															 	</label>
															</div>
														</div>
														<div id="mensajecumple'.$i.'"></div>';
													}
												} 
												?>
											</div>

										</div>
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12" align="center">
													<div style="width:50%;" align="center">
														<input type="hidden" id="idtramite" name="idtramite" value="<?php echo $info[0]['id_tramite']; ?>">
														<input type="button" id="btnSubmitAprobar" name="btnSubmitAprobar" value="<?php echo $boton; ?>" class="btn btn-success btn-block custom" <?php echo $disabled; ?>/>
														<!--<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>-->
													</div>
												</div>
											</div>
										</div>
										</form>
									</div>
								
									<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12" align="center">
												<button type="button" class="btn btn-info btn-block auditoria" data-toggle="modal" data-target="#modal" id="persona">
													<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Ver seguimiento
												</button>
												</div>
											</div>
										</div>
										<br>
										<form name="form_consultar" id="form_consultar" role="form_consultar" method="post" action="<?php echo base_url('certificado_discapacidad/resoluciones')?>">
											<div class="row">
												<div class="form-group">
													<div class="col-sm-6">
														<div class="form-group text-left">
															<label class="control-label" for="resolucion">Seleccione la resolución : *</label>
															<select name="resolucion" id="resolucion" class="form-control" required>
																<option value=''>Selecccione...</option>
																<option value='1'>Aprobada</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6" align="center">
														<button class="btn btn-info">Consultar</button>
													</div>
											</div>	
										</form>
									</fieldset>



								</div>
							</div>
						</div>
							
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
	<!--FIN Modal para adicionar HAZARDS -->

	