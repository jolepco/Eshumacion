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

<form action="<?php echo base_url('xindustrial/buscarporcedulaRX/') ?>" method="post" autocomplete="off" class="form-horizontal">
	<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-">
                <div class="subtitle">
                    <h2><b>Filtro Consulta de Tr&aacute;mites por Número de Documento</b></h2>
					<h3>Licencia de equipos industriales, veterinaria o de investigación</h3>
                </div>
            </div>
			<div class="col-12 col-md-6 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>No. Documento Solicitante:</b></label>
                    <input id="num_doc" name="num_doc" class="form-control" placeholder="Ingresar el Número de Documento" style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-6 pl-4">
                <div class="paragraph">
					<br><br><br>
                    <input type="submit" class="btn btn-info " value="Consultar" style="width:100%;">
                </div>
            </div>


</form>
		<div class="col-12 col-md-12">
		<br>
			<div class="alert alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<b>Apreciado Usuario!</b>
			<p>La siguiente consulta tiene como filtro de busqueda el Número de Documento del solicitante o nit quien esta registrado como persona natural o jurídica en el sistema Ventanilla Única de Trámites y Servicios de la Secretaría Distrital de Salud. Favor ingresar el número de documento sin separadores, espacios y/o puntos.
			</p>
			</div>
		</div>

		<div class="col-12 col-md-12">
		<br>
			<table class="table" id="tabla_tramites"  style="font-size:small;">
				<thead>
                    <tr>
                        <th>ID Tr&aacute;mite</th>
                        <th>Identificaci&oacute;n</th>
                        <th>Nombres y Apellidos</th>
                        <th>Fecha Radicaci&oacute;n</th>
						            <th>Estado Trámite</th>
                        <th>Ver M&aacute;s</th>

                    </tr>
                </thead>
                <tbody>

                <?php
                //Author: Mario Beltran mebeltran@saludcapital.gov.co Since: 03092020
                //Listado de tramites Exhumacion por cedula
                if(!empty($tramitesinfo)){
                        for($i=0;$i<count($tramitesinfo);$i++){
                        ?>
                    <tr>
                        <td>
                            <?php echo $tramitesinfo[$i]->id;?>
                        </td>
                        <td>
                            <?php echo $tramitesinfo[$i]->Descripcion." - ".$tramitesinfo[$i]->nume_identificacion?>
                        </td>
                        <td>
                            <?php echo $tramitesinfo[$i]->p_nombre." ".$tramitesinfo[$i]->s_nombre." ".$tramitesinfo[$i]->p_apellido." ".$tramitesinfo[$i]->s_apellido?>
                        </td>
						<td>
                            <?php echo $tramitesinfo[$i]->created_at?>
                        </td>
						<td>
                            <?php echo $tramitesinfo[$i]->descripcion?>
                        </td>
                        <td>
							<center>
								<a href="<?php echo base_url('xindustrial/visualizar_documentos/'.$tramitesinfo[$i]->id) ?>"  target="_blank">
								<img src="<?php echo base_url('assets/imgs/aprobar.png')?>" width="20px">
								<br>Visualizar Informaci&oacute;n
								</a>
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
