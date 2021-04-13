const {join} = require("path");
const fs = require('fs');

const imageExists = (folderName, image) => {
    let subPath;
    switch (folderName){
        case 'seller': subPath = 'users/seller';
            break;
        case 'admin': subPath = 'users/admin';
            break;
        case 'customer': subPath = 'users/customer';
    }

    const path = join(__dirname, `../../../../public/images/${subPath}/${image}`);

    try {
        if ( fs.existsSync(path)) {
            return true;
        }
    } catch(err) {
        console.error(err)
    }
    return false;
}

const str_random = (length) => {
    let characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghiklmnopqrstuvwxyz1234567890";
    let string = '';

    //loop to select a new character in each iteration
    for (let i = 0; i < length; i++) {
        let rand = Math.floor(Math.random() * characters.length);
        string += characters.substring(rand, rand + 1);
    }

    return string;
}

const getTableByModel = (model) => {
    let table;

    switch(model.toLowerCase()) {
        case 'ad_box': table = 'ad_boxes'
            break;
        case 'address': table = 'addresses'
            break;
        case 'admin': table = 'admins'
            break;
        case 'attribute': table = 'attributes'
            break;
        case 'banner': table = 'banners'
            break;
        case 'brand': table = 'brands'
            break;
        case 'cart': table = 'cart'
            break;
        case 'category': table = 'categories'
            break;
        case 'coupon': table = 'coupons'
            break;
        case 'product': table = 'products'
            break;
        case 'product_image': table = 'products_images'
            break;
        case 'user': table = 'users'
            break;
        case 'variation': table = 'variations'
            break;
        case 'variation_option': table = 'variations_options'
            break;
    }

    return table;
}


module.exports = {
    imageExists,
    str_random,
    getTableByModel
}
