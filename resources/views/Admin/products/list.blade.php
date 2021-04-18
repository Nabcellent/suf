@extends('Admin.layouts.app')
@section('content')

    <div id="products" class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
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
                                    <th>Label</th>
                                    <th>Qty sold</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($products as $product)
                                    <tr>
                                        <td></td>
                                        <td><img src="{{ asset('/images/products/' . $product['main_image']) }}" alt="product" class="img-fluid"></td>
                                        <td class="title">{{ $product['title'] }}</td>
                                        <td>{{ $product['seller']['username'] }}</td>
                                        <td class="text-nowrap">{{ date('d.m.Y', strtotime($product['created_at'])) }}</td>
                                        <td class="text-center">{{ $product['base_price'] }}</td>
                                        <td class="text-center">{{ $product['discount'] }}%</td>
                                        <td>{{ $product['label'] }}</td>
                                        <td class="text-center"> wait </td>
                                        <td class="text-center" style="font-size: 14pt">
                                            @if($product['status'])
                                                <a class="update_product_status" data-id="{{ $product['id'] }}" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                                <a class="update_product_status" data-id="{{ $product['id'] }}" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <a href="{{ url('/admin/product/' . $product['id']) }}" class="ml-2" title="view">
                                                <i class="fas fa-eye text-info"></i>
                                            </a>
                                            <a href="#" class="ml-2 delete_product" data-toggle="modal" data-id="{{ $product['id'] }}"
                                               data-image="{{ $product['main_image'] }}" data-target="#delete_product_modal" title="Remove">
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
