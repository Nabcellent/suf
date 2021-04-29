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



/**=== === === === === === === === === === === === === === === === === === === === ===  CONFIRM ORDER READY  */

$(document).on('click', '#order-view .is_ready', function() {
    const id = this.value;
    let title, confirmBtnTxt, cancelBtnTxt;

    if(this.checked) {
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
            if(checked) {
                sendOrderReadyAjax(id, 1);
            } else {
                sendOrderReadyAjax(id, 0);
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            element.checked = !checked;

            Swal.fire(
                'Cancelled',
                'Action aborted :)',
                'error'
            )
        }
    })
}

function sendOrderReadyAjax(id, ready) {
    $.ajax({
        url: '/admin/order-ready/' + id + '/' + ready,
        type: 'PATCH',
        statusCode: {
            200: function(responseObject, textStatus, errorThrown) {
                if(responseObject.status) {
                    Swal.fire(
                        'Done!',
                        responseObject.message,
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
