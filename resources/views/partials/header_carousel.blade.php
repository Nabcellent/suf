
<!--    Start Header Carousel    -->

<div id="header_carousel" class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="carousel slide header_carousel" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">

                    @foreach($banners as $key => $item)
                        @if($loop -> first)
                            <li data-target="#{{$item['link']}}" data-slide-to="{{$key}}" class="active"></li>
                        @else
                            <li data-target="#{{$item['link']}}" data-slide-to="{{$key}}"></li>
                        @endif
                    @endforeach

                </ol>
                <div class="carousel-inner">

                    @foreach($banners as $item)
                        @if($loop -> first)
                            <div class='carousel-item active'>
                                <a href='{{$item['link']}}'>
                                    <img src="{{asset('images/banners/' . $item["image"])}}" class='d-block w-100' alt='{{$item['image']}}'>
                                </a>
                                <div class='carousel-caption d-none d-md-block'>
                                    <span>New Inspiration 2021</span>
                                    <h1>SUITS MADE FOR YOU!</h1>
                                    <p>Trending from our style collection</p>
                                    <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                                </div>
                            </div>
                        @else
                            <div class='carousel-item'>
                                <a href='{{$item['url']}}'>
                                    <img src="{{asset('images/banners/' . $item["image"])}}" class='d-block w-100' alt=''>
                                </a>
                                <div class='carousel-caption d-none d-md-block'>
                                    <span>New Inspiration 2021</span>
                                    <h1>SUITS MADE FOR YOU!</h1>
                                    <p>Trending from our style collection</p>
                                    <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<!--    End Header Carousel    -->
</header>

{{--    End Header Section    --}}
