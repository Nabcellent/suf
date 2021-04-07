
/*_______  Set Variation To Delete with SweetAlert  _______*/
$(document).on('click','.delete_variation', function() {
    const id = $(this).attr('data-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/products/details/variation/' + id,
                type: 'DELETE',
                success: function (result) {
                    if(result === 1) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                       alert("Something went wrong!");
                    }
                }
            });
        }
    });
});



/*_______  Set Sub-Category To Delete with SweetAlert  _______*/
$(document).on('click','.delete_sub_category', function() {
    const id = $(this).attr('data-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/products/categories/' + id,
                type: 'DELETE',
                success: function (result) {
                    if(result === 1) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        })
                    }
                }
            });
        }
    });
});


/*_______  Set Banner To Delete  _______*/
$(document).on('click','.delete_banner', function() {
    const id = $(this).attr('data-id');
    const image = $(this).attr('data-image');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: {id, image},
                url: '/content/banners',
                type: 'DELETE',
                success: function (result) {
                    if(result === 1) {
                        Swal.fire(
                            'Deleted!',
                            'Banner has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        })
                    }
                }
            });
        }
    });
});
