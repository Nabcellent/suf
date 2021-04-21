<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Suf - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" href="<?php echo e(url('images/general/store_logo.jpg')); ?>">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    
    <link rel="stylesheet" href="<?php echo e(url('css/font-awesome/css/all.min.css')); ?>">

    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    
    <link href="<?php echo e(url('css/jquery.nice-number.css')); ?>" rel='stylesheet'>

    
    <link rel="stylesheet" href="<?php echo e(url('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('css/responsive.css')); ?>">
</head>
<body>
<?php echo $__env->make('partials.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.top_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($pageTitle) && $pageTitle === "Index"): ?>
    <?php echo $__env->make('partials.home_banners', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<!--    Swiper JS CDN    -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js" integrity="sha256-C7IaCo6kN3RN2EjOcM6WEMmykQV8mK72CI1jx0kqeZg=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>



<script src="<?php echo e(url('js/jquery.nice-number.js')); ?>"></script>
<script src="<?php echo e(url('js/main.js')); ?>"></script>
<script src="<?php echo e(url('js/validate.js')); ?>"></script>
<script src="<?php echo e(url('js/swiper.js')); ?>"></script>
<script src="<?php echo e(url('js/search.js')); ?>"></script>
<script src="<?php echo e(url('js/fetch.js')); ?>"></script>
<script src="<?php echo e(url('js/sweetAlert.js')); ?>"></script>
<script src="<?php echo e(url('js/payment.js')); ?>"></script>
</body>
</html>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views//layouts/master.blade.php ENDPATH**/ ?>