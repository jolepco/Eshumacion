
<?php
	
if($tramite_info->modulo1 == 1 && $tramite_info->modulo2 == 1 && $tramite_info->modulo3 == 1 && $tramite_info->modulo4 == 1 && $tramite_info->modulo5 == 1)
{
?>


   <div class="line"></div>
   <?php
	if($tramite_info->estado == 13){
		$nombreBoton = "Subsanar Trámite";
	}else if($tramite_info->estado == 22){
		$nombreBoton = "Subsanar Trámite";
	}else{
		$nombreBoton = "Finalizar Trámite";
	} 
   
   ?>

   <!-- PRIMER PASO CREACION DEL TRAMITE Y ASIGNACION DEL PRIMER ESTADO -->
   <div id="paso6" class="row block w-100 newsletter">
   <form class="form-inline" id="formfinal" name="formfinal" action="<?php echo base_url('xindustrial/completarTramiteRayosx')?>" method="post">
      <div class="w-100">
         <div class="subtitle">
            <h5><b>El trámite de Registro y autorización de Licencia de equipos industriales, veterinaria o de investigación se encuentra completo</b></h5>
         </div>

         <div class="form-group ">
            <label for="tipo_tramite">¡Apreciado Usuario! Una vez se presione el botón de <?php echo $nombreBoton?>, este no podrá ser editado y será gestionado por los Funcionarios de la Secretaría de Salud.</label>
			<input id="id_tramite_rayosx" name="id_tramite_rayosx" type="hidden" value="<?php echo $id_tramite ?>">
			<input type="hidden" value="2" name="estado_tramite">
         </div>
		 <br>
		 <p>
			Autoriza a la Secretaria Distrital de Salud de conformidad con lo establecido en la ley 1437 del 2011 a ser notificado y comunicado de cualquier decisión o requerimiento por medio de correo electrónico?			
		 </p>
		   <div class="form-group">
            <label for="notificacion">Notificación electrónica: </label>
            <select id="notificacion" name="notificacion" class="form-control validate[required]">
               <option value="">Seleccione...</option>
               <option value="1">Si</option>
               <option value="2">No</option>
            </select>
         </div>
		   <div class="form-group" id="div_correo_noti" style="display:none">
            <label for="correo_notificacion">Correo electrónico de notificación: </label>
			   <input type="email" id="correo_notificacion" name="correo_notificacion" class="form-control validate[required, custom[email]]" placeholder="Correo electrónico de notificación">
         </div>

       <div id="btnRegistrarSolicitud" class="col-md-12 pt-200">
         <p align="center">
            <br/>
            <!-- Primer Collapsible - Localizacion Entidad -->
            <button type="submit" class="btn btn-warning">
               <?php echo $nombreBoton?>
            </button>
         </p>
       </div>
    </div>
	</form>

</div>
<?php
	}
?>