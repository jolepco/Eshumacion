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
                                  dayNames: ['Domingo', 'Lunes', 'Martes', 'MiÃ©rcoles', 'Jueves', 'Viernes', 'Sï¿½bado'],
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




$(document).ready(function(){

  $("#p_nombre").convertirMayuscula();
  $("#s_nombre").convertirMayuscula();
  $("#p_apellido").convertirMayuscula();
  $("#s_apellido").convertirMayuscula();
  $("#dire_resi").convertirMayuscula();
  $("#telefono_fijo").bloquearTexto().maxlength(12);
  $("#telefono_celular").bloquearTexto().maxlength(12);
  $("#numiden").bloquearTexto().maxlength(12);

  $( "#form" ).validate( {
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
    },
    /*messages: {
        "mes[]": { required: "Debe seleccionar una opcion."
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
    if ($("#form").valid() == true){
        //Activa icono guardando
        $('#btnSubmit').attr('disabled','-1');
        $("#div_error").css("display", "none");
        $("#div_load").css("display", "inline");
       
        $.ajax({
          type: "POST",
          url: base_url + "expendedor_droga/save_persona",
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
              location.href = base_url + "expendedor_droga/save_persona";
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
   })
 });



    



