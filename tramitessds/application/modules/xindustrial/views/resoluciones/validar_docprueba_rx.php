<script type="text/javascript">
		
    $(document).ready(function(){
        $(".actualizarVisorAction").click(function() {                   
            $("#visorPdf").attr('src', $(this).attr('title'));            
        });
    });
                        
</script>
<?php

$retornoError = $this->session->flashdata('error');
if ($retornoError) {
?>
    <div class="alert alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $retornoError ?>
    </div>
    <?php
}

$retornoExito = $this->session->flashdata('exito');
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


<form class="form-horizontal" id="form_tramite" name="form_tramite" action="<?php echo base_url('validacion/guardarEstadoRx/'.$tramites_pendientes->id)?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_persona" value="<?php echo $tramites_pendientes->id_persona?>">
<input type="hidden" name="id_tramite" value="<?php echo $tramites_pendientes->id?>">
<fieldset class="header-form">
<div class="row block right" style="width:100%;">
			<div class="col-12 col-md-12 pl-4">
				<div class="subtitle">
					<h2><b>Tr&aacute;mite ID.<?php echo $tramites_pendientes->id?></b></h2>
					<h4><b>Estado Trámite:</b> <?php echo $tramites_pendientes->descripcion?>
						<br>
						<b>Fecha Trámite:</b> <?php echo $tramites_pendientes->created_at?>
					</h4>
				</div>
            </div>
            <div class="row block w-100 newsletter ">
			<div class="col-12 col-md-12 text-center">
			
				<h3>
					<table style="width:100%;">
					<tr>
					<td align="left"><b>Datos Personales</b> <i class="fas fa-user"></i></td>
					<td align="right"><font color="#3D5DA6"><i id="mindiv1" class="fas fa-angle-up"></i><i id="morediv1" class="fas fa-angle-down"></i></font></td>
					</tr>
					</table>
				</h3>
            </div>
			
            <div class="col-12 col-md-6 pl-4" id="div_1_1">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_2">
                <div class="paragraph">
                    <label for="num_doc"><b>N&uacute;mero Identificaci&oacute;n:</b></label>
                    <input id="nume_documento" name="nume_documento" placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramites_pendientes->nume_identificacion?>" readonly style="width:100%;">                    
                </div>
            </div>
			<?php
				if($tramites_pendientes->tipo_identificacion == 5){
					?>
					<div class="col-12 col-md-6 pl-4" id="div_1_13">
						<div class="paragraph">
							<label for=""><b>Razón Social:</b></label>
							<input id="nombre_rs" name="nombre_rs" placeholder="Razón Social" class="form-control validate[required, maxSize[250]]" type="text" value="<?php echo $tramites_pendientes->nombre_rs?>">
						</div>
					</div>
					<?php
				}else{
					?>
					<div class="col-12 col-md-6 pl-4" id="div_1_3">
						<div class="paragraph">
							<label for=""><b>Primer nombre:</b></label>
							<input id="p_nombre" name="p_nombre" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_nombre?>">
						</div>
					</div>
					<div class="col-12 col-md-6 pl-4" id="div_1_4">
						<div class="paragraph">
							<label for=""><b>Segundo nombre:</b></label>
							<input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_nombre?>">
						</div>
					</div>
					<div class="col-12 col-md-6 pl-4" id="div_1_5">
						<div class="paragraph">
							<label for=""><b>Primer apellido:</b></label>
							<input id="p_apellido" name="p_apellido" placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_apellido?>">
						</div>
					</div>
					<div class="col-12 col-md-6 pl-4" id="div_1_6">
						<div class="paragraph">
							<label for=""><b>Segundo apellido:</b></label>
							<input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_apellido?>">
						</div>
					</div>
					<?php
				}			
			?>			
			<div class="col-12 col-md-6 pl-4" id="div_1_7">
                <div class="paragraph">
					<label for=""><b>Teléfono celular:</b></label>
					<input id="telefono_celular" name="telefono_celular" placeholder="Teléfono celular" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramites_pendientes->telefono_celular?>">
				</div>
            </div>				
			<div class="col-12 col-md-6 pl-4" id="div_1_8">
                <div class="paragraph">
					<label for=""><b>Teléfono fijo:</b></label>
					<input id="telefono_fijo" name="telefono_fijo" placeholder="Teléfono fijo" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramites_pendientes->telefono_fijo?>">
				</div>
            </div>
			<div class="col-12 col-md-6 pl-4" id="div_1_9">
                <div class="paragraph">
					<label for=""><b>Correo electr&oacute;nico:</b></label>
                    <input id="email" name="email" placeholder="Correo eletrónico " class="form-control input-md validate[required, custom[email]]" required="" type="text" value="<?php echo $tramites_pendientes->email?>">
				</div>
            </div>
			<?php
			if($tramites_pendientes->tipo_identificacion == 5)
			{
				?>
				<div class="col-12 col-md-6 pl-4" id="div_1_1">
					<div class="paragraph">
						<label for=""><b>Tipo Identificaci&oacute;n representante legal:</b></label>
						<select id="tipo_iden_rl" name="tipo_iden_rl" class="form-control validate[required]">
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
				<div class="col-12 col-md-6 pl-4" id="div_1_2">
					<div class="paragraph">
						<label for="nume_iden_rl"><b>N&uacute;mero Identificaci&oacute;n:</b></label>
						<input id="nume_iden_rl" name="nume_iden_rl" placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramites_pendientes->nume_iden_rl?>" style="width:100%;">                    
					</div>
				</div>
				<div class="col-12 col-md-6 pl-4" id="div_1_3">
					<div class="paragraph">
						<label for=""><b>Primer nombre representante legal:</b></label>
						<input id="p_nombre" name="p_nombre" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_nombre?>">
					</div>
				</div>
				<div class="col-12 col-md-6 pl-4" id="div_1_4">
					<div class="paragraph">
						<label for=""><b>Segundo nombre representante legal:</b></label>
						<input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_nombre?>">
					</div>
				</div>
				<div class="col-12 col-md-6 pl-4" id="div_1_5">
					<div class="paragraph">
						<label for=""><b>Primer apellido representante legal:</b></label>
						<input id="p_apellido" name="p_apellido" placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->p_apellido?>">
					</div>
				</div>
				<div class="col-12 col-md-6 pl-4" id="div_1_6">
					<div class="paragraph">
						<label for=""><b>Segundo apellido representante legal:</b></label>
						<input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramites_pendientes->s_apellido?>">
					</div>
				</div>
				<?php
			}else{
			?>	
			<div class="col-12 col-md-6 pl-4" id="div_1_10">
                <div class="paragraph">
					<label for=""><b>Fecha Nacimiento:</b></label>
					<input id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nacimiento" class="form-control input-md validate[required]" type="date" value="<?php echo $tramites_pendientes->fecha_nacimiento?>" autocomplete="off">
				</div>
            </div>
			<div class="col-12 col-md-6 pl-4" id="div_1_11">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_12">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_13">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_14">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_15">
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
			<div class="col-12 col-md-6 pl-4" id="div_1_16">
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
			
			<div class="row block w-100 newsletter ">
			<div class="col-12 col-md-12 text-center ">
			<br><br>	
				<h3>
					<table style="width:100%;">
					<tr>
					<td align="left"><b>Localización Entidad </b> <i class="fas fa-globe-americas"></i></td>
					<td align="right"><font color="#3D5DA6"><i id="mindiv2" class="fas fa-angle-up"></i><i id="morediv2" class="fas fa-angle-down"></i></font></td>
					</tr>
					</table>
				</h3>
            </div>
                <div class="col-md-6" id="div_2_1">
                   <span class="text-orange">•</span><label for="depto_entidad">Departamento(*)</label>
                   <input id="id_tramite" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
                   <input id="id_tramite" name="id_direccion_tramite" type="hidden" value="<?php if(isset($rayosxDireccion)&& $rayosxDireccion->id_direccion_rayosx != ''){ echo $rayosxDireccion->id_direccion_rayosx;} ?>">
                   <select id="depto_entidad" name="depto_entidad" class="form-control validate[required]" required disabled>
                      <option value=""> - Seleccione Departamento -</option>
                      <?php
                      for($i=0;$i<count($departamento);$i++){
                          ?>
                            <option value="<?php echo $departamento[$i]->IdDepartamento?>"
                            <?php
                                if(isset($rayosxDireccion->depto_entidad) && $rayosxDireccion->depto_entidad == $departamento[$i]->IdDepartamento)
                                    {
                                        echo "selected";
                                    }else{ 
                                        echo "";
                                    } ?>>
                                <?php echo $departamento[$i]->Descripcion?>				
                            </option>
                      <?php
                      }
                      ?>
                   </select>
                </div>
                <?php
                if(isset($rayosxDireccion->depto_entidad)){
                    $municipios = $this->login_model->municipios_col($rayosxDireccion->depto_entidad);
                }

                ?>
                <div class="col-md-6" id="div_2_2">
                   <span class="text-orange">•</span><label for="mpio_entidad">Municipio(*)</label>
                   <select id="mpio_entidad" name="mpio_entidad" class="form-control validate[required]" required disabled>
                    <option value="">Seleccione...</option>
                    <?php 
                        if(count($municipios) > 0){
                            for($j=0;$j<count($municipios);$j++){
                                ?>
                                    <option value="<?php echo $municipios[$j]->CodigoDane?>" 
                                    <?php
                                        if(isset($rayosxDireccion->mpio_entidad) && $rayosxDireccion->mpio_entidad == $municipios[$j]->CodigoDane)
                                            {
                                                echo "selected";
                                            }?>>
                                        <?php echo $municipios[$j]->Descripcion?>				
                                    </option>
                                <?php
                            }

                        }

                    ?>
                   </select>
                   <div class="col-md-2" style="visibility:hidden;"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
                </div>


            <div class="col-md-6" id="div_2_3">
                <span class="text-orange">•</span><label for="tipo_tramite">Dirección de la Instalación(*)</label>
                <input id="dire_entidad" name="dire_entidad" class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" required disabled placeholder="Ingresar la Dirección Entidad" value="<?php if(isset($rayosxDireccion->dire_entidad)){echo $rayosxDireccion->dire_entidad;}?>"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
             </div>

             <div class="col-md-6" id="div_2_4">
                <span class="text-orange">•</span><label for="dire_entidad">Sede de la Instalación(*)</label>
                <input id="sede_entidad" name="sede_entidad" class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" required disabled placeholder="Ingresar el Nombre Distintivo de la sede que será sujeta a inspección" value="<?php if(isset($rayosxDireccion->sede_entidad)){echo $rayosxDireccion->sede_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="30"  title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
             </div>
             <div class="col-md-6" id="div_2_5">
                   <span class="text-orange">•</span><label for="email_entidad">Correo Electrónico(*)</label>
                   <input id="email_entidad" name="email_entidad" class="form-control validate[required, custom[email]] input-md" type="email" required disabled placeholder="Ingresar Correo Electrónico"  value="<?php if(isset($rayosxDireccion->email_entidad)){echo $rayosxDireccion->email_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="30"  title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
             </div>

            <div class="col-md-6" id="div_2_6">
               <span class="text-orange">•</span><label for="celular_entidad">Número celular(*)</label>
               <input id="celular_entidad" name="celular_entidad" placeholder="Ingresar Número Celular de contacto en sede de la Instalación" class="form-control input-md validate[required,custom[number], minSize[10], maxSize[10]]" value="<?php if(isset($rayosxDireccion->celular_entidad)){echo $rayosxDireccion->celular_entidad;}?>"   minlength="10" maxlength="10"  title="Ingresar un Tamaño mínimo: 10 carácteres a un Tamaño máximo: 10 carácteres" onKeyPress="if(this.value.length==10) return false;" disabled>
            </div>
                <div class="col-md-6" id="div_2_7">
                   <span class="text-orange">•</span><label for="telefono_entidad">Número telefónico fijo</label>
                   <input id="telefono_entidad" name="telefono_entidad" placeholder="Ingresar Número telefónico de contacto en sede de la Instalación" class="form-control input-md validate[required, custom[number], minSize[7], maxSize[10]]" value="<?php if(isset($rayosxDireccion->telefono_entidad)){echo $rayosxDireccion->telefono_entidad;}?>"   minlength="7" maxlength="10"  title="Ingresar un Tamaño mínimo: 7 carácteres a un Tamaño máximo: 10 carácteres" onKeyPress="if(this.value.length==10) return false;" disabled>
                </div>

                <div class="col-md-6" id="div_2_8">
                   <span class="text-orange">•</span><label for="extension_entidad">Extensión</label>
                   <input id="extension_entidad" name="extension_entidad" placeholder="Ingresar Extensión telefónica de contacto en sede" class="form-control input-md validate[custom[number], minSize[3], maxSize[5]]" value="<?php if(isset($rayosxDireccion->extension_entidad)){echo $rayosxDireccion->extension_entidad;}?>"   minlength="3" maxlength="5"  title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 5 carácteres" onKeyPress="if(this.value.length==5) return false;" disabled>
                </div>
				<div class="col-md-12">
                   <span class="text-orange">•</span><label for="extension_entidad">Observaciones Validación</label>
                   <textarea id="observaciones_item1" name="observaciones_item1" placeholder="Observaciones de localización" class="form-control input-md"></textarea>
                </div>
			</div>	

			<div class="row block w-100 newsletter ">
			<div class="col-12 col-md-12 text-center ">
			<br><br>
				<h3>
					<table style="width:100%;">
					<tr>
					<td align="left"><b>Equipos generadores de radiación ionizante</b> <i class="fas fa-x-ray"></i></td>
					<td align="right">
					<font color="#3D5DA6"><i id="mindiv3" class="fas fa-angle-up"></i><i id="morediv3" class="fas fa-angle-down"></i></font>
					<input type="hidden" id="tipotitulovalue" value="<?php echo $tramites_pendientes->id?>">
					</td>
					</tr>
					</table>
				</h3>
            </div>
            <?php
            $verbtnCate = "block";
            ?>
           <div class="col-md-12" id="div_3_1">
               <span class="text-orange">•</span><label for="categoria">Categoría</label>
               <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
               <input id="id_categoria_rayosx" name="id_categoria_rayosx" type="hidden" value="<?php if(isset($tramite_info)&& $tramite_info->categoria != ''){ echo $tramite_info->categoria;} ?>">
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
            <div id="div_3_2" class="col-12 col-md-12 table-responsive">
                <table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Marca Equipo</th>
						<th>Modelo Equipo</th>
						<th>Serie Equipo</th>										
						<th>Ver más</th>
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
							<!--<a class="btn green" onClick="abrirModal('Equipo <?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>','#ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>')">Ver más...</a>-->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
							  Ver más...
							</button>
						</td>						
					</tr>
					<div class="modal fade" id="ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><b>Equipo ID:<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?></b></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
							<ul>
							<?php
								if($rayosxEquipo[$i]->categoria1 != 0 || $rayosxEquipo[$i]->categoria1 != NULL){
									if($rayosxEquipo[$i]->categoria1 == 1){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radiolog&iacute;a odontol&oacute;gica periapical</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria1 == 2){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de RX</li>
										<?php
									}
								}
						   
								if($rayosxEquipo[$i]->categoria2 != 0 || $rayosxEquipo[$i]->categoria2 != NULL){
									if($rayosxEquipo[$i]->categoria2 == 1){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radioterapia</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2 == 2){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de alta complejidad</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2 == 3){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de media complejidad</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2 == 4){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radio diagn&oacute;stico de baja complejidad</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2 == 5){
										?>
										<li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Radiografias odontol&oacute;gicas pan&oacute;ramicas y tomografias orales</li>
										<?php
									}
								}
					
								if($rayosxEquipo[$i]->categoria1_1 != 0 || $rayosxEquipo[$i]->categoria1_1 != NULL){
									if($rayosxEquipo[$i]->categoria1_1 == 1){
										?>
										<li><b>Radiolog&iacute;a odontol&oacute;gica periapical: </b>Equipo de RX odontol&oacute;gico periapical</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria1_1 == 2){
										?>
										<li><b>Radiolog&iacute;a odontol&oacute;gica periapical: </b>Equipo de RX odontol&oacute;gico periapical portat&iacute;l</li>
										<?php
									}
								}
					
								if($rayosxEquipo[$i]->categoria1_2 != 0 || $rayosxEquipo[$i]->categoria1_2 != NULL){
									if($rayosxEquipo[$i]->categoria1_2 == 1){
										?>
										<li><b>Equipo de RX: </b>Densit&oacute;metro &oacute;seo</li>
										<?php
									}
								}
								
								if($rayosxEquipo[$i]->categoria2_1 != 0 || $rayosxEquipo[$i]->categoria2_1 != NULL){
									if($rayosxEquipo[$i]->categoria2_1 == 1){
										?>
										<li><b>Equipo de RX: </b>Equipo de RX convencional</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 2){
										?>
										<li><b>Equipo de RX: </b>Tomógrafo Odontológico</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 3){
										?>
										<li><b>Equipo de RX: </b>Tomógrafo</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 4){
										?>
										<li><b>Equipo de RX: </b>Equipo de RX Portátil</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 5){
										?>
										<li><b>Equipo de RX: </b>Equipo de RX Odontológico</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 6){
										?>
										<li><b>Equipo de RX: </b>Panorámico Cefálico</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 7){
										?>
										<li><b>Equipo de RX: </b>Fluoroscopio</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 8){
										?>
										<li><b>Equipo de RX: </b>SPECT-CT</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 9){
										?>
										<li><b>Equipo de RX: </b>Arco en C</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 10){
										?>
										<li><b>Equipo de RX: </b>Mamógrafo</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 11){
										?>
										<li><b>Equipo de RX: </b>Litotriptor</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 12){
										?>
										<li><b>Equipo de RX: </b>Angiógrafo</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 13){
										?>
										<li><b>Equipo de RX: </b>PET-CT</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 14){
										?>
										<li><b>Equipo de RX: </b>Acelerador lineal</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 15){
										?>
										<li><b>Equipo de RX: </b>Sistema de radiocirugia robótica</li>
										<?php
									}else if($rayosxEquipo[$i]->categoria2_1 == 16){
										?>
										<li><b>Equipo de RX: </b><?php echo $rayosxEquipo[$i]->otro_equipo?></li>
										<?php
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
							
							<?php
								
								if($rayosxEquipo[$i]->fi_blindajes != ''){
									$fi_blindajes = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_blindajes);
									
									if($fi_blindajes){
										?>
										<li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_blindajes->nombre);?>" target="_blank">Ver archivo</a></li>		
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
									$fi_control_calidad = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_control_calidad);
									
									if($fi_control_calidad){
										?>
										<li><b>Informe sobre los resultados del control de calidad: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_control_calidad->nombre);?>" target="_blank">Ver archivo</a></li>		
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
									$fi_plano = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_plano);
									
									if($fi_plano){
										?>
										<li><b>Plano general de las instalaciones: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_plano->nombre);?>" target="_blank">Ver archivo</a></li>		
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
									$fi_pruebas_caracterizacion = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_pruebas_caracterizacion);
									
									if($fi_pruebas_caracterizacion){
										?>
										<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_pruebas_caracterizacion->nombre);?>" target="_blank">Ver archivo</a></li>		
										<?php
									}else{
										?>
										<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior:  </b> Sin archivo disponible</li>		
										<?php
									}
								}else{
									?>
									<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b> Sin archivo disponible</li>		
									<?php
								}									
							
								if($rayosxEquipo[$i]->categoria2_1 == 16){
									
									?>
									<h3>Información Tubo RX 2</h3>
									
									<li><b>Marca Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->marca_tubo_rx2?></li>
									<li><b>Modelo Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->modelo_tubo_rx2?></li>
									<li><b>Serie Tubo 2 RX: </b><?php echo $rayosxEquipo[$i]->serie_tubo_rx2?></li>
									<li><b>Tensión máxima tubo 2 RX [kV]: </b><?php echo $rayosxEquipo[$i]->tension_tubo_rx2?></li>
									<li><b>Cont. Max del tubo 2 RX [mA]: </b><?php echo $rayosxEquipo[$i]->contiene_tubo_rx2?></li>
									<li><b>Energía de fotones 2 [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_fotones2?></li>
									<li><b>Energía de electrones 2 [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_electrones2?></li>
									<li><b>Carga de trabajo 2 [mA.min/semana]: </b><?php echo $rayosxEquipo[$i]->carga_trabajo2?></li>
									<li><b>Año de fabricación del tubo2: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion_tubo2?></li>
									<?php
									
									if($rayosxEquipo[$i]->fi_blindajes2 != ''){
										$fi_blindajes2 = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_blindajes2);
										
										if($fi_blindajes2){
											?>
											<li><b>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_blindajes2->nombre);?>" target="_blank">Ver archivo</a></li>		
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
									
									if($rayosxEquipo[$i]->fi_control_calidad2 != ''){
										$fi_control_calidad2 = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_control_calidad2);
										
										if($fi_control_calidad2){
											?>
											<li><b>Informe sobre los resultados del control de calidad: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_control_calidad2->nombre);?>" target="_blank">Ver archivo</a></li>		
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

									
									if($rayosxEquipo[$i]->fi_pruebas_caracterizacion2 != ''){
										$fi_pruebas_caracterizacion2 = $this->rx_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_pruebas_caracterizacion2);
										
										if($fi_pruebas_caracterizacion2){
											?>
											<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_pruebas_caracterizacion2->nombre);?>" target="_blank">Ver archivo</a></li>		
											<?php
										}else{
											?>
											<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior:  </b> Sin archivo disponible</li>		
											<?php
										}
									}else{
										?>
										<li><b>Pruebas iniciales de caracterización de los equipos o licencia anterior: </b> Sin archivo disponible</li>		
										<?php
									}	
									
								}
							?>
								</ul>	
								<h3>Observaciones Infraestructura</h3>		
								<div id="obs<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
									<div class="card card-body">
									<input type="hidden" name="id_tramite" value="<?php echo $tramites_pendientes->id?>">
									<input type="hidden" name="id_equipo" value="<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
									<input type="hidden" name="estado" value="<?php echo $tramites_pendientes->estado?>">
									<div class="row" >
										<h5>Resolución 482 de 2018</h5>
										<p>
											23.7 Plano general de las instalaciones de acuerdo con lo establecido en la Resolución 4445 de 1996, expedida por el entonces Ministerio de Salud o la norma de la modifique o sustituya, el cual debe contener:
										</p>
									</div>
									<?php
									
									$items482 = $this->rx_model->itemsInfraestructura('482');
									
									for($it=0;$it<count($items482);$it++){
										
										
										$itemCons['id_equipo'] = $rayosxEquipo[$i]->id_equipo_rayosx; 
										$itemCons['id_tramite'] = $tramites_pendientes->id; 
										$itemCons['id_item'] = $items482[$it]->id_item; 
																		
										if($tramites_pendientes->estado == 4){
											$itemCons['id_estado'] = 3; 	
										}else if($tramites_pendientes->estado == 7){
											$itemCons['id_estado'] = 3; 	
										}else if($tramites_pendientes->estado == 16){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 19){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 24){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 21){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 25){
											$itemCons['id_estado'] = 24; 	
										}else if($tramites_pendientes->estado == 41){
											$itemCons['id_estado'] = 3; 	
										}
										
										$resultadoEquipoInfra = $this->rx_model->consulta_obs_infra($itemCons);
										
										if(count($resultadoEquipoInfra)>0){
											$obs = $resultadoEquipoInfra->observaciones;
										}else{
											$obs = "";
										}	
										
										?>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<p>
													<?php echo $items482[$it]->desc_item?>
												</p>
											</div>
											<div class="col-md-6">
												<textarea class="form-control input-md" id="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items482[$it]->id_item?>" name="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items482[$it]->id_item?>"><?php echo $obs?></textarea>
											</div>
										</div>
										<?php							
									}
									?>							
									<hr>
									<hr>
									<div class="row">
										<h5>Articulo 33 Resolución 4445 de 1996 </h5>
									</div>
									<?php
									
									$items4445 = $this->rx_model->itemsInfraestructura('4445');
									
									for($it=0;$it<count($items4445);$it++){
										
										$itemCons['id_equipo'] = $rayosxEquipo[$i]->id_equipo_rayosx; 
										$itemCons['id_tramite'] = $tramites_pendientes->id; 
										$itemCons['id_item'] = $items4445[$it]->id_item; 
										
										if($tramites_pendientes->estado == 4){
											$itemCons['id_estado'] = 3; 	
										}else if($tramites_pendientes->estado == 7){
											$itemCons['id_estado'] = 3; 	
										}else if($tramites_pendientes->estado == 16){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 19){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 24){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 21){
											$itemCons['id_estado'] = 15; 	
										}else if($tramites_pendientes->estado == 25){
											$itemCons['id_estado'] = 24; 	
										}else if($tramites_pendientes->estado == 41){
											$itemCons['id_estado'] = 3; 	
										}
										
										$resultadoEquipoInfra = $this->rx_model->consulta_obs_infra($itemCons);
										
										if(count($resultadoEquipoInfra)>0){
											$obs = $resultadoEquipoInfra->observaciones;
										}else{
											$obs = "";
										}	
										
										
										?>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<p>
													<?php echo $items4445[$it]->desc_item?>
												</p>
											</div>
											<div class="col-md-6">
												<textarea class="form-control input-md" id="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items4445[$it]->id_item?>" name="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items4445[$it]->id_item?>"><?php echo $obs?></textarea>
												<!--<input type="text" class="form-control input-md" id="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items4445[$it]->id_item?>" name="item_<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>_<?php echo $items4445[$it]->id_item?>" value="<?php echo $obs?>">-->
											</div>
										</div>
										<?php							
									}
									
									?>	
									<input type="hidden" name="estadoInfra" value="<?php echo $itemCons['id_estado']?>">
									</div>
								</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					  </div>
					</div>
					
					<?php
				}
				?>								
				</tbody>
			</table>
            </div>
			<div class="col-md-12">
			   <span class="text-orange">•</span><label for="extension_entidad">Observaciones Validación</label>
			   <textarea id="observaciones_item2" name="observaciones_item2" placeholder="Observaciones de equipos" class="form-control input-md"></textarea>
			</div>
			</div>
    
			<div class="row block w-100 newsletter ">
            <div class="col-12 col-md-12 text-center ">
			<br><br>
				<h3>
					<table style="width:100%;">
					<tr>
					<td align="left"><b>Trabajadores ocupacionalmente expuestos - TOE</b> <i class="fas fa-user-tie"></i></td>
					<td align="right">
					<font color="#3D5DA6"><i id="mindiv4" class="fas fa-angle-up"></i><i id="morediv4" class="fas fa-angle-down"></i></font>
					</td>
					</tr>
					</table>
				</h3>
            </div>
    
            <div class="col-12 col-md-12" id="div_4_1">
                <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
                <input id="id_encargado_rayosx" name="id_encargado_rayosx" type="hidden" value="<?php if(isset($rayosxOficialToe)&& $rayosxOficialToe->id_encargado_rayosx != ''){ echo $rayosxOficialToe->id_encargado_rayosx;} ?>">
              <div class="col">
               <h4><b><span class="text-orange">•</span>Oficial de protección radiológica/Encargado de protección Radiológica</b></h4>
              </div>
           </div>

           <div class="col-md-4" id="div_4_2">
              <span class="text-orange">•</span><label for="encargado_pnombre">Primer Nombre</label>
              <input id="encargado_pnombre" name="encargado_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_pnombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
           </div>

           <div class="col-md-4" id="div_4_3">
              <span class="text-orange">•</span><label for="encargado_snombre">Segundo Nombre</label>
              <input id="encargado_snombre" name="encargado_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_snombre ;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
           </div>

           <div class="col-md-4" id="div_4_4">
              <span class="text-orange">•</span><label for="encargado_papellido">Primer Apellido</label>
              <input id="encargado_papellido" name="encargado_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_papellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
           </div>
           <div class="col-md-4" id="div_4_5">
              <span class="text-orange">•</span><label for="encargado_sapellido">Segundo Apellido</label>
              <input id="encargado_sapellido" name="encargado_sapellido" placeholder="Ingresar Segundo Apellido" class="form-control input-md validate[minSize[3], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_sapellido; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled> 
           </div>

           <div class="col-md-4" id="div_4_6">
              <span class="text-orange">•</span><label for="encargado_tdocumento">Tipo Documento</label>
              <select id="encargado_tdocumento" name="encargado_tdocumento" class="form-control validate[required]" required disabled>
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

           <div class="col-md-4" id="div_4_7">
              <span class="text-orange">•</span><label for="encargado_ndocumento">Número Documento</label>
              <input id="encargado_ndocumento" name="encargado_ndocumento" placeholder="Ingresar Número Documento" class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" required value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_ndocumento; }?>" onKeyPress="if(this.value.length==15) return false;" disabled> 
           </div>

           <div class="col-md-4" id="div_4_8">
              <span class="text-orange">•</span><label for="encargado_lexpedicion">Lugar Expedición</label>
              <input id="encargado_lexpedicion" name="encargado_lexpedicion" placeholder="Ingresar Lugar Expedición" required class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_lexpedicion; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres" disabled>
           </div>


        <div class="col-md-4" id="div_4_9">
           <span class="text-orange">•</span><label for="encargado_correo">Correo Electrónico</label>
           <input id="encargado_correo" name="encargado_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]]" type="email" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_correo; }?>" required disabled>
        </div>

           <div class="col-md-4" id="div_4_10">
              <span class="text-orange">•</span><label for="encargado_nivel">Nivel Académico</label>
              <select id="encargado_nivel" name="encargado_nivel" class="form-control validate[required]" required disabled>
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

           <div class="col-md-4" id="div_4_11">
              <span class="text-orange">•</span><label for="encargado_profesion">Profesión</label>
              <input id="encargado_profesion" name="encargado_profesion" placeholder="Ingresar Profesión" class="form-control validate[required]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_profesion; }?>" required disabled>
           </div>
    
          <div class="col-12 col-md-12" id="div_4_12">
              <div class="col">
               <h4><b><span class="text-orange">•</span>TOE - Trabajadores Ocupacionalmente  Expuestos</b></h4>
              </div>
          </div>            
    
          <div class="col-12 col-md-12 table-responsive" id="div_4_13">
			<table class="display nowrap table table-hover">
			   <thead>
				  <tr>
					 <th>ID</th>
					 <th>Número Identificación</th>
					 <th>Nombres y Apellidos </th>
					 <th>Ver Más</th>
				  </tr>
			   </thead>

			<tbody>
			<?php 
			if(isset($rayosxTemporalToe)){
				for($t=0;$t<count($rayosxTemporalToe);$t++){
					?>
					<tr>
						<td><?php echo $rayosxTemporalToe[$t]->id_toe_rayosx;?></td>
						<td><?php echo $rayosxTemporalToe[$t]->toe_ndocumento;?></td>
						<td><?php echo $rayosxTemporalToe[$t]->toe_pnombre;?> <?php echo $rayosxTemporalToe[$t]->toe_snombre;?> <?php echo $rayosxTemporalToe[$t]->toe_papellido;?> <?php echo $rayosxTemporalToe[$t]->toe_sapellido;?></td>
						<td>
							<a class="btn green"  onClick="abrirModal('TOE ID: <?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?>','#modalToe<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?>')">Ver más...</a> 
						</td>
					</tr>
					<div id="modalToe<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?>" class="modal">
					  <p><b>TOE ID:<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?></b></p>
						<ul>							
							<li><b>Primer Nombre: </b><?php echo $rayosxTemporalToe[$t]->toe_pnombre?></li>
							<li><b>Segundo Nombre: </b><?php echo $rayosxTemporalToe[$t]->toe_snombre?></li>
							<li><b>Primer Apellido: </b><?php echo $rayosxTemporalToe[$t]->toe_papellido?></li>
							<li><b>Segundo Apellido: </b><?php echo $rayosxTemporalToe[$t]->toe_sapellido?></li>
							<li><b>Número de identificación: </b><?php echo $rayosxTemporalToe[$t]->toe_ndocumento?></li>
							<li><b>Lugar Expedición: </b><?php echo $rayosxTemporalToe[$t]->toe_lexpedicion?></li>
							<li><b>Correo: </b><?php echo $rayosxTemporalToe[$t]->toe_correo?></li>
							<li><b>Profesión: </b><?php echo $rayosxTemporalToe[$t]->toe_profesion?></li>
							<li><b>Nivel Académico: </b><?php echo $rayosxTemporalToe[$t]->toe_nivel?></li>
							<li><b>Fecha del último entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$t]->toe_ult_entrenamiento?></li>
							<li><b>Fecha del próximo entrenamiento en protección radiológica: </b><?php echo $rayosxTemporalToe[$t]->toe_pro_entrenamiento?></li>
							<li><b>Número del registro profesional de salud: </b><?php echo $rayosxTemporalToe[$t]->toe_registro?></li>
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
		<div class="col-md-12">
		   <span class="text-orange">•</span><label for="extension_entidad">Observaciones Validación</label>
		   <textarea id="observaciones_item3" name="observaciones_item3" placeholder="Observaciones TOE" class="form-control input-md"></textarea>
		</div>		
		</div>
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
		<div class="row block w-100 newsletter ">
		<div class="col-12 col-md-12 text-center ">
			<br><br>
			<h3>
				<table style="width:100%;">
				<tr>
				<td align="left"><b>Talento Humano</b> <i class="fas fa-user-tie"></i></td>
				<td align="right">
				<font color="#3D5DA6"><i id="mindiv5" class="fas fa-angle-up"></i><i id="morediv5" class="fas fa-angle-down"></i></font>
				</td>
				</tr>
				</table>
			</h3>
		</div>  


		<div class="row block w-100 newsletter " id="div_5_1">
		<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
		<input id="id_director_rayosx" name="id_director_rayosx" type="hidden" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->id_director_rayosx;}?>">
		<div class="w-100">
			<div class="subtitle">
				<h3><b>Talento Humano:</b></h3>
			</div>
		<div class="col-md-12">
			<span class="text-orange">•</span><label for="tipo_titulo">La IPS cuenta con el talento humano estipulado en el artículo 6 y 7, numeral 7.1?</label>
			<select id="visita_previa" name="visita_previa_th" class="form-control validate[required]" disabled>
				<option value="">Seleccione...</option>
				<option value="1" <?php echo $opcionSi;?>>SI</option>
				<option value="2" <?php echo $opcionNo;?>>NO</option>
			</select>	
		</div>
		<br><br>
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

			</div>
			<div class="col-md-12">
			   <span class="text-orange">•</span><label for="observaciones_item4">Observaciones Validación</label>
			   <textarea id="observaciones_item4" name="observaciones_item4" placeholder="Observaciones Talento Humano" class="form-control input-md"></textarea>
			</div>
		</div>	
        </div>				
	</div>	
	<br><br>
	<div id="div_objetos" style="<?php echo $visible_objetos?>" class="row block w-100 newsletter ">
		
	  <div class="col-md-12">
			 <h4><b><span class="text-orange">•</span>Equipos u objetos de prueba</b></h4>		
	  
	 <div id="respuesta_4_2" class="col-12 col-md-12 table-responsive">
		<table class="display nowrap table table-hover">
			   <thead>
				  <tr>
					  <th>ID</th>
					  <th>Nombre del equipo</th>
					  <th>Marca del equipo</th>
					  <th>Modelo del equipo</th>
					  <th>Ver Más</th>
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
							<a class="btn green" onClick="abrirModal('Equipo Objeto de prueba ID: <?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>','#modalObj<?php echo $rayosxObjprueba[$i]->id_obj_rayosx?>')">Ver más...</a>
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
			<div class="col-md-12">
			   <span class="text-orange">•</span><label for="observaciones_item4">Observaciones Validación</label>
			   <textarea id="observaciones_item5" name="observaciones_item5" placeholder="Observaciones Equipos u objetos de prueba" class="form-control input-md"></textarea>
			</div>
    
        </div>
		
		<div class="row block w-100 newsletter ">
			<div class="col-12 col-md-12 text-center ">
			<br><br>
				<h3>
					<table style="width:100%;">
					<tr>
					<td align="left"><b>Visualizador Archivos Adjuntos</b> <i class="far fa-file-pdf"></i></td>
					<td align="right"><font color="#3D5DA6"><i id="mindiv6" class="fas fa-angle-up"></i><i id="morediv6" class="fas fa-angle-down"></i></font></td>
					</tr>
					</table>				
				</h3>
            </div>
            
<?php
if((isset($rayosxCategoria->categoria) && $rayosxCategoria->categoria == 1))
{	
    $categoria_form = $rayosxCategoria->categoria;
	$display_form4_1 = "display:block";
	$display_form4_2 = "display:none";
}else if((isset($rayosxCategoria->categoria) && $rayosxCategoria->categoria == 2)){
    $categoria_form = $rayosxCategoria->categoria;
	$display_form4_2 = "display:block";
	$display_form4_1 = "display:none";
}else{
	$categoria_form = 1;
	$display_form4_1 = "display:none";
	$display_form4_2 = "display:none";
}

if($tramites_pendientes->tipo_identificacion != 5){
	$display_cedula = "display:block";
	$display_rut = "display:none";
}else{
	$display_rut = "display:block";
	$display_cedula = "display:none";
}

if($tramite_info->visita_previa && $tramite_info->visita_previa == 2){
	$display_docTalento = "display:none";
}else{
	$display_docTalento = "display:block";
}
        
       /* echo "<pre>";
        print_r($documentosTramite);
        echo "</pre>";*/
        
?>
        



     <div class="col-6 col-md-6 table-responsive" style="<?php echo $display_form4_1;?>">
       <h4><b><span class="text-orange">•</span>Documentos Categoría I</b></h4>
		<div class="col-12 col-md-12 table-responsive">
		   <table class="table table-hover">
			   <thead>
				  <tr>
					 <th>Descripción</th>
					 <th>Cargar Documento</th>
				  </tr>
			   </thead>
			   <tbody>
			   <?php
			   
				   if($display_cedula == 'display:block'){
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pn_doc");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                            <tr>
                                <td>Fotocopia documento de identificación</td>
                                <td>
									<?php
									if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
									{										
									?>
                                    <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
                                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
									<?php
									   }else{
											echo "Sin archivo";
									   }
									?>
                                </td>
                            </tr>
                            <?php
				   }
				   
				   
				   if($display_rut == 'display:block'){
					   
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pj_doc");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                            <tr>
                                <td>Fotocopia del Registro Unico Tributario - RUT</td>
                                <td>
                                    <?php
									if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
									{										
									?>
                                    <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
                                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
									<?php
									   }else{
											echo "Sin archivo";
									   }
									?>
                                </td>
                            </tr>
                            <?php                   
				   }
				   
				   if($display_rut == 'display:block'){
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pj_cyc");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                            <tr>
                                <td>Registro cámara y comercio</td>
                                <td>
                                    <?php
									if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
									{										
									?>
                                    <a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
                                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
									<?php
									   }else{
											echo "Sin archivo";
									   }
									?>
                                </td>
                            </tr>
                            <?php                        
				   }
                   
                   $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_doc_encargado");
                   $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Copia documento identificación del encargado de protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php 
                   $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_encargado");
                   $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Copia del diploma del encargado de protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>    
					<?php
					$resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_blindajes");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_control_calidad");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Informe sobre los resultados del control de calidad</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               	
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_registro_dosimetrico");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php 
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_registro_niveles");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Registro del cumplimiento de los niveles de referencia para diagnóstico</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    
                    <?php 
                    
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_certificado_capacitacion");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Certificado de la capacitación en protección radiológica de cada trabajador ocupacionalmente expuesto reportado en el formulario</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php 
    
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_programa_capacitacion");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Programa de capacitación en protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
    
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_procedimiento_mantenimiento");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Procedimientos de mantenimiento de conformidad a lo establecido por el fabricante</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    
                    <?php 
    
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_programa_tecno");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Programa de Tecno vigilancia</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php 
                   
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_programa_proteccion");
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                   ?>
                   <tr>
                        <td>Programa de protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php     
    
					
					$resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_plano");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Plano general de las instalaciones</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }	
					
				   if($display_docTalento == 'display:block'){
					   
                   
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_soporte_talento");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo 1 del artículo 21</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php 
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_director");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php 
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_director");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico </td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php 
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_pos_profe");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php  
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_profe");
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php  
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_cert_calibracion");
                        
                        if($resultado_archivo){
                            $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php 
                        }
                               
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_declaraciones");
                        
                        if($resultado_archivo){
                            $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);    
                        ?>
                        <tr>
                            <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
                            <td>
                               <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php                  
                        }
				   }
				   
				   ?>
				  
				  
			   </tbody>
			</table>
		</div>        
     </div>

     <div class="col-6 col-md-6 table-responsive" style="<?php echo $display_form4_2;?>">
       <div class="subtitle">
           <h3><b>Documentos Adjuntos:</b></h3>
       </div>
       <h4><b><span class="text-orange">•</span>Documentos Categoría II</b></h4>
        <input id="categoria_docs" name="categoria_docs" type="hidden" value="<?php echo $categoria_form?>">     
		<div class="col-12 col-md-12 table-responsive">		
			<table class="table table-hover">
			   <thead>
				  <tr>
					 <th>Descripción</th>
					 <th>Documento</th>
				  </tr>
			   </thead>
			   <tbody>
				 <?php
				   if($display_cedula == 'display:block'){
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pn_doc");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia documento de identificación</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
				   }
				   
				   
				   if($display_rut == 'display:block'){
                       $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pj_doc");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia del Registro Único Tributario - RUT</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
				   }
				   
				   if($display_rut == 'display:block'){
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "pj_cyc");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Registro cámara y comercio</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
				   }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_doc_oficial");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Copia documento identificación del oficial de protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_oficial");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Copia del diploma del oficial de protección radiológica</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_blindajes");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Descripción de los blindajes estructurales o portátiles y el cálculo del blindaje</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_control_calidad");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Informe sobre los resultados del control de calidad</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_registro_dosimetrico");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos. Para alta complejidad, registros del segundo dosímetro</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
               
                    $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_plano");
                    if($resultado_archivo){
                    $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                    ?>
                    <tr>
                        <td>Plano general de las instalaciones</td>
                        <td>
                            <?php
							if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
							{										
							?>
							<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
							</a>
							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
							   }else{
									echo "Sin archivo";
							   }
							?>
                        </td>
                    </tr>
                    <?php
                    }
					
				   if($display_docTalento == 'display:block'){
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_soporte_talento");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo del articulo 23</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_director");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_director");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_pos_profe");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_profe");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_cert_calibracion");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
                        $resultado_archivo = $this->rx_model->consultar_archivo($tramites_pendientes->id, "fi_declaraciones");
                        if($resultado_archivo){
                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('uploads/rayosx/'.$resultado_archivo->nombre);
                        ?>
                        <tr>
                            <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
                            <td>
                                <?php
								if(count($resultado_archivo) > 0 && $resultado_archivo->nombre != '')
								{										
								?>
								<a href="<?php echo base_url('uploads/rayosx/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
								<?php
								   }else{
										echo "Sin archivo";
								   }
								?>
                            </td>
                        </tr>
                        <?php
                        }
                       
				   }
				   ?>
				  
			   </tbody>
			</table>
		</div>
     </div>
        			
	<div class="col-6 col-md-6 " style="height: 600px;" id="divdatoarchvisor">
		<iframe id="visorPdf" style="height: 100%; width: 100%;" src=""></iframe>
	</div>
	<div class="col-md-12">
	   <span class="text-orange">•</span><label for="observaciones_item4">Observaciones Validación</label>
	   <textarea id="observaciones_item6" name="observaciones_item6" placeholder="Observaciones Documentos adjuntos" class="form-control input-md"></textarea>
	</div>
	</div>
    
<div class="row block right" style="width:100%;">
	<div class="col-12 col-md-12 pl-4">
		<div class="subtitle">
			<h2><b>Resultado de la validaci&oacute;n</b> <i class="fas fa-check-double"></i></h2>
		</div>
	</div>
	
	<div class="col-10 col-md-10 pl-4">
	<select id="resultado_validacion" name="resultado_validacion" class="form-control validate[required]">
		<option value="">Seleccione...</option>
		<?php
		for($i=0;$i<count($resultado_validacion);$i++){
			
			if($tramites_pendientes->id_estado == 4 && ($resultado_validacion[$i]->id_estado == 4 || $resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 7 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";	
			}else if($tramites_pendientes->id_estado == 16 && ($resultado_validacion[$i]->id_estado == 17 || $resultado_validacion[$i]->id_estado == 18 || $resultado_validacion[$i]->id_estado == 20)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";	
			}	
			
			if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 4 && $resultado_validacion[$i]->id_estado == 19){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";					
			}
			
			if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 16 && $resultado_validacion[$i]->id_estado == 19){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";					
			}	

			if($tramites_pendientes->id_estado == 19 && ($resultado_validacion[$i]->id_estado == 17 || $resultado_validacion[$i]->id_estado == 18 || $resultado_validacion[$i]->id_estado == 20)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";	
			}
			
			if($tramites_pendientes->id_estado == 41 && ($resultado_validacion[$i]->id_estado == 17 || $resultado_validacion[$i]->id_estado == 18 || $resultado_validacion[$i]->id_estado == 20)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";	
			}

			if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 41 && $resultado_validacion[$i]->id_estado == 21){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";					
			}

			if($tramites_pendientes->id_estado == 25 && ($resultado_validacion[$i]->id_estado == 26 || $resultado_validacion[$i]->id_estado == 27 || $resultado_validacion[$i]->id_estado == 28)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";	
			}	
		}
		?>
	</select>
	
	<div class="col-12 col-md-12 pl-4">
		
	
		<div id="div_obs_resultado" style="display:none">				
			<div>
				<label><b>Observaciones</b></label>
				<textarea name="observaciones" id="observaciones" class="form-control" style="width:100%;height:80px"></textarea>
			</div>
			
			<div id="div_preliminar" style="display:none">
				
				<?php
				
				if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 41){
					?>
					<table class="table table-striped">
						<h4>Resultado de la visita</h4>
						<tr>
							<td>Acta de la visita</td>
							<td><input id="resultado_visita" name="resultado_visita" type="file" class="archivopdf validate[required]"></td>
						</tr>
						<tr>
							<td>Certificado expedido por una institución de educación superior o por una institución de Educación para el Trabajo y el Desarrollo Humano, en el que se acredite la capacitación en materira de protección radiológica de los trabajadores ocupacionalmente expuestos</td>
							<td><input id="visita_certificado" name="visita_certificado" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Programa de capacitación en protección radiológica</td>
							<td><input id="visita_prote_radio" name="visita_prote_radio" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Registro de los niveles de referencia para diagnóstico, respecto de los procedimientos más comunes</td>
							<td><input id="visita_niveles" name="visita_niveles" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Descripción de los elementos, sistemas y componenetes necesarios en la práctica médica categoria II que se realice</td>
							<td><input id="visita_elementos" name="visita_elementos" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Procedimientos de mantenimiento de los equipos generadores de radicación ionizante, de conformidad con lo establecido por el fabricante</td>
							<td><input id="visita_procedimientos" name="visita_procedimientos" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Documentos suministrado por el instalador del equipo o equipos, que contenga los resultados de las pruebas iniciales de caracterización y puesta en marcha de dicho equipo o equipos</td>
							<td><input id="visita_resultados" name="visita_resultados" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Documento que contenga el programa de vigilancia radiológica</td>
							<td><input id="visita_vigilancia_radio" name="visita_vigilancia_radio" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Documento que contenga el programa institucional de tecnovigilancia</td>
							<td><input id="visita_tecnovigilancia" name="visita_tecnovigilancia" type="file" class="archivopdf"></td>
						</tr>
						<tr>
							<td>Documento que contenga un programa de protección radiológica</td>
							<td><input id="visita_docu_prote" name="visita_docu_prote" type="file" class="archivopdf"></td>
						</tr>
					</table>
					
					<?php
				}
				
				?>
				<br><br>
				<button name="preliminar" id="preliminar" class="btn blue w-100 py-2" type="submit" class="btn btn-primary" role="button" formtarget="_blank">Preliminar</button>
				
			</div>
			<div>
				<br><br>
				<button name="guardar" id="guardar" class="btn green w-100 py-2" type="submit" class="btn btn-primary" role="button" onclick="this.disabled">Guardar</button>
			</div>
		</div>

	</div>
	</div>
	
	<div class="col-2 col-md-2 pl-4" align="center">
		<a id="btn_seguimiento" onClick="abrirModal('Tabla de Seguimiento','#modalSeguimiento')"><img src="<?php echo base_url('assets/imgs/audit.png')?>"><br>Seguimiento Auditoría</a>
		<br><br>
	</div>	
</div>
</fieldset>
</form>

<div id="modalSeguimiento" class="modal">
  	<legend>Tabla de Seguimiento</legend>
	<table width="100%" border="1" id="customers">
		<thead>
			<tr>
				<th width="12%"><b>Fecha Seguimiento</b></th>
				<th width="25%"><b>Usuario</b></th>
				<th width="15%"><b>Estado</b></th>
				<th width="48%"><b>Observación</b></th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(count($tramites_seguimientos)>0){
		for($i=0;$i<count($tramites_seguimientos);$i++){
		?>
		<tr>
			<td style="height:55px;">
				<?php echo date("Y-m-d",strtotime($tramites_seguimientos[$i]->fecha_estado));?>
			</td>
			<td style="height:55px;">
				<?php echo $tramites_seguimientos[$i]->username;?> 
			</td>
			<td style="height:55px;">
				<?php echo $tramites_seguimientos[$i]->descEstado?>
			</td>
			<td style="height:55px;">
				<?php echo $tramites_seguimientos[$i]->observaciones;?>
			</td>
		</tr>
		<?php									
		}
		}
		?>
		</tbody>
	</table>		  
</div>

<script src="<?php echo base_url('assets/js/trumbowyg/dist/trumbowyg.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/trumbowyg/dist/langs/es.min.js')?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/js/trumbowyg/dist/ui/trumbowyg.min.css')?>">

<script type="text/javascript">

	$('#observaciones_item1').trumbowyg({
		lang: 'es'
	});
	
	$('#observaciones_item2').trumbowyg({
		lang: 'es'
	});
	
	$('#observaciones_item3').trumbowyg({
		lang: 'es'
	});
	
	$('#observaciones_item4').trumbowyg({
		lang: 'es'
	});
	
	$('#observaciones_item5').trumbowyg({
		lang: 'es'
	});
	
	$('#observaciones_item6').trumbowyg({
		lang: 'es'
	});
	
	
	$("#mindiv1").click(function () {
		$('#div_1_1').hide();
		$('#div_1_2').hide();
		$('#div_1_3').hide();
		$('#div_1_4').hide();
		$('#div_1_5').hide();
		$('#div_1_6').hide();
		$('#div_1_7').hide();
		$('#div_1_8').hide();
		$('#div_1_9').hide();
		$('#div_1_10').hide();
		$('#div_1_11').hide();
		$('#div_1_12').hide();
		$('#div_1_13').hide();
		$('#div_1_14').hide();
		$('#div_1_15').hide();
		$('#div_1_16').hide();
	});
	
	$("#morediv1").click(function () {
		$('#div_1_1').show();
		$('#div_1_2').show();
		$('#div_1_3').show();
		$('#div_1_4').show();
		$('#div_1_5').show();
		$('#div_1_6').show();
		$('#div_1_7').show();
		$('#div_1_8').show();
		$('#div_1_9').show();
		$('#div_1_10').show();
		$('#div_1_11').show();
		$('#div_1_12').show();
		$('#div_1_13').show();
		$('#div_1_14').show();
		$('#div_1_15').show();
		$('#div_1_16').show();
	});	
	
	$("#mindiv2").click(function () {
		$('#div_2_1').hide();
		$('#div_2_2').hide();
		$('#div_2_3').hide();
		$('#div_2_4').hide();
		$('#div_2_5').hide();
		$('#div_2_6').hide();
		$('#div_2_7').hide();
		$('#div_2_8').hide();
	});
	
	$("#morediv2").click(function () {
		$('#div_2_1').show();
		$('#div_2_2').show();
		$('#div_2_3').show();
		$('#div_2_4').show();
		$('#div_2_5').show();
		$('#div_2_6').show();
		$('#div_2_7').show();
		$('#div_2_8').show();
	});

	$("#mindiv3").click(function () {
		$('#div_3_1').hide();
		$('#div_3_2').hide();
	});
	
	$("#morediv3").click(function () {
		$('#div_3_1').show();
		$('#div_3_2').show();
	});	
	
	$("#mindiv4").click(function () {
		$('#div_4_1').hide();
		$('#div_4_2').hide();
		$('#div_4_3').hide();
		$('#div_4_4').hide();
		$('#div_4_5').hide();
		$('#div_4_6').hide();
		$('#div_4_7').hide();
		$('#div_4_8').hide();
		$('#div_4_9').hide();
		$('#div_4_10').hide();
		$('#div_4_11').hide();
		$('#div_4_12').hide();
		$('#div_4_13').hide();
	});
	
	$("#morediv4").click(function () {
		$('#div_4_1').show();
		$('#div_4_2').show();
		$('#div_4_3').show();
		$('#div_4_4').show();
		$('#div_4_5').show();
		$('#div_4_6').show();
		$('#div_4_7').show();
		$('#div_4_8').show();
		$('#div_4_9').show();
		$('#div_4_10').show();
		$('#div_4_11').show();
		$('#div_4_12').show();
		$('#div_4_13').show();
	});	
	
	$("#mindiv5").click(function () {
		$('#div_5_1').hide();
	});
	
	$("#morediv5").click(function () {
		$('#div_5_1').show();
	});	
	
	$("#btn_seguimiento").click(function () {
		$('#modalseguimiento').modal('show');

	});
	
	$("#resultado_validacion").change(function(){
        if($("#resultado_validacion").val() != ''){
			
			$("#div_obs_resultado").show();
			$("#div_preliminar").show();	
			$("#preliminar").show();			
			
			if($("#resultado_validacion").val() == 8){
				$("#preliminar").hide();
			}
			
        }else{
            $("#div_obs_resultado").hide();
			$("#div_preliminar").hide();
        }
    });
	

</script>
