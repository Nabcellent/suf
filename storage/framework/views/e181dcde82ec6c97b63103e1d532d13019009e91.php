<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>td{padding:10px!important}#invoice{padding:30px}.invoice{position:relative;background-color:#fff;min-height:680px;padding:15px}.invoice header{padding:10px 0;margin-bottom:20px;border-bottom:1px solid #9f1910FF}.invoice .company-details{text-align:right}.invoice .company-details .name{margin-top:0;margin-bottom:0}.invoice .contacts{margin-bottom:20px}.invoice .invoice-to{text-align:left}.invoice .invoice-to .to{margin-top:0;margin-bottom:0}.invoice .invoice-details{text-align:right}.invoice .invoice-details .invoice-id{margin-top:0;color:#3989c6}.invoice main{padding-bottom:50px}.invoice main .thanks{margin-top:-100px;font-size:2em;margin-bottom:50px}.invoice main .notices{display:flex;justify-content:space-between;padding-left:6px;border-left:6px solid #3989c6}.invoice main .notices .notice{font-size:1.2em}.invoice table{width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:20px}.invoice table td,.invoice table th{padding:15px;background:#eee;border-bottom:1px solid #fff}.invoice table th{white-space:nowrap;font-weight:400;font-size:16px}.invoice table td h3{margin:0;font-weight:400;color:#3989c6;font-size:1.2em}.invoice table .qty,.invoice table .total,.invoice table .unit{text-align:right;font-size:1.2em}.invoice table .no{color:#fff;font-size:1.6em;background:#3989c6}.invoice table .unit{background:#ddd}.invoice table .total{background:#3989c6;color:#fff}.invoice table tbody tr:last-child td{border:none}.invoice table tfoot td{background:0 0;border-bottom:none;white-space:nowrap;text-align:right;padding:10px 20px;font-size:1.2em;border-top:1px solid #aaa}.invoice table tfoot tr:first-child td{border-top:none}.invoice table tfoot tr:last-child td{color:#3989c6;font-size:1.4em;border-top:1px solid #3989c6}.invoice table tfoot tr td:first-child{border:none}.invoice-footer{position:relative;width:100%;text-align:center;color:#777;border-top:1px solid #9f1910FF;padding:8px 0}@media  print{.invoice{font-size:11px!important;overflow:hidden!important}.invoice footer{position:absolute;bottom:10px;page-break-after:always}.invoice>div:last-child{page-break-before:always}}</style>
</head>
<body>
<div class="invoice overflow-auto">
    <div style="min-width: 600px">
        <header class=" p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col p-0 m-0">
                    <h4>ORDER #<?php echo e($order['id']); ?></h4>
                    <div class="date">Order Date: <?php echo e(date('M d, Y', strtotime($order['created_at']))); ?> </div>
                </div>
                <div class="col company-details">
                    <h2 class="name">
                        <a target="_blank" href="https://lobianijs.com" style="color: #9F1910FF;">
                            SU-FASHION
                        </a>
                    </h2>
                    <div>455 Foggy Heights, AZ 85004, US</div>
                    <div>+254 110-039-317</div>
                    <a href="mailto:su.fashion10@gmail.com" style="color: #9F1910FF;">su.fashion10@gmail.com</a>
                </div>
            </div>
        </header>
        <main>
            <div class="row contacts">
                <div class="col invoice-to">
                    <div class="text-gray-light">INVOICE TO:</div>
                    <h2 class="to"><?php echo e($order['user']['first_name']); ?> <?php echo e($order['user']['last_name']); ?></h2>
                    <div class="address"><?php echo e($order['address']['address']); ?>, <?php echo e($order['address']['sub_county']['name']); ?>, <?php echo e($order['address']['sub_county']['county']['name']); ?></div>
                    <div class="email"><a href="mailto:<%= order.email %>"><?php echo e($order['user']['email']); ?></a></div>
                    <div class="email"><a href="tel:0<%= order.phone %>">+254-<?php echo e($order['phone']['phone']); ?></a></div>
                </div>
                <div class="col invoice-details">
                    <h1 class="invoice-id">INVOICE 3-2-1</h1>
                    <div class="date">Date of Invoice: 01/10/2018</div>
                    <div class="date">Due Date: 30/10/2018</div>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th class="text-left">DESCRIPTION</th>
                    <th class="text-right">UNIT PRICE</th>
                    <th class="text-right">QUANTITY</th>
                    <th class="text-right">TOTAL</th>
                </tr>
                </thead>
                <tbody>

                <?php $total = 0 ?>
                <?php $__currentLoopData = $order['order_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="no"><?php echo e(sprintf("%02d", $loop->iteration)); ?></td>
                        <td class="text-left">
                            <h3><a href="<?php echo e(url('/product/' . $item['product_id'] . '/'. $item['product']['title'])); ?>"><?php echo e($item['product']['title']); ?></a></h3>
                            <?php $detailsArr = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR); ?>
                            <?php $__currentLoopData = $detailsArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="m-0"><?php echo e($key); ?>: <?php echo e($value); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="unit"><?php echo e(currencyFormat($item['final_unit_price'])); ?></td>
                        <td class="qty"><?php echo e($item['quantity']); ?></td>
                        <td class="total">KES <?php echo e(currencyFormat($item['final_unit_price'] * $item['quantity'])); ?>/-</td>
                    </tr>
                    <?php $total += ($item['final_unit_price'] * $item['quantity']) ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUB-TOTAL</td>
                    <td><?php echo e(currencyFormat($total)); ?>/=</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">DISCOUNT</td>
                    <td><?php echo e(currencyFormat($order['discount'])); ?>/=</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td><?php echo e(currencyFormat($order['total'])); ?>/=</td>
                </tr>
                </tfoot>
            </table>
            <div class="thanks">Thank you!</div>
            <div class="notices">
                <div>
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
                <div><h5>Payment Method: <?php echo e(ucfirst($order['payment_method'])); ?></h5></div>
            </div>
        </main>
        <footer class="invoice-footer">
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </div>
    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
    <div></div>
</div>
</body>
</html>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/invoice_template.blade.php ENDPATH**/ ?>