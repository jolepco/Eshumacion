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
<form class="border border-light p-5" id="formsst_usuario" name="formsst_usuario" action="<?php echo base_url('sst/actualizarTramite')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?php echo $this->session->userdata('tipo_identificacion');?>">
<input type="hidden" name="id_estado" id="id_estado" value="5">
<input type="hidden" name="id_tramite" id="id_tramite" value="<?php echo $id_tramite?>">
<input type="hidden" name="tipo_tramite" id="tipo_tramite" value="<?php echo $tramite_info->tipo_tramite?>">
<div class="text-center">
    <h3 class="text-info"><b>Licencia para prestación de servicios en Seguridad y Salud en el Trabajo</b></h3>
</div>

<div class="row" id="div_info">
    <div class="col-md-12">
        <p>
            Solicitar la expedición, renovación o modificación de la licencia para prestar servicios en Seguridad y Salud en el Trabajo como persona natural o jurídica, pública o privada.
        </p>   
    </div>
    <div class="col-md-12">
        <table class="table">
            <tr>
                <td><b>ID Tramite</b></td>
                <td><?php echo $id_tramite?></td>
            </tr>
            <tr>
                <td><b>Tipo trámite</b></td>
                <td>
                <?php 
                    if($tramite_info->tipo_tramite == 1){
                        echo "Primera Vez";
                    }else if($tramite_info->tipo_tramite == 2){
                        echo "Modificación";
                    }else if($tramite_info->tipo_tramite == 3){
                        echo "Renovación";
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td><b>Estado</b></td>
                <td><?php echo $estado_tramite->descripcion?></td>
            </tr>
            <tr>
                <td><b>Observación<b></td>
                <td><?php echo $estado_tramite->observaciones?></td>
            </tr>
        </table>
    </div>    
</div>
<hr>
<?php
if($tramite_info->tipo_tramite == 2){
?>
<div class="row" id="div_modificacion">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Seleccione Motivo Modificación (*)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Motivo de modificación</label>
                        <select name="motivo_modificacion" id="motivo_modificacion" class="form-control validate[required]">
                        <option value="">Seleccione...</option>
                        <?php
                            if($this->session->userdata('tipo_identificacion') != 5){
                                ?>
                                <option value="1" <?php if($tramite_info->id_motivo_modificacion == 1){echo "selected";}?>>Cambio de nombre y/o apellido del titular de la licencia</option>
                                <option value="2" <?php if($tramite_info->id_motivo_modificacion == 2){echo "selected";}?>>Cambio de número y tipo de identificación</option>
                                <option value="3" <?php if($tramite_info->id_motivo_modificacion == 3){echo "selected";}?>>Cambio en el nivel de formación en seguridad y salud en el trabajo</option>
                                <?php
                            }else{
                                ?>
                                <option value="4" <?php if($tramite_info->id_motivo_modificacion == 4){echo "selected";}?>>Cambio de Nomenclatura</option>
                                <option value="5" <?php if($tramite_info->id_motivo_modificacion == 5){echo "selected";}?>>Cambio de domicilio</option>
                                <option value="6" <?php if($tramite_info->id_motivo_modificacion == 6){echo "selected";}?>>Apertura de campo(s) de acción adicional(es) al(os) otorgado(s) en la licencia SST</option>
                                <option value="7" <?php if($tramite_info->id_motivo_modificacion == 7){echo "selected";}?>>Cierre temporal o definitivo de campos de acción</option>
                                <option value="8" <?php if($tramite_info->id_motivo_modificacion == 8){echo "selected";}?>>Cambio de Representante Legal</option>
                                <option value="9" <?php if($tramite_info->id_motivo_modificacion == 9){echo "selected";}?>>Apertura de sede</option>
                                <?php
                            }
                            ?>                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><font class="text-danger">(*)</font> PDF Licencia Vigente a modificar</label>
                        <input type="file" name="doc_lic_anterior" id="doc_lic_anterior" class="form-control-sm form-control-file archivopdf validate[required]">
                    </div>
                    <?php
                        if($this->session->userdata('tipo_identificacion') == 5){
                            ?>
                            <div class="col-md-4">
                                <label><font class="text-danger">(*)</font> PDF Soporte de la modificación <span class="badge badge-primary" id="alert_modificacion">Ayuda</span></label>
                                <input type="file" name="soporte_modificacion" id="soporte_modificacion" class="form-control-sm form-control-file archivopdf">
                            </div>
                            <?php
                        }
                    ?>                    
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Número de resolución vigente a la cual se le va a realizar la modificación</label>
                        <input type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $tramite_info->num_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Fecha de resolución vigente a la cual se le va a realizar la modificación</label>
                        <input type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" value="<?php echo $tramite_info->fecha_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<?php
}else if($tramite_info->tipo_tramite == 3){
?>
<div class="row" id="div_renovacion">    
    <div class="col-md-12" id="div_dat">
        <div class="card">
            <div class="card-header">
                Datos adicionales renovación
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Departamento</label>
                        <select name="depto_lic_anterior" id="depto_lic_anterior" class="form-control form-control-sm validate[required]">
                            <option value="">Seleccione...</option>
                            <?php
                            for($i=0;$i<count($departamentos_col);$i++){
                                if($departamentos_col[$i]->CodigoDane == 11){    
                                    if($tramite_info->id_depto_renovacion == $departamentos_col[$i]->IdDepartamento)
                                    {
                                        echo "<option value='".$departamentos_col[$i]->IdDepartamento."' selected>".$departamentos_col[$i]->Descripcion."</option>";
                                    }else{
                                        echo "<option value='".$departamentos_col[$i]->IdDepartamento."'>".$departamentos_col[$i]->Descripcion."</option>";
                                    }                                                                    
                                }                                
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Municipio</label>
                        <select name="mpio_lic_anterior" id="mpio_lic_anterior" class="form-control form-control-sm validate[required]">
                        <?php
                        if($tramite_info->id_depto_renovacion != 0){
                            $municipiosDep = $this->sst_model->municipios_col($tramite_info->id_depto_renovacion);
                            for($i=0;$i<count($municipiosDep);$i++){
                                if($tramite_info->id_mpio_renovacion == $municipiosDep[$i]->IdMunicipio){
                                    echo "<option value='".$municipiosDep[$i]->IdMunicipio."' selected>".$municipiosDep[$i]->Descripcion."</option>";
                                }else{
                                    echo "<option value='".$municipiosDep[$i]->IdMunicipio."'>".$municipiosDep[$i]->Descripcion."</option>";
                                }                                        
                            }
                        }                                    
                        ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><font class="text-danger">(*)</font> PDF Licencia Anterior</label>
                        <input type="file" name="doc_lic_anterior" id="doc_lic_anterior" class="form-control-sm form-control-file archivopdf validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Número de resolución de la licencia anterior</label>
                        <input type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $tramite_info->num_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Fecha de resolución de la licencia anterior</label>
                        <input type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" value="<?php echo $tramite_info->fecha_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<?php
}
if($this->session->userdata('tipo_identificacion') == 5){
    ?>
    <div class="row" id="div_pj">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Datos Laborales- Registro Persona Jurídica
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Tipos de servicio a prestar</p>
                        </div>                  
                        <div class="col-md-12">
                            <label>Servicios</label>
                            <textarea name="servicios" id="servicios" class="form-control form-control-sm validate[required]"><?php echo $tramite_registro->servicios?></textarea>
                        </div>                        
                        <div class="col-md-12">
                            <label>Características básicas del servicio:</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control form-control-sm validate[required]"><?php echo $tramite_registro->caracteristicas?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Otros Cuáles?</label>
                            <textarea name="otros" id="otros" class="form-control form-control-sm"><?php echo $tramite_registro->otros?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Dirección de la entidad</label>
                            <input type="text" name="direccion_entidad" id="direccion_entidad" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->direccion_entidad?>"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <a href="<?php echo base_url('assets/docs/formato_recurso_humano.pdf')?>" target="_blank">
                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>"><br>
                                Descarga Formato Personas Vinculadas a prestación del servicio de SST
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo base_url('assets/docs/formato_equipos.pdf')?>" target="_blank">
                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>"><br>
                                Descarga Formato Equipos destinados al Servicio de SST
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Cámara de Comercio Establecimiento</div>
                                <div class="col-md-4"><input type="file" name="doc_cc" id="doc_cc" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_cc != '' || $tramite_registro->doc_cc != 0){
                                            $docu_cc = $this->sst_model->consultar_archivo($tramite_registro->doc_cc);
                                            if($docu_cc){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_cc->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Fotocopia Documento Representante Legal</div>
                                <div class="col-md-4"><input type="file" name="doc_rl" id="doc_rl" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_rl != '' || $tramite_registro->doc_rl != 0){
                                            $docu_rl = $this->sst_model->consultar_archivo($tramite_registro->doc_rl);
                                            if($docu_rl){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_rl->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Formato Diligenciado Personas Vinculadas a la prestación del Servicio de SST</div>
                                <div class="col-md-4"><input type="file" name="doc_formato_personas" id="doc_formato_personas" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_formato_personas != '' || $tramite_registro->doc_formato_personas != 0){
                                            $docu_formatoPer = $this->sst_model->consultar_archivo($tramite_registro->doc_formato_personas);
                                            if($docu_formatoPer){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_formatoPer->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Formato Diligenciado Equipos destinados al Servicio de SST</div>
                                <div class="col-md-4"><input type="file" name="doc_formato_equipos" id="doc_formato_equipos" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_formato_equipos != '' || $tramite_registro->doc_formato_equipos != 0){
                                            $docu_formatoEqu = $this->sst_model->consultar_archivo($tramite_registro->doc_formato_equipos);
                                            if($docu_formatoEqu){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_formatoEqu->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" name="guardar" id="guardar" class="btn btn-sm btn-success ">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
    </div>
    <?php
}else{
    ?>
    <div class="row" id="div_pn">        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Datos Laborales- Registro Persona Natural
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Labora actualmente? </label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="labora_actual1" name="labora_actual" class="custom-control-input validate[required]" value="1" <?php if($tramite_registro->labora == 1){echo "checked";}?>>
                                <label class="custom-control-label" for="labora_actual1">Si</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="labora_actual2" name="labora_actual" class="custom-control-input validate[required]" value="2" <?php if($tramite_registro->labora == 2){echo "checked";}?>>
                                <label class="custom-control-label" for="labora_actual2">No</label>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if($tramite_registro->labora == 1){
                        $display_empresa = "block";
                    }else{
                        $display_empresa = "none";
                    }
                    ?>
                    <div id="div_empresa" style="display:<?php echo $display_empresa?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre de la empresa</label>
                                <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->nombre_empresa?>">
                            </div>
                            <div class="col-md-6">
                                <label>Dirección de la empresa</label>
                                <input type="text" name="dir_empresa" id="dir_empresa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->dir_empresa?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Departamento Empresa</label>
                                <select name="depto_empresa" id="depto_empresa" class="form-control form-control-sm validate[required]">
                                    <option value="">Seleccione...</option>
                                    <?php
                                    for($i=0;$i<count($departamentos_col);$i++){
                                        if($tramite_registro->depto_empresa == $departamentos_col[$i]->IdDepartamento){
                                            echo "<option value='".$departamentos_col[$i]->IdDepartamento."' selected>".$departamentos_col[$i]->Descripcion."</option>";
                                        }else{
                                            echo "<option value='".$departamentos_col[$i]->IdDepartamento."'>".$departamentos_col[$i]->Descripcion."</option>";
                                        }                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Municipio Empresa</label>
                                <select name="mpio_empresa" id="mpio_empresa" class="form-control form-control-sm validate[required]">
                                <option value="">Seleccione...</option>
                                    <?php
                                    if($tramite_registro->depto_empresa != 0){
                                        $municipiosDep = $this->sst_model->municipios_col($tramite_registro->depto_empresa);
                                        for($i=0;$i<count($municipiosDep);$i++){
                                            if($tramite_registro->mpio_empresa == $municipiosDep[$i]->IdMunicipio){
                                                echo "<option value='".$municipiosDep[$i]->IdMunicipio."' selected>".$municipiosDep[$i]->Descripcion."</option>";
                                            }else{
                                                echo "<option value='".$municipiosDep[$i]->IdMunicipio."'>".$municipiosDep[$i]->Descripcion."</option>";
                                            }                                        
                                        }
                                    }                                    
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Teléfono Empresa</label>
                                <input type="text" name="tel_empresa" id="tel_empresa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->tel_empresa?>">
                            </div>
                            <div class="col-md-3">
                                <label>Fax Empresa</label>
                                <input type="text" name="fax_empresa" id="fax_empresa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->fax_empresa?>">
                            </div>
                        </div>
                    </div>                    
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Tipos de servicio a prestar</p>
                        </div>                        
                        <div class="col-md-12">
                            <label>Servicios</label>
                            <textarea name="servicios" id="servicios" class="form-control form-control-sm validate[required]"><?php echo $tramite_registro->servicios?></textarea>
                        </div>                        
                        <div class="col-md-12">
                            <label>Características básicas del servicio:</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control form-control-sm validate[required]"><?php echo $tramite_registro->caracteristicas?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Otros Cuales?</label>
                            <textarea name="otros" id="otros" class="form-control form-control-sm"><?php echo $tramite_registro->otros?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Documentos adjuntos</p>
                        </div>  
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Apreciado Ciudadano! En caso de contar con dos o mas títulos universitarios favor separarlos por coma en orden cronológico, 
                                asi mismo en el campo donde se deben adjuntar los soportes, favor subir un solo PDF con los títulos registrados según sea pregrado o postgrado. 
                            </div>
                        </div>                      
                        <div class="col-md-4">
                            <label>Tipo de programa</label>
                            <select name="tipo_programa" id="tipo_programa" class="form-control form-control-sm validate[required]">
                                <option value="1" <?php if($tramite_registro->tipo_programa == 1){ echo "selected";}?>>Profesional Universitario con Postgrado</option>
                                <option value="2" <?php if($tramite_registro->tipo_programa == 2){ echo "selected";}?>>Profesional Universitario</option>
                                <option value="3" <?php if($tramite_registro->tipo_programa == 3){ echo "selected";}?>>Tecnología en seguridad y salud en el trabajo</option>
                                <option value="4" <?php if($tramite_registro->tipo_programa == 4){ echo "selected";}?>>Técnico profesional en seguridad y salud en el trabajo</option>                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo Titulo</label>
                            <select name="tipo_titulo" id="tipo_titulo" class="form-control form-control-sm validate[required]">
                                <option value="1" <?php if($tramite_registro->tipo_titulo == 1){ echo "selected";}?>>Nacional</option>
                                <option value="2" <?php if($tramite_registro->tipo_titulo == 2){ echo "selected";}?>>Extranjero</option>                           
                            </select>
                        </div>
                        <div class="col-md-4" id="div_tipo_profesional">
                            <label>Tipo Profesional</label>
                            <select name="tipo_profesional" id="tipo_profesional" class="form-control form-control-sm validate[required]">
                                <option value="">Seleccione...</option>
                                <option value="1" <?php if($tramite_registro->tipo_profesional == 1){ echo "selected";}?>>Médico</option>
                                <option value="2" <?php if($tramite_registro->tipo_profesional == 2){ echo "selected";}?>>Profesional Psicología</option>                           
                                <option value="3" <?php if($tramite_registro->tipo_profesional == 3){ echo "selected";}?>>Ingeniería</option>                           
                                <option value="4" <?php if($tramite_registro->tipo_profesional == 4){ echo "selected";}?>>Otros</option>                           
                            </select>
                        </div>
                        <?php
                        if($tramite_registro->tipo_profesional == 4){
                            $displayOtro = "flex";
                        }else{
                            $displayOtro = "none";
                        }
                        ?>
                        <div class="col-md-4" id="div_otro_tipo_profesional" style="display:<?php echo $displayOtro?>">
                            <label>Otro Tipo Profesional</label>
                            <input type="text" name="otro_tipo_profesional" id="otro_tipo_profesional" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->otro_tipo_profesional?>">
                        </div>
                        
                    </div>                    
                    <div class="row">                                              
                        <div class="col-md-6">
                            <label>Ingrese el título del programa (Como aparece en el diploma) (*)</label>
                            <input type="text" name="titulo_programa" id="titulo_programa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->titulo_programa?>">
                        </div>
                        <?php 
                        if($tramite_registro->tipo_programa == 1){ 
                            $displayInputPostgrado = "flex";
                        }else{
                            $displayInputPostgrado = "none";
                        }

                        if($tramite_registro->tipo_titulo == 2){ 
                            $displayInputConvalidacion = "flex";
                        }else{
                            $displayInputConvalidacion = "none";
                        }

                        if($tramite_registro->tipo_programa == 1){ 
                            $displayTextoPregrado = "Pregrado";
                        }else if($tramite_registro->tipo_programa == 2){ 
                            $displayTextoPregrado = "Pregrado";
                        }else if($tramite_registro->tipo_programa == 3){ 
                            $displayTextoPregrado = "Tecnólogo";
                        }else if($tramite_registro->tipo_programa == 4){ 
                            $displayTextoPregrado = "Técnico Profesional";
                        }
                        ?>
                        <div class="col-md-6" id="div_titulo_postgrado" style="display:<?php echo $displayInputPostgrado?>">
                            <label>Ingrese el título de postgrado (Como aparece en el diploma) (*)</label>
                            <input type="text" name="titulo_postgrado" id="titulo_postgrado" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->titulo_postgrado?>">
                        </div>
                    </div>                    
                    <hr>
                    <div class="row" id="div_mensaje_postgrado" style="display:none">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                            Apreciado Ciudadano! El registro calificado y el pensum que debe adjuntar es del programa de especialización. 
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div_mensaje_docs">
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                Apreciado Ciudadano! Si requiere cambiar alguno de los documentos, solo adjunte el archivo PDF en el documento asociado. 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> Documento de identidad</div>
                                <div class="col-md-4"><input type="file" name="doc_docu_iden" id="doc_docu_iden" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_docu_iden != '' || $tramite_registro->doc_docu_iden != 0){
                                            $docu_iden = $this->sst_model->consultar_archivo($tramite_registro->doc_docu_iden);
                                            if($docu_iden){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_iden->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_pregrado">
                                <div class="col-md-4"><font class="text-danger">(*)</font> <font id="div_text_pregrado">PDF Título <?php echo $displayTextoPregrado?> </font></div>
                                <div class="col-md-4"><input type="file" name="doc_pregrado" id="doc_pregrado" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_pregrado != '' || $tramite_registro->doc_pregrado != 0){
                                            $docu_pre = $this->sst_model->consultar_archivo($tramite_registro->doc_pregrado);
                                            if($docu_pre){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_pre->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_postgrado" style="display:<?php echo $displayInputPostgrado?>">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Título Postgrado</div>
                                <div class="col-md-4"><input type="file" name="doc_postgrado" id="doc_postgrado" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_postgrado != '' || $tramite_registro->doc_postgrado != 0){
                                            $docu_pos = $this->sst_model->consultar_archivo($tramite_registro->doc_postgrado);
                                            if($docu_pos){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_pos->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_convalidacion" style="display:<?php echo $displayInputConvalidacion?>">
                                <div class="col-md-4"><font class="text-danger">(*)</font> Convalidación</div>
                                <div class="col-md-4"><input type="file" name="doc_convalidacion" id="doc_convalidacion" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_convalidacion != '' || $tramite_registro->doc_convalidacion != 0){
                                            $docu_conv = $this->sst_model->consultar_archivo($tramite_registro->doc_convalidacion);
                                            if($docu_conv){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_conv->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> PDF Certificado de notas o asignaturas Aprobadas</div>
                                <div class="col-md-4"><input type="file" name="doc_pensum" id="doc_pensum" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_pensum != '' || $tramite_registro->doc_pensum != 0){
                                            $docu_pens = $this->sst_model->consultar_archivo($tramite_registro->doc_pensum);
                                            if($docu_pens){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_pens->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-4"><font class="text-danger">(*)</font> Soporte que demuestre que el programa es de Educación Formal de Carácter Superior</div>
                                <div class="col-md-4"><input type="file" name="doc_soporte" id="doc_soporte" class="form-control-sm form-control-file archivopdf"></div>
                                <div class="col-md-4">
                                    <?php
                                        if($tramite_registro->doc_soporte != '' || $tramite_registro->doc_soporte != 0){
                                            $docu_soporte = $this->sst_model->consultar_archivo($tramite_registro->doc_soporte);
                                            if($docu_soporte){
                                                ?>
                                                <a href="<?php echo base_url('sst/abrir_pdf/'.$docu_soporte->nombre)?>" target="_blank">
                                                <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                                Documento Actual</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" name="guardar" id="guardar" class="btn btn-sm btn-success ">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
        
<?php
}
?>
</form>
