const moment = require('moment');
const UserService = require("../Services/UserService");
const createError = require("http-errors");
const {join} = require("path");
const {User} = require('../Models');
const {alertUser} = require("../Helpers");
const {validationResult} = require("express-validator");
const {dbRead} = require("../../Database/query");



const getCreateUser = async (req, res) => {
    res.render('users/admins/create_admin', {
        Title: 'Create',
        layout: './layouts/nav'
    });
}

const createUser = async (req, res, next) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const error = errors.array()[0];
        alertUser(req, 'info', 'Something is missing!', error.msg);

        return res.redirect('back');
    }

    const {
        first_name, last_name, email, phone, gender, address, password, user_type, username, national_id, pin
    } = req.body;

    let imageTitle;
    if (req.files || typeof req.file !== 'undefined') {
        const {image} = req.files;
        let {name} = image;
        name = Math.floor((Math.random() * 1199999) + 1) + name;
        imageTitle = name;

        let folder
        switch (user_type){
            case 'Seller': folder = 'seller';
                break;
            case 'Admin': folder = 'admin';
                break;
            case 'Customer': folder = 'customer';
        }

        const pathToImages = join(__dirname, '../../../../public/images/users/' + folder + '/');

        try {
            image.mv(pathToImages + name)
                .then(response => {
                    if(response instanceof Error) throw createError(404, response.message);
                })
                .catch(error => next(error));
        } catch (e) {
            next(e);
        }
    }

    const phoneNo = (phone.length === 10) ? phone.substring(1) : phone;
    try {
        User.createUser(first_name, last_name, gender, user_type, email, password, imageTitle, req.ip)
            .then(response => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response.length === 1) {
                    let userId = response[0];
                    User.createAdmin(userId, national_id, username, pin)
                        .then(response => {
                            if(response instanceof Error) {
                                throw createError(404, response);
                            } else if(response === 1) {
                                User.createAddress(userId, phoneNo, address)
                                    .then(response => {
                                        if(response instanceof Error) {
                                            throw createError(404, response);
                                        } else if(response === 1) {
                                            alertUser(req, 'success', 'Success!', 'User created successfully.');
                                            res.redirect('/admins');
                                        } else {
                                            throw createError(404, 'Something went wrong.');
                                        }
                                    }).catch(err => next(err));
                            } else {
                                throw createError(404, 'Something went wrong.');
                            }
                        }).catch(err => next(err));
                } else {
                    throw createError(404, 'Something went wrong.');
                }
            }).catch(error => next(error));
    } catch (e) {
        next(e);
    }
}

const readAdmins = async (req, res, next) => {
    try {
        User.readAdmins()
            .then(response => {
                if(!(response instanceof Error)) {
                    res.render('users/admins/list', {
                        Title: 'Customers',
                        layout: './layouts/nav',
                        admins: response,
                        moment
                    });
                } else if(response instanceof Error) {
                    throw createError(404, response);
                } else {
                    console.log(response);
                    throw createError(404, 'Something went wrong');
                }
            }).catch(error => next(error));
    } catch (e) {
        next(e);
    }
}

const readProfile = async(req, res) => {
    res.render('users/profile', {
        Title: 'Customers',
        layout: './layouts/nav',
        admin: {first_name: 'Michael'}/*req.user[0]*/,
    });
}

const createSeller = async (req, res) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const alerts = errors.array()

        res.json({errors: alerts})
    }

    const {first_name, last_name, email, id_number, gender, password} = req.body;
    const phone = (req.body.phone.length === 10) ? req.body.phone.substring(1) : req.body.phone;

    User.createUser(first_name, last_name, gender, 'Seller', email, password, null, req.ip)
        .then(data => {
            if(data.affectedRows === 1) {
                let userId = data.insertId;

                UserService.createSeller(userId, id_number)
                    .then(data => {
                        if(data === 1) {

                            UserService.createAddress(userId, phone)
                                .then(data => {
                                    if(data === 1) {
                                        return res.json({success: {message: 'success'}});
                                    } else {
                                        return res.json({errors: {'message': 'Internal error. Contact Admin'}});
                                    }
                                })
                                .catch(err => console.log(err));

                        } else {
                            res.json({errors: {'message': 'An error occurred. Contact Admin'}});
                        }
                    })
                    .catch(err => console.log(err));

            } else {
                res.json({errors: {'message': 'Registration Error. Contact Admin'}});
            }
        }).catch(err => console.log(err));
}
const readSeller = async (req, res) => {
    const getSellerData = async () => {
        const result = {
            users: [],
            moment: moment
        };

        (await dbRead.getReadInstance().getFromDb({
            table: 'users',
            join: [
                ['sellers', 'users.user_id = sellers.user_id'],
                ['addresses', 'users.user_id = addresses.user_id']
            ],
            orderBy: ['users.user_id DESC'],
            where: [['user_type', '=', 'seller']]
        })).forEach((row) => {result.users.push(row);})

        return result;
    }

    try {
        const data = await getSellerData();

        res.render('users/sellers', {Title: 'Customers', layout: './layouts/nav', sellerInfo: data});
    } catch(error) {
        console.log(error);
    }
}

const readCustomer = async (req, res) => {
    const getCustomerData = async () => {
        const result = {
            users: [],
            moment: moment
        };

        (await dbRead.getReadInstance().getFromDb({
            table: 'users',
            orderBy: ['user_id DESC'],
            where: [['user_type', '=', 'customer']]
        })).forEach((row) => {result.users.push(row);})

        return result;
    }

    try {
        const data = await getCustomerData();

        res.render('users/customers', {Title: 'Customers', layout: './layouts/nav', customerInfo: data});
    } catch(error) {
        console.log(error);
    }
}

module.exports = {
    getCreateUser,

    createUser,

    readAdmins,

    createSeller,
    readSeller,
    readProfile,

    readCustomer,
}
