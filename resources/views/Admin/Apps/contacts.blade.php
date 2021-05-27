@extends('Admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-6">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Contacts</h6>
                        @if(isRed())
                            <button class="btn btn-outline-info">Add Phone</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="phones_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone</th>
                                    <th>Provider</th>
                                    <th>Owner</th>
                                    <th>Role</th>
                                    @if(!isSeller())
                                        <th>Status</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if(tableCount()['phones'] > 0)
                                    @foreach($phones as $phone)
                                        <tr>
                                            <td></td>
                                            <td>{{ $phone['phone'] }}</td>
                                            <td class="bg-dark">
                                                @if(preg_match('/^(0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})$/i', $phone['phone']))
                                                    Safaricom
                                                @elseif(preg_match('/^(0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})$/i', $phone['phone']))
                                                    Airtel
                                                @elseif(preg_match('/^(0)?(77[0-6][0-9]{6})$/', $phone['phone']))
                                                    Orange
                                                @else
                                                    Unknown
                                                @endif
                                            </td>
                                            <td>{{ $phone['user']['last_name'] }} {{ $phone['user']['first_name'] }}</td>
                                            <td>{{ ($phone['user']['is_admin'] === 1) ? 'Admin' : 'Customer' }}</td>
                                            @if(!isSeller())
                                                <td class="text-center" style="font-size: 14pt">

                                                    @if($phone['status'])
                                                        <a class="update_status" data-id="{{ $phone['id'] }}" data-model="User" title="Update Status"
                                                           style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="update_status" data-id="{{ $phone['id'] }}" data-model="User" title="Update Status"
                                                           style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif

                                                </td>
                                            @endif
                                            <td class="action">
                                                <a href="#" class="mx-2" title="Modify"><i class="fas fa-paper-plane text-primary"></i></a>
                                                @if(!isSeller())
                                                    <a href="#" class="mx-2" title="Modify"><i class="fas fa-pen text-success"></i></a>
                                                    <a href="#" class="mx-2 delete-from-table" title="Remove" data-id="{{ $phone['id'] }}" data-model="User">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

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
                            @if(!isSeller())
                                @if(isRed())
                                    <a href="{{ route('admin.admins') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                                    </a>
                                @endif
                                <a href="{{ route('admin.sellers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                                </a>
                            @endif
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
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
