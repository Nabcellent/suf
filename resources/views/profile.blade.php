@extends('/layouts.master')
@section('title', 'Profile')
@section('content')
    @include('/partials/top_nav')

    <!--    Start Profile    -->
    <div id="profile">
        <!--    Start Content Area    -->

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
                            <div class="profile-image">
                                @if(!empty(Auth::user()->image) && file_exists(public_path('/images/users/profile/' . Auth::user()->image)))
                                    <img src="{{asset('/images/users/profile/' . Auth::user()->image)}}" class="img-fluid card-img-top" alt="...">
                                @else
                                    <img src="{{asset('/images/users/630728-200.png')}}" class="card-img-top" alt="...">
                                @endif
                                <span data-toggle="modal" data-target="#image_modal">Change picture</span>
                            </div>
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
        <!--    End Content Area    -->

    </div>
    <!--    End Sticky Header Jumbotron    -->


    <!-- Modal -->
    <div class="modal fade" id="image_modal"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile-pic') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Profile Pic</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="inputGroupFile02" accept="image/*" required>
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose an image</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
