@extends('layouts.master')
@section('title', 'Sign In')
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
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--    End Breadcrumb    -->

                <!--    Start Contact Section    -->

                <div class="row justify-content-center align-items-center" style="height: 70vh; margin-bottom: 10rem">
                    <div class="col-md-11 col-sm-12">

                        <!--    Start Card    -->

                        <div class="card shadow mx-auto mt-md-5" style="max-width:30rem">
                            <div class="card-header">
                                <h4>Sign In</h4>
                                @if($errors->any())
                                    <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                        <ul class="m-0"><li>{{$errors->first()}}</li></ul>
                                    </div>
                                @endif
                                <hr class="bg-info m-0">
                            </div>

                            <div class="card-body pb-0 anime_card">
                                <form id="login_form" class="anime_form" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                               placeholder="Email address *" aria-label required autocomplete="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('email') is-invalid @enderror"
                                               name="password" placeholder="Password *" aria-label required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember_me[]"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="form-group col text-right">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span>Sign In <i class="fas fa-sign-in-alt"></i></span>
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
