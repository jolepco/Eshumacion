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

    var $signupForm = $('#solicitudLiEXH');

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

    $signupForm.submit(function() {
        var $resultado=$signupForm.validationEngine("validate");

        if ($resultado) {

            return true;
        }
        return false;
    });
// Ajuste a JS para creación y edición del trámite de licencia de exhumación persona juridica. por mebeltran@saludcapital.gov.co
    $("#razonsocial, #p_nombrerl, #s_nombrerl, #p_apellidorl, #s_apellidorl, #otrodocumentofallecido, #aliasfallecido, #otrodocumentofallecido, #p_nombrefallecido, #s_nombrefallecido, #p_apellidofallecido, #s_apellidofallecido, #nombrecementerio").on("keypress", function () {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);

    });

     $( "#fechaInh" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
    });

     $( "#fechaInh2" ).datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        //defaultDate: "1998-12-31",
        //maxDate: new Date(1998,12-1,31),
        dateFormat: "yy-mm-dd"
    });

    $( "#fechaInh3" ).datepicker({
      changeMonth: true,
      changeYear: true,
      defaultDate: "-0y",
      dateFormat: "yy-mm-dd"
  });

    $("#depa_cementerio").change(function () {
           $("#depa_cementerio option:selected").each(function () {
            departamento = $(this).val();
            $.post( base_url + "login/datosMunicipios", {
                departamento: departamento },
            function(data){
                $("#ciudad_cementerio").html(data);
            });
        });
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

	$( "#fechaInh" ).change(function () {

		if($( "#fechaInh" ).val() > factual){
			alertify.alert("Novedad en Fecha Licencia de Inhumación","La fecha ingresada " + $( "#fechaInh" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fechaInh" ).val("");
		}
    });

	$( "#fechaInh2" ).change(function () {

		if($( "#fechaInh2" ).val() > factual){
			alertify.alert("Novedad en Fecha Licencia de Inhumación","La fecha ingresada " + $( "#fechaInh2" ).val() + " no puede ser mayor a la actual " + factual);
			$( "#fechaInh2" ).val("");
		}
    });
});

$(document).on('change','input[type="file"]',function(){
    // this.files[0].size recupera el tamaño del archivo
    // alert(this.files[0].size);

    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if(fileSize > 5000000){
       // alert('El archivo no debe superar los 5MB');
      $('#respuestaMensaje').html("El tamaño/peso del archivo que intenta adjuntar no es valido. Tenga en cuenta que el tamaño/peso del archivo a registrar no puede superar las CINCO (5) MB.");
                        $('#myModal').modal('show');

        this.value = '';
        this.files[0].name = '';
    }else{
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();

        // console.log(ext);
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf': break;
            default:
                //alert('El archivo no tiene la extensión adecuada');
                $('#respuestaMensaje').html("El formato del archivo seleccionado NO es valido. Tenga en cuenta que los únicos formatos (extensiones) de archivo permitidos por el sistema son:  [.pdf].");
                        $('#myModal').modal('show');
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }

$('input[name="pdf_certificado_per3"]').change(function(){
   var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
   var doc3 = $('input[name="pdf_certificado_per3"]')[0].files[0]['name']
   if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                        this.files[0].name = '';

       }
})

$('input[name="pdf_certificado_per4"]').change(function(){
   var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
   var doc3 = $('input[name="pdf_certificado_per3"]')[0].files[0]['name']
   if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                        this.files[0].name = '';

       }
})




/*$('input[name="pdf_certificado_per3"]').change(function(e){
            var doc3 = e.target.files[0].name;
       var doc4 = $('input[name="pdf_certificado_per4"]')[0].files[0]['name']
       //alert(doc4);console.log(doc4)
       if(doc3 !='' && doc4 !=''){
        $('#respuestaMensaje').html("Solo se debe cargar una opción: 'En caso que el fallecido sea mayor de 7 años o En caso que el fallecido sea menor de 7 años' ");
                        $('#myModal').modal('show');
                        this.value = ''; // reset del valor
                this.files[0].name = '';

       }
    });*/


});
