@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Administrators</h6>
                        <a href="{{ route('admin.user', ['user' => 'Admin']) }}" class="btn btn-outline-info">Add Admin</a>
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
                                    <th>email</th>
                                    <th>Phone</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($admins as $admin)
                                    <tr>
                                        <td></td>
                                        @if(isset($admin['image']))
                                            <td><img src="{{ asset('/images/users/admin/Profile/' . $admin['image']) }}" alt="profile" class="img-fluid"></td>
                                        @else
                                            <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                        @endif
                                        <td>{{ $admin['first_name'] }}</td>
                                        <td>{{ $admin['last_name'] }}</td>
                                        <td>{{ $admin['email'] }}</td>
                                        <td>{{ $admin['primary_phone']['phone'] }}</td>
                                        <td>{{ date('d.m.Y', strtotime($admin['created_at'])) }}</td>
                                        <td class="action">
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="{{ $admin['id'] }}" data-model="Admin">
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
    </div>

@endsection
