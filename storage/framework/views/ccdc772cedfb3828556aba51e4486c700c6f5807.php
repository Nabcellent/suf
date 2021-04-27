<?php $__env->startSection('title', 'Confirm Password'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <!--    Start Breadcrumb    -->
    <div class="row pb-lg-5">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Confirm Password</li>
                </ul>
            </nav>
        </div>
    </div>
    <!--    End Breadcrumb    -->

    <div class="row justify-content-center py-md-5 mb-lg-5">
        <div class="col-md-8 py-md-5 mb-lg-5">
            <div class="card px-5 py-4">
                <div class="card-body">
                    <div class="card-header my-3"><?php echo e(__('Confirm Password')); ?></div>
                    <form method="POST" action="<?php echo e(route('password.confirm')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="password" placeholder="Enter password" required autocomplete="current-password">

                                <?php $__errorArgs = ['password'];
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
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="morphic_btn" style="color: #fff; background-color: var(--dark-gold);"
                                        onmouseover="this.style.backgroundColor='#3b5998'"
                                        onmouseout="this.style.backgroundColor='var(--light-gold)'">
                                    <?php echo e(__('Confirm Password')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="text-center small"><?php echo e(__('Please confirm your password before proceeding.')); ?></p>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-6 text-center">
                    <?php if(Route::has('password.request')): ?>
                        <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('Forgot Your Password?')); ?>

                        </a>
                    <?php endif; ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/auth/passwords/confirm.blade.php ENDPATH**/ ?>