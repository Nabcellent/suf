
<div class="container-fluid p-0">
    <div id="results" class="col column">

        <!--    Start Single ProductSeeder    -->
        @foreach($products as $item)
            <div class="card">
                <a href="/details/{{$item['id']}}">
                    <?php $image_path = 'images/products/' . $item['main_image']; ?>
                    @if(!empty($item['main_image']) && file_exists($image_path))
                        <img src="{{asset($image_path)}}" alt="Product image">
                    @else
                        <img src="{{asset('images/general/on-on-C100919_Image_01.jpeg')}}" alt="Product image">
                    @endif
                </a>
                <div class="supplier"><a href="#">{{$item['username']}}</a></div>
                <div class="card-body">
                    <h6 class="card-title"><a href="">{{$item['title']}}</a></h6>
                    <div class="row">
                        <div class="col prices">
                            @if(strtolower($item['label']) === "new")
                                <p>{{$item['base_price']}}/=</p>
                            @else
                                <p>{{$item['sale_price']}}/=</p><br>
                                <del class="text-secondary">{{$item['base_price']}}/=</del>
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
            {{ $products->links() }}
        </div>
    </div>
</div>
