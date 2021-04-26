<?php

if($user['gender'] ==='Male') {
    $gender = 'Male';
    $genderIcon = '<i class="bx bx-male-sign"></i>';
}else {
    $gender = 'Female';
    $genderIcon = "<i class='bx bx-female-sign'></i>";
}

?>

<div id="edit-profile" class="card">

    <!--    Start Update Profile    -->
    <div class="card-header">
        <h3><i class="fas fa-user-edit"></i> Personal Details</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="profile-form" class="anime_form" action="<?php echo e(route('profile')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>First name *</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" value="<?php echo e(ucfirst($user['first_name'])); ?>" required>
                    <?php $__errorArgs = ['first_name'];
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
                    <label>Last name *</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" value="<?php echo e(ucfirst($user['last_name'])); ?>" required>
                    <?php $__errorArgs = ['last_name'];
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
            <div class="form-row">
                <div class="form-group col">
                    <label>Email address</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-envelope"></i></span></div>
                        <input type="text" class="form-control" value="<?php echo e($user['email']); ?>" disabled>
                    </div>
                </div>
                <div class="form-group col">
                    <label>Gender</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text"><?= $genderIcon ?></span></div>
                        <input type="text" class="form-control" value="<?php echo e($gender); ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Update Profile</span>
                </button>
            </div>
        </form>
        <div class="form-group">
            <label class="d-flex justify-content-between">
                <span>Phone Number(s) *</span>
                <a href="#" class="input-group-text border-primary text-info add-phone">
                    <i class='bx bx-plus' ></i>
                </a>
            </label>
            <?php $__currentLoopData = $user['phones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                        <span class="input-group-text">+254</span>
                    </div>
                    <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e($phone['phone']); ?>"
                           pattern="^((7|1)(?:(?:[12569][0-9])|(?:0[0-8])|(4[081])|(3[64]))[0-9]{6})$" aria-label required>
                    <div class="input-group-append">
                        <?php if($phone['primary']): ?>
                            <span class="input-group-text">primary</span>
                        <?php endif; ?>
                        <a href="#" class="input-group-text border-primary text-info"><i class='bx bx-edit-alt'></i></a>
                        <a href="#" class="input-group-text border-danger text-danger delete-phone" data-id="<?php echo e($phone['id']); ?>">
                            <i class='bx bx-trash-alt'></i>
                        </a>
                    </div>
                    <?php $__errorArgs = ['phone'];
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if(count($user['addresses']) > 0): ?>
            <div class="form-group">
                <label class="d-flex justify-content-between">
                    <span>Address(es)</span>
                    <a href="<?php echo e(route('profile', ['page', 'delivery-address'])); ?>" class="input-group-text border-primary text-info">
                        <i class='bx bx-plus' ></i>
                    </a>
                </label>
                <?php $__currentLoopData = $user['addresses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                        <label class="form-control text-truncate" for="address<?php echo e($address['id']); ?>">
                            <?php echo e($address['sub_county']['county']['name']); ?>, <?php echo e($address['sub_county']['name']); ?>, <?php echo e($address['address']); ?>

                        </label>
                        <div class="input-group-append">
                            <a href="<?php echo e(url('/account/delivery-address/' . $address["id"])); ?>" class="input-group-text border-primary text-info">
                                <i class='bx bx-edit-alt'></i>
                            </a>
                            <a href="javascript:void(0)" class="input-group-text border-danger text-danger delete-address" data-id="<?php echo e($address['id']); ?>">
                                <i class='bx bx-trash-alt'></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div>You don't have any delivery addresses at the moment. Care to add one? 🙂... |
                <a href="<?php echo e(route('profile', ['page' => 'delivery-address'])); ?>">add</a></div>
            <hr class="m-0">
        <?php endif; ?>
    </div>
    <!--    End Update Profile    -->

    <!--    Start Update Password    -->

    <div class="card-header">
        <h3><i class="fas fa-key"></i> Change Password</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="change-password" class="anime_form" action="<?php echo e(route('change-password')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="current_password">Current password *</label>
                <input type="password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="current_password" placeholder="Enter current password *" required>
                <?php $__errorArgs = ['current_password'];
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
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="password">New password *</label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="Enter new password *" required>
                    <?php $__errorArgs = ['password'];
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
                <div class="form-group col-md-6 col-sm-12">
                    <label for="password_confirmation">Confirm New password *</label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="password_confirmation" placeholder="Confirm new password *" required>
                    <?php $__errorArgs = ['password_confirmation'];
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
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Change Password</span>
                </button>
                <img id="change_pass_gif" class="d-none loader_gif" src="<?php echo e(asset('/images/loaders/Infinity-1s-197px.gif')); ?>" alt="loader.gif">
            </div>
        </form>
    </div>
    <!--    End Update Password    -->

    <!--    Start Delete Account    -->

    <div class="card-header">
        <h3><i class="fas fa-user-times"></i> Delete Account</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="col text-right">
            <button type="button" class="morphic_btn morphic_btn_danger" data-toggle="modal" data-target="#exampleModal">
                <span><i class="fas fa-user-slash"></i> Delete Account</span>
            </button>
        </div>
    </div>

    <!--    Start delete modal    -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Deleting your account is irreversible!</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <a type="submit" name="yes" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Delete Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--    End Delete Modal    -->

</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/edit.blade.php ENDPATH**/ ?>