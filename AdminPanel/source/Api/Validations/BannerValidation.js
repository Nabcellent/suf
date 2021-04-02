const {check} = require("express-validator");

module.exports = {
    create: () => {
        return [
            check("title", "Banner title is required.").not().isEmpty(),
        ]
    },

    update: () => {
        return [
            check("title", "Banner title is required.").not().isEmpty(),
        ]
    }
}
