<!--#################################################    VIEW MODALS   ##############################################-->

<!--&&&===    DELETE PRODUCT    ===&&&-->
<div class="modal fade" id="delete_product_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.delete.product') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <p class="small text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" id="image_name" name="image_name">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--#################################################    PRODUCTS MODALS    #########################################-->

<!--&&&===    EDIT PRODUCT TABLE    ===&&&-->
@isset($product)
    <div class="modal fade" id="edit_product_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url()->current() }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="mb-0">Title</label>
                                <input type="text" name="title" class="form-control crud_form" value="{{ $product['title'] }}"
                                       placeholder="Title" aria-label>
                            </div>
                            <div class="form-group col">
                                <label class="mb-0">Label</label>
                                <input type="text" name="label" class="form-control crud_form" value="{{ $product['label'] }}"
                                       placeholder="Label" aria-label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="mb-0">Seller</label>
                                <select id="sellers" name="seller" class="form-control @error('seller') is-invalid @enderror crud_form" aria-label required>
                                    <option selected hidden value="">Select a seller*</option>
                                    @foreach($sellers as $seller)
                                        <option @if($seller['id'] === $product['seller_id']) selected @endif value="{{ $seller['id'] }}">{{ $seller['username'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label class="mb-0">Category</label>
                                <select id="categories" class="form-control @error('category') is-invalid @enderror crud_form" name="sub_category" aria-label required>
                                    <option selected hidden value="">Select a category *</option>
                                    @foreach($sections as $section)
                                        <optgroup label="{{ $section['title'] }}"></optgroup>
                                        @foreach($section['categories'] as $category)
                                            <optgroup label=" &nbsp;&nbsp;&nbsp;&nbsp; {{ $category['title'] }}"></optgroup>
                                            @foreach($category['sub_categories'] as $subCat)
                                                <option @if($subCat['id'] === $product['category_id']) selected @endif value="{{ $subCat['id'] }}"> &nbsp;&nbsp;&nbsp;&nbsp; ------ {{ $subCat['title'] }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="mb-0">Brand</label>
                                <select name="brand" class="mt-2 form-control @error('brand') is-invalid @enderror crud_form" aria-label required>
                                    <option selected hidden value="">Select a brand*</option>
                                    @foreach($brands as $brand)
                                        <option @if($brand['id'] === $product['brand_id']) selected @endif value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label class="mb-0">Keywords</label>
                                <input type="text" name="keywords" class="form-control crud_form" value="{{ $product['keywords'] }}"
                                       placeholder="Keywords" aria-label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="mb-0">Base Price</label>
                                <input type="number" name="base_price" class="form-control crud_form" value="{{ $product['base_price'] }}"
                                       placeholder="Base price" aria-label>
                            </div>
                            <div class="form-group col">
                                <label class="mb-0">Discount (%)</label>
                                <input type="number" name="discount" max="99" min="0" class="form-control crud_form" value="{{ $product['discount'] }}"
                                       placeholder="Discount" aria-label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-0">Description</label>
                            <textarea  name="description" class="form-control crud_form"
                                       rows="4" placeholder="Description..." aria-label>{{ $product['description'] }}"</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" @if($product['is_featured'] === 'Yes') checked @endif>
                                <label class="custom-control-label" for="is_featured">Featured</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!--&&&===    ADD VARIATION MODAL    ===&&&-->
    <div class="modal fade" id="add_variation" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.create.variation', ['id' => $product['id']]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Variation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            Attribute
                            <select class="form-control" id="attribute" name="attribute" style="width: 100%" aria-label required>
                                <option selected hidden value="">Select an attribute</option>
                                @foreach($attributes as $attr)
                                    <option value="{{ $attr['id'] }}">{{ $attr['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            Value(s)
                            <select class="variation form-control" id="values_s2" name="variation_options[]" style="width: 100%" aria-label>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--&&&===    SET PRICE MODAL    ===&&&-->
    <div class="modal fade" id="set_price" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.update.extra-price', ['id' => $product['id']]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Extra Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="number" name="price" class="form-control" placeholder="Enter price" aria-label autofocus required>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="variation_option_id">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--&&&===    SET STOCK MODAL    ===&&&-->
    <div class="modal fade" id="set_stock" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.update.stock', ['id' => $product['id']]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="number" name="stock" class="form-control" placeholder="Enter stock amount" aria-label>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="variation_option_id">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--&&&===    ADD IMAGE MODAL    ===&&&-->
    <div class="modal fade" id="add_image_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.create.product-image', ['id' => $product['id']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Image(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" multiple="" name="images[]" class="custom-file-input crud_form"  accept=".jpg,.png,.jpeg,image/*" required>
                                <label class="custom-file-label crud_form file">Choose image(s)</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endisset



<!--#################################################    ATTRIBUTE MODALS    #########################################-->

<!--&&&===    CREATE ATTRIBUTE    ===&&&-->
<div class="modal fade" id="add_attribute" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.create.attribute') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" aria-label required>
                    </div>
                    <div class="form-group">
                        <select class="form-control variation" name="values" multiple="multiple" style="width: 100%" aria-label>
                            <option>orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--&&&===    CREATE BRAND    ===&&&-->
<div class="modal fade" id="brand" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create_brand" action="{{ route('admin.create.brand') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Brand name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-label required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="brand_id" id="brand_id">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_update_brand" class="btn btn-primary">Insert</button>
                </div>
            </form>
        </div>
    </div>
</div>
