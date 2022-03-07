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

    var $signupForm = $( '#form_registro_natural' );

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

    var $signupForm2 = $( '#form_registro_juridica' );

    $signupForm2.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    /*$signupForm2.formToWizard({
        submitButton: 'Guardar',
        nextBtnClass: 'btn next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag:    'button',
        nextBtnName: 'Siguiente >>',
        prevBtnName: '<< Regresar',
        showProgress: false, //default value for showProgress is also true
        showStepNo: true,
        validateBeforeNext: function() {
            return $signupForm2.validationEngine( 'validate' );
        }
    });*/

    $signupForm2.submit(function() {
        var $resultado=$signupForm2.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });

    $("select").select2({ width: '100%' });
    //$("#institucion_educativa").select2();


    $("#nacionalidad").change(function(){
        if($("#nacionalidad").val() == '170'){
            $("#div_ciudad_col").show();
            $("#div_ciudad_otros").hide();

        }else{
            $("#div_ciudad_col").hide();
            $("#div_ciudad_otros").show();

        }
    });

	/*Author: Mario Beltrán mebeltran@saludcapital.gov.co Since: 27062019
	Ajuste visualizacion btn direccion geo y btn direccion*/
    $("#depa_resi").change(function () {
           $("#depa_resi option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "login/datosMunicipios", {
                departamento: departamento },
            function(data){
            $("#ciudad_resi").html(data);
            });

            if(departamento == '3'){
        				$("#div_btndirgeo").show();
        				$("#div_btndir").hide();
        				$("#d_num1").val('');
        				$("#d_num2").val('');
        				$("#d_placa").val('');
        				$("#direccion_per").val('');
            }else{
        				$("#div_btndirgeo").hide();
        				$("#div_btndir").show();
        				$("#d_num1").val('');
        				$("#d_num2").val('');
        				$("#d_placa").val('');
        				$("#direccion_per").val('');
            }
        });
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

    $("#zona").change(function () {
           $("#zona option:selected").each(function () {
            subred = $(this).val();
            $.post( base_url + "login/datosLocalidades", {
                subred: subred },
            function(data){
                $("#localidad").html(data);
            });
        });
    });

    $("#localidad").change(function () {
           $("#localidad option:selected").each(function () {
            id_localidad = $(this).val();
            $.post( base_url + "login/datosUPZ", {
                id_localidad: id_localidad },
            function(data){
                $("#upz").html(data);
            });
        });
    });

    $("#upz").change(function () {
           $("#upz option:selected").each(function () {
            id_upz = $(this).val();
            $.post( base_url + "login/datosBarrios", {
                id_upz: id_upz },
            function(data){
                $("#barrio").html(data);
            });
        });
    });


	$("#btn_direccion").click(function () {
		if($("#d_viap").val() == null || $("#d_num1").val() == null || $("#d_num2").val() == null || $("#d_placa").val() == null){
		alertify.alert("Novedad en Dirección","No se puede validar, existen datos de la dirección que no se han ingresado. Favor verifique e intente de nuevo");
		}
		else{
		direccion = $("#d_viap").val() + " " +  $("#d_num1").val() + $("#d_letra1").val() + " " + $("#d_bis1").val();
		direccion = direccion + " " + $("#d_card1").val() + " " + $("#d_num2").val() + $("#d_letra2").val() + " " + $("#d_placa").val() + " " + $("#d_card2").val();
		$("input[name=dire_resi]").val(direccion);
		}
	});




    var edad = $("#edad").val();
    $( "#fecha_nacimiento" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-" +edad+ "y",
        dateFormat: "yy-mm-dd"
    });

    $('#fecha_nacimiento').bind('load change', function() {
        //alert("Ingreso");
    //$("#enc_fech_nac").load.change(function () {

        fecha = new Date($("#fecha_nacimiento").val());
        hoy = new Date();
        edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
        var mesesUsuario = calcularEdad($("#fecha_nacimiento").val(), 'meses', 'SI');

        $("#edad").val(edadPaciente);
    });


	/*Author: Mario Beltrán mebeltran@saludcapital.gov.co Since: 08052019
	Ajustes Fecha de Nacimiento Mayor de 14 años*/
	$("#fecha_nacimiento").change(function () {
		fecha = new Date($("#fecha_nacimiento").val());
		hoy = new Date();
		edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
		mesesPaciente = edadPaciente * 12;

		if(mesesPaciente >= 216){
			$("#pr_adultos").show();
		}else{
			$("#pr_adultos").hide();
		}
		if (mesesPaciente<168){
			alertify.alert("Novedad en Fecha de Nacimiento","El sistema no permite el ingreso de fechas superiores a la actual. El trámite esta orientado a personas mayores de 14 años de edad");
			$("#fecha_nacimiento").val(null);
		}
	})

    $("#institucion_educativa").change(function () {
           $("#institucion_educativa option:selected").each(function () {
            id_institucion = $(this).val();
            $.post( base_url + "login/datosSedes", {
                id_institucion: id_institucion },
            function(data){
                $("#sede").html(data);
            });
        });
    });

    $("#sede").change(function () {
           $("#sede option:selected").each(function () {
            sede = $(this).val();
            id_institucion = $("#institucion_educativa").val();
            $.post( base_url + "login/datosPrograma", {
                id_institucion: id_institucion, sede: sede,  },
            function(data){
                $("#programa").html(data);
            });
        });
    });

    $("#btn_natural").click(function () {
        $("#fr_natural").show();
        $("#fr_juridica").hide();
    });

    $("#btn_juridica").click(function () {
        $("#fr_natural").hide();
        $("#fr_juridica").show();
    });


    $("#cursa_otro_programa").change(function(){
        if($("#cursa_otro_programa").val() == 'S'){
            $("#div_otro_curso").show();
        }else{
            $("#div_otro_curso").hide();
        }
    });

    $("#p_nombre, #s_nombre, #p_apellido, #s_apellido").on("keypress", function () {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);

    });
    /*
    $('#tabla_personas').DataTable({
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

    $("#viable").change(function(){

        if($("#viable").val() == '1'){
            $("#efectiva").show();
            $("#no_efectiva").hide();
        }else{
            $("#efectiva").hide();
            $("#no_efectiva").show();
        }

    });

    $("#dir1, #dir2, #dir3, #dir4, #dir5, #dir6, #dir7, #dir8, #dir9, #dir10, #dir11, #dir12").change(function(){

        var dir1 = $("#dir1").val();
        var dir2 = $("#dir2").val();
        var dir3 = $("#dir3").val();

        if($('input:checkbox[name=dir4]:checked').val() == 'on'){
            var dir4 = 'BIS';
        }else{
            var dir4 = '';
        }

        var dir5 = $("#dir5").val();
        var dir6 = $("#dir6").val();
        var dir7 = $("#dir7").val();
        var dir8 = $("#dir8").val();

        if($('input:checkbox[name=dir9]:checked').val() == 'on'){
            var dir9 = 'BIS';
        }else{
            var dir9 = '';
        }

        var dir10 = $("#dir10").val();
        var dir11 = $("#dir11").val();
        var dir12 = $("#dir12").val();
        var dir13 = $("#dir13").val();

        var direccion_final = dir1 + " " + dir2 + " " + dir3 + " " + dir4 + " " + dir5 + " " + dir6 + " " + dir7 + " " + dir8 + " " + dir9 + " " + dir10 + " " + dir11 + " " + dir12 + " " + dir13;

        $("#dire_usua").val(direccion_final);
    });

    $("#loca_capta").change(function () {
           $("#loca_capta option:selected").each(function () {
            localidad = $(this).val();
            $.post( base_url + "gestor/upzs", {
                loca: localidad },
            function(data){
            $("#upz_capta").html(data);
            });
        });
    })*/
    $("#btn_direccion_geo").click(function () {
	  
      
	  if($("#d_viap").val() == null || $("#d_num1").val() == null || $("#d_num2").val() == null || $("#d_placa").val() == null){
      alertify.alert("Novedad en Dirección","No se puede validar, existen datos de la dirección que no se han ingresado. Favor verifique e intente de nuevo");
      }
      else{
      direccion = $("#d_viap").val() + " " +  $("#d_num1").val() + $("#d_letra1").val() + " " + $("#d_bis1").val();
      direccion = direccion + " " + $("#d_card1").val() + " " + $("#d_num2").val() + $("#d_letra2").val() + " " + $("#d_placa").val() + " " + $("#d_card2").val();
      $("input[name=dire_resi]").val(direccion);


      direccion = $("#dire_resi").val();


      if (direccion != null){
        $.ajax({
          url: base_url + "login/obtenerDireccion/",
          type:'POST',
          dataType: "json",
          data:{
            direccion: direccion
          },
          success:function(res){
            if (res)
            {
              if(res[4] != '' || res[5] != ''){
                //alert("Ok Geo");
                //console.log(res);
                //console.log(res[4]);
                //console.log(direccion);
                $("#div_zona_bogota").show();
                $("#estadogeo").show();
                $("#cx").val(res[4]);
                $("#cy").val(res[5]);
                $("#dircod").val(res[0]);
                $('select[name="zona"]').find('option[value="'+res[7]+'"]').attr("selected",true).change();
                $("#localidadgeo").show();
                $('select[name="localidadg"]').find('option[value="'+res[1]+'"]').attr("selected",true).change();
                $("#upzgeo").show();
                $('select[name="upzg"]').find('option[value="'+res[2]+'"]').attr("selected",true).change();
                $("#barriogeo").show();
                $('select[name="barriog"]').find('option[value="'+res[3]+'"]').attr("selected",true).change();
                $("#stategeo").val('1');

                $("#barriongeo").hide();
                $("#upzngeo").hide();
                $("#estadongeo").hide();
                $("#localidadngeo").hide();

              }else{
                //alert("No Geo");
                //console.log(res);
                $("#div_zona_bogota").show();
                $("#estadogeo").hide();
                $("#localidadgeo").hide();
                $("#upzgeo").hide();
                $("#barriogeo").hide();
                $("#stategeo").val('0');
                $("#barriongeo").show();
                $("#upzngeo").show();
                $("#localidadngeo").show();
                $("#estadongeo").show();
              }
            }
          },
          error:function(res){
            console.log(res);
            alertify.alert("Novedad Error con el Georreferenciador","Favor Ingrese los siguientes datos de forma manual");
			$("#div_zona_bogota").show();
            $("#estadogeo").hide();
            $("#localidadgeo").hide();
            $("#upzgeo").hide();
            $("#barriogeo").hide();
            $("#stategeo").val('0');
            $("#barriongeo").show();
            $("#upzngeo").show();
            $("#localidadngeo").show();
            $("#estadongeo").show();
          }
        });
      }
    }
    });





});


function isValidDate(day,month,year)
{
    var dteDate;

    // En javascript, el mes empieza en la posicion 0 y termina en la 11

    //   siendo 0 el mes de enero

    // Por esta razon, tenemos que restar 1 al mes

    month=month-1;

    // Establecemos un objeto Data con los valore recibidos

    // Los parametros son: año, mes, dia, hora, minuto y segundos

    // getDate(); devuelve el dia como un entero entre 1 y 31

    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,

    //   martes, miercoles ...

    // getHours(); Devuelve la hora

    // getMinutes(); Devuelve los minutos

    // getMonth(); devuelve el mes como un numero de 0 a 11

    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1

    //   de enero de 1970 hasta el momento definido en el objeto date

    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.

    // getYear(); devuelve el año

    // getFullYear(); devuelve el año

    dteDate=new Date(year,month,day);

    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));

}



/**

 * Funcion para validar una fecha

 * Tiene que recibir:

 *  La fecha en formato ingles yyyy-mm-dd

 * Devuelve:

 *  true-Fecha correcta

 *  false-Fecha Incorrecta

 */

function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");

    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");

        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }

    return false;

}



/**

 * Esta función calcula la edad de una persona y los meses

 * La fecha la tiene que tener el formato yyyy-mm-dd que es

 * metodo que por defecto lo devuelve el <input type="date">

 */

function calcularEdad(edadUsuario, parametro, mensaje)
{
    var fecha = edadUsuario;

    if(validate_fecha(fecha)==true)
    {

        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;

        if ( ahora_mes < mes )
        {
            edad--;
        }

        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }

        if (edad > 1900)
        {
            edad -= 1900;
        }

        // calculamos los meses
        var meses=0;

        if(ahora_mes>mes)
            meses=ahora_mes-mes;

        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);

        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;

        // calculamos los dias
        var dias=0;

        if(ahora_dia>dia)
            dias=ahora_dia-dia;

        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }

        if(mensaje == 'SI'){
            alertify.success("Edad: "+edad+" años, "+meses+" meses y "+dias+" días");
        }

        if(parametro == 'meses'){
            totalEdad = edad * 12;
            totalMeses = totalEdad + meses;

            return totalMeses;
        }else if(parametro == 'anios'){
            return edad;
        }

    }else{
        alertify.error("La fecha "+fecha+" es incorrecta");
    }

}
