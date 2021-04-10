
<!--    Start Header Carousel    -->

<div id="header_carousel" class="container-fluid">
    <div class="row">
        <div class="col">
            <div id="carousel_indicators" class="carousel slide header_carousel" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">

                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop -> first): ?>
                            <li data-target="#carousel_indicators" data-slide-to="<?php echo e($key); ?>" class="active"></li>
                        <?php else: ?>
                            <li data-target="#carousel_indicators" data-slide-to="<?php echo e($key); ?>"></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ol>
                <div class="carousel-inner">

                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop -> first): ?>
                            <div class='carousel-item active'>
                                <a href="#carousel_indicators">
                                    <img src="<?php echo e(asset('images/banners/' . $item["image"])); ?>" class='d-block w-100' alt='<?php echo e($item['image']); ?>'>
                                </a>
                                <div class='carousel-caption d-none d-md-block'>
                                    <span>New Inspiration 2021</span>
                                    <h1>SUITS MADE FOR YOU!</h1>
                                    <p>Trending from our style collection</p>
                                    <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class='carousel-item'>
                                <a href="#carousel_indicators">
                                    <img src="<?php echo e(asset('images/banners/' . $item["image"])); ?>" class='d-block w-100' alt=''>
                                </a>
                                <div class='carousel-caption d-none d-md-block'>
                                    <span>New Inspiration 2021</span>
                                    <h1>SUITS MADE FOR YOU!</h1>
                                    <p>Trending from our style collection</p>
                                    <a href='#'><button class='btn btn-outline-light'>SHOP NOW</button></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!--    End Header Carousel    -->
</header>


<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/header_carousel.blade.php ENDPATH**/ ?>