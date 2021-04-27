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

            <!--    Start Breadcrumb    -->

            <div class="row">
                <div class="col">
                    <nav class="d-flex justify-content-between" aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            <?php if(!empty($catDetails['breadcrumbs'])) echo $catDetails['breadcrumbs'] ?>
                        </ul>
                        @if (tableCount()['products'] > 0)
                            <div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="per_page">Per page</label>
                                    </div>
                                    <select class="custom-select" id="per_page">
                                        <option selected value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <div class="row">

                <!--    Start SideBar Categories    -->

                <div class="col-md-3 pl-0">

                    @include('partials.products.sidebar')

                </div>
                <!--    End SideBar Categories    -->

                <!--    Start ProductSeeder Section    -->

                <div class="col-md-9 pr-0">
                    @if(tableCount()['products'] > 0)
                        <div class="row">
                            <div class="col bg-light p-3 mb-2 rounded">
                                <div class="d-flex justify-content-between">
                                    <h2 id="textChange">
                                        @if(!empty($catDetails['catDetails']['title']))
                                            {{$catDetails['catDetails']['title']}}
                                        @else
                                            All Products
                                        @endif
                                    </h2>
                                    <p class="m-0 text-muted">Available products: {{count($products)}}</p>
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
                                    <div class="col-auto">
                                        <form id="sort_products_form" class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="sort_by">Sort By</label>
                                            </div>
                                            <select class="custom-select" name="sort" id="sort_by">
                                                <option selected hidden value="">Select</option>
                                                <option value="newest">Newest Products</option>
                                                <option value="oldest">Oldest Products</option>
                                                <option value="title_asc">Title Ascending</option>
                                                <option value="title_desc">Title Descending</option>
                                                <option value="price_asc">Price Ascending</option>
                                                <option value="price_desc">Price Descending</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="text-center">
                        <img src="{{asset('images/loaders/Infinity-1s-197px.gif')}}" alt="" id="loader" width="197" style="display:none;">
                    </div>

                    <div id="product_section" class="row mb-2">

                        @include('partials.products.products_data')

                    </div>
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
