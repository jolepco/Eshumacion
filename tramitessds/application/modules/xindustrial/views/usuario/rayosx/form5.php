
<?php
if((isset($rayosxCategoria->categoria) && $rayosxCategoria->categoria == 1))
{
    $categoria_form = $rayosxCategoria->categoria;
	$display_form4_1 = "display:block";
	$display_form4_2 = "display:none";
}else if((isset($rayosxCategoria->categoria) && $rayosxCategoria->categoria == 2)){
    $categoria_form = $rayosxCategoria->categoria;
	$display_form4_2 = "display:block";
	$display_form4_1 = "display:none";
}else{
	$categoria_form = 1;
	$display_form4_1 = "display:none";
	$display_form4_2 = "display:none";
}

if($this->session->userdata('tipo_identificacion') == 1){
	$display_cedula = "display:block";
	$display_rut = "display:block";
	$display_camara = "display:none";
}else{
	$display_rut = "display:block";
	$display_cedula = "display:none";
	$display_camara = "display:block";
}


?>
<div id="paso5" class="row-center shadow-lg p-3 mb-5 bg-white rounded ">
<!-- Equipos generadores de radiación ionizante -->
<form id="formSeccion5-1" name="formSeccion5" action="<?php echo base_url('xindustrial/editarDocumentos1')?>" method="post" class="form-row" enctype="multipart/form-data" style="<?php echo $display_form4_1?>">
   <!-- PRIMERA PARTE DEL REGISTRO DE LA SOLICITUD - LOCALIZACION tipoTramite  -->

       <div class="subtitle">
           <h3>Documentos Adjuntos:</h3>
       </div>
       <h4><span class="text-orange">•</span>Documentos Categoría I</h4>
         <input id="categoria_docs" name="categoria_docs" type="hidden" value="<?php echo $categoria_form?>">
		<div class="col-12 col-md-12 table-responsive">
		   <table class="table table-hover">
			   <thead>
				  <tr>
					 <th>Descripción</th>
					 <th>Cargar Documento</th>
					 <th>Documento Cargado</th>
				  </tr>
			   </thead>
			   <tbody>
			   <?php

				   if($display_cedula == 'display:block'){
					   ?>
					   <tr>
						 <td>Fotocopia documento de identificación</td>
						 <td>
						 <?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pn_doc");
						  ?>
						   <input id="pn_doc" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="pn_doc" type="file" class="archivopdf ">
						   </td>
						   <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					   </tr>
					   <?php
				   }


				   if($display_cedula == 'display:block'){
					   ?>
					   <tr>
						 <td>Fotocopia del Registro Unico Tributario - RUT</td>
						 <td>
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pj_doc");
							?>
						   <input id="pj_doc" <?php if(!$resultado_archivo){ echo 'required'; } ?>  name="pj_doc" type="file" class="archivopdf "></td>
						<td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					   </tr>
					   <?php
				   }

				   if($display_camara == 'display:block'){
					   ?>
					   <tr>
						 <td>Registro Camara y comercio o certificado de representación legal</td>
						 <td>
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pj_cyc");
							?>
						   <input id="pj_cyc" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="pj_cyc" type="file" class="archivopdf "></td>
						<td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					   <?php
				   }
				   ?>

				  <tr>
          <?php
            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_doc_encargado");
          ?>
					 <td>Copia documento identificación del encargado de protección radiológica</td>
					 <td>

					   <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
					   <input id="fi_doc_encargado" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_doc_encargado" type="file" class="archivopdf "></td>
					   <td>
						<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
				  </tr>
				  <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_encargado");
						?>
					 <td>Copia del diploma del encargado de protección radiológica</td>
					 <td><input id="fi_diploma_encargado" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_encargado" type="file" class="archivopdf "></td>
					 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
				  </tr>

				  <tr>
				  		<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_registro_dosimetrico");
						?>
					 <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos</td>
					 <td><input id="fi_registro_dosimetrico" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_registro_dosimetrico" type="file" class="archivopdf "></td>
					 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
				  </tr>
          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_constancia_toe");
						?>
					 <td>Constancia de asistencia a curso de portección radiológica, de los trabajadores ocupacionalmente expuestos.</td>
					 <td><input id="fi_constancia_toe"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_constancia_toe" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>

          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_constancia_equipo");
						?>
					 <td>Constancia de asistencia a cursos sobre el manejo de los equipos generadores de radiación ionizante.</td>
					 <td><input id="fi_constancia_equipo"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_constancia_equipo" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>
				  <?php

					if($tramite_info->visita_previa == 1){

					   $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_soporte_talento");
					   ?>
					   <tr class="docu_talento">
						 <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo 1 del artículo 21</td>
						 <td><input id="fi_soporte_talento" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_soporte_talento" type="file" class="archivopdf "></td>
						 <td>
							<?php

								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_director");
							?>
						 <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
						 <td><input id="fi_diploma_director" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_director" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_res_convalida_director");
							?>
						 <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico  </td>
						 <td><input id="fi_res_convalida_director" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_res_convalida_director" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_pos_profe");
							?>
						 <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
						 <td><input id="fi_diploma_pos_profe" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_pos_profe" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_res_convalida_profe");
							?>
						 <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad  </td>
						 <td><input id="fi_res_convalida_profe" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_res_convalida_profe" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_cert_calibracion");
							?>
						 <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
						 <td><input id="fi_cert_calibracion" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_cert_calibracion" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_declaraciones");
							?>
						 <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
						 <td><input id="fi_declaraciones" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_declaraciones" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					   <?php
				   }

				   ?>


			   </tbody>
			</table>
		</div>
        <div id="btnGuardarDocumentos" class="col-md-12 pt-200">
           <p align="center">
              <br/>
              <!-- Primer Collapsible - Localizacion Entidad -->
              <button type="submit" class="btn btn-warning">
                 Guardar Documento
              </button>
           </p>
         </div>
</form>

<!-- Equipos generadores de radiación ionizante -->
<form id="formSeccion5-2" name="formSeccion5" action="<?php echo base_url('xindustrial/editarDocumentos2')?>" method="post" class="form-row" enctype="multipart/form-data"  style="<?php echo $display_form4_2?>">
   <!-- PRIMERA PARTE DEL REGISTRO DE LA SOLICITUD - LOCALIZACION tipoTramite  -->

       <div class="subtitle">
           <h3>Documentos Adjuntos:</h3>
       </div>
       <h4><span class="text-orange">•</span>Documentos Categoría II</h4>
        <input id="categoria_docs" name="categoria_docs" type="hidden" value="<?php echo $categoria_form?>">
		<div class="col-12 col-md-12 table-responsive">
			<table class="table table-hover">
			   <thead>
				  <tr>
					 <th width="50%">Descripción</th>
					 <th width="30%">Documento</th>
					 <th width="20%">Documento Cargado</th>
				  </tr>
			   </thead>
			   <tbody>
				 <?php
				   if($display_cedula == 'display:block'){
					$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pn_doc");
					   ?>
					   <tr>
						 <td>Fotocopia documento de identificación</td>
						 <td>
						   <input id="pn_doc2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="pn_doc" type="file" class="archivopdf ">
						   </td>
						   <td>
							<?php

								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
									<?php
								}
							?>
						   </td>
					   </tr>
					   <?php
				   }


				   if($display_rut == 'display:block'){
					   $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pj_doc");
					   ?>
						<tr>
							<td>Fotocopia del Registro Unico Tributario - RUT</td>
							<td>
							   <input id="pj_doc2" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="pj_doc" type="file" class="archivopdf ">
							</td>
							<td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
									<?php
								}
							?>
						   </td>
						</tr>
					   <?php
				   }

				   if($display_camara == 'display:block'){
					$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "pj_cyc");
					   ?>
					   <tr>
						 	<td>Registro Camara y comercio</td>
						 	<td>
						   		<input id="pj_cyc2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="pj_cyc" type="file" class="archivopdf ">
							</td>
							<td>
							<?php

								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
									<?php
								}
							?>
						   </td>
					  </tr>
					   <?php
				   }
				   ?>
				  <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_doc_oficial");
						?>
					 <td>Copia documento identificación del oficial de protección radiológica</td>
					 <td>
					   <input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php if(isset($tramite_info)){echo $tramite_info->id;}?>">
					   <input id="fi_doc_oficial"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_doc_oficial" type="file" class="archivopdf "></td>
					   <td>
						<?php
							if($resultado_archivo){
						?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>
				  <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_oficial");
						?>
					 <td>Copia del diploma del oficial de protección radiológica</td>
					 <td><input id="fi_diploma_oficial"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_oficial" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>
          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_registro_dosimetrico");
						?>
					 <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos.</td>
					 <td><input id="fi_registro_dosimetrico2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_registro_dosimetrico" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>
          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_constancia_toe");
						?>
					 <td>Constancia de asistencia a curso de portección radiológica, de los trabajadores ocupacionalmente expuestos.</td>
					 <td><input id="fi_constancia_toe2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_constancia_toe" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>

          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_constancia_equipo");
						?>
					 <td>Constancia de asistencia a cursos sobre el manejo de los equipos generadores de radiación ionizante.</td>
					 <td><input id="fi_constancia_equipo2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_constancia_equipo" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>

          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_capacitacion_radiologica");
						?>
					 <td>Programa de capacitación en protección radiológica.</td>
					 <td><input id="fi_capacitacion_radiologica"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_capacitacion_radiologica" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>

          <tr>
						<?php
							$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_evaluacion");
						?>
					 <td>Evaluación de Emergencias</td>
					 <td><input id="fi_evaluacion"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_evaluacion" type="file" class="archivopdf "></td>
					 <td>
						<?php
							if($resultado_archivo){
								?>
								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
								</a>
								<?php
							}
						?>
					   </td>
				  </tr>
					<?php
					if($tramite_info->visita_previa  == 1){
						$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_soporte_talento");
					?>
					   <tr class="docu_talento">
						 <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo del articulo 23</td>
						 <td><input id="fi_soporte_talento2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_soporte_talento" type="file" class="archivopdf " ></td>
						<td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_director");
							?>
						 <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
						 <td><input id="fi_diploma_director2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_director" type="file" class="archivopdf "></td>
						 <td>
							<?php

								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
						<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_res_convalida_director");
						?>
						 <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico  </td>
						 <td><input id="fi_res_convalida_director2" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_res_convalida_director" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_diploma_pos_profe");
							?>
						 <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
						 <td><input id="fi_diploma_pos_profe2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_diploma_pos_profe" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_res_convalida_profe");
							?>
						 <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad  </td>
						 <td><input id="fi_res_convalida_profe2"  <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_res_convalida_profe" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_cert_calibracion");
							?>
						 <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
						 <td><input id="fi_cert_calibracion2" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_cert_calibracion" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					  <tr class="docu_talento">
							<?php
								$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramite_info->id, "fi_declaraciones");
							?>
						 <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
						 <td><input id="fi_declaraciones2" <?php if(!$resultado_archivo){ echo 'required'; } ?> name="fi_declaraciones" type="file" class="archivopdf "></td>
						 <td>
							<?php
								if($resultado_archivo){
									?>
									<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
										<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
									</a>
									<?php
								}
							?>
						</td>
					  </tr>
					   <?php
				   }
					   ?>

			   </tbody>
			</table>
		</div>
        <div id="btnGuardarDocumentos" class="col-md-12 pt-200">
           <p align="center">
              <br/>
              <!-- Primer Collapsible - Localizacion Entidad -->
              <button type="submit" class="btn btn-warning">
                 Guardar Documento
              </button>
           </p>
         </div>
    
</form>
</div>