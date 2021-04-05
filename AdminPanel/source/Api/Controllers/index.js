const UserController = require('./UserController');
const {ProductController, AddonController, CategoryController} = require('./Product');
const {BannerController, AdController} = require('./PageContent');

const JQueryController = require('./JQueryController');

module.exports = {
    UserController,
    ProductController,
    JQueryController,
    AddonController,
    CategoryController,

    BannerController,
    AdController
}
