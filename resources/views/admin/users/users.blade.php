@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Users</h6>
                        <div>
                            <a href="{{ route('admin.user.create', ['user' => 'Admin']) }}" class="btn btn-outline-info">Add Admin</a>
                            <a href="{{ route('admin.user.create', ['user' => 'Seller']) }}" class="btn btn-outline-info">Add Seller</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-2">
                            <button data-model="User" data-table="#users_table" class="btn btn-outline-red delete-all">
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="users_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Phone</th>
                                    <th>Role(s)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($users as $user)
                                    <tr id="{{$user->id}}">
                                        <td></td>
                                        <td></td>
                                        @if(isset($user->image) && file_exists(public_path("/images/users/profile/{$user->image}")))
                                            <td><img src="{{ asset('/images/users/profile/' . $user->image) }}" alt="profile" class="img-fluid"></td>
                                        @else
                                            <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                        @endif
                                        <td>{{ "$user->first_name $user->last_name" }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->primaryPhone->phone }}</td>
                                        <td>{{ count($user->roles) ? $user->roles->implode('name', ', ') : 'N/A' }}</td>
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
                            <a href="{{ route('admin.product.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userDataTable = $('#users_table').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            order: [[ 3, 'asc' ]],
            language: {
                info: 'Number of users: _MAX_',
                infoFiltered:   "(filtered _TOTAL_ users)",
                search: "_INPUT_",
                searchPlaceholder: "Search user"
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                searchable: false,
                orderable: false,
                targets: 1
            }, {
                searchable: false,
                orderable: false,
                targets: 6
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
        });
        userDataTable.on( 'order.dt search.dt', function () {
            userDataTable.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell["innerHTML"] = i+1;
            } );
        }).draw();
    </script>

@endsection
