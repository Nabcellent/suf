<?php use Illuminate\Support\Arr;

$__env->startSection('title', 'Profile'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/partials/top_nav', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--    Start Profile    -->
    <div id="profile">
        <!--    Start Content Area    -->
        <div id="content">
            <div class="container profile_container">

                <!--    Start Page Header    -->
                <div class="container px-1">
                    <div class="row">
                        <div class="col-md-12 px-0">
                            <div class="card-header profile_header">
                                <h2>Profile</h2>
                                <div class="underline"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    End Page Header    -->

                <div class="row py-2">
                    <!--    Start Sidebar    -->

                    <div class="col-md-3 px-1">
                        <div class="card mb-2 sidebar_menu">
                            <div class="card-header">
                                <img src="<?php echo e(asset('/images/users/630728-200.png')); ?>" class="card-img-top" alt="...">
                                <h5 class="card-title" style="text-decoration: underline">
                                    <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?>

                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush category_menu profile_links">
                                    <li class="list-group-item">
                                        <a href="<?php echo e(url('/account')); ?>" class="stretched-link">
                                            <i class="fas fa-user-edit"></i><span>Your Account</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php echo e(url('/orders')); ?>" class="stretched-link">
                                            <i class="fas fa-list"></i><span>My Orders</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php echo e(route('logout')); ?>" class="stretched-link">
                                            <i class="fas fa-sign-out-alt"></i><span>Sign Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--    End Sidebar    -->

                    <!--    Start My Orders Section    -->

                    <div class="col-md-9 px-1 profile_pages">
                        <?php if($page === 'edit'): ?>
                            <?php echo $__env->make('partials.profile.edit', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif($page === 'orders'): ?>
                            <?php echo $__env->make('partials.profile.orders', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif($page === 'delivery-address'): ?>
                            <?php echo $__env->make('partials.profile.delivery_address', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                    </div>
                    <!--    End My Orders Section    -->
                </div>
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/profile.blade.php ENDPATH**/ ?>
