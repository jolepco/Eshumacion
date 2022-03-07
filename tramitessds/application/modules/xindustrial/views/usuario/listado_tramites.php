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

<div class="text-center">
    <h3 class="text-info"><b>Licencia de equipos industriales, veterinaria o de investigación</b></h3>
</div>
<div class="row p-4">
    <div class="col-md-12 text-center">
        <a href="<?php echo base_url('xindustrial/rx_crear_tramite')?>" class="btn btn-info">Nuevo Trámite</a>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
        <table class="table" id="tabla_tramites2">
            <thead>
              <tr>
                  <th> Id Trámite </th>
                  <th> Tipo Trámite </th>
                  <th> Inicio Trámite </th>
                  <th> Estado </th>
                  <th> Fecha Estado </th>
                  <th> Categoría </th>
                  <th>Editar Tr&aacute;mite</th>
                  <th>Ver PDF</th>
                  <th>Tiempo</th>
              </tr>
            </thead>
            <tbody>
                <?php

                for($i=0;$i<count($mistramites_rx);$i++){

                    //$estado_obs = $this->sst_model->sst_flujo_tramite($tramites_pen[$i]->id_tramite,$tramites_pen[$i]->id_estado);

                ?>
                <tr>
                    <td><?php echo $mistramites_rx[$i]->id;
                        if ($mistramites_rx[$i]->estado == '1') {
                            ?>
                            <br>
                            <a class="btn btn-danger" href="#" onClick="anularTramite(<?php echo $mistramites_rx[$i]->id?>)">Anular</a>
                            <?php

                        }

                    ?>
                    </td>
                    <td><?php echo $mistramites_rx[$i]->descripcion ?></td>
                    <td><?php echo $mistramites_rx[$i]->created_at ?></td>
                    <td><?php echo $mistramites_rx[$i]->estadoDesc ?></td>
                    <td><?php echo $mistramites_rx[$i]->fecha_estado ?></td>
                    <td><?php echo $mistramites_rx[$i]->categoria?></td>



                <?php
                if ($mistramites_rx[$i]->estado == '1') {
                ?>
                    <td>
                        <a href="<?php echo base_url('xindustrial/rx_editarForm/' . $mistramites_rx[$i]->id) ?>">
                        <img src="<?php echo base_url('assets/imgs/editar.png') ?>" width="25px"></a>
                    </td>

                    <td></td>
                    <td></td>
                <?php
              }else if($mistramites_rx[$i]->estado == '13'){

                  $archivoTram = $this->xindustrial_model->consultar_archivo_equipo($mistramites_rx[$i]->id_archivo);
                  $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($mistramites_rx[$i]->id);
                  $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($mistramites_rx[$i]->id);
                  ?>
                  <td>
                      <a href="<?php echo base_url('xindustrial/rx_editarForm/' . $mistramites_rx[$i]->id) ?>">
                      <img src="<?php echo base_url('assets/imgs/editar.png') ?>" width="25px"></a>

                  </td>
                  <td class="row">
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      if($archivoVisita){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita2){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      ?>
                  </td>
                      <td>

                      <?php

                      if($mistramites_rx[$i]->estado == '13')
                      {
                          $exd = date_create($mistramites_rx[$i]->fecha_estado);
                          $fecha_radicado = date_format($exd,"Y-m-d");//here you make mistake
                          $from = $fecha_radicado;

                          $to = date('Y-m-d');
                          $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
                          $holidayDays = ['*-12-25', '*-01-01', '*-05-01', '*-07-20', '*-08-07', '2019-08-19', '2019-03-25', '2019-04-18', '2019-04-19', '2019-06-03', '2019-06-24']; # variable and fixed holidays

                          $from = new DateTime($from);


                          $tiempo_validacion = 20;


                          $to = new DateTime($to);
                          $to->modify('+0 day');
                          $interval = new DateInterval('P1D');
                          $periods = new DatePeriod($from, $interval, $to);

                          $days = 0;
                          foreach ($periods as $period) {
                              if (!in_array($period->format('N'), $workingDays)) continue;
                              if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
                              if (in_array($period->format('*-m-d'), $holidayDays)) continue;
                              $days++;
                          }


                          if($tiempo_validacion == 20){
                              if($days > $tiempo_validacion){
                                $dataflujo['tramite_id'] = $mistramites_rx[$i]->id;
                  						  $dataflujo['id_usuario'] = $this->session->userdata('id_usuario');
                  						  $dataflujo['id_estado'] = '20';
                  						  $dataflujo['fecha_estado'] = date('Y-m-d H:i:s');
                  						  $dataflujo['observaciones'] = 'Vencimiento Subsanación';
                                $dataAct['id_tramite'] = $mistramites_rx[$i]->id;
                                $dataAct['estado'] = '20';
                                $resultRayosxEstado = $this->xindustrial_model->actualizarEstado2($dataAct);
                  						  $resultadoCrearTramiteFlujo = $this->xindustrial_model->crear_tramite_flujo($dataflujo);

                                  echo '<div class="alert alert-danger" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> <br>El trámite se encuentra vencido. Días transcurridos '.$days.'</div>';
                                  echo '<div class="alert alert-info" role="alert" style="font-size:10px;">faltan'.$faltan.' tiempo validacion'.$tiempo_validacion.' dias'.$days.'</div>';
                              }else if($days > 15 && $days <=20){
                                  $faltan= $tiempo_validacion - $days;
                                  echo '<div class="alert alert-warning" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> Trámite Proximo a vencerse. Quedan '.$faltan.' d&iacute;as.<br> Días transcurridos  '.$days.'</div>';
                              }else if($days > 11 && $days <=15){
                                  $faltan= $tiempo_validacion - $days;
                                  echo '<div class="alert alert-success" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Estos son los días transcurridos '.$days.'</div>';
                              }else if($days <=10 && $days < 1){
                                  $faltan= $tiempo_validacion - $days;
                                  echo '<div class="alert alert-info" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Días transcurridos '.$days.'</div>';
                              }
                          }

                      }
                      ?>
                      </td>
                      <?php
              }else if($mistramites_rx[$i]->estado == '10'){

                  $archivoTram = $this->xindustrial_model->consultar_archivo_aprobacion($mistramites_rx[$i]->id);
                  $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($mistramites_rx[$i]->id);
                  $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($mistramites_rx[$i]->id);
                  $archivoSubsanacion = $this->xindustrial_model->consultar_archivo_subsanacion($mistramites_rx[$i]->id);
                  ?>
                  <td></td>
                  <td class="row">
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      if($archivoSubsanacion){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoSubsanacion->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita2){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      ?>
                  </td>

                  <td></td>
                  <?php

              }else if($mistramites_rx[$i]->estado == '14' || $mistramites_rx[$i]->estado == '5' || $mistramites_rx[$i]->estado == '6' || $mistramites_rx[$i]->estado == '9' || $mistramites_rx[$i]->estado == '11' ){
                  $archivoSubsanacion = $this->xindustrial_model->consultar_archivo_subsanacion($mistramites_rx[$i]->id);
                  $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($mistramites_rx[$i]->id);
                  $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($mistramites_rx[$i]->id);
                  ?>
                  <td></td>
                  <td class="row">  <?php
                      if($archivoSubsanacion){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoSubsanacion->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita2){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      ?>
                  </td>

                  <td></td>
                  <?php

              }else if($mistramites_rx[$i]->estado == '12'){

                  $archivoTram = $this->xindustrial_model->consultar_archivo_negacion($mistramites_rx[$i]->id);
                  $archivoSubsanacion = $this->xindustrial_model->consultar_archivo_subsanacion($mistramites_rx[$i]->id);
                  $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($mistramites_rx[$i]->id);
                  $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($mistramites_rx[$i]->id);
                  ?>
                  <td></td>
                  <td class="row">
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoTram->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      if($archivoSubsanacion){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoSubsanacion->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita2){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      ?>
                  </td>

                  <td></td>
                  <?php

              }else if($mistramites_rx[$i]->estado == '41' || $mistramites_rx[$i]->estado == '21'  || $mistramites_rx[$i]->estado == '22' || $mistramites_rx[$i]->estado == '23'){
                  
                  $archivoVisita = $this->xindustrial_model->consultar_archivo_avisita($mistramites_rx[$i]->id);
                  $archivoVisita2 = $this->xindustrial_model->consultar_archivo_avisita2($mistramites_rx[$i]->id);
				  $archivoSubsanacion = $this->xindustrial_model->consultar_archivo_subsanacion($mistramites_rx[$i]->id);
                  ?>
                  <td></td>
                  <td class="row">

                      <?php
                      if($archivoSubsanacion){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/resoluciones/' . $archivoSubsanacion->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }if($archivoVisita){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      if($archivoVisita2){
                        ?>
                      <a href="<?php echo base_url('uploads/xindustrial/' . $archivoVisita2->nombre) ?>" target="_blank"><img src="<?php echo base_url('assets/imgs/pdf.png') ?>"  width="25px"></a>
                      <?php
                      }
                      ?>
                  </td>

                  <td></td>
                  <?php

              }
              else{
                ?>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php
              }

                ?>
            </tr>
        <?php
        }

?>
            </tbody>
            </table>
    </div>
</div>