<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Administrators</h6>
                        <a href="<?php echo e(route('admin.user', ['user' => 'Admin'])); ?>" class="btn btn-outline-info">Add Admin</a>
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
                                    <th>email</th>
                                    <th>Phone</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if(tableCount()['admins'] > 0): ?>
                                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <?php if(isset($admin['user']['image'])): ?>
                                                <td><img src="<?php echo e(asset('/images/users/profile/' . $admin['user']['image'])); ?>" alt="profile" class="img-fluid"></td>
                                            <?php else: ?>
                                                <td><img src="<?php echo e(asset('/images/general/NO-IMAGE.png')); ?>" alt="profile" class="img-fluid"></td>
                                            <?php endif; ?>
                                            <td><?php echo e($admin['user']['first_name']); ?></td>
                                            <td><?php echo e($admin['user']['last_name']); ?></td>
                                            <td><?php echo e($admin['user']['email']); ?></td>
                                            <td><?php echo e($admin['user']['primary_phone']['phone']); ?></td>
                                            <td><?php echo e(date('d.m.Y', strtotime($admin['user']['created_at']))); ?></td>
                                            <td style="font-size: 14pt">

                                                <?php if($admin['user']['status']): ?>
                                                    <a class="update_status" data-id="<?php echo e($admin['user_id']); ?>" data-model="USer" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                <?php else: ?>
                                                    <a class="update_status" data-id="<?php echo e($admin['user_id']['id']); ?>" data-model="USer" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                <?php endif; ?>

                                            </td>
                                            <td class="action">
                                                <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                                <a href="#" class="ml-3 delete-from-table" title="Remove" data-id="<?php echo e($admin['user_id']); ?>" data-model="USer">
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
                            <a href="<?php echo e(route('admin.sellers')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Sellers<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['sellers']); ?></span>
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

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Users/admins.blade.php ENDPATH**/ ?>