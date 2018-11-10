$(document).ready(function(){
    /*confirm delete item*/
    $('.delete-item').click(function(){
        if(confirm("Bạn có chắc xóa Item này?")) return true;
        else return false;
    })
    /* call menu */
    try{
        $.slidebars({
            disableOver: 768,
            hideControlClasses: true
        });
    }
    catch (e){
    }

    /*js toglle action location */
    $(window).scroll(function() {

        if ($("#ctrl-scoll").offset().top > 420) {
            $("#box-ctrl").show(200);
        }
        else{
            $("#box-ctrl").hide(200);
            /*$("#box-ctrl").removeClass('show-box');*/
        }
    });

    //show hide tab
    $('.box-toggle span.drop-item:first').addClass('active');
    $('.box-toggle .content:first').show().addClass('active');
    $('.box-toggle span.drop-item:last').addClass('last');
    $(".box-toggle span.drop-item").click(function(){
        var parent = $(this).parent();
        if(!$(this).hasClass('active')){
            $('.box-toggle span.drop-item').removeClass('active');
            $(this).addClass('active');
            $('.content-toggle').hide().removeClass('active');
            $('.content-toggle', parent).show().addClass('active');
        } else {
            $(this).removeClass('active');
            $('.content-toggle', parent).hide().removeClass('active');
        }
    });

});