
function validarFrm2() {
    
    /*$("#frmRegUsuario").validationEngine('attach', {
        onValidationComplete: function (form, status) {
            if (status === true) {
                if (confirm("Confirma la validez y el registro de los datos ingresados?")) {
                    form.validationEngine('detach');
                    validarFrm();
                } //if Confirm
            } //if status
            else
                return;
        } //if onvalidation
    }); // validationEngine */
	
	$("#frmRegUsuario").validationEngine('attach', {
		onValidationComplete: function (form, status) {
			if (status === true) {
				if (confirm("Confirma la validez y el registro de los datos ingresados?")) {
					form.validationEngine('detach');
					validarFrm();
				}else{
					 $("#frmRegUsuario").validationEngine('attach', {
						//
					 });
					return false;	
				}
			} //if status
			else
				return;
		} //if onvalidation
	}); // validationEngine 
}

function validarFrm() {
    $.ajax({
        type: "POST",
        url: "../controller/enviar.php",
        data: $("#frmRegUsuario").serialize(),
        beforeSend: function () {
            $("#Enviar").hide();
        },
        success: function (datos) {
            
            var array = datos.split('|');
            
            if(array[0] == 0) {
                //$('#respuestaMensaje').html(array[2]);
                //$('#myModal').modal('show');
                $("#Enviar").show();
				//funcion incliuda en la importación del master/modal.html
                showAlert( array[2] , 'info');
                $('#frmRegUsuario')[0].reset();
				$("#formpreliminar").show();
            }
            else if(array[1]===undefined){
                //$('#respuestaMensaje').html(" Error No fue posible realizar su solicitud. ");
                //$('#myModal').modal('show');
                $("#Enviar").show();
				showAlert( "No fue posible realizar su solicitud. Por favor intente nuevamente y si el problema persiste comuníquese al correo eléctronico contactenos@saludcapital.gov.co" , 'error');
            }
            else{
				
                //$('#respuestaMensaje').html(array[1]);
                //$('#myModal').modal('show');
				showAlert( array[1] , 'info')
				$("#Enviar").show();;
            }
        },
		error: function(XMLHttpRequest, textStatus, errorThrown){
			console.log(textStatus);
			showAlert( "No fue posible realizar su solicitud. Por favor intente nuevamente y si el problema persiste comuníquese al correo eléctronico contactenos@saludcapital.gov.co" , 'error');
			$("#Enviar").show();
		}
    });
}

/**
 * @consulta upz segun id localidad
 */
$("#localidadrural").on("change", function () {
    var codigoloc = /(\d+)/g;
    var name = $("#localidadrural option:selected").text();
    $("#codigoloc").val(name.match(codigoloc));
    var id = $.post("../controller/direccionRural.php", {funcion: "upz", idlocalidad: $(this).val()
    });
    id.done(function (data) {
        $("#upzrural").html(data);
    });
    id.error(function () {
        alert("error");
    });
});
/**
 * @funcion para extraer solo numeros de un String
 */
$("#upzrural").on("change", function () {
    var codigoupz = /(\d+)/g;  //match obtiene valores numericos y \d indica que quieres que coja números y
    //   /g indica que quieres buscar de manera global en todo el string.     
    var name = $("#upzrural option:selected").text();
    $("#codigoupz").val(name.match(codigoupz));
    var id = $.post("../controller/direccionRural.php", {funcion: "barrio", idupz: $(this).val()
    });
    id.done(function (data) {
        $("#barriorural").html(data);
    });
    id.error(function () {
        alert("error");
    });
});

function nro(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    if ((e.keyCode == 101) || (e.keyCode == 69) || (e.keyCode == 46) || (e.keyCode == 43) || (e.keyCode == 45))
        return false;
    return true;
}

/**
 * Funcion para validad que solo se ingresa letras y numeros 
 
 * @param {type} e
 * @returns {Boolean} */
function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    //patron = /[A-Za-z0-9]/;
    patron = /[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
function checknumber(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros 
    //patron = /[A-Za-z0-9]/;
    patron = /[0-9-]+/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
//jQuery('#representante').keypress(function(tecla) {
//if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45)) 
// return false;

//});

