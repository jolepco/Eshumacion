<div class="row">
    <div class="col-md-6" id="div_2_1">
        <label for="depto_entidad" class="font-weight-bold">Departamento(*)</label>
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
        $municipios = $this->xindustrial_model->municipios_col($rayosxDireccion->depto_entidad);
    }

    ?>
    <div class="col-md-6" id="div_2_2">
        <label for="mpio_entidad" class="font-weight-bold">Municipio(*)</label>
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
    </div>


    <div class="col-md-6" id="div_2_3">
        <label for="tipo_tramite" class="font-weight-bold">Direcci??n de la Instalaci??n(*)</label>
        <input id="dire_entidad" name="dire_entidad" class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" required disabled placeholder="Ingresar la Direcci??n Entidad" value="<?php if(isset($rayosxDireccion->dire_entidad)){echo $rayosxDireccion->dire_entidad;}?>"  onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tama??o m??nimo: 4 car??cteres a un Tama??o m??ximo: 30 car??cteres">
    </div>

    <div class="col-md-6" id="div_2_4">
        <label for="dire_entidad" class="font-weight-bold">Sede de la Instalaci??n(*)</label>
        <input id="sede_entidad" name="sede_entidad" class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" required disabled placeholder="Ingresar el Nombre Distintivo de la sede que ser?? sujeta a inspecci??n" value="<?php if(isset($rayosxDireccion->sede_entidad)){echo $rayosxDireccion->sede_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="30"  title="Ingresar un Tama??o m??nimo: 4 car??cteres a un Tama??o m??ximo: 30 car??cteres">
    </div>
    <div class="col-md-6" id="div_2_5">
        <label for="email_entidad" class="font-weight-bold">Correo Electr??nico(*)</label>
        <input id="email_entidad" name="email_entidad" class="form-control validate[required, custom[email]] input-md" type="email" required disabled placeholder="Ingresar Correo Electr??nico"  value="<?php if(isset($rayosxDireccion->email_entidad)){echo $rayosxDireccion->email_entidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"  minlength="4" maxlength="80"  title="Ingresar un Tama??o m??nimo: 4 car??cteres a un Tama??o m??ximo: 80 car??cteres">
    </div>

    <div class="col-md-6" id="div_2_6">
        <label for="celular_entidad" class="font-weight-bold">N??mero celular(*)</label>
        <input id="celular_entidad" name="celular_entidad" placeholder="Ingresar N??mero Celular de contacto en sede de la Instalaci??n" class="form-control input-md validate[required,custom[number], minSize[10], maxSize[10]]" value="<?php if(isset($rayosxDireccion->celular_entidad)){echo $rayosxDireccion->celular_entidad;}?>"   minlength="10" maxlength="10"  title="Ingresar un Tama??o m??nimo: 10 car??cteres a un Tama??o m??ximo: 10 car??cteres" onKeyPress="if(this.value.length==10) return false;" disabled>
    </div>
    <div class="col-md-6" id="div_2_7">
        <label for="telefono_entidad" class="font-weight-bold">N??mero telef??nico fijo</label>
        <input id="telefono_entidad" name="telefono_entidad" placeholder="Ingresar N??mero telef??nico de contacto en sede de la Instalaci??n" class="form-control input-md validate[required, custom[number], minSize[7], maxSize[10]]" value="<?php if(isset($rayosxDireccion->telefono_entidad)){echo $rayosxDireccion->telefono_entidad;}?>"   minlength="7" maxlength="10"  title="Ingresar un Tama??o m??nimo: 7 car??cteres a un Tama??o m??ximo: 10 car??cteres" onKeyPress="if(this.value.length==10) return false;" disabled>
    </div>

    <div class="col-md-6" id="div_2_8">
        <label for="extension_entidad" class="font-weight-bold">Extensi??n</label>
        <input id="extension_entidad" name="extension_entidad" placeholder="Ingresar Extensi??n telef??nica de contacto en sede" class="form-control input-md validate[custom[number], minSize[3], maxSize[5]]" value="<?php if(isset($rayosxDireccion->extension_entidad)){echo $rayosxDireccion->extension_entidad;}?>"   minlength="3" maxlength="5"  title="Ingresar un Tama??o m??nimo: 3 car??cteres a un Tama??o m??ximo: 5 car??cteres" onKeyPress="if(this.value.length==5) return false;" disabled>
    </div>
</div>
