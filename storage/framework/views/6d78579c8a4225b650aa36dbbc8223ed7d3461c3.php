<?php $__env->startSection('title', 'Details'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/partials/top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php use App\Models\Product; ?>

<div id="details">

<!--    Start Content Area    -->

    <div class="container">

        <!--    Start Breadcrumb    -->

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/products')); ?>">Shop</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/products/<?php echo e($details['sub_category']['id']); ?>"><?php echo e($details['sub_category']['title']); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($details['title']); ?></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--    End Breadcrumb    -->

        <!--    Start Product Show Case    -->

        <div class="row my-2 justify-content-center">
            <div class="col p-3 card" style="min-height: 30rem;">
                <div class="row" style="height: 100%;">
                    
                    <div class="col-6">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('<?php echo e(asset('/images/products/' . $details['main_image'])); ?>')"></div>

                                <?php $__currentLoopData = $details['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide" style="background-image:url('<?php echo e(asset('/images/products/' . $image['image'])); ?>')"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image:url('<?php echo e(asset('/images/products/' . $details['main_image'])); ?>')"></div>

                                <?php $__currentLoopData = $details['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide" style="background-image:url('<?php echo e(asset('/images/products/' . $image['image'])); ?>')"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-6">
                        <div class="card-title m-0">
                            <div class="d-flex justify-content-between">
                                <h3><?php echo e($details['title']); ?></h3>
                                <p class="small"><?php echo e($details['seller']['seller']['username']); ?></p>
                            </div>
                            <h6>--> <?php echo e($details['brand']['name']); ?></h6>
                        </div>
                        <hr>
                        <form action="<?php echo e(url('/add-to-cart')); ?>" method="POST" class="card-body py-1">
                            <?php echo csrf_field(); ?>
                            <div class="row justify-content-end">
                                <div class="col"><p class="small m-0"><?php echo e($totalStock); ?> in stock</p></div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                                        </div>
                                        <input type="number" name="quantity" class="form-control" min="0" step="1" value="<?php echo e(old('quantity')); ?>" placeholder="Quantity" aria-label required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="min-height: 10rem">
                                <div class="col variations">

                                    <?php if(count($details['variations']) > 0): ?>
                                        <h5>Variations</h5>
                                        <hr class="bg-warning m-0">
                                        <ul class="list-group list-group-flush">
                                            <?php $__currentLoopData = $details['variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $variationName = key(json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR)) ?>
                                                <?php if(count($variation['variation_options']) > 0): ?>
                                                    <li class="list-group-item"><?php echo e($variationName); ?>

                                                        <div class="form-group m-0">
                                                                <?php $__currentLoopData = $variation['variation_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="option<?php echo e($option['id']); ?>" name="variant<?php echo e($variationName); ?>"
                                                                               <?php if(old("variant$variationName") === $option['variant']): ?> checked <?php endif; ?>
                                                                               class="custom-control-input" value="<?php echo e($option['variant']); ?>" data-id="<?php echo e($details['id']); ?>" required>
                                                                        <label class="custom-control-label" for="option<?php echo e($option['id']); ?>" data-id="<?php echo e($details['id']); ?>">
                                                                            <?php echo e($option['variant']); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <?php $discountPrice = Product::getDiscountPrice($details['id']); ?>
                                    <?php if($discountPrice > 0): ?>
                                            <p class="font-weight-bold m-0">
                                                KSH <span class="variation_price"><?php echo e($discountPrice); ?></span>/=
                                            </p>
                                            <del class="text-secondary"><?php echo e($details['base_price']); ?>/=</del>
                                        <?php else: ?>
                                            <p class="font-weight-bold">
                                                KSH <span class="variation_price"><?php echo e($details['base_price']); ?></span>/=
                                            </p>
                                        <?php endif; ?>
                                </div>
                                <div class="col text-right">
                                    <input type="hidden" name="product_id" value="<?php echo e($details['id']); ?>">
                                    <button class="btn btn-success">Add To Cart <i class="bx bxs-cart-add"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <h4>Description</h4>
                            <p><?php echo e($details['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    End Product Show Case    -->

        <!--    Start Product Info    -->

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Product Details</a>
                <?php if(count($related) > 0): ?>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Related Products</a>
                <?php endif; ?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div id="products_like">
                    <div class="row like_title">
                        <div class="col">
                            <h3>Product Information</h3>
                            <hr class="bg-light my-0">
                        </div>
                    </div>
                </div>
                <table class="table table-dark table-hover">
                    <thead>
                    <tr><th scope="col" colspan="2">Details</th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Brand</th>
                        <td><?php echo e($details['brand']['name']); ?></td>
                    </tr>
                    <?php if(count($details['variations']) > 0): ?>
                        <?php $__currentLoopData = $details['variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $variationName = key(json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR));
                            $variationOption = json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR)[$variationName];
                            ?>
                            <tr>
                                <th scope="row"><?php echo e($variationName); ?></th>
                                <?php if(is_array($variationOption)): ?>
                                <td><?php echo e(implode(', ', $variationOption)); ?></td>
                                <?php else: ?>
                                    <td><?php echo e($variationOption); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <tr>
                        <th scope="row">Seller</th>
                        <td><?php echo e($details['seller']['seller']['username']); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php if(count($related) > 0): ?>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <!--    Start Products you may Like    -->

                    <div id="products_like" class="row">
                        <div class="col">
                            <div class="row like_title">
                                <div class="col">
                                    <h3>Products you may Like</h3>
                                    <hr class="bg-light my-0">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div id="results" class="col column">

                                    <!--    Start Single ProductSeeder    -->
                                    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                    <img src="<?php echo e(asset('images/general/on-on-C100919_Image_01.jpeg')); ?>" alt="Product image">
                                                <?php endif; ?>
                                            </a>
                                            <div class="card-body">
                                                <h6 class="card-title"><a href=""><?php echo e($item['title']); ?></a></h6>
                                                <div class="d-flex justify-content-center">
                                                    <hr class="col-7 m-0">
                                                </div>
                                                <p class="m-0 text-center text-secondary"><?php echo e($item['brand']['name']); ?></p>
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
                                                        <a href="" class="btn btn-block btn-outline-primary add">
                                                            <i class="fas fa-cart-plus"></i> +
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="product_label <?php echo e(strtolower($item['label'])); ?>">
                                                <span class="label"><?php echo e($item['label']); ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    End Products you may Like    -->
                </div>
            <?php endif; ?>

        </div>
        <!--    End Product Info    -->

    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/details.blade.php ENDPATH**/ ?>