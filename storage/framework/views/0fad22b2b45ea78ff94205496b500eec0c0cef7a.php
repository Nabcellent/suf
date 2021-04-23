<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/partials/top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="cart">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container-fluid cart_page_container">
            <div class="row">

                <!--    Start Breadcrumb    -->

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                        </ul>
                    </nav>
                </div>
                <!--    End Breadcrumb    -->
            </div>
            <div id="cart_row" class="row my-2">

                <!--    Start Cart Section    -->

                <div class="col-md-9">

                    <!--    Start Box    -->

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <div class="box bg-light pt-2 pb-3 px-3 rounded shadow cart_table">

                                <?php if(count($cart) === 0): ?>
                                    <div class='p-5'>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h1 class='display-1'><i class='fab fa-opencart'></i></h1>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h3>Empty Cart</h3>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <a href="<?php echo e(url('/products')); ?>" class='btn btn-warning'>Go Shopping <i class='fas fa-running'></i></a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div>

                                        <!--    Start Cart Table    -->

                                        <h1>Cart Items</h1>
                                        <p class="text-muted">You currently have <span class="cart_count"><?php echo e(cartCount()); ?></span> item(s) in your Cart.</p>

                                        <div id="cart_table" class="table-responsive">
                                            <?php echo $__env->make('partials.products.cart-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <!--    End Cart Table    -->

                                        <!--    Start Coupon Section    -->

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-inline float-right pb-3">
                                                    <form action="<?php echo e(route('apply-coupon')); ?>" method="POST" class="form-group">
                                                        <?php echo csrf_field(); ?>
                                                        <label for="code">Coupon Code: </label>
                                                        <input type="text" name="code" id="code" class="form-control-sm mx-2" placeholder="Enter Code" required>
                                                        <button type="submit" class="btn-sm btn-warning">Apply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    End Coupon Section    -->

                                        <!--    Start Box Footer    -->

                                        <div class="box_footer">
                                            <div class="float-left">
                                                <a href="<?php echo e(url('/products')); ?>" class="btn btn-outline-dark"><i class="fas fa-chevron-left"></i> Continue Shopping</a>
                                            </div>
                                            <div class="float-right">
                                                <a href="<?php echo e(route('checkout')); ?>" class="btn btn-outline-success">Checkout <i class="fas fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                        <!--    End Box Footer    -->
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->

                    <!--    Start Products you may like -->

                    <div id="products_like" class="row">
                        <div class="col like_title">
                            <h3>Luku Kali ni Setoka !</h3>
                            <hr class="bg-light my-0">
                        </div>
                    </div>
                    <!--    End Products you may like -->
                </div>
                <!--    End Cart Section    -->

                <!--    Start Order Summary    -->

                <div class="col-md-3">

                    <!--    Start Box    -->

                    <div id="order_summary" class="box p-3 bg-light rounded shadow">
                        <div class="row">
                            <div class="col">
                                <div class="box_header">
                                    <h3>Order Summary</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <p class="text-muted">
                                Transport and Additional Costs are calculated based on your delivery address and cart quantity.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="svg">
                                    <?php if(Auth::check()): ?>
                                        <?php if(Auth::user()->gender === "Male"): ?>
                                            <img src="<?php echo e(asset('images/illustrations/undraw_empty_cart_co35.svg')); ?>" class="img-fluid shadow-lg" alt="">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images/illustrations/undraw_shopping_app_flsj.svg')); ?>" class="img-fluid shadow-lg" alt="">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/illustrations/undraw_shopping_eii3.svg')); ?>" class="img-fluid shadow-lg" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->
                </div>
                <!--    End Order Summary    -->
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/cart.blade.php ENDPATH**/ ?>