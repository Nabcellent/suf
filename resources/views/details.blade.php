@extends('/layouts.master')
@section('title', 'Home')
@section('content')
    @include('/partials/top_header')
    @include('/partials/top_nav')

<div id="details">

<!--    Start Content Area    -->

    <div id="content">
        <div class="container details_container">
            <div class="row">

                <!--    Start Breadcrumb    -->

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/products">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$details['details'] -> pro_title}}</li>
                        </ul>
                    </nav>
                </div>
                <!--    End Breadcrumb    -->
            </div>
            <div class="row my-2 justify-content-center">

                <!--    Start ProductSeeder Detail    -->

                <div class="col-md-12">
                    <div id="main_product" class="row">
                        <div class="col-md-6">

                            <!-- Swiper -->

                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_one}})"></div>
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_two}})"></div>
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_three}})"></div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_one}})"></div>
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_two}})"></div>
                                    <div class="swiper-slide" style="background-image:url(/images/products/{{$details['details'] -> pro_image_three}})"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 align-self-center">

                            <!--    Start Box    -->

                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="box bg-light px-3 rounded shadow details_box">
                                        <div class="row">
                                            <div class="col-md-12 pt-2">
                                                <h3 class="mb-3 text-center">{{$details['details'] -> pro_title}}</h3>
                                                <span class="product_label {{$details['details'] -> pro_label}}">
                                                    {{$details['details'] -> pro_label}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="add_to_cart_form" action="/cart" method="POST">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="product_id" value="{{$details['details'] -> id}}">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text">Quantity</label>
                                                        </div>
                                                        <select class="custom-select form-control" name="quantity" aria-label>
                                                            <option selected value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text">Size</label>
                                                        </div>
                                                        <select class="custom-select form-control" name="size" aria-label
                                                                required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Size is required')">
                                                            <option hidden value="">Select a size</option>
                                                            <option value="Small">Small</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Large">Large</option>
                                                        </select>
                                                    </div>

                                                    <div class="row pt-2">
                                                        <div class="col prices">
                                                            @if($details['details'] -> pro_sale_price === 0)
                                                                <input type="text" name="price" value="{{$details['details'] -> pro_price}}/=" readonly aria-label>
                                                            @else
                                                                <input type="text" name="price" value="{{$details['details'] -> pro_price}}/=" readonly aria-label><br>
                                                                <del class="text-secondary">{{$details['details'] -> pro_price}}/=</del>
                                                            @endif
                                                        </div>
                                                        <div class="col form-group text-right">
                                                            <button type="submit" class="btn btn-primary float-right">
                                                                <i class="fas fa-shopping-cart"></i> Add to Cart
                                                            </button>
                                                            <img class="d-none loader_gif" src="/images/loaders/Ripple-1s-151px.gif" alt="loader.gif">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    End Box    -->

                        </div>
                    </div>

                    <!--    Start ProductSeeder Description    -->

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="box bg-dark text-light p-3 rounded shadow" id="details">

                                <h3>Product Details</h3>
                                <hr class="bg-light mt-0">
                                <p>product desc</p>

                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </div>
                    <!--    End ProductSeeder Description    -->

                </div>
                <!--    End ProductSeeder Detail    -->

            </div>

            <!--    Start Products you may Like    -->

            <div id="products_like" class="row">
                <div class="col">
                    <div class="row like_title">
                        <div class="col">
                            <h3>Products you may Like</h3>
                            <hr class="bg-light my-0">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div id="results" class="col column">

                            <!--    Start Single ProductSeeder    -->
                            @foreach($details['products'] -> take(5) as $item)
                                <div class="card">
                                    <a href="/details/{{$item -> id}}"><img src='/images/products/{{$item -> pro_image_one}}' alt=''></a>
                                    <div class="card-body">
                                        <div class="row product_title">
                                            <div class="col">
                                                <h6 class="card-title text-nowrap"><a href=''>{{$item -> pro_title}}</a></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-auto prices">
                                                @if($item -> pro_sale_price === 0)
                                                    <p>{{$item -> pro_price}}/=</p>
                                                @else
                                                    <p>{{$item -> pro_price}}/=</p>
                                                    <del class="text-secondary">{{$item -> pro_sale_price}}/=</del>
                                                @endif
                                            </div>
                                            <div class="col-7 button">
                                                <a href="/details/{{$item -> id}}" class='btn btn-block btn-outline-primary add'>
                                                    <i class='fas fa-cart-plus'></i> +
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="product_label {{$item -> pro_label}} ">
                                        <span class="label">{{$item -> pro_label}}</span>
                                    </a>
                                </div>
                        @endforeach
                        <!--    End Single ProductSeeder    -->

                        </div>
                    </div>
                </div>
            </div>
            <!--    End Products you may Like    -->
        </div>
    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

@endsection
