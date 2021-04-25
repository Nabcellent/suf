<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Orders</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="orders_table">
                                <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Pay Method</th>
                                    <th scope="col">Pay Type</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th><?php echo e($order['id']); ?></th>
                                    <td><?php echo e($order['phone']['phone']); ?></td>
                                    <td><?php echo e($order['payment_method']); ?></td>
                                    <td><?php echo e($order['payment_type']); ?></td>
                                    <td><?php echo e($order['discount']); ?></td>
                                    <td><?php echo e($order['total']); ?></td>
                                    <td><?php echo e($order['status']); ?></td>
                                    <td><?php echo e(date('d~m~y', strtotime($order['created_at']))); ?></td>
                                    <td class="action" style="background-color: #1a202c">
                                        <a href="<?php echo e(route('admin.order', ['id' => $order['id']])); ?>" class="ml-2" title="view Order">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        <?php if($order['tracking_number']): ?>
                                            <a href="<?php echo e(route('admin.invoice', ['id' => $order['id']])); ?>" class="ml-2" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice text-warning"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.invoice-pdf', ['id' => $order['id']])); ?>" class="ml-2" title="GENERATE PDF">
                                                <i class='fas fa-file-pdf text-white'></i>
                                            </a>
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
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="<?php echo e(route('admin.create.product')); ?>" class="list-group-item list-group-item-action">
                                Create Product
                            </a>
                            <a href="<?php echo e(route('admin.products')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">14</span>
                            </a>
                            <a href="<?php echo e(route('admin.categories')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Categories<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['categories']); ?></span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['qtySold']); ?></span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Orders/list.blade.php ENDPATH**/ ?>