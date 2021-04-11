const {Router} = require('express');
const router = Router();
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

router.get('/create/:userType', UserController.getCreateUser);

router.route('/:id')
    .get(UserController.readProfile)
    .delete(UserController.deleteUser);


router.route('/customer')
    .get(UserController.readCustomer);


module.exports = router;
