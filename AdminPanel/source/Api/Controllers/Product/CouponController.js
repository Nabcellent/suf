const {dbRead} = require("../../../Database/query");
const moment = require('moment');
const {Coupon} = require("../../Models");


const readCoupons = async (req, res, next) => {
    try {
        const coupons = await dbRead.getReadInstance().getFromDb({
            table: 'coupons',
        });

        res.render('products/coupons', {Title: 'Coupons', layout: './layouts/nav', moment, coupons});
    } catch(error) {
        next(error);
    }
}

const updateStatus = async (req, res) => {
    let {status, id} = req.body;
    status = (status === 'Active') ? 0 : 1;

    try {
        Coupon.updateStatus(id, status)
            .then((data) => {
                if(data === 1) {
                    return res.json({status});
                } else {
                    return res.json({errors: {message: 'Internal error. Contact Admin'}});
                }
            }).catch(error => console.log(error));
    } catch(err) {
        res.json(err);
    }
}



module.exports = {
    readCoupons,

    updateStatus
}
