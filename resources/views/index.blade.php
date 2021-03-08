@extends('/layouts.master')
@section('title', 'Home')
@section('content')
    @include('partials.top_header')
    @include('partials.header_carousel')
    @include('partials.top_nav')
    @include('partials.social_icons')

    <div id="index">
        <div class="container-fluid p-0">

            {{--    Start Content    --}}

            {{--    Start Box Section    --}}

            <div class="container">
                <div class="row">

                    @foreach($homeInfo['adBoxes'] as $item)
                        <div class="col p-3 box_section">
                            <div class="card mb-2 text-black rounded shadow" style="max-width:25rem">
                                <a href="">
                                    <img class="card-img" src="images/box_section/{{$item['box_image']}}" alt="Image">
                                    <div class="card-img-overlay text-left">
                                        <h2 class="card-title">{{$item['box_title']}}</h2>
                                        <p class="card-text">{{$item['box_desc']}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            {{--    End Box Section    --}}

            {{--    Start Product Preview    --}}

            <div class="products">

                <!--    Start Latest Products    -->

                <div id="content" class="container-fluid latest_products product_container">
                    <div class="section_title">
                        <div class="container">
                            <h3 class="mb-0">Latest Products</h3>
                        </div>
                    </div>

                    <!--    Start Swiper 1    -->

                    <div class="row py-2">
                        <div class="col">
                            <div class="swiper-container product_swiper">
                                <div class="swiper-wrapper">

                                    <!--    Start Slide    -->

                                    @foreach($homeInfo['products']['latestLadies'] as $item)
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    <a href='/details/{{$item -> id}}'>
                                                        <img src='images/products/{{$item['pro_image_one']}}' alt=''>
                                                    </a>
                                                    <div class="supplier">
                                                        <a href="#">Man title</a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">
                                                            <a href=''>{{$item['pro_title']}}</a>
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col prices">
                                                                @if($item['pro_sale_price'] === 0)
                                                                <p>{{$item['pro_price']}}/=</p>
                                                                @else
                                                                <p>{{$item['pro_sale_price']}}/=</p><br>
                                                                <del class="text-secondary">{{$item['pro_price']}}/=</del>
                                                                @endif
                                                            </div>
                                                            <div class="col button">
                                                                <a href='' class='btn btn-block btn-outline-primary add'>
                                                                    <i class='fas fa-cart-plus'></i> Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="product_label {{$item['pro_label']}}">
                                                    <span class="label">{{$item['pro_label']}}</span>
                                                </a>
                                            </div>
                                @endforeach
                                    <!--    End Slide    -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Swiper 1    -->

                    <!--    Start Swiper 2    -->

                    <div class="row py-2">
                        <div class="col">
                            <div class="swiper-container product_swiper">
                                <div class="swiper-wrapper">

                                    <!--    Start Slide    -->

                                    @foreach($homeInfo['products']['latestGents'] as $item)
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <a href=''>
                                                    <img src='images/products/{{$item['pro_image_one']}}' alt=''>
                                                </a>
                                                <div class="supplier">
                                                    <a href="#">Man title</a>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <a href=''>{{$item['pro_title']}}</a>
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col prices">
                                                            @if($item['pro_sale_price'] === 0)
                                                                <p>{{$item['pro_price']}}/=</p>
                                                                @else
                                                                <p>{{$item['pro_sale_price']}}/=</p><br>
                                                                <del class="text-secondary">{{$item['pro_price']}}/=</del>
                                                                @endif
                                                        </div>
                                                        <div class="col button">
                                                            <a href='' class='btn btn-block btn-outline-primary add'>
                                                                <i class='fas fa-cart-plus'></i> Add
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="product_label {{$item['pro_label']}}">
                                                <span class="label">{{$item['pro_label']}}</span>
                                            </a>
                                        </div>
                                @endforeach
                                    <!--    End Slide    -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Swiper 2    -->
                    <!--    End Latest Products    -->

                    <!--    STart Top Products    -->

                    <div class="section_title">
                        <div class="container">
                            <h3 class="mb-0">Top Products</h3>
                        </div>
                    </div>

                    <!--    Start Swiper 1    -->

                    <div class="row py-2">
                        <div class="col">
                            <div class="swiper-container product_swiper">
                                <div class="swiper-wrapper">

                                    <!--    Start Slide    -->

                                    @foreach($homeInfo['products']['top'] as $item)
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <a href=''>
                                                    <img src='images/products/{{$item['pro_image_one']}}' alt=''>
                                                </a>
                                                <div class="supplier">
                                                    <a href="#">Man title</a>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <a href=''>{{$item['pro_title']}}</a>
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col prices">
                                                            @if($item['pro_sale_price'] === 0)
                                                                <p>{{$item['pro_price']}}/=</p>
                                                                @else
                                                                <p>{{$item['pro_sale_price']}}/=</p><br>
                                                                <del class="text-secondary">{{$item['pro_price']}}/=</del>
                                                                @endif
                                                        </div>
                                                        <div class="col button">
                                                            <a href='' class='btn btn-block btn-outline-primary add'>
                                                                <i class='fas fa-cart-plus'></i> Add
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="product_label {{$item['pro_label']}}">
                                                <span class="label">{{$item['pro_label']}}</span>
                                            </a>
                                        </div>
                                @endforeach
                                    <!--    End Slide    -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Swiper 1    -->
                    {{--    End Top Products    --}}

                </div>
            </div>
            {{--    End Product Preview    --}}

            {{--    Start Rotating Image    --}}

            <div class="rotating-img">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center">
                            <img src="images/general/main_logo.jpg" alt="logo" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Rotating Image    -->
        </div>
    </div>

@endsection
