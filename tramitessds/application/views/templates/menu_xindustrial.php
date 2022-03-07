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
		  <li class="nav-item <?php if ($url=='usuario'){ echo "active";} ?>">
			<a class="nav-link text-white" href="<?php echo $this->config->item('url_tramites')."/usuario"?>">Mis trámites</a>
		  </li>
		  <li class="nav-item <?php if ($url=='usuario/nuevo_tramite'){ echo "active";} ?>">
			<a class="nav-link text-white" href="<?php echo $this->config->item('url_tramites')?>">Registrar Trámite</a>
		  </li>
          <?php
        }else if($this->session->userdata('perfil') == 3){
          ?>
          <li class="nav-item <?php if ($url=='xindustrial/validacion'){ echo "active";} ?>">
            <a class="nav-link text-white" href="<?php echo base_url('xindustrial/validacion/')?>">Mis trámites Pendientes</a>
          </li>
          <li class="nav-item dropdown <?php if ($url=='sst/reportes'){ echo "active";} elseif ($url=='sst/reportes/anulados'){ echo "active";}elseif ($url=='sst/reportes/devueltos'){ echo "active";} elseif ($url=='sst/reportes/licencias'){ echo "active";} elseif ($url=='sst/reportes/ministerio'){ echo "active";}?>">
              <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporte_xindustrial')?>">Reporte X Industrial</a>
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporteporcedulaRX')?>">Consultar tr&aacute;mites RX Industrial por No. de Identificación</a>
              </div>
          </li>
          <?php
        }else if($this->session->userdata('perfil') == 4){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url('xindustrial/coordinacion/')?>">Mis trámites Pendientes</a>
          </li>
          <li class="nav-item dropdown <?php if ($url=='sst/reportes'){ echo "active";} elseif ($url=='sst/reportes/anulados'){ echo "active";}elseif ($url=='sst/reportes/devueltos'){ echo "active";} elseif ($url=='sst/reportes/licencias'){ echo "active";} elseif ($url=='sst/reportes/ministerio'){ echo "active";}?>">
              <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporte_xindustrial')?>">Reporte X Industrial</a>
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporteporcedulaRX')?>">Consultar tr&aacute;mites RX Industrial por No. de Identificación</a>
              </div>
            </li>
          <?php
        }else if($this->session->userdata('perfil') == 5){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo base_url('xindustrial/direccion/')?>">Mis trámites Pendientes</a>
          </li>
          <li class="nav-item dropdown <?php if ($url=='sst/reportes'){ echo "active";} elseif ($url=='sst/reportes/anulados'){ echo "active";}elseif ($url=='sst/reportes/devueltos'){ echo "active";} elseif ($url=='sst/reportes/licencias'){ echo "active";} elseif ($url=='sst/reportes/ministerio'){ echo "active";}?>">
              <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporte_xindustrial')?>">Reporte X Industrial</a>
                <a class="dropdown-item" href="<?php echo base_url('xindustrial/reporteporcedulaRX')?>">Consultar tr&aacute;mites RX Industrial por No. de Identificación</a>
              </div>
            </li>
          <?php
        }

      ?>
	  <li class="nav-item active">
		<a class="nav-link text-white" href="<?php echo base_url('transversal/cambiar_clave/')?>">Cambiar Contraseña</a>
	  </li>
      <li class="nav-item active">
        <a class="nav-link text-white" href="<?php echo base_url('sst/cerrar_sesion/')?>">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>