/*  DYNAMIC DELETE  */
$(document).on('click', '.delete-from-table', function () {
    const id = [$(this).data('id')];
    const model = $(this).data('model');

    deleteFromTable(id, model);
});

$(document).on('click', '.delete-all', function () {
    const table = $(this).data('table'),
        ids = $(table).DataTable().rows({selected: true}).ids().toArray(),
        model = $(this).data('model');

    if (ids.length) {
        deleteFromTable(ids, model)
    } else {
        Toastify({
            text: 'No items selected for deletion.',
            duration: 7000,
            close: true,
            className: 'info',
        }).showToast();
    }
});

const deleteFromTable = (ids, model) => {
    Swal.fire({
        title: `Are you sure you want to delete ${ids.length > 1 ? 'these' : 'this'} ${ids.length > 1 ? model + 's' : model}?`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Yes, delete ${model}!`,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                data: {ids, model},
                url: '/admin/delete/',
                type: 'DELETE',
                success: () => true,
                error: () => {
                    Swal.fire(
                        'Error!',
                        'That thing is still around?',
                        'error'
                    )
                }
            });
        },
    }).then(result => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                `${ids.length > 1 ? model + 's have' : model + ' has'} been deleted.`,
                'success'
            ).then(() => location.reload());
        }
    });
}


/**=== === === === === === === === === === === === === === === === === === === === ===  CONFIRM ORDER READY  */

$(document).on('click', '#order-view .is_ready', function () {
    const id = this.value;
    let title, confirmBtnTxt, cancelBtnTxt;

    if (this.checked) {
        title = 'Is this product ready?';
        confirmBtnTxt = 'Yes, it is!';
        cancelBtnTxt = 'No, not yet!';

        fireSweet(id, true, title, confirmBtnTxt, '#28A745', cancelBtnTxt, '#900', this);
    } else {
        title = 'Are you sure this product isn\'t ready?';
        confirmBtnTxt = 'Yes, I am!';
        cancelBtnTxt = 'No, scratch that!';

        fireSweet(id, false, title, confirmBtnTxt, '#3085d6', cancelBtnTxt, '#900', this);
    }
});

function fireSweet(id, checked, title, confirmBtnTxt, confirmColor, cancelBtnTxt, cancelColor, element) {
    Swal.fire({
        title: title,
        text: "Please confirm this action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmBtnTxt,
        cancelButtonText: cancelBtnTxt,
        confirmButtonColor: confirmColor,
        cancelButtonColor: cancelColor,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            sendOrderReadyAjax(id, checked ? 1 : 0);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            element.checked = !checked;

            Swal.fire({
                icon: 'info',
                title: 'Cancelled!',
                text: 'Action aborted :)',
                timer: 1500,
                showConfirmButton: false,
                position: 'top-end',
            })
        }
    })
}

function sendOrderReadyAjax(id, ready) {
    $.ajax({
        url: '/admin/order-ready/' + id + '/' + ready,
        type: 'PATCH',
        success: response => {
            if (response.status) {
                Swal.fire(
                    'Done!',
                    response.message,
                    'success'
                );
            } else {
                Swal.fire(
                    'Sorry!',
                    'Something went wrong.',
                    'error'
                );
            }
        },
        error: () => alert("Error")
    });
}
