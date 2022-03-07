<script type="text/javascript" src="<?php echo base_url("assets/js/discapacidad/validate/editdatostramite.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tr&aacute;mite Certificado de Discapacidad
		<br><small>Editar datos personales</small>
	</h4>
</div>
<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="regimen_esp">¿Pertenece al régimen especial o de excepción?</label> <br><p>(Docentes Magisterio, Fuerzas Militares, Policía Nacional, Trabajadores Ecopetrol y Universidades Públicas en aplicaciones de la ley 647 del 2000).</p>
				    <div class="input-group">
				        <label class="radio-inline">
				        	<input class="regimen" type="radio" id="regimen_esp" name="regimen_esp" value="si" <?php echo $information[0]['regimen_esp']=='si'?'checked':""; ?>>Si
				        </label>
						<label class="radio-inline">
							<input class="regimen" type="radio" id="regimen_esp" name="regimen_esp" value="no" <?php echo $information[0]['regimen_esp']=='no'?'checked':""; ?>>No
						</label>
					</div>
					<div id="mensajeRegimen"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left regimen_no">
					<label for="cat_discapacidad">Categor&iacute;a de discapaciad:</label>
				    <div class="form-check-label">
					    <?php for ($i = 0; $i < count($categoria); $i++) { 
							$j=$i+1;	
							?>
							<label class="checkbox-inline" for="categoria">
							<input class="categoria" type="checkbox" id="categoria<?php echo $categoria[$i]["id_categoria"]; ?>" name="categoria<?php echo $categoria[$i]["id_categoria"]; ?>" value="1" <?php if($information[0]["categoria_$j"] >= 1) { echo "checked"; }  ?>>
							<?php echo $categoria[$i]["id_categoria"].'.'.$categoria[$i]["descripcion"];?>
							</label>
						<?php } ?>
					</div>
					<div id="mensajeCategoria"></div>
				</div>
			</div>
		</div>
		<div class="row regimen_no">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="dis_movilizar">¿Cuál dispositivo utiliza para movilizarse?:</label>
				    <div>
				    	<select name="movilizar" id="movilizar" class="form-control regimen_no" required>
						<option value=''>Selecccione...</option>
						<?php for ($i = 0; $i < count($movilizar); $i++) { ?>
							<option value="<?php echo $movilizar[$i]["id_moviliza"]; ?>" <?php if($information[0]['moviliza'] == $movilizar[$i]["id_moviliza"]) { echo "selected"; }  ?>><?php echo $movilizar[$i]['nombre_dispositivo']; ?>
								
							</option>	
						<?php } ?>
						</select>
					</div>
					
				</div>
			</div>
			<div class="col-sm-6">
				<label for="cual_movilizar">Otro cu&aacute;l:</label>
				<div>
					<input id="cual_movilizar" name="cual_movilizar" value="<?php echo $information?$information[0]['cual_moviliza']:""; ?>" placeholder="Cuál dispositivo" class="form-control input-md validate[required,maxSize[80]] regimen_no" type="text" required  autocomplete="off" disabled="disabled">

				</div>
			</div>	
		</div>
		<div class="row regimen_no">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="dis_comunicar">¿Cuál dispositivo utiliza para comunicarse?:</label>
				    <div>
						<select name="comunicar" id="comunicar" class="form-control regimen_no" required>
						<option value=''>Selecccione...</option>
						<?php for ($i = 0; $i < count($comunicar); $i++) { ?>
							<option value="<?php echo $comunicar[$i]["id_comunica"]; ?>" <?php if($information[0]['comunica'] == $comunicar[$i]["id_comunica"]) { echo "selected"; }  ?>><?php echo $comunicar[$i]['nombre_dispositivo']; ?>
								
							</option>	
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<label for="cual_comunicar">Otro cu&aacute;l:</label>
				<div>
					<input id="cual_comunicar" name="cual_comunicar" value="<?php echo $information?$information[0]['cual_comunica']:""; ?>" placeholder="Cuál dispositivo" class="form-control input-md validate[required,maxSize[80]] regimen_no" type="text" required  autocomplete="off"disabled="disabled">

				</div>
			</div>	
		</div>

		<div class="row regimen_no">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="req_acompanante">¿Requiere acompa&ntilde;ante?:</label>
				    <div class="input-group">
				        <label class="radio-inline">
				        	<input class="acompanante" type="radio" id="req_acompanante" name="req_acompanante" value="si" <?php echo $information[0]['req_acompanante']=='si'?'checked':""; ?>>Si
				        </label>
						<label class="radio-inline">
							<input class="acompanante" type="radio" id="req_acompanante" name="req_acompanante" value="no" <?php echo $information[0]['req_acompanante']=='no'?'checked':""; ?>>No
						</label>
					</div>
					<div id="mensajeacompanante"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="vive_persona">¿Vive con una persona que presente condici&oacute;n de discapacidad?:</label>
					<div class="input-group">
				        <label class="radio-inline">
				        	<input class="persona" type="radio" id="vive_persona" name="vive_persona" value="si" <?php echo $information[0]['vive_persona']=='si'?'checked':""; ?>>Si
				        </label>
						<label class="radio-inline">
							<input class="persona" type="radio" id="vive_persona" name="vive_persona" value="no" <?php echo $information[0]['vive_persona']=='no'?'checked':""; ?>>No
						</label>
					</div>
					<div id="mensajepersona"></div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label for="ips">Seleccione la IPS</label>
				<div>
					<select name="ips" id="ips" class="form-control regimen_no" required>
					<option value=''>Selecccione...</option>
					<?php for ($i = 0; $i < count($lista_ips); $i++) { ?>
						<option value="<?php echo $lista_ips[$i]["id_ips"]; ?>" <?php if($information[0]['id_ips'] == $lista_ips[$i]["id_ips"]) { echo "selected"; }  ?>><?php echo $lista_ips[$i]['nombre_ips']; ?>
						</option>	
					<?php } ?>
					</select>
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
