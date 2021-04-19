/**==============================================================================  AJAX CSRF TOKEN   */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$(() => {
    $('#variation_attribute_s2').on('change', function() {
        fetch(`/products/details/attributeValues/${$(this).val()}`)
            .then(response => response.json())
            .then((data) => {
                let values = JSON.parse(data);
                let attributeValOptions = '<option></option>';

                if(Array.isArray(values)) {
                    values.forEach(value => {
                        attributeValOptions += `<option value="${value}">${value}</option>`
                    })
                } else {
                    attributeValOptions += `<option value="${values}">${values}</option>`
                }
                $('#values_s2').html(attributeValOptions);
            })
            .catch((error) => {
                alert('Problem contacting server');
                console.log(error)
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
});
