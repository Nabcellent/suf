
<div class="container-fluid p-0">
    <div id="results" class="col column">

        <!--    Start Single ProductSeeder    -->
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <a href="/product/<?php echo e($item['id']); ?>">
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
                <div class="supplier"><a href="#"><?php echo e($item['seller']['username']); ?></a></div>
                <div class="card-body">
                    <h6 class="card-title"><a href=""><?php echo e($item['title']); ?></a></h6>
                    <div class="d-flex justify-content-center">
                        <hr class="col-7 m-0">
                    </div>
                    <p class="m-0 text-center text-secondary"><?php echo e($item['brand']['name']); ?></p>
                    <div class="row">
                        <div class="col prices">
                            <?php if(strtolower($item['label']) === "new"): ?>
                                <p><?php echo e($item['base_price']); ?>/=</p>
                            <?php else: ?>
                                <p><?php echo e($item['sale_price']); ?>/=</p><br>
                                <del class="text-secondary"><?php echo e($item['base_price']); ?>/=</del>
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
    <!--    End Single ProductSeeder    -->

    </div>
    <div class="row justify-content-center">
        <div class="col text-center">
            
            <?php echo e($products->appends(['sort' => 'title_desc'])->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/products/products_data.blade.php ENDPATH**/ ?>