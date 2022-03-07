<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Salud</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/validationEngine.jquery.css">
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/enesima-salud.css">
        <link rel="stylesheet" href="../css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    </head>
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
                    <li><a href="index.php">Solicite su visita</a></li>
                    <li><a href="consulta.php">Consulte su solicitud</a></li>
                </ul>      
            </div>
            <div class="row block right">
                <div class="col-12">
                    <div class="subtitle">
                        Consulta estado solicitud 
                    </div>
                    <div class="paragraph">
                        <p>
                            Señor usuario en esta página puede consultar el estado de su solicitud
                        </p>
                    </div>
                    <form class="form-inline" method="post" action="#">
                        <div class="form-group">

                            <label>Digite el Número de radicado</label> 
                            <input type="number" name="numerosolicitud" id="numerosolicitud" class="form-control" required="true" min="1" style="margin-bottom: 1px;">

                        </div>
                        <button type="button" value="Consultar" id="send"  class="btn yellow">Consultar</button>

                    </form>
                </div>
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
        $("#send").click(function () {
            var numerosolicitud = $("#numerosolicitud").val();
            // alert(numerosolicitud);

            $.ajax({
                method: "POST",
                url: "../controller/procesarconsulta.php",
                data: {numerosolicitud: numerosolicitud },
                //timeout : 60000
            }).done(function( data ) {
                if(Number(data) === 0){
                    showAlert('En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
                }else{
                    showAlert(data , 'info');
                }
            }).error( function (error) {
                showAlert('2En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
            });



            /* var send = $.post("../controller/procesarconsulta.php", {numerosolicitud: numerosolicitud });

            send.done(function (data) {

                if( data != "0"){
                    showAlert(data , 'info');
                }else{
                    showAlert('En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
                }
            });

            send.error(function (XMLHttpRequest, textStatus, errorThrown) {
                showAlert('En este momento no se pudo completar la solicitud, por favor intentarlo de nuevo. Si el problema persiste, informarlo a través de correo electrónico: contactenos@saludcapital.gov.co' , 'error');
            }); */

        })



    </script>
</html>