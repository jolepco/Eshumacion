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
<body>
		<?php
		$exd = date_create($datos_tramite->fecha_envio); 
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
		<p class="justificado">
			22100<br>
			Bogotá D.C.<br><br>
			Señor(a)<br>
			<?php echo $nombre_rl?><br>
			<?php echo $datos_tramite->email?><br>
			<?php echo $datos_tramite->dire_resi?><br>
			Bogotá D.C
		</p>
		<p class="justificado">
			Asunto: Respuesta Radicado No <?php echo $datos_tramite->id?> del <?php echo $fecha_radicado?>
		</p>		
		<p class="justificado">
			Cordial Saludo:	
		</p>
		<?php
		if(count($rayosxEquipo)>1){
			?>
			<p class="justificado">
				Atentamente doy respuesta a la comunicación de la referencia en la que solicita la obtención de la Licencia de Practica industrial, veterinaria o de investigación, de conformidad con lo dispuesto en la Resolución 482 de 2018. 
			</p>
			<?php		
		}else{
			
			if($rayosxEquipo[0]->categoria1 != 0 || $rayosxEquipo[0]->categoria1 != NULL){
				if($rayosxEquipo[0]->categoria1 == 1){
					$categoria1 = "Radiología odontológica";
					$desc_categoria = $categoria1;
					
				}else if($rayosxEquipo[0]->categoria1 == 2){
					$categoria1 = "Equipo de RX";					
					$desc_categoria = $categoria1;
				}else if($rayosxEquipo[0]->categoria1 == 3){
					$categoria1 = $rayosxEquipo[0]->otro_equipo;					
					$desc_categoria = $categoria1;
				}				
			}
		
			if($rayosxEquipo[0]->categoria2 != 0 || $rayosxEquipo[0]->categoria2 != NULL){
				if($rayosxEquipo[0]->categoria2 == 1){
					$categoria2 = "Pallets y paquetes";		
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 2){
					$categoria2 = "Escáner  de carga";
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 3){
					$categoria2 = "Equipo radiología convencional móvil";					
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 4){
					$categoria2 = "Inspectometro de Rayos X";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 5){
					$categoria2 = "Equipo de difracción de Rayos X";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 6){
					$categoria2 = "Equipo radiología convencional";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 7){
					$categoria2 = "Equipo radiología veterinaria";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 8){
					$categoria2 = "Acelerador lineal de uso veterinario";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 9){
					$categoria2 = "Acelerador lineal";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 10){
					$categoria2 = "Equipo de fluorescencia con tubo de Rayos RX";										
					$desc_categoria = $categoria2;	
				}else if($rayosxEquipo[0]->categoria2 == 11){
					$categoria2 = $rayosxEquipo[0]->otro_equipo;										
					$desc_categoria = $categoria2;	
				}
			}
		
				
			if($categoria2_1 != ""){
				$equipo_doc = $categoria2_1;	
			}					
			
			?>
			<p class="justificado">
				Atentamente doy respuesta a la comunicación de la referencia en la que solicita la obtención de la Licencia de Practica industrial, veterinaria o de investigación para el equipo 
				de Rayos X <?php echo $equipo_doc?> marca <?php echo $rayosxEquipo[0]->marca_equipo?> modelo <?php echo $rayosxEquipo[0]->modelo_equipo?>, de 
				conformidad con lo dispuesto en la Resolución 482 de 2018. 
			</p>
			<?php		
		}
		?>
		
		<p class="justificado">
			Al respecto le informo que una vez revisada la documentación aportada por usted, esta Secretaría de Salud emitió concepto con las observaciones 
			que a continuación se describen:  	
		</p>
		<p><?php echo $observaciones ?>
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
			Para continuar con el trámite de Licencia de Practica industrial, veterinaria o de investigación, es necesario el cumplimiento de los aspectos descritos en el concepto, para lo cual 
			contará con 20 días hábiles, de acuerdo a lo establecido en el Artículo 26, numeral 26.1de la Resolución 482 de 2018. En caso contrario, se entenderá 
			que se desiste de ésta, salvo que antes de vencer el plazo concedido, solicite prórroga, la cual se concederá hasta por un término igual, 
			(Artículo 26, numeral 26.2 de la Resolución 482 de 2018).
		</p>
		<p class="justificado">
			Cordialmente,
		</p>
		<br><br><br>
		<?php
	
		if($firma == TRUE){
			?>
			<img src="<?php echo FCPATH.'assets/imgs/firma_docsol.jpg'?>" width="100px"><br>
			<?php
		}
		
		?>
		<p align="justify"><b>SOL YIBER BELTRÁN AGUILERA</b></p>
		<p align="justify">Subdirectora de Vigilancia en Salud Publica</p>

</body>
</html>
