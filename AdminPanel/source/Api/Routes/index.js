const express = require('express');
const router = express();
const generalRoute = require('./GeneralRoute');
const productsRoute = require('./ProductsRoute');
const pageContentRoutes = require('./PageContentRoutes');
const ordersRoute = require('./OrdersRoute');
const usersRoute = require('./UsersRoute');
const adminRoutes = require('./AdminRoutes');
const sellerRoutes = require('./SellerRoutes');
const authRoute = require('./AuthRoute');
const deleteRoutes = require('./DeleteRoutes');

router.use('/auth', /*checkAuth,*/ authRoute);
router.use('/users', /*checkAuth,*/ usersRoute);
router.use('/admins', /*checkAuth,*/ adminRoutes);
router.use('/sellers', /*checkAuth,*/ sellerRoutes);
router.use('/products', /*checkAuth,*/ productsRoute);
router.use('/orders', /*checkAuth,*/ ordersRoute);
router.use('/payments', /*checkAuth,*/ ordersRoute);
router.use('/content', /*checkAuth,*/ pageContentRoutes);
router.use('/delete', /*checkAuth,*/ deleteRoutes);


router.use(generalRoute);



const TestController = require('../../../Test/Test');

router.route('/test')
    .get(TestController.test);

module.exports = router;







/*******
 * QUERY BUILDER PARAMS EXAMPLE
 * *
 const sqlParams = {
    table: 'orders',
    join: [
        ['customers', 'orders.customer_id = customers.customer_id'],
        ['products', 'orders.product_id = products.product_id']
    ],
    where: [
        ['amount_due', '>=' ,1000],
        ['amount_due', '<' ,3000]
    ],
    orderBy: ['amount_due DESC'],
    groupBy: ['table.column'],
    limit: 5
}*/
