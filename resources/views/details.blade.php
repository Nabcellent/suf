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
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="/products/{{$details->subCategory->id}}">{{$details->subCategory->title}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$details->title}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <!--    Start Product Show Case    -->

            <div class="row my-2 justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="row">
                            {{--    Images    --}}
                            <div class="col-12 col-md-6" style="min-height: 20rem;">
                                <div class="swiper details-swiper-2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"
                                             style="background-image:url('{{asset('/images/products/' . $details['main_image'])}}')"></div>

                                        @foreach($details->images as $image)
                                            <div class="swiper-slide"
                                                 style="background-image:url('{{asset('/images/products/' . $image->image)}}')"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div thumbsSlider="" class="swiper details-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"
                                             style="background-image:url('{{asset('/images/products/' . $details->main_image)}}')"></div>

                                        @foreach($details->images as $image)
                                            <div class="swiper-slide"
                                                 style="background-image:url('{{asset('/images/products/' . $image['image'])}}')"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{--    Details    --}}
                            <div class="col-12 col-md-6 details" style="min-height: 20rem;">
                                <div class="card-title m-0">
                                    <div class="d-flex justify-content-between align-items-start p-md-2 px-2 py-0">
                                        <h3>{{$details->title}}</h3>
                                        <p class="small text-muted">{{$details->seller->admin->username}}</p>
                                    </div>
                                    <h6 class="brand-name">--> {{$details->brand->name}}</h6>
                                </div>
                                <hr class="my-1 my-md-2">
                                <form action="{{url('/add-to-cart')}}" method="POST" class="card-body py-md-1">
                                    @csrf
                                    <div class="row justify-content-end">
                                        <div class="col"><p class="small m-0">{{$totalStock}} in stock</p></div>
                                        <div class="col-6 quantity">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Quantity</span>
                                                </div>
                                                <input type="number" name="quantity" class="form-control" min="1" step="1"
                                                       value="{{ old('quantity', 1) }}" placeholder="Quantity" autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row variations">
                                        <div class="col">

                                            @if(count($details->variations) > 0)
                                                <h5>Variations</h5>
                                                <hr class="bg-warning m-0">
                                                <ul class="list-group list-group-flush">
                                                    @foreach($details->variations as $variation)
                                                        @if(count($variation->options) > 0)
                                                            <li class="list-group-item py-2 py-md-3">{{$variation->attribute->name}}
                                                                <div class="form-group m-0">
                                                                    @foreach($variation->options as $key => $option)
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="option{{ $key }}" required
                                                                                   name="variant{{ $variation->attribute->name }}"
                                                                                   data-id="{{$details->id}}"
                                                                                   @if(old("variant{$variation->attribute->name}") === $key || count($variation->options) === 1) checked
                                                                                   @endif
                                                                                   class="custom-control-input" value="{{$key}}">
                                                                            <label class="custom-control-label" for="option{{ $key }}"
                                                                                   data-id="{{$details->id}}">{{ $key }}
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
                                        <div class="col price">
                                            <?php $discountPrice = Product::getDiscountPrice($details->id); ?>
                                            @if($discountPrice > 0)
                                                <p class="font-weight-bold m-0">
                                                    KSH <span class="variation_price">{{$discountPrice}}</span>/=
                                                </p>
                                                <del class="text-secondary">{{$details->base_price}}/=</del>
                                            @else
                                                <p class="font-weight-bold">
                                                    KSH <span class="variation_price">{{$details->base_price}}</span>/=
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col text-right">
                                            <input type="hidden" name="product_id" value="{{$details->id}}">
                                            <button class="btn btn-success">Add To Cart <i class="bx bxs-cart-add"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-footer">
                                    <h4>Description</h4>
                                    <p>{{$details->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Product Show Case    -->

            <!--    Start Product Info    -->

            <div class="row product-info">
                <div class="col">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                               aria-controls="nav-home" aria-selected="true">Product Details</a>
                            @if(count($related) > 0)
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                   aria-controls="nav-profile" aria-selected="false">Related Products</a>
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
                                <tr>
                                    <th scope="col" colspan="2">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Brand</th>
                                    <td>{{$details->brand->name}}</td>
                                </tr>
                                @if(count($details->variations) > 0)
                                    @foreach($details->variations as $variation)
                                        <tr>
                                            <th scope="row">{{$variation->attribute->name}}</th>
                                            @if(is_array( $variation->options))
                                                <td>{{implode(', ', array_keys($variation->options))}}</td>
                                            @else
                                                <td>{{ $variation->options }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <th scope="row">Seller</th>
                                    <td>{{$details->seller->admin->username}}</td>
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
                                            <div id="results" class="col">

                                                <!--    Start Single ProductSeeder    -->
                                                @foreach($related as $item)
                                                    <div class="card">
                                                        <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item['title']))}}">
                                                            @if(isset($item->main_image))
                                                                <?php $image_path = 'images/products/' . $item->main_image; ?>
                                                            @else
                                                                <?php $image_path = ''; ?>
                                                            @endif
                                                            @if(!empty($item->main_image) && file_exists($image_path))
                                                                <img src="{{asset($image_path)}}" alt="Product image">
                                                            @else
                                                                <img src="{{asset('images/general/on-on-C100919_Image_01.jpeg')}}"
                                                                     alt="Product image">
                                                            @endif
                                                        </a>
                                                        <div class="card-body">
                                                            <h6 class="card-title"><a href="">{{$item->title}}</a></h6>
                                                            <div class="d-flex justify-content-center">
                                                                <hr class="col-7 m-0">
                                                            </div>
                                                            <p class="m-0 text-center text-secondary brand-name">{{$item->brand->name}}</p>
                                                            <div class="row">
                                                                <div class="col prices">
                                                                    <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                                    @if($discountPrice > 0)
                                                                        <p>{{$discountPrice}}/=</p><br>
                                                                        <del class="text-secondary">{{$item->base_price}}/=</del>
                                                                    @else
                                                                        <p>{{$item->base_price}}/=</p>
                                                                    @endif
                                                                </div>
                                                                <div class="col button">
                                                                    <a href="" class="btn btn-block btn-outline-primary add">
                                                                        <i class="fas fa-cart-plus"></i> +
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="product_label {{strtolower($item->label)}}">
                                                            <span class="label">{{$item->label}}</span>
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
                </div>
            </div>
            <!--    End Product Info    -->

        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->

@endsection
