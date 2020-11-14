$(function () {

    $('.btn-delete').click(function () {

        if(confirm($(this).data('text')))
            $(this).closest('.card').find('.form-post-delete').submit();

    });


});