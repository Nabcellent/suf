const express = require('express');
const {Help} = require("../Helpers");
const router = express.Router();
const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development);

router.delete('/:id/:model', async (req, res) => {
    let {id, model} = req.params;
    const table = Help.getTableByModel(model);

    try {
        db(table).where({id}).del()
            .then(result => {
                res.json(result);
            }).catch(err => res.json({err}));
    } catch(err) {
        res.json({err});
    }
});


router.get('/:id/:model', async (req, res) => {
    /*const getOrderData = async () => {
        const data = {
            orders: [],
            moment: moment
        };

        (await dbRead.getReadInstance().getFromDb({
            table: 'orders',
            join: [
                ['users', 'orders.user_id = users.id'],
                ['products', 'orders.pro_id = products.id']
            ],
            orderBy: ['order_date DESC']
        })).forEach((row) => {data.orders.push(row)});

        return data;
    }

    try {
        const data = await getOrderData();

        res.render('pages/orders', {Title: 'Orders', layout: './layouts/nav', orderInfo: data});
    } catch(error) {
        console.log(error);
    }*/
});

module.exports = router;
