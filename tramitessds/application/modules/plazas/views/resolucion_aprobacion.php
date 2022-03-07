<html>
<head>
  <title>Aprobación - Tramites en Linea . SDS</title>
  <meta charset="utf-8">
  <style type="text/css">

    body {
		background-color: #fff;
		font-family: Lucida Grande, Verdana, Sans-serif;
		font-size: 12px;
		color: #4F5155;
	}

	table {
		border: 1px solid #fff;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 16px;
		font-weight: bold;
		margin: 24px 0 2px 0;
		padding: 5px 0 6px 0;
	}
	
	h4 {
		color: #444;
		font-size: 12px;
		font-weight: bold;
	}

	.encabezados {
		color: #000000;
		border-bottom: 1px solid #D0D0D0;
		font-size: 16px;
		margin: 24px 0 2px 0;
		padding: 5px 0 6px 0;
	}

	h2 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 14px;
		font-weight: bold;
		margin: 5px 0 2px 0;
		padding: 5px 0 6px 0;
	}

	code {
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.centro {
		text-align: center;
	}
	
	.justificado {
		text-align: justify;
	}

	.derecha {
		text-align: right;
	}

	.total {
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #000000;
		border-bottom: 1px solid #000000;
		border-top: 1px solid #000000;
		color: #002166;
	}

	.marca-de-agua {
		padding: 0;
		width: 100%;
		height: auto;
		opacity: 0.7;
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 25px;
	}

	.contenido{
		margin-top: 60px;
		margin-bottom: 55px;
	} 

	.cursiva{
		font-style: italic;
	}
	table, th, td {
  	border: 1px solid black;
  	border-collapse: collapse;	
  </style>
</head>
<body>
<div id="header">
  <!--<img src="./assets/img/memologo.jpg" />-->
  <!--<img src="<?php //echo FCPATH.'assets/imgs/logo_pdf_alcaldia.png'?>" width="70px">-->
</div>
  <div style="width:100%;">
      <div style="margin-left:45px;margin-right:35px;margin-top:-30px;">
	    <p align="center">
            <br><b><em>SECRETARÍA DISTRITAL DE SALUD DE BOGOT&Aacute;, D.C.</b>
        </p>
        <p align="center">
            <b><em>Resolución No. <?php echo $nume_resolucion?> del <?php echo $dia." de ".$mes." de ".$anio;?><br>
              "Por medio de la cual se aprueban unas plazas para el cumplimiento del Servicio Social Obligatorio en Bogotá, D.C."<br>
              LA SUBDIRECCIÓN INSPECCIÓN VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD
              </em></b>
        </p>
        <p align="justify">En ejercicio de las facultades legales y en especial las conferidas por la Ley 1164 de 2007, la Resolución 1058 de 2010, el Decreto 507 de 2013 y la Resolución 2358 de 2014.</p>
        <p align="center"><b>CONSIDERANDO:</b></p>
        <?php
		
		$nombre_rs = $datos_tramite->nombre_rs;
		$nombre_rl = $info[0]->p_nombre." ".$info[0]->s_nombre." ".$info[0]->p_apellido." ".$info[0]->s_apellido;
		$nombre_enc = $info[0]->enc_pnombre." ".$info[0]->enc_snombre." ".$info[0]->enc_papellido." ".$info[0]->enc_sapellido;

		switch ($info[0]->tipo_iden_rl) {
			case 1:
				$tipo_iden_rl = "Cédula de ciudadanía";
				break;
			case 2:
				$tipo_iden_rl = "Cédula de extranjería";
				break;
			case 3:
				$tipo_iden_rl = "Tarjeta de identidad";
				break;
			case 4:
				$tipo_iden_rl = "Permiso especial de permanencia";
				break;
			case 5:
				$tipo_iden_rl = "NIT";
				break;
		}
		switch ($info[0]->enc_tipodoc) {
			case 1:
				$tipo_iden_enc = "Cédula de ciudadanía";
				break;
			case 2:
				$tipo_iden_enc = "Cédula de extranjería";
				break;
			case 3:
				$tipo_iden_enc = "Tarjeta de identidad";
				break;
			case 4:
				$tipo_iden_enc = "Permiso especial de permanencia";
				break;
			case 5:
				$tipo_iden_enc = "NIT";
				break;
		}				
		$nume_iden_rl = $datos_tramite->nume_iden_rl;
		$tipo_iden_rs = $datos_tramite->descTipoIden;
		$nume_iden_rs = $datos_tramite->nume_identificacion; 
		
		
			
			
			$exd = date_create($datos_tramite->fecha_envio); 
			$fecha_radicado = date_format($exd,"Y-m-d");
			
		?>
		<p align="justify">Que la Ley 1164 de 2007 “Por la cual se dictan disposiciones en materia de Talento Humano en Salud”, crea el Servicio Social Obligatorio para los egresados de los programas de educación superior del área de la salud, el cual debe ser prestado en poblaciones deprimidas urbanas o rurales o de difícil acceso a los servicios de salud, en entidades relacionadas con la prestación de servicios, la dirección, la administración y la investigación en las áreas de la salud.
		</p>
		<p align="justify">Que la misma Ley en el artículo 33 señala que el Estado velará porque las instituciones prestadoras de servicios (IPS), Instituciones de Protección Social, Direcciones Territoriales de Salud, ofrezcan un número de plazas suficientes, acorde con las necesidades de la población en su respectiva jurisdicción y con el número de egresados de los programas de educación superior de áreas de la salud.
		</p>
		<p align="justify">Que el Decreto 507de 2013 “Por el cual se modifica la Estructura Organizacional de la Secretaría Distrital de Salud de Bogotá, D.C” establece en el literal 5 del artículo 20 que le corresponde a la Subdirección de Inspección, Vigilancia y Control de Servicios de Salud Coordinar el proceso del Servicio Social Obligatorio en el Distrito Capital.
		</p>
		<p align="justify">Que la Resolución 1058 de 2010 “Por medio de la cual se reglamenta el Servicio Social Obligatorio para los egresados de los programas de educación superior del área de la salud y se dictan otras disposiciones” proferida por el Ministerio de Salud y Protección Social, establece que corresponde a las Direcciones Departamentales y Distritales de Salud, aprobar las plazas para el cumplimiento del servicio social obligatorio.
		</p>
		<p align="justify">Que la Resolución 2358 de 2014 “Por la cual se establece el procedimiento para la asignación de las plazas del Servicio Social Obligatorio – SSO-, de los profesionales de medicina, odontología, enfermería y bacteriología, en la modalidad de prestación de servicios de salud y se dictan otras disposiciones” proferida por el Ministerio de Salud y Protección Social, señala las condiciones y requisitos que deben tenerse en cuenta  para garantizar una selección objetiva de los profesionales, de acuerdo con las prioridades y preferencias de los mismos, atendiendo las necesidades de las Instituciones Prestadoras de Servicios de Salud que tienen aprobadas plazas para asignar.
		</p>
		<p align="justify">Que la misma resolución establece en el artículo 14, que corresponde a las Direcciones Departamentales de Salud o quienes hagan sus veces y a la Secretaría Distrital de Salud de Bogotá, atender y resolver las peticiones relacionadas con la vinculación, exoneración convalidación y cumplimiento del Servicio Social Obligatorio, que se originen en plazas ubicadas en sus respectivos territorios.
		</p>
        <p align="justify">Que el <?php echo $dia_reg; ?>  de <?php echo $mes_reg; ?> de <?php echo $anio_reg; ?> mediante radicado No. <?php echo $id_tramite; ?>, ante esta entidad, <?php echo $info[0]->nombre_rs; ?>, 
            identificado(a) con <?php echo $info[0]->tipiden; ?> número <?php echo $info[0]->nume_identificacion; ?>, solicita la aprobación de <?php echo $num_plazas; ?> plaza(s) de Servicio Social Obligatorio de <?php 
	    	if($tipo_profesion==5){
	    		echo " ";
	    	}else{
	    		echo $profesion; 
	    	}
	    	if($especialidad==""){

	    	}else{
	    		echo 'especialización en '.$especialidad; 
	    	}
	    	?>, en la modalidad de "<?php echo $modalidad.'"'; if($modalidad_plaza==2){ echo " para desarrollar el siguiente proyecto: <br><br>".$nom_proyecto; } ?>.

            <br><br>
        	Que atendiendo la viabilidad emitida por la Comisión Asesora para la selección, aprobación y renovación de plazas para el cumplimiento del Servicio Social Obligatorio de la Secretaría Distrital de Salud de fecha <?php echo $dia_apr; ?>  de <?php echo $mes_apr; ?> de <?php echo $anio_apr; ?>, es procedente aprobar la plaza solicitada.
        </p>
		<p>
			En mérito de lo anteriormente expuesto,
		</p> 
		<p align="center">
            <b><em>RESUELVE</em></b>
        </p>
	    <p align="justify">
	    	<b>ARTÍCULO PRIMERO.</b> - Aprobar <?php echo $num_plazas; ?> plaza(s) para el cumplimiento del Servicio Social Obligatorio para la jurisdicción de Bogotá, D.C., <?php  echo $modalidad; ?>, tipo de profesión o especialidad 
	    	<?php 
	    	if($tipo_profesion==5){
	    		echo " ";
	    	}else{
	    		echo '"'.$profesion.'"'; 
	    	}
	    	if($especialidad==""){

	    	}else{
	    		echo '"'.$especialidad.'"'; 
	    	}
	    	?>	
	    	, así:

	    </p>
	        <table border="1" width="100%" style="border: 1px solid black;border-collapse: collapse;">
	        	<tr style="border: 1px solid black;border-collapse: collapse;">
	        		<td>
	        			<b>NOMBRE DE LA INSTITUCIÓN</b>
	        		</td>
	        		<td>
	        			<b>Código de la plaza</b>
	        		</td>
	        		<td>
	        			<b>N°. De plazas</b>
	        		</td>
	        	</tr>
	        	<tr>
	        		<td>
	        			<?php 
	        				echo $info[0]->nombre_rs."<br>"; 
	        				echo $modalidad;
	        				if($modalidad_plaza==2){ 
	        					echo "<br>".$nom_proyecto;
	        				} 
	        			?>
	        		</td>
	        		<td>
	        		</td>
	        		<td align="center">
	        			<?php echo $num_plazas; ?>
	        		</td>
	        	</tr>
	        </table>
        <p align="justify"><b>PARÁGRAFO 1.</b> La aprobación de las plazas referidas en el presente artículo, de conformidad con lo establecido en el artículo 11 de la Resolución 1058 de 2010 y en el artículo 7° de la Resolución 2358 de 2014, se perderán en los siguientes casos:<br>

		•	Cuando durante más de dos períodos la plaza no haya sido ocupada.<br>
		•	Cuando la provisión de la plaza no cumpla con los procedimientos establecidos en la Resolución 1058 de 2010 y en la Resolución 2358 de 2014.<br>
		•	Cuando se comprueben irregularidades en el desarrollo del Servicio Social Obligatorio.
		</p>
        <p align="justify"><b>ARTÍCULO SEGUNDO:</b> la presente resolución rige a partir de la fecha de su expedición.
        </p>
        <!--<p align="justify">
        	<b>ARTICULO TERCERO:</b> Notifíquese electrónicamente el contenido de la presente Resolución a <?php echo $nombre_rl; ?> con <?php echo $tipo_iden_rl; ?> número <?php echo $info[0]->nume_identificacion; ?>, o a quien haga sus veces, haciéndole saber que, contra la misma sólo procede el recurso de reposición ante esta Subdirección, el cual deberá interponerse dentro de los diez (10) días siguientes a la notiﬁcación electrónica, por medio de la plataforma virtual mediante la cual se llevó a cabo el  trámite inicial o por escrito.
        </p>-->
        <p align="center">
            <b><em>COMUNIQUESE Y CUMPLASE</em></b>
        </p>
        <p>
			Dada en Bogotá, D.C. a los <?php echo $dia." d&iacute;as del mes de ".$mes." del ".$anio.".";?>
		</p> 
		<br><br><br>
		<?php 
		if($firma=='N'){ 
			echo "";
		}else{
		?>
		<img src="<?php echo FCPATH.'assets/imgs/firma_draDora.JPG'?>" width="300px"><br>
		<?php 
		}
		?>
		<!--<p align="justify"><b>YOLlMA SEDANO</b></p>-->
        <p align="justify">Subdirectora de Inspección Vigilancia y Control de Servicios de Salud</p>
		<?php
	
		if(isset($codigo_veridicacion) && $codigo_veridicacion != ''){
			?>
			<p class="justificado">Código de verificación: <?php echo $codigo_veridicacion?></p>
			<?php
		}
		
		?>
      </div>
  </div>
  <div id="footer" style="margin-left:45px;margin-right:45px">
  </div>

</body>
</html>		  