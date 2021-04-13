const createError = require("http-errors");
const moment = require('moment');
const {User, Section, Coupon} = require("../../Models");    //  Models
//  Helpers
const {in_array} = require('locutus/php/array');
const {alertUser, Help} = require("../../Helpers");


const createUpdateCoupon = async (req, res, next) => {
    let {id} = req.params;
    let title, coupon;

    const categories = await Section.withCategories();
    const users = await User.activeUsers();

    if(!id) {
        title = 'Create';

        if(req.method === 'POST') {
            //  Create coupon
            let {option, code, categories, users = '', coupon_type, amount_type, expiry_date, amount} = req.body;
            if(Array.isArray(users)) users = users.join();
            if(Array.isArray(categories)) categories = categories.join();

            if(option.toLowerCase() === 'automatic') code = Help.str_random(8);

            try {
                Coupon.create(option, code, categories, users, coupon_type, amount_type, amount, expiry_date)
                    .then(response => {
                        if(response instanceof Error) {
                            throw createError(404, response);
                        } else if(response.length === 1) {
                            alertUser(req, 'success', 'Success!', 'New coupon created.');
                        } else {
                            console.log(response);
                            throw createError(404, "Something went wrong");
                        }
                        return res.redirect('/products/coupons');
                    }).catch(err => next(err));
            } catch (err) {
                return next(err);
            }
        } else {
            return res.render('coupons/view', {
                Title: title + ' Coupon', layout: './layouts/nav', moment, coupon, categories, users
            });
        }
    } else {
        //  Update coupon
        title = 'Update';

        if(req.method === 'POST') {
            let {categories, users = '', coupon_type, amount_type, expiry_date, amount} = req.body;
            if(Array.isArray(users)) users = users.join();
            if(Array.isArray(categories)) categories = categories.join();

            try {
                Coupon.update(id, categories, users, coupon_type, amount_type, amount, expiry_date)
                    .then(response => {
                        if(response instanceof Error) {
                            throw createError(404, response);
                        } else if(response === 1) {
                            alertUser(req, 'success', 'Success! ', 'Coupon has been updated.');
                        } else {
                            console.log(response);
                            throw createError(404, "Something went wrong");
                        }
                        return res.redirect('/products/coupons');
                    }).catch(err => next(err));
            } catch (err) {
                return next(err);
            }
        } else {
            try {
                Coupon.findById(id)
                    .then(response => {
                        if(response instanceof Error) {
                            throw createError(404, response);
                        } else if(response) {
                            response.users = response.users.split(',') || [];
                            response.categories = response.categories.split(',') || [];
                            coupon = response;
                        } else {
                            console.log(response); throw createError(404, 'Something went wrong');
                        }
                        return res.render('coupons/view', {
                            Title: title + ' Coupon', layout: './layouts/nav', moment, coupon, categories, users, in_array
                        });
                    }).catch(err => next(err));
            } catch(error) {
                next(error);
            }
        }
    }
}

const readCoupons = async (req, res, next) => {
    try {
        Coupon.readCoupons()
            .then(response => {
                if(!(response instanceof Error)) {
                    res.render('coupons/list', {Title: 'Coupons', layout: './layouts/nav', moment, coupons:response});
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

const updateStatus = async (req, res) => {
    let {status, id} = req.body;
    status = (status === 'Active') ? 0 : 1;

    try {
        Coupon.updateStatus(id, status)
            .then((data) => {
                if(data === 1) {
                    return res.json({status});
                } else {
                    return res.json({errors: {message: 'Internal error. Contact Admin'}});
                }
            }).catch(error => console.log(error));
    } catch(err) {
        res.json(err);
    }
}



module.exports = {
    createUpdateCoupon,
    readCoupons,

    updateStatus
}
