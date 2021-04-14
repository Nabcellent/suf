$(() => {
    /**==============================================================================  AJAX CSRF TOKEN   */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});



/**==================================================================================================  PRODUCT PAGE   */

/**==============================================================================  Pagination   */
$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    let ajaxUrl = '/products?page=' + page;
    getProducts(ajaxUrl);
});

/**==============================================================================  Sorting   */
$(document).on('change', '#products #sort_by', function() {
    let ajaxUrl = '/products?page=1';
    getProducts(ajaxUrl);
});

/**==============================================================================  Filter Categories   */
$(document).on('click','.product_check',function() {
    getProducts('/products');
});

/**=======================================================================  Change Products Per Page   */
$(document).on('change', '#products nav #per_page',() => {
    getProducts('/products', );
});

const getProducts = (url) => {
    $('#loader').show();
    let sort = $('#products #sort_by').val();
    let perPage = parseInt($('#products nav #per_page').val());

    let category = getFilterText('category');
    let subCategory = getFilterText('sub_category');
    let seller = getFilterText('seller');
    let brand = getFilterText('brand');

    let categoryId = location.href.split('/products/')[1];

    $.ajax({
        data: {
            sort:sort,
            categoryId: categoryId,
            perPage:perPage,
            category:category,
            subCategory:subCategory,
            seller:seller,
            brand:brand,
        },
        type: 'GET',
        url: url,
        success: function(response) {
            $('#product_section').html(response);
            $('#loader').hide();
            /*if(changeHeading) {
                $('#textChange').text('Filtered Products');
            }*/
        }
    })
}

function getFilterText(text_id) {
    let filterData = [];

    $('#'+text_id+':checked').each(function() {
        filterData.push($(this).val());
    });
    return filterData;
}




/**=====================================================================================================  DETAILS PAGE   */

/**=======================================================================  Change Price Per Variation   */
$(document).on('click', '#details input[name^="variant"]', function() {
    let variations = [];
    const productId = $(this).attr('data-id');

    $('#details input[name^="variant"]:checked').each(function() {
        variations.push($(this).val());
    });

    $.ajax({
        data: {
            variations,
            productId
        },
        type:'POST',
        url:'/get-product-price',
        success: (response) => {
            if(response['discount'] > 0) {
                $('#details .variation_price').html(response['discount_price']);
                $('#details del').html(response['unit_price'] + '/=');
            } else {
                $('#details .variation_price').html(response['discount_price']);
            }
        },
        error: () => {
            alert("Error");
        }
    });
});



/**=====================================================================================================  CART PAGE   */

$(document).on('click', '#cart .cart_table td.quantity button', function() {
    const $qtyInput = $(this).parents('td.quantity').find($('input[type="number"]'));
    const newQty = parseInt($qtyInput.val());
    const cartId = $qtyInput.data('id');

    if(newQty > 0) {
        updateCartQty(cartId, newQty);
    } else {
        alert("Error: Quantity must be at least 1!");
    }
});
$(document).on('change', '#cart .cart_table td.quantity input[type="number"]', function() {
    if($(this).val() < 1) {
        $(this).val(1);
        return;
    }

    const newQty = parseInt($(this).val(), 10);
    const cartId = $(this).data('id');

    updateCartQty(cartId, newQty);
});

const updateCartQty = (cartId, newQty) => {
    $.ajax({
        data: {cartId, newQty},
        type: 'POST',
        url: '/update-cart-item-qty',
        success: (response) => {
            $('#cart #cart_table').html(response.view);
            $('.cart_count').html(response.cartCount);
            $('#mega_nav .item_right .cart_total p').html(response.cartTotal + '/=');

            if(!response.status) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Sorryy☹',
                    text: response.message,
                    timer: 5000
                })
            }

            $.cachedScript( "js/jquery.nice-number.js" ).done(function( script, textStatus ) {
                console.log( textStatus );
            });
            $.cachedScript( "js/main.js" ).done(function( script, textStatus ) {
                console.log( textStatus );
            });
        },
        error:() => {
            alert("Error");
        }
    });
}



/**=====================================================================================================  ACCOUNT PAGE   */
$(() => {
    const $county = $('#delivery-address form #county');
    if($county.val().trim()) {
        const data = {
            id: $county.val(),
            subCounty: $('#delivery-address form #county :selected').attr('data-subCounty')
        };

        fetchSubCounties(data);
    }
});

$(document).on('click', '#delivery-address form #county', function() {
    const id = $(this).val();
    console.log($(this).is(':selected'));

    fetchSubCounties({id});
});

function fetchSubCounties(data) {


    $.ajax({
        data: data,
        type: 'POST',
        url: '/get-sub-counties',
        statusCode: {
            404: function(responseObject, textStatus, jqXHR) {
                // No content found (404)
                // This code will be executed if the server returns a 404 response
                alert('Not Found');
            },
            200: (responseObject, textStatus) => {
                $('#delivery-address form select[name="sub_county"]').html(responseObject.subCounties);
            },
            503: function(responseObject, textStatus, errorThrown) {
                // Service Unavailable (503)
                // This code will be executed if the server returns a 503 response
                alert('Unavailable');
            }
        },
        error: () => {
            alert('Error: Something went wrong');
        }
    }).done((data) => {
        //alert("Done " + data);
    }).fail((error, textStatus) => {
        alert('Something went wrong: ' + textStatus);
    });
}
