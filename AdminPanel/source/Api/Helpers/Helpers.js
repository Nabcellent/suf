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


module.exports = {
    imageExists
}


//  Knex queries
const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development);
