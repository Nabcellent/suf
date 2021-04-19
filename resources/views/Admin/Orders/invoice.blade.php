<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suf - Invoice</title>

    <!--    Bootstrap CSS    -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--    Boxicons CSS    -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!--    Font Awesome CSS    -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome/css/all.min.css') }}">

    <link href="{{ asset('css/Admin/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
</head>
<body class="nav_body">

@if(Auth::guard('admin')->check())
    @include('Admin.include.navbar')
@endif

<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <a href="{{ route('admin.invoice-pdf', ['id' => $order['id']]) }}" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Generate PDF</a>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header class=" p-0 m-0">
                <div class="row p-0 m-0">
                    <div class="col p-0 m-0">
                        <h4 style="margin: 0">ORDER #{{ $order['id'] }}</h4>
                        <div class="date">Order Date: {{ date('M d, Y', strtotime($order['created_at'])) }} </div>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com" style="color: #9F1910FF;">
                                SU-FASHION
                            </a>
                        </h2>
                        <div>455 Foggy Heights, AZ 85004, US</div>
                        <div>+254 110-039-317</div>
                        <a href="mailto:su.fashion10@gmail.com" style="color: #9F1910FF;">su.fashion10@gmail.com</a>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{ $order['user']['first_name'] }} {{ $order['user']['last_name'] }}</h2>
                        <div class="address">{{ $order['address']['address'] }}, {{ $order['address']['sub_county']['name'] }}, {{ $order['address']['sub_county']['county']['name'] }}</div>
                        <div class="email"><a href="mailto:{{ $order['user']['email'] }}">{{ $order['user']['email'] }}</a></div>
                        <div class="email"><a href="tel:0{{ $order['phone']['phone'] }}">+254-{{ $order['phone']['phone'] }}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h2 class="invoice-id">INVOICE 3-2-1</h2>
                        <div class="date">Date of Invoice: 01/10/2018</div>
                        <div class="date">Due Date: 30/10/2018</div>
                    </div>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-left">DESCRIPTION</th>
                        <th class="text-right">UNIT PRICE</th>
                        <th class="text-right">QUANTITY</th>
                        <th class="text-right">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $total = 0 ?>
                    @foreach($order['order_products'] as $item)
                        <tr>
                            <td class="no">{{ sprintf("%02d", $loop->iteration) }}</td>
                            <td class="text-left">
                                <h3><a href="{{ route('admin.product', ['id' => $item['product_id']]) }}">{{ $item['product']['title'] }}</a></h3>
                                <?php $detailsArr = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR); ?>
                                @foreach($detailsArr as $key => $value)
                                    <p class="detail">{{ $key }}: {{ $value }}</p>
                                @endforeach
                            </td>
                            <td class="unit">{{ currencyFormat($item['final_unit_price']) }}/-</td>
                            <td class="qty">{{ $item['quantity'] }}</td>
                            <td class="total">KES {{ currencyFormat($item['final_unit_price'] * $item['quantity']) }}/-</td>
                        </tr>
                        <?php $total += ($item['final_unit_price'] * $item['quantity']) ?>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUB-TOTAL</td>
                        <td>KSH {{ currencyFormat($total) }}/=</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">DISCOUNT</td>
                        <td>KSH {{ currencyFormat($order['discount']) }}/=</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>KSH {{ currencyFormat($order['total']) }}/=</td>
                    </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div><h5>Payment Method: {{ ucfirst($order['payment_method']) }}</h5></div>
                    <div>
                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    </div>
                </div>
            </main>
            <footer class="invoice-footer">
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>


<!--    Jquery CDN    -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{ asset('js/Admin/Main.js') }}"></script>

<script>
    $(document).on('click', '#printInvoice',function(){
        Popup($('.invoice')[0].outerHTML);
        function Popup(data)
        {
            window.print();
            return true;
        }
    });
</script>
</body>
</html>
