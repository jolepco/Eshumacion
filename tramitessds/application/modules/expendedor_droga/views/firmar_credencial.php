<script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/validate/aprobartramite.js"); ?>"></script>
<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-bookmark fa-fw"></i> CREDENCIALES EXPENDEDOR DE DROGAS
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-success" href=" <?php echo base_url(). 'expendedor_droga/tramites_pendientes'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a>
					<i class="fa fa-check-circle"></i> FIRMAR CREDENCIAL
				</div>
				<div class="panel-body">
					<?php
					if($info){
						
					?>	
						<button type="button" class="btn btn-success btn-block editar" data-toggle="modal" data-target="#modal" id="persona">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Revisar y editar datos personales
						</button><br>
						<br>
						<?php
						$retornoExito = $this->session->flashdata('retornoExito');
						if ($retornoExito) {
							$disabled="disabled";
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success ">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo $retornoExito ?>		
								</div>
							</div>
							<?php
						}else{
							$disabled="";
						}

						$retornoError = $this->session->flashdata('retornoError');
						if ($retornoError) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-danger ">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<?php echo $retornoError ?>
								</div>
							</div>
							<?php
						}
						
						?> 
								
						<div class="modal-body">
							<p class="text-danger text-left">Los campos con * son obligatorios.</p>
							<form name="form_aprobar" id="form_aprobar" role="form_aprobar" method="post" >
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group text-left">
										<label class="control-label" for="estado">Cambiar estado del trámite : *</label>
										<select name="estado" id="estado" class="form-control" required>
											<option value=''>Selecccione...</option>
											<?php for ($i = 0; $i < count($estados); $i++) { ?>
												<option value="<?php echo $estados[$i]["id_estado"]; ?>" <?php if($info[0]->id_estado == $estados[$i]["id_estado"]) { echo "selected"; }  ?>><?php echo $estados[$i]["descripcion"]; ?></option>	
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group text-left">
										<label class="control-label" for="observaciones">Observaciones :</label>
										<textarea name="observaciones" id="observaciones" class="form-control" rows="3" cols="50" required><?php echo $info[0]->observaciones; ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<legend>Documentos registrados</legend>
							</div>
							<div class="row">
								<div class="modal-header">
									<div class="row">
								      <div class="col-sm-2">Id documento</div>
									  <div class="col-sm-4">Descripci&oacute;n</div>
									  <div class="col-sm-2">Abrir PDF</div>
									  <div class="col-sm-2">Ver PDF</div>
									  <div class="col-sm-2">Cumple el documento?</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="modal-body">
									<?php
									if($info){
										
										for($i=0; $i<=count($archivos)-1; $i++){
											
											$ruta='<a href="'.base_url('/'.$archivos[$i]['ruta'].''.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
											$nombre=explode('-', $archivos[$i]['nombre']);
																						
											echo '<div class="row">
											  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
											 	<div class="col-sm-4">'.$nombre[1].'</div>
											  	<div class="col-sm-2">'. $ruta.'</div> ';
											echo "<div class='col-sm-2'>";
												?>
												<button type="button" class="btn btn-success btn-xs VerPDF" data-toggle="modal" data-target="#modal" id="<?php echo $archivos[$i]['id_archivo']; ?>" >
												Ver <span class="glyphicon glyphicon-eye-open" aria-hidden="true">
												</button>
												<?php
											echo "</div>";
											echo '<div class="col-sm-2">
										  			<input type="radio" class="form-check-input" id="'.$archivos[$i]['id_archivo'].'" name="'.$archivos[$i]['id_archivo'].'" value="1"';
										  			if($archivos[$i]["condicion"] == 1){
										  				echo 'checked="checked"';
										  			}
										  			echo ' required>
										  			
												 	<label class="form-check-label" for="materialUnchecked">Si</label>
											 	
												 	<input type="radio" class="form-check-input" id="'.$archivos[$i]['id_archivo'].'" name="'.$archivos[$i]['id_archivo'].'" value="2"
												 	';
										  			if($archivos[$i]["condicion"] == 2){
										  				echo 'checked="checked"';
										  			}
										  			echo ' >
												 	<label class="form-check-label" for="materialUnchecked">No</label>
												</div>
											</div>';
										
										}
									} 
									?>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-12" align="center">
										<div style="width:50%;" align="center">
											<input type="hidden" id="idtramite" name="idtramite" value="<?php echo $info[0]->id_expdrogas_tramite; ?>">
											<input type="button" id="btnSubmitAprobar" name="btnSubmitAprobar" value="<?php echo $boton; ?>" class="btn btn-success"<?php echo $disabled; ?>/>
											<!--<button type="submit" id="btnSubmit" class="btn btn-success">Guardar</button>-->
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>


					<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
</div>
	<!-- /#page-wrapper -->


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
	<!--FIN Modal para adicionar HAZARDS -->

	