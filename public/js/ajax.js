$(document).ready(function(){
    $('#add_student').click(function(){
        $("#student_form").submit();
    })
    $("#student_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/ajax_handler',
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
                    //Ajax call to get last added student or page refresh and let laravel add student to list
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