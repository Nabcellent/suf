@extends('/layouts.master')
@section('title', 'Cart')
@section('content')
    @include('/partials/top_nav')

<div id="cart">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container-fluid cart_page_container">
            <div class="row">

                <!--    Start Breadcrumb    -->

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                        </ul>
                    </nav>
                </div>
                <!--    End Breadcrumb    -->
            </div>
            <div id="cart_row" class="row my-2">

                <!--    Start Cart Section    -->

                <div class="col-md-9">

                    <!--    Start Box    -->

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <div class="box bg-light pt-2 pb-3 px-3 rounded shadow cart_table">

                                @if(count($cart) === 0)
                                    <div class='p-5'>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h1 class='display-1'><i class='fab fa-opencart'></i></h1>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h3>Empty Cart</h3>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <a href="{{url('/products')}}" class='btn btn-warning'><i class='bx bx-run bx-flip-horizontal' ></i> Go Shopping</a>
                                        </div>
                                    </div>
                                @else
                                    <div>

                                        <!--    Start Cart Table    -->

                                        <h1>Cart Items</h1>
                                        <p class="text-muted">You currently have <span class="cart_count">{{ cartCount() }}</span> item(s) in your Cart.</p>

                                        <div id="cart_table" class="table-responsive">
                                            @include('partials.products.cart-table')
                                        </div>
                                        <!--    End Cart Table    -->

                                        <!--    Start Coupon Section    -->

                                        <div class="row coupon">
                                            <div class="col">
                                                <div class="form-inline float-right pb-md-3">
                                                    <form action="{{route('apply-coupon')}}" method="POST" class="form-group">
                                                        @csrf
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Coupon Code: </span>
                                                            </div>
                                                            <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Enter Code" aria-label required>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-warning">Apply</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    End Coupon Section    -->

                                        <!--    Start Box Footer    -->

                                        <div class="box_footer">
                                            <div class="float-left">
                                                <a href="{{url('/products')}}" class="btn btn-outline-dark"><i class="fas fa-chevron-left"></i> Continue Shopping</a>
                                            </div>
                                            <div class="float-right">
                                                <a href="{{route('checkout')}}" class="btn btn-outline-success shadow">Checkout <i class="fas fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                        <!--    End Box Footer    -->
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->

                    <!--    Start Products you may like -->

                    <div id="products_like">
                        <div class="row like_title">
                            <div class="col">
                                <h3>Luku Kali ni Setoka !</h3>
                                <hr class="bg-light my-0">
                            </div>
                        </div>
                    </div>
                    <!--    End Products you may like -->
                </div>
                <!--    End Cart Section    -->

                <!--    Start Order Summary    -->

                <div class="col-md-3 pl-md-0">

                    <!--    Start Box    -->

                    <div id="order_summary" class="box p-3 bg-light rounded shadow">
                        <div class="row">
                            <div class="col">
                                <div class="box_header">
                                    <h3>Something Here💀</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <p class="text-muted">
                                Transport and Additional Costs are calculated based on your delivery address and cart quantity.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="svg">
                                    @if(Auth::check())
                                        @if(Auth::user()->gender === "Male")
                                            <img src="{{ asset('images/illustrations/undraw_empty_cart_co35.svg') }}" class="img-fluid shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('images/illustrations/undraw_shopping_app_flsj.svg') }}" class="img-fluid shadow-lg" alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('images/illustrations/undraw_shopping_eii3.svg') }}" class="img-fluid shadow-lg" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->
                </div>
                <!--    End Order Summary    -->
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->


@endsection
