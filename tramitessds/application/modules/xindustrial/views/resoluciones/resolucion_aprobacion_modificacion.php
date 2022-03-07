<html>
<head>
  <title>Aprobación Modificación - Tramites en Linea . SDS</title>
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
</div>
  <div style="width:100%;">
      <div style="margin-left:45px;margin-right:35px;margin-top:-30px;">
	    <p class="centro">
            <br><b>DIRECCIÓN DE CALIDAD DE SERVICIOS DE SALUD <br>SUBDIRECCIÓN INSPECCIÓN, VIGILANCIA Y CONTROL DE SERVICIOS DE SALUD</b>
        </p>
        <p class="centro">
            <b>Resolución No. <?php echo $nume_resolucion?> de <?php echo date('d/m/Y')?><b>
        </p>
		<p class="centro">
			"Por la cual se Modifica Licencia de Prestación de Servicios en Seguridad y Salud en el Trabajo"
		</p>    
		<p class="centro">
			LA DIRECTORA DE CALIDAD DE SERVICIOS DE SALUD
		</p>    
		<p class="justificado">
			En uso de sus facultades legales conferidas en los artículos 23 de la ley 1562 de 2012 y 1o. de la Resolución 4502  del  28  de  diciembre  de  2012  del  Ministerio  de  
            Salud  y Protección  Social  y en especial por las que le confiere el Decreto 507 del 6 de noviembre de 2013 de la Alcaldía Mayor de Bogotá y,
		</p>  
		<p class="centro">
            <b>CONSIDERANDO:</b>
        </p>  
		<p class="justificado">
			<?php
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
					ubicada en la <?php echo $tramite_info->dire_resi?>   de  la ciudad de <?php echo $municipio_resi?>, representada legalmente por 
					<?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, identificado(a) con CC No. 
                    <?php echo $tramite_info->nume_iden_rl?>, ha solicitado la modificacion de la Licencia de Prestación de Servicios en Seguridad y Salud en el Trabajo como Persona Jurídica por 
                    <?php                   
                        if($tramite_info->id_motivo_modificacion == 4){
                            echo "Cambio de Nomenclatura";
                        }else if($tramite_info->id_motivo_modificacion == 5){
                            echo "Cambio de domicilio";
                        }else if($tramite_info->id_motivo_modificacion == 6){
                            echo "Apertura de campo(s) de acción adicional(es) al(os) otorgado(s) en la licencia SST";
                        }else if($tramite_info->id_motivo_modificacion == 7){
                            echo "Cierre temporal o definitivo de campos de acción";
                        }
                    ?>.
				<?php
				}else{
				?>
					Que el (la) señor(a)  <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>,  
					identificado(a) con CC <?php echo $tramite_info->nume_identificacion?>, ha solicitado la modificacion de la Licencia para prestación de servicios en Seguridad y Salud en el Trabajo como persona natural por 
                    <?php                   
                        if($tramite_info->id_motivo_modificacion == 1){
                            echo "Cambio de nombre y/o apellido del titular de la licencia";
                        }else if($tramite_info->id_motivo_modificacion == 2){
                            echo "Cambio de número y tipo de identificación";
                        }else if($tramite_info->id_motivo_modificacion == 3){
                            echo "Cambio en el nivel de formación en seguridad y salud en el trabajo";
                        }
                    ?>
				<?php
				}
			?>			
        </p>  
		<p class="justificado">
			<?php
				if($tramite_info->tipo_identificacion == 5){					
				?>
					Que la entidad peticionaria ha presentado la documentación necesaria, exigida por el literal B del Artículo Segundo de la 
					Resolución 4502 del 28 de diciembre de 2012 del Ministerio de Salud y Protección Social.
				<?php
				}else{
				?>
					Que el peticionario ha presentado la documentación necesaria, exigida por el literal A del Artículo Segundo de la Resolución 4502 del 
					28 de diciembre de 2012 del Ministerio de Salud y Protección Social.
				<?php
				}
			?>
		</p>
		<?php
			if($tramite_info->tipo_identificacion == 5){					
			?>
				<p class="justificado">
					Que  revisada  la  solicitud  presentada  con  su  documentación  anexa  se  verificó  el  cumplimiento  de  los  requisitos exigidos  por  la  Resolución  No.  4502  
                    de  2012  expedida  por  el  Ministerio  de  Salud  y  Protección  Social  para  el otorgamiento de la licencia de seguridad y salud en el trabajo.
				</p>
				<p class="justificado">
					Que  en cumplimiento de lo ordenado en  el artículo 8º de la Resolución 4502 de 2012  expedida por el Ministerio de Salud  y  Protección  Social  se  efectuó  visita  
                    técnica  con  el  propósito  de  verificar  la  información  suministrada  y garantizar la calidad en la prestación de los servicios de seguridad y salud en el trabajo, 
                    como consta en el acta de visita No: <?php echo $tramite_info->acta_visita?> de fecha <?php echo $tramite_info->fecha_visita?>.
				</p>
				<p class="justificado">
					Que  con  base  en  el  análisis  de  la  documentación  presentada  y  lo  verificado  en  la  visita  de  vigilancia  técnica  se considera procedente la expedición de  licencia solicitada.
				</p>
				<p class="justificado">
					En  mérito  de  lo  expuesto,  la  Dirección  de  Calidad  de  Servicios  de  Salud  de  la  Secretaría  Distrital  de  Salud
				</p>
				<p class="centro">
					<b>RESUELVE:</b>
				</p>
				<p class="justificado">
					ARTICULO  PRIMERO:  Conceder  Licencia  de  Prestación  de  Servicios  en  Seguridad  y  Salud  en  el  Trabajo  a 
					<?php echo $tramite_info->nombre_rs?>, identificada con  NIT  <?php echo $tramite_info->nume_identificacion?>,   ubicada en la <?php echo $tramite_info->dire_resi?>  
					de la ciudad de <?php echo $municipio_resi?>, representada legalmente por <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
					identificado(a) con CC No <?php echo $tramite_info->nume_iden_rl?>, como Persona Jurídica.
				</p>
				<p class="justificado">
					ARTICULO SEGUNDO: La licencia otorgada comprende la prestación de servicios en Seguridad y Salud en el Trabajo en las siguientes áreas o campos de acción:
				</p>
				<p class="justificado">					
					<ul>
						<?php
							for($ct=0;$ct<count($campos_tramite);$ct++){
								if($campos_tramite[$ct]->estado_aprobacion == 1){
									echo "<li>".$campos_tramite[$ct]->desc_campo."</li>";
								}
							}
						?>
					</ul>
				</p>
				<p class="justificado">
					ARTÍCULO TERCERO: La presente Licencia se concede por término de diez (10) años, es de carácter personal eintransferible, tendrá validez en todo el 
					territorio nacional y puede solicitarse su renovación, por un término igual, en cualquier Secretaría Seccional o Distrital del país.
				</p>
				<p class="justificado">
					ARTICULO CUARTO: Cuando el titular de la licencia modifique alguna de las condiciones acreditadas en el momento  de  su  obtención,  deberá  informar  
					tal hecho a la Dirección de Calidad de Servicios  de  Salud - Subdirección Inspección, Vigilancia y Control de Servicios de Salud de esta Secretaría de Salud, 
					a fin de que se proceda a modificar la resolución por la cual se otorgó la licencia. En caso contrario incurrirá en las sanciones previstas en las normas legales vigentes.
				</p>
				<p class="justificado">
					ARTICULO  QUINTO: El titular de la licencia deberá dar estricto cumplimiento a las normas que regulan la materia, en especial a la Ley 1562 de 2012, 
					Resolución 4502 del 28 de diciembre de 2012 y demás normas que la modifiquen o adicionen.
				</p>
				<p class="justificado">
					ARTICULO SEXTO: Notificar personalmente esta Resolución a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
					informándole que de conformidad con el artículo 74 del Código de Procedimiento Administrativo y  de lo Contencioso Administrativo (Ley 1437 de 2011) contra la misma 
					proceden los recursos de reposición y en subsidio apelación, los cuales podrá interponer ante esta Secretaría, dentro de los diez (10) días hábiles siguientes a la 
					notificación de este acto administrativo.
				</p>
			<?php
			}else{
			?>
				<p class="justificado">
					Que revisada la solicitud presentada con su documentación anexa y verificado el cumplimiento de los requisitos exigidos  por  la  Resolución  No.  4502  de  2012  
					expedida  por  el  Ministerio  de  Salud  y  Protección  Social  para  el otorgamiento de la licencia de salud ocupacional, se considera procedente la expedición de 
					licencia solicitada.
				</p>
				<p class="justificado">
					En mérito de lo expuesto, la Directora de Calidad de Servicios de Salud  de la Secretaría Distrital de Salud
				</p>
				<p class="centro">
					<b>RESUELVE:</b>
				</p>
				<p class="justificado">
					ARTICULO  PRIMERO:  Conceder  Licencia  de  Prestación  de  Servicios  en  Seguridad  y  Salud  en  el  Trabajo  a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?>, 
					Identificado(a) con CC <?php echo $tramite_info->nume_identificacion?>, como <?php echo $tramite_registro->titulo_programa?>.
				</p>
				<p class="justificado">
					ARTICULO SEGUNDO: La licencia otorgada comprende la prestación de servicios en Seguridad y Salud en el Trabajo enlas siguientes áreas o campos de acción:
				</p>
				<p class="justificado">
					<ul>
						<?php						
							for($c=0;$c<count($campos_tramite);$c++){
								if($campos_tramite[$c]->estado_aprobacion == "1"){
									echo "<li>".$campos_tramite[$c]->desc_campo."</li>";
								}
							}
						?>
					</ul>
				</p>
				<p class="justificado">
					ARTÍCULO TERCERO: La presente Licencia se concede por término de diez (10) años, es de carácter personal e intransferible, tendrá validez en todo el territorio nacional y 
					puede solicitarse su renovación, por un término igual, en cualquier Secretaría Seccional o Distrital del país.
				</p>
				<p class="justificado">
					ARTICULO CUARTO: Cuando el titular de la licencia modifique alguna de las condiciones acreditadas en el momento de su obtención, deberá informar tal hecho a 
					la Dirección de Calidad de Servicios  de  Salud - Subdirección Inspección, Vigilancia y Control de Servicios de Salud de esta Secretaría de Salud, a fin de que se 
					proceda a modificar la resolución por la cual se otorgó la licencia. En caso contrario incurrirá en las sanciones previstas en las normas legales vigentes.
				</p>
				<p class="justificado">
					ARTICULO  QUINTO:  El  titular  de  la  licencia  deberá  dar  estricto  cumplimiento  a  las  normas  que  regulan  la materia,  en especial a la Ley 1562 de 2012, 
					Resolución 4502 del 28 de diciembre de 2012 y demás normas que la modifiquen o adicionen.
				</p>
				<p class="justificado">
					ARTICULO SEXTO: Notificar esta Resolución a <?php echo $tramite_info->p_nombre." ".$tramite_info->s_nombre." ".$tramite_info->p_apellido." ".$tramite_info->s_apellido?> 
					informándole que de   conformidad   con   el   artículo   74   del   Código   de   Procedimiento   Administrativo   y     de   lo   
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
			<img src="<?php echo FCPATH.'assets/imgs/firma_docmarthaBK.JPG'?>" width="300px"><br>
			<?php
		}
		
		?>
        <p class="justify"><b>YOLIMA AGUDELO SEDANO</b></p>
        <p class="justify">Subdirectora Inspección, Vigilancia y Control de Servicios de Salud</p>
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