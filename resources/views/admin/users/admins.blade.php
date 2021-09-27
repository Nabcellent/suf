@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Administrators</h6>
                        <a href="{{ route('admin.user.create', ['user' => 'Admin']) }}" class="btn btn-outline-info">Create Admin</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="admins_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($admins as $admin)
                                    <tr>
                                        <td></td>
                                        @if(isset($admin->user->image) && file_exists(public_path("/images/users/profile/{$admin->user->image}")))
                                            <td><img src="{{ asset('/images/users/profile/' . $admin->user->image) }}" alt="profile"
                                                     class="img-fluid"></td>
                                        @else
                                            <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                        @endif
                                        <td>{{ $admin->user->first_name }}</td>
                                        <td>{{ $admin->user->last_name }}</td>
                                        <td>{{ $admin->user->email }}</td>
                                        <td>{{ $admin->user->primaryPhone->phone }}</td>
                                        <td class="action">
                                            @if($admin->user->status)
                                                <a class="update_status" data-id="{{ $admin->user_id }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $admin->user_id }}" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            <a href="{{ route('admin.user.edit', ['user' => 'Admin', 'id' => $admin->user_id]) }}" class="ml-4"
                                               title="Modify"><i class="fas fa-pen text-success"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $admin->user_id }}"
                                               data-model="User">
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
                            <a href="{{ route('admin.sellers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.customers') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
                            </a>
                            <a href="{{ route('admin.products') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const adminsDataTable = $('#admins_table').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            order: [[0, 'desc']],
            language: {
                info: 'Number of administrators: _MAX_',
                infoFiltered: "(filtered _TOTAL_ admins)",
                search: "_INPUT_",
                searchPlaceholder: "Search admin"
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }, {
                searchable: false,
                orderable: false,
                targets: 6
            }],
        });
        adminsDataTable.on('order.dt search.dt', function () {
            adminsDataTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell["innerHTML"] = i + 1;
            });
        }).draw();
    </script>

@endsection
