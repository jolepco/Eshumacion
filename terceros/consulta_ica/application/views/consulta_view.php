	   <header>
        <div class="row-header">
            <div class="header-container">
                <div class="brand">
                    <!--<img class="logo-header" src="http://tramitesenlinea.saludcapital.gov.co/assets/imgs/alcaldia_logo.png" alt="Escudo de la Alcaldía Mayor de Bogotá D. C. y logotipo de Bogotá mejor para todos">-->
                    <img class="logo-header" src="http://tramitesenlinea.saludcapital.gov.co/assets/imgs/logo_sds_alcaldia.png" alt="Escudo de la Alcaldía Mayor de Bogotá D. C. y logotipo Secretaria Distrital de Salud">
                </div>
                <div class="btn-menu" id="btnMenu"><i class="fa fa-bars"></i></div>
                <div class="container-bar-search">
                    <div class="bar-search">
                        <h4>Consulta SDS - Valores ICA </h4>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="login-content">		
		<div class="row">								
			<form id="buscar_lista" >	
				   <div class="main-info">
				        <p>
				FONDO FINANCIERO DISTRITAL DE SALUD
				<br />NIT: 800.246.953-2
				<br />CERTIFICADO DE RETENCIÓN DE INDUSTRIA Y COMERCIO - ICA
				<br />AÑO GRAVABLE 2021
				 </p>
				    </div>
				<div class="row" style="border-bottom: 2px solid #b3b7bf;">
				    <div class="main-info">
				        <p>A través de este sitio, usted puede verificar la información relacionada para la declaración del ICA.				            
				        </p>
				    </div>
				</div>	
				<div class="contenedor_busq" >
					<div class="form-group">
							<label class="text-login" for="tipo_ident">Tipo de Identificación</label>
							<select class="form-control validate[required]" id="tipo_ident" name="tipo_ident" tabindex="3">
								<option value="-">Seleccione...</option>
								<option value="CC">CC</option>
								<option value="NIT">NIT</option>								
							</select>							
						</div>
						<div class="form-group">
							<label class="text-login" for="numero de identificacion">Número de Identificación</label>
							<input type="text" class="form-control" name="num_identif" id="num_identif" value="<?php echo $num_identif; ?>"  placeholder="Digite identificación..." tabindex="1"> 
						</div>
						<!--<div class="form-group">
							<label class="text-login" for="contrato">Contrato / Convenio</label>
							<input type="text" class="form-control" name="contrato" id="contrato"  value="<?php echo $contrato; ?>"  placeholder="Digite contr..." tabindex="2"> 
						</div>
						<div class="form-group">
							<label class="text-login" for="cuenta">Seleccione #Cuenta</label>
							<select class="form-control validate[required]" id="cuenta" name="cuenta" tabindex="3">
								<option value="">Seleccione...</option>
								<?php
									for($i=0;$i<count($cuenta);$i++){
										echo "<option value='".$cuenta[$i]->CUENTA_BANCO_RECEPTOR."'>".$cuenta[$i]->CUENTA_BANCO_RECEPTOR."</option>";
									}
								?>
							</select>							
						</div>-->
						</div>
				<div >
					<button type="button"  class="btn-consulta" id="btn-buscar">Buscar</button>
				</div>	
			</form>
		</div>	
	</section>

	<hr style="max-width: 80%; margin:0 auto;" />
		<br /><br />

		<!--<div style="text-align: right;">
						<button type="button" class="btn" id="btn-enviar" style="background-color:white; color:#3498db; text-align: right;"><img src="<?php echo base_url('assets/imgs/download_excel.png')?>" alt="Imagen Excel" class="sds-logo" tabindex="1" style="width:28px; height:28px;" />Descargar Excel con valores</button>	
				</div>-->
		<div class="row2" id="linea2" <!--style="display:none;"-->

			<div class="table-responsive" id="tabla_respuesta" class="col-md-12" /*style="display:none"*/>
				<div>
					<input type="text" name="nombre_persona" id="nombre_persona"  value="" tabindex="4" style="border:none; width:500px;" readonly="true"> 
				</div>
				
				</form>
				<div>
					<table id="book-table" class="table table-bordered table-striped table-hover tabla_resp" cellspacing="0">
						<thead>
							<tr class="success">
								<th >AÑO <br />GRAVABLE</th>	
								<th >TIPO <br />IDENTIFICACIÓN</th>	
								<th >NUM <br />IDENTIFICACIÓN</th>	
								<th >NOMBRE / RAZÓN SOCIAL</th>							
								<th >BASE GRAVABLE <br />NETA</th>								
								<th >TOTAL INGRESOS </th>							
								<th >VALOR RETENIDO A <br />TÍTULO DE INDUSTRIA <br />Y COMERCIO</th>	
                <th >DEDUCCIONES</th>												
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="row2" id="vacio"  style="display:none;">
			<div>Registros no encontrados</div>	
		</div>
		<div style="max-width: 80%; margin:0 auto;">
			<br/>
			<br/>
			Sin firma Autógrafa según Artículo 7 del Decreto 380 de 1996 y artículo 10 del Decreto 836 de 1991
		</div>
</div>
			
	