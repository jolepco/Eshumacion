
<?php
	require_once '../class/solicitudConcepto.php';
	require_once '../controller/controllerSolicitudConcepto.php';

	$sol = new SolicitudConcepto();
	$solicitud = new ControllerSolicitudConcepto();
	$now = date("d/m/Y");
?>


<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Salud</title>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/validationEngine.jquery.css">
<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="../css/styles.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

<body>
    <header>
        <div class="container">
            <div class="logos">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <img class="logo1" src="../img/logos/home_alcaldia.svg" alt="">
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <img class="logo2" src="../img/logos/home_negocios_rentables.svg" alt="">
                    </div>
                </div>
            </div>

        </div>
    </header>
    <main class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="index2.php">Solicite su visita</a></li>
                <li><a href="consulta.php">Consulte su solicitud</a></li>
            </ul>
        </div>
        <div class="row">
			<div class="row block right" id="formpreliminar">
			<div class="subtitle">
                        Formulario Preconsulta Solicitud Visita Concepto Sanitario
            </div>
            <div class="col-md-12" >
                <div class="row">
                    <div class="col-md-12">
                        <h3>Su establecimiento ya se encuentra inscrito en la Secretaría de salud?</h3>
                        <label for="inscrito">&nbsp Si</label>
                        <input type="radio" name="inscrito" id="inscritosi" value="1">
                        <label for="inscrito">&nbsp No</label>
                        <input type="radio" name="inscrito" id="inscritono" value="2">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12" id="url" style="display:none">
                        <a class="btn btn-primary" href="http://appb.saludcapital.gov.co/MicroSivigilaDC/InscripcionesOtrosEstab/frmSubmenuInscripcionEstab.aspx">Inscríbase Aquí</a>
                    </div>
                </div>
                <div class="row" id="inscripcion" style="display: none">
                    <div class="col-md-12">
                        <input type="text" class="validate[required,custom[onlyLetterNumber], maxSize[10]] form-control mb-10" id="numeroIns1" name="numeroIns1" placeholder="Digite el número de inscripción incluyendo el prefijo"  onkeyup="this.value = this.value.toUpperCase();"  >
                    </div>
                    <div class="col-md-12">
                        <input type="button" id="consultaRegistroIns" class="btn btn-primary" value="Consultar">
                    </div>
                </div>
            </div>
			</div>
			
			<form name="frmRegUsuario" id="frmRegUsuario" method="post" action="#" enctype="multipart/form-data">
				<input type="hidden" name="action" id="action" value="guardar">
				<input type="hidden"  id="numeroIns" name="numeroIns">
				<div class="row block right" id="ocultar" style="display:none ">
					<div class="row" id="fech_ins" style="display: none">
						<div class="col-md-4">
							<label for="fechaIns">Fecha Inscripción(*)</label>
							<input type="text" class="form-control" id="fechaIns" name="fechaIns" readonly="tue">
						</div>

						<div class="col-md-4">
							<label for="codigo">Código</label>
							<input type="number" class="validate[ maxSize[10]] form-control" id="codigo" name="codigo" min="1" onkeypress="return nro(event)">
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
						<h3 class="well well-sm" style="background-color: #0069B4; color: #ffffff">Solicitud de visita por concepto sanitario</h3>
						<div class="alert alert-warning" role="alert">
							<strong>Señor Usuario!</strong> Todo campo con <strong>(*)</strong> será de carácter obligatorio en el diligenciamiento del formulario.
						</div>
						</div>
					</div>

					<div class="row" style="display:none">
						<div class="col-md-12">
							<label>Matrícula mercantil del establecimiento(*)</label>
							<input type="number" name="matricula" id="matricula" required="true">
						</div>
					</div>
					<div class="row" id="matriculam" style="display: none">
						<div class="col-md-4">
							<label for="numeromatricula">Número de Matrícula(*)</label>
							<input type="number" readonly="true" class="validate[required, maxSize[10]] form-control" id="numeromatricula" name="numeromatricula" min="1" onkeypress="return nro(event)">
						</div>
						<div class="col-md-4">
							<label for="razon_s">Razón Social(*)</label>
							<input type="text" readonly="true" class="validate[required,maxSize[250]] form-control" id="razon_s" name="razon_s" placeholder="Digite el Nombre">
						</div>
						<div class="col-md-4">
							<label for="Nit">Nit(*)</label>
							<input type="text" readonly="true" class="form-control" id="nit" name="nit" placeholder="Digite el número del nit incluya el - y código de verificación" onkeypress="return checknumber(event)">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label for="nombreEstable">Nombre Comercial(*)</label>
							<input type="text" readonly="true" class="validate[required, maxSize[250]] form-control" id="nombreEstable" name="nombreEstable" placeholder="Nombre del establecimiento" onkeypress="return check(event)">
						</div>
						<div class="col-md-6">
							<label for="">Dirección Comercial</label>
							<input type="text" class="validate[required, maxSize[100]] form-control" id="direccionGenerada" name="direccionGenerada" placeholder="Dirección" readonly="true">
						</div>
					</div>

					<div class="row" id="zrural" style="display:none">
						<div class="col-md-2">
							<label for="">Localidad</label>
							<input type="number" name="codigoloc" id="codigoloc">
						</div>
						<div class="col-md-2">
							<label for="">Upz</label>
							<input type="number" name="codigoupz" id="codigoupz">
						</div>
						<div class="col-md-2">
							<label for="">Barrio</label>
							<input type="text" name="barriorural" id="barriorural">
						</div>

						<br>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<label for="telefono">Teléfono</label>
							<input readonly="true" type="number" class="validate[required,maxSize[10],minSize[7]] form-control" id="telefono" name="telefono" min="1" onkeypress="return nro(event)">
						</div>
						<div class="col-md-4">
							<label for="celular">Celular
								(*)</label>
							<input type="number" min="1" class="validate[required,minSize[7], maxSize[10]] form-control" id="celular" name="celular" min="1" onkeypress="return nro(event)">
						</div>
						<div class="col-md-4">
							<label for="mail">Correo electrónico </label>
							<input readonly="true" type="email" class="validate[ condRequired[info-correo2], minSize[6], maxSize[50]] form-control" id="email" name="email" placeholder="Dirección de correo electronico">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div id="rpt" style=""><label for="representante">Representante Legal(*)</label></div>
							<div id="ptr" style=""><label for="representante">Propietario(*)</label></div>
							<input readonly="true" type="text" class="validate[maxSize[60]] form-control" id="representante" name="representante" placeholder="Nombres y Apellidos" onkeypress="return check(event)">
						</div>
						<div class="col-md-4">
							<label for="tipo_doc">Tipo Documento(*)</label>
							<select class="disabled-drop validate[required, maxSize[10]] form-control" id="tipo_doc" name="tipo_doc">
								<?php $solicitud->TipoDoc() ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="numero_doc">Número Documento(*)</label>
							<input readonly="true" type="text" class="validate[required, minSize[5],maxSize[15]] form-control" id="numero_doc" name="numero_doc" placeholder="Digite Número de documento">
						</div>
					</div>

					
					
					<h5 class="alert alert-warning "><strong>Señor Usuario(a) </strong>Si requiere actualizar o modificar algunos de los datos aquí presentados, debe ingresar a la opción de <a href="http://appb.saludcapital.gov.co/MicroSivigilaDC/InscripcionesOtrosEstab/frmSubmenuInscripcionEstab.aspx">actualizar inscripción</a> ó al siguiente <a href="http://appb.saludcapital.gov.co/MicroSivigilaDC/InscripcionesOtrosEstab/frmSubmenuInscripcionEstab.aspx">link</a>. Realizar el cambio requerido, así podrá ser notificado de la solicitud de visita de concepto sanitario de forma correcta. Agradecemos su colaboración.
						<strong></strong></h5>
						
					<div class="col-md-12 hidden-low">
						<div class="col-md-2">
							<label for="direccion">Dirección(*)</label>
							<select class=" form-control input-sm" id="c1">
								<option value=""></option>
								<option value="AC">Avenida calle</option>
								<option value="AK">avenida carrera</option>
								<option value="CL">Calle</option>
								<option value="KR">Carrera</option>
								<option value="DG">Diagonal</option>
								<option value="TV">Transversal</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="numerod">Num(*)</label>
							<input type="text" class="validate[maxSize[3]] form-control input-sm" id="c2" min="0" onkeypress="return checknumber(event)">
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="">B</label>
							<select class=" form-control input-sm" id="c3">
								<option value=""></option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
								<option value="F">F</option>
								<option value="G">G</option>
								<option value="H">H</option>
								<option value="I">I</option>
								<option value="J">J</option>
								<option value="K">K</option>
								<option value="L">L</option>
								<option value="M">M</option>
								<option value="N">N</option>
								<option value="O">O</option>
								<option value="P">P</option>
								<option value="Q">Q</option>
								<option value="R">R</option>
								<option value="S">S</option>
								<option value="T">T</option>
								<option value="U">U</option>
								<option value="V">V</option>
								<option value="W">W</option>
								<option value="X">X</option>
								<option value="Y">Y</option>
								<option value="Z">Z</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="bis">Bis</label>
							<select class=" form-control input-sm" id="c4">
								<option value=""></option>
								<option value="BIS">BIS</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="c5">A</label>
							<select class=" form-control input-sm" id="c5">
								<option></option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
								<option value="F">F</option>
								<option value="G">G</option>
								<option value="H">H</option>
								<option value="I">I</option>
								<option value="J">J</option>
								<option value="K">K</option>
								<option value="L">L</option>
								<option value="M">M</option>
								<option value="N">N</option>
								<option value="O">O</option>
								<option value="P">P</option>
								<option value="Q">Q</option>
								<option value="R">R</option>
								<option value="S">S</option>
								<option value="T">T</option>
								<option value="U">U</option>
								<option value="V">V</option>
								<option value="W">W</option>
								<option value="X">X</option>
								<option value="Y">Y</option>
								<option value="Z">Z</option>
							</select>
						</div>

						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="bis">S/E</label>
							<select class=" form-control input-sm" id="c6">
								<option></option>
								<option value="SUR">SUR</option>
								<option value="ESTE">ESTE</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="c7">Num(*)</label>
							<input type="text" class="validate[maxSize[3]] form-control input-sm" id="c7" min="0" onkeypress="return checknumber(event)">
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="c8">A</label>
							<select class="form-control input-sm" id="c8">
								<option></option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
								<option value="F">F</option>
								<option value="G">G</option>
								<option value="H">H</option>
								<option value="I">I</option>
								<option value="J">J</option>
								<option value="K">K</option>
								<option value="L">L</option>
								<option value="M">M</option>
								<option value="N">N</option>
								<option value="O">O</option>
								<option value="P">P</option>
								<option value="Q">Q</option>
								<option value="R">R</option>
								<option value="S">S</option>
								<option value="T">T</option>
								<option value="U">U</option>
								<option value="V">V</option>
								<option value="W">W</option>
								<option value="X">X</option>
								<option value="Y">Y</option>
								<option value="Z">Z</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="numerod">Num(*)</label>
							<input type="text" class="validate[maxSize[3]] form-control input-sm" id="c9" min="0" onkeypress="return checknumber(event)">
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<label for="c10">Sur/E</label>
							<select class=" form-control input-sm" id="c10">
								<option></option>
								<option value="SUR">SUR</option>
								<option value="ESTE">ESTE</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
							<br>
							<button class="btn btn-primary" id="generar" type="button">Generar</button>
						</div>

					</div>
					<hr>
					<div class="row">

						<!--      <div class="col-md-2">
							<input type="button" class="btn btn-info btn-block" id="webs" value="Guardar">
						</div>
						<div class="col-md-2">
							<input type="button" class="btn btn-warning btn-block" id="limpiar" value="Limpiar">
						</div> -->
					</div>
					<!--  <input type="hidden" name="localidad" id="localidad" >
					<input type="hidden" name="upz" id="upz" >
					<input type="hidden" name="barrio" id="barrio" >-->

					<div class="row">
						<div class="col-md-4">
							<label for="Ciudad">Autoriza Notificación electrónica</label><br>
							<input type="radio" id="autoriza_notifsi" class="validate[required]" name="autoriza_notif" value="1">
							<label>&nbsp; Si&nbsp;&nbsp;</label>
							<input type="radio" id="autoriza_notifno" class="validate[required]" name="autoriza_notif" value="2">
							<label>&nbsp; No </label>
						</div>
						<div class="col-md-4">
							<label for="email_notif">Dirección de notificación correo electrónica</label>
							<input type="email" class="validate[optional, maxSize[100],minSize[8]] form-control" id="email_notif" name="email_notif">
						</div>
						<div class="col-md-4">
							<label for="direccion_notf">Dirección de Notificación Física (*)</label>
							<input readonly="true" type="text" readonly="true" name="direccion_notf" id="direccion_notf" class="validate[required,minSize[6],maxSize[60]] form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="Ciudad">Ciudad Notificación(*)</label>
							<!--  <input class="validate[required] form-control" id="ciudad_notif" name="ciudad_notif">-->
							<select  class="disabled-drop validate[required] form-control" id="ciudad_notif" name="ciudad_notif">
								<option value="149">BOGOTÁ D.C.</option>
								<?php $solicitud->ciudades(); ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="actividades">Actividad Principal del establecimiento(*)</label>
							<select  class="disabled-drop form-control" id="actividadP" name="actividadP">
								<option></option>
								<?php $solicitud->tipoestablecimientos(); ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="actividades">Seleccione primera actividad </label>
							<select  class="disabled-drop form-control" id="actividadescom1" name="actividadescom1">
								<option></option>
								<?php $solicitud->tipoestablecimientos(); ?>
							</select>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4">
							<label for="actividades">Seleccione segunda actividad </label>
							<select  class="disabled-drop form-control" id="actividadescom2" name="actividadescom2">
								<option></option>
								<?php $solicitud->tipoestablecimientos(); ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="actividades">Seleccione tercera actividad </label>
							<select  class="disabled-drop form-control" id="actividadescom3" name="actividadescom3">
								<option></option>
								<?php $solicitud->tipoestablecimientos(); ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="actividades">Seleccione cuarta actividad </label>
							<select  class="disabled-drop form-control" id="actividadescom4" name="actividadescom4">
								<option></option>
								<?php $solicitud->tipoestablecimientos(); ?>
							</select>
						</div>

					</div>
					<div class="row" style="display:none">
						<h5><strong>Alguna vez el establecimiento ha sido inspeccionado en sus condiciones sanitarias por la subred integrada de servicios de salud?</strong></h5>
						<input type="radio" id="inspec_antessi" name="inspec_antes" value="1" class="validate[required]">
						<label>&nbsp; Si&nbsp;&nbsp;</label>
						<input type="radio" id="inspec_antesno" name="inspec_antes" value="2" class="validate[required]">
						<label>&nbsp; No </label>
					</div>

					<div class="row" id="inspeccionado" style="display:none">
						<div class="col-md-4">
							<label>Número acta visita (*)</label>
							<input type="text" readonly="true" name="numero_acta" class="validate[required,maxSize[15]] form-control" id="numero_acta">
						</div>
						<div class="col-md-4 hidden-low">
							<label for="fecha_insp">Fecha de última inspección(*)</label>
							<input type="date" class="form-control" name="fecha_insp" id="fecha_insp" class="validate[required]" max="<?php $now ?>">
						</div>
						<div class="col-md-4 hidden-low">
							<label>Concepto Emitido(*)</label>
							<select name="concepto_emitido" class="form-control" id="concepto_emitido">
								<option></option>
								<option value="CF">Favorable</option>
								<option value="CD">Desfavorable</option>
								<option value="CFR">Favorable con requerimientos</option>
								<option value="CP">Pendiente</option>
							</select>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-12">
							<a href="../index.php"> <button type="button" class="btn btn-danger btn-lg">Regresar</button></a>
							<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn btn-dark btn-lg">Cancelar</button> -->
							<input type="submit" class="btn btn-primary btn-lg float-right" name="Enviar" id="Enviar" onclick="validarFrm2()" value="Enviar">
						</div>
					</div>
				</div>
				<!--div ocultar -->
			</form>
        </div>
    </main>

    <?php include('../master/footer.html'); ?>
	<?php include('../master/modal.html'); ?>
    

</body>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-migrate-1.2.1.js"></script>   
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine-es.js"></script>      
<script type="text/javascript" src="../js/direccion.js"></script>
<script type="text/javascript" src="../js/validaciones.js"></script>
<script>
    $("#btnCerrar").click(function() {
        if (($("#respuestaMensaje").html()).indexOf("enviada con exito") >= 0) {
            window.location.replace("../");
        }
    });

    $("#consultaRegistroIns").click(function() {
        var numeroR = $("#numeroIns1").val();
        //alert(numeroR);
        var send = $.post("../controller/ConsultaRegistro.php", {
            numeroIns: numeroR
        });

        send.done(function(data) {
            if (data !== "" && data !== "0") {
				$("#formpreliminar").hide();
                $("#ocultar").show();
                var array = data.split('|');
                if (array[1] != '') {
                    $("#inscripcion").hide();
                    if (array[3] == 1) $("#matriculam").show();
                    else $("#matriculam").hide();
                    if (array[19] == 1) {
                        $("#rpt").show();
                        $("#ptr").hide();
                    } else {
                        $("#rpt").hide();
                        $("#ptr").show();
                    }
                    $("#numeroIns").val(array[1]);
                    $("#fechaIns").val(array[2]);
                    $("#matricula").val(array[3]);
                    $("#numeromatricula").val(array[4]);
                    $("#razon_s").val(array[6]);
                    $("#nit").val(array[5]);
                    $("#nombreEstable").val(array[7]);
                    $("#codigoloc").val(array[10]);
                    $("#codigoupz").val(array[11]);
                    $("#barriorural").val(array[12]);
                    $("#direccionGenerada").val(array[8]);
                    $("#telefono").val(array[13]);
                    $("#celular").val(array[14]);
                    $("#email").val(array[15]);
                    if (array[16] != '') $("#representante").val(array[16]);
                    else $("#representante").val(array[20]);
                    /* if(array[17] !='')$("#tipo_doc").val(array[17]);
                     else $("#tipo_doc").val(array[21]);*/
                    if (array[18] != '') $("#numero_doc").val(array[18]);
                    else $("#numero_doc").val(array[22]);
                    $("#direccion_notf").val(array[23]);
                    if (array[27] == 1) {
                        $("#autoriza_notifsi").attr('checked', true);
                        $('#email_notif').attr('required', true);
                    } else $("#autoriza_notifno").attr('checked', true);
                    //$("#ciudad_notif").val(array[25]);
                    $("#email_notif").val(array[26]);
                    $("#actividadP").val(array[28]);
                    $("#actividadescom1").val(array[34]);
                    $("#actividadescom2").val(array[35]);
                    $("#actividadescom3").val(array[36]);
                    $("#actividadescom4").val(array[37]);
                    if (array[30] == 1) {
                        $("#inspec_antessi").attr('checked', true);
                        $("#inspeccionado").show();
                    } else {
                        $("#inspec_antesno").attr('checked', true);
                        $("#inspeccionado").hide();
                    }
                    $("#numero_acta").val(array[31]);
                } else {
                    //funcion incliuda en la importación del master/modal.html
                    showAlert('No se encontraron datos con el número ingresado. Por favor intente nuevamente o <a href="http://appb.saludcapital.gov.co/MicroSivigilaDC/InscripcionesOtrosEstab/frmSubmenuInscripcionEstab.aspx" target="_black">inscríbase aquí</a>' , 'info');
					$("#formpreliminar").show();
                }
            }else{
                //funcion incliuda en la importación del master/modal.html
                showAlert('En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
				$("#formpreliminar").show();
            }
        });

        send.error(function(XMLHttpRequest, textStatus, errorThrown) {
            //funcion incliuda en la importación del master/modal.html
            showAlert('En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
        });

    });
</script>
</body>

</html>