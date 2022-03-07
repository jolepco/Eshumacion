$(document).ready(function(){

    $(".actualizarVisorAction").click(function() {                   
        $("#visorPdf").attr('src', $(this).attr('title'));            
    });

    $("#btn_seguimiento").click(function () {
		$('#modalseguimiento').modal('show');

	});
	
	$("#tabla_tramites").DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
	});
	
	$("#resultado_validacion").change(function(){
        if($("#resultado_validacion").val() != ''){
			
			$("#div_obs_resultado").show();
			$("#div_preliminar").show();	
			$("#preliminar").show();			
			
			if($("#resultado_validacion").val() == 7 || $("#resultado_validacion").val() == 8){
				$("#div_acta").show();
			}else{
				$("#div_acta").hide();
			}

			if($("#resultado_validacion").val() == 4 || $("#resultado_validacion").val() == 6){
				$("#div_preliminar").hide();
			}
			
        }else{
            $("#div_obs_resultado").hide();
			$("#div_preliminar").hide();
        }
	});
	
	/*$('#observaciones').trumbowyg({
		lang: 'es'
	});*/

	/*$('.multipleSelect').select2({
        width: '100%' // need to override the changed default
    });*/

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
	
	$('#addRow').click(function () {

		var rowCount = $('#mainTable tr').length;
		
		var clonedRow = jQuery('#mainTable > tbody > tr:first').clone(true).appendTo("#mainTable tbody");;

		clonedRow.find("#sede_campo-1").attr("id","sede_campo-" + (rowCount + 1)).attr("name","sede_campo-" + (rowCount + 1));
		clonedRow.find("#areas-1").attr("id","areas-" + (rowCount + 1)).attr("name","areas-"+(rowCount + 1)+"[]");
		var totalCampos = $('#mainTable tr').length;
		$("#total_campos_accion").val(totalCampos);
	});
	
	$('#removeRow').click(function () {

		var rowCount = $('#mainTable tr').length;

		if(rowCount >= 2){
			$("#mainTable tr:last").remove();
		}else{
			alertify.error('No es posible eliminar esta fila');
		}

		var totalCampos = $('#mainTable tr').length;
		$("#total_campos_accion").val(totalCampos);
	});

	$('#addRowNatural').click(function () {

		var rowCount = $('#mainTableNatural tr').length;
		
		var clonedRow = jQuery('#mainTableNatural > tbody > tr:first').clone(true).appendTo("#mainTableNatural tbody");;

		//clonedRow.find("#sede_campo-1").attr("id","sede_campo-" + (rowCount + 1)).attr("name","sede_campo-" + (rowCount + 1));
		clonedRow.find("#perfiles-1").attr("id","perfiles-" + (rowCount + 1)).attr("name","perfiles-" + (rowCount + 1));
		clonedRow.find("#areas-1").attr("id","areas-" + (rowCount + 1)).attr("name","areas-"+(rowCount + 1)+"[]");
		var totalCampos = $('#mainTableNatural tr').length;
		$("#total_campos_accion").val(totalCampos);
	});
	
	$('#removeRowNatural').click(function () {

		var rowCount = $('#mainTableNatural tr').length;

		if(rowCount >= 2){
			$("#mainTableNatural tr:last").remove();
		}else{
			alertify.error('No es posible eliminar esta fila');
		}

		var totalCampos = $('#mainTableNatural tr').length;
		$("#total_campos_accion").val(totalCampos);
	});
	
	$('#requiere_visita').click(function () {
		if( $('#requiere_visita').prop('checked') ) {
			$("#div_acta_campo").show();
			$("#div_fecha_campo").show();
			$("#div_doc_visita").show();
		}else{
			$("#div_acta_campo").hide();
			$("#div_fecha_campo").hide();
			$("#div_doc_visita").hide();
		}
	});
	

});
  
function cargarCampos(id){
	
	var id_a_cargar = id.split('-');
	
	$("#areas-" + id_a_cargar[1]).html('');
	$("#perfiles-"+  id_a_cargar[1]+" option:selected").each(function () {

		perfiles = $(this).val();

		$.post( base_url + "sst/cargarCampos", {
			perfiles: perfiles },
		function(data){
			$("#areas-" + id_a_cargar[1]).html(data);			
		});
	});

}