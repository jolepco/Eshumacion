<!DOCTYPE html>
<html>

<head>

    <!--Meta tags-->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">
    <meta http-equiv="content-language" content="es">
    <meta name="distribution" content="global">
    <meta name="robots" content="all">

    <!--favicon-->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/layout_sds/images/favicon/favicon.png')?>" />

    <!--Fuente de iconografia-->
    <link rel="stylesheet" href="<?php echo base_url('assets/layout_sds/css/font-awesome.min.css')?>">

    <!--Titulo del sistema de información-->
    <title>Secretaría Distrital de Salud</title>

    <!--Enlaces hojas de estilos-->
    <link rel="stylesheet" href="<?php echo base_url('assets/layout_sds/css/reset.css')?>">
    <!--
        <link rel="stylesheet" href="css/main.full.css">
-->
    <link rel="stylesheet" href="<?php echo base_url('assets/layout_sds/css/admin.css')?>">

</head>

<body>
    <header>
        <div class="brand d-inflex">
            <img class="logo-header" src="<?php echo base_url('assets/layout_sds/images/logos/logo-blanco.svg')?>" alt="Escudo de la Alcaldía Mayor de Bogotá D. C. y logotipo de Bogotá mejor para todos">
        </div>
        <div class="config-menu d-inflex">
            <a href="#" class="desk-act" data-tooltip="" id="hideMenuAdmin"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <a href="#" class="mvl-act" data-tooltip="" id="actMovileMenuAdmin"><i class="fa fa-bars" aria-hidden="true"></i></a>
        </div>
        <div class="config-menu d-inflex">
            <a href="index.html" data-tooltip=""><i class="fa fa-home m-right-1" aria-hidden="true"></i><span class="m-text-adm">Inicio</span></a>
        </div>
        <div class="config-menu d-inflex">
            <a class="item-btn-dd" href="#" data-tooltip=""><img class="avatar-menu" src="<?php echo base_url('assets/layout_sds/images/avatars/avatar-n.svg')?>" alt="Foto de perfil"><span class="m-text-adm">Administrador</span></a>
            <ul class="dropdown-m">
                <li><a class="dd-item" href=""><i class="fa fa-bell" aria-hidden="true"></i>Notificaciones</a></li>
                <li><a class="dd-item" href=""><i class="fa fa-comments-o" aria-hidden="true"></i>Mensajes</a></li>
                <li><a class="dd-item" href="index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>
Cerrar sesión</a></li>
            </ul>
        </div>
    </header>

    <div class="d-inflex left-menu">
        <div class="user-section">
            <span class="avatar-user"><img src="<?php echo base_url('assets/layout_sds/images/avatars/avatar-n.svg')?>" alt="Avatar"></span>
            <p class="name-user">Administrador</p>
        </div>
        <div class="d-flex menu-section">
            <ul class="m-admin">
                <li><a href="#" class="link-left-menu dd-m-collapsed-btn"><i class="fa fa-home" aria-hidden="true"></i><span class="menu-text">Dashboard</span><i class="fa fa-sort-desc f-right m-right-0 i-anim" aria-hidden="true"></i></a>
                    <ul class="dropdown-m-collapsed" id="mAdminCollapsed">
                        <li><a href="" class="dd-item-m-collapsed">Menú</a></li>
                        <li><a href="" class="dd-item-m-collapsed">Menú</a></li>
                        <li><a href="" class="dd-item-m-collapsed">Menú</a></li>
                        <li><a href="" class="dd-item-m-collapsed">Menú</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!--Cartas de accesos faciles-->

    <div class="main-container">
        <div class=" content-main">
            <ul class="card-section">
                <li class="card-btn-c"><a href="#" class="card-btn "><i class="fa fa-bed" aria-hidden="true"></i><span class="imp-text">30</span><span class="sec-text">Camas habilitadas</span></a></li>
                <li class="card-btn-c"><a href="#" class="card-btn btnPopUp"><i class="fa fa-hospital-o" aria-hidden="true"></i><span class="imp-text">25</span><span class="sec-text">Centros hospitalarios</span></a></li>
                <li class="card-btn-c"><a href="#" class="card-btn "><i class="fa fa-ambulance" aria-hidden="true"></i><span class="imp-text">14</span><span class="sec-text">Ambulacias</span></a></li>
                <li class="card-btn-c"><a href="#" class="card-btn "><i class="fa fa-stethoscope" aria-hidden="true"></i><span class="imp-text">1320</span><span class="sec-text">Medicos</span></a></li>
                <li class="card-btn-c"><a href="#" class="card-btn "><i class="fa fa-medkit" aria-hidden="true"></i>
<span class="imp-text">+ 350</span><span class="sec-text">Vacunas disponibles</span></a></li>
            </ul>
        </div>

        <!--Cartas de información adicional-->
        <div class="content-main m-top-0">
            <ul class="card-section m-top-2">
                <li class="card-btn-c card-btn-c-mbl">
                    <div class="card-dash">

                    </div>
                </li>
                <li class="card-btn-c card-btn-c-mbl">
                    <div class="card-dash"></div>
                </li>
                <li class="card-btn-c card-btn-c-mbl">
                    <div class="card-dash">
                        <table id="calendar">
                            <caption></caption>
                            <thead>
                                <tr>
                                    <th>Lun</th>
                                    <th>Mar</th>
                                    <th>Mie</th>
                                    <th>Jue</th>
                                    <th>Vie</th>
                                    <th>Sab</th>
                                    <th>Dom</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>

        <footer class="fixed-pos">
            <div class="copy">2018. @ Todos los derechos reservados </div>
            <div class="social">
                <ul>
                    <li><a href="" class="social-link"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="" class="social-link"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </footer>
    </div>

    <div class="background-popup"></div>
    <div class="container-popup" id="popUp">
        <div class="content-popup">
            <div class="header-popup">
                <h3>Título PopUp</h3>
                <i class="fa fa-times" aria-hidden="true" id="closePopUpbtn"></i>
            </div>
            <div class="body-popup">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate libero sint temporibus reiciendis exercitationem.
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="css/calendarCSS.css">

    <script src="js/calendarJS.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>