<div class="row">
    <div class="col-12 col-md-12" id="div_4_1">
        <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
        <input id="id_encargado_rayosx" name="id_encargado_rayosx" type="hidden" value="<?php if(isset($rayosxOficialToe)&& $rayosxOficialToe->id_encargado_rayosx != ''){ echo $rayosxOficialToe->id_encargado_rayosx;} ?>">
        <p class="font-weight-bold">Oficial de protección radiológica/Encargado de protección Radiológica</p>
    </div>

        <div class="col-md-4" id="div_4_2">
            <label for="encargado_pnombre" class="font-weight-bold">Primer Nombre</label>
            <input id="encargado_pnombre" name="encargado_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_pnombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
        </div>

        <div class="col-md-4" id="div_4_3">
            <label for="encargado_snombre" class="font-weight-bold">Segundo Nombre</label>
            <input id="encargado_snombre" name="encargado_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_snombre ;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
        </div>

        <div class="col-md-4" id="div_4_4">
            <label for="encargado_papellido" class="font-weight-bold">Primer Apellido</label>
            <input id="encargado_papellido" name="encargado_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]" required type="text" value="<?php if(isset($rayosxOficialToe)) {echo $rayosxOficialToe->encargado_papellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled>
        </div>
        <div class="col-md-4" id="div_4_5">
            <label for="encargado_sapellido" class="font-weight-bold">Segundo Apellido</label>
            <input id="encargado_sapellido" name="encargado_sapellido" placeholder="Ingresar Segundo Apellido" class="form-control input-md validate[minSize[3], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_sapellido; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres" disabled> 
        </div>

        <div class="col-md-4" id="div_4_6">
            <label for="encargado_tdocumento" class="font-weight-bold">Tipo Documento</label>
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
            <label for="encargado_ndocumento" class="font-weight-bold">Número Documento</label>
            <input id="encargado_ndocumento" name="encargado_ndocumento" placeholder="Ingresar Número Documento" class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" required value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_ndocumento; }?>" onKeyPress="if(this.value.length==15) return false;" disabled> 
        </div>

        <div class="col-md-4" id="div_4_8">
            <label for="encargado_lexpedicion" class="font-weight-bold">Lugar Expedición</label>
            <input id="encargado_lexpedicion" name="encargado_lexpedicion" placeholder="Ingresar Lugar Expedición" required class="form-control input-md validate[required, minSize[4], maxSize[30]]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_lexpedicion; }?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres" disabled>
        </div>

        <div class="col-md-4" id="div_4_9">
            <label for="encargado_correo" class="font-weight-bold">Correo Electrónico</label>
            <input id="encargado_correo" name="encargado_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]]" type="email" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_correo; }?>" required disabled>
        </div>

        <div class="col-md-4" id="div_4_10">
            <label for="encargado_nivel" class="font-weight-bold">Nivel Académico</label>
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
            <label for="encargado_profesion" class="font-weight-bold">Profesión</label>
            <input id="encargado_profesion" name="encargado_profesion" placeholder="Ingresar Profesión" class="form-control validate[required]" type="text" value="<?php if(isset($rayosxOficialToe)){echo $rayosxOficialToe->encargado_profesion; }?>" required disabled>
        </div>

        <div class="col-12 col-md-12" id="div_4_12">
            <p class="font-weight-bold">TOE - Trabajadores Ocupacionalmente  Expuestos</p>
        </div>            

        <div class="col-12 col-md-12 table-responsive" id="div_4_13">
        <table class="display nowrap table table-hover">
            <thead class="bg-primary text-white">
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
                        <a class="btn btn-warning" data-toggle="modal" data-target="#modalToe<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?>">Ver más...</a> 
                    </td>
                </tr>
                <div class="modal fade" id="modalToe<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>TOE ID:<?php echo $rayosxTemporalToe[$t]->id_toe_rayosx?></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
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
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
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
        <label for="extension_entidad" class="font-weight-bold">Observaciones Validación</label>
        <textarea id="observaciones_item3" name="observaciones_item3" placeholder="Observaciones TOE" class="form-control input-md"><?php if(isset($observacionesTramite->observaciones3)){echo $observacionesTramite->observaciones3;}?></textarea>
    </div>		
</div>