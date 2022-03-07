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

    $("#btn_acep2term").click(function () {
        $("#formreg").show();
        $("#2termino").hide();
    });

    $("#btn_nacep2term").click(function () {
        $("#formreg").hide();
        $("#2termino").show();
        alertify.alert("Novedad en Aceptar Términos:","Los presentes términos son pre-requisito para registrar el trámite, si tiene alguna inquietud sobre los términos mencionados agradecemos contactar teléfonicamente o al correo eléctronico contactenos@saludcapital.gov.co ");
    });

    $signupForm.submit(function() {
        var $resultado=$signupForm.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });

    $("select").select2({ width: '100%' });

    $("#tipo_titulo").change(function(){
        if($("#tipo_titulo").val() == '1'){
            $("#div_nacional").show();
            $("#div_extranjero").hide();
			$("#div_tarjeta").hide();
            $("#div_archivos_extranjero").hide();
        }else{
            $("#div_nacional").hide();
			$("#div_tarjeta").hide();
            $("#div_extranjero").show();
            $("#div_archivos_extranjero").show();
			$("#fecha_resolucion").attr('required',true);
			$("#pdf_resolucion").attr('required',true);
        }
    });


    $("#institucion_educativa").change(function () {
           $("#institucion_educativa option:selected").each(function () {
            id_institucion = $(this).val();
            $.post( base_url + "login/datosProgramasUniversidad", {
                id_institucion: id_institucion },
            function(data){
                $("#profesion2").html(data);
				$("#profesion").html(data);
            });
        });
    });

    $("#profesion").change(function () {

        var result = $("#profesion option:selected").text().split('-');
        var texto = $.trim(result[2]);

           if(texto == 'UNV' || texto == 'UNV'){
			   $("#tarjeta").attr('required',true);
			   $("#pdf_tarjeta").attr('required',true);
               $("#div_tarjeta").show();
               $("#div_doctarjeta").show();
           }else{
			   $("#tarjeta").attr('required',false);
			   $("#pdf_tarjeta").attr('required',false);
               $("#div_tarjeta").hide();
               $("#div_doctarjeta").hide();
           }
    });

    $("#profesion2").change(function () {

        var result = $("#profesion2 option:selected").text().split('-');
        var texto = $.trim(result[2]);

           if(texto == 'UNV' || texto == 'UNV'){
			   $("#tarjeta").attr('required',true);
			   $("#pdf_tarjeta").attr('required',true);

               $("#div_tarjeta").show();
               $("#div_doctarjeta").show();
           }else{
			   $("#tarjeta").attr('required',false);
			   $("#pdf_tarjeta").attr('required',false);
		       $("#div_tarjeta").hide();
               $("#div_doctarjeta").hide();
           }
		$("#fecha_resolucion").attr('required',true);
		$("#pdf_resolucion").attr('required',true);	
    });
	
	
    $("#titulo_equivalente").change(function () {

        var result = $("#titulo_equivalente option:selected").text().split('-');
        var texto = $.trim(result[1]);

           if(texto == 'UNV' || texto == 'UNV'){
			   $("#tarjeta").attr('required',true);
			   $("#pdf_tarjeta").attr('required',true);
               $("#div_tarjeta").show();
               $("#div_doctarjeta").show();
           }else{
			   $("#tarjeta").attr('required',false);
			   $("#pdf_tarjeta").attr('required',false);			   
               $("#div_tarjeta").hide();
               $("#div_doctarjeta").hide();
           }
    });	
	
	$("#titulo_equivalente2").change(function () {

        var result = $("#titulo_equivalente2 option:selected").text().split('-');
        var texto = $.trim(result[1]);

           if(texto == 'UNV' || texto == 'UNV'){
			   $("#tarjeta").attr('required',true);
               $("#div_tarjeta").show();
               $("#div_doctarjeta").show();
           }else{
			   $("#tarjeta").attr('required',false);
			   $("#pdf_tarjeta").attr('required',false);			   
               $("#div_tarjeta").hide();
               $("#div_doctarjeta").hide();
           }
    });	

    $( "#fecha_resolucion" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

    $( "#fecha_term" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

    $( "#fecha_term_ext" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

     $('#tabla_tramites').DataTable({
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

    $("#cod_universidad").on("keypress", function () {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);

    });

	// Author Mario Beltran mebeltran@saludcapital.gov.co since 11062019
	// Ajuste validacion campo Fecha no mayor a la actual en fecha resolucion fecha terminacion y fecha terminacion exterior.
	var f = new Date();
	var mes =  f.getMonth() + 1
	var diaFT=0;

	if (f.getDate() > 0) {
		if (f.getDate() <10) {
			diaFT = "0" + f.getDate();
		}else {
			diaFT = f.getDate();
		}
	}

	if (mes > 0) {
		if (mes <10) {
			mes = "0" + mes;
		}else {
			mes = mes;
		}
	}


	var factual = f.getFullYear() + "-" + mes + "-" + diaFT;

	$( "#fecha_term" ).change(function () {

		if($( "#fecha_term" ).val() > factual){
			alertify.alert("Novedad en Fecha Terminación de Estudios","La fecha ingresada " + $( "#fecha_term" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_term" ).val("");
		}
    });

	$( "#fecha_resolucion" ).change(function () {

		if($( "#fecha_resolucion" ).val() > factual){
			alertify.alert("Novedad en Fecha Resolución Extranjeros","La fecha ingresada " + $( "#fecha_resolucion" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_resolucion" ).val("");
		}
    });

	$( "#fecha_term_ext" ).change(function () {

		if($( "#fecha_term_ext" ).val() > factual){
			alertify.alert("Novedad en Fecha Terminación de Estudios Extranjeros","La fecha ingresada " + $( "#fecha_term_ext" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fecha_term_ext" ).val("");
		}
    });


  $(document).on('change','input[name="pdf_titulo"]',function(){

  			var fileName = $("#pdf_titulo").val();
  			var fileSize = this.files[0].size;

  				var ext = fileName.split('.');
                  // ahora obtenemos el ultimo valor despues el punto
                  // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
                  ext = ext[ext.length-1];

  				switch (ext) {
  					case 'pdf':
              if(fileSize >= 2996480){
                alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                this.value = ''; // reset del valor
                this.files[0].name = '';
              }else{
                alertify.alert("Carga Exitosa Archivo PDF","El archivo Diploma fue cargado correctamente.");
              }

  					break;


  					case 'PDF':
              if(fileSize >= 2996480){
                alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                this.value = ''; // reset del valor
                this.files[0].name = '';
              }else{
                alertify.alert("Carga Exitosa Archivo PDF","El archivo Diploma fue cargado correctamente.");
              }

  					break;
  					default:
  						alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
  						this.value = ''; // reset del valor
  						this.files[0].name = '';
  					break;					
  				}
				


  								
  		});

      $(document).on('change','input[name="pdf_documento"]',function(){

      			var fileName = $("#pdf_documento").val();
      			var fileSize = this.files[0].size;

      				var ext = fileName.split('.');
                      // ahora obtenemos el ultimo valor despues el punto
                      // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
                      ext = ext[ext.length-1];

      				switch (ext) {
      					case 'pdf':
                  if(fileSize >= 2996480){
                    alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                    this.value = ''; // reset del valor
                    this.files[0].name = '';
                  }else{
                    alertify.alert("Carga Exitosa Archivo PDF","El archivo Documento Identidad fue cargado correctamente.");
                  }

      					break;
						
						case 'PDF':
                  if(fileSize >= 2996480){
                    alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                    this.value = ''; // reset del valor
                    this.files[0].name = '';
                  }else{
                    alertify.alert("Carga Exitosa Archivo PDF","El archivo Documento Identidad fue cargado correctamente.");
                  }

      					break;
      					default:
      						alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
      						this.value = ''; // reset del valor
      						this.files[0].name = '';
      					break;						
      				}
      		});

      $(document).on('change','input[name="pdf_acta"]',function(){
      			var fileName = $("#pdf_acta").val();
      			var fileSize = this.files[0].size;

      				var ext = fileName.split('.');
                          // ahora obtenemos el ultimo valor despues el punto
                          // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
                    ext = ext[ext.length-1];

          				switch (ext) {
          					case 'pdf':
                      if(fileSize >= 2996480){
                        alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                        this.value = ''; // reset del valor
                        this.files[0].name = '';
                      }else{
                        alertify.alert("Carga Exitosa Archivo PDF","El archivo Acta de Grado fue cargado correctamente.");
                      }

          					break;

          					case 'PDF':
                      if(fileSize >= 2996480){
                        alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                        this.value = ''; // reset del valor
                        this.files[0].name = '';
                      }else{
                        alertify.alert("Carga Exitosa Archivo PDF","El archivo Acta de Grado fue cargado correctamente.");
                      }

          					break;
          					default:
          						alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
          						this.value = ''; // reset del valor
          						this.files[0].name = '';
          					break;
          				}
          		});

          $(document).on('change','input[name="pdf_tarjeta"]',function(){
          			var fileName = $("#pdf_tarjeta").val();
          			var fileSize = this.files[0].size;

          				var ext = fileName.split('.');
                              // ahora obtenemos el ultimo valor despues el punto
                              // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
                        ext = ext[ext.length-1];

              				switch (ext) {
              					case 'pdf':
                          if(fileSize >= 2996480){
                            alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                          }else{
                            alertify.alert("Carga Exitosa Archivo PDF","El archivo Tarjeta Profesional fue cargado correctamente.");
                          }

              					break;

              					case 'PDF':
                          if(fileSize >= 2996480){
                            alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                          }else{
                            alertify.alert("Carga Exitosa Archivo PDF","El archivo Tarjeta Profesional fue cargado correctamente.");
                          }

              					break;
              					default:
              						alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
              						this.value = ''; // reset del valor
              						this.files[0].name = '';
              					break;
              				}
              		});

          $(document).on('change','input[name="pdf_resolucion"]',function(){
          			var fileName = $("#pdf_resolucion").val();
          			var fileSize = this.files[0].size;
          				var ext = fileName.split('.');
                              // ahora obtenemos el ultimo valor despues el punto
                              // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
                        ext = ext[ext.length-1];
              				switch (ext) {
              					case 'pdf':
                          if(fileSize >= 2996480){
                            alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                          }else{
                            alertify.alert("Carga Exitosa Archivo PDF","El archivo Resolución Convalidación fue cargado correctamente.");
                          }
                					break;

              					case 'PDF':
                          if(fileSize >= 2996480){
                            alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                          }else{
                            alertify.alert("Carga Exitosa Archivo PDF","El archivo Resolución Convalidación fue cargado correctamente.");
                          }
                					break;
            					default:
              						alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
              						this.value = ''; // reset del valor
              						this.files[0].name = '';
            					break;
              				}
              		});

});
