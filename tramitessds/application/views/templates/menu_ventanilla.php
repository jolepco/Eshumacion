<ul>
    <li><a href="#" class="item-pc-menu item-btn-dd">Tr&aacute;mites</a>
        <ul class="dropdown-m">
            <li><a class="dd-item" href="<?php echo base_url('validacion/')?>">Nuevo Tr&aacute;mite</a></li>
        </ul>
    </li>
    <li><a class="item-pc-menu" href="<?php echo base_url('login/logout_ci')?>">Cerrar sesi&oacute;n</a></li>
</ul>




<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo "Validaci&oacute;n"?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a class="dd-item" href="<?php echo base_url('validacion/')?>">Nuevo Tr&aacute;mite</a></li>       
      </ul>
      
      <ul class="nav navbar-nav navbar-right">        
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('usuario')?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('usuario/')?>">Actualizaci&oacute;n Datos</a></li>
            
          </ul>
        </li>-->
        <li><a href="<?php echo base_url('login/logout_ci')?>">Cerrar sesi&oacute;n</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
    
    
  </div>
  <!-- /.container-fluid -->
</nav>