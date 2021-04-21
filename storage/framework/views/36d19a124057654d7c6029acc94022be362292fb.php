<?php $__env->startComponent('mail::message'); ?>
# <?php echo e($details['subject']); ?>


<?php echo e($details['message']); ?>


<?php $__env->startComponent('mail::button', ['url' => route('admin.dashboard')]); ?>
Open Admin
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

Regards,<br>
<?php echo e($details['last_name']); ?> <?php echo e($details['last_name']); ?><br>
<a href="mailto:<?php echo e($details['email']); ?>"><?php echo e($details['email']); ?></a>
<hr>
<?php echo e(config('app.name')); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/emails/contact_us.blade.php ENDPATH**/ ?>