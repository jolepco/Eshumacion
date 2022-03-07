<div id="paso3" class="row-center shadow-lg p-3 mb-5 bg-white rounded ">

	<form id="formSeccion3-1" name="formSeccion3-1" action="<?php echo base_url('xindustrial/editarOficialToeRX')?>" method="post" class="text-justify border border-light p-5">
		<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
		<input id="id_categoria_rayosx" name="id_categoria_rayosx" type="hidden" value="<?php if(isset($tramite_info)&& $tramite_info->categoria != ''){ echo $tramite_info->categoria;} ?>">
		<div class="subtitle text-left">
		   <h3><b>Trabajadores ocupacionalmente expuestos - TOE:</b></h3>
		</div>
		<div class="row">
			<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
			<input id="id_encargado_rayosx" name="id_encargado_rayosx" type="hidden" value="<?php if(isset($rayosxOficialToe)&& $rayosxOficialToe->id_encargado_rayosx != ''){ echo $rayosxOficialToe->id_encargado_rayosx;} ?>">
			<div class="col">
				<h4><b><span class="text-orange">•</span>Oficial de protección radiológica/Encargado de protección Radiológica</b></h4>
			</div>
		</div>
		<div class="row">

			<div class="col-md-3">
				<span class="text-orange">•</span><label for="encargado_pnombre">Primer Nombre</label>
				<input id="encargado_pnombre" name="encargado_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_pnombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
			</div>

			<div class="col-md-3">
				<span class="text-orange">•</span><label for="encargado_snombre">Segundo Nombre</label>
				<input id="encargado_snombre" name="encargado_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_snombre ;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
			</div>

			<div class="col-md-3">
				<span class="text-orange">•</span><label for="encargado_papellido">Primer Apellido</label>
				<input id="encargado_papellido" name="encargado_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_papellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
			</div>
			<div class="col-md-3">
				<span class="text-orange">•</span><label for="encargado_sapellido">Segundo Apellido</label>
				<input id="encargado_sapellido" name="encargado_sapellido" placeholder="Ingresar Segundo Apellido" class="form-control input-md validate[minSize[3], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_sapellido; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<span class="text-orange">•</span><label for="encargado_tdocumento">Tipo Documento</label>
				<select id="encargado_tdocumento" name="encargado_tdocumento" class="form-control validate[required]" required>
					<option value=""> - Seleccione Tipo Documento -</option>
					<?php
					for($i=0;$i<count($tipo_identificacion_natural);$i++){
						 ?>
						 <option value="<?php echo $tipo_identificacion_natural[$i]->IdTipoIdentificacion?>" 
						 <?php if(isset($rayosxOficialToe->encargado_tdocumento) && $rayosxOficialToe->encargado_tdocumento == $tipo_identificacion_natural[$i]->IdTipoIdentificacion ){ echo 'selected';}?>>
						 <?php echo $tipo_identificacion_natural[$i]->Descripcion?>
						 </option>
						 <?php
					}
					?>
				 
				</select>
			</div>

		<div class="col-md-4">
		  <span class="text-orange">•</span><label for="encargado_ndocumento">Número Documento</label>
		  <input id="encargado_ndocumento" name="encargado_ndocumento" placeholder="Ingresar Número Documento" class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" required value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_ndocumento; }?>" onKeyPress="if(this.value.length==15) return false;">
		</div>

		<div class="col-md-4">
		  <span class="text-orange">•</span><label for="encargado_lexpedicion">Lugar Expedición</label>
		  <input id="encargado_lexpedicion" name="encargado_lexpedicion" placeholder="Ingresar Lugar Expedición" required class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_lexpedicion; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		</div>

		</div>

		<div class="form-group">
		<span class="text-orange">•</span><label for="encargado_correo">Correo Electrónico</label>
		<input id="encargado_correo" name="encargado_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]]" type="email" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_correo; }?>" required>
		</div>

		<div class="row">
		<div class="col-md-6">
		  <span class="text-orange">•</span><label for="encargado_nivel">Nivel Académico</label>
		  <select id="encargado_nivel" name="encargado_nivel" class="form-control validate[required]" required>
			 <option value="">Seleccione...</option>
			 <?php
			 for($i=0;$i<count($nivelAcademico);$i++){
				 ?>
				 <option value="<?php echo $nivelAcademico[$i]->IdNivelEducativo?>" 
				 <?php if(isset($rayosxOficialToe->encargado_nivel) && $rayosxOficialToe->encargado_nivel == $nivelAcademico[$i]->IdNivelEducativo ){ echo 'selected';}?>>
				 <?php echo $nivelAcademico[$i]->Nombre?>
				 </option>
				 <?php
			 }
			 ?>                                 
		  </select>
		</div>

		<div class="col-md-6">
		  <span class="text-orange">•</span><label for="encargado_profesion">Profesión</label>
		  <input id="encargado_profesion" name="encargado_profesion" placeholder="Ingresar Profesión" class="form-control validate[required]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_profesion; }?>" required>
		</div>
		</div>
		<br>
		<div class="row">
		<div class="alert alert alert-success" role="alert">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				Si el oficial o encargado también es TOE deberá relacionarlo en el módulo TOE - Trabajadores ocupacionalmente expuestos
		</div>
		</div>

		<div id="btnGuardarOficialTOE" class="col-md-12 pt-200">
			<p align="center">
				<br/>
				<button type="submit" class="btn btn-warning">
				 Guardar Encargado TOE
				</button>
			</p>
		</div>
		<div id="resultado3_1">
			
		</div>
	
	</form>
	<form id="formSeccion3-2" name="formSeccion3-2" action="<?php echo base_url('xindustrial/editarTrabajadorToeRX')?>"  method="post"  class="text-justify border border-light p-5">
	 <!-- PRIMERA PARTE DEL REGISTRO DE LA SOLICITUD - LOCALIZACION tipoTramite  -->

		<div class="col">
			<h4><b><span class="text-orange">•</span>TOE - Trabajadores ocupacionalmente  Expuestos</b></h4>
		</div>

		<div class="row">

		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_pnombre">Primer Nombre</label>
			  <input id="toe_pnombre" name="toe_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_snombre">Segundo Nombre</label>
			  <input id="toe_snombre" name="toe_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>

		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_papellido">Primer Apellido</label>
			  <input id="toe_papellido" name="toe_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>
		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_sapellido">Segundo Apellido</label>
			  <input id="toe_sapellido" name="toe_sapellido" placeholder="Ingresar Segundo Apellido" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>
		</div>

		<div class="row">
		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_correo">Correo Electrónico</label>
			  <input id="toe_correo" name="toe_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]]" type="email" required>
		   </div>
		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="encargado_tdocumento">Tipo Documento</label>
			  <select id="toe_tdocumento" name="toe_tdocumento" class="form-control validate[required]" required>
				  <option value=""> - Seleccione Tipo Documento -</option>
				 <?php
				 for($i=0;$i<count($tipo_identificacion_natural);$i++){
					 ?>
					 <option value="<?php echo $tipo_identificacion_natural[$i]->IdTipoIdentificacion?>">
					 <?php echo $tipo_identificacion_natural[$i]->Descripcion?>
					 </option>
					 <?php
				 }
				 ?>                    
			  </select>
		   </div>

		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="toe_ndocumento">Número Documento</label>
			  <input id="toe_ndocumento" name="toe_ndocumento" placeholder="Ingresar Número Documento" class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]"  onKeyPress="if(this.value.length==15) return false;">
		   </div>

		   <div class="col-md-3">
			  <span class="text-orange">•</span><label for="toe_lexpedicion">Lugar Expedición</label>
			  <input id="toe_lexpedicion" name="toe_lexpedicion" placeholder="Ingresar Lugar Expedición" class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
		   </div>
		</div>

		<div class="row">
		   <div class="col-md-6">
			  <span class="text-orange">•</span><label for="toe_nivel">Nivel Académico</label>
			  <select id="toe_nivel" name="toe_nivel" class="form-control validate[required]" required>
				 <option value="">Seleccione...</option>
				 <?php
				 for($i=0;$i<count($nivelAcademico);$i++){
					 ?>
					 <option value="<?php echo $nivelAcademico[$i]->IdNivelEducativo?>">
					 <?php echo $nivelAcademico[$i]->Nombre?>
					 </option>
					 <?php
				 }
				 ?> 
			  </select>
		   </div>
		   <div class="col-md-6">
			  <span class="text-orange">•</span><label for="toe_profesion">Profesión</label>
			  <input id="toe_profesion" name="toe_profesion" placeholder="Ingresar Profesión" class="form-control validate[required]" type="text" required>                  
		   </div>
		</div>

		<div class="row">
		   <div class="col-md-6">
			  <span class="text-orange">•</span><label for="toe_ult_entrenamiento">Fecha del último entrenamiento en protección radiológica</label>
			  <input id="toe_ult_entrenamiento" name="toe_ult_entrenamiento" placeholder="Ingresar Fecha del último entrenamiento en protección radiológica" class="form-control validate[required] input-md" type="date"  max="<?php echo date('Y-m-d')?>" required >
		   </div>
		   <div class="col-md-6">
			  <span class="text-orange">•</span><label for="toe_pro_entrenamiento">Fecha del próximo entrenamiento en protección radiológica</label>
			  <input id="toe_pro_entrenamiento" name="toe_pro_entrenamiento" placeholder="Ingresar Fecha del próximo entrenamiento en protección radiológica" class="form-control validate[required] input-md" type="date" >
		   </div>               
		</div>
		<div class="row">
			<div class="col-md-6">
			  <span class="text-orange">•</span><label for="toe_registro">Número del registro profesional de salud</label>
			  <input id="toe_registro" name="toe_registro" placeholder="Ingresar Número del registro profesional de salud" class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" onKeyPress="if(this.value.length==15) return false;">
		   </div>
		</div>


		<div id="btnGuardarOficialTOE" class="col-md-12 pt-200">
		   <p align="center">
			  <br/>
			  <!-- Primer Collapsible - Localizacion Entidad -->
			  <button type="submit" class="btn btn-warning">
				 Guardar TOE
			  </button>
		   </p>
		</div>

	</form>
	<div id="resultado3_2" class="col-12 col-md-12 table-responsive">
			<table class="display nowrap table table-hover">
			   <thead>
				  <tr>
					 <th>ID</th>
					 <th>Número Identificación</th>
					 <th>Nombres y Apellidos </th>
					 <th>Ver Más</th>
					 <th>Eliminar</th>
				  </tr>
			   </thead>

			<tbody>
			<?php 
			if(isset($rayosxTemporalToe)){
				for($i=0;$i<count($rayosxTemporalToe);$i++){
					?>
					<tr>
						<td><?php echo $rayosxTemporalToe[$i]->id_toe_rayosx;?></td>
						<td><?php echo $rayosxTemporalToe[$i]->toe_ndocumento;?></td>
						<td><?php echo $rayosxTemporalToe[$i]->toe_pnombre;?> <?php echo $rayosxTemporalToe[$i]->toe_snombre;?> <?php echo $rayosxTemporalToe[$i]->toe_papellido;?> <?php echo $rayosxTemporalToe[$i]->toe_sapellido;?></td>
						<td>
							<a class="btn btn-success"  onClick="abrirModal('TOE ID: <?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>','#modalToe<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>')">Ver más...</a> 
						</td>
						<td>
							<a class="btn btn-danger" href="#" onClick="eliminarTOE(<?php echo $rayosxTemporalToe[$i]->id_tramite_rayosx?>,<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>)">Eliminar</a>
						</td>
					</tr>
					<div id="modalToe<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?>" class="modal">
					  <p><b>TOE ID:<?php echo $rayosxTemporalToe[$i]->id_toe_rayosx?></b></p>
						<ul>							
							<li><b>Primer Nombre: </b><?php echo $rayosxTemporalToe[$i]->toe_pnombre?></li>
							<li><b>Segundo Nombre: </b><?php echo $rayosxTemporalToe[$i]->toe_snombre?></li>
							<li><b>Primer Apellido: </b><?php echo $rayosxTemporalToe[$i]->toe_papellido?></li>
							<li><b>Segundo Apellido: </b><?php echo $rayosxTemporalToe[$i]->toe_sapellido?></li>
							<li><b>Número de identificación: </b><?php echo $rayosxTemporalToe[$i]->toe_ndocumento?></li>
							<li><b>Lugar Expedición: </b><?php echo $rayosxTemporalToe[$i]->toe_lexpedicion?></li>
							<li><b>Correo: </b><?php echo $rayosxTemporalToe[$i]->toe_correo?></li>
							<li><b>Profesión: </b><?php echo $rayosxTemporalToe[$i]->toe_profesion?></li>
							<li><b>Nivel Académico: </b><?php echo $rayosxTemporalToe[$i]->toe_nivel?></li>
							<li><b>Fecha del último entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$i]->toe_ult_entrenamiento?></li>
							<li><b>Fecha del próximo entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$i]->toe_pro_entrenamiento?></li>
							<li><b>Número del registro profesional de salud: </b><?php echo $rayosxTemporalToe[$i]->toe_registro?></li>
						</ul>					  
					</div>
					<?php	
				}	
			}else{
				?>
				<tr>
					<td colspan="6" scope="col">No Existen TOE Registrados</td>
				</tr>	
				<?php
			}
			?>            
			</tbody>
			</table>
		</div>
</div>