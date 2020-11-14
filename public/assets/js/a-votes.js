$(function() {
    $('.button-winner').bind('click', function(event) {
        event.preventDefault();

        var option_id   = $(this).data('option');
        var post_id     = $(this).data('post');

        var form_elem   = $('#form-' + post_id);

        if (confirm($(form_elem).data('text')))
        {
            $('#form-' + post_id + '-option').val(option_id);
            $(form_elem).submit();
        }
    });
});