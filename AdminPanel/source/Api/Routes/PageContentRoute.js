const {Router} = require('express');
const router = Router();
const {BannerController, AdController} = require("../Controllers");
const {checkAuth} = require("../Middleware/checkAuthentication");

router.route('/banners')
    .get(/*checkAuth,*/ BannerController.readBanners)
    .delete(/*checkAuth,*/ BannerController.deleteBanner)

router.put('/banner-status', BannerController.updateBannerStatus);



router.get('/ads', /*checkAuth,*/ AdController.readAds);

module.exports = router;
