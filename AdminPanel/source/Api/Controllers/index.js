const UserController = require('./UserController');
const OrderController = require('./OrderController');
const {ProductController, AddonController, CategoryController, CouponController} = require('./Product');
const {BannerController, AdController} = require('./PageContent');

const JQueryController = require('./JQueryController');

module.exports = {
    UserController,
    ProductController,
    JQueryController,
    AddonController,
    CategoryController,

    BannerController,
    AdController,
    CouponController,

    OrderController
}
