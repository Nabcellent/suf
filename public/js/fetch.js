$(() => {
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let ajaxUrl = '/products/get-products?page=' + page;
        getProducts(ajaxUrl);
    });
});

/**==============================================================================  Filter Categories   */

$(document).on('click','.product_check',function() {
    getProducts('/products/get-products', true);
});

/**=======================================================================  Change Products Per Page   */
$(document).on('change', '#products nav #per_page',() => {
    getProducts('/products/get-products', );
})


const getProducts = (url, changeHeading = false) => {
    $('#loader').show();

    let perPage = parseInt($('#products nav #per_page').val());

    let category = getFilterText('category');
    let subCategory = getFilterText('sub_category');
    let seller = getFilterText('seller');
    let section = getFilterText('section');

    $.ajax({
        data: {
            perPage:perPage,
            category:category,
            subCategory:subCategory,
            seller:seller,
            section:section,
        },
        type: 'GET',
        url: url,
        success: function(response) {
            $('#product_section').html(response);
            $('#loader').hide();
            if(changeHeading) {
                $('#textChange').text('Filtered Products');
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
