<?php $__env->startSection('content'); ?>

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col p-0">
                <div class="row">
                    <div class="col-9">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sections</h6>
                                <button class="btn btn-info" data-toggle="modal" data-target="#add_section">Add Section</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="sections_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">No of Sub-Categories</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo e($section['title']); ?></td>
                                                <td><?= \App\Models\Category::where('section_id', $section['id'])->count() ?></td>
                                                <td class="text-nowrap"><?php echo e(date('M d, Y', strtotime($section['created_at']))); ?></td>
                                                <td style="font-size: 14pt">

                                                    <?php if($section['status']): ?>
                                                        <a class="update_category_status" data-id="<?php echo e($section['id']); ?>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    <?php else: ?>
                                                        <a class="update_category_status" data-id="<?php echo e($section['id']); ?>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    <?php endif; ?>

                                                </td>
                                                <td class="action">
                                                    <a href="#" class="ml-4" title="Modify"><i class="fas fa-pen text-dark"></i></a>
                                                    <a href="#" class="ml-3 delete_sub_category" title="Remove" data-id="<?php echo e($section['id']); ?>">
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

                <div class="row">
                    <div class="col-6">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Categories</h6>
                                <div>
                                    <button id="add_category" class="btn btn-info" data-toggle="modal" data-target="#category_modal">Add Category</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo e($category['title']); ?></td>
                                                <td><?php echo e($category['section']['title']); ?></td>
                                                <td><?php echo e($category['discount']); ?>%</td>
                                                <td class="action">
                                                    <?php if($category['status']): ?>
                                                        <a class="update_category_status" data-id="<%= row.id %>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    <?php else: ?>
                                                        <a class="update_category_status" data-id="<%= row.id %>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    <?php endif; ?>
                                                    <a href="#" class="ml-3 update_category" title="Modify" data-toggle="modal" data-target="#category_modal"
                                                       data-id="<%= row.id %>"
                                                       data-title="<%= row.title %>"
                                                       data-section="<%= row.section_id %>"
                                                       data-discount="<%= row.discount %>"
                                                       data-desc="<%= row.description %>">
                                                        <i class="fas fa-pen text-dark"></i>
                                                    </a>
                                                    <a href="#" class="ml-3 delete_sub_category" data-id="<%= row.id %>"
                                                       data-toggle="modal" data-target="#delete_sub_category" title="Remove">
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

                    <div class="col-6">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Sub-Categories</h6>
                                <div>
                                    <button id="add_sub_category" class="btn btn-info" data-toggle="modal" data-target="#sub_category_modal">Add Sub-Category</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="sub_categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sub-Category</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                         <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo e($subCategory['title']); ?></td>
                                                <td><?php echo e($subCategory['category']['title']); ?></td>
                                                <td><?php echo e($subCategory['category']['section']['title']); ?></td>
                                                <td><?php echo e($subCategory['discount']); ?>%</td>
                                                <td class="action">
                                                    <?php if($subCategory['status']): ?>
                                                        <a class="update_category_status" data-id="<?php echo e($subCategory['id']); ?>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                                    <?php else: ?>
                                                        <a class="update_category_status" data-id="<?php echo e($subCategory['id']); ?>" title="Update Status"
                                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                     <?php endif; ?>
                                                    <a href="#" class="ml-3 update_sub_category" title="Modify" data-toggle="modal" data-target="#sub_category_modal"
                                                       data-id="<%= row.id %>"
                                                       data-title="<%= row.title %>"
                                                       data-section="<%= row.sectionId %>"
                                                       data-discount="<%= row.discount %>"
                                                       data-desc="<%= row.description %>">
                                                        <i class="fas fa-pen text-dark"></i>
                                                    </a>
                                                    <a href="#" class="ml-3 delete_sub_category" data-id="<?php echo e($subCategory['id']); ?>"
                                                       data-toggle="modal" data-target="#delete_su_category" title="Remove">
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
        </div>
    </div>

    <?php echo $__env->make('Admin.Categories.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Categories/list.blade.php ENDPATH**/ ?>