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
					<i class="fa fa-folder-open"></i> Estado de mi trámite
				</div>
				<div class="panel-body">
					<?php
					if($info){
						if ($info[0]->id_estado!=13 && $info[0]->email!=''){
							$disabled="disabled='disabled'";
						}else{
							$disabled='';
						}
					?>	
						<button type="button" class="btn btn-success btn-block editar" data-toggle="modal" data-target="#modal" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos personales
						</button><br>
						<br>
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

						if ($info[0]->id_estado==4 || $info[0]->id_estado==19 || $info[0]->id_estado==11) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success text-center">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo 'Descargue aqu&iacute; su credencial <br>
									<a href="'.base_url('expendedor_droga/resoluciones').'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
									?>	
								</div>
							</div>
							<div class="col-12 col-md-12">
							<br>
								<div class="alert alert alert-info" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<b>Apreciado Usuario!</b>
									<p>Si se presenta alguna inconsistenca en la presente credencial, puede presentar un recurso de aclaraci&oacute;n haciendo clilck en el siguiente bot&oacute;n:</p>
								</div>
							</div>
							<div class="col-lg-12 text-center">	
								<button type="button" class="btn btn-success aclaracion" data-toggle="modal" data-target="#modal">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Presentar recurso de aclaraci&oacute;n
								</button><br><br>
							</div>
							<?php
						}
						if ($info[0]->id_estado==7) {
							?>
							<div class="col-lg-12">	
								<div class="alert alert-success text-center">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<?php echo 'Resoluci&oacute;n de negaci&oacute;n <br>
									<a href="'.base_url('expendedor_droga/resoluciones').'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
									?>	
								</div>
							</div>
							<div class="col-12 col-md-12">
							<br>
								<div class="alert alert alert-info" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									<b>Apreciado Usuario!</b>
									<p>Debido a que su tr&aacute;mite fue negado, puede presentar un recurso de reposicion haciendo clilck en el siguiente bot&oacute;n:</p>
								</div>
							</div>
							<div class="col-lg-12 text-center">	
								<button type="button" class="btn btn-success reposicion" data-toggle="modal" data-target="#modal">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Presentar recurso de reposici&oacute;n
								</button><br><br>
							</div>
						<?php
						}
						?> 
						
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
							<thead>
								<tr>
									<th class="text-center">No. trámite</th>
									<th class="text-center">Nombres Completo</th>
									<th class="text-center">Número de documento</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Correo</th>
									<th class="text-center">Estado trámite</th>
									<th class="text-center">Observacioes</th>
									<!--<th class="text-center">Editar</th>-->
								</tr>
							</thead>
							<tbody>							
								<?php
								foreach ($info as $lista):
									//echo "MMM".$info ."as". $lista;
									echo "<tr>";
										echo "<td>&nbsp;&nbsp;&nbsp;" . $info[0]->id_expdrogas_tramite . "</td>";
										echo "<td>&nbsp;" . $info[0]->p_nombre . " ". $info[0]->p_apellido . "</td>";
										echo "<td class='text-center'>" . $info[0]->nume_identificacion . "</td>";
										echo "<td class='text-center'>" . $info[0]->telefono_celular . "</td>";
										echo "<td>" . $info[0]->email . "</td>";
										echo "<td class='text-center'>";

											switch ($info[0]->id_estado) {
												case 1:
													$valor = 'Registrado';
													$clase = "text-primary";
												break;
												case 2:
												case 3:
													$valor = 'En trámite';
													$clase = "text-success";
												break;
												case 4:
													$valor = 'Aprobado';
													$clase = "text-success";
												break;
												case 5:
												case 6:
												case 7:
													$valor = 'Negado';
													$clase = "text-danger";
												break;
												case 8:
													$valor = 'Solicitud de recurso de reposición';
													$clase = "text-primary";
												break;
												case 9:
													$valor = 'En trámite';
													$clase = "text-success";
												break;
												case 10:
													$valor = 'En trámite';
													$clase = "text-success";
												break;
												case 11:
													$valor = 'Resuelve recurso de reposición firma';
													$clase = "text-success";
												break;
												case 12:
													$valor = 'Solicitud de recurso de aclaración';
													$clase = "text-primary";
												break;
												case 13:
													$valor = 'Se requiere mas informaci&oacute;n';
													$clase = "text-warning";
												break;
												case 17:
													$valor = 'En trámite';
													$clase = "text-success";
												break;
												case 18:
													$valor = 'En trámite';
													$clase = "text-success";
												break;
												case 19:
													$valor = 'Resuelve recurso de aclaración firma';
													$clase = "text-success";
												break;
												case 23:
													$valor = 'Subsanado';
													$clase = "text-primary";
												break;
											}
											echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
										echo "</td>";
										
										
										echo "<td>" . $info[0]->observaciones . "</td>";
									echo "</tr>";
								endforeach;
								?>
							</tbody>
						</table>

					<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<?php
	if($info[0]->id_estado==4 || $info[0]->id_estado==7) {
		echo "";
	}else{
		?>
		<!-- /.row -->
		<fieldset class="header-form">
			<div class="modal-header">
			     <legend>Documentos registrados</legend>
				<div class="row">
				  <div class="col-sm-2">Id documento</div>
				  <div class="col-sm-4">Descripci&oacute;n</div>
				  <div class="col-sm-2">Ver documento</div>
				  <div class="col-sm-2">Estado del documento</div>
				  
				</div>
			</div>
			<div class="modal-body">
				<?php
				if($info){
					for($i=0; $i<=count($archivos)-1; $i++){
						$nombre=explode('-', $archivos[$i]['nombre']);
						$corregir='<button type="button" class="btn btn-danger btn-xs corregirPDF" data-toggle="modal" data-target="#modal1" id="'.$archivos[$i]['id_archivo'].'" >
							Corregir <span class="glyphicon glyphicon-edit" aria-hidden="true">
							</button>';
						$ruta='<a href="'.base_url('expendedor_droga/abrir_pdf/'.$archivos[$i]['id_archivo']).'" target="_blank"><img src="'. base_url('assets/imgs/pdf.png').'" width="30px"></a>';
										
						echo '<div class="row">
						  	<div class="col-sm-2">'.$archivos[$i]['id_archivo'].'</div>
						 	<div class="col-sm-4">'.$nombre[1].'</div>
						  	<div class="col-sm-2">'; 
					  		if($archivos[$i]['condicion']=="2"){
					  			echo $corregir;
					  		}else{
					  			echo $ruta;
					  		}	
					  		
						echo '</div>
						  	<div class="col-sm-2">';
							  	switch ($archivos[$i]['condicion']) {
									case 0:
									$clase = '<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"> Registrado</span></button>';
									break;
									case 1:
									$clase = '<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-check"> Si cumple</span></button>';
									break;
									case 2:
									$clase = '<button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"> No cumple</span></button>';
									break;
								}
								echo '<p>'.$clase.'</p>';
						  	echo '</div>
					  
						</div>';
					}
				} 
				?>
			</div>
		</fieldset>
		<?php
	}
	?>
</div>
	<!-- /#page-wrapper -->


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
		
	</div>
	
</div>
<div class="modal fade text-center" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos1">
			
		</div>
	</div>
 </div>                   
	<!--FIN Modal para adicionar HAZARDS -->

	