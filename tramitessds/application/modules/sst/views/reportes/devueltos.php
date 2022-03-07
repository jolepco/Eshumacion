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
<form action="<?php echo base_url('sst/reportes/devueltos/') ?>" method="post" class="form-horizontal">
		<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-4">
                <div class="subtitle">
                    <h2><b>Trámites Devueltos.</b></h2>
					<h3>Licencia para prestación de servicios en Seguridad y Salud en el Trabajo</h3>
                </div>
            </div>
<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>Fecha Inicial:</b></label>
                    <input type="date" id="fecha_i" name="fecha_i" class="form-control" placeholder="Fecha Seguimiento Inicio" style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>Fecha Final:</b></label>
                    <input type="date" id="fecha_f" name="fecha_f" class="form-control" placeholder="Fecha Seguimiento Fin"  style="width:100%;">
                </div>
            </div>

			<div class="col-12 col-md-3 pl-4">
                <div class="paragraph">
					<br><br><br>
                    <input type="submit" class="btn btn-info" value="Consultar" style="width:100%;">
                </div>
            </div>

			<div class="alert alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<b>Apreciado Usuario!</b>
			<p>La consulta y el reporte de tr&aacute;mites que se han solicitado con su ultimo estado de gesti&oacute;n, es por rango de fecha de acuerdo a la fecha del registro generada por el sistema.<br>
			Los Tr&aacute;mites visualizados corresponden a los últimos 30 d&iacute;as desde la fecha actual.
			</p>
			</div>
			
            <div class="col-12 col-md-12">
					<table class="table" id="tabla_reporte" style="font-size:small;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID Trámite</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Tipo Trámite</th>
                                <th>Fecha radicaci&oacute;n</th>                                
                                <th>Estado</th>
								<th>Fecha estado</th>                                
                                <th>Observaciones</th>
                                <th>Ver Trámite</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($tramites_devueltos != NULL)
                            {
                                for($i=0;$i<count($tramites_devueltos);$i++){                                    
                                ?>
                                <tr>
                                    <td>
                                        <?php 
                                            echo $tramites_devueltos[$i]->id_tramite;
                                        /*if(!empty($rayosx_pendientes[$i]->fecha_editado)){ 
                                            echo '<i class="fas fa-exclamation-circle" alt="Trámite Editado"></i><font color="black" font-family="sans-serif;">Ajustado</font> ';
                                        } */										
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $tramites_devueltos[$i]->DescTipoIden." - ".$tramites_devueltos[$i]->nume_identificacion?>
                                    </td>
                                    <td>
                                        <?php 
                                            if($tramites_devueltos[$i]->tipo_identificacion == 5){
                                                echo $tramites_devueltos[$i]->nombre_rs;
                                            }else{
                                                echo $tramites_devueltos[$i]->p_nombre." ".$tramites_devueltos[$i]->s_nombre." ".$tramites_devueltos[$i]->p_apellido." ".$tramites_devueltos[$i]->s_apellido;
                                            }
                                        ?>
                                    </td>                                
                                    <td>
                                        <?php 
                                            if($tramites_devueltos[$i]->tipo_tramite == 1){
                                                echo "Primera Vez";
                                            }else if($tramites_devueltos[$i]->tipo_tramite == 2){
                                                echo "Modificación";
                                            }else if($tramites_devueltos[$i]->tipo_tramite == 3){
                                                echo "Renovación";
                                            }
                                        ?>                                    
                                    </td>
                                    <td>
                                        <?php echo $tramites_devueltos[$i]->fecha_creacion?>
                                    </td>                               
                                    <td>
                                        <?php echo $tramites_devueltos[$i]->descripcion?>
                                    </td>
                                    <td>
                                        <?php echo $tramites_devueltos[$i]->fecha_estado?>
                                    </td>                                
                                    <td>
                                        <?php echo $tramites_devueltos[$i]->observaciones?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('sst/reportes/ver_contenido/'.$tramites_devueltos[$i]->id_tramite)?>">Ver</a>
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
</form>
		
