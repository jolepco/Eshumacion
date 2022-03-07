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
    <h3 class="text-info"><b>Licencia para prestación de servicios en Seguridad y Salud en el Trabajo</b></h3>
</div>
<div class="row p-4">
    <div class="col-md-12 text-center">
        <a href="<?php echo base_url('sst/formulario_usuario')?>" class="btn btn-info">Nuevo Trámite</a>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID trámite</th>
                    <th>Fecha radicación</th>
                    <th>Estado trámite</th>
                    <th>Fecha Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                for($i=0;$i<count($tramites_pen);$i++){
                   
                    $estado_obs = $this->sst_model->sst_flujo_tramite($tramites_pen[$i]->id_tramite,$tramites_pen[$i]->id_estado); 

                ?>
                <tr>
                    <td><?php echo $tramites_pen[$i]->id_tramite?></td>
                    <td><?php echo $tramites_pen[$i]->fecha_creacion?></td>
                    <td><?php echo $tramites_pen[$i]->descripcion?></td>
                    <td><?php echo $estado_obs->fecha_estado?></td>
                    <td class="text-center">
                        <?php 
                        if($tramites_pen[$i]->id_estado == 4){
                            ?>
                            <a href="<?php echo base_url('sst/editar_tramite/'.$tramites_pen[$i]->id_tramite)?>">
                                <img src="<?php echo base_url('assets/imgs/editar.png')?>" width="40px">
                                <br>Editar Trámite
                            </a>
                            <?php 
                        }else if($tramites_pen[$i]->id_estado == 10 || $tramites_pen[$i]->id_estado == 11){

      
                            $resolucion = $this->sst_model->consultar_resolucion($tramites_pen[$i]->id_tramite, $tramites_pen[$i]->id_estado);

                            if($resolucion){
                                ?>
                                <a href="<?php echo base_url('sst/abrir_resoluciones/'.$resolucion->nombre)?>" target="_blank">
                                    <img src="<?php echo base_url('assets/imgs/pdf.png')?>" width="40px">
                                    <br>Ver Documento
                                </a>
                                <?php 
                            }


                        }else if($tramites_pen[$i]->id_estado == 6){
                            ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Ver Observación
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Observación de anulación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><?php echo $estado_obs->observaciones?></p>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                            <?php 
                        }else if($tramites_pen[$i]->id_estado == 12){
							$estado_obs2 = $this->sst_model->sst_flujo_tramite($tramites_pen[$i]->id_tramite,$tramites_pen[$i]->id_estado); 
                            ?>
							<a class="btnseg" id="<?php echo $tramites_pen[$i]->id_tramite?>" href="#" data-target="#modalseguimiento" data-toggle="modal"><img src="<?php echo base_url('assets/imgs/audit.png')?>" width="40px"><br>Observaciones</a>
                            <?php 
							
                        }
                        ?>
                    </td>
                </tr>
                <?php
				unset ($estado_obs2);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="modalseguimiento" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
<div class="modal-dialog modal-lg" role="dialog">
    <div class="modal-content">
        <div class="modal-header" style="background:#3D5DA6;">
            <h4 class="modal-title" id="myModalLabel" style="color:white;">Ventana de Seguimiento y Observaciones Ciudadano(a)</h4>		
        </div>
        <div class="modal-body">
		<legend>Tabla de Seguimiento</legend>
		<br>
			<table width="100%" border="1" id="observacionestabla">
				<thead>
					<tr>
						<th width="12%"><b>Fecha Observación</b></th>
						<th width="25%"><b>Observación</b></th>
					</tr>
				</thead>
				<tbody id="bodyobservacionestabla">
				</tbody>
			</table>	
		
        </div>
        <div class="modal-footer" align="center">
		<table width="100%">
		<tr>
			<td align="center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</td>
		</tr>
		</table>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">

 $(document).ready(function() {
        $(".btnseg").click(function() {
            var id_tituloaseg = $(this).attr('id');
            
			console.log(id_tituloaseg);
			$('#bodyobservacionestabla').empty();
			//$(".modal-body #id_titulomodalseg" ).html(id_tituloaseg);
			$.ajax({
					url: base_url + "sst/seguimientociudadano/",
					type:'POST',
					dataType: "json",
					data:{
						idt :  id_tituloaseg			
					},
					
					success:function(res){

						var res = jQuery.parseJSON(JSON.stringify(res));
								$.each(res, function(index, value){
									//console.log(value);
									$( "#bodyobservacionestabla" ).append("<tr>");
									$( "#bodyobservacionestabla" ).append("<td>" + value.fecha_estado + "</td>");
									$( "#bodyobservacionestabla" ).append("<td>" + value.observaciones + "</td>");
									$( "#bodyobservacionestabla" ).append("</tr>");
								});	
						
						$('#modalseguimiento').modal('show');
						//alertify.alert('Usuario creado', res.mensaje, function(){ location.reload(); alertify.success('Recargando...'); });
					
					},
					error:function(){
						alertify.alert('Usuario no creado', res.mensaje, function(){ location.reload(); alertify.success('Recargando...'); });
					}
				});	
				return false;
        });

    });
	
</script>