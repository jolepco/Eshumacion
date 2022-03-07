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
      <div style="margin-left:45px;margin-right:45px;margin-top:-50px;">
		<p align="justify">Que examinada la documentación allegada se encontró que se cumple con los requisitos exigidos por
          la Resolución 482 de 2018 y demás normas vigentes relacionadas con la protección de las personas expuestas a las
          Radiaciones Ionizantes, expedidas por el Ministerio de Salud y Protección Social.</p>

		  <?php
			if($datos_tramite->categoria == 2){
				?>
					<p align="justify">Que realizada la visita de verificación con enfoque de riesgo a las instalaciones del interesado se evidenció que cumple con los requisitos. </p>
				<?php
			}

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

		  ?>

        <p align="justify">En mérito a lo expuesto, este Despacho</p>
        <p align="center"><b>RESUELVE:</b></p>
        <p align="justify"><b>ARTÍCULO PRIMERO:</b> Conceder licencia de practicas industriales, veterinaria o de investigación de categoría <?php echo $categoria_romano?> a <?php echo $nombre_rs?>
          ubicada en la <?php echo $rayosxDireccion->dire_entidad?> representado legalmente por el señor (a) <?php echo $nombre_rl ?> identificado(a) con
           <?php echo $tipo_iden_rl?> número <?php echo $nume_iden_rl?></p>
        <p align="justify"><b>ARTÍCULO SEGUNDO:</b> El Nombre del Oficial o Encargado de Protección Radiológica es:</p>

		<table style="border-collapse: collapse;" width="100%">
			<tr>
				<td style="border:1px solid black;">NOMBRE</td>
				<td style="border:1px solid black;">IDENTIFICACIÓN</td>
				<td style="border:1px solid black;">PROFESIÓN</td>
			</tr>
			<tr>
				<td style="border:1px solid black;"><?php echo $rayosxOficialToe->encargado_papellido." ".$rayosxOficialToe->encargado_sapellido." ".$rayosxOficialToe->encargado_pnombre." ".$rayosxOficialToe->encargado_snombre?></td>
				<td style="border:1px solid black;"><?php echo $rayosxOficialToe->encargado_ndocumento?></td>
				<td style="border:1px solid black;"><?php echo $rayosxOficialToe->encargado_profesion?></td>
			</tr>
		</table>
        <p align="justify"><b>ARTÍCULO TERCERO:</b> El (los) equipo (s) que allí funciona (n) es (son):</p>
          <?php

            for($i=0;$i<count($rayosxEquipo);$i++){

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
				<br>
				<table style="border-collapse: collapse;" width="100%">
					<tr>
						<td style="border:1px solid black;">Clase de Equipo:</td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($equipo_doc, 'UTF-8')?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Categoria de Equipo:</td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($desc_categoria, 'UTF-8')?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Marca: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->marca_equipo)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Modelo: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->modelo_equipo)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Serie: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->serie_equipo)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Tubo: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->marca_tubo_rx)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Modelo Tubo: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->modelo_tubo_rx)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Serie Tubo: </td>
						<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->serie_tubo_rx)?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Tensión Máxima tubo RX [Kv]: </td>
						<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->tension_tubo_rx?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Corriente Máxima tubo RX [mA]: </td>
						<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->contiene_tubo_rx?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Energía Fotones[MeV]: </td>
						<td style="border:1px solid black;"> <?php echo $rayosxEquipo[$i]->energia_fotones?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Energía Electrones [MeV]: </td>
						<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->energia_electrones?></td>
					</tr>
					<tr>
						<td style="border:1px solid black;">Carga de trabajo [mA.min/semana]: </td>
						<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->carga_trabajo?></td>
					</tr>
					<?php

						if($rayosxEquipo[$i]->marca_tubo_rx2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Tubo 2: </td>
								<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->marca_tubo_rx2)?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->modelo_tubo_rx2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Modelo Tubo 2: </td>
								<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->modelo_tubo_rx2)?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->serie_tubo_rx2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Serie Tubo 2: </td>
								<td style="border:1px solid black;"><?php echo mb_strtoupper($rayosxEquipo[$i]->serie_tubo_rx2)?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->tension_tubo_rx2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Tensión Máxima tubo 2 RX [Kv]: </td>
								<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->tension_tubo_rx2?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->contiene_tubo_rx2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Corriente Máxima tubo 2 RX [mA]: </td>
								<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->contiene_tubo_rx2?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->energia_fotones2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Energía Fotones[MeV]: </td>
								<td style="border:1px solid black;"> <?php echo $rayosxEquipo[$i]->energia_fotones2?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->energia_electrones2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Energía Electrones [MeV]: </td>
								<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->energia_electrones2?></td>
							</tr>
							<?php
						}

						if($rayosxEquipo[$i]->carga_trabajo2 != ''){
							?>
							<tr>
								<td style="border:1px solid black;">Carga de trabajo [mA.min/semana]: </td>
								<td style="border:1px solid black;"><?php echo $rayosxEquipo[$i]->carga_trabajo2?></td>
							</tr>
							<?php
						}

					?>
				</table>
                <?php
            }

		  if($datos_tramite->categoria == 1){
			  $termino = "CINCO (5)";
		  }else{
			  $termino = "CUATRO (4)";
		  }

          ?>



        <p align="justify"><b>ARTÍCULO CUARTO:</b> La presente licencia se concede por el término de <?php echo $termino?> años, contados a partir
          de la fecha de expedición del presente acto administrativo, y podrá ser renovada por un término igual mediante solicitud
          presentada con sesenta (60) días de antelación de su vencimiento, de conformidad con los artículos 22 y 35 de la
          Resolución 482 de 2018.</p>
        <p align="justify"><b>ARTÍCULO QUINTO:</b> Conforme al Artículo 38 de la Resolución 482 de 2018 el titular de la licencia de practicas industriales,
			veterinaria o de investigación categoría I o II podrá solicitar la modificación de algunas de las condiciones que se señalan en el
          literal 38.1 y literal 38.2.</p>
        <p align="justify"><b>ARTÍCULO SEXTO:</b> Notificar el contenido de esta providencia al representante legal, o a un tercero
          debidamente autorizado, de conformidad con lo dispuesto en los artículos 67 y 69 del Código  de Procedimiento
          Administrativo y de lo Contencioso Administrativo, haciéndole (s) saber que contra la presente proceden los recursos
          de reposición ante este Despacho y de apelación ante el Secretario Distrital de Salud, dentro de los cinco (5) días
          siguientes a la notificación del presente acto administrativo, de conformidad con lo establecido en el Artículo 74
          del Código  de Procedimiento Administrativo y de lo Contencioso Administrativo.</p>
        <p align="center"><b>NOTIFÍQUESE Y CÚMPLASE</b></p>
        <p align="center">Dado en Bogotá, D.C. a los <?php echo date('d/m/Y');?></p>
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

      </div>
  </div>
  <div id="footer" style="margin-left:45px;margin-right:45px">



  </div>

</body>
</html>
