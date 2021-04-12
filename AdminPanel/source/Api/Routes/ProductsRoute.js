const express = require('express');
const {CategoryValidation} = require("../Validations");
const router = express.Router();
const {ProductController, AddonController, JQueryController, CategoryController, CouponController} = require("../Controllers");
const {ProductValidation, VariationValidation, BrandValidation} = require("../Validations");

router
    .route('/')
    .get(ProductController.readProducts)
    .post(ProductValidation.create(), ProductController.createProduct)
    .put(ProductValidation.update(), ProductController.updateProduct)
    .delete(ProductController.deleteProduct);

router.put('/status', ProductController.updateProductStatus)

router
    .route('/create')
    .get((req, res) => {
        res.render('products/add_product', {Title: 'Add Product', layout: './layouts/nav'});
    })

router
    .route('/create/info')
    .get(ProductController.readProductCreate);



/***    DETAILS ROUTE
 * ********************************************************************************************************************/
router
    .route('/details/:id')
    .get(ProductController.readProductDetails);

router.route('/details/variation/:id')
    .delete(ProductController.deleteVariation)

router.post('/details/variation/create/:id', VariationValidation.create(), ProductController.createVariation);

router.put('/details/variation/set-price', ProductController.updateVariationPrice);
router.patch('/details/variation/set-stock', ProductController.updateVariationStock);

router.patch('/details/variation/status', ProductController.updateVariationStatus);
router.patch('/details/variation-option/status', ProductController.updateVariationOptionStatus);

router
    .route('/details/images')
    .post(ProductController.createImage)
    .put(ProductController.updateImageStatus)
    .delete(ProductController.deleteImage);



/***    CATEGORIES ROUTE
 * ********************************************************************************************************************/
router
    .route('/categories')
    .get(CategoryController.readCategories)
    .post(CategoryValidation.categoryCreate(), CategoryController.createCategory)
router.delete('/categories/:id', CategoryController.deleteCategory);

router.put('/category', CategoryController.updateCategory);
router.put('/sub-category', CategoryController.updateSubCategory);

router.put('/categories/status', CategoryController.updateCategoryStatus);

router.post('/sub-category', CategoryController.createSubCategory);



/***    COUPON ROUTES
 * ********************************************************************************************************************/

router
    .route('/coupons')
    .get(CouponController.readCoupons);



router
    .route('/attributes')
    .get(ProductController.readAttributes)
    .post(ProductController.createAttribute);

router
    .route('/brands')
    .get(AddonController.readBrands);

router
    .route('/addons/brand')
    .post(BrandValidation.create(), AddonController.createUpdateBrand)
    .put(BrandValidation.update(), AddonController.createUpdateBrand)
    .delete(AddonController.deleteBrand);

router.put('/addons/status', AddonController.updateBrandStatus)





/**
 * STATUS UPDATES    */

router.patch('/coupon-status', CouponController.updateStatus)


/**
 * JQUERY ROUTES    */
router.get('/details/attributeValues/:name', JQueryController.getAttributeValueById);

router.get('/get-categories/:id', JQueryController.getCategoryBySection);

router.get('/get-sub-category/:id', JQueryController.getSubCategoryByCategory);




module.exports = router;
