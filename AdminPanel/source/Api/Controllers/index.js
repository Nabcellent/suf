const UserController = require('./UserController');
const AdminController = require('./AdminController');
const {ProductController, AddonController, CategoryController} = require('./Product');
const {BannerController, AdController} = require('./PageContent');

const JQueryController = require('./JQueryController');

module.exports = {
    AdminController,
    UserController,
    ProductController,
    JQueryController,
    AddonController,
    CategoryController,

    BannerController,
    AdController
}
