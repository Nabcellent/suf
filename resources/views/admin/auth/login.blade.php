@extends('admin.layouts.app')
@section('title', 'Sign In')
@section('content')

    <div id="login" class="container mt-4">
        <a href="{{ route('home') }}" class="position-absolute" style="left:1rem; top:1rem; color: var(--dark-gold)">Shop</a>
        <div class="row justify-content-center align-items-center" style="height: 75vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <div class="card-header mb-2 bg-white border-0 d-flex flex-row align-items-center">
                            <div class="col text-center">
                                <h5></h5>
                                <h5 class="m-0 font-weight-bold" style="color: #900">Sign In</h5>
                            </div>
                            <div class="text-danger list-group all_errors"></div>
                        </div>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    @if($errors->any())
                                        <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                            <ul class="m-0"><li>{{$errors->first()}}</li></ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="anime_input_field">
                                    <input type="text" id="email" name="email" class="anime_input" required autocomplete="email" autofocus>
                                    <span class="placeholder">Email or Phone number</span>
                                </label>
                            </div>
                            <div class="form-group mb-3">
                                <label class="anime_input_field">
                                    <input type="password" id="password" name="password" class="anime_input" required>
                                    <span class="placeholder">Password</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col d-flex align-items-end">
                                        <a href="{{ route('admin.register') }}" class="card-link float-right">Register</a>
                                    </div>
                                    <div class="col text-end">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">Sign In <i class='bx bx-log-in bx-fade-right-hover'></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
