/* 

ALL FUNCTIONS THAT IS DEFINED HERE IS ONLY USED AFTER SUCCESS AJAX CALL ON CREATING STUDENT 

*/

function add_student_drag_drop(){
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
}

function add_student_details_slide(){
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
}