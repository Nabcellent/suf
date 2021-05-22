@extends('/layouts.master')
@section('title', 'Mpesa')
@section('content')
    @include('/partials/top_nav')

    <div id="mpesa-preloader" class="d-none">
        <div class="row justify-content-center pt-5 mt-5">
            <div class="col-9 col-md-6">
                <div class="card p-5">
                    <div class="text-center py-3 my-3">Check your mobile phone.</div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="three-loaders"></div>
    </div>

    <div id="checkout" class="container px-lg-5">

        <!--    Start Breadcrumb    -->

        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
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
            <div class="card col-md-9 col-sm-12">
                <div class="card-header bg-dark" style="color: var(--light-gold)">
                    <h3 class="m-0 text-center">! 🥳 ~ 🥳 ~ 🥳 !</h3>
                    <hr style="background-color: var(--dark-gold)">
                </div>
                <div class="card-body py-2">
                    <hr>
                    <div class="row py-2">
                        <div class="col-6">
                            <h5><i class="fas fa-shipping-fast"></i> Your Order has been placed. 💯</h5>
                            <div class="row">
                                <div class="col-auto">
                                    <p class="m-0">Order Number: </p>
                                    <p>Total payable amount: </p>
                                </div>
                                <div class="col">
                                    <p class="m-0"><i>{{ session('orderId') }}</i></p>
                                    <p><i>KSH {{ session('grandTotal') }}/=</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end py-2">
                        <div class="col-6">
                            <p class="m-0 text-center">Click the button below to pay.</p>
                            <span class="btn btn-block btn-success font-weight-bold" data-toggle="modal" data-target="#pay_phone" style="border-radius: 2.5rem; height: 2.5rem">
                                <i class="fas fa-hand-holding-usd"></i> Pay Now
                            </span>
                        </div>
                    </div>
                    <div class="pt-2">
                        <h3 class="text-right position-relative">
                            We shall contact you. @if(Auth::user()->gender === 'Male') 🥂 @else 🥰 @endif
                            <span style="position:absolute; right:0; font-size:.7rem; bottom:-1rem;">We are happy to be of service.</span>
                        </h3>
                    </div>
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

    <div class="modal fade" id="pay_phone" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="mpesa_stk" class="anime_form" action="{{ route('mpesa.stk.request') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Phone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Phone number to make payment.</label>
                        <input type="tel" name="phone" class="form-control" placeholder="254712345678" autofocus required
                               pattern="^((0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6}))$">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Proceed</button>
                        <img src="{{ asset('images/loaders/Ripple-1s-151px.gif') }}" alt="" width="40" height="40" class="gif-loader">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
