
<!--=======     HEADER     =======-->
<header class="header">
    <div class="header_container">
        <div class="dropdown header_image">
            <?php echo e(Str::substr(Str::upper(admin()->first_name), 0, 1)); ?>.
            <?php echo e(Str::ucfirst(admin()->last_name)); ?>

            <img src="<?php echo e(asset('/images/users/default-profile-pic.png')); ?>" alt="Profile image" data-toggle="dropdown">
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Orders</a>
                <a class="dropdown-item" href="#">Notifications</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('home')); ?>">Store</a>
                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <?php echo e(__('Exit')); ?>

                </a>
                <form id="logout-topnav-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
        <div class="header_title d-flex">
            <a href="/" class="header_logo">Suf-Store </a>

            <span class="text-muted"> &nbsp; Dashboard</span>

        </div>
        <div class="header_search">
            <input type="search" class="header_input" placeholder="Search" aria-label>
            <i class="bx bx-search header_icon"></i>
        </div>
        <div class="header_toggle">
            <i id="header_toggle" class="bx bx-menu-alt-left"></i>
        </div>
    </div>
</header>

<!--=======     SIDEBAR     =======-->
<div id="sidebar">
    <nav class="nav_container">
        <div>
            <a href="#" class="nav_logo link-info">
                <i class="bx bxs-disc nav_icon"></i>
                <span class="nav_logo_name">Suf-Admin</span>
                <div class="nav_state d-none d-md-block">
                    <label>
                        <input type="checkbox" id="nav_state_toggle" aria-label="">
                        <span></span>
                        <i class="indicator"></i>
                    </label>
                </div>
            </a>
            <div class="nav_list">
                <div class="nav_items">
                    <h3 class="nav_subtitle">General</h3>
                    <div class="dropdown-divider m-0"></div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav_link active">
                        <i class="fas fa-tachometer-alt nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Ecommerce</h3>
                    <div class="dropdown-divider m-0"></div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class='bx bxs-shopping-bags nav_icon' ></i>
                            <span class="nav_name">Products</span>
                            <i class="bx bx-chevrons-down bx-fade-down-hover nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.products')); ?>" class="nav_dropdown_item">list</a>
                                <a href="<?php echo e(route('admin.product', ['id' => latestProductId()])); ?>" class="nav_dropdown_item">View</a>
                                <a href="<?php echo e(route('admin.categories')); ?>" class="nav_dropdown_item">Categories</a>
                                <a href="<?php echo e(route('admin.coupons')); ?>" class="nav_dropdown_item">Coupons</a>
                                <a href="<?php echo e(route('admin.attributes')); ?>" class="nav_dropdown_item">Attributes</a>
                            </div>
                        </div>
                    </div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fab fa-opencart nav_icon"></i>
                            <span class="nav_name">Overview</span>
                            <i class="bx bx-chevrons-down bx-fade-down-hover nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.orders')); ?>" class="nav_dropdown_item">Orders</a>
                                <a href="<?php echo e(route('admin.payments')); ?>" class="nav_dropdown_item">Payments</a>
                            </div>
                        </div>
                    </div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fab fa-page4 nav_icon"></i>
                            <span class="nav_name">Page Content</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.banners')); ?>" class="nav_dropdown_item">Banners</a>
                                <a href="<?php echo e(route('admin.ads')); ?>" class="nav_dropdown_item">Ads</a>
                                <a href="<?php echo e(route('admin.policies')); ?>" class="nav_dropdown_item">Policies</a>
                            </div>
                        </div>
                    </div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-address-card nav_icon"></i>
                            <span class="nav_name">Profile</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="#" class="nav_dropdown_item">Passwords</a>
                                <a href="#" class="nav_dropdown_item">Mail</a>
                                <a href="#" class="nav_dropdown_item">Account</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Apps</h3>
                    <div class="dropdown-divider m-0"></div>
                    <a href="#" class="nav_link">
                        <i class='bx bxs-contact nav_icon' ></i>
                        <span class="nav_name">Contacts</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-mail-send nav_icon' ></i>
                        <span class="nav_name">Emails</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="fas fa-paper-plane nav_icon"></i>
                        <span class="nav_name">Messages</span>
                    </a>
                    <a href="<?php echo e(route('home')); ?>" class="nav_link">
                        <i class="fas fa-store nav_icon"></i>
                        <span class="nav_name">Suf-Store</span>
                    </a>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Users</h3>
                    <div class="dropdown-divider m-0"></div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-users nav_icon"></i>
                            <span class="nav_name">Customers</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.customers')); ?>" class="nav_dropdown_item">List</a>
                                <a href="#" class="nav_dropdown_item">View</a>
                                <a href="#" class="nav_dropdown_item">Edit</a>
                                <a href="#" class="nav_dropdown_item">profile</a>
                                <a href="#" class="nav_dropdown_item">cards</a>
                            </div>
                        </div>
                    </div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-user-tag nav_icon"></i>
                            <span class="nav_name">Sellers</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.sellers')); ?>" class="nav_dropdown_item">List</a>
                                <a href="#" class="nav_dropdown_item">Mail</a>
                                <a href="#" class="nav_dropdown_item">Account</a>
                            </div>
                        </div>
                    </div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-users-cog nav_icon"></i>
                            <span class="nav_name">Admins</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="<?php echo e(route('admin.admins')); ?>" class="nav_dropdown_item">List</a>
                                <a href="#" class="nav_dropdown_item">Mail</a>
                                <a href="#" class="nav_dropdown_item">Account</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav_link">
                        <i class='bx bxs-user-account nav_icon' ></i>
                        <span class="nav_name">Account</span>
                    </a>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">ETC</h3>
                    <div class="dropdown-divider m-0"></div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class='bx bxs-server nav_icon' ></i>
                            <span class="nav_name">Data</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="#" class="nav_dropdown_item">Charts</a>
                                <a href="#" class="nav_dropdown_item">Analysis</a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="nav_link">
                        <i class='bx bx-info-circle nav_icon' ></i>
                        <span class="nav_name">Status</span>
                    </a>
                </div>
            </div>
        </div>

        <a href="<?php echo e(route('logout')); ?>" class="nav_link nav_logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-log-out nav_icon"></i>
            <span class="nav_name"><?php echo e(__('Leave')); ?></span>
        </a>
        <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </nav>
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/include/navbar.blade.php ENDPATH**/ ?>