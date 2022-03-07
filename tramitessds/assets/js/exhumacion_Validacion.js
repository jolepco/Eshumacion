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

    var $signupForm = $('#form_tramite');

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
    
     $("#fecha_inh").datepicker({
        changeMonth: true,
        changeYear: true,
        defaultDate: "-0y",
        dateFormat: "yy-mm-dd"
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

