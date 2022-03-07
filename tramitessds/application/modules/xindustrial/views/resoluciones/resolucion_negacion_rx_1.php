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
	<p class="centro">
		<br><b><em>Dirección de Epidemiología, Análisis y Gestión de Políticas de Salud Publica<br>
				Subdirección de Vigilancia en Salud Publica</em>
			</b>
	</p>
	<p class="centro">
		<b><em>
      "Por la cual se niega una LICENCIA DE PRÁCTICA VETERINARIA, INDUSTRIAL O DE INVESTIGACIÓN CATEGORÍA <?php echo $datos_tramite->categoria?> PARA USO DE EQUIPOS EMISORES DE RADIACIÓN IONIZANTE, según el numeral 4.9 del artículo 4º de la Resolución No. 482 de 2018"
		  </em></b>
	</p>
	<p class="justificado">En uso de sus facultades legales conferidas en el Decreto 507 del 06 de noviembre de 2013 de la Alcaldía Mayor de Bogotá y
	Resolución 482 de 2018,</p>
	<p class="centro">CONSIDERANDO: </p>
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

		$dateFechaTramite = date_create($estadoSubsanancion->fecha_estado);
		$fechaFechaTramite = date_format($dateFechaTramite,"d/m/Y");

		$exd = date_create($datos_tramite->fecha_envio);
		$fecha_radicado = date_format($exd,"d/m/Y");//here you make mistake

	?>
	<p class="justificado">
		Que <?php echo $tratamiento." ".$nombre_rs?>,
		con <?php echo $tipo_iden_rs?> <?php echo $nume_iden_rs?>, solicitó mediante radicado <?php echo $datos_tramite->id?>
		del <?php echo $fecha_radicado?>, Solicitud de la Licencia de Practica industrial, veterinaria o de investigación, para el equipo de rayos X <?php echo $equipo_doc?>
		marca <?php echo $rayosxEquipo[0]->marca_equipo?> modelo <?php echo $rayosxEquipo[0]->modelo_equipo?>, quien anexa los documentos que soportan su solicitud.
	</p>
	<p class="justificado">
		Que de conformidad con la Resolución 482 del 22 de febrero de 2018, expedida por el Ministerio de Salud y Protección Social, por la cual se reglamenta
		el uso de equipos generadores de radiación ionizante, su control de calidad, la prestación de servicios de protección radiológica y se dictan otras
		disposiciones, establece:
	</p>
	<p><?php echo $observaciones ?>
	</p>
	<p class="justificado">
		Artículo 34. Trámite de la solicitud para el otorgamiento de la licencia de prácticas industriales, veterinarias o de investigación. El estudio de la documentación para el otorgamiento de la licencia de prácticas industriales, veterinarias o de investigación categoría I o II, estará sujeto al siguiente procedimiento:
	</p>
	<p class="justificado">
		34.1. Radicada la solicitud en el formato dispuesto en el Anexo No. 4, con los documentos requeridos en los artículos 21 o 33, según la categoría, la entidad
		territorial de salud departamental o distrital, según corresponda, procederá a revisarla dentro de los veinte (20) días hábiles siguientes y,
		de encontrar la documentación incompleta, requerirá al solicitante para que la suministre dentro de los veinte (20) días hábiles siguientes.
	</p>
	<p class="justificado">
		34.2. Si no se completa la solicitud, se entenderá que se desiste de esta, salvo que antes de vencer el plazo concedido, el peticionario solicite
		prórroga, la cual se concederá hasta por un término igual.
	</p>
	<p class="justificado">
		34.3. Completa la solicitud ya sea desde la presentación inicial o como resultado de la respuesta al requerimiento, la entidad territorial de salud de carácter departamental o
		distrital, procederá a estudiar la documentación y podrá realizar visita previa con enfoque de riesgo, para verificación de los requisitos establecidos en el articulo 33 de la presente
		resolución. Posterior a ello, dentro de los cuarenta y cinco (45) días hábiles siguientes, entrará a resolver de fondo la solicitud, decisión que será notificada de acuerdo con lo establecido por el Código de Procedimiento Administrativo y de lo
		Contencioso Administrativo y susceptible de los recursos en este contemplados.
	</p>
	<p class="justificado">
  Que el interesado, inició el trámite correspondiente en aras de cumplir lo señalado en el artículo 33 “Requisitos para obtener la licencia de prácticas industriales, veterinarias
  o de investigación” ibídem, para lo cual diligenció el formato No. 4 y anexó una documentación.<br><br>
  Que, verificada la no completitud de los requisitos legales, mediante correo electrónico de 23 de junio de 2020, la entidad ofició al solicitante al solicitante para que en los términos del artículo 34 ib, procediera a:<br>

  </p>

</body>
</html>
