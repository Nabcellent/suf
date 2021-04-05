const {dbCheck} = require("../../Database/query");
const {check} = require("express-validator");

module.exports = {
    create: () => {
        return [
            check('first_name', 'First name is required')
                .not().isEmpty()
                .isAlpha().withMessage('First name can only contain letters'),
            check('last_name', 'Last name is required')
                .not().isEmpty()
                .isAlpha().withMessage('Last name can only contain letters'),
            check('password')
                .isLength({ min: 1 }).withMessage('Password min length is 3'),
            check('confirmPassword')
                .custom(async (confirmPassword, {req}) => {
                    const password = req.body.password;
                    if(password !== confirmPassword){
                        throw new Error('Passwords must be same!')
                    }
                }),
            check('email').custom(async (value) => {
                if(!await dbCheck.getCheckInstance().checkEmail('users', 'email', value))
                    return true;
                throw new Error('Email is in use!');
            }),
            check('phone').custom(async (value) => {
                if(!await dbCheck.getCheckInstance().checkEmail('addresses', 'phone', value))
                    return true;
                throw new Error('Phone number is in use!');
            }),
            check('gender').custom((value) => {
                if (value.toLowerCase() === "m" || value.toLowerCase() === "f")
                    return true;
                throw new Error('Invalid Gender');
            })
        ]
    },

    update: () => {
        return [
            check("name", "Name is required").not().isEmpty(),
        ]
    }
}
