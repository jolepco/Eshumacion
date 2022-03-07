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
<form action="<?php echo base_url('xindustrial/reporte_xindustrial/') ?>" method="post" class="form-horizontal">
	<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-">
                <div class="subtitle">
                    <h2><b>Filtro Consulta y Descarga Excel Tr&aacute;mites Solicitados</b></h2>
					<h3>Licencia de equipos industriales, veterinaria o de investigación</h3>
                </div>
            </div>
			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>Fecha Inicial:</b></label>
                    <input type="date" id="fecha_i" name="fecha_i" class="form-control" placeholder="Fecha Seguimiento Inicio" style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>Fecha Final:</b></label>
                    <input type="date" id="fecha_f" name="fecha_f" class="form-control" placeholder="Fecha Seguimiento Fin"  style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br><br><br>
                    <input type="submit" class="btn btn-info" value="Consultar" style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br><br><br>
					<input  type="button" class="btn btn-success" id="Excel" value="Descargar Excel" style="width:100%;">
                </div>
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
		<br>
			<table class="table" id="tabla_tramites"  style="font-size:small;">
					<thead>
						<tr>
							<th>ID Solicitud</th>
							<th>Tipo Trámite</th>
							<th>Categoría Equipo</th>
							<th>Fecha creación</th>
              <th>No Identificación Solicitante</th>
							<th>Nombre solicitante</th>
							<th>Estados</th>
							<th>Fecha Estado</th>
							<th>PDF</th>
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
										<?php echo $listado_soli[$i]->tipo_tramite; ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->categoria; ?>
                  </td>
                  <td>
										<?php echo $listado_soli[$i]->created_at ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->nume_identificacion ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->p_nombre . " " . $listado_soli[$i]->s_nombre . " " . $listado_soli[$i]->p_apellido . " " . $listado_soli[$i]->s_apellido ?>

									</td>
									<td>
										<?php echo $listado_soli[$i]->descripcion; ?>
									</td>
									<td>
										<?php echo $listado_soli[$i]->fecha_estado ?>
                    <?php echo $listado_soli[$i]->id_estado ?>
									</td>
									<td>
                  <center>
										<?php
                    if($listado_soli[$i]->estado == '41' ){
                        $archivoTram = $this->xindustrial_model->consultar_archivo_visita($listado_soli[$i]->id);
                    ?>
    									<a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                    }else if ($listado_soli[$i]->estado == '12' ){
                      $archivoTram = $this->xindustrial_model->consultar_archivo_negacion($listado_soli[$i]->id);
                    ?>
    									<a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                    }else if($listado_soli[$i]->estado == '13'){
                        $archivoSubsanacion = $this->xindustrial_model->consultar_archivo_subsanacion($listado_soli[$i]->id);
                        if($archivoSubsanacion){
                          ?>
                        <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoSubsanacion->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                        }
                    }else if($listado_soli[$i]->estado == '10'){
                        $archivoTram = $this->xindustrial_model->consultar_archivo_aprobacion($listado_soli[$i]->id);
                        if($archivoTram){
                          ?>
                        <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                        }
                    }else if($listado_soli[$i]->estado == '22'){
                        $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($listado_soli[$i]->id);
                        if($archivoVisita){
                          ?>
                        <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                        }
                    }else if($listado_soli[$i]->estado == '23'){
                        $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($listado_soli[$i]->id);
                        if($archivoVisita2){
                          ?>
                        <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                    <?php
                        }
                    }
                    ?>

                </center>
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

 <script type="text/javascript">
    $("#Excel").click(function (){
    var fecha_i= $("#fecha_i").val();
    var fecha_f= $("#fecha_f").val();
   window.location.href =base_url+'xindustrial/generar_excel?fecha_i='+fecha_i+'&fecha_f='+fecha_f;
   //window.location.href ="<?php //echo base_url("validacion/generar_excel/")?>"

  });

  </script>
