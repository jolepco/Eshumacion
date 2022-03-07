<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/editproyecto.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite autorización de plazas servicio social obligatorio
		<br><small>Editar datos del proyecto y tipo de plaza de servicio social</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" method="post" action="<?php echo base_url('/plazas/save_editproyecto/')?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6">
				<label for="modalidad">Modalidad de la Plaza (*)</label>
				<div>
					<select name="modalidad" id="modalidad" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($modalidad); $i++) { ?>
						<option value="<?php echo $modalidad[$i]["id_modalidad"]; ?>" <?php if($information[0]->modalidad_plaza == $modalidad[$i]["id_modalidad"]) { echo "selected"; }  ?>><?php echo $modalidad[$i]['descripcion']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="nro_plazas">Plazas solicitadas: *</label>
					<input type="text" id="nro_plazas" name="nro_plazas" class="form-control" value="<?php echo $information?$information[0]->nro_plazas:""; ?>" placeholder="Primer nombre" required>
				</div>
			</div>
		</div>
		<div class="row investigacion" style="display:none">
			<div class="col-sm-12">
				<label for="nombre_proyecto">Nombre proyecto investigación (*)</label>
				<div>
					<input id="nombre_proyecto" name="nombre_proyecto" placeholder="Ingresar el Nombre del Proyecto, Maximo 200 caracteres" class="form-control validate[required, maxSize[200]]" value ="<?php echo $information?$information[0]->nom_proyecto:""; ?>" type="text" autocomplete="off" title="Ingresar el Nombre del Proyecto, Maximo 200 caracteres" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label for="tipo_profesion">Tipo profesión o especialidad (*)</label>
				<div>
					<select name="tipo_profesion" id="tipo_profesion" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($profesiones); $i++) { ?>
						<option value="<?php echo $profesiones[$i]["id_profesion"]; ?>" <?php if($information[0]->tipo_profesion == $profesiones[$i]["id_profesion"]) { echo "selected"; }  ?>><?php echo $profesiones[$i]['nombre']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-6">
				<label for="tipo_vinculacion">Tipo Vinculación (*)</label>
				<div>
					<select name="tipo_vinculacion" id="tipo_vinculacion" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($vinculacion); $i++) { ?>
						<option value="<?php echo $vinculacion[$i]["id_vinculacion"]; ?>" <?php if($information[0]->tipo_vinculacion == $vinculacion[$i]["id_vinculacion"]) { echo "selected"; }  ?>><?php echo $vinculacion[$i]['descripcion']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label for="labelespecialidad">Especialidad (*)</label>
				<div>
					<input id="especialidad" name="especialidad" value ="<?php echo $information?$information[0]->especialidad:""; ?>" placeholder="Ingresar el Nombre de la Especialidad" class="form-control validate[required, maxSize[200]]" type="text" autocomplete="off" <?php echo $disabled; ?>  required>
				</div>
			</div>
			<div class="col-sm-6">
				<label for="nro_poblacion">Población beneficiada (*)</label>
				<div>
					<input id="nro_poblacion" name="nro_poblacion" value ="<?php echo $information?$information[0]->nro_poblacion:""; ?>" placeholder="Favor ingresar un numero entero, entre 1 y 1000000" type="number" autocomplete="off" title="Favor ingresar un numero entero, entre 1 y 1000000" required style="width:100%;">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label for="salario_plaza">Salario asignado por Plaza Individual (*)</label>
				<div>
					<input id="salario_plaza" name="salario_plaza" value ="<?php echo $information?$information[0]->salario_asignado:""; ?>" type="number" placeholder="Ingresar un numero entero, sin decimales o separadores de miles" autocomplete="off" title="Ingresar un numero entero, sin decimales o separadores de miles" required style="width:100%;">
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="doc_correigido">1. Documento del proyecto (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="doc_corregido" type="file" id="doc_corregido">
				            </span>
				        </label>
				        <input class="form-control" id="doc_corregido" name="doc_corregido" type="text" value="" readonly="readonly">
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>
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
