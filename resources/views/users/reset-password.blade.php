@extends('/layouts.master')
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
                                <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--    End Breadcrumb    -->

                <!--    Start Contact Section    -->
                <div class="row justify-content-center py-5">
                    <div class="col-md-11 col-sm-12 mb-5 pb-5">

                        <!--    Start Card    -->

                        <div class="card shadow mx-auto" style="max-width:30rem">
                            <div class="card-header">
                                <h4>Reset your password</h4>
                                @if(session()->has('status'))
                                    <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                        <ul class="m-0"><li class="list-group-flush">{{ session()->get('status') }}</li></ul>
                                    </div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger py-1 px-2 mb-1" role="alert">
                                        <ul class="m-0"><li>{{$errors->first()}}</li></ul>
                                    </div>
                                @endif
                                <hr class="bg-info m-0">
                            </div>

                            <div class="card-body pb-0 anime_card">
                                <form id="forgot_password" class="anime_form" action="{{url('/reset-password')}}" method="POST">
                                    @csrf
                                    <p>You may now reset your password here 😌</p>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter email address *"
                                               value="{{old('email')}}" aria-label required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Enter new password *"
                                               aria-label required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password *"
                                               aria-label required>
                                    </div>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="token" value="{{$token}}">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span>Reset Password <i class="bx bx-refresh"></i></span>
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
    <!--    End Sticky Header Jumbotron    -->

@endsection
