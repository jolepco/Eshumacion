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

	$("#personas1").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#lastName").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#encargado_pnombre").convertirMayuscula(); 
	$("#encargado_snombre").convertirMayuscula();
	$("#encargado_papellido").convertirMayuscula();
	$("#encargado_sapellido").convertirMayuscula();
	$("#nro_plazas").bloquearTexto().maxlength(2);
	$("#nro_poblacion").bloquearTexto().maxlength(7);
	$("#salario_plaza").bloquearTexto().maxlength(16);
  $("#salario_plaza").bloquearTexto().maxlength(16);
  $("#especialidad").bloquearNumeros().convertirMayuscula().maxlength(50).bloquearCaracteres().bloquearCaracteres1();
	
  
  $( "#form" ).validate( {
    rules: {
      email_confirma: { required: true, email: true, equalTo:"#encargado_email" },
      lastName:       { required: true, minlength: 3, maxlength:50 },
      nro_poblacion:    { required: true, min:1, max:1000000},
      nro_plazas:    { required: true, min:1, max:10},
      
    },
    /*messages: {
        "mes[]": { requrequiired: "Debe seleccionar una opcion."
        },
        "dependencia[]": { required: "Debe seleccionar una opcion."
        },
    },*/
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
       alert("El archivo pesa mas de 3Mb.");
       $(this).val('');
     }
    });

  $("#btnSubmit").click(function(){

  $(".dependencia").on("change",function(){
      if($(this).prop('checked')){
        $("#dependencia1").parent().parent().removeClass("alert alert-danger");
        $('#mensajeDepend').html('');
      }
  });

  $(".meses").on("change",function(){
      if($(this).prop('checked')){
        $("#mes1").parent().parent().removeClass("alert alert-danger");
        $('#mensajeMes').html('');
      }
  });

  /*if(!$("input.dependencia:checked[type=checkbox]").length>0){  //checked = $("input:checked[type=checkbox]").length;
      $("#dependencia1").parent().parent().addClass("alert alert-danger");
      $('#mensajeDepend').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opción.</span></div>');
  }
  else if(!$("input.meses:checked[type=checkbox]").length>0){
      $("#mes1").parent().parent().addClass("alert alert-danger");
      $('#mensajeMes').html('<div class="alert alert-warning" role="alert"><span class="glyphicon" aria-hidden="true">Debe seleccionar una opción.</span></div>');
  }else{*/
    if ($("#formMMMM").valid() == true){
        //Activa icono guardando
        $('#btnSubmit').attr('disabled','-1');
        $("#div_error").css("display", "none");
        $("#div_load").css("display", "inline");
       
        $.ajax({
          type: "POST",
          //url: base_url + "save_proyecto",
          data: $("#form").serialize(),
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
              //alert("MMM");
              $("#div_load").css("display", "none");
              $('#btnSubmit').removeAttr('disabled');
              //location.href = base_url + "registrar_proyecto";
              //location.reload(true);
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
  //}
  
    
  });

    $("#modalidad").change(function () {
           $("#modalidad option:selected").each(function () {
           	if($(this).val()==2){
              //$( ".investigacion" ).prop( "disabled", false );
              $(".investigacion").show();
            }else{
              //$( ".investigacion" ).prop( "disabled", true );
               $(".investigacion").hide();
            }

        });
   })

    $("#tipo_profesion").change(function () {
           $("#tipo_profesion option:selected").each(function () {
            if($(this).val()==5){
                $("#especialidad" ).prop( "disabled", false );
              }else{
                $("#especialidad" ).prop( "disabled", true );
                $('#especialidad').val('');
            }

        });
   })
 });



    



