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
                <div class="row">
                    <div class="col mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Create Roles</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.role.assign.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">User(s)</label>
                                        <select id="select-users" name="users[]" multiple placeholder="Enter roles..." autocomplete="off">
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col form-group">
                                            <label for="name">Role(s) *</label>
                                            <select id="select-roles" name="roles[]" multiple placeholder="Enter roles..." autocomplete="off">
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label for="name">Permission(s)</label>
                                            <select id="select-permissions" name="permissions[]" multiple autocomplete="off"
                                                    value="{{ old('name', $permission->name ?? '') }}" placeholder="Enter permissions...">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="action">Action *</label>
                                        <select id="select-action" name="action" placeholder="Select action..." autocomplete="off" required>
                                        </select>
                                    </div>
                                    <div class="form-group text-end">
                                        <button class="btn btn-primary">Assign</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.permission.index') }}" class="list-group-item list-group-item-action">
                                Permissions
                            </a>
                            <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">
                                All Users
                            </a>
                            <a href="{{ route('admin.permission.create') }}" class="list-group-item list-group-item-action">
                                Create Permissions
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
