const {BannerService} = require("../../Services");
const {dbRead} = require("../../../Database/query");
const {alert} = require('../../Helpers');
const {join} = require("path");
const fs = require("fs")
const createError = require('http-errors');

const readBanners = async(req, res, next) => {
    const getBannerData = async () => {
        return {
            banners: await dbRead.getReadInstance().getFromDb({
                table: 'banners',
            })
        };
    }

    try {
        const data = await getBannerData();

        if(typeof data.banners == 'undefined') throw createError(404, 'Unable to retrieve banners');

        res.render('page-content/banners', {Title: 'Products', layout: './layouts/nav', bannerInfo: data});
    } catch(error) {
        console.log(error);
        next(error);
    }
}
const deleteBanner = async(req, res) => {
    const {id, image} = req.body;
    const imagePath = join(__dirname, '../../../../../public/images/banners/' + image);

    try {
        BannerService.deleteBanner(id)
            .then(data => {
                if(data === 1) {
                    fs.unlink(imagePath, function(err) {
                        if (err) {
                            throw err.message;
                        } else {
                            alert(req, 'success', '', 'Banner Deleted!');
                        }
                        res.redirect('back');
                    })
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                    res.redirect('back');
                }
            }).catch(error => console.log(error));
    } catch(error) {
        console.log(error);
        alert(req, 'danger', 'Error!', 'Something went wrong!');
        res.redirect('back');
    }
}

const updateBannerStatus = async(req, res) => {
    const {status, banner_id} = req.body;
    let newStatus = (status === 'Active') ? 0 : 1;

    try {
        BannerService.updateBannerStatus(banner_id, newStatus)
            .then((data) => {
                if(data === 1) {
                    alert(req, 'success', '', 'Status Updated!');
                    return res.json({status: newStatus});
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                    return res.json({errors: {message: 'Internal error. Contact Admin'}});
                }
            }).catch(error => console.log(error));
    } catch(error) {
        console.log(error);
        alert(req, 'danger', 'Error!', 'Something went wrong!');
        res.redirect('back');
    }
}



module.exports = {
    readBanners,
    deleteBanner,

    updateBannerStatus
}
