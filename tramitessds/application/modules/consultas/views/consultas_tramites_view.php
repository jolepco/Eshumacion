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

<form action="<?php echo base_url('consultas/index/') ?>" method="post" autocomplete="off" class="form-horizontal">
	<div class="row block right" style="width:100%" >
			<div class="col-12 col-md-12 pl-">
                <div class="subtitle">
                    <h2>Filtro consulta de tr&aacute;mites por número de documento</h2>
					
                </div>
            </div>
			<div class="col-12 col-md-6 pl-4">
                <div class="paragraph">
					<br>
                    <label for="num_doc"><b>No. Documento Solicitante:</b></label>
                    <input id="num_doc" name="num_doc" class="form-control" placeholder="Ingresar el Número de Documento" style="width:100%;" required="required">
                </div>
            </div>
			
			<div class="col-12 col-md-6 pl-4">
                <div class="paragraph">
					<br><br><br>
                    <input type="submit" class="btn btn-info " value="Consultar" style="width:100%;">
                </div>
            </div>

			
</form>
		<div class="col-12 col-md-12">
		<br>
			<div class="alert alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<b>Apreciado Usuario!</b>
			<p>La siguiente consulta tiene como filtro de busqueda el número de documento del solicitante, quien esta registrado como persona natural o jurídica en el sistema ventanilla única de trámites y servicios de la Secretaría Distrital de Salud. Favor ingresar el número de documento sin separadores, espacios y/o puntos. 
			</p>
			</div>
		</div>
		
		<div class="col-12 col-md-12">
		<br>
			<table class="table" id="tabla_tramites"  style="font-size:small;">
				<thead>
                    <tr>
                        <th>Id Tr&aacute;mite</th>
                        <th>Id usuario</th>
                        <th>Nombres y Apellidos</th>
                        <th>Razón Social</th>
						<th>Fecha Radicaci&oacute;n</th>
                        <th>Tr&aacute;mite</th>
						<th>Estado Trámite</th>
                        <th>Ver M&aacute;s</th>

                    </tr>
                </thead>
                <tbody>

                <?php
                //Author: Mario Beltran mebeltran@saludcapital.gov.co Since: 28052019
                //Listado de tramites Aprobados por Validador
                if(count($information)>0){
                        for($i=0;$i<count($information);$i++){
                        ?>
                    <tr>
                        <td>
                            <?php echo $information[$i]->id_tramite;?>
                        </td>
                        <td>
                            <?php echo $information[$i]->id_usuario; ?>
                        </td>
                        <td>
                            <?php echo $information[$i]->p_nombre." ".$information[$i]->s_nombre." ".$information[$i]->p_apellido." ".$information[$i]->s_apellido; ?>
                        </td>
                        <td>
                            <?php echo $information[$i]->nombre_rs; ?>
                        </td>
						<td>
                            <?php echo $information[$i]->fecha_registro; ?>
                        </td>
                        <td>
                            <?php echo $information[$i]->tramite; ?>
                        </td>
						<td>
                            <?php echo $information[$i]->nombre_estado?>
                        </td>
                        <td>
							<center>
								<a href="<?php echo base_url('consultas/ver_historico/'.$information[$i]->id_tramite.'/'.$information[$i]->tipo_tramite) ?>"  target="_blank">
								<img src="<?php echo base_url('assets/imgs/aprobar.png')?>" width="20px">
								<br>Visualizar Informaci&oacute;n
								</a>
							</center>
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

<!--Author: Mario Beltran mebeltran@saludcapital.gov.co Since: 17062019
//Script Generar Excel-->
        <script type="text/javascript">
           $("#Excel").click(function (){
           var fecha_i= $("#fecha_i").val();
           var fecha_f= $("#fecha_f").val();
          window.location.href =base_url+'validacion/generar_excelaprobados?fecha_i='+fecha_i+'&fecha_f='+fecha_f;
          //window.location.href ="<?php //echo base_url("validacion/generar_excel/")?>"

         });

         </script>
		<script type="text/javascript">
           $("#ExcelAC").click(function (){
           var fecha_i= $("#fecha_i").val();
           var fecha_f= $("#fecha_f").val();
          window.location.href =base_url+'validacion/generar_excelaprobadosAC?fecha_i='+fecha_i+'&fecha_f='+fecha_f;
          //window.location.href ="<?php //echo base_url("validacion/generar_excel/")?>"

         });

        </script>			 
