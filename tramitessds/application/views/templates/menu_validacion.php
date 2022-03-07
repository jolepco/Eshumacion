<nav class="navbar navbar-expand-md mt-2">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="mr-2">
                        <div class="locator mb-2">
                            <div class="point"><span></span></div>
                        </div>
                        <ul class="navbar-nav">

                            <li class="nav-item">
								
                                <span class="nav-link"><font color="white"> Perfil Validación</font></span>
								
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li> 
						
                            <li class="nav-item">
								
                                <div class="dropdown">
                                    <a class="nav-link" href="#">Tr&aacute;mites pendientes</a>
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php
                                        $tramites_validacion = explode(',',$this->session->userdata('id_usuario'));

                                        for($i=0;$i<count($tramites_validacion);$i++){
                                            if($tramites_validacion[$i] == 3){
                                                ?>
                                                <a class="dropdown-item" href="<?php echo base_url('validacion/')?>">Rayos x</a>
                                                <?php
                                            }else if($tramites_validacion[$i] == 5){
                                                ?>
                                                <a class="dropdown-item" href="<?php echo base_url('tramitessds/sst/')?>">Seguridad y Salud en el trabajo</a>
                                                <?php
                                            }
                                        }

                                       if($validacion->tramites=='4'){
										?>
										<a class="dropdown-item" href="<?php echo base_url('expendedor_droga/tramites_pendientes')?>">Expendedor de drogas</a>

                                        
										
										<!--<a class="dropdown-item" href="<?php echo base_url('validacion/aclarados')?>">Consultar tr&aacute;mites Aclarados</a>-->

										<?php
										}else{
										?>
										<a class="dropdown-item" href="<?php echo base_url('validacion/')?>">Tr&aacute;mites pendientes</a>
										<?php
										}
										?>
                                    </div>									
                                </div>

								
                            </li>
							
							<li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link" href="#">Menú Reportes</a>
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php
                                       if($validacion->tramites=='1'){
										?>
										<a class="dropdown-item" href="<?php echo base_url('validacion/reporteporcedula')?>">Consultar tr&aacute;mites por No. de Identificación</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/aprobados')?>">Consultar tr&aacute;mites Aprobados</a>
										
										<a class="dropdown-item" href="<?php echo base_url('validacion/aclarados')?>">Consultar tr&aacute;mites Aclarados</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/rechazados')?>">Consultar tr&aacute;mites Rechazados</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/recurso')?>">Consultar tr&aacute;mites en Recurso</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/negados')?>">Consultar tr&aacute;mites Negados</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/anulados')?>">Consultar tr&aacute;mites Anulados</a>

                                        <a class="dropdown-item" href="<?php echo base_url('validacion/solicitados')?>">Consultar tr&aacute;mites Solicitados</a>
										
										<a class="dropdown-item" href="<?php echo base_url('validacion/resolucion3030')?>">Resolución 3030 del 2014 Aprobados</a>
										
										<a class="dropdown-item" href="<?php echo base_url('validacion/resolucion3030aclaracion')?>">Resolución 3030 del 2014 Aclarados</a>
										<?php
										}else if ($validacion->tramites=='2'){
										?>
										<a class="dropdown-item" href="<?php echo base_url('validacion/exhumacion')?>">Consultar Tr&aacute;mites Exhumación</a>
										<?php
										}else if ($validacion->tramites=='3'){
										?>
										<a class="dropdown-item" href="<?php echo base_url('validacion/repor_consulta_rx')?>">Consultar Tr&aacute;mites RX</a>
										<?php
										}
										?>
                                    </div>									
                                </div>
                                
                            </li>							
					
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('registro/cambiar_clave_usuario')?>">Cambiar Contrase&ntilde;a</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('login/logout_ci')?>">Cerrar sesi&oacute;n</a>
							</li>
						</ul>
                    </div>
                </div>	
</nav>