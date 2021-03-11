@extends('/layouts.master')
@section('title', 'Products')
@section('content')
    @include('partials.top_header')
    @include('partials.top_nav')

<!--    End Sticky Header    -->

<!--    Start Sticky Header Jumbotron    -->

<div id="products">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container-fluid products_container">

            <!--    Start Breadcrumb    -->

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <div class="row">

                <!--    Start SideBar Categories    -->

                <div class="col-md-3">

                    @include('partials.products.sidebar')

                </div>
                <!--    End SideBar Categories    -->

                <!--    Start ProductSeeder Section    -->

                <div class="col-md-9">
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
                        <img src="images/loaders/Infinity-1s-197px.gif" alt="" id="loader" width="197" style="display:none;">
                    </div>

                    <div id="product_section" class="row mb-2">
                        <div id="results" class="col column">

                        <!--    Start Single ProductSeeder    -->
                            @foreach($products -> take(20) as $item)
                                <div class="card">
                                    <a href="/details/{{$item -> id}}"><img src='images/products/{{$item -> pro_image_one}}' alt=''></a>
                                    <div class="supplier"><a href="#">{{$item -> man_name}}</a></div>
                                    <div class="card-body">
                                        <h6 class="card-title"><a href=''>{{$item -> pro_title}}</a></h6>
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
                                                    <i class='fas fa-cart-plus'></i> +
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="product_label {{$item['pro_label']}} ">
                                        <span class="label">{{$item['pro_label']}}</span>
                                    </a>
                                </div>
                            @endforeach
                            <!--    End Single ProductSeeder    -->

                        </div>

                        <!--    Start Pagination    -->

                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item"><button class="page-link" value="1">First Page</button></li>

                                    @for($i = 1; $i < ceil(count($products) / 20); $i++)
                                    <li class='page-item' style='cursor:pointer;'>
                                        <button class='page-link' value=''>{{$i}}</button>
                                    </li>
                                    @endfor

                                    <li class="page-item"><button class="page-link" value="">Last Page</button></li>
                                </ul>
                            </div>
                        </div>
                        <!--    End Pagination    -->

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
