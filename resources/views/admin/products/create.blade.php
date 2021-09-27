@extends('admin.layouts.app')
@section('content')

    <div id="add_product" class="container-fluid p-0">

    <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="card shadow">
                            <form id="create_product" action="{{ route('admin.create.product') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Add Product</h4>
                                    <div class="dropdown no-arrow">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Order Options</div>
                                            <a class="dropdown-item" href="{{ route('admin.products') }}">View Products</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="" class="m-0">Title</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror "
                                                   placeholder="Enter product title *" aria-label>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label for="" class="m-0">Brand</label>
                                            <select name="brand" class="form-control @error('brand') is-invalid @enderror " aria-label>
                                                <option selected hidden value="0">Select a brand*</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if(isSeller())
                                            <input type="hidden" name="seller" value="{{ Auth::id() }}">
                                        @else
                                            <div class="form-group col">
                                                <label></label>
                                                <select id="sellers" name="seller" class="form-control @error('seller') is-invalid @enderror" aria-label required>
                                                    <option selected hidden value="">Select a seller*</option>
                                                    @foreach($sellers as $seller)
                                                        <option value="{{ $seller['user_id'] }}">{{ $seller['username'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('seller')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="form-group col">
                                            <label></label>
                                            <select id="categories" class="form-control @error('category') is-invalid @enderror" name="category" aria-label required>
                                                <option selected hidden value="">Select a category *</option>
                                                @foreach($sections as $section)
                                                    <optgroup label="{{ $section['title'] }}"></optgroup>
                                                    @foreach($section['categories'] as $category)
                                                        <option value="{{ $category['id'] }}"> &nbsp; --- {{ $category['title'] }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label></label>
                                            <select id="sub_categories" class="form-control @error('sub_category') is-invalid @enderror" name="sub_category" aria-label required>
                                                <option selected hidden value="">Select a sub-category *</option>
                                            </select>
                                            @error('sub_category')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group m-0">
                                                <p class="mt-1 mb-0 small">Product label</p>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="new" name="label" class="custom-control-input" value="new" @if(old('label')) checked @endif required>
                                                    <label class="custom-control-label" for="new">New product</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control">
                                                    <input type="radio" id="sale" name="label" class="custom-control-input" value="sale" @if(old('label')) checked @endif required>
                                                    <label class="custom-control-label" for="sale">Sale product</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label></label>
                                                    <input type="number" name="base_price" class="form-control @error('base_price') is-invalid @enderror" placeholder="Base price *" aria-label required>

                                                    @error('base_price')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <label></label>
                                                    <input type="number" name="discount" max="99" min="0" class="form-control" placeholder="Discount %" aria-label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label></label>
                                            <div class="custom-file">
                                                <input type="file" name="main_image" class="custom-file-input @error('main_image') is-invalid @enderror" accept="image/png,image/jpg,image/jpeg" required>
                                                @error('main_image')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                                <label class="custom-file-label">Choose image</label>
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label></label>
                                            <input type="text" name="keywords" class="form-control" placeholder="Enter product keywords" aria-label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="font-weight-bold"></label>
                                        <textarea id="description" name="description" cols="30" rows="7" class="form-control" placeholder="Your product description..." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                            <label class="custom-control-label" for="is_featured">Featured</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Insert Product</button>
                                    <img class="d-none loader_gif" src="{{ asset('/images/loaders/Gear-0.2s-200px.gif') }}" alt="loader.gif">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Products<span class="badge badge-primary badge-pill">{{ tableCount()['products'] }}</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    End Insert Card    -->
    </div>

@endsection
