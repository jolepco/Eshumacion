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

      
    
            <link rel="stylesheet" href="<?php echo base_url("assets/css/expendedor/1140.css"); ?>" type="text/css" media="screen" />
            <link rel="stylesheet" href="<?php echo base_url("assets/css/expendedor/styles.css"); ?>" type="text/css" media="screen" />
            
            <link href="<?php echo base_url("assets/expendedor/bootstrap/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
            <!-- MetisMenu CSS -->
            <link href="<?php echo base_url("assets/expendedor/bootstrap/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="<?php echo base_url("assets/expendedor/bootstrap/dist/css/sb-admin-2.css"); ?>" rel="stylesheet">
            <!-- Custom Fonts -->
            <link href="<?php echo base_url("assets/expendedor/bootstrap/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
            <!-- DataTables CSS -->
            <link href="<?php echo base_url("assets/expendedor/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.css"); ?>" rel="stylesheet">
            <!-- DataTables Responsive CSS -->
            <link href="<?php echo base_url("assets/expendedor/bootstrap/vendor/datatables-responsive/dataTables.responsive.css"); ?>" rel="stylesheet">
            <link rel="stylesheet" href="<?php echo base_url("css/select2.css"); ?>" type="text/css" media="screen" />


            <!-- jQuery -->
            <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/jquery/jquery.min.js"); ?>"></script>
            <!-- jQuery validate-->
             <script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/jquery.validate.js"); ?>"></script>

            <link rel="stylesheet" href="<?php echo base_url("assets/css/expendedor/jquery-ui.css"); ?>" type="text/css">
            
                    
        <?php
        if(isset($js) && count($js) > 0){
            for($i=0;$i<count($js);$i++){
                echo '<script type="text/javascript" src="'.$js[$i].'"></script>';
            }
        }
        ?>
    </head>
    <header>
        <div class="container2">
            <div id="header">
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
            <div class="last">
                <?php 
                $this->load->view('templates/menu_plaza.php');
                /*switch ($this->session->userdata('perfil')) {
                case '1':
                    $this->load->view('templates/menu_admin.php');
                    break;
                case '2':
                    $this->load->view('templates/menu_usuario_exp.php');
                    break;
                case '3':
                    $this->load->view('templates/menu_validacion_exp.php');
                    break;
                case '4':
                    $this->load->view('templates/menu_coordinacion_exp.php');
                    break;
                case '5':
                    $this->load->view('templates/menu_direcccion_exp.php');
                    break;
                
                }*/
                ?> 
            </div>  
        </div>
    </header>
    <body>
        <div class="container">
            <div class="row">
                <div id="container2">
                      
                    <div id="contenido">
                        
                        <?php
                            $this->load->view($contenido);
                        ?>
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>
                        <!-- Metis Menu Plugin JavaScript -->
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/metisMenu/metisMenu.min.js"); ?>"></script>
                        <!-- Custom Theme JavaScript -->
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/dist/js/sb-admin-2.js"); ?>"></script>
                        <!-- DataTables JavaScript -->
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/datatables/js/jquery.dataTables.min.js"); ?>"></script>
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.min.js"); ?>"></script>
                        <script src="<?php echo base_url("assets/expendedor/bootstrap/vendor/datatables-responsive/dataTables.responsive.js"); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url("assets/expendedor/js/general/ready.js"); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url("js/general/select2.js"); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url("assets/expendedor/js/validate/planeacion/planeacion.js"); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/jquery-ui.js"); ?>"></script>
                        <script src="<?php echo base_url('assets/js/expendedor/expendedor.js') ?>"></script>
                        <script src="<?php echo base_url('assets/js/plazas/ready.js') ?>"></script>
                         <script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/jquery-ui.js"); ?>"></script>
                         <script type="text/javascript" src="<?php echo base_url("assets/js/expendedor/general.js"); ?>"></script>


                           
                    </div>
                </div>
            </div>
        </div>  
        
           
       
                
    </body>
    <footer>
        <div class="container2">
            <div id="footer">
                <div class="row">
                    <div class="col-12 col-md-4"></div>
                    <div class="col-12 col-md-4 text-md-center">
                        <p>2019. @ Todos los derechos reservados- Versión 2.1</p>
                        <p style="color:white;"><a target="_blank" href="http://www.saludcapital.gov.co/Documents/Politica_Proteccion_Datos_P.pdf" style="color:white;">*Habeas data</a></p>
                        <p style="color:white;"><a href="http://www.saludcapital.gov.co/Documents/Politicas_Sitios_Web.pdf" style="color:white;" target="_blank">*Términos y condiciones</a></p>
                    </div>
                    <div class="col-12 col-md-4 text-md-right">
                        <img src="<?php echo base_url('assets/img/logos/logoalcaldia.png')?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</html> 