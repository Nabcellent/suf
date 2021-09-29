window.toast = (msg = 'Hello 😁', type = 'success', duration = 7, close = true) => {
    duration *= 1000

    Toastify({
        text: msg,
        duration: duration,
        close: close,
        className: type,
    }).showToast();
}


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




/**=====================================================================================================  ADD PHONE   */
$(document).on('click', '.user-phone', function() {
    let isValid = false;

    $(document).on('keyup', '.swal-input', function() {
        let value = $(this).val();
        let $phoneInput = $('#phone-form input');
        if(!value.match(/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$/)) {
            $phoneInput.removeClass('is-valid');
            $phoneInput.addClass('is-invalid');
            $('#phone-form strong').text('Invalid phone number');
        } else {
            $phoneInput.removeClass('is-invalid');
            $phoneInput.addClass('is-valid');
            $('#phone-form strong').text('');
            isValid = true;
        }
    });

    const fireSweetPhone = () => {
        Swal.fire({
            title: 'Enter Your phone number',
            html: '<form id="phone-form"><div class="input-group">\n' +
                '      <div class="input-group-prepend">' +
                '          <span class="input-group-text">+254</span>' +
                '      </div>' +
                '      <input type="tel" class="form-control swal-input" name="phone" aria-label ' +
                '             placeholder="123456789" pattern="^((?:254|\\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\\+254|0)?(77[0-6][0-9]{6})$)$">' +
                '  <span class="invalid-feedback" role="alert"><strong></strong></span></div>' +
                '</form>',
            inputAttributes: {
                autocapitalize: 'off',
                required: true
            },
            showCancelButton: true,
            confirmButtonText: 'ADD',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const phone = $('#phone-form input');
                if(!isValid) {
                    phone.addClass('is-invalid');
                    $('#phone-form strong').text('The phone number is invalid. (hint: it must be 9 digits omitt the leading 0)');
                    return false;
                }
                const data = {
                    phone: phone.val(),
                };

                if(typeof $(this).data('id') !== 'undefined') {
                    data.id = $(this).data('id');
                }

                return $.ajax({
                    data: data,
                    type: 'PATCH',
                    url: '/add-phone',
                    success: (response) => {
                        return response;
                    }, error: () => {
                        Swal.fire({
                            text: 'Something went wrong. Please contact @Lè_•Çapuchôn✓🩸',
                            footer: '<a href="mailto:su-fashion10@gmail.com">su-fashion10@gmail.com</a>'
                        });
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if(typeof result.value !== 'undefined') {
                    if(result.value.status) {
                        Swal.fire({
                            icon: 'success',
                            text: result.value.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        if(result.value.message === 'The phone has already been taken.' || 'The phone format is invalid.') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops!',
                                text: result.value.message,
                            }).then(() => {
                                fireSweetPhone();
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops!',
                                text: result.value.message,
                            });
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Sorry!',
                        text: 'Something went wrong. Please contact @Lè_•Çapuchôn✓🩸',
                        footer: '<a href="mailto:su-fashion10@gmail.com">su-fashion10@gmail.com</a>'
                    });
                }
            }
        });
    }

    fireSweetPhone();
});




/**
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    VALIDATIONS
 * */

/***********************************************************    UPDATE PASSWORD    */
$('form.change-password').validate({
    rules: {
        current_password: {
            required: true,
            remote: '/check-password'
        },
        password: {
            required: true,
            minlength: 7
        },
        password_confirmation: {
            required: true,
            equalTo: '#password'
        }
    },
    messages: {
        current_password: {
            required: 'Please confirm your current password',
            remote: 'This password is incorrect.'
        },
        password: {
            required: 'Please provide a new password.',
            minlength: 'Password must be at least 7 characters.',
        },
        password_confirmation: {
            required: 'Kindly confirm your new password.',
            equalTo: 'Your new passwords do not match.'
        }
    }
});
