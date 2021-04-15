const express = require('express');
const {OrderController} = require("../Controllers");
const router = express.Router();

router.get('/', OrderController.readOrders);

router.get('/view/:id', OrderController.readOrder);

router.patch('/status', OrderController.updateStatus);



module.exports = router;
