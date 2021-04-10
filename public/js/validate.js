$(() => {
    jQuery.validator.setDefaults({
        errorPlacement: function (error, element) {
            error.addClass('error');
            if(element.prop('type') === 'radio') {
                error.insertAfter(element.closest('.form-group'));
            } else if(element.prop('type') === 'file') {
                error.insertAfter(element.closest('div'));
            } else if(element.is('textarea')) {
                error.insertAfter(element.next());
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
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
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
                equalTo: '#password'
            }
        },
        messages: {
            first_name: 'Please enter your first name.',
            last_name: 'Please enter your last name.',
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address',
                remote: 'This email is already in use.',
            },
            phone: {
                required: 'Please provide your phone number.',
                digits: 'Please enter a valid phone number.',
                pattern: 'Invalid phone number',
                remote: 'This phone number is already in use.',
            },
            gender: 'Please choose your gender.',
            password: {
                required: 'Please provide a password.',
                minlength: 'Password must be at least 6 characters.',
            },
            confirm_password: {
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
    })
})
