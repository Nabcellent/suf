@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
    <div class="row">
        <div class="col-9">
            <div class="card crud_table shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sellers</h6>
                    <a href="{{ route('admin.user', ['user' => 'Seller']) }}" class="btn btn-outline-info">Add Seller</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover crud_table" id="sellers_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>username</th>
                                <th>email</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sellers as $seller)
                                <tr>
                                    <td></td>
                                    @if(isset($seller['image']))
                                        <td><img src="{{ asset('/images/users/profile/' . $seller['image']) }}" alt="profile" class="img-fluid"></td>
                                    @else
                                        <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                    @endif
                                    <td>{{ $seller['first_name'] }}</td>
                                    <td>{{ $seller['last_name'] }}</td>
                                    <td>{{ $seller['username'] }}</td>
                                    <td>{{ $seller['email'] }}</td>
                                    <td>{{ $seller['primary_phone']['phone'] }}</td>
                                    <td class="text-primary">{{ $seller['products_count'] }}</td>
                                    <td style="font-size: 14pt">

                                        @if($seller['status'])
                                            <a class="update_status" data-id="{{ $seller['id'] }}" data-model="Admin" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                        @else
                                            <a class="update_status" data-id="{{ $seller['id'] }}" data-model="Admin" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                        @endif

                                    </td>
                                    <td class="action">
                                        <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                        <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $seller['id'] }}" data-model="Admin">
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
                        <a href="{{ route('admin.customers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
                        </a>
                        <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
