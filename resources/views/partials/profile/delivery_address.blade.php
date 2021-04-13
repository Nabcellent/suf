
<div id="edit-profile" class="card">

    <!--    Start Update Profile    -->
    <div class="card-header">
        <h3><i class="fas fa-user-edit"></i> Delivery Address</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="profile-form" class="anime_form" action="{{route('update-user')}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>County</label>
                    <select type="text" class="form-control @error('first_name') is-invalid @enderror" name="county" required>
                        <option selected hidden value="">Select your county</option>
                        @foreach($counties as $county)
                            <option value="{{ $county['id'] }}">{{ $county['name'] }}</option>
                        @endforeach
                    </select>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Sub-County</label>
                    <select type="text" class="form-control @error('first_name') is-invalid @enderror" name="sub_county" required>
                        <option selected hidden value="">Select your county</option>
                    </select>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="u_first_name">Estate/House Address *</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter your current home address">{{ $address['address'] }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> Add Address</span>
                </button>
                <img id="update_profile_gif" class="d-none loader_gif" src="{{asset('/images/loaders/Infinity-1s-197px.gif')}}" alt="loader.gif">
            </div>
        </form>
    </div>
    <!--    End Update Profile    -->
</div>
