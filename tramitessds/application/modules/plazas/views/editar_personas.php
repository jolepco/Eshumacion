<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/editpersona.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite autorización de plazas servicio social obligatorio
		<br><small>Editar datos del representante legal</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n: *</label>
					<input type="text" id="numiden" name="numiden" class="form-control" value="<?php echo $information?$information->nume_identificacion:""; ?>" placeholder="N&uacute;mero de identificaci&oacute;n" disabled>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="rsocial">Razón social: *</label>
					<input type="text" id="rsocial" name="rsocial" class="form-control" value="<?php echo $information?$information->nombre_rs:""; ?>" placeholder="N&uacute;mero de identificaci&oacute;n" disabled>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="p_nombre">Primer nombre representante legal: *</label>
					<input type="text" id="p_nombre" name="p_nombre" class="form-control" value="<?php echo $information?$information->p_nombre:""; ?>" placeholder="Primer nombre" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="s_nombre">Segundo nombre representante legal: *</label>
					<input type="text" id="s_nombre" name="s_nombre" class="form-control" value="<?php echo $information?$information->s_nombre:""; ?>" placeholder="Segundo nombre">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="p_apellido">Primer apellido representante legal: *</label>
					<input type="text" id="p_apellido" name="p_apellido" class="form-control" value="<?php echo $information?$information->p_apellido:""; ?>" placeholder="Primer apellido" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="s_apellido">Segundo apellido representante legal: *</label>
					<input type="text" id="s_apellido" name="s_apellido" class="form-control" value="<?php echo $information?$information->s_apellido:""; ?>" placeholder="Segundo apellido">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo electr&oacute;nico: *</label>
					<input type="text" id="email" name="email" class="form-control" value="<?php echo $information?$information->email:""; ?>" placeholder="Correo" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="telefono_fijo">Tel&eacute;fono fijo: *</label>
					<input type="text" id="telefono_fijo" name="telefono_fijo" class="form-control" value="<?php echo $information?$information->telefono_fijo:""; ?>" placeholder="Tel&eacute;fono fijo">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="telefono_celular">Tel&eacute;fono celular: *</label>
					<input type="text" id="telefono_celular" name="telefono_celular" class="form-control" value="<?php echo $information?$information->telefono_celular:""; ?>" placeholder="Tel&eacute;fono celualr" required>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="dire_resi">Direcci&oacute;n: *</label>
					<input type="text" id="dire_resi" name="dire_resi" class="form-control" value="<?php echo $information?$information->dire_resi:""; ?>" placeholder="Direcci&oacute;n fijo" required>
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
