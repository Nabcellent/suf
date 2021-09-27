@extends('admin.layouts.app')
@section('content')

    <div id="add_user" class="container-fluid p-0">

        <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card shadow">
                            <form id="{{ isset($user) ? 'update_admin' : 'create_admin' }}"
                                  action="{{ isset($user) ? route('admin.user.update', ['title' => $title, 'id' => $user->id]) : route('admin.user.create') }}"
                                  method="POST" enctype="multipart/form-data">
                                @isset($user) @method('PUT') @endif @csrf
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> {{ (isset($user) ? 'Update' : 'Create') . " $title" }}</h4>
                                    <div class="dropdown no-arrow">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Order Options</div>
                                            <a class="dropdown-item" href="{{ route('admin.products') }}">View Products</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group col">
                                            <label for="">First name</label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                                   placeholder="Enter first name *" value="{{ old('first_name', $user->first_name ?? '') }}" aria-label required autofocus>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Last name</label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                                   placeholder="Enter last name *" value="{{ old('last_name', $user->last_name ?? '') }}" aria-label required>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter email address *" value="{{ old('email', $user->email ?? '') }}" aria-label required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label for="">National ID</label>
                                            <input type="number" name="national_id" class="form-control @error('national_id') is-invalid @enderror"
                                                   placeholder="Enter National Id *" value="{{ old('national_id', $user->admin->national_id ?? '') }}" aria-label required>
                                            @error('national_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        @if($title === "Seller")
                                            <div class="form-group col">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                                       placeholder="Enter username *" value="{{ old('username', $user->admin->username ?? '') }}" aria-label required>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    @if(empty($user))
                                        <div class="form-group mb-3">
                                            <label for="">Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">+254</span></div>
                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" aria-label
                                                       value="{{ old('phone', $user->primaryPhone->phone ?? '') }}" placeholder="123456789">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-group m-0">
                                                <label>Gender</label>
                                                <div class="custom-control custom-radio custom-control">
                                                    <input type="radio" id="Male" name="gender"
                                                           class="custom-control-input @error('gender') is-invalid @enderror" value="Male"
                                                           @if(old('gender') || (isset($user) && $user->gender === 'Male')) checked @endif required>
                                                    <label class="custom-control-label" for="Male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control">
                                                    <input type="radio" id="Female" name="gender"
                                                           class="custom-control-input @error('gender') is-invalid @enderror" value="Female"
                                                           @if(old('gender') || (isset($user) && $user->gender === 'Female')) checked @endif required>
                                                    <label class="custom-control-label" for="Female">Female</label>
                                                </div>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label>Profile Picture</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                                       id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"
                                                       accept=".jpg,.png,.jpeg,image/*">
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror

                                            @if(isset($user->image) && file_exists(public_path() . "/images/users/profile/{$user->image}"))
                                            <div>
                                                <img src="{{ asset("/images/users/profile/{$user->image}") }}" style="width:100px; height:100px; object-fit:cover;" alt="">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-plus-circle"></i> {{ (isset($user) ? 'Update' : 'Create') . " $title" }}
                                    </button>
                                    <img class="d-none loader_gif" src="{{ asset('/images/loaders/Gear-0.2s-200px.gif') }}" alt="loader.gif">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.admins') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.sellers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.customers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
                            </a>
                            <a href="{{ route('admin.user.create', ['user' => ($title === 'Admin') ? 'Seller' : 'Admin']) }}"
                               class="list-group-item list-group-item-action">
                                Create {{ ($title === 'Admin') ? 'Seller' : 'Admin' }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    End Insert Card    -->
    </div>

@endsection
