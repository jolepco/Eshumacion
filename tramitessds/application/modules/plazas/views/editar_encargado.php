<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/editencargado.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite autorización de plazas servicio social obligatorio
		<br><small>Editar datos del encargao del trámite</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_numiden">N&uacute;mero de identificaci&oacute;n: *</label>
					<input type="text" id="enc_numiden" name="enc_numiden" class="form-control" value="<?php echo $information?$information[0]->enc_numdoc:""; ?>" placeholder="N&uacute;mero de identificaci&oacute;n">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tipo_doc">Tipo de identificación : *</label>
					<select name="tipo_doc" id="tipo_doc" class="form-control" required>
						<option value=''>Selecccione...</option>
						<?php for ($i = 0; $i < count($tipo_doc); $i++) { ?>
							<option value="<?php echo $tipo_doc[$i]["IdTipoIdentificacion"]; ?>" <?php if($information[0]->enc_tipodoc == $tipo_doc[$i]["IdTipoIdentificacion"]) { echo "selected"; }  ?>><?php echo $tipo_doc[$i]["Descripcion"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_pnombre">Primer nombre encargado del trámite: *</label>
					<input type="text" id="enc_pnombre" name="enc_pnombre" class="form-control" value="<?php echo $information?$information[0]->enc_pnombre:""; ?>" placeholder="Primer nombre" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_snombre">Segundo nombre encargado del trámite: *</label>
					<input type="text" id="enc_snombre" name="enc_snombre" class="form-control" value="<?php echo $information?$information[0]->enc_snombre:""; ?>" placeholder="Segundo nombre">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_papellido">Primer apellido encargado del trámite: *</label>
					<input type="text" id="enc_papellido" name="enc_papellido" class="form-control" value="<?php echo $information?$information[0]->enc_papellido:""; ?>" placeholder="Primer apellido" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_sapellido">Segundo apellido encargado del trámite: *</label>
					<input type="text" id="enc_sapellido" name="enc_sapellido" class="form-control" value="<?php echo $information?$information[0]->enc_sapellido:""; ?>" placeholder="Segundo apellido">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_email">Correo electr&oacute;nico: *</label>
					<input type="text" id="enc_email" name="enc_email" class="form-control" value="<?php echo $information?$information[0]->enc_email:""; ?>" placeholder="Correo" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_telefono">Tel&eacute;fono fijo: *</label>
					<input type="text" id="enc_telefono" name="enc_telefono" class="form-control" value="<?php echo $information?$information[0]->enc_telefono:""; ?>" placeholder="Tel&eacute;fono fijo">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="enc_celular">Tel&eacute;fono celular: *</label>
					<input type="text" id="enc_celular" name="enc_celular" class="form-control" value="<?php echo $information?$information[0]->enc_celular:""; ?>" placeholder="Tel&eacute;fono celualr" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
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
