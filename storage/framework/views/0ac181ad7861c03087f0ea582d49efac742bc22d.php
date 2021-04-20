<?php $__env->startSection('content'); ?>

    <div id="order-view" class="container-fluid px-0">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="card bg-info text-white crud_table shadow mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> Order Details</h6>
                                        <div>
                                            <span class="m-0" >#<?php echo e($order['id']); ?></span>
                                            <a href="<?php echo e(route('admin.invoice', ['id' => $order['id']])); ?>" class="ml-2 btn btn-outline-light" title="View Invoice" target="_blank">
                                                <i class="fas fa-file-invoice"></i> Invoice
                                            </a>
                                            <a href="<?php echo e(route('admin.invoice-pdf', ['id' => $order['id']])); ?>" class="btn btn-outline-light">
                                                <i class="fa fa-file-pdf"></i> Generate PDF
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-sm table-borderless">
                                                                <tbody>
                                                                <?php if(isset($order['coupon'])): ?>
                                                                    <tr>
                                                                        <th class="py-1" scope="row">Coupon Code</th>
                                                                        <td class="py-1" colspan="2"><?php echo e($order['coupon']['code']); ?></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Discount</th>
                                                                    <td class="py-1" colspan="2"><?php echo e($order['discount']); ?>/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Delivery Fee</th>
                                                                    <td class="py-1" colspan="2"><?php echo e($order['delivery_fee']); ?>/-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Method</th>
                                                                    <td class="py-1" colspan="2"><?php echo e($order['payment_method']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Payment Type</th>
                                                                    <td class="py-1" colspan="2"><?php echo e($order['payment_type']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="py-1" scope="row">Amount Due</th>
                                                                    <td class="py-1 font-weight-bolder text-warning" colspan="2">KSH.<?php echo e(currencyFormat($order['total'])); ?>/=</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <hr class="bg-light">
                                                            <div class="row">
                                                                <div class="col text-light">
                                                                    <p class="m-0">Order Date: &nbsp; <?php echo e(date('F jS, y  @g:i A', strtotime($order['created_at']))); ?></p>
                                                                    <p class="m-0">Order Status: &nbsp; <?php echo e($order['status']); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row pb-4">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Customer</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;<?php echo e($order['user']['first_name']); ?> &nbsp; <?php echo e($order['user']['last_name']); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email Address</th>
                                                                            <td>:&nbsp;&nbsp;&nbsp;<a href="mailto:<%= order.email %>" class="text-light"><?php echo e($order['user']['email']); ?></a></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="m-0 font-weight-bold">Delivery Address</h6>
                                                                    <div class="dropdown-divider"></div>
                                                                    <table class="table-sm table-borderless">
                                                                        <tbody>
                                                                        <tr><th>County</th><td>:&nbsp;&nbsp;&nbsp;<?php echo e($order['address']['sub_county']['county']['name']); ?></td></tr>
                                                                        <tr><th>Sub-County</th><td>:&nbsp;&nbsp;&nbsp;<?php echo e($order['address']['sub_county']['name']); ?></td></tr>
                                                                        <tr><th>Address</th><td class="text-dark">:&nbsp;&nbsp;&nbsp;<?php echo e($order['address']['address']); ?></td></tr>
                                                                        <tr><th>Phone</th><td>:&nbsp;&nbsp;&nbsp;0<?php echo e($order['phone']['phone']); ?></td></tr>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-danger"><i class="fab fa-opencart"></i> Order Products</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover crud_table" id="categories_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Sub-Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $__currentLoopData = $order['order_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><img src="<?php echo e(asset('storage/images/products/' . $item['product']['main_image'])); ?>" alt="product" class="img-fluid"></td>
                                            <td><a href="<?php echo e(route('admin.product', ['id' => $item['id']])); ?>"><?php echo e($item['product']['title']); ?></a></td>
                                            <td><?php echo e($item['product']['brand']['name']); ?></td>
                                            <td><?php echo e($item['product']['seller']['username']); ?></td>
                                            <td>
                                                <?php $detailsArr = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR); ?>
                                                <?php $__currentLoopData = $detailsArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p class="m-0"><?php echo e($key); ?>: <?php echo e($value); ?></p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><?php echo e($item['quantity']); ?></td>
                                            <td><?php echo e($item['final_unit_price']); ?></td>
                                            <td><?php echo e($item['final_unit_price'] * $item['quantity']); ?></td>
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

            <div class="col-3">
                <div class="row">
                    <div class="col">
                        <div class="card crud_table shadow mb-4">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="<?php echo e(route('admin.orders')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        All Orders<span class="badge badge-primary badge-pill">7</span>
                                    </a>
                                    <a href="<?php echo e(route('admin.products')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Products<span class="badge badge-primary badge-pill">14</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Remaining stock<span class="badge badge-primary badge-pill">37</span>
                                    </a>
                                    <a href="<?php echo e(route('admin.categories')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Categories<span class="badge badge-primary badge-pill">13</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5>Update Order Status</h5>
                                <hr>
                                <form id="update-order-status" action="<?php echo e(url()->current()); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option <?php if($order['status'] === 'new'): ?> selected <?php endif; ?> value="new">New</option>
                                            <option <?php if($order['status'] === 'in process'): ?> selected <?php endif; ?> value="in process">In Process</option>
                                            <option <?php if($order['status'] === 'hold'): ?> selected <?php endif; ?> value="hold">Hold</option>
                                            <option <?php if($order['status'] === 'pending'): ?> selected <?php endif; ?> value="pending">Pending</option>
                                            <option <?php if($order['status'] === 'completed'): ?> selected <?php endif; ?> value="completed">Completed</option>
                                            <option <?php if($order['status'] === 'cancelled'): ?> selected <?php endif; ?> value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <div id="courier" class="collapse <?php $__errorArgs = ['courier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> show <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php $__errorArgs = ['tracking_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> show <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <input type="text" class="form-control <?php $__errorArgs = ['courier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="courier" placeholder="Enter Courier Name">
                                                <?php $__errorArgs = ['courier'];
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
                                                <input type="number" class="form-control <?php $__errorArgs = ['tracking_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tracking_number" placeholder="Tracking number">
                                                <?php $__errorArgs = ['tracking_number'];
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
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info">Update</button>
                                    </div>
                                </form>

                                <?php if(count($order['order_logs']) > 0): ?>
                                    <h5 class="mb-1">Logs</h5>
                                    <hr class="mt-0">
                                    <div>
                                        <?php $__currentLoopData = $order['order_logs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="font-weight-bold m-0"><?php echo e($log['status']); ?></p>
                                                    <p class="mb-1"><?php echo e(date('d.m.Y - h:i A', strtotime($log['created_at']))); ?></p>
                                                    <hr class="col-6 mx-0 mt-0">
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/Orders/view.blade.php ENDPATH**/ ?>