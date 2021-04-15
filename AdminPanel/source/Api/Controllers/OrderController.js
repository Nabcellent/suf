const createError = require("http-errors");
const moment = require('moment');
const {Order} = require("../Models");    //  Models

//  Helpers
const {alertUser, Help} = require("../Helpers");


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

const updateStatus = async (req, res, next) => {
    let {order_id, status} = req.body;

    try {
        Order.updateStatus(order_id, status.toLowerCase())
            .then((response) => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response === 1) {
                    alertUser(req, 'success', 'Success!', 'Status updated.');
                } else {
                    console.log(response);
                    throw createError(404, "Something went wrong");
                }
                res.redirect('back');
            }).catch(error => next(error));
    } catch(err) {
        next(err);
    }
}



module.exports = {
    readOrders,
    readOrder,

    updateStatus
}
