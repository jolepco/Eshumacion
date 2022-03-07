<div id="page-wrapper">
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
		<div class="col-12 col-md-12">
		<br>
			<div class="alert alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<b>Apreciado Usuario!</b>
			<p>Los documentos adjuntos deben estar en formato PDF y su tama&ntilde;o máximo debe ser de 3MB, recomendamos escanear los documentos en un scaner, no utilizar las aplicaciones de los dispositivos móviles como celulares o tablet, ya que los documentos quedan con un tamaño demasiado grande y pude tener problemas al momento de cargar los documentos en el formlulario. Ante cualquier inquietud en relación a los documentos, favor contactar vía correo electronico al correo expendedormedicamentos@saludcapital.gov.co</p>
			
			</div>
		</div>
		<p class="text-danger text-left">Los campos con * son obligatorios.</p>
		<form name="form" id="form" method="post" action="<?php echo base_url('/expendedor_droga/registrar_documentos/')?>" enctype="multipart/form-data">
			
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="cedula">1. C&eacute;dula de ciudadan&iacute;a o c&eacute;dula de extranjer&iacute;a:</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="cedula" type="file" id="cedula">
					            </span>
					        </label>
					        <input class="form-control" id="cedula" name="cedula" type="text" value="" readonly="readonly" required>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="registro_civil">2. Registro civil de nacimiento o partia de Bautismo:</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="registro_civil" type="file" id="registro_civil">
					            </span>
					        </label>
					        <input class="form-control" id="registro_civil" name="registro_civil" type="text" value=""  readonly="readonly" required>
						</div>
					</div>
				</div>	
			</div>
			<?php if($information->edad < 50 && $information->sexo==1){ ?>  
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="tarjeta_reservista">3. Tarjeta de reservista (documento militar) excepto mayores de 50 a&ntilde;os:</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="tarjeta_reservista" type="file" id="tarjeta_reservista">
					            </span>
					        </label>
					        <input class="form-control" id="tarjeta_reservista" name="tarjeta_reservista" type="text" value="" readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="certificado_salud">4. Certificado de salud expedido por un m&eacute;dico debidamente 	registrado en el ministerio de salud o colegio de m&eacute;dicos colombiano, en donde conste que el solicitante no padece de enfermedad infecto-contagiosa que le impida vivir en comunidad:
						</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="certificado_salud" type="file" id="certificado_salud">
					            </span>
					        </label>
					        <input class="form-control" id="certificado_salud" name="certificado_salud" type="text" value=""  readonly="readonly" required>
						</div> 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="antecedentes_judiciales">5. Certificaci&oacute;n de antecedentes judiciales de policia nacional no mayor a un (1) mes:</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="antecedentes_judiciales" type="file" id="antecedentes_judiciales">
					            </span>
					        </label>
					        <input class="form-control" id="antecedentes_judiciales" name="antecedentes_judiciales" type="text" value="" readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="certificado_vecindad">6. Certificado de vecindad expedido por la autoridad competente del lugar de domicilio del interesado (alcald&iacute;a menor) no mayor a un (1) mes:</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="certificado_vecindad" type="file" id="certificado_vecindad">
					            </span>
					        </label>
					        <input class="form-control" id="certificado_vecindad" name="certificado_vecindad" type="text" value=""  readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="manisfestacion_expresa">7. Manifestaci&oacute;n expresa de dos (2) m&eacute;dicos graduados o qu&iacute;micos farmac&eacute;uticos debidamente registrados ante el lministerios de salud o colegio m&eacute;dico en donde conste que el peticionario se ha desempe&ntilde;ado como empleado vendedor de droguer&iacute;a, con honorabilidad, competencia y consagraci&oacute;n durante un periodo no menor a diez (10) a&ntilde;os.  Los profesionales deber&aacute;n tener como m&iacute;nimo diez (10) a&ntilde;os de graduados a la fecha de su declaraci&oacute;n: </label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="manisfestacion_expresa" type="file" id="manisfestacion_expresa">
					            </span>
					        </label>
					        <input class="form-control" id="manisfestacion_expresa" name="manisfestacion_expresa" type="text" value=""  readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="certificado_minsalud">8. Certificado expedido por el Ministerio De Salud &oacute; Colegio M&eacute;dico Colombiano de los profesionales que expiden la manifestación  (Resoluci&oacute;n &oacute; tarjeta profesional):</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="certificado_minsalud" type="file" id="certificado_minsalud">
					            </span>
					        </label>
					        <input class="form-control" id="certificado_minsalud" name="certificado_minsalud" type="text" value=""  readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label for="certificado_estudios">9. Certificado de terminaci&oacute;n de estudios del solicitante (m&iacute;nimo 5o. primaria):</label>
					    <div class="input-group">
					        <label class="input-group-btn">
								<span class="btn btn-primary btn-file">
					                Seleccionar archivo <input accept=".pdf" class="hidden" name="certificado_estudios" type="file" id="certificado_estudios">
					            </span>
					        </label>
					        <input class="form-control" id="certificado_estudios" name="certificado_estudios" type="text" value=""  readonly="readonly" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<label class="control-label" for="observaciones">Observaciones :</label>
						<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50"></textarea>
					</div>
				</div>
			</div>
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
		</form>
	</div>
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
				            <li>Cumplir con las intrucciones que imarta la autoridad de control en relaci&oacute;n con el cumplimiento de la legislaci&oacute;n estatutaria.</li>
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