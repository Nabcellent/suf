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
                const qry = "INSERT INTO categories(title, category_id, created_at, updated_at) VALUES (?, ?, ?, ?)";

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
const createSubCategory = async(title, category_id, sub_category_id) => {
    try{
        const VALUES = {
            title, category_id, sub_category_id,
            created_at: date, updated_at:date
        };
        console.log(VALUES);
        return await new Promise((resolve, reject) => {
            const sql = `INSERT INTO categories SET ?`;
            link.query(sql, VALUES, (err, result) => {
                if(err) {
                    reject(new Error(err.message));
                } else{
                    resolve(result.affectedRows);
                }
            });
        })
    } catch(error) {
        console.log(error);
    }
}

const readCategories = async () => {
    try {
        return await new Promise((resolve, reject) => {
            let qry = `SELECT section.id, section.title AS sectionTitle, cat.title, subCat.title AS catTitle, section.status
                        FROM categories AS section
                        LEFT JOIN categories AS cat ON section.category_id = cat.id
                        LEFT JOIN categories AS subCat ON section.sub_category_id = subCat.id
                        WHERE section.category_id IS NOT NULL OR section.sub_category_id IS NOT NULL
                        ORDER BY section.updated_at DESC`;

            link.query(qry, (err, results) => {
                if(err) {
                    reject(new Error(err.message));
                } else {
                    resolve(results);
                }
            });
        });
    } catch(error) {
        console.log(error);
    }
}

const updateCategory = async(id, title) => {
    try {
        return await new Promise((resolve, reject) => {
            link.query("UPDATE categories SET title = ? WHERE id = ?", [title, id], (err, results) => {
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

const deleteSubCategory = async(id) => {
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

    readCategories,

    updateCategory,
    updateCategoryStatus,

    deleteSubCategory
}
