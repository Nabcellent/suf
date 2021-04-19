@extends('Admin.layouts.app')
@section('content')

    <div id="boxes">
        <div class="row">
            <div class="col-xl-11 col-lg-12">
                <div class="card crud_box shadow">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: orange"><i class="fas fa-boxes"></i> SU-F Boxes Section</h6>
                        <button type="button" id="btn_add_box" data-toggle="modal" data-target="#crud_modal" class="btn btn-outline-info">
                            Add Box
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            @foreach($ads as $ad)
                            <div class="col-xl-4 col-md-6 card border-0 box shadow-sm">
                                <div class="card-header">
                                    <i class="fas fa-box fa-2x text-gray-300"></i> Box {{ $ad['number'] }}: {{ $ad['title'] }}
                                    <div class="action">
                                        <a href="#"><i class="fas fa-pen"></i></a>
                                        <a href="#"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="box_url">{{ $ad['url'] }}</div>
                                    <div class="box_img">
                                        <img src="{{ asset('/images/box_section/' . $ad['image']) }}" alt="Image">
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
    <hr style="background-color: #900">

    @include('Admin.Pages.modals')
@endsection
