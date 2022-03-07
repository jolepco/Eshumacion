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

			if($tramites_pendientes->categoria == 1 && $tramites_pendientes->id_estado == 2 && ($resultado_validacion[$i]->id_estado == 2 || $resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 7 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}else if($tramites_pendientes->categoria == 1 && $tramites_pendientes->id_estado == 14 && ($resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}else if($tramites_pendientes->id_estado == 20  && ($resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}else if($tramites_pendientes->id_estado == 17 && ($resultado_validacion[$i]->id_estado == 2 || $resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 7 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}

			if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 2 && ($resultado_validacion[$i]->id_estado == 2 || $resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 7 || $resultado_validacion[$i]->id_estado == 8 || $resultado_validacion[$i]->id_estado == 19)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}
			if($tramites_pendientes->categoria == 2 &&  $tramites_pendientes->id_estado == 41 && ($resultado_validacion[$i]->id_estado == 21 || $resultado_validacion[$i]->id_estado == 8)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}
			if($tramites_pendientes->categoria == 2 && $tramites_pendientes->id_estado == 14 && ($resultado_validacion[$i]->id_estado == 5 || $resultado_validacion[$i]->id_estado == 6 || $resultado_validacion[$i]->id_estado == 8 || $resultado_validacion[$i]->id_estado == 7 || $resultado_validacion[$i]->id_estado == 19)){
				echo "<option value='".$resultado_validacion[$i]->id_estado."'>".$resultado_validacion[$i]->descripcion."</option>";
			}

		}
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

			<div class="col-md-12 text-center m-3" id="div_preliminar" style="display:none">
				<?php if ($tramites_pendientes->id_estado != 41){
				?>
				<button name="preliminar" id="preliminar" class="btn btn-primary" type="submit" role="button" formtarget="_blank">Preliminar</button>
				<?php
				 }?>
			</div>
			<div class="col-md-12 text-center m-3">
				<button name="guardar" id="guardar" class="btn btn-success" type="submit" role="button" onclick="this.disabled">Guardar</button>
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