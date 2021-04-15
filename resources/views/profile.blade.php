@extends('/layouts.master')
@section('title', 'Profile')
@section('content')
    @include('/partials/top_nav')


    <!--    Start Profile    -->
    <div id="profile">
        <!--    Start Content Area    -->
        <div id="content">
            <div class="container profile_container">

                <!--    Start Page Header    -->
                <div class="container px-1">
                    <div class="row">
                        <div class="col-md-12 px-0">
                            <div class="card-header profile_header">
                                <h2>Profile</h2>
                                <div class="underline"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    End Page Header    -->

                <div class="row py-2">
                    <!--    Start Sidebar    -->

                    <div class="col-md-3 px-1">
                        <div class="card mb-2 sidebar_menu">
                            <div class="card-header">
                                <img src="{{asset('/images/users/630728-200.png')}}" class="card-img-top" alt="...">
                                <h5 class="card-title" style="text-decoration: underline">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush category_menu profile_links">
                                    <li class="list-group-item">
                                        <a href="{{url('/account')}}" class="stretched-link">
                                            <i class="fas fa-user-edit"></i><span>Your Account</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/orders')}}" class="stretched-link">
                                            <i class="fas fa-list"></i><span>My Orders</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{url('/account/delivery-address')}}" class="stretched-link">
                                            <i class="far fa-address-card"></i><span>Delivery Addresses</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{route('logout')}}" class="stretched-link">
                                            <i class="fas fa-sign-out-alt"></i><span>Sign Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--    End Sidebar    -->

                    <!--    Start My Orders Section    -->

                    <div class="col-md-9 px-1 profile_pages">
                        @if($page === 'edit')
                            @include('partials.profile.edit')
                        @elseif($page === 'orders')
                            @include('partials.profile.orders')
                        @elseif($page === 'delivery-address')
                            @include('partials.profile.delivery_address')
                        @endif

                    </div>
                    <!--    End My Orders Section    -->
                </div>
            </div>
        </div>
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->

@endsection
