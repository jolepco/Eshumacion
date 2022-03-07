<div id="page-wrapper">
	<div class="modal-header">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="list-group-item-heading">
					<i class="fa fa-wheelchair"></i> &nbsp;  TR&Aacute;MITE CERTIFICADO DE DISCAPACIDAD
				</h4>
			</div>
			<?php
				$retornoExito = $this->session->flashdata('retornoExito');
				if ($retornoExito) {
					?>
					<div class="col-lg-12">	
						<div class="alert alert-success ">
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<?php echo $retornoExito ?>		
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
	<div class="modal-body">
		
		<form name="form" id="form" method="post" action="<?php echo base_url('/certificado_discapacidad/registrar_tramite/')?>" enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bookmark"></i> Datos del trámite
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group text-left">
							<label for="regimen_esp">¿Pertenece al régimen especial o de excepción?</label> <br><p>(Docentes Magisterio, Fuerzas Militares, Policía Nacional, Trabajadores Ecopetrol y Universidades Públicas en aplicaciones de la ley 647 del 2000).</p>
						    <div class="input-group">
						        <label class="radio-inline">
						        	<input class="regimen" type="radio" id="regimen_esp" name="regimen_esp" value="si">Si
						        </label>
								<label class="radio-inline">
									<input class="regimen" type="radio" id="regimen_esp" name="regimen_esp" value="no" >No
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
									<option value="<?php echo $movilizar[$i]["id_moviliza"]; ?>" <?php if($information[0]->movilizar_plaza == $movilizar[$i]["id_moviliza"]) { echo "selected"; }  ?>><?php echo $movilizar[$i]['nombre_dispositivo']; ?>
										
									</option>	
								<?php } ?>
								</select>
							</div>
							
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cual_movilizar">Otro cu&aacute;l:</label>
						<div>
							<input id="cual_movilizar" name="cual_movilizar" value="<?php echo $information?$information->enc_sapellido:""; ?>" placeholder="Cuál dispositivo" class="form-control input-md validate[required,maxSize[80]] regimen_no" type="text" required  autocomplete="off" disabled="disabled">

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
									<option value="<?php echo $comunicar[$i]["id_comunica"]; ?>" <?php if($information[0]->comunicar_plaza1 == $comunicar[$i]["id_comunica"]) { echo "selected"; }  ?>><?php echo $comunicar[$i]['nombre_dispositivo']; ?>
										
									</option>	
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cual_comunicar">Otro cu&aacute;l:</label>
						<div>
							<input id="cual_comunicar" name="cual_comunicar" value="<?php echo $information?$information->enc_sapellido:""; ?>" placeholder="Cuál dispositivo" class="form-control input-md validate[required,maxSize[80]] regimen_no" type="text" required  autocomplete="off"disabled="disabled">

						</div>
					</div>	
				</div>

				<div class="row regimen_no">
					<div class="col-sm-6">
						<div class="form-group text-left">
							<label for="req_acompanante">¿Requiere acompa&ntilde;ante?:</label>
						    <div class="input-group">
						        <label class="radio-inline">
						        	<input class="acompanante" type="radio" id="req_acompanante" name="req_acompanante" value="si">Si
						        </label>
								<label class="radio-inline">
									<input class="acompanante" type="radio" id="req_acompanante" name="req_acompanante" value="no" >No
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
						        	<input class="persona" type="radio" id="vive_persona" name="vive_persona" value="si">Si
						        </label>
								<label class="radio-inline">
									<input class="persona" type="radio" id="vive_persona" name="vive_persona" value="no">No
								</label>
							</div>
							<div id="mensajepersona"></div>
						</div>
					</div>	
				</div>
				<!-- <div class="row">
					<div class="col-sm-6 regimen_no">
						<label for="ips">Seleccione la IPS</label>
						<div>
							<select name="ips" id="ips" class="form-control regimen_no" required>
							<option value=''>Selecccione...</option>
							<?php for ($i = 0; $i < count($lista_ips); $i++) { ?>
								<option value="<?php echo $lista_ips[$i]["id_ips"]; ?>" <?php if($information->nivel_educativo == $lista_ips[$i]["id_ips"]) { echo "selected"; }  ?>><?php echo $lista_ips[$i]['nombre_ips']; ?>
									
								</option>	
							<?php } ?>
							</select>
						
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="panel panel-default cuidador" style="display:none">
			<div class="panel-heading">
			<i class="fa fa-user-md"></i> Datos del cuidador
			</div>	
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_pnombre">Primer Nombre (*)</label>
						<div>
							<input id="cuidador_pnombre" name="cuidador_pnombre" value="<?php echo $information?$information->enc_pnombre:""; ?>" placeholder="Primer Nombre" class="form-control cuidador validate[required, maxSize[80]] regimen_no" type="text" autocomplete="off" required>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_snombre">Segundo Nombre</label>
							<div>
								<input id="cuidador_snombre" name="cuidador_snombre" value="<?php echo $information?$information->enc_snombre:""; ?>" placeholder="Segundo Nombre" class="form-control input-md cuidador validate[maxSize[80]] regimen_no" type="text" autocomplete="off">
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_papellido">Primer Apellido (*)</label>
						<div>
							<input id="cuidador_papellido" name="cuidador_papellido" value="<?php echo $information?$information->enc_papellido:""; ?>" placeholder="Primer Apellido" class="form-control input-md cuidador validate[required, maxSize[80]] regimen_no" required autocomplete="off" type="text">

						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_sapellido">Segundo Apellido</label>
							<div>
								<input id="cuidador_sapellido" name="cuidador_sapellido" value="<?php echo $information?$information->enc_sapellido:""; ?>" placeholder="Segundo Apellido" class="form-control input-md cuidador validate[maxSize[80]] regimen_no" type="text"  autocomplete="off">
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
								<option value="<?php echo $tipo_identificacion[$i]["IdTipoIdentificacion"]; ?>" <?php if($information->nivel_educativo == $tipo_identificacion[$i]["IdTipoIdentificacion"]) { echo "selected"; }  ?>><?php echo $tipo_identificacion[$i]['Descripcion']; ?>
									
								</option>	
							<?php } ?>
							</select>
						
						</div>
					</div>
					<div class="col-sm-6">
						<label for="nume_documento">No. de documento (*)</label>
						<div>
							<input id="cuidador_numdoc" name="cuidador_numdoc" value="<?php echo $information?$information->enc_numdoc:""; ?>" placeholder="Número de documento" class="form-control input-md cuidador validate[required] regimen_no" required type="text"  autocomplete="off">
						</div>
						<div id="mensajeTipoDoc"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="email_cuidador">Correo electrónico (*)</label>
						<div>
							<input id="email_cuidador" name="email_cuidador" value="<?php echo $information?$information->enc_email:""; ?>" placeholder="Correo electrónico " class="form-control input-md cuidador validate[required, custom[email]] regimen_no" required type="email" >
						</div>
					</div>
					<div class="col-sm-6">
						<label for="cuidador_telefono">Teléfono fijo</label>
						<div>
							<input id="cuidador_telefono" name="cuidador_telefono" value="<?php echo $information?$information->enc_telefono:""; ?>" placeholder="Teléfono fijo" class="form-control input-md cuidador validate[required, maxSize[10], minSize[9], custom[number]] regimen_no" type="number" required  autocomplete="off">

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="cuidador_celular">Teléfono celular</label>
						<div>
							<input id="cuidador_celular" name="cuidador_celular" value="<?php echo $information?$information->enc_celular:""; ?>" placeholder="Teléfono celular" class="form-control input-md cuidador validate[required, maxSize[10], custom[number]] regimen_no" type="number" required  autocomplete="off">

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default regimen_no">
			<div class="panel-heading">
				<i class="fa fa-file-pdf-o"></i> Documentos del trámite
			</div>	
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert alert-info" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<b>Apreciado Usuario!</b>
						<p>Los documentos adjuntos deben estar en formato PDF y su tama&ntilde;o máximo debe ser de 3MB, recomendamos escanear los documentos en un scaner, no utilizar las aplicaciones de los dispositivos móviles como celulares o tablet, ya que los documentos quedan con un tamaño demasiado grande y pude tener problemas al momento de cargar los documentos en el formlulario. Ante cualquier inquietud en relación a los documentos, favor contactar vía correo electronico al correo discapacidad@saludcapital.gov.co</p>
						
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group text-left">
							<label for="historia_clinica">1. Copia de la última historia clínica con diagnóstico CIE 10 relacionado con la discapacidad:
							</label>
						    <div class="input-group">
						        <label class="input-group-btn">
									<span class="btn btn-primary btn-file">
						                Seleccionar archivo <input accept=".pdf" class="hidden" name="historia_clinica" type="file" id="historia_clinica">
						            </span>
						        </label>
						        <input class="form-control regimen_no validate[required]" id="historia_clinica" name="historia_clinica" type="text" value=""  readonly="readonly" required="required">
							</div> 
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group text-left">
							<label for="examen_medico">2. Copia de los exámenes médicos más recientes que complemente el diagnóstico de discapacidad:</label>
						    <div class="input-group">
						        <label class="input-group-btn">
									<span class="btn btn-primary btn-file">
						                Seleccionar archivo <input accept=".pdf" class="hidden" name="examen_medico" type="file" id="examen_medico">
						            </span>
						        </label>
						        <input class="form-control regimen_no" id="examen_medico" name="examen_medico" type="text" value="" readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group text-left">
							<label for="copia_documento">3. Copia del documento de identificación:</label>
						    <div class="input-group">
						        <label class="input-group-btn">
									<span class="btn btn-primary btn-file">
						                Seleccionar archivo <input accept=".pdf" class="hidden" name="copia_documento" type="file" id="copia_documento">
						            </span>
						        </label>
						        <input class="form-control regimen_no" id="copia_documento" name="copia_documento" type="text" value=""  readonly="readonly" required>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group text-left">
							<label for="certificado_residencia">4. Certificado de residencia de Bogotá: </label>
						    <div class="input-group">
						        <label class="input-group-btn">
									<span class="btn btn-primary btn-file">
						                Seleccionar archivo <input accept=".pdf" class="hidden" name="certificado_residencia" type="file" id="certificado_residencia">
						            </span>
						        </label>
						        <input class="form-control regimen_no" id="certificado_residencia" name="certificado_residencia" type="text" value=""  readonly="readonly" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group text-left">
							<label for="valoracion_domiciliaria">5. La valoración en modalidad domiciliaria, será excepcional, y procederá únicamente por orden expresa del médico tratante:</label>
						    <div class="input-group">
						        <label class="input-group-btn">
									<span class="btn btn-primary btn-file">
						                Seleccionar archivo <input accept=".pdf" class="hidden" name="valoracion_domiciliaria" type="file" id="valoracion_domiciliaria">
						            </span>
						        </label>
						        <input class="form-control regimen_no" id="valoracion_domiciliaria" name="valoracion_domiciliaria" type="text" value=""  readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group text-left">
							<label class="control-label" for="observaciones">Observaciones :</label>
							<textarea name="observaciones" id="observaciones" class="form-control regimen_no" rows="3" cols="50"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">	
				<div class="row">
					<div class="form-group" id="div_enviar">	
						<div class="col-sm-12">
							
							<input type="checkbox" name="acepta_terminos" id="acepta_terminos">  He leído y acepto los <a href="" data-toggle="modal" data-target="#modalTratamiento">términos y condiciones de uso</a>
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" align="center">
							<div style="width:50%;" align="center">
								<!--<input type="button" id="btnSubmit" name="btnSubmit" value="Enviar" class="btn btn-success" disabled/>-->
								<button type="submit" id="btnSubmit" class="btn btn-success" disabled>Enviar</button>
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
			</div>
		</div>
			
		</form>
		
		<div class="modal" tabindex="-1" role="dialog" id="modalTratamiento">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<div class="modal-header text-center">
					<h5 class="modal-title" id="exampleModalLabel">TERMINOS Y CONDICIONES TRATAMIENTO DE DATOS </h5>
				</div>
				<div class="modal-body">
					<ol>
						<li value="1">
							Los datos personales proporcionados a la Secretar&iacute;a Distrital de Salud, en adelante SDS son objeto de tratamiento (recolecci&oacute;n, almacenamiento, uso, circulaci&oacute;n, o supresi&oacute;n), con el fin de darles finalidad espec&iacute;fica para la que fueron suministrados y cumplimiento de las funciones constitucionales y legales de la Entidad. Seg&uacute;n la reglamentaci&oacute;n de la respectiva funci&oacute;n o del servicio en virtud del cual el titular proporcion&oacute; dichos datos.
						</li>
						<li>
							El tratamiento de los datos personales se realiza como la Entidad rectora en salud en Bogot&aacute; D.C. con la finalidad de garantizar el derecho a la salud a trav&eacute;s de un modelo de atenci&oacute;n integral e integrado y la gobernanza, para contribuir al mejoramiento de la calidad de vida de la poblaci&oacute;n del Distrito Capital. 
						</li>
						<li>
							La modalidad de divulgaci&oacute;n del dato personal ocurrir&aacute; de manera leg&iacute;tima, cuando la motivaci&oacute;n de la solicitud de informaci&oacute;n est&eacute; basada en una clara y espec&iacute;fica competencia funcional de la SDS.
						</li>
						<li>
							El titulat tiene derecho a optar por no suministrar cualquier informaci&oacute;n sensible solicitada por la SDS, relacindada, entre otros, con datos sobre su origen racial o &eacute;tnico, la pertenencia a sindicatos, organizaciones sociales o de derechos humanos, convicciones pol&iacute;ticas, religiosas, de la vida sexual, datos biom&eacute;tricos o datos de salud.
						</li>
						<li>
							El suministro de los datos personales de menores de edad es facultativo y debe realizarse con autorizaci&oacute;n del padre, la madre o del representante legal del menor.
						</li>
						<li>
							La SDS vela por el uso adecuado de los datos personales de ni&ntilde;as, ni&ntilde;os y adolecentes, y respetar&aacute; en su tratamiento el inter&eacute;s superior de aquellos, asgurando la protecci&oacute;n de sus derechos funtamentales.
						</li>
						<li>
							Una vez la SDS accede al dato personal se convierte en responsable y encargada del tratamiento del dato, con el deber de garantizar los derechos fundamentales del titular de la informaci&oaccute;n previstos en la constituci&oacute;n pl&iacute;tica y en consecuencia debe:
							<ol type="a">
					            <li>Conservar con las debidas seguridades la informaci&oacute;n recibida para impedir su deterioro, p&eacute;rdida, alteraci&oacute;n, uso no autorizado o fraudulento.</li>
					            <li>Guardad reserva de la informaci&oacute;n que le sea suministrada por el titular, en los t&eacute;rminos se&ntilde;alados en el ordenamiento jur&iacute;dico vigente aplicable a la materia.</li>
					            <li>Utilizar los datos personales &uacute;nicamente para los fines que justificaron la entrega, esto es, aquellos relacionados con la competencia funcional espec&iacute;fica que motiv&oacute; la solicitud de suministros del dato personal.</li>
					            <li>Informar a los titulares del dato el uso que se le est&eacute; dando al mismo, en caso de requerido el titular.</li>
					            <li>Cumplir con las intrucciones que imparta la autoridad de control en relaci&oacute;n con el cumplimiento de la legislaci&oacute;n estatutaria.</li>
					    	</ol>
						</li>
					</ol>
				</div>
				<div class="modal-footer">
					<button id="aceptarTerminos" class="btn btn-success">Aceptar</button>
				</div>
		    </div>
		  </div>
		</div>
	</div>
</div>