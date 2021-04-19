<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <div class="card crud_table shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Administrators</h6>
                        <a href="<?php echo e(route('admin.user', ['user' => 'Seller'])); ?>" class="btn btn-outline-info">Add Admin</a>
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
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td></td>
                                        <?php if(isset($admin['image'])): ?>
                                            <td><img src="<?php echo e(asset('/images/users/seller/' . $admin['image'])); ?>" alt="profile" class="img-fluid"></td>
                                        <?php else: ?>
                                            <td><img src="<?php echo e(asset('/images/general/NO-IMAGE.png')); ?>" alt="profile" class="img-fluid"></td>
                                        <?php endif; ?>
                                        <td><?php echo e($admin['first_name']); ?></td>
                                        <td><?php echo e($admin['last_name']); ?></td>
                                        <td><?php echo e($admin['username']); ?></td>
                                        <td><?php echo e($admin['email']); ?></td>
                                        <td><?php echo e($admin['primary_phone']['phone']); ?></td>
                                        <td><?php echo e(date('d.m.Y', strtotime($admin['created_at']))); ?></td>
                                        <td class="action">
                                            <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                            <a href="#" class="ml-3 delete_user" title="Remove" data-id="<?php echo e($admin['id']); ?>">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Users/admins.blade.php ENDPATH**/ ?>