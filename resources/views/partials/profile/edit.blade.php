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
        <form id="profile-form" class="anime_form" action="{{route('update-user')}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>First name *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ucfirst($user['first_name'])}}" required>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Last name *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ucfirst($user['last_name'])}}" required>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="u_email">Email address</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" value="{{$user['email']}}" readonly>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="u_gender">Gender</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><?= $genderIcon ?></span>
                        </div>
                        <input type="text" class="form-control" name="gender" value="{{ $gender }}" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Phone Number *</label>
                <div class="input-group mb-3 is-invalid">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                        <span class="input-group-text">+254</span>
                    </div>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$address['phone']}}"
                           pattern="^((7|1)(?:(?:[12569][0-9])|(?:0[0-8])|(4[081])|(3[64]))[0-9]{6})$" aria-label required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="u_first_name">Home Address *</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter your current home address">{{ $address['address'] }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Update Profile</span>
                </button>
                <img id="update_profile_gif" class="d-none loader_gif" src="{{asset('/images/loaders/Infinity-1s-197px.gif')}}" alt="loader.gif">
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
        <form id="change-password" class="anime_form" action="{{route('change-password')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current password *</label>
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter current password *" required>
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="password">New password *</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password *" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="password_confirmation">Confirm New password *</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" placeholder="Confirm new password *" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Change Password</span>
                </button>
                <img id="change_pass_gif" class="d-none loader_gif" src="{{asset('/images/loaders/Infinity-1s-197px.gif')}}" alt="loader.gif">
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
