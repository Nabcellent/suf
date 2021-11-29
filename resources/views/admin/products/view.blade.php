@extends('admin.layouts.app')
@section('title', $product->title)
@once
    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('vendor/TomSelect/tom-select.css') }}">
    @endpush
@endonce
@section('content')

    <div id="v-product" class="container-fluid px-0">
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
                                <div class="card bg-dark text-white crud_table shadow mb-4">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Product Details
                                        </h6>
                                        <div>
                                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                               class="btn btn-outline-light"
                                               title="Edit">
                                                <i class="fas fa-pen text-success"></i>
                                            </a>
                                            <a href="#" class="ms-2 btn btn-outline-red delete-from-table"
                                               data-id="{{ $product->id }}"
                                               data-model="Product" title="Remove">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                @if(isset($product->image) && file_exists(public_path("/images/products/{$product->image}")))
                                                    <img src="{{ asset('/images/products/' . $product->image) }}"
                                                         alt="Main Image" class="img-fluid"
                                                         style="width: 15rem;">
                                                @else
                                                    <img src="{{ asset('/images/general/cart.jpg') }}" alt="Main image"
                                                         class="img-fluid"
                                                         style="width: 15rem;">
                                                @endif
                                                <h5 class="card-title pt-2">{{ $product->title }}</h5>
                                            </div>
                                            <div class="col">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-sm table-borderless text-info">
                                                                <tbody>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Category</th>
                                                                    <td class="py-0">{{ $product->subCategory->category->title }}
                                                                        - {{ $product->subCategory->title }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Seller</th>
                                                                    <td class="py-0">{{ $product->seller->admin->username }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Brand</th>
                                                                    <td class="py-0"
                                                                        colspan="2">{{ $product->brand->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Keywords</th>
                                                                    <td class="py-0"
                                                                        colspan="2">{{ $product->keywords }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Label</th>
                                                                    <td class="py-0"
                                                                        colspan="2">{{ $product->label }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Discount</th>
                                                                    <td class="py-0" colspan="2"
                                                                        style="color: white">{{ $product->discount ?? 0 }}%
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-0" scope="row">Base Price</th>
                                                                    <td class="py-0 font-weight-bolder text-warning"
                                                                        colspan="2">
                                                                        KSH {{ currencyFormat($product->base_price) }}/=
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            @if($product->is_featured)
                                                                <p class="m-0 text-info"> --- Featured ---</p>
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="m-0">Date Created:</p>
                                                                    <p class="m-0">Date Updated:</p>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="m-0">{{ date('M d, Y', strtotime($product->created_at)) }}</p>
                                                                    <p class="m-0">{{ date('M d, Y', strtotime($product->updated_at)) }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col">
                                                                    <h6 class="m-0">Description</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <p class="m-0">{!! $product->description !!}</p>
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
                                        <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-opencart"></i>
                                            Product Variations</h6>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#create_variation">Add
                                            Variation
                                        </button>
                                    </div>
                                    <div class="card-body pb-0">

                                        @if(count($product->variations) > 0)
                                            <table class="table table-sm mb-1">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Variation</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($product->variations as $variation)
                                                    <tr>
                                                        <td class="pb-0 pt-1">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">{{ $variation->attribute->name }}</th>
                                                                    <th scope="col">Stock</th>
                                                                    <th scope="col">Extra Cost</th>
                                                                    <th scope="col" colspan="2">Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($variation->options as $optionKey => $optionVal)
                                                                    <tr>
                                                                        <td class="d-flex">
                                                                            <div>
                                                                                <input type="text"
                                                                                       name="variation_option"
                                                                                       value="{{ $optionKey }}"
                                                                                       class="form-control form-control-sm"
                                                                                       data-option="{{ $optionKey }}"
                                                                                       data-id="{{ $variation->id }}"
                                                                                       style="max-width: 7rem">
                                                                                <input type="hidden"
                                                                                       id="current_variant_name"
                                                                                       value="{{ $optionKey }}">
                                                                                <span class="invalid-feedback"></span>
                                                                            </div>
                                                                            <img id="loader"
                                                                                 src="{{ asset('images/loaders/Gear-0.2s-200px.gif') }}"
                                                                                 alt=""
                                                                                 width="30" height="30">
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-4">{{ $optionVal['stock'] }}</div>
                                                                                <div class="col">
                                                                                    <a href="#"
                                                                                       data-id="{{ $variation->id }}"
                                                                                       class="stock"
                                                                                       data-option="{{ $optionKey }}"
                                                                                       data-bs-toggle="modal"
                                                                                       data-bs-target="#set_stock">set
                                                                                        stock</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-4">{{ currencyFormat($optionVal['extra_price']) }}
                                                                                    /-
                                                                                </div>
                                                                                <div class="col">
                                                                                    <a href="#"
                                                                                       data-id="{{ $variation->id }}"
                                                                                       data-option="{{ $optionKey }}"
                                                                                       class="extra_price"
                                                                                       data-bs-toggle="modal"
                                                                                       data-bs-target="#set_price">set
                                                                                        price</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td><a href="#"><i class="fas fa-pen-fancy"></i>
                                                                                Image</a></td>
                                                                        <td>
                                                                            @if($optionVal['status'])
                                                                                <a class="update_status"
                                                                                   data-id="{{ json_encode(['key' => $optionKey, 'id' => $variation->id]) }}"
                                                                                   data-model="Variations_Option"
                                                                                   title="Update Status"
                                                                                   style="cursor: pointer">
                                                                                    <i class="fas fa-toggle-on"
                                                                                       status="Active"></i>
                                                                                </a>
                                                                            @else
                                                                                <a class="update_status"
                                                                                   data-id="{{ json_encode(['key' => $optionKey, 'id' => $variation->id]) }}"
                                                                                   data-model="Variations_Option"
                                                                                   title="Update Status"
                                                                                   style="cursor: pointer">
                                                                                    <i class="fas fa-toggle-off"
                                                                                       status="Inactive"></i>
                                                                                </a>
                                                                            @endif

                                                                            <a href="#" class="delete-from-table ml-2"
                                                                               data-id="{{ $optionKey }}"
                                                                               data-model="Variation's Option">
                                                                                <i class="bx bxs-trash-alt"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="d-flex justify-content-between">
                                                            @if($variation['status'])
                                                                <h5>
                                                                    <a class="update_status"
                                                                       data-id="{{ $variation['id'] }}"
                                                                       data-model="Variation"
                                                                       title="Update Status" style="cursor: pointer">
                                                                        <i class="fas fa-toggle-on" status="Active"></i>
                                                                    </a>
                                                                </h5>
                                                            @else
                                                                <h5>
                                                                    <a class="update_status"
                                                                       data-id="{{ $variation['id'] }}"
                                                                       data-model="Variation"
                                                                       title="Update Status" style="cursor: pointer">
                                                                        <i class="fas fa-toggle-off"
                                                                           status="Inactive"></i>
                                                                    </a>
                                                                </h5>
                                                            @endif

                                                            <a href="#" class="attribute"
                                                               data-id="{{ $variation['id'] }}" data-bs-toggle="modal"
                                                               data-bs-target="#create_variation_option"
                                                               title="Add A {{ Str::singular(key($variation->options)) }}">
                                                                <h5><i class="fas fa-plus-circle pl-3"></i></h5>
                                                            </a>
                                                            <a href="#" class="delete-from-table"
                                                               data-id="{{ $variation['id'] }}"
                                                               data-model="Variation"><h5><i
                                                                        class="fas fa-trash pl-3"></i></h5></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        @else
                                            <div class="row my-5 justify-content-center">
                                                <div class="col-9 text-center">
                                                    <h6>This product has no variations.</h6>
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
                                    <a href="{{ route('admin.product.create') }}"
                                       class="list-group-item list-group-item-action">
                                        Create Product
                                    </a>
                                    <a href="{{ route('admin.coupon') }}"
                                       class="list-group-item list-group-item-action">
                                        Create Coupon
                                    </a>
                                    <a href="{{ route('admin.product.index') }}"
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        All Products<span
                                            class="badge bg-primary rounded-pill">{{ tableCount('products') }}</span>
                                    </a>
                                    <a href="{{ route('admin.orders') }}"
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Orders<span
                                            class="badge bg-primary rounded-pill">{{ tableCount('orders') }}</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Quantity Sold<span class="badge bg-primary rounded-pill">17</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Remaining stock<span class="badge bg-primary rounded-pill">37</span>
                                    </a>
                                    <a href="{{ route('admin.categories.index') }}"
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Categories<span
                                            class="badge bg-primary rounded-pill">{{ tableCount('categories') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="images row">
                    <div class="col-5 pr-md-1">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> Image List
                                </h6>
                                <button class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#add_image_modal">Upload
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($product['images']) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless table-hover crud_table"
                                               id="categories_table">
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
                                                    <td><img src="{{ asset('/images/products/' . $image['image']) }}"
                                                             alt="image" class="img-fluid">
                                                    </td>
                                                    <td class="action">

                                                        @if($image['status'])
                                                            <a class="update_status mr-4" data-id="{{ $image['id'] }}"
                                                               data-model="Product's Image"
                                                               title="Update Status"
                                                               style="cursor: pointer"><i class="fas fa-toggle-on"
                                                                                          status="Active"></i></a>
                                                        @else
                                                            <a class=" update_status mr-3" data-id="{{ $image['id'] }}"
                                                               data-model="Product's Image"
                                                               title="Update Status"
                                                               style="cursor: pointer"><i class="fas fa-toggle-off"
                                                                                          status="Inactive"></i></a>
                                                        @endif

                                                        <a href="#" class="delete-from-table"
                                                           data-id="{{ $image['id'] }}"
                                                           data-model="Product's Image"
                                                           data-image="{{ $image['image'] }}" title="Remove">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row my-5 justify-content-center">
                                        <div class="col-9 text-center">
                                            <h6>This product has no extra images yet.</h6>
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
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> Product
                                    Images</h6>
                            </div>
                            <div class="card-body">
                                @if(count($product->images) > 0)
                                    <div id="image-swiper" class="swiper">
                                        <div class="swiper-wrapper">
                                            @foreach($product->images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('/images/products/' . $image->image) }}"
                                                         alt="Product Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                @else
                                    <div class="row my-5 justify-content-center">
                                        <div class="col-9 text-center">
                                            <h6>This product has no extra images yet.</h6>
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

    @include('admin.products.modals')

    <script src="{{ asset('vendor/TomSelect/tom-select.js') }}"></script>
    <script>
        const attributeValues = new TomSelect("#select-values", {
            create: true,
            persist: true,
            delimiter: ',',
            hideSelected: true,
            selectOnTab: true,
            plugins: [
                'caret_position',
                'input_autogrow',
                'remove_button'
            ],
        });

        $('select#attribute').on('change', function () {
            $.ajax({
                data: {id: $(this).val()},
                type: 'POST',
                url: '/admin/get-attribute-values',
                success: response => {
                    const values = response.values.map(val => {
                        return {value: val, text: val}
                    })
                    attributeValues.clearOptions()
                    attributeValues.addOptions(values)
                },
                error: (error) => {
                    toast('Something went wrong', 'danger');
                    console.log(error);
                }
            });
        });

        /*_______   CHANGE VARIANT NAME    _______*/
        $(document).on('change', '#v-product td input[name="variation_option"]', function () {
            const option = $(this).next().val();
            const variationId = $(this).data('id');
            const variant = $(this).val();
            const loader = $(this).closest('td.d-flex').find($('img')).hide();

            $.ajax({
                data: {option, variant, variationId},
                url: '/admin/variation-option',
                type: 'PUT',
                beforeSend: () => {
                    loader.show();
                },
                statusCode: {
                    200: (response) => {
                        if (response.status) {
                            $(this).removeClass('is-invalid').addClass('is-valid');
                            $(this).val(response.newValue);
                            $(this).next().val(response.newValue)
                        } else {
                            if ($(this).val() === $('#current_variant_name').val()) {
                                $(this).removeClass('is-invalid').addClass('is-valid');
                            } else {
                                $(this).removeClass('is-valid').addClass('is-invalid');
                                $('#details td span.invalid-feedback').html(response.message);
                            }
                        }
                    },
                },
                complete: () => loader.hide(),
                error: () => {
                    alert('Error: Something went wrong!');
                },
            });
        });
    </script>

    @once
        @push('scripts')

            <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
            <script>
                new Swiper('#image-swiper', {
                    slidesPerView: 3,
                    loop: true,
                    spaceBetween: 30,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            </script>

        @endpush
    @endonce
@endsection
