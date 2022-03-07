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
  <!--<img src="<?php //echo FCPATH.'assets/imgs/logo_pdf_alcaldia.png'?>" width="70px">-->
</div>
  <div style="width:100%;">
      <div style="margin-left:45px;margin-right:35px;margin-top:-30px;">
	    <p align="center">
            <br><b><em>SECRETARÍA DISTRITAL DE SALUD BOGOTA, D.C.</b>
        </p>
        <p align="center">
            <b><em>Resolución No. <?php echo $nume_resolucion?> del <?php echo $dia." de ".$mes." de ".$anio;?><br>
              "POR LA CUAL SE EXPIDE UNA CREDENCIAL DE EXPENDEDOR DE DROGAS"<br>
              LA SUBDIRECCIÓN INSPECCIÓN VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD
              </em></b>
        </p>
        <p align="justify">En uso de las facultades  conferidas mediante Resolución No. 13370 de 1990 del Ministerio de Salud, y resolución 001390 del 10 de marzo de 1997.</p>
        <p align="center"><b>CONSIDERANDO:</b></p>
        <?php
		
		$nombre_rs = $datos_tramite->nombre_rs;
		$nombre_rl = $info[0]->p_nombre." ".$info[0]->s_nombre." ".$info[0]->p_apellido." ".$info[0]->s_apellido;
		switch ($info[0]->tipo_identificacion) {
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
		
		
			
			
			$exd = date_create($datos_tramite->fecha_envio); 
			$fecha_radicado = date_format($exd,"Y-m-d");
			
		?>
        <p align="justify">Que ante esta entidad, <?php echo $nombre_rl?>, 
            identificado(a) con <?php echo $tipo_iden_rl?> número <?php echo $info[0]->nume_identificacion?>, solicitó la expedición de la Credencial que lo acredita como Expendedor de Drogas.<br>
        	Que revisados los documentos aportados por el peticionario, se constató que estos cumplen con los requisitos exigidos por la resolución 13370 de 1990 y decreto 1070 de 1990 del Ministerio de Salud.
        </p>
		<p>
			En mérito de lo expuesto,
		</p> 
		<p align="center">
            <b><em>RESUELVE</em></b>
        </p>
	    <p align="justify">
	    	<b>ARTÍCULO PRIMERO:</b> Expedir la Credencial de Expendedor de Drogas a  <?php echo $nombre_rl?> con <?php echo $tipo_iden_rl?> número <?php echo $info[0]->nume_identificacion?> que lo autoriza para dirigir el establecimiento denominado DROGUERÍA.
	        </p>
	        <p align="justify"><b>ARTÍCULO SEGUNDO:</b> Esta credencial NO FACULTA a su titular para ejercer actos propios de la Farmacia y Medicina, de conformidad con lo estipulado por el decreto 1070 de 1990 del Ministerio de Salud.
        </p>
        <p align="justify">
        	<b>ARTICULO TERCERO:</b> Notifíquese electrónicamente el contenido de la presente Resolución a <?php echo $nombre_rl; ?> con <?php echo $tipo_iden_rl; ?> número <?php echo $info[0]->nume_identificacion; ?>, o a quien haga sus veces, haciéndole saber que, contra la misma sólo procede el recurso de reposición ante esta Subdirección, el cual deberá interponerse dentro de los diez (10) días siguientes a la notiﬁcación electrónica, por medio de la plataforma virtual mediante la cual se llevó a cabo el  trámite inicial o por escrito.
        </p>
        <p align="center">
            <b><em>COMUNIQUESE Y CUMPLASE</em></b>
        </p>
        <p>
			Dada en Bogotá, D.C. a los <?php echo $dia." dias del mes de ".$mes." del ".$anio.".";?>
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