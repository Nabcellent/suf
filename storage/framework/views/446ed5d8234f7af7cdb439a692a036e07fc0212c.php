<?php $__env->startSection('content'); ?>

    <div id="add_product" class="container-fluid p-0">

    <!--    Start Insert Card    -->
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="card shadow crud_form">
                        <form id="frm_add_product" action="<?php echo e(route('admin.create-product')); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-header crud_form">
                                <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Add Product</h4>
                                <div class="dropdown no-arrow">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Order Options</div>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.products')); ?>">View Products</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body crud_form">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="text" name="title" class="form-control mt-2 crud_form"
                                               placeholder="Enter product title *" aria-label>
                                    </div>
                                    <div class="form-group col">
                                        <select id="select_brand" name="brand_id" class="mt-2 form-control crud_form" aria-label required>
                                            <option selected hidden value="">Select a brand*</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label></label>
                                        <select id="sellers" name="seller" class="form-control crud_form" aria-label required>
                                            <option selected hidden value="">Select a seller*</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label></label>
                                        <select id="categories" class="form-control crud_form" name="category" aria-label required>
                                            <option selected hidden value="">Select a category *</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label></label>
                                        <select id="sub_categories" class="form-control crud_form" name="sub_category" aria-label required>
                                            <option selected hidden value="">Select a sub-category *</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <p class="mt-1 mb-0 small">Product label</p>
                                        <div class="custom-control custom-radio custom-control">
                                            <input type="radio" id="new" name="label" class="custom-control-input" value="new">
                                            <label class="custom-control-label crud_form" for="new">New product</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control">
                                            <input type="radio" id="sale" name="label" class="custom-control-input" value="sale">
                                            <label class="custom-control-label crud_form" for="sale">Sale product</label>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label></label>
                                                <input type="number" name="base_price" class="form-control crud_form" placeholder="Base price *" aria-label required>
                                            </div>
                                            <div class="form-group col">
                                                <label></label>
                                                <input type="number" name="discount" max="99" min="0" class="form-control crud_form" placeholder="Discount %" aria-label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label></label>
                                        <div class="custom-file">
                                            <input type="file" name="main_image" class="custom-file-input crud_form" required>
                                            <label class="custom-file-label crud_form file">Choose image</label>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label></label>
                                        <input type="text" name="keywords" class="form-control crud_form" placeholder="Enter product keywords" aria-label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold"></label>
                                    <textarea id="description" name="description" cols="30" rows="7" class="form-control crud_form" placeholder="Your product description..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="featured" name="featured">
                                        <label class="custom-control-label" for="featured">Featured</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Insert Product</button>
                                <img class="d-none loader_gif" src="<?php echo e(asset('/images/loaders/Gear-0.2s-200px.gif')); ?>" alt="loader.gif">
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
                        <a href="<?php echo e(route('admin.products')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            All Products<span class="badge badge-primary badge-pill">14</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Orders<span class="badge badge-primary badge-pill">7</span>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/products/create.blade.php ENDPATH**/ ?>