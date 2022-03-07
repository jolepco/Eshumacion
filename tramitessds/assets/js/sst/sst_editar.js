$(document).ready(function(){

    

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
			$("#div_renovacion").show();			
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

});
  
  
  
  