
<div class="card edit_profile">

    <!--    Start Update Profile    -->

    <div class="card-header">
        <h3><i class="fas fa-user-edit"></i> Personal Details</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="edit_profile_form" class="anime_form" action="/profile/update-user" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="u_first_name">First name *</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo e(ucfirst(Auth::user() -> first_name)); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="u_last_name">Last name *</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo e(ucfirst(Auth::user() -> last_name)); ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="u_email">Email address</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" value="<?php echo e(Auth::user() -> email); ?>" readonly>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="u_gender">Gender</label>
                    <div class="input-group mb-3">
                        <?php if(Auth::user() -> gender === 'M'): ?>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='bx bx-male-sign'></i></span>
                            </div>
                            <input type="text" class="form-control" name="gender" value="Male" readonly>
                            <?php elseif(Auth::user() -> gender ==='F'): ?>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='bx bx-female-sign'></i></span>
                            </div>
                            <input type="text" class="form-control" name="gender" value="Female" readonly>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="u_phone_number">Phone Number *</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                        <span class="input-group-text">+254</span>
                    </div>
                    <input type="number" class="form-control" name="phone" pattern="([0 | 1 | 7]+).*"
                           value="<?php echo e(\App\Models\Address::firstWhere('user_id', Auth::id()) -> phone); ?>" aria-label required>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Update Profile</span>
                </button>
                <img id="update_profile_gif" class="d-none loader_gif" src="/images/loaders/Infinity-1s-197px.gif" alt="loader.gif">
            </div>
        </form>
    </div>
    <!--    End Update Profile    -->

    <!--    Start Update Password    -->

    <div class="card-header">
        <h3><i class="fas fa-key"></i> Change Password</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="change_password_form" class="anime_form" action="../../profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" id="customer_email" name="customer_email" value="">
                <label for="u_current_pass">Current password *</label>
                <input type="password" class="form-control" id="u_current_pass" name="u_current_pass" placeholder="Enter current password *" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="u_new_pass">New password *</label>
                    <input type="password" class="form-control" id="u_new_pass" name="u_new_pass" placeholder="Enter new password *" required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="u_confirm_new_pass">Confirm New password *</label>
                    <input type="password" class="form-control" id="u_confirm_new_pass" name="u_confirm_new_pass" placeholder="Confirm new password *" required>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" name="customer_crud" value="update_pass" class="morphic_btn morphic_btn_primary"><span><i class="fas fa-pen"></i> Change Password</span></button>
                <img id="change_pass_gif" class="d-none loader_gif" src="/images/loaders/Infinity-1s-197px.gif" alt="loader.gif">
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
                        <h5>Deleting your account is irreversible!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="yes" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--    End Delete Modal    -->

</div>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/profile/edit.blade.php ENDPATH**/ ?>