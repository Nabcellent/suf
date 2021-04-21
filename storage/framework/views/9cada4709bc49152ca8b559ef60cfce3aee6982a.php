
<header id="top_header" class="navigation-sticky">

    <!--    Start Sticky Header    -->

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark top_header">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?php echo e(asset('storage/images/general/main_logo.jpg')); ?>" alt="SU-F logo" class="img-fluid main_logo">
            </a>

            <div class="" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <?php if(Auth::check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" data-toggle="dropdown">
                                <?php echo e(Str::substr(ucfirst(Auth::user() -> first_name), 0, 1) . '. ' . ucfirst(Auth::user() -> last_name)); ?>

                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(url('/checkout')); ?>">Checkout</a>
                                <a class="dropdown-item" href="<?php echo e(url('/orders')); ?>">My Orders</a>
                                <a class="dropdown-item" href="<?php echo e(url('/account')); ?>">My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Sign Out</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" style="transform: scale(1);">Hey There!👋 You might wanna</a>
                        </li>
                        <li class="nav-item" style="text-decoration: underline;">
                            <a class="nav-link" href="<?php echo e(url('register')); ?>">Register</a>
                        </li>
                        <li class="nav-item"><a class="nav-link">or</a></li>
                        <li class="nav-item" style="text-decoration: underline;">
                            <a class="nav-link" href="<?php echo e(url('login')); ?>">Sign In</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/top_header.blade.php ENDPATH**/ ?>