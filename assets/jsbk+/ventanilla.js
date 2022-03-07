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

    var $formCrearUsuario = $( '#formCrearUsuario' );

    $formCrearUsuario.validationEngine({
        promptPosition : "bottomRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 3000
    });

    $formCrearUsuario.submit(function() {
        var $resultado=$formCrearUsuario.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });

    $("#tramites").select2({ width: '100%' });

    $("#btn-buscar").click(function() {
          usuario_consulta = $('#usuario_consulta').val();
          tramite = $('#tramite').val();

        if(usuario_consulta != '' && tramite != ''){

            $.post(base_url + "ventanilla/cargaTramite", {
                usuario_consulta: usuario_consulta,
                tramite: tramite,
            }, function (data) {
                $("#informacion").html(data);
            });

        }else{
            alertify.error('Todos los campos son obligatorios');
            return false;
        }

    });

});
