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
	table, th, td {
  	border: 1px solid black;
  	border-collapse: collapse;
  	}

  	.continuacion{
		font-style: italic;
		font-size: 9px;
	}

	.elaboro{
		font-style: italic;
		font-size: 9px;
	}

    /*th,td,tr {
        border:1px solid black;
        border-collapse:collapse;
    }*/

    .conborde{
        border:1px solid black;
        border-collapse:collapse;
    }    

    .mt-5{
        margin-top: 2px;
    }

    .titulocampo {		
		background-color: #bec2c2;
	}
	.subtitulocampo {		
		background-color: #ebf0f0;
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
      		<table width="100%" class="conborde">
      			<tr>
				    	<td colspan="2" class="conborde" align="center">	
			        	No. de solicitud: <b><?php echo $info[0]['id_tramite']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			DATOS DE LA ENTIDAD QUE EMITE LA ORDEN
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde" width="40%">
		    			Municipio / Distrito / donde es emitida la orden: <b>Bogotá, D.C</b>
		    		</td>
		    		<td class="conborde" width="55%">
		            Nombre de la entidad:<br> <b>Secretaría Distrital de Salud de Bogotá.</b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Fecha de solicitud de la orden: <b><?php echo $dia_reg.'/'.$mes_reg.'/'.$anio_reg; ?></b>
		    		</td>
		    		<td class="conborde">
		            Fecha de expedición de la orden : <b><?php echo $dia_apr.'/'.$mes_apr.'/'.$anio_apr; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			   DATOS DE IDENTIFICACIÓN Y DE CONTACTO DE LA PERSONA QUE REQUIERE LA VALORACIÓN
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Nombres completos: <b><?php echo $info[0]['p_nombre'].' '.$info[0]['s_nombre']; ?></b>
		    		</td>
		    		<td class="conborde">
			        Apellidos completos: <b><?php echo $info[0]['p_apellido'].' '.$info[0]['s_apellido']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde subtitulocampo" align="center">
		    			   Tipo de documento de identificación y número
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Tipo de identificación: <b><?php echo $info[0]['tipoiden']; ?></b>
		    		</td>
		    		<td class="conborde">
		            No. de identificación: <b><?php echo $info[0]['nume_identificacion']; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde subtitulocampo" align="center">
		    			   Ubicación de residencia y número de contacto
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Dirección: <b><?php echo $info[0]['dire_resi']; ?></b>
		    		</td>
		    		<td class="conborde">
		          Teléfono fijo: <b><?php echo $info[0]['telefono_fijo']; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Complemento de la Dirección: 
		    		</td>
		    		<td class="conborde">
			          Telefóno celular 1 y 2: <b><?php echo $info[0]['telefono_celular']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Municipio de residencia: <b><?php echo $info[0]['ciudadnacimiento']; ?></b>
		    		</td>
		    		<td class="conborde">
			            Correo electrónico: <b><?php echo $info[0]['email']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Localidad: <b><?php echo $info[0]['localidad']; ?></b>
		    		</td>
		    		<td class="conborde" align="center">
			           
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			DATOS DE IDENTIFICACIÓN Y DE CONTACTO DEL REPRESENTANTE DE LA PERSONA A SER VALORADA 
							(DILIGENCIAR EN CASO DE QUE APLICA)

		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Nombres completos: <b><?php echo $info[0]['cu_pnombre'].' '.$info[0]['cu_snombre']; ?></b>
		    		</td>
		    		<td class="conborde">
			        Apellidos completos: <b><?php echo $info[0]['cu_papellido'].' '.$info[0]['cu_sapellido']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde subtitulocampo" align="center">
		    			   Tipo de documento de identificación y número
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Tipo de identificación: <b><?php echo $info[0]['nom_tipodoc']; ?></b>
		    		</td>
		    		<td class="conborde">
			        No. de identificación: <b><?php echo $info[0]['cu_numdoc']; ?></b>
			      </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde subtitulocampo" align="center">
		    			   Ubicación de residencia y número de contacto
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Dirección: <b></b>
		    		</td>
		    		<td class="conborde">
		          Teléfono fijo: <b><?php echo $info[0]['cu_telefono']; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Complemento de la Dirección: <b></b>
		    		</td>
		    		<td class="conborde">
		          Telefóno celular 1 y 2: <b><?php echo $info[0]['cu_celular']; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Municipio de residencia: <b></b>
		    		</td>
		    		<td class="conborde">
		          Correo electrónico: <b><?php echo $info[0]['cu_email']; ?></b>
		        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde" colspan="2">
		    			Localidad: <b></b>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			INFORMACIÓN SOBRE LA ORDEN
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Código de autorización RLCPD:<br> <b><?php echo $info[0]['cod_autorizacion']; ?></b>
		    		</td>
		    		<td class="conborde">
			           Nombre de la institución en la cual se autoriza   solicitar la valoración por el equipo multidisciplinario:<br> <b><?php echo $info[0]['nombre_ips']; ?></b><br>
			           Teléfono: <b><?php echo $info[0]['telefono_ips']; ?></b><br>
			           Correo: <b><?php echo $info[0]['email_ips']; ?></b><br>
			           Dirección: <b><?php echo $info[0]['direccion_ips']; ?></b><br>
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			INFORMACIÓN SOBRE AJUSTES Y APOYOS RAZONABLES
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde subtitulocampo"> 
		    			CONSULTA POR EQUIPO MULTIDISCIPLINARIO
		    		</td>
		    		<td class="conborde subtitulocampo" align="center">
			           NECESIDADES DE APOYOS Y AJUSTES RAZONABLES
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde">
		    			Modalidad de consulta por equipo multidisciplinario de salud, de acuerdo con lo establecido por el médico tratante:<br>
		    			<b><?php echo $info[0]['nom_modalidad']; ?></b><br>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			a) Movilidad
		    		</td>
		    		<td class="conborde">
			           b) Comunicación y acceso a la comunicación
			        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Cuál dispositivo utiliza para movilizarse:<br>
		    			 <b><?php echo $info[0]['nom_moviliza']; ?></b>
		    		</td>
		    		<td class="conborde">
			           Cuál dispositivo utiliza para comunicarse:<br>
			           <b><?php echo $info[0]['nom_comunica']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Otro dispositivo que utiliza para movilizarse:<br>
		    			<b><?php echo $info[0]['cual_moviliza']; ?></b>
		    		</td>
		    		<td class="conborde">
			           Otro dispositivo que utiliza para comunicarse:<br>
			           <b><?php echo $info[0]['cual_comunica']; ?></b>
			        </td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			¿Requiere acompa&ntilde;ante?: <b><?php echo $info[0]['req_acompanante']; ?></b>
		    		</td>
		    		<td class="conborde">
			           
			        </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2" class="conborde titulocampo" align="center">
		    			DATOS DE QUIEN AUTORIZA LA ORDEN
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="conborde">
		    			Nombre y Apellidos Completos:<br>
		    			<b><?php echo $info[0]['nom_usuario_director']; ?></b>
		    		</td>
		    		<td class="conborde">
			           Cargo:<br>
			           <b>Dirección de Provisión de Servicios de Salud</b>
			        </td>
			    </tr>
			    <tr>
		    		<td class="conborde centro">
		    			Firma<br>
		    			<?php 
							if($firma=='N'){ 
								echo "";
							}else{
								?>
								<img src="<?php echo FCPATH.'assets/imgs/firma_danielblanco.jpg'?>" width="150px"><br>
								<?php 
							}
							?>
		    		</td>
		    		<td class="conborde">
			           <table width="100%">
			           		<tr>
			           			<td>
			           				Dependencia:<br>
			           				<b>Dirección de Provisión de Servicios de Salud</b>
			           			</td>
			           		</tr>
			           		<tr>
			           			<td>
			           				Correo Electronico:<br>
			           				<b><?php echo $info[0]['email_director']; ?></b>
			           			</td>
			           		</tr>
			           </table>
			        </td>
			    </tr>
			    <tr>
		    		<td colspan="2" class="conborde">
		    			Observaciones: <b><?php echo $info[0]['observaciones']; ?></b>
		    		</td>
		    	</tr>
	        </table>
		</div>
  	</div>
  <div id="footer" style="margin-left:45px;margin-right:45px">
  </div>

</body>
</html>		  