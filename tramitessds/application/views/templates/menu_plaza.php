<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
   
  </div>

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div id="menu" class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
    	<?php 
      	if($this->session->userdata('perfil') == 2){
        ?>
      		<li class=""><a href="#">Trámites</a></li>

      	<?php
        }else if($this->session->userdata('perfil') == 3){
        ?>
          <li class=""><a href="<?php echo base_url('plazas/tramites_pendientes')?>">Mis trámites</a></li>
               <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Reportes <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('plazas/reportes/1')?>">Trámites registrados</a></li> 
              <li><a href="<?php echo base_url('plazas/reportes/2')?>">Reporte histórico</a></li>
              <!--<li><a href="<?php echo base_url('plazas/reportes/3')?>">Trámites negados</a></li>-->
            </ul>
          </li>
        <?php
        }else if($this->session->userdata('perfil') == 4){
        ?>
        	<li class=""><a href="<?php echo base_url('plazas/tramites_pendientes')?>">Mis trámites</a></li>
               <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Reportes <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('plazas/reportes/1')?>">Trámites registrados</a></li> 
              <li><a href="<?php echo base_url('plazas/reportes/2')?>">Reporte histórico</a></li>
              <!--<li><a href="<?php //echo base_url('plazas/reportes/3')?>">Trámites negados</a></li>-->
            </ul>
          </li>
        <?php
        }else if($this->session->userdata('perfil') == 5){
        ?>
			     <li class=""><a href="<?php echo base_url('plazas/tramites_pendientes')?>">Mis trámites</a></li>
               <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Reportes <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('plazas/reportes/1')?>">Trámites registrados</a></li> 
              <li><a href="<?php echo base_url('plazas/reportes/2')?>">Reporte histórico</a></li>
              <!--<li><a href="<?php //echo base_url('plazas/reportes/3')?>">Trámites negados</a></li>-->
            </ul>
          </li>
      	<?php
        }
      	?>
      <!--<li><a href="#">Enlace #2</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li> 
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="">Cerrar sesi&oacute;n</a></li>
        </ul>
      </li>-->
      <li class="nav-item">
        <?php $url=$this->config->item('url_tramites').'registro/cambiar_clave_usuario/'; ?>
        <a class="nav-link" href="<?php echo $url ?>">Cambiar Contrase&ntilde;a</a>
      </li>
      <li class=""><a href="<?php echo base_url('plazas/logout_ci')?>">Cerrar sesi&oacute;n</a></li>
    </ul>
    
  </div>
</nav>