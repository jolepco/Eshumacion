<!--
Hojas de estilos del módulo y fuente
-->
   <header>
        <div class="row-header">
            <div class="header-container">
                <div class="brand">
                    <img class="logo-header" src="https://tramitesenlinea.saludcapital.gov.co/assets/imgs/logo_sds_alcaldia.png" alt="Escudo de la Alcaldía Mayor de Bogotá D. C. y logotipo de Bogot&aacute;">
                </div>
                <div class="btn-menu" id="btnMenu"><i class="fa fa-bars"></i></div>
                <div class="container-bar-search">
                    <div class="bar-search">
                        <h4>Consulta - Trámite de Pagos del FFDS </h4>
                    </div>
                </div>
            </div>
        </div>
    </header>
<div class="contenedor">
	<!--<div style="width:100%; height:60px; background-color:#0069b4;"></div>-->
	<section class="row">
		<div class="col-md-12">								
			<form id="buscar_lista">
				<div class="row" style="border-bottom: 2px solid #13BFEF;">
				    <div class="main-info">
				        <p class="text-justify">
				            A través de este sitio, usted puede verificar los pagos que le ha realizado la Secretaría Distrital de Salud.<br>Se recomienda digitar nit/cedula o convenio (sin dígito de verificación) y posteriormente digitar el número de cuenta.
				            <br />Tenga en cuenta que si no digita una cuenta correctamente no saldrá la información solicitada.
				        </p>
				    </div>
				</div>
				<div class="contenedor_busq">
					<div class="form-group">
						<label class="text-login" for="numero de identificacion">NIT / Cédula</label>
						<input type="text" class="form-control" name="num_identif" id="num_identif" value="<?php echo $num_identif; ?>"  placeholder="Digite identificación..." tabindex="1"> 
					</div>
					<div class="form-group">
						<label class="text-login" for="contrato">Contrato / Convenio</label>
						<input type="text" class="form-control" name="contrato" id="contrato"  value="<?php echo $contrato; ?>"  placeholder="Digite contr..." tabindex="2"> 
					</div>
					<div class="form-group">
						<label class="text-login" for="cuenta">Digite #Cuenta (solo números)</label>
						<!--<select class="form-control validate[required]" id="cuenta" name="cuenta" tabindex="3">
							<option value="">Seleccione...</option>
							<?php
								for($i=0;$i<count($cuenta);$i++){
									echo "<option value='".$cuenta[$i]->CUENTA_BANCO_RECEPTOR."'>".$cuenta[$i]->CUENTA_BANCO_RECEPTOR."</option>";
								}
							?>
						</select>		-->	
						<input type="text" class="form-control validate[required, custom[integer]]" name="cuenta" id="cuenta"  value="<?php echo $cuenta; ?>"  placeholder="Digite cuenta..." tabindex="3">
					</div>
				</div>
			<div>
				<button type="button" class="btn-consulta" id="btn-buscar">Buscar</button>
			</div>	
		</form>
	</div>	
	</section>
	<div class="row" id="linea1" style="display: none;">
		<div class="col-md-10">
			<input type="text" name="nombre_persona" id="nombre_persona"  value="" tabindex="4" style="border:none; width:500px;" readonly="true">
		</div>
		<div class="col-md-2">
			<button type="button" class="btn" id="btn-enviar" style="background-color:white; color:#3498db;"><img src="<?php echo base_url('assets/imgs/download_excel.png')?>" alt="Imagen Excel" class="sds-logo" tabindex="1" style="width:28px; height:28px;" />Descargar Plano</button>
		</div>
	</div>
	<div class="row" id="linea2" style="display: none;">
		<div class="tabla_responsive">
			<div class="col-md-12" id="tabla_respuesta" style="display: none;">
				<table id="book-table" class="table table-bordered table-striped table-hover " width="100%" cellspacing="0">
					<thead>
						<tr class="info">
							<th>VIGENCIA</th>
							<th>NIT-CEDULA</th>							
							<th>CTO CONVENIO</th>
							<!--<th>FECHA DILIGENCIAMIENTO</th>
							<th>FECHA APROBACION</th>-->
							<th>ESTADO</th>
							<th>FECHA GIRO</th>
							<th>PLANILLA</th>
							<th>ORDEN PAGO</th>
							<th>BRUTO</th>
							<th>VALOR GIRADO</th>
							<th>NOMBRE BANCO</th>
							<th>CUENTA BANCO RECEPTOR</th>	
							<th>DETALLE</th>							
							</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="row" id="vacio" style="display:none;">
		<div class="col-md-12">
			<label>Registros no encontrados</label>	
		</div>
	</div>
</div>