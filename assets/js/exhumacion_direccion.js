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

    var $signupForm = $('#form_tramite');

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

	$("#BtnVerPDF").click(function () {
		$('#myModalPDF').modal('show');
	});


	$("#btn_seguimiento").click(function () {
		$('#modalseguimiento').modal('show');
	});

	$("#BtnVerPDF").click(function () {
		$('#myModalPDF').modal('show');
	});

	  $("#VPDF").click(function (){
		var idlic= $("#idlicec").val();
		var difunto=$("#nombre_difunto").val();
		var cementerio=$("#cementerio").val();
		var licenciai=$("#num_licencia_inhumacion").val();
		var observacionesp=$("#observacionesp").val();
		var fecha=$("#fecha_inh").val();
		var send = $.post("<?php echo base_url('Coordinacion/visualizarPDF')?>", {idl: idlic,difunto:difunto,cementerio:cementerio,licenciai:licenciai,observacionesp:observacionesp,fecha:fecha});
		send.done(function (data) {

			var parent = $('embed#idASG').parent();
			var newElement = "<embed src='<?php echo base_url('uploads/exhumacion/' . $nombre_archivo)?>' id='idASG' width='100%' height='600' alt='pdf' pluginspage='http://www.adobe.com/products/acrobat/readstep2.html'>";
			$('embed#idASG').remove();
			parent.append(newElement);
			$("#BtnVerPDF").show();
			console.log("OK")
		});
		send.error(function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Error "+XMLHttpRequest,textStatus, errorThrown);
			console.log(XMLHttpRequest,textStatus, errorThrown);
		});
	  });

      $("#resultado_validacion").change(function () {
        if ($("#resultado_validacion").val() != '') {
            $("#div_resuelve").show();

            if ($("#resultado_validacion").val() == 8) {
                $("#div_devolver").show();
				        $("#div_preliminar").hide();
				        $("#div_guardar").show();
                $("#aprobado").hide();
            } else if ($("#resultado_validacion").val() == 4) {
                $("#aprobado").show();
				        $("#div_preliminar").show();
                $("#div_devolver").hide();
			          $("#div_guardar").show();
            }

        }
    });


    $("#parentesco").change(function () {
        if ($("#parentesco").val() != '') {
            if ($("#parentesco").val() == 'Otro') {
                $("#divparentesco").show();
				$("#parentescoOTRO").val('');

            } else {
                $("#divparentesco").hide();
				$("#parentescoOTRO").val('');
            }
        }
    });


	$("#p_nombre, #s_nombre, #p_apellido, #s_apellido, #nombre_difunto, #cementerio, #observaciones, #parentescoOTRO").on("keypress", function () {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);

    });

    $("#fecha_inhumacion").datepicker({
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


	$( "#fecha_inhumacion" ).change(function () {

		if($( "#fecha_inhumacion" ).val() > factual){
			alertify.alert("Novedad en Fecha Inhumación","La fecha ingresada " + $( "#fecha_inhumacion" ).val() + " no puede ser mayor a la fecha actual " + factual);
			$( "#fecha_inhumacion" ).val("");
		}
    });



});

$(document).on('change','input[type="file"]',function(){
    // this.files[0].size recupera el tamaño del archivo
    // alert(this.files[0].size);

    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if(fileSize > 5000000){
       // alert('El archivo no debe superar los 5MB');
      $('#respuestaMensaje').html("El tamaño/peso del archivo que intenta adjuntar no es valido. Tenga en cuenta que el tamaño/peso del archivo a registrar no puede superar las CINCO (5) MB.");
                        $('#myModal').modal('show');

        this.value = '';
        this.files[0].name = '';
    }else{
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();

        // console.log(ext);
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf': break;
            default:
                //alert('El archivo no tiene la extensión adecuada');
                $('#respuestaMensaje').html("El formato del archivo seleccionado NO es valido. Tenga en cuenta que los únicos formatos (extensiones) de archivo permitidos por el sistema son:  [.pdf].");
                        $('#myModal').modal('show');
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }

$('input[name="pdf_certificado_per3"]').change(function(){
   var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
   var doc3 = $('input[name="pdf_certificado_per3"]')[0].files[0]['name']
   if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                        this.files[0].name = '';

       }
})

$('input[name="pdf_certificado_per4"]').change(function(){
   var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
   var doc3 = $('input[name="pdf_certificado_per3"]')[0].files[0]['name']
   if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                        this.files[0].name = '';

       }
})




/*$('input[name="pdf_certificado_per3"]').change(function(e){
            var doc3 = e.target.files[0].name;
       var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
       //alert(doc4);console.log(doc4)
       if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                this.files[0].name = '';

       }
    });*/


});
