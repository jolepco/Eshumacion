<div id="paso1" class="row-center shadow-lg p-3 mb-5 bg-white rounded ">
	<form class="text-center border border-light p-5" id="formSeccion1" name="form_tramite" action="<?php echo base_url('xindustrial/editarDireccionRX')?>" method="post">
	<input id="id_tramite" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
	<input id="id_tramite" name="id_direccion_tramite" type="hidden" value="<?php if(isset($rayosxDireccion)&& $rayosxDireccion->id_direccion_rayosx != ''){ echo $rayosxDireccion->id_direccion_rayosx;} ?>">
		<div class="subtitle text-left">
            <h3><b>Localizacíón Entidad:</b></h3>
        </div>
        <div class="row">
            <div class="col">
               <span class="text-orange">•</span><label for="depto_entidad">Departamento(*)</label>               
               <select id="depto_entidad" name="depto_entidad" class="form-control validate[required]" required>
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
				$municipios = $this->xindustrial_model->municipios_col($rayosxDireccion->depto_entidad);
			}
			
			?>
            <div class="col">
               <span class="text-orange">•</span><label for="mpio_entidad">Municipio(*)</label>
               <select id="mpio_entidad" name="mpio_entidad" class="form-control validate[required]" required>
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
            </div>
        </div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<span class="text-orange">•</span><label for="tipo_tramite">Dirección de la Instalación(*)</label>
					<input id="dire_entidad" name="dire_entidad" class="form-control input-md validate[required, minSize[4], maxSize[200]]" type="text" required placeholder="Ingresar la Dirección Entidad" value="<?php if(isset($rayosxDireccion->dire_entidad)){echo $rayosxDireccion->dire_entidad;}?>"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="200" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 200 carácteres">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<span class="text-orange">•</span><label for="dire_entidad">Sede de la Instalación(*)</label>
				<input id="sede_entidad" name="sede_entidad" class="form-control input-md validate[required, minSize[4], maxSize[200]]" type="text" required placeholder="Ingresar el Nombre Distintivo de la sede que será sujeta a inspección" value="<?php if(isset($rayosxDireccion->sede_entidad)){echo $rayosxDireccion->sede_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="200"  title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 200 carácteres">
			</div>
		</div>

         <div class="row">
            <div class="col">
               <span class="text-orange">•</span><label for="email_entidad">Correo Electrónico(*)</label>
               <input id="email_entidad" name="email_entidad" class="form-control validate[required, custom[email]] input-md" type="email" required placeholder="Ingresar Correo Electrónico"  value="<?php if(isset($rayosxDireccion->email_entidad)){echo $rayosxDireccion->email_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="80"  title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 80 carácteres">
            </div>

            <div class="col">
               <span class="text-orange">•</span><label for="celular_entidad">Número celular(*)</label>
               <input id="celular_entidad" name="celular_entidad" placeholder="Ingresar Número Celular de contacto en sede de la Instalación" class="form-control input-md validate[required,custom[number], minSize[10], maxSize[10]]" value="<?php if(isset($rayosxDireccion->celular_entidad)){echo $rayosxDireccion->celular_entidad;}?>"   minlength="10" maxlength="10"  title="Ingresar un Tamaño mínimo: 10 carácteres a un Tamaño máximo: 10 carácteres" onKeyPress="if(this.value.length==10) return false;">
            </div>
         </div>
         <div class="row">
            <div class="col">
               <span class="text-orange">•</span><label for="telefono_entidad">Número telefónico fijo</label>
               <input id="telefono_entidad" name="telefono_entidad" placeholder="Ingresar Número telefónico de contacto en sede de la Instalación" class="form-control input-md validate[required, custom[number], minSize[7], maxSize[10]]" value="<?php if(isset($rayosxDireccion->telefono_entidad)){echo $rayosxDireccion->telefono_entidad;}?>"   minlength="7" maxlength="10"  title="Ingresar un Tamaño mínimo: 7 carácteres a un Tamaño máximo: 10 carácteres" onKeyPress="if(this.value.length==10) return false;">
            </div>

            <div class="col">
               <span class="text-orange">•</span><label for="extension_entidad">Extensión</label>
               <input id="extension_entidad" name="extension_entidad" placeholder="Ingresar Extensión telefónica de contacto en sede" class="form-control input-md validate[custom[number], minSize[3], maxSize[5]]" value="<?php if(isset($rayosxDireccion->extension_entidad)){echo $rayosxDireccion->extension_entidad;}?>"   minlength="3" maxlength="5"  title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 5 carácteres" onKeyPress="if(this.value.length==5) return false;">
            </div>
         </div>

          <div id="btnRegistrarGuardarEntidad" class="col-md-12 pt-200">
            <p align="center">
               <br/>
               <!-- Primer Collapsible - Localizacion Entidad -->
               <button type="submit" class="btn btn-warning">
                  Guardar y Continuar
               </button>
            </p>
          </div>
	</form>  
</div>