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

<form class="form-horizontal" id="form_tramite" name="form_tramite" action="<?php echo base_url('xindustrial/direccion/guardarEstadoRx/'.$tramites_pendientes->id)?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id_persona" value="<?php echo $tramites_pendientes->id_persona?>">
	<input type="hidden" name="id_tramite" value="<?php echo $tramites_pendientes->id?>">
	<div class="row">
		<div class="col-12 col-md-12 pl-4">
			<div class="subtitle">
        <h2><b>Tr&aacute;mite ID.<?php echo $tramites_pendientes->id?></b></h2>
				  <b>Estado Trámite:</b> <?php echo $tramites_pendientes->descripcion?>
					<br>
          <b>Tipo Trámite:</b> <?php echo $tramites_pendientes->ttdescripcion?><br>
					<b>Fecha Trámite:</b> <?php echo $tramites_pendientes->created_at?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<a class="nav-link active" id="v-pills-dpersonales-tab" data-toggle="pill" href="#v-pills-dpersonales" role="tab" aria-controls="v-pills-dpersonales" aria-selected="true">Datos Personales</a>
			<a class="nav-link" id="v-pills-localizacion-tab" data-toggle="pill" href="#v-pills-localizacion" role="tab" aria-controls="v-pills-localizacion" aria-selected="false">Localización</a>
			<a class="nav-link" id="v-pills-equipos-tab" data-toggle="pill" href="#v-pills-equipos" role="tab" aria-controls="v-pills-equipos" aria-selected="false">Equipos</a>
			<a class="nav-link" id="v-pills-trabajadores-tab" data-toggle="pill" href="#v-pills-trabajadores" role="tab" aria-controls="v-pills-trabajadores" aria-selected="false">Trabajadores</a>
			<a class="nav-link" id="v-pills-talento-tab" data-toggle="pill" href="#v-pills-talento" role="tab" aria-controls="v-pills-talento" aria-selected="false">Talento Humano</a>
			<a class="nav-link" id="v-pills-documentos-tab" data-toggle="pill" href="#v-pills-documentos" role="tab" aria-controls="v-pills-documentos" aria-selected="false">Documentos Adjuntos</a>
			<a class="nav-link" id="v-pills-resultado-tab" data-toggle="pill" href="#v-pills-resultado" role="tab" aria-controls="v-pills-resultado" aria-selected="false">Resultado Validación</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-dpersonales" role="tabpanel" aria-labelledby="v-pills-dpersonales-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Datos Personales
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/datos_personales');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-localizacion" role="tabpanel" aria-labelledby="v-pills-localizacion-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Localización Entidad
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/localizacion_equipos');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-equipos" role="tabpanel" aria-labelledby="v-pills-equipos-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Equipos
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/equipos');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-trabajadores" role="tabpanel" aria-labelledby="v-pills-trabajadores-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Trabajadores Expuestos
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/trabajadores');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-talento" role="tabpanel" aria-labelledby="v-pills-talento-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Talento Humano
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/talento_humano');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Documentos Adjuntos
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/documentos');?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-resultado" role="tabpanel" aria-labelledby="v-pills-resultado-tab">
					<div class="card">
						<div class="card-header bg-primary text-white">
							Resultado Validación
						</div>
						<div class="card-body">
							<?php $this->load->view('direccion/rayosx/resultado');?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
