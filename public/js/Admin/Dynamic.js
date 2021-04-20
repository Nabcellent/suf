$(() => {
    /*_______  Set Product To Delete  _______*/
    $('.delete_product').on('click', function() {
        $('#delete_product_modal #product_id').val($(this).attr('data-id'));
        $('#delete_product_modal #image_name').val($(this).attr('data-image'));
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
     * ===========================================================================    COUPONS
     * */
    //  SHOW / HIDE COUPON CODE FIELD
    $('#coupon-view form input#manual').on('click', () => {
        $('#coupon-code-field').show(300);
    });
    $('#coupon-view form input#automatic').on('click', () => {
        $('#coupon-code-field').hide(200);
    });


    /**
     * ===========================================================================    ORDERS
     * */
    //  SHOW HIDE COURIER FIELDS
    $(document).on('change', '#order-view form#update-order-status #status', function() {
        if($(this).val().toLowerCase() === 'completed') {
            $('form#update-order-status input[name="courier"]').attr('required', true);
            $('form#update-order-status input[name="tracking_number"]').attr('required', true);
            $('form#update-order-status #courier').show(200);
        } else {
            $('form#update-order-status input[name="courier"]').attr('required', false);
            $('form#update-order-status input[name="tracking_number"]').attr('required', false);
            $('form#update-order-status #courier').hide(100);
        }
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
});



/***********************************************************************************    UPDATE STATUS */
$(document).on('click', '.update_status', function() {
    const status = $(this).children('i').attr('status');
    const id = $(this).data('id');
    const model = $(this).data('model');

    updateStatus(model, id, status, $(this));
});
/********************************************************************************
 * UPDATE STATUSES DYNAMIC FUNCTION
 * ********************************************************************************/

const updateStatus = (model, id, status, element) => {
    $.ajax({
        data: {
            model:model,
            id: id,
            status: status
        },
        method: 'PATCH',
        url: '/admin/status/toggle-update',
        statusCode: {
            200: function(responseObject) {
                if(responseObject.status === 0) {
                    element.html('<i class="fas fa-toggle-off" status="Inactive"></i>');
                } else{
                    element.html('<i class="fas fa-toggle-on" status="Active"></i>');
                }
            },
            404: () => {
                console.log('Not Error Found')
            },
            500: function(responseObject, textStatus, errorThrown) {
                console.log(errorThrown);
                alert("Something went wrong!");
            }
        },
        error: () => {
            alert("Error");
        },
    });
}
