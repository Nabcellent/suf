///////////////////////////////////////////////  MPESA INTEGRATION  ///////////////////////////////////////////////
class Payment {
    constructor(stkResponse) {
        this.checkoutRequestId = stkResponse.CheckoutRequestID;
        this.merchantRequestId = stkResponse.MerchantRequestID;
        this.customerMessage = stkResponse.CustomerMessage;
        this.responseDescription = stkResponse.ResponseDescription;
    }

    async validateStkStatus() {
        return await fetch('/api/payments/callbacks/stk_status/' + this.checkoutRequestId)
            .then(response => response.json())
            .then(data => { return data; });

    }

    checkStatus() {
        this.validateStkStatus()
            .then(data => {
                //console.log(data.status);
                if(data.status === 'processing') {
                    setTimeout(() => { this.checkStatus(); }, 1500);
                } else if(data.status === 'processed') {
                    setTimeout(() => { this.checkStatus(); }, 1500);
                } else if(data.status === 'recorded') {
                    $('#mpesa-preloader').addClass('d-none');

                    Swal.fire({
                        position: 'top-end',
                        icon: data.icon,
                        title: data.message,
                        showConfirmButton: true,
                    }).then(() => {
                        if(data.url !== "") {
                            window.location = data.url;
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }
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
                console.log(details);

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
