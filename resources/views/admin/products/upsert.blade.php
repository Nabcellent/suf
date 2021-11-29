@extends('admin.layouts.app')
@section('title', (empty($product) ? 'Create' : 'Update') . ' Product')
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/TomSelect/tom-select.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}">
        <link href="{{ asset('vendor/filepond/style.css') }}" rel="stylesheet"/>
        <link href="{{ asset('vendor/filepond/plugin-image-preview.css') }}" rel="stylesheet"/>
    @endpush
@endonce
@section('content')

    <div id="add_product" class="container-fluid p-0">

        <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-12 col-md-10">
                <form class="row" id="create_product"
                      action="{{ empty($product) ? route('admin.product.store') : route('admin.product.update', ['id' => $product->id]) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @isset($product) @method('PUT') @endisset
                    <div class="col-lg-9 col-md-12">

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><small>{{ $error }}</small></li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close pt-2" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body shadow">
                            <div class="card-header">
                                <h5 class="m-0 font-weight-bold">
                                    <i class="fab fa-opencart"></i> {{ empty($product) ? 'Create' : 'Update' }} Product
                                </h5>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col">
                                    <small>Title</small>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror "
                                           placeholder="Enter product title *" aria-label
                                           value="{{ old('title', $product->title ?? '') }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <small>Brand</small>
                                    <select id="select-brand" class="is-invalid @error('brand') is-invalid @enderror"
                                            placeholder="Product brand..."
                                            autocomplete="on" name="brand" required>
                                        <option value=""></option>
                                        @foreach($brands as $brand)
                                            <option @if($brand->id === ($product->brand_id ?? old('brand'))) selected
                                                    @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                @if(isSeller())
                                    <input type="hidden" name="seller" value="{{ Auth::id() }}">
                                @else
                                    <div class="form-group col">
                                        <small>Seller</small>
                                        <select id="sellers" name="seller"
                                                class="form-control @error('seller') is-invalid @enderror"
                                                aria-label="" required>
                                            <option hidden value="">Select a seller*</option>
                                            @foreach($sellers as $seller)
                                                <option
                                                    @if($seller->user_id === ($product->seller_id ?? old('seller'))) selected
                                                    @endif value="{{ $seller->user_id }}">{{ $seller->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('seller')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group col">
                                    <small>Category</small>
                                    <select id="categories" class="form-control @error('category') is-invalid @enderror"
                                            name="category"
                                            aria-label="" required>
                                        <option selected hidden value="">Select a category *</option>
                                        @foreach($sections as $section)
                                            @if(count($section->categories))
                                                <optgroup label="{{ $section->title }}"></optgroup>
                                                @foreach($section->categories as $category)
                                                    <option
                                                        @if($category->id === ($product->subCategory->category->id ?? old('category'))) selected
                                                        @endif value="{{ $category->id }}"> &nbsp;
                                                        --- {{ $category->title }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <small>Sub category</small>
                                    <select id="sub_categories"
                                            class="form-control @error('sub_category') is-invalid @enderror"
                                            name="sub_category" aria-label="" required>
                                        @isset($subCategories)
                                            @foreach($subCategories as $sub)
                                                <option
                                                    @if($sub->id === ($product->category_id ?? old('sub_category'))) selected
                                                    @endif value="{{ $sub->id }}">{{ $sub->title }}</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="">Select a sub-category *</option>
                                        @endisset
                                    </select>
                                    @error('sub_category')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col">
                                    <small>Initial price</small>
                                    <input type="number" name="base_price"
                                           value="{{ old('base_price', $product->base_price ?? '') }}"
                                           class="form-control @error('base_price') is-invalid @enderror"
                                           placeholder="Base price *"
                                           aria-label required>

                                    @error('base_price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <small>Discount (%)</small>
                                    <input type="number" name="discount" max="99" min="0" class="form-control"
                                           value="{{ old('discount', $product->discount ?? '') }}"
                                           placeholder="Discount %" aria-label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <small>Label</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="new" name="label" value="new"
                                               @if(old('label') === 'new') checked @endif>
                                        <label class="form-check-label" for="new">
                                            New product
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="sale" name="label" value="sale"
                                               @if(old('label') === 'sale') checked @endif>
                                        <label class="form-check-label" for="sale">
                                            Sale product
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <small>Is this a featured product?</small>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_featured"
                                               name="is_featured" value="true">
                                        <label class="form-check-label" for="is_featured">Is featured</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col">
                                    <small>Stock</small>
                                    <input type="number" name="stock" max="99" min="1"
                                           value="{{ old('stock', $product->stock ?? '') }}"
                                           class="form-control"
                                           placeholder="Total stock" aria-label>
                                </div>
                                <div class="form-group col">
                                    <small>Keywords</small>
                                    <input type="text" name="keywords" class="form-control"
                                           value="{{ old('keywords', $product->keywords ?? '') }}"
                                           placeholder="Product keywords" aria-label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <small>Description</small>
                                <input id="description" value="{{ old('description', $product->description ?? '') }}"
                                       type="hidden"
                                       name="description" required>
                                <trix-editor input="description" placeholder="Product description..."></trix-editor>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-outline-primary"><i
                                        class="fas fa-plus-circle"></i> {{ empty($product) ? 'Create' : 'Update' }}
                                </button>
                                <img class="d-none loader_gif" src="{{ asset('/images/loaders/Gear-0.2s-200px.gif') }}"
                                     alt="loader.gif">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="card-body shadow row">
                            <div class="form-group col">
                                <input type="file" id="image" name="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       accept="image/png,image/jpg,image/jpeg">
                                @error('image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-2">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.product.index') }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Products<span
                                    class="badge badge-primary badge-pill">{{ tableCount('products') }}</span>
                            </a>
                            <a href="#"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount('orders') }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a href="{{ route('admin.categories.upsert') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Create Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    End Insert Card    -->
    </div>

    <script src="{{ asset('vendor/TomSelect/tom-select.js') }}"></script>
    <script src="{{ asset('vendor/trix/trix.js') }}"></script>
    <script src="{{ asset('vendor/filepond/plugins/image-preview.js') }}"></script>
    <script src="{{ asset('vendor/filepond/plugins/image-resize.js') }}"></script>
    <script src="{{ asset('vendor/filepond/plugins/file-validate-type.js') }}"></script>
    <script src="{{ asset('vendor/filepond/plugins/file-rename.js') }}"></script>
    <script src="{{ asset('vendor/filepond/index.min.js') }}"></script>
    <script>
        new TomSelect("#select-brand", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginFileValidateType,
            FilePondPluginFileRename,
        );

        const inputElement = document.getElementById('image');
        const pond = FilePond.create(inputElement, {
            labelIdle: `Drag & Drop your product's image or <span class="filepond--label-action"> Browse </span>`,
            acceptedFileTypes: ['image/jpg', 'image/png', 'image/jpeg'],
            instantUpload: false,
            storeAsFile: true,
            imageResizeMode: 'cover',
            imageResizeTargetWidth: 300,
            imageResizeTargetHeight: 300,
            dropOnPage: true
        });

        if ({{ isset($product->image) && file_exists(public_path("images/products/" . ($product->image ?? 0))) ?: '0' }})
            pond.addFile(`{{ asset("images/products/" . ($product->image ?? '')) }}`);
    </script>

@endsection
