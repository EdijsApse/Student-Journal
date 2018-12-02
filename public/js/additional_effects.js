$(document).ready(function(){
    $('.add_student').click(function(){
        $('.right').css('z-index', '0');
    })
    $('#student_modal').on('hidden.bs.modal', function () {
        $('.right').css('z-index', '9999');
    })
});