@extends('/layouts.master')
@section('title', 'Home')
@section('content')
    @include('/partials/top_nav')

<div id="details">

<!--    Start Content Area    -->

    <div class="container">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/products')}}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$details['details'] -> title}}</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <!--    Start Product Show Case    -->

        <div class="row my-2 justify-content-center">
            <div class="col p-2 card" style="min-height: 30rem;">
                <div class="row" style="height: 100%;">
                    {{--    Images    --}}
                    <div class="col-6">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-1.jpg")}}')"></div>
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-2.jpg")}}')"></div>
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-3.jpg")}}')"></div>
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-1.jpg")}}')"></div>
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-2.jpg")}}')"></div>
                                <div class="swiper-slide" style="background-image:url('{{asset("/images/products/jacket-3.jpg")}}')"></div>
                            </div>
                        </div>
                    </div>

                    {{--    Details    --}}
                    <div class="col-6">
                        <div class="card-title m-0">
                            <div class="d-flex justify-content-between">
                                <h3>Classy Jacket</h3>
                                <p class="small">Seller</p>
                            </div>
                            <h6>--> Brand</h6>
                        </div>
                        <hr>
                        <div class="card-body py-1">
                            <div class="row justify-content-end">
                                <div class="col"><p class="small m-0">40 in stock</p></div>
                                <div class="col-6">
                                    <select name="quantity" id="quantity" class="form-control" aria-label>
                                        <option selected hidden value="">select quantity</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5>Variations</h5>
                                    <hr class="bg-warning m-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Sizes
                                            <div class="form-group m-0">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline1">S</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">M</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">L</label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">Colors
                                            <div class="form-group m-0">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline1">Red</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">Blue</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">White</label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <p>KSH 300/=</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-success">Add To Cart <i class="bx bxs-cart-add"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h4>Description</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet animi architecto doloribus eaque earum esse impedit magni officiis perferendis praesentium quae quaerat, quis repellendus tempora vel veniam voluptate. Necessitatibus?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    End Product Show Case    -->

        <!--    Start Product Info    -->

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Product Details</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Related Products</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div id="products_like">
                    <div class="row like_title">
                        <div class="col">
                            <h3>Product Information</h3>
                            <hr class="bg-light my-0">
                        </div>
                    </div>
                </div>
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col" colspan="2">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Brand</th>
                        <td>Gap Premium</td>
                    </tr>
                    <tr>
                        <th scope="row">Colors</th>
                        <td>Red, Blue, White</td>
                    </tr>
                    <tr>
                        <th scope="row">Materials</th>
                        <td>Cotton, Silk, Wool</td>
                    </tr>
                    <tr>
                        <th scope="row">Seller</th>
                        <td>Larry</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
        <!--    End Product Info    -->

    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

@endsection
