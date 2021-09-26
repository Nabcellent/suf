@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Users</h6>
                        <div>
                            <a href="{{ route('admin.user', ['user' => 'Admin']) }}" class="btn btn-outline-info">Add Admin</a>
                            <a href="{{ route('admin.user', ['user' => 'Seller']) }}" class="btn btn-outline-info">Add Seller</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="sellers_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Phone</th>
                                    <th>Role(s)</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($users as $user)
                                    <tr>
                                        <td></td>
                                        @if(isset($user->image) && file_exists(asset('/images/users/profile/' . $user->image)))
                                            <td><img src="{{ asset('/images/users/profile/' . $user->image) }}" alt="profile" class="img-fluid"></td>
                                        @else
                                            <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                        @endif
                                        <td>{{ "$user->first_name $user->last_name" }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->primaryPhone->phone }}</td>
                                        <td>{{ count($user->roles) ? $user->roles->implode('name', ', ') : 'N/A' }}</td>
                                        <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td>
                                        <td class="action">
                                            @if($user->status)
                                                <a class="update_status" data-id="{{ $user->id }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $user->id }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-success"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $user->id }}" data-model="User">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

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
