/*$.datepicker.regional['es'] = {
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
$.datepicker.setDefaults($.datepicker.regional['es']);*/

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
            }else if($("#resultado_validacion").val() == 4){
                $("#div_negacion").show();
                $("#div_recurso").hide();
				$("#div_masinformacion").hide();
				$("#div_aclaracion").hide();
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);
            }else if($("#resultado_validacion").val() == 5) {
                $("#div_recurso").show();
                $("#div_negacion").hide();
				$("#div_masinformacion").hide();
				$("#div_aclaracion").hide();
                $("#div_preliminar").show();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);
            }else if($("#resultado_validacion").val() == 6) {
                $("#div_masinformacion").show();
                $("#div_negacion").hide();
                $("#div_recurso").hide();
				$("#div_aclaracion").hide();
                $("#div_preliminar").hide();
				$("#observacion1aclaracion").attr('required',false);
				$("#observacion2aclaracion").attr('required',false);
            }


        }else{
            $("#div_resuelve").hide();
            $("#div_negacion").hide();
            $("#div_recurso").hide();
            $("#div_masinformacion").hide();
            $("#div_preliminar").hide();
        }
    });
	
	$('#tabla_consulta_rx').DataTable({
        language: {
            search: "Buscar:",
            lengthMenu: "Ver _MENU_ registros",
            info: "Viendo _START_ a _END_ de _TOTAL_ entradas",
            infoEmpty: "No se encontraron resultados",
            paginate: {
                first: "Primero",
                previous: "Previo",
                next: "Siguiente",
            }
        },initComplete: function () {
            this.api().columns('.busca').every( function () {
                var column = this;
                var select = $('<select><option value="">Seleccione...</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
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
                alertify.alert("Actualización de títulos","Se realizo la actualización del título");
                location.replace(base_url);
            }else if(data == 'ERROR'){
                alertify.alert("Actualización de títulos","No fue posible realizar la actualización");
            }

        });
}



}

function guardarFecha(id_tramite, id_subsanacion){

	if($("#fecha_noti" + id_tramite).val() != ''){
		alertify.confirm('Actualización de fecha de notificación', 'Esta seguro que desea actualizar la fecha de notificación de la subsanación?. Después de registrada la fecha esta no podrá ser modificada', 
		function(){ 
			var fechanoti = $("#fecha_noti" + id_tramite).val();
			location.replace(base_url + "validacion/actualizarFechaNotificacion/" + id_tramite + "/" + id_subsanacion + "/" + fechanoti);		
		 },
		 function(){ 
		}).set('labels', {ok:'Si', cancel:'Cancelar'});
	}else{
		alertify.alert("Actualización fecha notificación","No fue posible realizar la actualización");
	}
	
 }

