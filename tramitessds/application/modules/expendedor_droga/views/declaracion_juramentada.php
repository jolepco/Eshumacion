<script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/expendedor.js"); ?>"></script>
<div class="modal-header">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="list-group-item-heading">
				<i class="fa fa-gear fa-fw"></i> &nbsp;  SOLICITUD CREDENCIAL DE EXPENDEDOR DE DROGAS
			</h4>
		</div>
	</div>
</div>
<div class="modal-body">
	<form name="formCap1" id="formCap1" role="form" method="post">
		<div class="row">
			<div class="panel-heading">
				<i class="fa fa-hand-paper-o"></i> Declaración juramentada
			</div>
			<div class="alert alert-danger" role="alert">
				
				<p>	Señor Ciudadano (a):</p>
				<p> 
					El siguiente tramite se denomina ¨ REGISTRO CREDENCIAL EXPENDEDOR DE DROGAS ¨ autoriza para dirigir el establecimiento denominado droguería.
				</p>
				<p> 
					Los documentos requeridos deben ser cargados en el orden y espacio establecido para tal fin, no deben ser cargados documentos diferentes. En caso de ser cargados en desorden o que no cumplan con los requerimientos exigidos, será devuelta la solicitud.
				</p>
				<p> 
					Los documentos adjuntados están sujetos a verificación ante las autoridades que lo emitieron.
				</p>
				<p>
					Si ya cuenta con esta credencial emitida anteriormente por alguna Secretaria de Salud no deberá realizarlo nuevamente.
				</p>
				<p>
					De acuerdo a la normatividad vigente usted no debe solicitar otra resolución para la misma persona, si ya cuenta con ella.
				</p>
				<p>
					Acorde con lo anterior, manifestó expresamente y bajo la gravedad de juramento, que no he sido autorizado ni he iniciado el trámite para ejercer esta ocupación, así como los documentos cargados en esta plataforma a título personal son auténticos.
				</p>
				</p>
			</div>
		</div>
		<div class="form-group">
			<div class="row" align="center">
				<div class="registro_triada">
                    <a class="btn btn-success" href="<?php echo base_url('expendedor_droga/form_documentos')?>" class="btn btn-primary" role="button">Aceptar</a>
					<a class="btn btn-danger" href="<?php echo base_url('expendedor_droga/logout_ci')?>" class="btn btn-primary" role="button">No Aceptar</a>
                </div>
			</div>
		</div>
	</form>
</div>