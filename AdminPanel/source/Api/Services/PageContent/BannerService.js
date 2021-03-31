const link = require("../../../Config/database");

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
    updateBannerStatus,


    deleteBanner
}
