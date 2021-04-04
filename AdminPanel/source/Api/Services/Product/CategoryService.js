const link = require("../../../Config/database");

const knex = require('knex');
const config = require('../../../../knexfile');
const db = knex(config.development);

const date = new Date();


const createCategory = async(title, categoryId, description) => {
    try {
        description = description.toString();
        console.log(description);
        return await new Promise((resolve, reject) => {
            if(typeof categoryId === 'undefined') {
                const qry = "INSERT INTO categories(title, description, created_at, updated_at) VALUES (?, ?, ?, ?)";

                link.query(qry, [title, description, date, date], (err, result) => {
                    if (err) {
                        reject(new Error(err.message));
                    } else {
                        resolve(result.affectedRows);
                    }
                });
            } else {
                const qry = "INSERT INTO categories(title, description, section_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

                if(typeof categoryId === "object" && categoryId.length > 1) {
                    categoryId.forEach((id) => {
                        link.query(qry, [title, description, id, date, date], (err, result) => {
                            if (err) {
                                reject(new Error(err.message));
                            } else {
                                resolve(result.affectedRows);
                            }
                        });
                    });
                } else {
                    link.query(qry, [title, description, categoryId, date, date], (err, result) => {
                        if (err) {
                            reject(new Error(err.message));
                        } else {
                            resolve(result.affectedRows);
                        }
                    });
                }
            }
        });
    } catch(error) {
        console.log(error);
    }
    return name;
}
const createSubCategory = async(title, section_id, category_id, description) => {
    try {
        const VALUES = {
            title, section_id, category_id, description,
            created_at: date, updated_at:date
        };
        return await new Promise((resolve, reject) => {
            db('categories').insert(VALUES)
                .then(rows => {
                    resolve(rows.length);
                }).catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}

const updateCategory = async(id, title, section_id, description) => {
    try {
        return await new Promise((resolve, reject) => {
            db('categories').where({id}).update({title, section_id, description})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const updateSubCategory = async(id, title, section_id, category_id, description) => {
    try {
        return await new Promise((resolve, reject) => {
            db('categories').where({id}).update({title, section_id, category_id, description})
                .then(result => {
                    resolve(result);
                })
                .catch(error => reject(error));
        });
    } catch (error) {
        return error;
    }
}
const updateCategoryStatus = async(id, status) => {
    try {
        return await new Promise((resolve, reject) => {
            const qry = `UPDATE categories SET status = ? WHERE id = ?`;

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

const deleteCategory = async(id) => {
    try {
        return await new Promise((resolve, reject) => {
            link.query("DELETE FROM categories WHERE id = ?", id, (error, result) => {
                if(error) {
                    reject(new Error(error.message));
                } else {
                    resolve(result.affectedRows);
                }
            });
        })
    } catch(error) {
        console.log(error);
    }
}

module.exports = {
    /*********
     * CREATE
     * ********/
    createCategory,
    createSubCategory,

    updateCategory,
    updateSubCategory,
    updateCategoryStatus,

    deleteCategory
}
