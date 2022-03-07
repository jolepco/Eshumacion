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
    
    $("select").select2({ width: '100%' });

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

    $("#resultado_validacion").change(function(){
        if($("#resultado_validacion").val() != ''){
            $("#div_resuelve").show();

        }else{
            $("#div_resuelve").hide();
        }
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
