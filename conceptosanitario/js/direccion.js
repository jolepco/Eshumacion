/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * funcion para generar deireccion estandar segun seleccion de usuario
 * @type type
 */
$(document).ready(function () {
    $("#generar").click(function () {
        var c1 = $('#c1').val();
        var c2 = $('#c2').val();
        var c3 = $('#c3').val();
        var c4 = $('#c4').val();
        var c5 = $('#c5').val();
        var c6 = $('#c6').val();
        var c7 = $('#c7').val();
        var c8 = $('#c8').val();
        var c9 = $('#c9').val();
        var c10 = $('#c10').val();
        $('#direccion_notf').val(c1 + ' ' + c2 + ' ' + c3 + ' ' + c4 + ' ' + c5 + ' ' + c6 + ' ' + c7 + ' ' + c8 + ' ' + c9 + ' ' + c10);
    })

    /**
     * @ limpiar el campo direccion generada a traves del boton.
     */
    $("#limpiar").click(function () {
        $("#direccion_notf").val('');
    })
    
    /**
     * @ consumir el web service de geolocalización para obtener el codigo de la localidad,upz y el barrio
     */
    $("#webs").click(function () {
        var direccion = $("#direccion_notf").val();
        $("#webs").hide();
        $("#limpiar").hide();
        var send = $.post("../controller/Cdireccion.php", {direccion: direccion
        });

        send.done(function (data) {
            //alert(data); 
            var array = data.split('|');
            $("#localidad").val(array[0]);
            $("#upz").val(array[1]);
            $("#barrio").val(array[2]);
            if ($("#upz").val() == '') {
                // alert('ERROR!!!!No se ha guardado la dirección correctamente. Guárdela nuevamente');
                $('#respuestaMensaje').html("ERROR!!!!No se ha guardado la dirección correctamente. Guárdela nuevamente");
                $('#myModal').modal('show');
                $("#webs").show();
                $("#limpiar").show();
            } else {
                $("#continuar").show();
            }
            //console.log(data);
        });
        send.error(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error");
            console.log(XMLHttpRequest);

        });

    })
    /**
     * Si el ciudadano esta inscrito o no 
     */
    $("#inscrito").click(function () {
        if ($(this).is(':checked')) {
            $("#inscripcion").show();
        } else {
            $("#inscripcion").hide();
        }
    })
    
    /**
     * Si el ciudadano se encuentra inscrito o no, segun la opcion seleccionada hace 
     */
    $('input[name="inscrito"]').click(function () {
        var mtr = $('input[name="inscrito"]:checked').val();
        if (mtr == 1) {
            $("#inscripcion").show();
            $("#url").hide();
        } else {
            $("#inscripcion").hide();
            $("#ocultar").hide();
            $("#url").show();
        }
    })
    
    /***
     * segun la seleccion del ciudadano mostrarle las opciones correspondientes
     */
    
    $('input[name="matricula"]').click(function () {
        var mtr = $('input[name="matricula"]:checked').val();
        if (mtr == 1) {
            $("#matriculam").show();
            $("#rpt").show();
            $("#ptr").hide();
        } else {
            $("#matriculam").hide();
            $("#rpt").hide();
            $("#ptr").show();
            $("#numeromatricula").val("");
            $("#razon_s").val("");
            $("#nit").val("");
        }
    })

   /***
    * Si el establecimiento ya ha tenido visita antes o no 
    */
    $('input[name="inspec_antes"]').click(function () {
        var inspec = $('input[name="inspec_antes"]:checked').val();
        if (inspec == 1) {
            $("#inspeccionado").show(); 
        } else {
            $("#inspeccionado").hide();
             $("#fecha_insp")[0].value = 0;
            $("#concepto_emitido")[0].value = 0;
            $("#numero_acta")[0].value = "";
        }
    })
    /***
     * Opción de dirección en caso que el establecimiento pertenezca a zona rural
     */
    $('input[name="rural"]').click(function () {
        var rural = $('input[name="rural"]:checked').val();
        if (rural == 1){
            $("#zrural").show();
            $("#urbano").hide();
            $("#dirgenUrbano").hide();
            $("#continuar").show();
        } else {
            $("#zrural").hide();
            $("#urbano").show();
            $("#dirgenUrbano").show();
            $("#continuar").hide();
            $("#localidadrural").val("");
            $("#upzrural").val("");
            $("#barriorural").val("");
            $("#direccionrural").val("");
        }
    })
  
})
