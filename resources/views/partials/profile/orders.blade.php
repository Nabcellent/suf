
<div class="box bg-light p-3 rounded shadow orders">
    <div class="row head">
        <div class="col">
            <h1>My Orders</h1>
            <p class="lead">All in one place.</p>
            <p class="text-muted">If your have any Queries, please <a href="{{ route('contact-us') }}">contact us.</a></p>
        </div>
        <div class="dropdown-divider"></div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                @if(count($orders) > 0)
                    <table class="table table-striped table-borderless table-hover">
                        <thead>
                        <tr>
                            <th scope="col" class="pr-0">Order No.</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col" class="d-none d-md-block">Payment Method</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody id="accordion">

                        @foreach($orders as $order)
                            <tr data-toggle="collapse" data-target="#order-products{{ $order['id'] }}" style="cursor: pointer">
                                <th scope="row" class="pr-0">{{ $order['id'] }}</th>
                                <td>{{ currencyFormat($order['total']) }}/=</td>
                                <td class="d-none d-md-block">{{ ucfirst($order['payment_method']) }} {{ ucfirst($order['payment_type']) }}</td>
                                <td>{{ date('M d, y', strtotime($order['created_at'])) }}</td>
                                <td>{{ $order['status'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="p-0">
                                    <div class="ml-3 collapse" data-parent="#accordion" id="order-products{{ $order['id'] }}">
                                        <table class="table table-sm table-bordered small">
                                            <thead>
                                            <tr>
                                                <th>product(s)</th>
                                                <th>Details</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Sub-Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $total = 0; ?>
                                            @foreach($order->orderProducts as $item)
                                                <tr>
                                                    <td>{{ $item->product->title }}</td>
                                                    <td>
                                                        @if(count($item->details) > 0)
                                                            {{ mapped_implode(', ', $item->details, ': ') }}
                                                        @else - @endif
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ currencyFormat($item->price) }}/-</td>
                                                    <td>{{ currencyFormat($item->price * $item->quantity) }}/=</td>
                                                </tr>
                                                <?php $total += $item->price ?>
                                            @endforeach

                                            @if($order->discount > 0)
                                                <tr class="border-0">
                                                    <th colspan="4" class="text-right">Total Discount:</th>
                                                    <td colspan="3">{{ currencyFormat($order->discount) }}/=</td>
                                                </tr>
                                            @endif
                                            <tr class="border-0">
                                                <th colspan="4" class="text-right">GRAND TOTAL:</th>
                                                <td colspan="3">{{ currencyFormat($order['total']) }}/=</td>
                                            </tr>
                                            <tr class="border-0 d-md-none">
                                                <th colspan="4" class="text-right">Payment Method:</th>
                                                <td colspan="3">{{ ucfirst($order['payment_method']) }} <br> {{ ucfirst($order['payment_type']) }}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @else
                    <div class='p-5'>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <h1 class='display-1'><i class='fab fa-shopify'></i></h1>
                        </div>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <h4>You Haven't placed any orders yet...</h4>
                        </div>
                        <div class='d-flex align-items-center justify-content-center empty_cart'>
                            <a href="{{url('/products')}}" class='btn btn-info'><i class='bx bx-run bx-flip-horizontal' ></i> Wanna do some Shopping? 😁</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
