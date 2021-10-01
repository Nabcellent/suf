<!--#################################################    VIEW MODALS   ##############################################-->
@isset($product)
    <!--&&&===    ADD VARIATION MODAL    ===&&&-->
    <div class="modal fade" id="create_variation" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="create_variation" action="{{ route('admin.create.variation', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Variation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <small>Attribute</small>
                            <select class="form-control" id="attribute" name="attribute" style="width: 100%" aria-label="" required>
                                <option selected hidden value="">Select an attribute</option>
                                @foreach($attributes as $attr)
                                    <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <small>Value(s)</small>
                            <select id="select-values" name="options[]" multiple aria-label="" placeholder="Select or create options" required></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--&&&===    ADD VARIATION MODAL    ===&&&-->
    <div class="modal fade" id="create_variation_option" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="create_variation_option" action="{{ route('admin.create.variation-option') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Variation Option</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Option name</label>
                            <input type="text" name="variant" class="form-control" placeholder="Enter Option" aria-label autofocus required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="">Stock</label>
                                <input type="number" name="stock" step="1" class="form-control" placeholder="Enter Stock" aria-label required>
                            </div>
                            <div class="form-group col">
                                <label for="">Extra Price(if any)</label>
                                <input type="number" name="extra_price" class="form-control" placeholder="Enter extra price" aria-label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="variation_id" id="variation_id">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
                <form action="{{ route('admin.update.extra-price', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Extra Price</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="number" name="price" class="form-control" placeholder="Enter price" aria-label autofocus required>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="variation_id">
                        <input type="hidden" name="option">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
                <form action="{{ route('admin.update.stock', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="number" name="stock" class="form-control" placeholder="Enter stock amount" aria-label>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="variation_id">
                        <input type="hidden" name="option">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
                <form id="create_product_image" action="{{ route('admin.create.product-image', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Image(s)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="images" class="form-label">Browse image(s)</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple accept="image/png,image/jpg,image/jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endisset



<!--#################################################    ATTRIBUTE MODALS    #########################################-->

<!--&&&===    CREATE ATTRIBUTE    ===&&&-->
<div class="modal fade" id="attr" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="upsert_attr" action="{{ route('admin.attr.attribute.upsert') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <small>Title</small>
                        <input type="text" class="form-control" name="name" aria-label required>
                    </div>
                    <div class="form-group">
                        <small>Values</small>
                        <select id="select-values" name="values[]" multiple aria-label="">
                            <option>orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn_attr">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--&&&===    CREATE BRAND    ===&&&-->
<div class="modal fade" id="brand" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create_brand" action="{{ route('admin.attr.brand.upsert') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Brand</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn_update_brand" class="btn btn-primary">Insert</button>
                </div>
            </form>
        </div>
    </div>
</div>
