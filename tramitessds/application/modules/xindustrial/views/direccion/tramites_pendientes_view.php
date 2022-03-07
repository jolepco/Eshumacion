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

		<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-4">
                <div class="subtitle">
                    <h2><b>Trámites pendientes de validar.</b></h2>
					<h3>Licencia de equipos industriales, veterinaria o de investigación</h3>
                </div>
            </div>

            <div class="col-12 col-md-12">
					<table class="table" id="tabla_tramites" style="font-size:small;">
                        <thead>
                            <tr>
                                <th>ID Trámite</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Fecha radicaci&oacute;n</th>
                                <th>Estado</th>
								<th>Fecha estado</th>

                                <th>Tiempo de respuesta</th>
								<th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(count($rayosx_pendientes)>0){
                                for($i=0;$i<count($rayosx_pendientes);$i++){
                                ?>
                            <tr>
                                <td>
                                    <?php
										echo $rayosx_pendientes[$i]->id;
									/*if(!empty($rayosx_pendientes[$i]->fecha_editado)){
										echo '<i class="fas fa-exclamation-circle" alt="Trámite Editado"></i><font color="black" font-family="sans-serif;">Ajustado</font> ';
									} */
									?>
                                </td>
                                <td>
                                    <?php echo $rayosx_pendientes[$i]->descTipoIden." - ".$rayosx_pendientes[$i]->nume_identificacion?>
                                </td>
                                <td>
                                    <?php
										if($rayosx_pendientes[$i]->tipo_identificacion == 5){
											echo $rayosx_pendientes[$i]->nombre_rs;
										}else{
											echo $rayosx_pendientes[$i]->p_nombre." ".$rayosx_pendientes[$i]->s_nombre." ".$rayosx_pendientes[$i]->p_apellido." ".$rayosx_pendientes[$i]->s_apellido;
										}
									?>
                                </td>
                                <td>
                                    <?php echo $rayosx_pendientes[$i]->categoria; ?>
                                </td>
								<td>
                                    <?php echo $rayosx_pendientes[$i]->fecha_envio?>
                                </td>
                                <td>
                                    <?php echo $rayosx_pendientes[$i]->descEstado?>
                                </td>
								<td>
                                    <?php echo $rayosx_pendientes[$i]->fecha_estado?>
                                </td>

                                <td>
                                    <?php
									$estadosCoordinador = array(9,11,15,16);
									if(in_array($rayosx_pendientes[$i]->estado, $estadosCoordinador)){
										$from = $rayosx_pendientes[$i]->fecha_envio;
										$to = date('Y-m-d');
										$workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
										$holidayDays = array();
										for($ff = 0;$ff<count($festivos);$ff++){
											array_push($holidayDays,$festivos[$ff]->fecha);
										}

										$from = new DateTime($from);
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

										$tiempo_validacion = 20;

										if($days > $tiempo_validacion){
											echo '<div class="alert alert-danger" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> <br>El trámite se encuentra vencido. Días transcurridos '.$days.'</div>';
										}else if($days >= 17 && $days <=20){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-warning" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> Trámite Proximo a vencerse. Quedan '.$faltan.' d&iacute;as.<br> Días transcurridos  '.$days.'</div>';
										}else if($days >= 11 && $days <17){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-success" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Días transcurridos '.$days.'</div>';
										}else if($days <= 10){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-info" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Estos son los días transcurridos '.$days.'</div>';
										}
									}
                                    ?>
                                </td>
								<td>
                                   <?php

											$estadosDirector = array(9,11,15,16);
											if(in_array($rayosx_pendientes[$i]->estado, $estadosDirector)){
                                                ?>
                                                <center>
                                                  <a href="<?php echo base_url('xindustrial/direccion/validar_documentos_rx/'.$rayosx_pendientes[$i]->id)?>">
                                                    <img src="<?php echo base_url('assets/imgs/aprobar.png')?>" width="40px">
                                                    <br>Validar Informaci&oacute;n
                                                    </a>
                                                </center>
                                                <?php
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
