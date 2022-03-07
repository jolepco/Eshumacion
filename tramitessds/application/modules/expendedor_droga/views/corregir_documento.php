<script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/validate/editar_documento.js"); ?>"></script>
<div id="page-wrapper">
	<div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-header">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="list-group-item-heading">
					<i class="fa fa-gear fa-fw"></i> &nbsp;  SOLICITUD DE RESOLUCI&Oacute;N DE EXPENDEDOR DE DROGAS
				</h4>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<p class="text-danger text-left">Por favor cargar los siguientes documentos en formato PDF, tama&ntilde;o máximo permitido 2 Mb por archivo:</p>
		<p class="text-danger text-left">Los campos con * son obligatorios.</p>
		<form name="form" id="form" method="post" action="<?php echo base_url('/expendedor_droga/editar_documentos/')?>" enctype="multipart/form-data">
			<input type="hidden" id="id_documento" name="id_documento" value="<?php echo $id_documento; ?>"/>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group text-left">
						<label for="<?php echo $nombre; ?>"><?php echo $nombre; ?> *</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="<?php echo $nombre; ?>" type="file" id="<?php echo $nombre; ?>">
					            </span>
					        </label>
					        <input class="form-control" id="<?php echo $nombre; ?>" name="<?php echo $nombre; ?>" type="text" value="" readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
					
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group text-left">
						<label class="control-label" for="observaciones">Observaciones :</label>
						<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-sm-7" align="center">
						<div style="width:50%;" align="center">
							<!--<input type="button" id="btnSubmit" name="btnSubmit" value="Enviar" class="btn btn-success" disabled/>-->
							<button type="submit" id="btnSubmit" class="btn btn-success">Enviar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
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
					<div id="div_terminos" style="display:none">
						<div class="alert alert-success"><span class="glyphicon glyphicon-ok" id="span_ msj"> &nbsp Terminos y condiciones aceptados.</span></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>