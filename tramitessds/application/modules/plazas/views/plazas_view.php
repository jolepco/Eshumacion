<?php

    $retornoError = $this->session->flashdata('retorno_error');
    if ($retornoError) {
        ?>
    <div class="alert alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $retornoError ?>
    </div>
    <?php
    }

    $retornoExito = $this->session->flashdata('retorno_exito');
    if ($retornoExito) {
        ?>
        <div class="alert alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php echo $retornoExito ?>
        </div>
        <?php
    }

?>

									<!-- Formulario de entrada Plazas de Servicio Social-->
									<!-- Author Mario Beltran mebeltran@saludcapital.gov.co
									Ajuste validacion campo sin requerido HTML since 08102019-->

            <div class="row">
				<div class="row">
                            <div class="col-md-12">
                              <form class="form-inline" enctype="multipart/form-data" role="form" id="form_tramite" name="form_tramite" action="<?php echo base_url('usuario/guardarTramitePlazas')?>" method="post">
                              <fieldset>
                                <fieldset>
                                    <legend>Registro de Informaci&oacute;n<br>Encargado del Trámite Plazas de Servicio Social</legend>

									<div class="form-group col-lg-3">
										<label for="p_nombre">Primer Nombre (*)</label>
										<div>
											<input id="encargado_pnombre" name="encargado_pnombre" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" autocomplete="off" required>
										</div>
									</div>


									<div class="form-group col-lg-3">
										<label for="s_nombre">Segundo Nombre</label>
										<div>
											<input id="encargado_snombre" name="encargado_snombre" placeholder="Segundo Nombre" class="form-control input-md validate[maxSize[80]]" type="text" autocomplete="off">
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group col-lg-3">
										<label for="p_apellido">Primer Apellido (*)</label>
										<div>
											<input id="encargado_papellido" name="encargado_papellido" placeholder="Primer Apellido" class="form-control input-md validate[required, maxSize[80]]" required autocomplete="off" type="text">

										</div>
									</div>

									<div class="form-group col-lg-3">
										<label for="s_apellido">Segundo Apellido</label>
										<div>
											<input id="encargado_sapellido" name="encargado_sapellido" placeholder="Segundo Apellido" class="form-control input-md validate[maxSize[80]]" type="text"  autocomplete="off">

										</div>
									</div>
									<?php for ($i = 0; $i < count($tipo_identificacion); $i++) {
										echo "RRRR".$tipo_identificacion[$i]["IdTipoIdentificacion"];
									}
									?>
									<!-- Select Basic -->
									<div class="form-group col-lg-6">
										<label for="tipo_identificacion">Tipo de Identificaciónnnn (*)</label>
										<div>
											
											<select name="encargado_tipodoc" id="encargado_tipodoc" class="form-control" required>
											<option value=''>Selecccione...</option>
											<?php for ($i = 0; $i < count($tipo_identificacion); $i++) { ?>
												<option value="<?php echo $tipo_identificacion[$i]["IdTipoIdentificacion"]; ?>" <?php if($information->nivel_educativo == $tipo_identificacion[$i]["IdTipoIdentificacion"]) { echo "selected"; }  ?>><?php echo $tipo_identificacion[$i]->Descripcion; ?>
													
												</option>	
											<?php } ?>
											</select>
										
										</div>
									</div>

									<div class="form-group col-lg-6">
										<label for="nume_documento">N. de documento de identidad (*)</label>
										<div>
											<input id="encargado_numdoc" name="encargado_numdoc" placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required type="number"  autocomplete="off">
										</div>
									</div>


									<div class="form-group col-lg-6">
										<label for="email">Correo electrónico (*)</label>
										<div>
											<input id="encargado_email" name="encargado_email" placeholder="Correo electrónico " class="form-control input-md validate[required, custom[email]]" required type="email" >
										</div>
									</div>



									<div class="form-group col-lg-6">
										<label for="email">Confirmar Correo electrónico (*)</label>
										<div>
											<input id="email-confirma" name="email-confirma" placeholder="Correo electrónico " class="form-control input-md validate[required, custom[email], equals[encargado_email]]" required="" type="email">

										</div>
									</div>

									<!-- Text input-->
									<div class="form-group col-lg-6">
										<label for="telefono_fijo">Teléfono fijo</label>
										<div>
											<input id="encargado_telefono" name="encargado_telefono" placeholder="Teléfono fijo" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="number" required  autocomplete="off">

										</div>
									</div>

									<!-- Text input-->
									<div class="form-group col-lg-6">
										<label for="telefono_celular">Teléfono celular</label>
										<div>
											<input id="encargado_celular" name="encargado_celular" placeholder="Teléfono celular" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="number" required  autocomplete="off">

										</div>
									</div>
												
                                </fieldset>
                            </div>
							 <div class="col-md-12">
                                <fieldset>
                                    <legend>Datos del Proyecto y Tipo de Plaza de Servicio Social</legend>
                                    
									<div class="form-group col-lg-12">
										<label for="labeln_proyecto">Nombre Proyecto Investigación (*)</label>
										<div>
											<input id="nombre_proyecto" name="nombre_proyecto" placeholder="Favor ingresar el Nombre del Proyecto, Maximo 200 caracteres" class="form-control validate[required, maxSize[200]]" type="text" autocomplete="off" required>
										</div>
									</div>
									<div class="form-group col-lg-6">
										<label for="labeltipoprofesion">Tipo Profesión o Especialidad (*)</label>
										<div>
											<select id="tipo_profesion" name="tipo_profesion" class="form-control validate[required]" required>
                                                <option value="">Seleccione...</option>
                                                <option value="1">Medicina</option>
                                                <option value="2">Odontología</option>
												<option value="3">Enfermería</option>
												<option value="4">Bacteriología</option>
												<option value="5">Especialidad</option>
                                            </select>
										</div>
									</div>
									<div class="form-group col-lg-6" id="divespecialidad" style="display:none">
										<label for="labelespecialidad">Especialidad (*)</label>
										<div>
											<input id="especialidad" name="especialidad" placeholder="Favor ingresar el Nombre de la Especialidad" class="form-control validate[required, maxSize[200]]" type="text" autocomplete="off">
										</div>
									</div>									
									<div class="form-group col-lg-6" id="divtipovinculacion">
										<label for="labeltipovinculacion">Tipo Vinculación (*)</label>
										<div>
											<select id="tipo_vinculacion" name="tipo_vinculacion" class="form-control validate[required]" required>
                                                <option value="">Seleccione...</option>
                                                <option value="1">Contratación Reglamentaría</option>
                                                <option value="2">Orden Prestación de Servicios</option>
                                            </select>
										</div>
									</div>
									<div class="form-group col-lg-12">
										<label for="labelmodalidadplaza">Modalidad de la Plaza (*)</label>
										<div>
											<select id="modalidad_plaza" name="modalidad_plaza" class="form-control validate[required]" required>
                                                <option value="">Seleccione...</option>
                                                <option value="1">Prestación Servicio</option>
                                                <option value="2">Investigación en Salud</option>
												<option value="3">Atención Población Vulnerable</option>
												<option value="3">Planes de Salud Publica</option>
                                            </select>
										</div>
									</div>										
									<div class="form-group col-lg-6">
										<label for="labelno_plazassolicitadas">Numero de Plazas Solicitadas (*)</label>
										<div>
											<input id="no_plazas" name="no_plazas"  placeholder="Favor ingresar un numero entero, entre 1 y 10" type="number" autocomplete="off" required style="width:100%;">
										</div>
									</div>
									<div class="form-group col-lg-6">
										<label for="labelno_poblacionbeneficiada">Numero de Población Beneficiada (*)</label>
										<div>
											<input id="no_poblacion" name="no_poblacion" placeholder="Favor ingresar un numero entero, entre 1 y 1000000" type="number" autocomplete="off" required style="width:100%;">
										</div>
									</div>	
									<div class="form-group col-lg-6">
										<label for="labelsalario">Salario asignado por Plaza Individual (*)</label>
										<div>
											<input id="salario_plaza" name="salario_plaza" type="number" placeholder="Favor ingresar un numero entero, sin decimales o separadores de miles" autocomplete="off" required style="width:100%;">
										</div>
									</div>	
									
								</fieldset>
							</div>
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Documentos Adjuntos</legend>
                                    <div class="form-group  col-lg-12">
                                        <div class="alert alert-warning" role="alert">Los documentos adjuntos deben ser en formato PDF y su tama&ntilde;o inferior a 5Mb. Ante cualquier inquietud en relación a los documentos, favor contactar vía correo electronico al correo contactenos@saludcapital.gov.co.</div>
                                    </div>
                                    <div class="form-group  col-lg-6">
                                        <label for="pdf_documentoproyecto">Documento de Proyecto</label>
                                        <div>
                                            <input type="file" name="pdf_documentoproyecto" id="pdf_documentoproyecto" class="validate[required]" required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-6">
                                        <label for="pdf_hvdirector">Documento Hoja de Vida Director</label>
                                        <div>
                                            <input type="file" name="pdf_hvdirector" id="pdf_hvdirector" class="validate[required]" required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-6">
                                        <label for="pdf_actividades">Documento Actividades a Desempeñar</label>
                                        <div>
                                            <input type="file" name="pdf_actividades" id="pdf_actividades" class="validate[required]" required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-6">
                                        <label for="pdf_colciencias">Documento Inscripción Colciencias</label>
                                        <div>
                                            <input type="file" name="pdf_colciencias" id="pdf_colciencias" class="validate[required]" required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-6">
                                        <label for="pdf_certpresupuesto">Certificado de Disponibilidad Presupuestal</label>
                                        <div>
                                            <input type="file" name="pdf_certpresupuesto" id="pdf_certpresupuesto" class="validate[required]" required>
                                        </div>
                                    </div>

                                </fieldset>
                                <div class="row text-center">
                                    <a href="<?php echo base_url()?>" class="btn-danger btn-lg">Regresar</a>
                                    <button id="Guardar" type="submit" class="btn-primary submit  btn-lg">Guardar</button>
                                </div>



                            </fieldset>
							</div>
                        </form>
				</div>		
            </div>

			<!--Author: Mario E Beltran mebeltran@saludcapital.gov.co Since: 30052019
			//Modal Infografia y Listado PDF-->
				  <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-800">

					  <!-- Modal content-->
					  <div class="modal-content" style="width:800px;">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Información Importante</h4>
						</div>
						<div class="modal-body">
						 <img src="<?php echo base_url('assets/imgs/infografia.jpg')?>" class="img-responsive">
						</div>
						<div class="modal-footer">
						<center>
						  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						  <a href="<?php echo base_url('assets/docs/listado.pdf')?>" class="btn btn-success" target="_blank">Listado PDF</a>
						</center>
						</div>
					  </div>

					</div>
				  </div>

			<script type="text/javascript">
				$(window).on('load',function(){
					$('#myModal').modal('show');
				});
			</script>
