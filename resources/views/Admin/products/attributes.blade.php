@extends('Admin.layouts.app')
@section('content')


    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Attributes</h6>
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#add_attribute">Add Attribute</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Attribute</th>
                                    <th scope="col">Values</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($attributes as $attribute)
                                <tr>
                                    <td></td>
                                    <td>{{ $attribute['name'] }}</td>
                                    <td>
                                        {{ $attribute['values'] }}
                                    </td>
                                    <td class="action">
                                        <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-light"></i></a>
                                        <a href="#" class="ml-3" title="Remove"><i class="fas fa-trash text-danger"></i></a>
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
                            <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                            <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Categories<span class="badge badge-primary badge-pill">{{ tableCount()['categories'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Brands</h6>
                        <button id="create_brand" class="btn btn-info" data-toggle="modal" data-target="#brand">Add Brand</button>
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
                                        <td>{{ $brand['name'] }}</td>
                                        <td>{{ $brand['products_count'] }}</td>
                                        <td class="action">
                                            @if($brand['status'])
                                                <a class="update_status mx-2" data-id="{{ $brand['id'] }}" data-model="Brand" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class=" update_status mx-2" data-id="{{ $brand['id'] }}" data-model="Brand" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif

                                            <a href="#" class="mx-2 update_brand" title="Modify" data-toggle="modal" data-target="#brand" data-id="{{ $brand['id'] }}" data-name="{{ $brand['name'] }}">
                                                <i class="fas fa-pen text-light"></i>
                                            </a>
                                            <a href="#" class="mx-1 delete-from-table" data-id="{{ $brand['id'] }}" data-model="Brand" title="Remove">
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

    @include('Admin.products.modals')
@endsection
