const {Router} = require('express');
const router = Router();
const {checkAuth} = require("../Middleware/checkAuthentication");
const {UserValidation} = require("../Validations");
const {UserController} = require("../Controllers");

/**
 * *************************************************************  LOGIN  ********************
 */

//router.get('/');       //  Finds all users
//router.post('/');      //  Creates a user
//router.get('/:id');       //  Finds user details
//router.delete('/:id');    //  Deletes a user
//router.patch('/:id');     //  Updates a user

router.route('/')
    .post(UserValidation.create(), UserController.createUser);
router.route('/:id')
    .get(UserController.readProfile);


router.route('/seller')
    .get(UserController.readSeller);

router.route('/customer')
    .get(UserController.readCustomer);


module.exports = router;
