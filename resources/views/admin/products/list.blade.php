@extends('admin.layouts.app')
@section('title', 'Products')
@section('content')
    <div id="products" class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Products</h6>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-info">Create Product</a>
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-2" style="display: none">
                            <button data-model="Product" data-table="#products_table" class="btn btn-outline-red delete-all">
                                <i class="fas fa-trash"></i> Delete all
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="products_table">
                                <thead>
                                <tr>
                                    <th><input class="form-check-input select-all" type="checkbox"></th>
                                    <th>#</th>
                                    <th>Title</th>
                                    @if(!isSeller())
                                        <th>Seller</th>
                                    @endif
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Qty sold</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($products as $item)
                                    <tr id="{{ $item->id }}">
                                        <td></td>
                                        <td></td>
                                        <td class="title">
                                            @if(isset($item->image) && file_exists(public_path("/images/products/{$item->image}")))
                                                <img src="{{ asset('/images/products/' . $item->image) }}" alt="product" class="img-fluid">
                                            @else
                                                <img src="{{ asset('/images/general/NO-IMAGE.png') }}" alt="profile" class="img-fluid">
                                            @endif
                                            {{ $item->title }}
                                        </td>
                                        @if(!isSeller())
                                            <td>{{ $item->seller->admin->username }}</td>
                                        @endif
                                        <td class="text-nowrap">{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
                                        <td class="text-center"><span class="badge bg-primary rounded-pill">{{ $item->base_price }}</span></td>
                                        <td class="text-center"> wait</td>
                                        <td class="action">
                                            @if($item->status)
                                                <a class="update_status" data-id="{{ $item->id }}" data-model="Product" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $item->id }}" data-model="Product" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            <a href="{{ route('admin.product.show', ['id' => $item->id]) }}" class="ml-2" title="view">
                                                <i class="fas fa-eye text-info"></i>
                                            </a>
                                            <a href="{{ route('admin.product.edit', ['id' => $item->id]) }}" class="ml-2" title="view">
                                                <i class="fas fa-pen text-success"></i>
                                            </a>
                                            <a href="#" class="ml-2 delete-from-table" data-id="{{ $item->id }}" data-model="Product" title="Remove">
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

            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.orders') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge bg-primary rounded-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            @if(isAdmin())
                                <a href="{{ route('admin.attr.index') }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Brands<span class="badge bg-primary rounded-pill">{{ tableCount()['brands'] }}</span>
                                </a>
                                <a href="{{ route('admin.categories') }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Categories<span class="badge bg-primary rounded-pill">{{ tableCount()['categories'] }}</span>
                                </a>
                                <a href="{{ route('admin.sellers') }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Sellers<span class="badge bg-primary rounded-pill">{{ tableCount()['sellers'] }}</span>
                                </a>
                            @endif
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge bg-primary rounded-pill">{{ tableCount()['qtySold'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.products.modals')

    <script>
        let targets;

        @if(!isSeller())
            targets = [0, 5, 6, 7]
        @else
            targets = [0, 4, 5, 6]
        @endif

        const productDataTable = $('#products_table').DataTable({
            language: {
                info: 'Number of products: _MAX_',
                infoFiltered: "(filtered _TOTAL_ products)",
                search: "_INPUT_",
                searchPlaceholder: "Search products"
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                searchable: false,
                orderable: false,
                targets: targets
            }],
            createdRow: function (row, data) {
                if ($($(data[5]).get(0)).text().replace(/[$,]/g, '') * 1 > 1000) {
                    $($('td', row).eq(5).get(0)).children().addClass('bg-success')
                } else if ($($(data[5]).get(0)).text().replace(/[$,]/g, '') * 1 < 1000) {
                    $($('td', row).eq(5).get(0)).children().addClass('bg-danger')
                }
            },
        });
        productDataTable.on('order.dt search.dt', function () {
            productDataTable.column(1, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell["innerHTML"] = i + 1;
            });
        }).draw();
    </script>
@endsection
