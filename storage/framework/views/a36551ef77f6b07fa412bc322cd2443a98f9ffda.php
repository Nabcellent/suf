<?php $__env->startComponent('mail::message'); ?>
# Order Placed

Heyy <?php echo e($user->first_name); ?><?php echo e($icons['hello']); ?>,<br>

Your order has been placed successfully and is being processed!<br>
We will contact you using this number: +254 <?php echo e($order['phone']['phone']); ?>.<?php echo e($icons['relax']); ?>


<?php $__env->startComponent('mail::panel'); ?>
    Order Total: KSH <?php echo e(currencyFormat($order['total'])); ?>

<?php if (isset($__componentOriginal78a7183c9f5e577b074162f44312b5a9c6fd7b4c)): ?>
<?php $component = $__componentOriginal78a7183c9f5e577b074162f44312b5a9c6fd7b4c; ?>
<?php unset($__componentOriginal78a7183c9f5e577b074162f44312b5a9c6fd7b4c); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => route('profile', ['page' => 'orders']), 'color' => 'primary']); ?>
    View Order
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::subcopy'); ?>
    Order No: #<?php echo e($order['id']); ?>

<?php if (isset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc)): ?>
<?php $component = $__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc; ?>
<?php unset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

Thanks you for shopping with us<?php echo e($icons['thanks']); ?>,<br>

Regards,<br>
<?php echo e(config('app.name')); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/emails/orders/placed.blade.php ENDPATH**/ ?>