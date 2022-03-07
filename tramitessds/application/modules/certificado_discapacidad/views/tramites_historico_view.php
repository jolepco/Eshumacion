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
<form action="<?php echo base_url('certificado_discapacidad/reportes/2') ?>" method="post" class="form-horizontal">
	<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-">
                <div class="subtitle">
                    <h3><b>Reporte histórico trámites Certificado de Discapacidad</b></h3>
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
				<a href="<?php echo base_url("certificado_discapacidad/generar_excel/2"); ?>" class="btn btn-primary btn-xl">Descargar Excel<span class="" aria-hidden="true"></a>
            </div>
		<br>
			<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_tramites"  style="font-size:small;">
					<thead>
						<tr>
							<th>Id Trámite</th>
							<th>Identificación Solicitante</th>
							<th>Nombre solicitante</th>
							<th>Fecha registro</th>
							<th>Estado</th>
							<th>Observaci&oacute;n</th>
							<th>Fecha actualizaci&oacute;n</th>
							<th>PDF</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if (count($listado_soli) > 0) {
							for ($i = 0; $i < 15000; $i++) {
								?>
								<tr>
									<td>
										<?php echo $listado_soli[$i]->id_tramite; ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->nume_identificacion ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->p_nombre . " " . $listado_soli[$i]->s_nombre . " " . $listado_soli[$i]->p_apellido . " " . $listado_soli[$i]->s_apellido ?>

									</td>

									<td>
										<?php echo $listado_soli[$i]->fecha_registro ?>
									</td>
									<td>
										<?php
										switch ($listado_soli[$i]->id_estado) {
												case 1:
													$valor = 'Solicitud realizada por el usuario';
													$clase = "text-primary";
												break;
												case 2:
													$valor = 'Aprobado por parte del validador de documentos';
													$clase = "text-success";
												break;
												case 3:
													$valor = 'Aprobado por el coordinador';
													$clase = "text-success";
												break;
												case 4:
													$valor = 'Aprobado y firmado';
													$clase = "text-success";
												break;
												case 5:
													$valor = 'Negado por el validador de documentos';
													$clase = "text-success";
												break;
												case 6:
													$valor = 'Negado por el coordinador';
													$clase = "text-success";
												break;
												case 7:
													$valor = 'Negado y firmado';
													$clase = "text-danger";
												break;
												case 13:
													$valor = 'Solicitar mas información';
													$clase = "text-warning";
												break;
												case 23:
													$valor = 'Subsanado';
													$clase = "text-primary";
												break;
												case 24:
													$valor = 'Sin competencia (Régimen especial o no residente en Bogotá)';
													$clase = "text-primary";
												break;
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
										?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->observaciones_h ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->fecha_registro_h ?>
									</td>
									<td>
										<?php 
										if ($listado_soli[$i]->id_estado == 4) { 
											$resolucion="certificado_discapacidad/abrir_resolucion_pdf/".$listado_soli[$i]->id_tramite;
										?>
											<center>
												<a href="<?php echo base_url($resolucion) ?>" target="_blank">
													<img src="<?php echo base_url('assets/imgs/pdf.png') ?>" width="20px">
												</a>
											</center>
										<?php } ?>
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