@extends('admin.layouts.app')
@section('title', 'Sign Up')
@section('content')

    <div id="register" class="container mt-4">
        <section class="container">
            <a href="{{ route('home') }}" class="position-absolute" style="left:1rem; top:1rem; color: var(--dark-gold)">Shop</a>
            <div class="row py-3 justify-content-center align-items-center" style="height: 75vh;">
                <div class="col-md-7 p-0">
                    <div class="card anime_card">
                        <div class="card-body shadow-lg">
                            <div class="card-header bg-white border-0 pb-1">
                                <div class="col text-center">
                                    <h5 class="m-0 font-weight-bold" style="color: #900"><i class="fas fa-tags"></i> Register</h5>
                                </div>
                                <div class="text-danger list-group all_errors">
                                    @if ($errors->any())
                                        <div class="alert alert-danger py-2 m-0">
                                            <ul class="m-0 py-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form id="register_seller" action{{ route('admin.register') }} method="POST">
                                @csrf
                                <div class="row mb-2">
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="text" name="first_name" class="anime_input" value="{{ old('first_name') }}" required autofocus>
                                            <span class="placeholder">First name</span>
                                        </label>
                                    </div>
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="text" name="last_name"  class="anime_input" value="{{ old('last_name') }}" required>
                                            <span class="placeholder">Last name</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="anime_input_field">
                                        <input type="email" id="email" name="email"  class="anime_input" value="{{ old('email') }}" required>
                                        <span class="placeholder">Email address</span>
                                    </label>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col d-flex align-items-center mb-0">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" name="gender" class="custom-control-input" @if(old('gender')) checked @endif value="Male">
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" class="custom-control-input" @if(old('gender')) checked @endif value="Female">
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="text" name="username"  class="anime_input" value="{{ old('username') }}" required>
                                            <span class="placeholder">Username</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="tel" id="phone" name="phone"  class="anime_input" value="{{ old('phone') }}"
                                                   pattern="^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$" required>
                                            <span class="placeholder">Phone number</span>
                                        </label>
                                    </div>
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="number" id="national_id" name="national_id"  class="anime_input" value="{{ old('national_id') }}" required>
                                            <span class="placeholder">National ID</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="password" id="password" name="password"  class="anime_input" required>
                                            <span class="placeholder">Create password</span>
                                        </label>
                                    </div>
                                    <div class="form-group col">
                                        <label class="anime_input_field">
                                            <input type="password" id="password_confirmation" name="password_confirmation"  class="anime_input" required>
                                            <span class="placeholder">Confirm password</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <a href="{{ route('admin.login') }}" class="card-link">Sign In</a>
                                            <button type="submit" class="morphic_btn morphic_btn_primary">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="alert-danger d-flex justify-content-center err_message"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
