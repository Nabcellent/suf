
<div id="categories_sidebar">
    <div class="d-flex justify-content-between filters-header"  data-toggle="collapse" data-target="#filters">
        <h4 class="m-0 d-none d-md-block">FILTERS</h4><i class="fas fa-filter"></i>
    </div>
    <ul id="filters" class="list-group list-group-flush">
        <?php $sections = sections(); ?>
        @foreach($sections as $section)
            @if(count($section['categories']) > 0)
                <li class="list-group-item">
                    <span class="row">
                        <span class="col">
                            <a href="#" class="btn-block" data-toggle="collapse" data-target="#collapse{{$section['id']}}">
                                {{strtoupper($section['title'])}}
                            </a>
                        </span>
                        <span class="col-auto mr-2 bg-dark search_icon" data-toggle="collapse" data-target="#search_box{{$loop->iteration}}">
                            <i class="bx bx-search"></i>
                        </span>
                    </span>
                    <div id="search_box{{$loop->iteration}}" class="collapse search_box">
                        <input type="text" class="search_text" placeholder="Search Category" aria-label
                               data-filters="#suf_products" data-action="filter">
                    </div>
                    <ul id="collapse{{$section['id']}}" class="list-group list-group-flush show">
                        @foreach($section['categories'] as $category)
                            <li class="list-group-item py-1">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check list">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input product_check" id="category" value="{{$category['id']}}">
                                            <span></span>
                                            <i class="indicator"></i>
                                            <strong>{{$category['title']}}</strong>
                                        </label>
                                    </div>
                                    @if(count($category['sub_categories']) > 0)
                                        <span class="px-2 rounded-pill" data-toggle="collapse" data-target="#sub_collapse{{$category['id']}}" style="background-color: #900; color: #cbd5e0">
                                            <i class="bx bx-arrow-to-bottom bx-fade-down-hover" style="cursor: pointer;"></i>
                                        </span>
                                    @endif
                                </div>
                                <ul id="sub_collapse{{$category['id']}}" class="list-group list-group-flush collapse">
                                    @foreach($category['sub_categories'] as $subCategory)
                                        <li class="list-group-item py-0">
                                            <div class="form-check sub_list">
                                                <label class="form-check-label">
                                                    <input type='checkbox' class='form-check-input product_check' id="sub_category" value="{{$subCategory['id']}}">
                                                    <span></span>
                                                    <i class="indicator"></i>
                                                    {{$subCategory['title']}}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach


        <li class="list-group-item">
            <a href="#" class="btn-block" data-toggle="collapse" data-target="#seller_collapse">SELLERS</a>
            <ul id="seller_collapse" class="list-group list-group-flush show">
                @foreach($sellers as $item)
                    <li class="list-group-item py-1">
                        <div class="d-flex justify-content-between">
                            <div class="form-check list">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" id="seller" value="{{$item['user_id']}}">
                                    <span></span>
                                    <i class="indicator"></i>
                                    <strong>{{$item['username']}}</strong>
                                </label>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span class="row">
                <span class="col">
                    <a href="#" class="btn-block" data-toggle="collapse" data-target="#brands_collapse">
                        BRANDS
                    </a>
                </span>
                <span class="col-auto mr-2 bg-dark search_icon" data-toggle="collapse" data-target="#search_box">
                    <i class="bx bx-search"></i>
                </span>
            </span>
            <div id="search_box" class="collapse search_box">
                <input type="text" class="search_text" placeholder="Search Category" aria-label
                       data-filters="#suf_products" data-action="filter">
            </div>
            <ul id="brands_collapse" class="list-group list-group-flush show">
                @foreach($brands as $item)
                    <li class="list-group-item py-1">
                        <div class="d-flex justify-content-between">
                            <div class="form-check list">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" id="brand" value="{{$item['id']}}">
                                    <span></span>
                                    <i class="indicator"></i>
                                    <strong>{{$item['name']}}</strong>
                                </label>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
