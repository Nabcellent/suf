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


module.exports = {
    imageExists,
    str_random
}
