<div class="row">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="col-12">
        <div class="row justify-content-between">
            <div class="col-auto px-0">
                <input class="form-control p-2 w-100" type="text" placeholder="Search products..." wire:model="term"/>
            </div>
            <div class="col-auto px-0 mb-2">
                <form method="get">
                    <div class="input-group">
                        <select class="custom-select" name="sort" id="sort_by">
                            <option selected hidden value="">Sort By...</option>
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                            <option value="title_asc">Title Asc</option>
                            <option value="title_desc">Title Desc</option>
                            <option value="price_asc">Price Asc</option>
                            <option value="price_desc">Price Desc</option>
                        </select>
                        <select class="custom-select" id="per_page" style="min-width:10rem;">
                            <option selected hidden value="10">Per page...(10)</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div wire:loading>
            <div class="text-center">
                <h4>Searching products...</h4>
                <hr class="mx-0">
                <img src="{{ asset('images/illustrations/undraw_Search_re_x5gq.svg') }}" alt="">
            </div>
        </div>
        <div wire:loading.remove>
            <!-- notice that $term is available as a public variable, even though it's not part of the data array -->
            <div id="product_section" class="row mb-2">
                <div class="container-fluid p-0">
                    <div id="results" class="col column">
                        @forelse($products as $item)
                            <div class="card">
                                <a href="{{url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title))}}">
                                    @if(isset($item->main_image))
                                        <?php $image_path = 'images/products/' . $item->main_image; ?>
                                    @else
                                        <?php $image_path = ''; ?>
                                    @endif
                                    @if(!empty($item->main_image) && file_exists($image_path))
                                        <img src="{{asset($image_path)}}" alt="Product image">
                                    @else
                                        <img src="{{asset('images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                                    @endif
                                </a>
                                <div class="supplier"><a href="#">{{$item->seller->username}}</a></div>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="">{{$item->title}}</a></h6>
                                    <div class="d-flex justify-content-center">
                                        <hr class="col-7 m-0">
                                    </div>
                                    <p class="m-0 text-center text-secondary brand-name">{{$item->brand->name}}</p>
                                    <div class="row">
                                        <div class="col prices">
                                            <?php $discountPrice = getDiscountPrice($item['id']); ?>
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
                        @empty
                            <div>
                                <h4>Sorryyy! No products found matching this category😔</h4>
                                <hr class="mx-0">
                                <img src="{{ asset('images/illustrations/undraw_feeling_blue_4b7q.svg') }}" alt="">
                            </div>
                        @endforelse
                    </div>
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            {{ $products->appends(['sort' => 'title_desc'])->links() }}
                        </div>
                    </div>
                </div>
                {{--@include('partials.products.products_data')--}}
            </div>
        </div>
    </div>
</div>
