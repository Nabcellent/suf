$(() => {
    jQuery.validator.setDefaults({
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



    /**
     * *********************************************************    SIGN UP
     */
    $('#register_form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            last_name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            email: {
                required: true,
                email: true,
                remote: 'check-email',
            },
            phone: {
                required: true,
                digits: true,
                maxlength: 9,
                minlength: 9,
                remote: 'check-phone',
            },
            gender: 'required',
            password: {
                required: true,
                minlength: 4
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            first_name: {
                required: 'Please enter your first name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            last_name: {
                required: 'Please enter your last name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address',
                remote: 'This email is already in use.',
            },
            phone: {
                required: 'Please provide your phone number.',
                digits: 'Only numbers are allowed.',
                pattern: 'Invalid phone number',
                remote: 'This phone number is already in use.',
            },
            gender: 'Please choose your gender.',
            password: {
                required: 'Please provide a password.',
                minlength: 'Password must be at least 6 characters.',
            },
            password_confirmation: {
                required: 'Kindly confirm your new password.',
                equalTo: 'Both passwords must be the same.'
            }
        }
    });

    /**
     * *********************************************************    SIGN IN
     */
    $('#login_form').validate({
        rules: {
            email: 'required',
            password: 'required'
        },
        messages: {
            email: 'Your email or phone number is required.',
            password: 'Your password is required.',
        }
    });

    /**
     * *********************************************************    UPDATE PERSONAL DETAILS
     */
    $('#profile-form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            last_name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            phone: {
                required: true,
                digits: true,
                maxlength: 9,
                minlength: 9,
                remote: 'check-phone',
            }
        },
        messages: {
            first_name: {
                required: 'Please enter your first name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            last_name: {
                required: 'Please enter your last name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            phone: {
                required: 'Please provide your phone number.',
                digits: 'Only numbers are allowed.',
                pattern: 'Invalid phone number',
                remote: 'This phone number is already in use.',
            }
        }
    });

    /**
     * *********************************************************    UPDATE PASSWORD
     */
    $('#change-password').validate({
        rules: {
            current_password: 'required',
            password: {
                required: true,
                minlength: 4
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            current_password: 'Please confirm your current password',
            password: {
                required: 'Please provide a new password.',
                minlength: 'Password must be at least 6 characters.',
            },
            password_confirmation: {
                required: 'Kindly confirm your new password.',
                equalTo: 'Your new passwords do not match.'
            }
        }
    });

    $('#edit-profile #change-password input[name="current_password"]').keyup(function() {
        const $inputValue = $(this).val();

        $.ajax({
            data: {current_password: $inputValue},
            type: 'POST',
            url: '/check-password',
            success: (response) => {
                if(response) {
                    $(this).addClass('is-valid');
                    $(this).removeClass('is-invalid');
                } else {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                }
                console.log(response);
            },
            error: () => {
                alert("Error");
            }
        })
    });



    $('#delivery-address-form').validate({
        rules: {
            county: 'required',
            sub_county: 'required',
            address: 'required'
        },
        messages: {
            county: 'Please select your County.',
            sub_county: 'please select your Sub-county.',
            address: 'Please input a small description of where your stay (like; house number, street/drive, estate/court)'
        }
    })
});
