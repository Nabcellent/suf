const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development);
let created_at  = new Date();
let updated_at = new Date();



const findById = (id) => {
    try {
        return new Promise((resolve, reject) => {
            db('coupons').where({id}).first()
                .then(row => {
                    resolve(row);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}

const create = (option, code, categories, users, coupon_type, amount_type, amount, expiry) => {
    try {
        return new Promise((resolve, reject) => {
            db('coupons').insert({option, code, categories, users, coupon_type, amount_type, amount, expiry, created_at, updated_at})
                .then(row => {
                    resolve(row);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}
const update = (id, categories, users, coupon_type, amount_type, amount, expiry) => {
    try {
        return new Promise((resolve, reject) => {
            db('coupons').where({id}).update({categories, users, coupon_type, amount_type, amount, expiry, created_at, updated_at})
                .then(row => {
                    resolve(row);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}

const readCoupons = () => {
    try {
        return new Promise((resolve, reject) => {
            db('coupons').orderBy('created_at','DESC')
                .then(rows => {
                    resolve(rows);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}

const updateStatus = async (id, status) => {
    return await new Promise((resolve, reject) => {
        db('coupons').where({id}).update({status})
            .then((data) => {
                resolve(data);
            }).catch(err => reject(err));
    });
}



module.exports = {
    findById,

    create,

    readCoupons,

    update,
    updateStatus
}
