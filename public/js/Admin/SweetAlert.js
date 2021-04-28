/*  DYNAMIC DELETE  */
$(document).on('click','.delete-from-table', function() {
    const id = $(this).data('id');
    const model = $(this).data('model');

    deleteFromTable(id, model);
});

const deleteFromTable = (id, model) => {
    Swal.fire({
        title: `Are you sure you want to delete this ${model}?`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Yes, delete ${model}!`,
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/delete/' + id + '/' + model,
                type: 'DELETE',
                statusCode: {
                    200: function(responseObject, textStatus, errorThrown) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        console.log(errorThrown);
                        alert("Something went wrong!");
                        return false;
                    }
                },
                error: () => {
                    alert("Error");
                    return false;
                }
            });
        }
    });
}


$(document).on('click', '#order-view .is_ready', function() {
    if(this.checked) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Is this product ready?',
            text: "Please confirm this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, it is!',
            cancelButtonText: 'No, not yet!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                this.checked = false;

                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Action aborted :)',
                    'error'
                )
            }
        })
    }
})
