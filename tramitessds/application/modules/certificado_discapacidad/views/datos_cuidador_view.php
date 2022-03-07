<script type="text/javascript" src="<?php echo base_url("assets/js/discapacidad/validate/editdatoscuidador.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite Certificado de Discapacidad
		<br><small>Editar datos del cuidador</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_pnombre">Primer Nombre (*)</label>
						<div>
							<input id="cuidador_pnombre" name="cuidador_pnombre" value="<?php echo $information?$information[0]['cu_pnombre']:""; ?>" placeholder="Primer Nombre" class="form-control cuidador validate[required, maxSize[80]] regimen_no" type="text" autocomplete="off" required>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_snombre">Segundo Nombre</label>
							<div>
								<input id="cuidador_snombre" name="cuidador_snombre" value="<?php echo $information?$information[0]['cu_snombre']:""; ?>" placeholder="Segundo Nombre" class="form-control input-md cuidador validate[maxSize[80]] regimen_no" type="text" autocomplete="off">
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_papellido">Primer Apellido (*)</label>
						<div>
							<input id="cuidador_papellido" name="cuidador_papellido" value="<?php echo $information?$information[0]['cu_papellido']:""; ?>" placeholder="Primer Apellido" class="form-control input-md cuidador validate[required, maxSize[80]] regimen_no" required autocomplete="off" type="text">

						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_sapellido">Segundo Apellido</label>
							<div>
								<input id="cuidador_sapellido" name="cuidador_sapellido" value="<?php echo $information?$information[0]['cu_sapellido']:""; ?>" placeholder="Segundo Apellido" class="form-control input-md cuidador validate[maxSize[80]] regimen_no" type="text"  autocomplete="off">

							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="tipo_identificacion">Tipo de Identificación (*)</label>
						<div>
							<select name="cuidador_tipodoc" id="cuidador_tipodoc" class="form-control cuidador regimen_no" required>
							<option value=''>Selecccione...</option>
							<?php for ($i = 0; $i < count($tipo_identificacion); $i++) { ?>
								<option value="<?php echo $tipo_identificacion[$i]["IdTipoIdentificacion"]; ?>" <?php if($information[0]['cu_tipodoc'] == $tipo_identificacion[$i]["IdTipoIdentificacion"]) { echo "selected"; }  ?>><?php echo $tipo_identificacion[$i]['Descripcion']; ?>
									
								</option>	
							<?php } ?>
							</select>
						
						</div>
					</div>
					<div class="col-sm-6">
						<label for="nume_documento">No. de documento (*)</label>
						<div>
							<input id="cuidador_numdoc" name="cuidador_numdoc" value="<?php echo $information?$information[0]['cu_numdoc']:""; ?>" placeholder="Número de documento" class="form-control input-md cuidador validate[required, maxSize[11], custom[number]] regimen_no" required type="number"  autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="email_cuidador">Correo electrónico (*)</label>
						<div>
							<input id="email_cuidador" name="email_cuidador" value="<?php echo $information?$information[0]['cu_email']:""; ?>" placeholder="Correo electrónico " class="form-control input-md cuidador validate[required, custom[email]] regimen_no" required type="email" >
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_telefono">Teléfono fijo</label>
						<div>
							<input id="cuidador_telefono" name="cuidador_telefono" value="<?php echo $information?$information[0]['cu_telefono']:""; ?>" placeholder="Teléfono fijo" class="form-control input-md cuidador validate[required, maxSize[10], custom[number]] regimen_no" type="number" required  autocomplete="off">

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_celular">Teléfono celular</label>
						<div>
							<input id="cuidador_celular" name="cuidador_celular" value="<?php echo $information?$information[0]['cu_celular']:""; ?>" placeholder="Teléfono celular" class="form-control input-md cuidador validate[required, maxSize[10], custom[number]] regimen_no" type="number" required  autocomplete="off">

						</div>
					</div>
				</div>
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<br>
					<input type="button" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
					<input type="hidden" id="id_tramite" name="id_tramite" value="<?php echo $information[0]['id_tramite']; ?>"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">Ya existe un registro con los datos ingresados.</span></div>
			</div>	
		</div>
	</form>
</div>
