@extends('layouts.master')
@section('title', 'Register')
@section('content')

    <div id="register">
        <!--    Start Content Area    -->

        <div id="content">
            <div class="container registration_page_container">

                <!--    Start Breadcrumb    -->
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--    End Breadcrumb    -->

                <div class="row justify-content-center align-items-center" style="height: 70vh; margin-bottom: 10rem">

                    <!--    Start Registration Section    -->
                    <div class="col-md-11 col-sm-12">
                        <div class="card shadow mx-auto mt-md-5" style="max-width:40rem">
                            <div class="card-header">
                                <h4>Register</h4>

                                    @if ($errors->any())
                                        <div class="alert alert-danger py-1 mb-1">
                                            <ul class="m-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                <hr class="bg-info m-0">
                            </div>
                            <div class="card-body pb-0 anime_card">
                                <form id="register_form" class="anime_form" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First name *</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name" placeholder="First name" value="{{ old('first_name') }}" aria-label required autofocus>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last name *</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" placeholder="Last name" value="{{ old('last_name') }}" aria-label required>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address *</label>
                                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" aria-label required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group m-0">
                                            <label>Gender *</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="male" name="gender" class="custom-control-input"
                                                       value="Male" @if(old('gender')) checked @endif required>
                                                <label class="custom-control-label" for="male">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="female" name="gender" class="custom-control-input"
                                                       value="Female" @if(old('gender')) checked @endif required>
                                                <label class="custom-control-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+254</span>
                                            </div>
                                            <input type="tel" class="form-control" name="phone" aria-label value="{{ old('phone') }}" placeholder="123456789" required
                                                   pattern="^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Create password *</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Create password" aria-label required>
                                        </div>
                                        <div class="form-group col">
                                            <label>Confirm password *</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" aria-label required>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span><i class="fas fa-user-plus"></i> Sign Up</span>
                                        </button>
                                        <img class="d-none loader_gif" src="{{asset('images/loaders/Ripple-1s-151px.gif')}}" alt="loader.gif">
                                    </div>
                                </form>
                            </div>
                            <!--    End Contact Form    -->
                        </div>
                        <!--    End Box    -->

                        <div class="row mt-4 justify-content-center">
                            <div class="col text-center">
                                <p>Already have an account? <a href="{{url('/login')}}">Sign In</a>.</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!--    End Contact Section    -->
                </div>
            </div>
        </div>
        <!--    End Content Area    -->
    </div>
@endsection
