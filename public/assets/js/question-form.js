$(function () {

    var inputsSelector = '.question-options input',
        defaultOptionClass = '.question-default-option',
        $default = $(defaultOptionClass);

    function update_default_options() {

        console.log('update');

        var $inputs = $(inputsSelector);

        $(defaultOptionClass+' option').remove();

        $inputs.each(function () {

            var val = $(this).val(),
                selected = $default.attr('data-selected') == val ? 'selected' : '';

            if(val)
                $default.append('<option '+selected+' value="'+val+'">'+val+'</option>');

        });

    }

    update_default_options();

    $('body').delegate(inputsSelector, 'blur ', function () {
        update_default_options();
    });

    $default.change(function () {
        $(this).attr('data-selected', $(this).val());
    });

    $('.add-option').click(function () {
        $('.question-options').append(questionOptionHtml);
        update_default_options();
    });

    $('.question-options').delegate('.remove-option', 'click', function () {
        $(this).closest('.row').remove();
        update_default_options();
    });




});