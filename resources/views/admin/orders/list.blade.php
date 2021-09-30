@extends('admin.layouts.app')
@section('content')
    <?php use App\Models\Order ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Orders</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="orders_table">
                                <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Pay Method</th>
                                    <th scope="col">Pay Type</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    @if(!isSeller())
                                        <th scope="col">Ready?</th>
                                    @endif
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                <tr>
                                    <th>{{ $order->order_no }}</th>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->status }}</td>
                                    @if(!isSeller())
                                        <td>
                                            @if((orderProductsReady($order->id)))
                                                <h5 class="text-success"><i class="fas fa-thumbs-up"></i></h5>
                                            @else
                                                <h5 class="text-info"><i class="far fa-thumbs-down"></i></h5>
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ date('d~m~y', strtotime($order->created_at)) }}</td>
                                    <td class="action">
                                        <a href="{{ route('admin.order', ['id' => $order->id]) }}" title="view Order">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        @if($order->tracking_number)
                                            <a href="{{ route('admin.invoice', ['id' => $order->id]) }}" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice text-warning"></i>
                                            </a>
                                            <a href="{{ route('admin.invoice-pdf', ['id' => $order->id]) }}" title="GENERATE PDF">
                                                <i class='fas fa-file-pdf text-white'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.create.product') }}" class="list-group-item list-group-item-action">
                                Create Product
                            </a>
                            <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            @if(isTeamSA())
                                <a href="{{ route('admin.payments') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Payments<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                                </a>
                                <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Categories<span class="badge badge-primary badge-pill">{{ tableCount()['categories'] }}</span>
                                </a>
                            @endif
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">{{ tableCount()['qtySold'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const orderDataTable = $('#orders_table').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            order: [0, 'DESC'],
            language: {
                info: 'Number of orders: _MAX_',
                infoFiltered:   "(filtered _TOTAL_ orders)",
                search: "_INPUT_",
                searchPlaceholder: "Search order"
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 1
            }, {
                searchable: false,
                orderable: false,
                targets: 8
            }],
            createdRow: function(row, data) {
                if(data[6].replace(/[$,]/g, '') * 1 > 1000) {
                    $('td', row).eq(5).addClass('text-success');
                } else if(data[6].replace(/[$,]/g, '') * 1 < 1000) {
                    $('td', row).eq(5).addClass('text-danger');
                }
                if(data[7].toLowerCase() === 'cancelled') {
                    $('td', row).eq(6).addClass('text-danger');
                } else if(data[7].toLowerCase() === 'completed') {
                    $('td', row).eq(6).addClass('text-success');
                }
            },
        });

    </script>

@endsection
