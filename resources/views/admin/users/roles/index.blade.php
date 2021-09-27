@extends('admin.layouts.app')
@section('content')

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col card crud_table shadow mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-red"><i class="fab fa-opencart"></i> SU-F Roles</h6>
                            <a class="btn btn-red" href="{{ route('admin.permission.create') }}">Create Roles</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover crud_table" id="roles_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Guard</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($roles as $role)
                                        <tr>
                                            <td></td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->guard_name }}</td>
                                            <td class="text-nowrap">{{ date('M d, Y', strtotime($role->created_at)) }}</td>
                                            <td class="action">
                                                @if($role->status)
                                                    <a class="update_status" data-id="{{ $role->id }}" data-model="Role" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                @else
                                                    <a class="update_status" data-id="{{ $role->id }}" data-model="Role" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                @endif
                                                <a href="{{ route('admin.role.show', ['id' => $role->id]) }}" class="ml-4" title="Modify">
                                                    <i class="fas fa-eye text-light"></i>
                                                </a>
                                                <a href="{{ route('admin.role.edit', ['id' => $role->id]) }}" class="ml-4" title="Modify"><i
                                                        class="fas fa-pen text-success"></i></a>
                                                <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $role->id }}" data-model="Role">
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
                <div class="row">
                    <div class="col card crud_table shadow mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-red"><i class="fab fa-opencart"></i> SU-F Permissions</h6>
                            <a class="btn btn-red" href="{{ route('admin.permission.create') }}">Create Permissions</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover crud_table" id="permissions_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Guard</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td></td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->guard_name }}</td>
                                            <td class="text-nowrap">{{ date('M d, Y', strtotime($permission->created_at)) }}</td>
                                            <td class="action">
                                                @if($permission->status)
                                                    <a class="update_status" data-id="{{ $permission->id }}" data-model="Permission"
                                                       title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                @else
                                                    <a class="update_status" data-id="{{ $permission->id }}" data-model="Permission"
                                                       title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                @endif
                                                <a href="{{ route('admin.permission.show', ['id' => $permission->id]) }}" class="ml-4" title="Modify">
                                                    <i class="fas fa-eye text-light"></i>
                                                </a>
                                                <a href="{{ route('admin.permission.edit', ['id' => $permission->id]) }}" class="ml-4" title="Modify">
                                                    <i class="fas fa-pen text-success"></i>
                                                </a>
                                                <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $permission->id }}"
                                                   data-model="Permission">
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
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.role.assign') }}" class="list-group-item list-group-item-action">
                                Assign
                            </a>
                            <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">
                                All Users
                            </a>
                            <a href="{{ route('admin.products') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">14</span>
                            </a>
                            <a href="{{ route('admin.orders') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">7</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">{{ tableCount()['qtySold'] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(() => {
            const rolesTable = $('#roles_table').DataTable({
                scrollY: '30vh',
                scrollCollapse: true,
                language: {
                    info: 'Total roles: _MAX_',
                    infoFiltered: "(filtered _TOTAL_)",
                    search: "_INPUT_",
                    searchPlaceholder: "Search roles"
                },
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0
                }, {
                    searchable: false,
                    orderable: false,
                    targets: 4
                }],
            });
            rolesTable.on('order.dt search.dt', function () {
                rolesTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell["innerHTML"] = i + 1;
                });
            }).draw();

            const permissionsTable = $('#permissions_table').DataTable({
                scrollY: '30vh',
                scrollCollapse: true,
                language: {
                    info: 'Total permissions: _MAX_',
                    infoFiltered: "(filtered _TOTAL_)",
                    search: "_INPUT_",
                    searchPlaceholder: "Search permissions"
                },
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0
                }, {
                    searchable: false,
                    orderable: false,
                    targets: 4
                }],
            });
            permissionsTable.on('order.dt search.dt', function () {
                permissionsTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell["innerHTML"] = i + 1;
                });
            }).draw();
        })
    </script>
@endsection
