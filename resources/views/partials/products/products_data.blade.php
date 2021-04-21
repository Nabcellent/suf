
<?php use App\Models\Product; ?>

<div class="container-fluid p-0">
    @if(count($products) > 0)
        <div id="results" class="col column">

            <!--    Start Single ProductSeeder    -->
            @foreach($products as $item)
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
                    <div class="supplier"><a href="#">{{$item['seller']['username']}}</a></div>
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
        <!--    End Single ProductSeeder    -->

        </div>
        <div class="row justify-content-center">
            <div class="col text-center">
                {{ $products->appends(['sort' => 'title_desc'])->links() }}
            </div>
        </div>
    @else
        <div>
            <h4>Sorryyy! No Products for this category😔</h4>
            <hr class="mx-0">
            <img src="{{ asset('images/illustrations/undraw_feeling_blue_4b7q.svg') }}" alt="">
        </div>
    @endif
</div>
