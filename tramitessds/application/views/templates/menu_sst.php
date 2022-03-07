<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand  text-white" href="#">VUTS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link text-white" href="<?php echo $this->config->item('url_tramites')?>">Inicio</a>
      </li>
      <?php 
      
        if($this->session->userdata('perfil') == 2){
          ?>          
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo $this->config->item('url_tramites')."/usuario"?>">Mis trámites</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo $this->config->item('url_tramites')?>">Registrar Trámite</a>
          </li>  
          <?php
        }else if($this->session->userdata('perfil') == 3){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url('sst/validacion/')?>">Mis trámites Pendientes</a>
          </li>     
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/')?>">Dashboard</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/anulados')?>">Trámites Anulados</a>  
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/devueltos')?>">Trámites Devueltos</a>         
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/licencias')?>">Licencias Generadas</a> 
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/ministerio')?>">Reporte Ministerio</a>
		<a class="dropdown-item" href="<?php echo base_url('sst/reportes/reporteporcedulaSST')?>">Consulta trámites LSST por No. de Identificación</a>
              </div>
          </li> 
          <li class="nav-item active">
            <a class="nav-link text-white" href="<?php echo base_url('transversal/cambiar_clave/')?>">Cambiar Contraseña</a>
          </li>      
          <?php
        }else if($this->session->userdata('perfil') == 4){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url('sst/coordinacion/')?>">Mis trámites Pendientes</a>
          </li>    
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/')?>">Dashboard</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/anulados')?>">Trámites Anulados</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/devueltos')?>">Trámites Devueltos</a>          
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/licencias')?>">Licencias Generadas</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/ministerio')?>">Reporte Ministerio</a>
		<a class="dropdown-item" href="<?php echo base_url('sst/reportes/reporteporcedulaSST')?>">Consulta trámites LSST por No. de Identificación</a>
              </div>
          </li> 
          <li class="nav-item active">
            <a class="nav-link text-white" href="<?php echo base_url('transversal/cambiar_clave/')?>">Cambiar Contraseña</a>
          </li>           
          <?php
        }else if($this->session->userdata('perfil') == 5){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url('sst/direccion/')?>">Mis trámites Pendientes</a>
          </li>    
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/')?>">Dashboard</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/anulados')?>">Trámites Anulados</a>
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/devueltos')?>">Trámites Devueltos</a>          
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/licencias')?>">Licencias Generadas</a>   
                <a class="dropdown-item" href="<?php echo base_url('sst/reportes/ministerio')?>">Reporte Ministerio</a>
		<a class="dropdown-item" href="<?php echo base_url('sst/reportes/reporteporcedulaSST')?>">Consulta trámites LSST por No. de Identificación</a>
              </div>
          </li> 
          <li class="nav-item active">
            <a class="nav-link text-white" href="<?php echo base_url('transversal/cambiar_clave/')?>">Cambiar Contraseña</a>
          </li>          
          <?php
        }
      
      ?>      
      <li class="nav-item active">
        <a class="nav-link text-white" href="<?php echo base_url('sst/cerrar_sesion/')?>">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>