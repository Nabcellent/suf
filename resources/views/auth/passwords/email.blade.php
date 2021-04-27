@extends('layouts.master')
@section('title', 'Forgotten Password')
@section('content')

    <div class="login">
        <!--    Start Content Area    -->
        <div id="content">
            <div class="container registration_page_container">

                <!--    Start Breadcrumb    -->
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forgotten Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--    End Breadcrumb    -->

                <!--    Start Contact Section    -->
                <div class="row justify-content-center py-5">
                    <div class="col-md-8 col-sm-12 py-5">

                        <!--    Start Card    -->

                        <div class="card shadow mx-auto" style="max-width:30rem">
                            <div class="card-header">
                                <h4>Forgot your password?</h4>
                                @if(session('status'))
                                    <div class="alert alert-success py-1 px-2 mb-1" role="alert">
                                        <ul class="m-0"><li class="list-group-flush">{{ session('status') }}</li></ul>
                                    </div>
                                @endif
                                <hr class="bg-info m-0">
                            </div>

                            <div class="card-body pb-0 anime_card">
                                <form id="forgot_password" class="anime_form" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <p>Provide us with your email address to reset your password.</p>
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                               placeholder="Enter email address *" value="{{old('email')}}" aria-label required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group text-right">
                                        <p>Remembered your password? <a href="{{url('/login')}}">Sign In</a>!</p>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span>Send Password Reset Link <i class="bx bx-refresh"></i></span>
                                        </button>
                                        <img class="d-none loader_gif" src="{{asset('images/loaders/Ripple-1s-151px.gif')}}" alt="loader.gif">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--    End Card    -->

                        <div class="row mt-4 justify-content-center">
                            <div class="col-md-6 text-center">
                                <p>New to Su-F ? <a href="{{url('/register')}}">Sign Up</a> Already!⚡</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    End Contact Section    -->
            </div>
        </div>
        <!--    End Content Area    -->
    </div>

@endsection
