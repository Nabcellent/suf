@extends('/layouts.master')
@section('title', 'Paypal')
@section('content')
    @include('/partials/top_nav')

    <div id="payment" class="container pb-md-5 px-lg-5">

        <div class="row justify-content-center py-md-5 my-md-5">
            <div class="col-md-9 col-sm-12 mb-md-5">
                <div class="card shadow">
                    <div class="card-header bg-dark" style="color: var(--light-gold)">
                        <h3 class="m-0 text-center">PAYPAL INSTANT PAYMENT</h3>
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
                                        <p><i>KSH {{ session('grandTotal') }}/=</i><br><i>${{ $usd }} USD</i></p>
                                        <input type="hidden" name="amount_payable" value="{{ $usd }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-primary">
                        <div class="row justify-content-end py-2 button">
                            <div class="col-md-6">
                                <p class="m-0 text-center">Click the button below to pay.</p>
                                <div id="paypal_payment_button" style="position: relative; z-index: 1;"></div>
                                <hr>
                                <p class="mb-0 mt-3 text-right">Pay with <a href="{{ route('mpesa') }}">M-PESA</a> instead?</p>
                            </div>
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
