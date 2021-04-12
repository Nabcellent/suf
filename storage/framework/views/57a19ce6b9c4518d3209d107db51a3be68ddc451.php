</header>
<header id="mega_nav" class="sticky-top header">
    <div class="container-fluid nav_container">
        <div class="row px-3 align-items-center v_center">
            <div class="d-none d-sm-block header_item item_left">
                <div class="logo"><a href="/">Suf-Store</a></div>
            </div>

            <!--    Start Menu    -->

            <div class="header_item item_center">
                <div class="menu_overlay"></div>
                <nav class="menu">
                    <div class="mobile_menu_head">
                        <div class="go_back"><span><i class="fas fa-angle-left"></i></span></div>
                        <div class="current_menu_title"></div>
                        <div class="mobile_menu_close">&times;</div>
                    </div>
                    <ul class="menu_main">
                        <li><a href="/" class="nav_link">Home</a></li>
                        <li class="menu_item_has_children">
                            <a class="nav_link" style="cursor: pointer">Latest <Span><i class='bx bx-down-arrow-alt' ></i></Span></a>
                            <div class="sub_menu mega_menu mega_menu_column_4 text-dark">

                                <?php $__currentLoopData = $latestFour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $four): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list_item text-center">
                                        <a href="<?php echo e(url('/product/' . $four['id'] . '/' . preg_replace("/\s+/", "", $four['title']))); ?>">
                                            <img src="/images/products/<?php echo e($four['main_image']); ?>" alt="new ProductSeeder">
                                            <h4 class="title"><?php echo e($four['title']); ?></h4>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </li>
                        <li class="menu_item_has_children">
                            <a href="<?php echo e(url('/products')); ?>" class="nav_link products">Products <span><i class='bx bx-down-arrow-alt' ></i></span></a>
                            <ul class="sub_menu mega_menu mega_menu_column_4">


                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($section['categories']) > 0): ?>
                                        <li class="list_item">
                                            <h4 class="title">
                                                <a href="<?php echo e(url('#')); ?>"><?php echo e($section['title']); ?>' Fashion</a>
                                            </h4>
                                            <div class="mt-0 dropdown-divider"></div>
                                            <ul>
                                                <?php $__currentLoopData = $section['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e(url('/products/' . $category['id'])); ?>"><?php echo e($category['title']); ?></a></li>
                                                    <?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="ml-2"><a href="<?php echo e(url('/products/' . $subCategory['id'])); ?>">- <?php echo e($subCategory['title']); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <li class="list_item">
                                    <img src="<?php echo e(asset('/images/general/meganav/174-1744463_beard-men-in-suit.jpg')); ?>" alt="shop">
                                    <h4 class="title"><a href="<?php echo e(url('/products')); ?>" class="d-block d-lg-none lead nav_link">All Products</a></h4>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('/about')); ?>" class="nav_link">About</a></li>
                        <li><a href="<?php echo e(url('/contact-us')); ?>" class="nav_link">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <!--    End Menu    -->

            <div class="header_item item_right">
                <div class="icons search w-100">
                    <form action="#">
                        <input type="text" name="search" class="form-control">
                        <button class="search_btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="icons ml-2">
                    <button class="icon_button">
                        <i class="fas fa-hand-sparkles"></i>
                        <span class="icon_count"></span>
                    </button>
                </div>
                <div class="icons ml-2">
                    <a href="<?php echo e(url('/cart')); ?>" class="icon_button">
                        <i class="fab fa-opencart"></i>
                        <span class="cart_count"><?php echo e(cartCount()); ?></span>
                    </a>
                </div>
                <div class="cart_total"><p class="m-0"><?php echo e(cartTotal()); ?>/=</p></div>

                <!--    Start Mobile Menu Trigger    -->

                <div class="mobile_menu_trigger">
                    <span></span>
                </div>
                <!--    End Mobile Menu Trigger    -->

            </div>
        </div>
    </div>
</header>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/top_nav.blade.php ENDPATH**/ ?>