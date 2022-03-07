<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/registrar_nuevo.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite autorizaci&oacute;n de plazas
		<br><small>Registro información encargado del trámite Plazas de Servicio Social</small>
	</h4>
</div>
<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="id_tramite" name="id_tramite" value="<?php echo $information?$information[0]["id_tramite"]:'x';?>"/>
		<div class="row">
			<div class="col-sm-4">
				<label for="encargado_pnombre">Primer Nombre (*)</label>
				<div>
					<input id="encargado_pnombre" name="encargado_pnombre" value="<?php echo $information?$information->enc_pnombre:""; ?>" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" autocomplete="off" required>
				</div>
			</div>
			<div class="col-sm-4">
				<label for="encargado_snombre">Segundo Nombre</label>
					<div>
						<input id="encargado_snombre" name="encargado_snombre" value="<?php echo $information?$information->enc_snombre:""; ?>" placeholder="Segundo Nombre" class="form-control input-md validate[maxSize[80]]" type="text" autocomplete="off">
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<label for="encargado_papellido">Primer Apellido (*)</label>
				<div>
					<input id="encargado_papellido" name="encargado_papellido" value="<?php echo $information?$information->enc_papellido:""; ?>" placeholder="Primer Apellido" class="form-control input-md validate[required, maxSize[80]]" required autocomplete="off" type="text">

				</div>
			</div>
			<div class="col-sm-4">
				<label for="encargado_sapellido">Segundo Apellido</label>
					<div>
						<input id="encargado_sapellido" name="encargado_sapellido" value="<?php echo $information?$information->enc_sapellido:""; ?>" placeholder="Segundo Apellido" class="form-control input-md validate[maxSize[80]]" type="text"  autocomplete="off">

					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<label for="tipo_identificacion">Tipo de Identificación (*)</label>
				<div>
					<select name="encargado_tipodoc" id="encargado_tipodoc" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($tipo_identificacion); $i++) { ?>
						<option value="<?php echo $tipo_identificacion[$i]["IdTipoIdentificacion"]; ?>" <?php if($information->nivel_educativo == $tipo_identificacion[$i]["IdTipoIdentificacion"]) { echo "selected"; }  ?>><?php echo $tipo_identificacion[$i]['Descripcion']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-4">
				<label for="nume_documento">No. de documento (*)</label>
				<div>
					<input id="encargado_numdoc" name="encargado_numdoc" value="<?php echo $information?$information->enc_numdoc:""; ?>" placeholder="Número de documento" class="form-control input-md validate[required, maxSize[11], custom[number]]" required type="number"  autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<label for="encargado_email">Correo electrónico (*)</label>
				<div>
					<input id="encargado_email" name="encargado_email" value="<?php echo $information?$information->enc_email:""; ?>" placeholder="Correo electrónico " class="form-control input-md validate[required, custom[email]]" required type="email" >
				</div>
			</div>
			<div class="col-sm-4">
				<label for="email_confirma">Confirmar Correo electrónico (*)</label>
				<div>
					<input id="email_confirma" name="email_confirma" placeholder="Correo electrónico " class="form-control input-md validate[required, custom[email], equalTo[encargado_email]]" required="" type="email">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<label for="encargado_telefono">Teléfono fijo</label>
				<div>
					<input id="encargado_telefono" name="encargado_telefono" value="<?php echo $information?$information->enc_telefono:""; ?>" placeholder="Teléfono fijo" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="number" required  autocomplete="off">

				</div>
			</div>
			<div class="col-sm-4">
				<label for="encargado_celular">Teléfono celular</label>
				<div>
					<input id="encargado_celular" name="encargado_celular" value="<?php echo $information?$information->enc_celular:""; ?>" placeholder="Teléfono celular" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="number" required  autocomplete="off">

				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-10">
				<input type="button" id="btnSubmit" name="btnSubmit" value="Registrar" class="btn btn-primary"/>

				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancelar</span></button>
		</div>
		
		<div class="row">
			<div class="col-sm-10">
				<div id="div_load" style="display:none">		
					<div class="progress progress-striped active">
						<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
							<span class="sr-only">45% completado</span>
						</div>
					</div>
				</div>
				<div id="div_error" style="display:none">			
					<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">Hay un trámite registrado para el día de hoy...</span></div>
				</div>
			</div>	
		</div>
	</form>
</div>
