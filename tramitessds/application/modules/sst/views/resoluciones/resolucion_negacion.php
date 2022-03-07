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

	.continuacion{
		font-style: italic;
		font-size: 9px;
	}

	.elaboro{
		font-style: italic;
		font-size: 9px;
	}

	ul,ol {
		
	}

	li {
		margin-bottom: 15px;
	}
  </style>
</head>
<body>
<?php

$imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
?>
<htmlpageheader name="firstpage" style="display:none">
	<table class='sinborde centro' width='100%' border='0'>
		<tr class='centro'> 
			<td width='100%'>
				<img src='<?php echo $imagenHeader?>' width='250px'>
			</td>
		</tr>
	</table>
</htmlpageheader>

<htmlpageheader name="otherpages" style="display:none">
	<table class='sinborde centro' width='100%' border='0'>
		<tr class='centro'> 
			<td width='100%' colspan="3">
				<img src='<?php echo $imagenHeader?>' width='250px'>
			</td>
		</tr>
		<tr class="justificado">
			<td width='5%'></td>
			<td width='90%' class="justificado">
				<p class="continuacion">
					<?php
					if($tramite_info->tipo_identificacion == 5){
						?>
						Continuación de la Resolución No <?php echo $nume_resolucion?> de <?php echo date('d/m/Y')?> por  la cual se niega 
						Licencia de Prestación de Servicios de Seguridad y Salud en el Trabajo a la entidad <?php echo $tramite_info->nombre_rs?>.	
						<?php
					}else{
						?>
						Continuación de la Resolución No <?php echo $nume_resolucion?> de <?php echo date('d/m/Y')?> por la cual se niega Licencia de Prestación de Servicios de Seguridad y Salud en el Trabajo
						<?php
					}
					?>					
				</p>
			</td>
			<td width='5%'></td>
		</tr>
	</table>
</htmlpageheader>



<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" />
<div id="header">
</div>
  <div style="width:100%;">
      <div style="margin-left:45px;margin-right:35px;margin-top:-30px;">
	    <p class="centro">
            <br><b>DIRECCIÓN DE CALIDAD DE SERVICIOS DE SALUD <br> SUBDIRECCIÓN INSPECCIÓN, VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD</b>
        </p>
        <p class="centro">
            <b>Resolución No. <?php echo $nume_resolucion?> de <?php echo date('d/m/Y')?><b>
        </p>
		<p class="centro">
			"Por la cual se niega Licencia de Prestación de Servicios en Seguridad y  Salud en el Trabajo"
		</p>    
		<p class="centro">
            LA SUBDIRECTORA DE INSPECCION, VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD
		</p>    
		<p class="justificado">
			En uso de sus facultades legales conferidas en los artículos 23 de la ley 1562 de 2012 y 1o. de la Resolución 4502  del  28  de  diciembre  de  2012  del  
			Ministerio  de  Salud  y Protección  Social  y en especial por las que le confiere el Decreto 507 del 6 de noviembre de 2013 de la Alcaldía Mayor de Bogotá y,
		</p>  
		<p class="centro">
            <b>CONSIDERANDO:</b>
        </p>  
		<p class="justificado">
			<?php			
				$fecha_creacion = date_create($tramite_info->fecha_creacion);
				$formatoFechaCreacion = date_format($fecha_creacion, 'd/m/Y');

				if($tramite_info->tipo_identificacion == 5){
					if($tramite_info->ciudad_resi != ''){
						$mpio = $this->sst_model->consulta_municipio($tramite_info->ciudad_resi);
						if($mpio){
							$municipio_resi = $mpio->Descripcion;
						}else{
							$municipio_resi = 'Bogotá D.C';
						}
					}else{
						$municipio_resi = 'Bogotá D.C';
					}
				?>
					Que la entidad <?php echo $tramite_info->nombre_rs?>,  identificada  con  NIT <?php echo $tramite_info->nume_identificacion?>, 
					ubicada en la <?php echo $tramite_registro->direccion_entidad?>   de  la ciudad de <?php echo $municipio_resi?>, representada legalmente por 
					<?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, identificado(a) con <?php echo $tramite_info->codigoidenrl?> No. 
					<?php echo $tramite_info->nume_iden_rl?>, solicitó a  través  del  canal virtual de  la  entidad,  el  día <?php echo $formatoFechaCreacion?> expedición  de  Licencia  
                    para prestación de servicios en Seguridad y Salud en el Trabajo, en las áreas o campos de acción: “<?php echo $tramite_registro->servicios?>”.
				<?php
				}else{
				?>
					Que el (la) señor(a)  <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>,  
					identificado(a) con <?php echo $tramite_info->descTipoIden?> <?php echo $tramite_info->nume_identificacion?>, solicitó a través del canal virtual de la entidad el día <?php echo $formatoFechaCreacion?>, 
                    Licencia para prestación de servicios en Seguridad y Salud en el Trabajo como Persona Natural, quien anexa copia de título como <?php echo $tramite_registro->titulo_programa?>.
				<?php
				}
			?>			
        </p>  		
		<?php
			if($tramite_info->tipo_identificacion == 5){					
			?>
				<p class="justificado">
                    Que  de  conformidad  con  el  artículo  2  de  la  Resolución  4502  del  28 de  diciembre  de  2012, expedida  por  el  Ministerio  de  Salud  y  Protección  Social,  
                    por  la  cual  se  reglamenta  el procedimiento  y  los  requisitos  para  el  otorgamiento  y  renovación  de  las  licencias  de  salud ocupacional  y  se  dictan  
                    otras  disposiciones,  consagro: “...Requisitos.  El  otorgamiento  y renovación de las licencias de salud ocupacional a las personas naturales o jurídicas públicas o 
                    privadas que oferten a nivel nacional, servicios de seguridad y salud en el trabajo, estará sujeto al cumplimiento de los siguientes requisitos:
				</p>
				<p class="justificado cursiva">
                    “(...)”
				</p>
				<p class="justificado cursiva">
					<b>
                    B. Personas Jurídicas:
                    </b>				
                </p>
                <p class="justificado cursiva">
                    <ol>
                        <li class="justificado cursiva">
                            Relación de las personas vinculadas a la persona jurídica pública o privada que cuenten con   licencia   vigente   en   salud   ocupacional,   ya   sean   profesionales 
                            con   postgrado, profesionales, tecnólogos o técnicos profesionales, todos ellos con títulos en un área de salud ocupacional,  obtenidos  en  una  institución  de  
                            educación  formal  superior  debidamente aprobada por el Ministerio de Educación Nacional. 
                        </li>
                        <li class="justificado cursiva">
                            Relación de los equipos e Instalaciones destinadas a garantizar la prestación de servicios en  las  áreas  de  seguridad  y  salud  en  trabajo.  indicando  sus características, 
                            laboratorios. materiales y demás elementos que se utilizarán para la prestación de los servicios de salud ocupacional.
                        </li>
                        <li class="justificado cursiva">
                            Los equipos destinados a la prestación de servicios en las áreas de seguridad y salud en el  trabajo  deben  estar  calibrados  de  acuerdo  con  las  recomendaciones  del  fabricante, 
                            pudiendo  ser  propios,  arrendados  u  obtenidos  mediante  contrato  de  uso,  pero  siempre debiendo acreditar su disponibilidad para la prestación de los mencionados 
                            servicios.
                        </li>
                        <li class="justificado cursiva">
                            Certificado de existencia y/o representación legal de la persona jurídica pública o privada que solicita la licencia, en el que se señalen las características básicas de los 
                            servicios que pretende ofertar.
                        </li>
                    </ol>
                </p>
				<p class="justificado">
                    Así mismo, la citada norma señala:
				</p>
				<p class="justificado">
                    <span class="cursiva">"(...)Artículo  9.  Vigilancia  y  Control. Las  Secretarias  Seccionales  y  Distritales  de  Salud, vigilarán y controlarán el cumplimiento de las disposiciones en la 
                    presente resolución...”</span>, por lo cual,  ésta  Secretaría  realizó  revisión  documental  con  el  fin  de  verificar  el  cumplimiento  de  los requisitos para la 
                    expedición de licencia para prestar servicios en Seguridad y Salud en el Trabajo como persona jurídica.
				</p>
				<p class="justificado">
                    <?php echo $observaciones?>
				</p>
				<p class="justificado">
					En  mérito  de  lo  expuesto,
				</p>
				<p class="centro">
					<b>RESUELVE:</b>
				</p>
				<p class="justificado">
					ARTICULO  PRIMERO:  Negar la  expedición Licencia  de  Prestación  de  Servicios  en  Seguridad  y  Salud  en  el  Trabajo  a 
					<?php echo $tramite_info->nombre_rs?>, identificada con  NIT  <?php echo $tramite_info->nume_identificacion?>,   ubicada en la <?php echo $tramite_registro->direccion_entidad?>   de  la ciudad de <?php echo $municipio_resi?>, representada legalmente por <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
					identificado(a) con <?php echo $tramite_info->codigoidenrl?> No <?php echo $tramite_info->nume_iden_rl?>, por las razones expuestas en la parte considerativa de esta resolución.
				</p>
				<p class="justificado">
                    ARTICULO SEGUNDO: Notificar esta Resolución a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
                    informándole que de conformidad con el artículo 74 del Código de Procedimiento 
                    Administrativo y de lo Contencioso Administrativo (Ley 1437 de 2011) contra la misma proceden los recursos de reposición y en subsidio apelación, los cuales podrá 
                    interponer ante esta Secretaría, dentro de los diez (10) días hábiles siguientes a la notificación de este acto administrativo.
				</p>
			<?php
			}else{
			?>
				<p class="justificado">
                    Que de conformidad con la Resolución 4502 del 28 de diciembre de 2012, expedida por el Ministerio de  Salud  y  Protección  Social,  por  la  cual  se  reglamenta  el  
                    procedimiento  y  los  requisitos  para  el otorgamiento  y  renovación  de  las  licencias de  salud  ocupacional y  se  dictan otras  disposiciones, establece:
				</p>
                <p class="justificado cursiva">
                    <b>“...Artículo2. Requisitos.</b>El otorgamiento y renovación de las licencias de salud ocupacional a las personas naturales o jurídicas públicas o privadas que 
                    oferten a nivel nacional, servicios de seguridad y saluden el trabajo, estará sujeto al cumplimiento de los siguientes requisitos:
				</p>
                <p class="justificado cursiva">
                    <b>A. Personas Naturales: </b>
				</p>
                <p class="justificado cursiva">
                    <ol>
                        <li class="justificado cursiva">Fotocopia de los títulos o diplomas debidamente legalizados que demuestren el nivel académico otorgado  por  la  institución  de  educación  superior  debidamente  aprobada  por  el  Ministerio  de Educación Nacional, en cualquiera de las siguientes modalidades de formación académica: </li>
                        
                        <ol type="a">
                            <li class="justificado cursiva">
                                Profesional  Universitario  con posgrado  en  área  de  salud  ocupacional,  con  título  obtenido  en una  institución  de  educación  superior  debidamente  aprobada  por  el  Ministerio  de  Educación Nacional.
                            </li>
                            <li class="justificado cursiva">
                                Profesional Universitario en un área de salud ocupacional, con título obtenido en una Institución de  educación  superior  debidamente  aprobada  por  el  Ministerio  de  Educación  Nacional.
                            </li>
                            <li class="justificado cursiva">
                                Tecnólogo en Salud Ocupacional con título obtenido en unainstitución de educación superior debidamente aprobada por el Ministerio de Educación Nacional.
                            </li>
                            <li class="justificado cursiva">
                                Técnico  en  Salud  Ocupacional  con  título  obtenido  en  una  institución  de  educación  superior debidamente aprobada por el Ministerio de Educación Nacional...”.
                            </li>
                        </ol>
                    
                        <li class="justificado cursiva">
                            Fotocopia  del  documento  que  demuestre  que  el  programa  académico  cursado  es  de  educación formal de carácter superior, conforme a lo establecido en las Leyes 30 de 1992 y 115 de 1994 o las que modifiquen adicionen o sustituya.
                        </li>
                        <li class="justificado cursiva">
                            Fotocopia del pensum académico o asignaturas aprobadas que soporten los campos de acción de su formación...".
                        </li>
                    </ol>
				</p>
                <p class="justificado">
					<?php echo $observaciones?>
				</p>
				<p class="justificado">
					En mérito de lo expuesto,
				</p>
				<p class="centro">
					<b>RESUELVE:</b>
				</p>
				<p class="justificado">
					ARTICULO  PRIMERO:  Negar  la expedición de Licencia de  Prestación  de  Servicios  en  Seguridad  y  Salud  en  el  Trabajo  a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
					Identificado(a) con <?php echo $tramite_info->descTipoIden?> <?php echo $tramite_info->nume_identificacion?>, por las razones expuestas en la parte considerativa de esta resolución.
				</p>				
				<p class="justificado">
					ARTICULO SEGUNDO: Notificar esta Resolución a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?> 
					informándole que de conformidad con el artículo 74 del Código   de   Procedimiento   Administrativo   y     de   lo   
					Contencioso Administrativo  (Ley  1437  de  2011)  contra  la  misma  proceden  los  recursos  de  reposición  y    en  subsidio apelación, los cuales 
					podrá interponer ante esta Secretaría, dentro de los diez (10) días hábiles siguientes a la notificación de este acto administrativo.
				</p>
			<?php
			}
		?>
        <p class="centro">
            <b>NOTIFIQUESE Y CUMPLASE</b>
        </p>
        <p class="centro">
			Dada en Bogotá, D.C. a los <?php echo date('d/m/Y');?>
		</p> 
		<br><br><br>
		<?php
	
		if($firma == TRUE){
			?>
			<img src="<?php echo FCPATH.'assets/imgs/firma_draDora.JPG'?>" width="300px"><br>
			<?php
		}
		
		?>
		<p class="justify"><b>DORA DUARTE PRADA</b></p>
        <p class="justificado">Subdirectora Inspección, Vigilancia y Control de Servicios de Salud</p>
		<?php
	
		if(isset($codigo_verificacion) && $codigo_verificacion != ''){
			?>
			<p class="justificado">Código de verificación: <?php echo $codigo_verificacion?></p>
			<?php
		}
		
		if($firma == TRUE){

			$firmaValidador = $this->sst_model->usuario_valida_tramites($id_tramite);

			if($firmaValidador){
				$fValidador = $firmaValidador->username;
			}else{
				$fValidador = '';	
			}

			$firmaCoordinador = $this->sst_model->usuario_coordinador_tramites($id_tramite);

			if($firmaCoordinador){
				$fCoordinador = $firmaCoordinador->username;
			}else{
				$fCoordinador = '';	
			}

			$id_usuario = $this->session->userdata('id_usuario');
			$firmaDirector = $this->sst_model->usuario_director_tramites($id_usuario);

			if($firmaDirector){
				$fDirector = $firmaDirector->username;
			}else{
				$fDirector = '';	
			}


		}else{
			$fValidador = '';
			$fCoordinador = '';
			$fDirector = '';
		}

		?>
		<p class="justificado elaboro">Elaboró: <?php echo $fValidador?></p>
		<p class="justificado elaboro">Revisó: <?php echo $fCoordinador?></p>
		<p class="justificado elaboro">Aprobó: <?php echo $fDirector?></p>		
		
      </div>
  </div>
  <div id="footer" style="margin-left:45px;margin-right:45px">
  </div>

</body>
</html>		  