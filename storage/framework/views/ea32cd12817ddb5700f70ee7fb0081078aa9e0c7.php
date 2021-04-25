<?php $__env->startSection('content'); ?>

    <div id="coupon-view" class="container-fluid p-0">

        <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="card shadow">
                            <form id="coupon-form" action="<?php echo e(url()->current()); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($coupon)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> <?php echo e($title); ?></h4>
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
                                <div class="card-body">
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul class="m-0">
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Option</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="automatic" name="option" class="custom-control-input <?php $__errorArgs = ['Automatic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                       value="Automatic" <?php if(isset($coupon)): ?> disabled <?php endif; ?> checked required>
                                                <label class="custom-control-label" for="automatic">Automatic</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="manual" name="option" class="custom-control-input <?php $__errorArgs = ['Automatic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="Manual"
                                                       <?php if(isset($coupon)): ?> disabled <?php echo e($coupon['option'] === 'Manual' ? 'checked' : ''); ?> <?php endif; ?> required>
                                                <label class="custom-control-label" for="manual">Manual</label>
                                            </div>
                                        </div>
                                        <div class="form-group col" id="coupon-code-field" <?php if(isset($coupon)): ?> disabled <?php else: ?> style="display: none" <?php endif; ?> >
                                            <label for="">Code</label>
                                            <input type="text" name="code" class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter coupon code" <?php if(isset($coupon)): ?> disabled <?php endif; ?>
                                            value="<?php if(isset($coupon)): ?> <?php echo e($coupon['code']); ?> <?php endif; ?>" aria-label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Select Categories</label>
                                            <select class="form-control <?php $__errorArgs = ['categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="categories_s2" name="categories[]" multiple="multiple" style="width: 100%" aria-label>
                                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <optgroup label="<?php echo e($section['title']); ?>"></optgroup>
                                                    <?php $__currentLoopData = $section['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category['id']); ?>" <?php if(isset($coupon) && in_array($category['id'], explode(',', $coupon['categories']), false)): ?> selected <?php endif; ?> >
                                                            &nbsp; <?php echo e($category['title']); ?>

                                                        </option>
                                                        <?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($subCategory['id']); ?>" <?php if(isset($coupon) && in_array($subCategory['id'], explode(',', $coupon['categories']), false)): ?> selected <?php endif; ?> >
                                                                &nbsp; -- <?php echo e($subCategory['title']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Select Users</label>
                                            <select class="form-control <?php $__errorArgs = ['users'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" name="users[]" multiple="multiple" style="width: 100%" aria-label>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user['email']); ?>" <?php if(isset($coupon) && in_array($user['email'], explode(',', $coupon['users']), false)): ?> selected <?php endif; ?> >
                                                        &nbsp; <?php echo e($user['email']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Coupon Type</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="multiple" name="coupon_type" class="custom-control-input"  value="Multiple" checked required>
                                                <label class="custom-control-label" for="multiple">Multiple</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="single" name="coupon_type" class="custom-control-input" <?php if(old('gender')): ?> checked <?php endif; ?> value="Single"
                                                       <?php if(isset($coupon)): ?> <?php echo e($coupon['coupon_type'] === 'Single' ? 'checked' : ''); ?> <?php endif; ?> required>
                                                <label class="custom-control-label" for="single">Single</label>
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label>Amount Type</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="percent" name="amount_type" class="custom-control-input" value="Percent" checked required>
                                                <label class="custom-control-label" for="percent">Percentage (%)</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="fixed" name="amount_type" class="custom-control-input" <?php if(old('gender')): ?> checked <?php endif; ?> value="Fixed"
                                                       <?php if(isset($coupon)): ?> <?php echo e($coupon['amount_type'] === 'Fixed' ? 'checked' : ''); ?> <?php endif; ?> required>
                                                <label class="custom-control-label" for="fixed">Fixed (in KSH)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Amount</label>
                                            <input type="number" name="amount" class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter coupon amount" aria-label required
                                                   value="<?php if(isset($coupon)): ?><?php echo e($coupon['amount']); ?><?php endif; ?>">
                                        </div>
                                        <div class="form-group col">
                                            <label>Expiry Date</label>
                                            <input type="date" class="form-control <?php $__errorArgs = ['expiry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="expiry" placeholder="Enter expiry date" min="2021-01-01" max="2021-12-31" required
                                                   value="<?php if(isset($coupon)): ?><?php echo e($coupon['expiry']); ?><?php endif; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> <?php echo e($title); ?></button>
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
                            <a href="<?php echo e(route('admin.coupons')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Coupons List<span class="badge badge-primary badge-pill">14</span>
                            </a>
                            <?php if(isset($coupon)): ?>
                                <a href="<?php echo e(route('admin.coupon')); ?>" class="list-group-item list-group-item-action">Create Coupon</a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.customers')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Customers<span class="badge badge-primary badge-pill">14</span>
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

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Coupons/view.blade.php ENDPATH**/ ?>