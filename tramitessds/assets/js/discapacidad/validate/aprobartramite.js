//*****************************************************************************************
  //* Convierte todos los caracteres de una caja de texto a mayusculas cuando pierde el foco
  //*****************************************************************************************
  $.fn.mayusculas = function(){
    return this.blur(function(event){
      $(this).val($(this).val().toUpperCase());
    });
  };
  
  //*****************************************************************************************
  //* Convierte todos los caracteres de una caja de texto a minusculas cuando pierde el foco
  //*****************************************************************************************
  $.fn.minusculas = function(){
    return this.blur(function(event){
      $(this).val($(this).val().toLowerCase());
    });
  };

$(document).ready(function(){
    $.datepicker.regional['es'] = { closeText: 'Cerrar',
                                  currentText: 'Hoy',
                                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'S�bado'],
                                  dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','S&aacute;b'],
                                  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                                  weekHeader: 'Sem',
                                  dateFormat: 'dd/mm/yy',
                                  firstDay: 1,
                                  isRTL: false,
                                  showMonthAfterYear: false,
                                  yearSuffix: ''
    };
    $("#fecha_nacimiento").datepicker({
       format: 'mm/dd/yyyy'
    
    });
});

//*******************************************************************************************
    //* 2) Bloquea el ingreso de caracteres de texto en una caja de texto. Solo permite números
    //*******************************************************************************************
    $.fn.bloquearTexto = function () {
        return this.keypress(function (event) {
            if ((event.which == 8) || (event.which == 0) || (event.which == 45) || (event.which == 46))
                return true;
            if ((event.which >= 48) && (event.which <= 57))
                return true;
            else
                return false;
        });
    };

    //******************************************************************************************
    //* 3) Bloquea el ingreso de caracteres numericos en una caja de texto. Solo permite letras
    //******************************************************************************************
    $.fn.bloquearNumeros = function () {
        return this.keypress(function (event) {
            if ((event.which < 48) || (event.which > 57))
                return true;
            else
                return false;
        });
    };

    //******************************************************************************************
    //* 3) Bloquea el ingreso de caracteres especiales /, *, +, -
    //******************************************************************************************
    $.fn.bloquearCaracteres = function () {
        return this.keypress(function (event) {
            if ((event.which < 33) || (event.which > 47))
                return true;
            else
                return false;
        });
    };

    //******************************************************************************************
    //* 3) Bloquea el ingreso de caracteres especiales /, *, +, -
    //******************************************************************************************
    $.fn.bloquearCaracteres1 = function () {
        return this.keypress(function (event) {
            if ((event.which < 91) || (event.which > 95))
                return true;
            else
                return false;
        });
    };

    //******************************************************************************************
    //* 4) Convierte el contenido de una caja de texto todo a mayusculas
    //******************************************************************************************
    $.fn.convertirMayuscula = function () {
        return this.blur(function (event) {
            $(this).val($(this).val().toUpperCase());
        });
    };

    //******************************************************************************************
    //* 5) Convierte el contenido de una caja de texto todo a minusculas
    //******************************************************************************************
    $.fn.convertirMinuscula = function () {
        return this.blur(function (event) {
            $(this).val($(this).val().toLowerCase());
        });
    };

    //********************************************************************************************
    //* 1) Establece el valor máximo de caracteres que pueden ir en una caja de texto.
    //********************************************************************************************
    $.fn.maxlength = function (expresion) {
        return this.keypress(function (event) {
            if ((event.which == 8) || (event.which == 0))
                return true;
            else if ($(this).val().length < expresion)
                return true;
            else
                return false;
        });
    };
  //*****************************************************************************************
    //* Convierte todos los caracteres de una caja de texto a mayusculas cuando pierde el foco
    //*****************************************************************************************
    $.fn.mayusculas = function(){
      return this.blur(function(event){
        $(this).val($(this).val().toUpperCase());
      });
    };
    
    //*****************************************************************************************
    //* Convierte todos los caracteres de una caja de texto a minusculas cuando pierde el foco
    //*****************************************************************************************
    $.fn.minusculas = function(){
      return this.blur(function(event){
        $(this).val($(this).val().toLowerCase());
      });
    };
$("#cod_autorizacion").convertirMayuscula().maxlength(50);

$(document).ready(function(){

  
  $( "#form_aprobar" ).validate( {
    rules: {
      personas1:      { required: true, minlength: 3, maxlength:50 },
      lastName:       { required: true, minlength: 3, maxlength:50 },
      tipoDocumento:    { required: true },
      documento:      { required: true, number: true, minlength: 4, maxlength:12 },
      address:      { minlength: 4, maxlength:200},
      personas:     { minlength: 1, maxlength:3  },
      movilNumber:    { required: true, minlength: 4, maxlength:15 },
      email:        { required: true, email: true },
      rol:        { required: true },
      cumple0:        { required: true },
      cumple1:        { required: true },
      cumple2:        { required: true },
      cumple3:        { required: true },
      cumple4:        { required: true },
    },
    messages: {
        "cumple0": { required: "Debe seleccionar una opcion."
        },
        "cumple1": { required: "Debe seleccionar una opcion."
        },
        "cumple2": { required: "Debe seleccionar una opcion."
        },
        "cumple3": { required: "Debe seleccionar una opcion."
        },
        "cumple4": { required: "Debe seleccionar una opcion."
        },
    },
    errorElement: "em",
    errorPlacement: function ( error, element ) {
      // Add the `help-block` class to the error element
      error.addClass( "help-block" );
      error.insertAfter( element );

     error.css('opacity','0.47');
      error.css('z-index','991');
      error.css('background','#ee0101');
      //error.css('float','right');
      error.css('position','abosolute');  
      error.css('margin-top','10px');
      error.css('color','#fff');
      error.css('font-size','11px');
      error.css('border','2px solid #ddd');
      error.css('box-shadow','0 0 6px #000');
      error.css('-moz-box-shadow','0 0 6px #000');
      error.css('-webkit-box-shadow','0 0 6px #000');
      error.css('padding','4px 10px 4px 10px');
      error.css('border-radius','6px');
      error.css('-moz-border-radius','6px');
      error.css('-webkit-border-radius','6px');
      $("#cumple0").parent().parent().addClass("alert alert-danger");
      $("#cumple1").parent().parent().addClass("alert alert-danger");
      $("#cumple2").parent().parent().addClass("alert alert-danger");
      $("#cumple3").parent().parent().addClass("alert alert-danger");
      $("#cumple4").parent().parent().addClass("alert alert-danger");

    },
    highlight: function ( element, errorClass, validClass ) {
      $( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
    },
    submitHandler: function (form_aprobar) {
      return true;
    }
  });

  $("#btnSubmitAprobar").click(function(){

    $(".cumplen0").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple0").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple0').html('');
		}
	});

    $(".cumplen1").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple1").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple1').html('');
		}
	});

	$(".cumplen2").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple2").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple2').html('');
		}
	});

	$(".cumplen3").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple3").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple3').html('');
		}
	});

	$(".cumplen4").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple4").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple4').html('');
		}
	});

	$(".cumplen5").on("change",function(){
		if($(this).prop('checked')){
			$("#cumple5").parent().parent().removeClass("alert alert-danger");
        	$('#mensajecumple5').html('');
		}
	});

    /*if(!$("input[type='radio'].cumplen0").is(':checked')) {
	      $("#cumple0").parent().parent().addClass("alert alert-danger");
	      $('#mensajecumple0').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opci&oacute;n.</span></div>');
	}else if(!$("input[type='radio'].cumplen2").is(':checked')) {
	      $("#cumple2").parent().parent().addClass("alert alert-danger");
	      $('#mensajecumple2').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opci&oacute;n.</span></div>');
	}else if(!$("input[type='radio'].cumplen3").is(':checked')) {
	      $("#cumple3").parent().parent().addClass("alert alert-danger");
	      $('#mensajecumple3').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opci&oacute;n.</span></div>');
	}else{*/
	    if ($("#form_aprobar").valid() == true){
	        //Activa icono guardando
	        $('#btnSubmitAprobar').attr('disabled','-1');
	        $("#div_error").css("display", "none");
	        $("#div_load").css("display", "inline");
	        
	        $.ajax({
	          type: "POST",
	          url: base_url + "certificado_discapacidad/save_aprobar",
	          data: $("#form_aprobar").serialize(),
	          dataType: "json",
	          contentType: "application/x-www-form-urlencoded;charset=UTF-8",
	          cache: false,

	          success: function(data){
	            if( data.result == "error" )
	            {
	              $("#div_load").css("display", "none");
	              $("#div_error").css("display", "inline");
	              $('#btnSubmitAprobar').removeAttr('disabled');
	              return false;
	            }

	            if( data.result )//true
	            {
	              //alert("MMM");
	              $("#div_load").css("display", "none");
	              $('#btnSubmitAprobar').removeAttr('disabled');
	              location.href = base_url + "certificado_discapacidad/aprobar_tramite";
	              location.reload(true);
	            }
	            else
	            {
	              //alert("NNN");
	              alert('Error. Reload the web page.');
	              $("#div_load").css("display", "none");
	              $("#div_error").css("display", "inline");
	              $('#btnSubmitAprobar').removeAttr('disabled');
	            }
	          },
	          error: function(result) {
	            //alert("zzz");
	            alert('Error. Reload the web page.');
	            $("#div_load").css("display", "none");
	            $("#div_error").css("display", "inline");
	            $('#btnSubmitAprobar').removeAttr('disabled');
	          }


	        });

	    }//if
  	//}
  });

    $("#areaOperacion").change(function () {
           $("#areaOperacion option:selected").each(function () {

            if($(this).val()==16){
              $( "#otroCual" ).prop( "disabled", false );
              //$(".otro").show();
            }else{
              $( "#otroCual" ).prop( "disabled", true );
                //$(".otro").hide();
            }

        });
   });
    $("#estado").change(function () {
           $("#estado option:selected").each(function () {
            if($(this).val()==15){
              $( "#cod_autorizacion" ).prop( "disabled", true );
              $('#cod_autorizacion').val('');
            }else{
              $( "#cod_autorizacion" ).prop( "disabled", false );
                //$(".otro").hide();
            }

        });
   });

    $("#estado").change(function () {
           $("#estado option:selected").each(function () {
            if($(this).val()==24){
              $( "#ips" ).prop( "disabled", true );
              $('#ips').val('');
            }else{
              $( "#ips" ).prop( "disabled", false );
                //$(".otro").hide();
            }

        });
   });

    $("#btnSubmitFirmar").click(function(){
       $.ajax({
          type: "POST",
          url: base_url + "certificado_discapacidad/enviar_resolucion",
          data: $("#form_aprobar").serialize(),
          dataType: "json",
          contentType: "application/x-www-form-urlencoded;charset=UTF-8",
          cache: false,
          success: function(data){
          if( data.result )//true
            {
              //alert("MMM");
              $("#div_load").css("display", "none");
              $('#btnSubmitFirmar').removeAttr('disabled');
              location.href = base_url + "certificado_discapacidad/tramites_pendientes";
              //location.reload();
            }
            else
            {
              //alert("NNN");
              alert('Error. Reload the web page.');
              $("#div_load").css("display", "none");
              $("#div_error").css("display", "inline");
              $('#btnSubmitFirmar').removeAttr('disabled');
            }
          },
          error: function(result) {
            //alert("zzz");
            alert('Error. Reload the web page.');
            $("#div_load").css("display", "none");
            $("#div_error").css("display", "inline");
            $('#btnSubmitFirmar').removeAttr('disabled');
          }
        });
    });

});