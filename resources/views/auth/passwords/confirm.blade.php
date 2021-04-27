@extends('layouts.master')
@section('title', 'Confirm Password')
@section('content')

<div class="container">
    <!--    Start Breadcrumb    -->
    <div class="row pb-lg-5">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Su-F</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Confirm Password</li>
                </ul>
            </nav>
        </div>
    </div>
    <!--    End Breadcrumb    -->

    <div class="row justify-content-center py-md-5 mb-lg-5">
        <div class="col-md-8 py-md-5 mb-lg-5">
            <div class="card px-5 py-4">
                <div class="card-body">
                    <div class="card-header my-3">{{ __('Confirm Password') }}</div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" placeholder="Enter password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="morphic_btn" style="color: #fff; background-color: var(--dark-gold);"
                                        onmouseover="this.style.backgroundColor='#3b5998'"
                                        onmouseout="this.style.backgroundColor='var(--light-gold)'">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="text-center small">{{ __('Please confirm your password before proceeding.') }}</p>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-6 text-center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
