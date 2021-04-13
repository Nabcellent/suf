@extends('/layouts.master')
@section('title', 'CheckOut')
@section('content')
    @include('/partials/top_nav')

    <?php
    use App\Models\Cart;

    ?>

    <div id="checkout" class="container">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <form class="col-md-11 col-sm-12">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="m-0 text-right">Checkout</h3>
                        <hr class="mt-0">
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="m-0">Delivery Addresses</h5>
                                        <a href="{{ url('/account/delivery-address') }}" class="btn btn-outline-info" style="border: none; border-bottom: 1px solid;">Add Address</a>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text custom">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="address{{ $address['id'] }}" name="address" class="custom-control-input" value="{{ $address['id'] }}">
                                                        <label class="custom-control-label" for="address{{ $address['id'] }}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="form-control">{{ $address['sub_county']['county']['name'] }}, {{ $address['sub_county']['name'] }}, {{ $address['address'] }}</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header py-1">
                        <h5 class="m-0">Your Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" colspan="2">Product Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col" colspan="2">Sub-Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cart as $item)
                                    <tr>
                                        <th scope="row">{{$loop -> iteration}}</th>
                                        <td>
                                            <a href="{{url('/product/' . $item['product']['id'] . '/' . preg_replace("/\s+/", "", $item['product']['title']))}}">
                                                {{$item['product']['title']}}
                                            </a><br>
                                            <?php
                                            $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
                                            $unitPrice = Cart::getVariationPrice($item['product_id'], $details)['unit_price'];
                                            $discountPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];
                                            $discount = Cart::getVariationPrice($item['product_id'], $details)['discount'];
                                            ?>
                                        </td>
                                        <td>
                                            @if(count($details) > 0) {{mapped_implode(', ', $details, ": ")}} @else - @endif
                                        </td>
                                        <td>{{$item['quantity']}}</td>
                                        <td>KES.{{$unitPrice}}/-</td>
                                        <td>KES.{{$discount}}/-</td>
                                        <td class="border-left">KES {{$discountPrice * $item['quantity']}}/-</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot class=" text-info">
                                <tr>
                                    <th colspan="6" class="text-right">Sub Total : </th>
                                    <th colspan="3" class="border-left">KES 0.00/-</th>
                                </tr>
                                <tr>
                                    <th colspan="6" class="text-right">Coupon Discount : </th>
                                    <th colspan="3" class="border-left">
                                        KES @if(session('couponAmount')) {{ session('couponAmount') }} @else 0.0 @endif/-
                                    </th>
                                </tr>
                                <tr class="total">
                                    <th colspan="6" class="text-right">
                                        GRAND TOTAL (700.00 - @if(session('couponAmount')) {{ session('couponAmount') }}) @else 0.0) @endif =
                                    </th>
                                    <th colspan="3" class="border-left">
                                        KES @if(session('grandTotal')) {{ session('grandTotal') }}/= @else {{ 700.00 }}/= @endif
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header py-1">
                        <h4 class="m-0">Payment Options</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <img src="{{ asset('images/general/1200px-M-PESA_LOGO-01.svg.png') }}" alt="PayPal" class="img-fluid" style="width: 10rem; height: 5rem; object-fit: cover">
                                <button class="btn btn-block btn-success" style="border-radius: 2.5rem; height: 2.7rem">
                                    <a href="#" class="text-white" style="text-decoration: none;">
                                        <h4 class="font-weight-bold"><i class="fas fa-hand-holding-usd"></i> Offline Payment</h4>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <img src="{{ asset('images/general/paypal-784404_1280-1.png') }}" alt="PayPal" class="img-fluid" style="width: 10rem; height: 5rem; object-fit: cover">
                                <div id="paypal_payment_button"></div>
                            </div>
                        </div>
                        <hr class="bg-primary">
                        <div class="row">
                            <div class="col d-flex justify-content-between">
                                <a href="{{ url('/cart') }}" class="btn btn-outline-success"><i class="fa fa-arrow-circle-left"></i> Back to Cart</a>
                                <a class="btn btn-dark">Place Order <i class="bx bxs-send"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--    End Contact Section    -->

        </div>
    </div>

<!--    PayPal Integration    -->
<script src="https://www.paypal.com/sdk/js?client-id=AXDf54IUhnF5DvZ7WmFndgKTxkeBi6LNJbZyZFBQgcD1V4oQQmJ7gVbjt5XZx_8CCirhoCqylaeJHtPq&disable-funding=credit,card"></script>

@endsection
