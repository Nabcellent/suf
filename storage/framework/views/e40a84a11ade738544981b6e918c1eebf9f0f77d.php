<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="position-absolute" style="right:1rem; top:1rem; color: var(--dark-gold)"
       href="<?php echo e(route('admin.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <?php echo e(__('Exit')); ?>

    </a>
    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
    <div class="row py-3 justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8 py-md-5 mb-lg-5">
            <div class="card shadow-lg p-5">
                <div class="card-body shadow-sm">
                    <div class="card-header mb-3"><?php echo e(__('Verify Your Email Address')); ?></div>
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                            <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                    <?php echo e(__('If you did not receive the email')); ?>,
                    <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="morphic_btn" style="color: #fff; background-color: var(--first-color);"
                                onmouseover="this.style.backgroundColor='#3b5998'"
                                onmouseout="this.style.backgroundColor='var(--first-color)'">
                            <?php echo e(__('click here to request another')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/auth/verify.blade.php ENDPATH**/ ?>