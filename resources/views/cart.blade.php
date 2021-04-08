@extends('/layouts.master')
@section('title', 'Cart')
@section('content')
    @include('/partials/top_nav')

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
        return number_format((float)$number, 2, '.', ',');
    }
    ?>

<div id="cart">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container-fluid cart_page_container">
            <div class="row">

                <!--    Start Breadcrumb    -->

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                        </ul>
                    </nav>
                </div>
                <!--    End Breadcrumb    -->
            </div>
            <div id="cart_row" class="row my-2">

                <!--    Start Cart Section    -->

                <div class="col-md-9">

                    <!--    Start Box    -->

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <div class="box bg-light py-2 px-3 rounded shadow cart_table">

                                @if(count($cart) === 0)
                                    <div class='p-5'>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h1 class='display-1'><i class='fab fa-opencart'></i></h1>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <h3>Empty Cart</h3>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                                            <a href="{{url('/products')}}" class='btn btn-warning'>Go Shopping <i class='fas fa-running'></i></a>
                                        </div>
                                    </div>
                                @else
                                    <form action="{{url('/cart')}}" method="POST">

                                        <!--    Start Cart Table    -->

                                        <h1>Cart Items</h1>
                                        <p class="text-muted">You currently have items in your Cart.</p>

                                        <div id="cart_table" class="table-responsive cart_table">
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
                                                            <a href="{{url('/details')}}">{{$item['product']['title']}}</a><br>
                                                            <?php
                                                            $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
                                                            $unitPrice = Cart::getVariationPrice($item['product_id'], $details);
                                                            ?>
                                                            @if(count($details) > 0)
                                                                {{mapped_implode(', ', $details, ': ')}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="item_qty">
                                                            <input type="hidden" class="product_id" value="" aria-label>
                                                            <label>
                                                                <input type="number" class="text-center bg-warning" value="{{$item['quantity']}}">
                                                            </label>
                                                            <img class="loader" src="{{asset('images/loaders/load.gif')}}" alt="loader.gif">
                                                        </td>
                                                        <td>KES {{$unitPrice}}/-</td>
                                                        <td>{{$item['product']['discount']}}%</td>
                                                        <td class="border-left">KES {{$unitPrice * $item['quantity']}}/-</td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-danger p-1 border-0 delete_cart" data-toggle="modal" data-target="#delete_cart_modal">
                                                                <i class="fas fa-backspace"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $totalPrice += ($unitPrice * $item['quantity'])?>
                                                @endforeach

                                                </tbody>
                                                <tfoot class="bg-dark text-white">
                                                <tr>
                                                    <th colspan="6" class="text-right py-0">
                                                        <p class="m-0 small">Total Discount : </p>
                                                    </th>
                                                    <th colspan="3" class="border-left py-0"><p class="m-0 small">0.0%</p></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6" class="text-right py-0"><p class="m-0 small">Total Price : </p></th>
                                                    <th colspan="3" class="border-left py-0">
                                                        <p class="m-0 small">KES {{currencyFormat($totalPrice)}}/-</p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6" class="text-right">
                                                        <p class="m-0 small">TOTAL ({{currencyFormat($totalPrice)}} - 0.0) = </p>
                                                    </th>
                                                    <th colspan="3" class="border-left">
                                                        <p class="m-0 small">KES {{currencyFormat($totalPrice)}}/-</p>
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!--    End Cart Table    -->

                                        <!--    Start Coupon Section    -->

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-inline float-right pb-3">
                                                    <div class="form-group">
                                                        <label for="coupon_code">Coupon Code: </label>
                                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control-sm mx-2">
                                                        <input type="submit" name="use_coupon" class="btn-sm btn-warning" value="Use Coupon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    End Coupon Section    -->

                                        <!--    Start Box Footer    -->

                                        <div class="box_footer">
                                            <div class="float-left">
                                                <a href="{{url('/products')}}" class="btn btn-outline-dark"><i class="fas fa-chevron-left"></i> Continue Shopping</a>
                                            </div>
                                            <div class="float-right">
                                                <button type="submit" name="update" value="Update Cart" class="btn btn-outline-dark"><i class="fas fa-sync-alt"></i> Update Cart</button>
                                                <a href="{{url('/checkout')}}" class="btn btn-outline-success">Checkout <i class="fas fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                        <!--    End Box Footer    -->


                                        <!--    Start Delete Item Modal    -->

                                        <div class="modal fade" id="delete_cart_modal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Item?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keep Item</button>
                                                        <button type="button" class="btn btn-outline-danger" id="delete_item">Yes, Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    End Delete Item Modal    -->

                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->

                    <!--    Start Products you may like -->

                    <div id="products_like" class="row">
                        <div class="col">
                            <div class="row like_title">
                                <div class="col">
                                    <h3>Products you may Like</h3>
                                    <hr class="bg-light my-0">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div id="results" class="col column">

                                    <!--    Start Single ProductSeeder    -->
                                    {{--@foreach($cart['products'] -> take(5) as $item)
                                        <div class="card">
                                            <a href="/details/{{$item -> id}}"><img src='/images/products/{{$item -> pro_image_one}}' alt=''></a>
                                            <div class="card-body">
                                                <div class="row product_title">
                                                    <div class="col">
                                                        <h6 class="card-title m-0 h-"><a href=''>{{$item -> pro_title}}</a></h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto prices">
                                                        @if($item -> pro_sale_price === 0)
                                                            <p>{{$item -> pro_price}}/=</p>
                                                        @else
                                                            <p>{{$item -> pro_price}}/=</p>
                                                            <del class="text-secondary">{{$item -> pro_sale_price}}/=</del>
                                                        @endif
                                                    </div>
                                                    <div class="col-7 button">
                                                        <a href="/details/{{$item -> id}}" class='btn btn-block btn-outline-primary add'>
                                                            <i class='fas fa-cart-plus'></i> +
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="product_label {{$item -> pro_label}} ">
                                                <span class="label">{{$item -> pro_label}}</span>
                                            </a>
                                        </div>
                                @endforeach--}}
                                <!--    End Single ProductSeeder    -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Products you may like -->
                </div>
                <!--    End Cart Section    -->

                <!--    Start Order Summary    -->

                <div class="col-md-3">

                    <!--    Start Box    -->

                    <div id="order_summary" class="box p-3 bg-light rounded shadow">
                        <div class="row">
                            <div class="col">
                                <div class="box_header">
                                    <h3>Order Summary</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <p class="text-muted">
                                Transport and Additional Costs are calculated based on value you have entered.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="cart_summary" class="table-responsive">
                                    <table class="table table-bordered table-dark">
                                        <tbody>
                                        <tr>
                                            <td>Order Sub-Total</td>
                                            <th>KES</th>
                                        </tr>
                                        <tr>
                                            <td>Total Tax</td>
                                            <th>KES 00.00</th>
                                        </tr>
                                        <tr>
                                            <td>Total Discount</td>
                                            <th>KES 00.00</th>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <th>KES</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Box    -->
                </div>
                <!--    End Order Summary    -->
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->


@endsection
