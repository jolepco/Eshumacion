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
<form action="<?php echo base_url('sst/reportes/generarExcelMinisterio')?>" method="post" enctype="multipart/form-data" id="form-ministerio">
    <div class="row m-5">
        <div class="col-md-12 text-center">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <h3>Reporte Ministerio de Salud</h3>
                </div>                
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group w-25">
                        <label>Reporte:</label>
                        <select name="reporte" id="reporte" class="form-control form-control-sm validate[required]" required>
                            <option value=''>Seleccione...</option>
                            <option value='PN'>Persona Natural</option>
                            <option value='PJ'>Persona Jurídica</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group w-25">
                        <label>Fecha inicial:</label>
                        <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control form-control-sm validate[required]" required>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group w-25">
                        <label>Fecha final:</label>
                        <input type="date" name="fecha_final" id="fecha_final" class="form-control form-control-sm validate[required]" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="submit">Generar Reporte</button>
                </div>
            </div>
        </div>
    </div>
</form>