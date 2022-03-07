<div class="row">
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

    <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
    <input id="id_director_rayosx" name="id_director_rayosx" type="hidden" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->id_director_rayosx;}?>">

    <div class="col-md-12">
        <label for="tipo_titulo">La IPS cuenta con el talento humano estipulado en el artículo 6 y 7, numeral 7.1?</label>
        <select id="visita_previa" name="visita_previa_th" class="form-control validate[required]" disabled>
            <option value="">Seleccione...</option>
            <option value="1" <?php echo $opcionSi;?>>SI</option>
            <option value="2" <?php echo $opcionNo;?>>NO</option>
        </select>
    </div>
</div>
    <div id="div_talentohumano" style="<?php echo $visible_director?>">
        <p class="font-weight-bold"></p><h4><b>Director Técnico</b></h4>

        <div class="row">
            <div class="col-md-3">
               <label for="talento_pnombre" class="font-weight-bold">Primer Nombre</label>
               <input id="talento_pnombre" name="talento_pnombre" placeholder="Ingresar Primer Nombre" class="form-control input-md validate[required, minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_pnombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-3">
               <label for="talento_snombre" class="font-weight-bold">Segundo Nombre</label>
               <input id="talento_snombre" name="talento_snombre" placeholder="Ingresar Segundo Nombre" class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_snombre;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-3">
               <label for="talento_papellido" class="font-weight-bold">Primer Apellido</label>
               <input id="talento_papellido" name="talento_papellido" placeholder="Ingresar Primer Apellido" class="form-control input-md validate[required, minSize[3], maxSize[30]]" type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_papellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-3">
               <label for="talento_sapellido" class="font-weight-bold">Segundo Apellido</label>
               <input id="talento_sapellido" name="talento_sapellido" placeholder="Ingresar Segundo Apellido"  class="form-control input-md validate[minSize[3], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_sapellido;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="3" maxlength="30" title="Ingresar un Tamaño mínimo: 3 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
               <label for="talento_tdocumento" class="font-weight-bold">Tipo Documento</label>
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
               <label for="talento_ndocumento" class="font-weight-bold">Número Documento</label>
               <input id="talento_ndocumento" name="talento_ndocumento" placeholder="Ingresar Número Documento"  class="form-control input-md validate[custom[number], required, minSize[4], maxSize[15]]" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_ndocumento;}?>" onKeyPress="if(this.value.length==15) return false;">
            </div>

            <div class="col-md-4">
               <label for="talento_lexpedicion" class="font-weight-bold">Lugar Expedición</label>
               <input id="talento_lexpedicion" name="talento_lexpedicion" placeholder="Ingresar Lugar Expedición"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_lexpedicion;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
            <div class="col-md-12">
                <span class="text-orange">•</span><label for="talento_correo">Correo Electrónico</label>
                <input id="talento_correo" name="talento_correo" placeholder="Ingresar Correo Electrónico" class="form-control validate[required, custom[email]] input-md" type="email"  value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_correo;}?>" >
            </div>
        </div>


         <div class="row">
            <p class="font-weight-bold">Idoneidad Profesional</p>
            <div class="col-md-4">
               <label for="talento_titulo" class="font-weight-bold">Título de pregrado obtenido </label>
               <input id="talento_titulo" name="talento_titulo" placeholder="Título de pregrado obtenido"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_titulo;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-4">
               <label for="talento_universidad" class="font-weight-bold">Universidad que otorgó el título de pregrado</label>
               <input id="talento_universidad" name="talento_universidad" placeholder="Universidad que otorgó el titulo de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"   value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_universidad;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-4">
               <label for="talento_libro" class="font-weight-bold">Libro del diploma de pregrado</label>
               <input id="talento_libro" name="talento_libro" placeholder="Libro del diploma de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[15]]" type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_libro;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
            </div>
         </div>

         <div class="row">
            <div class="col-md-4">
               <span class="text-orange">•</span><label for="talento_registro" class="font-weight-bold">Registro del diploma de pregrado</label>
               <input id="talento_registro" name="talento_registro" placeholder="Registro del diploma de pregrado"  class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_registro;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
            </div>
            <div class="col-md-4">
               <span class="text-orange">•</span><label for="talento_fecha_diploma" class="font-weight-bold">Fecha diploma de pregrado</label>
               <input id="talento_fecha_diploma" name="talento_fecha_diploma" placeholder="Fecha diploma de pregrado" class="form-control input-md validate[required]"  max="<?php echo date('Y-m-d')?>"  type="date" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_diploma;}?>">
            </div>
            <div class="col-md-4">
               <span class="text-orange">•</span><label for="talento_resolucion" class="font-weight-bold">Resolución convalidación título pregrado</label>
               <input id="talento_resolucion" name="talento_resolucion" placeholder="Resolución convalidación título pregrado"  class="form-control input-md validate[minSize[4], maxSize[30]]"   type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_resolucion;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>
         </div>

         <div class="row">
            <div class="col-md-4">
               <label for="talento_fecha_convalida" class="font-weight-bold">Fecha convalidación título de pregrado</label>
               <input id="talento_fecha_convalida" name="talento_fecha_convalida" placeholder="Fecha convalidación título de pregrado" class="form-control input-md" type="date"  max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_convalida;}?>">
            </div>
            <div class="col-md-4">
               <label for="talento_nivel" class="font-weight-bold">Nivel Académico último posgrado</label>
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
               <label for="talento_titulo_pos" class="font-weight-bold">Título de posgrado obtenido</label>
               <input id="talento_titulo_pos" name="talento_titulo_pos" placeholder="Título de posgrado obtenido"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_titulo_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

         </div>

         <div class="row">

            <div class="col-md-4">
               <label for="talento_universidad_pos" class="font-weight-bold">Universidad que otorgó el título de posgrado</label>
               <input id="talento_universidad_pos" name="talento_universidad_pos" placeholder="Universidad que otorgó el título de posgrado"  class="form-control input-md validate[required, minSize[4], maxSize[30]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_universidad_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="30" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 30 carácteres">
            </div>

            <div class="col-md-4">
               <label for="talento_libro_pos">Libro del diploma de posgrado</label>
               <input id="talento_libro_pos" name="talento_libro_pos" placeholder="Libro del diploma de posgrado"class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_libro_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
            </div>

            <div class="col-md-4">
               <label for="talento_registro_pos" class="font-weight-bold">Registro del diploma de posgrado</label>
               <input id="talento_registro_pos" name="talento_registro_pos" placeholder="Registro del diploma de posgrado" class="form-control input-md validate[required, minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_registro_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
            </div>
         </div>

         <div class="row">

            <div class="col-md-4">
               <label for="talento_fecha_diploma_pos" class="font-weight-bold">Fecha diploma de posgrado</label>
               <input id="talento_fecha_diploma_pos" name="talento_fecha_diploma_pos" placeholder="Fecha diploma de posgrado" class="form-control  validate[required]" type="date" max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_diploma_pos;}?>" >
            </div>

            <div class="col-md-4">
               <label for="talento_resolucion" class="font-weight-bold">Resolución convalidación título posgrado</label>
               <input id="talento_resolucion_pos" name="talento_resolucion_pos" placeholder="Resolución convalidación título posgrado" class="form-control input-md validate[minSize[4], maxSize[15]]"  type="text" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_resolucion_pos;}?>" onkeyup="javascript:this.value=this.value.toUpperCase();"   minlength="4" maxlength="15" title="Ingresar un Tamaño mínimo: 4 carácteres a un Tamaño máximo: 15 carácteres">
            </div>

            <div class="col-md-4">
               <label for="talento_fecha_convalida_pos" class="font-weight-bold">Fecha convalidación título de posgrado</label>
               <input id="talento_fecha_convalida_pos" name="talento_fecha_convalida_pos" placeholder="Fecha convalidación título de posgrado" class="form-control input-md" type="date" max="<?php echo date('Y-m-d')?>" value="<?php if(isset($rayosxTalento)){echo $rayosxTalento->talento_fecha_convalida_pos;}?>">
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                <label for="observaciones_item4" class="font-weight-bold">Observaciones Validación</label>
                <textarea id="observaciones_item4" name="observaciones_item4" placeholder="Observaciones Talento Humano" class="form-control input-md"><?php if(isset($observacionesTramite->observaciones4)){echo $observacionesTramite->observaciones4;}?></textarea>
            </div>
         </div>


<div class="row" id="div_objetos" style="<?php echo $visible_objetos?>">

  <div class="col-md-12">
         <h4><b><span class="text-orange">•</span>Equipos u objetos de prueba</b></h4>

 <div id="respuesta_4_2" class="col-md-12 table-responsive">
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
           <textarea id="observaciones_item5" name="observaciones_item5" placeholder="Observaciones Equipos u objetos de prueba" class="form-control input-md"><?php if(isset($observacionesTramite->observaciones5)){echo $observacionesTramite->observaciones5;}?></textarea>
        </div>

    </div>
</div>
