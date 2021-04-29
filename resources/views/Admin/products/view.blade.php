@extends('Admin.layouts.app')
@section('content')

    <div id="details" class="container-fluid px-0">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="text-danger list-group all_errors">
                                    @if ($errors->any())
                                        <div class="alert alert-danger py-2">
                                            <ul class="m-0 py-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card bg-primary text-white crud_table shadow mb-4">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Product Details</h6>
                                        <div>
                                            <button class="btn btn-outline-light" data-toggle="modal" data-target="#edit_product_modal">Edit</button>
                                            <a href="#" class="ml-2 delete_product" data-toggle="modal" data-id="{{ $product['id'] }}"
                                               data-image="{{ $product['main_image'] }}" data-target="#delete_product_modal" title="Delete This Product">
                                                <i class="fas fa-trash text-warning"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <img src="{{ asset('/images/products/' . $product['main_image']) }}" alt="main_image" style="width: 15rem;">
                                                <h5 class="card-title pt-2">{{ $product['title'] }}</h5>
                                            </div>
                                            <div class="col">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-sm table-borderless">
                                                                <tbody>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Category</th>
                                                                    <td class="py-0">{{ $product['sub_category']['category']['title'] }} - {{ $product['sub_category']['title'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Seller</th>
                                                                    <td class="py-0">{{ $product['seller']['admin']['username'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Brand</th>
                                                                    <td class="py-0" colspan="2">{{ $product['brand']['name'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Keywords</th>
                                                                    <td class="py-0" colspan="2">{{ $product['keywords'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Label</th>
                                                                    <td class="py-0" colspan="2">{{ $product['label'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Featured</th>
                                                                    <td class="py-0" colspan="2">{{ $product['is_featured'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Discount</th>
                                                                    <td class="py-0" colspan="2" style="color: white">{{ $product['discount'] }}%</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Base Price</th>
                                                                    <td class="py-0 font-weight-bolder text-warning" colspan="2">
	                                                                    KSH {{ currencyFormat($product['base_price']) }}/=
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="m-0">Date Created:</p>
                                                                    <p class="m-0">Date Updated:</p>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="m-0">{{ date('M d, Y', strtotime($product['created_at'])) }}</p>
                                                                    <p class="m-0">{{ date('M d, Y', strtotime($product['updated_at'])) }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col">
                                                                    <h6 class="m-0">Description</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <p class="m-0">{{ $product['description'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card crud_table shadow mb-4">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-opencart"></i> Product Variations</h6>
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_variation">Add Variation</button>
                                    </div>
                                    <div class="card-body pb-0">

                                        @if(count($product['variations']) > 0)
                                            <table class="table table-sm mb-1">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Variation</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($product['variations'] as $variant)
                                                    @php $attribute = key(json_decode($variant['variation'], true, 512, JSON_THROW_ON_ERROR)); @endphp
                                                    <tr>
                                                        <td class="pb-0 pt-1">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">{{ $attribute }}</th>
                                                                    <th scope="col">Stock</th>
                                                                    <th scope="col">Extra Cost</th>
                                                                    <th scope="col" colspan="2">Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($variant['variation_options'] as $option)
                                                                    <tr>
                                                                        <td class="d-flex">
                                                                            <div>
                                                                                <input type="text" name="variation_option" value="{{ $option['variant'] }}" class="form-control"
                                                                                       data-variation-id="{{ $variant['id'] }}" data-id="{{ $option['id'] }}" style="max-width: 7rem">
                                                                                <input type="hidden" id="current_variant_name" value="{{ $option['variant'] }}">
                                                                                <span class="invalid-feedback"></span>
                                                                            </div>
                                                                            <img id="loader" src="{{ asset('images/loaders/Gear-0.2s-200px.gif') }}" alt="" width="30" height="30">
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-4">{{ $option['stock'] }}</div>
                                                                                <div class="col">
                                                                                    <a href="#" data-id="{{ $option['id'] }}" class="stock" data-toggle="modal" data-target="#set_stock">set stock</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-4">{{ currencyFormat($option['extra_price']) }}/-</div>
                                                                                <div class="col">
                                                                                    <a href="#" data-id="{{ $option['id'] }}" class="extra_price" data-toggle="modal" data-target="#set_price">set price</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td><a href="#"><i class="fas fa-pen-fancy"></i> Image</a></td>
                                                                        <td>
                                                                            @if($option['status'])
                                                                                <a class="update_status" data-id="{{ $option['id'] }}" data-model="Variation's Option" title="Update Status" style="cursor: pointer">
                                                                                    <i class="fas fa-toggle-on" status="Active"></i>
                                                                                </a>
                                                                            @else
                                                                                <a class="update_status" data-id="{{ $option['id'] }}" data-model="Variation's Option" title="Update Status" style="cursor: pointer">
                                                                                    <i class="fas fa-toggle-off" status="Inactive"></i>
                                                                                </a>
                                                                            @endif

                                                                            <a href="#" class="delete-from-table ml-2" data-id="{{ $option['id'] }}" data-model="Variation's Option"><i class="bx bxs-trash-alt"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="d-flex">
                                                            @if($variant['status'])
                                                                <h5>
                                                                    <a class="update_status" data-id="{{ $variant['id'] }}" data-model="Variation" title="Update Status" style="cursor: pointer">
                                                                        <i class="fas fa-toggle-on" status="Active"></i>
                                                                    </a>
                                                                </h5>
                                                            @else
                                                                <h5>
                                                                    <a class="update_status" data-id="{{ $variant['id'] }}" data-model="Variation" title="Update Status" style="cursor: pointer">
                                                                        <i class="fas fa-toggle-off" status="Inactive"></i>
                                                                    </a>
                                                                </h5>
                                                            @endif

                                                            <a href="#" class="attribute" data-id="{{ $variant['id'] }}" data-toggle="modal" data-target="#create_variation_option" title="Add A {{ Str::singular($attribute) }}">
                                                                <h5><i class="fas fa-plus-circle pl-3"></i></h5>
                                                            </a>
                                                            <a href="#" class="delete-from-table" data-id="{{ $variant['id'] }}" data-model="Variation"><h5><i class="fas fa-trash pl-3"></i></h5></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        @else
                                            <div class="row my-5 ">
                                                <div class="col">
                                                    <h5>This product has no variations.</h5>
                                                    <hr class="bg-primary">
                                                </div>
                                            </div>
                                        @endif

                                    </div>
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

                <div class="row">
                    <div class="col-5 pr-md-1">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> Image List</h6>
                                <button class="btn btn-outline-info" data-toggle="modal" data-target="#add_image_modal">Upload</button>
                            </div>
                            <div class="card-body">
                                @if(count($product['images']) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($product['images'] as $image)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('/images/products/' . $image['image']) }}" alt="image" class="img-fluid"></td>
                                                    <td class="action">

                                                        @if($image['status'])
                                                            <a class="update_status mr-4" data-id="{{ $image['id'] }}" data-model="Product's Image" title="Update Status"
                                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                        @else
                                                            <a class=" update_status mr-3" data-id="{{ $image['id'] }}" data-model="Product's Image" title="Update Status"
                                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                        @endif

                                                        <a href="#" class="delete-from-table" data-id="{{ $image['id'] }}" data-model="Product's Image" data-image="{{ $image['image'] }}" title="Remove">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row my-5 ">
                                        <div class="col">
                                            <h5>This product has no extra images yet.</h5>
                                            <hr class="bg-primary">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-7 pl-md-1">
                        <div class="card text-white bg-dark crud_table shadow mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> Product Images</h6>
                            </div>
                            <div class="card-body">
                                @if(count($product['images']) > 0)
                                <div id="details-swiper" class="swiper-container">
                                    <div class="swiper-wrapper">

                                        @foreach($product['images'] as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('/images/products/' . $image['image']) }}" alt="Product Image">
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                @else
                                    <div class="row my-5 ">
                                        <div class="col">
                                            <h5>This product has no extra images yet.</h5>
                                            <hr class="bg-primary">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('Admin.products.modals')
@endsection
