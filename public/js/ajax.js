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
                console.log(response);
            },
            error:function(){

            }
        })
    })
})