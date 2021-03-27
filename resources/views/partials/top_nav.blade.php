<?php

use Illuminate\Support\Facades\DB;
use App\Models\Category;
$sections = Category::sections();

$topNavInfo = [
    'latestProducts' => DB::table('products') -> orderByDesc('id') -> take(10) -> get(),
    'subCategories' => DB::table('products')
        -> join('categories', 'products.category_id', '=', 'categories.id')
        -> select('categories.title') -> orderBy('categories.title', 'ASC')
        -> distinct() -> get(),
    'cartCount' => DB::table('cart') -> where('user_id', Auth::id()) -> count()
];

?>

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

                                {{--@for($i = 0; $i < 4; $i++)
                                    <div class="list_item text-center">
                                        <a href="">
                                            <img src="/images/products/{{$topNavInfo['latestProducts'][$i] -> pro_image_one}}" alt="new ProductSeeder">
                                            <h4 class="title">{{$topNavInfo['latestProducts'][$i] -> pro_title}}</h4>
                                        </a>
                                    </div>
                                @endfor--}}

                            </div>
                        </li>
                        <li class="menu_item_has_children">
                            <a href="/products" class="nav_link products">Products <span><i class='bx bx-down-arrow-alt' ></i></span></a>
                            <ul class="sub_menu mega_menu mega_menu_column_4">


                                @foreach($sections as $section)
                                    @if(count($section['categories']) > 0)
                                        <li class="list_item">
                                            <h4 class="title">
                                                <a href="">{{$section['title']}}' Fashion</a>
                                            </h4>
                                            <div class="mt-0 dropdown-divider"></div>
                                            <ul>
                                                @foreach($section['categories'] as $category)
                                                    <li><a href="">{{$category['title']}}</a></li>
                                                    @foreach($category['sub_categories'] as $subCategory)
                                                        <li class="ml-2"><a href="">- {{$subCategory['title']}}</a></li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach


                                {{--<li class="list_item">
                                    <h4 class="title">
                                        <a href="">Ladies' Fashion</a>
                                    </h4>
                                    <div class="mt-0 dropdown-divider"></div>
                                    <ul>

                                        @foreach($topNavInfo['subCategories'] as $item)
                                            @if($item -> title === 'Ladies')
                                            <li>
                                                <a href="">
                                                    {{$item -> subcat_title}}
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>
                                <li class="list_item">
                                    <h4 class="title">
                                        <a href="">Men's Fashion</a>
                                    </h4>
                                    <div class="mt-0 dropdown-divider"></div>
                                    <ul>

                                        @foreach($topNavInfo['subCategories'] as $item)
                                            @if($item -> title === 'Gents')
                                                <li>
                                                    <a href="">
                                                        {{$item -> subcat_title}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>
                                <li class="list_item">
                                    <h4 class="title">
                                        <a href="">Exclusive Fashion</a>
                                    </h4>
                                    <div class="mt-0 dropdown-divider"></div>
                                    <ul>

                                        @foreach($topNavInfo['subCategories'] as $item)
                                            @if($item -> title === 'Exclusive')
                                                <li>
                                                    <a href="">
                                                        {{$item -> title}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>--}}
                                <li class="list_item">
                                    <img src="/images/general/meganav/174-1744463_beard-men-in-suit.jpg" alt="shop">
                                    <h4 class="title"><a href="/products" class="d-block d-lg-none lead nav_link">All Products</a></h4>
                                </li>
                            </ul>
                        </li>
                        <li><a href="/about" class="nav_link">About</a></li>
                        <li><a href="/contact-us" class="nav_link">Contact Us</a></li>
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
                        <span class="icon_count">~</span>
                    </button>
                </div>
                <div class="icons ml-2">
                    <a href="/cart" class="icon_button">
                        <i class="fab fa-opencart"></i>

                        @if(Auth::check())
                            <span class="icon_count">
                                {{$topNavInfo['cartCount']}}
                            </span>
                        @endif

                    </a>
                </div>
                <div class="cart_total">
                    <p class="m-0">7000/=</p>
                </div>

                <!--    Start Mobile Menu Trigger    -->

                <div class="mobile_menu_trigger">
                    <span></span>
                </div>
                <!--    End Mobile Menu Trigger    -->

            </div>
        </div>
    </div>
</header>
