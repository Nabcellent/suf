@extends('Admin.layouts.app')
@section('content')

    <div id="order-view" class="container-fluid px-0">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="card bg-info text-white crud_table shadow mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Order Details</h6>
                                        <div>
                                            <span class="m-0" >#{{ $order['id'] }}</span>
                                            <a href="{{ route('admin.invoice', ['id' => $order['id']]) }}" class="ml-2 btn btn-outline-light" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice"></i> Invoice
                                            </a>
                                            <a href="{{ route('admin.invoice-pdf', ['id' => $order['id']]) }}" class="btn btn-outline-light">
                                                <i class="fa fa-file-pdf"></i> Generate PDF
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-sm table-borderless">
                                                                <tbody>
                                                                @isset($order['coupon'])
                                                                    <tr>
                                                                        <th class="py-1" scope="row">Coupon Code</th>
                                                                        <td class="py-1" colspan="2">{{ $order['coupon']['code'] }}</td>
                                                                    </tr>
                                                                @endisset
                                                                <tr>
                                                                    <th class="py-1" scope="row">Discount</th>
                                                                    <td class="py-1" colspan="2">{{ $order['discount'] }}/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Delivery Fee</th>
                                                                    <td class="py-1" colspan="2">{{ $order['delivery_fee'] }}/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Method</th>
                                                                    <td class="py-1" colspan="2">{{ $order['payment_method'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Type</th>
                                                                    <td class="py-1" colspan="2">{{ $order['payment_type'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Amount Due</th>
                                                                    <td class="py-1 font-weight-bolder text-warning" colspan="2">KSH.{{ currencyFormat($order['total']) }}/=</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <hr class="bg-light">
                                                            <div class="row">
                                                                <div class="col text-light">
                                                                    <p class="m-0">Order Date: &nbsp; {{ date('F jS, y  @g:i A', strtotime($order['created_at'])) }}</p>
                                                                    <p class="m-0">Order Status: &nbsp; {{ $order['status'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row pb-4">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Customer</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;{{ $order['user']['first_name'] }} &nbsp; {{ $order['user']['last_name'] }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email Address</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;<a href="mailto:<%= order.email %>" class="text-light">{{ $order['user']['email'] }}</a></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Delivery Address</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr><th>County</th><td>:&nbsp;&nbsp;&nbsp;{{ $order['address']['sub_county']['county']['name'] }}</td></tr>
                                                                        <tr><th>Sub-County</th><td>:&nbsp;&nbsp;&nbsp;{{ $order['address']['sub_county']['name'] }}</td></tr>
                                                                        <tr><th>Address</th><td class="text-dark">:&nbsp;&nbsp;&nbsp;{{ $order['address']['address'] }}</td></tr>
                                                                        <tr><th>Phone</th><td>:&nbsp;&nbsp;&nbsp;0{{ $order['phone']['phone'] }}</td></tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-danger"><i class="fab fa-opencart"></i> Order Products</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Sub-Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($order['order_products'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/images/products/' . $item['product']['main_image']) }}" alt="product" class="img-fluid"></td>
                                            <td><a href="{{ route('admin.product', ['id' => $item['id']]) }}">{{ $item['product']['title'] }}</a></td>
                                            <td>{{ $item['product']['brand']['name'] }}</td>
                                            <td>{{ $item['product']['seller']['admin']['username'] }}</td>
                                            <td>
                                                <?php $detailsArr = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR); ?>
                                                @foreach($detailsArr as $key => $value)
                                                    <p class="m-0">{{ $key }}: {{ $value }}</p>
                                                @endforeach
                                            </td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['final_unit_price'] }}</td>
                                            <td>{{ $item['final_unit_price'] * $item['quantity'] }}</td>
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

            <div class="col-3">
                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        All Orders<span class="badge badge-primary badge-pill">7</span>
                                    </a>
                                    <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Products<span class="badge badge-primary badge-pill">14</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Remaining stock<span class="badge badge-primary badge-pill">37</span>
                                    </a>
                                    <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Categories<span class="badge badge-primary badge-pill">13</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5>Update Order Status</h5>
                                <hr>
                                <form id="update-order-status" action="{{ url()->current() }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option @if($order['status'] === 'new') selected @endif value="new">New</option>
                                            <option @if($order['status'] === 'in process') selected @endif value="in process">In Process</option>
                                            <option @if($order['status'] === 'hold') selected @endif value="hold">Hold</option>
                                            <option @if($order['status'] === 'pending') selected @endif value="pending">Pending</option>
                                            <option @if($order['status'] === 'completed') selected @endif value="completed">Completed</option>
                                            <option @if($order['status'] === 'cancelled') selected @endif value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <div id="courier" class="collapse @error('courier') show @enderror @error('tracking_number') show @enderror">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <input type="text" class="form-control @error('courier') is-invalid @enderror" name="courier" placeholder="Enter Courier Name">
                                                @error('courier')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <input type="number" class="form-control @error('tracking_number') is-invalid @enderror" name="tracking_number" placeholder="Tracking number">
                                                @error('tracking_number')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info">Update</button>
                                    </div>
                                </form>

                                @if(count($order['order_logs']) > 0)
                                    <h5 class="mb-1">Logs</h5>
                                    <hr class="mt-0">
                                    <div>
                                        @foreach($order['order_logs'] as $log)
                                            <div class="row">
                                                <div class="col">
                                                    <p class="font-weight-bold m-0">{{ $log['status'] }}</p>
                                                    <p class="mb-1">{{ date('d.m.Y - h:i A', strtotime($log['created_at'])) }}</p>
                                                    <hr class="col-6 mx-0 mt-0">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
