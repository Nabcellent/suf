<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Coupons</h6>
                        <a href="<?php echo e(route('admin.coupon')); ?>" class="btn btn-info">Add Coupon</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover crud_table" id="coupons_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Option</th>
                                    <th scope="col">Coupon Type</th>
                                    <th scope="col">Amount Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">expiry</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th></th>
                                        <td><?php echo e($coupon['code']); ?></td>
                                        <td><?php echo e($coupon['option']); ?></td>
                                        <td><?php echo e($coupon['coupon_type']); ?></td>
                                        <td><?php echo e($coupon['amount_type']); ?></td>
                                        <td><?php echo e($coupon['amount']); ?> <?php echo e(($coupon['code'] === "Percent") ? "%" : "/="); ?></td>
                                        <td><?php echo e(date('m-d-Y', strtotime($coupon['expiry']))); ?></td>
                                        <td class="action">
                                            <?php if($coupon['status']): ?>
                                                <a class="update_coupon_status" data-id="<?php echo e($coupon['id']); ?>" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            <?php else: ?>
                                                <a class="update_coupon_status" data-id="<?php echo e($coupon['id']); ?>" title="Update Status"
                                               style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            <?php endif; ?>

                                            <a href="<?php echo e(route('admin.coupon', ['id' => $coupon['id']])); ?>" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" data-model="coupon" data-id="<?php echo e($coupon['id']); ?>" title="Remove"><i class="fas fa-trash text-danger"></i></a>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Coupons/list.blade.php ENDPATH**/ ?>