@extends('/layouts.master')
@section('title', 'Info')
@section('content')
    @include('/partials/top_nav')

    <!--    Start Sticky Header Jumbotron    -->
    <div id="back_to_top"></div>

    <div id="info">
        <div id="content">
            <div class="container">
                <div class="row pb-3">

                    <!--    Start Tab Content    -->

                    <div class="col">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($cms as $page)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($loop->iteration === 1) active @endif" id="home-tab" data-toggle="tab" href="#{{ $page->url }}"
                                       role="tab" aria-controls="home" aria-selected="true">{{ $page->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach($cms as $page)
                                <div class="tab-pane fade @if($loop->iteration === 1) show active @endif" id="{{ $page->url }}" role="tabpanel"
                                     aria-labelledby="home-tab">{!! $page->description !!}
                                </div>
                            @endforeach
                        </div>
                        <a href="#back_to_top" class="btn btn-outline-light float-right rounded-circle">
                            <h4><i class="fas fa-arrow-alt-circle-up"></i></h4>
                        </a>
                    </div>
                    <!--    End Tab Content    -->

                </div>
            </div>
        </div>
    </div>

@endsection
