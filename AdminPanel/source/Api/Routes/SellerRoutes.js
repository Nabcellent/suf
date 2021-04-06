const {Router} = require('express');
const router = Router();
const UserController = require("../Controllers/UserController");


router.route('/')
    .get(UserController.readSellers);



module.exports = router;
