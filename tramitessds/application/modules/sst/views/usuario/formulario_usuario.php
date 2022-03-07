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

    if(count($tramites_proceso) > 0){
        ?>
        <div class="alert alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            Estimado usuario!, en este momento ya cuenta con tramites de Licencia para prestación de servicios en seguridad y salud en el trabajo en proceso. 
            Recomendamos realizar el registro de una nueva solicitud solo en caso de ser diferente a la ya registrada en el sistema, de lo contrario la solicitud puede ser anulada.
        </div>
        <?php
    }

?>


<form class="border border-light p-5" id="formsst_usuario" name="formsst_usuario" action="<?php echo base_url('sst/guardarTramite')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?php echo $this->session->userdata('tipo_identificacion');?>">
<input type="hidden" name="id_estado" id="id_estado" value="1">
<div class="text-center">
    <h3 class="text-info"><b>Licencia para prestación de servicios en Seguridad y Salud en el Trabajo</b></h3>
</div>

<div class="row" id="div_info">
    <p>
        Solicitar la expedición, renovación o modificación de la licencia para prestar servicios en Seguridad y Salud en el Trabajo como persona natural o jurídica, pública o privada.
    </p>
    <p>
        <b>Apreciado Ciudadano!</b><br>
        Favor indique a continuación las opciones disponibles para el trámite de Licencia en Seguridad y Salud en el Trabajo!
    </p>    
</div>
<div class="row">
    <div class="text-center">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="tipo_tramite1" name="tipo_tramite" class="custom-control-input validate[required]" value="1">
            <label class="custom-control-label" for="tipo_tramite1">Primera Vez</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="tipo_tramite2" name="tipo_tramite" class="custom-control-input validate[required]" value="2">
            <label class="custom-control-label" for="tipo_tramite2">Modificación</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="tipo_tramite3" name="tipo_tramite" class="custom-control-input validate[required]" value="3">
            <label class="custom-control-label" for="tipo_tramite3">Renovación</label>
        </div>
    </div>  
</div>
<hr>
<div class="row" id="div_modificacion" style="display:none">
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
                                <option value="1">Cambio de nombre y/o apellido del titular de la licencia</option>
                                <option value="2">Cambio de número y tipo de identificación</option>
                                <option value="3">Cambio en el nivel de formación en seguridad y salud en el trabajo</option>
                                <?php
                            }else{
                                ?>
                                <option value="4">Cambio de Nomenclatura</option>
                                <option value="5">Cambio de domicilio</option>
                                <option value="6">Apertura de campo(s) de acción adicional(es) al(os) otorgado(s) en la licencia SST</option>
                                <option value="7">Cierre temporal o definitivo de campos de acción</option>
                                <option value="8">Cambio de Representante Legal</option>
                                <option value="9">Apertura de sede</option>
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
                                <input type="file" name="soporte_modificacion" id="soporte_modificacion" class="form-control-sm form-control-file archivopdf validate[required]">
                            </div>
                            <?php
                        }
                    ?>                    
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Número de resolución vigente a la cual se le va a realizar la modificación</label>
                        <input type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" class="form-control form-control-sm validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Fecha de resolución vigente a la cual se le va a realizar la modificación</label>
                        <input type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" class="form-control form-control-sm validate[required]">
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<div class="row" id="div_renovacion" style="display:none">    
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
                                    echo "<option value='".$departamentos_col[$i]->IdDepartamento."'>".$departamentos_col[$i]->Descripcion."</option>";
                                }                                
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Municipio</label>
                        <select name="mpio_lic_anterior" id="mpio_lic_anterior" class="form-control form-control-sm validate[required]">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><font class="text-danger">(*)</font> PDF Licencia Anterior</label>
                        <input type="file" name="doc_lic_anteriorR" id="doc_lic_anterior" class="form-control-sm form-control-file archivopdf validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Número de resolución de la licencia anterior</label>
                        <input type="text" name="num_resolucion_anteriorR" id="num_resolucion_anterior" class="form-control form-control-sm validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Fecha de resolución de la licencia anterior</label>
                        <input type="date" name="fecha_resolucion_anteriorR" id="fecha_resolucion_anterior" class="form-control form-control-sm validate[required]">
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<?php
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
                            <textarea name="servicios" id="servicios" class="form-control form-control-sm validate[required]"></textarea>
                        </div>                        
                        <div class="col-md-12">
                            <label>Características básicas del servicio:</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control form-control-sm validate[required]"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Otros Cuáles?</label>
                            <textarea name="otros" id="otros" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Dirección de la entidad</label>
                            <input type="text" name="direccion_entidad" id="direccion_entidad" class="form-control form-control-sm validate[required]"/>
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
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Cámara de Comercio Establecimiento</div>
                                <div class="col-md-6"><input type="file" name="doc_cc" id="doc_cc" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Fotocopia Documento Representante Legal</div>
                                <div class="col-md-6"><input type="file" name="doc_rl" id="doc_rl" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Formato Diligenciado Personas Vinculadas a la prestación del Servicio de SST</div>
                                <div class="col-md-6"><input type="file" name="doc_formato_personas" id="doc_formato_personas" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Formato Diligenciado Equipos destinados al Servicio de SST</div>
                                <div class="col-md-6"><input type="file" name="doc_formato_equipos" id="doc_formato_equipos" class="form-control-sm form-control-file archivopdf validate[required]"></div>
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
                                <input type="radio" id="labora_actual1" name="labora_actual" class="custom-control-input validate[required]" value="1">
                                <label class="custom-control-label" for="labora_actual1">Si</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="labora_actual2" name="labora_actual" class="custom-control-input validate[required]" value="2">
                                <label class="custom-control-label" for="labora_actual2">No</label>
                            </div>
                        </div>
                    </div>
                    <div id="div_empresa" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre de la empresa</label>
                                <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control form-control-sm validate[required]">
                            </div>
                            <div class="col-md-6">
                                <label>Dirección de la empresa</label>
                                <input type="text" name="dir_empresa" id="dir_empresa" class="form-control form-control-sm validate[required]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Departamento Empresa</label>
                                <select name="depto_empresa" id="depto_empresa" class="form-control form-control-sm validate[required]">
                                    <option value="">Seleccione...</option>
                                    <?php
                                    for($i=0;$i<count($departamentos_col);$i++){
                                        echo "<option value='".$departamentos_col[$i]->IdDepartamento."'>".$departamentos_col[$i]->Descripcion."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Municipio Empresa</label>
                                <select name="mpio_empresa" id="mpio_empresa" class="form-control form-control-sm validate[required]">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Teléfono Empresa</label>
                                <input type="text" name="tel_empresa" id="tel_empresa" class="form-control form-control-sm validate[required]">
                            </div>
                            <div class="col-md-3">
                                <label>Fax Empresa</label>
                                <input type="text" name="fax_empresa" id="fax_empresa" class="form-control form-control-sm validate[required]">
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
                            <textarea name="servicios" id="servicios" class="form-control form-control-sm validate[required]"></textarea>
                        </div>                        
                        <div class="col-md-12">
                            <label>Características básicas del servicio:</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control form-control-sm validate[required]"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Otros Cuales?</label>
                            <textarea name="otros" id="otros" class="form-control form-control-sm"></textarea>
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
                                <option value="">Seleccione...</option>
                                <option value="1">Profesional Universitario con Postgrado</option>
                                <option value="2">Profesional Universitario</option>
                                <option value="3">Tecnología en seguridad y salud en el trabajo</option>
                                <option value="4">Técnico profesional en seguridad y salud en el trabajo</option>                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo Titulo</label>
                            <select name="tipo_titulo" id="tipo_titulo" class="form-control form-control-sm validate[required]">
                                <option value="">Seleccione...</option>
                                <option value="1">Nacional</option>
                                <option value="2">Extranjero</option>                           
                            </select>
                        </div>
                        <div class="col-md-4" id="div_tipo_profesional">
                            <label>Tipo Profesional</label>
                            <select name="tipo_profesional" id="tipo_profesional" class="form-control form-control-sm validate[required]">
                                <option value="">Seleccione...</option>
                                <option value="1">Médico</option>
                                <option value="2">Profesional Psicología</option>                           
                                <option value="3">Ingeniería</option>                           
                                <option value="4">Otros</option>                           
                            </select>
                        </div>
                        <div class="col-md-4" id="div_otro_tipo_profesional" style="display:none">
                            <label>Otro Tipo Profesional</label>
                            <input type="text" name="otro_tipo_profesional" id="otro_tipo_profesional" class="form-control form-control-sm validate[required]">
                        </div>
                    </div>                    
                    <div class="row">                                              
                        <div class="col-md-6">
                            <label>Ingrese el título del programa (Como aparece en el diploma) (*)</label>
                            <input type="text" name="titulo_programa" id="titulo_programa" class="form-control form-control-sm validate[required]">
                        </div>
                        <div class="col-md-6" id="div_titulo_postgrado">
                            <label>Ingrese el título de postgrado (Como aparece en el diploma) (*)</label>
                            <input type="text" name="titulo_postgrado" id="titulo_postgrado" class="form-control form-control-sm validate[required]">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> Documento de identidad</div>
                                <div class="col-md-6"><input type="file" name="doc_docu_iden" id="doc_docu_iden" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_pregrado">
                                <div class="col-md-6"><font class="text-danger">(*)</font> <font id="div_text_pregrado">PDF Título Pregrado </font></div>
                                <div class="col-md-6"><input type="file" name="doc_pregrado" id="doc_pregrado" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_postgrado">
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Título Postgrado</div>
                                <div class="col-md-6"><input type="file" name="doc_postgrado" id="doc_postgrado" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto" id="div_convalidacion">
                                <div class="col-md-6"><font class="text-danger">(*)</font> Convalidación</div>
                                <div class="col-md-6"><input type="file" name="doc_convalidacion" id="doc_convalidacion" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> PDF Certificado de notas o asignaturas Aprobadas</div>
                                <div class="col-md-6"><input type="file" name="doc_pensum" id="doc_pensum" class="form-control-sm form-control-file archivopdf validate[required]"></div>
                            </div>
                            <div class="row border-bottom border-info mx-auto">
                                <div class="col-md-6"><font class="text-danger">(*)</font> Soporte que demuestre que el programa es de Educación Formal de Carácter Superior</div>
                                <div class="col-md-6"><input type="file" name="doc_soporte" id="doc_soporte" class="form-control-sm form-control-file archivopdf validate[required]"></div>
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
