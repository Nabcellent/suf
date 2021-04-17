const express = require('express');
const {OrderController} = require("../Controllers");
const router = express.Router();

router.get('/', OrderController.readOrders);

router.get('/view/:id', OrderController.readOrder);

router.get('/invoice/:id', OrderController.readInvoice);

router.patch('/status', OrderController.updateStatus);



module.exports = router;
