$(document).on('change','.btn-file :file',function(){
  var input = $(this);
  var numFiles = input.get(0).files ? input.get(0).files.length : 1;
  var label = input.val().replace(/\\/g,'/').replace(/.*\//,'');
  input.trigger('fileselect',[numFiles,label]);
});
$(document).ready(function(){
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
	$("#cuidador_pnombre").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#cuidador_snombre").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#cuidador_papellido").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#cuidador_sapellido").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#cuidador_numdoc").maxlength(18).convertirMayuscula().bloquearCaracteres().bloquearCaracteres1();
	$("#cuidador_telefono").bloquearTexto().maxlength(16);
	$("#cuidador_celular").bloquearTexto().maxlength(16);

  	$('.btn-file :file').on('fileselect',function(event,numFiles,label){
    var input = $(this).parents('.input-group').find(':text');
    var log = numFiles > 1 ? numFiles + ' files selected' : label;
    if(input.length){ input.val(log); }else{ if (log) alert(log); }
	});

	
	//$('#modalTratamiento').modal('show');
	
	$('#aceptarTerminos').on('click', function(e){
		e.preventDefault();
		$('#modalTratamiento').modal('hide');
	})
	
	$("input[name='acepta_terminos']:checkbox").change(function () {
		if($('input[name="acepta_terminos"]:checked').val() == 'on'){
			
			//alerttify.success('Terminos y condiciones aceptados');
			$("#div_terminos").css("display", "inline");
			$('#btnSubmit').prop('disabled', false);
		}else{
			$("#div_terminos").css("display", "none");
			$('#btnSubmit').prop('disabled', true);
		}
	});

	

	$("#form").validate( {
		rules: {
			cedulaaaa: 			{ required: true, accept: "pdf", filesize: 10000 },
			registro_civillll: 	{ required: true, accept: "pdf", filesize: 1048576 }
			
		},
		messages: {
			
			cedulaaaa : {	required   :  "Falta la cédula.",
						accept:  "Solo acepta PDF.",
						filesize: "Tamaño mínimo 1 MB"
			},
			registro_civillll : {	required   :  "Registro civil.",
								accept:  "Solo acepta PDF.",
								filesize: "Tamaño mínimo 1 MB"
			}
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
			error.css('position','relative');
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
		submitHandler: function (form) {
			return true;
		}
	});

	$("input[type='file']").on("change", function () {
		var file = $(this).val();
	    var ext = file.substring(file.lastIndexOf("."));
		 if(this.files[0].size > 3000000) {
	       alert("El archivo pesa mas de 3MB.");
	       $(this).val('');
	     }
        
	    if(ext != '.pdf')
	    {
	        alert("La extensión " + ext + " no es admitida, los archivos deben estar en formato pdf");
	        return false;
	    }
	    else
	    {
	        return true;
	    }  
	});
	
	
	$("#btnSubmit").click(function(){ 
		$(".regimen").on("change",function(){
			if($(this).prop('checked')){
				$("#regimen_esp").parent().parent().removeClass("alert alert-danger");
	        	$('#mensajeRegimen').html('');
			}
		});

		$(".categoria").on("change",function(){
			if($(this).prop('checked')){
				$("#categoria1").parent().parent().removeClass("alert alert-danger");
	        	$('#mensajeCategoria').html('');
			}
		});

		$(".acompanante").on("change",function(){
			if($(this).prop('checked')){
				$("#req_acompanante").parent().parent().removeClass("alert alert-danger");
	        	$('#mensajeacompanante').html('');
			}
		});

		$(".persona").on("change",function(){
			if($(this).prop('checked')){
				$("#vive_persona").parent().parent().removeClass("alert alert-danger");
	        	$('#mensajepersona').html('');
			}
		});

		if(!$("input[type='radio'].regimen").is(':checked')){  //checked = $("input:checked[type=checkbox]").length;
	      	$("#regimen_esp").parent().parent().addClass("alert alert-danger");
	      	$('#mensajeRegimen').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opción.</span></div>');
  			return false;
  		}else if(!$("input.categoria:checked[type=checkbox]").length>0){  //checked = $("input:checked[type=checkbox]").length;
	      	var reg=$('input:radio[name=regimen_esp]:checked').val();
		   if(reg==='no'){
	          $("#categoria1").parent().parent().addClass("alert alert-danger");
	      		$('#mensajeCategoria').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opción.</span></div>');
  				return false;
	        }else{
	          return true;
	        }

  		}else if(!$("input[type='radio'].acompanante").is(':checked')) {
	      $("#req_acompanante").parent().parent().addClass("alert alert-danger");
	      $('#mensajeacompanante').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opci&oacute;n.</span></div>');
			return false;
		}else if(!$("input[type='radio'].persona").is(':checked')) {
	      $("#vive_persona").parent().parent().addClass("alert alert-danger");
	      $('#mensajepersona').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opci&oacute;n.</span></div>');
		   return false;	
		}else{
			return true;
		}
	});

	$("#movilizar").change(function () {
		$("#movilizar option:selected").each(function () {	
			if($(this).val()==5){
	          $( "#cual_movilizar" ).prop( "disabled", false );
	          //$(".otro").show();
	        }else{
	          $( "#cual_movilizar" ).prop( "disabled", true );
	          $('#cual_movilizar').val('');
	        }
    	});
	});

    $("#comunicar").change(function () {
		$("#comunicar option:selected").each(function () {	
			if($(this).val()==5){
	          $( "#cual_comunicar" ).prop( "disabled", false );
	          //$(".otro").show();
	        }else{
	          $( "#cual_comunicar" ).prop( "disabled", true );
	          $('#cual_comunicar').val('');
	        }
    	});
    }); 

    $(".acompanante").change(function () {
    	var acompan=$('input:radio[name=req_acompanante]:checked').val();
    	if(acompan==='si'){
          //$( "#cual_comunicar" ).prop( "disabled", false );
          $(".cuidador").show();
        }else{
          $(".cuidador").hide();
          $('.cuidador').val('');
        }
    });

    $(".regimen").change(function () {
		var reg=$('input:radio[name=regimen_esp]:checked').val();
	   if(reg==='no'){
          //$( "#cual_comunicar" ).prop( "disabled", false );
          $(".regimen_no").show();          
        }else{
          $(".regimen_no").hide();
          $('.regimen_no').val('');
          $('.categoria').prop('checked', false);
          $('.acompanante').prop('checked', false);
          $('.persona').prop('checked', false);
          //$('.persona').prop('checked', false);
        }
    });

    $("#cuidador_numdoc").change(function () {
		$("#cuidador_tipodoc option:selected").each(function () {	
			if($(this).val() == 1){
				if($("#cuidador_numdoc").val().length < 6 || $("#cuidador_numdoc").val().length > 10){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">La c\u00E9dula de ciudadan\u00EDa debe tener como m\u00EDnimo 6 d\u00EDgitos y m\u00E1ximo 10 d\u00EDgitos.</span></div>');
			  		$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
			  	}else if(isNaN($("#cuidador_numdoc").val())){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">La c\u00E9dula de ciudadan\u00EDa debe tener solo n\u00FAmeros.</span></div>');
					$( "#acepta_terminos" ).prop( "checked", false );
					$( "#acepta_terminos" ).prop( "disabled", true );
					$('#btnSubmit').prop('disabled', true);
					
				}else{
					$('#mensajeTipoDoc').html('');
					$( "#acepta_terminos" ).prop( "disabled", false );
					$('#btnSubmit').prop('disabled', false);
			  	}
	          //$(".otro").show();
	        }else if($(this).val() == 3){
				if($("#cuidador_numdoc").val().length < 10 || $("#cuidador_numdoc").val().length > 11){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">La tarjeta de identidad debe tener como m\u00EDnimo 10 d\u00EDgitos y m\u00E1ximo 11 d\u00EDgitos.</span></div>');
			  		$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
				}else if(isNaN($("#cuidador_numdoc").val())){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">La tarjeta de identidad debe tener solo n\u00FAmeros.</span></div>');
					$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
				}else{
					$('#mensajeTipoDoc').html('');
					$( "#acepta_terminos" ).prop( "disabled", false );
					$('#btnSubmit').prop('disabled', false);
			  	}
	          //$(".otro").show();
	        }else if($(this).val() == 7){
				if($("#cuidador_numdoc").val().length < 10 || $("#cuidador_numdoc").val().length > 11){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">El regisro civil debe tener como m\u00EDnimo 10 caracteres y m\u00E1ximo 11 caracteres.</span></div>');
			  		$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
				}else{
					$('#mensajeTipoDoc').html('');
					$( "#acepta_terminos" ).prop( "disabled", false );
					$('#btnSubmit').prop('disabled', false);
			  	}
	          //$(".otro").show();
	        }else if($(this).val() == 4){
				if($("#cuidador_numdoc").val().length < 10 || $("#cuidador_numdoc").val().length > 15){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">El permiso especial de permanencia debe tener como m\u00EDnimo 10 caracteres y m\u00E1ximo 15 caracteres.</span></div>');
			  		$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
				}else if(isNaN($("#cuidador_numdoc").val())){
					$('#mensajeTipoDoc').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">El permiso especial de permanencia debe tener solo n\u00FAmeros.</span></div>');
					$( "#acepta_terminos" ).prop( "checked", false );
			  		$( "#acepta_terminos" ).prop( "disabled", true );
			  		$('#btnSubmit').prop('disabled', true);
				}else{
					$('#mensajeTipoDoc').html('');
					$( "#acepta_terminos" ).prop( "disabled", false );
					$('#btnSubmit').prop('disabled', false);
			  	}
	          //$(".otro").show();
	        }else if($(this).val() == 2){
	        	$('#mensajeTipoDoc').html('');
	        }
	        else{
	        	$('#mensajeTipoDoc').html('');
	        }
	        
    	});
    }); 
});



