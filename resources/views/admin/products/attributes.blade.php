@extends('admin.layouts.app')
@section('title', 'Attributes')
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
                    <div class="col card crud_table shadow mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Attributes</h6>
                            <button class="btn btn-outline-info create_attr" data-bs-toggle="modal" data-bs-target="#attr">Add Attribute
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover crud_table" id="attributes_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Attribute</th>
                                        <th scope="col">Values</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($attributes as $attr)
                                        <tr>
                                            <td></td>
                                            <td>{{ $attr->name }}</td>
                                            <td>
                                                {{ implode(' ~ ', $attr->values) }}
                                            </td>
                                            <td class="action">
                                                <a href="#" class="edit_attr" data-bs-toggle="modal" data-bs-target="#attr" title="Modify"
                                                   data-name="{{ $attr->name }}" data-values="{{ json_encode($attr->values) }}">
                                                    <i class="fas fa-pen text-light"></i>
                                                </a>
                                                <a href="#" title="Remove"><i class="fas fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col card crud_table shadow mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Brands</h6>
                            <button id="create_brand" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#brand">Add Brand</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover crud_table" id="brands_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">No. of products</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($brands as $brand)
                                        <tr>
                                            <td></td>
                                            <td>{{ $brand->name }}</td>
                                            <td>{{ $brand->products_count }}</td>
                                            <td class="action">
                                                @if($brand->status)
                                                    <a class="update_status mx-2" data-id="{{ $brand->id }}" data-model="Brand" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                @else
                                                    <a class=" update_status mx-2" data-id="{{ $brand->id }}" data-model="Brand" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                @endif

                                                <a href="#" class="mx-2 update_brand" title="Modify" data-bs-toggle="modal" data-bs-target="#brand"
                                                   data-id="{{ $brand->id }}" data-name="{{ $brand->name }}">
                                                    <i class="fas fa-pen text-light"></i>
                                                </a>
                                                <a href="#" class="mx-1 delete-from-table" data-id="{{ $brand->id }}" data-model="Brand"
                                                   title="Remove">
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
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.product.create') }}" class="list-group-item list-group-item-action">
                                Create Product
                            </a>
                            <a href="{{ route('admin.coupon') }}" class="list-group-item list-group-item-action">
                                Create Coupon
                            </a>
                            <a href="{{ route('admin.product.index') }}"
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

    @include('admin.products.modals')

    <script src="{{ asset('vendor/TomSelect/tom-select.js') }}"></script>
    <script>
        const attributeValues = new TomSelect("#select-values", {
            persist: true,
            delimiter: ',',
            hideSelected: true,
            plugins: [
                'caret_position',
                'input_autogrow',
                'remove_button'
            ],
        });

        const categoriesTable = $('#attributes_table').DataTable({
            scrollY: '30vh',
            scrollCollapse: true,
            language: {
                info: 'Total Categories: _MAX_',
                infoFiltered: "(filtered _TOTAL_)",
                search: "_INPUT_",
                searchPlaceholder: "Search category"
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }, {
                searchable: false,
                orderable: false,
                targets: 3
            }],
        });
        categoriesTable.on('order.dt search.dt', function () {
            categoriesTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell["innerHTML"] = i + 1;
            });
        }).draw();

        const brandDataTable = $('#brands_table').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false,
            order: [[0, 'ASC']],
            language: {
                info: 'Number of brands: _MAX_',
                infoFiltered: "(filtered _TOTAL_ brands)",
                search: "_INPUT_",
                searchPlaceholder: "Search brand"
            },
            columnDefs: [
                {searchable: false, orderable: false, targets: 0},
                {searchable: false, orderable: false, targets: 2}
            ],
        });
        brandDataTable.on('order.dt search.dt', function () {
            brandDataTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell["innerHTML"] = i + 1;
            });
        }).draw();

        /*__________________________________________  Set Attribute To Upsert  _____________________*/
        $('.edit_attr').on('click', function () {
            let attrName = $(this).attr('data-name');
            let attrValues = JSON.parse($(this).attr('data-values'));

            $('#attr .modal-title').html("Update Attribute");
            $('#attr .btn_attr').html("Update");
            const values = attrValues.map(val => {
                return {value: val, text: val}
            })
            attributeValues.addOptions(values)
            attributeValues.setValue(attrValues)

            $('#attr input[name="name"]').val(attrName);
        });
        $(document).on('click', 'button#create_attr', function () {
            $('form#upsert_attr input[name="name"]').val('');
            $('#attr #attr_id').val("");
            $('#attr #btn_update_attr').html("Create");
            $('#attr .modal-title').html("Create Brand");
        });
    </script>
@endsection
