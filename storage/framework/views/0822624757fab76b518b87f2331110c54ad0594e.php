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
                    <ul class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <form id="checkout-form" action="<?php echo e(route('place-order')); ?>" method="POST" class="col-md-11 col-sm-12">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-header py-sm-0 pb-1">
                        <h3 class="m-0 text-right">Checkout</h3>
                        <hr class="my-1">
                    </div>
                    <div class="card-body py-2">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="m-0">Delivery Addresses</h5>
                                            <?php if(count($addresses) > 0): ?>
                                                <a href="<?php echo e(route('profile', ['page' => 'delivery-address'])); ?>" class="btn btn-outline-info" style="border: none; border-bottom: 1px solid;">Add Address</a>
                                            <?php endif; ?>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($addresses) > 0): ?>
                                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="pb-1">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text custom">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="address<?php echo e($address['id']); ?>" name="address" <?php if((int)old('address') === $address['id']): ?> checked <?php endif; ?>
                                                                class="custom-control-input <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($address['id']); ?>" required>
                                                                <label class="custom-control-label" for="address<?php echo e($address['id']); ?>"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="form-control text-truncate" for="address<?php echo e($address['id']); ?>">
                                                        <?php echo e($address['sub_county']['county']['name']); ?>, <?php echo e($address['sub_county']['name']); ?>, <?php echo e($address['address']); ?>

                                                    </label>
                                                    <div class="input-group-append">
                                                        <a href="<?php echo e(url('/account/delivery-address/' . $address["id"])); ?>" class="input-group-text border-primary text-info">
                                                            <i class='bx bx-edit-alt'></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="input-group-text border-danger text-danger delete-address" data-id="<?php echo e($address['id']); ?>">
                                                            <i class='bx bx-trash-alt'></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td>
                                            <div>You don't have any delivery addresses at the moment. Care to add one? 🙂... |
                                                <a href="<?php echo e(route('profile', ['page' => 'delivery-address'])); ?>">add</a></div>
                                            <hr class="m-0">
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="row justify-content-end bd-highlight">
                            <div class="col-lg-5 col-md-7 col-sm-9 input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text p-1">Phone Number</label>
                                    <label class="input-group-text py-1">+254</label>
                                </div>
                                <select class="custom-select <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputGroupSelect01" name="phone" required>
                                    <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($phone['id']); ?>"><?php echo e($phone['phone']); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
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

                                <?php $totalPrice = 0; ?>
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
                                        <td> - KES.<?php echo e($discount * $item['quantity']); ?>/-</td>
                                        <td class="border-left">KES <?php echo e($discountPrice * $item['quantity']); ?>/-</td>
                                    </tr>
                                    <?php $totalPrice += ($discountPrice * $item['quantity'])?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tfoot class=" text-info">
                                <tr>
                                    <th colspan="6" class="text-right">Sub Total : </th>
                                    <th colspan="3" class="border-left">KES <?php echo e(currencyFormat($totalPrice)); ?>/-</th>
                                </tr>
                                <tr>
                                    <th colspan="6" class="text-right">Coupon Discount : </th>
                                    <th colspan="3" class="border-left">
                                        KES <?php if(session('couponDiscount')): ?> <?php echo e(session('couponDiscount')); ?> <?php else: ?> 0.0 <?php endif; ?>/-
                                    </th>
                                </tr>
                                <tr class="total">
                                    <th colspan="6" class="text-right">
                                        GRAND TOTAL (<?php echo e(currencyFormat($totalPrice)); ?> - <?php if(session('couponDiscount')): ?> <?php echo e(session('couponDiscount')); ?>) <?php else: ?> 0.0) <?php endif; ?> =
                                    </th>
                                    <th colspan="3" class="border-left">
                                        KES <?php if(session('grandTotal')): ?> <?php echo e(session('grandTotal')); ?>/= <?php else: ?> <?php echo e(currencyFormat($totalPrice)); ?>/= <?php endif; ?>
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
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col">
                                M-pesa
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mpesa-inst" name="payment_method" value="M-Pesa-instant" <?php if(old('payment_method') === 'M-pesa-instant'): ?> checked <?php endif; ?>
                                    class="custom-control-input <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <label class="custom-control-label" for="mpesa-inst">Instant</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mpesa-ondeliv" name="payment_method" value="M-Pesa-on-delivery" <?php if(old('payment_method') === 'M-pesa-on-delivery'): ?> checked <?php endif; ?>
                                    class="custom-control-input <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <label class="custom-control-label" for="mpesa-ondeliv">On Delivery</label>
                                </div>
                                <hr>
                            </div>
                            <div class="col border-left border-dark">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="paypal-inst" name="payment_method" value="paypal" <?php if(old('payment_method') === 'paypal'): ?> checked <?php endif; ?>
                                    class="custom-control-input <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <label class="custom-control-label" for="paypal-inst">PayPal</label>
                                </div>
                                <p class="small">(For PayPal, Click the button below to complete payment)</p>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cash" name="payment_method" value="cash" <?php if(old('payment_method') === 'cash'): ?> checked <?php endif; ?>
                                    class="custom-control-input <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <label class="custom-control-label" for="cash">Cash On Delivery</label>
                                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <hr class="bg-success">
                        <div class="row text-center">
                            <div class="col">
                                <img src="<?php echo e(asset('images/general/1200px-M-PESA_LOGO-01.svg.png')); ?>" alt="PayPal" class="img-fluid" style="width: 10rem; height: 5rem; object-fit: cover">
                                <button class="btn btn-block btn-success" style="border-radius: 2.5rem; height: 2.7rem">
                                    <a class="text-white">
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
                                <button type="submit" class="btn btn-dark">Place Order <i class="bx bxs-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--    End Contact Section    -->

        </div>
    </div>

<!--    PayPal Integration    -->
<!--
<script src="https://www.paypal.com/sdk/js?client-id=AXDf54IUhnF5DvZ7WmFndgKTxkeBi6LNJbZyZFBQgcD1V4oQQmJ7gVbjt5XZx_8CCirhoCqylaeJHtPq&disable-funding=credit,card"></script>
-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/checkout.blade.php ENDPATH**/ ?>