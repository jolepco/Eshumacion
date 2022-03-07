$(document).ready(function() {

    var $signupForm = $( '#formsst_usuario' );

    $signupForm.validationEngine({
        promptPosition : "topRight",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 2000
    });

    $signupForm.submit(function() {
        var $resultado=$signupForm.validationEngine("validate");

        if ($resultado) {
            return true;
        }
        return false;
    });

    $("input[name=tipo_tramite]:radio").change(function () {

        $("#div_modificacion").hide();
        $("#div_renovacion").hide();

        if($(this).val() == 1){

        }else if($(this).val() == 2){
			$("#div_modificacion").show();
        }else if($(this).val() == 3){
            $("#div_renovacion").show();
        }

    });

	$( "#paso1" ).show();
	$( "#paso2" ).hide();
	$( "#paso3" ).hide();
	$( "#paso4" ).hide();
	$( "#paso5" ).hide();
	$( "#paso6" ).hide();


	var $signupForm1 = $( '#formSeccion1' );

      $signupForm1.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm1.submit(function() {
          var $resultado=$signupForm1.validationEngine("validate");

          if ($resultado) {

              return true;
          }
          return false;
      });

      var $signupForm2 = $( '#formSeccion2' );

      $signupForm2.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm2.submit(function() {
		  event.preventDefault();
          var $resultado=$signupForm2.validationEngine("validate");

		  /* get the action attribute from the <form action=""> element */
          url = $signupForm2.attr( 'action' );

          if ($resultado) {


				$.post( url, {
					id_tramite_rayosx: $("#id_tramite_rayosx").val(),
					id_categoria_rayosx: $("#id_categoria_rayosx").val(),
					categoria: $("#categoria").val()
				},
				function(data){
					var result = $.parseJSON(data);

					if(result.estado == "OK"){
						alertify.success(result.mensaje);
						$("#btnGuardarCategoria").hide();
						$("#btn_rest_cat").show();
						$("#categoria").prop( "disabled", true );

					}else{
						alertify.danger(result.mensaje);
					}

					if(result.btn_menu == 1){
						$("#cstep2").removeClass( "btn-warning" ).addClass( "btn-success" );
						$("#check_step2").css("display", "block");
					}

				});
              return false;
          }
          return false;
      });

	  $("#btn_rest_cat").click(function(){
		  alertify.confirm('Cambio de categoría', '¿Está seguro de cambiar la categoría? <br> Esta acción eliminara los equipos que agrego a la categoría ya guardada'
		  ,function(){
				window.location.replace(base_url + "xindustrial/limpiarCategoria/" + $("#id_tramite_rayosx").val());

		  },function(){

			});
	  });

	  var $signupForm2_1 = $( '#formSeccion2-1' );

      $signupForm2_1.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

		$signupForm2_1.submit(function() {
			var $resultado=$signupForm2_1.validationEngine("validate");
			if ($resultado) {
			  return true;
			}
			return false;
		});


      var $signupForm3_1 = $( '#formSeccion3-1' );

      $signupForm3_1.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm3_1.submit(function() {
          event.preventDefault();
          var $resultado=$signupForm3_1.validationEngine("validate");

		  /* get the action attribute from the <form action=""> element */
          url = $signupForm3_1.attr( 'action' );

          if ($resultado) {

				$.post( url, {
					id_tramite_rayosx: $("#id_tramite_rayosx").val(),
					id_encargado_rayosx: $("#id_encargado_rayosx").val(),
					encargado_pnombre: $("#encargado_pnombre").val(),
					encargado_snombre: $("#encargado_snombre").val(),
					encargado_papellido: $("#encargado_papellido").val(),
					encargado_sapellido: $("#encargado_sapellido").val(),
					encargado_tdocumento: $("#encargado_tdocumento").val(),
					encargado_ndocumento: $("#encargado_ndocumento").val(),
					encargado_lexpedicion: $("#encargado_lexpedicion").val(),
					encargado_correo: $("#encargado_correo").val(),
					encargado_nivel: $("#encargado_nivel").val(),
					encargado_profesion: $("#encargado_profesion").val()
				},
				function(data){

					var result = $.parseJSON(data);
					console.log(result);
					if(result.estado == "OK"){
						alertify.success(result.mensaje);
					}else{
						alertify.danger(result.mensaje);
					}

					if(result.btn_menu == 1){
						$("#cstep3").removeClass( "btn-warning" ).addClass( "btn-success" );
						$("#check_step3").css("display", "block");
					}
				});
              return false;
		  }
          return false;
      });

      var $signupForm3_2 = $( '#formSeccion3-2' );

      $signupForm3_2.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm3_2.submit(function() {
           event.preventDefault();
          var $resultado=$signupForm3_2.validationEngine("validate");

		  /* get the action attribute from the <form action=""> element */
          url = $signupForm3_2.attr( 'action' );

          if ($resultado) {

				$.post( url, {
					id_tramite_rayosx: $("#id_tramite_rayosx").val(),
					toe_pnombre: $("#toe_pnombre").val(),
					toe_snombre: $("#toe_snombre").val(),
					toe_papellido: $("#toe_papellido").val(),
					toe_sapellido: $("#toe_sapellido").val(),
					toe_correo: $("#toe_correo").val(),
					toe_tdocumento: $("#toe_tdocumento").val(),
					toe_ndocumento: $("#toe_ndocumento").val(),
					toe_lexpedicion: $("#toe_lexpedicion").val(),
					toe_nivel: $("#toe_nivel").val(),
					toe_profesion: $("#toe_profesion").val(),
					toe_ult_entrenamiento: $("#toe_ult_entrenamiento").val(),
					toe_pro_entrenamiento: $("#toe_pro_entrenamiento").val(),
					toe_registro: $("#toe_registro").val()
				},
				function(data){

					var result = $.parseJSON(data);
					console.log(result.estado);
					if(result.estado == "OK"){
						alertify.success(result.mensaje);
					}else{
						alertify.danger(result.mensaje);
					}

					if(result.btn_menu == 1){
						$("#cstep3").removeClass( "btn-warning" ).addClass( "btn-success" );
						$("#check_step3").css("display", "block");
					}

					$.post( base_url + 'xindustrial/listarTrabajadores/', {
						id_tramite_rayosx: $("#id_tramite_rayosx").val()
					},
					function(data){
						$("#resultado3_2").html(data);
					});
					$signupForm3_2[0].reset();
				});
              return false;
		  }
          return false;
      });

      var $signupForm4_1 = $( '#formSeccion4-1' );

      $signupForm4_1.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm4_1.submit(function() {
		  event.preventDefault();

		  var $resultado=$signupForm4_1.validationEngine("validate");

		  /* get the action attribute from the <form action=""> element */
          url = $signupForm4_1.attr( 'action' );

          if ($resultado) {

			  $.post( url, {
					id_tramite_rayosx: $("#id_tramite_rayosx").val(),
					visita_previa: $("#visita_previa").val(),
					talento_pnombre: $("#talento_pnombre").val(),
					talento_snombre: $("#talento_snombre").val(),
					talento_papellido: $("#talento_papellido").val(),
					talento_sapellido: $("#talento_sapellido").val(),
					talento_tdocumento: $("#talento_tdocumento").val(),
					talento_ndocumento: $("#talento_ndocumento").val(),
					talento_lexpedicion: $("#talento_lexpedicion").val(),
					talento_correo: $("#talento_correo").val(),
					talento_titulo: $("#talento_titulo").val(),
					talento_universidad: $("#talento_universidad").val(),
					talento_libro: $("#talento_libro").val(),
					talento_registro: $("#talento_registro").val(),
					talento_fecha_diploma: $("#talento_fecha_diploma").val(),
					talento_resolucion: $("#talento_resolucion").val(),
					talento_fecha_convalida: $("#talento_fecha_convalida").val(),
					talento_nivel: $("#talento_nivel").val(),
					talento_titulo_pos: $("#talento_titulo_pos").val(),
					talento_universidad_pos: $("#talento_universidad_pos").val(),
					talento_libro_pos: $("#talento_libro_pos").val(),
					talento_registro_pos: $("#talento_registro_pos").val(),
					talento_fecha_diploma_pos: $("#talento_fecha_diploma_pos").val(),
					talento_resolucion_pos: $("#talento_resolucion_pos").val(),
					talento_fecha_convalida_pos: $("#talento_fecha_convalida_pos").val()
				},
				function(data){

					var result = $.parseJSON(data);

					if(result.estado == "OK"){
						alertify.success(result.mensaje);
					}else{
						alertify.danger(result.mensaje);
					}

					if(result.btn_menu == 1){
						$("#cstep4").removeClass( "btn-warning" ).addClass( "btn-success" );
						$("#check_step4").css("display", "block");
					}
				});
              return false;
          }
          return false;
      });

      var $signupForm4_2 = $( '#formSeccion4-2' );

      $signupForm4_2.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm4_2.submit(function() {
			event.preventDefault();
			var $resultado=$signupForm4_2.validationEngine("validate");

		  /* get the action attribute from the <form action=""> element */
          url = $signupForm4_2.attr( 'action' );

          if ($resultado) {

				$.post( url, {
					id_tramite_rayosx: $("#id_tramite_rayosx").val(),
					obj_nombre: $("#obj_nombre").val(),
					obj_marca: $("#obj_marca").val(),
					obj_modelo: $("#obj_modelo").val(),
					obj_serie: $("#obj_serie").val(),
					obj_calibracion: $("#obj_calibracion").val(),
					obj_vigencia: $("#obj_vigencia").val(),
					obj_fecha: $("#obj_fecha").val(),
					obj_uso: $("#obj_uso").val()
				},
				function(data){

					var result = $.parseJSON(data);

					if(result.estado == "OK"){
						alertify.success(result.mensaje);
					}else{
						alertify.danger(result.mensaje);
					}

					if(result.btn_menu == 1){
						$("#cstep4").removeClass( "btn-warning" ).addClass( "btn-success" );
						$("#check_step4").css("display", "block");
					}

					$.post( base_url + 'xindustrial/listarObjetos/', {
						id_tramite_rayosx: $("#id_tramite_rayosx").val()
					},
					function(data){
						$("#resultado4_2").html(data);
					});

					$signupForm4_2[0].reset();
				});
              return false;
		  }
          return false;
      });


      var $signupForm5_1 = $( '#formSeccion5-1' );

      $signupForm5_1.validationEngine({
         promptPosition : "topLeft",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm5_1.submit(function() {
          var $resultado=$signupForm5_1.validationEngine("validate");
          if ($resultado) {
              return true;
          }
          return false;
      });

      var $signupForm5_2 = $( '#formSeccion5-2' );

      $signupForm5_2.validationEngine({
         promptPosition : "topLeft",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $signupForm5_2.submit(function() {
          var $resultado=$signupForm5_2.validationEngine("validate");
          if ($resultado) {
              return true;
          }
          return false;
      });

	  var $formfinal = $( '#formfinal' );

      $formfinal.validationEngine({
         promptPosition : "topLeft",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

      $formfinal.submit(function() {
          var $resultado=$formfinal.validationEngine("validate");
          if ($resultado) {
              return true;
          }
          return false;
      });

	  var $signupFormActEquipo = $( '.formActEquipo' );

      $signupFormActEquipo.validationEngine({
         promptPosition : "topRight",
         scroll: false,
         autoHidePrompt: true,
         autoHideDelay: 2000
      });

	  $("#notificacion").change(function(){
        if($("#notificacion").val() == '1'){
            $("#div_correo_noti").show();
        }else{
            $("#div_correo_noti").hide();
        }
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
            $.post(base_url + "xindustrial/cargaMunicipio", {
                departamento: depto_entidad
            }, function (data) {
                $("#mpio_entidad").html(data);
            });
        });
    });


    $("#categoria").on("change load", function(){
        if($("#categoria").val() == '1'){
            $("#div_categoria1").show();
            $("#div_doc_cat1").show();
            $("#div_categoria2").hide();
            $("#div_categoria2-1").hide();
            $("#div_categoria2-1-otro").hide();
            $("#div_doc_cat2").hide();
        }else{
            $("#div_categoria1").hide();
            $("#div_doc_cat1").hide();
            $("#div_categoria2").show();
            $("#div_doc_cat2").show();
			$("#div_categoria2-1").show();
            $("#div_categoria2-1-otro").hide();
            $("#div_categoria1-1").hide();
            $("#div_categoria1-2").hide();
        }
    });

    $("#categoria1").on('change load', function(){
        if($("#categoria1").val() == '3'){
            $("#div_categoria-otro").show();
        }else{
            $("#div_categoria-otro").hide();
        }
    });

	$("#categoria2").on('change load', function(){
        if($("#categoria2").val() == '11'){
            $("#div_categoria-otro").show();
        }else{
            $("#div_categoria-otro").hide();
        }
    });


    $("#visita_previa").change(function(){
        if($("#visita_previa").val() == '1'){
            $("#div_talentohumano").show();
            $("#div_objetos").show();
			$("#btnGuardarIps").hide();
			$(".docu_talento").show();
        }else{
            $("#div_talentohumano").hide();
            $("#div_objetos").hide();
            $("#btnGuardarIps").show();
			$(".docu_talento").hide();

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
            alertify.error('Solo es posible agregar hasta 60 personas');
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

$(document).on('change','input[name="soporte_modificacion"]',function(){

var fileName = $("#soporte_modificacion").val();
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
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;


		case 'PDF':
      if(fileSize >= 2996480){
        alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      }else{
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;
		default:
			alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
			this.value = ''; // reset del valor
			this.files[0].name = '';
		break;
	}
});


$(document).on('change','input[name="doc_lic_anteriorR"]',function(){

var fileName = $("#doc_lic_anteriorR").val();
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
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;


		case 'PDF':
      if(fileSize >= 2996480){
        alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      }else{
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;
		default:
			alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
			this.value = ''; // reset del valor
			this.files[0].name = '';
		break;
	}
});

$(document).on('change','input[name="doc_lic_anterior"]',function(){

var fileName = $("#doc_lic_anterior").val();
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
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;


		case 'PDF':
      if(fileSize >= 2996480){
        alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      }else{
            alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
      }

		break;
		default:
			alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
			this.value = ''; // reset del valor
			this.files[0].name = '';
		break;
	}




});

$(document).on('change','input[name="fi_blindajes"]',function(){

	var fileName = $("#fi_blindajes").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

			break;


			case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

			break;
			default:
				alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
				this.value = ''; // reset del valor
				this.files[0].name = '';
			break;
		}




});


$(document).on('change','input[name="fi_control_calidad"]',function(){

  var fileName = $("#fi_control_calidad").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }




});


$(document).on('change','input[name="fi_plano"]',function(){

  var fileName = $("#fi_plano").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }




});


$(document).on('change','input[name="fi_manual"]',function(){

  var fileName = $("#fi_manual").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[name="fi_ficha"]',function(){

  var fileName = $("#fi_ficha").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
                alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[name="fi_estudio"]',function(){

  var fileName = $("#fi_estudio").val();
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
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
              alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[name="fi_pruebas_caracterizacion"]',function(){

  var fileName = $("#fi_pruebas_caracterizacion").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="pn_doc"]',function(){

  var fileName = $("#pn_doc").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF2. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});




$(document).on('change','input[id="pn_doc2"]',function(){

  var fileName = $("#pn_doc2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});





$(document).on('change','input[id="pj_doc"]',function(){

  var fileName = $("#pj_doc").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="pj_doc2"]',function(){

  var fileName = $("#pj_doc2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="pj_cyc"]',function(){

  var fileName = $("#pj_cyc").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="pj_cyc2"]',function(){

  var fileName = $("#pj_cyc2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[name="fi_doc_encargado"]',function(){

  var fileName = $("#fi_doc_encargado").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[name="fi_diploma_encargado"]',function(){

  var fileName = $("#fi_diploma_encargado").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_registro_dosimetrico2"]',function(){

  var fileName = $("#fi_registro_dosimetrico2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});




$(document).on('change','input[id="fi_registro_dosimetrico"]',function(){

  var fileName = $("#fi_registro_dosimetrico").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="fi_constancia_toe"]',function(){

  var fileName = $("#fi_constancia_toe").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_constancia_toe2"]',function(){

  var fileName = $("#fi_constancia_toe2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="fi_constancia_equipo"]',function(){

  var fileName = $("#fi_constancia_equipo").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_constancia_equipo2"]',function(){

  var fileName = $("#fi_constancia_equipo2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_soporte_talento"]',function(){

  var fileName = $("#fi_soporte_talento").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="fi_diploma_director"]',function(){

  var fileName = $("#fi_diploma_director").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_res_convalida_director"]',function(){

  var fileName = $("#fi_res_convalida_director").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_diploma_pos_profe"]',function(){

  var fileName = $("#fi_diploma_pos_profe").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="fi_res_convalida_profe"]',function(){

  var fileName = $("#fi_res_convalida_profe").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="fi_cert_calibracion"]',function(){

  var fileName = $("#fi_cert_calibracion").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_declaraciones"]',function(){

  var fileName = $("#fi_declaraciones").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});




$(document).on('change','input[id="fi_soporte_talento2"]',function(){

  var fileName = $("#fi_soporte_talento2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="fi_diploma_director2"]',function(){

  var fileName = $("#fi_diploma_director2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="fi_res_convalida_director2"]',function(){

  var fileName = $("#fi_res_convalida_director2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="fi_diploma_pos_profe2"]',function(){

  var fileName = $("#fi_diploma_pos_profe2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});

$(document).on('change','input[id="fi_res_convalida_profe2"]',function(){

  var fileName = $("#fi_res_convalida_profe2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[id="fi_cert_calibracion2"]',function(){

  var fileName = $("#fi_cert_calibracion2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[id="fi_declaraciones2"]',function(){

  var fileName = $("#fi_declaraciones2").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});




$(document).on('change','input[name="fi_doc_oficial"]',function(){

  var fileName = $("#fi_doc_oficial").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[name="fi_diploma_oficial"]',function(){

  var fileName = $("#fi_diploma_oficial").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});



$(document).on('change','input[name="fi_capacitacion_radiologica"]',function(){

  var fileName = $("#fi_capacitacion_radiologica").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;
      default:
        alertify.alert("Novedad Tipo Archivo","El archivo cargado no es de extensión PDF. Favor Verifique el contenido");
        this.value = ''; // reset del valor
        this.files[0].name = '';
      break;
    }
});


$(document).on('change','input[name="fi_evaluacion"]',function(){

  var fileName = $("#fi_evaluacion").val();
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
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
        }

      break;


      case 'PDF':
        if(fileSize >= 2996480){
          alertify.alert("Novedad Tamaño Archivo PDF","El archivo cargado supera el tamaño máximo permitido que es de 3 Megas. Favor Verifique el contenido");
          this.value = ''; // reset del valor
          this.files[0].name = '';
        }else{
          alertify.alert("Carga Exitosa Archivo PDF","El archivo fue cargado correctamente.");
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


function step1() {

   $( "#paso1" ).show();
   $( "#paso2" ).hide();
   $( "#paso3" ).hide();
   $( "#paso4" ).hide();
   $( "#paso5" ).hide();
 }

 function step2() {

	$( "#paso1" ).hide();
    $( "#paso2" ).show();
	$( "#paso3" ).hide();
	$( "#paso4" ).hide();
	$( "#paso5" ).hide();
 }

 function step3() {

	$( "#paso1" ).hide();
	$( "#paso2" ).hide();
	$( "#paso3" ).show();
	$( "#paso4" ).hide();
	$( "#paso5" ).hide();
 }

 function step4() {

	$( "#paso1" ).hide();
	$( "#paso2" ).hide();
	$( "#paso3" ).hide();
	$( "#paso4" ).show();
	$( "#paso5" ).hide();

 }

 function step5() {

	$( "#paso1" ).hide();
	$( "#paso2" ).hide();
	$( "#paso3" ).hide();
	$( "#paso4" ).hide();
	$( "#paso5" ).show();

   if($("#categoria").val() == 1){
	   $( "#formSeccion5-1" ).show();
   }else if($("#categoria").val() == 2){
	   $( "#formSeccion5-2" ).show();
   }else{
	   alertify.error("Debe seleccionar una categoria valida para visualizar los documentos");
   }


 }

 function step6() {
	$( "#paso1" ).hide();
	$( "#paso2" ).hide();
	$( "#paso3" ).hide();
	$( "#paso4" ).hide();
	$( "#paso5" ).hide();
	$( "#paso6" ).show();
}

 function eliminarEquipo(id_tramite, id_equipo){

	 alertify.confirm('Eliminar Equipo', 'Esta seguro que desea eliminar el equipo seleccionado?',
	 function(){

		$.post( base_url + "xindustrial/eliminarEquipo", {
			id_tramite_rayosx: id_tramite,
			id_equipo_rayosx: id_equipo
		},
		function(data){
			console.log(data);
			var respuesta = $.parseJSON(data);

			if(respuesta.estado == 'OK'){
				alertify.success(respuesta.mensaje);

				if(respuesta.btn_menu == 0){
					$("#cstep2").removeClass( "btn-success" ).addClass( "btn-warning" );
					$("#check_step2").css("display", "block");
				}
				location.reload(base_url + 'xindustrial/rx_editarForm/' + id_tramite);

			}else{
				alertify.error(respuesta.mensaje);
			}
		});
	 },
	 function(){
	}).set('labels', {ok:'Si', cancel:'Cancelar'});

 }

 function eliminarTOE(id_tramite, id_toe){

	 alertify.confirm('Eliminar TOE', 'Esta seguro que desea eliminar el trabajador seleccionado?',
	 function(){

		$.post( base_url + "xindustrial/eliminarTOE", {
			id_tramite_rayosx: id_tramite,
			id_toe_rayosx: id_toe
		},
		function(data){
			console.log(data);
			var respuesta = $.parseJSON(data);

			if(respuesta.estado == 'OK'){
				alertify.success(respuesta.mensaje);

				$.post( base_url + 'xindustrial/listarTrabajadores/', {
					id_tramite_rayosx: id_tramite
				},
				function(data){
					$("#resultado3_2").html(data);
				});

			}else{
				alertify.error(respuesta.mensaje);
			}
		});
	 },
	 function(){
	}).set('labels', {ok:'Si', cancel:'Cancelar'});

 }
 
 function eliminarObj(id_tramite, id_obj){

	 alertify.confirm('Eliminar Objeto', 'Esta seguro que desea eliminar el objeto seleccionado?',
	 function(){

		$.post( base_url + "xindustrial/eliminarObj", {
			id_tramite_rayosx: id_tramite,
			id_obj_rayosx: id_obj
		},
		function(data){
			console.log(data);
			var respuesta = $.parseJSON(data);

			if(respuesta.estado == 'OK'){
				alertify.success(respuesta.mensaje);

				$.post( base_url + 'xindustrial/listarObjetos/', {
					id_tramite_rayosx: id_tramite
				},
				function(data){
					$("#resultado4_2").html(data);
				});

			}else{
				alertify.error(respuesta.mensaje);
			}
		});
	 },
	 function(){
	}).set('labels', {ok:'Si', cancel:'Cancelar'});

 } 

 function act_cambiacat1(id_equipo){
	 if($("#categoria1_eq" + id_equipo).val() == '1'){
		$("#div_categoria1-1_eq" + id_equipo).show();
		$("#div_categoria1-2_eq" + id_equipo).hide();
	}else{
		$("#div_categoria1-1_eq" + id_equipo).hide();
		$("#div_categoria1-2_eq" + id_equipo).show();
	}
 }

 function act_cambiacat2(id_equipo){
	if($("#categoria2_eq" + id_equipo).val() >= '1'){
		$("#div_categoria2-1_eq" + id_equipo).show();
	}else{
		$("#div_categoria2-1_eq" + id_equipo).hide();
	}
 }

 function act_cambiacat2_1(id_equipo){

	if($("#categoria2_1_eq" + id_equipo).val() == '16'){
		$("#div_categoria2-1-otro_eq" + id_equipo).show();
		$("#div_info_tubo2_eq" + id_equipo).show();
		$("#div_doc_tubo2_eq" + id_equipo).show();

	}else{
		$("#div_categoria2-1-otro_eq" + id_equipo).hide();
		$("#div_info_tubo2_eq" + id_equipo).hide();
		$("#div_doc_tubo2_eq" + id_equipo).hide();
	}

 }

function validarFormEquipoAct(id_equipo){
	var $signupFormAct = $( '#formActualizar' +  id_equipo);

		$signupFormAct.validationEngine({
			promptPosition : "topRight",
			scroll: false,
			autoHidePrompt: true,
			autoHideDelay: 2000
		});

		$signupFormAct.submit(function() {
			var $resultado=$signupFormAct.validationEngine("validate");
			if ($resultado) {
			  return true;
			}
			return false;
		});
}


 function abrirModal(titulo, info){
	 alertify.alert()
	  .setting({
		'title':titulo,
		'label':'Cerrar',
		'message': $(info).html() ,
		'onok': function(){ }
	  }).show();
	 //alertify.alert($(info).html());
	 //alertify.alert("Prueba");
 }


 function editarEquipo(id_tramite, id_equipo){
	alertify.genericDialog ($('#formEditarEquipo'+id_equipo)[0]);
 }

 alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        },
        setup:function(){
            return {
                focus:{
                    element:function(){
                        return this.elements.body.querySelector(this.get('selector'));
                    },
                    select:true
                },
                options:{
                    basic:true,
                    maximizable:false,
                    resizable:false,
                    padding:false
                }
            };
        },
        settings:{
            selector:undefined
        }
    };
});
