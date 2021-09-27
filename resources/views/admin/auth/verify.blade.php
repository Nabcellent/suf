@extends('admin.layouts.app')
@section('content')
<div class="container">
    <a class="position-absolute" style="right:1rem; top:1rem; color: var(--dark-gold)"
       href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Exit') }}
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="row py-3 justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8 py-md-5 mb-lg-5">
            <div class="card shadow-lg p-5">
                <div class="card-body shadow-sm">
                    <div class="card-header mb-3">{{ __('Verify Your Email Address') }}</div>
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="morphic_btn" style="color: #fff; background-color: var(--first-color);"
                                onmouseover="this.style.backgroundColor='#3b5998'"
                                onmouseout="this.style.backgroundColor='var(--first-color)'">
                            {{ __('click here to request another') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
