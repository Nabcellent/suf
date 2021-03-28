
$(() => {
    /*_______  Set Product To Delete  _______*/
    $('.delete_product').on('click', function() {
        $('#delete_product_modal #product_id').val($(this).attr('data-id'));
        $('#delete_product_modal #image_name').val($(this).attr('data-image'));
    })

    /*_______  Set Sub-Category To Update  _______*/
    $('#add_sub_category').on('click', () => {
        $('#cat_group').show();
    })
    $('#sub_cat_table .update_sub_category').on('click', function() {
        $('#sub_category_modal button[type="submit"]').html("Update");
        $('#sub_category_modal .modal-title').html("Update Sub-Category");
        $('#cat_group').hide();
        $('#sub_category_modal #section').val(2);
        $('#sub_category_modal #category_id').val($(this).attr('data-id'));
        $('#sub_category_modal #title').val($(this).attr('data-title'));
        $('#sub_category_modal form').attr('action', '/products/categories?_method=PUT')
    });

    /*_______  Set Image To Delete  _______*/
    $('.delete_image').on('click', function() {
        $('#delete_image_modal #image_id').val($(this).attr('data-id'));
        $('#delete_image_modal #image_name').val($(this).attr('data-image'));
    })

    /*_______  Set Variation Id For Price  _______*/
    $('.extra_price').on('click', function() {
        let variationId = $(this).attr('data-id');
        $('#set_price #variation_id').val(variationId);
    })


    /*_______  Set Brand Id To Update  _______*/
    $('.update_brand').on('click', function() {
        let brandId = $(this).attr('data-id');
        let brandName = $(this).attr('data-name');
        let brandStatus = $(this).attr('data-status');
        $('#brand #btn_update_brand').html("Update");
        $('#brand .modal-title').html("Update Brand");

        $('#brand form').attr('action', '/products/addons/brand?_method=PUT');

        $('#brand #brand_id').val(brandId);
        $('#brand #name').val(brandName);

        if(brandStatus === '0') {
            $('#brand #inactive').prop('checked', true);
        } else {
            $('#brand #active').prop('checked', true);
        }
    })

    /*_______  Set Brand Id To Delete  _______*/
    $('.delete_brand').on('click', function() {
        let brandId = $(this).attr('data-id');
        $('#delete_brand_modal #brand_id').val(brandId);
    });



    /**
     * ON ACTION FETCH FROM SERVER  */

    $('#section').on('change', async function() {
        const sectionId = $(this).val();
        const response = await fetch('/products/section-category/' + sectionId, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        const data = await response.json();

        let options = '<option selected hidden value="">Select *</option>';
        $(data).each(function() {
            options += `<option value="${$(this)[0].id}">${$(this)[0].title}</option>`;
        });

        $('#sub_category_modal #category').html(options);
    });
});



/**
 * UPDATE STATUSES*/

$(document).on('click','.update_product_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            product_id: $(this).attr('data-id')
        },
        method: 'PUT',
        url: '/products/status',
        success: (response) => {
            if(response.errors) {
                alert(response.errors.message);
            } else {
                if(response.status === 0) {
                    $(this).html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    $(this).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            }
        }, error: () => {
            alert("error");
        }
    });
});

$(document).on('click','.update_image_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            image_id: $(this).attr('data-id')
        },
        method: 'PUT',
        url: '/products/details/images',
        success: (response) => {
            if(response.errors) {
                alert(response.errors.message);
            } else {
                if(response.status === 0) {
                    $(this).html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    $(this).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            }
        }, error: () => {
            alert("error");
        }
    });
});

$(document).on('click','.update_brand_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            brand_id: $(this).attr('data-id')
        },
        method: 'PUT',
        url: '/products/addons/status',
        success: (response) => {
            if(response.errors) {
                alert(response.errors.message);
            } else {
                if(response.status === 0) {
                    $(this).html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    $(this).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            }
        }, error: () => {
            alert("error");
        }
    });
});

$(document).on('click','.update_category_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            sub_category_id: $(this).attr('data-id')
        },
        method: 'PUT',
        url: '/products/categories/status',
        success: (response) => {
            if(response.errors) {
                alert(response.errors.message);
            } else {
                if(response.status === 0) {
                    $(this).html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    $(this).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            }
        }, error: () => {
            alert("error");
        }
    });
})
