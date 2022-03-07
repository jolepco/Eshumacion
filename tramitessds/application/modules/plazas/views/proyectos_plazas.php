<div id="page-wrapper">
	<div>
		<a class="btn btn-info" href=" <?php echo base_url(). 'plazas/index'; ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-bookmark fa-fw"></i> AUTORIZACIÓN DE PLAZAS
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	<?php
	if($information){
		if($information[0]->modalidad!=''){
			$disabled='disabled';
		}else{
			$disabled='';
		}
	?>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" class="btn btn-success btn-block proyecto" data-toggle="modal" data-target="#modal" <?php echo $disabled; ?> >
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registrar proyecto
			</button>
		</div>
	</div>
	<br>
	<!-- /.row -->
	
	<div class="row">
			<?php
			$retornoExito = $this->session->flashdata('retornoExito');
			if ($retornoExito) {
				?>
				<div class="col-lg-12">	
					<div class="alert alert-success ">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<?php echo $retornoExito ?>		
					</div>
				</div>
				<?php
			}

			$retornoExitoP = $this->session->flashdata('retornoExitoP');
			if ($retornoExitoP) {
				?>
				<div class="col-lg-12">	
					<div class="alert alert-success ">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<?php echo $retornoExitoP ?>		
					</div>
				</div>
				<?php
			}

			$retornoExitoENC = $this->session->flashdata('retornoExitoENC');
					if ($retornoExitoENC) {
						?>
						<div class="col-lg-12">	
							<div class="alert alert-success ">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								<?php echo $retornoExitoENC ?>		
							</div>
						</div>
						<?php
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
		<div class="col-lg-12">
			<?php
			if ($information[0]->id_estado==4) {
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bookmark-o"></i> Descargue la Resolución.
				</div>
				<div class="panel-body">
					
						<div class="col-lg-12">	
							<div class="alert alert-success text-center">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								<?php echo 'Descargue aqu&iacute; su resolución <br>
								<a href="'.base_url('plazas/resoluciones').'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
								?>	
							</div>
						</div>
						
				</div>
			</div>
			<?php
			}
			?>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-user"></i>  Datos representante legal
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group text-left">
								<label class="control-label" for="numiden">Razón social:</label>
								<?php echo $information?$information[0]->nombre_rs:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
								<?php echo $information?$information[0]->nume_identificacion:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="numiden">Tipo de identificaci&oacute;n:</label>
								<?php echo $information?$information[0]->tipiden:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="p_nombre">Nombre representante legal:</label>
								<?php echo $information?$information[0]->p_nombre:""; ?>
								<?php echo ' '.$information?$information[0]->s_nombre:""; ?>
								<?php echo ' '.$information?$information[0]->p_apellido:""; ?>
								<?php echo ' '.$information?$information[0]->s_apellido:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="email">Correo electrónico: </label>
								<?php echo $information?$information[0]->email:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">No. de teléfono:</label>
								<?php echo $information?$information[0]->telefono_fijo:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="celular">No. de celular:</label>
								<?php echo $information?$information[0]->telefono_celular:""; ?>
							</div>
						</div>
					</div>
					<?php
					if($information[0]->id_estado==13){
					?>
					<div class="row">
						<div class="col-lg-12 text-center">
							
							<button type="button" class="btn btn-success editPersonales" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos del representante legal
							</button>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-users"></i> Datos del encargado del trámite
				</div>	
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="numiden">N&uacute;mero de identificaci&oacute;n:</label>
								<?php echo $information?$information[0]->enc_numdoc:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="numiden">Tipo de identificaci&oacute;n:</label>
								<?php echo $information?$information[0]->tipidenenc:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="p_nombre">Nombre:</label>
								<?php echo $information?$information[0]->enc_pnombre:""; ?>
								<?php echo ' '.$information?$information[0]->enc_snombre:""; ?>
								<?php echo ' '.$information?$information[0]->enc_papellido:""; ?>
								<?php echo ' '.$information?$information[0]->enc_sapellido:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="email">Correo electrónico: </label>
								<?php echo $information?$information[0]->enc_email:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">No. de teléfono:</label>
								<?php echo $information?$information[0]->enc_telefono:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="celular">No. de celular:</label>
								<?php echo $information?$information[0]->enc_celular:""; ?>
							</div>
						</div>
					</div>
					<?php
					if($information[0]->id_estado==13){
					?>
					<div class="row">
						<div class="col-lg-12 text-center">
							<button type="button" class="btn btn-success editEncargado" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos del encargado del trámite
							</button>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<!-- /.panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-clone"></i> Datos del proyecto y tipo de plaza de servicio social
				</div>	
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Modalidad de la plaza:</label>
								<?php echo $information?$information[0]->modalidad:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">No. de plazas solicitadas:</label>
								<?php echo $information?$information[0]->nro_plazas:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Nombre proyecto investigación:</label>
								<?php echo $information[0]->nom_proyecto!=''?$information[0]->nom_proyecto:"N/A"; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Tipo profesión o especialidad:</label>
								<?php echo $information?$information[0]->profesion:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Tipo de vinculación:</label>
								<?php echo $information?$information[0]->vinculacion:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Especialidad:</label>
								<?php echo $information[0]->especialidad!=''?$information[0]->especialidad:"N/A"; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">No. de población beneficiada :</label>
								<?php echo $information?$information[0]->nro_poblacion:""; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Salario asignado por Plaza Individual :</label>
								<?php echo $information?$information[0]->salario_asignado:""; ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group text-left">
								<label class="control-label" for="telefono_fijo">Fecha de registro:</label>
								<?php echo $information?$information[0]->fecha_registro:""; ?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file"></i> Documentos adjuntos
				</div>	
				<div class="panel-body">
					<div class="row">
					<?php
						for($i=0; $i<=count($archivos)-1; $i++){
												
							//$ruta='<a href="'.base_url('/'.$archivos[$i]['ruta'].''.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
							$ruta='<a href="'.base_url('plazas/abrir_pdf/'.$archivos[$i]['nombre']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';

							$nombre=explode('-', $archivos[$i]['nombre']);
																		
							echo '<div class="row">
							  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
							 	<div class="col-sm-4">'.$nombre[1].'</div>
							  	<div class="col-sm-2">'. $ruta.'</div> ';
								echo "<div class='col-sm-4'>";
								?>
									<button type="button" class="btn btn-info btn-xs VerPDF" data-toggle="modal" data-target="#modal" id="<?php echo $archivos[$i]['id_archivo']; ?>" >
									Ver PDF<span class="glyphicon glyphicon-eye-open" aria-hidden="true">
									</button>
								<?php
								echo "</div>";
							echo '</div>';
						}
					?>
					</div>
					<?php
					if($information[0]->id_estado==13){
					?>
					<div class="row">
						<div class="col-lg-12 text-center">
							<button type="button" class="btn btn-success editProyecto" data-toggle="modal" data-target="#modal">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos del proyecto y documentos
							</button>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-success text-center">
								Estimado usuario, si ya realizó las correcciones que le solicitaron, por favor haga click en el siguiente botón para enviar el trámite a validación.
							</div>
						</div>
						<div class="col-lg-12">	
							<div class="alert alert-success text-center">
								<input type="button"  id="btnSubmitEnviar" name="btnSubmitEnviar" value="Enviar a validación" class="btn btn-success btn-block editProyecto"/>		
							</div>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<?php } ?>
</div>
	<!-- /#page-wrapper -->


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
	<!--FIN Modal para adicionar HAZARDS -->

	