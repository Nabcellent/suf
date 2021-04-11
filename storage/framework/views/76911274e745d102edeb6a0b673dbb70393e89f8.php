<?php $__env->startSection('title', 'Reset Password'); ?>
<?php $__env->startSection('content'); ?>

    <div class="login">
        <!--    Start Content Area    -->
        <div id="content">
            <div class="container registration_page_container">

                <!--    Start Breadcrumb    -->
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--    End Breadcrumb    -->

                <!--    Start Contact Section    -->
                <div class="row justify-content-center py-5">
                    <div class="col-md-11 col-sm-12 mb-5 pb-5">

                        <!--    Start Card    -->

                        <div class="card shadow mx-auto" style="max-width:30rem">
                            <div class="card-header">
                                <h4>Reset your password</h4>
                                <?php if(session()->has('status')): ?>
                                    <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                        <ul class="m-0"><li class="list-group-flush"><?php echo e(session()->get('status')); ?></li></ul>
                                    </div>
                                <?php endif; ?>
                                <hr class="bg-info m-0">
                            </div>

                            <div class="card-body pb-0 anime_card">
                                <form id="forgot_password" class="anime_form" action="<?php echo e(route('password.update')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <p>You may now reset your password here 😌</p>
                                    <div class="form-group">
                                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" placeholder="Enter email address *"
                                               value="<?php echo e($email ?? old('email')); ?>" aria-label required autocomplete="email" autofocus>
                                        <?php $__errorArgs = ['email'];
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
                                    <div class="form-group">
                                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                               placeholder="Enter new password *" aria-label required autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password_confirmation"
                                               placeholder="Confirm new password *" aria-label required autocomplete="new-password">
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
                                    <div class="form-group text-right">
                                        <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span>Reset Password <i class="bx bx-refresh"></i></span>
                                        </button>
                                        <img class="d-none loader_gif" src="<?php echo e(asset('images/loaders/Ripple-1s-151px.gif')); ?>" alt="loader.gif">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--    End Card    -->

                        <div class="row mt-4 justify-content-center">
                            <div class="col-md-6 text-center">
                                <p>New to Su-F ? <a href="<?php echo e(url('/register')); ?>">Sign Up</a> Already!⚡</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    End Contact Section    -->
            </div>
        </div>
        <!--    End Content Area    -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>