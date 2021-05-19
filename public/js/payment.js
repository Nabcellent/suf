
///////////////////////////////////////////////  PAYPAL INTEGRATION  ///////////////////////////////////////////////
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
                window.location.href = "paypal-success";
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
