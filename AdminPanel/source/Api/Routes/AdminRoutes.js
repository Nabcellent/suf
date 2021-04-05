const {Router} = require('express');
const router = Router();
const UserController = require("../Controllers/UserController");


router.route('/')
    .get(UserController.readAdmins);

router.get('/create', UserController.getCreateUser);

module.exports = router;
