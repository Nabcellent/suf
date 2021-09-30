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
    let ajaxUrl = '/get-filtered-products?page=' + page;
    getProducts(ajaxUrl);
});

/**==============================================================================  Sorting   */
$(document).on('change', '#products #sort_by', function() {
    let ajaxUrl = '/get-filtered-products?page=1';
    getProducts(ajaxUrl);
});

/**==============================================================================  Filter Categories   */
$(document).on('click','.product_check',function() {
    getProducts();
});

/**=======================================================================  Change Products Per Page   */
$(document).on('change', '#per_page',() => {
    getProducts();
});

const getProducts = (url = '/get-filtered-products') => {
    $('#loader').show();
    let sort = $('#products #sort_by').val();
    let perPage = parseInt($('#per_page').val());

    let category = getFilterText('category');
    let subCategory = getFilterText('sub_category');
    let seller = getFilterText('seller');
    let brand = getFilterText('brand');
    let priceRange = [parseInt($('#minPrice').val()), parseInt($('#maxPrice').val())];

    let categoryId = location.href.split('/products/')[1];

    $.ajax({
        data: {
            sort,
            categoryId,
            perPage,
            category,
            subCategory,
            seller,
            brand,
            priceRange,
        },
        type: 'GET',
        url: url,
        success: function(response) {
            $('#product_section').html(response.view);
            $('#productCount span').text(response.count);
            $('#loader').hide();

            if($('.product_check:checked').length > 0) {
                $('#textChange').text('Filtered Products');
            } else {
                $('#textChange').text('All Products');
            }
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




/**==================================================================================================  DETAILS PAGE   */

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
    const element = $(this).parents('td.quantity').find($('input[type="number"]')),
        newQty = parseInt(element.val()),
        cartId = element.data('id');

    (newQty > 0)
        ? updateCartQty(cartId, newQty, element)
        : toast('Quantity must be at least 1!')
});
$(document).on('change', '#cart .cart_table td.quantity input[type="number"]', function() {
    if($(this).val() < 1) {
        $(this).val(1);
        return;
    }

    const newQty = parseInt($(this).val(), 10),
        cartId = $(this).data('id');

    updateCartQty(cartId, newQty, $(this));
});

const updateCartQty = (cartId, newQty, inputElement) => {
    const unitPriceTD = inputElement.closest('.quantity').next(),
        subTotalTD = inputElement.closest('tr').find($('.sub-total')),
        subTotalDiscountTD = inputElement.closest('tr').next().find($('.sub-total-discount')),
        productDiscountTD = inputElement.closest('table').find($('.product-discount'))

    $.ajax({
        data: {cartId, newQty},
        type: 'POST',
        url: '/update-cart-item-qty',
        success: (response) => {
            $('.cart_count').html(response.cartCount);
            $('#mega_nav .item_right .cart_total p').html(response.cartTotal + '/=');

            if(response.status) {
                const {unit_price, discount_price, discount} = response.price,
                    currentProductDiscount = parseInt(productDiscountTD.text().match(/(\d+)/)[0], 10),
                    currentSubTotalDiscount = parseInt(subTotalDiscountTD.text().match(/(\d+)/)[0], 10),
                    newProductDiscount = (currentProductDiscount - currentSubTotalDiscount) + (discount * newQty)

                inputElement.val(newQty)
                unitPriceTD.html(`${unit_price}/-`);
                subTotalTD.html(`${discount_price * newQty}/-`)
                subTotalDiscountTD.html(`${discount * newQty}/-`)
                productDiscountTD.html(`KES.${newProductDiscount}/-`)
                toast(response.message)
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Sorryy☹',
                    text: response.message,
                    timer: 5000
                })
            }
        },
        error:() => toast("Oops! something isn't right", 'danger')
    });
}



/**=====================================================================================================  ACCOUNT PAGE   */
$(() => {
    const $county = $('#delivery-address form #county');
    if($county.length && $county.val().trim()) {
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
        success: response => $('#delivery-address form select[name="sub_county"]').html(response.subCounties),
        error: () => toast('Error: Something went wrong', 'error'),
    });
}
