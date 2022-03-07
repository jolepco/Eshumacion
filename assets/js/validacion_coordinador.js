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

    var $signupForm = $( '#form_tramite' );

    $signupForm.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    $signupForm.submit(function() {
        var $resultado=$signupForm.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });
    
    $("#p_nombre, #s_nombre, #p_apellido, #s_apellido").on("keypress", function () {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);
            
    });
    
    $("select").select2({ width: '100%' });
    
		$("#cboxmotivo1").click(function() {  
			if($("#cboxmotivo1").is(':checked')) {  
				$('#divmotivo1').show();
				$("#nombresapellidos_errados").attr('required',true);
			} else {  
				$('#divmotivo1').hide();
				$("#nombresapellidos_errados").attr('required',false);
			}  
		});  
	  
		$("#cboxmotivo2").click(function() {  
			if($("#cboxmotivo2").is(':checked')) {  
				$('#divmotivo2').show();
				$("#nombre_profesionnerrado").attr('required',true);
			} else {  
				$('#divmotivo2').hide();
				$("#nombre_profesionnerrado").attr('required',false);
			}  
		});  

		$("#cboxmotivo3").click(function() {  
			if($("#cboxmotivo3").is(':checked')) {  
				$('#divmotivo3').show();
				$("#nombre_institucionerrado").attr('required',true);
			} else {  
				$('#divmotivo3').hide();
				$("#nombre_institucionerrado").attr('required',false);
			}  
		});  

		$("#cboxmotivo4").click(function() {  
			if($("#cboxmotivo4").is(':checked')) {  
				$('#divmotivo4').show();
				$("#tipo_identificacionerrada").attr('required',true);
			} else {  
				$('#divmotivo4').hide();
				$("#tipo_identificacionerrada").attr('required',false);
			}  
		});  

		$("#cboxmotivo5").click(function() {  
			if($("#cboxmotivo5").is(':checked')) {  
				$('#divmotivo5').show();
				$("#fecha_termerrada").attr('required',true);
			} else {  
				$('#divmotivo5').hide();
				$("#fecha_termerrada").attr('required',false);
			}  
		});  

		$("#guardar").on("click", function() {
			
			if($("#resultado_validacion").val() == '17'){
				var checkboxmotivo1 = $("#cboxmotivo1").is(":checked");
				var checkboxmotivo2 = $("#cboxmotivo2").is(":checked");
				var checkboxmotivo3 = $("#cboxmotivo3").is(":checked");
				var checkboxmotivo4 = $("#cboxmotivo4").is(":checked");
				var checkboxmotivo5 = $("#cboxmotivo5").is(":checked");

				if (!checkboxmotivo1 && !checkboxmotivo2 && !checkboxmotivo3 && !checkboxmotivo4 && !checkboxmotivo5) {
					alertify.alert("Novedad en Tipo Motivos Aclaración:","Debe seleccionar al menos un Tipo de Motivo de Aclaración para continuar.");
					event.preventDefault();
				}
			}
		});
		
		$("#preliminar").on("click", function() {
			
			if($("#resultado_validacion").val() == '17'){			
				var checkboxmotivo1 = $("#cboxmotivo1").is(":checked");
				var checkboxmotivo2 = $("#cboxmotivo2").is(":checked");
				var checkboxmotivo3 = $("#cboxmotivo3").is(":checked");
				var checkboxmotivo4 = $("#cboxmotivo4").is(":checked");
				var checkboxmotivo5 = $("#cboxmotivo5").is(":checked");

				if (!checkboxmotivo1 && !checkboxmotivo2 && !checkboxmotivo3 && !checkboxmotivo4 && !checkboxmotivo5) {
					alertify.alert("Novedad en Tipo Motivos Aclaración:","Debe seleccionar al menos un Tipo de Motivo de Aclaración para continuar.");
					event.preventDefault();
				}
			}
		});		

	
	$('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:'My Title',
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;        
    });
	
	$( "#fecha_i" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

    $( "#fecha_f" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });


    $( "#fecha_term" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

    $( "#fecha_nacimiento" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

    $( "#fecha_term_ext" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });


    $( "#fecha_resolucion" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });


// Author Mario Beltran mebeltran@saludcapital.gov.co since 11062019
	// Ajuste validacion campo Fecha no mayor a la actual en fecha resolucion fecha terminacion y fecha terminacion exterior.
	var f = new Date();
	var mes =  f.getMonth() + 1
	var diaFT=0;

	if (f.getDate() > 0) {
		if (f.getDate() <10) {
			diaFT = "0" + f.getDate();
		}else {
			diaFT = f.getDate();
		}
	}

	if (mes > 0) {
		if (mes <10) {
			mes = "0" + mes;
		}else {
			mes = mes;
		}
	}


	var factual = f.getFullYear() + "-" + mes + "-" + diaFT;


	$( "#fecha_term" ).change(function () {

		if($( "#fecha_term" ).val() > factual){
			alertify.alert("Novedad en Fecha Terminación de Estudios","La fecha ingresada " + $( "#fecha_term" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_term" ).val("");
		}
    });

	$( "#fecha_resolucion" ).change(function () {

		if($( "#fecha_resolucion" ).val() > factual){
			alertify.alert("Novedad en Fecha Resolución Extranjeros","La fecha ingresada " + $( "#fecha_resolucion" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_resolucion" ).val("");
		}
    });

	$( "#fecha_term_ext" ).change(function () {

		if($( "#fecha_term_ext" ).val() > factual){
			alertify.alert("Novedad en Fecha Terminación de Estudios Extranjeros","La fecha ingresada " + $( "#fecha_term_ext" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_term_ext" ).val("");
		}
    });
	


    $("#causales_negacion").select2({ width: '100%' });

     $('#tabla_tramites').DataTable({
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
    
    $("#institucion_educativa").change(function () {
           $("#institucion_educativa option:selected").each(function () {
            id_institucion = $(this).val();
            $.post( base_url + "login/datosProgramasUniversidad", {
                id_institucion: id_institucion },
            function(data){
                $("#profesion").html(data);
            });
        });
    });
	

   $("#nacionalidad").change(function(){
        if($("#nacionalidad").val() == '170'){
            $("#div_ciudad_col").show();
        }else{
            $("#div_ciudad_col").hide();
        }
    });

    $("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "login/datosMunicipios", {
                departamento: departamento },
            function(data){
                $("#ciudad_nacimiento").html(data);
            });
        });
    });


    $("#depa_resi").change(function () {

           $("#depa_resi option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "login/datosMunicipios", {
                departamento: departamento },
            function(data){
                $("#ciudad_resi").html(data);
            });
        });
    });	

    $("#resultado_validacion").change(function(){
        if($("#resultado_validacion").val() != ''){
            $("#div_resuelve").show();

            if($("#resultado_validacion").val() == 3){
                $("#div_negacion").hide();
                $("#div_recurso").hide();
                $("#div_masinformacion").hide();
				$("#div_aclaracion").hide();
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);
            }else if($("#resultado_validacion").val() == 6){
                $("#div_negacion").show();
				$("#div_masinformacion").hide();
                $("#div_recurso").hide();
				$("#div_aclaracion").hide();
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);				
            }else if($("#resultado_validacion").val() == 10) {
                $("#div_recurso").show();
                $("#div_negacion").hide();
				$("#div_masinformacion").hide();
				$("#div_aclaracion").hide()
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);				
            }else if($("#resultado_validacion").val() == 13) {
                $("#div_masinformacion").show();
				$("#div_aclaracion").hide()
				$("#div_negacion").hide()
                $("#div_recurso").hide();
                $("#div_preliminar").hide();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);				
            }else if($("#resultado_validacion").val() == 16) {
                $("#div_negacion").hide();
                $("#div_recurso").hide();
                $("#div_masinformacion").hide();
                $("#div_preliminar").hide();
				$("#div_aclaracion").hide();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);				
            }else if($("#resultado_validacion").val() == 18) {
                $("#div_negacion").hide();
                $("#div_recurso").hide();
				$("#div_aclaracion").show();
                $("#div_masinformacion").hide();
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',true);
				$("#observacion2aclaracion").attr('required',true);
            }

        }else{
            $("#div_resuelve").hide();
            $("#div_negacion").hide();
            $("#div_recurso").hide();
            $("#div_masinformacion").hide();
            $("#div_preliminar").hide();
        }
    });

	$("#mindatospersonal").click(function () {
		$('#divdatopertipoiden').hide();
		$('#divdatopernumiden').hide();
		$('#divdatoperpnombre').hide();
		$('#divdatopersnombre').hide();
		$('#divdatoperpapellido').hide();
		$('#divdatopersapellido').hide();
		$('#divdatopertelcelu').hide();
		$('#divdatopertelfijo').hide();
		$('#divdatoperemail').hide();
		$('#divdatoperfecnac').hide();
		$('#divdatopersexo').hide();
		$('#divdatopergenero').hide();
		$('#divdatoperorienta').hide();
		$('#divdatoperetnia').hide();
		$('#divdatoperestciv').hide();
		$('#divdatopernivedu').hide();
	});
	
	$("#moredatospersonal").click(function () {
		$('#divdatopertipoiden').show();
		$('#divdatopernumiden').show();
		$('#divdatoperpnombre').show();
		$('#divdatopersnombre').show();
		$('#divdatoperpapellido').show();
		$('#divdatopersapellido').show();
		$('#divdatopertelcelu').show();
		$('#divdatopertelfijo').show();
		$('#divdatoperemail').show();
		$('#divdatoperfecnac').show();
		$('#divdatopersexo').show();
		$('#divdatopergenero').show();
		$('#divdatoperorienta').show();
		$('#divdatoperetnia').show();
		$('#divdatoperestciv').show();
		$('#divdatopernivedu').show();
	});
	
	$("#mindatosgeo").click(function () {
		$('#divdatogeonac').hide();
		$('#divdatogeodepanac').hide();
		$('#divdatogeociudnac').hide();
		$('#divdatogeodeparesi').hide();
		$('#divdatogeociudresi').hide();
	});	

	$("#moredatosgeo").click(function () {
		$('#divdatogeonac').show();
		$('#divdatogeodepanac').show();
		$('#divdatogeociudnac').show();
		$('#divdatogeodeparesi').show();
		$('#divdatogeociudresi').show();
	});	

	$("#mindatosaca").click(function () {
		$('#div_nacional').hide();
		$('#div_nacional2').hide();
		$('#div_extranjero').hide();
		$('#div_extranjero2').hide();
	});	

	$("#moredatosaca").click(function () {
		if($("#tipotitulovalue").val() == 1){
		$('#div_nacional').show();
		$('#div_nacional2').show();}
		else{
		$('#div_extranjero').show();
		$('#div_extranjero2').show();
		}
	});	

	$("#mindatosarch").click(function () {
		$('#divdatoarch').hide();
		$('#divdatoarchvisor').hide();
	});	

	$("#moredatosarch").click(function () {
		$('#divdatoarch').show();
		$('#divdatoarchvisor').show();
	});		

	$("#preliminar").click(function () {
		$('#divdatopertipoiden').show();
		$('#divdatopernumiden').show();
		$('#divdatoperpnombre').show();
		$('#divdatopersnombre').show();
		$('#divdatoperpapellido').show();
		$('#divdatopersapellido').show();
		$('#divdatopertelcelu').show();
		$('#divdatopertelfijo').show();
		$('#divdatoperemail').show();
		$('#divdatoperfecnac').show();
		$('#divdatopersexo').show();
		$('#divdatopergenero').show();
		$('#divdatoperorienta').show();
		$('#divdatoperetnia').show();
		$('#divdatoperestciv').show();
		$('#divdatopernivedu').show();	
		$('#divdatogeonac').show();
		$('#divdatogeodepanac').show();
		$('#divdatogeociudnac').show();
		$('#divdatogeodeparesi').show();
		$('#divdatogeociudresi').show();
		if($("#tipotitulovalue").val() == 1){
		$('#div_nacional').show();
		$('#div_nacional2').show();}
		else{
		$('#div_extranjero').show();
		$('#div_extranjero2').show();
		}
		$('#divdatoarch').show();
		$('#divdatoarchvisor').show();		
	});
	
	$("#guardar").click(function () {
		$('#divdatopertipoiden').show();
		$('#divdatopernumiden').show();
		$('#divdatoperpnombre').show();
		$('#divdatopersnombre').show();
		$('#divdatoperpapellido').show();
		$('#divdatopersapellido').show();
		$('#divdatopertelcelu').show();
		$('#divdatopertelfijo').show();
		$('#divdatoperemail').show();
		$('#divdatoperfecnac').show();
		$('#divdatopersexo').show();
		$('#divdatopergenero').show();
		$('#divdatoperorienta').show();
		$('#divdatoperetnia').show();
		$('#divdatoperestciv').show();
		$('#divdatopernivedu').show();
		$('#divdatogeonac').show();
		$('#divdatogeodepanac').show();
		$('#divdatogeociudnac').show();
		$('#divdatogeodeparesi').show();
		$('#divdatogeociudresi').show();
		if($("#tipotitulovalue").val() == 1){
		$('#div_nacional').show();
		$('#div_nacional2').show();}
		else{
		$('#div_extranjero').show();
		$('#div_extranjero2').show();
		}
		$('#divdatoarch').show();
		$('#divdatoarchvisor').show();		
	});	
	

	$("#btn_seguimiento").click(function () {
		$('#modalseguimiento').modal('show');

	});
	
	$("#btn_resolucionpreliminar").click(function () {
		$('#myModal').modal('show');

	});


			if($("#cboxmotivo1").is(':checked')) {  
				$('#divmotivo1').show();
				$("#nombresapellidos_errados").attr('required',true);
			} else {  
				$('#divmotivo1').hide();
				$("#nombresapellidos_errados").attr('required',false);
			}  
			
			if($("#cboxmotivo2").is(':checked')) {  
				$('#divmotivo2').show();
				$("#nombre_profesionnerrado").attr('required',true);
			} else {  
				$('#divmotivo2').hide();
				$("#nombre_profesionnerrado").attr('required',false);
			}  			

			if($("#cboxmotivo3").is(':checked')) {  
				$('#divmotivo3').show();
				$("#nombre_institucionerrado").attr('required',true);
			} else {  
				$('#divmotivo3').hide();
				$("#nombre_institucionerrado").attr('required',false);
			}  

			if($("#cboxmotivo4").is(':checked')) {  
				$('#divmotivo4').show();
				$("#tipo_identificacionerrada").attr('required',true);
			} else {  
				$('#divmotivo4').hide();
				$("#tipo_identificacionerrada").attr('required',false);
			}  

			if($("#cboxmotivo5").is(':checked')) {  
				$('#divmotivo5').show();
				$("#fecha_termerrada").attr('required',true);
			} else {  
				$('#divmotivo5').hide();
				$("#fecha_termerrada").attr('required',false);
			}  


		$("#cboxmotivo1").click(function() {  
			if($("#cboxmotivo1").is(':checked')) {  
				$('#divmotivo1').show();
				$("#nombresapellidos_errados").attr('required',true);
			} else {  
				$('#divmotivo1').hide();
				$("#nombresapellidos_errados").val()= '';
				$("#nombresapellidos_errados").attr('required',false);
			}  
		});  
	  
		$("#cboxmotivo2").click(function() {  
			if($("#cboxmotivo2").is(':checked')) {  
				$('#divmotivo2').show();
				$("#nombre_profesionnerrado").attr('required',true);
			} else {  
				$('#divmotivo2').hide();
				$("#nombre_profesionnerrado").val()= '';
				$("#nombre_profesionnerrado").attr('required',false);
			}  
		});  

		$("#cboxmotivo3").click(function() {  
			if($("#cboxmotivo3").is(':checked')) {  
				$('#divmotivo3').show();
				$("#nombre_institucionerrado").attr('required',true);
			} else {  
				$('#divmotivo3').hide();
				$("#nombre_institucionerrado").val()= '';
				$("#nombre_institucionerrado").attr('required',false);
			}  
		});  

		$("#cboxmotivo4").click(function() {  
			if($("#cboxmotivo4").is(':checked')) {  
				$('#divmotivo4').show();
				$("#tipo_identificacionerrada").attr('required',true);
			} else {  
				$('#divmotivo4').hide();
				$("#tipo_identificacionerrada").val()= '';
				$("#tipo_identificacionerrada").attr('required',false);
			}  
		});  

		$("#cboxmotivo5").click(function() {  
			if($("#cboxmotivo5").is(':checked')) {  
				$('#divmotivo5').show();
				$("#fecha_termerrada").attr('required',true);
			} else {  
				$('#divmotivo5').hide();
				$("#fecha_termerrada").val()= '';
				$("#fecha_termerrada").attr('required',false);
			}  
		});  

		$("#guardar").on("click", function() {
			
			if($("#resultado_validacion").val() == '18'){
				var checkboxmotivo1 = $("#cboxmotivo1").is(":checked");
				var checkboxmotivo2 = $("#cboxmotivo2").is(":checked");
				var checkboxmotivo3 = $("#cboxmotivo3").is(":checked");
				var checkboxmotivo4 = $("#cboxmotivo4").is(":checked");
				var checkboxmotivo5 = $("#cboxmotivo5").is(":checked");

				if (!checkboxmotivo1 && !checkboxmotivo2 && !checkboxmotivo3 && !checkboxmotivo4 && !checkboxmotivo5) {
					alertify.alert("Novedad en Tipo Motivos Aclaración:","Debe seleccionar al menos un Tipo de Motivo de Aclaración para continuar.");
					event.preventDefault();
				}
			}
		});
		
		$("#preliminar").on("click", function() {
			
			if($("#resultado_validacion").val() == '18'){			
				var checkboxmotivo1 = $("#cboxmotivo1").is(":checked");
				var checkboxmotivo2 = $("#cboxmotivo2").is(":checked");
				var checkboxmotivo3 = $("#cboxmotivo3").is(":checked");
				var checkboxmotivo4 = $("#cboxmotivo4").is(":checked");
				var checkboxmotivo5 = $("#cboxmotivo5").is(":checked");

				if (!checkboxmotivo1 && !checkboxmotivo2 && !checkboxmotivo3 && !checkboxmotivo4 && !checkboxmotivo5) {
					alertify.alert("Novedad en Tipo Motivos Aclaración:","Debe seleccionar al menos un Tipo de Motivo de Aclaración para continuar.");
					event.preventDefault();
				}
			}
		});		


});



/*Author: Mario Beltrán mebeltran@saludcapital.gov.co Since: 08072019
Ajuste visualizacion btn direccion geo y btn direccion*/
  $("#depa_resi").change(function () {
        //alert("Mario");
         $("#depa_resi option:selected").each(function () {

          departamento = $(this).val();
          $.post( base_url + "login/datosMunicipios", {
              departamento: departamento },
          function(data){
          $("#ciudad_resi").html(data);
          });
      });
  });

function cambiarEstado(id_titulo){
    if($("#observaciones").val() == ""){
        alertify.warning("Las observaciones deben tener minimo 20 caracteres");
    }else{
        observaciones = $("#observaciones").val();
        estado = $("#resultado_validacion").val();
        $.post( base_url + "validacion/cambiarEstado", {
            observaciones: observaciones,
            estado: estado,
            id_titulo: id_titulo
        },
        function(data){

            if(data == 'OK'){
                alertify.alert("Actualización de titulos","Se realizo la actualización del titulo");
                location.replace(base_url);
            }else if(data == 'ERROR'){
                alertify.alert("Actualización de titulos","No fue posible realizar la actualización");
            }

        });
}
}
