@extends('/layouts.master')
@section('title', 'Thank You')
@section('content')
    @include('/partials/top_nav')

    <div id="checkout" class="container px-lg-5">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thank You {{ Auth::user()->first_name }}@if(Auth::user()->gender === 'Male') ⚡ @else ✨ @endif</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <div class="card col-md-11 col-sm-12">
                <div class="card-header bg-dark" style="color: var(--light-gold)">
                    <h3 class="m-0 text-center">! 🥳 ~ 🥳 ~ 🥳 !</h3>
                    <hr style="background-color: var(--dark-gold)">
                </div>
                <div class="card-body py-2">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            @if(Auth::user()->gender === 'Male')
                                <img src="{{ asset('images/thanks/giphy.gif') }}" alt="Thank You">
                            @else
                                <img src="{{ asset('images/thanks/177891_662ea.gif') }}" alt="Thank You">
                            @endif

                        <!--<img src="{{ asset('images/thanks/undraw_super_thank_you_obwk.svg') }}" alt="Thank You" height="300" width="300">-->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5><i class="fas fa-shipping-fast"></i> Your Order has been placed. 💯</h5>
                            <div class="row">
                                <div class="col-auto">
                                    <p class="m-0">Order Number: </p>
                                    <p>Total payable amount: </p>
                                </div>
                                <div class="col">
                                    <p class="m-0"><i>{{ session('orderId') }}</i></p>
                                    <p><i>KSH {{ session('grandTotal') }}/=</i><br><i>${{ $usd }} USD</i></p>
                                    <input type="hidden" name="amount_payable" value="{{ $usd }}">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p class="m-0 text-center">Click the button below to pay.</p>
                            <div id="paypal_payment_button"></div>
                        </div>
                    </div>
                    <h3 class="text-right position-relative">
                        We shall contact you. @if(Auth::user()->gender === 'Male') 🥂 @else 🥰 @endif
                        <span style="position:absolute; right:0; font-size:.7rem; bottom:-1rem;">We are happy to be of service.</span>
                    </h3>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col d-flex justify-content-between">
                            <a href="{{ url('/products') }}" class="btn btn-success"><i class='bx bx-run bx-flip-horizontal' ></i> Shop some more? 😙</a>
                            <a href="{{ url('/orders') }}" class="btn btn-outline-info">My orders <i class="fab fa-shopify"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Contact Section    -->

        </div>
    </div>

@endsection
<!--    PayPal Integration    -->
<script src="https://www.paypal.com/sdk/js?client-id=AfzK9bEaxQ_TP4LIXl0Pp-akLxoKvaReVchEVlTfiRWdseaa1l1o-iXQ92FlhBla_M73KSLf4Y6NBWOG&disable-funding=credit,card&buyer-country=KE&components=buttons"></script>
