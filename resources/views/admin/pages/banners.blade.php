@extends('admin.layouts.app')
@section('content')

    <div id="banners" class="container-fluid p-0">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col">
                <div class="text-danger list-group all_errors">
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="m-0 py-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row">
            <div class="col">
                <div class="card crud_box shadow">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-slideshare"></i> SU-F Banners</h6>
                        <button type="button" data-toggle="modal" data-target="#create_slider" data-modal-title="Slider" class="btn btn-outline-info btn_add_banner">
                            Add Slider
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                             @foreach($banners as $banner)
                                <div class="col-xl-3 col-md-6 align-self-center card-body border-info shadow slider_box">
                                <div class="slider_title">
	                                {{ $banner['title'] }}
                                    <h5>
                                        @if($banner['status'])
                                        <a class="update_status" data-id="{{ $banner['id'] }}" data-model="Banner" title="Update Status"
                                           style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                        @else
                                        <a class="update_status" data-id="{{ $banner['id'] }}" data-model="Banner" title="Update Status"
                                           style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                        @endif
                                    </h5>
                                </div>
                                <div class="slider_img">
                                    <img src="{{ asset('/images/banners/' . $banner['image']) }}" alt="{{ $banner['alt'] }}">
                                </div>
                                <div class="slider_action">
                                    <a href="#" class="update_banner" data-toggle="modal" data-target="#create_slider" title="Modify"
                                       data-id="{{ $banner['id'] }}"
                                       data-title="{{ $banner['title'] }}"
                                       data-image="{{ $banner['image'] }}"
                                       data-link="{{ $banner['link'] }}"
                                       data-alt="{{ $banner['alt'] }}"
                                       data-description="{{ $banner['description'] }}" data-modal-title="Slider">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" class="delete-from-table" title="Remove" data-id="{{ $banner['id'] }}" data-model="Banner">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <div class="details">
                                    <strong>Link -</strong> <a href="{{ $banner['link'] }}" target="_blank">{{ $banner['link'] }}</a>
                                    <hr class="m-0">
                                    <div>
                                        <strong>Description:</strong>
                                        <p class="m-0">{{ $banner['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="background-color: #900">

        <div class="row">
            <div class="col">
                <div class="card crud_box shadow">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: orange"><i class="fas fa-boxes"></i> SU-F Boxes Section</h6>
                        <button type="button" id="btn_add_box" data-toggle="modal" data-target="#create_ad_box" data-modal-title="Box Section" class="btn btn-outline-info btn_add_banner">
                            Add Box
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            @foreach($ads as $ad)
                                <div class="col-lg col-md-6 col-sm-12 card border-0 box shadow-sm">
                                    <div class="card-header">
                                        <i class="fas fa-box fa-2x text-gray-300"></i> Box {{ $loop->iteration }}: {{ $ad['title'] }}
                                        <div class="action">
                                            <h5>
                                                @if($ad['status'])
                                                    <a class="update_status" data-id="{{ $ad['id'] }}" data-model="Banner" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                @else
                                                    <a class="update_status" data-id="{{ $ad['id'] }}" data-model="Banner" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                @endif
                                            </h5>
                                            <a href="#" class="update_banner" data-toggle="modal" data-target="#create_ad_box" title="Modify"
                                               data-id="{{ $ad['id'] }}"
                                               data-title="{{ $ad['title'] }}"
                                               data-image="{{ $ad['image'] }}"
                                               data-link="{{ $ad['link'] }}"
                                               data-alt="{{ $ad['alt'] }}"
                                               data-description="{{ $ad['description'] }}" data-modal-title="Advert">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="#" class="delete-from-table" title="Remove" data-id="{{ $ad['id'] }}" data-model="Banner">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="box_url">{{ $ad['link'] }}</div>
                                        <div class="box_img">
                                            <img src="{{ asset('/images/banners/' . $ad['image']) }}" alt="Image">
                                        </div>
                                        <div class="box_desc">{{ $ad['description'] }}</div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.pages.modals')
@endsection
