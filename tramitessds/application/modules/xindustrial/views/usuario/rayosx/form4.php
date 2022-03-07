
<?php 

	if($tramite_info->visita_previa == 1){
		
		$visible_director = "display:block";
		$visible_objetos = "display:block";
		$btnGuardarIps = "display:block";
		$opcionSi = "selected";
		$opcionNo = "";
	}else if($tramite_info->visita_previa == 2){
		$visible_director = "display:none";
		$visible_objetos = "display:none";
		$btnGuardarIps = "display:none";
		$opcionSi = "";
		$opcionNo = "selected";
	}else{
		$visible_director = "display:none";
		$visible_objetos = "display:none";
		$btnGuardarIps = "display:none";
		$opcionSi = "";
		$opcionNo = "";
	}
		
?>

<div id="paso4" class="row-center shadow-lg p-3 mb-5 bg-white rounded ">

	<!-- PRIMERA PARTE DEL REGISTRO DE LA SOLICITUD - LOCALIZACION tipoTramite  -->
	<!-- Equipos generadores de radiación ionizante -->
	<form id="formSeccion4-1" name="formSeccion4-1" action="<?php echo base_url('xindustrial/editarDirector')?>" method="post" class="text-justify border border-light p-5">
		<div id="paso4-1" class="row block w-100 newsletter ">
		<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
		<input id="id_director_rayosx" name="id_director_rayosx" type="hidden" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->id_director_rayosx;}?>">
		<div class="w-100">
			<div class="subtitle">
				<h3><b>Talento Humano:</b></h3>
			</div>
		<div class="col-md-12">
			<span class="text-orange">•</span><label for="tipo_titulo">La IPS cuenta con el talento humano estipulado en el artículo 6 y 7, numeral 7.1?</label>
			<select id="visita_previa" name="visita_previa_th" class="form-control validate[required]">
				<option value="">Seleccione...</option>
				<option value="1" <?php echo $opcionSi;?>>SI</option>
				<option value="2" <?php echo $opcionNo;?>>NO</option>
			</select>				 
			<div id="btnGuardarIps" class="col-md-12 pt-200" style="<?php echo $btnGuardarIps?>">
				<p align="center">
				   <br/>
				   <button type="submit" class="btn btn-warning">
					  Guardar
				   </button>
				</p>
			</div>	
		</div>
		<div id="div_talentohumano" style="<?php echo $visible_director?>">
			<h4><b><span class="text-orange">•</span>Director Técnico</b></h4>

			<div class="row">

				<div class="col-md-3">
				   <span class="text-orange">•</span><label for="talento_pnombre">Primer Nombre</label>				   
				   <input id="talento_pnombre" name="talento_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_pnombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-3">
				   <span class="text-orange">•</span><label for="talento_snombre">Segundo Nombre</label>
				   <input id="talento_snombre" name="talento_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_snombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-3">
				   <span class="text-orange">•</span><label for="talento_papellido">Primer Apellido</label>
				   <input id="talento_papellido" name="talento_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]" type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_papellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-3">
				   <span class="text-orange">•</span><label for="talento_sapellido">Segundo Apellido</label>
				   <input id="talento_sapellido" name="talento_sapellido" placeholder="Ingresar Segundo Apellido"  class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_sapellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
				</div>
			</div>

			<div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_tdocumento">Tipo Documento</label>
				   <select id="talento_tdocumento" name="talento_tdocumento" class="form-control validate[required]" >
					  <option value=""> - Seleccione Tipo Documento -</option>
					  <?php
						 for($i=0;$i<count($tipo_identificacion_natural);$i++){
							 ?>
							 <option value="<?php echo $tipo_identificacion_natural[$i]->IdTipoIdentificacion?>" 
							 <?php if(isset($rayosxTalento->talento_tdocumento) && $rayosxTalento->talento_tdocumento == $tipo_identificacion_natural[$i]->IdTipoIdentificacion ){ echo 'selected';}?>>
							 <?php echo $tipo_identificacion_natural[$i]->Descripcion?>
							 </option>
							 <?php
						 }
						 ?>   
					  </select>
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_ndocumento">Número Documento</label>
				   <input id="talento_ndocumento" name="talento_ndocumento" placeholder="Ingresar Número Documento"  class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_ndocumento;}?>" onKeyPress="if(this.value.length==15) return false;">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_lexpedicion">Lugar Expedición</label>
				   <input id="talento_lexpedicion" name="talento_lexpedicion" placeholder="Ingresar Lugar Expedición"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_lexpedicion;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

			

			 <div class="col-md-12">
				<span class="text-orange">•</span><label for="talento_correo">Correo Electrónico</label>
				<input id="talento_correo" name="talento_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]] input-md" type="email"  value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_correo;}?>" >
			 </div>
			</div> 
			 <br/>

			 <h4><b><span class="text-orange">•</span>Idoneidad Profesional</b></h4>
			 <div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_titulo">Título de pregrado obtenido </label>
				   <input id="talento_titulo" name="talento_titulo" placeholder="Título de pregrado obtenido"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_titulo;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_universidad">Universidad que otorgó el título de pregrado</label>
				   <input id="talento_universidad" name="talento_universidad" placeholder="Universidad que otorgó el titulo de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_universidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_libro">Libro del diploma de pregrado</label>
				   <input id="talento_libro" name="talento_libro" placeholder="Libro del diploma de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[15]]" type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_libro;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
				</div>

			 </div>

			 <div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_registro">Registro del diploma de pregrado</label>
				   <input id="talento_registro" name="talento_registro" placeholder="Registro del diploma de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_registro;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_fecha_diploma">Fecha diploma de pregrado</label>
				   <input id="talento_fecha_diploma" name="talento_fecha_diploma" placeholder="Fecha diploma de pregrado" class="form-control input-md validate[required]"  max="<?php echo date('Y-m-d')?>"  type="date" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_diploma;}?>">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_resolucion">Resolución convalidación título pregrado</label>
				   <input id="talento_resolucion" name="talento_resolucion" placeholder="Resolución convalidación título pregrado"  class="form-control input-md validate[minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_resolucion;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

			 </div>

			 <div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_fecha_convalida">Fecha convalidación título de pregrado</label>
				   <input id="talento_fecha_convalida" name="talento_fecha_convalida" placeholder="Fecha convalidación título de pregrado" class="form-control input-md" type="date"  max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_convalida;}?>">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_nivel">Nivel Académico último posgrado</label>
				   <select id="talento_nivel" name="talento_nivel" class="form-control validate[required]">
					  <option value="">Seleccione...</option>
					  <?php
						 for($i=0;$i<count($nivelAcademico);$i++){
							 if($nivelAcademico[$i]->IdNivelEducativo == 6){
							 ?>
								 <option value="<?php echo $nivelAcademico[$i]->IdNivelEducativo?>" 
								 <?php if(isset($rayosxTalento->talento_nivel) && $rayosxTalento->talento_nivel == $nivelAcademico[$i]->IdNivelEducativo ){ echo 'selected';}?>>
								 <?php echo $nivelAcademico[$i]->Nombre?>
								 </option>
								 <?php
							 }
						 }
						?>   
				   </select>
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_titulo_pos">Título de posgrado obtenido</label>
				   <input id="talento_titulo_pos" name="talento_titulo_pos" placeholder="Título de posgrado obtenido"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_titulo_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

			 </div>

			 <div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_universidad_pos">Universidad que otorgó el título de posgrado</label>
				   <input id="talento_universidad_pos" name="talento_universidad_pos" placeholder="Universidad que otorgó el título de posgrado"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_universidad_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_libro_pos">Libro del diploma de posgrado</label>
				   <input id="talento_libro_pos" name="talento_libro_pos" placeholder="Libro del diploma de posgrado"class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_libro_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_registro_pos">Registro del diploma de posgrado</label>
				   <input id="talento_registro_pos" name="talento_registro_pos" placeholder="Registro del diploma de posgrado" class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_registro_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
				</div>
			 </div>

			 <div class="row">

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_fecha_diploma_pos">Fecha diploma de posgrado</label>
				   <input id="talento_fecha_diploma_pos" name="talento_fecha_diploma_pos" placeholder="Fecha diploma de posgrado" class="form-control  validate[required]" type="date" max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_diploma_pos;}?>" >
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_resolucion">Resolución convalidación título posgrado</label>
				   <input id="talento_resolucion_pos" name="talento_resolucion_pos" placeholder="Resolución convalidación título posgrado" class="form-control input-md validate[minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_resolucion_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
				</div>

				<div class="col-md-4">
				   <span class="text-orange">•</span><label for="talento_fecha_convalida_pos">Fecha convalidación título de posgrado</label>
				   <input id="talento_fecha_convalida_pos" name="talento_fecha_convalida_pos" placeholder="Fecha convalidación título de posgrado" class="form-control input-md" type="date" max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_convalida_pos;}?>">
				</div>
			 </div>
			 <div id="btnGuardarDirector" class="col-md-12 pt-200">
				<p align="center">
				   <br/>
				   <button type="submit" class="btn btn-warning">
					  Guardar Talento Humano
				   </button>
				</p>
			  </div>

			</div>
		</div>	
        </div>          
	</form>
	<div id="div_objetos" style="<?php echo $visible_objetos?>">
	<form id="formSeccion4-2"  name="formSeccion4-2" action="<?php echo base_url('xindustrial/editarObjetosPrueba')?>" method="post" class="text-justify border border-light p-5"> 
		
	  <div id="paso4-2" class="row block w-100 newsletter ">

	  <div class="w-100">
			 <h4><b><span class="text-orange">•</span>Equipos u objetos de prueba</b></h4>		
	  <div id="seccion4-2">
		<div class="row">
		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_nombre">Nombre del Equipo:</label>
			  <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
			  <input id="obj_nombre" name="obj_nombre" placeholder="Nombre del Equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"   type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_marca">Marca del equipo</label>
			  <input id="obj_marca" name="obj_marca" placeholder="Marca del equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_modelo">Modelo del equipo</label>
			  <input id="obj_modelo" name="obj_modelo" placeholder="Modelo del Equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>
		</div>

		<div class="row">

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_serie">Serie del equipo</label>
			  <input id="obj_serie" name="obj_serie" placeholder="Serie del Equipo" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_calibracion">Calibración</label>
			  <input id="obj_calibracion" name="obj_calibracion" placeholder="Calibración" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_vigencia">Vigencia de calibración</label>
			  <select id="obj_vigencia" name="obj_vigencia" class="form-control validate[required]" >
				 <option value="">Seleccione...</option>
				 <option value="1">Un (1) A&ntilde;o</option>
				 <option value="2">Dos (2) A&ntilde;os</option>
				 <option value="3">Otra, definida por el fabricante</option>
			  </select>
		   </div>
		</div>

		<div class="row">

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_fecha">Fecha de calibración</label>
			  <input id="obj_fecha" name="obj_fecha" placeholder="Fecha de la calibracion" class="form-control validate[required] input-md" type="date"  max="<?php echo date('Y-m-d')?>">
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_manual">Manual Técnico y ficha Técnica</label>
			  <select id="obj_manual" name="obj_manual" class="form-control validate[required]" >
				 <option value="">Seleccione...</option>
				 <option value="1">Posee manual técnico</option>
				 <option value="2">Posee ficha técnica</option>
			  </select>
		   </div>

		   <div class="col-md-4">
			  <span class="text-orange">•</span><label for="obj_uso">Usos</label>
			  <textarea id="obj_uso" name="obj_uso" class="form-control validate[required] input-md" ></textarea>
		   </div>
		</div>

		<div id="btnGuardarEquipoPrueba" class="col-md-12 pt-200">
		   <p align="center">
			  <br/>
			  <!-- Primer Collapsible - Localizacion Entidad -->
			  <button type="submit" class="btn btn-warning">
				 Guardar Equipo/Objeto Prueba
			  </button>
		   </p>
		 </div>
	 </form>
	 <div id="resultado4_2" class="col-12 col-md-12 table-responsive">
		<table class="display nowrap table table-hover">
			   <thead>
				  <tr>
					  <th>ID</th>
					  <th>Nombre del equipo</th>
					  <th>Marca del equipo</th>
					  <th>Modelo del equipo</th>
					  <th>Ver Más</th>
					  <th>Eliminar</th>
				  </tr>
			   </thead>

			<tbody>
			<?php 
			if(isset($rayosxObjprueba)){
				for($i=0;$i<count($rayosxObjprueba);$i++){
					?>
					<tr>
						<td><?php echo $rayosxObjprueba[$i]->id_obj_rayosx;?></td>
						<td><?php echo $rayosxObjprueba[$i]->obj_nombre;?></td>
						<td><?php echo $rayosxObjprueba[$i]->obj_marca;?></td>
						<td><?php echo $rayosxObjprueba[$i]->obj_modelo;?></td>
						<td>
							<a class="btn btn-success" onClick="abrirModal('Equipo Objeto de prueba ID: <?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>','#modalObj<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>')">Ver más...</a>
						</td>
						<td>
							<a class="btn btn-danger" href="#" onClick="eliminarObj(<?php echo $rayosxObjprueba[$i]->id_tramite_rayosx?>,<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>)">Eliminar</a>
						</td>
					</tr>
					<div id="modalObj<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>" class="modal">
					  <p><b>Equipo Objeto de prueba ID:<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?></b></p>
						<ul>							
							<li><b>Nombre del Equipo: </b><?php echo $rayosxObjprueba[$i]->obj_nombre?></li>
							<li><b>Marca del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_marca?></li>
							<li><b>Modelo del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_modelo?></li>
							<li><b>Serie del equipo: </b><?php echo $rayosxObjprueba[$i]->obj_serie?></li>
							<li><b>Calibración: </b><?php echo $rayosxObjprueba[$i]->obj_calibracion?></li>
							<li><b>Vigencia de calibración: </b><?php echo $rayosxObjprueba[$i]->obj_vigencia?></li>
							<li><b>Fecha de calibración: </b><?php echo $rayosxObjprueba[$i]->obj_fecha?></li>
							<li><b>Manual Técnico y ficha Técnica: </b><?php echo $rayosxObjprueba[$i]->obj_manual?></li>
							<li><b>Usos: </b><?php echo $rayosxObjprueba[$i]->obj_uso?></li>							
						</ul>					  
					</div>
					<?php	
				}	
			}else{
				?>
				<tr>
					<td colspan="6" scope="col">No Existen Objetos de prueba Registrados</td>
				</tr>	
				<?php
			}
			?>            
			</tbody>
			</table>
	 </div>
	 
	 </div>
</div>


         
              

</div>
</div>
</div>