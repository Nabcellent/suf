///////////////////////////////////////////////  MPESA INTEGRATION  ///////////////////////////////////////////////
function queryStk() {
    $('button.done').children('img').first().show(100)

    const CHECKOUT_REQUEST_INPUT = $('input[name="checkout_id"]');

    if(CHECKOUT_REQUEST_INPUT.length) {
        const mpesaPaymentRequest = new Payment(CHECKOUT_REQUEST_INPUT.val());

        setTimeout(() => { mpesaPaymentRequest.checkStatus(); }, 3000);
    }
}

function cancelPayment() {
    $('#mpesa-preloader').hide(500);
}

if($('.countDown').length) {
    const countDown = () => {
        if (timeLeft < 0) {
            clearTimeout(timerId);
            queryStk()
        } else {
            $('.countDown').html(timeLeft);
            timeLeft--;
        }
    }

    let timeLeft = 30;
    let timerId = setInterval(countDown, 1000);
}

class Payment {
    constructor(checkoutRequestId) {
        this.checkoutRequestId = checkoutRequestId;
    }

    async validateStkStatus() {
        return await fetch('/payments/callbacks/stk_status/' + this.checkoutRequestId)
            .then(response => response.json())
            .then(data => { return data; });
    }

    checkStatus() {
        this.validateStkStatus()
            .then(data => {
                if(data.status === 'processing') {
                    $('#mpesa-preloader h5').text(data.message);

                    setTimeout(() => { this.checkStatus(); }, 5000);
                } else if(data.status === 'processed') {
                    $('#mpesa-preloader').addClass('d-none');

                    Swal.fire({
                        position: 'top-end',
                        icon: data.icon,
                        title: data.message,
                        showConfirmButton: true,
                    }).then(() => { if(data.url !== "") window.location = data.url; });
                } else {
                    this.error()
                }
            }).catch(() => this.error());
    }

    error() {
        cancelPayment()
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href>Why do I have this issue?</a>'
        });
    }
}



///////////////////////////////////////////////  PAYPAL INTEGRATION  ///////////////////////////////////////////////
if($('#paypal_payment_button').length) {
    paypal.Buttons({
        style: {
            color: 'gold',
            // Available colors
            //'blue',
            //'black',
            //'white',
            //'gold',
            //'silver',
            layout:  'vertical',
            shape: 'pill',
            label: 'buynow',
        },
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units:[{
                    amount: {
                        currency_code: "USD",
                        value: 0.1
                        //value: $('input[name="amount_payable"]').val()
                    },
                    payee: {
                        email_address: 'sb-kg0wb2320059@business.example.com'
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then((details) => {
                Swal.fire(
                    'Payment Successful!',
                    'SUF-STORE',
                    'success'
                ).then(() => {
                    window.location.href = "thank-you";
                });

                $.ajax({
                    data: {status: 'Paid'},
                    type: 'PATCH',
                    url: '/paypal/update-order-status'
                });
            });
        },
        onCancel: (data) => {
            Swal.fire(
                'Payment Cancelled.',
                'SUF-STORE',
                'warning'
            )
        }
    }).render('#paypal_payment_button');
}
