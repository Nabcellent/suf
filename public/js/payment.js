
///////////////////////////////////////////////  PAYPAL INTEGRATION  ///////////////////////////////////////////////
paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: (data, actions) => {
        return actions.order.create({
            purchase_units:[{
                amount: {
                    value: '0.1'
                }
            }]
        });
    },
    onApprove: (data, actions) => {
        return actions.order.capture().then((details) => {
            console.log(details);

            alertMessage("Payment Successful", "Success");
        });
    },
    onCancel: (data) => {
        alertMessage("Payment Cancelled", "Warning");
    }
}).render('#paypal_payment_button');
