
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

    $('#reg_form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            email: 'required',
            phone: {
                required: true,
                maxlength: 10,
                minlength: 9
            },
            id_number: 'required',
            gender: 'required',
            password: 'required',
            confirm_password: {
                equalTo: '#password'
            }
        },
        submitHandler(form) {
            let data = $(form).serialize();

            $.ajax({
                data: data,
                method: 'POST',
                url: '/auth/register',
                success: (response) => {
                    if (response.errors) {
                        $('#reg_form .err_message').html(response.errors[0].msg);
                    } else if (response.success) {
                        $('#reg_form .err_message').html('');
                        location.href = '/auth/sign-in';
                    }
                }
            });
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

    $('#frm_add_category').validate({
        rules: {
            title: 'required',
            sections: 'required',
            section: 'required',
        }
    });
});
