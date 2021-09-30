@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid p-0">
    <div class="row">
        <div class="col-9">
            <div class="card crud_table shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sellers</h6>
                    <a href="{{ route('admin.user.create', ['user' => 'Seller']) }}" class="btn btn-outline-info">Create Seller</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover crud_table" id="sellers_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>email</th>
                                <th>Products</th>
                                <th>Orders</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($sellers as $seller)
                                <tr>
                                    <td></td>
                                    @if(isset($seller->user->image) && file_exists(public_path("/images/users/profile/{$seller->user->image}")))
                                        <td><img src="{{ asset('/images/users/profile/' . $seller->user->image) }}" alt="profile" class="img-fluid"></td>
                                    @else
                                        <td><img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid"></td>
                                    @endif
                                    <td>{{ $seller->username }}</td>
                                    <td>{{ $seller->user->email }}</td>
                                    <td class="text-primary">{{ $seller->user->products_count }}</td>
                                    <td>{{ $seller->user->orders_count }}</td>
                                    <td class="action">
                                        @if($seller->user->status)
                                            <a class="update_status" data-id="{{ $seller->user_id }}" data-model="User" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                        @else
                                            <a class="update_status" data-id="{{ $seller->user_id }}" data-model="User" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                        @endif
                                        <a href="{{ route('admin.user.edit', ['user' => 'Seller', 'id' => $seller->user_id]) }}" class="mx-2" title="Modify"><i class="fas fa-pen text-light"></i></a>
                                        <a href="#" class="delete-from-table" title="Remove" data-id="{{ $seller->user_id }}" data-model="User">
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
                        @if(isRed())
                            <a href="{{ route('admin.admins') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Admins<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                        @endif
                        <a href="{{ route('admin.customers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Customers<span class="badge badge-primary badge-pill">{{ tableCount()['customers'] }}</span>
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

    <script>
        const sellerDataTable = $('#sellers_table').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            order: [[ 3, 'asc' ]],
            language: {
                info: 'Number of sellers: _MAX_',
                infoFiltered:   "(filtered _TOTAL_ sellers)",
                search: "_INPUT_",
                searchPlaceholder: "Search seller"
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
        sellerDataTable.on( 'order.dt search.dt', function () {
            sellerDataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell["innerHTML"] = i+1;
            });
        }).draw();
    </script>
@endsection
