<?php $__env->startSection('content'); ?>
    <div id="products" class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Products</h6>
                        <a href="<?php echo e(route('admin.create-product')); ?>" class="btn btn-info">Add Product</a>
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

                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <td><img src="<?php echo e(asset('/images/products/' . $item['main_image'])); ?>" alt="product" class="img-fluid"></td>
                                        <td class="title"><?php echo e($item['title']); ?></td>
                                        <td><?php echo e($item['seller']['username']); ?></td>
                                        <td class="text-nowrap"><?php echo e(date('d.m.Y', strtotime($item['created_at']))); ?></td>
                                        <td class="text-center"><?php echo e($item['base_price']); ?></td>
                                        <td class="text-center"><?php echo e($item['discount']); ?>%</td>
                                        <td><?php echo e($item['label']); ?></td>
                                        <td class="text-center"> wait </td>
                                        <td class="text-center" style="font-size: 14pt">
                                            <?php if($item['status']): ?>
                                                <a class="update_product_status" data-id="<?php echo e($item['id']); ?>" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            <?php else: ?>
                                                <a class="update_product_status" data-id="<?php echo e($item['id']); ?>" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action">
                                            <a href="<?php echo e(url('/admin/product/' . $item['id'])); ?>" class="ml-2" title="view">
                                                <i class="fas fa-eye text-info"></i>
                                            </a>
                                            <a href="#" class="ml-2 delete_product" data-toggle="modal" data-id="<?php echo e($item['id']); ?>"
                                               data-target="#delete_product_modal" title="Remove">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
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

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/products/list.blade.php ENDPATH**/ ?>