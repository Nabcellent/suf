const {Router} = require('express');
const router = Router();
const {BannerValidation} = require("../Validations");
const {BannerController, AdController} = require("../Controllers");
const {checkAuth} = require("../Middleware/checkAuthentication");

router.route('/banners')
    .get(/*checkAuth,*/ BannerController.readBanners)
    .post(BannerValidation.create(), BannerController.createBanner)
    .put(BannerValidation.update(), BannerController.updateBanner)
    .delete(/*checkAuth,*/ BannerController.deleteBanner);
router.put('/banner-image', BannerController.updateBannerImage);

router.put('/banner-status', BannerController.updateBannerStatus);



router.get('/ads', /*checkAuth,*/ AdController.readAds);

module.exports = router;
