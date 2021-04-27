
<div id="delivery-address" class="card">

    <!--    Start Update Profile    -->
    <div class="card-header">
        <h3><i class="fas fa-user-edit"></i> Delivery Address</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="delivery-address-form" class="anime_form"  method="POST"
              <?php if(empty($address['id'] ?? '')): ?> action="<?php echo e(route('delivery-address')); ?>" <?php else: ?> action="<?php echo e(url('/delivery-address/' . $address ["id"])); ?>" <?php endif; ?> >
            <?php echo csrf_field(); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>County *</label>
                    <select type="text" class="form-control <?php $__errorArgs = ['county'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="county" name="county" required>
                        <option selected hidden value="">Select your county *</option>
                        <?php $__currentLoopData = $counties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $county): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(!empty($address ?? '') && $address['sub_county']['county']['id'] === $county['id']): ?> selected data-subCounty="<?php echo e($address['sub_county_id']); ?>" <?php endif; ?>
                            value="<?php echo e($county['id']); ?>"><?php echo e($county['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['county'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <label>Sub-County *</label>
                    <select type="text" class="form-control <?php $__errorArgs = ['sub_county'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="sub_county" required>
                        <option selected hidden value="">Select your Sub-county *</option>
                    </select>
                    <?php $__errorArgs = ['sub_county'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="u_first_name">Address (District/Estate/House No.) *</label>
                <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          name="address" required placeholder="Enter the address details i.e; Location, Street name/Drive, Estate, house number (Where applicable) *"><?php echo e(old('address')); ?><?php echo e($address['address'] ?? ''); ?></textarea>
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> <?php echo e($btnAction); ?> Address</span>
                </button>
                <img id="update_profile_gif" class="d-none loader_gif" src="<?php echo e(asset('/images/loaders/Infinity-1s-197px.gif')); ?>" alt="loader.gif">
            </div>
        </form>
    </div>
    <!--    End Update Profile    -->
</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/delivery_address.blade.php ENDPATH**/ ?>