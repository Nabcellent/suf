const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development);
let created_at  = new Date();
let updated_at = new Date();

const updateStatus = async (id, status) => {
    return await new Promise((resolve, reject) => {
        db('coupons').where({id}).update({status})
            .then((data) => {
                resolve(data);
            }).catch(err => reject(err));
    });
}



module.exports = {
    updateStatus
}
