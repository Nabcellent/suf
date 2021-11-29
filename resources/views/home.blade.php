@extends('/layouts.master')
@section('title', 'Home')
@section('content')
    @include('partials.top_nav')
    @include('partials.social_icons')

    <div id="index">
        <div class="container-fluid p-0">
            {{--    Start Content    --}}

            {{--    Start Box Section    --}}
            <div class="container">
                <div class="row">

                    @foreach($banners['ads'] as $item)
                        <div class="col p-3 box_section">
                            <div class="card mb-2 text-black rounded shadow" style="max-width:25rem">
                                <a href="{{ $item->link }}">
                                    <img class="card-img" src="{{ asset('/images/banners/' . $item->image) }}" alt="Image">
                                    <div class="card-img-overlay text-left">
                                        <h2 class="card-title m-0">{{$item->title}}</h2>
                                        <p class="card-text m-0">{{$item->description}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            {{--    End Box Section    --}}

            <div class="products">
                <!--    Start FEATURED PRODUCTS    -->

                <div id="content" class="container-fluid latest_products product_container">
                    @if(count($featuredProducts) > 0)
                        <div class="section_title">
                            <div class="container">
                                <div class="row">
                                    <div class="col d-flex justify-content-between">
                                        <h3 class="mb-0">Featured Products</h3>
                                        <p class="m-0 lead">{{ count($featuredProducts) }} Featured products</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--    Start Swiper 1    -->

                        <div class="row py-2">
                            <div class="col-3">
                                <div class="card-body h-100 d-flex justify-content-center align-items-center">
                                    <h4>Some SU AD</h4>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="swiper featured_products_swiper product_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($featuredProducts as $item)
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                                        @if(isset($item->image) && file_exists(public_path("images/products/{$item->image}")))
                                                            <img src="{{asset("images/products/{$item->image}")}}" alt="Product image">
                                                        @else
                                                            <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                        @endif
                                                    </a>
                                                    <div class="supplier">
                                                        <a href="#">{{$item->seller->admin->username}}</a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="card-title"><a href=''>{{$item->title}}</a></h6>
                                                        <div class="row">
                                                            <div class="col-auto prices">
                                                                @if($item->discount_price > 0)
                                                                    <p>{{$item->discount_price}}/=</p><br>
                                                                    <del class="text-secondary">{{$item->base_price}}/=</del>
                                                                @else
                                                                    <p>{{$item->base_price}}/=</p>
                                                                @endif
                                                            </div>
                                                            <div class="col button">
                                                                <a href="{{ route('product-details', ['id' => $item->id, 'title' => preg_replace("/\s+/", "", $item->title)]) }}"
                                                                   class='btn btn-block btn-outline-primary add'>
                                                                    <i class='fas fa-cart-plus'></i> Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="product_label {{strtolower($item->label)}}">
                                                    <span class="label">{{$item->label}}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                <!--    End Swiper 1    -->

                    @if(count($newProducts) > 0)
                        <div class="section_title">
                            <div class="container">
                                <h3 class="mb-0">Latest Products</h3>
                            </div>
                        </div>
                    @endif

                <!--    Start Swiper 1    -->
                    <div class="row py-2">
                        <div class="col">
                            <div class="swiper product_swiper">
                                <div class="swiper-wrapper">
                                    @foreach($newProducts as $item)
                                        @if($item->section === 'Ladies')
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                                        @if(isset($item->image) && file_exists(public_path("images/products/{$item->image}")))
                                                            <img src="{{asset("images/products/{$item->image}")}}" alt="Product image">
                                                        @else
                                                            <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                        @endif
                                                    </a>
                                                    <div class="supplier">
                                                        <a href="#">{{$item->username}}</a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">
                                                            <a href=''>{{$item->title}}</a>
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-auto prices">
                                                                @if($item->discount_price > 0)
                                                                    <p>{{$item->discount_price}}/=</p><br>
                                                                    <del class="text-secondary">{{$item->base_price}}/=</del>
                                                                @else
                                                                    <p>{{$item->base_price}}/=</p>
                                                                @endif
                                                            </div>
                                                            <div class="col button">
                                                                <a href="{{ route('product-details', ['id' => $item->id, 'title' => preg_replace("/\s+/", "", $item->title)]) }}"
                                                                   class='btn btn-block btn-outline-primary add'>
                                                                    <i class='fas fa-cart-plus'></i> Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="product_label {{strtolower($item->label)}}">
                                                    <span class="label">{{$item->label}}</span>
                                                </a>
                                            </div>
                                    @endif
                                @endforeach
                                <!--    End Slide    -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Swiper 1    -->

                    <!--    Start Swiper 2 - GENTS    -->

                    <div class="row py-2">
                        <div class="col">
                            <div class="swiper product_swiper">
                                <div class="swiper-wrapper">
                                    @foreach($newProducts as $item)
                                        @if($item->section === 'Gents')
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                                        @if(isset($item->image) && file_exists(public_path("images/products/{$item->image}")))
                                                            <img src="{{asset("/images/products/{$item->image}")}}" alt="Product image">
                                                        @else
                                                            <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                        @endif
                                                    </a>
                                                    <div class="supplier"><a href="#">{{$item->username}}</a></div>
                                                    <div class="card-body">
                                                        <h6 class="card-title"><a href=''>{{$item->title}}</a></h6>
                                                        <div class="row">
                                                            <div class="col-auto prices">
                                                                @if($item->discount_price > 0)
                                                                    <p>{{$item->discount_price}}/=</p><br>
                                                                    <del class="text-secondary">{{$item->base_price}}/=</del>
                                                                @else
                                                                    <p>{{$item->base_price}}/=</p>
                                                                @endif
                                                            </div>
                                                            <div class="col button">
                                                                <a href="{{ route('product-details', ['id' => $item->id, 'title' => preg_replace("/\s+/", "", $item->title)]) }}"
                                                                   class='btn btn-block btn-outline-primary add'>
                                                                    <i class='fas fa-cart-plus'></i> Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="product_label {{strtolower($item->label)}}">
                                                    <span class="label">{{$item->label}}</span>
                                                </a>
                                            </div>
                                    @endif
                                @endforeach
                                <!--    End Slide    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Swiper 2    -->
                    <!--    End Latest Products    -->

                    <!--    STart Top Products    -->

                    @if(count($topProducts) > 0)
                        <div class="section_title">
                            <div class="container"><h3 class="mb-0">Top Products</h3></div>
                        </div>

                        <!--    Start Swiper 1    -->

                        <div class="row py-2">
                            <div class="col">
                                <div class="swiper product_swiper">
                                    <div class="swiper-wrapper">

                                        @foreach($topProducts as $item)
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    <a href="{{url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                                        @if(!empty($item->image) && file_exists("images/products/{$item->image}"))
                                                            <img src="{{asset("images/products/{$item->image}")}}" alt="Product image">
                                                        @else
                                                            <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                        @endif
                                                    </a>
                                                    <div class="supplier"><a href="#">Man title</a></div>
                                                    <div class="card-body">
                                                        <h6 class="card-title"><a href=''>{{$item->title}}</a></h6>
                                                        <div class="row">
                                                            <div class="col-auto prices">
                                                                @if($item->discount_price > 0)
                                                                    <p>{{$item->discount_price}}/=</p><br>
                                                                    <del class="text-secondary">{{$item->base_price}}/=</del>
                                                                @else
                                                                    <p>{{$item->base_price}}/=</p>
                                                                @endif
                                                            </div>
                                                            <div class="col button">
                                                                <a href="{{ route('product-details', ['id' => $item->id, 'title' => preg_replace("/\s+/", "", $item->title)]) }}"
                                                                   class='btn btn-block btn-outline-primary add'>
                                                                    <i class='fas fa-cart-plus'></i> Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="product_label {{$item->label}}">
                                                    <span class="label">{{$item->label}}</span>
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
                    @endif

                </div>
            </div>
            {{--    End ProductSeeder Preview    --}}

            {{--    Start Rotating Image    --}}

            <div class="rotating-img">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center">
                            <img src="{{ asset('images/general/store_logo.jpg') }}" alt="logo" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Rotating Image    -->
        </div>
    </div>

@endsection
