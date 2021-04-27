<?php $__env->startSection('content'); ?>

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col-9 card pb-3">
                <div class="row my-2">
                    <div class="col">
                        <div class="card crud_table shadow-sm bg-dark">
                            <div class="card-header text-center"><a class="btn btn-info"><?php echo e($title); ?></a></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card crud_table shadow-sm">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Add Category</h6>
                            </div>
                            <div class="card-body">
                                <form id="add_category" action="<?php echo e(url()->current()); ?>" method="POST">
                                    <fieldset <?php if(isset($subCategory)): ?> disabled="disabled" <?php endif; ?>>
                                        <?php echo csrf_field(); ?>
                                        <?php if(isset($category)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control <?php $__errorArgs = ['category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="category_title"
                                                           value="<?php if(isset($category)): ?><?php echo e($category['title']); ?><?php endif; ?>" aria-label required autofocus>
                                                    <?php $__errorArgs = ['category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Discount</label>
                                                    <input type="number" class="form-control <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="0" max="99" name="discount"
                                                           value="<?php if(isset($category)): ?><?php echo e($category['discount']); ?><?php endif; ?>" aria-label>
                                                    <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="3" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" aria-label><?php if(isset($category)): ?><?php echo e($category['description']); ?><?php endif; ?></textarea>
                                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <?php if(isset($category)): ?>
                                                <div class="form-group">
                                                    <label>Select Section</label>
                                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="<?php echo e($section['title']); ?>" name="section" value="<?php echo e($section['id']); ?>"
                                                                   class="custom-control-input <?php $__errorArgs = ['section'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if($section['id'] === $category['section_id']): ?> checked <?php endif; ?> required>
                                                            <label class="custom-control-label" for="<?php echo e($section['title']); ?>"><?php echo e($section['title']); ?></label>
                                                        </div>
                                                        <?php $__errorArgs = ['section'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="form-group">
                                                    <label>Select Sections</label>
                                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input <?php $__errorArgs = ['sections'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="sections[]" value="<?php echo e($section['id']); ?>" id="<?php echo e($section['id']); ?>">
                                                            <label class="custom-control-label" for="<?php echo e($section['id']); ?>"><?php echo e($section['title']); ?></label>
                                                            <?php $__errorArgs = ['sections'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><?php echo e($title); ?></button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card crud_table shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Add Sub-Category</h6>
                            </div>
                            <div class="card-body">
                                <form id="add_sub_category" action="<?php if(isset($subCategory)): ?> <?php echo e(route('admin.sub-category', ['id' => $subCategory['id']])); ?> <?php else: ?> <?php echo e(route('admin.sub-category')); ?> <?php endif; ?>" method="POST">
                                    <fieldset <?php if(isset($category)): ?> disabled="disabled" <?php endif; ?>>
                                        <?php echo csrf_field(); ?>
                                        <?php if(isset($subCategory)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="section">Section</label>
                                                    <select name="section" id="section" class="form-control <?php $__errorArgs = ['section'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                                        <option selected hidden value="">Select *</option>
                                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(isset($subCategory)): ?> <?php if($subCategory['section_id'] === $section['id']): ?> selected data-categoryId="<?php echo e($subCategory['category_id']); ?>" <?php endif; ?> <?php endif; ?>
                                                        value="<?php echo e($section['id']); ?>"><?php echo e($section['title']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['section'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col">
                                                    <label for="category">Category</label>
                                                    <select name="category" id="category" class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                                        <option selected hidden value="">Select a category*</option>
                                                    </select>
                                                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control <?php $__errorArgs = ['sub_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="sub_category_title"
                                                       value="<?php if(isset($subCategory)): ?><?php echo e($subCategory['title']); ?><?php endif; ?>" aria-label required>
                                                <?php $__errorArgs = ['sub_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" class="form-control <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="0" max="99" name="discount"
                                                       value="<?php if(isset($subCategory)): ?><?php echo e($subCategory['discount']); ?><?php endif; ?>" aria-label>
                                                <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="3" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                          name="description" aria-label><?php if(isset($subCategory)): ?><?php echo e($subCategory['description']); ?><?php endif; ?></textarea>
                                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><?php echo e($title); ?></button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col text-right">
                        <button class="btn btn-outline-dark">Multi-Create</button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="<?php echo e(route('admin.categories')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Categories<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['admins']); ?></span>
                            </a>
                            <a href="<?php echo e(route('admin.products')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['sellers']); ?></span>
                            </a>
                            <a href="<?php echo e(route('admin.orders')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill"><?php echo e(tableCount()['orders']); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Categories/create.blade.php ENDPATH**/ ?>