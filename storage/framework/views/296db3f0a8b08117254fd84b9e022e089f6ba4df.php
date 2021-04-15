<!--    Start Footer    -->

<footer class="main_footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <!--    Start Products    -->

                <h3>Trending Categories</h3>
                <div class="dropdown-divider"></div>

                <?php $__currentLoopData = $footerInfo['trendingCategories'] -> take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><a href="#"><?php echo e($item -> title); ?></a></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!--    End Products    -->
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">

                <!--    Start Important Links    -->

                <h3>Important links</h3>
                <p><a href="<?php echo e(url('cart')); ?>">Shopping Cart</a></p>
                <p><a href="<?php echo e(url('products')); ?>">Our Products</a></p>
                <p><a href="<?php echo e(url('profile/edit')); ?>">My Account</a></p>
                <div class="dropdown-divider"></div>
                <p><a href="#">Strathmore University Website</a></p>
                <p><a href="#">e-learning System</a></p>
                <p><a href="#">AMS Students' Module</a></p>
                <!--    End Important Links    -->
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <h3>Find Us</h3>
                <p>Mobile - <a href="#">+254 000 000 000</a></p>
                <p>Email Address - <a href="#">email@gmail.com</a></p>
                <p>Name - <a href="#"></a>Some Name</p>
                <div class="dropdown-divider"></div>
                <p><a href="<?php echo e(url('contact')); ?>">Contact Us</a></p>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <!--    Start UserSeeder Section    -->

                <h3>User Section</h3>
                <p>

                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(route('checkout')); ?>">Checkout<br></a>
                        <a href="<?php echo e(url('/account')); ?>">Edit Account<br></a>
                        <a href="<?php echo e(url('/account/orders')); ?>">My Orders<br></a>
                        <a href="<?php echo e(url('/logout')); ?>">Sign Out</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/login')); ?>">Sign In<br></a>
                        <a href="<?php echo e(url('/register')); ?>">Register account</a>
                    <?php endif; ?>
                    <br><a href="<?php echo e(url('policies')); ?>">Terms & Conditions</a>

                </p>
                <!--    End UserSeeder Section    -->
            </div>
            <div class="col-lg-6 col-md-6">
                <!--    Start Get News Section    -->
                <h3>Get the news</h3>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid impedit nemo non qui quidem ut. Explicabo mollitia nemo velit. Autem delectus id magni sequi ut vitae. Doloribus, ex in!
                </p>
                <form action="" method="post">
                    <div class="form-group mb-0">
                        <label>
                            <input type="email" class="form-control" name="email">
                        </label>
                        <input type="submit" value="subscribe" class="btn btn-outline-light">
                    </div>
                </form>
                <h5>Don't Miss Our Latest Update! Stay tuned.</h5>

                <!--    End Get News Section    -->
            </div>
            <div class="col-lg-6 col-md-6">
                <h3>Connect with us</h3>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook" onmouseover="this.style.color='#3b5998'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter" onmouseover="this.style.color='#00aced'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram" onmouseover="this.style.color='#3f729b'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube" onmouseover="this.style.color='#c4302b'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                    <li><a href="#"><i class="fab fa-whatsapp" onmouseover="this.style.color='#25D366'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus-g" onmouseover="this.style.color='#db4a39'" onmouseout="this.style.color='rgb(1, 7, 29)'"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--    End Footer    -->

<!-- Start Socket -->

<div class="socket text-light text-center py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1 text-muted">&copy; 2021 Strathmore Fashion Store | Terms of use.</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1 text-muted">@Lè_•Çapuchôn✓🩸</p>
            </div>
        </div>
    </div>
</div>
<!-- End Socket -->
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/footer.blade.php ENDPATH**/ ?>