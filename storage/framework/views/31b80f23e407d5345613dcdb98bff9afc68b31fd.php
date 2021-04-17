<?php use Illuminate\Support\Arr;

$__env->startSection('title', 'Verify Email'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <!--    Start Breadcrumb    -->

    <div class="row mb-md-5 pb-md-5">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Email Verification</li>
                </ul>
            </nav>
        </div>
    </div>
    <!--    End Breadcrumb    -->

    <div class="row justify-content-center mb-md-5 py-md-5">
        <div class="col-md-8 mb-md-5 pb-md-5">
            <div class="card">
                <div class="card-header"><?php echo e(__('Verify Your Email Address')); ?></div>

                <div class="card-body">
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                    <?php echo e(__('If you did not receive the email')); ?>,
                    <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><?php echo e(__('click here to request another')); ?></button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/auth/verify.blade.php ENDPATH**/ ?>
