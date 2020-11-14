$(function() {
    $('.moderate-link').bind('click', function(e) {
        e.preventDefault();
        var form_id = this.getAttribute('data-form');
        var form_value = this.getAttribute('data-value');

        var form_elem = $('#form-' + form_id);
        var form_action = $('#form-' + form_id + '-action');

        if(confirm($(form_elem).attr('data-text')))
        {
            $(form_action).val(form_value);
            $(form_elem).submit();
        }
    });
})