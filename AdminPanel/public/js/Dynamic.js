
$(() => {
    /*_______  Set Product To Delete  _______*/
    $('.delete_product').on('click', function() {
        $('#delete_product_modal #product_id').val($(this).attr('data-id'));
        $('#delete_product_modal #image_name').val($(this).attr('data-image'));
    });


    /*_______  Set Category To Create/Update  _______*/
    $(document).on('click', '#add_category', function() {
        const $form = $('#category_modal form');

        $('#cat_radio_group').css('display', 'none');
        $('#cat_check_group').show();

        $form[0].reset();
        $form.attr('action', '/products/categories');

        $('#cat_radio_group input').removeAttr('required');
        $('#category_modal .modal-title').html("Add Category");
        $('#category_modal button[type="submit"]').html("Insert");
    });
    $(document).on('click', '#categories_table .update_category', function() {
        $('#cat_check_group').css('display', 'none');
        $('#cat_radio_group').show();
        $('#cat_check_group input').removeAttr('required');

        $('#category_modal #category_id').val($(this).attr('data-id'));
        $('#category_modal textarea[name="description"]').val($(this).attr('data-desc'));
        $('#category_modal input[name="discount"]').val($(this).attr('data-discount'));
        let sectionId = $(this).attr('data-section');
        $('#category_modal input[value="'+ sectionId +'"]').prop('checked', true);

        $('#category_modal #cat_title').val($(this).attr('data-title'));
        $('#category_modal form').attr('action', '/products/category?_method=PUT');
        $('#category_modal .modal-title').html("Update Category");
        $('#category_modal button[type="submit"]').html("Update");
    });


    /*_______  Set Sub-Category To Update  _______*/
    $(document).on('click', '#sub_categories_table .update_sub_category', function() {
        $('#cat_check_group').css('display', 'none');
        $('#cat_radio_group').show();

        $('#sub_category_modal #sub_category_id').val($(this).attr('data-id'));
        $('#sub_category_modal textarea[name="description"]').val($(this).attr('data-desc'));
        $('#sub_category_modal #section').val($(this).attr('data-section'));
        $('#sub_category_modal input[name="discount"]').val($(this).attr('data-discount'));

        $('#sub_category_modal #title').val($(this).attr('data-title'));
        $('#sub_category_modal form').attr('action', '/products/sub-category?_method=PUT');
        $('#sub_category_modal .modal-title').html("Update Sub-Category");
        $('#sub_category_modal button[type="submit"]').html("Update");
    });

    /*_______  Set Image To Delete  _______*/
    $('.delete_image').on('click', function() {
        $('#delete_image_modal #image_id').val($(this).attr('data-id'));
        $('#delete_image_modal #image_name').val($(this).attr('data-image'));
    });

    /*_______  Set Variation Id For Price  _______*/
    $('.stock').on('click', function() {
        let variationId = $(this).attr('data-id');
        $('#set_stock #variation_id').val(variationId);
    });

    /*_______  Set Variation Id For Stock  _______*/
    $('.extra_price').on('click', function() {
        let variationId = $(this).attr('data-id');
        $('#set_price #variation_id').val(variationId);
    });


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

    /*__________________________________________  Set Banner To Create/Update  _____________________*/
    let $bannerSubmit = $('#add_banner_modal button[type="submit"]');
    let $bannerForm = $('#add_banner_modal form');

    $(document).on('click', '#btn_add_banner', () => {
        $bannerForm.attr('action', '/content/banners');
    });
    $(document).on('click', '#banners .update_banner', function() {
        $('#update_banner_modal #banner_id').val($(this).attr('data-id'));
        $('#update_banner_modal #current_image').val($(this).attr('data-image'));
        $('#update_banner_modal input[name="title"]').val($(this).attr('data-title'));
        $('#update_banner_modal input[name="link"]').val($(this).attr('data-link'));
        $('#update_banner_modal input[name="alt"]').val($(this).attr('data-alt'));
        $('#update_banner_modal input[name="description"]').val($(this).attr('data-description'));

        $('#update_banner_modal img').attr('src', '/images/banners/' + $(this).attr('data-image'));
    });



    /**
     * =============================================    COUPONS
     * */
    //  SHOW / HIDE COUPON CODE FIELD
    $('#coupon-view form input#manual').on('click', () => {
        $('#coupon-code-field').show(300);
    });
    $('#coupon-view form input#automatic').on('click', () => {
        $('#coupon-code-field').hide(200);
    });



    /**
     * ON ACTION FETCH FROM SERVER  */

    $('#section').on('change', async function() {
        const sectionId = $(this).val();
        const response = await fetch('/products/get-categories/' + sectionId, {
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

    $('#categories').on('change', async function() {
        const sectionId = $(this).val();
        const response = await fetch('/products/get-sub-category/' + sectionId, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        const data = await response.json();

        let options = '<option selected hidden value="">Select a sub-category *</option>';
        $(data).each(function() {
            options += `<option value="${$(this)[0].id}">${$(this)[0].title}</option>`;
        });

        $('#add_product #sub_categories').html(options);
    });
});



/********************************************************************************
 * UPDATE COUPON STATUS */
$(document).on('click', '.update_coupon_status', function() {
    const status = $(this).children('i').attr('status');
    const id = $(this).data('id');
    const url = '/products/coupon-status';

    updateStatus(status, id, url, $(this));
})


/********************************************************************************
 * UPDATE STATUSES DYNAMIC FUNCTION
 * ********************************************************************************/

const updateStatus = (status, id, url, element) => {
    $.ajax({
        data: {
            status: status,
            id: id
        },
        method: 'PATCH',
        url: url,
        success: (response) => {
            console.log(response);
            if(response.errors) {
                alert(response.errors.message);
            } else {
                if(response.status === 0) {
                    element.html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    element.html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            }
        }, error: () => {
            alert("error");
        }
    });
}


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

$(document).on('click','.update_variation_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            id: $(this).attr('data-id')
        },
        method: 'PATCH',
        url: '/products/details/variation/status',
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

$(document).on('click','.update_variation_option_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            id: $(this).attr('data-id')
        },
        method: 'PATCH',
        url: '/products/details/variation-option/status',
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
            category_id: $(this).attr('data-id')
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

$(document).on('click','.update_banner_status', function() {
    $.ajax({
        data: {
            status: $(this).children('i').attr('status'),
            banner_id: $(this).attr('data-id')
        },
        method: 'PUT',
        url: '/content/banner-status',
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
