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
  </style>
</head>
<body>
<div id="header">
  <!--<img src="./assets/img/memologo.jpg" />-->
  <!--<img src="<?php echo FCPATH.'assets/imgs/logo_pdf_alcaldia.png'?>" width="70px">-->
</div>
  <div style="width:100%;">
      <div style="margin-left:45px;margin-right:35px;margin-top:-30px;">
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

		?>
        <p align="center">
            <br><b><em>Dirección de Epidemiología, Análisis y Gestión de Políticas de Salud Publica<br>
				Subdirección de Vigilancia en Salud Publica</em>
                </b>
        </p>
        <p align="center">
            <b><em>Resolución No. <?php echo $nume_resolucion?> del <?php echo date('d')." de ".$mes." del ".date('Y');?><br>
              "Por la cual se concede una LICENCIA DE PRÁCTICA VETERINARIA, INDUSTRIAL O DE INVESTIGACIÓN CATEGORÍA <?php echo $datos_tramite->categoria?> PARA USO DE EQUIPOS EMISORES DE RADIACIÓN IONIZANTES, según el numeral 4.9 del artículo 4º de la Resolución No. 482 de 2018"
              </em></b>
        </p>
        <p align="center">
          <b>LA SUBDIRECTORA DE VIGILANCIA EN SALUD PÚBLICA</b><br>
          En uso de sus facultades legales, en especial las conferidas por el Decreto No. 507 de 2013, la Resolución 482 de 2018 y el artículo 151 de la Ley 9 de 1979,
          modificado por el artículo 91 del Decreto Ley 2106 de 2019,
        </p>

        <p align="center"><b>CONSIDERANDO:</b></p>
        <p align="justify">Que mediante Resolución No. 482 del 22 de febrero de 2018, el Ministerio de
          Salud y Protección Social reglamentó el uso de equipos generadores de radiación ionizante, su control
          de calidad, la prestación de servicios de protección radiológica y se dictan otras disposiciones
          regulando las autorizaciones y licencias de funcionamiento y establece:</p>
        <p align="justify">Que el Artículo 31 de la Resolución 482 de 2018 estable: Licencias de practicas industriales, veterinaria o de investigación.
          Los interesados en realizar una práctica industrial, veterinaria o de investigación que haga uso de equipos
          generadores de radiación ionizante, móviles o fijos, deberán solicitar la correspondiente licencia ante
          la entidad territorial de salud de carácter departamental o distrital de la jurisdicción en la que se
          encuentre la respectiva instalación. </p>
        <p align="justify">Que mediante el Artículo 32 de la Resolución 482 de 2018 se categorizaron las prácticas
          médicas así:</p>
        <p align="justify">
          32.1. Categoría I:<br>
          32.1.1. Radiología industrial de baja complejidad. <br><br>
          32.2. Categoría II: <br>
          32.2.1. Radiología industrial de alta complejidad. <br>
          32.2.2. Radiología veterinaria. <br>
          32.2.3. Radiología en investigación<br>
        </p>
        <p align="justify">Parágrafo. Las prácticas industriales, veterinaria o de investigación que no se encuentren expresamente señaladas en el presente
          artículo, se considerarán como categoría II.”</p>
        <p align="justify">Que de conformidad con el artículo 33 de la resolución 482 de 2018 corresponde a las
          entidades territoriales de salud otorgar las licencias de practicas industriales, veterinaria o de investigación, a solicitud de los interesados.</p>
		<?php
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

				$tipo_iden_rs = $datos_tramite->descTipoIden;
				$nume_iden_rs = $datos_tramite->nume_identificacion;
			}

			if($datos_tramite->categoria == 1){
				  $categoria_romano = "I";
			  }else{
				  $categoria_romano = "II";
			  }

			$exd = date_create($datos_tramite->fecha_envio);
			$fecha_radicado = date_format($exd,"Y-m-d");//here you make mistake

		?>
        <p align="justify">Que el (la) señor(a) <?php echo $nombre_rl?>,
            identificado(a) con <?php echo $tipo_iden_rl?> número <?php echo $nume_iden_rl?> en su
			calidad de Representante Legal, mediante radicado No <?php echo $datos_tramite->id?> de fecha <?php echo $fecha_radicado?> ha solicitado licencias de practicas industriales,
			veterinaria o de investigación de categoría <?php echo $categoria_romano." ".$desc_categoria?>, para <?php echo $nombre_rs." - ".$rayosxDireccion->sede_entidad?>
            identificado (a) con <?php echo $tipo_iden_rs?> número <?php echo $nume_iden_rs?>, ubicado (a) en la
          <?php echo $rayosxDireccion->dire_entidad?> de la nomenclatura urbana de Bogotá, de acuerdo a los preceptos de la Resolución 482 de 2018.</p>


      </div>
  </div>
  <div id="footer" style="margin-left:45px;margin-right:45px">



  </div>

</body>
</html>
