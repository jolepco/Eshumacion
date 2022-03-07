<script type="text/javascript" src="<?php echo base_url("assets/js/plazas/validate/registrar_proyecto.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite autorizaci&oacute;n de plazas
		<br><small>Registro de proyecto y tipo de plaza de servicio social</small>
	</h4>
</div>
<div class="modal-body">
	<form name="form" id="form" method="post" action="<?php echo base_url('/plazas/save_proyecto/')?>" enctype="multipart/form-data">
		<input type="hidden" id="id_tramite" name="id_tramite" value="<?php echo $information?$information[0]["id_tramite"]:'x';?>"/>
		<div class="row">
			<div class="col-sm-6">
				<label for="modalidad">Modalidad de la Plaza (*)</label>
				<div>
					<select name="modalidad" id="modalidad" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($modalidad); $i++) { ?>
						<option value="<?php echo $modalidad[$i]["id_modalidad"]; ?>" <?php if($information->nivel_educativo == $modalidad[$i]["id_modalidad"]) { echo "selected"; }  ?>><?php echo $modalidad[$i]['descripcion']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-6">
				<label for="nro_plazas">Plazas solicitadas (*)</label>
				<div>
					<input id="nro_plazas" name="nro_plazas"  placeholder="Ingresar un numero entero, entre 1 y 10" type="number" autocomplete="off" style="width:100%;" title="Ingresar un numero entero, entre 1 y 10" required>
				</div>
			</div>
		</div>
		<div class="row investigacion" style="display:none">
			<div class="col-sm-12">
				<label for="nombre_proyecto">Nombre proyecto investigación (*)</label>
				<div>
					<input id="nombre_proyecto" name="nombre_proyecto" placeholder="Ingresar el Nombre del Proyecto, Maximo 200 caracteres" class="form-control validate[required, maxSize[200]]" type="text" autocomplete="off" title="Ingresar el Nombre del Proyecto, Maximo 200 caracteres" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<label for="tipo_profesion">Tipo profesión o especialidad (*)</label>
				<div>
					<select name="tipo_profesion" id="tipo_profesion" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($profesiones); $i++) { ?>
						<option value="<?php echo $profesiones[$i]["id_profesion"]; ?>" <?php if($information->nivel_educativo == $profesiones[$i]["id_profesion"]) { echo "selected"; }  ?>><?php echo $profesiones[$i]['nombre']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-4">
				<label for="tipo_vinculacion">Tipo Vinculación (*)</label>
				<div>
					<select name="tipo_vinculacion" id="tipo_vinculacion" class="form-control" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($vinculacion); $i++) { ?>
						<option value="<?php echo $vinculacion[$i]["id_vinculacion"]; ?>" <?php if($information->nivel_educativo == $vinculacion[$i]["id_vinculacion"]) { echo "selected"; }  ?>><?php echo $vinculacion[$i]['descripcion']; ?>
							
						</option>	
					<?php } ?>
					</select>
				
				</div>
			</div>
			<div class="col-sm-4">
				<label for="labelespecialidad">Especialidad (*)</label>
				<div>
					<input id="especialidad" name="especialidad" placeholder="Ingresar el Nombre de la Especialidad" class="form-control validate[required, maxSize[200]]" type="text" autocomplete="off" disabled="disabled" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label for="nro_poblacion">Población beneficiada (*)</label>
				<div>
					<input id="nro_poblacion" name="nro_poblacion" placeholder="Favor ingresar un numero entero, entre 1 y 1000000" type="number" autocomplete="off" title="Favor ingresar un numero entero, entre 1 y 1000000" required style="width:100%;">
				</div>
			</div>
			<div class="col-sm-6">
				<label for="salario_plaza">Salario asignado por Plaza Individual (*)</label>
				<div>
					<input id="salario_plaza" name="salario_plaza" type="number" placeholder="Ingresar un numero entero, sin decimales o separadores de miles" autocomplete="off" title="Ingresar un numero entero, sin decimales o separadores de miles" required style="width:100%;">
				</div>
			</div>
		</div>
		<div class="row">
			
		</div>
		<br>
		<div class="form-group  col-lg-12">
	        <div class="alert alert-warning" role="alert">Los documentos adjuntos deben ser en formato PDF y su tama&ntilde;o inferior a 3Mb. Ante cualquier inquietud en relación a los documentos, favor contactar vía correo electronico al correo contactenos@saludcapital.gov.co.</div>
	    </div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="doc_proyecto">1. Documento del proyecto (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="doc_proyecto" type="file" id="doc_proyecto">
				            </span>
				        </label>
				        <input class="form-control" id="doc_proyecto" name="doc_proyecto" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
			<div class="col-sm-6 investigacion" style="display:none">
				<div class="form-group text-left">
					<label for="hv_director">2. Hoja de Vida Director (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="hv_director" type="file" id="hv_director">
				            </span>
				        </label>
				        <input class="form-control" id="hv_director" name="hv_director" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
		</div>
		<div class="row investigacion" style="display:none">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="doc_actividades">3. Documento Actividades a Desempeñar (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="doc_actividades" type="file" id="doc_actividades">
				            </span>
				        </label>
				        <input class="form-control" id="doc_actividades" name="doc_actividades" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="doc_colciencias">4. Documento Inscripción Colciencias (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="doc_colciencias" type="file" id="doc_colciencias">
				            </span>
				        </label>
				        <input class="form-control" id="doc_colciencias" name="doc_colciencias" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
		</div>
		<div class="row investigacion" style="display:none">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="cert_disponibilidad">5. Certificado de Disponibilidad Presupuestal (*):</label>
				    <div class="input-group">
				        <label class="input-group-btn">
							<span class="btn btn-primary btn-file">
				                Seleccionar archivo <input accept=".pdf" class="hidden" name="cert_disponibilidad" type="file" id="cert_disponibilidad">
				            </span>
				        </label>
				        <input class="form-control" id="cert_disponibilidad" name="cert_disponibilidad" type="text" value="" readonly="readonly" required>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancelar</span></button>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
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
