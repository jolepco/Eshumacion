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
<form action="<?php echo base_url('consultas/rayosx') ?>" method="post" class="form-horizontal">
	<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-">
                <div class="subtitle">
                    <h3><b>Reporte trámites Rayos X</b></h3>
				</div>
            </div>
			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="fecha_i"><b>Fecha Inicial:</b></label>
                    <input id="fecha_i" name="fecha_i" class="form-control" placeholder="Fecha Seguimiento Inicio" style="width:100%;">
                </div>
            </div>
			
			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="fecha_f"><b>Fecha Final:</b></label>
                    <input id="fecha_f" name="fecha_f" class="form-control" placeholder="Fecha Seguimiento Fin"  style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br><br><br>
                    <input type="submit" class="btn btn-info" value="Consultar" style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                
            </div>			
	
</form>
		<div class="col-12 col-md-12">
		<br>
			<div class="alert alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<b>Apreciado Usuario!</b>
			<p>La consulta y el reporte de tr&aacute;mites que se han solicitado con su ultimo estado de gesti&oacute;n, es por rango de fecha de acuerdo a la fecha del registro generada por el sistema.<br>
			Los Tr&aacute;mites visualizados corresponden a los últimos 30 d&iacute;as desde la fecha actual.
			</p>
			</div>
		</div>
		
		<div class="col-12 col-md-12">
			<div class="col-md-2 col-md-offset-5">
				<a href="<?php echo base_url("consultas/generar_excel/1"); ?>" class="btn btn-primary btn-xl">Descargar Excel<span class="" aria-hidden="true"></a>
            </div>
        <br>
			<table class="table" id="tabla_tramites"  style="font-size:small;">
					<thead>
						<tr>
							<th>Id Trámite</th>
							<th>Identificación</th>
							<th>Nombres y apellidos</th>
							<th>Fecha envío</th>
							<th>Estado</th>
							<th>Fecha estado</th>
							<!--<th>PDF</th>-->
						</tr>
					</thead>
					<tbody>
						<?php
						if (count($listado_soli) > 0) {
							for ($i = 0; $i < count($listado_soli); $i++) {
								?>
								<tr>
									<td>
										<?php echo $listado_soli[$i]->id; ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->nume_identificacion ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->p_nombre . " " . $listado_soli[$i]->s_nombre . " " . $listado_soli[$i]->p_apellido . " " . $listado_soli[$i]->s_apellido ?>

									</td>

									<td>
										<?php echo $listado_soli[$i]->created_at; ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->estado ." ".$listado_soli[$i]->descEstado ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->fecha_estado ?>
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
       
 

