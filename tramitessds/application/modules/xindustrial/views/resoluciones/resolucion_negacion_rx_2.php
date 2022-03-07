
	<html>
<head>
  <title>Negación - Tramites en Linea SDS</title>
  <meta charset="utf-8">
  <style type="text/css">

    body {
		background-color: #fff;
		font-family: Lucida Grande, Verdana, Sans-serif;
		font-size: 11px;
		color: #4F5155;
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
			$tratamiento = "la institución";
		}else{
			$nombre_rs = $datos_tramite->p_nombre." ".$datos_tramite->s_nombre." ".$datos_tramite->p_apellido." ".$datos_tramite->s_apellido;
			$nombre_rl = $datos_tramite->p_nombre." ".$datos_tramite->s_nombre." ".$datos_tramite->p_apellido." ".$datos_tramite->s_apellido;

			$tipo_iden_rl = $datos_tramite->descTipoIden;
			$nume_iden_rl = $datos_tramite->nume_identificacion;
			$tipo_iden_rs = $datos_tramite->descTipoIden;
			$nume_iden_rs = $datos_tramite->nume_identificacion;
			$tratamiento = "el señor(a)";
		}

		if($datos_tramite->categoria == 1){
			$catRomano = "I";
		}else if($datos_tramite->categoria == 2){
			$catRomano = "II";
		}

		//Negación tramite enviado
		$arregloNegacionPrimera = array(4,6,11,12);
		if(in_array($datos_tramite->estado, $arregloNegacionPrimera)){
			$dateEstadoEnviado = date_create($datos_tramite->fecha_envio);
			$fechaEstadoEnviado = date_format($dateEstadoEnviado,"d/m/Y");
			?>
			<p class="justificado">
				Que mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fechaEstadoEnviado." ".$tratamiento." ".$nombre_rs?>,
				envío la documentación solicitada por la Subdirección de Vigilancia en Salud Publica, una vez analizada la información,
				se encontraron las siguientes observaciones:
			</p>
			<?php
			if($observaciones != ''){
				echo "<p class='justificado'>".$observaciones."</p>";
			}
		}

		$estadoSubsanancion = $this->xindustrial_model->consultar_flujo_estado($datos_tramite->id, 13);

		if($estadoSubsanancion){
			$dateEstadoSubasanacion = date_create($estadoSubsanancion->fecha_estado);
			$fechaEstadoSubsanacion = date_format($dateEstadoSubasanacion,"d/m/Y");
			?>
			<p class="justificado">
				Que la Subdirección de Vigilancia en Salud Publica, mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fechaEstadoSubsanacion?>,
				otorgó plazo de 20 días hábiles para allegar los documentos faltantes para continuar con el trámite de la Licencia de Practica industrial, veterinaria o de investigación Categoría <?php echo $catRomano ?>.
			</p>
			<?php
		}

		//Negación subsanacion primera instancia
		$arregloNegacionPrimeraInstancia = array(16,18,31,34);
		if(in_array($datos_tramite->estado, $arregloNegacionPrimeraInstancia)){
			$respuestaSubsanacion = $this->xindustrial_model->consultar_flujo_estado($datos_tramite->id, 14);

			if($respuestaSubsanacion){
				$daterespuestaSubasanacion = date_create($respuestaSubsanacion->fecha_estado);
				$fecharespuestaSubsanacion = date_format($daterespuestaSubasanacion,"d/m/Y");
				?>
				<p class="justificado">
					Que mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fecharespuestaSubsanacion." ".$tratamiento." ".$nombre_rs?>,
					envío la documentación solicitada por la Subdirección de Vigilancia en Salud Publica, una vez analizada la información,
					se encontraron las siguientes observaciones:
				</p>
				<?php
				if($observaciones != ''){
					echo "<p class='justificado'>".$observaciones."</p>";
				}
			}
		}

		//Negación subsanacion segunda instancia
		$arregloNegacionSegundaInstancia = array(24,25,27,29,36);
		if(in_array($datos_tramite->estado, $arregloNegacionSegundaInstancia)){
			$respuestaSubsanacion = $this->xindustrial_model->consultar_flujo_estado($datos_tramite->id, 14);

			if($respuestaSubsanacion){
				$daterespuestaSubasanacion = date_create($respuestaSubsanacion->fecha_estado);
				$fecharespuestaSubsanacion = date_format($daterespuestaSubasanacion,"d/m/Y");
				//AJUSTAR TEXTO PARA SEGUNDA INSTANCIA
				?>
				<p class="justificado">
					Que mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fecharespuestaSubsanacion." ".$tratamiento." ".$nombre_rs?>,
					envío la documentación solicitada por la Subdirección de Vigilancia en Salud Publica.
				</p>
				<?php
			}
		}

		$respuestaVisita = $this->xindustrial_model->consultar_flujo_estado($datos_tramite->id, 19);
		if($respuestaVisita){
			$daterespuestaVisita = date_create($respuestaVisita->fecha_estado);
			$fecharespuestaVisita = date_format($daterespuestaVisita,"d/m/Y");
			?>
			<p class="justificado">
				Que la Subdirección de Vigilancia en Salud Publica, mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fecharespuestaVisita?>,
				realizo programación de visita de verificación, acorde a lo señalado en la Resolución 482 de 2018, Articulo 24.
			</p>
			<?php
		}

		if($datos_tramite->fecha_visita != ''){
			$dateFechaVisita = date_create($datos_tramite->fecha_visita);
			$fechaVisita = date_format($dateFechaVisita,"d/m/Y");
			?>
			<p class="justificado">
				Que mediante Acta de Visita Inspección Vigilancia y Control del <?php echo $fechaVisita?> se realizó visita de verificación para licenciamiento de Practica
				industrial, veterinaria o de investigación del equipo <?php echo $equipo_doc?> marca <?php echo $rayosxEquipo[0]->marca_equipo?> modelo <?php echo $rayosxEquipo[0]->modelo_equipo?>,
				acorde a lo definido en la resolución 482 de 2018. Se encontraron las siguientes observaciones:
			</p>
			<?php
			if($observaciones_visita != ''){
				?>
				<p class="justificado">
					<?php echo $observaciones_visita?>
				</p>
				<?php
			}
		}

		//Negación subsanacion segunda instancia
		$arregloNegacionSegundaInstancia = array(24,25,27,29,36);
		if(in_array($datos_tramite->estado, $arregloNegacionSegundaInstancia)){
			$respuestaSubsanancionCiu = $this->xindustrial_model->consultar_flujo_estado($datos_tramite->id, 23);

			if($respuestaSubsanancionCiu){
				$daterespuestaSubsanancionCiu = date_create($respuestaSubsanancionCiu->fecha_estado);
				$fecharespuestaSubsanancionCiu = date_format($daterespuestaSubsanancionCiu,"d/m/Y");
				?>
				<p class="justificado">
					Que mediante radicado <?php echo $datos_tramite->id ?> del <?php echo $fecharespuestaSubsanancionCiu." ".$tratamiento." ".$nombre_rs?>, envío la documentación
					solicitada por la Subdirección de Vigilancia en Salud Publica, una vez analizada la información, se encontraron las siguientes observaciones:
				</p>
				<?php
				if($observaciones != ''){
					?>
					<p class="justificado">
						<?php echo $observaciones?>
					</p>
					<?php
				}

			}
		}

	?>
<p class="justificado">
	<ol>
		<li>
			Revisar y dar cumplimiento a los requisitos descritos en el Artículo 33 de la Resolución 482 de 2018.
		</li>
		<li>
			Una vez se cuenten con todos los soportes conforme a lo descrito en el Artículo 33 de la Resolución 482 de 2018, se deberá diligenciar en su totalidad el Anexo 4: “Formato de solicitud de licencia de prácticas industriales, veterinarias o de investigación” contenido en dicha resolución (incluyendo la lista de verificación).
		</li>
		<li>
			Se deberá armar una carpeta en la que se incluyan los soportes en el orden descrito en la lista de verificación, el “Formato de solicitud de licencia de prácticas industriales, veterinarias o de investigación” y la lista de verificación.
		</li>
		<li>
			Este proceso se adelantará conforme a lo descrito en el Artículo 34 de la Resolución 482 de 2018.”
		</li>
	</ol>
	</p>
	<p class="justificado">
    Que se encuentra ampliamente superado el término legal para el aporte de la documentación faltante y el cumplimiento de los requisitos legales por parte del peticionario de la licencia, sin su acatamiento ni solicitud de prórroga alguna, por lo cual se configura la situación descrita en el numeral 34.2. ib. esto es,
    se entiende el desistimiento de la petición de la licencia.<br><br>
		26.3.1. Para las licencias de práctica médica categoría I, se procederá a estudiar la documentación y dentro de los cuarenta y cinco (45) días
		hábiles siguientes, a emitir el acto administrativo.
	</p>
	<p class="justificado">
		Que el Artículo 26. Trámite de las Licencia de Practica industrial, veterinaria o de investigación categoría I o II. Establece el numeral 26.3. Completa la solicitud, se surtirá
		el siguiente procedimiento: 26.3.1. Para las Licencia de Practica industrial, veterinaria o de investigación categoría I, se procederá a estudiar la documentación y dentro de los
		cuarenta y cinco (45) días hábiles siguientes, a emitir el acto administrativo.
	</p>
	<p class="justificado">
		(…) 26.3.4. Rebasado el término del requerimiento o el de la visita, la entidad territorial de salud de carácter departamental o distrital,
		según corresponda, dentro de los cuarenta y cinco (45) días hábiles siguientes, entrará a resolver de fondo la solicitud con la documentación e
		información de que disponga, decisión que será notificada de acuerdo con lo establecido por el Código de Procedimiento Administrativo y de lo
		Contencioso Administrativo y susceptible de los recursos en este contemplados.
	</p>
	<p class="justificado">
		Que, en mérito a lo expuesto, esta Subdirección
	</p>
	<p class="centro">
		RESUELVE:
	</p>
	<p class="justificado">
		<b>ARTÍCULO PRIMERO: </b>Negar la expedición de la Licencia de Practica industrial, veterinaria o de investigación Categoría <?php echo $catRomano ?> a <?php echo $tratamiento?>
		<?php echo $nombre_rs?>, con
		<?php echo $tipo_iden_rs?> <?php echo $nume_iden_rs?>, por las razones expuestas en la parte considerativa de ésta Resolución.
	</p>
	<p class="justificado">
		<b>ARTICULO SEGUNDO: </b>Notificar a <?php echo $nombre_rl?>,
		identificado(a) con <?php echo $tipo_iden_rl?> No <?php echo $nume_iden_rl?>
		<?php
		if($datos_tramite->tipo_identificacion == 5){
			?>
			representante legal de <?php echo $tratamiento." ".$nombre_rs?>, con <?php echo $tipo_iden_rs?> No <?php echo $nume_iden_rs?>,
			<?php
		}
		?>
		o quien haga sus veces, el contenido de la presente
		Resolución, informándole que de conformidad con el artículo 74 del Código de Procedimiento Administrativo y de lo Contencioso Administrativo
		(Ley 1437 de 2011) contra la misma proceden los recursos de reposición y en subsidio apelación, los cuales podrá interponer ante ésta Dirección,
		dentro de los diez (10) días hábiles siguientes a la notificación de este acto administrativo.
	</p>
	<p class="justificado">
	<b>ARTÍCULO TERCERO. RECURSO:</b> contra la presente resolución procede el recurso de reposición, el cual deberá interponerse ante la Subdirección de Vigilancia en Salud Pública
	de la Secretaría Distrital de Salud de Bogotá, D.C., dentro los diez (10) días siguientes a su notificación en los términos señalados en el Código de Procedimiento
	Administrativo y de lo Contencioso Administrativo.
	</p>
	<p class="centro"><b>NOTIFÍQUESE Y CÚMPLASE</b></p>
	<p class="centro">Dado en Bogotá, D.C. a los <?php echo date('d')." días del mes de ".$mes." del a&ntilde;o ".date('Y');?></p>
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

	<?php

	if(isset($codigo_verificacion) && $codigo_verificacion != ''){
		?>
		<p class="justificado">Código de verificación: <?php echo $codigo_verificacion?></p>
		<?php
	}

	?>

</body>
</html>
