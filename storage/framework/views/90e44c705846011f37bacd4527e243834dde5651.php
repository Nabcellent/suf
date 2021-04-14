<?php
use App\Models\Cart;

?>

<table class="table table-sm table-striped table-hover table_fixed">
    <thead class="thead-dark">
    <tr class="header">
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
            <td><img src="<?php echo e('/images/products/' . $item['product']['main_image']); ?>" alt="Product Image"></td>
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
                <?php if(count($details) > 0): ?>
                    <?php echo e(mapped_implode(', ', $details, ': ')); ?>

                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td class="quantity">
                <div>
                    <input type="number" name="quantity" min="1" value="<?php echo e($item['quantity']); ?>" data-id="<?php echo e($item['id']); ?>" aria-label>
                    <img class="loader" src="<?php echo e(asset('images/loaders/load.gif')); ?>" alt="loader.gif">
                </div>
            </td>
            <td>KES <?php echo e($unitPrice); ?>/-</td>
            <td>KES.<?php echo e($discount); ?>/-</td>
            <td class="border-left">KES <?php echo e($discountPrice * $item['quantity']); ?>/-</td>
            <td>
                <a href="#" class="btn btn-outline-danger p-1 border-0 delete_cart_item" data-id="<?php echo e($item['id']); ?>">
                    <i class="fas fa-backspace"></i>
                </a>
            </td>
        </tr>
        <?php $totalPrice += ($discountPrice * $item['quantity'])?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
    <tfoot class="bg-dark text-white">
    <tr>
        <th colspan="6" class="text-right">Sub Total : </th>
        <th colspan="3" class="border-left">KES <?php echo e(currencyFormat($totalPrice)); ?>/-</th>
    </tr>
    <tr>
        <th colspan="6" class="text-right">Coupon Discount : </th>
        <th colspan="3" class="border-left">
            KES.<?php if(session('couponDiscount')): ?> <?php echo e(session('couponDiscount')); ?> <?php else: ?> 0.0 <?php endif; ?>/-
        </th>
    </tr>
    <tr class="total">
        <th colspan="6" class="text-right">
            GRAND TOTAL (<?php echo e(currencyFormat($totalPrice)); ?> - <?php if(session('couponDiscount')): ?> <?php echo e(session('couponDiscount')); ?>) <?php else: ?> 0.0) <?php endif; ?> =
        </th>
        <th colspan="3" class="border-left">
            KES
            <?php if(session('grandTotal')): ?> <?php echo e(session('grandTotal')); ?> <?php else: ?> <?php echo e(currencyFormat($totalPrice)); ?> <?php endif; ?>
            /-
        </th>
    </tr>
    </tfoot>
</table>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/products/cart-table.blade.php ENDPATH**/ ?>