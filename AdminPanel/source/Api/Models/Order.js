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

const readOrders = () => {
    try {
        return new Promise((resolve, reject) => {
            db('orders')
                .join('users', {'orders.user_id': 'users.id'})
                .join('phones', {'orders.phone_id': 'phones.id'})
                .select('orders.*', 'users.email', 'phones.phone')
                .orderBy('orders.created_at','DESC')
                .then(rows => {
                    resolve(rows);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}
const readOrder = (id) => {
    try {
        return new Promise((resolve, reject) => {
            db('orders').where({'orders.id': id}).first()
                .join('users', {'orders.user_id': 'users.id'})
                .join('phones', {'orders.phone_id': 'phones.id'})
                .join('addresses', {'orders.address_id': 'addresses.id'})
                .join('sub_counties', {'addresses.sub_county_id': 'sub_counties.id'})
                .join('counties', {'sub_counties.county_id': 'counties.id'})
                .leftJoin('coupons', {'coupon_id': 'coupons.id'})
                .select('orders.*', 'users.email', 'first_name', 'last_name', 'gender', 'coupons.code',
                    'image','phones.phone', 'addresses.address', 'sub_counties.name AS subCounty', 'counties.name AS county')
                .orderBy('orders.created_at','DESC')
                .then(async order => {
                    order.orderProducts = await db('orders_products').where({order_id: order.id})
                        .join('products', {'product_id': 'products.id'})
                        .join('brands', {'products.brand_id': 'brands.id'})
                        .join('sellers', {'products.seller_id': 'sellers.user_id'})
                        .select('orders_products.*', 'products.title', 'products.main_image', 'brands.name AS brand', 'sellers.username')
                        .then(async orderProducts => {
                            return orderProducts;
                        }).catch(err => reject(err));
                    resolve(order);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}

const updateStatus = (id, status) => {
    return new Promise((resolve, reject) => {
        db('orders').where({id}).update({status})
            .then((data) => {
                resolve(data);
            }).catch(err => reject(err));
    });
}



module.exports = {
    findById,

    readOrders,
    readOrder,

    update,
    updateStatus
}
