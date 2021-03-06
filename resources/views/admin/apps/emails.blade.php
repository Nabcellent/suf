@extends('admin.layouts.app')
@section('title', 'Emails')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-8">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Contacts</h6>
                        @if(isRed())
                            <button class="btn btn-outline-info">Add Email</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="emails_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($emails as $email)
                                    <tr>
                                        <td></td>
                                        <td>{{ $email['email'] }}</td>
                                        <td>{{ $email['first_name'] }}</td>
                                        <td>{{ $email['last_name'] }}</td>
                                        <td>{{ ($email['is_admin'] === 1) ? 'Admin' : 'Customer' }}</td>
                                        <td class="action">
                                            <a href="#" class="mx-2" title="Send Email"><i class="fas fa-envelope text-light"></i></a>
                                            @if(!isSeller())
                                                <a href="#" class="mx-2" title="Modify"><i class="fas fa-pen text-success"></i></a>
                                                <a href="#" class="mx-2 delete-from-table" title="Remove" data-id="{{ $email['id'] }}" data-model="User">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

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
                                        Admins<span class="badge badge-primary badge-pill">{{ tableCount('admins') }}</span>
                                    </a>
                                @endif
                                <a href="{{ route('admin.sellers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Sellers<span class="badge badge-primary badge-pill">{{ tableCount('sellers') }}</span>
                                </a>
                            @endif
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount('orders') }}</span>
                            </a>
                            <a href="{{ route('admin.product.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount('products') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const emailDataTable = $('#emails_table').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            order: [[0, 'ASC']],
            language: {
                info: 'Number of emails: _MAX_',
                infoFiltered:   "(filtered _TOTAL_ emails)",
                search: "_INPUT_",
                searchPlaceholder: "Search email"
            },
            columnDefs: [
                { searchable: false, orderable: false, targets: 0 },
                { searchable: false, orderable: false, targets: 5 }
            ],
            createdRow: function(row, data) {
                const role = data[4];
                if(role.toLowerCase() === 'customer') {
                    $('td', row).eq(4).addClass('text-success').addClass('font-weight-bolder');
                } else if(role.toLowerCase() === 'admin') {
                    $('td', row).eq(4).addClass('text-danger').addClass('font-weight-bolder');
                }
            }
        });
        emailDataTable.on( 'order.dt search.dt', function () {
            emailDataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell["innerHTML"] = i+1;
            });
        }).draw();

    </script>

@endsection
