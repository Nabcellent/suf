<?php
use App\Models\Cart;use JetBrains\PhpStorm\Pure;

function mapped_implode($glue, $array, $symbol = '='): string
{
    return implode($glue, array_map(
            static function($k, $v) use($symbol) {
                return $k . $symbol . $v;
            },
            array_keys($array),
            array_values($array)
        )
    );
}

#[Pure] function currencyFormat($number): string
{
    return number_format((float)$number, 2);
}
?>

<table class="table table-sm table-striped table-hover table_fixed">
    <thead class="thead-dark">
    <tr class="header">
        <th scope="col">#</th>
        <th scope="col" colspan="2">Product Description</th>
        <th scope="col">Quantity</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Discount</th>
        <th scope="col" colspan="2">Sub-Total</th>
    </tr>
    </thead>
    <tbody>

    <?php $totalPrice = 0; ?>
    @foreach($cart as $item)
        <tr>
            <th scope="row">{{$loop -> iteration}}</th>
            <td><img src="{{'/images/products/' . $item['product']['main_image']}}" alt="Product Image"></td>
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
                @if(count($details) > 0)
                    {{mapped_implode(', ', $details, ': ')}}
                @else
                    -
                @endif
            </td>
            <td class="quantity">
                <div>
                    <input type="number" name="quantity" min="1" value="{{$item['quantity']}}" data-id="{{$item['id']}}" aria-label>
                    <img class="loader" src="{{asset('images/loaders/load.gif')}}" alt="loader.gif">
                </div>
            </td>
            <td>KES {{$unitPrice}}/-</td>
            <td>KES.{{$discount}}/-</td>
            <td class="border-left">KES {{$discountPrice * $item['quantity']}}/-</td>
            <td>
                <a href="#" class="btn btn-outline-danger p-1 border-0 delete_cart_item" data-id="{{$item['id']}}">
                    <i class="fas fa-backspace"></i>
                </a>
            </td>
        </tr>
        <?php $totalPrice += ($discountPrice * $item['quantity'])?>
    @endforeach

    </tbody>
    <tfoot class="bg-dark text-white">
    <tr>
        <th colspan="6" class="text-right">Sub Total : </th>
        <th colspan="3" class="border-left">KES {{currencyFormat($totalPrice)}}/-</th>
    </tr>
    <tr>
        <th colspan="6" class="text-right">Coupon Discount : </th>
        <th colspan="3" class="border-left">KES.0.0/-</th>
    </tr>
    <tr class="total">
        <th colspan="6" class="text-right">GRAND TOTAL ({{currencyFormat($totalPrice)}} - 0.0) = </th>
        <th colspan="3" class="border-left">KES {{currencyFormat($totalPrice)}}/-</th>
    </tr>
    </tfoot>
</table>
