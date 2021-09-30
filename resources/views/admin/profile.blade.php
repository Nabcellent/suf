@extends('admin.layouts.app')
@section('content')

    <div id="profile" class="container-fluid" style="height: 80vh">
        <div class="row h-100 justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9 my-auto p-0 bg-light rounded shadow">
                <div class="row">
                    @if(Auth::user()->is_admin === 7)
                        <div class="col">
                            <div class="row p-2 position-absolute" style="right:2rem; top:1rem; width: 30%">
                                <div class="col text-right">
                                    <h4>Sir!</h4>
                                    <hr class="mr-0 mb-0 col-3">
                                </div>
                            </div>
                            <img src="{{ asset('images/illustrations/undraw_pie_chart_6efe.svg') }}" alt="">
                        </div>
                    @else
                        <div class="col-lg-5 d-none d-lg-block">
                            @if(empty($admin['user']['image']))
                                <img data-toggle="modal" data-target="#image_modal" src="{{ asset('/images/general/store_logo.jpg') }}" alt="login image" class="img-fluid"
                                     style="width:100%; height: 100%; object-fit: cover; cursor:pointer;">
                            @else
                                <img data-toggle="modal" data-target="#image_modal" src="{{ asset('/images/users/profile/' . $admin['user']['image']) }}" alt="login image" class="img-fluid"
                                     style="width:100%; height: 100%; object-fit: cover; cursor:pointer;">
                            @endif
                        </div>
                        <div class="col-lg-7 p-5 overflow-auto" style="max-height: 35rem">
                            <label class="bg-secondary text-warning py-1 px-2" style="position: absolute; top: 0; left: 0"> {{ $admin['type'] }} </label>
                            <div class="row">
                                <div class="col">
                                    <h3 class=" text-center">Hello {{ $admin['user']['first_name'] }}!</h3>
                                    <hr class="bg-secondary">
                                    <div class="text-danger list-group all_errors">
                                        <div class="alert alert-danger" style="display:none;">
                                            <ul class="m-0 py-0"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form id="update_profile" action="{{ route('admin.put_profile') }}">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="mb-0" for="first_name">First Name</label>
                                                <input type="text" class="form-control border-0" id="first_name" name="first_name" value="{{ $admin['user']['first_name'] }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="mb-0" for="last_name">Last Name</label>
                                                <input type="text" class="form-control border-0" id="last_name" name="last_name" value="{{ $admin['user']['last_name'] }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label class="mb-0" for="email_address">Email Address</label>
                                                <input type="email" class="form-control border-0" name="email_address" value="{{ $admin['user']['email'] }}" disabled required>
                                            </div>
                                            <div class="form-group col">
                                                <label class="mb-0" for="email_address">Username</label>
                                                <input type="text" class="form-control border-0" name="username" value="{{ $admin['username'] }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label class="mb-0" for="email_address">National ID</label>
                                                <input type="email" class="form-control border-0" name="national_id" value="{{ $admin['national_id'] }}" disabled required>
                                            </div>
                                            <div class="form-group col">
                                                <label class="mb-0">Gender</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text"><?= getGenderIcon($admin['user']['gender']) ?></span></div>
                                                    <input type="text" class="form-control" value="{{ $admin['user']['gender'] }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-pen"></i> Update Profile</button>
                                            <img class="loader_gif" id="loader" src="{{ asset('images/loaders/Gear-0.2s-200px.gif') }}" alt="loader.gif" width="30">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h4>Contact</h4>
                                    <hr class="bg-secondary">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex justify-content-between">
                                        <span>Phone Number(s) *</span>
                                        <a href="#" class="input-group-text border-primary text-info user-phone" title="Add Phone">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                    </div>
                                    @foreach($phones as $phone)
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text border-0">+254</span></div>
                                                <input type="tel" class="form-control border-0" name="phone_number" value="{{ $phone['phone'] }}" readonly required>
                                                <div class="input-group-append">
                                                    @if($phone['primary'])
                                                        <span class="input-group-text border-0">primary</span>
                                                    @endif
                                                    <a href="#" class="input-group-text border-primary text-info user-phone" data-id="{{ $phone['id'] }}">
                                                        <i class='bx bx-edit-alt'></i>
                                                    </a>
                                                    <a href="#" class="input-group-text border-danger text-danger delete-from-table" data-id="{{ $phone['id'] }}" data-model="Phone">
                                                        <i class='bx bx-trash-alt'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h4>Change Password!</h4>
                                    <hr class="bg-secondary">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form class="change-password" action="{{ route('change-password') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="current_password">Current password *</label>
                                            <input type="password" class="form-control border-0 @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter current password *" required>
                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="password">New password *</label>
                                                <input type="password" class="form-control border-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password *" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="password_confirmation">Confirm New password *</label>
                                                <input type="password" class="form-control border-0 @error('password_confirmation') is-invalid @enderror"
                                                       name="password_confirmation" placeholder="Confirm new password *" required>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-pen"></i> Change Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="image_modal"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile-pic') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="inputGroupFile02" accept="image/*" required>
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose an image</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
