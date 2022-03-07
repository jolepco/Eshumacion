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
                $("#div_preliminar").show();
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
