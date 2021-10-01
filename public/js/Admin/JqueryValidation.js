$(() => {
    /**
     * *********************************************************    SIGN UP
     */
    $('#register_seller').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            last_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            username: {
                required: true,
                minlength: 3,
                remote: '/check-username',
            },
            email: {
                required: true,
                email: true,
                remote: '/check-email',
            },
            phone: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 12,
                remote: '/check-phone',
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
                minlength: 'Last name should be more than 3 characters long.',
                alphaSpecial: true
            },
            last_name: {
                required: 'Please enter your last name.',
                minlength: 'Last name should be more than 3 characters long.',
                alphaSpecial: true
            },
            username: {
                required: 'Please enter a username of your choice.',
                minlength: 'minimum required length is 3',
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
                pattern: 'Invalid phone number.🤒',
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
     * *********************************************************    CREATE PRODUCT
     */

    $('form#create_product').validate({
        rules: {
            title: 'required',
            brand_id: 'required',
            seller: 'required',
            category: 'required',
            sub_category: 'required',
            base_price: {
                required: true,
                digits: true
            },
            discount: {
                digits: true
            },
            label: {
                lettersonly: true
            },
        },
        messages: {
            image: {
                accept: 'Only .jpg, .png and .jpeg are allowed',
            }
        }
    });

    /**
     * *********************************************************    UPDATE PRODUCT
     */

    $('form#update_product').validate({
        rules: {
            title: 'required',
            brand_id: 'required',
            seller: 'required',
            category: 'required',
            sub_category: 'required',
            base_price: {
                required: true,
                digits: true
            },
            discount: {
                digits: true
            },
            label: {
                lettersonly: true
            },
        },
        messages: {
            image: {
                accept: 'Only .jpg, .png and .jpeg are allowed',
            }
        }
    });

    $('form#create_variation').validate({
        rules: {
            attribute: {
                required: true,
                remote: {
                    url: '/admin/check-variation',
                    type: 'POST',
                    data: {
                        productId: () => {
                            return $('form#create_variation .product_id').val();
                        },
                    }
                }
            },
            variation_options: 'required',
        },
        messages: {
            attribute: {
                remote: 'This attribute already exists.',
            }
        }
    })

    $('form#create_variation_option').validate({
        rules: {
            variation_id: 'required',
            variant: {
                required: true,
                lettersonly: true,
                remote: {
                    url: '/admin/check-variation-option',
                    type: 'POST',
                    data: {
                        variationId: () => {
                            return $('form#create_variation_option #variation_id').val();
                        },
                    }
                }
            },
            stock: {
                digits: true
            },
            extra_price: {
                digits: true
            }
        },
        messages: {
            variant: {
                lettersonly: 'Provide one word containing letters only please.',
                remote: 'This option already exists.',
            }
        }
    })

    $('form#create_product_image').validate({
        rules: {
            images: 'required',
        },
        messages: {
            images: {
                accept: 'Only .jpg, .png and .jpeg are allowed',
            }
        }
    })

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
            first_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            last_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            username: {
                required: true,
                minlength: 3,
                remote: '/check-username',
            },
            email: {
                required: true,
                email: true,
                remote: '/check-email',
            },
            phone: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 12,
                remote: '/check-phone',
            },
            national_id: {
                required: true,
                digits: true,
                minlength: 8,
                maxlength: 8,
                remote: '/check-national-id',
            },
            gender: 'required',
        },
        messages: {
            first_name: {
                required: 'Please enter a first name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            last_name: {
                required: 'Please enter a last name.',
                minlength: 'Last name should be more than 3 characters long.'
            },
            username: {
                required: 'Please provide a username for this seller.',
                minlength: 3,
                remote: 'This username has been taken',
            },
            email: {
                required: 'Please enter a email address',
                email: 'Please enter a valid email address',
                remote: 'This email is already in use.',
            },
            phone: {
                required: 'Please provide a phone number.',
                digits: 'Only numbers are allowed.',
                pattern: 'Invalid phone number',
                remote: 'This phone number is already in use.',
            },
            national_id: {
                required: 'Please provide a valid ID number.',
                minlength: 'Please enter no less than 8 numbers.',
                remote: 'This ID number is already in use.',
            },
            gender: 'Please choose a gender.',
        }
    });



    /**
     * *********************************************************    UPDATE ADMIN
     */
    $('form#update_profile').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            last_name: {
                required: true,
                minlength: 3,
                alphaSpecial: true
            },
            username: {
                minlength: 3,
                remote: '/check-username',
            },
        },
        messages: {
            username: {
                required: 'Please provide a username for this seller.',
                minlength: 3,
                remote: 'This username has been taken',
            },
        },
        submitHandler: function() {
            let data = $($(this)[0].currentForm).serialize(),
                loader = $('#loader');

            $.ajax({
                data,
                type: 'PUT',
                url: 'profile',
                beforeSend: () => loader.show(),
                statusCode: {
                    200: (responseObject) => {
                        if(responseObject.status) {
                            $('#profile .alert').hide(30);

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: responseObject.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            let errors = '';

                            responseObject.messages.forEach(error => {
                                errors += '<li>' + error + '</li>'
                            });

                            $('#profile .alert').show(30);
                            $('#profile .alert ul').html(errors);
                        }
                    }
                },
                error: () => toast('something went wrong', 'danger'),
                complete: () => loader.hide(),
            })
        }
    });
});
