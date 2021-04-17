const createError = require("http-errors");
const Mail = require('../Mail');

const moment = require('moment');
const {Order} = require("../Models");    //  Models
//  Helpers
const {alertUser, Help, options} = require("../Helpers");



const readOrders = (req, res, next) => {
    try {
        Order.readOrders()
            .then(response => {
                if(!(response instanceof Error)) {
                    res.render('orders/list', {Title: 'Orders', layout: './layouts/nav', moment, orders:response});
                } else if(response instanceof Error) {
                    throw createError(404, response);
                } else {
                    console.log(response); throw createError(404, 'Something went wrong');
                }
            }).catch(error => next(error));
    } catch (e) {
        next(e);
    }
}

const readOrder = (req, res, next) => {
    try {
        Order.readOrder(req.params.id)
            .then(response => {
                if(!(response instanceof Error)) {
                    res.render('orders/view', {
                        Title: 'Orders', layout: './layouts/nav', moment, order:response, currencyFormat: Help.currencyFormat
                    });
                } else if(response instanceof Error) {
                    throw createError(404, response);
                } else {
                    console.log(response); throw createError(404, 'Something went wrong');
                }
            }).catch(error => next(error));
    } catch (e) { next(e); }
}

const readInvoice = (req, res, next) => {
    try {
        Order.readOrder(req.params.id)
            .then(response => {
                if(!(response instanceof Error)) {
                    res.render('orders/invoice', {
                        Title: 'Invoice', layout: './layouts/navless', moment, order:response, currencyFormat: Help.currencyFormat
                    });
                } else if(response instanceof Error) {
                    throw createError(404, response);
                } else {
                    console.log(response); throw createError(404, 'Something went wrong');
                }
            }).catch(error => next(error));
    } catch (e) { next(e); }
}

const updateStatus = async (req, res, next) => {
    let {order_id, status, courier, tracking_number} = req.body;

    if(status !== 'completed') {
        courier = "";
        tracking_number = 0;
    } else {
        tracking_number = parseInt(tracking_number, 10);
    }

    try {
        Order.updateStatus(order_id, status.toLowerCase(), courier.toLowerCase(), tracking_number)
            .then((response) => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response === 1) {
                    Mail.sendEmail();
                    //res.send('Email sent!')
                    alertUser(req, 'success', 'Success!', 'Status updated.');
                    res.redirect('back');
                } else {
                    console.log(response);
                    throw createError(404, "Something went wrong");
                }
            }).catch(error => next(error));
    } catch(err) {
        next(err);
    }
}



module.exports = {
    readOrders,
    readOrder,
    readInvoice,

    updateStatus,
}
