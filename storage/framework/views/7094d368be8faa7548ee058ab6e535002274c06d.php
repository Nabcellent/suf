<?php use Illuminate\Support\Arr;

$__env->startSection('top-header'); ?>

<nav class="nav">
    <a href="/home" class="nav-link">Home</a>
    <a href="/products" class="nav-link">Products</a>
    <a href="/contact-us" class="nav-link">Contact</a>
</nav>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views//layouts/top_header.blade.php ENDPATH**/ ?>
