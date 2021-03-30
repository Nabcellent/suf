const UserController = require('./UserController');
const AdminController = require('./AdminController');
const {ProductController, AddonController, CategoryController} = require('./Product');
const {BannerController} = require('./PageContent');

const JQueryController = require('./JQueryController');

module.exports = {
    AdminController,
    UserController,
    ProductController,
    JQueryController,
    AddonController,
    CategoryController,

    BannerController
}
