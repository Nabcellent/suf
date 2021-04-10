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
                                    <form action="<?php echo e(url('/cart')); ?>" method="POST">

                                        <!--    Start Cart Table    -->

                                        <h1>Cart Items</h1>
                                        <p class="text-muted">You currently have items in your Cart.</p>

                                        <div id="cart_table" class="table-responsive">
                                            <?php echo $__env->make('partials.products.cart-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <!--    End Cart Table    -->

                                        <!--    Start Coupon Section    -->

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-inline float-right pb-3">
                                                    <div class="form-group">
                                                        <label for="coupon_code">Coupon Code: </label>
                                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control-sm mx-2">
                                                        <input type="submit" name="use_coupon" class="btn-sm btn-warning" value="Use Coupon">
                                                    </div>
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
                                                <button type="submit" name="update" value="Update Cart" class="btn btn-outline-dark"><i class="fas fa-sync-alt"></i> Update Cart</button>
                                                <a href="<?php echo e(url('/checkout')); ?>" class="btn btn-outline-success">Checkout <i class="fas fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                        <!--    End Box Footer    -->


                                        <!--    Start Delete Item Modal    -->

                                        <div class="modal fade" id="delete_cart_modal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Item?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keep Item</button>
                                                        <button type="button" class="btn btn-outline-danger" id="delete_item">Yes, Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    End Delete Item Modal    -->

                                    </form>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->

                    <!--    Start Products you may like -->

                    <div id="products_like" class="row">
                        <div class="col">
                            <div class="row like_title">
                                <div class="col">
                                    <h3>Products you may Like</h3>
                                    <hr class="bg-light my-0">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div id="results" class="col column">

                                    <!--    Start Single ProductSeeder    -->
                                    
                                <!--    End Single ProductSeeder    -->

                                </div>
                            </div>
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
                                Transport and Additional Costs are calculated based on value you have entered.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="cart_summary" class="table-responsive">
                                    <table class="table table-bordered table-dark">
                                        <tbody>
                                        <tr>
                                            <td>Order Sub-Total</td>
                                            <th>KES</th>
                                        </tr>
                                        <tr>
                                            <td>Total Tax</td>
                                            <th>KES 00.00</th>
                                        </tr>
                                        <tr>
                                            <td>Total Discount</td>
                                            <th>KES 00.00</th>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <th>KES</th>
                                        </tr>
                                        </tbody>
                                    </table>
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