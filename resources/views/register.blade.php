@extends('/layouts.master')
@section('title', 'Register')
@section('content')
    @include('/partials/top_header')

<div id="register">

<!--    Start Content Area    -->

    <div id="content">
        <div class="container registration_page_container">

            <!--    Start Breadcrumb    -->

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <div class="row justify-content-center">

                <!--    Start Contact Section    -->

                <div class="col-md-7 col-sm-12">
                    <!--    Start Box    -->

                    <div class="box bg-light p-2 rounded shadow">

                        <!--    Start Box Header    -->

                        <div class="row">
                            <div class="col">
                                <div class="box_header mt-2">
                                    <h4>Register new account</h4>
                                </div>
                                <hr class="bg-dark mt-0 mb-1">
                            </div>
                        </div>
                        <!--    End Box Header    -->

                        <!--    Start Contact Form    -->

                        <div class="row">
                            <div class="col">
                                <form id="customer_registration_form" class="anime_form" action="/register" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First name *</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last name *</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address *</label>
                                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" aria-label required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label><br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" name="gender" class="custom-control-input" value="M">
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" class="custom-control-input" value="F">
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+254</span>
                                            </div>
                                            <input type="number" class="form-control" name="phone" aria-label
                                                   placeholder="712345678" pattern="((^0[17]+)|(^[17]+)).*" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Create password *</label>
                                            <input type="password" class="form-control" name="password" placeholder="Create password" aria-label required>
                                        </div>
                                        <div class="form-group col">
                                            <label>Confirm password *</label>
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" aria-label required>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="user_type" value="customer">
                                        <button type="submit" class="morphic_btn morphic_btn_primary">
                                            <span><i class="fas fa-user-plus"></i> Sign Up</span>
                                        </button>
                                        <img class="d-none loader_gif" src="images/loaders/Ripple-1s-151px.gif" alt="loader.gif">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--    End Contact Form    -->
                    </div>
                    <!--    End Box    -->

                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-6 text-center">
                            <p class="lead">Already have an account? <a href="/sign-in">Sign In</a>.</p>
                        </div>
                    </div>
                </div>
                <!--    End Contact Section    -->

            </div>
        </div>
    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

@endsection
