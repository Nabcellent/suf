@extends('/layouts.master')
@section('title', 'Products')
@section('content')
    @include('partials.top_nav')

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
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ul>
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

                <div class="col-md-9 p-0">
                    <div class="row">
                        <div class="col">
                            <div class='box bg-light p-3 mb-2 rounded'>
                                <h1 id="textChange">All Products</h1>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequatur cupiditate
                                    dolores ducimus eos fugit, harum inventore laboriosam maxime minima nesciunt nihil
                                    nulla praesentium quibusdam quos recusandae repudiandae tenetur veritatis?
                                </p>
                            </div>
                        </div>
                    </div>

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
