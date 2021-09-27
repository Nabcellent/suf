@extends('admin.layouts.app')
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/TomSelect/tom-select.css') }}">
    @endpush
@endonce
@section('content')

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col-9">
                @isset($role)
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card shadow">
                                <div class="card-header d-flex align-items-center">
                                    <h6 class="card-title me-1" id="exampleModalLabel">
                                        <a class="btn btn-outline-red" title="Back to list" href="{{ route('admin.permission.index') }}"><i
                                                class='bx bx-arrow-back'></i></a>
                                    </h6>
                                    <h6 class="font-weight-bold text-red"><i class="fab fa-opencart"></i> SU-F {{ $role->name }} Role</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4>{{ $role->name }} Permissions</h4>
                                            <ol class="list-group list-group-flush">
                                                @forelse($role->permissions as $permit)
                                                    <li class="list-group-item">{{ $permit->name }}</li>
                                                @empty
                                                    <li class="list-group-item">This role has no permissions</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                        <div class="col border-start">
                                            <h5>STATS</h5>
                                            <ol class="list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Total users with this role
                                                    <span class="badge bg-primary rounded-pill">{{ $role->users_count }}</span>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

                @isset($permission)
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card shadow">
                                <div class="card-header d-flex align-items-center">
                                    <h6 class="card-title me-1" id="exampleModalLabel">
                                        <a class="btn btn-outline-red" title="Back to list" href="{{ route('admin.permission.index') }}"><i
                                                class='bx bx-arrow-back'></i></a>
                                    </h6>
                                    <h6 class="font-weight-bold text-red"><i class="fab fa-opencart"></i> SU-F {{ ucwords($permission->name) }} Permission</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4>Roles that can {{ $permission->name }}</h4>
                                            <ol class="list-group list-group-flush">
                                                @forelse($permission->roles as $role)
                                                    <li class="list-group-item">{{ $role->name }}</li>
                                                @empty
                                                    <li class="list-group-item">~ No role can {{ $role->name }}</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                        <div class="col border-start">
                                            <h5>STATS</h5>
                                            <ol class="list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Total users with this permission
                                                    <span class="badge bg-primary rounded-pill">{{ $permission->users_count }}</span>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
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

    <script src="{{ asset('vendor/TomSelect/tom-select.js') }}"></script>
    <script>
        const config = {
            persist: true,
            delimiter: ',',
            hideSelected: true,
            valueField: 'name',
            labelField: 'name',
            searchField: 'name',
            selectOnTab: true,
            plugins: [
                'caret_position',
                'input_autogrow',
                'remove_button'
            ],
        }

        const users = new TomSelect("#select-users", {
            ...config,
            valueField: 'id',
            labelField: 'email',
            searchField: 'email',
        });
        const roles = new TomSelect("#select-roles", config);
        const permissions = new TomSelect("#select-permissions", config);

        config.valueField = config.labelField = config.searchField = 'action';
        const actions = new TomSelect("#select-action", {
            ...config,
            onInitialize: () => {
                fetch(`/admin/roles/assign/data`).then(response => response.json())
                    .then(data => {
                        console.log(data)
                        users.addOptions(data.users)
                        roles.addOptions(data.roles)
                        permissions.addOptions(data.permissions)
                        actions.addOptions(data.actions)
                    }).catch(error => console.log(error))
            }
        });
    </script>
@endsection
