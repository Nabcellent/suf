
<div id="delivery-address" class="card">

    <!--    Start Update Profile    -->
    <div class="card-header">
        <h3><i class="fas fa-user-edit"></i> Delivery Address</h3>
        <hr>
    </div>
    <div class="card-body">
        <form id="delivery-address-form" class="anime_form"  method="POST"
              @if(empty($address['id'] ?? '')) action="{{route('delivery-address')}}" @else action="{{url('/delivery-address/' . $address ["id"])}}" @endif >
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>County *</label>
                    <select type="text" class="form-control @error('county') is-invalid @enderror" id="county" name="county" required>
                        <option selected hidden value="">Select your county *</option>
                        @foreach($counties as $county)
                            <option @if(!empty($address ?? '') && $address['sub_county']['county']['id'] === $county['id']) selected data-subCounty="{{ $address['sub_county_id'] }}" @endif
                            value="{{ $county['id'] }}">{{ $county['name'] }}</option>
                        @endforeach
                    </select>
                    @error('county')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Sub-County *</label>
                    <select type="text" class="form-control @error('sub_county') is-invalid @enderror" name="sub_county" required>
                        <option selected hidden value="">Select your Sub-county *</option>
                    </select>
                    @error('sub_county')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="u_first_name">Address (District/Estate/House No.) *</label>
                <textarea class="form-control @error('address') is-invalid @enderror"
                          name="address" required placeholder="Enter the address details i.e; Location, Street name/Drive, Estate, house number (Where applicable) *">{{ old('address') }}{{ $address['address'] ?? '' }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="morphic_btn morphic_btn_primary">
                    <span><i class="fas fa-pen"></i> {{$btnAction}} Address</span>
                </button>
                <img id="update_profile_gif" class="d-none loader_gif" src="{{asset('/images/loaders/Infinity-1s-197px.gif')}}" alt="loader.gif">
            </div>
        </form>
    </div>
    <!--    End Update Profile    -->
</div>
