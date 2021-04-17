
<div id="categories_sidebar">
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between">
            <h4 class="m-0">FILTERS</h4><i class="fas fa-filter"></i>
        </li>

        <?php $sections = sections(); ?>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(count($section['categories']) > 0): ?>
                <li class="list-group-item">
                    <span class="row">
                        <span class="col">
                            <a href="#" class="btn-block" data-toggle="collapse" data-target="#collapse<?php echo e($section['id']); ?>">
                                <?php echo e(strtoupper($section['title'])); ?>

                            </a>
                        </span>
                        <span class="col-auto mr-2 bg-dark search_icon" data-toggle="collapse" data-target="#search_box<?php echo e($loop->iteration); ?>">
                            <i class="bx bx-search"></i>
                        </span>
                    </span>
                    <div id="search_box<?php echo e($loop->iteration); ?>" class="collapse search_box">
                        <input type="text" class="search_text" placeholder="Search Category" aria-label
                               data-filters="#suf_products" data-action="filter">
                    </div>
                    <ul id="collapse<?php echo e($section['id']); ?>" class="list-group list-group-flush show">
                        <?php $__currentLoopData = $section['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item py-1">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check list">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input product_check" id="category" value="<?php echo e($category['id']); ?>">
                                            <span></span>
                                            <i class="indicator"></i>
                                            <strong><?php echo e($category['title']); ?></strong>
                                        </label>
                                    </div>
                                    <?php if(count($category['sub_categories']) > 0): ?>
                                        <span class="px-2 rounded-pill" data-toggle="collapse" data-target="#sub_collapse<?php echo e($category['id']); ?>" style="background-color: #900; color: #cbd5e0">
                                            <i class="bx bx-arrow-to-bottom bx-fade-down-hover" style="cursor: pointer;"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <ul id="sub_collapse<?php echo e($category['id']); ?>" class="list-group list-group-flush collapse">
                                    <?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item py-0">
                                            <div class="form-check sub_list">
                                                <label class="form-check-label">
                                                    <input type='checkbox' class='form-check-input product_check' id="sub_category" value="<?php echo e($subCategory['id']); ?>">
                                                    <span></span>
                                                    <i class="indicator"></i>
                                                    <?php echo e($subCategory['title']); ?>

                                                </label>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <li class="list-group-item">
            <a href="#" class="btn-block" data-toggle="collapse" data-target="#seller_collapse">SELLERS</a>
            <ul id="seller_collapse" class="list-group list-group-flush show">
                <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item py-1">
                        <div class="d-flex justify-content-between">
                            <div class="form-check list">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" id="seller" value="<?php echo e($item['user_id']); ?>">
                                    <span></span>
                                    <i class="indicator"></i>
                                    <strong><?php echo e($item['username']); ?></strong>
                                </label>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>

        <li class="list-group-item">
            <span class="row">
                <span class="col">
                    <a href="#" class="btn-block" data-toggle="collapse" data-target="#brands_collapse">
                        BRANDS
                    </a>
                </span>
                <span class="col-auto mr-2 bg-dark search_icon" data-toggle="collapse" data-target="#search_box">
                    <i class="bx bx-search"></i>
                </span>
            </span>
            <div id="search_box" class="collapse search_box">
                <input type="text" class="search_text" placeholder="Search Category" aria-label
                       data-filters="#suf_products" data-action="filter">
            </div>
            <ul id="brands_collapse" class="list-group list-group-flush show">
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item py-1">
                        <div class="d-flex justify-content-between">
                            <div class="form-check list">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" id="brand" value="<?php echo e($item['id']); ?>">
                                    <span></span>
                                    <i class="indicator"></i>
                                    <strong><?php echo e($item['name']); ?></strong>
                                </label>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    </ul>
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/products/sidebar.blade.php ENDPATH**/ ?>