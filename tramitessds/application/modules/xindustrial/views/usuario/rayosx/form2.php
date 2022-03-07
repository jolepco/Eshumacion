<div id="paso2" class="row-center shadow-lg p-3 mb-5 bg-white rounded ">
	<form id="formSeccion2" name="formSeccion2" method="post" action="<?php echo base_url('xindustrial/editarCategoriaRX')?>" class="text-center border border-light p-5" enctype="multipart/form-data">
		<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
		<input id="id_categoria_rayosx" name="id_categoria_rayosx" type="hidden" value="<?php if(isset($tramite_info)&& $tramite_info->categoria != ''){ echo $tramite_info->categoria;} ?>">
		<div class="subtitle text-left">
            <h3><b>Equipos generadores de radiación ionizante:</b></h3>
        </div>
		<div class="row">
			<?php
			$verbtnCate = "block";
			?>
           <div class="col-md-12">
               <span class="text-orange">•</span><label for="categoria">Categoría</label>
               
               <select id="categoria" name="categoria" class="form-control validate[required]" required <?php if(isset($tramite_info->categoria) && ($tramite_info->categoria == 1 || $tramite_info->categoria == 2)){echo "disabled";}?>>
                  <option value="">Seleccione...</option>
                  <option value="1"
                  <?php if(isset($tramite_info->categoria) && $tramite_info->categoria == 1){echo 'selected';$vercate1="block";$verbtnCate = "none";}else{$vercate1="none";} ?>>
                    Categoría  I
                  </option>
                  <option value="2"
                  <?php if(isset($tramite_info->categoria) && $tramite_info->categoria == 2){echo 'selected';$verbtnCate = "none";$vercate2="block";}else{$vercate2="none";}?>>
					Categoría  II
                  </option>
               </select>
            </div>
         </div>
		 <div class="row" id="resultado_seccion2"></div>
         <div class="col">
            <p align="center">
               <br/>
               <!-- Primer Collapsible - Localizacion Entidad -->
               <button type="submit" class="btn btn-warning" id="btnGuardarCategoria" style="display:<?php echo $verbtnCate;?>">
                  Guardar y Continuar
               </button>
			   <?php 
			   if(isset($tramite_info->categoria) && ($tramite_info->categoria == 1 || $tramite_info->categoria == 2))
				{
					$btn_res = "display:block";
					
				}else{
					$btn_res = "display:none";
				}					
			   ?>
			   <button type="button" id="btn_rest_cat" class="btn btn-danger" style="<?php echo $btn_res?>">
					Restablecer categoría
				</button>
            </p>
		</div>
	</form>
	<!--FORM EQUIPOS-->
	<form id="formSeccion2-1" name="formSeccion2-1" action="<?php echo base_url('xindustrial/editarEquipoRX')?>" method="post" class="text-left border border-light p-5" enctype="multipart/form-data">
		<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
		<div class="subtitle text-left">
            <h3><b>Descripción del equipo generador de radiación ionizante:</b></h3>
        </div>
		<div class="row">
			<div class="col" style="display:<?php echo $vercate1?>" id="div_categoria1">
				<span class="text-orange">•</span><label for="categoria1">Equipos generadores de radicaci&oacute;n ionizante</label>
				<select id="categoria1" name="categoria1" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" >Radiolog&iacute;a odontol&oacute;gica</option>
					<option value="2" >Equipo de RX</option>
					<option value="3" >Otros</option>
				</select>
			</div>
			<div class="col" style="display:<?php echo $vercate2?>" id="div_categoria2">
				<label for="categoria2">Equipos generadores de radicaci&oacute;n ionizante</label>
				<select id="categoria2" name="categoria2" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" >Pallets y paquetes</option>
					<option value="2" >Escáner  de carga</option>
					<option value="3" >Equipo radiología convencional móvil</option>
					<option value="4" >Inspectometro de Rayos X</option>
					<option value="5" >Equipo de difracción de Rayos X</option>
					<option value="6" >Equipo radiología convencional</option>
					<option value="7" >Equipo radiología veterinaria</option>
					<option value="8" >Acelerador lineal de uso veterinario</option>
					<option value="9" >Acelerador lineal</option>
					<option value="10" >Equipo de fluorescencia con tubo de Rayos RX</option>
					<option value="11" >Otros</option>
				</select>
			</div>
		</div>
		<div class="row">	
			<div class="col" style="display:none" id="div_categoria-otro">
				<label for="otro_equipo">Otro equipo de RX</label>
				<input id="otro_equipo" name="otro_equipo" placeholder="Otro equipo" class="form-control input-md validate[minSize[4], maxSize[100]]"  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
			</div>	
		</div>
		<div class="row">
			<div class="col">
				<label for="tipo_visualizacion">Tipo de visualización de la imagen</label>
				<select id="tipo_visualizacion" name="tipo_visualizacion" class="form-control validate[required]" required>
				   <option value="1" >Digital</option>
				   <option value="2" >Digitalizado</option>
				   <option value="3" >Análogo</option>
				   <option value="4" >Revelado Automático</option>
				   <option value="5" >Revelado Manual</option>
				   <option value="6" >Monitor Análogo</option>
				   <option value="7" >No Aplica</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col">
               <label for="marca_equipo">Marca equipo</label>
               <input id="marca_equipo" name="marca_equipo" placeholder="Ingresar Marca equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
			<div class="col">
               <label for="modelo_equipo">Modelo equipo</label>
               <input id="modelo_equipo" name="modelo_equipo" placeholder="Ingresar Modelo equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"   onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
			<div class="col">
               <label for="serie_equipo">Serie equipo</label>
               <input id="serie_equipo" name="serie_equipo" placeholder="Ingresar Serie equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>			
		</div>
		<div class="row">
			<div class="col">
			   <label for="marca_tubo_rx">Marca tubo RX</label>
			   <input id="marca_tubo_rx" name="marca_tubo_rx" placeholder="Ingresar Marca tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]" required type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
			</div>

			<div class="col">
			   <label for="modelo_tubo_rx">Modelo tubo RX</label>
			   <input id="modelo_tubo_rx" name="modelo_tubo_rx" placeholder="Ingresar Modelo tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
			</div>

			<div class="col">
			   <label for="serie_tubo_rx">Serie tubo RX</label>
			   <input id="serie_tubo_rx" name="serie_tubo_rx" placeholder="Ingresar Serie tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  required  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
			</div>
		</div>
		<div class="row">
			<div class="col">
               <label for="tension_tubo_rx">Tensión máxima tubo RX [kV]</label>
               <input id="tension_tubo_rx" name="tension_tubo_rx" placeholder="Ingresar Tensión máxima tubo RX [kV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]"  required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;" >
            </div>
			<div class="col">
               <label for="contiene_tubo_rx">Corriente Max del tubo RX [mA]</label>
               <input id="contiene_tubo_rx" name="contiene_tubo_rx" placeholder="Ingresar corriente máxima del tubo RX [mA]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
            </div>
			<div class="col">
               <label for="energia_fotones">Energ&iacute;a de fotones [MeV]</label>
               <input id="energia_fotones" name="energia_fotones" placeholder="Ingresar Energ&iacute;a de fotones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
            </div>
		</div>
		<div class="row">
			<div class="col">
               <label for="energia_electrones">Energ&iacute;a de electrones [MeV]</label>
               <input id="energia_electrones" name="energia_electrones" placeholder="Ingresar Energ&iacute;a de electrones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
            </div>
            <div class="col">
               <label for="carga_trabajo">Carga de trabajo [mA.min/semana]</label>
               <input id="carga_trabajo" name="carga_trabajo" placeholder="Ingresar Carga de trabajo [mA.min/semana]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any"    min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
            </div>
			<div class="col">
				<label for="ubicacion_equipo">Ubicación del equipo de la instalación</label>
				<input id="ubicacion_equipo" name="ubicacion_equipo" placeholder="Ingresar Ubicación del equipo de la instalación" class="form-control input-md validate[required, minSize[4], maxSize[100]]" required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
			</div>
		</div>
		<div class="row">
			<div class="col">
               <label for="anio_fabricacion">A&ntilde;o de fabricación del equipo</label>
               <input id="anio_fabricacion" name="anio_fabricacion" placeholder="Ingresar A&ntilde;o de fabricación del equipo" class="form-control input-md validate[custom[number],required, minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]" required onKeyPress="if(this.value.length==4) return false;">
            </div>
            <div class="col">
               <label for="anio_fabricacion_tubo">A&ntilde;o de fabricación del tubo</label>
               <input id="anio_fabricacion_tubo" name="anio_fabricacion_tubo" placeholder="Ingresar A&ntilde;o de fabricación del tubo" class="form-control input-md validate[custom[number],required, minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]]" required onKeyPress="if(this.value.length==4) return false;">
            </div>
            <div class="col" id="div_numpermiso">
               <label for="numero_permiso">Número de permiso de comercialización</label>
               <input id="numero_permiso" name="numero_permiso" placeholder="Ingresar Número de permiso de comercialización" class="form-control input-md validate[required, minSize[4], maxSize[30]]" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
		</div>
		<div class="row">
			<table class="table text-left">
				<thead>
					<th>Descripción documento</th>
					<th>PDF</th>
				</thead>
				<tbody>
					<tr>
						<td>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje</td>
						<td><input id="fi_blindajes" name="fi_blindajes" type="file" required class="form-control-file archivopdf validate[required]"></></td>
					</tr>
					<tr>
							<td>Programa de Protección Radiólogica</td>
						<td><input id="fi_control_calidad" name="fi_control_calidad" type="file" required class="form-control-file archivopdf validate[required]"></td>
					</tr>
					<tr>
						<td>Plano general de las instalaciones</td>
						<td><input id="fi_plano" name="fi_plano" type="file" required class="form-control-file archivopdf validate[required]"></td>
					</tr>
					<tr>
						<td>Manual de usuario</td>
						<td><input id="fi_manual" name="fi_manual" type="file" required class="form-control-file archivopdf validate[required]"></td>
					</tr>
					<tr>
						<td>Ficha Técnica</td>
						<td><input id="fi_ficha" name="fi_ficha" type="file" required class="form-control-file archivopdf validate[required]"></td>
					</tr>
					<tr>
						<td>Estudio Ambiental de la instalación</td>
						<td><input id="fi_estudio" name="fi_estudio" type="file" required class="form-control-file archivopdf validate[required]"></td>
					</tr>
					<tr>
						<td>Programa de vigilancia pos mercado de los equipos generadores de radiación ionizante</td>
						<td><input id="fi_pruebas_caracterizacion" name="fi_pruebas_caracterizacion" required type="file" class="form-control-file archivopdf validate[required]"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="btnGuardarEquipos" class="col-md-12">
            <p align="center">
               <br/>
               <!-- Primer Collapsible - Localizacion Entidad -->
               <button type="submit" class="btn btn-warning">
                  Guardar y Continuar
               </button>
            </p>
		</div>
	</form>	
	<div id="resultado_seccion2_1" class="col-12 col-md-12 table-responsive">
			<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Marca Equipo</th>
					<th>Modelo Equipo</th>
					<th>Serie Equipo</th>										
					<th>Ver más</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
			<?php
			for($i=0;$i<count($rayosxEquipo);$i++){
				?>
				<tr>
					<td><?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></td>
					<td><?php echo $rayosxEquipo[$i]->marca_equipo?></td>
					<td><?php echo $rayosxEquipo[$i]->modelo_equipo?></td>
					<td><?php echo $rayosxEquipo[$i]->serie_equipo?></td>										
					<td>
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#verEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
						  Ver mas...
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
						  Editar
						</button>	
					</td>
					<td>
						<a class="btn btn-danger" href="#" onClick="eliminarEquipo(<?php echo $rayosxEquipo[$i]->id_tramite_rayosx?>,<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">Eliminar</a>
					</td>
				</tr>

				<!-- Modal -->
				<div class="modal fade" id="editarEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">	
							<form id="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" action="<?php echo base_url('xindustrial/actualizarEquipoRX')?>" method="post" class="text-left border border-light formActEquipo" onsubmit="validarFormEquipoAct(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)" enctype="multipart/form-data">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Editar equipo <?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<?php
								
								if($tramite_info->categoria == 1){
									$vercateact1 = "block";
									$vercateact2 = "none";
								}else if($tramite_info->categoria == 2){
									$vercateact1 = "none";
									$vercateact2 = "block";
								}
								
								?>
								<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>"/>
								<input id="id_equipo_rayosx" name="id_equipo_rayosx" type="hidden" value="<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>"/>
									<div class="row">
										<div class="col" style="display:<?php echo $vercateact1?>" id="div_categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
											<span class="text-orange">•</span><label for="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipos generadores de radicaci&oacute;n ionizante</label>
											<select id="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria1_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]" onchange="act_cambiacat1(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">
												<option value="">Seleccione...</option>
												<option value="1" <?php if($rayosxEquipo[$i]->categoria1 == 1){echo "selected";}?>>Radiolog&iacute;a odontol&oacute;gica periapical</option>
												<option value="2" <?php if($rayosxEquipo[$i]->categoria1 == 2){echo "selected";}?>>Equipo de RX</option>
												<option value="2" <?php if($rayosxEquipo[$i]->categoria1 == 3){echo "selected";}?>>Otros</option>
											</select>
										</div>
										<div class="col" style="display:<?php echo $vercateact2?>" id="div_categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
											<label for="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Equipos generadores de radicaci&oacute;n ionizante</label>
											<select id="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="categoria2_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="form-control validate[required]"  onchange="act_cambiacat2(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)">
												<option value="">Seleccione...</option>
												<option value="1" <?php if($rayosxEquipo[$i]->categoria2 == 1){echo "selected";}?>>Pallets y paquetes</option>
												<option value="2" <?php if($rayosxEquipo[$i]->categoria2 == 2){echo "selected";}?>>Escáner  de carga</option>
												<option value="3" <?php if($rayosxEquipo[$i]->categoria2 == 3){echo "selected";}?>>Equipo radiología convencional móvil</option>
												<option value="4" <?php if($rayosxEquipo[$i]->categoria2 == 4){echo "selected";}?>>Inspectometro de Rayos X</option>
												<option value="5" <?php if($rayosxEquipo[$i]->categoria2 == 5){echo "selected";}?>>Equipo de difracción de Rayos X</option>
												<option value="6" <?php if($rayosxEquipo[$i]->categoria2 == 6){echo "selected";}?>>Equipo radiología convencional</option>
												<option value="7" <?php if($rayosxEquipo[$i]->categoria2 == 7){echo "selected";}?>>Equipo radiología veterinaria</option>
												<option value="8" <?php if($rayosxEquipo[$i]->categoria2 == 8){echo "selected";}?>>Acelerador lineal de uso veterinario</option>
												<option value="8" <?php if($rayosxEquipo[$i]->categoria2 == 9){echo "selected";}?>>Acelerador lineal</option>
												<option value="9" <?php if($rayosxEquipo[$i]->categoria2 == 10){echo "selected";}?>>Equipo de fluorescencia con tubo de Rayos RX</option>
												<option value="10" <?php if($rayosxEquipo[$i]->categoria2 == 11){echo "selected";}?>>Otros</option>
											</select>
										</div>
									</div>
									<div class="row">												
										<div class="col" style="display:none" id="div_categoria2-1-otro_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
											<label for="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">Otro equipo de RX</label>
											<input id="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="otro_equipo_eq<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" placeholder="Otro equipo" class="form-control input-md validate[minSize[4], maxSize[100]]"  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
										</div>	
									</div>
									<div class="row">
										<div class="col">
											<label for="tipo_visualizacion">Tipo de visualización de la imagen</label>
											<select id="tipo_visualizacion" name="tipo_visualizacion" class="form-control validate[required]" required>
											   <option value="1" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 1){echo "selected";}?>>Digital</option>
											   <option value="2" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 2){echo "selected";}?>>Digitalizado</option>
											   <option value="3" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 3){echo "selected";}?>>Análogo</option>
											   <option value="4" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 4){echo "selected";}?>>Revelado Automático</option>
											   <option value="5" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 5){echo "selected";}?>>Revelado Manual</option>
											   <option value="6" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 6){echo "selected";}?>>Monitor Análogo</option>
											   <option value="7" <?php if($rayosxEquipo[$i]->tipo_visualizacion == 7){echo "selected";}?>>No Aplica</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
										   <label for="marca_equipo">Marca equipo</label>
										   <input id="marca_equipo" value="<?php if($rayosxEquipo[$i]->marca_equipo != ''){echo $rayosxEquipo[$i]->marca_equipo;}?>" name="marca_equipo" placeholder="Ingresar Marca equipo" class="form-control input-md validate[required, minSize[4], maxSize[60]]"  required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>
										<div class="col">
										   <label for="modelo_equipo">Modelo equipo</label>
										   <input id="modelo_equipo" value="<?php if($rayosxEquipo[$i]->modelo_equipo != ''){echo $rayosxEquipo[$i]->modelo_equipo;}?>" name="modelo_equipo" placeholder="Ingresar Modelo equipo" class="form-control input-md validate[required, minSize[4], maxSize[60]]"  required  type="text"   onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>
										<div class="col">
										   <label for="serie_equipo">Serie equipo</label>
										   <input id="serie_equipo" value="<?php if($rayosxEquipo[$i]->serie_equipo != ''){echo $rayosxEquipo[$i]->serie_equipo;}?>" name="serie_equipo" placeholder="Ingresar Serie equipo" class="form-control input-md validate[required, minSize[4], maxSize[60]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>			
									</div>
									<div class="row">
										<div class="col">
										   <label for="marca_tubo_rx">Marca tubo RX</label>
										   <input id="marca_tubo_rx" value="<?php if($rayosxEquipo[$i]->marca_tubo_rx != ''){echo $rayosxEquipo[$i]->marca_tubo_rx;}?>" name="marca_tubo_rx" placeholder="Ingresar Marca tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[60]]" required type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>

										<div class="col">
										   <label for="modelo_tubo_rx">Modelo tubo RX</label>
										   <input id="modelo_tubo_rx" value="<?php if($rayosxEquipo[$i]->modelo_tubo_rx != ''){echo $rayosxEquipo[$i]->modelo_tubo_rx;}?>" name="modelo_tubo_rx" placeholder="Ingresar Modelo tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[60]]"  required  type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>

										<div class="col">
										   <label for="serie_tubo_rx">Serie tubo RX</label>
										   <input id="serie_tubo_rx" value="<?php if($rayosxEquipo[$i]->serie_tubo_rx != ''){echo $rayosxEquipo[$i]->serie_tubo_rx;}?>" name="serie_tubo_rx" placeholder="Ingresar Serie tubo RX" class="form-control input-md validate[required, minSize[4], maxSize[60]]"  required  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="60" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 60 carácteres">
										</div>
									</div>
									<div class="row">
										<div class="col">
										   <label for="tension_tubo_rx">Tensión máxima tubo RX [kV]</label>
										   <input id="tension_tubo_rx" value="<?php if($rayosxEquipo[$i]->tension_tubo_rx != ''){echo $rayosxEquipo[$i]->tension_tubo_rx;}?>" name="tension_tubo_rx" placeholder="Ingresar Tensión máxima tubo RX [kV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]"  required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;" >
										</div>
										<div class="col">
										   <label for="contiene_tubo_rx">Corriente Max del tubo RX [mA]</label>
										   <input id="contiene_tubo_rx" value="<?php if($rayosxEquipo[$i]->contiene_tubo_rx != ''){echo $rayosxEquipo[$i]->contiene_tubo_rx;}?>" name="contiene_tubo_rx" placeholder="Ingresar corriente máxima del tubo RX [mA]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any" min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
										</div>
										<div class="col">
										   <label for="energia_fotones">Energ&iacute;a de fotones [MeV]</label>
										   <input id="energia_fotones" value="<?php if($rayosxEquipo[$i]->energia_fotones != ''){echo $rayosxEquipo[$i]->energia_fotones;}?>" name="energia_fotones" placeholder="Ingresar Energ&iacute;a de fotones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
										</div>
									</div>
									<div class="row">
										<div class="col">
										   <label for="energia_electrones">Energ&iacute;a de electrones [MeV]</label>
										   <input id="energia_electrones" value="<?php if($rayosxEquipo[$i]->energia_electrones != ''){echo $rayosxEquipo[$i]->energia_electrones;}?>" name="energia_electrones" placeholder="Ingresar Energ&iacute;a de electrones [MeV]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[3]]" required step="any"    min="0" max="1000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
										</div>
										<div class="col">
										   <label for="carga_trabajo">Carga de trabajo [mA.min/semana]</label>
										   <input id="carga_trabajo" value="<?php if($rayosxEquipo[$i]->carga_trabajo != ''){echo $rayosxEquipo[$i]->carga_trabajo;}?>" name="carga_trabajo" placeholder="Ingresar Carga de trabajo [mA.min/semana]" class="form-control input-md validate[custom[number], required, minSize[1], maxSize[4]]" required step="any"    min="0" max="10000" step="0.01" title="Ingresar un máximo 4 decimales, separador decimal punto ó coma" onKeyPress="if(this.value.length==6) return false;">
										</div>
										<div class="col">
											<label for="ubicacion_equipo">Ubicación del equipo de la instalación</label>
											<input id="ubicacion_equipo" value="<?php if($rayosxEquipo[$i]->ubicacion_equipo != ''){echo $rayosxEquipo[$i]->ubicacion_equipo;}?>" name="ubicacion_equipo" placeholder="Ingresar Ubicación del equipo de la instalación" class="form-control input-md validate[required, minSize[4], maxSize[100]]" required type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="100" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 100 carácteres">
										</div>
									</div>
									<div class="row">
										<div class="col">
										   <label for="anio_fabricacion">A&ntilde;o de fabricación del equipo</label>
										   <input id="anio_fabricacion" value="<?php if($rayosxEquipo[$i]->anio_fabricacion != ''){echo $rayosxEquipo[$i]->anio_fabricacion;}?>" name="anio_fabricacion" placeholder="Ingresar A&ntilde;o de fabricación del equipo" class="form-control input-md validate[custom[number], minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]" onKeyPress="if(this.value.length==4) return false;">
										</div>
										<div class="col">
										   <label for="anio_fabricacion_tubo">A&ntilde;o de fabricación del tubo</label>
										   <input id="anio_fabricacion_tubo" value="<?php if($rayosxEquipo[$i]->anio_fabricacion_tubo != ''){echo $rayosxEquipo[$i]->anio_fabricacion_tubo;}?>" name="anio_fabricacion_tubo" placeholder="Ingresar A&ntilde;o de fabricación del tubo" class="form-control input-md validate[custom[number], minSize[4], maxSize[4], min[1900], max[<?php echo date('Y')?>]]" onKeyPress="if(this.value.length==4) return false;">
										</div>
										<div class="col" id="div_numpermiso">
										   <label for="numero_permiso">Número de permiso de comercialización</label>
										   <input id="numero_permiso" value="<?php if($rayosxEquipo[$i]->numero_permiso != ''){echo $rayosxEquipo[$i]->numero_permiso;}?>" name="numero_permiso" placeholder="Ingresar Número de permiso de comercialización" class="form-control input-md validate[minSize[4], maxSize[30]]" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
										</div>
									</div>
									<div class="row justify-content-md-center">
										<div class="col-md-10">
											<div class="row bg-light text-dark">
												<div class="col-md-4">
													Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_blindajes != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_blindajes);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_blindajes" name="fi_blindajes" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													Programa de Protección Radiólogica
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_control_calidad != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_control_calidad);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_control_calidad" name="fi_control_calidad" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row bg-light text-dark">
												<div class="col-md-4">
													Plano general de las instalaciones
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_plano != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_plano);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_plano" name="fi_plano" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													Programa de vigilancia pos mercado de los equipos generadores de radiación ionizante
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_pruebas_caracterizacion != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_pruebas_caracterizacion);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_pruebas_caracterizacion" name="fi_pruebas_caracterizacion" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													Manual de usuario
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_manual != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_manual);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_manual" name="fi_manual" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													Ficha Técnica
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_ficha != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_ficha);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_ficha" name="fi_ficha" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													Estudio Ambiental de la instalación
												</div>
												<div class="col">
												<?php
													if($rayosxEquipo[$i]->fi_estudio != ''){
														$resultado_archivo = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_estudio);
														?>
														<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
															<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
														</a>
														<?php
													}else{
														echo "Sin archivo";
													}
												?>
												</div>
												<div class="col">
													<input id="fi_estudio" name="fi_estudio" type="file" class="form-control-file archivopdf validate[required]">
												</div>
											</div>
										</div>										
									</div>									
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary">Actualizar</button>
							</div>
						</form>							
						</div>
					</div>
				</div>
					
				<div id="ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" class="modal">
				  
				</div>

				
				<div class="modal fade" id="verEquipo<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">	
							<form id="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" name="formActualizar<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" action="#" method="post" class="text-left border border-light formActEquipo" onsubmit="validarFormEquipoAct(<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>)" enctype="multipart/form-data">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Ver equipo <?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p><h2><b>Equipo ID:<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></b></h2></p>
									<ul>									
									<?php
										if($rayosxEquipo[$i]->categoria1 != 0 || $rayosxEquipo[$i]->categoria1 != NULL){
											if($rayosxEquipo[$i]->categoria1 == 1){
												?><li><b>Equipos generadores de radiaci&oacute;n ionizante: </b>Radiolog&iacute;a odontol&oacute;gica</li><?php
											}else if($rayosxEquipo[$i]->categoria1 == 2){
												?><li><b>Equipos generadores de radiaci&oacute;n ionizante: </b>Equipo de RX</li><?php
											}else if($rayosxEquipo[$i]->categoria1 == 3){
												?><li><b>Equipos generadores de radiaci&oacute;n ionizante: </b>Otro</li><?php
											}
										}
									
										if($rayosxEquipo[$i]->categoria2 != 0 || $rayosxEquipo[$i]->categoria2 != NULL){
											if($rayosxEquipo[$i]->categoria2 == 1){
												?><li><b>Equipos generadores de radiaci&oacute;n ionizante: </b>Pallets y paquetes</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 2){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Escáner  de carga</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 3){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología convencional móvil</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 4){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Inspectometro de Rayos X</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 5){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de difracción de Rayos X</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 6){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología convencional</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 7){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología veterinaria</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 8){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Acelerador lineal de uso veterinario</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 9){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Acelerador lineal</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 10){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de fluorescencia con tubo de Rayos RX</li><?php
											}else if($rayosxEquipo[$i]->categoria2 == 10){
												?><li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Otro</li><?php
											}
										}		
										
											if($rayosxEquipo[$i]->tipo_visualizacion != 0 || $rayosxEquipo[$i]->tipo_visualizacion != NULL){
												if($rayosxEquipo[$i]->tipo_visualizacion == 1){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Digital</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 2){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Digitalizado</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 3){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Análogo</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 4){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Revelado Automático</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 5){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Revelado Manual</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 6){
													?>
													<li><b>Tipo de visualización de la imagen: </b>Monitor Análogo</li>
													<?php
												}else if($rayosxEquipo[$i]->tipo_visualizacion == 7){
													?>
													<li><b>Tipo de visualización de la imagen: </b>No Aplica</li>
													<?php
												}
											}
										?>
										<li><b>Marca Equipo: </b><?php echo $rayosxEquipo[$i]->marca_equipo?></li>
										<li><b>Modelo Equipo: </b><?php echo $rayosxEquipo[$i]->modelo_equipo?></li>
										<li><b>Serie Equipo: </b><?php echo $rayosxEquipo[$i]->serie_equipo?></li>
										<li><b>Marca Tubo RX: </b><?php echo $rayosxEquipo[$i]->marca_tubo_rx?></li>
										<li><b>Modelo Tubo RX: </b><?php echo $rayosxEquipo[$i]->modelo_tubo_rx?></li>
										<li><b>Serie Tubo RX: </b><?php echo $rayosxEquipo[$i]->serie_tubo_rx?></li>
										<li><b>Tensión máxima tubo RX [kV]: </b><?php echo $rayosxEquipo[$i]->tension_tubo_rx?></li>
										<li><b>Cont. Max del tubo RX [mA]: </b><?php echo $rayosxEquipo[$i]->contiene_tubo_rx?></li>
										<li><b>Energía de fotones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_fotones?></li>
										<li><b>Energía de electrones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_electrones?></li>
										<li><b>Carga de trabajo [mA.min/semana]: </b><?php echo $rayosxEquipo[$i]->carga_trabajo?></li>
										<li><b>Ubicación del equipo de la instalación: </b><?php echo $rayosxEquipo[$i]->ubicacion_equipo?></li>
										<li><b>Año de fabricación del equipo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion?></li>
										<li><b>Año de fabricación del tubo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion_tubo?></li>
										<li><b>Número de permiso de comercialización: </b><?php echo $rayosxEquipo[$i]->numero_permiso?></li>
										
										<?php
											
											if($rayosxEquipo[$i]->fi_blindajes != ''){
													$fi_blindajes = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_blindajes);
													
													if($fi_blindajes){
														?>
														<li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_blindajes->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
														<?php
													}		
												}else{
													?>
													<li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b> Sin archivo disponible</li>		
													<?php
												}
											
												
												
											if($rayosxEquipo[$i]->fi_control_calidad != ''){
													$fi_control_calidad = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_control_calidad);
													
													if($fi_control_calidad){
														?>
														<li><b>Informe sobre los resultados del control de calidad: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_control_calidad->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Informe sobre los resultados del control de calidad:</b> Sin archivo disponible</li>		
													<?php
												}	
											

												if($rayosxEquipo[$i]->fi_plano != ''){
													$fi_plano = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_plano);
													
													if($fi_plano){
														?>
														<li><b>Plano general de las instalaciones: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_plano->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Plano general de las instalaciones: </b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Plano general de las instalaciones: </b> Sin archivo disponible</li>		
													<?php
												}		
												
												if($rayosxEquipo[$i]->fi_pruebas_caracterizacion != ''){
													$fi_pruebas_caracterizacion = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_pruebas_caracterizacion);
													
													if($fi_pruebas_caracterizacion){
														?>
														<li><b>Pruebas iniciales de caracterización de los equipos: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_pruebas_caracterizacion->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Pruebas iniciales de caracterización de los equipos:  </b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Pruebas iniciales de caracterización de los equipos: </b> Sin archivo disponible</li>		
													<?php
												}	
												
												if($rayosxEquipo[$i]->fi_manual != ''){
													$fi_manual = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_manual);
													
													if($fi_manual){
														?>
														<li><b>Manual de usuario: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_manual->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Manual de usuario:  </b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Manual de usuario: </b> Sin archivo disponible</li>		
													<?php
												}	

												if($rayosxEquipo[$i]->fi_ficha != ''){
													$fi_ficha = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_ficha);
													
													if($fi_ficha){
														?>
														<li><b>Ficha Técnica: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_ficha->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Ficha Técnica:  </b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Ficha Técnica: </b> Sin archivo disponible</li>		
													<?php
												}	

												if($rayosxEquipo[$i]->fi_estudio != ''){
													$fi_estudio = $this->xindustrial_model->consultar_archivo_pdf($rayosxEquipo[$i]->fi_estudio);
													
													if($fi_estudio){
														?>
														<li><b>Estudio Ambiental de la instalación: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_estudio->nombre);?>" target="_blank">Ver archivo</a></li>		
														<?php
													}else{
														?>
														<li><b>Estudio Ambiental de la instalación:  </b> Sin archivo disponible</li>		
														<?php
													}
												}else{
													?>
													<li><b>Estudio Ambiental de la instalación: </b> Sin archivo disponible</li>		
													<?php
												}	
										
										?>
									</ul>					  
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</form>							
						</div>
					</div>
				</div>
											
				<?php
			}
			?>								
			</tbody>
		</table>
	</div>
</div>