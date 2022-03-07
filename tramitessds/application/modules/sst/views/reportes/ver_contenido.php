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

if(count($total_sedes) == 0){
    $total_campos_accion = 1;
}else{
    $total_campos_accion = count($total_sedes);
}
?>

<form class="form-horizontal" id="form_tramite" name="form_tramite" action="<?php echo base_url('sst/validacion/guardarEstado/'.$tramite_info->id_tramite)?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_persona" value="<?php echo $tramite_info->id_persona?>">
<input type="hidden" name="id_tramite" value="<?php echo $tramite_info->id_tramite?>">
<input type="hidden" name="total_campos_accion" id="total_campos_accion" value="<?php echo $total_campos_accion?>">

<div class="row">
    <div class="col-md-9">
        <div class="d-flex justify-content-between">
            <b>Trámite ID:</b>
            <b><?php echo $tramite_info->id_tramite?></b>
        </div>
        <div class="d-flex justify-content-between">
            <b>Estado Trámite:</b>
            <b><?php echo $tramite_info->descripcion?></b>
        </div>
        <div class="d-flex justify-content-between">
            <b>Fecha Trámite:</b>
            <b><?php echo $tramite_info->fecha_creacion?></b>
        </div>
        <div class="d-flex justify-content-between">
        <?php
            if($tramite_info->tipo_tramite == 1){
                echo '<b>Tipo de tramite: Primera vez</b>';                
            }else if($tramite_info->tipo_tramite == 2){
                echo '<b>Tipo de tramite: Modificación</b>';               
            }else if($tramite_info->tipo_tramite == 3){
                echo '<b>Tipo de tramite: Renovación</b>';                
            }
        ?>            
        </div>
        <?php
        
        if($tramite_info->tipo_tramite == 2){
        ?>
        <div class="justify-content-between">
            <b>Motivo modificación:</b>
            <select name="id_motivo_modificacion" id="id_motivo_modificacion" class="form-control form-control-sm validate[required]" disabled>
                <option value="">Seleccione...</option>
                <option value="1" <?php if($tramite_info->id_motivo_modificacion == 1){echo "selected";}?>>Cambio de nombre y/o apellido del titular de la licencia</option>
                <option value="2" <?php if($tramite_info->id_motivo_modificacion == 2){echo "selected";}?>>Cambio de número y tipo de identificación</option>
                <option value="3" <?php if($tramite_info->id_motivo_modificacion == 3){echo "selected";}?>>Cambio en el nivel de formación en seguridad y salud en el trabajo</option>                        
                <option value="4" <?php if($tramite_info->id_motivo_modificacion == 4){echo "selected";}?>>Cambio de Nomenclatura</option>
                <option value="5" <?php if($tramite_info->id_motivo_modificacion == 5){echo "selected";}?>>Cambio de domicilio</option>
                <option value="6" <?php if($tramite_info->id_motivo_modificacion == 6){echo "selected";}?>>Apertura de campo(s) de acción adicional(es) al(os) otorgado(s) en la licencia SST</option>
                <option value="7" <?php if($tramite_info->id_motivo_modificacion == 7){echo "selected";}?>>Cierre temporal o definitivo de campos de acción</option>
                <option value="8" <?php if($tramite_info->id_motivo_modificacion == 8){echo "selected";}?>>Cambio de Representante Legal</option>
                <option value="9" <?php if($tramite_info->id_motivo_modificacion == 9){echo "selected";}?>>Apertura de sede</option>                                           
                <option value="10" <?php if($tramite_info->id_motivo_modificacion == 10){echo "selected";}?>>Otro</option>                                           
            </select>
        </div>
        <?php         
        if($tramite_info->id_motivo_modificacion == 10){
            $display_otro = 'block';
        }else{
            $display_otro = 'none';
        }
        ?>
        <div class="justify-content-between" id="div_modificacion_otro" style="display:<?php echo $display_otro?>">
            <label for=""><b>Otro tipo de modificación:</b></label>
            <input type="text" id="otro_modificacion" name="otro_modificacion" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_info->otro_modificacion?>" readonly>
        </div>
        <?php
        }
        ?>
        <div class="subtitle">                           
            <?php
            if($tramite_info->tipo_tramite == 3){
                
                if($tramite_info->id_depto_renovacion != ''){
                    ?>
                    <b>Renovación - Departamento: </b>
                    <?php
                $depto = $this->sst_model->consulta_departamento($tramite_info->id_depto_renovacion);

                echo $depto->Descripcion;
                }

                if($tramite_info->id_mpio_renovacion != ''){
                ?>                     
                <b>Renovación - Municipio: </b>
                    <?php

                    $mpio = $this->sst_model->consulta_municipio($tramite_info->id_mpio_renovacion);

                    echo $mpio->Descripcion;                 
                }  
            }
        ?>
        </div>
    </div>
    <div class="col-md-3">
            <br><br>
        <?php
            if(count($tramites_proceso_usuario) > 0){
                ?>
                    <a type="button" class="btn btn-primary text-white"data-toggle="modal" data-target="#otrosTramitesModal">
                        Trámites del usuario <span class="badge badge-light"><?php echo count($tramites_proceso_usuario)?></span>
                    </a>
                <?php
            }
        ?>            
    </div>
</div>
<hr>

<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-dpersonales-tab" data-toggle="pill" href="#v-pills-dpersonales" role="tab" aria-controls="v-pills-dpersonales" aria-selected="true">Datos Personales</a>
      <?php
      if($tramite_info->tipo_identificacion != 5){
      ?>
        <a class="nav-link" id="v-pills-dlaborales-tab" data-toggle="pill" href="#v-pills-dlaborales" role="tab" aria-controls="v-pills-dlaborales" aria-selected="false">Datos Laborales</a>
        <?php
      }
        ?>
      <a class="nav-link" id="v-pills-tiposervicio-tab" data-toggle="pill" href="#v-pills-tiposervicio" role="tab" aria-controls="v-pills-tiposervicio" aria-selected="false">Tipos de servicio a prestar</a>
      <a class="nav-link" id="v-pills-documentos-tab" data-toggle="pill" href="#v-pills-documentos" role="tab" aria-controls="v-pills-documentos" aria-selected="false">Documentos Adjuntos</a>
      <a class="nav-link" id="v-pills-campos-tab" data-toggle="pill" href="#v-pills-campos" role="tab" aria-controls="v-pills-campos" aria-selected="false">Campos de Acción</a>
      <a class="nav-link" id="v-pills-resultado-tab" data-toggle="pill" href="#v-pills-resultado" role="tab" aria-controls="v-pills-resultado" aria-selected="false">Seguimiento</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-dpersonales" role="tabpanel" aria-labelledby="v-pills-dpersonales-tab">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Datos Personales
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 pl-4" id="div_1_1">
                        <div class="paragraph">
                            <label for=""><b>Tipo Identificaci&oacute;n:</b></label>
                            <select id="tipo_identificacion" name="tipo_identificacion" class="form-control validate[required]" readonly >
                                <option value="">Seleccione...</option>
                                <?php
                                for($i=0;$i<count($tipo_identificacion);$i++){
                                    
                                    if($tramite_info->tipo_identificacion == $tipo_identificacion[$i]->IdTipoIdentificacion){
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
                            <input id="nume_documento" name="nume_documento" placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramite_info->nume_identificacion?>" readonly style="width:100%;">                    
                        </div>
                    </div>
                    <?php
                        if($tramite_info->tipo_identificacion == 5){
                            ?>
                            <div class="col-12 col-md-6 pl-4" id="div_1_13">
                                <div class="paragraph">
                                    <label for=""><b>Razón Social:</b></label>
                                    <input id="nombre_rs" name="nombre_rs" placeholder="Razón Social" class="form-control validate[required, maxSize[250]]" type="text" value="<?php echo $tramite_info->nombre_rs?>" readonly>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-12 col-md-6 pl-4" id="div_1_3">
                                <div class="paragraph">
                                    <label for=""><b>Primer nombre:</b></label>
                                    <input id="p_nombre" name="p_nombre" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramite_info->p_nombre?>" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pl-4" id="div_1_4">
                                <div class="paragraph">
                                    <label for=""><b>Segundo nombre:</b></label>
                                    <input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramite_info->s_nombre?>" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pl-4" id="div_1_5">
                                <div class="paragraph">
                                    <label for=""><b>Primer apellido:</b></label>
                                    <input id="p_apellido" name="p_apellido" placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramite_info->p_apellido?>" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pl-4" id="div_1_6">
                                <div class="paragraph">
                                    <label for=""><b>Segundo apellido:</b></label>
                                    <input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramite_info->s_apellido?>" readonly>
                                </div>
                            </div>
                            <?php
                        }			
                    ?>			
                    <div class="col-12 col-md-6 pl-4" id="div_1_7">
                        <div class="paragraph">
                            <label for=""><b>Teléfono celular:</b></label>
                            <input id="telefono_celular" name="telefono_celular" placeholder="Teléfono celular" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramite_info->telefono_celular?>" readonly>
                        </div>
                    </div>				
                    <div class="col-12 col-md-6 pl-4" id="div_1_8">
                        <div class="paragraph">
                            <label for=""><b>Teléfono fijo:</b></label>
                            <input id="telefono_fijo" name="telefono_fijo" placeholder="Teléfono fijo" class="form-control input-md validate[required, maxSize[10], custom[number]]" type="text" value="<?php echo $tramite_info->telefono_fijo?>" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 pl-4" id="div_1_9">
                        <div class="paragraph">
                            <label for=""><b>Correo electr&oacute;nico:</b></label>
                            <input id="email" name="email" placeholder="Correo eletrónico " class="form-control input-md validate[required, custom[email]]" required="" type="text" value="<?php echo $tramite_info->email?>" readonly>
                        </div>
                    </div>
                    <?php
                    if($tramite_info->tipo_identificacion != 5)
                    {
                        ?>
                    <div class="col-12 col-md-6 pl-4">
                        <div class="paragraph">
                            <label for=""><b>Dirección:</b></label>
                            <input id="direccion" name="direccion" placeholder="Dirección" class="form-control input-md validate[required]" required="" type="text" value="<?php echo $tramite_info->dire_resi?>" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 pl-4">
                        <div class="paragraph">
                            <label for=""><b>Departamento Residencia:</b></label>
                            <?php
                            $depto_resi = $this->sst_model->consulta_departamento($tramite_info->depa_resi);
                            ?>
                            <input id="depto_resi" name="depto_resi" placeholder="Departamento Residencia " class="form-control input-md validate[required]" required="" type="text" value="<?php echo $depto_resi->Descripcion?>" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 pl-4">
                        <div class="paragraph">
                            <label for=""><b>Municipio Residencia:</b></label>
                            <?php
                            $municipio_resi = $this->sst_model->consulta_municipio($tramite_info->ciudad_resi);
                            ?>
                            <input id="muni_resi" name="muni_resi" placeholder="Municipio Residencia " class="form-control input-md validate[required]" required="" type="text" value="<?php echo $municipio_resi->Descripcion?>" readonly>
                        </div>
                    </div>
                    <?php
                    }
                    if($tramite_info->tipo_identificacion == 5)
                    {
                        ?>
                        <div class="col-12 col-md-6 pl-4" id="div_1_1">
                            <div class="paragraph">
                                <label for=""><b>Tipo Identificaci&oacute;n representante legal:</b></label>
                                <select id="tipo_iden_rl" name="tipo_iden_rl" class="form-control validate[required] disabled">
                                    <option value="">Seleccione...</option>
                                    <?php
                                    for($i=0;$i<count($tipo_identificacion);$i++){
                                        
                                        if($tramite_info->tipo_iden_rl == $tipo_identificacion[$i]->IdTipoIdentificacion){
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
                                <input id="nume_iden_rl" name="nume_iden_rl" placeholder="Número de documento de identidad" class="form-control input-md validate[required, maxSize[11], custom[number]]" required="" type="text" value="<?php echo $tramite_info->nume_iden_rl?>" style="width:100%;" readonly>                    
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pl-4" id="div_1_3">
                            <div class="paragraph">
                                <label for=""><b>Primer nombre representante legal:</b></label>
                                <input id="p_nombre" name="p_nombre" placeholder="Primer Nombre" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramite_info->p_nombre?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pl-4" id="div_1_4">
                            <div class="paragraph">
                                <label for=""><b>Segundo nombre representante legal:</b></label>
                                <input id="s_nombre" name="s_nombre" placeholder="Segundo Nombre" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramite_info->s_nombre?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pl-4" id="div_1_5">
                            <div class="paragraph">
                                <label for=""><b>Primer apellido representante legal:</b></label>
                                <input id="p_apellido" name="p_apellido" placeholder="Primer apellido" class="form-control validate[required, maxSize[80]]" type="text" value="<?php echo $tramite_info->p_apellido?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pl-4" id="div_1_6">
                            <div class="paragraph">
                                <label for=""><b>Segundo apellido representante legal:</b></label>
                                <input id="s_apellido" name="s_apellido" placeholder="Segundo apellido" class="form-control validate[maxSize[80]]" type="text" value="<?php echo $tramite_info->s_apellido?>" readonly>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-dlaborales" role="tabpanel" aria-labelledby="v-pills-dlaborales-tab">
      <?php

        if($tramite_info->tipo_identificacion != 5){
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Datos Laborales- Registro Persona Natural
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Labora actualmente? </label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="labora_actual1" name="labora_actual" class="custom-control-input validate[required]" value="1" <?php if($tramite_registro->labora == 1){echo "checked";}?> readonly="readonly" onclick="javascript: return false;">
                                        <label class="custom-control-label" for="labora_actual1">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="labora_actual2" name="labora_actual" class="custom-control-input validate[required]" value="2" <?php if($tramite_registro->labora == 2){echo "checked";}?> readonly="readonly" onclick="javascript: return false;">
                                        <label class="custom-control-label" for="labora_actual2">No</label>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            if($tramite_registro->labora == 1){
                                $visualiza = "block";
                            }else{
                                $visualiza = "none";
                            }
                            
                            ?>
                            <div id="div_empresa" style="display:<?php echo $visualiza?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre de la empresa</label>
                                        <input type="text" name="nombre_empresa" id="nombre_empresa" value="<?php echo $tramite_registro->nombre_empresa;?>" readonly class="form-control form-control-sm validate[required]">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Dirección de la empresa</label>
                                        <input type="text" name="dir_empresa" id="dir_empresa" value="<?php echo $tramite_registro->dir_empresa;?>" readonly class="form-control form-control-sm validate[required]">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Departamento Empresa</label>
                                        <select name="depto_empresa" id="depto_empresa" class="form-control form-control-sm validate[required]"  readonly>
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for($i=0;$i<count($departamentos_col);$i++){
                                                if($departamentos_col[$i]->IdDepartamento == $tramite_registro->depto_empresa){
                                                    echo "<option value='".$departamentos_col[$i]->IdDepartamento."' selected>".$departamentos_col[$i]->Descripcion."</option>";
                                                }else{
                                                    echo "<option value='".$departamentos_col[$i]->IdDepartamento."'>".$departamentos_col[$i]->Descripcion."</option>";
                                                }                                            
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php 
                                        if($tramite_registro->depto_empresa){
                                            $municipios = $this->sst_model->municipios_col($tramite_registro->depto_empresa);
                                        }else{
                                            $municipios = NULL;
                                        }                                        
                                    ?>
                                    <div class="col-md-3">
                                        <label>Municipio Empresa</label>
                                        <select name="mpio_empresa" id="mpio_empresa" class="form-control form-control-sm validate[required]"  readonly>
                                            <option value="">Seleccione...</option>
                                            <?php
                                            if(is_array($municipios)){
                                                for($i=0;$i<count($municipios);$i++){
                                                    if($municipios[$i]->IdMunicipio == $tramite_registro->mpio_empresa){
                                                        echo "<option value='".$municipios[$i]->IdMunicipio."' selected>".$municipios[$i]->Descripcion."</option>";
                                                    }else{
                                                        echo "<option value='".$municipios[$i]->IdMunicipio."'>".$municipios[$i]->Descripcion."</option>";
                                                    }                                            
                                                }
                                            }                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Teléfono Empresa</label>
                                        <input type="text" name="tel_empresa" id="tel_empresa" value="<?php echo $tramite_registro->tel_empresa;?>" readonly  class="form-control form-control-sm validate[required]">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fax Empresa</label>
                                        <input type="text" name="fax_empresa" id="fax_empresa" value="<?php echo $tramite_registro->fax_empresa;?>" readonly class="form-control form-control-sm validate[required]">
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php
            }
            ?>
      </div>
      <div class="tab-pane fade" id="v-pills-tiposervicio" role="tabpanel" aria-labelledby="v-pills-tiposervicio-tab">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Tipos de servicio a prestar
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="l_servicios">Servicios</label>
                            <textarea name="servicios" id="servicios" class="form-control" readonly><?php echo $tramite_registro->servicios?></textarea>
                        </div>                        
                        <div class="col-md-12">
                            <label for="l_caracteristica">Caracteristicas básicas del servicio:</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control" readonly><?php echo $tramite_registro->caracteristicas?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="l_area">Otros</label>
                            <textarea name="otros" id="otros" class="form-control" readonly><?php echo $tramite_registro->otros?></textarea>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab">
      <div class="card">
                <div class="card-header bg-primary text-white">
                    Documentos Adjuntos
                </div>
                <div class="card-body">
                    <?php 
                    if($tramite_info->tipo_identificacion != 5){                        
                    ?>                                        
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tipo de programa</label>
                            <select name="tipo_programa" id="tipo_programa" class="form-control form-control-sm validate[required]" disabled>
                                <option value="1" <?php if($tramite_registro->tipo_programa == 1){echo "selected";}?>>Profesional Universitario con Postgrado</option>
                                <option value="2" <?php if($tramite_registro->tipo_programa == 2){echo "selected";}?>>Profesional Universitario</option>
                                <option value="3" <?php if($tramite_registro->tipo_programa == 3){echo "selected";}?>>Tecnología en seguridad y salud en el trabajo</option>
                                <option value="4" <?php if($tramite_registro->tipo_programa == 4){echo "selected";}?>>Técnico profesional en seguridad y salud en el trabajo</option>                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo Titulo</label>
                            <select name="tipo_titulo" id="tipo_titulo" class="form-control form-control-sm validate[required]" disabled>
                                <option value="1" <?php if($tramite_registro->tipo_titulo == 1){echo "selected";}?>>Nacional</option>
                                <option value="2" <?php if($tramite_registro->tipo_titulo == 2){echo "selected";}?>>Extranjero</option>                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo Profesional</label>
                            <select name="tipo_profesional" id="tipo_profesional" class="form-control form-control-sm validate[required]" disabled>                                
                                <option value="1" <?php if($tramite_registro->tipo_profesional == 1){echo "selected";}?>>Médico</option>
                                <option value="2" <?php if($tramite_registro->tipo_profesional == 2){echo "selected";}?>>Profesional Psicología</option>                           
                                <option value="3" <?php if($tramite_registro->tipo_profesional == 3){echo "selected";}?>>Ingeniería</option>                           
                                <option value="4" <?php if($tramite_registro->tipo_profesional == 4){echo "selected";}?>>Otros</option>                          
                            </select>
                        </div> 
                        <?php                        
                        if($tramite_registro->tipo_profesional == 4){
                            ?>
                            <div class="col-md-4" id="div_otro_tipo_profesional">
                                <label>Otro Tipo Profesional</label>
                                <input type="text" name="otro_tipo_profesional" id="otro_tipo_profesional" value="<?php echo $tramite_registro->tipo_profesional;?>" class="form-control form-control-sm validate[required]" readonly>
                            </div>
                            <?php
                        }                        
                        ?>
                        <div class="col">
                            <label>Título del programa (Como aparece en el diploma) (*)</label>
                            <input type="text" name="titulo_programa" id="titulo_programa" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->titulo_programa?>" readonly>
                        </div>                   
                    </div> 
                    <?php
                        if($tramite_registro->titulo_postgrado != ''){
                            ?>
                            <div class="row">
                                <div class="col">
                                    <label>Título del programa de postgrado (Como aparece en el diploma) (*)</label>
                                    <input type="text" name="titulo_postgrado" id="titulo_postgrado" class="form-control form-control-sm validate[required]" value="<?php echo $tramite_registro->titulo_postgrado?>" readonly>
                                </div>  
                            </div>
                            <?php
                        }
                        ?>    
                    <?php 
                    }else{
                        if($tramite_registro->direccion_entidad != ''){
                            $dir_entidad = $tramite_registro->direccion_entidad;
                        }else{
                            $dir_entidad = $tramite_registro->dir_empresa;
                        }
                        ?>
                        <div class="row">
                            <div class="col">
                                <label>Dirección de la entidad</label>
                                <input type="text" name="direccion_entidad" id="direccion_entidad" class="form-control form-control-sm validate[required]" value="<?php echo $dir_entidad?>" readonly>
                            </div>  
                        </div>
                        <?php
                    }

                    
                    if($tramite_info->tipo_tramite == 2 || $tramite_info->tipo_tramite == 3){
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label><font class="text-danger">(*)</font> Número de resolución objeto de modificación o renovación</label>
                                <input type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $tramite_info->num_resolucion_anterior?>" class="form-control form-control-sm validate[required]" readonly>
                            </div>
                            <div class="col-md-6">
                                <label><font class="text-danger">(*)</font> Fecha de resolución objeto de modificación o renovación</label>
                                <input type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" value="<?php echo $tramite_info->fecha_resolucion_anterior?>" class="form-control form-control-sm validate[required]" readonly>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><font class="text-danger">(*)</font> Número de resolución Artículo 3</label>
                                <input type="text" name="num_resolucion_articulo" id="num_resolucion_articulo" value="<?php echo $tramite_info->num_resolucion_articulo?>" class="form-control form-control-sm validate[required]" readonly>
                            </div>
                            <div class="col-md-6">
                                <label><font class="text-danger">(*)</font> Fecha de resolución Artículo 3</label>
                                <input type="date" name="fecha_resolucion_articulo" id="fecha_resolucion_articulo" value="<?php echo $tramite_info->fecha_resolucion_articulo?>" class="form-control form-control-sm validate[required]" readonly>
                            </div> 
                        </div>
                        <?php
                    }

                    ?>
                    <hr>                                 
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                
                                    if($tramite_registro->doc_docu_iden != ''){
                                        
                                            $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_docu_iden);
                                            $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                            ?>
                                                <tr>
                                                    <td>Fotocopia documento de identificación</td>
                                                    <td>
                                                        <?php
                                                        if($resultado_archivo->nombre != '')
                                                        {										
                                                        ?>
                                                        <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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

                                    if($tramite_registro->tipo_programa == 4 && $tramite_registro->doc_pregrado != ''){
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_pregrado);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Título Técnico</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    
                                    if($tramite_registro->tipo_programa == 3 && $tramite_registro->doc_pregrado != ''){
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_pregrado);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Título Tecnología</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                                                        
                                    if(($tramite_registro->tipo_programa == 1 || $tramite_registro->tipo_programa == 2) && $tramite_registro->doc_pregrado != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_pregrado);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Título Pregrado</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_postgrado != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_postgrado);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Título Postgrado</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_convalidacion != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_convalidacion);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Convalidación</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_pensum != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_pensum);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Certificado de notas o asignaturas Aprobadas</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_soporte != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_soporte);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if($tramite_info->tipo_identificacion != 5){
                                                        echo "Soporte que demuestre que el programa es de Educación Formal de Carácter Superior";
                                                    }else{
                                                        echo "Soporte de las personas naturales vinculadas a la prestación del servicio emitidos por otros entes territoriales";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_cc != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_cc);                                    
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Camara de Comercio Establecimiento</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_rl != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_rl);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Fotocopia Documento Representante Legal</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_formato_personas != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_formato_personas);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Formato Diligenciado Personas Vinculadas a la prestación del Servicio de SST</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    if($tramite_registro->doc_formato_equipos != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_registro->doc_formato_equipos);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>Formato Diligenciado Equipos destinados al Servicio de SST</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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

                                    if($tramite_info->id_licencia_ant != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_info->id_licencia_ant);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>PDF Licencia Anterior</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    
                                    if($tramite_info->pdf_acta != ''){
                                        
                                        $resultado_archivo = $this->sst_model->consultar_archivo($tramite_info->pdf_acta);
                                        $visorFilePdf=base_url('assets/pdfjs/web/viewer.html')."?file=".base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre);
                                        ?>
                                            <tr>
                                                <td>PDF Acta Visita</td>
                                                <td>
                                                    <?php
                                                    if($resultado_archivo->nombre != '')
                                                    {										
                                                    ?>
                                                    <a href="<?php echo base_url('sst/reportes/abrir_pdf/'.$resultado_archivo->nombre)?>" target="_blank">
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
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 col-md-6 " style="height: 600px;" id="divdatoarchvisor">
                            <iframe id="visorPdf" style="height: 100%; width: 100%;" src=""></iframe>
                        </div>
                        
                    </div>
                    <hr>                    
                </div>
            </div>
      </div>
      <div class="tab-pane fade" id="v-pills-campos" role="tabpanel" aria-labelledby="v-pills-campos-tab">
        <div class="card">
            <div class="card-header bg-primary text-white">
                    Campos de acción
            </div>
            <div class="card-body">
                <p>Para seleccionar más de un campo de acción, por favor mantenga presionada la tecla Ctrl y seleccione los campos que desea agregar</p>
                <?php
                if($tramite_info->tipo_identificacion != 5){
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="mainTableNatural">
                                <tbody>
                                    <?php
                                    if(count($total_sedes) > 0){

                                        for($ts=0;$ts<count($total_sedes);$ts++){

                                            $campos_tramite_sede = $this->sst_model->sst_campos_tramite_sede($tramite_info->id_tramite, $total_sedes[$ts]->contador);
                                            $campos_por_perfil = $this->sst_model->campos_por_perfil($total_sedes[$ts]->id_perfil);
                                        ?>
                                        <tr>                                            
                                            <td width="40%"> 
                                                <label>Perfiles:</label>
                                                <select name="perfiles-<?php echo $total_sedes[$ts]->contador?>" id="perfiles-<?php echo $total_sedes[$ts]->contador?>" class="form-control form-control-sm validate[required]" onchange="cargarCampos(this.id)" value="<?php $total_sedes[$ts]->id_perfil?>" disabled>
                                                    <option value=''>Seleccione...</option>
                                                    <?php
                                                    for($i=0;$i<count($perfiles_natural);$i++){
                                                        if($perfiles_natural[$i]->id_perfil == $total_sedes[$ts]->id_perfil){
                                                            echo "<option value='".$perfiles_natural[$i]->id_perfil."' selected>".$perfiles_natural[$i]->desc_perfil."</option>";
                                                        }else{
                                                            echo "<option value='".$perfiles_natural[$i]->id_perfil."'>".$perfiles_natural[$i]->desc_perfil."</option>";
                                                        }                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </td> 
                                            <td width="40%"> 
                                                <label>Campos de acción:</label>
                                                <select name="areas-<?php echo $total_sedes[$ts]->contador?>[]" id="areas-<?php echo $total_sedes[$ts]->contador?>" class="form-control form-control-sm validate[required] multipleSelect" multiple="multiple" disabled>
                                                <?php
                                                    $campos_seleccionados = array();
                                                    for($cts=0;$cts<count($campos_tramite_sede);$cts++){
                                                        $campos_seleccionados[] = $campos_tramite_sede[$cts]->id_campo;
                                                    }
                                                    for($cp=0;$cp<count($campos_por_perfil);$cp++){

                                                            if(in_array($campos_por_perfil[$cp]->id_campo, $campos_seleccionados)){
                                                                echo "<option value='".$campos_por_perfil[$cp]->id_campo."' selected>".$campos_por_perfil[$cp]->desc_campo."</option>";
                                                            }else{
                                                                echo "<option value='".$campos_por_perfil[$cp]->id_campo."'>".$campos_por_perfil[$cp]->desc_campo."</option>";
                                                            }

                                                        
                                                        
                                                    }
                                                ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php
                                        } 
                                    }else{
                                        ?>
                                        <tr>                                                                                
                                            <td width="40%"> 
                                                <label>Perfiles:</label>
                                                <select name="perfiles-1" id="perfiles-1" class="form-control form-control-sm validate[required]" onchange="cargarCampos(this.id)" disabled>
                                                    <option value=''>Seleccione...</option>
                                                    <?php
                                                    for($i=0;$i<count($perfiles_natural);$i++){
                                                        echo "<option value='".$perfiles_natural[$i]->id_perfil."'>".$perfiles_natural[$i]->desc_perfil."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>                                            
                                            <td width="40%"> 
                                                <label>Campos de acción:</label>
                                                <select name="areas-1[]" id="areas-1" class="form-control form-control-sm validate[required] multipleSelect" multiple="multiple" disabled>
                                                    
                                                </select>
                                            </td>                                            
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>                             
                        </div>
                        <!--<div class="col-md-12">
                            <label>Perfiles en los que se encuentra capacitado para obtener la Licencia:</label>
                            <select name="perfiles" id="perfiles" class="form-control form-control-sm validate[required]">
                                <option value=''>Seleccione...</option>
                                <?php
                                for($i=0;$i<count($perfiles_natural);$i++){
                                    echo "<option value='".$perfiles_natural[$i]->id_perfil."'>".$perfiles_natural[$i]->desc_perfil."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Campos de acción:</label>
                            <select name="areas[]" id="areas" class="form-control form-control-sm validate[required] multipleSelect" multiple="multiple">
                            
                            </select>
                        </div>-->
                    </div>                  
                    <?php
                }else{
                    ?>
                    <div class="row">                            
                        <div class="col-md-12">                           
                            <table class="table" id="mainTable">
                                <tbody>
                                <?php
                                if(count($total_sedes) > 0){
                                    for($ts=0;$ts<count($total_sedes);$ts++){

                                        $campos_tramite_sede = $this->sst_model->sst_campos_tramite_sede($tramite_info->id_tramite, $total_sedes[$ts]->contador);
                                        $campos_por_perfil = $this->sst_model->campos_por_perfil($total_sedes[$ts]->id_perfil);
                                        ?>
                                        <tr>
                                            <td width="30%">
                                                <label>Dirección o Sede:</label>
                                                <input type="text" name="sede_campo-<?php echo $total_sedes[$ts]->contador?>" id="sede_campo-<?php echo $total_sedes[$ts]->contador?>" class="form-control form-control-sm validate[required]" value="<?php echo $total_sedes[$ts]->sede?>" readonly>
                                            </td>                                        
                                            <td width="70%"> 
                                                <label>Campos de acción:</label>
                                                <select name="areas-<?php echo $total_sedes[$ts]->contador?>[]" id="areas-<?php echo $total_sedes[$ts]->contador?>" class="form-control form-control-sm validate[required] multipleSelect" multiple="multiple" disabled>
                                                    <?php
                                                    $campos_seleccionados = array();
                                                    for($cts=0;$cts<count($campos_tramite_sede);$cts++){
                                                        $campos_seleccionados[] = $campos_tramite_sede[$cts]->id_campo;
                                                    }
                                                    for($i=0;$i<count($campos_accion_juridica);$i++){

                                                        if(in_array($campos_accion_juridica[$i]->id_campo, $campos_seleccionados)){
                                                            echo "<option value='".$campos_accion_juridica[$i]->id_campo."' selected>".$campos_accion_juridica[$i]->desc_campo."</option>";
                                                        }else{
                                                            echo "<option value='".$campos_accion_juridica[$i]->id_campo."'>".$campos_accion_juridica[$i]->desc_campo."</option>";
                                                        }                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </td>                                            
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td width="30%">
                                            <label>Dirección o Sede:</label>
                                            <input type="text" name="sede_campo-1" id="sede_campo-1" class="form-control form-control-sm validate[required]" readonly>
                                        </td>                                        
                                        <td width="70%"> 
                                            <label>Campos de acción:</label>
                                            <select name="areas-1[]" id="areas-1" class="form-control form-control-sm validate[required] multipleSelect" multiple="multiple" disabled>
                                                <?php
                                                for($i=0;$i<count($campos_accion_juridica);$i++){
                                                    echo "<option value='".$campos_accion_juridica[$i]->id_campo."'>".$campos_accion_juridica[$i]->desc_campo."</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>                                            
                                    </tr>
                                    <?php
                                }
                                ?>
                                    
                                </tbody>
                            </table> 
                        </div>
                    </div>                        
                    <?php
                }
                
                ?>    
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-resultado" role="tabpanel" aria-labelledby="v-pills-resultado-tab">
      <div class="card">
            <div class="card-header bg-primary text-white">
                Seguimiento trámite
            </div>
            <div class="card-body">
                <div class="row">     
                    <div class="col-md-12">
                        <table width="100%" class="table table-striped">
                            <thead class="bg-primary text-white">
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
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tabla de Seguimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="otrosTramitesModal" tabindex="-1" role="dialog" aria-labelledby="otrosTramitesLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="otrosTramitesLabel">Otros trámites del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table width="100%" class="table table-striped">
		<thead class="bg-primary text-white">
			<tr>
				<th width="12%"><b>ID Trámite</b></th>
				<th width="25%"><b>Fecha de creación</b></th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(count($tramites_proceso_usuario)>0){
		for($i=0;$i<count($tramites_proceso_usuario);$i++){
		?>
		<tr>
			<td style="height:55px;">
				<?php echo $tramites_proceso_usuario[$i]->id_tramite;?>
			</td>
			<td style="height:55px;">
				<?php echo $tramites_proceso_usuario[$i]->fecha_creacion;?> 
			</td>
		</tr>
		<?php									
		}
		}
		?>
		</tbody>
	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>