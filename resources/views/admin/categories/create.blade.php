@extends('admin.layouts.app')
@section('content')

    <div id="categories" class="container-fluid">
        <div class="row">
            <div class="col-9 card pb-3">
                <div class="row my-2">
                    <div class="col">
                        <div class="card crud_table shadow-sm bg-dark">
                            <div class="card-header text-center"><a class="btn btn-info">{{ $title }}</a></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card crud_table shadow-sm">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Add Category</h6>
                            </div>
                            <div class="card-body">
                                <form id="add_category" action="{{ url()->current() }}" method="POST">
                                    <fieldset @isset($subCategory) disabled="disabled" @endisset>
                                        @csrf
                                        @isset($category) @method('PUT') @endisset
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control @error('category_title') is-invalid @enderror" name="category_title"
                                                           value="@isset($category){{ $category['title'] }}@endisset" aria-label required autofocus>
                                                    @error('category_title')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <label>Discount</label>
                                                    <input type="number" class="form-control @error('discount') is-invalid @enderror" min="0" max="99" name="discount"
                                                           value="@isset($category){{ $category['discount'] }}@endisset" aria-label>
                                                    @error('discount')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description" aria-label>@isset($category){{ $category['description'] }}@endisset</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            @if(isset($category))
                                                <div class="form-group">
                                                    <label>Select Section</label>
                                                    @foreach($sections as $section)
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="{{ $section['title'] }}" name="section" value="{{ $section['id'] }}"
                                                                   class="custom-control-input @error('section') is-invalid @enderror" @if($section['id'] === $category['section_id']) checked @endif required>
                                                            <label class="custom-control-label" for="{{ $section['title'] }}">{{ $section['title'] }}</label>
                                                        </div>
                                                        @error('section')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label>Select Sections</label>
                                                    @foreach($sections as $section)
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input @error('sections') is-invalid @enderror" name="sections[]" value="{{ $section['id'] }}" id="{{ $section['id'] }}">
                                                            <label class="custom-control-label" for="{{ $section['id'] }}">{{ $section['title'] }}</label>
                                                            @error('sections')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">{{ $title }}</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card crud_table shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><i class="fab fa-opencart"></i> SU-F Add Sub-Category</h6>
                            </div>
                            <div class="card-body">
                                <form id="add_sub_category" action="@if(isset($subCategory)) {{ route('admin.sub-category', ['id' => $subCategory['id']]) }} @else {{ route('admin.sub-category') }} @endisset" method="POST">
                                    <fieldset @isset($category) disabled="disabled" @endisset>
                                        @csrf
                                        @isset($subCategory) @method('PUT') @endisset
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="section">Section</label>
                                                    <select name="section" id="section" class="form-control @error('section') is-invalid @enderror" required>
                                                        <option selected hidden value="">Select *</option>
                                                        @foreach($sections as $section)
                                                        <option @isset($subCategory) @if($subCategory['section_id'] === $section['id']) selected data-categoryId="{{ $subCategory['category_id'] }}" @endif @endisset
                                                        value="{{ $section['id'] }}">{{ $section['title'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('section')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <label for="category">Category</label>
                                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                                        <option selected hidden value="">Select a category*</option>
                                                    </select>
                                                    @error('category')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control @error('sub_category_title') is-invalid @enderror" name="sub_category_title"
                                                       value="@isset($subCategory){{ $subCategory['title'] }}@endisset" aria-label required>
                                                @error('sub_category_title')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" class="form-control @error('discount') is-invalid @enderror" min="0" max="99" name="discount"
                                                       value="@isset($subCategory){{ $subCategory['discount'] }}@endisset" aria-label>
                                                @error('discount')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="3" class="form-control @error('description') is-invalid @enderror"
                                                          name="description" aria-label>@isset($subCategory){{ $subCategory['description'] }}@endisset</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">{{ $title }}</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col text-right">
                        <button class="btn btn-outline-dark">Multi-Create</button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card crud_table shadow mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                All Categories<span class="badge badge-primary badge-pill">{{ tableCount()['admins'] }}</span>
                            </a>
                            <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Products<span class="badge badge-primary badge-pill">{{ tableCount()['sellers'] }}</span>
                            </a>
                            <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Orders<span class="badge badge-primary badge-pill">{{ tableCount()['orders'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
