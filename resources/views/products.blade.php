@extends('/layouts.master')
@section('title', 'Products')
@section('content')
    @include('partials.top_nav')
    @include('partials.social_icons')

    <!--    Start Sticky Header Jumbotron    -->

    <div id="products">
        <!--    Start Content Area    -->

        <div id="content">
            <div class="container-fluid products_container">
                <div class="row">

                    <!--    Start SideBar Categories    -->

                    <div class="col-md-3 pl-md-0">
                        <!--    Start Breadcrumb    -->

                        <div class="row">
                            <div class="col p-0">
                                <nav class="d-flex justify-content-between align-items-start" aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                                        <?php if(!empty($catDetails['breadcrumbs'])) echo $catDetails['breadcrumbs'] ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!--    End Breadcrumb    -->
                        @include('partials.products.sidebar')

                    </div>
                    <!--    End SideBar Categories    -->

                    <!--    Start ProductSeeder Section    -->

                    <div class="col-md-9 pr-md-0">
                        @if(tableCount()['products'] > 0)
                            <div class="row top-info">
                                <div class="col bg-light p-3 mb-2 rounded">
                                    <div class="d-flex justify-content-between">
                                        <h2 id="textChange">
                                            @if(!empty($catDetails['catDetails']['title']))
                                                {{$catDetails['catDetails']['title']}}
                                            @else
                                                All Products
                                            @endif
                                        </h2>
                                        <p id="productCount" class="m-0 text-muted">Available products: <span>{{count($products)}}</span></p>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row d-flex justify-content-between">
                                        <p class="col">
                                            @if(!empty($catDetails['catDetails']['description']))
                                                {{$catDetails['catDetails']['description']}}
                                            @else
                                                We are pleased to serve you with these products.
                                            @endif
                                        </p>
                                        <div class="col-auto sort">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="text-center">
                            <img src="{{asset('images/loaders/Infinity-1s-197px.gif')}}" alt="" id="loader" width="197" style="display:none;">
                        </div>

                        @livewire('search-product')

                    </div>
                    <!--    End ProductSeeder Section    -->

                </div>
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->

    <!--    Scroll To Top Button    -->

    <span class="shadow" id="scroll_top" title="Scroll to the top"><i class="fas fa-arrow-alt-circle-up"></i></span>
    <!--    End Scroll To Top Button    -->

@endsection
