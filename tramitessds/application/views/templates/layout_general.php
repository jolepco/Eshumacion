<!DOCTYPE html>
<html lang="es">

<head>
    <!--Meta tags-->
    <meta charset="UTF-8">
	<meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">
    <meta http-equiv="content-language" content="es">
    <meta name="distribution" content="global">
    <meta name="robots" content="all">


    <!--favicon-->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon/favicon.png')?>"/>

    <!--Titulo del sistema de información-->
    <title>
        <?php echo $titulo?>
    </title>

    <!--CSS-->
    <!-- Optional theme -->
	
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/favicon/apple-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/favicon/apple-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/favicon/apple-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/favicon/apple-icon-76x76.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/favicon/apple-icon-114x114.png')?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/favicon/apple-icon-120x120.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/favicon/apple-icon-144x144.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/favicon/apple-icon-152x152.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon/apple-icon-180x180.png')?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('assets/favicon/android-icon-192x192.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/favicon/favicon-96x96.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon/favicon-16x16.png')?>">
	
    <link rel="manifest" href="<?php echo base_url('assets/favicon/manifest.json')?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('assets/favicon/ms-icon-144x144.png')?>">
    <meta name="theme-color" content="#ffffff">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,800" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/validationEngine.jquery.css')?>">
    
	
	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-theme.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-switch.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datatable.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style_gmap.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fileinput/fileinput.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2/select2.css')?>" />
	


    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css')?>">
    <!--JS-->
    <script type="text/javascript">
        var base_url = "<?php print base_url(); ?>";

    </script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>


    <!-- JavaScript -->
    <script src="<?php echo base_url('assets/js/alertifyjs/alertify.min.js') ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/js/alertifyjs/css/alertify.min.css') ?>" />
    <!-- Default theme -->
    <link rel="stylesheet" href="<?= base_url('assets/js/alertifyjs/css/themes/default.min.css') ?>" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="<?= base_url('assets/js/alertifyjs/css/themes/semantic.min.css') ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/css/bootstrap/js/bootstrap.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/formtowizard.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validationEngine.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validationEngine-es.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/datatable.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fileinput/fileinput.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fileinput/fileinput_locale_es.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/select2/select2.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/select2/i18n/es.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/chart/loader.js')?>"></script>	


    <?php
        if(isset($js) && count($js) > 0){
            for($i=0;$i<count($js);$i++){
                echo '<script type="text/javascript" src="'.$js[$i].'"></script>';
            }
        }
    ?>

</head>

<body>
<header>
        <div class="container">
            <div class="logos">
                <div class="row">
                    <div class="col-12 col-md-6 text-right">
                        <div style="color:white;">
                            <h2>Ventanilla Única digital de Trámites y Servicios</h2>
                        </div>
                    </div>
					 <div class="col-12 col-md-6 text-right">
                        <a href="<?php echo base_url()?>"><img class="logo1" src="<?php echo base_url('assets/imgs/logos/logoalcaldia.png')?>" alt=""></a>
                    </div>
                </div>
            </div>

<?php
    if(isset($menu) && $menu == 'NO'){
        ?>
		</header>
        <main class="container">
            <?php
                $this->load->view($contenido);
            ?>
        </main>
        <?php

    }else{
         
        switch ($this->session->userdata('perfil')) {
            case '1':
                $this->load->view('templates/menu_admin.php');
                break;
            case '2':
                $this->load->view('templates/menu_usuario.php');
                break;
            case '3':
                $this->load->view('templates/menu_validacion.php');
                break;
            case '4':
                $this->load->view('templates/menu_coordinacion.php');
                break;
            case '5':
                $this->load->view('templates/menu_firma.php');
                break;
            case '6':
                $this->load->view('templates/menu_ventanilla.php');
                break;
            case '7':
                $this->load->view('templates/menu_consulta.php');
                break; 
			case '8':
                $this->load->view('templates/menu_validacion.php');
                break;
			case '9':
                $this->load->view('templates/menu_validacion.php');
                break;	
			case '10':
                $this->load->view('templates/menu_coordinacion.php');
                break;	
			case '11':
                $this->load->view('templates/menu_coordinacion.php');
                break;	
        }
		?>
		</header>
			<main class="container">
            <?php
                $this->load->view($contenido);
            ?>
			</main>
	<?php
    }    
    ?>
        </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4"></div>
                <div class="col-12 col-md-4 text-md-center">
                    <p>2019. @ Todos los derechos reservados- Versión 2.1</p>
                    <p><a target="_blank" href="http://www.saludcapital.gov.co/Documents/Politica_Proteccion_Datos_P.pdf">*Habeas data</a></p>
                    <p><a href="http://www.saludcapital.gov.co/Documents/Politicas_Sitios_Web.pdf" target="_blank">*Términos y condiciones</a></p>
                </div>
                <div class="col-12 col-md-4 text-md-right">
                    <img src="<?php echo base_url('assets/img/logos/logoalcaldia.png')?>" alt="">
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="<?php echo base_url('assets/js/main.js')?>"></script>
	
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.nicescroll.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.autocomplete.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validationEngine.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validationEngine-es.js')?>"></script>



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url('assets/js/code.js')?>"></script>
</body>

</html>
