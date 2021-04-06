const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development)
const bcrypt = require('bcryptjs');
let created_at  = new Date();
let updated_at = new Date();

const createUser = async(first_name, last_name, gender, user_type, email, password, image, ip_address) => {
    gender = gender.toLowerCase() === 'm' ? 'Male' : 'Female';
    password = await bcrypt.hash(password, 10);

    try {
        return await new Promise((resolve, reject) => {
            db('users').insert({
                first_name, last_name, gender, user_type, email, password,
                ip_address, image, created_at, updated_at
            }).then(rows => {
                resolve(rows);
            }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const createAdmin = async (user_id, national_id, username, pin) => {
    try {
        return await new Promise((resolve, reject) => {
            db('admins').insert({user_id, national_id, username, pin, created_at, updated_at}).then(rows => {
                resolve(rows.length);
            }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const createSeller = async (user_id, national_id, username, pin) => {
    try {
        return await new Promise((resolve, reject) => {
            db('sellers').insert({user_id, national_id, username, pin, created_at, updated_at}).then(rows => {
                resolve(rows.length);
            }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const createAddress = async (user_id, phone, address_one) => {
    try {
        return await new Promise((resolve, reject) => {
            db('addresses').insert({user_id, phone, address_one, created_at, updated_at}).then(rows => {
                resolve(rows.length);
            }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const readAdmins = () => {
    try {
        return new Promise((resolve, reject) => {
            db('users')
                .join('admins', 'users.id', 'admins.user_id')
                .join('addresses', 'users.id', 'addresses.user_id')
                .where('user_type', 'Admin')
                .then(rows => {
                    resolve(rows);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}
const readSellers = () => {
    try {
        return new Promise((resolve, reject) => {
            db('users')
                .join('sellers', 'users.id', 'sellers.user_id')
                .join('addresses', 'users.id', 'addresses.user_id')
                .where('user_type', 'Seller')
                .then(rows => {
                    resolve(rows);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}

module.exports = {
    createUser,
    createAdmin,
    createSeller,
    createAddress,

    readAdmins,
    readSellers,
}
