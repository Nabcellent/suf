@extends('/layouts.master')
@section('title', 'CheckOut')
@section('content')
    @include('/partials/top_nav')

    <?php use App\Models\Cart; ?>

    <div id="checkout" class="container">

        <!--    Start Breadcrumb    -->
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row justify-content-center pb-4">
            <div class="col-md-11 col-sm-12">
                <div class="text-danger list-group all_errors">
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-1">
                            <ul class="m-0 py-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <form id="checkout-form" action="{{ route('place-order') }}" method="POST" class="col-md-11 col-sm-12">
                @csrf
                <div class="card address">
                    <div class="card-header py-sm-0 pb-1">
                        <h3 class="m-0 text-right">Checkout</h3>
                        <hr class="my-1">
                    </div>
                    <div class="card-body py-2">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="m-0">Delivery Addresses</h5>
                                            @if(count($addresses) > 0)
                                                <a href="{{ route('profile', ['page' => 'delivery-address']) }}" class="btn btn-outline-info" style="border: none; border-bottom: 1px solid;">Add Address</a>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($addresses) > 0)
                                    @foreach($addresses as $address)
                                        <tr>
                                            <td class="pb-1">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text custom">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="address{{ $address['id'] }}" name="address" @if($loop->iteration === 1 || (int)old('address') === $address['id']) checked @endif
                                                                class="custom-control-input @error('address') is-invalid @enderror" value="{{ $address['id'] }}" required>
                                                                <label class="custom-control-label" for="address{{ $address['id'] }}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="form-control text-truncate" for="address{{ $address['id'] }}">
                                                        {{ $address['sub_county']['county']['name'] }}, {{ $address['sub_county']['name'] }}, {{ $address['address'] }}
                                                    </label>
                                                    <div class="input-group-append">
                                                        <a href="{{url('/account/delivery-address/' . $address["id"])}}" class="input-group-text border-primary text-info">
                                                            <i class='bx bx-edit-alt'></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="input-group-text border-danger text-danger delete-address" data-id="{{ $address['id'] }}">
                                                            <i class='bx bx-trash-alt'></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <div>You don't have any delivery addresses at the moment. Care to add one? 🙂... |
                                                <a href="{{ route('profile', ['page' => 'delivery-address']) }}">add</a></div>
                                            <hr class="m-0">
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <div class="row justify-content-end bd-highlight">
                            <div class="col-lg-5 col-md-7 col-sm-9 form-group">
                                <label class="mb-0 p-1">Phone Number</label>
                                <select class="custom-select select2-edit @error('phone') is-invalid @enderror" id="inputGroupSelect01" name="phone" required>
                                    @foreach($phones as $phone)<option value="{{ $phone['phone'] }}">{{ $phone['phone'] }}</option>@endforeach
                                </select>
                            </div>
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card cart">
                    <div class="card-header py-1">
                        <h5 class="m-0">Your Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Sub-Total</th>
                                </tr>
                                </thead>
                                <tbody id="accordion">

                                <?php $totalPrice = 0; ?>
                                @foreach($cart as $item)
                                    <?php
                                    $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
                                    $unitPrice = Cart::getVariationPrice($item['product_id'], $details)['unit_price'];
                                    $discountPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];
                                    $discount = Cart::getVariationPrice($item['product_id'], $details)['discount'];
                                    ?>
                                    <tr data-toggle="collapse" data-target="#cart-item{{ $item['id'] }}" style="cursor: pointer">
                                        <th scope="row">{{$loop -> iteration}}</th>
                                        <td>
                                            <a href="{{url('/product/' . $item['product']['id'] . '/' . preg_replace("/\s+/", "", $item['product']['title']))}}">
                                                {{$item['product']['title']}}
                                            </a>
                                        </td>
                                        <td>{{$item['quantity']}}</td>
                                        <td>KES.{{ $unitPrice  }}/-</td>
                                        <td class="border-left">KES {{ $discountPrice * $item['quantity'] }}/-</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-0">
                                            <div class="ml-3 collapse" data-parent="#accordion" id="cart-item{{ $item['id'] }}">
                                                <table class="table table-sm table-bordered small">
                                                    <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Details</th>
                                                        <th>Discount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><img src="{{'/images/products/' . $item['product']['main_image']}}" alt="Product Image"></td>
                                                        <td>
                                                            @if(count($details) > 0)
                                                                @foreach($details as $key => $value)
                                                                    {{ $key }}: {{ $value }} <br>
                                                                @endforeach
                                                            @else N / A @endif
                                                        </td>
                                                        <td>- {{ $discount * $item['quantity'] }}/-</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $totalPrice += ($discountPrice * $item['quantity'])?>
                                @endforeach

                                </tbody>
                                <tfoot class=" text-info">
                                <tr>
                                    <th colspan="4" class="text-right">Sub Total : </th>
                                    <th colspan="3" class="border-left">KES {{currencyFormat($totalPrice)}}/-</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Coupon Discount : </th>
                                    <th colspan="3" class="border-left">
                                        KES @if(session('couponDiscount')) {{ session('couponDiscount') }} @else 0.0 @endif/-
                                    </th>
                                </tr>
                                <tr class="total">
                                    <th colspan="4" class="text-right">
                                        GRAND TOTAL ({{currencyFormat($totalPrice)}} - @if(session('couponDiscount')) {{ session('couponDiscount') }}) @else 0.0) @endif =
                                    </th>
                                    <th colspan="3" class="border-left">
                                        KES @if(session('grandTotal')) {{ session('grandTotal') }}/= @else {{currencyFormat($totalPrice)}}/= @endif
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card payment">
                    <div class="card-header py-1">
                        <h5 class="m-0">Payment Options</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col">
                                M-pesa
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mpesa-inst" name="payment_method" value="M-Pesa-instant" @if(old('payment_method') === 'M-pesa-instant') checked @endif
                                    class="custom-control-input @error('payment_method') is-invalid @enderror" required>
                                    <label class="custom-control-label" for="mpesa-inst">Instant</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mpesa-ondeliv" name="payment_method" value="M-Pesa-on-delivery" @if(old('payment_method') === 'M-pesa-on-delivery') checked @endif
                                    class="custom-control-input @error('payment_method') is-invalid @enderror" required>
                                    <label class="custom-control-label" for="mpesa-ondeliv">On Delivery</label>
                                </div>
                                <hr>
                            </div>
                            <div class="col border-left border-dark">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="paypal-inst" name="payment_method" value="paypal" @if(old('payment_method') === 'paypal') checked @endif
                                    class="custom-control-input @error('payment_method') is-invalid @enderror" required>
                                    <label class="custom-control-label" for="paypal-inst">PayPal</label>
                                </div>
                                <p class="small">(For PayPal, Click the button below to complete payment)</p>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cash" name="payment_method" value="cash" @if(old('payment_method') === 'cash') checked @endif
                                    class="custom-control-input @error('payment_method') is-invalid @enderror" required>
                                    <label class="custom-control-label" for="cash">Cash On Delivery</label>
                                    @error('payment_method')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        @error('payment_method')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <hr class="bg-success">
                        <div class="row text-center pay-buttons">
                            <div class="col">
                                <img src="{{ asset('images/general/1200px-M-PESA_LOGO-01.svg.png') }}" alt="PayPal" class="img-fluid">
                                <span class="btn btn-block btn-success font-weight-bold" data-toggle="modal" data-target="#pay_phone" style="border-radius: 2.5rem; height: 2.5rem">
                                    <i class="fas fa-hand-holding-usd"></i> Pay Now
                                </span>
                            </div>
                            <div class="col">
                                <img src="{{ asset('images/general/paypal-784404_1280-1.png') }}" alt="PayPal" class="img-fluid">
                                <div id="paypal_payment_button">Coming soon!</div>
                            </div>
                        </div>
                        <hr class="bg-primary">
                        <div class="row place">
                            <div class="col d-flex justify-content-between">
                                <a href="{{ url('/cart') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-circle-left"></i> Back to Cart</a>
                                <button type="submit" class="btn btn-success">Place Order <i class="bx bxs-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                        <input type="tel" name="phone" class="form-control" pattern="^((0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6}))$" autofocus required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--    PayPal Integration    -->
<!--<script src="https://www.paypal.com/sdk/js?client-id=AXDf54IUhnF5DvZ7WmFndgKTxkeBi6LNJbZyZFBQgcD1V4oQQmJ7gVbjt5XZx_8CCirhoCqylaeJHtPq&disable-funding=credit,card"></script>-->

@endsection
