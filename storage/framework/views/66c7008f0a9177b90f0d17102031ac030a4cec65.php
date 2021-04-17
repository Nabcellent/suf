<?php use Illuminate\Support\Arr;

$__env->startSection('title', 'Sign In'); ?>
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
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <!--    Start Contact Section    -->

            <div class="row justify-content-center pb-5 mb-md-5">
                <div class="col-md-11 col-sm-12 py-md-5">

                    <!--    Start Card    -->

                    <div class="card shadow mx-auto mt-md-5" style="max-width:30rem">
                        <div class="card-header">
                            <h4>Sign In</h4>
                            <?php if(session()->has('status')): ?>
                                <div class="alert alert-success py-1 px-2 mb-1" role="alert">
                                    <ul class="m-0"><li class="list-group-flush"><?php echo e(session()->get('status')); ?></li></ul>
                                </div>
                            <?php endif; ?>
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                    <ul class="m-0"><li><?php echo e($errors->first()); ?></li></ul>
                                </div>
                            <?php endif; ?>
                            <hr class="bg-info m-0">
                        </div>

                        <div class="card-body pb-0 anime_card">
                            <form id="login_form" class="anime_form" action="<?php echo e(url('/login')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email or Phone number *" aria-label required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password *" aria-label required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me[]">
                                            <label class="custom-control-label" for="remember_me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col text-right">
                                        <a href="<?php echo e(url('/forgot-password')); ?>">Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="morphic_btn morphic_btn_primary">
                                        <span>Sign In <i class="fas fa-sign-in-alt"></i></span>
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
<!--    End Sticky Header Jumbotron    -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('/layouts.master', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/login.blade.php ENDPATH**/ ?>
