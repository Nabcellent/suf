<table class="table table-sm table-striped table-hover table_fixed">
    <thead class="thead-dark">
    <tr class="header">
        <th scope="col">#</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Unit Price</th>
        <th scope="col" colspan="2">Sub-Total</th>
    </tr>
    </thead>
    <tbody id="accordion">

    <?php $totalPrice = $totalDiscount = 0; ?>
    @foreach($cart as $item)
        <?php $price = getVariationPrice($item->product_id, $item->details); ?>
        <tr>
            <th data-toggle="collapse" data-target="#cart-item{{ $item->id }}" style="cursor: pointer" scope="row">
                {{$loop -> iteration}} <small title="View details"><i class="fas fa-chevron-down text-red"></i></small>
            </th>
            <td>
                <a href="{{url('/product/' . $item->product->id . '/' . preg_replace("/\s+/", "", $item->product->title))}}">
                    {{$item->product->title}}
                </a>
            </td>
            <td class="quantity">
                <div>
                    <input type="number" name="quantity" min="1" value="{{$item->quantity}}" data-id="{{$item->id}}" aria-label>
                    <img class="loader" src="{{asset('images/loaders/load.gif')}}" alt="loader.gif">
                </div>
            </td>
            <td>{{ $price['unit_price'] }}/-</td>
            <td class="sub-total border-left">KES {{$price['discount_price'] * $item->quantity}}/-</td>
            <td>
                <a href="#" class="btn btn-outline-danger p-1 border-0 delete_cart_item" data-id="{{$item->id}}"><i class="fas fa-backspace"></i></a>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="p-0">
                <div class="ml-3 collapse" data-parent="#accordion" id="cart-item{{ $item->id }}">
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
                            <td><img src="{{ asset("/images/products/{$item->product->image}")  }}" alt="Product Image"></td>
                            <td>
                                @if(count($item->details) > 0)
                                    @foreach($item->details as $key => $value)
                                        {{ $key }}: {{ $value }} <br>
                                    @endforeach
                                @else N / A @endif
                            </td>
                            <td class="sub-total-discount">- {{ $price['discount'] * $item->quantity }}/-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        <?php
        $totalPrice += ($price['discount_price'] * $item->quantity);
        $totalDiscount += ($price['discount'] * $item->quantity);
        ?>
    @endforeach

    </tbody>
    <tfoot class="bg-dark text-white">
    <tr>
        <th colspan="4" class="text-right">Product discount :</th>
        <th colspan="3" class="border-left product-discount">
            KES.{{ $totalDiscount }}/-
        </th>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Coupon Discount :</th>
        <th colspan="3" class="border-left">
            KES.@if(session('couponDiscount')) {{ session('couponDiscount') }} @else 0.0 @endif/-
        </th>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Sub Total :</th>
        <th colspan="3" class="border-left">KES {{currencyFormat($totalPrice)}}/-</th>
    </tr>
    <tr class="total">
        <th colspan="4" class="text-right">
            GRAND TOTAL ({{currencyFormat($totalPrice)}} - @if(session('couponDiscount')) {{ session('couponDiscount') }}) @else 0.0) @endif =
        </th>
        <th colspan="3" class="border-left">
            KES
            @if(session('grandTotal')) {{ session('grandTotal') }} @else {{currencyFormat($totalPrice)}} @endif
            /-
        </th>
    </tr>
    </tfoot>
</table>

<script src="{{ asset('js/jquery.nice-number.js') }}"></script>
