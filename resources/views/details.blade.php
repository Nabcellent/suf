@extends('/layouts.master')
@section('title', $product->title)
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}">
    @endpush
@endonce
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
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="/products/{{$product->subCategory->id}}">{{$product->subCategory->title}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <!--    Start Product Show Case    -->

            <div class="row my-2 justify-content-center">
                <div class="col card mx-3">
                    <div class="row p-2">
                        {{--    Images    --}}
                        <div class="col-12 col-md-6" style="min-height: 20rem;">
                            <div class="swiper details-swiper-2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"
                                         style="background-image:url('{{asset('/images/products/' . $product['main_image'])}}')"></div>

                                    @foreach($product->images as $image)
                                        <div class="swiper-slide"
                                             style="background-image:url('{{asset('/images/products/' . $image->image)}}')"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div thumbsSlider="" class="swiper details-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"
                                         style="background-image:url('{{asset('/images/products/' . $product->main_image)}}')"></div>

                                    @foreach($product->images as $image)
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
                                    <h3>{{$product->title}}</h3>
                                    <p class="small text-muted">{{$product->seller->admin->username}}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="brand-name">--> {{$product->brand->name}}</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="average-rating" title="Sign in and rate this product 😁"
                                             data-rate-value="{{ $product->average_rating }}"></div>
                                        <small>({{ $product->average_rating }})</small>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-1 my-md-2">
                            <form action="{{url('/add-to-cart')}}" method="POST" class="card-body py-md-1">
                                @csrf
                                <div class="row justify-content-end">
                                    <div class="col"><p class="small m-0">{{ $product->stock }} in stock</p></div>
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

                                        @if(count($product->variations) > 0)
                                            <h5>Variations</h5>
                                            <hr class="bg-warning m-0">
                                            <ul class="list-group list-group-flush">
                                                @foreach($product->variations as $variation)
                                                    @if(count($variation->options) > 0)
                                                        <li class="list-group-item py-2 py-md-3">{{$variation->attribute->name}}
                                                            <div class="form-group m-0">
                                                                @foreach($variation->options as $key => $option)
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="option{{ $key }}" required
                                                                               name="variant{{ $variation->attribute->name }}"
                                                                               data-id="{{$product->id}}"
                                                                               @if(old("variant{$variation->attribute->name}") === $key || count($variation->options) === 1) checked
                                                                               @endif
                                                                               class="custom-control-input" value="{{$key}}">
                                                                        <label class="custom-control-label" for="option{{ $key }}"
                                                                               data-id="{{$product->id}}">{{ $key }}
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
                                        <?php $discountPrice = getDiscountPrice($product->id); ?>
                                        @if($discountPrice > 0)
                                            <p class="font-weight-bold m-0">
                                                KSH <span class="variation_price">{{$discountPrice}}</span>/=
                                            </p>
                                            <del class="text-secondary">{{$product->base_price}}/=</del>
                                        @else
                                            <p class="font-weight-bold">
                                                KSH <span class="variation_price">{{$product->base_price}}</span>/=
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col text-right">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button class="btn btn-success">Add To Cart <i class="bx bxs-cart-add"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-footer">
                                <h4>Description</h4>
                                <p>{{$product->description}}</p>
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
                        <div class="nav nav-tabs" id="nav-tab">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home">Product Details</a>
                            @if(count($related))
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile">Related Products</a>
                            @endif
                            @auth()
                                <a class="nav-item nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review">Product Reviews</a>
                            @endauth
                        </div>
                    </nav>
                    <div class="tab-content shadow" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home">
                            <table class="table table-sm table-dark table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" colspan="2">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Brand</th>
                                    <td>{{$product->brand->name}}</td>
                                </tr>
                                @if(count($product->variations) > 0)
                                    @foreach($product->variations as $variation)
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
                                    <td>{{$product->seller->admin->username}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        @if(count($related))
                            <div class="tab-pane fade" id="nav-profile">
                                <!--    Start Products you may Like    -->

                                <div id="products_like" class="row">
                                    <div class="col">
                                        <div class="row mb-2">
                                            <div id="results" class="col">
                                                @foreach($related as $item)
                                                    <div class="card">
                                                        <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                                            @if(isset($item->main_image) && file_exists(public_path("/images/products/{$item->main_image}")))
                                                                <img src="{{ asset("/images/products/{$item->main_image}") }}" alt="Product image">
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
                                                                    <?php $discountPrice = getDiscountPrice($item->id); ?>
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
                            </div>
                        @endif

                        @auth()
                            <div class="tab-pane fade p-3 bg-light" id="nav-review">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <p class="m-0 pr-2">My rating ~ </p>
                                            <div class="rating" title="Rate this product"
                                                 data-rate-value="{{ $product->reviews->where('user_id', Auth::id())->first()->rating ?? 0 }}"></div>
                                        </div>
                                        <form id="review">
                                            @csrf()
                                            <div class="form-group">
                                                <input id="review" value="{{ old('review') }}" type="hidden" name="review">
                                                <trix-editor input="review" placeholder="write your review..."></trix-editor>
                                            </div>
                                            <div class="form-group text-right">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" placeholder="Write your review">
                                                <button type="submit" class="btn btn-sm btn-outline-red">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Current reviews</h5>
                                        <div class="list-group-flush" style="max-height:13rem; overflow-y: auto">
                                            @forelse($product->reviews as $review)
                                            <a href="#" class="list-group-item list-group-item-action {{ $review->user_id === Auth::id() ? 'active' : ''}}" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>~ {{ $review->user->first_name }}</small>
                                                    <small class="text-light"><i>{{ carbon()::createFromTimestamp(strtotime($review->created_at))->diffForHumans() }}</i></small>
                                                </div>
                                                <p class="mb-1">{!! $review->review !!}</p>
                                                <div class="ratings"
                                                     title="{{ (($review->user_id === Auth::id() ? 'Your' : "{$review->user->first_name}'s") . " rating") . ($review->rating > 4 ? '🌟' : '⭐') }}"
                                                     data-rate-value="{{ $review->rating }}"></div>
                                            </a>
                                            @empty
                                                <li class="list-group-item">No reviews</li>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/rater/rater.min.js') }}"></script>
    <script>
        $(".average-rating").rate({readonly: true});
        $(".ratings").rate({readonly: true});

        $(".rating").rate({
            max_value: 5,
            step_size: 0.5,
            cursor: 'pointer',
        });

        $('.rating').on('change', function () {
            const rating = $(this).rate("getValue");

            if (rating) upsertReview({rating})
        })
    </script>
    @auth()
        <script src="{{ asset('vendor/trix/trix.js') }}"></script>
        <script>
            const trixEditor = $('trix-editor').get(0).editor
            trixEditor.deactivateAttribute("bold")

            addEventListener('trix-change', function (event) {
                localStorage["editorState"] = JSON.stringify(event.target.editor)
            })

            $('#review').on('submit', function (e) {
                e.preventDefault()

                const review = $('trix-editor').val();

                if (review)
                    upsertReview({review})
            })

            const upsertReview = (data) => {
                data.product_id = {{ $product->id }};

                $.ajax({
                    data,
                    type: 'POST',
                    url: '{{ route('review.store') }}',
                    success: (response) => {
                        toast({...response, type: 'success'})

                        if(data.review) $('trix-editor').val('')
                    },
                    error: error => {
                        console.log(error.msg)
                        toast({msg: 'Unable to set rating at this time. ☹', type: 'danger'})
                    }
                })
            }

            const toast = (response) => {
                Toastify({
                    text: response.msg,
                    duration: 7000,
                    close: true,
                    className: response.type,
                }).showToast();
            }

            trixEditor.loadJSON(JSON.parse(localStorage["editorState"]))
        </script>
    @endauth
    <script src="{{ asset('js/share.js') }}"></script>
@endsection
