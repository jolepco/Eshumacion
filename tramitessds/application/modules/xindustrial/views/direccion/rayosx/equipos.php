<?php
    $verbtnCate = "block";
?>
<div class="row">
    <div class="col-md-12 mb-4" id="div_3_1">
        <label for="categoria" class="font-weight-bold">Categoría</label>
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

    <div id="div_3_2" class="col-md-12 table-responsive">
        <label for="categoria" class="font-weight-bold">Equipos registrados</label>
        <table class="table table-striped">
        <thead class="bg-primary text-white">
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
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>">
                        Ver más...
                    </button>
                </td>
            </tr>
            <div class="modal fade" id="ex<?php echo $rayosxEquipo[$i]->id_equipo_rayosx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante:</b>Radiología odontológica</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria1 == 2){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante:</b>Equipo de RX</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria1 == 3){
                                ?>
                                <li><b>Otros: </b><?php echo $rayosxEquipo[$i]->otro_equipo?></li>
                                <?php
                            }
                        }

                        if($rayosxEquipo[$i]->categoria2 != 0 || $rayosxEquipo[$i]->categoria2 != NULL){
                            if($rayosxEquipo[$i]->categoria2 == 1){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Pallets y paquetes</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 2){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Escáner  de carga</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 3){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología convencional móvil</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 4){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Inspectometro de Rayos X</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 5){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de difracción de Rayos X</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 6){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología convencional</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 7){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo radiología veterinaria</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 8){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Acelerador lineal de uso veterinario</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 9){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Acelerador lineal</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 10){
                                ?>
                                <li><b>Equipos generadores de radicaci&oacute;n ionizante: </b>Equipo de fluorescencia con tubo de Rayos RX</li>
                                <?php
                            }else if($rayosxEquipo[$i]->categoria2 == 11){
                                ?>
                                <li><b>Otros: </b><?php echo $rayosxEquipo[$i]->otro_equipo?></li>
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
                    <li><b>Corriente. Max del tubo RX [mA]: </b><?php echo $rayosxEquipo[$i]->contiene_tubo_rx?></li>
                    <li><b>Energía de fotones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_fotones?></li>
                    <li><b>Energía de electrones [MeV]: </b><?php echo $rayosxEquipo[$i]->energia_electrones?></li>
                    <li><b>Carga de trabajo [mA.min/semana]: </b><?php echo $rayosxEquipo[$i]->carga_trabajo?></li>
                    <li><b>Ubicación del equipo de la instalación: </b><?php echo $rayosxEquipo[$i]->ubicacion_equipo?></li>
                    <li><b>Número permiso comecialización: </b><?php echo $rayosxEquipo[$i]->numero_permiso?></li>
                    <li><b>Año de fabricación del equipo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion?></li>
                    <li><b>Año de fabricación del tubo: </b><?php echo $rayosxEquipo[$i]->anio_fabricacion_tubo?></li>

                    <?php

                        if($rayosxEquipo[$i]->fi_blindajes != ''){
                            $fi_blindajes = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_blindajes);

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
                            $fi_control_calidad = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_control_calidad);

                            if($fi_control_calidad){
                                ?>
                                <li><b>Programa de Protección Radiólogica: </b><a href="<?php echo base_url('uploads/xindustrial/'.$fi_control_calidad->nombre);?>" target="_blank">Ver archivo</a></li>
                                <?php
                            }else{
                                ?>
                                <li><b>Programa de Protección Radiólogica:</b> Sin archivo disponible</li>
                                <?php
                            }
                        }else{
                            ?>
                            <li><b>Programa de Protección Radiólogica:</b> Sin archivo disponible</li>
                            <?php
                        }

                        if($rayosxEquipo[$i]->fi_plano != ''){
                            $fi_plano = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_plano);

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

                        if($rayosxEquipo[$i]->fi_manual != ''){
                            $fi_manual = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_manual);

                            if($fi_manual){
                                ?>
                                <li><b>Manual de usuario: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_manual->nombre);?>" target="_blank">Ver archivo</a></li>
                                <?php
                            }else{
                                ?>
                                <li><b>Manual de usuario: </b> Sin archivo disponible</li>
                                <?php
                            }
                        }else{
                            ?>
                            <li><b>Manual de usuario: </b> Sin archivo disponible</li>
                            <?php
                        }

                        if($rayosxEquipo[$i]->fi_ficha != ''){
                            $fi_ficha = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_ficha);

                            if($fi_ficha){
                                ?>
                                <li><b>Ficha Técnica: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_ficha->nombre);?>" target="_blank">Ver archivo</a></li>
                                <?php
                            }else{
                                ?>
                                <li><b>Ficha Técnica: </b> Sin archivo disponible</li>
                                <?php
                            }
                        }else{
                            ?>
                            <li><b>Ficha Técnica: </b> Sin archivo disponible</li>
                            <?php
                        }

                        if($rayosxEquipo[$i]->fi_estudio != ''){
                            $fi_estudio = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_estudio);

                            if($fi_estudio){
                                ?>
                                <li><b>Estudio Ambiental de la instalación: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_estudio->nombre);?>" target="_blank">Ver archivo</a></li>
                                <?php
                            }else{
                                ?>
                                <li><b>Estudio Ambiental de la instalación: </b> Sin archivo disponible</li>
                                <?php
                            }
                        }else{
                            ?>
                            <li><b>Estudio Ambiental de la instalación: </b> Sin archivo disponible</li>
                            <?php
                        }

                        if($rayosxEquipo[$i]->fi_pruebas_caracterizacion != ''){
                            $fi_pruebas_caracterizacion = $this->xindustrial_model->consultar_archivo_equipo($rayosxEquipo[$i]->fi_pruebas_caracterizacion);

                            if($fi_pruebas_caracterizacion){
                                ?>
                                <li><b>Programa de vigilancia pos mercado de los equipos generadores de radiación ionizante: </b><a href="<?php echo base_url('uploads/rayosx/'.$fi_pruebas_caracterizacion->nombre);?>" target="_blank">Ver archivo</a></li>
                                <?php
                            }else{
                                ?>
                                <li><b>Programa de vigilancia pos mercado de los equipos generadores de radiación ionizante:  </b> Sin archivo disponible</li>
                                <?php
                            }
                        }else{
                            ?>
                            <li><b>Programa de vigilancia pos mercado de los equipos generadores de radiación ionizante: </b> Sin archivo disponible</li>
                            <?php
                        }
                    ?>
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
        ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-12">
        <label for="extension_entidad" class="font-weight-bold">Observaciones Validación</label>
        <textarea id="observaciones_item2" name="observaciones_item2" placeholder="Observaciones de equipos" class="form-control input-md"><?php if(isset($observacionesTramite->observaciones2)){echo $observacionesTramite->observaciones2;}?></textarea>
    </div>
</div>
