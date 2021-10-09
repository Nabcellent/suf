@extends('admin.layouts.app')
@section('title', 'Profile')
@section('content')

    <div id="profile" class="container-fluid" style="height: 80vh">
        <div class="row h-100 justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9 my-auto p-0 bg-light rounded shadow">
                <div class="row">
                    @if(Auth::user()->is_admin === 7)
                        <div class="col">
                            <div class="row p-2 position-absolute" style="right:2rem; top:1rem; width: 30%">
                                <div class="col text-end">
                                    <h4>Sir!</h4>
                                    <hr class="me-0 mb-0 col-3">
                                </div>
                            </div>
                            <img src="{{ asset('images/illustrations/undraw_pie_chart_6efe.svg') }}" alt="">
                        </div>
                    @else
                        <div class="col-lg-5 d-none d-lg-block">
                            @if(empty($user->image))
                                <img data-toggle="modal" data-target="#image_modal" src="{{ asset('/images/general/store_logo.jpg') }}"
                                     alt="login image" class="img-fluid"
                                     style="width:100%; height: 100%; object-fit: cover; cursor:pointer;">
                            @else
                                <img data-toggle="modal" data-target="#image_modal" src="{{ asset('/images/users/profile/' . $user->image) }}"
                                     alt="login image" class="img-fluid"
                                     style="width:100%; height: 100%; object-fit: cover; cursor:pointer;">
                            @endif
                        </div>
                        <div class="col-lg-7 p-5 overflow-auto" style="max-height: 35rem">
                            <small class="bg-secondary text-warning py-1 px-2" style="position: absolute; top: 0; left: 0"> {{ $user->admin->type }} </small>
                            <div class="row">
                                <div class="col">
                                    <h4 class="mb-1 text-center">Hello {{ $user->first_name }}!</h4>
                                    <hr class="bg-secondary my-1">
                                    <div class="text-danger list-group all_errors">
                                        <div class="alert alert-danger" style="display:none;">
                                            <ul class="m-0 py-0"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <form id="update_profile" action="{{ route('admin.put_profile') }}">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-6">
                                                <small class="mb-0">First Name</small>
                                                <input type="text" class="form-control border-0" id="first_name" name="first_name"
                                                       value="{{ old('first_name', $user->first_name) }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <small class="mb-0">Last Name</small>
                                                <input type="text" class="form-control border-0" id="last_name" name="last_name"
                                                       value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group col">
                                                <small class="mb-0">Email Address</small>
                                                <input type="email" class="form-control border-0" name="email_address"
                                                       value="{{ $user->email }}" disabled required>
                                            </div>
                                            <div class="form-group col">
                                                <small class="mb-0">Username</small>
                                                <input type="text" class="form-control border-0" name="username" value="{{ $user->admin->username }}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="form-group col">
                                                <small class="mb-0">Gender</small>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">{!! getGenderIcon($user->gender) !!}</span>
                                                    <input type="text" class="form-control" value="{{ $user->gender }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-pen"></i> Update Profile</button>
                                            <img class="loader_gif" id="loader" src="{{ asset('images/loaders/Gear-0.2s-200px.gif') }}"
                                                 alt="loader.gif" width="30">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h5 class="mb-1">Contact(s)</h5>
                                    <hr class="bg-secondary my-1">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="d-flex justify-content-between">
                                        <small>Phone Number(s) *</small>
                                        <a href="#" class="input-group-text border-primary text-info user-phone" title="Add Phone">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                    </div>
                                    @foreach($phones as $phone)
                                        <div class="input-group">
                                            <span class="input-group-text border-0">+254</span>
                                            <input type="tel" class="form-control border-0" name="phone_number" value="{{ $phone->phone }}"
                                                   readonly required>
                                            @if($phone->primary)
                                                <span class="input-group-text border-0">primary</span>
                                            @endif
                                            <a href="#" class="input-group-text border-primary text-info user-phone"
                                               data-id="{{ $phone->id }}">
                                                <i class='bx bx-edit-alt'></i>
                                            </a>
                                            <a href="#" class="input-group-text border-danger text-danger delete-from-table"
                                               data-id="{{ $phone->id }}" data-model="Phone">
                                                <i class='bx bx-trash-alt'></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h5 class="mb-1">Change Password!</h5>
                                    <hr class="bg-secondary my-1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form class="change-password" action="{{ route('change-password') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group mb-3">
                                            <small>Current password *</small>
                                            <input type="password" class="form-control border-0 @error('current_password') is-invalid @enderror"
                                                   name="current_password" placeholder="Enter current password *" required>
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <small>New password *</small>
                                                <input type="password" class="form-control border-0 @error('password') is-invalid @enderror"
                                                       id="password" name="password" placeholder="Enter new password *" required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <small>Confirm New password *</small>
                                                <input type="password"
                                                       class="form-control border-0 @error('password_confirmation') is-invalid @enderror"
                                                       name="password_confirmation" placeholder="Confirm new password *" required>
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-pen"></i> Change Password</button>
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
    <div class="modal fade" id="image_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile-pic') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-small="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="inputGroupFile02" accept="image/*" required>
                                <label class="custom-file-small" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                    Choose an image
                                </label>
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
