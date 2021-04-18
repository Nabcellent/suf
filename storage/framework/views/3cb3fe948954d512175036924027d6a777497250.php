<?php $__env->startSection('content'); ?>


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

                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo e($attribute['name']); ?></td>
                                    <td>
                                        <?php echo e($attribute['values']); ?>

                                    </td>
                                    <td class="action">
                                        <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                        <a href="#" class="ml-3" title="Remove"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
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
                        <button class="btn btn-info" data-toggle="modal" data-target="#brand">Add Brand</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="brands_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number of products</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($brand['name']); ?></td>
                                        <td><?php echo e($brand['products_count']); ?></td>
                                        <td class="action">
                                            <a href="#" class="mx-2 update_brand" title="Modify" data-toggle="modal" data-target="#brand"
                                               data-id="<?php echo e($brand['id']); ?>" data-name="<?php echo e($brand['name']); ?>">
                                                <i class="fas fa-pen text-dark"></i>
                                            </a>
                                            <a href="#" class="mr-1 delete_brand" data-id="<?php echo e($brand['id']); ?>"
                                               data-toggle="modal" data-target="#delete_brand_modal" title="Remove">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                            <?php if($brand['status']): ?>
                                                <a class="update_brand_status mr-4" data-id="<?php echo e($brand['id']); ?>" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            <?php else: ?>
                                                <a class=" update_brand_status mr-2" data-id="<?php echo e($brand['id']); ?>" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('Admin.products.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/products/attributes.blade.php ENDPATH**/ ?>