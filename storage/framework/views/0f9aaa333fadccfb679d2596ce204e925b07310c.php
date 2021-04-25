<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
    <div class="row">
        <div class="col-9">
            <div class="card crud_table shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sellers</h6>
                    <a href="<?php echo e(route('admin.user', ['user' => 'Seller'])); ?>" class="btn btn-outline-info">Add Seller</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover crud_table" id="sellers_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>username</th>
                                <th>email</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(tableCount()['sellers'] > 0): ?>
                                <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <?php if(isset($seller['user']['image'])): ?>
                                            <td><img src="<?php echo e(asset('/images/users/profile/' . $seller['user']['image'])); ?>" alt="profile" class="img-fluid"></td>
                                        <?php else: ?>
                                            <td><img src="<?php echo e(asset('/images/general/NO-IMAGE.png')); ?>" alt="profile" class="img-fluid"></td>
                                        <?php endif; ?>
                                        <td><?php echo e($seller['user']['first_name']); ?></td>
                                        <td><?php echo e($seller['user']['last_name']); ?></td>
                                        <td><?php echo e($seller['username']); ?></td>
                                        <td><?php echo e($seller['user']['email']); ?></td>
                                        <td><?php echo e($seller['user']['primary_phone']['phone']); ?></td>
                                        <td class="text-primary"><?php echo e($seller['user']['products_count']); ?></td>
                                        <td style="font-size: 14pt">

                                            <?php if($seller['user']['status']): ?>
                                                <a class="update_status" data-id="<?php echo e($seller['user_id']); ?>" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            <?php else: ?>
                                                <a class="update_status" data-id="<?php echo e($seller['user_id']); ?>" data-model="User" title="Update Status"
                                                   style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            <?php endif; ?>

                                        </td>
                                        <td class="action">
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="<?php echo e($seller['user_id']); ?>" data-model="User">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

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
                        <a href="<?php echo e(route('admin.admins')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Admins<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['admins']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.customers')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Customers<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['customers']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.products')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Products<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['products']); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Users/sellers.blade.php ENDPATH**/ ?>