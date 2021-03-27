@extends('/layouts.master')
@section('title', 'Home')
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
                                <img src="/images/user/630728-200.png" class="card-img-top" alt="...">
                                <h5 class="card-title">User Name</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush category_menu profile_links">
                                    <li class="list-group-item">
                                        <a href="/profile/edit" class="stretched-link">
                                            <i class="fas fa-user-edit"></i>
                                            <span>Your Account</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/profile/my-orders" class="stretched-link">
                                            <i class="fas fa-list"></i>
                                            <span>My Orders</span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/sign-out" class="stretched-link">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Sign Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--    End Sidebar    -->

                    <!--    Start My Orders Section    -->

                    <div class="col-md-9 px-1 profile_pages">

                        @if(Request() -> page === 'edit')
                            @include('partials.profile.edit')
                        @elseif(Request() -> page === 'my-orders')
                            @include('partials.profile.myorders')
                        @elseif(Request() -> page === 'confirm-payment')
                            @include('partials.profile.confirm_payment')
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
