@extends('Admin.layouts.app')
@section('content')

    <div id="coupon-view" class="container-fluid p-0">

        <!--    Start Insert Card    -->
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="card shadow">
                            <form id="coupon-form" action="{{ route('admin.coupon') }}" method="POST">
                                @csrf
                                @if($title === 'Update') @method('PUT') @endif
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="m-0 font-weight-bold"><i class="fab fa-opencart"></i> {{ $title }}</h4>
                                    <div class="dropdown no-arrow">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Order Options</div>
                                            <a class="dropdown-item" href="{{ route('admin.products') }}">View Products</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Method</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="automatic" name="option" class="custom-control-input" value="Automatic" @if(isset($coupon)) disabled @endif checked required>
                                                <label class="custom-control-label" for="automatic">Automatic</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="manual" name="option" class="custom-control-input" value="Manual"
                                                       @if(isset($coupon)) {{ $coupon['option'] === 'Manual' ? 'checked' : '' }} @endif required>
                                                <label class="custom-control-label" for="manual">Manual</label>
                                            </div>
                                        </div>
                                        <div class="form-group col" id="coupon-code-field" @if(isset($coupon)) disabled @else style="display: none" @endif >
                                            <label for="">Code</label>
                                            <input type="text" name="code" class="form-control" placeholder="Enter coupon code" @if(isset($coupon)) disabled @endif
                                            value="@if(isset($coupon)) {{ $coupon['code'] }} @endif" aria-label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Select Categories</label>
                                            <select class="form-control" id="categories_s2" name="categories" multiple="multiple" style="width: 100%" aria-label>
                                                @foreach($sections as $section)
                                                    <optgroup label="{{ $section['title'] }}"></optgroup>
                                                    @foreach($section['categories'] as $category)
                                                        <option value="{{ $category['id'] }}" @if(isset($coupon) && in_array($category['id'], explode(',', $coupon['categories']), false)) selected @endif >
                                                            &nbsp; {{ $category['title'] }}
                                                        </option>
                                                        @foreach($category['sub_categories'] as $subCategory)
                                                            <option value="<%= subCategory.id %>" @if(isset($coupon) && in_array($subCategory['id'], explode(',', $coupon['categories']), false)) selected @endif >
                                                                &nbsp; -- {{ $subCategory['title'] }}</option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label for="">Select Users</label>
                                            <select class="form-control select2" name="users" multiple="multiple" style="width: 100%" aria-label>
                                                @foreach($users as $user)
                                                    <option value="<%= user.email %>" @if(isset($coupon) && in_array($category['id'], explode(',', $coupon['categories']), false)) selected @endif >
                                                        &nbsp; {{ $user['email'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Coupon Type</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="multiple" name="coupon_type" class="custom-control-input" value="Multiple" checked required>
                                                <label class="custom-control-label" for="multiple">Multiple</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="single" name="coupon_type" class="custom-control-input" value="Single"
                                                       @if(isset($coupon)) {{ $coupon['coupon_type'] === 'Single' ? 'checked' : '' }} @endif required>
                                                <label class="custom-control-label" for="single">Single</label>
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label>Amount Type</label><br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="percent" name="amount_type" class="custom-control-input" value="Percent" checked required>
                                                <label class="custom-control-label" for="percent">Percentage (%)</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="fixed" name="amount_type" class="custom-control-input" value="Fixed"
                                                       @if(isset($coupon)) {{ $coupon['amount_type'] === 'Fixed' ? 'checked' : '' }} @endif required>
                                                <label class="custom-control-label" for="fixed">Fixed (in KSH)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="">Amount</label>
                                            <input type="number" name="amount" class="form-control" placeholder="Enter coupon amount" aria-label required
                                                   value="<%= (typeof coupon !== 'undefined') ? coupon.amount : '' %>">
                                        </div>
                                        <div class="form-group col">
                                            <label>Expiry Date</label>
                                            <input type="date" class="form-control" name="expiry_date" placeholder="Enter expiry date" min="2021-01-01" max="2021-12-31" required
                                                   value="<%= (typeof coupon !== 'undefined') ? moment(coupon.expiry).format('YYYY-MM-DD') : '' %>">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> {{ $title }}</button>
                                    <img class="d-none loader_gif" src="{{ asset('/images/loaders/Gear-0.2s-200px.gif') }}" alt="loader.gif">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.coupons') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Coupons List<span class="badge badge-primary badge-pill">14</span>
                            </a>
                            @if(isset($coupon))
                                <a href="{{ route('admin.coupon') }}" class="list-group-item list-group-item-action">Create Coupon</a>
                            @endif
                            <a href="{{ route('admin.customers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Customers<span class="badge badge-primary badge-pill">14</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">7</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Quantity Sold<span class="badge badge-primary badge-pill">17</span>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Remaining stock<span class="badge badge-primary badge-pill">37</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--    End Insert Card    -->
    </div>

@endsection
