<html>
<head>
<title>Generación documentos</title>
<style>
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
</style>
</head>

<?php
	
	if($rayosxEquipo[0]->categoria1 != 0 || $rayosxEquipo[0]->categoria1 != NULL){
		if($rayosxEquipo[0]->categoria1 == 1){
			$categoria1 = "Radiolog&iacute;a odontol&oacute;gica periapical";
			
		}else if($rayosxEquipo[0]->categoria1 == 2){
			$categoria1 = "Equipo de RX";					
		}				
	}

	if($rayosxEquipo[0]->categoria2 != 0 || $rayosxEquipo[0]->categoria2 != NULL){
		if($rayosxEquipo[0]->categoria2 == 1){
			$categoria2 = "Radioterapia";					
		}else if($rayosxEquipo[0]->categoria2 == 2){
			$categoria2 = "Radio diagn&oacute;stico de alta complejida";
		}else if($rayosxEquipo[0]->categoria2 == 3){
			$categoria2 = "Radio diagn&oacute;stico de media complejidad";					
		}else if($rayosxEquipo[0]->categoria2 == 4){
			$categoria2 = "Radio diagn&oacute;stico de baja complejidad";										
		}else if($rayosxEquipo[0]->categoria2 == 5){
			$categoria2 = "Radiografias odontol&oacute;gicas pan&oacute;ramicas y tomografias orales";										
		}
	}

	if($rayosxEquipo[0]->categoria1_1 != 0 || $rayosxEquipo[0]->categoria1_1 != NULL){
		if($rayosxEquipo[0]->categoria1_1 == 1){
			$categoria1_1 = "Equipo de RX odontol&oacute;gico periapical";
			$equipo_doc = $categoria1_1;
		}else if($rayosxEquipo[0]->categoria1_1 == 2){
			$categoria1_1 = "Equipo de RX odontol&oacute;gico periapical portat&iacute;l";
			$equipo_doc = $categoria1_1;
		}				
	}

	if($rayosxEquipo[0]->categoria1_2 != 0 || $rayosxEquipo[0]->categoria1_2 != NULL){
		if($rayosxEquipo[0]->categoria1_2 == 1){
			$categoria1_2 = "Densit&oacute;metro &oacute;seo";
			$equipo_doc = $categoria1_2;
		}
	}
	
	if($rayosxEquipo[0]->categoria2_1 != 0 || $rayosxEquipo[0]->categoria2_1 != NULL){
		if($rayosxEquipo[0]->categoria2_1 == 1){
			$categoria2_1 = "Equipo de RX convencional";					
		}else if($rayosxEquipo[0]->categoria2_1 == 2){
			$categoria2_1 = "Tomógrafo Odontológico";
		}else if($rayosxEquipo[0]->categoria2_1 == 3){
			$categoria2_1 = "Tomógrafo";
		}else if($rayosxEquipo[0]->categoria2_1 == 4){
			$categoria2_1 = "Equipo de RX Portátil";
		}else if($rayosxEquipo[0]->categoria2_1 == 5){
			$categoria2_1 = "Equipo de RX Odontológico";
		}else if($rayosxEquipo[0]->categoria2_1 == 6){
			$categoria2_1 = "Panorámico Cefálico";
		}else if($rayosxEquipo[0]->categoria2_1 == 7){
			$categoria2_1 = "Fluoroscopio";
		}else if($rayosxEquipo[0]->categoria2_1 == 8){
			$categoria2_1 = "SPECT-CT";
		}else if($rayosxEquipo[0]->categoria2_1 == 9){
			$categoria2_1 = "Arco en C";
		}else if($rayosxEquipo[0]->categoria2_1 == 10){
			$categoria2_1 = "Mamógrafo";
		}else if($rayosxEquipo[0]->categoria2_1 == 11){
			$categoria2_1 = "Litotriptor";
		}else if($rayosxEquipo[0]->categoria2_1 == 12){
			$categoria2_1 = "Angiógrafo";
		}else if($rayosxEquipo[0]->categoria2_1 == 13){
			$categoria2_1 = "PET-CT";					
		}else if($rayosxEquipo[0]->categoria2_1 == 14){
			$categoria2_1 = "Acelerador lineal";					
		}else if($rayosxEquipo[0]->categoria2_1 == 15){
			$categoria2_1 = "Sistema de radiocirugia robótica";					
		}else if($rayosxEquipo[0]->categoria2_1 == 16){
			$categoria2_1 = $rayosxEquipo[0]->otro_equipo;					
		}else if($rayosxEquipo[0]->categoria2_1 == 17){
			$categoria2_1 = "Panorámico";
		}else{
			$categoria2_1 = "";					
		}
		
		if($categoria2_1 != ""){
			$equipo_doc = $categoria2_1;	
		}		
	}
	
	$exd = date_create($datos['datos_tramite']->fecha_envio);
	$fecha_radicado = date_format($exd,"Y-m-d");//here you make mistake
	
	if($datos_tramite->tipo_identificacion == 5){
		$nombre_rs = $datos_tramite->nombre_rs;
		$nombre_rl = $datos_tramite->p_nombre." ".$datos_tramite->s_nombre." ".$datos_tramite->p_apellido." ".$datos_tramite->s_apellido;
		switch ($datos_tramite->tipo_iden_rl) {
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
		$nume_iden_rl = $datos_tramite->nume_iden_rl;
		$tipo_iden_rs = $datos_tramite->descTipoIden;
		$nume_iden_rs = $datos_tramite->nume_identificacion;
	}else{
		$nombre_rs = $datos_tramite->p_nombre." ".$datos_tramite->s_nombre." ".$datos_tramite->p_apellido." ".$datos_tramite->s_apellido;
		$nombre_rl = $datos_tramite->p_nombre." ".$datos_tramite->s_nombre." ".$datos_tramite->p_apellido." ".$datos_tramite->s_apellido;
		
		$tipo_iden_rl = $datos_tramite->descTipoIden;
		$nume_iden_rl = $datos_tramite->nume_identificacion;
		$tipo_iden_rs = $datos_tramite->descTipoIden;
		$nume_iden_rs = $datos_tramite->nume_identificacion;
	}
?>

<body>
	<p class="centro">DIRECCIÓN DE CALIDAD DE SERVICIOS DE SALUD</p>
	<p class="centro">SUBDIRECCIÓN INSPECCIÓN, VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD</p>
	<p class="centro">RESOLUCIÓN No. <?php echo $nume_resolucion?> de <?php echo date('d')." del mes de ".$mes." del a&ntilde;o ".date('Y');?></p>
	<p class="centro cursiva">"Por la cual Por la cual se Ordena el Archivo de la solicitud de La Licencia de Práctica Médica Categoría <?php echo $datos_tramite->categoria?> para Equipo de Radiaciones Ionizantes"</p>
	<p class="centro">LA SUBDIRECTORA INSPECCIÓN, VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD</p>
	
	<p class="justificado">
		En uso de sus facultades legales y en especial las que confiere el Decreto Distrital 507 de 2013 expedido por el Alcalde Mayor de Bogotá y la 
		Resolución 482 de 2018 del Ministerio de Salud y Protección Social y 
	</p>
	
	<p class="centro">CONSIDERANDO:</p>
	<p class="justificado">
		Que la institución <?php echo $nombre_rs?>, identificado con <?php echo $tipo_iden_rs?> número <?php echo $nume_iden_rs?>, solicitó mediante radicado <?php echo $datos_tramite->id?> de <?php echo $fecha_radicado?>, 
		“Licencia de práctica médica”, para el equipo generador de radiaciones ionizantes equipo de Rayos X <?php echo $equipo_doc;?> marca <?php echo $rayosxEquipo[0]->marca_equipo?>, modelo <?php echo $rayosxEquipo[0]->modelo_equipo?>   
		para lo cual anexa los documentos que soportan su solicitud. 
	</p>
	
	<p class="justificado">
		Que la Resolución 482 del 22 de febrero de 2018, expedida por el Ministerio de Salud y Protección Social, por la cual se reglamenta el uso de equipos 
		generadores de radiación ionizante, su control de calidad, la prestación de servicios de protección radiológica y se dictan otras disposiciones, 
		establece: 
	</p>
	<p class="justificado">
		"…Artículo 26. Trámite de las licencias de prácticas médicas categoría I o II. El estudio de la documentación para el otorgamiento de la licencia de 
		prácticas médicas categoría I o II, estará sujeto al siguiente procedimiento: 
	</p>
	<p class="justificado">
		26.1. Radicada la solicitud en el formato dispuesto en el Anexo No. 3, con los documentos requeridos en los artículos 21 o 23, según la categoría, 
		la entidad territorial de salud departamental o distrital, según corresponda, procederá a revisarla dentro de los veinte (20) días hábiles siguientes
		y, de encontrar la documentación incompleta, requerirá al solicitante para que la suministre dentro de los veinte (20) días hábiles siguientes. 
	</p>
	<p class="justificado">
		26.2. Si no se completa la solicitud, se entenderá que se desiste de esta, salvo que antes de vencer el plazo concedido, el peticionario solicite 
		prórroga, la cual se concederá hasta por un término igual. 
	</p>
	<p class="justificado">
		Que la Dirección de Calidad de Servicios de Salud, mediante radicado <?php echo $datos_tramite->id?> del <?php echo $fecha_radicado?>, 
		otorgó plazo de 20 días hábiles para hacer llegar los documentos faltantes para continuar con el trámite de la Licencia de Práctica Médica Categoría <?php echo $datos_tramite->categoria?>.
	</p>
	<?php
		$item = 1;
		if(isset($obs_val1) && $obs_val1 != ''){
				
			?>
			<h4><?php echo $item?>. Observaciones Localización</h4>
			<p class="justificado">				
				<?php echo trim($obs_val1)?>
			</p>
			<?php
			$item++;
		}
		
		if(isset($obs_val2) && $obs_val2 != ''){
			
			?>
			<h4><?php echo $item?>. Observaciones Equipos</h4>
			<p class="justificado">
				<?php echo trim($obs_val2)?>
			</p>
			<?php
			$item++;
		}
		
		if(isset($obs_val3) && $obs_val3 != ''){				
			?>
			<h4><?php echo $item?>. Observaciones Trabajadores TOE</h4>
			<p class="justificado">
				<?php echo trim($obs_val3)?>
			</p>
			<?php
			$item++;
		}
		
		if(isset($obs_val4) && $obs_val4 != ''){
			
			?>
			<h4><?php echo $item?>. Observaciones Talento Humano</h4>
			<p class="justificado">
				<?php echo trim($obs_val4)?>
			</p>
			<?php
			$item++;
		}
		
		if(isset($obs_val5) && $obs_val5 != ''){
			
			?>
			<h4><?php echo $item?>. Observaciones Objetos de prueba</h4>
			<p class="justificado">
				<?php echo trim($obs_val5)?>
			</p>
			<?php
			$item++;
		}
		
		if(isset($obs_val6) && $obs_val6 != ''){
			
			?>
			<h4><?php echo $item?>. Observaciones Documentos Adjuntos</h4>
			<p class="justificado">
				<?php echo trim($obs_val6)?>
			</p>
			<?php
			$item++;
		}
	
	?>
	
	<p class="justificado">
		Que el Artículo 26. Trámite de las licencias de prácticas médicas categoría I o II. Establece el numeral 26.3. Completa la solicitud, se surtirá el 
		siguiente procedimiento: 26.3.1. Para las licencias de práctica médica categoría I, se procederá a estudiar la documentación y dentro de los cuarenta y cinco 
		(45) días hábiles siguientes, a emitir el acto administrativo. 
	</p>
	<p class="justificado">
		(…) 26.3.4. Rebasado el término del requerimiento o el de la visita, la entidad territorial de salud de carácter departamental o distrital, según corresponda, 
		dentro de los cuarenta y cinco (45) días hábiles siguientes, entrará a resolver de fondo la solicitud con la documentación e información de que disponga, 
		decisión que será notificada de acuerdo con lo establecido por el Código de Procedimiento Administrativo y de lo Contencioso Administrativo 
		y susceptible de los recursos en este contemplados.
	</p>
	<p class="justificado">
		Que en mérito a lo expuesto, esta Subdirección
	</p>
	<p class="centro">
		RESUELVE:
	</p>
	<p class="justificado">
		<b>ARTÍCULO PRIMERO: </b>Tener por desistida la solicitud de la renovación de la Licencia de Práctica Médica Categoría I, a la institución 
		<?php echo $nombre_rs?>, identificado con <?php echo $tipo_iden_rs?> número <?php echo $nume_iden_rs?>,
		por las razones expuestas en la parte considerativa de esta Resolución.		
	</p>
	<p class="justificado">
		<b>ARTÍCULO SEGUNDO: </b>Ordenar el archivo del trámite de la solicitud de la renovación de la Licencia de Practica Medica Categoría <?php echo $datos_tramite->categoria?>, a la institución 
		<?php echo $nombre_rs?>, identificado 
		con <?php echo $tipo_iden_rs?> número <?php echo $nume_iden_rs?>, por las razones expuestas en la parte considerativa de esta Resolución.
	</p>
	<p class="justificado">
		<b>ARTÍCULO TERCERO: </b>Notificar personalmente a <?php echo $nombre_rl?>  identificado(a) con <?php echo $tipo_iden_rl?> número <?php echo $nume_iden_rl?>, 
		representante legal de la institución <?php echo $nombre_rs?>, 
		identificado con <?php echo $tipo_iden_rs?> número <?php echo $nume_iden_rs?>, el contenido de la presente Resolución, informándole que de conformidad con el artículo 74 del Código de 
		Procedimiento Administrativo y de lo Contencioso Administrativo (Ley 1437 de 2011) contra la misma proceden los recursos de reposición y en 
		subsidio apelación, los cuales podrá interponer ante esta Dirección, dentro de los diez (10) días hábiles siguientes a la notificación de este acto administrativo.
	</p>
	<p class="centro">
		NOTIFÍQUESE Y CÚMPLASE	
	</p>
	<p class="centro">
		Dada en Bogotá, D.C
	</p>
	
	<br><br>
	<?php
	
	if($firma == TRUE){
		?>
		<img src="<?php echo FCPATH.'assets/imgs/firma_draInesSaludPublica.JPG'?>" width="100px"><br>
		<?php
	}
	
	?>
	<p align="justify"><b>INÉS MARÍA GALINDO HENRÍQUEZ</b></p>
	<p align="justify">Subdirectora de Vigilancia en Salud Publica</p>

	<?php
	
	if(isset($codigo_verificacion) && $codigo_verificacion != ''){
		?>
		<p class="justificado">Código de verificación: <?php echo $codigo_verificacion?></p>
		<?php
	}
	
	?>
</body>
</html>