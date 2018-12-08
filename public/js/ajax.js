$(document).ready(function(){
    $('#add_student').click(function(){
        $("#student_form").submit();
    })
    $("#student_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/add_student',
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success:function(data){
                var response;
                try{
                    response = JSON.parse(data);
                }
                catch(error){
                    console.log('Atbilde no servera nav derīga');
                }
                if(response.error == null){
                    $('.notification > ul > li').text(response.success);
                    $('.notification').fadeIn('fast');
                }
                else{
                    $('.notification > ul > li').text(response.error);
                    $('.notification').fadeIn('fast');
                }
            },
            error:function(error){
                $('.notification > ul > li').text(error.responseText);
                $('.notification').fadeIn('fast');
            }
        })
    })
    $("#add_lecture").click(function(){
        var title = $('input[name="title"]').val(),
            description = $('#description').val(),
            visited = [],
            skiped= [];
            $.each($('.attended > .student'), function(index, element){
                var student = {
                        value:null,
                        surname:null
                    };
                student.value = $(element).attr('value');
                student.surname = $(element).attr('surname');
                visited.push(student);
            })
            $.each($('.skiped > .student'), function(index, element){
                var student = {
                        value:null,
                        surname:null
                    };
                student.value = $(element).attr('value');
                student.surname = $(element).attr('surname');
                skiped.push(student);
            })
        $.ajax({
            url:'/add_lecture',
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                title:title,
                description:description,
                visited:visited,
                skiped:skiped
            },
            success:function(data){
                var response;
                try{
                    response = JSON.parse(data);
                }
                catch(error){
                    console.log('Atbilde no servera nav derīga');
                }
                if(response.error == null){
                    $('.notification > ul > li').text(response.success);
                    $('.notification').fadeIn('fast');
                }
                else{
                    $('.notification > ul > li').text(response.error);
                    $('.notification').fadeIn('fast');
                }

            },
            error:function(error){
                $('.notification > ul > li').text(error.responseText);
                $('.notification').fadeIn('fast');
            }
        })
    })
})