$(document).ready(function(){
	$.validator.addMethod("claveValida",function (value, element){
		if ( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/.test(value) )  {
			return true;
		}
		else{
			return false;
		}
	},"");

	$( "#form_consulta" ).validate( {
    rules: {
      clave_actual:      { required: true, minlength: 6, maxlength:16 },
      nueva_clave:       { required: true, minlength: 8, maxlength:16, claveValida:true },
      confirma_clave:    { required: true, minlength: 8, maxlength:16, equalTo:"#nueva_clave" },
    },
    messages: {
         "clave_actual": { required: "Este campo es requerido.",
        					minlength: "Mínimo 6 caracteres",
        					maxlength: "Máximo 16 caracteres"
        },
        "nueva_clave": { required: "Este campo es requerido.",
        					minlength: "Mínimo 8 caracteres",
        					maxlength: "Máximo 16 caracteres",
        					claveValida: "Ingrese una clave valida, debe contener al menos un caracter en mayúscula, al menos uno en minúscula, al menos un caracter numerico, no debe incluir la letra ñ y debe tener al menos uno de los siguientes caracteres especiales: @, !, *, $, %, &",
        },
        "confirma_clave": { required: "Este campo es requerido.",
        					minlength: "Mínimo 8 caracteres",
        					maxlength: "Máximo 16 caracteres",
        					equalTo: "Las contraseñas no son iguales",
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
		error.css('position','absolute');
		error.css('margin-top','1px');
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

    },
    highlight: function ( element, errorClass, validClass ) {
      $( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
    },
    submitHandler: function (form_consulta) {
      return true;
    }
  	});

	$("#btnSubmit").click(function(){
	  	if ($("#form_consulta").valid() === true){
	        //Activa icono guardando
	        $('#btnSubmit').attr('disabled','-1');
	        $("#div_error").css("display", "none");
	        $("#div_load").css("display", "inline");
	        $.ajax({
	          type: "POST",
	          url: base_url + "registro/cambio_clave_envio",
	          data: $("#form_consulta").serialize(),
	          dataType: "json",
	          contentType: "application/x-www-form-urlencoded;charset=UTF-8",
	          cache: false,

	          success: function(data){
	          	if( data.result == "error" )
	            {
	              $("#div_load").css("display", "none");
	              $("#div_error").css("display", "inline");
	              $('#btnSubmit').removeAttr('disabled');
	              location.reload(true);
	              return false;
	            }

	            if( data.result )//true
	            {
	              //alert("MMM");
	              $("#div_load").css("display", "none");
	              $('#btnSubmit').removeAttr('disabled');
	              location.href = base_url + "registro/cambio_clave_envio";
	              location.reload(true);
	            }
	            else
	            {
	              //alert("NNN");
	              alert('Error. Reload the web page.');
	              $("#div_load").css("display", "none");
	              $("#div_error").css("display", "inline");
	              $('#btnSubmit').removeAttr('disabled');
	            }
	        },
	          error: function(result) {
	            //alert("zzz");
	            alert('Error. Reload the web page.');
	            $("#div_load").css("display", "none");
	            $("#div_error").css("display", "inline");
	            $('#btnSubmit').removeAttr('disabled');
	        }


	        });

	    }//if
	  
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
   })
 });