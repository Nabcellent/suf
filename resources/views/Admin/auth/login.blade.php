
@extends('Admin.layouts.app')
@section('content')

    <div id="login" class="container mt-4">
        <div class="row justify-content-center align-items-center" style="height: 75vh;">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
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
                            <div class="form-group">
                                <label class="anime_input_field">
                                    <input type="text" id="email" name="email" class="anime_input" required autocomplete="email" autofocus>
                                    <span class="placeholder">Email or Phone number</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="anime_input_field">
                                    <input type="password" id="password" name="password" class="anime_input" required>
                                    <span class="placeholder">Password</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col d-flex align-items-end">
                                        <a href="/auth/register" class="card-link float-right">Register</a>
                                    </div>
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary">Sign In <i class='bx bx-log-in bx-fade-right-hover'></i></button>
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
