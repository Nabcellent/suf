
$(() => {
    /**
     * *********************************************************    VALIDATION CONFIGS
     */
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
    $('#register_seller').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            username: {
                required: true,
                minlength: 3,
                remote: 'check-username',
            },
            email: {
                required: true,
                email: true,
                remote: 'check-email',
            },
            phone: {
                required: true,
                digits: true,
                maxlength: 10,
                minlength: 10,
                remote: 'check-phone',
            },
            national_id: 'required',
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
            username: {
                required: 'Please enter a username of your choice.',
                minlength: 3,
                remote: 'This username has been taken',
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
     * *********************************************************    ADD PRODUCT
     */

    $('#frm_add_product').validate({
        rules: {
            title: 'required',
            brand_id: 'required',
            seller: 'required',
            category: 'required',
            sub_category: 'required',
            base_price: 'required',
            main_image: 'required',
        }
    });

    /**
     * *********************************************************    ADD CATEGORY
     */

    $('form#add_category').validate({
        rules: {
            category_title: 'required',
            sections: 'required',
            'sections[]': 'required',
            section: 'required',
        }
    });

    /**
     * *********************************************************    ADD CATEGORY
     */

    $('form#add_sub_category').validate({
        rules: {
            sub_category_title: 'required',
            sections: 'required',
            section: 'required',
        }
    });


    /**
     * *********************************************************    CREATE ADMIN
     */

    $('form#create_admin').validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            email: 'required',
            phone: 'required',
            national_id: 'required',
            gender: 'required',
        },
        messages: {
            phone: {
                pattern: 'Invalid phone number'
            }
        }
    });
});
