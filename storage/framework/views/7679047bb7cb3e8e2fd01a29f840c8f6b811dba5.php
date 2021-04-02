
<div id="header_carousel" class="container-fluid <?php if(count($banners) < 1): ?> d-none <?php endif; ?>">
    <div class="row">
        <div class="col">
            <div id="carousel_indicators" class="carousel slide header_carousel" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">

                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-target="#carousel_indicators" data-slide-to="<?php echo e($key); ?>" <?php if($loop -> first): ?> class="active" <?php endif; ?>></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ol>
                <div class="carousel-inner">

                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php if($loop -> first): ?> active <?php endif; ?>">
                            <a <?php if(!empty($banner['link'])): ?> href="<?php echo e(url($banner['link'])); ?>" <?php else: ?> href="javascript:void(0)" <?php endif; ?>>
                                <img src="<?php echo e(asset('images/banners/' . $banner["image"])); ?>" class='d-block w-100' alt="<?php echo e($banner['alt']); ?>" title="<?php echo e($banner['title']); ?>">
                            </a>
                            <div class='carousel-caption d-none d-md-block'>
                                <span>New Inspiration 2021</span>
                                <h1><?php echo e($banner['title']); ?></h1>
                                <p><?php echo e($banner['description']); ?></p>
                                <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!--    End Header Carousel    -->
</header>


<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/home_banners.blade.php ENDPATH**/ ?>