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
