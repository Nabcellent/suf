@extends('/layouts.master')
@section('title', 'Details')
@section('content')
    @include('/partials/top_nav')
    <?php use App\Models\Product; ?>

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
                        <li class="breadcrumb-item" aria-current="page"><a href="/products/{{$details['sub_category']['id']}}">{{$details['sub_category']['title']}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$details['title']}}</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <!--    Start Product Show Case    -->

        <div class="row my-2 justify-content-center">
            <div class="col p-3 card" style="min-height: 30rem;">
                <div class="row" style="height: 100%;">
                    {{--    Images    --}}
                    <div class="col-6">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('{{asset('/images/products/' . $details['main_image'])}}')"></div>

                                @foreach($details['images'] as $image)
                                    <div class="swiper-slide" style="background-image:url('{{asset('/images/products/' . $image['image'])}}')"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('{{asset('/images/products/' . $details['main_image'])}}')"></div>

                                @foreach($details['images'] as $image)
                                    <div class="swiper-slide" style="background-image:url('{{asset('/images/products/' . $image['image'])}}')"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{--    Details    --}}
                    <div class="col-6">
                        <div class="card-title m-0">
                            <div class="d-flex justify-content-between">
                                <h3>{{$details['title']}}</h3>
                                <p class="small">{{$details['seller']['admin']['username']}}</p>
                            </div>
                            <h6>--> {{$details['brand']['name']}}</h6>
                        </div>
                        <hr>
                        <form action="{{url('/add-to-cart')}}" method="POST" class="card-body py-1">
                            @csrf
                            <div class="row justify-content-end">
                                <div class="col"><p class="small m-0">{{$totalStock}} in stock</p></div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                                        </div>
                                        <input type="number" name="quantity" class="form-control" min="0" step="1" placeholder="Quantity" aria-label required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="min-height: 10rem">
                                <div class="col variations">

                                    @if(count($details['variations']) > 0)
                                        <h5>Variations</h5>
                                        <hr class="bg-warning m-0">
                                        <ul class="list-group list-group-flush">
                                            @foreach($details['variations'] as  $variation)
                                                <?php $variationName = key(json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR)) ?>
                                                @if(count($variation['variation_options']) > 0)
                                                    <li class="list-group-item">{{$variationName}}
                                                        <div class="form-group m-0">
                                                                @foreach($variation['variation_options'] as $option)
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="option{{$option['id']}}" name="variant{{ $variationName }}"
                                                                               class="custom-control-input" value="{{$option['variant']}}" data-id="{{$details['id']}}" required>
                                                                        <label class="custom-control-label" for="option{{$option['id']}}" data-id="{{$details['id']}}">
                                                                            {{$option['variant']}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <?php $discountPrice = Product::getDiscountPrice($details['id']); ?>
                                    @if($discountPrice > 0)
                                            <p class="font-weight-bold m-0">
                                                KSH <span class="variation_price">{{$discountPrice}}</span>/=
                                            </p>
                                            <del class="text-secondary">{{$details['base_price']}}/=</del>
                                        @else
                                            <p class="font-weight-bold">
                                                KSH <span class="variation_price">{{$details['base_price']}}</span>/=
                                            </p>
                                        @endif
                                </div>
                                <div class="col text-right">
                                    <input type="hidden" name="product_id" value="{{$details['id']}}">
                                    <button class="btn btn-success">Add To Cart <i class="bx bxs-cart-add"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <h4>Description</h4>
                            <p>{{$details['description']}}</p>
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
                @if(count($related) > 0)
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Related Products</a>
                @endif
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
                    <tr><th scope="col" colspan="2">Details</th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Brand</th>
                        <td>{{$details['brand']['name']}}</td>
                    </tr>
                    @if(count($details['variations']) > 0)
                        @foreach($details['variations'] as  $variation)
                            <?php
                            $variationName = key(json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR));
                            $variationOption = json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR)[$variationName];
                            ?>
                            <tr>
                                <th scope="row">{{$variationName}}</th>
                                @if(is_array($variationOption))
                                <td>{{implode(', ', $variationOption)}}</td>
                                @else
                                    <td>{{$variationOption}}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th scope="row">Seller</th>
                        <td>{{$details['seller']['admin']['username']}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @if(count($related) > 0)
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
                                    @foreach($related as $item)
                                        <div class="card">
                                            <a href="{{url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item['title']))}}">
                                                @if(isset($item['main_image']))
                                                    <?php $image_path = 'images/products/' . $item['main_image']; ?>
                                                @else
                                                    <?php $image_path = ''; ?>
                                                @endif
                                                @if(!empty($item['main_image']) && file_exists($image_path))
                                                    <img src="{{asset($image_path)}}" alt="Product image">
                                                @else
                                                    <img src="{{asset('images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                                @endif
                                            </a>
                                            <div class="card-body">
                                                <h6 class="card-title"><a href="">{{$item['title']}}</a></h6>
                                                <div class="d-flex justify-content-center">
                                                    <hr class="col-7 m-0">
                                                </div>
                                                <p class="m-0 text-center text-secondary">{{$item['brand']['name']}}</p>
                                                <div class="row">
                                                    <div class="col prices">
                                                        <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                        @if($discountPrice > 0)
                                                            <p>{{$discountPrice}}/=</p><br>
                                                            <del class="text-secondary">{{$item['base_price']}}/=</del>
                                                        @else
                                                            <p>{{$item['base_price']}}/=</p>
                                                        @endif
                                                    </div>
                                                    <div class="col button">
                                                        <a href="" class="btn btn-block btn-outline-primary add">
                                                            <i class="fas fa-cart-plus"></i> +
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="product_label {{strtolower($item['label'])}}">
                                                <span class="label">{{$item['label']}}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Products you may Like    -->
                </div>
            @endif

        </div>
        <!--    End Product Info    -->

    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

@endsection
