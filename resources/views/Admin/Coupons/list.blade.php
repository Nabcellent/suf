@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Coupons</h6>
                        <a href="{{ route('admin.coupon') }}" class="btn btn-info">Add Coupon</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="coupons_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Option</th>
                                    <th scope="col">Coupon Type</th>
                                    <th scope="col">Amount Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">expiry</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($coupons as $coupon)
                                    <tr>
                                        <th></th>
                                        <td>{{ $coupon['code'] }}</td>
                                        <td>{{ $coupon['option'] }}</td>
                                        <td>{{ $coupon['coupon_type'] }}</td>
                                        <td>{{ $coupon['amount_type'] }}</td>
                                        <td>{{ $coupon['amount'] }} {{ ($coupon['amount_type'] === "Percent") ? "%" : "/=" }}</td>
                                        <td>{{ date('m-d-Y', strtotime($coupon['expiry'])) }}</td>
                                        <td class="action">
                                            @if($coupon['status'])
                                                <a class="update_status" data-id="{{ $coupon['id'] }}" data-model="Coupon" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $coupon['id'] }}" data-model="Coupon" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif

                                            <a href="{{ route('admin.coupon', ['id' => $coupon['id']]) }}" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" data-model="Coupon" data-id="{{ $coupon['id'] }}" title="Remove"><i class="fas fa-trash text-danger"></i></a>
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
