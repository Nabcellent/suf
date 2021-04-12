const AddonService = require("../../Services/Product/AddonService");
const {validationResult} = require("express-validator");
const {dbRead} = require("../../../Database/query");
const {alertUser} = require('../../Helpers');


const readBrands = async (req, res, next) => {
    try {
        const brands = await dbRead.getReadInstance().getFromDb({
            table: 'brands',
            columns: 'id, name, status',
        });

        res.render('products/brands', {Title: 'Brands', layout: './layouts/nav', brands});
    } catch(error) {
        next(error);
    }
}


module.exports = {
    readBrands,


    createUpdateBrand: async(req, res) => {
        const errors = validationResult(req);

        if(!errors.isEmpty()) {
            const error = errors.array()[0];
            alertUser(req, 'info', 'Something is missing!', error.msg);
            return res.redirect('back');
        }

        let result;
        if (req.method === 'POST') {
            const {name, status} = req.body;
            result = AddonService.createBrand(name, status)
        } else if(req.method === 'PUT') {
            const {brand_id, name, status} = req.body;
            result = AddonService.updateBrand(brand_id, name, status)
        }

        try {
            result
                .then(data => {
                    if(data === 1) {
                        alertUser(req, 'success', 'Success!', 'Action Completed.')
                    } else {
                        alertUser(req,'danger', 'Error!', 'Unable to complete action.')
                    }
                    res.redirect('back');
                }).catch(err => console.log(err));
        } catch (error) {
            console.log(error);
            res.status(502).send("something wrong!");
        }
    },

    deleteBrand: async(req, res) => {
        try {
            AddonService.deleteBrand(req.body.brand_id)
                .then(data => {
                    if(data === 1) {
                        alertUser(req, 'success', '', 'Brand deleted');
                    } else {
                        alertUser(req, 'danger', 'Error!', 'Something went wrong!');
                    }
                    res.redirect('back');
                }).catch(error => console.log(error));
        } catch(error) {
            console.log(error);
            alertUser(req, 'danger', 'Error!', 'Something went wrong!');
            res.redirect('back');
        }
    },

    updateBrandStatus: async(req, res) => {
        const {status, brand_id} = req.body;
        let newStatus = (status === 'Active') ? 0 : 1;

        try {
            AddonService.updateBrandStatus(brand_id, newStatus)
                .then((data) => {
                    if(data === 1) {
                        alertUser(req, 'success', '', 'Status Updated!');
                        return res.json({status: newStatus});
                    } else {
                        alertUser(req, 'danger', 'Error!', 'Something went wrong!');
                        return res.json({errors: {message: 'Internal error. Contact Admin'}});
                    }
                }).catch(error => console.log(error));
        } catch(error) {
            console.log(error);
            alertUser(req, 'danger', 'Error!', 'Something went wrong!');
            res.redirect('back');
        }
    },
}
