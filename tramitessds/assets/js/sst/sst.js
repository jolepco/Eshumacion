$(document).ready(function(){

    if($("#tipo_usuario").val() == 5){
        alertify.confirm('Renovación de licencias', 'El trámite de licencia para persona jurídica debe realizarlo en el ente territorial donde se encuentre el domicilio de la institución, de lo contrario será anulado. <br>El domicilio de la persona jurídica es Bogotá?', function(){ 
        }, function(){ 
            $("#div_modificacion").hide();			
            $("#div_renovacion").hide();	
            $("#div_pj").hide();
            $("#div_pn").hide();
            alertify.error('No es posible continuar con el trámite')
        }).set('labels', {ok:'Si', cancel:'No'}); 
    }else{
        if($("#formsst_usuario").length > 0){
            alertify.alert('Estimado Ciudadano', 'Para su comodidad realice el trámite en el ente territorial donde reside o realizo sus estudios, de lo contrario podrá ser anulado.', function(){ });
        }
    }

    
    $("#alert_modificacion").click(function(){
       
        var html = 'Favor adjuntar como soporte de la modificación según lo seleccionado en motivo de modificación:<br><br>';
        html += '<ul>';
        html += '<li>Cambio de Representante legal o razón social: Cámara de Comercio y CC del Representante legal</li>';
        html += '<li>Cambio de Dirección: Cámara de comercio donde se evidencie la nueva dirección</li>';
        html += '<li>Nueva sede o cierre sede: Cámara de comercio donde se evidencie las sedes con sus respectivas direcciones</li>';
        html += '<li>Adición o Supresión de campo: Anexo Recurso humano diligenciado</li>';
        html += '</ul>';
        alertify.alert('Ayuda', html);
    });

    $("#div_pn").hide();
    $("#div_pj").hide();
    $("#div_postgrado").hide();
    $("#div_pregrado").hide();
    $("#div_convalidacion").hide();	

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

        var tipo_usuario = $("#tipo_usuario").val();
        if(tipo_usuario == 5){
            $("#div_pj").show();
        }else{
            $("#div_pn").show();
        }

        
        if($(this).val() == 1){  
            
        }else if($(this).val() == 2){
			$("#div_modificacion").show();			
        }else if($(this).val() == 3){

            alertify.confirm('Renovación de licencias', 'La licencia que desea renovar debe pertenecer a Bogotá. De lo contrario debe contactar el ente territorial correspondiente. <br>La licencia a renovar pertenece a Bogotá?', function(){ 
                $("#div_renovacion").show();	
            }, function(){ 
                $("#div_renovacion").hide();	
                $("#div_pj").hide();
                $("#div_pn").hide();
                alertify.error('No es posible continuar con el trámite')
            }).set('labels', {ok:'Si', cancel:'No'}); 
                
        }
        
    });

    $("input[name=labora_actual]:radio").change(function () {
      
        if($(this).val() == 1){           
			$("#div_empresa").show();	
        }else{
			$("#div_empresa").hide();			
        }
        
    });

    $("#tipo_programa").change(function(){

        $("#div_titulo_postgrado").hide();	
        $("#div_postgrado").hide();	
        $("#div_pregrado").hide();	
        $("#div_mensaje_postgrado").hide();
        $("#div_tipo_profesional").hide();		

        //postgrado
        if($(this).val() == '1'){
            $("#div_postgrado").show();	
            $("#div_titulo_postgrado").show();	
            $("#div_pregrado").show();
            $("#div_mensaje_postgrado").show();	
            $("#div_tipo_profesional").show();	
            $("#div_text_pregrado").text('PDF Título Pregrado');	
        }else if($(this).val() == '2'){
            $("#div_pregrado").show();	
            $("#div_mensaje_postgrado").hide();	
            $("#div_tipo_profesional").show();	
            $("#div_text_pregrado").text('PDF Título Pregrado');	
        }else if($(this).val() == '3'){
            $("#div_pregrado").show();	
            $("#div_tipo_profesional").hide();	
            $("#div_text_pregrado").text('PDF Título Tecnólogo');	
        }else if($(this).val() == '4'){
            $("#div_pregrado").show();	
            $("#div_tipo_profesional").hide();	
            $("#div_text_pregrado").text('PDF Título Técnico Profesional');	
        }
    });

    $("#tipo_profesional").change(function(){
        $("#div_otro_tipo_profesional").hide();	

        if($(this).val() == '4'){
            $("#div_otro_tipo_profesional").show();	
        }else{
            $("#div_otro_tipo_profesional").hide();	
        }
    });
    
    $("#tipo_titulo").change(function(){
        $("#div_convalidacion").hide();	
        //postgrado
        if($(this).val() == '1'){
            $("#div_convalidacion").hide();	
        }else{
            $("#div_convalidacion").show();	
        }
    });
    

    $("#depto_empresa").change(function () {

        $("#depto_empresa option:selected").each(function () {

            departamento = $(this).val();

            $.post( base_url + "sst/datosMunicipios", {
                departamento: departamento },
            function(data){
                $("#mpio_empresa").html(data);
            });
        });
    });

    $("#depto_lic_anterior").change(function () {

        $("#depto_lic_anterior option:selected").each(function () {

            departamento = $(this).val();

            $.post( base_url + "sst/datosMunicipios", {
                departamento: departamento },
            function(data){
                $("#mpio_lic_anterior").html(data);
            });
        });
    });

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

    $('.multipleSelect').select2({
        width: '100%' // need to override the changed default
    });

    $("#perfiles").change(function () {
        $("#areas").html('');
        $("#perfiles option:selected").each(function () {

            perfiles = $(this).val();

            $.post( base_url + "sst/cargarCampos", {
                perfiles: perfiles },
            function(data){
                $("#areas").html(data);
            });
        });
    });

});
  
  
  
  