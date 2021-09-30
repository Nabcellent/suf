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
                        @if(tableCount()['products'] > 7)
                            <li class="menu_item_has_children">
                                <a class="nav_link" style="cursor: pointer">Latest <Span><i class='bx bx-down-arrow-alt' ></i></Span></a>
                                <div class="sub_menu mega_menu mega_menu_column_4 text-dark">
                                    @foreach(latestFour() as $four)
                                        <div class="list_item text-center">
                                            <a href="{{url('/product/' . $four->id . '/' . preg_replace("/\s+/", "", $four->title))}}">
                                                @if(isset($four->main_image) && file_exists("images/products/{$four->main_image}"))
                                                    <img src="{{asset("images/products/{$four->main_image}")}}" alt="Product image">
                                                @else
                                                    <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                @endif
                                                <h4 class="title">{{$four->title}}</h4>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                        @if(tableCount()['products'] > 0)
                            <li class="menu_item_has_children">
                                <a href="{{route('products')}}" class="nav_link products">Products <span><i class='bx bx-down-arrow-alt' ></i></span></a>
                                <ul class="sub_menu mega_menu mega_menu_column_4">


                                    @foreach(sections() as $section)
                                        @if(count($section->categories) > 0)
                                            <li class="list_item">
                                                <h4 class="title">
                                                    <a>{{$section->title}}' Fashion</a>
                                                </h4>
                                                <div class="mt-0 dropdown-divider"></div>
                                                <ul>
                                                    @foreach($section->categories as $category)
                                                        <li><a href="{{route('products', ['id' => $category->id])}}">{{$category->title}}</a></li>
                                                        @foreach($category->subCategories as $subCategory)
                                                            <li class="ml-2"><a href="{{url('/products/' . $subCategory->id)}}">- {{$subCategory->title}}</a></li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach

                                    <li class="list_item">
                                        <img src="{{asset('/images/general/meganav/174-1744463_beard-men-in-suit.jpg')}}" alt="shop">
                                        <h4 class="title"><a href="{{ route('products') }}" class="d-block d-lg-none lead nav_link">All Products</a></h4>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!--    End Menu    -->

            <div class="header_item item_right">
                <div class="icons ml-2">
                    <button class="icon_button">
                        <i class="fas fa-hand-sparkles"></i>
                        <span class="icon_count"></span>
                    </button>
                </div>
                <div class="icons ml-2">
                    <a href="{{ url('/cart') }}" class="icon_button">
                        <i class="fab fa-opencart"></i>
                        <span class="cart_count">{{ getCart('count') }}</span>
                    </a>
                </div>
                <div class="cart_total"><p class="m-0">{{ getCart('total') }}/=</p></div>

                <!--    Start Mobile Menu Trigger    -->

                <div class="mobile_menu_trigger"><span></span></div>
                <!--    End Mobile Menu Trigger    -->
            </div>
        </div>
    </div>
</header>
