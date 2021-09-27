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
                                <h6 class="m-0 font-weight-bold text-red">
                                    <i class="fab fa-opencart"></i>SU-F {{ (empty($role) ? 'Create roles' : 'Update role') }}
                                </h6>
                            </div>
                            <form class="card-body" action="{{ empty($role) ? route('admin.role.store') : route('admin.role.update', ['id' => $role->id]) }}"
                                  method="POST">
                                @csrf @isset($role) @method('PUT') @endisset
                                <div class="form-group mb-3">
                                    <label for="name">Role names *</label>
                                    <input type="text" @isset($role) class="form-control" @endisset id="select-roles" name="name" multiple
                                           value="{{ old('name', $role->name ?? '') }}"
                                           placeholder="Enter roles..." autocomplete="off" required>
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn btn-primary">{{ (empty($role) ? 'Create roles' : 'Update role') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-red"><i class="fab fa-opencart"></i>
                                    SU-F {{ (empty($permission) ? 'Create permissions' : 'Update permission') }}</h6>
                            </div>
                            <form class="card-body"
                                action="{{ empty($permission) ? route('admin.permission.store') : route('admin.permission.update', ['id' => $permission->id]) }}"
                                method="POST">
                                @csrf @isset($permission) @method('PUT') @endisset
                                <div class="form-group mb-3">
                                    <label for="name">Permission names *</label>
                                    <input type="text" @isset($permission) class="form-control" @endisset id="select-permissions" name="name" multiple
                                           value="{{ old('name', $permission->name ?? '') }}"
                                           placeholder="Enter permissions..." autocomplete="off" required>
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn btn-primary">{{ (empty($permission) ? 'Create permission' : 'Update permissions') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.create.product') }}" class="list-group-item list-group-item-action">
                                Create Product
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

    <script src="{{ asset('vendor/TomSelect/tom-select.js') }}"></script>
    <script>
        const config = {
            create: true,
            persist: true,
            delimiter: ',',
            hideSelected: true,
            plugins: [
                'caret_position',
                'input_autogrow',
                'remove_button'
            ],
        }

        @empty($role)
        const roles = new TomSelect("#select-roles", config);
        @endempty
        @empty($permission)
        const permissions = new TomSelect("#select-permissions", config);
        @endempty
    </script>
@endsection
