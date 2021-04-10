</header>

<?php
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

if(Auth::check()) {
    $cartCount = Cart::where('user_id', Auth::id())->count();
} else if(!empty(Session::get('session_id'))) {
    $cartCount = Cart::where('session_id', Session::get('session_id'))->count();
}

?>

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

                                @foreach($latestFour as $four)
                                    <div class="list_item text-center">
                                        <a href="{{url('/product/' . $four['id'] . '/' . preg_replace("/\s+/", "", $four['title']))}}">
                                            <img src="/images/products/{{$four['main_image']}}" alt="new ProductSeeder">
                                            <h4 class="title">{{$four['title']}}</h4>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </li>
                        <li class="menu_item_has_children">
                            <a href="{{url('/products')}}" class="nav_link products">Products <span><i class='bx bx-down-arrow-alt' ></i></span></a>
                            <ul class="sub_menu mega_menu mega_menu_column_4">


                                @foreach($sections as $section)
                                    @if(count($section['categories']) > 0)
                                        <li class="list_item">
                                            <h4 class="title">
                                                <a href="{{url('#')}}">{{$section['title']}}' Fashion</a>
                                            </h4>
                                            <div class="mt-0 dropdown-divider"></div>
                                            <ul>
                                                @foreach($section['categories'] as $category)
                                                    <li><a href="{{url('/products/' . $category['id'])}}">{{$category['title']}}</a></li>
                                                    @foreach($category['sub_categories'] as $subCategory)
                                                        <li class="ml-2"><a href="{{url('/products/' . $subCategory['id'])}}">- {{$subCategory['title']}}</a></li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach

                                <li class="list_item">
                                    <img src="{{asset('/images/general/meganav/174-1744463_beard-men-in-suit.jpg')}}" alt="shop">
                                    <h4 class="title"><a href="{{url('/products')}}" class="d-block d-lg-none lead nav_link">All Products</a></h4>
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
                    <a href="{{url('/cart')}}" class="icon_button">
                        <i class="fab fa-opencart"></i>

                        @if(Auth::check() || !empty(Session::get('session_id')))
                            <span class="icon_count">
                                {{$cartCount}}
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
