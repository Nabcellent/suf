@extends('/layouts.master')
@section('title', 'Sign In')
@section('content')

<div class="login">

<!--    Start Content Area    -->

    <div id="content">
        <div class="container registration_page_container">

            <!--    Start Contact Section    -->

            <div class="row justify-content-center">
                <div class="col-md-11 col-sm-12">

                    <!--    Start Card    -->

                    <div class="card shadow mx-auto mt-5" style="max-width:30rem">
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
                            <form id="sign_in_form" class="anime_form" action="/sign-in" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email or Phone number *" aria-label required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password *" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me[]">
                                            <label class="custom-control-label" for="remember_me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col text-right">
                                        <a href="">Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="morphic_btn morphic_btn_primary">
                                        <span>Sign In <i class="fas fa-sign-in-alt"></i></span>
                                    </button>
                                    <img class="d-none loader_gif" src="images/loaders/Ripple-1s-151px.gif" alt="loader.gif">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--    End Card    -->

                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-6 text-center">
                            <p class="lead">New to Su-F ? <a href="/register">Sign Up</a> Already!</p>
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

