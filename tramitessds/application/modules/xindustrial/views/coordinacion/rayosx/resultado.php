<!--<p><?php echo $tramites_pendientes->id_estado?></p>
<pre>
</pre>-->
<div class="row block right" style="width:100%;">
	<div class="col-12 col-md-12 pl-4">
		<div class="subtitle">
			<h4><b>Resultado de la validaci&oacute;n</b> <i class="fas fa-check-double"></i></h4>
		</div>
	</div>
	<div class="col-md-8">
	<select id="resultado_validacion" name="resultado_validacion" class="form-control validate[required]">


		<option value="">Seleccione...</option>
<?php
for($i=0;$i<count($resultado_validacion);$i++){
	if($tramites_pendientes->id_estado == 7 && ($resultado_validacion[$i]->id_estado == 15 || $resultado_validacion[$i]->id_estado == 16)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 19 && ($resultado_validacion[$i]->id_estado == 16 || $resultado_validacion[$i]->id_estado == 15 || $resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 5 && ($resultado_validacion[$i]->id_estado == 16 || $resultado_validacion[$i]->id_estado == 15 || $resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 6 && ($resultado_validacion[$i]->id_estado == 16 || $resultado_validacion[$i]->id_estado == 15 || $resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 21 && ($resultado_validacion[$i]->id_estado == 22)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 22 && ($resultado_validacion[$i]->id_estado == 23 || $resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 23 && ($resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}else if($tramites_pendientes->id_estado == 18 && ($resultado_validacion[$i]->id_estado == 21 || $resultado_validacion[$i]->id_estado == 16 || $resultado_validacion[$i]->id_estado == 15 || $resultado_validacion[$i]->id_estado == 9 || $resultado_validacion[$i]->id_estado == 11)){
		echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";

	}

}
	echo "<option value='17'> Devolver al Validador</option>";
	echo "<option value='8'> Anular Trámite</option>";
?>
	</select>
	</div>
	<div class="col-md-4 text-center">
		<a id="btn_seguimiento" data-toggle="modal" data-target="#exampleModal"><img src="<?php echo base_url('assets/imgs/audit.png')?>"><br>Seguimiento Auditoría</a>
		<br><br>
	</div>
	<div class="col-md-12">


		<div class="row" id="div_obs_resultado" style="display:none">

			<div class="col-md-12">
				<label><b>Observaciones</b></label>
				<textarea name="observaciones" id="observaciones" class="form-control" style="width:100%;height:80px"><?php if(isset($observacionesTramite->observaciones)){echo $observacionesTramite->observaciones;}?></textarea>
			</div>
			<div class="col-md-12 " id="div_visita">
			
				<?php

					if($tramites_pendientes->categoria == 2){
						?>
						<table class="table table-striped">
							<h4>Resultado de la visita</h4>

								<tr>
									<td>Acta de la visita<br><input id="resultado_visita"  name="resultado_visita" type="file" class="form-control-file archivopdf validate[required]"></td>
									<td>Fecha de la visita<br><input id="fecha_visita"  name="fecha_visita" type="date" class="validate[required]"></td>
								</tr>

							<tr id="div_visita">
								<td colspan="4">
									<label><b>Observaciones Visita</b></label>
									<textarea id="observaciones_visitainput" name="observaciones_visita" placeholder="Observaciones Visita" class="form-control"><?php if(isset($observacionesTramite->observaciones_visita)){echo $observacionesTramite->observaciones_visita;}?></textarea>
								</td>
							</tr>
						</table>
					<?php
					}

				?>
			
			</div>
			<div class="col-md-12 text-center m-3">
				<button name="preliminar" id="preliminar"  class="btn btn-primary" type="submit" role="button" formtarget="_blank">Preliminar</button>
			</div>


			<div class="col-md-12 text-center m-3">
				<button name="guardar" id="guardar"  class="btn btn-success" type="submit" role="button" onclick="this.disabled">Guardar</button>
			</div>
		</div>

	</div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seguimiento Auditoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table width="100%" class="table table-sm table-striped" id="customers">
                <thead>
                    <tr>
                        <th width="12%"><b>Fecha Seguimiento</b></th>
                        <th width="25%"><b>Usuario</b></th>
                        <th width="15%"><b>Estado</b></th>
                        <th width="48%"><b>Observación</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(count($tramites_seguimientos)>0){
                    for($i=0;$i<count($tramites_seguimientos);$i++){
                    ?>
                    <tr>
                        <td style="height:55px;">
                            <?php echo date("Y-m-d",strtotime($tramites_seguimientos[$i]->fecha_estado));?>
                        </td>
                        <td style="height:55px;">
                            <?php echo $tramites_seguimientos[$i]->username;?> 
                        </td>
                        <td style="height:55px;">
                            <?php echo $tramites_seguimientos[$i]->descEstado?>
                        </td>
                        <td style="height:55px;">
                            <?php echo $tramites_seguimientos[$i]->observaciones;?>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>