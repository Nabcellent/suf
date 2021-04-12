
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
                                    'Your file has been deleted.',
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
