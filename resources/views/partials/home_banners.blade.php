
<div id="header_carousel" class="container-fluid @if(count($banners) < 1) d-none @endif">
    <div class="row">
        <div class="col">
            <div id="carousel_indicators" class="carousel slide header_carousel" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">

                    @foreach($banners['sliders'] as $key => $item)
                        <li data-target="#carousel_indicators" data-slide-to="{{$key}}" @if($loop -> first) class="active" @endif></li>
                    @endforeach

                </ol>
                <div class="carousel-inner">

                    @foreach($banners['sliders'] as $banner)
                        <div class="carousel-item @if($loop -> first) active @endif">
                            <a @if(!empty($banner['link'])) href="{{url($banner['link'])}}" @else href="javascript:void(0)" @endif>
                                <img src="{{asset('/images/banners/' . $banner["image"])}}" class='d-block w-100' alt="{{$banner['alt']}}" title="{{$banner['title']}}">
                            </a>
                            <div class='carousel-caption d-none d-md-block'>
                                <span>New Inspiration 2021</span>
                                <h1>{{$banner['title']}}</h1>
                                <p>{{$banner['description']}}</p>
                                <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<!--    End Header Carousel    -->
</header>

{{--    End Header Section    --}}
