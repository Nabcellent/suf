<div class="container-fluid p-0">
    @if(tableCount('products') > 0)
        @if(count($products) > 0)
            <div id="results" class="col column">

                @foreach($products as $item)
                    @php $url = url('/product/' . $item->id . '/' . preg_replace("/\s+/", "", $item->title)) @endphp
                    <div class="card">
                        <a href="{{ $url }}">
                            @if(isset($item->image) && file_exists(public_path("/images/products/{$item->image}")))
                                <img src="{{asset("/images/products/{$item->image}")}}" alt="Product image">
                            @else
                                <img src="{{asset('/images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
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
                                    @if($item->discount_price > 0)
                                        <p>{{$item->discount_price}}/=</p><br>
                                        <del class="text-secondary">{{$item->base_price}}/=</del>
                                    @else
                                        <p>{{$item->base_price}}/=</p>
                                    @endif
                                </div>
                                <div class="col button">
                                    <a href="{{ $url }}" class="btn btn-block btn-outline-primary add">
                                        <i class="fas fa-cart-plus"></i> +
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ $url }}" class="product_label {{strtolower($item['label'])}}">
                            <span class="label">{{$item['label']}}</span>
                        </a>
                    </div>
            @endforeach

            </div>
            <div class="row justify-content-center">
                <div class="col text-center">
                    {{ $products->appends(['sort' => 'title_desc'])->links() }}
                </div>
            </div>
        @else
            <div>
                <h4>Sorryyy! No products match this filter😔</h4>
                <hr class="mx-0">
                <img src="{{ asset('images/illustrations/undraw_feeling_blue_4b7q.svg') }}" alt="">
            </div>
        @endif
    @else
        <div>
            <h4>Hey There! Sorry, We aren't selling any products now.</h4>
            <hr class="mx-0">
            <img src="{{ asset('images/illustrations/undraw_feeling_blue_4b7q.svg') }}" alt="">
        </div>
    @endif
</div>
