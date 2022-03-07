<div class="row">
	<div class="col-md-6 pl-4" id="div_1_1">
		<div class="paragraph">
			<label for=""><b>Tipo Identificaci&oacute;n:</b></label>
			<select id="tipo_identificacion" name="tipo_identificacion" class="form-control validate[required]" readonly >
				<option value="">Seleccione...</option>
				<?php
				for($i=0;$i<count($tipo_identificacion);$i++){
					
					if($tramites_pendientes->tipo_identificacion == $tipo_identificacion[$i]->IdTipoIdentificacion){
						echo "<option value='".$tipo_identificacion[$i]->IdTipoIdentificacion."' selected>".$tipo_identificacion[$i]->Descripcion."</option>";
					}else{
						echo "<option value='".$tipo_identificacion[$i]->IdTipoIdentificacion."'>".$tipo_identificacion[$i]->Descripcion."</option>";
					}                                    
				}
				?>
			</select>
		</div>
	</div>
	<div class="col-md-6 pl-4" id="div_1_2">
		<div class="paragraph">
			<label for="num_doc"><b>N&uacute;mero Identificaci&oacute;n:</b></label>
			<input id="nume_documento" name="nume_documento" required placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramites_pendientes->nume_identificacion?>" readonly style="width:100%;">
		</div>
	</div>
	<?php
		if($tramites_pendientes->tipo_identificacion == 5){
			?>
			<div class="col-md-6 pl-4" id="div_1_13">
				<div class="paragraph">
					<label for=""><b>Razón Social:</b></label>
					<input id="nombre_rs" name="nombre_rs" required placeholder="Razón Social" class="form-control validate[required, maxSize[250]]" type="text" value="<?php echo $tramites_pendientes->nombre_rs?>">
				</div>
			</div>
			<?php
		}else{
			?>
			<div class="col-md-6 pl-4" id="div_1_3">
				<div class="paragraph">
					<label for=""><b>Primer nombre:</b></label>
					<input id="p_nombre" name="p_nombre" required placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_nombre?>">
				</div>
			</div>
			<div class="col-md-6 pl-4" id="div_1_4">
				<div class="paragraph">
					<label for=""><b>Segundo nombre:</b></label>
					<input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_nombre?>">
				</div>
			</div>
			<div class="col-md-6 pl-4" id="div_1_5">
				<div class="paragraph">
					<label for=""><b>Primer apellido:</b></label>
					<input id="p_apellido" name="p_apellido" required placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_apellido?>">
				</div>
			</div>
			<div class="col-md-6 pl-4" id="div_1_6">
				<div class="paragraph">
					<label for=""><b>Segundo apellido:</b></label>
					<input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_apellido?>">
				</div>
			</div>
			<?php
		}
	?>
	<div class="col-md-6 pl-4" id="div_1_7">
		<div class="paragraph">
			<label for=""><b>Teléfono celular:</b></label>
			<input id="telefono_celular" name="telefono_celular" placeholder="Teléfono celular" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramites_pendientes->telefono_celular?>">
		</div>
	</div>
	<div class="col-md-6 pl-4" id="div_1_8">
		<div class="paragraph">
			<label for=""><b>Teléfono fijo:</b></label>
			<input id="telefono_fijo" name="telefono_fijo" placeholder="Teléfono fijo" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramites_pendientes->telefono_fijo?>">
		</div>
	</div>
	<div class="col-md-6 pl-4" id="div_1_9">
		<div class="paragraph">
			<label for=""><b>Correo electr&oacute;nico:</b></label>
			<input id="email" name="email" required placeholder="Correo eletrónico " class="form-control input-md validate[required, custom[email]]" required="" type="text" value="<?php echo $tramites_pendientes->email?>">
		</div>
	</div>
	<?php
	if($tramites_pendientes->tipo_identificacion == 5)
	{
		?>
		<div class="col-md-6 pl-4" id="div_1_1">
			<div class="paragraph">
				<label for=""><b>Tipo Identificaci&oacute;n representante legal:</b></label>
				<select id="tipo_iden_rl" name="tipo_iden_rl" required class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<?php
					for($i=0;$i<count($tipo_identificacion);$i++){

						if($tramites_pendientes->tipo_iden_rl == $tipo_identificacion[$i]->IdTipoIdentificacion){
							echo "<option value='".$tipo_identificacion[$i]->IdTipoIdentificacion."' selected>".$tipo_identificacion[$i]->Descripcion."</option>";
						}else{
							echo "<option value='".$tipo_identificacion[$i]->IdTipoIdentificacion."'>".$tipo_identificacion[$i]->Descripcion."</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6 pl-4" id="div_1_2">
			<div class="paragraph">
				<label for="nume_iden_rl"><b>N&uacute;mero Identificaci&oacute;n:</b></label>
				<input id="nume_iden_rl" name="nume_iden_rl" required placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramites_pendientes->nume_iden_rl?>" style="width:100%;">
			</div>
		</div>
		<div class="col-md-6 pl-4" id="div_1_3">
			<div class="paragraph">
				<label for=""><b>Primer nombre representante legal:</b></label>
				<input id="p_nombre" name="p_nombre" required placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_nombre?>">
			</div>
		</div>
		<div class="col-md-6 pl-4" id="div_1_4">
			<div class="paragraph">
				<label for=""><b>Segundo nombre representante legal:</b></label>
				<input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_nombre?>">
			</div>
		</div>
		<div class="col-md-6 pl-4" id="div_1_5">
			<div class="paragraph">
				<label for=""><b>Primer apellido representante legal:</b></label>
				<input id="p_apellido" name="p_apellido" required placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_apellido?>">
			</div>
		</div>
		<div class="col-md-6 pl-4" id="div_1_6">
			<div class="paragraph">
				<label for=""><b>Segundo apellido representante legal:</b></label>
				<input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_apellido?>">
			</div>
		</div>
		<?php
	}else{
	?>
	<div class="col-md-6 pl-4" id="div_1_10">
		<div class="paragraph">
			<label for=""><b>Fecha Nacimiento:</b></label>
			<input id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nacimiento" class="form-control input-md validate[required]" type="date" value="<?php echo $tramites_pendientes->fecha_nacimiento?>" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6 pl-4" id="div_1_11">
		<div class="paragraph">
			<label for=""><b>Sexo:</b></label>
				<select id="sexo" name="sexo" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1"  <?php if($tramites_pendientes->sexo == 1){ echo "selected";}?>>Hombre</option>
					<option value="2"  <?php if($tramites_pendientes->sexo == 2){ echo "selected";}?>>Mujer</option>
					<option value="3"  <?php if($tramites_pendientes->sexo == 3){ echo "selected";}?>>Intersexual</option>
				</select>
		</div>
	</div>			
	<div class="col-md-6 pl-4" id="div_1_12">
		<div class="paragraph">
			<label for=""><b>Genero:</b></label>
				<select id="genero" name="genero" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" <?php if($tramites_pendientes->genero == 1){ echo "selected";}?>>Masculino</option>
					<option value="2" <?php if($tramites_pendientes->genero == 2){ echo "selected";}?>>Femenino</option>
					<option value="3" <?php if($tramites_pendientes->genero == 3){ echo "selected";}?>>Transgenero</option>
					<option value="4" <?php if($tramites_pendientes->genero == 4){ echo "selected";}?>>No responde</option>
				</select>
		</div>
	</div>			
	<div class="col-md-6 pl-4" id="div_1_13">
		<div class="paragraph">
			<label for=""><b>Orientaci&oacute;n:</b></label>
				<select id="orientacion" name="orientacion" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" <?php if($tramites_pendientes->orientacion == 1){ echo "selected";}?>>Heterosexual</option>
					<option value="2" <?php if($tramites_pendientes->orientacion == 2){ echo "selected";}?>>Homosexual</option>
					<option value="3" <?php if($tramites_pendientes->orientacion == 3){ echo "selected";}?>>Bisexual</option>
				</select>
		</div>
	</div>			
	<div class="col-md-6 pl-4" id="div_1_14">
		<div class="paragraph">
			<label for=""><b>Etnia:</b></label>
				<select id="etnia" name="etnia" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" <?php if($tramites_pendientes->etnia == 1){ echo "selected";}?>>Indigena</option>
					<option value="2" <?php if($tramites_pendientes->etnia == 2){ echo "selected";}?>>Rom-Gitano</option>
					<option value="3" <?php if($tramites_pendientes->etnia == 3){ echo "selected";}?>>Raizal</option>
					<option value="4" <?php if($tramites_pendientes->etnia == 4){ echo "selected";}?>>Palenquero</option>
					<option value="5" <?php if($tramites_pendientes->etnia == 5){ echo "selected";}?>>Afrocolombiano</option>
					<option value="6" <?php if($tramites_pendientes->etnia == 6){ echo "selected";}?>>Ninguna</option>
				</select>
		</div>
	</div>			
	<div class="col-md-6 pl-4" id="div_1_15">
		<div class="paragraph">
			<label for=""><b>Estado Civil:</b></label>
				<select id="estado_civil" name="estado_civil" class="form-control">
					<option value="">Seleccione...</option>
					<option value="1" <?php if($tramites_pendientes->estado_civil == 1){ echo "selected";}?>>Soltero</option>
					<option value="2" <?php if($tramites_pendientes->estado_civil == 2){ echo "selected";}?>>Casado</option>
					<option value="3" <?php if($tramites_pendientes->estado_civil == 3){ echo "selected";}?>>Union marital de hecho</option>
					<option value="4" <?php if($tramites_pendientes->estado_civil == 4){ echo "selected";}?>>Divorciado</option>
					<option value="5" <?php if($tramites_pendientes->estado_civil == 5){ echo "selected";}?>>Viudo</option>
				</select>
		</div>
	</div>			
	<div class="col-md-6 pl-4" id="div_1_16">
		<div class="paragraph">
			<label for=""><b>Nivel Educativo:</b></label>
				<select id="tipo" name="nivel_educativo" class="form-control validate[required]">
					<option value="">Seleccione...</option>
					<option value="1" <?php if($tramites_pendientes->nivel_educativo == 1){ echo "selected";}?>>Primaria</option>
					<option value="2" <?php if($tramites_pendientes->nivel_educativo == 2){ echo "selected";}?>>Secundaria</option>
					<option value="3" <?php if($tramites_pendientes->nivel_educativo == 3){ echo "selected";}?>>T&eacute;cnico</option>
					<option value="4" <?php if($tramites_pendientes->nivel_educativo == 4){ echo "selected";}?>>Tecn&oacute;logo</option>
					<option value="5" <?php if($tramites_pendientes->nivel_educativo == 5){ echo "selected";}?>>Profesional</option>
					<option value="6" <?php if($tramites_pendientes->nivel_educativo == 6){ echo "selected";}?>>Especialista</option>
					<option value="7" <?php if($tramites_pendientes->nivel_educativo == 7){ echo "selected";}?>>Maestria</option>
					<option value="8" <?php if($tramites_pendientes->nivel_educativo == 8){ echo "selected";}?>>Doctorado</option>
					<option value="9" <?php if($tramites_pendientes->nivel_educativo == 9){ echo "selected";}?>>Post-Doctorado</option>
					<option value="10" <?php if($tramites_pendientes->nivel_educativo == 10){ echo "selected";}?>>Ninguno</option>
				</select>
		</div>
	</div>
	<?php
	}
	?>
	</div>	