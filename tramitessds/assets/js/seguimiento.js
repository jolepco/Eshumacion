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

    var $form_cita = $( '#form_cita' );

    $form_cita.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    $form_cita.submit(function() {
        var $resultado=$form_cita.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });

    var $form_nueva_cita = $( '#form_nueva_cita' );

    $form_nueva_cita.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    $form_nueva_cita.submit(function() {
        var $resultado=$form_nueva_cita.validationEngine("validate");

        if ($form_nueva_cita) {

            return true;
        }
        return false;
    });

    var $form_seguimiento_nuevacita = $( '#form_seguimiento_nuevacita' );

    $form_seguimiento_nuevacita.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    $form_seguimiento_nuevacita.submit(function() {
        var $resultado=$form_seguimiento_nuevacita.validationEngine("validate");

        if ($form_seguimiento_nuevacita) {

            return true;
        }
        return false;
    });


    $("#fecha_cita").datetimepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true

    });


    $(".fecha_cita").datetimepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true

    });

    $("#asistencia").change(function(){

        if($("#asistencia").val() == 'NO'){
            $("#div_noasiste").show();
        }else{
            $("#div_noasiste").hide();
        }

    });

    $(".asistencianueva").change(function(){

        if($(".asistencianueva").val() == 'NO'){
            $(".div_noasistenueva").show();
        }else{
            $(".div_noasistenueva").hide();
        }

    });

});

function ocultarNoAsistencia($modal){
    if($("#asistencianueva" + $modal).val() == 'NO'){
        $("#div_noasistenueva" + $modal).show();
    }else{
        $("#div_noasistenueva" + $modal).hide();
    }
}
