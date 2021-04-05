const {validationResult} = require("express-validator");
const alertUser = require('../Helpers/alertMessage');

module.exports = {
    validate: async (req, res) => {
        const errors = validationResult(req);

        if(!errors.isEmpty()) {
            const error = errors.array()[0];
            alertUser(req, 'info', 'Something is missing!', error.msg);

            res.redirect('back');
            return true;
        } else {
            return false;
        }
    }
}
