@extends('Admin.layouts.app')
@section('content')

    <div id="add_user" class="container-fluid p-0">

        <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card shadow">
                            <form id="create_admin" action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
                                @if(isset($admin)) @method('PUT') @endif @csrf
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Add {{ $user }}</h4>
                                    <div class="dropdown no-arrow">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Order Options</div>
                                            <a class="dropdown-item" href="{{ route('admin.products') }}">View Products</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">First name</label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                                   placeholder="Enter first name *" value="{{ old('first_name') }}" aria-label required autofocus>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Last name</label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                                   placeholder="Enter last name *" value="{{ old('last_name') }}" aria-label required>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter email address *" value="{{ old('email') }}" aria-label required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        @if($user === "Seller")
                                            <div class="form-group col">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                                       placeholder="Enter username *" value="{{ old('username') }}" aria-label required>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+254</span>
                                            </div>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" aria-label value="{{ old('phone') }}" placeholder="123456789"
                                                   pattern="^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="mb-3 col">
                                            <div class="form-group m-0">
                                                <label>Gender</label>
                                                <div class="custom-control custom-radio custom-control">
                                                    <input type="radio" id="Male" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Male" @if(old('gender')) checked @endif required>
                                                    <label class="custom-control-label" for="Male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control">
                                                    <input type="radio" id="Female" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Female" @if(old('gender')) checked @endif required>
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
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="inputGroupFile01"
                                                           aria-describedby="inputGroupFileAddon01"  accept=".jpg,.png,.jpeg,image/*">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                                </div>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fas fa-plus-circle"></i> Create {{ $user }}
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
                            <a href="{{ route('admin.admins') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.sellers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.customers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
                            </a>
                            <a href="{{ route('admin.user', ['user' => ($user === 'Admin') ? 'Seller' : 'Admin']) }}" class="list-group-item list-group-item-action">
                                Create {{ ($user === 'Admin') ? 'Seller' : 'Admin' }}
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
