$(document).ready(function () {
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function algunoVacio() {
        var term1 = $("#username").val();
        var term2 = $("#password").val();

        if (term1 == '' || term2 == '') {
            return true;
        } else {
            return false;
        }
    }

    //$(".faqs").niceScroll(".faq_wrapper", { cursorwidth: "6px",autohidemode: false });
    //$(".verifica-lista").niceScroll(".verifica-lista-wrapper", { cursorwidth: "6px",autohidemode: false });

    $('.collapse').on('shown.bs.collapse', function () {
        //$(this).prev().addClass('active-acc');
        $(this).parent().addClass('active-acc');
        //$(".faqs").getNiceScroll().resize();
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        //$(this).prev().removeClass('active-acc');
        $(this).parent().removeClass('active-acc');
    });


    $(".faqs-btn button").click(function(){
        //if( $("#autocomplete").val()=="" ){
            $(".faqs .card").show();
        //}
    });
    /*
    $("#btn_submit").click(function(){
        var email = $("#correo").val();
        if (validateEmail(email)) {
            if (!algunoVacio()) {
                return true;
            } else {
                swal("Error", "Todos los campos son obligatorios.", "error");
                return false;
            }
        } else {
            swal("Error", "Formato de correo nó valido.", "error");
            return false;
        }

    });
    */
    $("#btn_submit").click(function(){
            if (!algunoVacio()) {
                return true;
            } else {
                swal("Error", "Todos los campos son obligatorios.", "error");
                return false;
            }
    });


});
