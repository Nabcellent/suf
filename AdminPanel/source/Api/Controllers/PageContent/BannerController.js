const fs = require("fs")
const {dbRead} = require("../../../Database/query");
const {alertUser} = require('../../Helpers');
const {join} = require("path");
const createError = require('http-errors');
const {validationResult} = require("express-validator");
const {BannerService} = require("../../Services");

const createBanner = async (req, res, next) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const error = errors.array()[0];
        alertUser(req, 'info', 'Something is missing!', error.msg);

        return res.redirect('back');
    } else if (!req.files || Object.keys(req.files).length === 0) {
        return res.status(400).send('No files were uploaded.');
    } else {
        const {image} = req.files;
        let {name} = image;
        name = Math.floor((Math.random() * 1199999) + 1) + name;

        const pathToBannerImages = join(__dirname, '../../../../../public/images/banners/');
        try {
            await image.mv(pathToBannerImages + name, (error) => {
                if (error) {
                    throw createError(404, error.message);
                }
            });

            const {title, link, alt, description} = req.body;

            BannerService.createBanner(name, title, link, alt, description)
                .then(response => {
                    if(response instanceof Error) {
                        throw createError(404, response);
                    } else if(response === 1) {
                        alertUser(req, 'success', 'Success!', 'Banner Created.');
                    } else {
                        throw createError(404, 'Something went wrong');
                    }
                    res.redirect('back');
                }).catch(error => next(error));
        } catch (e) {
            next(e);
        }
    }
}
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
const updateBanner = async(req, res, next) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const error = errors.array()[0];
        alertUser(req, 'info', 'Something is missing!', error.msg);

        return res.redirect('back');
    } else {
        const {title, link, alt, description, banner_id} = req.body;

        try {
            BannerService.updateBanner(title, link, alt, description, banner_id)
                .then(response => {
                    if(response instanceof Error) {
                        throw createError(404, response);
                    } else if(response === 1) {
                        alertUser(req, 'success', 'Success!', 'Banner Info Updated.');
                    } else {
                        throw createError(404, 'Something went wrong');
                    }
                    res.redirect('back');
                })
        } catch (e) {
            next(e);
        }
    }
}
const deleteBanner = async(req, res) => {
    const {id, image} = req.body;
    const imagePath = join(__dirname, '../../../../../public/images/banners/' + image);

    try {
        BannerService.deleteBanner(id)
            .then(data => {
                if(data === 1) {
                    if(fs.existsSync(imagePath)) {
                        fs.unlink(imagePath, function(err) {
                            if (err) {
                                throw err.message;
                            } else {
                                alertUser(req, 'success', '', 'Banner Deleted!');
                                res.json(data);
                            }
                        });
                    }
                } else {
                    alertUser(req, 'danger', 'Error!', 'Something went wrong!');
                    res.json(data);
                }
            }).catch(error => console.log(error));
    } catch(error) {
        console.log(error);
        alertUser(req, 'danger', 'Error!', 'Something went wrong!');
        res.redirect('back');
    }
}

const updateBannerImage = async(req, res, next) => {
    if (!req.files || Object.keys(req.files).length === 0) {
        return res.status(400).send('No files were uploaded.');
    } else {
        const {image} = req.files;
        let {name} = image;
        name = Math.floor((Math.random() * 1199999) + 1) + name;

        let bannersImagesPath = join(__dirname, '../../../../../public/images/banners/');
        try {
            await image.mv(bannersImagesPath + name, (error) => {
                if (error) {
                    throw createError(404, error.message);
                }
            });

            const {banner_id, current_image} = req.body;
            bannersImagesPath = join(__dirname, '../../../../../public/images/banners/' + current_image);

            if(fs.existsSync(bannersImagesPath)) {
                fs.unlink(bannersImagesPath, function(err) {
                    if (err) {
                        throw createError(404, err.message);
                    }
                });
            }

            BannerService.updateBannerImage(banner_id, name)
                .then(response => {
                    if(response instanceof Error) {
                        throw createError(404, response);
                    } else if(response === 1) {
                        alertUser(req, 'success', 'Success! : ', 'Banner Updated!');
                    } else {
                        throw createError(404, 'Something went wrong');
                    }
                    res.redirect('back');
                }).catch(error => next(error));
        } catch (e) {
            next(e);
        }
    }
}

const updateBannerStatus = async(req, res) => {
    const {status, banner_id} = req.body;
    let newStatus = (status === 'Active') ? 0 : 1;

    try {
        BannerService.updateBannerStatus(banner_id, newStatus)
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
}



module.exports = {
    createBanner,
    readBanners,
    updateBanner,
    deleteBanner,

    updateBannerImage,

    updateBannerStatus
}
