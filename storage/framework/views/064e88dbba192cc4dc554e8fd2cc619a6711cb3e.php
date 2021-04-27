<?php $__env->startSection('title', 'Thank You'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/partials/top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="checkout" class="container px-lg-5">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thank You <?php echo e(Auth::user()->first_name); ?>⚡</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <div class="card col-md-11 col-sm-12">
                <div class="card-header bg-dark" style="color: var(--light-gold)">
                    <h3 class="m-0 text-center">! 🥳 ~ 🥳 ~ 🥳 !</h3>
                    <hr style="background-color: var(--dark-gold)">
                </div>
                <div class="card-body py-2">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <?php if(Auth::user()->gender === 'Male'): ?>
                                <img src="<?php echo e(asset('images/thanks/giphy.gif')); ?>" alt="Thank You">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/thanks/177891_662ea.gif')); ?>" alt="Thank You">
                            <?php endif; ?>

                        <!--<img src="<?php echo e(asset('images/thanks/undraw_super_thank_you_obwk.svg')); ?>" alt="Thank You" height="300" width="300">-->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5><i class="fas fa-shipping-fast"></i> Your Order is being processed. 💯</h5>
                            <div class="row">
                                <div class="col-3">
                                    <p class="m-0">Order Number: </p>
                                    <p>Grand Total: </p>
                                </div>
                                <div class="col">
                                    <p class="m-0"><i><?php echo e(session('orderId')); ?></i></p>
                                    <p><i>KSH <?php echo e(session('grandTotal')); ?>/=</i></p>
                                </div>
                            </div>
                            <h3 class="text-right">We shall contact you. <?php if(Auth::user()->gender === 'Male'): ?> ⚡🥂 <?php else: ?> ✨🥰 <?php endif; ?></h3>
                            <span class="small pr-3" style="position: absolute; right: 0">We are happy to be of service.</span>
                        </div>
                    </div>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col d-flex justify-content-between">
                            <a href="<?php echo e(url('/products')); ?>" class="btn btn-success"><i class='bx bx-run bx-flip-horizontal' ></i> Shop some more? 😙</a>
                            <a href="<?php echo e(url('/orders')); ?>" class="btn btn-outline-info">My orders <i class="fab fa-shopify"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Contact Section    -->

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php
use Illuminate\Support\Facades\Session;

session::forget(['grandTotal', 'orderId', 'couponId', 'couponDiscount']);
?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/thanks.blade.php ENDPATH**/ ?>