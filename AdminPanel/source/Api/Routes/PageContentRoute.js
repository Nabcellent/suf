const {Router} = require('express');
const router = Router();
const {BannerController} = require("../Controllers");
const {checkAuth} = require("../Middleware/checkAuthentication");

router.get('/banners', /*checkAuth,*/ BannerController.readBanners);

module.exports = router;
