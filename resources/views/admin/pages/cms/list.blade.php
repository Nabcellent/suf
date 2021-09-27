@extends('admin.layouts.app')
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}">
    @endpush
@endonce
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F CMS</h6>
                        <a href="{{ route('admin.cms.create') }}" class="btn btn-outline-info">Create CMS</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table cms">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Date created</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cmsPages as $page)
                                    <tr>
                                        <td></td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->url }}</td>
                                        <td>{{ date('M d, Y', strtotime($page->created_at)) }}</td>
                                        <td class="action">
                                            @if($page->status)
                                                <a class="update_status" data-id="{{ $page->id }}" data-model="CmsPage" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $page->id }}" data-model="CmsPage" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            <a href="{{ route('admin.cms.edit', ['id' => $page->id]) }}" class="edit-cms" title="Modify page">
                                                <i class="fas fa-pen text-light"></i>
                                            </a>
                                            <a href="#" class="delete-from-table" data-id="{{ $page->id }}" data-model="CmsPage"
                                               title="Destroy"><i class="fas fa-trash text-danger"></i></a>
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
                            <a href="{{ route('admin.create-product') }}" class="list-group-item list-group-item-action">
                                Create Product
                            </a>
                            <a href="{{ route('admin.coupon') }}" class="list-group-item list-group-item-action">
                                Create Coupon
                            </a>
                            <a href="{{ route('admin.products') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                            <a href="{{ route('admin.categories') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Categories<span class="badge badge-primary badge-pill">{{ tableCount()['categories'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(() => {
            const categoriesTable = $('table.cms').DataTable({
                scrollY: '30vh',
                scrollCollapse: true,
                language: {
                    info: 'Total cms pages: _MAX_',
                    infoFiltered: "(filtered _TOTAL_)",
                    search: "_INPUT_",
                    searchPlaceholder: "Search cms"
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
            categoriesTable.on('order.dt search.dt', function () {
                categoriesTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell["innerHTML"] = i + 1;
                });
            }).draw();
        })
    </script>
@endsection
