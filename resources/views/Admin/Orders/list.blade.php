@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Coupons</h6>
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
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                <tr>
                                    <th>{{ $order['id'] }}</th>
                                    <td>{{ $order['phone']['phone'] }}</td>
                                    <td>{{ $order['payment_method'] }}</td>
                                    <td>{{ $order['payment_type'] }}</td>
                                    <td>{{ $order['discount'] }}</td>
                                    <td>{{ $order['total'] }}</td>
                                    <td>{{ $order['status'] }}</td>
                                    <td>{{ date('d~m~y', strtotime($order['created_at'])) }}</td>
                                    <td class="action" style="background-color: #1a202c">
                                        <a href="{{ route('admin.order', ['id' => $order['id']]) }}" class="ml-2" title="view Order">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        @if($order['tracking_number'])
                                            <a href="{{ route('admin.invoice', ['id' => $order['id']]) }}" class="ml-2" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice text-warning"></i>
                                            </a>
                                            <a href="{{ route('admin.invoice-pdf', ['id' => $order['id']]) }}" class="ml-2" title="GENERATE PDF">
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
        </div>
    </div>

@endsection
