<?php $__env->startSection('content'); ?>

    <div id="banners" class="container-fluid p-0">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><i class="fas fa-cog"></i> Admin Panel</li>
                        <li class="breadcrumb-item active" aria-current="page"> Banners</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <div class="row">
            <div class="col-xl-11 col-lg-12">
                <div class="card crud_box shadow">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-slideshare"></i> SU-F Banners</h6>
                        <button type="button" id="btn_add_banner" data-toggle="modal" data-target="#add_banner_modal" class="btn btn-outline-info">
                            Add Banner
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                             <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-md-6 align-self-center card-body border-info shadow slider_box">
                                <div class="slider_title">
	                                <?php echo e($banner['title']); ?>

                                    <?php if($banner['status']): ?>
                                    <a class="update_banner_status" data-id="<?php echo e($banner['id']); ?>" title="Update Status"
                                       style="cursor: pointer"><i class="fas fa-toggle-on" status="Active"></i></a>
                                    <?php else: ?>
                                    <a class="update_banner_status" data-id="<?php echo e($banner['id']); ?>" title="Update Status"
                                       style="cursor: pointer"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                    <?php endif; ?>
                                </div>
                                <div class="slider_img">
                                    <img src="<?php echo e(asset('/images/banners/' . $banner['image'])); ?>" alt="<%= row.alt %>">
                                </div>
                                <div class="slider_action">
                                    <a href="#" class="update_banner" data-toggle="modal" data-target="#update_banner_modal" title="Modify"
                                       data-id="<?php echo e($banner['id']); ?>"
                                       data-title="<?php echo e($banner['title']); ?>"
                                       data-image="<?php echo e($banner['image']); ?>"
                                       data-link="<?php echo e($banner['link']); ?>"
                                       data-alt="<?php echo e($banner['alt']); ?>"
                                       data-description="<?php echo e($banner['description']); ?>">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" class="delete_banner" title="Remove" data-id="<?php echo e($banner['id']); ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <div class="details">
                                    <strong>Link -</strong> <a href="<?php echo e($banner['link']); ?>" target="_blank"><?php echo e($banner['link']); ?></a>
                                    <div>
                                        <strong>Description:</strong>
                                        <p><?php echo e($banner['description']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr style="background-color: #900">

    <?php echo $__env->make('Admin.Pages.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Pages/banners.blade.php ENDPATH**/ ?>