<script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/validate/recurso.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite expendedor de droga
		<br><small>Recurso de aclaraci&oacute;n</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" method="post" action="<?php echo base_url('/expendedor_droga/registrar_recurso/')?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="observaciones">Escriba los motivos por el cual est&aacute; presetando el recurso da aclaraci&oacute;n:</label>
					<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50" required></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="recurso_aclaracion">Adjunte un documento que soporte la aclaraci&oacute;n:</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="recurso_aclaracion" type="file" id="recurso_aclaracion">
				            </span>
				        </label>
				        <input class="form-control" id="recurso_aclaracion" name="recurso_aclaracion" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="submit" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
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
