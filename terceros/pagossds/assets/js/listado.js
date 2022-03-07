//$(document).ready(function() {
$(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').on('click', function() {
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
    });

    var tabla_listado = $('#book-table').DataTable({
        processing: true,
        ajax: base_url + 'consulta/listadoJson',
        columns: [
            { 'data': 'VIGENCIA' },
            { 'data': 'NIT_CEDULA' },
           	{ 'data': 'CTO_CONVENIO' },
          /*  { 'data': 'FECHA_DILIGENCIAMIENTO' },
            { 'data': 'FECHA_APROBACION' },*/
			{ 'data': 'ESTADO' },
			{ 'data': 'FECHA_GIRO' },
            { 'data': 'PLANILLA' },  
			{ 'data': 'ORDEN_PAGO' },			
			{ 'data': 'BRUTO' },   
			{ 'data': 'VALOR_GIRADO' },           
            { 'data': 'NOMBRE_BANCO' },
            { 'data': 'CUENTA_BANCO_RECEPTOR' },
             { 'data': 'DETALLE' }
        ],
		'language': {
           'url': base_url + 'assets/plugins/DataTables/datatables.locale-es.json'
        },
        'paging': true,
        'pageLength': 50,
        'bFilter': true,
        'bInfo': false,
        'ordering': false,
        'responsive': true,
        'searching': false,
        'info': false
    });	

    $('#nombreB').on("change", function () {	
		var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
		var nombreB = $("#nombreB").val();		
		
		for (var i = 0; i < specialChars.length; i++) {
			nombreB= nombreB.replace(new RegExp("\\" + specialChars[i], 'gi'), ' ');
		}   
					
		$("#nombreB").val(nombreB);
		
	});

    $('#btn-enviar').on("click", function (e) {
    
        var cedula = $("#num_identif").val();
        var contrato = $("#contrato").val();
        var cuenta = $("#cuenta").val();

        if(!cedula){cedula=1}
        if(!contrato){contrato=1}

        if(cedula.length > 0 && cuenta.length > 0) {
            window.location = base_url + 'consulta/generarPlano/'+cedula+'/'+contrato+'/'+cuenta;
        } else {
            alert("No hay datos");
        }
    });

	$('#btn-buscar').on("click", function () {		
		$(this).buscarUsuarios();
        num_identif= $("#num_identif").val();
        contrato= $("#contrato").val();  
        cuenta=$("#cuenta").val();       
    
        if(num_identif){         
            /*$.ajax({
                url: base_url + "consulta/cargaCuentas/",
                type:'POST',
                dataType: "json",
                data:{                    
                    num_identif: num_identif
                },
                success:function(data){
                    if(data.length > 0) {
                        $('#cuenta').html('<option value="">Seleccione...</option>');
                        $(data).each(function(index, value){
                            if(cuenta==value.CUENTA_BANCO_RECEPTOR){ selected=" selected ";}
                            else{ selected="";}

                            $('#cuenta').append('<option value="' + value.CUENTA_BANCO_RECEPTOR + '" >' + value.CUENTA_BANCO_RECEPTOR + '</option>');
                        });
                        $("#cuenta").val(cuenta);
                    }
                    
                },                
                error:function(){                   
                    $("#num_identif").val(num_identif);   
                    $("#tabla_respuesta").hide();                               
                }
            });*/

            $("#tabla_respuesta").hide();
            $("#linea2").hide();
            $("#linea1").hide();
            $("#nombre_persona").val('');
            $("#vacio").hide();

            $.ajax({
            url: base_url + "consulta/traer_nombre/",
            type:'POST',
                dataType: "json",
                data:{
                     num_identif: num_identif,
                     cuenta : cuenta
                },
                success:function(res){              
                    if (res) {
                        $("#linea1").show();
                        $("#nombre_persona").val(res.nombre).show();
                        $("#tabla_respuesta").show();
                        $("#linea2").show();
                        $("#vacio").hide();
                    } else {
                        //alertify.alert("No existen registros");
                        $("#linea1").hide();
                        $("#tabla_respuesta").hide();
                        $("#linea2").hide();
                        $("#vacio").show();
                        // alert("no");
                    }
                },                
                error:function(){                   
                    $("#num_identif").val();
                    $("#linea1").hide();
                    $("#tabla_respuesta").hide();
                    $("#linea2").hide();
                     $("#vacio").show();
                  //alertify.alert("No existen registros");                                              
                }
            });
        }

        if  (contrato){         
            $.ajax({
                url: base_url + "consulta/cargaCuentasCon/",
                type:'POST',
                dataType: "json",
                data:{                    
                    contrato: contrato
                },
                success:function(data){
                    if(data.length > 0) {
                        $('#cuenta').html('<option value="">Seleccione...</option>');
                        $(data).each(function(index, value){
                            if(cuenta==value.CUENTA_BANCO_RECEPTOR){ selected=" selected ";}
                                else{ selected="";}

                        $('#cuenta').append('<option value="' + value.CUENTA_BANCO_RECEPTOR + '" >' + value.CUENTA_BANCO_RECEPTOR + '</option>');

                        });
                        $("#cuenta").val(cuenta);
                    }
                    
                },                
                error:function(){                   
                    $("#num_identif").val(num_identif);   
                    $("#tabla_respuesta").hide();                               
                }
            });

            $("#tabla_respuesta").hide();
            $("#linea2").hide();
            $("#nombre_persona").val('');
            $("#vacio").hide();

            $.ajax({
            url: base_url + "consulta/traer_nombre_con/",
            type:'POST',
                dataType: "json",
                data:{
                     contrato: contrato,
                     cuenta : cuenta
                },
                
                success:function(res){              
                    if (res) {                       
                        $("#nombre_persona").val(res.nombre);
                        $("#tabla_respuesta").show();
                        $("#linea2").show();
                          $("#vacio").hide();
                    } else {
                        //alertify.alert("No existen registros");
                         $("#tabla_respuesta").hide();
                         $("#linea2").hide();
                            $("#vacio").show();
                        // alert("no");
                    }
                },                
                error:function(){                   
                    $("#num_identif").val(); 
                    $("#tabla_respuesta").hide();
                    $("#linea2").hide();
                     $("#vacio").show();
                  //alertify.alert("No existen registros");                                              
                }
            });
        }     	
    });

  
	 $.fn.buscarUsuarios = function () {
		 
		var frm = generarURLserialize('buscar_lista');	

        /* for (var i = 0; i < frm.length; i++) {
            if (isNaN(frm[i]) && frm[i].indexOf('%2F') > 0) {
                frm[i] = formatearFecha(frm[i]);
				alert(frm[i]);
            }			
        }*/
		//$('#btn-buscar').button('loading');
	 	//carga tabla con consulta de pagos
        tabla_listado.ajax.url(base_url + 'consulta/listadoJson/' + frm.join('/')).load(); 
        // $("#tabla_respuesta").show();
        // $("#linea2").show();
    };

    $("#num_identif").blur(function () {    
        num_identif = $("#num_identif").val();
        
        if  (num_identif){         
            $.ajax({
                url: base_url + "consulta/cargaCuentas/",
                type:'POST',
                dataType: "json",
                data:{                    
                    num_identif: num_identif
                },

                success:function(data){
                    if(data.length > 0) {
                        $('#cuenta').html('<option value="">Seleccione...</option>');
                        $(data).each(function(index, value){
                        $('#cuenta').append('<option value="' + value.CUENTA_BANCO_RECEPTOR + '">' + value.CUENTA_BANCO_RECEPTOR + '</option>');
                    });
                        $("#cuenta").val(data.CUENTA_BANCO_RECEPTOR);
                    }
                },                
                error:function(){                   
                    $("#num_identif").val(num_identif);                                   
                }
            });
        }else{
            if (!contrato){
                 $('#cuenta').html('<option value="">Seleccione...</option>');
                 $("#cuenta").val('');
             }
        }
    });

    $("#contrato").blur(function () {    
        contrato = $("#contrato").val();
        
        if  (contrato){         
            $.ajax({
                url: base_url + "consulta/cargaCuentasCon/",
                type:'POST',
                dataType: "json",
                data:{                    
                    contrato: contrato
                },

                success:function(data){
                    if(data.length > 0) {
                        $('#cuenta').html('<option value="">Seleccione...</option>');
                        $(data).each(function(index, value){
                        $('#cuenta').append('<option value="' + value.CUENTA_BANCO_RECEPTOR + '">' + value.CUENTA_BANCO_RECEPTOR + '</option>');
                    });
                        $("#cuenta").val(data.CUENTA_BANCO_RECEPTOR);
                    }
                },                
                error:function(){                   
                    $("#num_identif").val(num_identif);                                   
                }
            });
        }  else{ 
            if  (!num_identif){
                 $('#cuenta').html('<option value="">Seleccione...</option>');
                 $("#cuenta").val('');
             }
        }
    });
		
});
	