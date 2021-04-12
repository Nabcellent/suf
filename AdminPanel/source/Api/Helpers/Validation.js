const {validationResult} = require("express-validator");
const alertUser = require('../Helpers/alertMessage');



module.exports = {
    validate: (req, res, next) => {
        const errors = validationResult(req);
        if(!errors.isEmpty()) {
            const error = errors.array()[0];
            alertUser(req, 'info', 'Something is amiss!', error.msg);

            res.redirect('back');
            return true;
        } else {
            next();
        }
    }
}
