//*****************************************************************************************
	//* Ejecuta una funcion ajax para actualizar un comboBox
	//*****************************************************************************************
	$.fn.cargarCombo = function(element,url){
		return this.change(function(event){
			$.ajax({
				type: "POST",
				url: base_url + url,
				data: "id=" + $(this).val(),
			    dataType: "html",
				cache: false,
				success: function(html){
					var target = "#" + element;
					$(target).html("");
					$(html).appendTo(target);									
				}
			});
		});
	};

//*****************************************************************************************
	//* End
//*****************************************************************************************	

function toggleNavigation(){
      $('.page-header').toggleClass('menu-expanded');
      $('.page-nav').toggleClass('collapse');
    }
 
    // EVENTOS DEL DOM
    $(window).on('load',function(){
      $('.toggle-nav').click(toggleNavigation);
    });

$("#btnIngresar").click(function () {
    $("#frmIngresar").validate({
        rules: {
            txtLogin: {required: true},
            txtPassword: {required: true}
        },
        messages: {
            txtLogin: {required: "Debe ingresar usuario."},
            txtPassword: {required: "Debe ingresar password."},
        },
        errorPlacement: function (error, element) {
            element.after(error);
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
        submitHandler: function (form) {
            form.submit();
            /*$.ajax({
                type: "POST",
                url: base_url + "login/validar",
                data: $("#frmIngresar").serialize(),
                dataType: "html",
                cache: false,
                success: function (data) {
                    //alert(url);
                    $("#agregarEmpresa").dialog('close');
                }
            });*/
        }
    });
});

$(function(){ 
    $(".nuevo").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"plazas/registrar_tramite",
            data: {'idRow': oID},
            cache: false,
            success: function (data) {
                //  alert(url);
                $('#tablaDatos').html(data);
            }
        });
    }); 
});

$(function(){ 
    $(".proyecto").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"plazas/registrar_proyecto",
            data: {'idRow': oID},
            cache: false,
            success: function (data) {
                //  alert(url);
                $('#tablaDatos').html(data);
            }
        });
    }); 
});

$(function(){ 
    $(".editar").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/editar_tramite",
            data: {'idRow': oID},
            cache: false,
            success: function (data) {
                //  alert(url);
                $('#tablaDatos').html(data);
            }
        });
    }); 
});
$(function(){ 
    $(".VerPDF").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/cargar_modal_pdf",
            data: {'idRow': oID},
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
    }); 
});
$(function(){ 
    $(".corregirPDF").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/cargar_modal_editarpdf",
            data: {'idRow': oID },
            cache: false,
            success: function (data) {
                $('#tablaDatos1').html(data);
            }
        });
    }); 
});

$(function(){ 
    $(".editTramite").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/modal_editTramite",
            data: {'idRow': oID },
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
    }); 
});
$(function(){ 
    $(".editCuidador").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/modal_editCuidador",
            data: {'idRow': oID },
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
    }); 
});

$(function(){ 
    $(".auditoria").click(function () { 
        var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
            url: base_url +"certificado_discapacidad/ver_auditoria",
            data: {'idRow': oID },
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
    }); 
});


$(document).ready(function() {
	$('#dataTables').DataTable({
		  language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ registros",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando registros 0 a 0 de 0 registros",
            infoFiltered:   "(filtrado de un total de _MAX_ registros)",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "No hay registros",
            paginate: {
                first:      "Primera",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Última"
            },
            buttons: {
                print:      "Imprimir",
                copy:       "Copiar",
                copyTitle: "Copiar al portapapeles"
                
            },
            aria: {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
		responsive: true,
		"order": [[ 0, "desc" ]],
		"pageLength": 25
	});

    $('#dataTablesTramites').DataTable({
          language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ registros",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando registros 0 a 0 de 0 registros",
            infoFiltered:   "(filtrado de un total de _MAX_ registros)",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "No se encontraron resultados",
            emptyTable:     "Ningún dato disponible en esta tabla",
            paginate: {
                first:      "Primera",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Última"
            },
            buttons: {
                print:      "Imprimir",
                copy:       "Copiar",
                copyTitle: "Copiar al portapapeles"
                
            },
            aria: {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        responsive: true,
        "order": [[ 0, "desc" ]],
        "pageLength": 15
    });

    $('#trigger').click(function(){
        $("#dialog").dialog();
    });

    $("#btnSubmitEnviar").click(function(){
       $.ajax({
          type: "POST",
          url: base_url + "plazas/enviar_validacion",
          data: $("#form").serialize(),
          dataType: "json",
          contentType: "application/x-www-form-urlencoded;charset=UTF-8",
          cache: false,
          success: function(data){
          if( data.result )//true
            {
              //alert("MMM");
              $("#div_load").css("display", "none");
              $('#btnSubmitEnviar').removeAttr('disabled');
              location.href = base_url + "plazas/index";
              //location.reload();
            }
            else
            {
              //alert("NNN");
              alert('Error. Reload the web page.');
              $("#div_load").css("display", "none");
              $("#div_error").css("display", "inline");
              $('#btnSubmitEnviar').removeAttr('disabled');
            }
          },
          error: function(result) {
            //alert("zzz");
            alert('Error. Reload the web page.');
            $("#div_load").css("display", "none");
            $("#div_error").css("display", "inline");
            $('#btnSubmitEnviar').removeAttr('disabled');
          }
        });
    }); 
    
});