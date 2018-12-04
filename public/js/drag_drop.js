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
    //Drag and drop for files
    $(window).on('drop', function(e){
        e.preventDefault();
    });
    $(window).on('dragover', function(e){
        e.preventDefault();
    });
    //Disabling window's events so browser wont open file
    $("#student_image").on('dragover', function(e){
        e.preventDefault();
        $(this).css('background-color', '#CCC');
    });
    $("#student_image").on('dragleave', function(){
        $(this).css('background-color', '#FFF');
    })
    $('#student_image').on('drop', function(e){
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files,//Droped file
            file_type,
            temp_path;
        temp_path = URL.createObjectURL(files[0]);//To get temp files path emiting files location (vilto faila atrašanās vietu)
        $(this).css('background-color', '#FFF');
    if(files.length > 1){
        alert('Vairāk par vienu failu');
    }
    else{
        file_type = files[0].type.split('/');//Spliting type into array (type always will be image/jpeg u.t.t)
        if(file_type[0] == 'image'){//Arrays 0 element is files type (image, text, video ...)
            $("#student_image > img").attr('src', temp_path);
            $("#student_image > img").fadeIn('slow');
            $("#upload_image").fadeOut('fast');
            //Zemākā rinda noseto inputa lauka vērtību kā failu, savādāk ajax'i nevar piekļūt ja bilde ir ievilkta
            $("input[type='file']").prop("files", files);
        }
        else{
            alert('Nav bilde');
        }
    }
    });
    //Drag and drop for image upload ends
    $("#file_upload").change(function(e){//If image is selected, if so, user still can drop file into
        var temp_path = URL.createObjectURL(e.target.files[0]),
        file_type;
        file_type = e.target.files[0].type.split('/');
        if(file_type[0] == 'image'){
            $("#student_image > img").attr('src', temp_path);
            $("#student_image > img").fadeIn('slow');
            $("#upload_image").fadeOut('fast');
        }
        else{
            alert('Nav bilde');
        }
    });
})