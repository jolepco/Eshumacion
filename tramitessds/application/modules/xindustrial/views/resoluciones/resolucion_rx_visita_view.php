
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
		
		.subrayado{
			text-decoration: underline black;
		}
</style>
</head>

<body>
	<?php 
	
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
	<p>
		22100<br>
		Bogotá D.C.<br><br>
		Señor(a)<br>
		<?php echo $nombre_rl?><br>
		<?php echo $datos_tramite->email?><br>
		<?php echo $datos_tramite->dire_resi?><br>
		Bogotá D.C
	</p>
	<p>
		Asunto: Respuesta Radicado No <?php echo $datos_tramite->id?> del <?php echo $fecha_radicado?>
	</p>		
	<p class="justificado">
		Cordial Saludo:	
	</p>
	<p class="justificado">
		En respuesta a su solicitud y en virtud de la Resolución 482 de 2018, la cual establece Articulo 34: <font class="cursiva">“Tramite de la solicitud para el otorgamiento de la licencia de 
		Practica industrial, veterinaria o de investigación categoría I o II. El estudio de la documentación para el otorgamiento de la licencia de Practica industrial, veterinaria o de investigación categoría I o II estará sujeto al siguiente 
		procedimiento: </font>
	</p>
	<p><?php echo $observaciones ?>
	</p>	
	<p class="justificado">
		26.3.2. Para las licencias de practica medica categoría II <font class="cursiva"><font class="subrayado">se programara visita con  enfoque de riesgo</font>, encaminada a la verificación de los requisitos 
		a que refiere el artículo 24, <font class="subrayado">la cual se realizara en un término no superior a sesenta (60) días hábiles</font>, contado a partir de la radicación de la 
		solicitud o de la complementación de esta, según sea el caso”. </font>(Subrayado fuera de texto).
	</p>
	<p class="justificado">
		Por lo anterior me permito informarle que la visita con enfoque de riesgo será programada de acuerdo a los términos legales establecidos. 
	</p>		
	<p class="justificado">
		Cordialmente,
	</p>
	<br><br>
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