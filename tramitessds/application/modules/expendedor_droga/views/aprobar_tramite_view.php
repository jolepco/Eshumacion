<script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/validate/aprobartramite.js"); ?>"></script>
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
					<a class="btn btn-info" href=" <?php echo base_url(). 'expendedor_droga/tramites_pendientes'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a>
					<i class="fa fa-check-circle"></i> APROBAR TRÁMITE
				</div>
				<div class="panel-body">
					<?php
					if($info){
						if ($info[0]->id_estado==4 || $info[0]->id_estado==7 || $info[0]->id_estado==19 || $info[0]->id_estado==11) {
							//echo base_url('expendedor_droga/resoluciones');
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success text-center">
									<embed src="<?php echo base_url('expendedor_droga/resoluciones'); ?>" frameborder="0" width="100%" height="400px">
								    <br>     
									
									 <a href="<?php echo base_url('expendedor_droga/resoluciones'); ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png');?>" width="30px"></a>
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

						if($tiene_tramite==1){
							?> 
							<div class="alert alert alert-warning" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								<b>Apreciado Usuario!</b>
								<p>El ciudadano tiene un trámite registrado en el sistema ORACLE, por favor validar.</p>
							
							</div>
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
						<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
										<?php echo $information?$information->nume_identificacion:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="p_nombre">Primer nombre:</label>
										<?php echo $information?$information->p_nombre:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="s_nombre">Segundo nombre: </label>
										<?php echo $information?$information->s_nombre:""; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="p_apellido">Primer apellido:</label>
										<?php echo $information?$information->p_apellido:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="s_apellido">Segundo apellido:</label>
										<?php echo $information?$information->s_apellido:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="fecha_nacimiento">Fecha de nacimiento: </label>
										<?php echo $information?$information->fecha_nacimiento:""; ?>
									</div>
								</div>
							</div>
							<div class="row">
								
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="email">E-mail: </label>
										<?php echo $information?$information->email:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="telefono_celular">Tel&eacute;fono celular: </label>
										<?php echo $information?$information->telefono_celular:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="telefono_fijo">Tel&eacute;fono fijo: </label>
										<?php echo $information?$information->telefono_fijo:""; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="dire_resi">Direcci&oacute;n: </label>
										<?php echo $information?$information->dire_resi:""; ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group text-left">
										<label class="control-label" for="nivel_educativo">Nivel educativo : </label>
										<?php echo $information->Nombre; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
								<button type="button" class="btn btn-success btn-block editar" data-toggle="modal" data-target="#modal" id="persona">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos personales
								</button>
							</div>
							</div>	
						</fieldset>	
						<fieldset style="padding: 10px; border: 1px solid #CCCCCC">		
							<div class="modal-body">

								<p class="text-danger text-left">Los campos con * son obligatorios.</p>
								<form name="form_aprobar" id="form_aprobar" role="form_aprobar" method="post" >
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group text-left">
											<label class="control-label" for="estado">Cambiar estado del trámite : *</label>
											<select name="estado" id="estado" class="form-control" required>
												<option value=''>Selecccione...</option>
												<?php for ($i = 0; $i < count($estados); $i++) { ?>
													<option value="<?php echo $estados[$i]["id_estado"]; ?>" <?php if($info[0]->id_estado == $estados[$i]["id_estado"]) { echo "selected"; }  ?>><?php echo $estados[$i]["descripcion"]; ?></option>	
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group text-left">
											<label class="control-label" for="observaciones">Observaciones :</label>
											<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50" required><?php echo $info[0]->observaciones; ?></textarea>
										</div>
									</div>
								</div>
								<?php if($info[0]->id_estado==12 || $info[0]->id_estado==17 || $info[0]->id_estado==18 || $info[0]->id_estado==15) { ?>
								<hr>
								<div class="row">
									<div class="col-sm-12">
										Resolución de aprobación No.<?php echo $resolucion->id_resolucion; ?>, con fecha <?php echo $resolucion->fecha_resolucion; ?>
									</div>
								</div>
								<hr>	
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group text-left">
											<label class="control-label" for="obs_aclaracion">Observacones de aclaración :</label>
											<textarea name="obs_aclaracion" id="obs_aclaracion" class="form-control" rows="3" cols="50" placeholder="Que...................." required><?php echo $info[0]->obs_aclaracion; ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group text-left">
											<label class="control-label" for="obs_articulo1">Observaciones de artículo primero :</label>
											<textarea name="obs_articulo1" id="obs_articulo1" class="form-control" rows="3" cols="50" placeholder="ARTÍCULO PRIMERO: Aclarar la resolución No del de de , expedida por la Secretaria Distrital de Salud de Bogotá
D.C en el sentido de consignar...................." required><?php echo $info[0]->obs_articulo1; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="row">
									<legend>Documentos registrados</legend>
								</div>
								<div class="row">
									<div class="modal-header">
										<div class="row">
									      <div class="col-sm-2">Id documento</div>
										  <div class="col-sm-4">Descripci&oacute;n</div>
										  <div class="col-sm-2">Abrir documento</div>
										  <div class="col-sm-2">Ver documento</div>
										  <div class="col-sm-2">Cumple el documento?</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="modal-body">
										<?php
										if($info){
											
											for($i=0; $i<=count($archivos)-1; $i++){
												
												$ruta='<a href="'.base_url('expendedor_droga/abrir_pdf/'.$archivos[$i]['id_archivo']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
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
														<input type="radio" class="form-check-input cumple'.$i.'" id="'.$archivos[$i]['id_archivo'].'" name="'.$archivos[$i]['id_archivo'].'" value="1"';
											  			if($archivos[$i]["condicion"] == 1){
											  				echo 'checked="checked"';
											  			}
											  			echo ' required>
											  			</label>
													 	<label class="form-check-label" for="materialUnchecked">NO
													 	<input type="radio" class="form-check-input cumple'.$i.'" id="'.$archivos[$i]['id_archivo'].'" name="'.$archivos[$i]['id_archivo'].'" value="2"
													 	';
											  			if($archivos[$i]["condicion"] == 2){
											  				echo 'checked="checked"';
											  			}
											  			echo ' required>
													 	</label>
													</div>
												</div>';
											
											}
										} 
										?>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-sm-12" align="center">
											<div style="width:50%;" align="center">
												<input type="hidden" id="idtramite" name="idtramite" value="<?php echo $info[0]->id_expdrogas_tramite; ?>">
												<input type="button" id="btnSubmitAprobar" name="btnSubmitAprobar" value="<?php echo $boton; ?>" class="btn btn-success btn-block custom" <?php echo $disabled; ?>/>
												<!--<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>-->
											</div>
										</div>
									</div>
								</div>
								</form>
							</div>
							
						</fieldset>
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
							<form name="form_consultar" id="form_consultar" role="form_consultar" method="post" action="<?php echo base_url('expendedor_droga/resoluciones')?>">
								<div class="row">
									<div class="form-group">
										<div class="col-sm-6">
											<div class="form-group text-left">
												<label class="control-label" for="resolucion">Seleccione la resolución : *</label>
												<select name="resolucion" id="resolucion" class="form-control" required>
													<option value=''>Selecccione...</option>
													<option value='1'>Aprobada</option>
													<option value='2'>Negada</option>
													<option value='3'>Aclaración</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-6" align="center">
											<!--<div style="width:50%;" align="center">
												<input type="button" id="btnSubmitConsultar" name="btnSubmitConsultar" value="Consultar" class="btn btn-success"/>
												
											</div>-->
											<button class="btn btn-info">Consultar</button>
										</div>
								</div>	
							</form>
						</fieldset>	
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

	