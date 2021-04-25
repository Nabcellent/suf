/**==============================================================================  AJAX CSRF TOKEN   */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$(() => {
    $('select#attribute').on('change', function() {
        $.ajax({
            data: {id: $(this).val()},
            type:'POST',
            url:'/admin/get-attribute-values',
            statusCode: {
                200: function(responseObject) {
                    $('select[name="variation_options[]"]').html(responseObject.values);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    console.log(errorThrown);
                    alert("Something went wrong!");
                },
                404: function() {
                    alert("Error! Not found");
                }
            },
            error: (error) => {
                alert("Error");
                console.log(error);
            }
        });
    });

    /**
     *  ==============================================================================   FETCH CALL FOR ADD PRODUCT PAGE
     * */
    $('#categories').on('change', async function() {
        const categoryId = $(this).val();
        $.ajax({
            data: {id: categoryId},
            type:'POST',
            url:'/admin/get-sub-categories',
            success: (response, textStatus) => {
                if(textStatus === 'success') {
                    $('#add_product #sub_categories').html(response.subCategories);
                } else {
                    alert('Error');
                }
            },
            error: () => {
                alert("Error");
            }
        });
    });

    /**
     *  ==========================================================================   FETCH CALL FOR CREATE CATEGORY PAGE
     * */
    const section = $('select#section');

    if(typeof section.val() !== 'undefined' && section.val().trim()) {
        fetchCategoriesBySectionId({
            id:section.val(),
            categoryId: $('select#section :selected').attr('data-categoryId')
        });
    }

    $('#section').on('change', async function() {
        const sectionId = $(this).val();

        fetchCategoriesBySectionId({id:sectionId});
    });
});

function fetchCategoriesBySectionId(data) {
    $.ajax({
        data: data,
        type:'POST',
        url:'/admin/get-categories',
        statusCode: {
            200: function(responseObject) {
                $('select#category').html(responseObject.categories);
            },
            500: function(responseObject, textStatus, errorThrown) {
                console.log(errorThrown);
                alert("Something went wrong!");
            }
        },
        error: () => {
            alert("Error");
        }
    });
}
