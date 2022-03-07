$(document).ready(function () {

    //Script para activación de menú

    $('#btnMenu').click(function () {
        $('#menuMobile').addClass('menu-active');
        $('#backgroundMenu').css('display', 'block');
    });

    $('#closeMenu').click(function () {
        $('#menuMobile').removeClass('menu-active');
        $('#backgroundMenu').css('display', 'none');
    });

    $('#backgroundMenu').click(function () {
        $('#menuMobile').removeClass('menu-active');
    });


    // Menú identificador
    $(function () {
        var url = window.location.href;

        $(".item-menu").each(function () {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest(".item-menu").addClass("item-active");
                //for making parent of submenu active
                $(this).closest(".item-menu").addClass("item-active");
            }
        });

        $(".item-pc-menu").each(function () {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest(".item-pc-menu").addClass("item-active");
                //for making parent of submenu active
                $(this).closest(".item-pc-menu").addClass("item-active");
            }
        });
    });

    //Calendario fecha de nacimiento

    $(function () {
        $("#datepicker").datepicker();
    });

    //PopUp

    $(function () {
        $(".btnPopUp").click(function () {
            $(".background-popup").fadeIn('100');
            $(".container-popup").fadeIn('250');
        });

        $("#closePopUpbtn").click(function () {
            $(".background-popup").fadeOut('10');
            $(".container-popup").fadeOut('10');
        });        
        $('body').click(function () {
            $(".background-popup").fadeOut('10');
            $(".container-popup").fadeOut('10');
        });
        
        $('.btnPopUp').click(function (e) {
            e.stopPropagation();
        });
        $('.container-popup').click(function (e) {
            e.stopPropagation();
        });
    });
    
    //Menu desplegable del panel de administración
$(function () {
        $('.dd-m-collapsed-btn').click(function() {
           $('.dropdown-m-collapsed').toggleClass('d-block');
           $('.i-anim').toggleClass('rot-anim');
        });
    });
    
    
    
    //Menu desplegable
    $(function () {
        $('.item-btn-dd').click(function() {
           $('.dropdown-m').toggleClass('d-block');
        });
    });
    
    

    //Menu admin

    $(function () {
        $('#hideMenuAdmin').click(function () {
            $('.left-menu').toggleClass('d-none');
            $('.main-container').toggleClass('m-left-0');
        });
    })
    
    //Menu admin movil
    $(function () {
        $('.mvl-act').click(function (){
            $('.left-menu').addClass('swipe-left');
        });
        $('body').click(function (){
           $('.left-menu').removeClass('swipe-left'); 
        });
        $('.mvl-act').click(function(e){
           e.stopPropagation(); 
        });
        $('.left-menu').click(function(e){
           e.stopPropagation(); 
        });
    });
    
    //Menú movil
    $(function () {
        $('.mbl-btn').click(function (){
            $('.menu-mbl').addClass('swipe-left');
        });
        $('body').click(function (){
           $('.menu-mbl').removeClass('swipe-left'); 
        });
        $('.mbl-btn').click(function(e){
           e.stopPropagation(); 
        });
        $('.menu-mbl').click(function(e){
           e.stopPropagation(); 
        });
    });
    

});
