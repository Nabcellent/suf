@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Customers</h6>
                        <button class="btn btn-outline-info">Add Customer</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="customers_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>gender</th>
                                    <th>Orders</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($customers as $customer)
                                    <tr>
                                        <td></td>
                                        <td>{{ $customer['first_name'] }}</td>
                                        <td>{{ $customer['last_name'] }}</td>
                                        <td>{{ $customer['email'] }}</td>
                                        <td>{{ $customer['primary_phone']['phone'] }}</td>
                                        <td>{{ $customer['gender'] }}</td>
                                        <td>{{ $customer['orders_count'] }}</td>
                                        <td style="font-size: 14pt">

                                            @if($customer['status'])
                                                <a class="update_status" data-id="{{ $customer['id'] }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $customer['id'] }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif

                                        </td>
                                        <td class="action">
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $customer['id'] }}" data-model="User">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
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
                            <a href="{{ route('admin.admins') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.sellers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
