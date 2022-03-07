$.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '<Ant',
	 nextText: 'Sig>',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	 weekHeader: 'Sm',
	 dateFormat: 'dd/mm/yy',
	 firstDay: 1,
	 isRTL: false,
	 yearRange: '-100y:-0d',
	 showMonthAfterYear: false,
	 yearSuffix: ''
	 };
$.datepicker.setDefaults($.datepicker.regional['es']);

$(document).ready(function() {
	
	var $signupForm = $( '#SignupForm' );
        
	$signupForm.validationEngine({
		promptPosition : "topRight", 
		scroll: false,
		autoHidePrompt: true,
		autoHideDelay: 2000
	}); 
	
	$signupForm.formToWizard({
		submitButton: 'Guardar',
		nextBtnClass: 'btn btn-primary next',
		prevBtnClass: 'btn btn-default prev',
		buttonTag:    'button',
		nextBtnName: 'Siguiente >>',
		prevBtnName: '<< Regresar',		
		showProgress: true, //default value for showProgress is also true
		showStepNo: true,                
		validateBeforeNext: function() {
			return $signupForm.validationEngine( 'validate' );
		},
		progress: function (i, count) {
			$('#progress-complete').width(''+(i/count*100)+'%');
		}
	});
	
	$signupForm.submit(function() {
		var $resultado=$signupForm.validationEngine("validate");

		if ($resultado) {

			return true;
		}
		return false;
	});
	
	$('#tabla_personas').DataTable({
		language: {
			search:         "Buscar:",
			lengthMenu:    "Ver _MENU_ registros",
			info:           "Viendo _START_ a _END_ de _TOTAL_ entradas",
			infoEmpty:      "No se encontraron resultados",
			paginate: {
				first:      "Primero",
				previous:   "Previo",
				next:       "Siguiente",
			}
		}
	});
	
	$("#viable").change(function(){
		
		if($("#viable").val() == '1'){
			$("#efectiva").show();
			$("#no_efectiva").hide();
		}else{
			$("#efectiva").hide();
			$("#no_efectiva").show();
		}
		
	});
	
	$("#dir1, #dir2, #dir3, #dir4, #dir5, #dir6, #dir7, #dir8, #dir9, #dir10, #dir11, #dir12").change(function(){
		
		var dir1 = $("#dir1").val();
		var dir2 = $("#dir2").val();
		var dir3 = $("#dir3").val();
				
		if($('input:checkbox[name=dir4]:checked').val() == 'on'){
			var dir4 = 'BIS';	
		}else{
			var dir4 = '';	
		}
		
		var dir5 = $("#dir5").val();
		var dir6 = $("#dir6").val();
		var dir7 = $("#dir7").val();
		var dir8 = $("#dir8").val();
		
		if($('input:checkbox[name=dir9]:checked').val() == 'on'){
			var dir9 = 'BIS';	
		}else{
			var dir9 = '';	
		}		
		
		var dir10 = $("#dir10").val();
		var dir11 = $("#dir11").val();
		var dir12 = $("#dir12").val();
		var dir13 = $("#dir13").val();
		
		var direccion_final = dir1 + " " + dir2 + " " + dir3 + " " + dir4 + " " + dir5 + " " + dir6 + " " + dir7 + " " + dir8 + " " + dir9 + " " + dir10 + " " + dir11 + " " + dir12 + " " + dir13;

		$("#dire_usua").val(direccion_final);	
	});
	
	$("#loca_capta").change(function () {
           $("#loca_capta option:selected").each(function () {
            localidad = $(this).val();
            $.post( base_url + "gestor/upzs", { 
				loca: localidad }, 
			function(data){
            $("#upz_capta").html(data);
            });            
        });
	})
	/*
	$("#enc_sexo").change(function () {
		var edad = $("#enc_edad").val();
		var sexo = $("#enc_sexo").val();
		
		if(sexo == 'F'){
			$("#div_gestante").show();
			$("#div_mujer").show();
			$("#div_hombre").hide();
		}else{
			$("#div_gestante").hide();
			$("#div_gestantepr").hide();
			$("#div_mujer").hide();
			$("#div_hombre").show();
		}

		//Campos Primera infancia
		$("#div_pi_me1").hide();
		$("#div_pi_me6m").hide();
		$("#div_pi_i1").hide();
		$("#div_pi_e24").hide();
		$("#div_pi_4").hide();
		$("#div_pi_ma2").hide();
		if(edad <= 1){
			$("#div_pi_me1").show();
			$("#div_pi_me6m").show();
		}
		
		if(edad == 1){
			$("#div_pi_i1").show();
		}
		
		if(edad >= 2 && edad <= 4){
			$("#div_pi_e24").show();
		}
		
		if(edad == 4){
			$("#div_pi_4").show();
		}
		
		if(edad > 2){
			$("#div_pi_ma2").show();
		}	
		
		if(edad <= 5){
			$("#div_imc_ninos").show();
			$("#div_imc").hide();
		}else{
			$("#div_imc_ninos").hide();
			$("#div_imc").show();
		}
		
		//Campos Infancia
		$("#div_in_1").hide();
		$("#div_in_2").hide();
		$("#div_in_3").hide();
		
		if(edad >= 6 && edad <= 7){
			$("#div_in_1").show();
		}
		
		if(edad >= 8 && edad <= 9){
			$("#div_in_2").show();
		}
		
		if(edad == 11){
			$("#div_in_3").show();
		}
		
		//Campos Adolescencia
		$("#div_ad_1").hide();
		$("#div_ad_2").hide();
		$("#div_ad_3").hide();
		
		if(edad == 16){
			$("#div_ad_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_ad_2").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ad_3").show();
		}
		
		//Campos juventud
		$("#div_ju_1").hide();
		$("#div_ju_2").hide();
				
		if(sexo == 'F'){
			$("#div_ju_1").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ju_2").show();
		}
				
		//Campos adultez
		$("#div_adu_1").hide();
		$("#div_adu_2").hide();
		$("#div_adu_3").hide();
		$("#div_adu_4").hide();
		$("#div_adu_5").hide();
				
		if(sexo == 'F' && edad >= 50){
			$("#div_adu_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_adu_2").show();
		}
		
		if(edad == 45){
			$("#div_adu_3").show();
		}
		
		if(edad <= 45){
			$("#div_adu_4").show();
		}
			
		if(sexo == 'M' && edad >= 50){
			$("#div_adu_5").show();
		}	

		//Campos vejez
		$("#div_ve_1").hide();
		$("#div_ve_2").hide();
		$("#div_ve_3").hide();
				
		if(sexo == 'F'){
			$("#div_ve_1").show();
		}
		
		if(sexo == 'F' && edad <= 69){
			$("#div_ve_2").show();
		}
					
		if(sexo == 'M' && edad >= 50){
			$("#div_ve_3").show();
		}	
	})
	*/
	/*
	$("#enc_gestante").change(function () {
		var gestante = $(this).val();
		
		var edad = $("#enc_edad").val();
		var sexo = $("#enc_sexo").val();
		
		if(gestante == 'Si'){
			$("#div_gestantepr").show();
			$("#div_semanas").show();
			$("#div_gestante_puer").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
								
			if(edad >= 10 && edad <= 19){
				$("#div_ga1").show();
				$("#div_ga2").show();
			}else{
				$("#div_ga1").hide();
				$("#div_ga2").hide();
			}
		}else if(gestante == 'Puerperio'){
			$("#div_gestante_puer").show();
			$("#div_semanas").hide();
			$("#div_gestantepr").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
		}else{
			$("#div_gestantepr").hide();
			$("#div_gestante_puer").hide();
			$("#div_semanas").hide();

			if(edad <= 5){
				$("#div_pi").show();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 5 && edad <= 11){
				$("#div_pi").hide();
				$("#div_in").show();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 11 && edad <= 17){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").show();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 17 && edad <= 28){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").show();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 28 && edad <= 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").show();
				$("#div_cronicos").hide();
				$("#div_ve").hide();
			}else if(edad > 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").show();
				$("#div_cronicos").hide();
			}	
			
			if(edad >= 45){
				$("#div_cronicos").show();
			}else{
				$("#div_cronicos").hide();
			}
		} 

		//Campos Primera infancia
		$("#div_pi_me1").hide();
		$("#div_pi_me6m").hide();
		$("#div_pi_i1").hide();
		$("#div_pi_e24").hide();
		$("#div_pi_4").hide();
		$("#div_pi_ma2").hide();
		if(edad <= 1){
			$("#div_pi_me1").show();
			$("#div_pi_me6m").show();
		}
		
		if(edad == 1){
			$("#div_pi_i1").show();
		}
		
		if(edad >= 2 && edad <= 4){
			$("#div_pi_e24").show();
		}
		
		if(edad == 4){
			$("#div_pi_4").show();
		}
		
		if(edad > 2){
			$("#div_pi_ma2").show();
		}	
		
		if(edad <= 5){
			$("#div_imc_ninos").show();
			$("#div_imc").hide();
		}else{
			$("#div_imc_ninos").hide();
			$("#div_imc").show();
		}
		
		//Campos Infancia
		$("#div_in_1").hide();
		$("#div_in_2").hide();
		$("#div_in_3").hide();
		
		if(edad >= 6 && edad <= 7){
			$("#div_in_1").show();
		}
		
		if(edad >= 8 && edad <= 9){
			$("#div_in_2").show();
		}
		
		if(edad == 11){
			$("#div_in_3").show();
		}
		
		//Campos Adolescencia
		$("#div_ad_1").hide();
		$("#div_ad_2").hide();
		$("#div_ad_3").hide();
		
		if(edad == 16){
			$("#div_ad_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_ad_2").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ad_3").show();
		}
		
		//Campos juventud
		$("#div_ju_1").hide();
		$("#div_ju_2").hide();
				
		if(sexo == 'F'){
			$("#div_ju_1").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ju_2").show();
		}
				
		//Campos adultez
		$("#div_adu_1").hide();
		$("#div_adu_2").hide();
		$("#div_adu_3").hide();
		$("#div_adu_4").hide();
		$("#div_adu_5").hide();
				
		if(sexo == 'F' && edad >= 50){
			$("#div_adu_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_adu_2").show();
		}
		
		if(edad == 45){
			$("#div_adu_3").show();
		}
		
		if(edad <= 45){
			$("#div_adu_4").show();
		}
			
		if(sexo == 'M' && edad >= 50){
			$("#div_adu_5").show();
		}	

		//Campos vejez
		$("#div_ve_1").hide();
		$("#div_ve_2").hide();
		$("#div_ve_3").hide();
				
		if(sexo == 'F'){
			$("#div_ve_1").show();
		}
		
		if(sexo == 'F' && edad <= 69){
			$("#div_ve_2").show();
		}
					
		if(sexo == 'M' && edad >= 50){
			$("#div_ve_3").show();
		}			
		
	})
	*/
	$("#depto_naci").change(function () {
           $("#depto_naci option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "gestor/municipios", { 
				dpto: departamento }, 
			function(data){
            $("#muni_naci").html(data);
            });            
        });
	})
	
	
	/*
	if($("#enc_fech_nac").val() != ''){
		fecha = new Date($("#enc_fech_nac").val());
		hoy = new Date();
		edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
		$("#enc_edad").val(edadPaciente);
		
		var edad = $("#enc_edad").val();
		var sexo = $("#enc_sexo").val();
		
		var gestante = $("#enc_gestante").val();
		
		if(gestante == 'Si'){
			$("#div_gestantepr").show();
			$("#div_gestante_puer").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
								
			if(edad >= 10 && edad <= 19){
				$("#div_ga1").show();
				$("#div_ga2").show();
			}else{
				$("#div_ga1").hide();
				$("#div_ga2").hide();
			}
		}else if(gestante == 'Puerperio'){
			$("#div_gestante_puer").show();
			$("#div_gestantepr").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
		}else{
			$("#div_gestantepr").hide();
			$("#div_gestante_puer").hide();
			
			if(edad <= 5){
				$("#div_pi").show();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 5 && edad <= 11){
				$("#div_pi").hide();
				$("#div_in").show();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 11 && edad <= 17){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").show();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 17 && edad <= 28){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").show();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 28 && edad <= 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").show();
				$("#div_cronicos").hide();
				$("#div_ve").hide();
			}else if(edad > 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").show();
				$("#div_cronicos").hide();
			}
			
			if(edad >= 45){
				$("#div_cronicos").show();
			}else{
				$("#div_cronicos").hide();
			}
		} 
		
		if(edad <= 5){
			$("#div_imc_ninos").show();
			$("#div_imc").hide();
		}else{
			$("#div_imc_ninos").hide();
			$("#div_imc").show();
		}
		
		//Campos Primera infancia
		$("#div_pi_me1").hide();
		$("#div_pi_me6m").hide();
		$("#div_pi_i1").hide();
		$("#div_pi_e24").hide();
		$("#div_pi_4").hide();
		$("#div_pi_ma2").hide();
		if(edad <= 1){
			$("#div_pi_me1").show();
			$("#div_pi_me6m").show();
		}
		
		if(edad == 1){
			$("#div_pi_i1").show();
		}
		
		if(edad >= 2 && edad <= 4){
			$("#div_pi_e24").show();
		}
		
		if(edad == 4){
			$("#div_pi_4").show();
		}
		
		if(edad > 2){
			$("#div_pi_ma2").show();
		}

		//Campos Infancia
		$("#div_in_1").hide();
		$("#div_in_2").hide();
		$("#div_in_3").hide();
		
		if(edad >= 6 && edad <= 7){
			$("#div_in_1").show();
		}
		
		if(edad >= 8 && edad <= 9){
			$("#div_in_2").show();
		}
		
		if(edad == 11){
			$("#div_in_3").show();
		}	
		
		//Campos Adolescencia
		$("#div_ad_1").hide();
		$("#div_ad_2").hide();
		$("#div_ad_3").hide();
		
		if(edad == 16){
			$("#div_ad_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_ad_2").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ad_3").show();
		}
				
		//Campos juventud
		$("#div_ju_1").hide();
		$("#div_ju_2").hide();
				
		if(sexo == 'F'){
			$("#div_ju_1").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ju_2").show();
		}
				
		//Campos adultez
		$("#div_adu_1").hide();
		$("#div_adu_2").hide();
		$("#div_adu_3").hide();
		$("#div_adu_4").hide();
		$("#div_adu_5").hide();
				
		if(sexo == 'F' && edad >= 50){
			$("#div_adu_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_adu_2").show();
		}
		
		if(edad == 45){
			$("#div_adu_3").show();
		}
		
		if(edad <= 45){
			$("#div_adu_4").show();
		}
			
		if(sexo == 'M' && edad >= 50){
			$("#div_adu_5").show();
		}

		//Campos vejez
		$("#div_ve_1").hide();
		$("#div_ve_2").hide();
		$("#div_ve_3").hide();
				
		if(sexo == 'F'){
			$("#div_ve_1").show();
		}
		
		if(sexo == 'F' && edad <= 69){
			$("#div_ve_2").show();
		}
					
		if(sexo == 'M' && edad >= 50){
			$("#div_ve_3").show();
		}				
	}
*/
	/*
		FUNCION: VALIDACIONES CUANDO SE CAMBIA LA FECHA DE NACIMIENTO
		DESCRIPCION: CUANDO EL USUARIO CAMBIA LA FECHA DE NACIMIENTO SE DEBEN CARGAR ALGUNAS VALIDACIONES
	*/ 
	//$('#enc_fech_nac').on('load change', function() {
	$('#enc_fech_nac, #enc_gestante, #enc_sexo').bind('load change', function() {
		//alert("Ingreso");
	//$("#enc_fech_nac").load.change(function () {
		
		fecha = new Date($("#enc_fech_nac").val());
		hoy = new Date();
		edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
		var mesesUsuario = calcularEdad($("#enc_fech_nac").val(), 'meses', 'SI');
		
		$("#enc_edad").val(edadPaciente);
		
		var edad = $("#enc_edad").val();
		var sexo = $("#enc_sexo").val();
		
		var gestante = $("#enc_gestante").val();
				
		if(sexo == 'F'){
			$("#div_gestante").show();
			$("#div_mujer").show();
			$("#div_hombre").hide();
		}else{
			$("#div_gestante").hide();
			$("#div_gestantepr").hide();
			$("#div_mujer").hide();
			$("#div_hombre").show();
		}
		
		
		if(gestante == 'Si'){
			$("#div_gestantepr").show();
			$("#div_gestante_puer").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
								
			if(edad >= 10 && edad <= 19){
				$("#div_ga1").show();
				$("#div_ga2").show();
			}else{
				$("#div_ga1").hide();
				$("#div_ga2").hide();
			}
		}else if(gestante == 'Puerperio'){
			$("#div_gestante_puer").show();
			$("#div_gestantepr").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
			
			if(edad >= 10 && edad <= 19){
				$("#val_puer_1").show();
				$("#val_puer_2").hide();
			}else{
				$("#val_puer_1").hide();
				$("#val_puer_2").show();
			}
		}else{
			$("#div_gestantepr").hide();
			$("#div_gestante_puer").hide();
			
			if(edad <= 5){
				$("#div_pi").show();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 5 && edad <= 11){
				$("#div_pi").hide();
				$("#div_in").show();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 11 && edad <= 17){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").show();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 17 && edad <= 28){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").show();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 28 && edad <= 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").show();
				$("#div_cronicos").hide();
				$("#div_ve").hide();
			}else if(edad > 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").show();
				$("#div_cronicos").hide();
			}
			
			if(edad >= 45){
				$("#div_cronicos").show();
			}else{
				$("#div_cronicos").hide();
			}
		}
		
		if(edad <= 5){
			$("#div_imc_ninos").show();
			$("#div_imc").hide();
		}else{
			$("#div_imc_ninos").hide();
			$("#div_imc").show();
		}
		
		if(mesesUsuario < 2){
			$("#val_pi_1").show();
			$("#val_pi_2").hide();
		}else{
			$("#val_pi_1").hide();
			$("#val_pi_2").show();
		}
		
		if(edad >= 60){
			$("#val_as_2").show();
		}else{
			$("#val_as_2").hide();
		}
		
		if(edad >= 5 && edad < 18){
			$("#val_as_3").show();
		}else{
			$("#val_as_3").hide();
		}
		
		if(sexo == 'F'){
			$("#val_as_1").show();
		}else{
			$("#val_as_1").hide();
		}

		
		//Campos Primera infancia
		$("#div_pi_me1").hide();
		$("#div_pi_me6m").hide();
		$("#div_pi_i1").hide();
		$("#div_pi_e24").hide();
		$("#div_pi_4").hide();
		$("#div_pi_ma2").hide();
		if(mesesUsuario < 6){
			$("#div_pi_me6m").show();
			$("#div_pi_me1").show();
		}else if(mesesUsuario < 12){
			$("#div_pi_me1").show();
			$("#div_pi_i1").hide();
			$("#div_pi_me6m").hide();
			$("#div_pi_e24").hide();
		}else if(mesesUsuario >= 12 && mesesUsuario < 24){
			$("#div_pi_i1").show();			
			$("#div_pi_me1").hide();
			$("#div_pi_me6m").hide();
			$("#div_pi_e24").hide();
		}else if(mesesUsuario >= 24 && mesesUsuario <= 84){
			$("#div_pi_e24").show();			
			$("#div_pi_me1").hide();
			$("#div_pi_i1").hide();
			$("#div_pi_me6m").hide();
		}
		
		if(edad == 4 && edad <= 5){
			$("#div_pi_4").show();
		}
		
		if(edad > 2){
			$("#div_pi_ma2").show();
		}	
		
		//Campos Infancia
		$("#div_in_1").hide();
		$("#div_in_2").hide();
		$("#div_in_3").hide();
		
		if(edad >= 6 && edad <= 7){
			$("#div_in_1").show();
		}
		
		if(edad >= 8 && edad <= 9){
			$("#div_in_2").show();
		}
		
		if(edad >= 11 && edad < 12 ){
			$("#div_in_3").show();
		}
		
		//Campos Adolescencia
		$("#div_ad_1").hide();
		$("#div_ad_2").hide();
		$("#div_ad_3").hide();
		
		if(edad == 16){
			$("#div_ad_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_ad_2").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ad_3").show();
		}
		
		//Campos juventud
		$("#div_ju_1").hide();
		$("#div_ju_2").hide();
				
		if(sexo == 'F'){
			$("#div_ju_1").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ju_2").show();
		}
				
		//Campos adultez
		$("#div_adu_quinquenio").hide();
		$("#div_adu_1").hide();
		$("#div_adu_2").hide();
		$("#div_adu_3").hide();
		$("#div_adu_4").hide();
		$("#div_adu_5").hide();
		
		if((edad >= 45 && edad < 46) || (edad >= 50 && edad < 51) || (edad >= 55 && edad < 56)){
			$("#div_adu_quinquenio").show();
		}	
				
		if(sexo == 'F' && edad >= 50){
			$("#div_adu_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_adu_2").show();
		}
		
		if(edad >= 45 && edad < 46){
			$("#div_adu_3").show();
		}
		
		if(edad <= 45){
			$("#div_adu_4").show();
		}
			
		if(sexo == 'M' && edad >= 50){
			$("#div_adu_5").show();
		}	

		//Campos vejez
		$("#div_ve_1").hide();
		$("#div_ve_2").hide();
		$("#div_ve_3").hide();
		
		if((edad >= 60 && edad < 61) || (edad >= 65 && edad < 66) || (edad >= 70 && edad < 71) || (edad >= 75 && edad < 76) || (edad >= 80 && edad < 81) || (edad >= 85 && edad < 86) || (edad >= 90 && edad < 91) || (edad >= 95 && edad < 96) || (edad >= 100 && edad < 101)){
			$("#div_ve_quinquenio").show();
		}
				
		if(sexo == 'F'){
			$("#div_ve_1").show();
		}
		
		if(sexo == 'F' && edad <= 69){
			$("#div_ve_2").show();
		}
					
		if(sexo == 'M' && edad >= 50){
			$("#div_ve_3").show();
		}			
	})
	/*
	if($("#enc_edad").val() != ''){
		
		var edad = $("#enc_edad").val();
		var sexo = $("#enc_sexo").val();
		
		var gestante = $("#enc_gestante").val();
		
		if(gestante == 'Si'){
			$("#div_gestantepr").show();
			$("#div_gestante_puer").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
								
			if(edad >= 10 && edad <= 19){
				$("#div_ga1").show();
				$("#div_ga2").show();
			}else{
				$("#div_ga1").hide();
				$("#div_ga2").hide();
			}
		}else if(gestante == 'Puerperio'){
			$("#div_gestante_puer").show();
			$("#div_gestantepr").hide();
			$("#div_pi").hide();
			$("#div_in").hide();
			$("#div_ado").hide();
			$("#div_juv").hide();
			$("#div_adu").hide();
			$("#div_ve").hide();
			$("#div_cronicos").hide();
		}else{
			$("#div_gestantepr").hide();
			$("#div_gestante_puer").hide();
			
			if(edad <= 5){
				$("#div_pi").show();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 5 && edad <= 11){
				$("#div_pi").hide();
				$("#div_in").show();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 11 && edad <= 17){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").show();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 17 && edad <= 28){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").show();
				$("#div_adu").hide();
				$("#div_ve").hide();
				$("#div_cronicos").hide();
			}else if(edad > 28 && edad <= 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").show();
				$("#div_cronicos").hide();
				$("#div_ve").hide();
			}else if(edad > 59){
				$("#div_pi").hide();
				$("#div_in").hide();
				$("#div_ado").hide();
				$("#div_juv").hide();
				$("#div_adu").hide();
				$("#div_ve").show();
				$("#div_cronicos").hide();
			}
			
			if(edad >= 45){
				$("#div_cronicos").show();
			}else{
				$("#div_cronicos").hide();
			}
		}
		
		if(edad <= 5){
			$("#div_imc_ninos").show();
			$("#div_imc").hide();
		}else{
			$("#div_imc_ninos").hide();
			$("#div_imc").show();
		}
		
		//Campos Primera infancia
		$("#div_pi_me1").hide();
		$("#div_pi_me6m").hide();
		$("#div_pi_i1").hide();
		$("#div_pi_e24").hide();
		$("#div_pi_4").hide();
		$("#div_pi_ma2").hide();
		if(edad <= 1){
			$("#div_pi_me1").show();
			$("#div_pi_me6m").show();
		}
		
		if(edad == 1){
			$("#div_pi_i1").show();
		}
		
		if(edad >= 2 && edad <= 4){
			$("#div_pi_e24").show();
		}
		
		if(edad == 4){
			$("#div_pi_4").show();
		}
		
		if(edad > 2){
			$("#div_pi_ma2").show();
		}

		//Campos Infancia
		$("#div_in_1").hide();
		$("#div_in_2").hide();
		$("#div_in_3").hide();
		
		if(edad >= 6 && edad <= 7){
			$("#div_in_1").show();
		}
		
		if(edad >= 8 && edad <= 9){
			$("#div_in_2").show();
		}
		
		if(edad == 11){
			$("#div_in_3").show();
		}	
		
		//Campos Adolescencia
		$("#div_ad_1").hide();
		$("#div_ad_2").hide();
		$("#div_ad_3").hide();
		
		if(edad == 16){
			$("#div_ad_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_ad_2").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ad_3").show();
		}
		
		//Campos juventud
		$("#div_ju_1").hide();
		$("#div_ju_2").hide();
				
		if(sexo == 'F'){
			$("#div_ju_1").show();
		}
		
		if(edad >= 10 && edad <= 19 && sexo == 'F'){
			$("#div_ju_2").show();
		}
				
		//Campos adultez
		$("#div_adu_1").hide();
		$("#div_adu_2").hide();
		$("#div_adu_3").hide();
		$("#div_adu_4").hide();
		$("#div_adu_5").hide();
				
		if(sexo == 'F' && edad >= 50){
			$("#div_adu_1").show();
		}
		
		if(sexo == 'F'){
			$("#div_adu_2").show();
		}
		
		if(edad == 45){
			$("#div_adu_3").show();
		}
		
		if(edad <= 45){
			$("#div_adu_4").show();
		}
			
		if(sexo == 'M' && edad >= 50){
			$("#div_adu_5").show();
		}		
		
		//Campos vejez
		$("#div_ve_1").hide();
		$("#div_ve_2").hide();
		$("#div_ve_3").hide();
				
		if(sexo == 'F'){
			$("#div_ve_1").show();
		}
		
		if(sexo == 'F' && edad <= 69){
			$("#div_ve_2").show();
		}
					
		if(sexo == 'M' && edad >= 50){
			$("#div_ve_3").show();
		}		
	}
	*/
	//IMC
	$("input[name=peso], input[name=talla]").blur(function () {
		
		if(isNaN($('input[name=peso]').val()) && isNaN($('input[name=talla]').val())){ 

		}else{ 
			var edad = $("#enc_edad").val();
			var sexo = $("#enc_sexo").val();
			var val_peso = $("input[name=peso]").val();
			var val_talla = $("input[name=talla]").val();
			var val_meses = calcularEdad($("#enc_fech_nac").val(), 'meses');
			
			if(val_peso > 0 && val_talla > 0 ){
				
				if(edad >= 6 && edad <= 11){
					if(sexo == 'M'){
						$.ajax({
							url: base_url + "gestor/imc_nino/",
							type:'POST',
							dataType: "json",
							data:{
								peso: val_peso, talla:val_talla, meses: val_meses
							},
							success:function(res){
								if (res)
								{
									$("#imc").val(res.imc);
									$("#desc_imc").val(res.diagnostico);								
								}
							}
						});
					}else if(sexo == 'F'){
						$.ajax({
							url: base_url + "gestor/imc_nina/",
							type:'POST',
							dataType: "json",
							data:{
								peso: val_peso, talla:val_talla, meses: val_meses
							},
							success:function(res){
								if (res)
								{
									$("#imc").val(res.imc);
									$("#desc_imc").val(res.diagnostico);								
								}
							}
						});
					}
				}else if(edad > 11){
					var talla_cm = val_talla / 100;
					var desc = '';
					var talla_m = (talla_cm * talla_cm);
					var imc = (val_peso / talla_m);
					//alert(imc);
					
					if(imc >= 0 && imc < 18.5){
						desc = 'Delgadez';
					}else if(imc >= 18.5 && imc < 25){
						desc = 'Normal';
					}else if(imc >= 25 && imc < 30){
						desc = 'Sobrepeso';
					}else if(imc >= 30){
						desc = 'Obesidad';
					}
					
					var imc_final = Math.round(imc,2);
					
					$("#imc").val(imc);
					$("#desc_imc").val(desc);
				}else{
					$("#imc").val('0');
					$("#desc_imc").val('N/A');
				}
				
				
			}
				
					
		};
		
	});
		
	$("input[name=enc_discapacidad]").click(function () {
		
		if($('input:radio[name=enc_discapacidad]:checked').val() == 'S'){
			$("#div_limitacion_cual").show();
		}else{
			$("#div_limitacion_cual").hide();
		}
		
	});
	
	$("#enc_responsable").change(function () {
		if($("#enc_responsable").val() == '5' || $("#enc_responsable").val() == '6'){
			$("#div_responsable_cual").show();
		}else{
			$("#div_responsable_cual").hide();
		}
	})
	  
	$("input[name=p10]").click(function () {
		
		if($('input:radio[name=p10]:checked').val() == 1){
			$("#div_deporte_cual").show();
		}else{
			$("#div_deporte_cual").hide();
		}
		
	}); 
		  
	$("#prioridad").change(function () {
		if($("#prioridad").val() == '1'){
			$("#div_traslado").show();
			$("#div_agendamiento").hide();
		}else if($("#prioridad").val() == '2'){
			$("#div_traslado").hide();
			$("#div_agendamiento").show();
		}else{
			$("#div_agendamiento").hide();
			$("#div_traslado").hide();
		}
	})
	var edad = $("#enc_edad").val();
	$( "#enc_fech_nac" ).datepicker({
		changeMonth: true,
		changeYear: true,
		defaultDate: "-" +edad+ "y",
		dateFormat: "yy-mm-dd"
    });
	  
	$( "#fecha_cita_a" ).datetimepicker({      
		dateFormat: "yy-mm-dd"
    });
	
	$( "#fecha_cita_r" ).datetimepicker({      
		dateFormat: "yy-mm-dd"
    });
	
	$("#alf3").change(function () {
		if($("#alf3").val() == 'A'){
			$("#div_alf3").show();
		}else{
			$("#div_alf3").hide();
		}
	})
	
	$("#alf4").change(function () {
		if($("#alf4").val() == 'A'){
			$("#div_alf4").show();
		}else{
			$("#div_alf4").hide();
		}
	})
	
	$("#pre_cronicos").change(function () {
		if($("#pre_cronicos").val() == 'SI'){
			$("#preguntas_cronicos").show();
			$("#preguntas_cronicos_si_1").show();
			$("#preguntas_cronicos_si_2").show();
			$("#preguntas_cronicos_si_3").show();
			$("#preguntas_cronicos_si_4").show();
			$("#preguntas_cronicos_si_5").show();
			$("#preguntas_cronicos_si_6").show();
			$("#preguntas_cronicos_si_7").show();
			$("#preguntas_cronicos_si_8").show();
			$("#preguntas_cronicos_si_9").show();
		}else{
			$("#preguntas_cronicos").show();
			$("#preguntas_cronicos_si_1").hide();
			$("#preguntas_cronicos_si_2").hide();
			$("#preguntas_cronicos_si_3").hide();
			$("#preguntas_cronicos_si_4").hide();
			$("#preguntas_cronicos_si_5").hide();
			$("#preguntas_cronicos_si_6").hide();
			$("#preguntas_cronicos_si_7").hide();
			$("#preguntas_cronicos_si_8").hide();
			$("#preguntas_cronicos_si_9").hide();
		}
	})
	
	$("input[name=tas]").keyup(function () {
		
		if(isNaN($('input[name=tas]').val())){ 
			$("input:radio[name=p3]").prop("checked",false);
		}else{ 
			if($("#pre_cronicos").val() == 'NO'){
				var val_tas = $("input[name=tas]").val();
				if(val_tas < 140){
					$("input:radio[name=p3][value='1']").prop("checked",true);
					$("#rojo_cro").css("background","#ccc");
					$("#amarillo_cro").css("background","#ccc");
					$("#verde_cro").css("background","#8fc800");
					$("#recomendaciones_verde_cro").show();
					$("#recomendaciones_amarillo_cro").hide();
					$("#recomendaciones_rojo_cro").hide();
					
				}else if(val_tas >= 140 && val_tas <= 160){
					$("input:radio[name=p3][value='2']").prop("checked",true);
					$("#riesgo").val('R');
					
					$("#rojo_cro").css("background","#cc0000");
					$("#amarillo_cro").css("background","#ccc");
					$("#verde_cro").css("background","#ccc");
					$("#recomendaciones_verde_cro").hide();
					$("#recomendaciones_amarillo_cro").hide();
					$("#recomendaciones_rojo_cro").show();
				}else{
					$("input:radio[name=p3][value='12']").prop("checked",true);
					$("#riesgo").val('R');
					
					$("#rojo_cro").css("background","#cc0000");
					$("#amarillo_cro").css("background","#ccc");
					$("#verde_cro").css("background","#ccc");
					$("#recomendaciones_verde_cro").hide();
					$("#recomendaciones_amarillo_cro").hide();
					$("#recomendaciones_rojo_cro").show();
				}	
			}else{
				var val_tas = $("input[name=tas]").val();
				if(val_tas < 140){
					$("input:radio[name=p3][value='1']").prop("checked",true);
				}else if(val_tas >= 140 && val_tas <= 160){
					$("input:radio[name=p3][value='2']").prop("checked",true);
				}else{
					$("input:radio[name=p3][value='12']").prop("checked",true);
				}	
			}
			
		};
		
	});
	
	$("input[name=glucometria]").keyup(function () {
		
		if(isNaN($('input[name=glucometria]').val())){ 
			$("input:radio[name=p4]").prop("checked",false);
		}else{ 
			var val_glu = $("input[name=glucometria]").val();
			if(val_glu >= 65 && val_glu <= 140){
				$("input:radio[name=p4][value='1']").prop("checked",true);
			}else if(val_glu >= 141 && val_glu <= 200){
				$("input:radio[name=p4][value='2']").prop("checked",true);
			}else if(val_glu > 200){
				$("input:radio[name=p4][value='12']").prop("checked",true);
			}else{
				$("input:radio[name=p4]").prop("checked",false);
			}
		};
		
	});
	
	$("input[name=vp_5]").keyup(function () {
		
		if(isNaN($('input[name=vp_5]').val())){ 
			if($("#enc_sexo").val() == 'F'){
				$("input:radio[id=p5_m]").prop("checked",false);
			}else{
				$("input:radio[id=p5_h]").prop("checked",false);
			}
			
		}else{ 
			var val_vp5 = $("input[name=vp_5]").val();
			
			if($("#enc_sexo").val() == 'F'){
				if(val_vp5 < 80){
					$("input:radio[id=p5_m][value='1']").prop("checked",true);
				}else if(val_vp5 >= 80 && val_vp5 <= 88){
					$("input:radio[id=p5_m][value='2']").prop("checked",true);
				}else if(val_vp5 > 88){
					$("input:radio[id=p5_m][value='6']").prop("checked",true);
				}else{
					$("input:radio[id=p5_m]").prop("checked",false);
				}
			}else{
				if(val_vp5 < 94){
					$("input:radio[id=p5_h][value='1']").prop("checked",true);
				}else if(val_vp5 >= 94 && val_vp5 <= 102){
					$("input:radio[id=p5_h][value='2']").prop("checked",true);
				}else if(val_vp5 > 102){
					$("input:radio[id=p5_h][value='6']").prop("checked",true);
				}else{
					$("input:radio[id=p5_h]").prop("checked",false);
				}
			}
			
			
		};
		
	});
	
	$("input[name=p1],input[name=p2],input[name=p3],input[name=p4],input[name=p5],input[name=p6],input[name=p7],input[name=p8],input[name=p9],input[name=p10]").on('click change',function () {    
	
		
		if(isNaN($('input:radio[name=p1]:checked').val())){ var p1 = 0;}else{ var p1 = $('input:radio[name=p1]:checked').val();};
		if(isNaN($('input:radio[name=p2]:checked').val())){ var p2 = 0;}else{ var p2 = $('input:radio[name=p2]:checked').val();};
		if(isNaN($('input:radio[name=p3]:checked').val())){ var p3 = 0;}else{ var p3 = $('input:radio[name=p3]:checked').val();};
		if(isNaN($('input:radio[name=p4]:checked').val())){ var p4 = 0;}else{ var p4 = $('input:radio[name=p4]:checked').val();};
		if(isNaN($('input:radio[name=p5]:checked').val())){ var p5 = 0;}else{ var p5 = $('input:radio[name=p5]:checked').val();};
		if(isNaN($('input:radio[name=p6]:checked').val())){ var p6 = 0;}else{ var p6 = $('input:radio[name=p6]:checked').val();};
		if(isNaN($('input:radio[name=p7]:checked').val())){ var p7 = 0;}else{ var p7 = $('input:radio[name=p7]:checked').val();};
		if(isNaN($('input:radio[name=p8]:checked').val())){ var p8 = 0;}else{ var p8 = $('input:radio[name=p8]:checked').val();};
		if(isNaN($('input:radio[name=p9]:checked').val())){ var p9 = 0;}else{ var p9 = $('input:radio[name=p9]:checked').val();};
		if(isNaN($('input:radio[name=p10]:checked').val())){ var p10 = 0;}else{ var p10 = $('input:radio[name=p10]:checked').val();};
		
		
		var total = parseInt(p1) + parseInt(p2) + parseInt(p3) + parseInt(p4) + parseInt(p5) + parseInt(p6) + parseInt(p7) + parseInt(p8) + parseInt(p9) + parseInt(p10);
		 
		if($("#pre_cronicos").val() == 'NO'){
			var val_tas = $("input[name=tas]").val();
			if(val_tas < 140){
				$("input:radio[name=p3][value='1']").prop("checked",true);
				$("#rojo_cro").css("background","#ccc");
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#8fc800");
				$("#recomendaciones_verde_cro").show();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").hide();
				
			}else if(val_tas >= 140 && val_tas <= 160){
				$("input:radio[name=p3][value='2']").prop("checked",true);
				$("#riesgo").val('R');
				
				$("#rojo_cro").css("background","#cc0000");
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#ccc");
				$("#recomendaciones_verde_cro").hide();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").show();
			}else{
				$("input:radio[name=p3][value='12']").prop("checked",true);
				$("#riesgo").val('R');
				
				$("#rojo_cro").css("background","#cc0000");
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#ccc");
				$("#recomendaciones_verde_cro").hide();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").show();
			}	
		}else{
			if(total == 10){
				$("#rojo_cro").css("background","#ccc");
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#8fc800");
				$("#recomendaciones_verde_cro").show();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").hide();			
				
			}else if(total > 10 && total <= 20){
				$("#riesgo").val('A');
					
				$("#rojo_cro").css("background","#ccc");
				$("#amarillo_cro").css("background","#f1da36");
				$("#verde_cro").css("background","#ccc");
				$("#recomendaciones_verde_cro").hide();
				$("#recomendaciones_amarillo_cro").show();
				$("#recomendaciones_rojo_cro").hide();
			}else if(total > 20){
				$("#riesgo").val('R');
				
				$("#rojo_cro").css("background","#cc0000");
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#ccc");
				$("#recomendaciones_verde_cro").hide();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").show();
			}else{
				$("#amarillo_cro").css("background","#ccc");
				$("#verde_cro").css("background","#ccc");
				$("#rojo_cro").css("background","#ccc");
				$("#recomendaciones_verde_cro").hide();
				$("#recomendaciones_amarillo_cro").hide();
				$("#recomendaciones_rojo_cro").hide();
			}	
		} 
		 
		
    });
	
	//VEJEZ 
	$("#ve1,#ve2,#ve3,#ve4,#ve5,#ve6,#ve7,#ve8,#ve9,#ve10,#ve11,#ve12,#ve13,#ve14,#ve15,#ve16,#ve17").change(function () {    
	
		$("#div_recome_veje").show();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}else if(valor == 'CC'){
			$("input:checkbox[name=canal_public]").prop("checked",true);
		}			
				
    });
	
	
	//ADULTEZ
	$("#adu1,#adu2,#adu3,#adu4,#adu5,#adu6,#adu7,#adu8,#adu9,#adu10,#adu11,#adu12,#adu13").change(function () {    
	
		$("#div_recome_veje").hide();
		$("#div_recome_adul").show();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}else if(valor == 'CC'){
			$("input:checkbox[name=canal_public]").prop("checked",true);
		}		
				
    });
	
	//JUVENTUD
	$("#ju1,#ju2,#ju3,#ju4,#ju5,#ju6,#ju7,#ju8,#ju9").change(function () {    
	
		$("#div_recome_veje").hide();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").show();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}else if(valor == 'CC'){
			$("input:checkbox[name=canal_public]").prop("checked",true);
		}
		
    });
	
	//ADOLECENCIA
	$("#ad1,#ad2,#ad3,#ad4,#ad5,#ad6,#ad7,#ad8,#ad9,#ad10,#ad11,#ad12,#ad13,#ad14,#ad15,#ad16,#ad17").change(function () {    
	
		$("#div_recome_veje").hide();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").show();
		$("#div_recome_inf").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}else if(valor == 'CC'){
			$("input:checkbox[name=canal_public]").prop("checked",true);
		}
		
    });
	
	//INFANCIA	
	$("#in1,#in2,#in3,#in4,#in5,#in6,#in7,#in8,#in9,#in10,#in11").change(function () {    
	
		
		$("#div_recome_veje").hide();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").show();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}
		
    });
	
	//PRIMERA INFANCIA	
	$("#pi1,#pi2,#pi3,#pi4,#pi5,#pi6,#pi7,#pi8,#pi9,#pi10").change(function () {    
	
		$("#div_recome_veje").hide();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").show();
		$("#div_recome_materno").hide();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				if($("#pi1").val() == '0' && $("#pi11").val() == '0' && $("#pi12").val() == '0' && $("#pi13").val() == '0'){
					$("#riesgo").val(valor);
				
					$("#rojo").css("background","#ccc");
					$("#amarillo").css("background","#f1da36");
					$("#verde").css("background","#ccc");
					$("#recomendaciones_verde").hide();
					$("#recomendaciones_amarillo").show();
					$("#recomendaciones_rojo").hide();
				}
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}
		
    });
	
	//MATERNO PERINATAL
	$("#m1,#m2,#m3,#m4,#m5,#m6,#m7,#m8,#m9,#m10,#m11").change(function () {    
	
		$("#div_recome_veje").hide();
		$("#div_recome_adul").hide();
		$("#div_recome_juve").hide();
		$("#div_recome_adol").hide();
		$("#div_recome_inf").hide();
		$("#div_recome_pinf").hide();
		$("#div_recome_materno").show();

		var valor = $(this).val();
		var riesgo = $("#riesgo").val();
		
		if(valor == 'R'){
			
			$("#riesgo").val(valor);
			
			$("#rojo").css("background","#cc0000");
			$("#amarillo").css("background","#ccc");
			$("#verde").css("background","#ccc");
			$("#recomendaciones_verde").hide();
			$("#recomendaciones_amarillo").hide();
			$("#recomendaciones_rojo").show();	
			
		}else if(valor == 'A'){
			
			if(riesgo == 'R'){
				if($("#m1").val() == '0' && $("#m5").val() == '0'){
					$("#riesgo").val(valor);
				
					$("#rojo").css("background","#ccc");
					$("#amarillo").css("background","#f1da36");
					$("#verde").css("background","#ccc");
					$("#recomendaciones_verde").hide();
					$("#recomendaciones_amarillo").show();
					$("#recomendaciones_rojo").hide();
				}
			}else{
				$("#riesgo").val(valor);
				
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#f1da36");
				$("#verde").css("background","#ccc");
				$("#recomendaciones_verde").hide();
				$("#recomendaciones_amarillo").show();
				$("#recomendaciones_rojo").hide();
			}
			
		}else if(valor == '0'){
			
			if(riesgo == 'R' || riesgo == 'A'){
				
			}else{
				$("#rojo").css("background","#ccc");
				$("#amarillo").css("background","#ccc");
				$("#verde").css("background","#8fc800");
				$("#recomendaciones_verde").show();
				$("#recomendaciones_amarillo").hide();
				$("#recomendaciones_rojo").hide();
			}			
		}else if(valor == 'CA'){
			$("input:checkbox[name=canal_vivi]").prop("checked",true);
		}
		
    });
	
});

function isValidDate(day,month,year)
{
    var dteDate;

    // En javascript, el mes empieza en la posicion 0 y termina en la 11 

    //   siendo 0 el mes de enero

    // Por esta razon, tenemos que restar 1 al mes

    month=month-1;

    // Establecemos un objeto Data con los valore recibidos

    // Los parametros son: año, mes, dia, hora, minuto y segundos

    // getDate(); devuelve el dia como un entero entre 1 y 31

    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,

    //   martes, miercoles ...

    // getHours(); Devuelve la hora

    // getMinutes(); Devuelve los minutos

    // getMonth(); devuelve el mes como un numero de 0 a 11

    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1

    //   de enero de 1970 hasta el momento definido en el objeto date

    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.

    // getYear(); devuelve el año

    // getFullYear(); devuelve el año

    dteDate=new Date(year,month,day);

    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));

}

 

/**

 * Funcion para validar una fecha

 * Tiene que recibir:

 *  La fecha en formato ingles yyyy-mm-dd

 * Devuelve:

 *  true-Fecha correcta

 *  false-Fecha Incorrecta

 */

function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");

    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");

        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }

    return false;

}

 

/**

 * Esta función calcula la edad de una persona y los meses

 * La fecha la tiene que tener el formato yyyy-mm-dd que es

 * metodo que por defecto lo devuelve el <input type="date">

 */

function calcularEdad(edadUsuario, parametro = '', mensaje = '')
{
    var fecha = edadUsuario;

    if(validate_fecha(fecha)==true)
    {

        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;

        if ( ahora_mes < mes )
		{
            edad--;
        }

        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }

        if (edad > 1900)
        {
            edad -= 1900;
        }
        
		// calculamos los meses
		var meses=0;

        if(ahora_mes>mes)
            meses=ahora_mes-mes;

        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);

        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;

        // calculamos los dias
        var dias=0;

        if(ahora_dia>dia)
            dias=ahora_dia-dia;

        if(ahora_dia<dia)
        {
			ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
			dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }

		if(mensaje == 'SI'){
			alertify.success("Edad: "+edad+" años, "+meses+" meses y "+dias+" días");
		}

		if(parametro == 'meses'){
			totalEdad = edad * 12;
			totalMeses = totalEdad + meses;
			
			return totalMeses;
		}else if(parametro == 'anios'){
			return edad;
		}
				
    }else{
		alertify.error("La fecha "+fecha+" es incorrecta");
    }

}
