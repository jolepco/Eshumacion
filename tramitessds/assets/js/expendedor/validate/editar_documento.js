$(document).on('change','.btn-file :file',function(){
  var input = $(this);
  var numFiles = input.get(0).files ? input.get(0).files.length : 1;
  var label = input.val().replace(/\\/g,'/').replace(/.*\//,'');
  input.trigger('fileselect',[numFiles,label]);
});
$(document).ready(function(){
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
			personas1: 			{ required: true, minlength: 3, maxlength:50 },
			lastName: 			{ required: true, minlength: 3, maxlength:50 },
			tipoDocumento: 		{ required: true },
			documento: 			{ required: true, number: true, minlength: 4, maxlength:12 },
			address: 			{ minlength: 4, maxlength:200},
			personas:	 		{ minlength: 4, maxlength:15  },
			movilNumber: 		{ required: true, minlength: 4, maxlength:15 },
			email: 				{ required: true, email: true },
			rol:	 			{ required: true }
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
	 if(this.files[0].size > 3000000) {
       alert("El archivo pesa mas de 3MB.");
       $(this).val('');
     }
    });
	
	$("#btnSubmittt").click(function(){		
		if ($("#form").valid() == true){
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: "",
					data: $("#formmmm").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');
							var url = "usuarios";
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
	
});



