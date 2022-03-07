<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/aprobartramite.js"); ?>"></script>
<div id="page-wrapper">
	<div>
		<a class="btn btn-info" href=" <?php echo base_url(). 'plazas/tramites_pendientes'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a>
	</div>
	<br>
	<div class="row">
	<?php
	if($information){
		if ($information[0]->id_estado==4) {
			//echo base_url('expendedor_droga/resoluciones');
			?>
			<div class="col-lg-12">	
				<div class="alert alert-success text-center">
					<embed src="<?php echo base_url('plazas/resoluciones'); ?>" frameborder="0" width="100%" height="400px">
				    <br>     
					<a href="<?php echo base_url('plazas/resoluciones'); ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png');?>" width="30px"></a>
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
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-user"></i>
					<a data-toggle="collapse" href="#collapse1">Datos representante legal</a>
				</div>
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group text-left">
									<label class="control-label" for="numiden">Razón social:</label>
									<?php echo $information?$information[0]->nombre_rs:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
									<?php echo $information?$information[0]->nume_identificacion:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="numiden">Tipo de identificaci&oacute;n:</label>
									<?php echo $information?$information[0]->tipiden:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="p_nombre">Nombre representante legal:</label>
									<?php echo $information?$information[0]->p_nombre:""; ?>
									<?php echo ' '.$information?$information[0]->s_nombre:""; ?>
									<?php echo ' '.$information?$information[0]->p_apellido:""; ?>
									<?php echo ' '.$information?$information[0]->s_apellido:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="email">Correo electrónico: </label>
									<?php echo $information?$information[0]->email:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">No. de teléfono:</label>
									<?php echo $information?$information[0]->telefono_fijo:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="celular">No. de celular:</label>
									<?php echo $information?$information[0]->telefono_celular:""; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-users"></i> 
					<a data-toggle="collapse" href="#collapse2">Datos del encargado del trámite</a>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
									<?php echo $information?$information[0]->enc_numdoc:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="numiden">Tipo de identificaci&oacute;n:</label>
									<?php echo $information?$information[0]->tipidenenc:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="p_nombre">Nombre:</label>
									<?php echo $information?$information[0]->enc_pnombre:""; ?>
									<?php echo ' '.$information?$information[0]->enc_snombre:""; ?>
									<?php echo ' '.$information?$information[0]->enc_papellido:""; ?>
									<?php echo ' '.$information?$information[0]->enc_sapellido:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="email">Correo electrónico: </label>
									<?php echo $information?$information[0]->email:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">No. de teléfono:</label>
									<?php echo $information?$information[0]->enc_telefono:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="celular">No. de celular:</label>
									<?php echo $information?$information[0]->enc_celular:""; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-clone"></i> 
					<a data-toggle="collapse" href="#collapse3">Datos del proyecto y tipo de plaza de servicio social</a>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Modalidad de la plaza:</label>
									<?php echo $information?$information[0]->modalidad:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">No. de plazas solicitadas:</label>
									<?php echo $information?$information[0]->nro_plazas:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Nombre proyecto investigación:</label>
									<?php echo $information[0]->nom_proyecto!=''?$information[0]->nom_proyecto:"N/A"; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Tipo profesión o especialidad:</label>
									<?php echo $information?$information[0]->profesion:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Tipo de vinculación:</label>
									<?php echo $information?$information[0]->vinculacion:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Especialidad:</label>
									<?php echo $information[0]->especialidad!=''?$information[0]->especialidad:"N/A"; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">No. de población beneficiada :</label>
									<?php echo $information?$information[0]->nro_poblacion:""; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Salario asignado por Plaza Individual :</label>
									<?php echo $information?$information[0]->salario_asignado:""; ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="telefono_fijo">Fecha de registro:</label>
									<?php echo $information?$information[0]->fecha_registro:""; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file"></i>
					<a data-toggle="collapse" href="#collapse4"> Documentos adjuntos</a>
				</div>
				<div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">
						<?php
							for($i=0; $i<=count($archivos)-1; $i++){
													
								//$ruta='<a href="'.base_url('/'.$archivos[$i]['ruta'].''.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
								$ruta='<a href="'.base_url('plazas/abrir_pdf/'.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
								$nombre=explode('-', $archivos[$i]['nombre']);
																			
								echo '<div class="row">
								  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
								 	<div class="col-sm-4">'.$nombre[1].'</div>
								  	<div class="col-sm-2">'. $ruta.'</div> ';
									echo "<div class='col-sm-4'>";
									?>
										<button type="button" class="btn btn-info btn-xs VerPDF" data-toggle="modal" data-target="#modal" id="<?php echo $archivos[$i]['id_archivo']; ?>" >
										Ver PDF<span class="glyphicon glyphicon-eye-open" aria-hidden="true">
										</button>
									<?php
									echo "</div>";
								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<?php } ?>
	<div class="row">
		<div class="col-lg-12">
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
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-bookmark fa-fw"></i>Aprobar trámite
						<!--<a data-toggle="collapse" class="bg-primary" href="#collapse7"> Aprobar trámite</a>-->
					</h4>

				</div>
				<!--<div id="collapse7" class="panel-collapse collapse">-->
					<div class="panel-body">
						<p class="text-danger text-left">Los campos con * son obligatorios.</p>
						<form name="form_aprobar" id="form_aprobar" role="form_aprobar" method="post" >
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="estado">Cambiar estado del trámite : *</label>
									<select name="estado" id="estado" class="form-control" required>
										<option value=''>Selecccione...</option>
										<?php for ($i = 0; $i < count($estados); $i++) { ?>
											<option value="<?php echo $estados[$i]["id_estado"]; ?>" <?php if($information[0]->id_estado == $estados[$i]["id_estado"]) { echo "selected"; }  ?>><?php echo $estados[$i]["descripcion"]; ?></option>	
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group text-left">
									<label class="control-label" for="observaciones">Observaciones :</label>
									<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50" required><?php echo $information?$information[0]->observaciones:''; ?></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<div class="col-sm-12" align="center">
									<div style="width:50%;" align="center">
										<input type="hidden" id="idtramite" name="idtramite" value="<?php echo $information?$information[0]->id_tramite:''; ?>">
										<input type="button" id="btnSubmitAprobar" name="btnSubmitAprobar" value="<?php echo $boton; ?>" class="btn btn-success btn-block custom" <?php echo $disabled; ?>/>
										<!--<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>-->
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				<!--</div>-->
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-eye-slash"></i>  
					<a data-toggle="collapse" href="#collapse5"> Seguimiento y auditoría</a>
				</div>
				<div id="collapse5" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-12" align="center">
							<button type="button" class="btn btn-info btn-block auditoria" data-toggle="modal" data-target="#modal" id="persona">
								<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Ver seguimiento
							</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file-pdf-o"></i>  
					<a data-toggle="collapse" href="#collapse6"> Previsualización resoluciones</a>
				</div>
				<div id="collapse6" class="panel-collapse collapse">
					<div class="panel-body">
						<form name="form_consultar" id="form_consultar" role="form_consultar" method="post" action="<?php echo base_url('plazas/resoluciones')?>">
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
									 <input type="hidden" name="id_tramite" value="<?php echo $information[0]->id_tramite; ?>">
								</div>
						</div>	
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>   
	



	