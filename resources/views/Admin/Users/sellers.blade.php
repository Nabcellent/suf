@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
    <div class="row">
        <div class="col-10">
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
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sellers as $seller)
                                <tr>
                                    <td></td>
                                    @if(isset($seller['image']))
                                        <td><img src="{{ asset('/images/users/admin/Profile/' . $seller['image']) }}" alt="profile" class="img-fluid"></td>
                                    @else
                                        <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                    @endif
                                    <td>{{ $seller['first_name'] }}</td>
                                    <td>{{ $seller['last_name'] }}</td>
                                    <td>{{ $seller['username'] }}</td>
                                    <td>{{ $seller['email'] }}</td>
                                    <td>{{ $seller['primary_phone']['phone'] }}</td>
                                    <td>{{ date('d.m.Y', strtotime($seller['created_at'])) }}</td>
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
    </div>
</div>

@endsection
