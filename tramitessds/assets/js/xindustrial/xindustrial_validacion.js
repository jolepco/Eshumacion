$(document).ready(function(){

    $(".actualizarVisorAction").click(function() {
        $("#visorPdf").attr('src', $(this).attr('title'));
    });

	$('#observaciones_item1').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_item2').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_item3').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_item4').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_item5').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_item6').trumbowyg({
		lang: 'es'
	});

	$('#observaciones').trumbowyg({
		lang: 'es'
	});

	$('#observaciones_visita').trumbowyg({
		lang: 'es'
	});

  $('#observaciones_visita2').trumbowyg({
		lang: 'es'
	});


  $('#observaciones_visitainput').trumbowyg({
		lang: 'es'
	});


    $("#btn_seguimiento").click(function () {
		$('#modalseguimiento').modal('show');
	});

    $("#resultado_validacion").change(function(){
		
		if($("#resultado_validacion").val() != ''){

			$("#div_obs_resultado").show();
			$("#div_preliminar").show();
			$("#preliminar").show();

		if($("#resultado_validacion").val() == 8){
				// Estado = 8 - Anular Trámite
			$("#preliminar").hide();
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 17){
			$("#preliminar").hide();
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 9){
			$("#preliminar").show();
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 11){
			$("#preliminar").show();
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 15){
			$("#preliminar").show();
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 16){
			$("#preliminar").show();
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 18){
			$("#preliminar").hide();
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 21){
			$("#preliminar").hide();
			$("#div_visita").hide();
		}else if($("#resultado_validacion").val() == 22){
			$("#div_visita").show();
			$("#resultado_visita").prop('required',true);
			$("#fecha_visita").prop('required',true);
			$("#preliminar").hide();
		}else if($("#resultado_validacion").val() == 23){
			$("#div_visita").show();
			$("#resultado_visita").prop('required',true);
			$("#fecha_visita").prop('required',true);
			$("#preliminar").hide();
		}
        }else{
			$("#resultado_visita").prop('required',false);
			$("#fecha_visita").prop('required',false);
			$("#div_visita").hide();
            $("#div_obs_resultado").hide();
			$("#div_preliminar").hide();

        }

    });
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


   $(".archivopdf").change(function (){
       var archivo = $(this).val();
       var extensiones = archivo.substring(archivo.lastIndexOf("."));

       if(extensiones != ".pdf")
       {
           alertify.error("El archivo de tipo " + extensiones + " no es válido");
           $(this).val('');
       }else{
           alertify.success("El archivo de tipo " + extensiones + " es válido");
       }
   });

});
