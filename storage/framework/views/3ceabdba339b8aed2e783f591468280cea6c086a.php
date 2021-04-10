<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

$user = Auth::user();

?>

<header id="top_header" class="navigation-sticky">

    <!--    Start Sticky Header    -->

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark top_header">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/general/main_logo.jpg" alt="SU-F logo" class="img-fluid main_logo">
            </a>

            <div class="" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <?php if(Auth::check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" data-toggle="dropdown">
                                <?php echo e(Str::substr(ucfirst($user -> first_name), 0, 1) . '. ' . ucfirst($user -> last_name)); ?>

                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/checkout">Checkout</a>
                                <a class="dropdown-item" href="/profile/edit">My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/sign-out">Sign Out</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                        <li class="nav-item"><span class="navbar-brand m-0 px-1 text-muted">or</span></li>
                        <li class="nav-item"><a class="nav-link" href="/sign-in">Sign In</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views//partials/top_header.blade.php ENDPATH**/ ?>