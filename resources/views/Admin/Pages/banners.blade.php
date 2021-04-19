@extends('Admin.layouts.app')
@section('content')

    <div id="banners" class="container-fluid p-0">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><i class="fas fa-cog"></i> Admin Panel</li>
                        <li class="breadcrumb-item active" aria-current="page"> Banners</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row">
            <div class="col-xl-11 col-lg-12">
                <div class="card crud_box shadow">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-slideshare"></i> SU-F Banners</h6>
                        <button type="button" id="btn_add_banner" data-toggle="modal" data-target="#add_banner_modal" class="btn btn-outline-info">
                            Add Banner
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                             @foreach($banners as $banner)
                                <div class="col-xl-3 col-md-6 align-self-center card-body border-info shadow slider_box">
                                <div class="slider_title">
	                                {{ $banner['title'] }}
                                    @if($banner['status'])
                                    <a class="update_banner_status" data-id="{{ $banner['id'] }}" title="Update Status"
                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                    @else
                                    <a class="update_banner_status" data-id="{{ $banner['id'] }}" title="Update Status"
                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                    @endif
                                </div>
                                <div class="slider_img">
                                    <img src="{{ asset('/images/banners/' . $banner['image']) }}" alt="<%= row.alt %>">
                                </div>
                                <div class="slider_action">
                                    <a href="#" class="update_banner" data-toggle="modal" data-target="#update_banner_modal" title="Modify"
                                       data-id="{{ $banner['id'] }}"
                                       data-title="{{ $banner['title'] }}"
                                       data-image="{{ $banner['image'] }}"
                                       data-link="{{ $banner['link'] }}"
                                       data-alt="{{ $banner['alt'] }}"
                                       data-description="{{ $banner['description'] }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" class="delete_banner" title="Remove" data-id="{{ $banner['id'] }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <div class="details">
                                    <strong>Link -</strong> <a href="{{ $banner['link'] }}" target="_blank">{{ $banner['link'] }}</a>
                                    <div>
                                        <strong>Description:</strong>
                                        <p>{{ $banner['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr style="background-color: #900">

    @include('Admin.Pages.modals')
@endsection
