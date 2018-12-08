$(document).ready(function(){
    $('.close').click(function(){
        $(this).parent('.notification').fadeOut('fast', function(){
            $('.message').text('');
        })
    })
    $('.modal').on('hidden.bs.modal', function () {
        $('.notification').hide();
        $(".message").text('');
    })
    $('.student').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).children('.details').slideUp('fast');
        }
        else{
            $(this).addClass('active');
            $(this).children('.details').slideDown('fast');
        }
    })
    $('.show_attendance').click(function(){//Animācija lago
        if($(this).hasClass('active')){
            $(this).siblings('.attendance').slideUp('fast');
            $(this).removeClass('active');
        }
        else{
            $(this).siblings('.attendance').slideDown('fast');
            $(this).addClass('active');
        }
    })
});