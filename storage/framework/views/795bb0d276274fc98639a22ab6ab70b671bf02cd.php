<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--    Start Sticky Header Jumbotron    -->

<div id="products">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container-fluid products_container">

            <!--    Start Breadcrumb    -->

            <div class="row">
                <div class="col">
                    <nav class="d-flex justify-content-between" aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            <?php if(!empty($catDetails['breadcrumbs'])) echo $catDetails['breadcrumbs'] ?>
                        </ul>
                        <?php if(tableCount()['products'] > 0): ?>
                            <div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="per_page">Per page</label>
                                    </div>
                                    <select class="custom-select" id="per_page">
                                        <option selected value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <div class="row">

                <!--    Start SideBar Categories    -->

                <div class="col-md-3 pl-0">

                    <?php echo $__env->make('partials.products.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>
                <!--    End SideBar Categories    -->

                <!--    Start ProductSeeder Section    -->

                <div class="col-md-9 pr-0">
                    <?php if(tableCount()['products'] > 0): ?>
                        <div class="row">
                            <div class="col bg-light p-3 mb-2 rounded">
                                <div class="d-flex justify-content-between">
                                    <h2 id="textChange">
                                        <?php if(!empty($catDetails['catDetails']['title'])): ?>
                                            <?php echo e($catDetails['catDetails']['title']); ?>

                                        <?php else: ?>
                                            All Products
                                        <?php endif; ?>
                                    </h2>
                                    <p class="m-0 text-muted">Available products: <?php echo e(count($products)); ?></p>
                                </div>
                                <hr class="mt-0">
                                <div class="row d-flex justify-content-between">
                                    <p class="col">
                                        <?php if(!empty($catDetails['catDetails']['description'])): ?>
                                            <?php echo e($catDetails['catDetails']['description']); ?>

                                        <?php else: ?>
                                            We are pleased to serve you with these products.
                                        <?php endif; ?>
                                    </p>
                                    <div class="col-auto">
                                        <form id="sort_products_form" class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="sort_by">Sort By</label>
                                            </div>
                                            <select class="custom-select" name="sort" id="sort_by">
                                                <option selected hidden value="">Select</option>
                                                <option value="newest">Newest Products</option>
                                                <option value="oldest">Oldest Products</option>
                                                <option value="title_asc">Title Ascending</option>
                                                <option value="title_desc">Title Descending</option>
                                                <option value="price_asc">Price Ascending</option>
                                                <option value="price_desc">Price Descending</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="text-center">
                        <img src="<?php echo e(asset('images/loaders/Infinity-1s-197px.gif')); ?>" alt="" id="loader" width="197" style="display:none;">
                    </div>

                    <div id="product_section" class="row mb-2">

                        <?php echo $__env->make('partials.products.products_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>
                <!--    End ProductSeeder Section    -->

            </div>
        </div>
    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

<!--    Scroll To Top Button    -->

<span class="shadow" id="scroll_top" title="Scroll to the top"><i class="fas fa-arrow-alt-circle-up"></i></span>
<!--    End Scroll To Top Button    -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/products.blade.php ENDPATH**/ ?>