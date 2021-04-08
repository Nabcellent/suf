const knex = require('knex');
const config = require('../../../../knexfile');
const db = knex(config.development)
const link = require("../../../Config/database");
const date = new Date();



const createProduct = async(title, seller_id, brand_id, category_id, label, base_price, discount,
                           main_image, keywords, description, is_featured) => {
    const values = {
        category_id,        seller_id,
        brand_id,           title,          main_image,
        discount,
        keywords,           description,    is_featured,
        label,              base_price,
        created_at:date,    updated_at:date
    }
    try {
        return await new Promise((resolve, reject) => {
            db('products').insert(values)
                .then(rows => {
                    resolve(rows.length);
                }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const updateProductStatus = async(id, status) => {
    try {
        return await new Promise((resolve, reject) => {
            const qry = `UPDATE products SET status = ? WHERE id = ?`;

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
const updateVariationPrice = async(id, Price) => {
    try {
        return await new Promise((resolve, reject) => {
            const qry = `UPDATE variations_options SET extra_price = ? WHERE id = ?`;

            link.query(qry, [Price, id], (error, result) => {
                if(error)
                    reject(new Error(error.message));
                resolve(result.changedRows);
            })
        })
    } catch(error) {
        console.log(error);
    }
}
const updateVariationStock = async(id, stock) => {
    try {
        return await new Promise((resolve, reject) => {
            db('variations_options').where({id}).update({stock})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch(error) {
        return error;
    }
}
const updateStatus = async(title, id, status) => {
    try {
        return await new Promise((resolve, reject) => {
            db(title).where({id: id}).update({status})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const deleteVariation = async(id) => {
    try {
        return await new Promise((resolve, reject) => {
            db('variations').where({id}).del()
                .then(result => {
                    resolve(result);
                }).catch(err => reject(err));
        });
    } catch(err) {
        return err;
    }
}



module.exports = {
    /*********
     * CREATE
     * ********/
    createProduct,

    createAttribute: async(name, values) => {
        try {
            const VALUES = {
                name,          values:JSON.stringify(values),
                created_at:date,    updated_at:date
            }

            return await new Promise((resolve, reject) => {
                const qry = `INSERT INTO attributes SET ?`;

                link.query(qry, VALUES,(error, result) => {
                    if(error)
                        reject(new Error(error.message));
                    resolve(result.affectedRows);
                });
            });
        } catch(error) {
            console.log(error);
        }
    },

    createVariation: async(product_id, variation) => {
        try {
            const VALUES = {
                product_id, variation,
                created_at:date, updated_at:date
            }
            return await new Promise((resolve, reject) => {
                const qry = `INSERT INTO variations SET ?`;

                link.query(qry, VALUES, (error, result) => {
                    if(error)
                        reject(new Error(error.message));
                    resolve(result);
                });
            })
        } catch(error) {
            console.log(error);
        }
    },

    createVariationsOption: (variationId, variants) => {
        try {
            const insert = async (variation_id, variant) => {
                const VALUES = {
                    variation_id, variant
                }
                return await new Promise((resolve, reject) => {
                    const qry = `INSERT INTO variations_options SET ?`;

                    link.query(qry, VALUES, (error, result) => {
                        if (error)
                            reject(new Error(error.message));
                        resolve(result.affectedRows);
                    })
                })
            }
            if(Array.isArray(variants)) {
                variants.forEach(variant => {
                    insert(variationId, variant)
                        .then()
                        .catch(error => {return console.log(error)});
                });

                return true;
            } else {
                insert(variationId, variants)
                    .then()
                    .catch(error => {return console.log(error)});
            }
        } catch(error) {
            console.log(error);
        }
    },

    createImage: async(product_id, image) => {
        try {
            const VALUES = {product_id, image, created_at:date, updated_at:date};

            return await new Promise((resolve, reject) => {
                const qry = `INSERT INTO products_images SET ?`;

                link.query(qry, VALUES, (error, result) => {
                    if (error) {
                        reject(new Error(error.message));
                    } else {
                        resolve(result.affectedRows);
                    }
                })
            })
        } catch (error) {
            console.log(error);
        }
    },


    /*********
     * UPDATE
     * ********/
    updateProduct: async(id, category_id, seller_id, title, keywords, description, is_featured, label, base_price
                         , discount, brand_id) => {
        try {
            discount = discount.trim() === "" ? 0 : discount;
            is_featured = (is_featured === 'on') ? "Yes" : "No";
            const VALUES = [
                category_id,    seller_id,      title,
                keywords,       description,    is_featured,
                label,          base_price,
                discount,       brand_id,       date,
                id
            ]

            return await new Promise((resolve, reject) => {
                const qry = `UPDATE products SET category_id = ?, seller_id = ?, title = ?, keywords = ?, description = ?,
                    is_featured = ?, label = ?, base_price = ?, discount = ?, brand_id = ?, updated_at = ?
                    WHERE id = ?`;

                link.query(qry, VALUES, (err, result) => {
                    if(err)
                        reject(new Error(err.message));
                    resolve(result.changedRows);
                })
            })
        } catch(error) {
            console.log(error);
        }
    },
    updateProductStatus,
    updateVariationPrice,
    updateVariationStock,
    updateImageStatus: async(id, status) => {
        try {
            return await new Promise((resolve, reject) => {
                const qry = `UPDATE products_images SET status = ? WHERE id = ?`;

                link.query(qry, [status, id], (error, result) => {
                    if(error)
                        reject(new Error(error.message));
                    resolve(result.changedRows);
                })
            })
        } catch(error) {
            console.log(error);
        }
    },
    updateStatus,


    /*********
     * DELETE
     * ********/
    deleteProduct: async (id) => {
        try {
            return await new Promise((resolve, reject) => {
                link.query('DELETE FROM `products` WHERE `id` = ?', [id], (err, result) => {
                    if(err) {
                        reject(new Error(err.message));
                    } else{
                        resolve(result.affectedRows);
                    }
                });
            });
        } catch (error) {
            console.log(error)
        }
    },

    deleteImage: async (id) => {
        try {
            return await new Promise((resolve, reject) => {
                link.query('DELETE FROM `products_images` WHERE `id` = ?', [id], (err, result) => {
                    if(err) {
                        reject(new Error(err.message));
                    } else{
                        resolve(result.affectedRows);
                    }
                });
            });
        } catch (error) {
            console.log(error)
        }
    },

    deleteVariation,
}
