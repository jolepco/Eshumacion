$( function() {
//************************************************************************
      //* Configura y ajusta todos los calendarios de jQuery en idioma espa�ol
      //************************************************************************
      $.datepicker.regional['es'] = { closeText: 'Cerrar',
                                  currentText: 'Hoy',
                                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'S�bado'],
                                  dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','S&aacute;b'],
                                  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                                  weekHeader: 'Sem',
                                  dateFormat: 'dd/mm/yy',
                                  firstDay: 1,
                                  isRTL: false,
                                  showMonthAfterYear: false,
                                  yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $("#fecha_i").datepicker({
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
       
    	onClose: function (selectedDate) {
      $("#fecha_f").datepicker("option", "minDate", selectedDate);
      }
    });
    $("#fecha_f").datepicker({
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
      onClose: function (selectedDate) {
      $("#fecha_i").datepicker("option", "maxDate", selectedDate);
      }
    });

    $('#tabla_tramites').DataTable({
        language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ registros",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando registros 0 a 0 de 0 registros",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
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
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        },
        responsive: true,
        "order": [[ 0, "DESC" ]],
        "pageLength": 25
    });
} );