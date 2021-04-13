<?php $__env->startSection('title', 'CheckOut'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/partials/top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
    use App\Models\Cart;

    ?>

    <div id="checkout" class="container">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <form class="col-md-11 col-sm-12">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="m-0 text-right">Checkout</h3>
                        <hr class="mt-0">
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="m-0">Delivery Addresses</h5>
                                        <a href="<?php echo e(url('/account/delivery-address')); ?>" class="btn btn-outline-info" style="border: none; border-bottom: 1px solid;">Add Address</a>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text custom">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="address<?php echo e($address['id']); ?>" name="address" class="custom-control-input" value="<?php echo e($address['id']); ?>">
                                                        <label class="custom-control-label" for="address<?php echo e($address['id']); ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="form-control"><?php echo e($address['sub_county']['county']['name']); ?>, <?php echo e($address['sub_county']['name']); ?>, <?php echo e($address['address']); ?></label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header py-1">
                        <h5 class="m-0">Your Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" colspan="2">Product Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col" colspan="2">Sub-Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($loop -> iteration); ?></th>
                                        <td>
                                            <a href="<?php echo e(url('/product/' . $item['product']['id'] . '/' . preg_replace("/\s+/", "", $item['product']['title']))); ?>">
                                                <?php echo e($item['product']['title']); ?>

                                            </a><br>
                                            <?php
                                            $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
                                            $unitPrice = Cart::getVariationPrice($item['product_id'], $details)['unit_price'];
                                            $discountPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];
                                            $discount = Cart::getVariationPrice($item['product_id'], $details)['discount'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php if(count($details) > 0): ?> <?php echo e(mapped_implode(', ', $details, ": ")); ?> <?php else: ?> - <?php endif; ?>
                                        </td>
                                        <td><?php echo e($item['quantity']); ?></td>
                                        <td>KES.<?php echo e($unitPrice); ?>/-</td>
                                        <td>KES.<?php echo e($discount); ?>/-</td>
                                        <td class="border-left">KES <?php echo e($discountPrice * $item['quantity']); ?>/-</td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tfoot class=" text-info">
                                <tr>
                                    <th colspan="6" class="text-right">Sub Total : </th>
                                    <th colspan="3" class="border-left">KES 0.00/-</th>
                                </tr>
                                <tr>
                                    <th colspan="6" class="text-right">Coupon Discount : </th>
                                    <th colspan="3" class="border-left">
                                        KES <?php if(session('couponAmount')): ?> <?php echo e(session('couponAmount')); ?> <?php else: ?> 0.0 <?php endif; ?>/-
                                    </th>
                                </tr>
                                <tr class="total">
                                    <th colspan="6" class="text-right">
                                        GRAND TOTAL (700.00 - <?php if(session('couponAmount')): ?> <?php echo e(session('couponAmount')); ?>) <?php else: ?> 0.0) <?php endif; ?> =
                                    </th>
                                    <th colspan="3" class="border-left">
                                        KES <?php if(session('grandTotal')): ?> <?php echo e(session('grandTotal')); ?>/= <?php else: ?> <?php echo e(700.00); ?>/= <?php endif; ?>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header py-1">
                        <h4 class="m-0">Payment Options</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <img src="<?php echo e(asset('images/general/1200px-M-PESA_LOGO-01.svg.png')); ?>" alt="PayPal" class="img-fluid" style="width: 10rem; height: 5rem; object-fit: cover">
                                <button class="btn btn-block btn-success" style="border-radius: 2.5rem; height: 2.7rem">
                                    <a href="#" class="text-white" style="text-decoration: none;">
                                        <h4 class="font-weight-bold"><i class="fas fa-hand-holding-usd"></i> Offline Payment</h4>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <img src="<?php echo e(asset('images/general/paypal-784404_1280-1.png')); ?>" alt="PayPal" class="img-fluid" style="width: 10rem; height: 5rem; object-fit: cover">
                                <div id="paypal_payment_button"></div>
                            </div>
                        </div>
                        <hr class="bg-primary">
                        <div class="row">
                            <div class="col d-flex justify-content-between">
                                <a href="<?php echo e(url('/cart')); ?>" class="btn btn-outline-success"><i class="fa fa-arrow-circle-left"></i> Back to Cart</a>
                                <a class="btn btn-dark">Place Order <i class="bx bxs-send"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--    End Contact Section    -->

        </div>
    </div>

<!--    PayPal Integration    -->
<script src="https://www.paypal.com/sdk/js?client-id=AXDf54IUhnF5DvZ7WmFndgKTxkeBi6LNJbZyZFBQgcD1V4oQQmJ7gVbjt5XZx_8CCirhoCqylaeJHtPq&disable-funding=credit,card"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/checkout.blade.php ENDPATH**/ ?>