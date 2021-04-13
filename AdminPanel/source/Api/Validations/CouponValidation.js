const {check} = require("express-validator");

module.exports = {
    create: () => {
        return [
            check("option", "Option is required")
                .if((value, { req }) => !req.params.id)
                .not().isEmpty().bail(),
            check('categories', "Categories field is required")
                .not().isEmpty(),
            check('coupon_type', "Coupon type is required")
                .not().isEmpty(),
            check('amount_type')
                .not().isEmpty(),
            check('amount', "Categories field is required")
                .not().isEmpty().isFloat(),
            check('expiry_date', "Categories field is required")
                .not().isEmpty().isDate(),
        ];
    },

    update: () => {
        return [
            check("name", "Name is required").not().isEmpty(),
        ]
    }
}
