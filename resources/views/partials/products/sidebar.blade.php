
<div id="sidebar_menu">
    <div class="row">
        <div class="col p-md-0">
            <div class="card main mb-2">
                <div class="card-header d-flex bd-highlight">
                    <div class="w-100 bd-highlight"><h4>Categories</h4></div>
                    <div class="flex-shrink-1 bd-highlight">
                        <div class="text-secondary burger_toggle open_burger">
                            <div class="burger"></div>
                        </div>
                    </div>
                </div>

                <div class="card-body category_menu">
                    <div class="collapse_category">
                        <div class="col-12 mx-auto search_box">
                            <label for="suf_table_filter"></label>
                            <input type="text" class=" search_text" placeholder="Search Category" id="suf_table_filter"
                                   data-filters="#suf_products" data-action="filter">
                            <a href="#" class="search_btn"><i class="fas fa-search"></i></a>
                        </div>

                        <div class="col-12 list_menu">
                            <ul id="suf_products">

                                @foreach($sections as $section)
                                    @if(count($section['categories']) > 0)
                                        <li class='list-group-item'>
                                            <div class="dropdown-divider mb-0"></div>
                                            <strong>{{strtoupper($section['title'])}}</strong>
                                            @foreach($section['categories'] as $category)
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <label class='form-check-label check_label'>
                                                            <input type='checkbox' class='form-check-input product_check' id='product_cat' value=''>
                                                            <span></span>
                                                            <i class="indicator"></i>
                                                            <strong>{{$category['title']}}</strong>
                                                        </label>
                                                    </div>
                                                </li>
                                                @foreach($category['sub_categories'] as $subCategory)
                                                <li>
                                                    <div class="form-check">
                                                        <label class='form-check-label check_label'>
                                                            <input type='checkbox' class='form-check-input product_check' id='product_cat' value=''>
                                                            <span></span>
                                                            <i class="indicator"></i>
                                                            {{$subCategory['title']}}
                                                        </label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endforeach
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex bd-highlight">
                    <div class="w-100 bd-highlight"><h4>Manufacturers</h4></div>
                    <div class="flex-shrink-1 bd-highlight">
                        <div class="text-secondary burger_toggle open_burger">
                            <div class="burger"></div>
                        </div>
                    </div>
                </div>

                <div class="card-body category_menu">
                    <div class="collapse_category">
                        <div class="col-12 mx-auto search_box">
                            <label for="suf_table_filter"></label>
                            <input type="text" class=" search_text" placeholder="Search Manufacturer" id="suf_table_filter"
                                   data-filters="#suf_manufacturer" data-action="filter">
                            <a href="#" class="search_btn"><i class="fas fa-search"></i></a>
                        </div>

                        <div class="col-12 list_menu">
                            <ul id="suf_manufacturer">

                                @foreach($sidebarInfo['sellers'] as $item)
                                    <li class='list-group-item'>
                                        <div class="form-check">
                                            <label class='form-check-label check_label'>
                                                <input type='checkbox' class='form-check-input product_check' id='product_cat' value=''>
                                                <span></span>
                                                <i class="indicator"></i>
                                                {{$item -> username}}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex bd-highlight">
                    <div class="w-100 bd-highlight"><h4>Category</h4></div>
                    <div class="flex-shrink-1 bd-highlight">
                        <div class="text-secondary burger_toggle open_burger">
                            <div class="burger"></div>
                        </div>
                    </div>
                </div>

                <div class="card-body category_menu">
                    <div class="collapse_category">
                        <div class="col-12 list_menu">
                            <ul id="suf_categories">

                                @foreach($sections as $section)
                                    <li class='list-group-item'>
                                        <div class="form-check">
                                            <label class='form-check-label check_label'>
                                                <input type='checkbox' class='form-check-input product_check' id='product_cat' value=''>
                                                <span></span>
                                                <i class="indicator"></i>
                                                {{$section['title']}}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
