<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
		<meta name="keywords" content="">
	    <meta name="description" content="">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">
	    <meta http-equiv="content-language" content="es">
	    <meta name="distribution" content="global">
	    <meta name="robots" content="all">

	     <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon/favicon.png')?>"/>

	     <title>
	        <?php echo $titulo?>
	    </title>

	    <script type="text/javascript">
				var base_url = "<?php print base_url(); ?>";
		</script>

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
        <link href="<?php echo base_url("assets/fontawesome-free/css/all.min.css")?>" rel="stylesheet" type="text/css">
   
        <link rel="stylesheet" href="<?php echo base_url("assets/css/estilo_tramites.css"); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        
        <link href="<?php echo base_url("assets/js/alertifyjs/css/alertify.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/js/alertifyjs/css/themes/default.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("assets/css/validationEngine.jquery.css"); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.js')?>"></script>	
    	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
        
    </head>
    <header>
		<div class="container-fluid text-center">
            <div id="header" class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-8 align-middle">
                            <div class="row">
                            <div class="col-md-6 text-left ">
                                <h2 class="text-white">Ventanilla Única digital de Trámites y Servicios</h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo base_url()?>"><img class="logo1" src="<?php echo base_url('assets/imgs/logos/logoalcaldia.png')?>" alt=""></a> 					
                            </div>
                            </div>
                        </div>                        
                        <div class="col"></div>
                    </div>                                        
                </div>                
            </div>
	    </div>
    </header>
    <body>
        <div  id="header" class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-8">
                    <?php 
                        $this->load->view('templates/menu_sst.php');
                    ?>
                    </div>
                    <div class="col"></div>
                </div>
            </div>            
        </div>
        <div class="container-fluid"> 
            <div class="row">
                <div class="col"></div>
                <div class="col-md-8">    
                <?php
                    $this->load->view($contenido);
                ?>
                </div>
                <div class="col"></div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

           
            <script type="text/javascript" src="<?php echo base_url("assets/js/alertifyjs/alertify.js"); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.validationEngine.js"); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.validationEngine-es.js"); ?>"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
            <!-- Page level plugins -->
            <!--<script src="<?php echo base_url("assets/js/chart.js/Chart.min.js")?>"></script>-->
 

            <?php
            if(isset($js) && count($js) > 0){
                for($i=0;$i<count($js);$i++){
                    echo '<script type="text/javascript" src="'.$js[$i].'?i='.date('His').'"></script>';
                }
            }
            ?>
        </div>  
        
           
       
    			
    </body>
    <footer>
        <div id="header" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-center text-white">
                        <p>2019. @ Todos los derechos reservados- Versión 2.1</p>
                        <p><a  class="text-white" target="_blank" href="http://www.saludcapital.gov.co/Documents/Politica_Proteccion_Datos_P.pdf">*Habeas data</a></p>
                        <p><a  class="text-white" href="http://www.saludcapital.gov.co/Documents/Politicas_Sitios_Web.pdf" target="_blank">*Términos y condiciones</a></p>
                    </div>
                    <div class="col-md-4 text-right">
                        <img src="<?php echo base_url('assets/imgs/logos/logoalcaldia.png')?>" alt="">
                    </div>
                </div>
            </div>            
        </div>
    </footer>
</html> 