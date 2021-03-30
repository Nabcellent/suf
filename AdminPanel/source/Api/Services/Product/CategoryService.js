const link = require("../../../Config/database");
const date = new Date();


const createCategory = async(title, categoryId) => {
    try {
        return await new Promise((resolve, reject) => {
            if(typeof categoryId === 'undefined') {
                const qry = "INSERT INTO categories(title, created_at, updated_at) VALUES (?, ?, ?)";

                link.query(qry, [title, date, date], (err, result) => {
                    if (err) {
                        reject(new Error(err.message));
                    } else {
                        resolve(result.affectedRows);
                    }
                });
            } else {
                const qry = "INSERT INTO categories(title, section_id, created_at, updated_at) VALUES (?, ?, ?, ?)";

                if(typeof categoryId === "object" && categoryId.length > 1) {
                    categoryId.forEach((id) => {
                        link.query(qry, [title, id, date, date], (err, result) => {
                            if (err) {
                                reject(new Error(err.message));
                            } else {
                                resolve(result.affectedRows);
                            }
                        });
                    });
                } else {
                    link.query(qry, [title, categoryId, date, date], (err, result) => {
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
const createSubCategory = async(title, section_id, category_id) => {
    try{
        const VALUES = {
            title, section_id, category_id,
            created_at: date, updated_at:date
        };
        return await new Promise((resolve, reject) => {
            const sql = `INSERT INTO categories SET ?`;
            link.query(sql, VALUES, (err, result) => {
                if(err) {
                    reject(new Error(err.message));
                } else{
                    resolve(result.affectedRows);
                }
            });
        });
    } catch(error) {
        console.log(error);
    }
}

const updateCategory = async(id, title, section_id) => {
    try {
        return await new Promise((resolve, reject) => {
            const sql = "UPDATE categories SET title = ?, section_id = ? WHERE id = ?";
            link.query(sql, [title, section_id, id], (err, results) => {
                if(err) {
                    reject(new Error(err.message));
                } else {
                    resolve(results.changedRows);
                }
            });
        })
    } catch(error) {
        console.log(error);
    }
}
const updateSubCategory = async(id, title, section_id, category_id) => {
    try {
        return await new Promise((resolve, reject) => {
            const sql = "UPDATE categories SET title = ?, section_id = ?, category_id = ? WHERE id = ?";
            link.query(sql, [title, section_id, category_id, id], (err, results) => {
                if(err) {
                    reject(new Error(err.message));
                } else {
                    resolve(results.changedRows);
                }
            });
        })
    } catch(error) {
        console.log(error);
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
