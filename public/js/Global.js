/**********************  -----------------  BOOTSTRAP FILE INPUT   -----------------  **********************/
$(document).on('change', 'input[type="file"]', function(){
    //get the file name
    let fileName = $(this).val().replace('C:\\fakepath\\', "");
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
});

/**********************  -----------------  JQUERY VALIDATION   -----------------  **********************/
//  VALIDATION CONFIGS
jQuery.validator.setDefaults({
    errorClass: 'is-invalid',
    validClass: 'is-valid',
    errorPlacement: function (error, element) {
        error.addClass('error');
        if(element.prop('type') === 'radio') {
            error.insertAfter(element.closest('.form-group'));
        } else if(element.prop('type') === 'file') {
            error.insertAfter(element.closest('div'));
        } else if(element.closest('.input-group').length > 0) {
            error.insertAfter(element.parent('.input-group'));
        } else if(element.hasClass('anime_input')) {
            error.insertAfter(element.closest('label'));
        } else if(element.hasClass('crud_form')) {
            error.insertAfter(element);
        } else if(element.prop('type') === 'checkbox') {
            error.insertAfter(element.closest('.form-group'));
        } else {
            error.insertAfter(element);
        }
    }
});

//  ADDITIONAL METHODS
jQuery.validator.addMethod("alphaSpecial", function(value, element) {
    return this.optional(element) || /^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i.test(value);
}, "Letters, apostrophes and dots only please.");
