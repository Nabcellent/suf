/**=====================================================================================================  ADD PHONE   */
$(document).on('click', '.add-phone', () => {
    let isValid = false;
    $(document).on('keyup', '.swal-input', function() {
        let value = $(this).val();
        let $phoneInput = $('#phone-form input');
        if(!value.match(/^(([71])(?:[123569][0-9]|0[0-8]|(4[081])|(3[64]))[0-9]{6})$/)) {
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

    Swal.fire({
        title: 'Enter Your phone number',
        html: '<form id="phone-form"><div class="input-group">\n' +
            '      <div class="input-group-prepend">' +
            '          <span class="input-group-text">+254</span>' +
            '      </div>' +
            '      <input type="tel" class="form-control swal-input" name="phone" aria-label ' +
            '             placeholder="712345678" pattern="^((7|1)(?:(?:[12569][0-9])|(?:0[0-8])|(4[081])|(3[64]))[0-9]{6})$">' +
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

            return $.ajax({
                data: {phone: phone.val()},
                type: 'PATCH',
                url: '/add-phone',
                statusCode: {
                    500: function(responseObject, textStatus, errorThrown) {
                        //console.log(errorThrown);
                    }
                },
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
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops!',
                        text: result.value.message,
                    });
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
});



/**=================================================================================  DELETE CART ITEM FROM TABLE   */

$(document).on('click', '#cart .delete_cart_item', function() {
    const cartId = parseInt($(this).data('id'), 10);

    const result = confirm("Are you sure you want to delete this cart item?");
    if(result) {
        Swal.fire({
            title: 'Are you really sure? 🤧',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {cartId},
                    type: 'POST',
                    url: '/delete-cart-item',
                    success: (response) => {
                        if(response.status) {
                            if(response.cartCount > 0) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your cart item has been deleted.',
                                    'success'
                                );

                                $('#cart #cart_table').html(response.view);
                                $('.cart_count').html(response.cartCount);
                                $('#mega_nav .item_right .cart_total p').html(response.cartTotal + '/=');

                                $.cachedScript( "js/jquery.nice-number.js" ).done(function( script, textStatus ) {
                                    console.log( textStatus );
                                });
                                $.cachedScript( "js/main.js" ).done(function( script, textStatus ) {
                                    console.log( textStatus );
                                });
                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Unable to delete cart Item.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error:() => {
                        alert("Error");
                    }
                });
            }
        });
    }
});



/**=============================================================================  DELETE ADDRESS   */

$(document).on('click', 'form a.delete-address', function() {
    const id = $(this).data('id');
    if(typeof id !== 'undefined') {
        Swal.fire({
            title: 'Are you really sure? 🤧',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '/delete-delivery-address/' + id;
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="/contact-us">Report this issue?</a>'
        })
    }
})



/**=============================================================================  DELETE PHONE   */

$(document).on('click', '#edit-profile .delete-phone', function() {
    const id = $(this).data('id');

    if(typeof id !== 'undefined') {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '/delete-phone/' + id;
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="/contact-us">Report this issue?</a>'
        })
    }
})
