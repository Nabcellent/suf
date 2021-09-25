@extends('/layouts.master')
@section('title', 'Mpesa')
@section('content')
    @include('/partials/top_nav')

    @if(session('stk'))
        <div id="mpesa-preloader">
            <div class="row justify-content-center pt-5 mt-5">
                <div class="col-9 col-md-6">
                    <div class="card p-md-5 p-2">
                        <h5 class="text-center font-weight-bold py-md-2 my-md-2 py-1 my-1">
                            Kindly check your phone and ENTER YOUR MPESA PIN when prompted. then click done.
                        </h5>
                        <span class="text-center text-dark my-2 countDown" style="font-weight: 700">30</span>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button class="btn btn-outline-light" onclick="cancelPayment()">Cancel</button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-light done" onclick="queryStk()">
                                    Done!
                                    <img src="{{ asset('images/loaders/load.gif') }}" style="display: none" width="20px" alt="">
                                </button>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <hr class="col-6 mt-5">
                </div>
            </div>
            <input type="hidden" name="checkout_id" value="{{ session('stk')['checkout_request_id'] }}">
            <div class="d-none d-md-block three-loaders"></div>
            <div class="d-md-none pulse"></div>
        </div>
    @endisset

    <div id="payment" class="container pb-md-5 px-lg-5">
        <div class="row justify-content-center py-md-5 my-md-5">
            <div class="col-md-9 col-sm-12 mb-md-5">
                <div class="card shadow">
                    <div class="card-header bg-dark" style="color: var(--light-gold)">
                        <h3 class="m-0 text-center">MPESA INSTANT PAYMENT</h3>
                        <hr style="background-color: var(--dark-gold)">
                    </div>
                    <div class="card-body py-2">
                        <hr>
                        <div class="row py-2">
                            <div class="col-md-6">
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
                        <hr class="bg-primary">
                        <div class="row justify-content-end py-2 button">
                            <div class="col-md-6">
                                <p class="m-0 text-center">Click the button below to pay.</p>
                                <span class="btn btn-block btn-success font-weight-bold" data-toggle="modal" data-target="#pay_phone" style="border-radius: 2.5rem; height: 2.5rem">
                                    <i class="fas fa-hand-holding-usd"></i> Pay Now
                                </span>
                                <hr>
                                <p class="mb-0 mt-3 text-right">Pay with <a href="{{ route('paypal') }}">PAYPAL</a> instead?</p>
                            </div>
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
                    @csrf
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

    @once
        @push('scripts')
            <script src="{{ asset('js/payment.js') }}"></script>
        @endpush
    @endonce

@endsection
