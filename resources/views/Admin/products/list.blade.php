@extends('Admin.layouts.app')
@section('content')
    <div id="products" class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Products</h6>
                        <a href="{{ route('admin.create-product') }}" class="btn btn-info">Add Product</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="products_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Seller</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Qty sold</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($products as $item)
                                    <tr>
                                        <td></td>
                                        <td><img src="{{ asset('/images/products/' . $item['main_image']) }}" alt="product" class="img-fluid"></td>
                                        <td class="title">{{ $item['title'] }}</td>
                                        <td>{{ $item['seller']['admin']['username'] }}</td>
                                        <td class="text-nowrap">{{ date('d.m.Y', strtotime($item['created_at'])) }}</td>
                                        <td class="text-center">{{ $item['base_price'] }}</td>
                                        <td class="text-center">{{ $item['discount'] }}%</td>
                                        <td class="text-center"> wait </td>
                                        <td class="text-center" style="font-size: 14pt">
                                            @if($item['status'])
                                                <a class="update_status" data-id="{{ $item['id'] }}" data-model="Product" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_status" data-id="{{ $item['id'] }}" data-model="Product" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <a href="{{ url('/admin/product/' . $item['id']) }}" class="ml-2" title="view">
                                                <i class="fas fa-eye text-info"></i>
                                            </a>
                                            <a href="#" class="ml-2 delete-from-table" data-id="{{ $item['id'] }}" data-model="Product" title="Remove">
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
                            <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Categories<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Brands<span class="badge badge-primary badge-pill">{{ tableCount()['brands'] }}</span>
                            </a>
                            <a href="{{ route('admin.attributes') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Sellers<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Admin.products.modals')
@endsection
