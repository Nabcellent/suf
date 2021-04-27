<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.social_icons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php use App\Models\Product; ?>

    <div id="index">
            <div class="container-fluid p-0">
                

                
                <div class="container">
                    <div class="row">

                        <?php $__currentLoopData = $adBoxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col p-3 box_section">
                                <div class="card mb-2 text-black rounded shadow" style="max-width:25rem">
                                    <a href="<?php echo e($item['url']); ?>">
                                        <img class="card-img" src="<?php echo e(asset('/images/box_section/' . $item['image'])); ?>" alt="Image">
                                        <div class="card-img-overlay text-left">
                                            <h2 class="card-title"><?php echo e($item['title']); ?></h2>
                                            <p class="card-text"><?php echo e($item['description']); ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
                

                <div class="products">
                    <!--    Start FEATURED PRODUCTS    -->

                    <div id="content" class="container-fluid latest_products product_container">
                        <?php if(count($featuredProducts) > 0): ?>
                            <div class="section_title">
                                <div class="container">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <h3 class="mb-0">Featured Products</h3>
                                            <p class="m-0 lead"><?php echo e($featuredProductsCount); ?> Featured products</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--    Start Swiper 1    -->

                            <div class="row py-2">
                                <div class="col-3">
                                    <div class="card-body h-100 d-flex justify-content-center align-items-center">
                                        <h4>Some SU AD</h4>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="swiper-container featured_products_swiper product_swiper">
                                        <div class="swiper-wrapper">

                                            <!--    Start Slide    -->

                                            <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="swiper-slide">
                                                    <div class="card">
                                                        <a href="<?php echo e(url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item['title']))); ?>">
                                                            <?php if(isset($item['main_image'])): ?>
                                                                <?php $image_path = 'images/products/' . $item['main_image']; ?>
                                                            <?php else: ?>
                                                                <?php $image_path = ''; ?>
                                                            <?php endif; ?>
                                                            <?php if(!empty($item['main_image']) && file_exists($image_path)): ?>
                                                                <img src="<?php echo e(asset($image_path)); ?>" alt="Product image">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('/images/general/on-on-C100919_Image_01.jpeg')); ?>" alt="Product image">
                                                            <?php endif; ?>
                                                        </a>
                                                        <div class="supplier">
                                                            <a href="#"><?php echo e($item['seller']['seller']['username']); ?></a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">
                                                                <a href=''><?php echo e($item['title']); ?></a>
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col prices">
                                                                    <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                                    <?php if($discountPrice > 0): ?>
                                                                        <p><?php echo e($discountPrice); ?>/=</p><br>
                                                                        <del class="text-secondary"><?php echo e($item['base_price']); ?>/=</del>
                                                                    <?php else: ?>
                                                                        <p><?php echo e($item['base_price']); ?>/=</p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col button">
                                                                    <a href="<?php echo e(route('product-details', ['id' => $item['id'], 'title' => preg_replace("/\s+/", "", $item['title'])])); ?>" class='btn btn-block btn-outline-primary add'>
                                                                        <i class='fas fa-cart-plus'></i> Add
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="product_label <?php echo e(strtolower($item['label'])); ?>">
                                                        <span class="label"><?php echo e($item['label']); ?></span>
                                                    </a>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!--    End Slide    -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <!--    End Swiper 1    -->

                            <?php if(count($newLadies) > 0 || count($newGents) > 0): ?>
                                <div class="section_title">
                                    <div class="container">
                                        <h3 class="mb-0">Latest Products</h3>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(count($newLadies) > 0): ?>
                            <!--    Start Swiper 1    -->
                                <div class="row py-2">
                                <div class="col">
                                    <div class="swiper-container product_swiper">
                                        <div class="swiper-wrapper">

                                            <!--    Start Slide    -->


                                            <?php $__currentLoopData = $newLadies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="swiper-slide">
                                                    <div class="card">
                                                        <a href="<?php echo e(url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item['title']))); ?>">
                                                            <?php if(isset($item['main_image'])): ?>
                                                                <?php $image_path = 'images/products/' . $item['main_image']; ?>
                                                            <?php else: ?>
                                                                <?php $image_path = ''; ?>
                                                            <?php endif; ?>
                                                            <?php if(!empty($item['main_image']) && file_exists($image_path)): ?>
                                                                <img src="<?php echo e(asset($image_path)); ?>" alt="Product image">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('/images/general/on-on-C100919_Image_01.jpeg')); ?>" alt="Product image">
                                                            <?php endif; ?>
                                                        </a>
                                                        <div class="supplier">
                                                            <a href="#"><?php echo e($item['username']); ?></a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">
                                                                <a href=''><?php echo e($item['title']); ?></a>
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col prices">
                                                                    <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                                    <?php if($discountPrice > 0): ?>
                                                                        <p><?php echo e($discountPrice); ?>/=</p><br>
                                                                        <del class="text-secondary"><?php echo e($item['base_price']); ?>/=</del>
                                                                    <?php else: ?>
                                                                        <p><?php echo e($item['base_price']); ?>/=</p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col button">
                                                                    <a href="<?php echo e(route('product-details', ['id' => $item['id'], 'title' => preg_replace("/\s+/", "", $item['title'])])); ?>" class='btn btn-block btn-outline-primary add'>
                                                                        <i class='fas fa-cart-plus'></i> Add
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="product_label <?php echo e(strtolower($item['label'])); ?>">
                                                        <span class="label"><?php echo e($item['label']); ?></span>
                                                    </a>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!--    End Slide    -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    End Swiper 1    -->
                            <?php endif; ?>

                        <!--    Start Swiper 2 - GENTS    -->

                            <?php if(count($newGents) > 0): ?>
                                <div class="row py-2">
                                    <div class="col">
                                        <div class="swiper-container product_swiper">
                                            <div class="swiper-wrapper">

                                                <!--    Start Slide    -->

                                                <?php $__currentLoopData = $newGents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="swiper-slide">
                                                        <div class="card">
                                                            <a href="<?php echo e(url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item['title']))); ?>">
                                                                <?php if(isset($item['main_image'])): ?>
                                                                    <?php $image_path = 'images/products/' . $item['main_image']; ?>
                                                                <?php else: ?>
                                                                    <?php $image_path = ''; ?>
                                                                <?php endif; ?>
                                                                <?php if(!empty($item['main_image']) && file_exists($image_path)): ?>
                                                                    <img src="<?php echo e(asset($image_path)); ?>" alt="Product image">
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(asset('/images/general/on-on-C100919_Image_01.jpeg')); ?>" alt="Product image">
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="supplier">
                                                                <a href="#"><?php echo e($item['username']); ?></a>
                                                            </div>
                                                            <div class="card-body">
                                                                <h6 class="card-title">
                                                                    <a href=''><?php echo e($item['title']); ?></a>
                                                                </h6>
                                                                <div class="row">
                                                                    <div class="col prices">
                                                                        <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                                        <?php if($discountPrice > 0): ?>
                                                                            <p><?php echo e($discountPrice); ?>/=</p><br>
                                                                            <del class="text-secondary"><?php echo e($item['base_price']); ?>/=</del>
                                                                        <?php else: ?>
                                                                            <p><?php echo e($item['base_price']); ?>/=</p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col button">
                                                                        <a href="<?php echo e(route('product-details', ['id' => $item['id'], 'title' => preg_replace("/\s+/", "", $item['title'])])); ?>" class='btn btn-block btn-outline-primary add'>
                                                                            <i class='fas fa-cart-plus'></i> Add
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="product_label <?php echo e(strtolower($item['label'])); ?>">
                                                            <span class="label"><?php echo e($item['label']); ?></span>
                                                        </a>
                                                    </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <!--    End Slide    -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <!--    End Swiper 2    -->
                        <!--    End Latest Products    -->

                        <!--    STart Top Products    -->

                        <?php if(count($topProducts) > 0): ?>
                            <div class="section_title">
                                <div class="container">
                                    <h3 class="mb-0">Top Products</h3>
                                </div>
                            </div>

                            <!--    Start Swiper 1    -->

                            <div class="row py-2">
                                <div class="col">
                                    <div class="swiper-container product_swiper">
                                        <div class="swiper-wrapper">

                                            <!--    Start Slide    -->

                                            <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="swiper-slide">
                                                    <div class="card">
                                                        <a href="<?php echo e(url('/product/' . $item['id'] . '/' . preg_replace("/\s+/", "", $item['title']))); ?>">
                                                            <?php if(isset($item['main_image'])): ?>
                                                                <?php $image_path = 'images/products/' . $item['main_image']; ?>
                                                            <?php else: ?>
                                                                <?php $image_path = ''; ?>
                                                            <?php endif; ?>
                                                            <?php if(!empty($item['main_image']) && file_exists($image_path)): ?>
                                                                <img src="<?php echo e(asset($image_path)); ?>" alt="Product image">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('/images/general/on-on-C100919_Image_01.jpeg')); ?>" alt="Product image">
                                                            <?php endif; ?>
                                                        </a>
                                                        <div class="supplier">
                                                            <a href="#">Man title</a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">
                                                                <a href=''><?php echo e($item['title']); ?></a>
                                                            </h6>
                                                            <div class="row">
                                                                <div class="col prices">
                                                                    <?php $discountPrice = Product::getDiscountPrice($item['id']); ?>
                                                                    <?php if($discountPrice > 0): ?>
                                                                        <p><?php echo e($discountPrice); ?>/=</p><br>
                                                                        <del class="text-secondary"><?php echo e($item['base_price']); ?>/=</del>
                                                                    <?php else: ?>
                                                                        <p><?php echo e($item['base_price']); ?>/=</p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col button">
                                                                    <a href="<?php echo e(route('product-details', ['id' => $item['id'], 'title' => preg_replace("/\s+/", "", $item['title'])])); ?>" class='btn btn-block btn-outline-primary add'>
                                                                        <i class='fas fa-cart-plus'></i> Add
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="product_label <?php echo e($item['label']); ?>">
                                                        <span class="label"><?php echo e($item['label']); ?></span>
                                                    </a>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!--    End Slide    -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    End Swiper 1    -->
                            
                        <?php endif; ?>

                    </div>
                </div>
                

                

                <div class="rotating-img">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-7 text-center">
                                <img src="<?php echo e(asset('images/general/store_logo.jpg')); ?>" alt="logo" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
                <!--    End Rotating Image    -->
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/home.blade.php ENDPATH**/ ?>