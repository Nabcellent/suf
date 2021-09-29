<header id="top_header" class="navigation-sticky">

    <!--    Start Sticky Header    -->

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark top_header">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('/images/general/store_logo.jpg')}}" alt="SU-F logo" class="img-fluid main_logo">
            </a>

            <div id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    @auth()
                        @if(User()->hasVerifiedEmail())
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown">
                                    {{Str::substr(ucfirst(Auth::user() -> first_name), 0, 1) . '. ' . ucfirst(Auth::user() -> last_name)}}
                                    @if(!empty(User()->image) && file_exists(public_path('/images/users/profile/' . User()->image)))
                                        <img src="{{ asset('/images/users/profile/' . User()->image) }}" class="img-fluid" alt=""
                                             data-toggle="dropdown"
                                             style="width:1.7rem; height:1.7rem; border-radius:50%; object-fit:cover;">
                                    @else
                                        <i class="fas fa-user-circle"></i>
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(getCart('count') > 0)
                                        <a class="dropdown-item" href="{{ route('checkout') }}">Checkout</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('orders') }}">My Orders</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">My Account</a>
                                    <div class="dropdown-divider"></div>
                                    @if(isTeamSA())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}">Sign Out</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" style="transform: scale(1);">Almost There😁</a>
                            </li>
                            <li class="nav-item" style="text-decoration: underline;">
                                <a class="nav-link" style="text-decoration: underline;" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Sign Out') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @else
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" style="transform: scale(1);">Hey There!👋 You might wanna</a>
                        </li>
                        <li class="nav-item d-none d-md-block" style="text-decoration: underline;">
                            <a class="nav-link" href="{{url('register')}}">Register</a>
                        </li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link">or</a></li>
                        <li class="nav-item d-none d-md-block" style="text-decoration: underline;">
                            <a class="nav-link" href="{{url('login')}}">Sign In</a>
                        </li>
                        <div class="d-flex align-items-center d-md-none text-light">
                            <a class="nav-link" href="{{url('register')}}">Register</a> <span class="px-1">/</span> <a class="nav-link"
                                                                                                                       href="{{url('login')}}">Sign
                                In</a>
                        </div>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
