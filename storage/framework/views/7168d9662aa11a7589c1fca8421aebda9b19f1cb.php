
<div class="box bg-light p-3 rounded shadow">
    <div class="row">
        <div class="col">
            <h1>My Orders</h1>
            <p class="lead">Your Orders in one place</p>
            <p class="text-muted">If your have any Queries, please <a href="<?php echo e(url('/contact-us')); ?>">contact us</a></p>
        </div>
        <div class="dropdown-divider"></div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <?php if(count($orders) > 0): ?>
                    <table class="table table-striped table-borderless table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Order No.</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="accordion">

                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-toggle="collapse" data-target="#order-products<?php echo e($order['id']); ?>" style="cursor: pointer">
                                <th scope="row"><?php echo e($order['id']); ?></th>
                                <td>KES.<?php echo e(currencyFormat($order['total'])); ?>/=</td>
                                <td><?php echo e(ucfirst($order['payment_method'])); ?> <?php echo e(ucfirst($order['payment_type'])); ?></td>
                                <td><?php echo e(date('M d, Y', strtotime($order['created_at']))); ?></td>
                                <td><?php echo e($order['status']); ?></td>
                                <td>
                                    <a href="<?php echo e(url('#')); ?>" target='_blank' class='text-nowrap morphic_btn morphic_btn_success'>
                                        <span><i class='fas fa-clipboard-check'></i> Confirm Paid</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="p-0">
                                    <div class="ml-3 collapse" data-parent="#accordion" id="order-products<?php echo e($order['id']); ?>">
                                        <table class="table table-sm table-bordered small">
                                            <thead>
                                            <tr>
                                                <th>product(s)</th>
                                                <th>Details</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Sub-Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $total = 0; ?>
                                            <?php $__currentLoopData = $order['order_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR); ?>
                                                <tr>
                                                    <td><?php echo e($item['product']['title']); ?></td>
                                                    <td>
                                                        <?php if(count($details) > 0): ?>
                                                            <?php echo e(mapped_implode(', ', $details, ': ')); ?>

                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($item['quantity']); ?></td>
                                                    <td><?php echo e(currencyFormat($item['final_unit_price'])); ?>/-</td>
                                                    <td><?php echo e(currencyFormat($item['final_unit_price'] * $item['quantity'])); ?>/=</td>
                                                </tr>
                                                <?php $total += $item['final_unit_price'] ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($order['discount'] > 0): ?>
                                                <tr class="border-0">
                                                    <th colspan="4" class="text-right">Total Discount:</th>
                                                    <td colspan="3"><?php echo e(currencyFormat($order['discount'])); ?>/=</td>
                                                </tr>
                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <div class='p-5'>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <h1 class='display-1'><i class='fab fa-shopify'></i></h1>
                        </div>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <h4>You Haven't placed any orders yet...</h4>
                        </div>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <a href="<?php echo e(url('/products')); ?>" class='btn btn-info'><i class='bx bx-run bx-flip-horizontal' ></i> Wanna do some Shopping? 😁</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/orders.blade.php ENDPATH**/ ?>