
<?php

    $retornoError = $this->session->flashdata('error');
    if ($retornoError) {
        ?>
    <div class="alert alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $retornoError ?>
    </div>
    <?php
    }

    $retornoExito = $this->session->flashdata('exito');
    if ($retornoExito) {
        ?>
        <div class="alert alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php echo $retornoExito ?>
        </div>
        <?php
    }


if($tramite_info->modulo1 == 0){
	$step1_class = "btn-warning";
	$step1_check = "display:none";
}else{
	$step1_class = "btn-success";
	$step1_check = "display:block";
}

if($tramite_info->modulo2 == 0){
	$step2_class = "btn-warning";
	$step2_check = "display:none";
}else{
	$step2_class = "btn-success";
	$step2_check = "display:block";
}

if($tramite_info->modulo3 == 0){
	$step3_class = "btn-warning";
	$step3_check = "display:none";
}else{
	$step3_class = "btn-success";
	$step3_check = "display:block";
}

if($tramite_info->modulo4 == 0){
	$step4_class = "btn-warning";
	$step4_check = "display:none";
}else{
	$step4_class = "btn-success";
	$step4_check = "display:block";
}

if($tramite_info->modulo5 == 0){
	$step5_class = "btn-warning";
	$step5_check = "display:none";
}else{
	$step5_class = "btn-success";
	$step5_check = "display:block";
}

if($tramite_info->modulo1 == 1 && $tramite_info->modulo2 == 1 && $tramite_info->modulo3 == 1 && $tramite_info->modulo4 == 1 && $tramite_info->modulo5 == 1){
	$btn_fin_proceso = "1";
	$step6_class = "btn-warning";
}else{
	$btn_fin_proceso = "0";
}
?>
<div class="row-center">
	<div class="btn-group-sm text-center" role="group" aria-label="Basic example">
		<button class="btn <?php echo $step1_class?>" onClick="step1();" id="cstep1"><span id="check_step1" style="<?php echo $step1_check?>"><i class="far fa-check-square"></i></span> Localizacíón Entidad</button>
		<i class="fa fa-chevron-right"></i>
		<button class="btn <?php echo $step2_class?>" onClick="step2();" id="cstep2"><span id="check_step2" style="<?php echo $step2_check?>"><i class="far fa-check-square"></i></span> Equipos Rayos X</button>
		<i class="fa fa-chevron-right"></i>
		<button class="btn <?php echo $step3_class?>" onClick="step3();" id="cstep3"><span id="check_step3" style="<?php echo $step3_check?>"><i class="far fa-check-square"></i></span> Trabajadores TOE</button>
		<i class="fa fa-chevron-right"></i>
		<button class="btn <?php echo $step4_class?>" onClick="step4();" id="cstep4"><span id="check_step4" style="<?php echo $step4_check?>"><i class="far fa-check-square"></i></span> Talento Humano </button>
		<i class="fa fa-chevron-right"></i>
		<button class="btn <?php echo $step5_class?>" onClick="step5();" id="cstep5"><span id="check_step5" style="<?php echo $step5_check?>"><i class="far fa-check-square"></i></span> Documentos Adjuntos</button>	  
		<?php 
			if($btn_fin_proceso == 1){
				
				if($tramite_info->estado == 13){
					?>
					<i class="fa fa-chevron-right"></i>
					<button class="btn <?php echo $step6_class?>" onClick="step6();" id="cstep6"><span id="check_step6" style="<?php echo $step5_check?>"><i class="far fa-check-square"></i></span> Subsanar Trámite</button>	  	
					<?php
				}else if($tramite_info->estado == 22){
					?>
					<i class="fa fa-chevron-right"></i>
					<button class="btn <?php echo $step6_class?>" onClick="step6();" id="cstep6"><span id="check_step6" style="<?php echo $step5_check?>"><i class="far fa-check-square"></i></span> Subsanar Trámite</button>	  	
					<?php
				}else{
					?>
					<i class="fa fa-chevron-right"></i>
					<button class="btn <?php echo $step6_class?>" onClick="step6();" id="cstep6"><span id="check_step6" style="<?php echo $step5_check?>"><i class="far fa-check-square"></i></span> Finalizar Trámite</button>	  	
					<?php
				}			
			}
		  ?>
	</div>
	<br>
</div>

<?php
	
	$this->load->view('usuario/rayosx/form1');
	$this->load->view('usuario/rayosx/form2');
	$this->load->view('usuario/rayosx/form3');
	$this->load->view('usuario/rayosx/form4');
	$this->load->view('usuario/rayosx/form5');
	$this->load->view('usuario/rayosx/form6');
	
?>
