/*function drag_start_function(e){
    $('.attended').css('box-shadow', '0px 0px 3px 1px #006abc');
    $('.skiped').css('box-shadow', '0px 0px 3px 1px #ef2d2e');
}*/
$(document).ready(function(){
    var student,
        attended_styles = {
            'box-shadow':'0px 0px 3px 1px #006abc'
        },
        skiped_styles = {
            'box-shadow':'0px 0px 3px 1px #ef2d2e'
        },
        default_styles = {
            'box-shadow':'0px 0px 2px 0px #999',
            'background-color':'#FFF'
        };
    $(".student").on('mousedown', function(){//If user is clicked but not draging student
        $('.attended').css(attended_styles);
        $('.skiped').css(skiped_styles);
    })
    $(".student").on('mouseup', function(){//If user didnt draged student
        $('.visit').css(default_styles);
    })
    $(".student").on('dragstart', function(){//If user stops draging student
        student = $(this);
    })
    $(".student").on('dragend', function(){//If user stops draging student
        $('.attended').css(default_styles);
        $('.skiped').css(default_styles);
    })
    $(".visit").on('dragover', function(e){
        e.preventDefault();//To allow drop
        if($(this).hasClass('skiped')){
            $(this).css('background-color', 'rgba(239, 45, 46, .1)');
        }
        else{
            $(this).css('background-color', 'rgba(0, 106, 188, .1)');
        }
    })
    $(".visit").on('dragleave', function(){
        $(this).css('background-color', '#FFF');
    })
    $(".visit").on('drop', function(){
        $(this).css('background-color', '#FFF');
        if($(this).hasClass('skiped')){
            $(student).css('background-color','#ef2d2e');
        }
        else{
            $(student).css('background-color','#006abc');
        }
        $(this).append($(student));
    })
})