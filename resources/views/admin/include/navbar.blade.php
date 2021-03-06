<!--=======     HEADER     =======-->
<header class="header">
    <div class="header_container">
        <div class="dropdown header_image">
            {{ Str::substr(Str::upper(Auth::user()->first_name), 0, 1) }}.
            {{ Str::ucfirst(Auth::user()->last_name) }}
            @if(!empty(Auth::user()->image) && file_exists(public_path('/images/users/profile/' . Auth::user()->image)))
                <img src="{{ asset('/images/users/profile/' . Auth::user()->image) }}" class="img-fluid dropdown-toggle" alt="" data-bs-toggle="dropdown">
            @else
                <img src="{{ asset('/images/general/store_logo.jpg') }}" class="img-fluid dropdown-toggle" alt="" data-bs-toggle="dropdown">
            @endif
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.orders') }}">Orders</a>
                <a class="dropdown-item" href="#">Notifications</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('home') }}">Store</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Exit') }}
                </a>
                <form id="logout-topnav-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <div class="header_title d-flex">
            <a href="/" class="header_logo">SuF-Store </a>
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
                    <a href="{{ route('admin.dashboard') }}" class="nav_link active">
                        <i class="fas fa-tachometer-alt nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Ecommerce</h3>
                    <div class="dropdown-divider m-0"></div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class='bx bxs-shopping-bags nav_icon'></i>
                            <span class="nav_name">Products</span>
                            <i class="bx bx-chevrons-down bx-fade-down-hover nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="{{ route('admin.product.index') }}" class="nav_dropdown_item">list</a>
                                <a href="{{ route('admin.product.create') }}" class="nav_dropdown_item">Create</a>
                                @if(isTeamSA())
                                    <a href="{{ route('admin.categories.index') }}" class="nav_dropdown_item">Categories</a>
                                    <a href="{{ route('admin.attr.index') }}" class="nav_dropdown_item">Attributes</a>
                                @endif
                                <a href="{{ route('admin.coupons') }}" class="nav_dropdown_item">Coupons</a>
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
                                <a href="{{ route('admin.orders') }}" class="nav_dropdown_item">Orders</a>
                                @if(isTeamSA())
                                    <a href="{{ route('admin.payments') }}" class="nav_dropdown_item">Payments</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(isRed())
                        <div class="nav_dropdown">
                            <a href="#" class="nav_link">
                                <i class="fab fa-page4 nav_icon"></i>
                                <span class="nav_name">Page Content</span>
                                <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                            </a>
                            <div class="nav_dropdown_collapse">
                                <div class="nav_dropdown_content">
                                    <a href="{{ route('admin.cms.index') }}" class="nav_dropdown_item">CMS</a>
                                    <a href="{{ route('admin.banners') }}" class="nav_dropdown_item">Banners</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Apps</h3>
                    <div class="dropdown-divider m-0"></div>
                    <a href="{{ route('admin.contacts') }}" class="nav_link">
                        <i class='bx bxs-contact nav_icon'></i>
                        <span class="nav_name">Contacts</span>
                    </a>
                    @if(isTeamSA())
                        <a href="{{ route('admin.emails') }}" class="nav_link">
                            <i class='bx bx-mail-send nav_icon'></i>
                            <span class="nav_name">Emails</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="fas fa-paper-plane nav_icon"></i>
                            <span class="nav_name">Messages</span>
                        </a>
                    @endif
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-store nav_icon"></i>
                            <span class="nav_name">Suf-Store</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="{{ route('home') }}" class="nav_dropdown_item">Home</a>
                                <a href="{{ route('products') }}" class="nav_dropdown_item">Products</a>
                                <a href="{{ route('cart') }}" class="nav_dropdown_item">Cart</a>
                                <a href="{{ route('checkout') }}" class="nav_dropdown_item">Checkout</a>
                                <a href="{{ route('contact-us') }}" class="nav_dropdown_item">Contact-us</a>
                                <a href="{{ route('about-us') }}" class="nav_dropdown_item">About-us</a>
                                <a href="{{ route('info') }}" class="nav_dropdown_item">Terms & Conditions</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav_items">
                    <h3 class="nav_subtitle">Users</h3>
                    <div class="dropdown-divider m-0"></div>
                    <div class="nav_dropdown">
                        <a href="#" class="nav_link">
                            <i class="fas fa-users nav_icon"></i>
                            <span class="nav_name">Users</span>
                            <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                        </a>
                        <div class="nav_dropdown_collapse">
                            <div class="nav_dropdown_content">
                                <a href="{{ route('admin.customers') }}" class="nav_dropdown_item">Customers</a>
                                @if(isTeamSA())
                                    <a href="{{ route('admin.sellers') }}" class="nav_dropdown_item">Sellers</a>
                                    @if(isRed())
                                        <a href="{{ route('admin.admins') }}" class="nav_dropdown_item">Admins</a>
                                        <a href="{{ route('admin.users') }}" class="nav_dropdown_item">All</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(isRed())
                        <div class="nav_dropdown">
                            <a href="#" class="nav_link">
                                <i class="fas fa-user-shield nav_icon"></i>
                                <span class="nav_name">Permissions</span>
                                <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                            </a>
                            <div class="nav_dropdown_collapse">
                                <div class="nav_dropdown_content">
                                    <a href="{{ route('admin.permission.index') }}" class="nav_dropdown_item">List</a>
                                    <a href="{{ route('admin.role.assign') }}" class="nav_dropdown_item">Assign</a>
                                    <a href="{{ route('admin.permission.create') }}" class="nav_dropdown_item">Create</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.review.index') }}" class="nav_link">
                            <i class='bx bxs-comment-detail nav_icon'></i>
                            <span class="nav_name">Reviews</span>
                        </a>
                    @endif
                    <a href="{{ route('admin.profile') }}" class="nav_link">
                        <i class='bx bxs-user-account nav_icon'></i>
                        <span class="nav_name">Profile</span>
                    </a>
                </div>

                @if(isAdmin())
                    <div class="nav_items">
                        <h3 class="nav_subtitle">ETC</h3>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav_dropdown">
                            <a href="#" class="nav_link">
                                <i class='bx bxs-server nav_icon'></i>
                                <span class="nav_name">Data</span>
                                <i class="bx bx-chevrons-down nav_icon nav_dropdown_icon"></i>
                            </a>
                            <div class="nav_dropdown_collapse">
                                <div class="nav_dropdown_content">
                                    <a href="{{ route('admin.chart.index') }}" class="nav_dropdown_item">Charts</a>
                                    <a href="#" class="nav_dropdown_item">Analysis</a>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="nav_link">
                            <i class='bx bx-info-circle nav_icon'></i>
                            <span class="nav_name">Status</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ route('logout') }}" class="nav_link nav_logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-log-out nav_icon"></i>
            <span class="nav_name">{{ __('Leave') }}</span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</div>
