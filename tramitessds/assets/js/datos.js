$(document).ready(function() {

    var $signupForm = $( '#SignupForm' );

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

    var edad = $("#enc_edad").val();
    $( "#enc_fech_nac" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-" +edad+ "y",
        dateFormat: "yy-mm-dd"
    });


$("#dir1, #dir2, #dir3, #dir4, #dir5, #dir6, #dir7, #dir8, #dir9, #dir10, #dir11, #dir12").change(function(){

        var dir1 = $("#dir1").val();
        var dir2 = $("#dir2").val();
        var dir3 = $("#dir3").val();

        if($('input:checkbox[name=dir4]:checked').val() == 'on'){
            var dir4 = 'BIS';
        }else{
            var dir4 = '';
        }

        var dir5 = $("#dir5").val();
        var dir6 = $("#dir6").val();
        var dir7 = $("#dir7").val();
        var dir8 = $("#dir8").val();

        if($('input:checkbox[name=dir9]:checked').val() == 'on'){
            var dir9 = 'BIS';
        }else{
            var dir9 = '';
        }

        var dir10 = $("#dir10").val();
        var dir11 = $("#dir11").val();
        var dir12 = $("#dir12").val();
        var dir13 = $("#dir13").val();

        var direccion_final = dir1 + " " + dir2 + " " + dir3 + " " + dir4 + " " + dir5 + " " + dir6 + " " + dir7 + " " + dir8 + " " + dir9 + " " + dir10 + " " + dir11 + " " + dir12 + " " + dir13;

        $("#dire_usua").val(direccion_final);
    });

    $("#loca_capta").change(function () {
           $("#loca_capta option:selected").each(function () {
            localidad = $(this).val();
            $.post( base_url + "gestor/upzs", {
                loca: localidad },
            function(data){
            $("#upz_capta").html(data);
            });
        });
    })

    $("#enc_sexo").change(function () {
        var edad = $("#enc_edad").val();
        var sexo = $("#enc_sexo").val();

        if(sexo == 'F'){
            $("#div_gestante").show();
            $("#div_mujer").show();
            $("#div_hombre").hide();
        }else{
            $("#div_gestante").hide();
            $("#div_gestantepr").hide();
            $("#div_mujer").hide();
            $("#div_hombre").show();
        }

        //Campos Primera infancia
        $("#div_pi_me1").hide();
        $("#div_pi_me6m").hide();
        $("#div_pi_i1").hide();
        $("#div_pi_e24").hide();
        $("#div_pi_4").hide();
        $("#div_pi_ma2").hide();
        if(edad <= 1){
            $("#div_pi_me1").show();
            $("#div_pi_me6m").show();
        }

        if(edad == 1){
            $("#div_pi_i1").show();
        }

        if(edad >= 2 && edad <= 4){
            $("#div_pi_e24").show();
        }

        if(edad == 4){
            $("#div_pi_4").show();
        }

        if(edad > 2){
            $("#div_pi_ma2").show();
        }

        if(edad <= 5){
            $("#div_imc_ninos").show();
            $("#div_imc").hide();
        }else{
            $("#div_imc_ninos").hide();
            $("#div_imc").show();
        }

        //Campos Infancia
        $("#div_in_1").hide();
        $("#div_in_2").hide();
        $("#div_in_3").hide();

        if(edad >= 6 && edad <= 7){
            $("#div_in_1").show();
        }

        if(edad >= 8 && edad <= 9){
            $("#div_in_2").show();
        }

        if(edad == 11){
            $("#div_in_3").show();
        }

        //Campos Adolescencia
        $("#div_ad_1").hide();
        $("#div_ad_2").hide();
        $("#div_ad_3").hide();

        if(edad == 16){
            $("#div_ad_1").show();
        }

        if(sexo == 'F'){
            $("#div_ad_2").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ad_3").show();
        }

        //Campos juventud
        $("#div_ju_1").hide();
        $("#div_ju_2").hide();

        if(sexo == 'F'){
            $("#div_ju_1").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ju_2").show();
        }

        //Campos adultez
        $("#div_adu_1").hide();
        $("#div_adu_2").hide();
        $("#div_adu_3").hide();
        $("#div_adu_4").hide();
        $("#div_adu_5").hide();

        if(sexo == 'F' && edad >= 50){
            $("#div_adu_1").show();
        }

        if(sexo == 'F'){
            $("#div_adu_2").show();
        }

        if(edad == 45){
            $("#div_adu_3").show();
        }

        if(edad <= 45){
            $("#div_adu_4").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_adu_5").show();
        }

        //Campos vejez
        $("#div_ve_1").hide();
        $("#div_ve_2").hide();
        $("#div_ve_3").hide();

        if(sexo == 'F'){
            $("#div_ve_1").show();
        }

        if(sexo == 'F' && edad <= 69){
            $("#div_ve_2").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_ve_3").show();
        }
    })

    $("#enc_gestante").change(function () {
        var gestante = $(this).val();

        var edad = $("#enc_edad").val();
        var sexo = $("#enc_sexo").val();

        if(gestante == 'Si'){
            $("#div_gestantepr").show();
            $("#div_gestante_puer").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();

            if(edad >= 10 && edad <= 19){
                $("#div_ga1").show();
                $("#div_ga2").show();
            }else{
                $("#div_ga1").hide();
                $("#div_ga2").hide();
            }
        }else if(gestante == 'Puerperio'){
            $("#div_gestante_puer").show();
            $("#div_gestantepr").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();
        }else{
            $("#div_gestantepr").hide();
            $("#div_gestante_puer").hide();

            if(edad <= 5){
                $("#div_pi").show();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 5 && edad <= 11){
                $("#div_pi").hide();
                $("#div_in").show();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 11 && edad <= 17){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").show();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 17 && edad <= 28){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").show();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 28 && edad <= 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").show();
                $("#div_cronicos").hide();
                $("#div_ve").hide();
            }else if(edad > 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").show();
                $("#div_cronicos").hide();
            }

            if(edad >= 45){
                $("#div_cronicos").show();
            }else{
                $("#div_cronicos").hide();
            }
        }

        //Campos Primera infancia
        $("#div_pi_me1").hide();
        $("#div_pi_me6m").hide();
        $("#div_pi_i1").hide();
        $("#div_pi_e24").hide();
        $("#div_pi_4").hide();
        $("#div_pi_ma2").hide();
        if(edad <= 1){
            $("#div_pi_me1").show();
            $("#div_pi_me6m").show();
        }

        if(edad == 1){
            $("#div_pi_i1").show();
        }

        if(edad >= 2 && edad <= 4){
            $("#div_pi_e24").show();
        }

        if(edad == 4){
            $("#div_pi_4").show();
        }

        if(edad > 2){
            $("#div_pi_ma2").show();
        }

        if(edad <= 5){
            $("#div_imc_ninos").show();
            $("#div_imc").hide();
        }else{
            $("#div_imc_ninos").hide();
            $("#div_imc").show();
        }

        //Campos Infancia
        $("#div_in_1").hide();
        $("#div_in_2").hide();
        $("#div_in_3").hide();

        if(edad >= 6 && edad <= 7){
            $("#div_in_1").show();
        }

        if(edad >= 8 && edad <= 9){
            $("#div_in_2").show();
        }

        if(edad == 11){
            $("#div_in_3").show();
        }

        //Campos Adolescencia
        $("#div_ad_1").hide();
        $("#div_ad_2").hide();
        $("#div_ad_3").hide();

        if(edad == 16){
            $("#div_ad_1").show();
        }

        if(sexo == 'F'){
            $("#div_ad_2").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ad_3").show();
        }

        //Campos juventud
        $("#div_ju_1").hide();
        $("#div_ju_2").hide();

        if(sexo == 'F'){
            $("#div_ju_1").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ju_2").show();
        }

        //Campos adultez
        $("#div_adu_1").hide();
        $("#div_adu_2").hide();
        $("#div_adu_3").hide();
        $("#div_adu_4").hide();
        $("#div_adu_5").hide();

        if(sexo == 'F' && edad >= 50){
            $("#div_adu_1").show();
        }

        if(sexo == 'F'){
            $("#div_adu_2").show();
        }

        if(edad == 45){
            $("#div_adu_3").show();
        }

        if(edad <= 45){
            $("#div_adu_4").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_adu_5").show();
        }

        //Campos vejez
        $("#div_ve_1").hide();
        $("#div_ve_2").hide();
        $("#div_ve_3").hide();

        if(sexo == 'F'){
            $("#div_ve_1").show();
        }

        if(sexo == 'F' && edad <= 69){
            $("#div_ve_2").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_ve_3").show();
        }

    })

    $("#depto_naci").change(function () {
           $("#depto_naci option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "gestor/municipios", {
                dpto: departamento },
            function(data){
            $("#muni_naci").html(data);
            });
        });
    })



    if($("#enc_fech_nac").val() != ''){
        fecha = new Date($("#enc_fech_nac").val());
        hoy = new Date();
        edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
        $("#enc_edad").val(edadPaciente);

        var edad = $("#enc_edad").val();
        var sexo = $("#enc_sexo").val();

        var gestante = $("#enc_gestante").val();

        if(gestante == 'Si'){
            $("#div_gestantepr").show();
            $("#div_gestante_puer").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();

            if(edad >= 10 && edad <= 19){
                $("#div_ga1").show();
                $("#div_ga2").show();
            }else{
                $("#div_ga1").hide();
                $("#div_ga2").hide();
            }
        }else if(gestante == 'Puerperio'){
            $("#div_gestante_puer").show();
            $("#div_gestantepr").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();
        }else{
            $("#div_gestantepr").hide();
            $("#div_gestante_puer").hide();

            if(edad <= 5){
                $("#div_pi").show();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 5 && edad <= 11){
                $("#div_pi").hide();
                $("#div_in").show();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 11 && edad <= 17){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").show();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 17 && edad <= 28){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").show();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 28 && edad <= 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").show();
                $("#div_cronicos").hide();
                $("#div_ve").hide();
            }else if(edad > 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").show();
                $("#div_cronicos").hide();
            }

            if(edad >= 45){
                $("#div_cronicos").show();
            }else{
                $("#div_cronicos").hide();
            }
        }

        if(edad <= 5){
            $("#div_imc_ninos").show();
            $("#div_imc").hide();
        }else{
            $("#div_imc_ninos").hide();
            $("#div_imc").show();
        }

        //Campos Primera infancia
        $("#div_pi_me1").hide();
        $("#div_pi_me6m").hide();
        $("#div_pi_i1").hide();
        $("#div_pi_e24").hide();
        $("#div_pi_4").hide();
        $("#div_pi_ma2").hide();
        if(edad <= 1){
            $("#div_pi_me1").show();
            $("#div_pi_me6m").show();
        }

        if(edad == 1){
            $("#div_pi_i1").show();
        }

        if(edad >= 2 && edad <= 4){
            $("#div_pi_e24").show();
        }

        if(edad == 4){
            $("#div_pi_4").show();
        }

        if(edad > 2){
            $("#div_pi_ma2").show();
        }

        //Campos Infancia
        $("#div_in_1").hide();
        $("#div_in_2").hide();
        $("#div_in_3").hide();

        if(edad >= 6 && edad <= 7){
            $("#div_in_1").show();
        }

        if(edad >= 8 && edad <= 9){
            $("#div_in_2").show();
        }

        if(edad == 11){
            $("#div_in_3").show();
        }

        //Campos Adolescencia
        $("#div_ad_1").hide();
        $("#div_ad_2").hide();
        $("#div_ad_3").hide();

        if(edad == 16){
            $("#div_ad_1").show();
        }

        if(sexo == 'F'){
            $("#div_ad_2").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ad_3").show();
        }

        //Campos juventud
        $("#div_ju_1").hide();
        $("#div_ju_2").hide();

        if(sexo == 'F'){
            $("#div_ju_1").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ju_2").show();
        }

        //Campos adultez
        $("#div_adu_1").hide();
        $("#div_adu_2").hide();
        $("#div_adu_3").hide();
        $("#div_adu_4").hide();
        $("#div_adu_5").hide();

        if(sexo == 'F' && edad >= 50){
            $("#div_adu_1").show();
        }

        if(sexo == 'F'){
            $("#div_adu_2").show();
        }

        if(edad == 45){
            $("#div_adu_3").show();
        }

        if(edad <= 45){
            $("#div_adu_4").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_adu_5").show();
        }

        //Campos vejez
        $("#div_ve_1").hide();
        $("#div_ve_2").hide();
        $("#div_ve_3").hide();

        if(sexo == 'F'){
            $("#div_ve_1").show();
        }

        if(sexo == 'F' && edad <= 69){
            $("#div_ve_2").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_ve_3").show();
        }
    }

    $("#enc_fech_nac").change(function () {
        fecha = new Date($("#enc_fech_nac").val());
        hoy = new Date();
        edadPaciente = parseInt((hoy -fecha)/365/24/60/60/1000);
        $("#enc_edad").val(edadPaciente);

        var edad = $("#enc_edad").val();
        var sexo = $("#enc_sexo").val();

        var gestante = $("#enc_gestante").val();

        if(gestante == 'Si'){
            $("#div_gestantepr").show();
            $("#div_gestante_puer").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();

            if(edad >= 10 && edad <= 19){
                $("#div_ga1").show();
                $("#div_ga2").show();
            }else{
                $("#div_ga1").hide();
                $("#div_ga2").hide();
            }
        }else if(gestante == 'Puerperio'){
            $("#div_gestante_puer").show();
            $("#div_gestantepr").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();
        }else{
            $("#div_gestantepr").hide();
            $("#div_gestante_puer").hide();

            if(edad <= 5){
                $("#div_pi").show();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 5 && edad <= 11){
                $("#div_pi").hide();
                $("#div_in").show();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 11 && edad <= 17){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").show();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 17 && edad <= 28){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").show();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 28 && edad <= 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").show();
                $("#div_cronicos").hide();
                $("#div_ve").hide();
            }else if(edad > 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").show();
                $("#div_cronicos").hide();
            }

            if(edad >= 45){
                $("#div_cronicos").show();
            }else{
                $("#div_cronicos").hide();
            }
        }

        if(edad <= 5){
            $("#div_imc_ninos").show();
            $("#div_imc").hide();
        }else{
            $("#div_imc_ninos").hide();
            $("#div_imc").show();
        }

        //Campos Primera infancia
        $("#div_pi_me1").hide();
        $("#div_pi_me6m").hide();
        $("#div_pi_i1").hide();
        $("#div_pi_e24").hide();
        $("#div_pi_4").hide();
        $("#div_pi_ma2").hide();
        if(edad <= 1){
            $("#div_pi_me1").show();
            $("#div_pi_me6m").show();
        }

        if(edad == 1){
            $("#div_pi_i1").show();
        }

        if(edad >= 2 && edad <= 4){
            $("#div_pi_e24").show();
        }

        if(edad == 4){
            $("#div_pi_4").show();
        }

        if(edad > 2){
            $("#div_pi_ma2").show();
        }

        //Campos Infancia
        $("#div_in_1").hide();
        $("#div_in_2").hide();
        $("#div_in_3").hide();

        if(edad >= 6 && edad <= 7){
            $("#div_in_1").show();
        }

        if(edad >= 8 && edad <= 9){
            $("#div_in_2").show();
        }

        if(edad == 11){
            $("#div_in_3").show();
        }

        //Campos Adolescencia
        $("#div_ad_1").hide();
        $("#div_ad_2").hide();
        $("#div_ad_3").hide();

        if(edad == 16){
            $("#div_ad_1").show();
        }

        if(sexo == 'F'){
            $("#div_ad_2").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ad_3").show();
        }

        //Campos juventud
        $("#div_ju_1").hide();
        $("#div_ju_2").hide();

        if(sexo == 'F'){
            $("#div_ju_1").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ju_2").show();
        }

        //Campos adultez
        $("#div_adu_1").hide();
        $("#div_adu_2").hide();
        $("#div_adu_3").hide();
        $("#div_adu_4").hide();
        $("#div_adu_5").hide();

        if(sexo == 'F' && edad >= 50){
            $("#div_adu_1").show();
        }

        if(sexo == 'F'){
            $("#div_adu_2").show();
        }

        if(edad == 45){
            $("#div_adu_3").show();
        }

        if(edad <= 45){
            $("#div_adu_4").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_adu_5").show();
        }

        //Campos vejez
        $("#div_ve_1").hide();
        $("#div_ve_2").hide();
        $("#div_ve_3").hide();

        if(sexo == 'F'){
            $("#div_ve_1").show();
        }

        if(sexo == 'F' && edad <= 69){
            $("#div_ve_2").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_ve_3").show();
        }
    })

    if($("#enc_edad").val() != ''){

        var edad = $("#enc_edad").val();
        var sexo = $("#enc_sexo").val();

        var gestante = $("#enc_gestante").val();

        if(gestante == 'Si'){
            $("#div_gestantepr").show();
            $("#div_gestante_puer").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();

            if(edad >= 10 && edad <= 19){
                $("#div_ga1").show();
                $("#div_ga2").show();
            }else{
                $("#div_ga1").hide();
                $("#div_ga2").hide();
            }
        }else if(gestante == 'Puerperio'){
            $("#div_gestante_puer").show();
            $("#div_gestantepr").hide();
            $("#div_pi").hide();
            $("#div_in").hide();
            $("#div_ado").hide();
            $("#div_juv").hide();
            $("#div_adu").hide();
            $("#div_ve").hide();
            $("#div_cronicos").hide();
        }else{
            $("#div_gestantepr").hide();
            $("#div_gestante_puer").hide();

            if(edad <= 5){
                $("#div_pi").show();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 5 && edad <= 11){
                $("#div_pi").hide();
                $("#div_in").show();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 11 && edad <= 17){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").show();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 17 && edad <= 28){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").show();
                $("#div_adu").hide();
                $("#div_ve").hide();
                $("#div_cronicos").hide();
            }else if(edad > 28 && edad <= 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").show();
                $("#div_cronicos").hide();
                $("#div_ve").hide();
            }else if(edad > 59){
                $("#div_pi").hide();
                $("#div_in").hide();
                $("#div_ado").hide();
                $("#div_juv").hide();
                $("#div_adu").hide();
                $("#div_ve").show();
                $("#div_cronicos").hide();
            }

            if(edad >= 45){
                $("#div_cronicos").show();
            }else{
                $("#div_cronicos").hide();
            }
        }

        if(edad <= 5){
            $("#div_imc_ninos").show();
            $("#div_imc").hide();
        }else{
            $("#div_imc_ninos").hide();
            $("#div_imc").show();
        }

        //Campos Primera infancia
        $("#div_pi_me1").hide();
        $("#div_pi_me6m").hide();
        $("#div_pi_i1").hide();
        $("#div_pi_e24").hide();
        $("#div_pi_4").hide();
        $("#div_pi_ma2").hide();
        if(edad <= 1){
            $("#div_pi_me1").show();
            $("#div_pi_me6m").show();
        }

        if(edad == 1){
            $("#div_pi_i1").show();
        }

        if(edad >= 2 && edad <= 4){
            $("#div_pi_e24").show();
        }

        if(edad == 4){
            $("#div_pi_4").show();
        }

        if(edad > 2){
            $("#div_pi_ma2").show();
        }

        //Campos Infancia
        $("#div_in_1").hide();
        $("#div_in_2").hide();
        $("#div_in_3").hide();

        if(edad >= 6 && edad <= 7){
            $("#div_in_1").show();
        }

        if(edad >= 8 && edad <= 9){
            $("#div_in_2").show();
        }

        if(edad == 11){
            $("#div_in_3").show();
        }

        //Campos Adolescencia
        $("#div_ad_1").hide();
        $("#div_ad_2").hide();
        $("#div_ad_3").hide();

        if(edad == 16){
            $("#div_ad_1").show();
        }

        if(sexo == 'F'){
            $("#div_ad_2").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ad_3").show();
        }

        //Campos juventud
        $("#div_ju_1").hide();
        $("#div_ju_2").hide();

        if(sexo == 'F'){
            $("#div_ju_1").show();
        }

        if(edad >= 10 && edad <= 19 && sexo == 'F'){
            $("#div_ju_2").show();
        }

        //Campos adultez
        $("#div_adu_1").hide();
        $("#div_adu_2").hide();
        $("#div_adu_3").hide();
        $("#div_adu_4").hide();
        $("#div_adu_5").hide();

        if(sexo == 'F' && edad >= 50){
            $("#div_adu_1").show();
        }

        if(sexo == 'F'){
            $("#div_adu_2").show();
        }

        if(edad == 45){
            $("#div_adu_3").show();
        }

        if(edad <= 45){
            $("#div_adu_4").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_adu_5").show();
        }

        //Campos vejez
        $("#div_ve_1").hide();
        $("#div_ve_2").hide();
        $("#div_ve_3").hide();

        if(sexo == 'F'){
            $("#div_ve_1").show();
        }

        if(sexo == 'F' && edad <= 69){
            $("#div_ve_2").show();
        }

        if(sexo == 'M' && edad >= 50){
            $("#div_ve_3").show();
        }
    }


});
