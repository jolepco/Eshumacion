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


<form class="border border-light p-5" id="formsst_usuario" name="formsst_usuario" action="<?php echo base_url('xindustrial/crearTramiteRayosx')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?php echo $this->session->userdata('tipo_identificacion');?>">
<input type="hidden" name="id_estado" id="id_estado" value="1">
<div class="text-center">
    <h3 class="text-info"><b>Licencia de equipos industriales, veterinaria o de investigación</b></h3>
</div>

<div class="row" id="div_info">
    <p>Apreciado Ciudadano(a)<br>
    <!--<p>Este trámite es solo para licencia de practica medica categoría I Y II. En el caso de licencia de prácticas industriales veterinarias o de investigación contactar a: contactenos@saludcapital.gov.co</p>-->
    Este módulo permite crear la solicitud y será dirigido al módulo de mis tramites donde puede completar la información y enviar la solicitud.</p>
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> PDF Licencia Vigente a modificar</label>
                        <input type="file" name="doc_lic_anterior" id="doc_lic_anterior" class="form-control-sm form-control-file archivopdf validate[required]">
                    </div>
                    <?php
                        if($this->session->userdata('tipo_identificacion') == 5){
                            ?>
                            <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> PDF Licencia Anterior</label>
                        <input type="file" name="doc_lic_anteriorR" id="doc_lic_anteriorR" class="form-control-sm form-control-file archivopdf validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Número de resolución de la licencia anterior</label>
                        <input type="text" name="num_resolucion_anteriorR" id="num_resolucion_anteriorR" class="form-control form-control-sm validate[required]">
                    </div>
                    <div class="col-md-6">
                        <label><font class="text-danger">(*)</font> Fecha de resolución de la licencia anterior</label>
                        <input type="date" name="fecha_resolucion_anteriorR" id="fecha_resolucion_anteriorR" class="form-control form-control-sm validate[required]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" name="guardar" id="guardar" class="btn btn-sm btn-success ">Crear Solicitud</button>
    </div>
</div>
</form>
