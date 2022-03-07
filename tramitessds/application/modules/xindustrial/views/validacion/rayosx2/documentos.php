
<div class="row">
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

if($tramites_pendientes->tipo_identificacion != 5){
	$display_cedula = "display:block";
	$display_rut = "display:none";
}else{
	$display_rut = "display:block";
	$display_cedula = "display:none";
}

if($tramite_info->visita_previa == 1){
	$display_docTalento = "display:block";
}else{
	$display_docTalento = "display:none";
}

       /* echo "<pre>";
        print_r($documentosTramite);
        echo "</pre>";*/

?>
    <div class="row">
<?php
if(!empty($visita1Tramite->archivo_visita)){
?>
  <div class="col-md-12">
      <label><font class="text-danger">(*)</font> Fecha 1er visita</label>
      <input type="date" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $visita1Tramite->fecha_visita?>" class="form-control form-control-sm validate[required]">
  </div>
  <div class="col-md-12">
      <label><font class="text-danger">(*)</font> Observaciones de la Visita</label>
      <textarea id="observaciones_visita" name="observaciones_visita" placeholder="Observaciones Visita" class="form-control">
      <?php if(isset($visita1Tramite->observaciones_visita)){echo $visita1Tramite->observaciones_visita;}?>
      </textarea>
  </div>
<?php
}
if(!empty($visita2Tramite->archivo_visita)){
?>
  <div class="col-md-12">
      <label><font class="text-danger">(*)</font> Fecha 2da visita</label>
      <input type="date" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $visita2Tramite->fecha_visita?>" class="form-control form-control-sm validate[required]">
  </div>
  <div class="col-md-12">
      <label><font class="text-danger">(*)</font> Observaciones de la Visita</label>
      <textarea id="observaciones_visita2" name="observaciones_visita" placeholder="Observaciones Visita" class="form-control">
      <?php if(isset($visita2Tramite->observaciones_visita)){echo $visita2Tramite->observaciones_visita;}?>
      </textarea>
  </div>
<?php
}
if($tramite_info->tipo_tramite == 2){
    ?>
        <div class="col-md-6">
            <label>Motivo de modificación</label>
            <select readonly name="motivo_modificacion" id="motivo_modificacion" class="form-control validate[required]">
            <option value="">Seleccione...</option>
            <?php
                if($tramites_pendientes->tipo_identificacion != 5){
                    ?>
                    <option value="1" <?php if($tramite_info->id_motivo_modificacion == 1){ echo selected;}?>>Cambio de nombre y/o apellido del titular de la licencia</option>
                    <option value="2" <?php if($tramite_info->id_motivo_modificacion == 2){ echo selected;}?>>Cambio de número y tipo de identificación</option>
                    <option value="3" <?php if($tramite_info->id_motivo_modificacion == 3){ echo selected;}?>>Cambio en el nivel de formación en seguridad y salud en el trabajo</option>
                    <?php
                }else{
                    ?>
                    <option value="4" <?php if($tramite_info->id_motivo_modificacion == 4){ echo selected;}?>>Cambio de Nomenclatura</option>
                    <option value="5" <?php if($tramite_info->id_motivo_modificacion == 5){ echo selected;}?>>Cambio de domicilio</option>
                    <option value="6" <?php if($tramite_info->id_motivo_modificacion == 6){ echo selected;}?>>Apertura de campo(s) de acción adicional(es) al(os) otorgado(s) en la licencia SST</option>
                    <option value="7" <?php if($tramite_info->id_motivo_modificacion == 7){ echo selected;}?>>Cierre temporal o definitivo de campos de acción</option>
                    <option value="8" <?php if($tramite_info->id_motivo_modificacion == 8){ echo selected;}?>>Cambio de Representante Legal</option>
                    <option value="9" <?php if($tramite_info->id_motivo_modificacion == 9){ echo selected;}?>>Apertura de sede</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label><font class="text-danger">(*)</font> Número de resolución objeto de modificación o renovación</label>
            <input readonly type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $tramite_info->num_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
        </div>
        <div class="col-md-6">
            <label><font class="text-danger">(*)</font> Fecha de resolución objeto de modificación o renovación</label>
            <input readonly type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" value="<?php echo $tramite_info->fecha_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
        </div>
    <?php
}else if ($tramite_info->tipo_tramite == 3){
  ?>
      <div class="col-md-6">
          <label><font class="text-danger">(*)</font> Número de resolución objeto de modificación o renovación</label>
          <input readonly type="text" name="num_resolucion_anterior" id="num_resolucion_anterior" value="<?php echo $tramite_info->num_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
      </div>
      <div class="col-md-6">
          <label><font class="text-danger">(*)</font> Fecha de resolución objeto de modificación o renovación</label>
          <input readonly type="date" name="fecha_resolucion_anterior" id="fecha_resolucion_anterior" value="<?php echo $tramite_info->fecha_resolucion_anterior?>" class="form-control form-control-sm validate[required]">
      </div>


<?php
}
?>
</div>

<div class="col-6 col-md-6 table-responsive" style="<?php echo $display_form4_1;?>">
 <h4><b>Documentos Categoría I</b></h4>
		<div class="col-12 col-md-12 table-responsive">
		   <table class="table table-sm table-hover">
			   <thead>
				  <tr>
					 <th>Descripción</th>
					 <th>Cargar Documento</th>
				  </tr>
			   </thead>
			   <tbody>
			   <?php

              $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pn_doc");
              if($resultado_archivo)
              {
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
              <tr>
                  <td>Fotocopia documento de identificación</td>
                  <td>
									<?php
									if($resultado_archivo && $resultado_archivo->nombre != '')
									{
									?>
                    <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                        <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    </a>
                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
									<?php
								   }else{
										echo "Sin archivo";
								   }
									?>
                  </td>
              </tr>
        <?php
				 }



              $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pj_doc");
              if($resultado_archivo)
              {
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
              <tr>
                  <td>Fotocopia del Registro Unico Tributario - RUT</td>
                  <td>
                  <?php
									if($resultado_archivo && $resultado_archivo->nombre != '')
									{
									?>
                      <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                          <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                      </a>
                      <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
									<?php
  							   }else{
  									echo "Sin archivo";
  							   }
									?>
                  </td>
              </tr>
          <?php
 			   }

          $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pj_cyc");
          if($resultado_archivo)
          {
          $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
      ?>
          <tr>
              <td>Registro cámara y comercio</td>
              <td>
              <?php
							if($resultado_archivo && $resultado_archivo->nombre != '')
							{
							?>
                  <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                      <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  </a>
                  <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							<?php
						   }else{
								echo "Sin archivo";
						   }
							?>
              </td>
          </tr>
         <?php
			   }

         $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_doc_encargado");
         if($resultado_archivo)
         {
         $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
         ?>
             <tr>
                  <td>Copia documento identificación del encargado de protección radiológica</td>
                  <td>
                  <?php
							    if($resultado_archivo && $resultado_archivo->nombre != '')
							    {
							    ?>
        							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
        								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
        							</a>
        							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
    							<?php
  							   }else{
  									echo "Sin archivo";
  							   }
							     ?>
                  </td>
              </tr>
        <?php
        }
       $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_encargado");
       if($resultado_archivo)
       {
       $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
         ?>
             <tr>
                  <td>Copia del diploma del encargado de protección radiológica</td>
                  <td>
                  <?php
							     if($resultado_archivo && $resultado_archivo->nombre != '')
							     {
							     ?>
        							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
        								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
        							</a>
        							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							    <?php
  							   }else{
  									echo "Sin archivo";
  							   }
							     ?>
                  </td>
              </tr>
					<?php
        }
				$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_registro_dosimetrico");
        if($resultado_archivo)
        {
        $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                    <tr>
                        <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos</td>
                        <td>
                        <?php
              					if($resultado_archivo && $resultado_archivo->nombre != '')
              					{
              					?>
              							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
              								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
              							</a>
              							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
          							<?php
        							   }else{
        									echo "Sin archivo";
        							   }
          							?>
                        </td>
                    </tr>
                    <?php
            }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_constancia_toe");
        if($resultado_archivo)
        {
        $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                <tr>
                    <td>Constancia de asistencia a curso de portección radiológica, de los trabajadores ocupacionalmente expuestos.</td>
                    <td>
                        <?php
					              if($resultado_archivo && $resultado_archivo->nombre != '')
          							{
          							?>
              							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
              								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
              							</a>
              							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
          							<?php
        							   }else{
        									echo "Sin archivo";
        							   }
          							?>
                    </td>
                </tr>
          <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_constancia_equipo");
        if($resultado_archivo)
        {
        $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
       ?>
             <tr>
                  <td>Constancia de asistencia a cursos sobre el manejo de los equipos generadores de radiación ionizante.</td>
                  <td>
                      <?php
				              if($resultado_archivo && $resultado_archivo->nombre != '')
				              {
        							?>
              						<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
              							<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
              						</a>
              						<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
      							<?php
    							   }else{
    									echo "Sin archivo";
    							   }
      							?>
                  </td>
              </tr>
        <?php
      }

			$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "doc_lic_anteriorR");
      if($resultado_archivo)
      {
      $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Licencia Anterior</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                      </td>
                  </tr>
        <?php
      }

			$resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "doc_lic_anterior");
      if($resultado_archivo)
      {
      $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Licencia Anterior</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                      </td>
                  </tr>
        <?php
      }


      if($tramite_info->visita_previa == 1){
      $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_soporte_talento");
        if($resultado_archivo){
          $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
      ?>
                    <tr>
                        <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo del articulo 23</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>
        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_director");
          if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>
        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_director");
          if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>
        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_pos_profe");
          if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>
        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_profe");
          if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>

        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_cert_calibracion");
          if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
                        </td>
                    </tr>

        <?php
        }

        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_declaraciones");
          if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
        ?>
                    <tr>
                        <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
                        <td>
                            <?php
                            if($resultado_archivo && $resultado_archivo->nombre != '')
                            {
                            ?>
                                <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                  <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                </a>
                                <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                            <?php
                             }else{
                              echo "Sin archivo";
                             }
                            ?>
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

     <div class="col-6 col-md-6 table-responsive" style="<?php echo $display_form4_2;?>">
       <h4><b>Documentos Categoría II</b></h4>
        <input id="categoria_docs" name="categoria_docs" type="hidden" value="<?php echo $categoria_form?>">
		<div class="col-12 col-md-12 table-responsive">
			<table class="table table-hover">
			   <thead>
				  <tr>
					 <th>Descripción</th>
					 <th>Documento</th>
				  </tr>
			   </thead>
			   <tbody>
				 <?php

                  $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pn_doc");
                  if($resultado_archivo)
                  {
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                        <tr>
                            <td>Fotocopia documento de identificación</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
          <?php
                  }


                 $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pj_doc");
                 if($resultado_archivo)
                 {
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                        <tr>
                            <td>Fotocopia del Registro Único Tributario - RUT</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
          <?php
                }



                $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "pj_cyc");
                if($resultado_archivo){
                $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                        <tr>
                            <td>Registro cámara y comercio</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
          <?php
                }


          $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_doc_oficial");
          if($resultado_archivo){
          $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                    <tr>
                        <td>Copia documento identificación del oficial de protección radiológica</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
							                  <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
							              <?php
            							   }else{
            									echo "Sin archivo";
            							   }
							              ?>
                        </td>
                    </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_oficial");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Copia del diploma del oficial de protección radiológica</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                        </td>
                    </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_registro_dosimetrico");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Registros dosimétricos del último periodo de los trabajadores ocupacionalmente expuestos</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                        </td>
                    </tr>

            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_constancia_toe");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Constancia de asistencia a curso de portección radiológica, de los trabajadores ocupacionalmente expuestos</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                        </td>
                    </tr>

            <?php
          }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_constancia_equipo");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Constancia de asistencia a cursos sobre el manejo de los equipos generadores de radiación ionizante</td>
                        <td>
                            <?php
              							if($resultado_archivo && $resultado_archivo->nombre != '')
              							{
              							?>
                  							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                  								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                  							</a>
                  							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
              							<?php
            							   }else{
            									echo "Sin archivo";
            							   }
              							?>
                        </td>
                    </tr>

            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_capacitacion_radiologica");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Programa de capacitación en protección radiológica</td>
                        <td>
                            <?php
                							if($resultado_archivo && $resultado_archivo->nombre != '')
                							{
                							?>
                    							<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    								<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    							</a>
                    							<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                							<?php
              							   }else{
              									echo "Sin archivo";
              							   }
                							?>
                        </td>
                    </tr>
            <?php
            }
            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_evaluacion");
            if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                    <tr>
                        <td>Evaluación de Emergencias</td>
                        <td>
                            <?php
                              if($resultado_archivo && $resultado_archivo->nombre != '')
                              {
                              ?>
                                  <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                    <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                  </a>
                                  <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                              <?php
                               }else{
                                echo "Sin archivo";
                               }
                              ?>
                        </td>
                    </tr>
          <?php
          }
        $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "doc_lic_anteriorR");
          if($resultado_archivo){
            $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                      <tr>
                          <td>Licencia Anterior</td>
                          <td>
                              <?php
                              if($resultado_archivo && $resultado_archivo->nombre != '')
                              {
                              ?>
                                  <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                    <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                  </a>
                                  <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                              <?php
                               }else{
                                echo "Sin archivo";
                               }
                              ?>
                        </td>
                    </tr>
          <?php
          }

          $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "doc_lic_anterior");
            if($resultado_archivo){
          $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Licencia Anterior</td>
                            <td>
                                <?php
                                if($resultado_archivo && $resultado_archivo->nombre != '')
                                {
                                ?>
                                    <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                      <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
                                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                                <?php
                                 }else{
                                  echo "Sin archivo";
                                 }
                                ?>
                          </td>
                      </tr>
            <?php
          }

					if($tramite_info->visita_previa == 1){
          $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_soporte_talento");
            if($resultado_archivo){
              $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
          ?>
                        <tr>
                            <td>Documentación de soporte de talento humano e infraestructura técnica. En el evento contemplado en el parágrafo del articulo 23</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
								                ?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_director");
              if($resultado_archivo){
                $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Fotocopia de Diploma de Posgrado del Director Técnico</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_director");
              if($resultado_archivo){
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del Director Técnico</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_diploma_pos_profe");
              if($resultado_archivo){
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Fotocopia de Diploma de posgrado del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_res_convalida_profe");
              if($resultado_archivo){
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Fotocopia de la Resolución de convalidación del t&iacute;tulo ante el Ministerio de Educación Nacional - MEN del (los) profesional(es) que realiza(n) control de calidad</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>

            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_cert_calibracion");
              if($resultado_archivo){
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Certificados de calibración con una vigencia superior a seis (6) meses por cada equipo reportado</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>

            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "fi_declaraciones");
              if($resultado_archivo){
                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Declaraciones de primera parte por cada objeto de prueba reportado</td>
                            <td>
                                <?php
                								if($resultado_archivo && $resultado_archivo->nombre != '')
                								{
                								?>
                    								<a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                    									<img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                    								</a>
                    								<img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                								<?php
              								   }else{
              										echo "Sin archivo";
              								   }
                								?>
                            </td>
                        </tr>
              <?php
              }

				   }

           if($tramites_pendientes->categoria == 2){
             $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "resultado_visita1");
             if($resultado_archivo){

             ?>
            <tr>
              <td colspan="2">Documento 1er Visita </td>
            </tr>
            <?php


                  $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
            ?>
                        <tr>
                            <td>Acta de la visita</td>
                            <td>
                                <?php
                                if($resultado_archivo && $resultado_archivo->nombre != '')
                                {
                                ?>
                                    <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                      <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    </a>
                                    <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                                <?php
                                 }else{
                                  echo "Sin archivo";
                                 }
                                ?>
                            </td>
                        </tr>
            <?php
            }

            $resultado_archivo = $this->xindustrial_model->consultar_archivo($tramites_pendientes->id, "resultado_visita2");
            if($resultado_archivo){

            ?>
           <tr>
             <td colspan="2">Documento 2da Visita </td>
           </tr>
           <?php


                 $visorFilePdf=base_url('uploads/xindustrial/'.$resultado_archivo->nombre);
           ?>
                       <tr>
                           <td>Acta de la visita</td>
                           <td>
                               <?php
                               if($resultado_archivo && $resultado_archivo->nombre != '')
                               {
                               ?>
                                   <a href="<?php echo base_url('uploads/xindustrial/'.$resultado_archivo->nombre)?>" target="_blank">
                                     <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                   </a>
                                   <img title="<?php echo $visorFilePdf?>"  style="cursor: pointer;" class="actualizarVisorAction" src="<?php echo base_url('assets/imgs/pdfVisor.png')?>" width="40px" />
                               <?php
                                }else{
                                 echo "Sin archivo";
                                }
                               ?>
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

	<div class="col-6 col-md-6 " style="height: 600px;" id="divdatoarchvisor">
		<iframe id="visorPdf" style="height: 100%; width: 100%;" src=""></iframe>
	</div>

</div>
