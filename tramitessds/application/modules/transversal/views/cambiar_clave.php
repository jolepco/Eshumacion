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


<form class="border border-light p-5" id="form_clave" name="form_clave" action="<?php echo base_url('transversal/guardarContrasena')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $this->session->userdata('id_usuario');?>">

<div class="text-center">
    <h3 class="text-info"><b>Cambio de Contraseña</b></h3>
</div>

<div class="row">
    <div class="col"></div>
    <div class="col-md-6">
        <div class="col-md-12">
            <label>Contraseña Actual</label>
            <input type="password" name="pass_actual" id="pass_actual" class="form-control form-control-sm validate[required, minSize[6]]">
            </select>
        </div>
        <div class="col-md-12">
            <label>Nueva Contraseña</label>
            <input type="password" name="pass_nuevo" id="pass_nuevo" class="form-control form-control-sm validate[required, equals[pass_repite], minSize[6]]">
        </div>
        <div class="col-md-12">
            <label>Repita Nueva Contraseña</label>
            <input type="password" name="pass_repite" id="pass_repite" class="form-control form-control-sm validate[required, equals[pass_nuevo], minSize[6]]">
        </div>
    </div>
    <div class="col"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" name="guardar" id="guardar" class="btn btn-sm btn-success ">Guardar</button>
    </div>
</div>  
</form>