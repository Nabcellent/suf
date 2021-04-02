const link = require("../../../Config/database");
//  Knex queries
const knex = require('knex');
const config = require('../../../../knexfile');
const db = knex(config.development);

const createBanner = async (image, title, link, alt, description) => {
    try {
        return await new Promise((resolve, reject) => {
            db('banners').insert({image, title, link, alt, description})
                .then(rows => {
                    resolve(rows.length);
                }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const updateBanner = async (title, link, alt, description, id) => {
    try {
        return await new Promise((resolve, reject) => {
            db('banners').where({id: id}).update({title, link, alt, description})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const updateBannerImage = async (id, image) => {
    try {
        return await new Promise((resolve, reject) => {
            db('banners').where({id}).update({image})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const updateBannerStatus = async(id, status) => {
    try {
        return await new Promise((resolve, reject) => {
            const qry = `UPDATE banners SET status = ? WHERE id = ?`;

            link.query(qry, [status, id], (error, result) => {
                if(error)
                    reject(new Error(error.message));
                resolve(result.changedRows);
            })
        })
    } catch(error) {
        console.log(error);
    }
}


const deleteBanner = async(id) => {
    try {
        return await new Promise((resolve, reject) => {
            link.query("DELETE FROM banners WHERE id = ?", id, (error, result) => {
                if(error) {
                    reject(new Error(error.message));
                } else {
                    resolve(result.affectedRows);
                }
            });
        })
    } catch(error) {
        console.log(error.message);
    }
}

module.exports = {
    createBanner,
    updateBanner,

    updateBannerImage,

    updateBannerStatus,

    deleteBanner
}
