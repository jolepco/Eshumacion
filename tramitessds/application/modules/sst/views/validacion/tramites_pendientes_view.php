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
					<h3>Licencia para prestación de servicios en Seguridad y Salud en el Trabajo</h3>
                </div>
            </div>
			
            <div class="col-12 col-md-12">
					<table class="table" id="tabla_tramites" style="font-size:small;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID Trámite</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Tipo Trámite</th>
                                <th>Fecha radicaci&oacute;n</th>                                
                                <th>Estado</th>
								<th>Fecha estado</th>                                
                                <th>Tiempo de respuesta</th>
								<th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        /*echo "<pre>";
                            print_r($tramites_pendientes);
                        echo "</pre>";*/

                        if(count($tramites_pendientes)>0){

                                for($i=0;$i<count($tramites_pendientes);$i++){  

                                    $estado_obs = $this->sst_model->sst_flujo_tramite($tramites_pendientes[$i]->id_tramite,$tramites_pendientes[$i]->id_estado);    
                                                           
                                ?>
                            <tr>
                                <td>
                                    <?php 
										echo $tramites_pendientes[$i]->id_tramite;
									/*if(!empty($rayosx_pendientes[$i]->fecha_editado)){ 
										echo '<i class="fas fa-exclamation-circle" alt="Trámite Editado"></i><font color="black" font-family="sans-serif;">Ajustado</font> ';
									} */										
									?>
                                </td>
                                <td>
                                    <?php echo $tramites_pendientes[$i]->descTipoIden." - ".$tramites_pendientes[$i]->nume_identificacion?>
                                </td>
                                <td>
                                    <?php 
										if($tramites_pendientes[$i]->tipo_identificacion == 5){
											echo $tramites_pendientes[$i]->nombre_rs;
										}else{
											echo $tramites_pendientes[$i]->p_nombre." ".$tramites_pendientes[$i]->s_nombre." ".$tramites_pendientes[$i]->p_apellido." ".$tramites_pendientes[$i]->s_apellido;
										}
									?>
                                </td>                                
                                <td>
                                    <?php 
                                        if($tramites_pendientes[$i]->tipo_tramite == 1){
                                            echo "Primera Vez";
                                        }else if($tramites_pendientes[$i]->tipo_tramite == 2){
                                            echo "Modificación";
                                        }else if($tramites_pendientes[$i]->tipo_tramite == 3){
                                            echo "Renovación";
                                        }
                                    ?>                                    
                                </td>
								<td>
                                    <?php echo $tramites_pendientes[$i]->fecha_creacion?>
                                </td>                               
                                <td>
                                    <?php echo $tramites_pendientes[$i]->descripcion?>
                                </td>
								<td>
                                    <?php echo $estado_obs->fecha_estado?>
                                </td>                                
                                <td>
                                    <?php
                                    $permite_validacion = array(1,5,12);
                                    
                                    if (in_array($tramites_pendientes[$i]->id_estado, $permite_validacion)) 
                                    {
                                        $from = $tramites_pendientes[$i]->fecha_creacion;
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

										$tiempo_validacion = 30;
									
										if($days > $tiempo_validacion){
											echo '<div class="alert alert-danger" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> <br>El trámite se encuentra vencido. Días transcurridos '.$days.'</div>';
										}else if($days >= 20 && $days <=30){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-warning" role="alert" style="font-size:10px;"><b>Atenci&oacute;n Usuario!</b> Trámite Próximo a vencerse. Quedan '.$faltan.' d&iacute;as.<br> Días transcurridos  '.$days.'</div>';
										}else if($days >= 11 && $days <20){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-success" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Días transcurridos '.$days.'</div>';
										}else if($days <= 10){
											$faltan= $tiempo_validacion - $days;
											echo '<div class="alert alert-info" role="alert" style="font-size:10px;">Quedan '.$faltan.' d&iacute;as. Días transcurridos '.$days.'</div>';
										}
									}							
                                    ?>
                                </td>
								<td class="text-center">
                                   <?php                                        
                                        if (in_array($tramites_pendientes[$i]->id_estado, $permite_validacion)) 
                                        {                                            
                                            ?>
                                            <a href="<?php echo base_url('sst/validacion/validar_documentos_sst/'.$tramites_pendientes[$i]->id_tramite)?>">
                                                <img src="<?php echo base_url('assets/imgs/aprobar.png')?>" width="40px">
                                                <br>Validar Informaci&oacute;n
                                            </a>
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
		
