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

    /*$signupForm.formToWizard({
        submitButton: 'Guardar',
        nextBtnClass: 'btn next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag:    'button',
        nextBtnName: 'Siguiente >>',
        prevBtnName: '<< Regresar',
        showProgress: false, //default value for showProgress is also true
        showStepNo: true,
        validateBeforeNext: function() {
            return $signupForm.validationEngine( 'validate' );
        }
    });*/

    $signupForm.submit(function() {
        var $resultado=$signupForm.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });



    $("#tipo_tramite").change(function(){
        if($("#tipo_tramite").val() == '1'){
            $("#div_nuevo").show();
            $("#div_renovacion").hide();
        }else{
            $("#div_nuevo").hide();
            $("#div_renovacion").show();
        }
    });

    $("#depto_entidad").change(function () {
        $("#depto_entidad option:selected").each(function () {
            depto_entidad = $('#depto_entidad').val();
            $.post(base_url + "usuario/cargaMunicipio", {
                departamento: depto_entidad
            }, function (data) {
                $("#mpio_entidad").html(data);
            });
        });
    });

    $("#categoria").change(function(){
        if($("#categoria").val() == '1'){
            $("#div_categoria1").show();
            $("#div_doc_cat1").show();
            $("#div_categoria2").hide();
            $("#div_doc_cat2").hide();
        }else{
            $("#div_categoria1").hide();
            $("#div_doc_cat1").hide();
            $("#div_categoria2").show();
            $("#div_doc_cat2").show();
            $("#div_categoria1-1").hide();
            $("#div_categoria1-2").hide();
        }
    });

    $("#categoria1").change(function(){
        if($("#categoria1").val() == '1'){
            $("#div_categoria1-1").show();
            $("#div_categoria1-2").hide();
        }else{
            $("#div_categoria1-1").hide();
            $("#div_categoria1-2").show();
        }
    });

    $("#visita_previa").change(function(){
        if($("#visita_previa").val() == '1'){
            $("#div_talento").show();
        }else{
            $("#div_talento").hide();
            alertify.error('Valide sus datos en la oficina de registros del ente territorial. Carrera 32 # 12-81 Oficina de atenci&oacute;n al ciudadano');
            return false;
        }
    });

    $("#agregar_equipo").click(function(){
        var $formulario = $( "#form-equipos" ).clone();
        $('#datos_equipos').html($formulario);
    });


    var tabla_equipos = $('#tabla_equipos').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching":   false,
        "scrollX": true
    });

    $('#clonar_form_equipos').on( 'click', function () {

        var rowCount = $('#tabla_equipos tr').length;

        if(rowCount <= 20){
            var row = $('#tabla_equipos tbody>tr:last').clone(true);

            //clear text boxes
            $("td input:text", row).val("");
            //clear selection boxes
            $("select option:selected", row).attr("selected", false);
            //clear empty cells

            //add row
            row.insertAfter('#tabla_equipos tbody>tr:last');
            return false;
        }else{
            alertify.error('Solo es posible agregar hasta 20 equipos');
            return false;
        }


    } );

    var tabla_tue = $('#tabla_toe').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching":   false,
        "scrollX": true
    });

    $('#clonar_form_toe').on( 'click', function () {

        var rowCount = $('#tabla_toe tr').length;

        if(rowCount <= 60){
            var row = $('#tabla_toe tbody>tr:last').clone(true);

            //clear text boxes
            $("td input:text", row).val("");
            //clear selection boxes
            $("select option:selected", row).attr("selected", false);
            //clear empty cells

            //add row
            row.insertAfter('#tabla_toe tbody>tr:last');
            return false;
        }else{
            alertify.error('Solo es posible agregar hasta 60 equipos');
            return false;
        }


    } );

    var tabla_equiprueba = $('#tabla_equiprueba').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching":   false,
        "scrollX": true
    });

    $('#clonar_form_equiprueba').on( 'click', function () {

        var rowCount = $('#tabla_equiprueba tr').length;

        if(rowCount <= 10){
            var row = $('#tabla_equiprueba tbody>tr:last').clone(true);

            //clear text boxes
            $("td input:text", row).val("");
            //clear selection boxes
            $("select option:selected", row).attr("selected", false);
            //clear empty cells

            //add row
            row.insertAfter('#tabla_equiprueba tbody>tr:last');
            return false;
        }else{
            alertify.error('Solo es posible agregar hasta 10 equipos');
            return false;
        }


    } );


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
